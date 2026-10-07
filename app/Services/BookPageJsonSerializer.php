<?php

namespace App\Services;

use DOMDocument;
use DOMElement;
use DOMNode;
use UnexpectedValueException;

class BookPageJsonSerializer
{
    /**
     * @return array{
     *     page_number: int,
     *     blocks: array<int, array<string, mixed>>,
     *     footnotes: array<int, array<string, mixed>>
     * }
     */
    public function serialize(int $pageNumber, string $html): array
    {
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = true;
        $previousErrorMode = libxml_use_internal_errors(true);

        try {
            $loaded = $dom->loadHTML(
                '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>'.$html.'</body></html>',
                LIBXML_NONET
            );
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($previousErrorMode);
        }

        if (! $loaded) {
            throw new UnexpectedValueException('Unable to parse book page HTML for JSON serialization.');
        }

        $body = $dom->getElementsByTagName('body')->item(0);
        if ($body === null) {
            throw new UnexpectedValueException('Parsed book page HTML has no body element.');
        }

        $page = $this->findPageElement($body) ?? $body;
        $blocks = [];
        $footnoteBlocks = [];

        foreach ($page->childNodes as $child) {
            if ($child instanceof DOMElement && $this->hasAnyClass($child, ['page-number'])) {
                continue;
            }

            if ($child instanceof DOMElement && $this->hasAnyClass($child, ['page-footnote'])) {
                $footnoteBlocks[] = $child;

                continue;
            }

            $node = $this->serializeNode($child, $pageNumber, false, '', '');
            if ($node !== null) {
                $blocks[] = $node;
            }
        }

        return [
            'page_number' => $pageNumber,
            'blocks' => $blocks,
            'footnotes' => $this->serializeFootnotes($footnoteBlocks, $pageNumber),
        ];
    }

    private function findPageElement(DOMNode $node): ?DOMElement
    {
        foreach ($node->childNodes as $child) {
            if (! $child instanceof DOMElement) {
                continue;
            }

            if ($this->hasAnyClass($child, ['page'])) {
                return $child;
            }

            $page = $this->findPageElement($child);
            if ($page !== null) {
                return $page;
            }
        }

        return null;
    }

    /**
     * @param  array<int, DOMElement>  $footnoteBlocks
     * @return array<int, array<string, mixed>>
     */
    private function serializeFootnotes(array $footnoteBlocks, int $pageNumber): array
    {
        $footnotes = [];
        $currentIndex = null;

        foreach ($footnoteBlocks as $footnoteBlock) {
            foreach ($footnoteBlock->childNodes as $paragraph) {
                if (! $paragraph instanceof DOMElement || ! $this->hasAnyClass($paragraph, ['footnote-p'])) {
                    continue;
                }

                $leadingSuperscript = $this->firstElementChild($paragraph, 'sup');
                $number = $leadingSuperscript === null
                    ? null
                    : trim($leadingSuperscript->textContent);
                if ($number !== null && preg_match('/^\d+$/u', $number) !== 1) {
                    $number = null;
                }

                $content = [];
                foreach ($paragraph->childNodes as $child) {
                    if ($child === $leadingSuperscript) {
                        continue;
                    }

                    $node = $this->serializeNode($child, $pageNumber, true, '', '');
                    if ($node !== null) {
                        $content[] = $node;
                    }
                }
                while (isset($content[0]) && $content[0]['type'] === 'text' && trim($content[0]['text']) === '') {
                    array_shift($content);
                }
                if (isset($content[0]) && $content[0]['type'] === 'text') {
                    $content[0]['text'] = ltrim($content[0]['text']);
                }

                if ($number !== null) {
                    $footnotes[] = [
                        'number' => (int) $number,
                        'target' => $pageNumber.':'.$number,
                        'blocks' => [],
                        'continues_from_previous_page' => false,
                        'continues_to_next_page' => false,
                    ];
                    $currentIndex = array_key_last($footnotes);
                } elseif ($currentIndex === null) {
                    $footnotes[] = [
                        'number' => null,
                        'target' => null,
                        'blocks' => [],
                        'continues_from_previous_page' => true,
                        'continues_to_next_page' => false,
                    ];
                    $currentIndex = array_key_last($footnotes);
                }

                if ($currentIndex === null) {
                    continue;
                }

                $paragraphNode = [
                    'type' => 'paragraph',
                    'children' => $content,
                ];
                $presentation = $this->presentation($paragraph);
                if ($presentation !== []) {
                    $paragraphNode['presentation'] = $presentation;
                }

                $continues = $this->endsWithContinuationArrow($paragraphNode);
                if ($continues) {
                    $this->removeTrailingContinuationArrow($paragraphNode);
                    $footnotes[$currentIndex]['continues_to_next_page'] = true;
                }

                $footnotes[$currentIndex]['blocks'][] = $paragraphNode;
            }
        }

        return $footnotes;
    }

    private function firstElementChild(DOMElement $parent, string $tagName): ?DOMElement
    {
        foreach ($parent->childNodes as $child) {
            if ($child instanceof DOMElement && strtolower($child->tagName) === $tagName) {
                return $child;
            }
        }

        return null;
    }

    /**
     * @return array<string, mixed>|null
     */
    private function serializeNode(
        DOMNode $node,
        int $pageNumber,
        bool $insideFootnote,
        string $inheritedLanguage,
        string $inheritedDirection
    ): ?array {
        if ($node->nodeType === XML_TEXT_NODE) {
            $text = preg_replace('/\s+/u', ' ', $node->nodeValue ?? '');
            if ($text === null || $text === '') {
                return null;
            }

            if (trim($text) === '' && $node->parentNode instanceof DOMElement
                && in_array(strtolower($node->parentNode->tagName), [
                    'body',
                    'div',
                    'section',
                    'article',
                    'ul',
                    'ol',
                    'table',
                    'thead',
                    'tbody',
                    'tfoot',
                    'tr',
                ], true)) {
                return null;
            }

            return ['type' => 'text', 'text' => $text];
        }

        if (! $node instanceof DOMElement) {
            return null;
        }

        $tag = strtolower($node->tagName);
        if (in_array($tag, ['script', 'style', 'iframe', 'object', 'embed'], true)) {
            return null;
        }

        $language = trim($node->getAttribute('lang')) ?: $inheritedLanguage;
        $direction = trim($node->getAttribute('dir')) ?: $inheritedDirection;
        $classes = preg_split('/\s+/', trim($node->getAttribute('class')) ?: '') ?: [];
        $type = $this->nodeType($tag, $classes, $insideFootnote);

        if ($tag === 'img') {
            $src = trim($node->getAttribute('src'));
            if ($src === '') {
                return null;
            }

            $result = [
                'type' => 'image',
                'src' => $src,
                'alt' => $node->getAttribute('alt'),
            ];
        } elseif ($tag === 'br') {
            $result = ['type' => 'line_break'];
        } elseif ($tag === 'hr') {
            $result = ['type' => 'thematic_break'];
        } else {
            $result = ['type' => $type];
            if (in_array($tag, ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'], true)) {
                $result['level'] = (int) substr($tag, 1);
            }
            if ($tag === 'ol') {
                $result['ordered'] = true;
            } elseif ($tag === 'ul') {
                $result['ordered'] = false;
            } elseif ($type === 'element') {
                $result['tag'] = $tag;
            }
            if ($tag === 'a') {
                $href = trim($node->getAttribute('href'));
                if ($href !== '' && ! preg_match('/^\s*javascript:/i', $href)) {
                    $result['href'] = $href;
                }
            }

            $children = [];
            foreach ($node->childNodes as $child) {
                $childNode = $this->serializeNode($child, $pageNumber, $insideFootnote, $language, $direction);
                if ($childNode !== null) {
                    $children[] = $childNode;
                }
            }
            if ($children !== []) {
                $result['children'] = $children;
            }
        }

        if ($language !== '') {
            $result['language'] = $language;
        }
        if ($direction !== '') {
            $result['direction'] = $direction;
        }

        $presentation = $this->presentation($node);
        if ($presentation !== []) {
            $result['presentation'] = $presentation;
        }

        if ($tag === 'sup' && ! $insideFootnote) {
            $number = trim($node->textContent);
            if (preg_match('/^\d+$/u', $number) === 1) {
                return [
                    'type' => 'footnote_ref',
                    'number' => (int) $number,
                    'target' => $pageNumber.':'.$number,
                ];
            }

            $result['type'] = 'superscript';
        }

        return $result;
    }

    /**
     * @param  array<int, string>  $classes
     */
    private function nodeType(string $tag, array $classes, bool $insideFootnote): string
    {
        return match ($tag) {
            'p' => 'paragraph',
            'h1', 'h2', 'h3', 'h4', 'h5', 'h6' => 'heading',
            'strong', 'b' => 'strong',
            'em', 'i' => 'emphasis',
            'a' => 'link',
            'ul', 'ol' => 'list',
            'li' => 'list_item',
            'blockquote' => 'blockquote',
            'sup' => $insideFootnote ? 'superscript' : 'footnote_ref',
            'div' => 'container',
            'span' => 'span',
            default => 'element',
        };
    }

    /**
     * @return array<string, string>
     */
    private function presentation(DOMElement $element): array
    {
        $classes = preg_split('/\s+/', trim($element->getAttribute('class')) ?: '') ?: [];
        $style = strtolower($element->getAttribute('style'));
        $presentation = [];

        if (array_intersect($classes, ['text-center', 'text-center-constrained']) !== []) {
            $presentation['alignment'] = 'center';
        } elseif (array_intersect($classes, ['text-end', 'text-right']) !== []) {
            $presentation['alignment'] = 'right';
        } elseif (array_intersect($classes, ['text-start', 'text-left']) !== []) {
            $presentation['alignment'] = 'left';
        } elseif (preg_match('/(?:^|;)\s*text-align\s*:\s*(left|right|center|justify)\s*(?:;|$)/', $style, $matches) === 1) {
            $presentation['alignment'] = $matches[1];
        }

        if (in_array('text-red', $classes, true)) {
            $presentation['tone'] = 'accent';
        }
        if (in_array('small-title', $classes, true)) {
            $presentation['role'] = 'small_title';
            $presentation['tone'] = 'accent';
        }
        if (in_array('text-arabic-bismillah', $classes, true)) {
            $presentation['role'] = 'bismillah';
        }
        if (in_array('page-title-chapter', $classes, true)) {
            $presentation['role'] = 'chapter_title';
        }
        if (in_array('honorific', $classes, true)) {
            $presentation['role'] = 'honorific';
        }
        if (in_array('text-bold', $classes, true)) {
            $presentation['font_weight'] = 'semibold';
        }
        if (in_array('text-italic', $classes, true)) {
            $presentation['font_style'] = 'italic';
        }
        if (in_array('text-underline', $classes, true)) {
            $presentation['text_decoration'] = 'underline';
        }
        if (in_array('text-arabic', $classes, true) || in_array('text-arabic-inline', $classes, true)) {
            $presentation['typeface'] = 'arabic_naskh';
        } elseif (in_array('delima-font', $classes, true)) {
            $presentation['typeface'] = 'book_display';
        }
        if (in_array('text-center-constrained', $classes, true)) {
            $presentation['width'] = 'reading_column';
        }

        if (in_array('bismillah-svg-light', $classes, true)) {
            $presentation['theme_variant'] = 'light';
        } elseif (in_array('bismillah-svg-dark', $classes, true)) {
            $presentation['theme_variant'] = 'dark';
        }

        return $presentation;
    }

    /**
     * @param  array<string, mixed>  $paragraph
     */
    private function endsWithContinuationArrow(array $paragraph): bool
    {
        $text = $this->plainText($paragraph);

        return preg_match('/(?:→|&rarr;)\s*$/u', $text) === 1;
    }

    /**
     * @param  array<string, mixed>  $node
     */
    private function plainText(array $node): string
    {
        if (($node['type'] ?? null) === 'text') {
            return (string) ($node['text'] ?? '');
        }

        $text = '';
        foreach ($node['children'] ?? [] as $child) {
            if (is_array($child)) {
                $text .= $this->plainText($child);
            }
        }

        return $text;
    }

    /**
     * @param  array<string, mixed>  $node
     */
    private function removeTrailingContinuationArrow(array &$node): void
    {
        if (($node['type'] ?? null) === 'text') {
            $node['text'] = preg_replace('/(?:→|&rarr;)\s*$/u', '', (string) ($node['text'] ?? '')) ?? $node['text'];

            return;
        }

        if (! isset($node['children']) || ! is_array($node['children'])) {
            return;
        }

        for ($index = count($node['children']) - 1; $index >= 0; $index--) {
            if (! is_array($node['children'][$index])) {
                continue;
            }

            $this->removeTrailingContinuationArrow($node['children'][$index]);
            if ($this->plainText($node['children'][$index]) !== '') {
                return;
            }
        }
    }

    /**
     * @param  array<int, string>  $classes
     */
    private function hasAnyClass(DOMElement $element, array $classes): bool
    {
        $elementClasses = preg_split('/\s+/', trim($element->getAttribute('class')) ?: '') ?: [];

        return array_intersect($classes, $elementClasses) !== [];
    }
}

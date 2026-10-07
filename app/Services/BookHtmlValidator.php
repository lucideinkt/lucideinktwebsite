<?php

namespace App\Services;

use DOMDocument;
use DOMElement;
use DOMNode;
use LibXMLError;
use UnexpectedValueException;

class BookHtmlValidator
{
    /**
     * @return array<int, array{code: string, severity: string, message: string}>
     */
    public function validatePageHtml(string $html, ?int $expectedPageNumber = null): array
    {
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = true;
        $previousErrorMode = libxml_use_internal_errors(true);

        try {
            $loaded = $dom->loadHTML(
                '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>'.$html.'</body></html>',
                LIBXML_NONET
            );
            $parseErrors = libxml_get_errors();
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($previousErrorMode);
        }

        if (! $loaded) {
            throw new UnexpectedValueException('Unable to parse book page HTML for validation.');
        }

        $body = $dom->getElementsByTagName('body')->item(0);
        if ($body === null) {
            throw new UnexpectedValueException('Parsed book page HTML has no body element.');
        }

        $findings = [];
        $page = $this->findFirstElementWithClass($body, 'page');

        if ($page === null) {
            $findings[] = $this->finding(
                'page-wrapper-missing',
                'error',
                'Page markup does not contain an element with class "page".'
            );
        } else {
            $this->validatePageNumber($page, $body, $expectedPageNumber, $findings);
        }

        foreach ($this->findElementsWithClass($body, ['fn-ref']) as $footnoteReference) {
            if ($footnoteReference->hasAttribute('data-html') && trim($footnoteReference->getAttribute('data-html')) !== '') {
                $findings[] = $this->finding(
                    'footnote-content-in-reference',
                    'error',
                    'Footnote content must be stored in the page footnotes block, not in the reference.'
                );
            }
        }

        foreach ($this->findElementsWithClass($body, ['text-arabic', 'text-arabic-inline', 'text-arabic-bismillah']) as $arabicElement) {
            if (! $this->containsArabicLetters($arabicElement->textContent)) {
                continue;
            }

            if ($this->effectiveAttribute($arabicElement, 'lang') === '') {
                $findings[] = $this->finding(
                    'arabic-lang-missing',
                    'warning',
                    'Arabic-script content has no language metadata on it or an ancestor.'
                );
            }

            if (strtolower($this->effectiveAttribute($arabicElement, 'dir')) !== 'rtl') {
                $findings[] = $this->finding(
                    'arabic-direction-missing',
                    'warning',
                    'Arabic-script content has no effective dir="rtl" metadata.'
                );
            }
        }

        $this->validateFootnoteReferences($body, $findings);

        foreach ($parseErrors as $parseError) {
            if ($parseError instanceof LibXMLError && $parseError->level === LIBXML_ERR_ERROR) {
                $findings[] = $this->finding(
                    'html-parse-error',
                    'warning',
                    'HTML parser reported a recoverable markup error.'
                );
                break;
            }
        }

        return $findings;
    }

    private function containsArabicLetters(string $text): bool
    {
        $text = str_replace(["\u{06DD}", "\u{06DE}", "\u{06E9}"], '', $text);

        return preg_match('/\p{Arabic}/u', $text) === 1;
    }

    /**
     * @param  array<int, array{code: string, severity: string, message: string}>  $findings
     */
    private function validatePageNumber(DOMElement $page, DOMElement $body, ?int $expectedPageNumber, array &$findings): void
    {
        if ($expectedPageNumber === null) {
            return;
        }

        $pageId = $page->getAttribute('id');
        if ($pageId !== '' && ctype_digit($pageId) && (int) $pageId !== $expectedPageNumber) {
            $findings[] = $this->finding(
                'page-id-mismatch',
                'error',
                sprintf('Page element id "%s" does not match stored page number %d.', $pageId, $expectedPageNumber)
            );
        }

        foreach ($this->findElementsWithClass($body, ['page-number']) as $pageNumberElement) {
            $text = trim($pageNumberElement->textContent);
            if (preg_match('/#?\s*(\d+)/u', $text, $matches) === 1 && (int) $matches[1] !== $expectedPageNumber) {
                $findings[] = $this->finding(
                    'printed-page-number-mismatch',
                    'warning',
                    sprintf('Printed page number "%s" does not match stored page number %d.', $text, $expectedPageNumber)
                );
            }

            break;
        }
    }

    /**
     * @param  array<int, array{code: string, severity: string, message: string}>  $findings
     */
    private function validateFootnoteReferences(DOMElement $body, array &$findings): void
    {
        $definedNumbers = [];
        foreach ($this->findElementsWithClass($body, ['page-footnote']) as $footnoteBlock) {
            foreach ($footnoteBlock->getElementsByTagName('sup') as $superscript) {
                $number = trim($superscript->textContent);
                if (preg_match('/^\d+$/u', $number) === 1) {
                    $definedNumbers[$number] = true;
                }
            }
        }

        foreach ($body->getElementsByTagName('sup') as $superscript) {
            if ($this->hasAncestorWithClass($superscript, 'page-footnote')) {
                continue;
            }

            $number = trim($superscript->textContent);
            if (preg_match('/^\d+$/u', $number) !== 1 || isset($definedNumbers[$number])) {
                continue;
            }

            $findings[] = $this->finding(
                'footnote-not-defined-on-page',
                'warning',
                sprintf('Footnote reference "%s" has no matching note on this page; it may be a continuation or intentional cross-page reference.', $number)
            );
        }
    }

    private function findFirstElementWithClass(DOMNode $node, string $class): ?DOMElement
    {
        foreach ($node->childNodes as $child) {
            if (! $child instanceof DOMElement) {
                continue;
            }

            if ($this->hasClass($child, $class)) {
                return $child;
            }

            $match = $this->findFirstElementWithClass($child, $class);
            if ($match !== null) {
                return $match;
            }
        }

        return null;
    }

    /**
     * @param  array<int, string>  $classes
     * @return array<int, DOMElement>
     */
    private function findElementsWithClass(DOMNode $node, array $classes): array
    {
        $matches = [];

        foreach ($node->childNodes as $child) {
            if (! $child instanceof DOMElement) {
                continue;
            }

            if ($this->hasAnyClass($child, $classes)) {
                $matches[] = $child;
            }

            array_push($matches, ...$this->findElementsWithClass($child, $classes));
        }

        return $matches;
    }

    private function hasAncestorWithClass(DOMNode $node, string $class): bool
    {
        for ($ancestor = $node->parentNode; $ancestor !== null; $ancestor = $ancestor->parentNode) {
            if ($ancestor instanceof DOMElement && $this->hasClass($ancestor, $class)) {
                return true;
            }
        }

        return false;
    }

    private function effectiveAttribute(DOMElement $node, string $attribute): string
    {
        for ($current = $node; $current !== null; $current = $current->parentNode) {
            if ($current instanceof DOMElement && $current->hasAttribute($attribute)) {
                return trim($current->getAttribute($attribute));
            }
        }

        return '';
    }

    private function hasClass(DOMElement $node, string $class): bool
    {
        return $this->hasAnyClass($node, [$class]);
    }

    /**
     * @param  array<int, string>  $classes
     */
    private function hasAnyClass(DOMElement $node, array $classes): bool
    {
        $nodeClasses = preg_split('/\s+/', trim($node->getAttribute('class')) ?: '');

        return is_array($nodeClasses) && array_intersect($classes, $nodeClasses) !== [];
    }

    /**
     * @return array{code: string, severity: string, message: string}
     */
    private function finding(string $code, string $severity, string $message): array
    {
        return compact('code', 'severity', 'message');
    }
}

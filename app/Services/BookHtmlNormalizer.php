<?php

namespace App\Services;

use DOMDocument;
use DOMElement;
use DOMNode;
use UnexpectedValueException;

class BookHtmlNormalizer
{
    public function normalizePageHtml(string $html): string
    {
        if (trim($html) === '') {
            return $html;
        }

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
            throw new UnexpectedValueException('Unable to parse book page HTML for normalization.');
        }

        $body = $dom->getElementsByTagName('body')->item(0);
        if ($body === null) {
            throw new UnexpectedValueException('Parsed book page HTML has no body element.');
        }

        $changed = false;
        foreach (iterator_to_array($body->childNodes) as $node) {
            $changed = $this->addSemanticMetadata($node) || $changed;
        }

        if (! $changed) {
            return $html;
        }

        $normalized = '';
        foreach (iterator_to_array($body->childNodes) as $node) {
            $serializedNode = $dom->saveHTML($node);
            if ($serializedNode === false) {
                throw new UnexpectedValueException('Unable to serialize normalized book page HTML.');
            }

            $normalized .= $serializedNode;
        }

        return $normalized;
    }

    private function addSemanticMetadata(DOMNode $node): bool
    {
        if (! $node instanceof DOMElement) {
            return false;
        }

        $changed = false;
        if ($this->hasClass($node, 'page')) {
            $changed = $this->addClass($node, 'book-page') || $changed;
            $pageNumber = $node->getAttribute('data-page');
            if ($pageNumber === '') {
                $pageNumber = $node->getAttribute('id');
            }
            if ($pageNumber !== '' && $node->getAttribute('data-page') !== $pageNumber) {
                $node->setAttribute('data-page', $pageNumber);
                $changed = true;
            }
        }

        if ($this->hasClass($node, 'page-title-chapter') || $this->hasClass($node, 'page-title')) {
            $heading = $this->findHeading($node);
            $changed = $this->addClass($heading ?? $node, 'chapter-title') || $changed;
        }

        if ($this->hasClass($node, 'page-footnote')) {
            $changed = $this->addClass($node, 'footnote') || $changed;
        }

        if ($this->hasClass($node, 'footnote-p')) {
            $changed = $this->addClass($node, 'footnote-content') || $changed;
        }

        if ($this->hasAnyClass($node, ['text-arabic', 'text-arabic-inline', 'text-arabic-bismillah'])) {
            $changed = $this->addClass($node, 'arabic') || $changed;
            if (! $node->hasAttribute('lang')) {
                $node->setAttribute('lang', 'ar');
                $changed = true;
            }
            if (! $node->hasAttribute('dir')) {
                $node->setAttribute('dir', 'rtl');
                $changed = true;
            }
        }

        foreach (iterator_to_array($node->childNodes) as $child) {
            $changed = $this->addSemanticMetadata($child) || $changed;
        }

        return $changed;
    }

    private function findHeading(DOMElement $node): ?DOMElement
    {
        foreach (iterator_to_array($node->childNodes) as $child) {
            if (! $child instanceof DOMElement) {
                continue;
            }

            if (in_array(strtolower($child->tagName), ['h1', 'h2', 'h3'], true)) {
                return $child;
            }

            $heading = $this->findHeading($child);
            if ($heading !== null) {
                return $heading;
            }
        }

        return null;
    }

    private function addClass(DOMElement $node, string $class): bool
    {
        $classes = preg_split('/\s+/', trim($node->getAttribute('class')) ?: '');
        $classes = is_array($classes) ? array_filter($classes, 'strlen') : [];

        if (! in_array($class, $classes, true)) {
            $classes[] = $class;
            $node->setAttribute('class', implode(' ', $classes));

            return true;
        }

        return false;
    }

    private function hasClass(DOMElement $node, string $class): bool
    {
        return $this->hasAnyClass($node, [$class]);
    }

    private function hasAnyClass(DOMElement $node, array $classes): bool
    {
        $nodeClasses = preg_split('/\s+/', trim($node->getAttribute('class')) ?: '');

        return is_array($nodeClasses) && array_intersect($classes, $nodeClasses) !== [];
    }
}

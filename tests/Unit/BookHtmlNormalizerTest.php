<?php

namespace Tests\Unit;

use App\Services\BookHtmlNormalizer;
use PHPUnit\Framework\TestCase;

class BookHtmlNormalizerTest extends TestCase
{
    public function test_it_returns_already_semantic_markup_unchanged(): void
    {
        $html = '<div class="page book-page" id="17" data-page="17"><p>Content</p></div>';

        $this->assertSame($html, (new BookHtmlNormalizer)->normalizePageHtml($html));
    }

    public function test_it_adds_semantics_without_changing_legacy_reader_or_style_markup(): void
    {
        $html = <<<'HTML'
<div class="page" id="17">
    <p class="text-end page-number">17</p>
    <div class="page-title-chapter"><h2>Het tiende woord</h2></div>
    <p class="text-arabic" style="margin: 0 auto; max-width: 500px">بِسْمِ اللَّهِ</p>
    <p>Voorbeeldtekst met voetnoot<sup>1</sup>.</p>
    <div class="page-footnote">
        <p class="footnote-p"><sup>1</sup> De voetnootinhoud.</p>
    </div>
</div>
HTML;

        $normalized = (new BookHtmlNormalizer)->normalizePageHtml($html);

        $this->assertStringNotContainsString('<article class="book-content"', $normalized);
        $this->assertMatchesRegularExpression('/<div[^>]*class="[^"]*page[^"]*book-page[^"]*"[^>]*id="17"/', $normalized);
        $this->assertStringContainsString('class="text-end page-number"', $normalized);
        $this->assertStringContainsString('data-page="17"', $normalized);
        $this->assertMatchesRegularExpression('/<div class="page-title-chapter"><h2 class="chapter-title">/', $normalized);
        $this->assertStringContainsString('lang="ar"', $normalized);
        $this->assertStringContainsString('dir="rtl"', $normalized);
        $this->assertStringContainsString('style="margin: 0 auto; max-width: 500px"', $normalized);
        $this->assertStringContainsString('بِسْمِ اللَّهِ', $normalized);
        $this->assertMatchesRegularExpression('/<div class="page-footnote footnote">/', $normalized);
        $this->assertStringContainsString('class="footnote-p footnote-content"', $normalized);
    }
}

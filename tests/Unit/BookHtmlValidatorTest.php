<?php

namespace Tests\Unit;

use App\Services\BookHtmlNormalizer;
use App\Services\BookHtmlValidator;
use PHPUnit\Framework\TestCase;

class BookHtmlValidatorTest extends TestCase
{
    public function test_it_accepts_representative_seed_markup_without_rewriting_or_style_warnings(): void
    {
        $html = <<<'HTML'
<div class="page" id="5">
<p class="text-end page-number">#5</p>
<p class="text-center text-arabic-bismillah" dir="rtl" lang="ar">
<img src="/images/bismillah .svg" alt="Bismillah" class="bismillah-svg bismillah-svg-light">
<img src="/images/bismillah-dark.svg" alt="Bismillah" class="bismillah-svg bismillah-svg-dark">
<sup>1</sup>
</p>
<p class="text-center text-arabic delima-font" dir="rtl" lang="ar" style="margin: 0 auto; max-width: 500px;">
وَبِهٖ نَسْتَعٖينُ<sup>2</sup>
</p>
<div class="page-footnote">
<p class="footnote-p"><sup>1</sup> “In de Naam van ALLAH.”</p>
<p class="footnote-p"><sup>2</sup> De lof zij ALLAH.</p>
</div>
</div>
HTML;

        $validator = new BookHtmlValidator;
        $normalizer = new BookHtmlNormalizer;
        $findings = $validator->validatePageHtml($html, 5);
        $normalized = $normalizer->normalizePageHtml($html);

        $this->assertSame([], $findings);
        $this->assertStringContainsString('class="page book-page"', $normalized);
        $this->assertStringContainsString('style="margin: 0 auto; max-width: 500px;"', $normalized);
        $this->assertMatchesRegularExpression('/class="[^"]*text-arabic[^"]*delima-font[^"]*arabic[^"]*"/', $normalized);
        $this->assertStringContainsString('class="page-footnote footnote"', $normalized);
        $this->assertStringContainsString('class="footnote-p footnote-content"', $normalized);
    }

    public function test_it_reports_page_number_and_rtl_issues_without_repairing_them(): void
    {
        $html = <<<'HTML'
<div class="page" id="8">
<p class="page-number">#9</p>
<p class="text-arabic">عَرَبِيّ</p>
<p><sup>4</sup> Reference without a note on this page.</p>
</div>
HTML;

        $findings = (new BookHtmlValidator)->validatePageHtml($html, 7);
        $codes = array_column($findings, 'code');

        $this->assertContains('page-id-mismatch', $codes);
        $this->assertContains('printed-page-number-mismatch', $codes);
        $this->assertContains('arabic-lang-missing', $codes);
        $this->assertContains('arabic-direction-missing', $codes);
        $this->assertContains('footnote-not-defined-on-page', $codes);
    }

    public function test_it_reports_footnote_content_embedded_in_a_reference_button(): void
    {
        $html = <<<'HTML'
<div class="page" id="7">
<p>Reference <button class="fn-ref" data-fn="1" data-html="The footnote text"><sup>1</sup></button></p>
<div class="page-footnote"><p class="footnote-p"><sup>1</sup> The footnote text.</p></div>
</div>
HTML;

        $findings = (new BookHtmlValidator)->validatePageHtml($html, 7);

        $this->assertContains('footnote-content-in-reference', array_column($findings, 'code'));
    }

    public function test_it_accepts_declared_persian_and_inherited_rtl_metadata_and_ignores_non_numeric_superscripts(): void
    {
        $html = <<<'HTML'
<div class="page" id="7">
<p class="text-arabic" lang="fa" dir="rtl">فارسی</p>
<p lang="ar" dir="rtl"><span class="text-arabic-inline">عَرَبِيّ</span></p>
<p class="text-arabic-inline">عَرَبِيّ</p>
<p class="text-arabic">۞</p>
<p><sup>الخ</sup> Supplementary Arabic marker.</p>
</div>
HTML;

        $findings = (new BookHtmlValidator)->validatePageHtml($html, 7);
        $codes = array_column($findings, 'code');

        $this->assertSame(1, count(array_filter($findings, fn (array $finding) => $finding['code'] === 'arabic-lang-missing')));
        $this->assertSame(1, count(array_filter($findings, fn (array $finding) => $finding['code'] === 'arabic-direction-missing')));
        $this->assertNotContains('footnote-not-defined-on-page', $codes);
    }
}

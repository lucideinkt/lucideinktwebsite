<?php

namespace Tests\Unit;

use App\Services\BookPageJsonSerializer;
use PHPUnit\Framework\TestCase;

class BookPageJsonSerializerTest extends TestCase
{
    public function test_it_serializes_book_blocks_and_footnotes_as_native_friendly_nodes(): void
    {
        $html = <<<'HTML'
<div class="page" id="17">
    <p class="text-end page-number">#17</p>
    <div class="text-center page-title-chapter delima-font"><h2>Het hoofdstuk</h2></div>
    <p class="text-red text-bold">Tekst <span class="text-bold">vet via class</span>, <strong>belangrijk</strong>, <em>cursief</em> en <sup>1</sup>.</p>
    <p class="text-arabic" lang="ar" dir="rtl">عَرَبِيّ<sup>2</sup></p>
    <p><img src="/images/example.png" alt="Voorbeeld"></p>
    <div class="page-footnote">
        <hr class="hr-footnote">
        <p class="footnote-p"><sup>1</sup> Eerste noot met <em>opmaak</em>.</p>
        <p class="footnote-p"><sup>2</sup> Tweede noot →</p>
        <p class="footnote-p">vervolg van de tweede noot</p>
    </div>
</div>
HTML;

        $page = (new BookPageJsonSerializer)->serialize(17, $html);

        $this->assertSame(17, $page['page_number']);
        $this->assertCount(4, $page['blocks']);
        $this->assertSame('container', $page['blocks'][0]['type']);
        $this->assertSame('chapter_title', $page['blocks'][0]['presentation']['role']);
        $this->assertSame('heading', $page['blocks'][0]['children'][0]['type']);
        $this->assertSame('book_display', $page['blocks'][0]['presentation']['typeface']);
        $this->assertSame('paragraph', $page['blocks'][1]['type']);
        $this->assertSame('semibold', $page['blocks'][1]['presentation']['font_weight']);
        $this->assertSame('span', $page['blocks'][1]['children'][1]['type']);
        $this->assertSame('semibold', $page['blocks'][1]['children'][1]['presentation']['font_weight']);
        $this->assertSame('strong', $page['blocks'][1]['children'][3]['type']);
        $this->assertSame('emphasis', $page['blocks'][1]['children'][5]['type']);
        $this->assertSame([
            'type' => 'footnote_ref',
            'number' => 1,
            'target' => '17:1',
        ], $page['blocks'][1]['children'][7]);
        $this->assertSame('accent', $page['blocks'][1]['presentation']['tone']);
        $this->assertSame('ar', $page['blocks'][2]['language']);
        $this->assertSame('rtl', $page['blocks'][2]['direction']);
        $this->assertSame('image', $page['blocks'][3]['children'][0]['type']);
        $this->assertCount(2, $page['footnotes']);
        $this->assertSame('17:1', $page['footnotes'][0]['target']);
        $this->assertSame('17:2', $page['footnotes'][1]['target']);
        $this->assertTrue($page['footnotes'][1]['continues_to_next_page']);
        $this->assertCount(2, $page['footnotes'][1]['blocks']);
        $this->assertStringNotContainsString('data-html', json_encode($page, JSON_THROW_ON_ERROR));
    }

    public function test_it_marks_unlabelled_leading_footnote_content_as_a_continuation(): void
    {
        $html = <<<'HTML'
<div class="page" id="18">
    <div class="page-footnote">
        <p class="footnote-p">vervolg van een noot op de vorige pagina</p>
    </div>
</div>
HTML;

        $page = (new BookPageJsonSerializer)->serialize(18, $html);

        $this->assertSame([
            'number' => null,
            'target' => null,
            'blocks' => [[
                'type' => 'paragraph',
                'children' => [[
                    'type' => 'text',
                    'text' => 'vervolg van een noot op de vorige pagina',
                ]],
            ]],
            'continues_from_previous_page' => true,
            'continues_to_next_page' => false,
        ], $page['footnotes'][0]);
    }

    public function test_it_preserves_table_and_subscript_structure_for_native_rendering(): void
    {
        $html = <<<'HTML'
<div class="page" id="19">
    <table>
        <tbody>
            <tr>
                <td>De Almachtige</td>
                <td>El-Qadîr</td>
                <td><span lang="ar" dir="rtl">اَلْقَدٖيرُ<sub>نِ</sub></span></td>
            </tr>
        </tbody>
    </table>
</div>
HTML;

        $page = (new BookPageJsonSerializer)->serialize(19, $html);
        $table = $page['blocks'][0];
        $row = $table['children'][0]['children'][0];
        $cells = $row['children'];
        $arabic = $cells[2]['children'][0];
        $subscript = $arabic['children'][1];

        $this->assertSame('element', $table['type']);
        $this->assertSame('table', $table['tag']);
        $this->assertSame('tr', $row['tag']);
        $this->assertCount(3, $cells);
        $this->assertSame('td', $cells[2]['tag']);
        $this->assertSame('ar', $arabic['language']);
        $this->assertSame('rtl', $arabic['direction']);
        $this->assertSame('element', $subscript['type']);
        $this->assertSame('sub', $subscript['tag']);
    }
}

<?php

declare(strict_types=1);

namespace Database\Seeders;

/**
 * Cevşen-ül Kebir — fully offline 100-page book seeder.
 *
 * The Arabic text is included literally in this PHP file. No HTTP requests,
 * external JSON, database lookups for text, font files, or dependencies other
 * than your existing BookPagesSeeder are needed to construct the book pages.
 *
 * Text source: https://readnur.com/kitap/cevsen/
 * Verify the text carefully and obtain permission to republish if necessary.
 * The source website's duplicated presentation text has been included ONCE.
 */
class CevsenPagesSeeder extends BookPagesSeeder
{
    protected function productSlug(): string
    {
        // Adjust only if your product has a different slug in DatabaseSeeder.
        return 'cevsen-ul-kebir';
    }

    protected function bookTitle(): string
    {
        return 'Cevşen-ül Kebir';
    }

    protected function pages(): array
    {
        return [
            [
                'page_number' => 1,
                'content' => <<<'CEVSEN_PAGE_001'
<div class="page" id="1">
<p class="text-end page-number">#1</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">جوشن الكبير</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">﴿ بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحٖيمِ ﴾</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ اِنّٖٓى اَسْئَلُكَ بِاَسْمَٓائِكَ يَا اَللّٰهُ <span class="cevsen-separator">۞</span> يَا رَحْمٰنُ <span class="cevsen-separator">۞</span> يَا رَحٖيمُ <span class="cevsen-separator">۞</span> يَا عَلٖيمُ <span class="cevsen-separator">۞</span> يَا حَلٖيمُ <span class="cevsen-separator">۞</span> يَا عَظٖيمُ <span class="cevsen-separator">۞</span> يَا حَكٖيمُ <span class="cevsen-separator">۞</span> يَا قَدٖيمُ <span class="cevsen-separator">۞</span> يَا مُقٖيمُ <span class="cevsen-separator">۞</span> يَا كَرٖيمُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝١</span></p>

</div>
CEVSEN_PAGE_001,
            ],
            [
                'page_number' => 2,
                'content' => <<<'CEVSEN_PAGE_002'
<div class="page" id="2">
<p class="text-end page-number">#2</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا سَيِّدَ السَّادَاتِ <span class="cevsen-separator">۞</span> يَا مُجٖيبَ الدَّعَوَاتِ <span class="cevsen-separator">۞</span> يَا وَلِىَّ الْحَسَنَاتِ <span class="cevsen-separator">۞</span> يَا رَفٖيعَ الدَّرَجَاتِ <span class="cevsen-separator">۞</span> يَا عَظٖيمَ الْبَرَكَاتِ <span class="cevsen-separator">۞</span> يَا غَافِرَ الْخَطٖٓيئَاتِ <span class="cevsen-separator">۞</span> يَا دَافِعَ الْبَلِيَّاتِ <span class="cevsen-separator">۞</span> يَا سَامِعَ الْاَصْوَاتِ <span class="cevsen-separator">۞</span> يَا مُعْطِىَ الْمَسْؤُلَاتِ <span class="cevsen-separator">۞</span> يَا عَالِمَ السِّرِّ وَ الْخَفِيَّاتِ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٢</span></p>

</div>
CEVSEN_PAGE_002,
            ],
            [
                'page_number' => 3,
                'content' => <<<'CEVSEN_PAGE_003'
<div class="page" id="3">
<p class="text-end page-number">#3</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا خَيْرَ الْغَافِرٖينَ <span class="cevsen-separator">۞</span> يَا خَيْرَ النَّاصِرٖينَ <span class="cevsen-separator">۞</span> يَا خَيْرَ الْحَاكِمٖينَ <span class="cevsen-separator">۞</span> يَا خَيْرَ الْفَاتِحٖينَ <span class="cevsen-separator">۞</span> يَا خَيْرَ الذَّاكِرٖينَ <span class="cevsen-separator">۞</span> يَا خَيْرَ الْوَارِثٖينَ <span class="cevsen-separator">۞</span> يَا خَيْرَ الْحَامِدٖينَ <span class="cevsen-separator">۞</span> يَا خَيْرَ الرَّازِقٖينَ <span class="cevsen-separator">۞</span> يَا خَيْرَ الْفَاصِلٖينَ <span class="cevsen-separator">۞</span> يَا خَيْرَ الْمُحْسِنٖينَ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٣</span></p>

</div>
CEVSEN_PAGE_003,
            ],
            [
                'page_number' => 4,
                'content' => <<<'CEVSEN_PAGE_004'
<div class="page" id="4">
<p class="text-end page-number">#4</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ لَهُ الْعِزُّ وَ الْجَمَالُ <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ الْمُلْكُ وَ الْجَلَالُ <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ الْقُدْرَةُ وَ الْكَمَالُ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ الْكَبٖيرُ الْمُتَعَالِ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ شَدٖيدُ الْمِحَالِ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ شَدٖيدُ الْعِقَابِ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ سَرٖيعُ الْحِسَابِ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ عِنْدَهُ حُسْنُ الثَّوَابِ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ عِنْدَهُٓ اُمُّ الْكِتَابِ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ يُنْشِىُٔ السَّحَابَ الثِّقَالَ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٤</span></p>

</div>
CEVSEN_PAGE_004,
            ],
            [
                'page_number' => 5,
                'content' => <<<'CEVSEN_PAGE_005'
<div class="page" id="5">
<p class="text-end page-number">#5</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">وَ اَسْئَلُكَ بِاَسْمَٓائِكَ يَا حَنَّانُ <span class="cevsen-separator">۞</span> يَا مَنَّانُ <span class="cevsen-separator">۞</span> يَا دَيَّانُ <span class="cevsen-separator">۞</span> يَا غُفْرَانُ <span class="cevsen-separator">۞</span> يَا بُرْهَانُ <span class="cevsen-separator">۞</span> يَا سُلْطَانُ <span class="cevsen-separator">۞</span> يَا سُبْحَانُ <span class="cevsen-separator">۞</span> يَا مُسْتَعَانُ <span class="cevsen-separator">۞</span> يَا ذَا الْمَنِّ وَ الْبَيَانِ <span class="cevsen-separator">۞</span> يَا ذَا الْاَمَانِ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٥</span></p>

</div>
CEVSEN_PAGE_005,
            ],
            [
                'page_number' => 6,
                'content' => <<<'CEVSEN_PAGE_006'
<div class="page" id="6">
<p class="text-end page-number">#6</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ تَوَاضَعَ كُلُّ شَىْءٍ لِعَظَمَتِهٖ <span class="cevsen-separator">۞</span> يَا مَنِ اسْتَسْلَمَ كُلُّ شَىْءٍ لِقُدْرَتِهٖ <span class="cevsen-separator">۞</span> يَا مَنْ ذَلَّ كُلُّ شَىْءٍ لِعِزَّتِهٖ <span class="cevsen-separator">۞</span> يَا مَنْ خَضَعَ كُلُّ شَىْءٍ لِهَيْبَتِهٖ <span class="cevsen-separator">۞</span> يَا مَنِ انْقَادَ كُلُّ شَىْءٍ لِمُلْكَتِهٖ <span class="cevsen-separator">۞</span> يَا مَنْ دَانَ كُلُّ شَىْءٍ مِنْ مَخَافَتِهٖ <span class="cevsen-separator">۞</span> يَا مَنِ انْشَقَّتِ الْجِبَالُ مِنْ خَشْيَتِهٖ <span class="cevsen-separator">۞</span> يَا مَنْ قَامَتِ السَّمٰوَاتُ بِاَمْرِهٖ <span class="cevsen-separator">۞</span> يَا مَنِ اسْتَقَرَّتِ الْاَرْضُ بِاِذْنِهٖ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يَعْتَدٖى عَلىٰٓ اَهْلِ مَمْلَكَتِهٖ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٦</span></p>

</div>
CEVSEN_PAGE_006,
            ],
            [
                'page_number' => 7,
                'content' => <<<'CEVSEN_PAGE_007'
<div class="page" id="7">
<p class="text-end page-number">#7</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا غَافِرَ الْخَطَايَا <span class="cevsen-separator">۞</span> يَا كَاشِفَ الْبَلَايَا <span class="cevsen-separator">۞</span> يَا مُنْتَهَى الرَّجَايَا <span class="cevsen-separator">۞</span> يَا مُجْزِلَ الْعَطَايَا <span class="cevsen-separator">۞</span> يَا وَاسِعَ الْهَدَايَا <span class="cevsen-separator">۞</span> يَا رَازِقَ الْبَرَايَا <span class="cevsen-separator">۞</span> يَا قَاضِىَ الْمُنَايَا <span class="cevsen-separator">۞</span> يَا سَامِعَ الشَّكَايَا <span class="cevsen-separator">۞</span> يَا بَاعِثَ السَّرَايَا <span class="cevsen-separator">۞</span> يَا مُطْلِقَ الْاُسَارٰى <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٧</span></p>

</div>
CEVSEN_PAGE_007,
            ],
            [
                'page_number' => 8,
                'content' => <<<'CEVSEN_PAGE_008'
<div class="page" id="8">
<p class="text-end page-number">#8</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا ذَا الْحَمْدِ وَ الثَّنَٓاءِ <span class="cevsen-separator">۞</span> يَا ذَا الْمَجْدِ وَ السَّنَٓاءِ <span class="cevsen-separator">۞</span> يَا ذَا الْفَخْرِ وَ الْبَهَٓاءِ <span class="cevsen-separator">۞</span> يَا ذَا الْعَهْدِ وَ الْوَفَٓاءِ <span class="cevsen-separator">۞</span> يَا ذَا الْعَفْوِ وَ الرِّضَٓاءِ <span class="cevsen-separator">۞</span> يَا ذَا الْمَنِّ وَ الْعَطَٓاءِ <span class="cevsen-separator">۞</span> يَا ذَا الْفَصْلِ وَ الْقَضَٓاءِ <span class="cevsen-separator">۞</span> يَا ذَا الْعِزَّةِ وَ الْبَقَٓاءِ <span class="cevsen-separator">۞</span> يَا ذَا الْجُودِ وَ النَّعْمَٓاءِ <span class="cevsen-separator">۞</span> يَا ذَا الْفَضْلِ وَ الْاٰلَٓاءِ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٨</span></p>

</div>
CEVSEN_PAGE_008,
            ],
            [
                'page_number' => 9,
                'content' => <<<'CEVSEN_PAGE_009'
<div class="page" id="9">
<p class="text-end page-number">#9</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">وَ اَسْئَلُكَ بِاَسْمَٓائِكَ يَا مَانِعُ <span class="cevsen-separator">۞</span> يَا دَافِعُ <span class="cevsen-separator">۞</span> يَا نَافِعُ <span class="cevsen-separator">۞</span> يَا سَامِعُ<span class="cevsen-separator">۞</span> يَا رَافِعُ <span class="cevsen-separator">۞</span> يَا صَانِعُ <span class="cevsen-separator">۞</span> يَا شَافِعُ <span class="cevsen-separator">۞</span> يَا جَامِعُ <span class="cevsen-separator">۞</span> يَا وَاسِعُ <span class="cevsen-separator">۞</span> يَا مُوسِعُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٩</span></p>

</div>
CEVSEN_PAGE_009,
            ],
            [
                'page_number' => 10,
                'content' => <<<'CEVSEN_PAGE_010'
<div class="page" id="10">
<p class="text-end page-number">#10</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا صَانِعَ كُلِّ مَصْنُوعٍ <span class="cevsen-separator">۞</span> يَا خَالِقَ كُلِّ مَخْلُوقٍ <span class="cevsen-separator">۞</span> يَا رَازِقَ كُلِّ مَرْزُوقٍ <span class="cevsen-separator">۞</span> يَا مَالِكَ كُلِّ مَمْلُوكٍ <span class="cevsen-separator">۞</span> يَا كَاشِفَ كُلِّ مَكْرُوبٍ <span class="cevsen-separator">۞</span> يَا فَارِجَ كُلِّ مَغْمُومٍ <span class="cevsen-separator">۞</span> يَا رَاحِمَ كُلِّ مَرْحُومٍ <span class="cevsen-separator">۞</span> يَا نَاصِرَ كُلِّ مَخْذُولٍ <span class="cevsen-separator">۞</span> يَا سَاتِرَ كُلِّ مَعْيُوبٍ <span class="cevsen-separator">۞</span> يَا مَلْجَأَ كُلِّ مَظْلوُمٍ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝١٠</span></p>

</div>
CEVSEN_PAGE_010,
            ],
            [
                'page_number' => 11,
                'content' => <<<'CEVSEN_PAGE_011'
<div class="page" id="11">
<p class="text-end page-number">#11</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا عِدَّتٖى عِنْدَ شِدَّتٖى <span class="cevsen-separator">۞</span> يَا رَجَٓائٖى عِنْدَ مُصٖيبَتٖى <span class="cevsen-separator">۞</span> يَا مُونِسٖى عِنْدَ وَحْشَتٖى <span class="cevsen-separator">۞</span> يَا صَاحِبٖى عِنْدَ غُرْبَتٖى <span class="cevsen-separator">۞</span> يَا وَلِيّٖى عِنْدَ نِعْمَتٖى <span class="cevsen-separator">۞</span> يَا كَاشِفٖى عِنْدَ كُرْبَتٖى <span class="cevsen-separator">۞</span> يَا غِيَاثٖى عِنْدَ افْتِقَارٖى <span class="cevsen-separator">۞</span> يَا مَلْجَئٖى عِنْدَ اضْطِرَارٖى <span class="cevsen-separator">۞</span> يَا مُعٖينٖى عِنْدَ فَزَعٖى <span class="cevsen-separator">۞</span> يَا دَلٖيلٖى عِنْدَ حَيْرَتٖى <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝١١</span></p>

</div>
CEVSEN_PAGE_011,
            ],
            [
                'page_number' => 12,
                'content' => <<<'CEVSEN_PAGE_012'
<div class="page" id="12">
<p class="text-end page-number">#12</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا عَلَّامَ الْغُيُوبِ <span class="cevsen-separator">۞</span> يَا غَفَّارَ الذُّنُوبِ <span class="cevsen-separator">۞</span> يَا سَتَّارَ الْعُيُوبِ <span class="cevsen-separator">۞</span> يَا كَشَّافَ الْكُرُوبِ <span class="cevsen-separator">۞</span> يَا مُقَلِّبَ الْقُلُوبِ <span class="cevsen-separator">۞</span> يَا مُزَيِّنَ الْقُلُوبِ <span class="cevsen-separator">۞</span> يَا مُنَوِّرَ الْقُلُوبِ <span class="cevsen-separator">۞</span> يَا طَبٖيبَ الْقُلُوبِ<span class="cevsen-separator">۞</span> يَا حَبٖيبَ الْقُلُوبِ <span class="cevsen-separator">۞</span> يَٓا اَنٖيسَ الْقُلُوبِ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝١٢</span></p>

</div>
CEVSEN_PAGE_012,
            ],
            [
                'page_number' => 13,
                'content' => <<<'CEVSEN_PAGE_013'
<div class="page" id="13">
<p class="text-end page-number">#13</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">وَ اَسْئَلُكَ بِاَسْمَٓائِكَ يَا جَلٖيلُ <span class="cevsen-separator">۞</span> يَا جَمٖيلُ <span class="cevsen-separator">۞</span> يَا وَكٖيلُ <span class="cevsen-separator">۞</span> يَا كَفٖيلُ <span class="cevsen-separator">۞</span> يَا دَلٖيلُ <span class="cevsen-separator">۞</span> يَا مُقٖيلُ <span class="cevsen-separator">۞</span> يَا خَبٖيرُ <span class="cevsen-separator">۞</span> يَا لَطٖيفُ <span class="cevsen-separator">۞</span> يَا عَزٖيزُ <span class="cevsen-separator">۞</span> يَا مَلٖيكُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝١٣</span></p>

</div>
CEVSEN_PAGE_013,
            ],
            [
                'page_number' => 14,
                'content' => <<<'CEVSEN_PAGE_014'
<div class="page" id="14">
<p class="text-end page-number">#14</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا دَلٖيلَ الْمُتَحَيِّرٖينَ <span class="cevsen-separator">۞</span> يَا غِيَاثَ الْمُسْتَغٖيثٖينَ <span class="cevsen-separator">۞</span> يَا صَرٖيخَ الْمُسْتَصْرِخٖينَ <span class="cevsen-separator">۞</span> يَا جَارَ الْمُسْتَجٖيرٖينَ <span class="cevsen-separator">۞</span> يَا مَلْجَأَ الْعَاصٖينَ <span class="cevsen-separator">۞</span> يَا غَافِرَ الْمُذْنِبٖينَ <span class="cevsen-separator">۞</span> يَٓا اَمَانَ الْخَٓائِفٖينَ <span class="cevsen-separator">۞</span> يَا رَاحِمَ الْمَسَاكٖينَ <span class="cevsen-separator">۞</span> يَٓا اَنٖيسَ الْمُسْتَوْحِشٖينَ <span class="cevsen-separator">۞</span> يَا مُجٖيبَ دَعْوَةِ الْمُضْطَرّٖينَ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝١٤</span></p>

</div>
CEVSEN_PAGE_014,
            ],
            [
                'page_number' => 15,
                'content' => <<<'CEVSEN_PAGE_015'
<div class="page" id="15">
<p class="text-end page-number">#15</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا ذَا الْجُودِ وَ الْاِحْسَانِ <span class="cevsen-separator">۞</span> يَا ذَا الْفَضْلِ وَ الْاِمْتِنَانِ <span class="cevsen-separator">۞</span> يَا ذَا الْاَمْنِ وَ الْاَمَانِ <span class="cevsen-separator">۞</span> يَا ذَا الْقُدْسِ وَ السُّبْحَانِ <span class="cevsen-separator">۞</span> يَا ذَا الْحِكْمَةِ وَ الْبَيَانِ <span class="cevsen-separator">۞</span> يَا ذَا الرَّحْمَةِ وَ الرِّضْوَانِ <span class="cevsen-separator">۞</span> يَا ذَا الْحُجَّةِ وَ الْبُرْهَانِ <span class="cevsen-separator">۞</span> يَا ذَا الْعَظَمَةِ وَ السُّلْطَانِ <span class="cevsen-separator">۞</span> يَا ذَا الْعَفْوِ وَ الْغُفْرَانِ <span class="cevsen-separator">۞</span> يَا ذَا الرَّأْفَةِ وَ الْمُسْتَعَانِ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝١٥</span></p>

</div>
CEVSEN_PAGE_015,
            ],
            [
                'page_number' => 16,
                'content' => <<<'CEVSEN_PAGE_016'
<div class="page" id="16">
<p class="text-end page-number">#16</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ هُوَ رَبُّ كُلِّ شَىْءٍ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ اِلٰهُ كُلِّ شَىْءٍ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ خَالِقُ كُلِّ شَىْءٍ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فَوْقَ كُلِّ شَىْءٍ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ قَبْلَ كُلِّ شَىْءٍ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ بَعْدَ كُلِّ شَىْءٍ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ عَالِمُ كُلِّ شَىْءٍ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ قَادِرُ كُلِّ شَىْءٍ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ صَانِعُ كُلِّ شَىْءٍ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ يَبْقٰى وَ يَفْنٰى كُلُّ شَىْءٍ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝١٦</span></p>

</div>
CEVSEN_PAGE_016,
            ],
            [
                'page_number' => 17,
                'content' => <<<'CEVSEN_PAGE_017'
<div class="page" id="17">
<p class="text-end page-number">#17</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">وَ اَسْئَلُكَ بِاَسْمَٓائِكَ يَا مُؤْمِنُ <span class="cevsen-separator">۞</span> يَا مُهَيْمِنُ <span class="cevsen-separator">۞</span> يَا مُكَوِّنُ <span class="cevsen-separator">۞</span> يَا مُلَقِّنُ <span class="cevsen-separator">۞</span> يَا مُبَيِّنُ <span class="cevsen-separator">۞</span> يَا مُهَوِّنُ <span class="cevsen-separator">۞</span> يَا مُزَيِّنُ <span class="cevsen-separator">۞</span> يَا مُعَظِّمُ <span class="cevsen-separator">۞</span> يَا مُعَوِّنُ <span class="cevsen-separator">۞</span> يَا مُلَوِّنُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝١٧</span></p>

</div>
CEVSEN_PAGE_017,
            ],
            [
                'page_number' => 18,
                'content' => <<<'CEVSEN_PAGE_018'
<div class="page" id="18">
<p class="text-end page-number">#18</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ هُوَ فٖى مُلْكِهٖ مُقٖيمٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فٖى جَلَالِهٖ عَظٖيمٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فٖى سُلْطَانِهٖ قَدٖيمٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ عَلٰى عَبْدِهٖ رَحٖيمٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ بِكُلِّ شَىْءٍ عَلٖيمٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ لِمَنْ جَفَاهُ حَلٖيمٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ لِمَنْ تَرَجَّاهُ كَرٖيمٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فٖى مَقَادٖيرِهٖ حَكٖيمٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فٖى حُكْمِهٖ لَطٖيفٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فٖى لُطْفِهٖ قَدٖيرٌ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝١٨</span></p>

</div>
CEVSEN_PAGE_018,
            ],
            [
                'page_number' => 19,
                'content' => <<<'CEVSEN_PAGE_019'
<div class="page" id="19">
<p class="text-end page-number">#19</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ لَا يُرْجىٰٓ اِلَّا فَضْلُهُ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُخَافُ اِلَّا عَدْلُهُ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُنْتَظَرُ اِلَّا بِرُّهُ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُسْئَلُ اِلَّا عَفْوُهُ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يَدُومُ اِلَّا مُلْكُهُ <span class="cevsen-separator">۞</span> يَا مَنْ لَا سُلْطَانَ اِلَّا سُلْطَانُهُ <span class="cevsen-separator">۞</span> يَا مَنْ لَا بُرْهَانَ اِلَّا بُرْهَانُهُ <span class="cevsen-separator">۞</span> يَا مَنْ وَسِعَتْ كُلَّ شَىْءٍ رَحْمَتُهُ <span class="cevsen-separator">۞</span> يَا مَنْ سَبَقَتْ رَحْمَتُهُ عَلٰى غَضَبِهٖ <span class="cevsen-separator">۞</span> يَا مَنْ اَحَاطَ بِكُلِّ شَىْءٍ عِلْمُهُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝١٩</span></p>

</div>
CEVSEN_PAGE_019,
            ],
            [
                'page_number' => 20,
                'content' => <<<'CEVSEN_PAGE_020'
<div class="page" id="20">
<p class="text-end page-number">#20</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا فَارِجَ الْهَمِّ <span class="cevsen-separator">۞</span> يَا كَاشِفَ الْغَمِّ <span class="cevsen-separator">۞</span> يَا غَافِرَ الذَّنْبِ <span class="cevsen-separator">۞</span> يَا قَابِلَ التَّوْبِ <span class="cevsen-separator">۞</span> يَاخَالِقَ الْخَلْقِ <span class="cevsen-separator">۞</span> يَا صَادِقَ الْوَعْدِ <span class="cevsen-separator">۞</span> يَا رَازِقَ الطِّفْلِ <span class="cevsen-separator">۞</span> يَا مُوفِىَ الْعَهْدِ <span class="cevsen-separator">۞</span> يَا عَالِمَ السِّرِّ <span class="cevsen-separator">۞</span> يَا فَالِقَ الْحَبِّ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٢٠</span></p>

</div>
CEVSEN_PAGE_020,
            ],
            [
                'page_number' => 21,
                'content' => <<<'CEVSEN_PAGE_021'
<div class="page" id="21">
<p class="text-end page-number">#21</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">فَاَسْئَلُكَ بِاَسْمآَئِكَ يَا عَلِىُّ <span class="cevsen-separator">۞</span> يَا وَفِىُّ <span class="cevsen-separator">۞</span> يَا وَلِىُّ <span class="cevsen-separator">۞</span> يَا غَنِىُّ <span class="cevsen-separator">۞</span> يَا مَلِىُّ <span class="cevsen-separator">۞</span> يَا زَكِىُّ <span class="cevsen-separator">۞</span> يَا رَضِىُّ <span class="cevsen-separator">۞</span> يَا بَدِىُّ <span class="cevsen-separator">۞</span> يَا خَفِىُّ <span class="cevsen-separator">۞</span> يَا قَوِىُّ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٢١</span></p>

</div>
CEVSEN_PAGE_021,
            ],
            [
                'page_number' => 22,
                'content' => <<<'CEVSEN_PAGE_022'
<div class="page" id="22">
<p class="text-end page-number">#22</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ اَظْهَرَ الْجَمٖيلَ <span class="cevsen-separator">۞</span> يَا مَنْ سَتَرَ عَلَى الْقَبٖيحِ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُؤَاخِذُ بِالْجَرٖيمَةِ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يَهْتِكُ السِّتْرَ <span class="cevsen-separator">۞</span> يَا عَظٖيمَ الْعَفْوِ <span class="cevsen-separator">۞</span> يَا حَسَنَ التَّجَاوُزِ<span class="cevsen-separator">۞</span> يَا وَاسِعَ الْمَغْفِرَةِ <span class="cevsen-separator">۞</span> يَا بَاسِطَ الْيَدَيْنِ بِالرَّحْمَةِ <span class="cevsen-separator">۞</span> يَا صَاحِبَ كُلِّ نَجْوٰى <span class="cevsen-separator">۞</span> يَا مُنْتَهٰى كُلِّ شَكْوٰى <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٢٢</span></p>

</div>
CEVSEN_PAGE_022,
            ],
            [
                'page_number' => 23,
                'content' => <<<'CEVSEN_PAGE_023'
<div class="page" id="23">
<p class="text-end page-number">#23</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا ذَا النِّعْمَةِ السَّابِغَةِ <span class="cevsen-separator">۞</span> يَا ذَا الرَّحْمَةِ الْوَاسِعَةِ <span class="cevsen-separator">۞</span> يَا ذَا الْحِكْمَةِ الْبَالِغَةِ<span class="cevsen-separator">۞</span> يَا ذَا الْقُدْرَةِ الْكَامِلَةِ <span class="cevsen-separator">۞</span> يَا ذَا الْحُجَّةِ الْقَاطِعَةِ <span class="cevsen-separator">۞</span> يَا ذَا الْكَرَامَةِ الظَّاهِرَةِ <span class="cevsen-separator">۞</span> يَا ذَا الصِّفَةِ الْعَالِيَةِ <span class="cevsen-separator">۞</span> يَا ذَا الْعِزَّةِ الدَّٓائِمَةِ <span class="cevsen-separator">۞</span> يَا ذَا الْقُوَّةِ الْمَتٖينَةِ <span class="cevsen-separator">۞</span> يَا ذَا الْمِنَّةِ السَّابِقَةِ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٢٣</span></p>

</div>
CEVSEN_PAGE_023,
            ],
            [
                'page_number' => 24,
                'content' => <<<'CEVSEN_PAGE_024'
<div class="page" id="24">
<p class="text-end page-number">#24</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَٓا اَحْكَمَ الْحَاكِمٖينَ <span class="cevsen-separator">۞</span> يَٓا اَعْدَلَ الْعَادِلٖينَ <span class="cevsen-separator">۞</span> يَٓا اَصْدَقَ الصَّادِقٖينَ <span class="cevsen-separator">۞</span> يَٓا اَظْهَرَ الظَّاهِرٖينَ <span class="cevsen-separator">۞</span> يَٓا اَطْهَرَ الطَّاهِرٖينَ <span class="cevsen-separator">۞</span> يَٓا اَحْسَنَ الْخَالِقٖينَ <span class="cevsen-separator">۞</span> يَٓا اَسْرَعَ الْحَاسِبٖينَ <span class="cevsen-separator">۞</span> يَٓا اَسْمَعَ السَّامِعٖينَ <span class="cevsen-separator">۞</span> يَٓا اَكْرَمَ الْاَكْرَمٖينَ <span class="cevsen-separator">۞</span> يَٓا اَرْحَمَ الرَّاحِمٖينَ <span class="cevsen-separator">۞</span> يَٓا اَشْفَعَ الشَّافِعٖينَ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٢٤</span></p>

</div>
CEVSEN_PAGE_024,
            ],
            [
                'page_number' => 25,
                'content' => <<<'CEVSEN_PAGE_025'
<div class="page" id="25">
<p class="text-end page-number">#25</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا بَدٖيعَ السَّمٰوَاتِ <span class="cevsen-separator">۞</span> يَا جَاعِلَ الظُّلُمَاتِ <span class="cevsen-separator">۞</span> يَا عَالِمَ الْخَفِيَّاتِ <span class="cevsen-separator">۞</span> يَا رَاحِمَ الْعَبَرَاتِ <span class="cevsen-separator">۞</span> يَا سَاتِرَ الْعَوَرَاتِ <span class="cevsen-separator">۞</span> يَا كَاشِفَ الْبَلِيَّاتِ <span class="cevsen-separator">۞</span> يَا مُحْيِىَ الْاَمْوَاتِ <span class="cevsen-separator">۞</span> يَا ضَاعِفَ الْحَسَنَاتِ <span class="cevsen-separator">۞</span> يَا مُنْزِلَ الْبَرَكَاتِ <span class="cevsen-separator">۞</span> يَا شَدٖيدَ النَّقَمَاتِ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٢٥</span></p>

</div>
CEVSEN_PAGE_025,
            ],
            [
                'page_number' => 26,
                'content' => <<<'CEVSEN_PAGE_026'
<div class="page" id="26">
<p class="text-end page-number">#26</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">وَ اَسْئَلُكَ بِاَسْمَٓائِكَ يَا مُصَوِّرُ <span class="cevsen-separator">۞</span> يَا مُقَدِّرُ <span class="cevsen-separator">۞</span> يَا مُطَهِّرُ <span class="cevsen-separator">۞</span> يَا مُنَوِّرُ <span class="cevsen-separator">۞</span> يَا مُقَدِّمُ <span class="cevsen-separator">۞</span> يَا مُؤَخِّرُ <span class="cevsen-separator">۞</span> يَا مُيَسِّرُ <span class="cevsen-separator">۞</span> يَا مُنْذِرُ <span class="cevsen-separator">۞</span> يَا مُبَشِّرُ <span class="cevsen-separator">۞</span> يَا مُدَبِّرُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٢٦</span></p>

</div>
CEVSEN_PAGE_026,
            ],
            [
                'page_number' => 27,
                'content' => <<<'CEVSEN_PAGE_027'
<div class="page" id="27">
<p class="text-end page-number">#27</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا رَبَّ الْبَيْتِ الْحَرَامِ <span class="cevsen-separator">۞</span> يَا رَبَّ الشَّهْرِ الْحَرَامِ <span class="cevsen-separator">۞</span> يَا رَبَّ الْمَسْجِدِ الْحَرَامِ <span class="cevsen-separator">۞</span> يَا رَبَّ الْبَلَدِ الْحَرَامِ <span class="cevsen-separator">۞</span> يَا رَبَّ الرُّكْنِ وَ الْمَقَامِ <span class="cevsen-separator">۞</span> يَا رَبَّ الْمَشْعَرِ الْحَرَامِ <span class="cevsen-separator">۞</span> يَا رَبَّ الْحِلِّ وَ الْحَرَامِ <span class="cevsen-separator">۞</span> يَا رَبَّ النُّورِ وَ الظَّلَامِ <span class="cevsen-separator">۞</span> يَا رَبَّ التَّحِيَّةِ وَ السَّلَامِ <span class="cevsen-separator">۞</span> يَا رَبَّ الْجَلَالِ وَ الْاِكْرَامِ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٢٧</span></p>

</div>
CEVSEN_PAGE_027,
            ],
            [
                'page_number' => 28,
                'content' => <<<'CEVSEN_PAGE_028'
<div class="page" id="28">
<p class="text-end page-number">#28</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا عِمَادَ مَنْ لَا عِمَادَ لَهُ <span class="cevsen-separator">۞</span> يَا سَنَدَ مَنْ لَا سَنَدَ لَهُ <span class="cevsen-separator">۞</span> يَا زُخْرَ مَنْ لَا زُخْرَ لَهُ <span class="cevsen-separator">۞</span> يَا غِيَاثَ مَنْ لَا غِيَاثَ لَهُ <span class="cevsen-separator">۞</span> يَا حِرْزَ مَنْ لَا حِرْزَ لَهُ <span class="cevsen-separator">۞</span> يَا فَخْرَ مَنْ لَا فَخْرَ لَهُ <span class="cevsen-separator">۞</span> يَا عِزَّ مَنْ لَا عِزَّ لَهُ <span class="cevsen-separator">۞</span> يَا مُعٖينَ مَنْ لَا مُعٖينَ لَهُ <span class="cevsen-separator">۞</span> يَٓا اَنٖيسَ مَنْ لَٓا اَنٖيسَ لَهُ <span class="cevsen-separator">۞</span> يَا غُنْيَةَ مَنْ لَا غُنْيَةَ لَهُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٢٨</span></p>

</div>
CEVSEN_PAGE_028,
            ],
            [
                'page_number' => 29,
                'content' => <<<'CEVSEN_PAGE_029'
<div class="page" id="29">
<p class="text-end page-number">#29</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">وَ اَسْئَلُكَ بِاَسْمَٓائِكَ يَا قَٓائِمُ <span class="cevsen-separator">۞</span> يَا دَٓائِمُ <span class="cevsen-separator">۞</span> يَا رَاحِمُ <span class="cevsen-separator">۞</span> يَا حَاكِمُ <span class="cevsen-separator">۞</span> يَا عَالِمُ <span class="cevsen-separator">۞</span> يَا عَاصِمُ <span class="cevsen-separator">۞</span> يَا قَاسِمُ <span class="cevsen-separator">۞</span> يَا سَالِمُ <span class="cevsen-separator">۞</span> يَا قَابِضُ <span class="cevsen-separator">۞</span> يَا بَاسِطُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٢٩</span></p>

</div>
CEVSEN_PAGE_029,
            ],
            [
                'page_number' => 30,
                'content' => <<<'CEVSEN_PAGE_030'
<div class="page" id="30">
<p class="text-end page-number">#30</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا عَاصِمَ مَنِ اسْتَعْصَمَهُ <span class="cevsen-separator">۞</span> يَا رَاحِمَ مَنِ اسْتَرْحَمَهُ <span class="cevsen-separator">۞</span> يَا نَاصِرَ مَنِ اسْتَنْصَرَهُ <span class="cevsen-separator">۞</span> يَا حَافِظَ مَنِ اسْتَحْفَظَهُ <span class="cevsen-separator">۞</span> يَا مُكْرِمَ مَنِ اسْتَكْرَمَهُ <span class="cevsen-separator">۞</span> يَا مُرْشِدَ مَنِ اسْتَرْشَدَهُ <span class="cevsen-separator">۞</span> يَا مُعٖينَ مَنِ اسْتَعَانَهُ <span class="cevsen-separator">۞</span> يَا مُغٖيثَ مَنِ اسْتَغَاثَهُ <span class="cevsen-separator">۞</span> يَا صَرٖيخَ مَنِ اسْتَصْرَخَهُ <span class="cevsen-separator">۞</span> يَا غَافِرَ مَنِ اسْتَغْفَرَهُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٣٠</span></p>

</div>
CEVSEN_PAGE_030,
            ],
            [
                'page_number' => 31,
                'content' => <<<'CEVSEN_PAGE_031'
<div class="page" id="31">
<p class="text-end page-number">#31</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا كَرٖيمَ الصَّفْحِ <span class="cevsen-separator">۞</span> يَا عَظٖيمَ الْمَنِّ <span class="cevsen-separator">۞</span> يَا كَثٖيرَ الْخَيْرِ <span class="cevsen-separator">۞</span> يَا قَدٖيمَ الْفَضْلِ <span class="cevsen-separator">۞</span> يَا لَطٖيفَ الصُّنْعِ <span class="cevsen-separator">۞</span> يَا دَٓائِمَ اللُّطْفِ <span class="cevsen-separator">۞</span> يَا نَافِسَ الْكَرْبِ <span class="cevsen-separator">۞</span> يَا كَاشِفَ الضُّرِّ <span class="cevsen-separator">۞</span> يَا مَالِكَ الْمُلْكِ <span class="cevsen-separator">۞</span> يَا قَاضِيًا بِالْحَقِّ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٣١</span></p>

</div>
CEVSEN_PAGE_031,
            ],
            [
                'page_number' => 32,
                'content' => <<<'CEVSEN_PAGE_032'
<div class="page" id="32">
<p class="text-end page-number">#32</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا عَزٖيزًا لَا يُضَامُ <span class="cevsen-separator">۞</span> يَا لَطٖيفًا لَا يُرَامُ <span class="cevsen-separator">۞</span> يَا رَقٖيبًا لَا يَنَامُ <span class="cevsen-separator">۞</span> يَا قَٓائِمًا لَا يَفُوتُ <span class="cevsen-separator">۞</span> يَا حَيًّا لَا يَمُوتُ <span class="cevsen-separator">۞</span> يَا مَلِكًا لَا يَزُولُ <span class="cevsen-separator">۞</span> يَا بَاقِيًا لَا يَفْنٰى <span class="cevsen-separator">۞</span> يَا عَالِمًا لَا يَجْهَلُ <span class="cevsen-separator">۞</span> يَا صَمَدًا لَا يُطْعَمُ <span class="cevsen-separator">۞</span> يَا قَوِيًّا لَا يُضْعَفُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٣٢</span></p>

</div>
CEVSEN_PAGE_032,
            ],
            [
                'page_number' => 33,
                'content' => <<<'CEVSEN_PAGE_033'
<div class="page" id="33">
<p class="text-end page-number">#33</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">وَ اَسْئَلُكَ بِاَسْمَٓائِكَ يَا وَاحِدُ <span class="cevsen-separator">۞</span> يَا وَاجِدُ <span class="cevsen-separator">۞</span> يَا شَاهِدُ <span class="cevsen-separator">۞</span> يَا مَاجِدُ <span class="cevsen-separator">۞</span> يَا رَاشِدُ <span class="cevsen-separator">۞</span> يَا بَاعِثُ <span class="cevsen-separator">۞</span> يَا وَارِثُ <span class="cevsen-separator">۞</span> يَا ضَٓارُّ <span class="cevsen-separator">۞</span> يَا نَافِعُ <span class="cevsen-separator">۞</span> يَا هَادٖى <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٣٣</span></p>

</div>
CEVSEN_PAGE_033,
            ],
            [
                'page_number' => 34,
                'content' => <<<'CEVSEN_PAGE_034'
<div class="page" id="34">
<p class="text-end page-number">#34</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَٓا اَعْظَمُ مِنْ كُلِّ عَظٖيمٍ <span class="cevsen-separator">۞</span> يَٓا اَكْرَمُ مِنْ كُلِّ كَرٖيمٍ <span class="cevsen-separator">۞</span> يَٓا اَرْحَمُ مِنْ كُلِّ رَحٖيمٍ <span class="cevsen-separator">۞</span> يَٓا اَحْكَمُ مِنْ كُلِّ حَكٖيمٍ <span class="cevsen-separator">۞</span> يَٓا اَعْلَمُ مِنْ كُلِّ عَلٖيمٍ <span class="cevsen-separator">۞</span> يَٓا اَقْدَمُ مِنْ كُلِّ قَدٖيمٍ <span class="cevsen-separator">۞</span> يَٓا اَكْبَرُ مِنْ كُلِّ كَبٖيرٍ <span class="cevsen-separator">۞</span> يَٓا اَجَلُّ مِنْ كُلِّ جَلٖيلٍ <span class="cevsen-separator">۞</span> يَٓا اَعَزُّ مِنْ كُلِّ عَزٖيزٍ <span class="cevsen-separator">۞</span> يَٓا اَلْطَفُ مِنْ كُلِّ لَطٖيفٍ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٣٤</span></p>

</div>
CEVSEN_PAGE_034,
            ],
            [
                'page_number' => 35,
                'content' => <<<'CEVSEN_PAGE_035'
<div class="page" id="35">
<p class="text-end page-number">#35</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ هُوَ فٖى عَهْدِهٖ وَفِىٌّ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فٖى وَفَٓائِهٖ قَوِىٌّ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فٖى قُوَّتِهٖ عَلِىٌّ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فٖى عُلُوِّهٖ قَرٖيبٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فٖى قُرْبِهٖ لَطٖيفٌ<span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فٖى لُطْفِهٖ شَرٖيفٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فٖى شَرَفِهٖ عَزٖيزٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فٖى عِزَّتِهٖ عَظٖيمٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فٖى عَظَمَتِهٖ مَجٖيدٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فٖى مَجْدِهٖ حَمٖيدٌ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٣٥</span></p>

</div>
CEVSEN_PAGE_035,
            ],
            [
                'page_number' => 36,
                'content' => <<<'CEVSEN_PAGE_036'
<div class="page" id="36">
<p class="text-end page-number">#36</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ هُوَ كُلُّ شَىْءٍ خَاضِعٌ لَهُ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ كُلُّ شَىْءٍ كَٓائِنٌ لَهُ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ كُلُّ شَىْءٍ مَوْجُودٌ لَهُ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ كُلُّ شَىْءٍ مُنٖيبٌ لَهُ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ كُلُّ شَىْءٍ خَٓائِفٌ مِنْهُ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ كُلُّ شَىْءٍ مُسَبِّحٌ لَهُ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ كُلُّ شَىْءٍ قَٓائِمٌ بِهٖ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ كُلُّ شَىْءٍ خَاشِعٌ لَهُ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ كُلُّ شَىْءٍ صَٓائِرٌ اِلَيْهِ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ كُلُّ شَىْءٍ هَالِكٌ اِلَّا وَجْهَهُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٣٦</span></p>

</div>
CEVSEN_PAGE_036,
            ],
            [
                'page_number' => 37,
                'content' => <<<'CEVSEN_PAGE_037'
<div class="page" id="37">
<p class="text-end page-number">#37</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">وَ اَسْئَلُكَ بِاَسْمَٓائِكَ يَا كَافٖى <span class="cevsen-separator">۞</span> يَا شَافٖى <span class="cevsen-separator">۞</span> يَا وَافٖى <span class="cevsen-separator">۞</span> يَا مُعَافٖى <span class="cevsen-separator">۞</span> يَا عَالٖى <span class="cevsen-separator">۞</span> يَا دَاعٖى <span class="cevsen-separator">۞</span> يَا رَاضٖى <span class="cevsen-separator">۞</span> يَا قَاضٖى <span class="cevsen-separator">۞</span> يَا بَاقٖى <span class="cevsen-separator">۞</span> يَا هَادٖى <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٣٧</span></p>

</div>
CEVSEN_PAGE_037,
            ],
            [
                'page_number' => 38,
                'content' => <<<'CEVSEN_PAGE_038'
<div class="page" id="38">
<p class="text-end page-number">#38</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ لَامَفَرَّ اِلَّٓا اِلَيْهِ <span class="cevsen-separator">۞</span> يَا مَنْ لَا مَفْزَعَ اِلَّٓا اِلَيْهِ <span class="cevsen-separator">۞</span> يَا مَنْ لَا مَلْجَأَ اِلَّٓا اِلَيْهِ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُتَوَكَّلُ اِلَّا عَلَيْهِ <span class="cevsen-separator">۞</span> يَا مَنْ لَا مَقْصَدَ اِلَّٓا اِلَيْهِ <span class="cevsen-separator">۞</span> يَا مَنْ لَا مَنْجَأَ اِلَّٓا اِلَيْهِ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُرْغَبُ اِلَّٓا اِلَيْهِ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُعْبَدُ اِلَّٓا اِيَّاهُ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُسْتَعَانُ اِلَّا مِنْهُ <span class="cevsen-separator">۞</span> يَا مَنْ لَا حَوْلَ وَ لَا قُوَّةَ اِلَّا بِهٖ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٣٨</span></p>

</div>
CEVSEN_PAGE_038,
            ],
            [
                'page_number' => 39,
                'content' => <<<'CEVSEN_PAGE_039'
<div class="page" id="39">
<p class="text-end page-number">#39</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا خَيْرَ الْمَرْهُوبٖينَ <span class="cevsen-separator">۞</span> يَا خَيْرَ الْمَطْلُوبٖينَ <span class="cevsen-separator">۞</span> يَا خَيْرَ الْمَرْغُوبٖينَ <span class="cevsen-separator">۞</span> يَا خَيْرَ الْمَسْئُولٖينَ <span class="cevsen-separator">۞</span> يَا خَيْرَ الْمَقْصُودٖينَ <span class="cevsen-separator">۞</span> يَا خَيْرَ الْمَذْكُورٖينَ <span class="cevsen-separator">۞</span> يَا خَيْرَ الْمَشْكُورٖينَ <span class="cevsen-separator">۞</span> يَا خَيْرَ الْمَحْبُوبٖينَ <span class="cevsen-separator">۞</span> يَا خَيْرَ الْمُنْزِلٖينَ <span class="cevsen-separator">۞</span> يَا خَيْرَ الْمُسْتَاْنِسٖينَ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٣٩</span></p>

</div>
CEVSEN_PAGE_039,
            ],
            [
                'page_number' => 40,
                'content' => <<<'CEVSEN_PAGE_040'
<div class="page" id="40">
<p class="text-end page-number">#40</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ هُوَ خَلَقَ فَسَوّٰى <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ قَدَّرَ فَهَدٰى <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ يَكْشِفُ الْبَلْوٰى <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ يَسْمَعُ النَّجْوٰى <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ يُنْقِذُ الْغَرْقٰى <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ يُنْجِى الْهَلْكٰى <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ يَشْفِى الْمَرْضٰى <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ اَمَاتَ وَ اَحْيٰى <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ اَضْحَكَ وَ اَبْكٰى <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ اَضَلَّ وَ اَهْدٰى <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٤٠</span></p>

</div>
CEVSEN_PAGE_040,
            ],
            [
                'page_number' => 41,
                'content' => <<<'CEVSEN_PAGE_041'
<div class="page" id="41">
<p class="text-end page-number">#41</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">وَ اَسْئَلُكَ بِاَسْمَٓائِكَ يَا غَافِرُ <span class="cevsen-separator">۞</span> يَا سَاتِرُ <span class="cevsen-separator">۞</span> يَا قَاهِرُ <span class="cevsen-separator">۞</span> يَا قَادِرُ <span class="cevsen-separator">۞</span> يَا نَاظِرُ <span class="cevsen-separator">۞</span> يَا فَاطِرُ <span class="cevsen-separator">۞</span> يَا شَاكِرُ <span class="cevsen-separator">۞</span> يَا ذَاكِرُ <span class="cevsen-separator">۞</span> يَا نَاصِرُ <span class="cevsen-separator">۞</span> يَا جَابِرُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٤١</span></p>

</div>
CEVSEN_PAGE_041,
            ],
            [
                'page_number' => 42,
                'content' => <<<'CEVSEN_PAGE_042'
<div class="page" id="42">
<p class="text-end page-number">#42</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ هُوَ فِى الْبَرِّ وَ الْبَحْرِ سَبٖيلُهُ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فِى الْاٰفَاقِ اٰيَاتُهُ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فِى الْاٰيَاتِ بُرْهَانُهُ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فِى الْمَمَاتِ قُدْرَتُهُ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فِى الْقُبُورِ عِزَّتُهُ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فِى الْقِيَامَةِ مِلْكَتُهُ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فِى الْحِسَابِ هَيْبَتُهُ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فِى الْمٖيزَانِ قَضَٓائُهُ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فِى الْجَنَّةِ رَحْمَتُهُ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فِى النَّارِ عَذَابُهُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٤٢</span></p>

</div>
CEVSEN_PAGE_042,
            ],
            [
                'page_number' => 43,
                'content' => <<<'CEVSEN_PAGE_043'
<div class="page" id="43">
<p class="text-end page-number">#43</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ هُوَ اِلَيْهِ يَهْرَبُ الْخَٓائِفُونَ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ اِلَيْهِ يَفْزَعُ الْمُذْنِبُونَ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ اِلَيْهِ يَقْصِدُ الْمُنٖيبُونَ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ اِلَيْهِ يَلْجَأُ الْعَاصُونَ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ اِلَيْهِ يَرْغَبُ الزَّاهِدُونَ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فٖيهِ يَطْمَعُ الْخَاطِؤُنَ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ يَسْتَاْنِسُ بِهِ الْمُرٖيدُونَ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ يَفْتَخِرُ بِهِ الْمُحْسِنُونَ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ عَلَيْهِ يَتَوَكَّلُ الْمُتَوَكِّلُونَ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ يَسْكُنُ بِهِ الْمُوقِنُونَ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٤٣</span></p>

</div>
CEVSEN_PAGE_043,
            ],
            [
                'page_number' => 44,
                'content' => <<<'CEVSEN_PAGE_044'
<div class="page" id="44">
<p class="text-end page-number">#44</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَٓا اَقْرَبُ مِنْ كُلِّ قَرٖيبٍ <span class="cevsen-separator">۞</span> يَٓا اَحَبُّ مِنْ كُلِّ حَبٖيبٍ <span class="cevsen-separator">۞</span> يَٓا اَعْظَمُ مِنْ كُلِّ عَظٖيمٍ <span class="cevsen-separator">۞</span> يَٓا اَعَزُّ مِنْ كُلِّ عَزٖيزٍ <span class="cevsen-separator">۞</span> يَٓا اَقْوٰى مِنْ كُلِّ قَوِىٍّ <span class="cevsen-separator">۞</span> يَٓا اَغْنٰى مِنْ كُلِّ غَنِىٍّ <span class="cevsen-separator">۞</span> يَٓا اَجْوَدُ مِنْ كُلِّ جَوَادٍ <span class="cevsen-separator">۞</span> يَٓا اَرْأَفُ مِنْ كُلِّ رَؤُفٍ <span class="cevsen-separator">۞</span> يَٓا اَرْحَمُ مِنْ كُلِّ رَحٖيمٍ <span class="cevsen-separator">۞</span> يَٓا اَجَلُّ مِنْ كُلِّ جَلٖيلٍ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٤٤</span></p>

</div>
CEVSEN_PAGE_044,
            ],
            [
                'page_number' => 45,
                'content' => <<<'CEVSEN_PAGE_045'
<div class="page" id="45">
<p class="text-end page-number">#45</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">وَ اَسْئَلُكَ بِاَسْمَٓائِكَ يَا قَرٖيبُ <span class="cevsen-separator">۞</span> يَا رَقٖيبُ <span class="cevsen-separator">۞</span> يَا حَبٖيبُ <span class="cevsen-separator">۞</span> يَا مُجٖيبُ <span class="cevsen-separator">۞</span> يَا حَسٖيبُ <span class="cevsen-separator">۞</span> يَا طَبٖيبُ <span class="cevsen-separator">۞</span> يَا بَصٖيرُ <span class="cevsen-separator">۞</span> يَا خَبٖيرُ <span class="cevsen-separator">۞</span> يَا مُنٖيرُ <span class="cevsen-separator">۞</span> يَا مُبٖينُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٤٥</span></p>

</div>
CEVSEN_PAGE_045,
            ],
            [
                'page_number' => 46,
                'content' => <<<'CEVSEN_PAGE_046'
<div class="page" id="46">
<p class="text-end page-number">#46</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا غَالِبًا غَيْرَ مَغْلُوبٍ <span class="cevsen-separator">۞</span> يَا صَانِعًا غَيْرَ مَصْنُوعٍ <span class="cevsen-separator">۞</span> يَا خَالِقًا غَيْرَ مَخْلُوقٍ <span class="cevsen-separator">۞</span> يَا مَالِكًا غَيْرَ مَمْلُوكٍ <span class="cevsen-separator">۞</span> يَا قَاهِرًا غَيْرَ مَقْهُورٍ <span class="cevsen-separator">۞</span> يَا رَافِعًا غَيْرَ مَرْفُوعٍ <span class="cevsen-separator">۞</span> يَا حَافِظًا غَيْرَ مَحْفُوظٍ <span class="cevsen-separator">۞</span> يَا نَاصِرًا غَيْرَ مَنْصُورٍ <span class="cevsen-separator">۞</span> يَا شَاهِدًا غَيْرَ غَٓائِبٍ <span class="cevsen-separator">۞</span> يَا قَرٖيبًا غَيْرَ بَعٖيدٍ</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٤٦</span></p>

</div>
CEVSEN_PAGE_046,
            ],
            [
                'page_number' => 47,
                'content' => <<<'CEVSEN_PAGE_047'
<div class="page" id="47">
<p class="text-end page-number">#47</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا نُورَ النُّورِ <span class="cevsen-separator">۞</span> يَا مُنَوِّرَ النُّورِ <span class="cevsen-separator">۞</span> يَا مُصَوِّرَ النُّورِ <span class="cevsen-separator">۞</span> يَا خَالِقَ النُّورِ<span class="cevsen-separator">۞</span> يَا مُقَدِّرَ النُّورِ <span class="cevsen-separator">۞</span> يَا مُدَبِّرَ النُّورِ <span class="cevsen-separator">۞</span> يَا نُورًا قَبْلَ كُلِّ نُورٍ <span class="cevsen-separator">۞</span> يَا نُورًا بَعْدَ كُلِّ نُورٍ <span class="cevsen-separator">۞</span> يَا نُورًا فَوْقَ كُلِّ نُورٍ <span class="cevsen-separator">۞</span> يَا نُورًا لَيْسَ مِثْلَهُ نُورٌ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٤٧</span></p>

</div>
CEVSEN_PAGE_047,
            ],
            [
                'page_number' => 48,
                'content' => <<<'CEVSEN_PAGE_048'
<div class="page" id="48">
<p class="text-end page-number">#48</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ عَطَٓاؤُهُ شَرٖيفٌ <span class="cevsen-separator">۞</span> يَا مَنْ فِعْلُهُ لَطٖيفٌ <span class="cevsen-separator">۞</span> يَا مَنْ لُطْفُهُ مُقٖيمٌ <span class="cevsen-separator">۞</span> يَا مَنْ اِحْسَانُهُ قَدٖيمٌ <span class="cevsen-separator">۞</span> يَا مَنْ قَوْلُهُ حَقٌّ <span class="cevsen-separator">۞</span> يَا مَنْ وَعْدُهُ صِدْقٌ <span class="cevsen-separator">۞</span> يَا مَنْ عَفْوُهُ فَضْلٌ <span class="cevsen-separator">۞</span> يَا مَنْ عَذَابُهُ عَدْلٌ <span class="cevsen-separator">۞</span> يَا مَنْ ذِكْرُهُ حُلْوٌ <span class="cevsen-separator">۞</span> يَا مَنْ اُنْسُهُ لَذٖيذٌ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٤٨</span></p>

</div>
CEVSEN_PAGE_048,
            ],
            [
                'page_number' => 49,
                'content' => <<<'CEVSEN_PAGE_049'
<div class="page" id="49">
<p class="text-end page-number">#49</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">وَ اَسْئَلُكَ بِاَسْمَٓائِكَ يَا مُنَوِّلُ <span class="cevsen-separator">۞</span> يَا مُفَصِّلُ <span class="cevsen-separator">۞</span> يَا مُبَدِّلُ <span class="cevsen-separator">۞</span> يَا مُسَهِّلُ <span class="cevsen-separator">۞</span> يَا مُذَلِّلُ <span class="cevsen-separator">۞</span> يَا مُنَزِّلُ <span class="cevsen-separator">۞</span> يَا مُحَوِّلُ <span class="cevsen-separator">۞</span> يَا مُجَمِّلُ <span class="cevsen-separator">۞</span> يَا مُكَمِّلُ <span class="cevsen-separator">۞</span> يَا مُفَضِّلُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٤٩</span></p>

</div>
CEVSEN_PAGE_049,
            ],
            [
                'page_number' => 50,
                'content' => <<<'CEVSEN_PAGE_050'
<div class="page" id="50">
<p class="text-end page-number">#50</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ يَرٰى وَ لَا يُرٰى <span class="cevsen-separator">۞</span> يَا مَنْ يَخْلُقُ وَ لَا يُخْلَقُ <span class="cevsen-separator">۞</span> يَا مَنْ يَهْدٖى وَ لَا يُهْدٰى <span class="cevsen-separator">۞</span> يَا مَنْ يُحْيٖى وَ لَا يُحْيٰى <span class="cevsen-separator">۞</span> يَا مَنْ يُطْعِمُ وَ لَا يُطْعَمُ <span class="cevsen-separator">۞</span> يَا مَنْ يُجٖيرُ وَ لَا يُجَارُ <span class="cevsen-separator">۞</span> يَا مَنْ يَقْضٖى وَ لَا يُقْضٰى عَلَيْهِ <span class="cevsen-separator">۞</span> يَا مَنْ يَحْكُمُ وَ لَا يُحْكَمُ عَلَيْهِ <span class="cevsen-separator">۞</span> يَا مَنْ لَمْ يَلِدْ وَ لَمْ يُولَدْ <span class="cevsen-separator">۞</span> وَ لَمْ يَكُنْ لَهُ كُفُوًا اَحَدٌ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٥٠</span></p>

</div>
CEVSEN_PAGE_050,
            ],
            [
                'page_number' => 51,
                'content' => <<<'CEVSEN_PAGE_051'
<div class="page" id="51">
<p class="text-end page-number">#51</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا نِعْمَ الْحَبٖيبُ <span class="cevsen-separator">۞</span> يَا نِعْمَ الطَّبٖيبُ <span class="cevsen-separator">۞</span> يَا نِعْمَ الْحَسٖيبُ <span class="cevsen-separator">۞</span> يَا نِعْمَ الْقَرٖيبُ <span class="cevsen-separator">۞</span> يَا نِعْمَ الرَّقٖيبُ <span class="cevsen-separator">۞</span> يَا نِعْمَ الْمُجٖيبُ <span class="cevsen-separator">۞</span> يَا نِعْمَ الْاَنٖيسُ <span class="cevsen-separator">۞</span> يَا نِعْمَ الْوَكٖيلُ <span class="cevsen-separator">۞</span> يَا نِعْمَ الْمَوْلٰى <span class="cevsen-separator">۞</span> يَا نِعْمَ النَّصٖيرُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٥١</span></p>

</div>
CEVSEN_PAGE_051,
            ],
            [
                'page_number' => 52,
                'content' => <<<'CEVSEN_PAGE_052'
<div class="page" id="52">
<p class="text-end page-number">#52</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا سُرُورَ الْعَارِفٖينَ <span class="cevsen-separator">۞</span> يَٓا اَنٖيسَ الْمُرٖيدٖينَ <span class="cevsen-separator">۞</span> يَا مُغٖيثَ الْمُشْتَاقٖينَ <span class="cevsen-separator">۞</span> يَا حَبٖيبَ التَّوَّابٖينَ <span class="cevsen-separator">۞</span> يَا رَازِقَ الْمُقِلّٖينَ <span class="cevsen-separator">۞</span> يَا رَجَٓاءَ الْمُذْنِبٖينَ <span class="cevsen-separator">۞</span> يَا كَاشِفَ الْمَكْرُوبٖينَ <span class="cevsen-separator">۞</span> يَا مُنَفِّسًا عَنِ الْمَغْمُومٖينَ <span class="cevsen-separator">۞</span> يَا مُفَرِّجًا عَنِ الْمَحْزُونٖينَ <span class="cevsen-separator">۞</span> يَٓا اِلٰهَ الْاَوَّلٖينَ وَ الْاٰخِرٖينَ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٥٢</span></p>

</div>
CEVSEN_PAGE_052,
            ],
            [
                'page_number' => 53,
                'content' => <<<'CEVSEN_PAGE_053'
<div class="page" id="53">
<p class="text-end page-number">#53</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا رَبَّ الْجَنَّةِ وَ النَّارِ <span class="cevsen-separator">۞</span> يَا رَبَّ النَّبِيّٖينَ وَ الْاَخْيَارِ <span class="cevsen-separator">۞</span> يَا رَبَّ الصِّدّٖيقٖينَ وَ الْاَبْرَارِ <span class="cevsen-separator">۞</span> يَا رَبَّ الصِّغَارِ وَ الْكِبَارِ <span class="cevsen-separator">۞</span> يَا رَبَّ الْحُبُوبِ وَ الْاَثْمَارِ <span class="cevsen-separator">۞</span> يَا رَبَّ الْاَنْهَارِ وَ الْاَشْجَارِ <span class="cevsen-separator">۞</span> يَا رَبَّ الصَّحَارٰى وَ الْقِفَارِ <span class="cevsen-separator">۞</span> يَا رَبَّ الْعَبٖيدِ وَ الْاَحْرَارِ <span class="cevsen-separator">۞</span> يَا رَبَّ الْاِعْلَانِ وَ الْاِسْرَارِ <span class="cevsen-separator">۞</span> يَا رَبَّ الَّيْلِ وَ النَّهَارِ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٥٣</span></p>

</div>
CEVSEN_PAGE_053,
            ],
            [
                'page_number' => 54,
                'content' => <<<'CEVSEN_PAGE_054'
<div class="page" id="54">
<p class="text-end page-number">#54</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ لَحِقَ فٖي كُلِّ شَىْءٍ عِلْمُهُ <span class="cevsen-separator">۞</span> يَا مَنْ نَفَذَ بِكُلِّ شَىْءٍ بَصَرُهُ <span class="cevsen-separator">۞</span> يَا مَنْ بَلَغَتْ اِلٰى كُلِّ شَىْءٍ قُدْرَتُهُ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُحْصِى الْعِبَادُ نَعْمَٓائَهُ <span class="cevsen-separator">۞</span> يَا مَنْ لَا تَبْلُغُ الْخَلَٓائِقُ شُكْرَهُ <span class="cevsen-separator">۞</span> يَا مَنْ لَا تُدْرِكُ الْاَفْهَامُ جَلَالَهُ <span class="cevsen-separator">۞</span> يَا مَنْ لَا تَنَالُ الْاَوْهَامُ كُنْهَهُ <span class="cevsen-separator">۞</span> يَا مَنِ الْعَظَمَةُ وَ الْكِبْرِيَٓاءُ رِدَٓاؤُهُ <span class="cevsen-separator">۞</span> يَا مَنِ الْهَيْبَةُ وَ السُّلْطَانُ بَهَٓاؤُهُ <span class="cevsen-separator">۞</span> يَا مَنْ تَعَزَّزَ بِالْعِزِّ بَقَٓاؤُهُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٥٤</span></p>

</div>
CEVSEN_PAGE_054,
            ],
            [
                'page_number' => 55,
                'content' => <<<'CEVSEN_PAGE_055'
<div class="page" id="55">
<p class="text-end page-number">#55</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ لَهُ الْمَثَلُ الْاَعْلٰى <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ الصِّفَاتُ الْعُلٰى <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ الْاٰخِرَةُ وَ الْاُولٰى <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ الْجَنَّةُ الْمَاْوٰى <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ النَّارُ وَ اللَّظٰى <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ الْاٰيَاتُ الْكُبْرٰى <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ الْاَسْمَٓاءُ الْحُسْنٰى <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ الْحُكْمُ وَ الْقَضَٓاءُ <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ السَّمٰوَاتُ الْعُلٰى <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ الْعَرْشُ وَ الثَّرٰى <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٥٥</span></p>

</div>
CEVSEN_PAGE_055,
            ],
            [
                'page_number' => 56,
                'content' => <<<'CEVSEN_PAGE_056'
<div class="page" id="56">
<p class="text-end page-number">#56</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">وَ اَسْئَلُكَ بِاَسْمَٓائِكَ يَا عَفُوُّ <span class="cevsen-separator">۞</span> يَا غَفُورُ <span class="cevsen-separator">۞</span> يَا وَدُودُ <span class="cevsen-separator">۞</span> يَا شَكُورُ <span class="cevsen-separator">۞</span> يَا صَبُورُ <span class="cevsen-separator">۞</span> يَا رَؤُفُ <span class="cevsen-separator">۞</span> يَا عَطُوفُ <span class="cevsen-separator">۞</span> يَا قُدُّوسُ <span class="cevsen-separator">۞</span> يَا حَىُّ <span class="cevsen-separator">۞</span> يَا قَيُّومُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٥٦</span></p>

</div>
CEVSEN_PAGE_056,
            ],
            [
                'page_number' => 57,
                'content' => <<<'CEVSEN_PAGE_057'
<div class="page" id="57">
<p class="text-end page-number">#57</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ هُوَ فِى السَّمَٓاءِ عَظَمَتُهُ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فِى الْاَرْضِ اٰيَاتُهُ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فٖى كُلِّ شَىْءٍ دَلَٓائِلُهُ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فِى الْبِحَارِ عَجَٓائِبُهُ <span class="cevsen-separator">۞</span> يَا مَنْ يَبْدَؤُ الْخَلْقَ ثُمَّ يُعٖيدُهُ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فِى الْجِبَالِ خَزَٓائِنُهُ <span class="cevsen-separator">۞</span> يَا مَنْ اَحْسَنَ كُلَّ شَىْءٍ خَلَقَهُ <span class="cevsen-separator">۞</span> يَا مَنْ اِلَيْهِ يُرْجَعُ الْاَمْرُ كُلُّهُ <span class="cevsen-separator">۞</span> يَا مَنْ ظَهَرَ فٖى كُلِّ شَىْءٍ لُطْفُهُ <span class="cevsen-separator">۞</span> يَا مَنْ يُعَرِّفُ الْخَلَٓائِقَ قُدْرَتَهُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٥٧</span></p>

</div>
CEVSEN_PAGE_057,
            ],
            [
                'page_number' => 58,
                'content' => <<<'CEVSEN_PAGE_058'
<div class="page" id="58">
<p class="text-end page-number">#58</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا حَبٖيبَ مَنْ لَا حَبٖيبَ لَهُ <span class="cevsen-separator">۞</span> يَا طَبٖيبَ مَنْ لَا طَبٖيبَ لَهُ <span class="cevsen-separator">۞</span> يَا مُجٖيبَ مَنْ لَا مُجٖيبَ لَهُ <span class="cevsen-separator">۞</span> يَا شَفٖيقَ مَنْ لَا شَفٖيقَ لَهُ <span class="cevsen-separator">۞</span> يَا رَفٖيقَ مَنْ لَا رَفٖيقَ لَهُ <span class="cevsen-separator">۞</span> يَا شَفٖيعَ مَنْ لَا شَفٖيعَ لَهُ <span class="cevsen-separator">۞</span>يَا مُغٖيثَ مَنْ لَا مُغٖيثَ لَهُ <span class="cevsen-separator">۞</span> يَا دَلٖيلَ مَنْ لَا دَلٖيلَ لَهُ <span class="cevsen-separator">۞</span> يَا قَٓائِدَ مَنْ لَا قَٓائِدَ لَهُ <span class="cevsen-separator">۞</span> يَا رَاحِمَ مَنْ لَا رَاحِمَ لَهُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٥٨</span></p>

</div>
CEVSEN_PAGE_058,
            ],
            [
                'page_number' => 59,
                'content' => <<<'CEVSEN_PAGE_059'
<div class="page" id="59">
<p class="text-end page-number">#59</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا كَافِىَ مَنِ اسْتَكْفَاهُ <span class="cevsen-separator">۞</span> يَا هَادِىَ مَنِ اسْتَهْدَاهُ <span class="cevsen-separator">۞</span> يَا كَالِىَ مَنِ اسْتَكْلَاهُ <span class="cevsen-separator">۞</span> يَا دَاعِىَ مَنِ اسْتَدْعَاهُ <span class="cevsen-separator">۞</span> يَا شَافِىَ مَنِ اسْتَشْفَاهُ <span class="cevsen-separator">۞</span> يَا قَاضِىَ مَنِ اسْتَقْضَاهُ <span class="cevsen-separator">۞</span> يَا مُغْنِىَ مَنِ اسْتَغْنَاهُ <span class="cevsen-separator">۞</span> يَا مُوفِىَ مَنِ اسْتَوْفَاهُ <span class="cevsen-separator">۞</span> يَا مُقَوِّىَ مَنِ اسْتَقْوَاهُ <span class="cevsen-separator">۞</span> يَا وَلِىَّ مَنِ اسْتَوْلَاهُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٥٩</span></p>

</div>
CEVSEN_PAGE_059,
            ],
            [
                'page_number' => 60,
                'content' => <<<'CEVSEN_PAGE_060'
<div class="page" id="60">
<p class="text-end page-number">#60</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">وَ اَسْئَلُكَ بِاَسْمَٓائِكَ يَٓا اَوَّلُ <span class="cevsen-separator">۞</span> يَٓا اٰخِرُ <span class="cevsen-separator">۞</span> يَا ظَاهِرُ <span class="cevsen-separator">۞</span> يَا بَاطِنُ <span class="cevsen-separator">۞</span> يَا خَالِقُ <span class="cevsen-separator">۞</span> يَا رَازِقُ <span class="cevsen-separator">۞</span> يَا صَادِقُ <span class="cevsen-separator">۞</span> يَا سَابِقُ <span class="cevsen-separator">۞</span> يَا سَٓائِقُ <span class="cevsen-separator">۞</span> يَا فَالِقُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ اَجِرْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٦٠</span></p>

</div>
CEVSEN_PAGE_060,
            ],
            [
                'page_number' => 61,
                'content' => <<<'CEVSEN_PAGE_061'
<div class="page" id="61">
<p class="text-end page-number">#61</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ يُقَلِّبُ الَّيْلَ وَ النَّهَارَ <span class="cevsen-separator">۞</span> يَا مَنْ خَلَقَ الظُّلُمَاتِ وَ النُّورَ <span class="cevsen-separator">۞</span> يَا مَنْ جَعَلَ الظِّلَّ وَ الْحَرُورَ <span class="cevsen-separator">۞</span> يَا مَنْ سَخَّرَ الشَّمْسَ وَ الْقَمَرَ <span class="cevsen-separator">۞</span> يَا مَنْ خَلَقَ الْمَوْتَ وَ الْحَيٰوةَ <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ الْخَلْقُ وَ الْاَمْرُ <span class="cevsen-separator">۞</span> يَا مَنْ لَمْ يَتَّخِذْ صَاحِبَةً وَ لَا وَلَدًا <span class="cevsen-separator">۞</span> يَا مَنْ لَمْ يَكُنْ لَهُ شَرٖيكٌ فِى الْمُلْكِ <span class="cevsen-separator">۞</span> يَا مَنْ لَمْ يَكُنْ لَهُ وَلِىٌّ مِنَ الذُّلِّ <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ الْحَوْلُ وَ الْقُوَّةُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٦١</span></p>

</div>
CEVSEN_PAGE_061,
            ],
            [
                'page_number' => 62,
                'content' => <<<'CEVSEN_PAGE_062'
<div class="page" id="62">
<p class="text-end page-number">#62</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ يَعْلَمُ مُرَادَ الْمُرٖيدٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ يَمْلِكُ حَوَٓائِجَ السَّٓائِلٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ يَسْمَعُ اَنٖينَ الْوَالِهٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ يَرٰى بُكَٓاءَ الْخَٓائِفٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ يَعْلَمُ ضَمٖيرَ الصَّامِتٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ يَرٰى نَدَمَ النَّادِمٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ يَقْبَلُ عُذْرَ التَّٓائِبٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُصْلِحُ عَمَلَ الْمُفْسِدٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُضٖيعُ اَجْرَ الْمُحْسِنٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يَبْعُدُ عَنْ قُلُوبِ الْعَارِفٖينَ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٦٢</span></p>

</div>
CEVSEN_PAGE_062,
            ],
            [
                'page_number' => 63,
                'content' => <<<'CEVSEN_PAGE_063'
<div class="page" id="63">
<p class="text-end page-number">#63</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا دَٓائِمَ الْبَقَٓاءِ <span class="cevsen-separator">۞</span> يَا غَافِرَ الْخَطَٓاءِ <span class="cevsen-separator">۞</span> يَا سَامِعَ الدُّعَٓاءِ <span class="cevsen-separator">۞</span> يَا وَاسِعَ الْعَطَٓاءِ <span class="cevsen-separator">۞</span> يَا رَافِعَ السَّمَٓاءِ <span class="cevsen-separator">۞</span> يَا كَاشِفَ الْبَلَٓاءِ <span class="cevsen-separator">۞</span> يَا عَظٖيمَ الثَّنَٓاءِ <span class="cevsen-separator">۞</span> يَا قَدٖيمَ السَّنَٓاءِ <span class="cevsen-separator">۞</span> يَا كَثٖيرَ الْوَفَٓاءِ <span class="cevsen-separator">۞</span> يَا شَرٖيفَ الْجَزَٓاءِ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٦٣</span></p>

</div>
CEVSEN_PAGE_063,
            ],
            [
                'page_number' => 64,
                'content' => <<<'CEVSEN_PAGE_064'
<div class="page" id="64">
<p class="text-end page-number">#64</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">وَ اَسْئَلُكَ بِاَسْمَٓائِكَ يَا غَفَّارُ <span class="cevsen-separator">۞</span> يَا سَتَّارُ <span class="cevsen-separator">۞</span> يَا قَهَّارُ <span class="cevsen-separator">۞</span> يَا جَبَّارُ <span class="cevsen-separator">۞</span> يَا صَبَّارُ <span class="cevsen-separator">۞</span> يَا رَزَّاقُ <span class="cevsen-separator">۞</span> يَا فَتَّاحُ <span class="cevsen-separator">۞</span> يَا عَلَّامُ <span class="cevsen-separator">۞</span> يَا وَهَّابُ <span class="cevsen-separator">۞</span> يَا تَوَّابُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٦٤</span></p>

</div>
CEVSEN_PAGE_064,
            ],
            [
                'page_number' => 65,
                'content' => <<<'CEVSEN_PAGE_065'
<div class="page" id="65">
<p class="text-end page-number">#65</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ خَلَقَنٖى وَ سَوَّانٖى <span class="cevsen-separator">۞</span> يَا مَنْ رَزَقَنٖى وَ رَبَّانٖى <span class="cevsen-separator">۞</span> يَا مَنْ اَطْعَمَنٖى وَ سَقَانٖى <span class="cevsen-separator">۞</span> يَا مَنْ قَرَّبَنٖى وَ اَدْنَانٖى <span class="cevsen-separator">۞</span> يَا مَنْ عَصَمَنٖى وَ كَفَانٖى <span class="cevsen-separator">۞</span> يَا مَنْ حَفِظَنٖى وَ كَلَانٖى <span class="cevsen-separator">۞</span> يَا مَنْ وَفَّقَنٖى وَ هَدَانٖى <span class="cevsen-separator">۞</span> يَا مَنْ اَعَزَّنٖى وَ اَغْنَانٖى <span class="cevsen-separator">۞</span> يَا مَنْ اَمَاتَنٖى وَ اَحْيَانٖى <span class="cevsen-separator">۞</span> يَا مَنْ اٰنَسَنٖى وَ اٰوَانٖى <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٦٥</span></p>

</div>
CEVSEN_PAGE_065,
            ],
            [
                'page_number' => 66,
                'content' => <<<'CEVSEN_PAGE_066'
<div class="page" id="66">
<p class="text-end page-number">#66</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ يُحِقُّ الْحَقَّ بِكَلِمَاتِهٖ <span class="cevsen-separator">۞</span> يَا مَنْ لَا مُعَقِّبَ لِحُكْمِهٖ <span class="cevsen-separator">۞</span> يَا مَنْ لَا رَٓادَّ لِقَضَٓائِهٖ <span class="cevsen-separator">۞</span> يَا مَنْ يَحُولُ بَيْنَ الْمَرْءِ وَ قَلْبِهٖ <span class="cevsen-separator">۞</span> يَا مَنْ يَقْبَلُ التَّوْبَةَ عَنْ عِبَادِهٖ <span class="cevsen-separator">۞</span> يَا مَنْ لَا تَنْفَعُ الشَّفَاعَةُ اِلَّا بِاِذْنِهٖ <span class="cevsen-separator">۞</span> يَا مَنِ السَّمٰوَاتُ مَطْوِيَّاتٌ بِيَمٖينِهٖ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ اَعْلَمُ بِمَنْ ضَلَّ عَنْ سَبٖيلِهٖ <span class="cevsen-separator">۞</span> يَا مَنْ يُسَبِّحُ الرَّعْدُ بِحَمْدِهٖ وَ الْمَلَٓئِكَةُ مِنْ خٖيفَتِهٖ <span class="cevsen-separator">۞</span> يَا مَنْ يُرْسِلُ الرِّيَاحَ بُشْرًا بَيْنَ يَدَىْ رَحْمَتِهٖ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٦٦</span></p>

</div>
CEVSEN_PAGE_066,
            ],
            [
                'page_number' => 67,
                'content' => <<<'CEVSEN_PAGE_067'
<div class="page" id="67">
<p class="text-end page-number">#67</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ جَعَلَ الْاَرْضَ مِهَادًا <span class="cevsen-separator">۞</span> يَا مَنْ جَعَلَ الْجِبَالَ اَوْتَادًا <span class="cevsen-separator">۞</span> يَا مَنْ جَعَلَ الشَّمْسَ سِرَاجًا <span class="cevsen-separator">۞</span> يَا مَنْ جَعَلَ الْقَمَرَ نُورًا <span class="cevsen-separator">۞</span> يَا مَنْ جَعَلَ الَّيْلَ لِبَاسًا <span class="cevsen-separator">۞</span> يَا مَنْ جَعَلَ النَّهَارَ مَعَاشًا <span class="cevsen-separator">۞</span> يَا مَنْ جَعَلَ النَّوْمَ سُبَاتًا <span class="cevsen-separator">۞</span> يَا مَنْ جَعَلَ السَّمَٓاءَ بِنَٓاءً <span class="cevsen-separator">۞</span> يَا مَنْ جَعَلَ الْاَشْيَٓاءَ اَزْوَاجًا <span class="cevsen-separator">۞</span> يَا مَنْ جَعَلَ النَّارَ مِرْصَادًا <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٦٧</span></p>

</div>
CEVSEN_PAGE_067,
            ],
            [
                'page_number' => 68,
                'content' => <<<'CEVSEN_PAGE_068'
<div class="page" id="68">
<p class="text-end page-number">#68</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">وَ اَسْئَلُكَ بِاَسْمَٓائِكَ يَا شَفٖيعُ <span class="cevsen-separator">۞</span> يَا سَمٖيعُ <span class="cevsen-separator">۞</span> يَا رَفٖيعُ <span class="cevsen-separator">۞</span> يَا مَنٖيعُ <span class="cevsen-separator">۞</span> يَا بَدٖيعُ <span class="cevsen-separator">۞</span> يَا سَرٖيعُ <span class="cevsen-separator">۞</span> يَا بَشٖيرُ <span class="cevsen-separator">۞</span> يَا نَذٖيرُ <span class="cevsen-separator">۞</span> يَا قَدٖيرُ <span class="cevsen-separator">۞</span> يَا مُقْتَدِرُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٦٨</span></p>

</div>
CEVSEN_PAGE_068,
            ],
            [
                'page_number' => 69,
                'content' => <<<'CEVSEN_PAGE_069'
<div class="page" id="69">
<p class="text-end page-number">#69</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا حَىُّ قَبْلَ كُلِّ حَىٍّ <span class="cevsen-separator">۞</span> يَا حَىُّ بَعْدَ كُلِّ حَىٍّ <span class="cevsen-separator">۞</span> يَا حَىُّ الَّذٖى لَا يُشْبِهُهُ شَىْءٌ <span class="cevsen-separator">۞</span> يَا حَىُّ الَّذٖى لَيْسَ كَمِثْلِهٖ حَىٌّ <span class="cevsen-separator">۞</span> يَا حَىُّ الَّذٖى لَا يُشَارِكُهُ حَىٌّ <span class="cevsen-separator">۞</span> يَا حَىُّ الَّذٖى لَا يَحْتَاجُ اِلٰى حَىٍّ <span class="cevsen-separator">۞</span> يَا حَىُّ الَّذٖى يُمٖيتُ كُلَّ حَىٍّ <span class="cevsen-separator">۞</span> يَا حَىُّ الَّذٖى يَرْزُقُ كُلَّ حَىٍّ <span class="cevsen-separator">۞</span> يَا حَىُّ الَّذٖى يُحْيِى الْمَوْتٰى <span class="cevsen-separator">۞</span> يَا حَىُّ الَّذٖى لَا يَمُوتُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٦٩</span></p>

</div>
CEVSEN_PAGE_069,
            ],
            [
                'page_number' => 70,
                'content' => <<<'CEVSEN_PAGE_070'
<div class="page" id="70">
<p class="text-end page-number">#70</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ لَهُ ذِكْرٌ لَا يُنْسٰى <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ نُورٌ لَا يُطْفٰى <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ ثَنَٓاءٌ لَا يُحْصٰى <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ نُعُوتٌ لَا تُغَيَّرُ <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ نِعَمٌ لَا تُعَدُّ <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ مُلْكٌ لَا يَزُولُ <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ جَلَالٌ لَا يُكَيَّفُ <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ قَضَٓاءٌ لَا يُرَدُّ <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ صِفَاتٌ لَا تُبَدَّلُ <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ كَمَالٌ لَا يُدْرَكُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٧٠</span></p>

</div>
CEVSEN_PAGE_070,
            ],
            [
                'page_number' => 71,
                'content' => <<<'CEVSEN_PAGE_071'
<div class="page" id="71">
<p class="text-end page-number">#71</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا رَبَّ الْعَالَمٖينَ <span class="cevsen-separator">۞</span> يَا مَالِكَ يَوْمِ الدّٖينِ <span class="cevsen-separator">۞</span> يَا مَنْ يُحِبُّ الصَّابِرٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ يُحِبُّ التَّوَّابٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ يُحِبُّ الْمُتَطَهِّرٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ يُحِبُّ الْمُحْسِنٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ خَيْرُ النَّاصِرٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ خَيْرُ الْفَاصِلٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ خَيْرُ الشَّاكِرٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ اَعْلَمُ بِالْمُفْسِدٖينَ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٧١</span></p>

</div>
CEVSEN_PAGE_071,
            ],
            [
                'page_number' => 72,
                'content' => <<<'CEVSEN_PAGE_072'
<div class="page" id="72">
<p class="text-end page-number">#72</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">وَ اَسْئَلُكَ بِاَسْمَٓائِكَ يَا مُبْدِىُٔ <span class="cevsen-separator">۞</span> يَا مُعٖيدُ <span class="cevsen-separator">۞</span> يَا حَفٖيظُ <span class="cevsen-separator">۞</span> يَا مُحٖيطُ <span class="cevsen-separator">۞</span> يَا حَمٖيدُ <span class="cevsen-separator">۞</span> يَا مَجٖيدُ <span class="cevsen-separator">۞</span> يَا مُقٖيتُ <span class="cevsen-separator">۞</span> يَا مُغٖيثُ <span class="cevsen-separator">۞</span> يَا مُعِزُّ <span class="cevsen-separator">۞</span> يَا مُذِلُّ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٧٢</span></p>

</div>
CEVSEN_PAGE_072,
            ],
            [
                'page_number' => 73,
                'content' => <<<'CEVSEN_PAGE_073'
<div class="page" id="73">
<p class="text-end page-number">#73</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ هُوَ اَحَدٌ بِلَا ضِدٍّ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فَرْدٌ بِلَا نِدٍّ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ صَمَدٌ بِلَا عَيْبٍ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ وِتْرٌ بِلَا شَفْعٍ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ رَبٌّ بِلَا وَزٖيرٍ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ غَنِىٌّ بِلَا فَقْرٍ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ سُلْطَانٌ بِلَا عَزْلٍ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ مَلٖيكٌ بِلَا عَجْزٍ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ مَوْجُودٌ بِلَا مِثْلٍ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٧٣</span></p>

</div>
CEVSEN_PAGE_073,
            ],
            [
                'page_number' => 74,
                'content' => <<<'CEVSEN_PAGE_074'
<div class="page" id="74">
<p class="text-end page-number">#74</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ هُوَ ذِكْرُهُ شَرَفٌ لِلذَّاكِرٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ شُكْرُهُ فَوْزٌ لِلشَّاكِرٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ حَمْدُهُ فَخْرٌ لِلْحَامِدٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ طَاعَتُهُ نَجَاةٌ لِلْمُطٖيعٖينَ<span class="cevsen-separator">۞</span> يَا مَنْ هُوَ بَابُهُ مَفْتُوحٌ لِلطَّالِبٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ سَبٖيلُهُ وَاضِحٌ لِلْمُؤْمِنٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ اٰيَاتُهُ بُرْهَانٌ لِلنَّاظِرٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ كِتَابُهُ تَذْكِرَةٌ لِلْمُوقِنٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ عَفْوُهُ مَلْجَأٌ لِلْمُذْنِبٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ رَحْمَتُهُ قَرٖيبٌ لِلْمُحْسِنٖينَ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٧٤</span></p>

</div>
CEVSEN_PAGE_074,
            ],
            [
                'page_number' => 75,
                'content' => <<<'CEVSEN_PAGE_075'
<div class="page" id="75">
<p class="text-end page-number">#75</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ تَبَارَكَ اسْمُهُ <span class="cevsen-separator">۞</span> يَا مَنْ تَعَالٰى جَدُّهُ <span class="cevsen-separator">۞</span> يَا مَنْ جَلَّ ثَنَٓاؤُهُ <span class="cevsen-separator">۞</span> يَا مَنْ لَٓا اِلٰهَ غَيْرُهُ <span class="cevsen-separator">۞</span> يَا مَنْ تَقَدَّسَتْ اَسْمَٓاؤُهُ <span class="cevsen-separator">۞</span> يَا مَنْ يَدُومُ بَقَٓاؤُهُ <span class="cevsen-separator">۞</span> يَا مَنِ الْعَظَمَةُ بَهَٓاؤُهُ <span class="cevsen-separator">۞</span> يَا مَنِ الْكِبْرِيَٓاءُ رِدَٓاؤُهُ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُحْصٰى اٰلَٓاؤُهُ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُعَدُّ نَعْمَٓاؤُهُ</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٧٥</span></p>

</div>
CEVSEN_PAGE_075,
            ],
            [
                'page_number' => 76,
                'content' => <<<'CEVSEN_PAGE_076'
<div class="page" id="76">
<p class="text-end page-number">#76</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">وَ اَسْئَلُكَ بِاَسْمَٓائِكَ يَا مُعٖينُ <span class="cevsen-separator">۞</span> يَا مُبٖينُ <span class="cevsen-separator">۞</span> يَٓا اَمٖينُ <span class="cevsen-separator">۞</span> يَا مَكٖينُ <span class="cevsen-separator">۞</span> يَا مَتٖينُ <span class="cevsen-separator">۞</span> يَا شَدٖيدُ <span class="cevsen-separator">۞</span> يَا شَهٖيدُ <span class="cevsen-separator">۞</span> يَا رَشٖيدُ <span class="cevsen-separator">۞</span> يَا حَمٖيدُ <span class="cevsen-separator">۞</span> يَا مَجٖيدُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٧٦</span></p>

</div>
CEVSEN_PAGE_076,
            ],
            [
                'page_number' => 77,
                'content' => <<<'CEVSEN_PAGE_077'
<div class="page" id="77">
<p class="text-end page-number">#77</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا ذَا الْعَرْشِ الْمَجٖيدِ <span class="cevsen-separator">۞</span> يَا ذَا الْقَوْلِ السَّدٖيدِ <span class="cevsen-separator">۞</span> يَا ذَا الْفَضْلِ الرَّشٖيدِ <span class="cevsen-separator">۞</span> يَا ذَا الْبَطْشِ الشَّدٖيدِ <span class="cevsen-separator">۞</span> يَا ذَا الْوَعْدِ وَ الْوَعٖيدِ <span class="cevsen-separator">۞</span> يَا قَرٖيبًا غَيْرَ بَعٖيدٍ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ الْوَلِىُّ الْحَمٖيدُ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ عَلٰى كُلِّ شَىْءٍ شَهٖيدٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ لَيْسَ بِظَلَّامٍ لِلْعَبٖيدِ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ اَقْرَبُ اِلَيْهِ مِنْ حَبْلِ الْوَرٖيدِ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٧٧</span></p>

</div>
CEVSEN_PAGE_077,
            ],
            [
                'page_number' => 78,
                'content' => <<<'CEVSEN_PAGE_078'
<div class="page" id="78">
<p class="text-end page-number">#78</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ لَا شَرٖيكَ لَهُ وَ لَا وَزٖيرَ <span class="cevsen-separator">۞</span> يَا مَنْ لَا شَبٖيهَ لَهُ وَ لَا نَظٖيرَ <span class="cevsen-separator">۞</span> يَا خَالِقَ الشَّمْسِ وَ الْقَمَرِ الْمُنٖيرِ <span class="cevsen-separator">۞</span> يَا مُغْنِىَ الْبَٓائِسِ الْفَقٖيرِ <span class="cevsen-separator">۞</span> يَا رَازِقَ الطِّفْلِ الصَّغٖيرِ <span class="cevsen-separator">۞</span> يَا رَاحِمَ الشَّيْخِ الْكَبٖيرِ <span class="cevsen-separator">۞</span> يَا عِصْمَةَ الْخَٓائِفِ الْمُسْتَجٖيرِ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ بِعِبَادِهٖ بَصٖيرٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ بِحَوَايِجِ الْعِبَادِ خَبٖيرٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ عَلٰى كُلِّ شَىْءٍ قَدٖيرٌ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٧٨</span></p>

</div>
CEVSEN_PAGE_078,
            ],
            [
                'page_number' => 79,
                'content' => <<<'CEVSEN_PAGE_079'
<div class="page" id="79">
<p class="text-end page-number">#79</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا ذَا الْجُودِ وَ النِّعَمِ <span class="cevsen-separator">۞</span> يَا ذَا الْفَضْلِ وَ الْكَرَمِ <span class="cevsen-separator">۞</span> يَا ذَا الْبَاْسِ وَ النِّقَمِ <span class="cevsen-separator">۞</span> يَا خَالِقَ اللَّوْحِ وَ الْقَلَمِ <span class="cevsen-separator">۞</span> يَا بَارِىَٔ الذَّرِّ وَ النَّسَمِ <span class="cevsen-separator">۞</span> يَا مُلْهِمَ الْعَرَبِ وَ الْعَجَمِ <span class="cevsen-separator">۞</span> يَا كَاشِفَ الضُّرِّ وَ الْاَلَمِ <span class="cevsen-separator">۞</span> يَا عَالِمَ السِّرِّ وَ الْهِمَمِ <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ الْبَيْتُ وَ الْحَرَمُ <span class="cevsen-separator">۞</span> يَا مَنْ يَخْلُقُ الْاَشْيَٓاءَ مِنَ الْعَدَمِ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٧٩</span></p>

</div>
CEVSEN_PAGE_079,
            ],
            [
                'page_number' => 80,
                'content' => <<<'CEVSEN_PAGE_080'
<div class="page" id="80">
<p class="text-end page-number">#80</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">وَ اَسْئَلُكَ بِاَسْمَٓائِكَ يَا عَادِلُ <span class="cevsen-separator">۞</span> يَا قَابِلُ <span class="cevsen-separator">۞</span> يَا فَاضِلُ <span class="cevsen-separator">۞</span> يَا فَاعِلُ <span class="cevsen-separator">۞</span> يَا كَافِلُ <span class="cevsen-separator">۞</span> يَا جَاعِلُ <span class="cevsen-separator">۞</span> يَا كَامِلُ <span class="cevsen-separator">۞</span> يَا فَاطِرُ <span class="cevsen-separator">۞</span> يَا طَالِبُ <span class="cevsen-separator">۞</span> يَا مَطْلُوبُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٨٠</span></p>

</div>
CEVSEN_PAGE_080,
            ],
            [
                'page_number' => 81,
                'content' => <<<'CEVSEN_PAGE_081'
<div class="page" id="81">
<p class="text-end page-number">#81</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ اَنْعَمَ بِحَوْلِهٖ <span class="cevsen-separator">۞</span> يَا مَنْ اَكْرَمَ بِطَوْلِهٖ <span class="cevsen-separator">۞</span> يَا مَنْ عَادَ بِلُطْفِهٖ <span class="cevsen-separator">۞</span> يَا مَنْ تَعَزَّزَ بِقُدْرَتِهٖ <span class="cevsen-separator">۞</span> يَا مَنْ قَدَّرَ بِحِكْمَتِهٖ <span class="cevsen-separator">۞</span> يَا مَنْ حَكَمَ بِتَدْبٖيرِهٖ <span class="cevsen-separator">۞</span> يَا مَنْ دَبَّرَ بِعِلْمِهٖ <span class="cevsen-separator">۞</span> يَا مَنْ تَجَاوَزَ بِحِلْمِهٖ <span class="cevsen-separator">۞</span> يَا مَنْ دَنَا فٖى عُلُوِّهٖ <span class="cevsen-separator">۞</span> يَا مَنْ عَلٰا فٖى دُنُوِّهٖ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٨١</span></p>

</div>
CEVSEN_PAGE_081,
            ],
            [
                'page_number' => 82,
                'content' => <<<'CEVSEN_PAGE_082'
<div class="page" id="82">
<p class="text-end page-number">#82</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ يَخْلُقُ مَا يَشَٓاءُ <span class="cevsen-separator">۞</span> يَا مَنْ يَفْعَلُ مَا يَشَٓاءُ <span class="cevsen-separator">۞</span> يَا مَنْ يَهْدٖى مَنْ يَشَٓاءُ <span class="cevsen-separator">۞</span> يَا مَنْ يُضِلُّ مَنْ يَشَٓاءُ <span class="cevsen-separator">۞</span> يَا مَنْ يَغْفِرُ لِمَنْ يَشَٓاءُ <span class="cevsen-separator">۞</span> يَا مَنْ يُعَذِّبُ مَنْ يَشَٓاءُ <span class="cevsen-separator">۞</span> يَا مَنْ يَتُوبُ عَلٰى مَنْ يَشَٓاءُ <span class="cevsen-separator">۞</span> يَا مَنْ يُصَوِّرُ فِى الْاَرْحَامِ كَيْفَ يَشَٓاءُ <span class="cevsen-separator">۞</span> يَا مَنْ يَزٖيدُ فِى الْخَلْقِ مَا يَشَٓاءُ <span class="cevsen-separator">۞</span> يَا مَنْ يَخْتَصُّ بِرَحْمَتِهٖ مَنْ يَشَٓاءُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٨٢</span></p>

</div>
CEVSEN_PAGE_082,
            ],
            [
                'page_number' => 83,
                'content' => <<<'CEVSEN_PAGE_083'
<div class="page" id="83">
<p class="text-end page-number">#83</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ لَمْ يَتَّخِذْ صَاحِبَةً وَ لَا وَلَدًا <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُشْرِكُ فٖى حُكْمِهٖٓ اَحَدًا <span class="cevsen-separator">۞</span> يَا مَنْ جَعَلَ لِكُلِّ شَىْءٍ قَدْرًا <span class="cevsen-separator">۞</span> يَا مَنْ لَمْ يَزَلْ رَحٖيمًا <span class="cevsen-separator">۞</span> يَا جَاعِلَ الْمَلٰٓئِكَةِ رُسُلًا <span class="cevsen-separator">۞</span> يَا مَنْ جَعَلَ فِى السَّمَٓاءِ بُرُوجًا <span class="cevsen-separator">۞</span> يَا مَنْ جَعَلَ الْاَرْضَ قَرَارًا <span class="cevsen-separator">۞</span> يَا مَنْ جَعَلَ مِنَ الْمَٓاءِ بَشَرًا <span class="cevsen-separator">۞</span> يَا مَنْ اَحْصٰى كُلَّ شَىْءٍ عَدَدًا <span class="cevsen-separator">۞</span> يَا مَنْ اَحَاطَ بِكُلِّ شَىْءٍ عِلْمًا <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٨٣</span></p>

</div>
CEVSEN_PAGE_083,
            ],
            [
                'page_number' => 84,
                'content' => <<<'CEVSEN_PAGE_084'
<div class="page" id="84">
<p class="text-end page-number">#84</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">وَ اَسْئَلُكَ بِاَسْمَٓائِكَ يَا فَرْدُ <span class="cevsen-separator">۞</span> يَا وِتْرُ <span class="cevsen-separator">۞</span> يَٓا اَحَدُ <span class="cevsen-separator">۞</span> يَا صَمَدُ <span class="cevsen-separator">۞</span> يَٓا اَمْجَدُ <span class="cevsen-separator">۞</span> يَٓا اَعَزُّ <span class="cevsen-separator">۞</span> يَٓا اَجَلُّ <span class="cevsen-separator">۞</span> يَٓا اَحَقُّ <span class="cevsen-separator">۞</span> يَٓا اَبَرُّ <span class="cevsen-separator">۞</span> يَٓا اَبَدُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٨٤</span></p>

</div>
CEVSEN_PAGE_084,
            ],
            [
                'page_number' => 85,
                'content' => <<<'CEVSEN_PAGE_085'
<div class="page" id="85">
<p class="text-end page-number">#85</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَعْرُوفَ مَنْ عَرَفَهُ <span class="cevsen-separator">۞</span> يَا مَعْبُودَ مَنْ عَبَدَهُ <span class="cevsen-separator">۞</span> يَا مَشْكُورَ مَنْ شَكَرَهُ <span class="cevsen-separator">۞</span> يَا مَذْكُورَ مَنْ ذَكَرَهُ <span class="cevsen-separator">۞</span> يَا مَحْمُودَ مَنْ حَمِِدَهُ <span class="cevsen-separator">۞</span> يَا مَوْجُودَ مَنْ طَلَبَهُ <span class="cevsen-separator">۞</span> يَا مَوْصُوفَ مَنْ وَحَّدَهُ <span class="cevsen-separator">۞</span> يَا مَحْبُوبَ مَنْ اَحَبَّهُ <span class="cevsen-separator">۞</span> يَا مَرْغُوبَ مَنْ اَرَادَهُ <span class="cevsen-separator">۞</span> يَا مَقْصُودَ مَنْ اَنَابَ اِلَيْهِ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٨٥</span></p>

</div>
CEVSEN_PAGE_085,
            ],
            [
                'page_number' => 86,
                'content' => <<<'CEVSEN_PAGE_086'
<div class="page" id="86">
<p class="text-end page-number">#86</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ لَا مُلْكَ اِلَّا مُلْكَهُ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُحْصِى الْعِبَادُ ثَنَٓائَهُ <span class="cevsen-separator">۞</span> يَا مَنْ لَا تَصِفُ الْخَلَٓائِقُ جَلَالَهُ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُدْرِكُ الْاَبْصَارُ كَمَالَهُ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يَبْلُغُ الْاَفْهَامُ صِفَاتَهُ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يَنَالُ الْاَفْكَارُ كِبْرِيَٓائَهُ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُحْسِنُ الْاِنْسَانُ نُعُوتَهُ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يَرُدُّ الْعِبَادُ قَضَٓائَهُ <span class="cevsen-separator">۞</span> يَا مَنْ ظَهَرَ فٖى كُلِّ شَىْءٍ اٰيَاتُهُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلَهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٨٦</span></p>

</div>
CEVSEN_PAGE_086,
            ],
            [
                'page_number' => 87,
                'content' => <<<'CEVSEN_PAGE_087'
<div class="page" id="87">
<p class="text-end page-number">#87</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا حَبٖيبَ الْبَكَّٓائٖينَ <span class="cevsen-separator">۞</span>يَا سَنَدَ الْمُتَوَكِّلٖينَ <span class="cevsen-separator">۞</span> يَا هَادِىَ الْمُضِلّٖينَ <span class="cevsen-separator">۞</span> يَا وَلِىَّ الْمُؤْمِنٖينَ <span class="cevsen-separator">۞</span> يَٓا اَنٖيسَ الذَّاكِرٖينَ <span class="cevsen-separator">۞</span> يَٓا اَقْدَرَ الْقَادِرٖينَ <span class="cevsen-separator">۞</span> يَٓا اَبْصَرَ النَّاظِرٖينَ <span class="cevsen-separator">۞</span> يَٓا اَعْلَمَ الْعَالِمٖينَ <span class="cevsen-separator">۞</span> يَا مَفْزَعَ الْمَلْهُوفٖينَ <span class="cevsen-separator">۞</span> يَٓا اَنْصَرَ النَّاصِرٖينَ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٨٧</span></p>

</div>
CEVSEN_PAGE_087,
            ],
            [
                'page_number' => 88,
                'content' => <<<'CEVSEN_PAGE_088'
<div class="page" id="88">
<p class="text-end page-number">#88</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">وَ اَسْئَلُكَ بِاَسْمَٓائِكَ يَا مُكْرِمُ <span class="cevsen-separator">۞</span> يَا مُعَظَّمُ <span class="cevsen-separator">۞</span> يَا مُنَعِّمُ <span class="cevsen-separator">۞</span> يَا مُعْطٖى <span class="cevsen-separator">۞</span> يَا مُغْنٖى <span class="cevsen-separator">۞</span> يَا مُحْيٖى <span class="cevsen-separator">۞</span> يَا مُبْدِىُٔ <span class="cevsen-separator">۞</span> يَا مُرْضٖى <span class="cevsen-separator">۞</span> يَا مُنْجٖى <span class="cevsen-separator">۞</span> يَا مُحْسِنُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٨٨</span></p>

</div>
CEVSEN_PAGE_088,
            ],
            [
                'page_number' => 89,
                'content' => <<<'CEVSEN_PAGE_089'
<div class="page" id="89">
<p class="text-end page-number">#89</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا كَافِىَ كُلِّ شَىْءٍ <span class="cevsen-separator">۞</span> يَا قَٓائِمًا عَلٰى كُلِّ شَىْءٍ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُشْبِهُهُ شَىْءٌ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يَزٖيدُ فٖى مُلْكِهِ شَىْءٌ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يَنْقُصُ مِنْ خَزَٓائِنِهٖ شَىْءٌ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يَخْفٰى عَلَيْهِ شَىْءٌ <span class="cevsen-separator">۞</span> يَا مَنْ لَيْسَ كَمِثْلِهٖ شَىْءٌ <span class="cevsen-separator">۞</span> يَا مَنْ بِيَدِهٖ مَقَالٖيدُ كُلِّ شَىْءٍ <span class="cevsen-separator">۞</span> يَا مَنْ وَسِعَتْ رَحْمَتُهُ كُلَّ شَىْءٍ <span class="cevsen-separator">۞</span> يَا مَنْ يَبْقٰى وَ يَفْنٰى كُلُّ شَىْءٍ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٨٩</span></p>

</div>
CEVSEN_PAGE_089,
            ],
            [
                'page_number' => 90,
                'content' => <<<'CEVSEN_PAGE_090'
<div class="page" id="90">
<p class="text-end page-number">#90</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ لَا يَعْلَمُ الْغَيْبَ اِلَّا هُوَ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يَصْرِفُ السُّٓوءَ اِلَّا هُوَ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُدَبِّرُ الْاَمْرَ اِلَّا هُوَ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يَغْفِرُ الذُّنُوبَ اِلَّا هُوَ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُقَلِّبُ الْقَلْبَ اِلَّا هُوَ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يَخْلُقُ الْخَلْقَ اِلَّا هُوَ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُتِمُّ النِّعْمَةَ اِلَّا هُوَ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُنَزِّلُ الْغَيْثَ اِلَّا هُوَ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُحْيِى الْمَوْتٰى اِلَّا هُوَ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُغْنٖى عَلَى التَّحْقٖيقِ اِلَّا هُوَ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ نَجِّنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٩٠</span></p>

</div>
CEVSEN_PAGE_090,
            ],
            [
                'page_number' => 91,
                'content' => <<<'CEVSEN_PAGE_091'
<div class="page" id="91">
<p class="text-end page-number">#91</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">وَ اَسْئَلُكَ بِاَسْمَٓائِكَ يَا كَاشِفُ <span class="cevsen-separator">۞</span> يَا فَارِجُ <span class="cevsen-separator">۞</span> يَا فَاتِحُ <span class="cevsen-separator">۞</span> يَا نَاصِرُ <span class="cevsen-separator">۞</span> يَا ضَامِنُ <span class="cevsen-separator">۞</span> يَٓا اٰمِرُ <span class="cevsen-separator">۞</span> يَا نَاهٖى <span class="cevsen-separator">۞</span> يَا رَجَا <span class="cevsen-separator">۞</span> يَا مُرْتَجَا <span class="cevsen-separator">۞</span> يَا عَظٖيمَ الرَّجَا <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٩١</span></p>

</div>
CEVSEN_PAGE_091,
            ],
            [
                'page_number' => 92,
                'content' => <<<'CEVSEN_PAGE_092'
<div class="page" id="92">
<p class="text-end page-number">#92</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مُعٖينَ الضُّعَفَٓاءِ <span class="cevsen-separator">۞</span> يَا كَنْزَ الْفُقَرَٓاءِ <span class="cevsen-separator">۞</span> يَا صَاحِبَ الْغُرَبَٓاءِ <span class="cevsen-separator">۞</span> يَا نَاصِرَ الْاَوْلِيَٓاءِ <span class="cevsen-separator">۞</span> يَا قَاهِرَ الْاَعْدَٓاءِ <span class="cevsen-separator">۞</span> يَا رَافِعَ السَّمَٓاءِ <span class="cevsen-separator">۞</span> يَا كَاشِفَ الْبَلَٓاءِ <span class="cevsen-separator">۞</span> يَٓا اَنٖيسَ الْاَوْلِيَٓاءِ <span class="cevsen-separator">۞</span> يَا حَبٖيبَ الْاَتْقِيَٓاءِ <span class="cevsen-separator">۞</span> يَٓا اِلٰهَ الْاَغْنِيَٓاءِ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٩٢</span></p>

</div>
CEVSEN_PAGE_092,
            ],
            [
                'page_number' => 93,
                'content' => <<<'CEVSEN_PAGE_093'
<div class="page" id="93">
<p class="text-end page-number">#93</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَٓا اَوَّلَ كُلِّ شَىْءٍ وَ اٰخِرَهُ <span class="cevsen-separator">۞</span> يَٓا اِلٰهَ كُلِّ شَىْءٍ وَ صَانِعَهُ <span class="cevsen-separator">۞</span> يَا رَازِقَ كُلِّ شَىْءٍ وَ خَالِقَهُ <span class="cevsen-separator">۞</span> يَا فَاطِرَ كُلِّ شَىْءٍ وَ مَلٖيكَهُ <span class="cevsen-separator">۞</span> يَا قَابِضَ كُلِّ شَىْءٍ وَ بَاسِطَهُ <span class="cevsen-separator">۞</span> يَا مُبْدِىَٔ كُلِّ شَىْءٍ وَ مُعٖيدَهُ <span class="cevsen-separator">۞</span> يَا مُسَبِّبَ كُلِّ شَىْءٍ وَ مُقَدِّرَهُ <span class="cevsen-separator">۞</span> يَا مُرَبِّىَ كُلِّ شَىْءٍ وَ مُدَبِّرَهُ <span class="cevsen-separator">۞</span> يَا مُكَوِّرَ كُلِّ شَىْءٍ وَ مُحَوِّلَهُ <span class="cevsen-separator">۞</span> يَا مُحْيِىَ كُلِّ شَىْءٍ وَ مُمٖيتَهُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٩٣</span></p>

</div>
CEVSEN_PAGE_093,
            ],
            [
                'page_number' => 94,
                'content' => <<<'CEVSEN_PAGE_094'
<div class="page" id="94">
<p class="text-end page-number">#94</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا خَيْرَ ذَاكِرٍ وَ مَذْكُورٍ <span class="cevsen-separator">۞</span> يَا خَيْرَ شَاكِرٍ وَ مَشْكُورٍ <span class="cevsen-separator">۞</span> يَا خَيْرَ حَامِدٍ وَ مَحْمُودٍ <span class="cevsen-separator">۞</span> يَا خَيْرَ شَاهِدٍ وَ مَشْهُودٍ <span class="cevsen-separator">۞</span> يَا خَيْرَ دَاعٍ وَ مَدْعُوٍّ <span class="cevsen-separator">۞</span> يَا خَيْرَ مُجٖيبٍ وَ مُجَابٍ <span class="cevsen-separator">۞</span> يَا خَيْرَ مُونِسٍ وَ اَنٖيسٍ <span class="cevsen-separator">۞</span> يَا خَيْرَ صَاحِبٍ وَ جَلٖيسٍ <span class="cevsen-separator">۞</span> يَا خَيْرَ مَقْصُودٍ وَ مَطْلُوبٍ <span class="cevsen-separator">۞</span> يَا خَيْرَ حَبٖيبٍ وَ مَحْبُوبٍ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٩٤</span></p>

</div>
CEVSEN_PAGE_094,
            ],
            [
                'page_number' => 95,
                'content' => <<<'CEVSEN_PAGE_095'
<div class="page" id="95">
<p class="text-end page-number">#95</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ هُوَ لِمَنْ دَعَاهُ مُجٖيبٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ لِمَنْ اَطَاعَهُ حَبٖيبٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ لِمَنْ اَحَبَّهُ قَرٖيبٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ بِمَنْ اَرَادَهُ عَلٖيمٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ لِمَنْ رَجَاهُ كَرٖيمٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ بِمَنْ عَصَاهُ حَلٖيمٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فٖى حِلْمِهٖ حَكٖيمٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فٖى حُكْمِهٖ عَظٖيمٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فٖى عَظَمَتِهٖ رَحٖيمٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فٖٓى اِحْسَانِهٖ قَدٖيمٌ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٩٥</span></p>

</div>
CEVSEN_PAGE_095,
            ],
            [
                'page_number' => 96,
                'content' => <<<'CEVSEN_PAGE_096'
<div class="page" id="96">
<p class="text-end page-number">#96</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">وَ اَسْئَلُكَ بِاَسْمَٓائِكَ يَا مُسَبِّبُ <span class="cevsen-separator">۞</span> يَا مُقَرِّبُ <span class="cevsen-separator">۞</span> يَا مُعَقِّبُ <span class="cevsen-separator">۞</span> يَا مُقَلِّبُ <span class="cevsen-separator">۞</span> يَا مُقَدِّرُ <span class="cevsen-separator">۞</span> يَا مُرَتِّبُ <span class="cevsen-separator">۞</span> يَا مُرَغِّبُ <span class="cevsen-separator">۞</span> يَا مُذَكِّرُ <span class="cevsen-separator">۞</span> يَا مُكَوِّنُ <span class="cevsen-separator">۞</span> يَا مُتَكَبِّرُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٩٦</span></p>

</div>
CEVSEN_PAGE_096,
            ],
            [
                'page_number' => 97,
                'content' => <<<'CEVSEN_PAGE_097'
<div class="page" id="97">
<p class="text-end page-number">#97</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ لَا يُشْغِلُهُ سَمْعٌ عَنْ سَمْعٍ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يَمْنَعُهُ فِعْلٌ عَنْ فِعْلٍ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُلْهٖيهِ قَوْلٌ عَنْ قَوْلٍ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُغَلِّطُهُ سُؤَالٌ عَنْ سُؤَالٍ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يُبْرِمُهُ اِلْحَاحُ الْمُلِحّٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ شَرَحَ بِالْاِسْلَامِ صُدُورَ الْمُؤْمِنٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ اَطَابَ بِذِكْرِهٖ قُلُوبَ الْمُخْبِتٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يَغٖيبُ عَنْ قُلُوبِ الْمُشْتَاقٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ غَايَةُ مُرَادِ الْمُرٖيدٖينَ <span class="cevsen-separator">۞</span> يَا مَنْ لَا يَخْفٰى عَلَيْهِ شَىْءٌ فِى الْعَالَمٖينَ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٩٧</span></p>

</div>
CEVSEN_PAGE_097,
            ],
            [
                'page_number' => 98,
                'content' => <<<'CEVSEN_PAGE_098'
<div class="page" id="98">
<p class="text-end page-number">#98</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنْ هُوَ عِلْمُهُ سَابِقٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ وَعْدُهُ صَادِقٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ لُطْفُهُ ظَاهِرٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ اَمْرُهُ غَالِبٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ كِتَابُهُ مُحْكَمٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ قَضَٓاؤُهُ كَٓائِنٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ قُرْاٰنُهُ مَجٖيدٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ مُلْكُهُ قَدٖيمٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ فَضْلُهُ مُقٖيمٌ <span class="cevsen-separator">۞</span> يَا مَنْ هُوَ عَرْشُهُ عَظٖيمٌ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٩٨</span></p>

</div>
CEVSEN_PAGE_098,
            ],
            [
                'page_number' => 99,
                'content' => <<<'CEVSEN_PAGE_099'
<div class="page" id="99">
<p class="text-end page-number">#99</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">يَا رَبَّ الْاَرْبَابِ <span class="cevsen-separator">۞</span> يَا مُفَتِّحَ الْاَبْوَابِ <span class="cevsen-separator">۞</span> يَا مُسَبِّبَ الْاَسْبَابِ <span class="cevsen-separator">۞</span> يَا مُعْطِىَ الثَّوَابِ <span class="cevsen-separator">۞</span> يَا مُلْهِمَ الصَّوَابِ <span class="cevsen-separator">۞</span> يَا مُنْشِىَٔ السَّحَابِ <span class="cevsen-separator">۞</span> يَا شَدٖيدَ الْعِقَابِ <span class="cevsen-separator">۞</span> يَا سَرٖيعَ الْحِسَابِ <span class="cevsen-separator">۞</span> يَا مَنْ لَهُ الْاِيَابُ <span class="cevsen-separator">۞</span> يَا غَفُورُ يَا تَوَّابُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝٩٩</span></p>

</div>
CEVSEN_PAGE_099,
            ],
            [
                'page_number' => 100,
                'content' => <<<'CEVSEN_PAGE_100'
<div class="page" id="100">
<p class="text-end page-number">#100</p>

<p class="text-center text-arabic" dir="rtl" lang="ar">وَ اَسْئَلُكَ بِاَسْمَٓائِكَ يَا رَبَّنَا <span class="cevsen-separator">۞</span> يَا اِلٰهَنَا <span class="cevsen-separator">۞</span> يَا سَيِّدَنَا <span class="cevsen-separator">۞</span> يَا مَوْلٰينَا <span class="cevsen-separator">۞</span> يَا نَاصِرَنَا <span class="cevsen-separator">۞</span> يَا حَافِظَنَا <span class="cevsen-separator">۞</span> يَا قَادِرَنَا <span class="cevsen-separator">۞</span> يَا رَازِقَنَا <span class="cevsen-separator">۞</span> يَا دَلٖيلَنَا <span class="cevsen-separator">۞</span> يَا مُغٖيثَنَا <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ خَلِّصْنَا مِنَ النَّارِ <span class="cevsen-verse-number">۝١٠٠</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ رَبَّنَا <span class="cevsen-separator">۞</span> خَلِّصْنَا <span class="cevsen-separator">۞</span> وَ اَجِرْنَا <span class="cevsen-separator">۞</span> وَ نَجِّنَا مِنَ النَّارِ <span class="cevsen-separator">۞</span> وَ عَافِنَا وَ اعْفُ عَنَّا وَ اَدْخِلْنَا الْجَنَّةَ دَارَ قُدْسِكَ مَعَ الْاَبْرَارِ <span class="cevsen-separator">۞</span> بِعَفْوِكَ يَا مُجٖيرُ <span class="cevsen-separator">۞</span> بِفَضْلِكَ يَا غَفَّارُ <span class="cevsen-separator">۞</span> وَ اَسْئَلُكَ بِحَقِّ هٰذِهِ الْاَسْمَٓاءِ الْكَرٖيمَةِ الشَّرٖيفَةِ وَ الصِّفَاتِ الْجَلٖيلَةِ الَّلطٖيفَةِ اَنْ تُصَلِّىَ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَ عَلٰٓى اٰلِهٖ وَ صَحْبِهٖ بِعَدَدِ حَسَنَاتِ مُحَمَّدٍ بِسْمِ اللّٰهِ <span class="cevsen-separator">۞</span> حَسْبِىَ اللّٰهُ <span class="cevsen-separator">۞</span> لَٓا اِلٰهَ اِلَّا اللّٰهُ <span class="cevsen-separator">۞</span> شَهِدَ اللّٰهُ <span class="cevsen-separator">۞</span> قُلْ هُوَ اللّٰهُ <span class="cevsen-separator">۞</span> مَا شَٓاءَ اللّٰهُ <span class="cevsen-separator">۞</span> رَبِّىَ اللّٰهُ <span class="cevsen-separator">۞</span></p>

<p class="text-center text-arabic" dir="rtl" lang="ar">تَبَارَكَ اللّٰهُ <span class="cevsen-separator">۞</span> تَعَالَى اللّٰهُ <span class="cevsen-separator">۞</span> تَوَكَّلْتُ عَلَى اللّٰهِ <span class="cevsen-separator">۞</span> فَسَيَكْفٖيكَهُمُ اللّٰهُ وَ هُوَ السَّمٖيعُ الْعَلٖيمُ <span class="cevsen-separator">۞</span> سُبْحَانَكَ يَا لَٓا اِلٰهَ اِلَّٓا اَنْتَ الْاَمَانُ الْاَمَانُ لَٓا اُحْصٖى ثَنَٓاءً عَلَيْكَ اَنْتَ كَمَٓا اَثْنَيْتَ عَلٰى نَفْسِكَ <span class="cevsen-separator">۞</span> يَٓا اَللّٰهُ <span class="cevsen-separator">۞</span> يَا رَحْمٰنُ <span class="cevsen-separator">۞</span> يَا رَحٖيمُ <span class="cevsen-separator">۞</span> يَا غَفُورُ <span class="cevsen-separator">۞</span> يَا شَكُورُ <span class="cevsen-separator">۞</span> اَسْئَلُكَ بِمَٓا اَحْصَيْتَهُ عَلَيْكَ مِنْ اَسْمَٓائِكَ الْحُسْنٰى وَ صِفَاتِكَ الْعُلْيَا وَ كَلِمَاتِكَ التَّٓامَّةِ اَنْ تَغْفِرَلٖى وَ لِوَالِدَىَّ وَ لِاُسْتَاذٖى سَعٖيدِ النُّورْسٖى وَ لِطَلَبَةِ رَسَٓائِلِ النُّورِ وَ لِجَمٖيعِ الْمُؤْمِنٖينَ وَ الْمُؤْمِنَاتِ وَ الْمُسْلِمٖينَ وَ الْمُسْلِمَاتِ اَلْاَحْيَٓاءِ مِنْهُمْ وَ الْاَمْوَاتِ وَ تَرْحَمَنَا رَحْمَةً تُغْنٖينَا بِهَا عَنْ رَحْمَةِ مَنْ سِوَاكَ مِنْ خَلْقِكَ وَ اَنْ تَقْضِىَ حَوَايِجَنَا وَ تُعْطِيَنَا سُؤَالَنَا فِى الدُّنْيَا وَ الْاٰخِرَةِ وَ تَخْتِمَ لَنَا بِالسَّعَادَةِ وَ الشَّهَادَةِ وَ الْكَرَامَةِ وَ الْبُشْرٰى عِنْدَ فِرَاقِ الدُّنْيَا وَ تَجْزِىَ مُحَمَّدًا صَلَّى اللّٰهُ عَلَيْهِ وَ سَلَّمَ عَنَّا مَا هُوَ اَهْلُهُ وَ مُسْتَحَقُّهُ وَ اَنْ لَا تَكِلَنَا عَلَٓى اَنْفُسِنَا طَرْفَةَ عَيْنٍ وَ لَٓا اِلَٓى اَحَدٍ مِنْ خَلْقِكَ وَ تُصْلِحَ لَنَا شَاْنَنَا وَ اَنْ تَحْرُسَنَا بِعَيْنِكَ الَّتٖى لَا تَنَامُ وَ تَحْفَظَنَا بِرُكْنِكَ الَّذٖى لَا يُرَامُ يَا ذَا الْجَلَالِ وَ الْاِكْرَامِ وَ اَنْ تَصْرِفَ عَنَّا وَ عَمَّنْ عُلِّقَ عَلَيْهِ هٰذِهِ الْاَسْمَٓاءُ اٰفَةَ الْجِنِّ وَ الْاِنْسِ وَ الشَّيَاطٖينِ وَ زَلْزَلَةَ الْاَرْضِ وَ دَكْدَكَةَ الْجِبَالِ مِنْ خَشْيَتِهٖ وَ اٰفَةَ الطَّاعُونِ وَ الْوَبَٓاءِ وَ عَيْنَ السُّٓوءِ وَ وَجَعَ الْجَوَارِحِ وَسَٓائِرَ الْاٰفَاتِ وَ تَحْفَظَنَا مِنْ كُلِّ شَرٍّ وَ سُٓوءٍ وَ تَرْزُقَنَا السَّلَامَةَ وَ الْعَافِيَةَ وَ الْخَيْرَ فِى الدُّنْيَا وَ الْاٰخِرَةِ بِرَحْمَتِكَ يَٓا اَرْحَمَ الرَّاحِمٖينَ وَ صَلَّى اللّٰهُ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَ اٰلِهٖ وَ صَحْبِهٖٓ اَجْمَعٖينَ وَ الْحَمْدُ لِلّٰهِ رَبِّ الْعَالَمٖينَ</p>

</div>
CEVSEN_PAGE_100,
            ],
        ];
    }
}

<?php

declare(strict_types=1);

namespace Database\Seeders;

/**
 * Namaz Tesbihatı — zelfstandige offline boek-seeder.
 *
 * Gebaseerd op de door de gebruiker aangeleverde teksten
 * (Sabah, Öğle, İkindi, Akşam, Yatsı), met Nederlandse aanwijzingen.
 * Arabische orthografie: beperkte correctieronde op basis van Define Yayınları (2010)
 * en de tweede aangeleverde PDF. Volledige woord-voor-woord collatie blijft nodig.
 * Geen HTTP-verzoeken of externe tekstbestanden.
 *
 * Controleer eventuele rechten op herpublicatie vóór publicatie.
 */
class TesbihatPagesSeeder extends BookPagesSeeder
{
    protected function productSlug(): string
    {
        return 'namaz-tesbihati';
    }

    protected function bookTitle(): string
    {
        return 'Namaz Tesbihatı';
    }

    protected function pages(): array
    {
        $pages = [
            [
                'page_number' => 1,
                'content' => <<<'TESBIHAT_PAGE_001'
<div class="page" id="1">
<p class="text-end page-number">#1</p>
<p class="text-center"><strong>Fajr – Ochtendgebed</strong></p>

<p class="text-center">Na het verplichte deel van het ochtendgebed en de afsluitende vredesgroet zeg je:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ اَنْتَ السَّلَامُ وَمِنْكَ السَّلَامُ تَبَارَكْتَ يَاذَا الْجَلَالِ وَالْاِكْرَامِ</p>
<p class="text-center">Hef daarna je handen op met de handpalmen naar boven en reciteer de smeekbede Salâtan Tunjînâ:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِ سَيِّدِنَا مُحَمَّدٍ صَلَاةً تُنْجٖينَا بِهَا مِنْ جَمٖيعِ الْاَهْوَالِ وَالْاٰفَاتِ وَتَقْضٖي لَنَا بِهَا جَمٖيعَ الْحَاجَاتِ وَتُطَهِّرُنَا بِهَا مِنْ جَمٖيعِ السَّيِّئَاتِ وَتَرْفَعُنَا بِهَا عِنْدَكَ اَعْلَى الدَّرَجَاتِ وَتُبَلِّغُنَا بِهَا اَقْصَى الْغَايَاتِ مِنْ جَمٖيعِ الْخَيْرَاتِ فِي الْحَيَاةِ وَبَعْدَ الْمَمَاتِ اٰمٖينَ يَامُجٖيبَ الدَّعَوَاتِ وَالْحَمْدُ لِلّٰهِ رَبِّ الْعَالَمٖينَ <span class="cevsen-separator">۞</span></p>
<p class="text-center">Reciteer vervolgens eenmaal:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ اِنَّا نُقَدِّمُ اِلَيْكَ بَيْنَ يَدَيْ كُلِّ نَفَسٍ وَلَمْحَةٍ وَلَحْظَةٍ وَطَرْفَةٍ يَطْرِفُ بِهَا اَهْلُ السَّمٰوَاتِ وَاَهْلُ الْاَرَضٖينَ شَهَادَةً اَشْهَدُ اَنْ‥</p>
<p class="text-center">Herhaal negenmaal:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">لَٓا اِلٰهَ اِلَّا اللّٰهُ وَحْدَهُ لَا شَرٖيكَ لَهُ، لَهُ الْمُلْكُ وَلَهُ الْحَمْدُ يُحْيٖ وَيُمٖيتُ وَهُوَ حَيٌّ لَا يَمُوتُ بِيَدِهِ الْخَيْرُ وَهُوَ عَلٰى كُلِّ شَيْءٍ قَدٖيرٌ</p>
<p class="text-center">Vul de tiende herhaling als volgt aan:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">لَٓا اِلٰهَ اِلَّا اللّٰهُ وَحْدَهُ لَا شَرٖيكَ لَهُ، لَهُ الْمُلْكُ وَلَهُ الْحَمْدُ يُحْيٖ وَيُمٖيتُ وَهُوَ حَيٌّ لَا يَمُوتُ بِيَدِهِ الْخَيْرُ وَهُوَ عَلٰى كُلِّ شَيْءٍ قَدٖيرٌ <span class="cevsen-separator">۞</span> وَاِلَيْهِ الْمَصٖيرُ <span class="cevsen-separator">۞</span></p>
<p class="text-center">Draai daarna je handpalmen naar beneden en zeg drie-, vijf- of zevenmaal: <span class="text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ اَجِرْنَا مِنَ النَّارِ</span> Ga vervolgens verder met:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ اَجِرْنَا مِنْ كُلِّ نَارٍ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ فِتْنَةِ الدّٖينِيَّةِ وَالدُّنْيَوِيَّةِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ فِتْنَةِ اٰخِرِ الزَّمَانِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ فِتْنَةِ الْمَسٖيحِ الدَّجَّالِ وَالسُّفْيَانِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنَ الضَّلَالَاتِ وَالْبِدْعِيَّاتِ وَالْبَلِيَّاتِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ شَرِّ النَّفْسِ الْاَمَّارَةِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ شُرُورِ النُّفُوسِ الْاَمَّارَاتِ الْفِرْعَوْنِيَّةِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ شَرِّ النِّسَاءِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ بَلَاءِ النِّسَاءِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ فِتْنَةِ النِّسَاءِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ عَذَابِ الْقَبْرِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ عَذَابِ يَوْمِ الْقِيَامَةِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ عَذَابِ جَهَنَّمَ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ عَذَابِ قَهْرِكَ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ نَارِ قَهْرِكَ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ عَذَابِ الْقَبْرِ وَالنّٖيرَانِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنَ الرِّيَاءِ وَالسُّمْعَةِ وَالْعُجُبِ وَالْفَخْرِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ تَجَاوُزِ الْمُلْحِدٖينَ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ شَرِّ الْمُنَافِقٖينَ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ فِتْنَةِ الْفَاسِقٖينَ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا وَاَجِرْ وَالِدَيْنَا وَطَلَبَةَ رَسَائِلِ النُّورِ الصَّادِقٖينَ فٖي خِدْمَةِ الْقُراٰنِ وَالْاٖيمَانِ وَاَحْبَابَنَا الْمُؤْمِنٖينَ الْمُخْلِصٖينَ وَاَقْرِبَائَنَا وَاَجْدَادَنَا مِنَ النَّارِ <span class="cevsen-separator">۞</span></p>
<p class="text-center">Draai je handpalmen naar boven en ga verder met:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِعَفْوِكَ يَا مُجٖيرُ <span class="cevsen-separator">۞</span> بِفَضْلِكَ يَا غَفَّارُ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَدْخِلْنَا الْجَنَّةَ مَعَ الْاَبْرَارِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَدْخِلْنَا الْجَنَّةَ مَعَ الْاَبْرَارِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَدْخِلْنَا وَاَدْخِلْ اُسْتَاذَنَا سَعٖيدَ النُّورْسٖى ( رَضِيَ اللّٰهُ عَنْهُ ) وَوَالِدَيْنَا وَطَلَبَةَ رَسَائِلِ النُّورِ الصَّادِقٖينَ وَاِخْوَانَنَا وَاَخَوَاتِنَا وَاَقْرِبَائَنَا وَاَجْدَادَنَا وَاَحْبَابَنَا الْمُؤْمِنٖينَ الْمُخْلِصٖينَ فٖي خِدْمَةِ الْاٖيمَانِ وَالْقُرْاٰنِ اَلْجَنَّةَ مَعَ الْاَبْرَارِ صَلِّ عَلٰى نَبِيِّكَ الْمُخْتَارِ وَاٰلِهِ الْاَطْهَارِ وَاَصْحَابِهِ الْاَخْيَارِ وَسَلِّمْ مَا دَامَ الَّيْلُ وَالنَّهَارُ اٰمٖينَ وَالْحَمْدُ لِلّٰهِ رَبِّ الْعَالَمٖينَ <span class="cevsen-separator">۞</span></p>
<p class="text-center">Spreek vervolgens zegeningen uit over de Profeet en reciteer deze smeekbede:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَ اللّٰهِ وَالْحَمْدُ لِلّٰهِ وَلَٓا اِلٰهَ اِلَّا اللّٰهُ وَاللّٰهُ اَكْبَرُ وَلَا حَوْلَ وَلَا قُوَّةَ اِلَّا بِاللّٰهِ الْعَلِيِّ الْعَظٖيمِ</p>
<p class="text-center">Reciteer Ayat al-Kursi (het Troonvers, soera Al-Baqara, vers 255):</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحٖيمِ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُ لَٓا اِلٰهَ اِلَّا هُوَ<span class="arabic-waqf">ۚ</span> اَلْحَيُّ الْقَيُّومُ<span class="arabic-waqf">ۚ</span> لَا تَأْخُذُهُ سِنَةٌ وَلَا نَوْمٌ<span class="arabic-waqf">ۜ</span> لَهُ مَا فِي السَّمٰوَاتِ وَمَا فِي الْاَرْضِ<span class="arabic-waqf">ۜ</span> مَنْ ذَا الَّذٖي يَشْفَعُ عِنْدَهُٓ اِلَّا بِاِذْنِهٖ<span class="arabic-waqf">ۜ</span> يَعْلَمُ مَا بَيْنَ اَيْدٖيهِمْ وَمَا خَلْفَهُمْ<span class="arabic-waqf">ۚ</span> وَلَا يُحٖيطُونَ بِشَيْءٍ مِنْ عِلْمِهٖٓ اِلَّا بِمَا شَٓاءَ<span class="arabic-waqf">ۚ</span> وَسِعَ كُرْسِيُّهُ السَّمٰوَاتِ وَالْاَرْضَ<span class="arabic-waqf">ۚ</span> وَلَا يَ<span class="arabic-madd-below">ؤُ</span>دُهُ حِفْظُهُمَا<span class="arabic-waqf">ۚ</span> وَهُوَ الْعَلِيُّ الْعَظٖيمُ <span class="cevsen-verse-number">۝٢٥٥</span></p>
<p class="text-center">Zeg daarna:</p>
<p class="text-center">33 keer: <span class="text-arabic" dir="rtl" lang="ar">سُبْحَانَ اللّٰهِ</span></p>
<p class="text-center">33 keer: <span class="text-arabic" dir="rtl" lang="ar">اَلْحَمْدُ لِلّٰهِ</span></p>
<p class="text-center">33 keer: <span class="text-arabic" dir="rtl" lang="ar">اَللّٰهُ اَكْبَرُ</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">لَٓا اِلٰهَ اِلَّا اللّٰهُ وَحْدَهُ لَا شَرٖيكَ لَهُ، لَهُ الْمُلْكُ وَلَهُ الْحَمْدُ يُحْيٖ وَيُمٖيتُ وَهُوَ حَيٌّ لَا يَمُوتُ بِيَدِهِ الْخَيْرُ وَهُوَ عَلٰى كُلِّ شَيْءٍ قَدٖيرٌ <span class="cevsen-separator">۞</span></p>
<p class="text-center">Verricht hierna een persoonlijke smeekbede. Zeg daarna eenmaal <span class="text-arabic" dir="rtl" lang="ar">فَاعْلَمْ اَنَّهُ</span> en ga verder met de geloofsgetuigenis van Gods eenheid.</p>
<p class="text-center">33 keer: <span class="text-arabic" dir="rtl" lang="ar">لَٓا اِلٰهَ اِلَّا اللّٰهُ</span> Sluit daarna af met: <span class="text-arabic" dir="rtl" lang="ar">مُحَمَّدٌ رَسُولُ اللّٰهِ صَلَّى اللّٰهُ تَعَالٰى عَلَيْهِ وَسَلَّمَ</span></p>
<p class="text-center">Alleen bij de tesbihat van het ochtendgebed reciteer je tienmaal:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">لَٓا اِلٰهَ اِلَّا اللّٰهُ الْمَلِكُ الْحَقُّ الْمُبٖينُ مُحَمَّدٌ رَسُولُ اللّٰهِ صَادِقُ الْوَعْدِ الْاَمٖينُ</p>
<p class="text-center">Ga vervolgens verder met de tesbihat:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحٖيمِ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اِنَّ اللّٰهَ وَمَلٰٓئِكَتَهُ يُصَلُّونَ عَلَى النَّبِيِّ<span class="arabic-waqf">ۜ</span> يَٓا اَيُّهَا الَّذٖينَ اٰمَنُوا صَلُّوا عَلَيْهِ وَسَلِّمُوا تَسْلٖيمًا <span class="cevsen-separator">۞</span> لَبَّيْكَ‥</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِ سَيِّدِنَا مُحَمَّدٍ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِعَدَدِ كُلِّ دَاءٍ وَدَوَاءٍ وَبَارِكْ وَسَلِّمْ عَلَيْهِ وَعَلَيْهِمْ كَثٖيرًا <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِ سَيِّدِنَا مُحَمَّدٍ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِعَدَدِ كُلِّ دَاءٍ وَدَوَاءٍ وَبَارِكْ وَسَلِّمْ عَلَيْهِ وَعَلَيْهِمْ كَثٖيرًا <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِ سَيِّدِنَا مُحَمَّدٍ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِعَدَدِ كُلِّ دَاءٍ وَدَوَاءٍ وَبَارِكْ وَسَلِّمْ عَلَيْهِ وَعَلَيْهِمْ كَثٖيرًا كَثٖيرًا <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">صَلِّ وَسَلِّمْ يَا رَبِّ عَلٰى حَبٖيبِكَ مُحَمَّدٍ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">وَعَلٰى جَمٖيعِ الْاَنْبِيَاءِ وَالْمُرْسَلٖينَ وَعَلٰى اٰلِ كُلٍّ وَصَحْبِ كُلٍّ اَجْمَعٖينَ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اٰمٖينَ وَالْحَمْدُ لِلّٰهِ رَبِّ الْعَالَمٖينَ <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَلْفُ اَلْفِ صَلَاةٍ وَاَلْفُ اَلْفِ سَلَامٍ عَلَيْكَ يَا رَسُولَ اللّٰهِ <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَلْفُ اَلْفِ صَلَاةٍ وَاَلْفُ اَلْفِ سَلَامٍ عَلَيْكَ يَا حَبٖيبَ اللّٰهِ <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَلْفُ اَلْفِ صَلَاةٍ وَاَلْفُ اَلْفِ سَلَامٍ عَلَيْكَ يَا اَمٖينَ وَحْيِ اللّٰهِ <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ وَسَلِّمْ وَبَارِكْ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِهٖ وَاَصْحَابِهٖ بِعَدَدِ اَوْرَاقِ الْاَشْجَارِ وَاَمْوَاجِ الْبِحَارِ وَقَطَرَاتِ الْاَمْطَارِ وَاغْفِرْلَنَا وَارْحَمْنَا وَالْطُفْ بِنَا وَبِاُسْتَاذِنَا سَعٖيدِ النُّورْسٖى ( رَضِيَ اللّٰهُ عَنْهُ ) وَوَالِدَيْنَا وَبِطَلَبَةِ رَسَائِلِ النُّورِ الصَّادِقٖينَ يَا اِلٰهَنَا بِكُلِّ صَلَاةٍ مِنْهَا اَشْهَدُ اَنْ لَٓا اِلٰهَ اِلَّا اللّٰهُ وَاَشْهَدُ اَنَّ مُحَمَّدًا رَسُولُ اللّٰهِ صَلَّى اللّٰهُ تَعَالٰى عَلَيْهِ وَسَلَّمَ <span class="cevsen-separator">۞</span></p>
<hr class="hr-tesbihat">
<p class="text-center">Reciteer de smeekbede Tercüman-ı İsm-i A’zâm:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحٖيمِ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا اَللّٰهُ تَعَالَيْتَ يَا رَحْمٰنُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝١</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا رَحٖيمُ تَعَالَيْتَ يَا كَرٖيمُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٢</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا حَمٖيدُ تَعَالَيْتَ يَا حَكٖيمُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٣</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا مَجٖيدُ تَعَالَيْتَ يَا مَلِكُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٤</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا قُدُّوسُ تَعَالَيْتَ يَا سَلَامُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٥</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا مُؤْمِنُ تَعَالَيْتَ يَا مُهَيْمِنُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٦</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا عَزٖيزُ تَعَالَيْتَ يَا جَبَّارُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٧</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا مُتَكَبِّرُ تَعَالَيْتَ يَا خَالِقُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٨</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا اَوَّلُ تَعَالَيْتَ يَا اٰخِرُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٩</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا ظَاهِرُ تَعَالَيْتَ يَا بَاطِنُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝١٠</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا بَارِئُ تَعَالَيْتَ يَا مُصَوِّرُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝١١</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا تَوَّابُ تَعَالَيْتَ يَا وَهَّابُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝١٢</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا بَاعِثُ تَعَالَيْتَ يَا وَارِثُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝١٣</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا قَدٖيمُ تَعَالَيْتَ يَا مُقٖيمُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝١٤</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا فَرْدُ تَعَالَيْتَ يَا وِتْرُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝١٥</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا نُورُ تَعَالَيْتَ يَا سَتَّارُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝١٦</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا جَلٖيلُ تَعَالَيْتَ يَا جَمٖيلُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝١٧</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا قَاهِرُ تَعَالَيْتَ يَا قَادِرُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝١٨</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا مَلٖيكُ تَعَالَيْتَ يَا مُقْتَدِرُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝١٩</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا عَلٖيمُ تَعَالَيْتَ يَا عَلَّامُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٢٠</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا عَظٖيمُ تَعَالَيْتَ يَا غَفُورُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٢١</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا حَلٖيمُ تَعَالَيْتَ يَا وَدُودُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٢٢</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا شَهٖيدُ تَعَالَيْتَ يَا شَاهِدُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٢٣</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا كَبٖيرُ تَعَالَيْتَ يَا مُتَعَالُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٢٤</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا نُورُ تَعَالَيْتَ يَا لَطٖيفُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٢٥</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا سَمٖيعُ تَعَالَيْتَ يَا كَفٖيلُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٢٦</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا قَرٖيبُ تَعَالَيْتَ يَا بَصٖيرُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٢٧</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا حَقُّ تَعَالَيْتَ يَا مُبٖينُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٢٨</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا رَؤُ۫فٌ تَعَالَيْتَ يَا رَحٖيمُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٢٩</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا طَاهِرُ تَعَالَيْتَ يَا مُطَهِّرُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٣٠</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا مُجَمِّلُ تَعَالَيْتَ يَا مُفَضِّلُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٣١</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا مُظْهِرُ تَعَالَيْتَ يَا مُنْعِمُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٣٢</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا دَيَّانُ تَعَالَيْتَ يَا سُلْطَانُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٣٣</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا حَنَّانُ تَعَالَيْتَ يَا مَنَّانُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٣٤</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَٓا اَحَدُ تَعَالَيْتَ يَا صَمَدُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٣٥</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا حَيُّ تَعَالَيْتَ يَا قَيُّومُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٣٦</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا عَدْلُ تَعَالَيْتَ يَا حَكَمُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٣٧</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا فَرْدُ تَعَالَيْتَ يَا قُدُّوسُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٣٨</span></p>
<p class="text-center">Open je handen met de handpalmen naar boven en reciteer:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ اٰهِيًّا شَرَاهِيًّا تَعَالَيْتَ لَا اِلٰهَ اِلَّا اَنْتَ اَجِرْنَا وَاَجِرْ اُسْتَاذَنَا سَعٖيدَ النُّورْسٖى ( رَضِيَ اللّٰهُ عَنْهُ ) وَوَالِدَيْنَا وَاِخْوَانَنَا وَاَخَوَاتِنَا وَطَلَبَةَ رَسَائِلِ النُّورِ وَرُفَقَائَنَا وَاَقْرِبَائَنَا وَاَحْبَابَنَا الْمُخْلِصٖينَ مِنَ النَّارِ</p>
<p class="text-center">Draai je handpalmen naar beneden en ga verder met:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">وَمِنْ كُلِّ نَارٍ وَاحْفَظْنَا مِنْ شَرِّ النَّفْسِ وَالشَّيْطَانِ وَمِنْ شَرِّ الْجِنِّ وَالْاِنْسَانِ وَمِنْ شَرِّ الْبِدْعَةِ وَالضَّلَالَاتِ وَالْاِلْحَادِ وَالطُّغْيَانِ <span class="cevsen-separator">۞</span></p>
<p class="text-center">Draai je handpalmen weer naar boven en sluit de smeekbede als volgt af:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِعَفْوِكَ يَا مُجٖيرُ <span class="cevsen-separator">۞</span> بِفَضْلِكَ يَا غَفَّارُ بِرَحْمَتِكَ يَا اَرْحَمَ الرَّاحِمٖينَ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَدْخِلْنَا الْجَنَّةَ مَعَ الْاَبْرَارِ بِشَفَاعَةِ نَبِيِّكَ الْمُخْتَارِ اٰمٖينَ وَالْحَمْدُ لِلّٰهِ رَبِّ الْعَالَمٖينَ <span class="cevsen-separator">۞</span></p>
<hr class="hr-tesbihat">
<p class="text-center">Reciteer de verzen 20 tot en met 24 van soera Al-Hashr:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحٖيمِ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">لَا يَسْتَوٖٓي اَصْحَابُ النَّارِ وَاَصْحَابُ الْجَنَّةِ<span class="arabic-waqf">ۜ</span> اَصْحَابُ الْجَنَّةِ هُمُ الْفَٓائِزُونَ <span class="cevsen-verse-number">۝٢٠</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">لَوْ اَنْزَلْنَا هٰذَا الْقُرْاٰنَ عَلٰى جَبَلٍ لَرَاَيْتَهُ خَاشِعًا مُتَصَدِّعًا مِنْ خَشْيَةِ اللّٰهِ<span class="arabic-waqf">ۜ</span> وَتِلْكَ الْاَمْثَالُ نَضْرِبُهَا لِلنَّاسِ لَعَلَّهُمْ يَتَفَكَّرُونَ <span class="cevsen-verse-number">۝٢١</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">هُوَ اللّٰهُ الَّذٖي لَٓا اِلٰهَ اِلَّا هُوَ<span class="arabic-waqf">ۚ</span> عَالِمُ الْغَيْبِ وَالشَّهَادَةِ<span class="arabic-waqf">ۚ</span> هُوَ الرَّحْمٰنُ الرَّحٖيمُ <span class="cevsen-verse-number">۝٢٢</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">هُوَ اللّٰهُ الَّذٖي لَٓا اِلٰهَ اِلَّا هُوَ<span class="arabic-waqf">ۚ</span> اَلْمَلِكُ الْقُدُّوسُ السَّلَامُ الْمُؤْمِنُ الْمُهَيْمِنُ الْعَزٖيزُ الْجَبَّارُ الْمُتَكَبِّرُ<span class="arabic-waqf">ۜ</span> سُبْحَانَ اللّٰهِ عَمَّا يُشْرِكُونَ <span class="cevsen-verse-number">۝٢٣</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">هُوَ اللّٰهُ الْخَالِقُ الْبَارِئُ الْمُصَوِّرُ لَهُ الْاَسْمَٓاءُ الْحُسْنٰى<span class="arabic-waqf">ۜ</span> يُسَبِّحُ لَهُ مَا فِي السَّمٰوَاتِ وَالْاَرْضِ<span class="arabic-waqf">ۚ</span> وَهُوَ الْعَزٖيزُ الْحَكٖيمُ <span class="cevsen-verse-number">۝٢٤</span></p>
</div>
TESBIHAT_PAGE_001,
            ],
            [
                'page_number' => 2,
                'content' => <<<'TESBIHAT_PAGE_002'
<div class="page" id="2">
<p class="text-end page-number">#2</p>
<p class="text-center"><strong>Dhuhr – Middaggebed</strong></p>

<p class="text-center">Na het verplichte deel van het middaggebed en de afsluitende vredesgroet zeg je:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ اَنْتَ السَّلَامُ وَمِنْكَ السَّلَامُ تَبَارَكْتَ يَاذَا الْجَلَالِ وَالْاِكْرَامِ</p>
<p class="text-center">Hef daarna je handen op met de handpalmen naar boven en reciteer de smeekbede Salâtan Tunjînâ:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِ سَيِّدِنَا مُحَمَّدٍ صَلَاةً تُنْجٖينَا بِهَا مِنْ جَمٖيعِ الْاَهْوَالِ وَالْاٰفَاتِ وَتَقْضٖي لَنَا بِهَا جَمٖيعَ الْحَاجَاتِ وَتُطَهِّرُنَا بِهَا مِنْ جَمٖيعِ السَّيِّئَاتِ وَتَرْفَعُنَا بِهَا عِنْدَكَ اَعْلَى الدَّرَجَاتِ وَتُبَلِّغُنَا بِهَا اَقْصَى الْغَايَاتِ مِنْ جَمٖيعِ الْخَيْرَاتِ فِي الْحَيَاةِ وَبَعْدَ الْمَمَاتِ اٰمٖينَ يَامُجٖيبَ الدَّعَوَاتِ وَالْحَمْدُ لِلّٰهِ رَبِّ الْعَالَمٖينَ <span class="cevsen-separator">۞</span></p>
<p class="text-center">Verricht daarna het afsluitende soennagebed van het middaggebed. Spreek vervolgens zegeningen uit over de Profeet en reciteer deze smeekbede:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَ اللّٰهِ وَالْحَمْدُ لِلّٰهِ وَلَٓا اِلٰهَ اِلَّا اللّٰهُ وَاللّٰهُ اَكْبَرُ وَلَا حَوْلَ وَلَا قُوَّةَ اِلَّا بِاللّٰهِ الْعَلِيِّ الْعَظٖيمِ</p>
<p class="text-center">Reciteer Ayat al-Kursi (het Troonvers, soera Al-Baqara, vers 255):</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحٖيمِ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُ لَٓا اِلٰهَ اِلَّا هُوَ<span class="arabic-waqf">ۚ</span> اَلْحَيُّ الْقَيُّومُ<span class="arabic-waqf">ۚ</span> لَا تَأْخُذُهُ سِنَةٌ وَلَا نَوْمٌ<span class="arabic-waqf">ۜ</span> لَهُ مَا فِي السَّمٰوَاتِ وَمَا فِي الْاَرْضِ<span class="arabic-waqf">ۜ</span> مَنْ ذَا الَّذٖي يَشْفَعُ عِنْدَهُٓ اِلَّا بِاِذْنِهٖ<span class="arabic-waqf">ۜ</span> يَعْلَمُ مَا بَيْنَ اَيْدٖيهِمْ وَمَا خَلْفَهُمْ<span class="arabic-waqf">ۚ</span> وَلَا يُحٖيطُونَ بِشَيْءٍ مِنْ عِلْمِهٖٓ اِلَّا بِمَا شَٓاءَ<span class="arabic-waqf">ۚ</span> وَسِعَ كُرْسِيُّهُ السَّمٰوَاتِ وَالْاَرْضَ<span class="arabic-waqf">ۚ</span> وَلَا يَ<span class="arabic-madd-below">ؤُ</span>دُهُ حِفْظُهُمَا<span class="arabic-waqf">ۚ</span> وَهُوَ الْعَلِيُّ الْعَظٖيمُ <span class="cevsen-verse-number">۝٢٥٥</span></p>
<p class="text-center">Zeg daarna:</p>
<p class="text-center">33 keer: <span class="text-arabic" dir="rtl" lang="ar">سُبْحَانَ اللّٰهِ</span></p>
<p class="text-center">33 keer: <span class="text-arabic" dir="rtl" lang="ar">اَلْحَمْدُ لِلّٰهِ</span></p>
<p class="text-center">33 keer: <span class="text-arabic" dir="rtl" lang="ar">اَللّٰهُ اَكْبَرُ</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">لَٓا اِلٰهَ اِلَّا اللّٰهُ وَحْدَهُ لَا شَرٖيكَ لَهُ، لَهُ الْمُلْكُ وَلَهُ الْحَمْدُ يُحْيٖ وَيُمٖيتُ وَهُوَ حَيٌّ لَا يَمُوتُ بِيَدِهِ الْخَيْرُ وَهُوَ عَلٰى كُلِّ شَيْءٍ قَدٖيرٌ <span class="cevsen-separator">۞</span></p>
<p class="text-center">Verricht hierna een persoonlijke smeekbede. Zeg daarna eenmaal <span class="text-arabic" dir="rtl" lang="ar">فَاعْلَمْ اَنَّهُ</span> en ga verder met de geloofsgetuigenis van Gods eenheid.</p>
<p class="text-center">33 keer: <span class="text-arabic" dir="rtl" lang="ar">لَٓا اِلٰهَ اِلَّا اللّٰهُ</span> Sluit daarna af met: <span class="text-arabic" dir="rtl" lang="ar">مُحَمَّدٌ رَسُولُ اللّٰهِ صَلَّى اللّٰهُ تَعَالٰى عَلَيْهِ وَسَلَّمَ</span> Ga vervolgens verder met de tesbihat:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحٖيمِ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اِنَّ اللّٰهَ وَمَلٰٓئِكَتَهُ يُصَلُّونَ عَلَى النَّبِيِّ<span class="arabic-waqf">ۜ</span> يَٓا اَيُّهَا الَّذٖينَ اٰمَنُوا صَلُّوا عَلَيْهِ وَسَلِّمُوا تَسْلٖيمًا <span class="cevsen-separator">۞</span> لَبَّيْكَ‥</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِ سَيِّدِنَا مُحَمَّدٍ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِعَدَدِ كُلِّ دَاءٍ وَدَوَاءٍ وَبَارِكْ وَسَلِّمْ عَلَيْهِ وَعَلَيْهِمْ كَثٖيرًا <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِ سَيِّدِنَا مُحَمَّدٍ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِعَدَدِ كُلِّ دَاءٍ وَدَوَاءٍ وَبَارِكْ وَسَلِّمْ عَلَيْهِ وَعَلَيْهِمْ كَثٖيرًا <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِ سَيِّدِنَا مُحَمَّدٍ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِعَدَدِ كُلِّ دَاءٍ وَدَوَاءٍ وَبَارِكْ وَسَلِّمْ عَلَيْهِ وَعَلَيْهِمْ كَثٖيرًا كَثٖيرًا <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">صَلِّ وَسَلِّمْ يَا رَبِّ عَلٰى حَبٖيبِكَ مُحَمَّدٍ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">وَعَلٰى جَمٖيعِ الْاَنْبِيَاءِ وَالْمُرْسَلٖينَ وَعَلٰى اٰلِ كُلٍّ وَصَحْبِ كُلٍّ اَجْمَعٖينَ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اٰمٖينَ وَالْحَمْدُ لِلّٰهِ رَبِّ الْعَالَمٖينَ <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَلْفُ اَلْفِ صَلَاةٍ وَاَلْفُ اَلْفِ سَلَامٍ عَلَيْكَ يَا رَسُولَ اللّٰهِ <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَلْفُ اَلْفِ صَلَاةٍ وَاَلْفُ اَلْفِ سَلَامٍ عَلَيْكَ يَا حَبٖيبَ اللّٰهِ <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَلْفُ اَلْفِ صَلَاةٍ وَاَلْفُ اَلْفِ سَلَامٍ عَلَيْكَ يَا اَمٖينَ وَحْيِ اللّٰهِ <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ وَسَلِّمْ وَبَارِكْ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِهٖ وَاَصْحَابِهٖ بِعَدَدِ اَوْرَاقِ الْاَشْجَارِ وَاَمْوَاجِ الْبِحَارِ وَقَطَرَاتِ الْاَمْطَارِ وَاغْفِرْلَنَا وَارْحَمْنَا وَالْطُفْ بِنَا وَبِاُسْتَاذِنَا سَعٖيدِ النُّورْسٖى ( رَضِيَ اللّٰهُ عَنْهُ ) وَوَالِدَيْنَا وَبِطَلَبَةِ رَسَائِلِ النُّورِ الصَّادِقٖينَ يَا اِلٰهَنَا بِكُلِّ صَلَاةٍ مِنْهَا اَشْهَدُ اَنْ لَٓا اِلٰهَ اِلَّا اللّٰهُ وَاَشْهَدُ اَنَّ مُحَمَّدًا رَسُولُ اللّٰهِ صَلَّى اللّٰهُ تَعَالٰى عَلَيْهِ وَسَلَّمَ <span class="cevsen-separator">۞</span></p>
<hr class="hr-tesbihat">
<p class="text-center">Reciteer de smeekbede İsm-i A’zâm:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحٖيمِ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا جَمٖيلُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١</span> يَا قَرٖيبُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مُجٖيبُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣</span> يَا حَبٖيبُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٤</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا رَؤُ۫فٌ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٥</span> يَا عَطُوفُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٦</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَعْرُوفُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٧</span> يَا لَطٖيفُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٨</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا عَظٖيمُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٩</span> يَا حَنَّانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٠</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنَّانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١١</span> يَا دَيَّانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٢</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا سُبْحَانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٣</span> يَا اَمَانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٤</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا بُرْهَانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٥</span> يَا سُلْطَانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٦</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مُسْتَعَانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٧</span> يَا مُحْسِنُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٨</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مُتَعَالُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٩</span> يَا رَحْمٰنُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٠</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا رَحٖيمُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢١</span> يَا كَرٖيمُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٢</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَجٖيدُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٣</span> يَا فَرْدُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٤</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا وِتْرُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٥</span> يَا اَحَدُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٦</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا صَمَدُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٧</span> يَا مَحْمُودُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٨</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا صَادِقَ الْوَعْدِ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٩</span> يَا عَلِيُّ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٠</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا غَنِيُّ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣١</span> يَا شَافِى يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٢</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا كَافِى يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٣</span> يَا مُعَافِى يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٤</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا بَاقٖي يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٥</span> يَا هَادٖي يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٦</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا قَادِرُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٧</span> يَا سَاتِرُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٨</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا قَهَّارُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٩</span> يَا جَبَّارُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٤٠</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا غَفَّارُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٤١</span> يَا فَتَّاحُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٤٢</span></p>
<p class="text-center">Open je handen met de handpalmen naar boven en reciteer:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا رَبَّ السَّمٰوَاتِ وَالْاَرْضِ <span class="cevsen-separator">۞</span> يَا ذَا الْجَلَالِ وَالْاِكْرَامِ <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَسْئَلُكَ بِحَقِّ هٰذِهِ الْاَسْمَاءِ كُلِّهَا اَنْ تُصَلِّيَ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِ مُحَمَّدٍ وَارْحَمْ مُحَمَّدًا كَمَا صَلَّيْتَ وَسَلَّمْتَ وَبَارَكْتَ وَرَحِمْتَ وَتَرَحَّمْتَ عَلٰى اِبْرَاهٖيمَ وَعَلٰى اٰلِ اِبْرَاهٖيمَ فِي الْعَالَمٖينَ رَبَّنَا اِنَّكَ حَمٖيدٌ مَجٖيدٌ بِرَحْمَتِكَ يَا اَرْحَمَ الرَّاحِمٖينَ وَالْحَمْدُ لِلّٰهِ رَبِّ الْعَالَمٖينَ <span class="cevsen-separator">۞</span></p>
<hr class="hr-tesbihat">
<p class="text-center">Reciteer de verzen 27 tot en met 29 van soera Al-Fath:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحٖيمِ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">لَقَدْ صَدَقَ اللّٰهُ رَسُولَهُ الرُّءْيَا بِالْحَقِّ<span class="arabic-waqf">ۚ</span> لَتَدْخُلُنَّ الْمَسْجِدَ الْحَرَامَ اِنْ شَٓاءَ اللّٰهُ اٰمِنٖينَ<span class="arabic-waqf">ۙ</span> مُحَلِّقٖينَ رُؤُ۫سَكُمْ وَمُقَصِّرٖينَ<span class="arabic-waqf">ۙ</span> لَا تَخَافُونَ<span class="arabic-waqf">ۜ</span> فَعَلِمَ مَا لَمْ تَعْلَمُوا فَجَعَلَ مِنْ دُونِ ذٰلِكَ فَتْحًا قَرٖيبًا <span class="cevsen-verse-number">۝٢٧</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">هُوَ الَّذٖٓي اَرْسَلَ رَسُولَهُ بِالْهُدٰى وَدٖينِ الْحَقِّ لِيُظْهِرَهُ عَلَى الدّٖينِ كُلِّهٖ<span class="arabic-waqf">ۜ</span> وَكَفٰى بِاللّٰهِ شَهٖيدًا<span class="arabic-waqf">ۜ</span> <span class="cevsen-verse-number">۝٢٨</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">مُحَمَّدٌ رَسُولُ اللّٰهِ<span class="arabic-waqf">ۜ</span> وَالَّذٖينَ مَعَهُٓ اَشِدَّٓاءُ عَلَى الْكُفَّارِ رُحَمَٓاءُ بَيْنَهُمْ تَرٰيهُمْ رُكَّعًا سُجَّدًا يَبْتَغُونَ فَضْلًا مِنَ اللّٰهِ وَرِضْوَانًا<span class="arabic-waqf">ۘ</span> سٖيمَاهُمْ فٖي وُجُوهِهِمْ مِنْ اَثَرِ السُّجُودِ<span class="arabic-waqf">ۜ</span> ذٰلِكَ مَثَلُهُمْ فِي التَّوْرٰيةِ<span class="arabic-waqf">ۚۛ</span> وَمَثَلُهُمْ فِي الْاِنْجٖيلِ<span class="arabic-waqf">ࣞۛ</span> كَزَرْعٍ اَخْرَجَ شَطَْٔهُ۫ فَاٰزَرَهُ فَاسْتَغْلَظَ فَاسْتَوٰى عَلٰى سُوقِهٖ يُعْجِبُ الزُّرَّاعَ لِيَغٖيظَ بِهِمُ الْكُفَّارَ<span class="arabic-waqf">ۜ</span> وَعَدَ اللّٰهُ الَّذٖينَ اٰمَنُوا وَعَمِلُوا الصَّالِحَاتِ مِنْهُمْ مَغْفِرَةً وَاَجْرًا عَظٖيمًا <span class="cevsen-verse-number">۝٢٩</span></p>
</div>
TESBIHAT_PAGE_002,
            ],
            [
                'page_number' => 3,
                'content' => <<<'TESBIHAT_PAGE_003'
<div class="page" id="3">
<p class="text-end page-number">#3</p>
<p class="text-center"><strong>Asr – Namiddaggebed</strong></p>

<p class="text-center">Na het verplichte deel van het namiddaggebed en de afsluitende vredesgroet zeg je:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ اَنْتَ السَّلَامُ وَمِنْكَ السَّلَامُ تَبَارَكْتَ يَاذَا الْجَلَالِ وَالْاِكْرَامِ</p>
<p class="text-center">Hef daarna je handen op met de handpalmen naar boven en reciteer de smeekbede Salâtan Tunjînâ:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِ سَيِّدِنَا مُحَمَّدٍ صَلَاةً تُنْجٖينَا بِهَا مِنْ جَمٖيعِ الْاَهْوَالِ وَالْاٰفَاتِ وَتَقْضٖي لَنَا بِهَا جَمٖيعَ الْحَاجَاتِ وَتُطَهِّرُنَا بِهَا مِنْ جَمٖيعِ السَّيِّئَاتِ وَتَرْفَعُنَا بِهَا عِنْدَكَ اَعْلَى الدَّرَجَاتِ وَتُبَلِّغُنَا بِهَا اَقْصَى الْغَايَاتِ مِنْ جَمٖيعِ الْخَيْرَاتِ فِي الْحَيَاةِ وَبَعْدَ الْمَمَاتِ اٰمٖينَ يَامُجٖيبَ الدَّعَوَاتِ وَالْحَمْدُ لِلّٰهِ رَبِّ الْعَالَمٖينَ <span class="cevsen-separator">۞</span></p>
<p class="text-center">Spreek zegeningen uit over de Profeet en reciteer deze smeekbede:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَ اللّٰهِ وَالْحَمْدُ لِلّٰهِ وَلَٓا اِلٰهَ اِلَّا اللّٰهُ وَاللّٰهُ اَكْبَرُ وَلَا حَوْلَ وَلَا قُوَّةَ اِلَّا بِاللّٰهِ الْعَلِيِّ الْعَظٖيمِ</p>
<p class="text-center">Reciteer Ayat al-Kursi (het Troonvers, soera Al-Baqara, vers 255):</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحٖيمِ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُ لَٓا اِلٰهَ اِلَّا هُوَ<span class="arabic-waqf">ۚ</span> اَلْحَيُّ الْقَيُّومُ<span class="arabic-waqf">ۚ</span> لَا تَأْخُذُهُ سِنَةٌ وَلَا نَوْمٌ<span class="arabic-waqf">ۜ</span> لَهُ مَا فِي السَّمٰوَاتِ وَمَا فِي الْاَرْضِ<span class="arabic-waqf">ۜ</span> مَنْ ذَا الَّذٖي يَشْفَعُ عِنْدَهُٓ اِلَّا بِاِذْنِهٖ<span class="arabic-waqf">ۜ</span> يَعْلَمُ مَا بَيْنَ اَيْدٖيهِمْ وَمَا خَلْفَهُمْ<span class="arabic-waqf">ۚ</span> وَلَا يُحٖيطُونَ بِشَيْءٍ مِنْ عِلْمِهٖٓ اِلَّا بِمَا شَٓاءَ<span class="arabic-waqf">ۚ</span> وَسِعَ كُرْسِيُّهُ السَّمٰوَاتِ وَالْاَرْضَ<span class="arabic-waqf">ۚ</span> وَلَا يَ<span class="arabic-madd-below">ؤُ</span>دُهُ حِفْظُهُمَا<span class="arabic-waqf">ۚ</span> وَهُوَ الْعَلِيُّ الْعَظٖيمُ <span class="cevsen-verse-number">۝٢٥٥</span></p>
<p class="text-center">Zeg daarna:</p>
<p class="text-center">33 keer: <span class="text-arabic" dir="rtl" lang="ar">سُبْحَانَ اللّٰهِ</span></p>
<p class="text-center">33 keer: <span class="text-arabic" dir="rtl" lang="ar">اَلْحَمْدُ لِلّٰهِ</span></p>
<p class="text-center">33 keer: <span class="text-arabic" dir="rtl" lang="ar">اَللّٰهُ اَكْبَرُ</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">لَٓا اِلٰهَ اِلَّا اللّٰهُ وَحْدَهُ لَا شَرٖيكَ لَهُ، لَهُ الْمُلْكُ وَلَهُ الْحَمْدُ يُحْيٖ وَيُمٖيتُ وَهُوَ حَيٌّ لَا يَمُوتُ بِيَدِهِ الْخَيْرُ وَهُوَ عَلٰى كُلِّ شَيْءٍ قَدٖيرٌ <span class="cevsen-separator">۞</span></p>
<p class="text-center">Verricht hierna een persoonlijke smeekbede. Zeg daarna eenmaal <span class="text-arabic" dir="rtl" lang="ar">فَاعْلَمْ اَنَّهُ</span> en ga verder met de geloofsgetuigenis van Gods eenheid.</p>
<p class="text-center">33 keer: <span class="text-arabic" dir="rtl" lang="ar">لَٓا اِلٰهَ اِلَّا اللّٰهُ</span> Sluit daarna af met: <span class="text-arabic" dir="rtl" lang="ar">مُحَمَّدٌ رَسُولُ اللّٰهِ صَلَّى اللّٰهُ تَعَالٰى عَلَيْهِ وَسَلَّمَ</span> Ga vervolgens verder met de tesbihat:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحٖيمِ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اِنَّ اللّٰهَ وَمَلٰٓئِكَتَهُ يُصَلُّونَ عَلَى النَّبِيِّ<span class="arabic-waqf">ۜ</span> يَٓا اَيُّهَا الَّذٖينَ اٰمَنُوا صَلُّوا عَلَيْهِ وَسَلِّمُوا تَسْلٖيمًا <span class="cevsen-separator">۞</span> لَبَّيْكَ‥</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِ سَيِّدِنَا مُحَمَّدٍ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِعَدَدِ كُلِّ دَاءٍ وَدَوَاءٍ وَبَارِكْ وَسَلِّمْ عَلَيْهِ وَعَلَيْهِمْ كَثٖيرًا <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِ سَيِّدِنَا مُحَمَّدٍ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِعَدَدِ كُلِّ دَاءٍ وَدَوَاءٍ وَبَارِكْ وَسَلِّمْ عَلَيْهِ وَعَلَيْهِمْ كَثٖيرًا <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِ سَيِّدِنَا مُحَمَّدٍ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِعَدَدِ كُلِّ دَاءٍ وَدَوَاءٍ وَبَارِكْ وَسَلِّمْ عَلَيْهِ وَعَلَيْهِمْ كَثٖيرًا كَثٖيرًا <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">صَلِّ وَسَلِّمْ يَا رَبِّ عَلٰى حَبٖيبِكَ مُحَمَّدٍ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">وَعَلٰى جَمٖيعِ الْاَنْبِيَاءِ وَالْمُرْسَلٖينَ وَعَلٰى اٰلِ كُلٍّ وَصَحْبِ كُلٍّ اَجْمَعٖينَ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اٰمٖينَ وَالْحَمْدُ لِلّٰهِ رَبِّ الْعَالَمٖينَ <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَلْفُ اَلْفِ صَلَاةٍ وَاَلْفُ اَلْفِ سَلَامٍ عَلَيْكَ يَا رَسُولَ اللّٰهِ <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَلْفُ اَلْفِ صَلَاةٍ وَاَلْفُ اَلْفِ سَلَامٍ عَلَيْكَ يَا حَبٖيبَ اللّٰهِ <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَلْفُ اَلْفِ صَلَاةٍ وَاَلْفُ اَلْفِ سَلَامٍ عَلَيْكَ يَا اَمٖينَ وَحْيِ اللّٰهِ <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ وَسَلِّمْ وَبَارِكْ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِهٖ وَاَصْحَابِهٖ بِعَدَدِ اَوْرَاقِ الْاَشْجَارِ وَاَمْوَاجِ الْبِحَارِ وَقَطَرَاتِ الْاَمْطَارِ وَاغْفِرْلَنَا وَارْحَمْنَا وَالْطُفْ بِنَا وَبِاُسْتَاذِنَا سَعٖيدِ النُّورْسٖى ( رَضِيَ اللّٰهُ عَنْهُ ) وَوَالِدَيْنَا وَبِطَلَبَةِ رَسَائِلِ النُّورِ الصَّادِقٖينَ يَا اِلٰهَنَا بِكُلِّ صَلَاةٍ مِنْهَا اَشْهَدُ اَنْ لَٓا اِلٰهَ اِلَّا اللّٰهُ وَاَشْهَدُ اَنَّ مُحَمَّدًا رَسُولُ اللّٰهِ صَلَّى اللّٰهُ تَعَالٰى عَلَيْهِ وَسَلَّمَ <span class="cevsen-separator">۞</span></p>
<hr class="hr-tesbihat">
<p class="text-center">Reciteer de smeekbede Tercüman-ı İsm-i A’zâm:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحٖيمِ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا اَللّٰهُ تَعَالَيْتَ يَا رَحْمٰنُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝١</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا رَحٖيمُ تَعَالَيْتَ يَا كَرٖيمُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٢</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا حَمٖيدُ تَعَالَيْتَ يَا حَكٖيمُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٣</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا مَجٖيدُ تَعَالَيْتَ يَا مَلِكُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٤</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا قُدُّوسُ تَعَالَيْتَ يَا سَلَامُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٥</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا مُؤْمِنُ تَعَالَيْتَ يَا مُهَيْمِنُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٦</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا عَزٖيزُ تَعَالَيْتَ يَا جَبَّارُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٧</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا مُتَكَبِّرُ تَعَالَيْتَ يَا خَالِقُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٨</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا اَوَّلُ تَعَالَيْتَ يَا اٰخِرُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٩</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا ظَاهِرُ تَعَالَيْتَ يَا بَاطِنُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝١٠</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا بَارِئُ تَعَالَيْتَ يَا مُصَوِّرُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝١١</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا تَوَّابُ تَعَالَيْتَ يَا وَهَّابُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝١٢</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا بَاعِثُ تَعَالَيْتَ يَا وَارِثُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝١٣</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا قَدٖيمُ تَعَالَيْتَ يَا مُقٖيمُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝١٤</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا فَرْدُ تَعَالَيْتَ يَا وِتْرُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝١٥</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا نُورُ تَعَالَيْتَ يَا سَتَّارُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝١٦</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا جَلٖيلُ تَعَالَيْتَ يَا جَمٖيلُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝١٧</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا قَاهِرُ تَعَالَيْتَ يَا قَادِرُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝١٨</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا مَلٖيكُ تَعَالَيْتَ يَا مُقْتَدِرُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝١٩</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا عَلٖيمُ تَعَالَيْتَ يَا عَلَّامُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٢٠</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا عَظٖيمُ تَعَالَيْتَ يَا غَفُورُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٢١</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا حَلٖيمُ تَعَالَيْتَ يَا وَدُودُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٢٢</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا شَهٖيدُ تَعَالَيْتَ يَا شَاهِدُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٢٣</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا كَبٖيرُ تَعَالَيْتَ يَا مُتَعَالُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٢٤</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا نُورُ تَعَالَيْتَ يَا لَطٖيفُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٢٥</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا سَمٖيعُ تَعَالَيْتَ يَا كَفٖيلُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٢٦</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا قَرٖيبُ تَعَالَيْتَ يَا بَصٖيرُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٢٧</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا حَقُّ تَعَالَيْتَ يَا مُبٖينُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٢٨</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا رَؤُ۫فٌ تَعَالَيْتَ يَا رَحٖيمُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٢٩</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا طَاهِرُ تَعَالَيْتَ يَا مُطَهِّرُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٣٠</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا مُجَمِّلُ تَعَالَيْتَ يَا مُفَضِّلُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٣١</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا مُظْهِرُ تَعَالَيْتَ يَا مُنْعِمُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٣٢</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا دَيَّانُ تَعَالَيْتَ يَا سُلْطَانُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٣٣</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا حَنَّانُ تَعَالَيْتَ يَا مَنَّانُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٣٤</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَٓا اَحَدُ تَعَالَيْتَ يَا صَمَدُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٣٥</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا حَيُّ تَعَالَيْتَ يَا قَيُّومُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٣٦</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا عَدْلُ تَعَالَيْتَ يَا حَكَمُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٣٧</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ يَا فَرْدُ تَعَالَيْتَ يَا قُدُّوسُ اَجِرْنَا مِنَ النَّارِ بِعَفْوِكَ يَا رَحْمٰنُ <span class="cevsen-verse-number">۝٣٨</span></p>
<p class="text-center">Open je handen met de handpalmen naar boven en reciteer:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَكَ اٰهِيًّا شَرَاهِيًّا تَعَالَيْتَ لَا اِلٰهَ اِلَّا اَنْتَ اَجِرْنَا وَاَجِرْ اُسْتَاذَنَا سَعٖيدَ النُّورْسٖى ( رَضِيَ اللّٰهُ عَنْهُ ) وَوَالِدَيْنَا وَاِخْوَانَنَا وَاَخَوَاتِنَا وَطَلَبَةَ رَسَائِلِ النُّورِ وَرُفَقَائَنَا وَاَقْرِبَائَنَا وَاَحْبَابَنَا الْمُخْلِصٖينَ مِنَ النَّارِ</p>
<p class="text-center">Draai je handpalmen naar beneden en ga verder met:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">وَمِنْ كُلِّ نَارٍ وَاحْفَظْنَا مِنْ شَرِّ النَّفْسِ وَالشَّيْطَانِ وَمِنْ شَرِّ الْجِنِّ وَالْاِنْسَانِ وَمِنْ شَرِّ الْبِدْعَةِ وَالضَّلَالَاتِ وَالْاِلْحَادِ وَالطُّغْيَانِ <span class="cevsen-separator">۞</span></p>
<p class="text-center">Draai je handpalmen weer naar boven en sluit de smeekbede als volgt af:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِعَفْوِكَ يَا مُجٖيرُ <span class="cevsen-separator">۞</span> بِفَضْلِكَ يَا غَفَّارُ بِرَحْمَتِكَ يَا اَرْحَمَ الرَّاحِمٖينَ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَدْخِلْنَا الْجَنَّةَ مَعَ الْاَبْرَارِ بِشَفَاعَةِ نَبِيِّكَ الْمُخْتَارِ اٰمٖينَ وَالْحَمْدُ لِلّٰهِ رَبِّ الْعَالَمٖينَ <span class="cevsen-separator">۞</span></p>
<hr class="hr-tesbihat">
<p class="text-center">Reciteer soera An-Naba:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحٖيمِ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">عَمَّ يَتَسَٓاءَلُونَ<span class="arabic-waqf">ۚ</span> <span class="cevsen-verse-number">۝١</span> عَنِ النَّبَأِ الْعَظٖيمِ<span class="arabic-waqf">ۙ</span> <span class="cevsen-verse-number">۝٢</span> اَلَّذٖي هُمْ فٖيهِ مُخْتَلِفُونَ<span class="arabic-waqf">ۜ</span> <span class="cevsen-verse-number">۝٣</span> كَلَّا سَيَعْلَمُونَ<span class="arabic-waqf">ۙ</span> <span class="cevsen-verse-number">۝٤</span> ثُمَّ كَلَّا سَيَعْلَمُونَ <span class="cevsen-verse-number">۝٥</span> اَلَمْ نَجْعَلِ الْاَرْضَ مِهَادًا<span class="arabic-waqf">ۙ</span> <span class="cevsen-verse-number">۝٦</span> وَالْجِبَالَ اَوْتَادًا<span class="arabic-waqf">ۖ</span> <span class="cevsen-verse-number">۝٧</span> وَخَلَقْنَاكُمْ اَزْوَاجًا<span class="arabic-waqf">ۙ</span> <span class="cevsen-verse-number">۝٨</span> وَجَعَلْنَا نَوْمَكُمْ سُبَاتًا<span class="arabic-waqf">ۙ</span> <span class="cevsen-verse-number">۝٩</span> وَجَعَلْنَا الَّيْلَ لِبَاسًا<span class="arabic-waqf">ۙ</span> <span class="cevsen-verse-number">۝١٠</span> وَجَعَلْنَا النَّهَارَ مَعَاشًا<span class="arabic-waqf">ۖ</span> <span class="cevsen-verse-number">۝١١</span> وَبَنَيْنَا فَوْقَكُمْ سَبْعًا شِدَادًا<span class="arabic-waqf">ۙ</span> <span class="cevsen-verse-number">۝١٢</span> وَجَعَلْنَا سِرَاجًا وَهَّاجًا<span class="arabic-waqf">ۖ</span> <span class="cevsen-verse-number">۝١٣</span> وَاَنْزَلْنَا مِنَ الْمُعْصِرَاتِ مَٓاءً ثَجَّاجًا<span class="arabic-waqf">ۙ</span> <span class="cevsen-verse-number">۝١٤</span> لِنُخْرِجَ بِهٖ حَبًّا وَنَبَاتًا<span class="arabic-waqf">ۙ</span> <span class="cevsen-verse-number">۝١٥</span> وَجَنَّاتٍ اَلْفَافًا<span class="arabic-waqf">ۜ</span> <span class="cevsen-verse-number">۝١٦</span> اِنَّ يَوْمَ الْفَصْلِ كَانَ مٖيقَاتًا<span class="arabic-waqf">ۙ</span> <span class="cevsen-verse-number">۝١٧</span> يَوْمَ يُنْفَخُ فِي الصُّورِ فَتَأْتُونَ اَفْوَاجًا<span class="arabic-waqf">ۙ</span> <span class="cevsen-verse-number">۝١٨</span> وَفُتِحَتِ السَّمَٓاءُ فَكَانَتْ اَبْوَابًا<span class="arabic-waqf">ۙ</span> <span class="cevsen-verse-number">۝١٩</span> وَسُيِّرَتِ الْجِبَالُ فَكَانَتْ سَرَابًا<span class="arabic-waqf">ۜ</span> <span class="cevsen-verse-number">۝٢٠</span> اِنَّ جَهَنَّمَ كَانَتْ مِرْصَادًا<span class="arabic-waqf">ۙ</span> <span class="cevsen-verse-number">۝٢١</span> لِلطَّاغٖينَ مَاٰبًا<span class="arabic-waqf">ۙ</span> <span class="cevsen-verse-number">۝٢٢</span> لَابِثٖينَ فٖيهَٓا اَحْقَابًا<span class="arabic-waqf">ۚ</span> <span class="cevsen-verse-number">۝٢٣</span> لَا يَذُوقُونَ فٖيهَا بَرْدًا وَلَا شَرَابًا<span class="arabic-waqf">ۙ</span> <span class="cevsen-verse-number">۝٢٤</span> اِلَّا حَمٖيمًا وَغَسَّاقًا<span class="arabic-waqf">ۙ</span> <span class="cevsen-verse-number">۝٢٥</span> جَزَٓاءً وِفَاقًا <span class="cevsen-verse-number">۝٢٦</span> اِنَّهُمْ كَانُوا لَا يَرْجُونَ حِسَابًا<span class="arabic-waqf">ۙ</span> <span class="cevsen-verse-number">۝٢٧</span> وَكَذَّبُوا بِاٰيَاتِنَا كِذَّابًا<span class="arabic-waqf">ۜ</span> <span class="cevsen-verse-number">۝٢٨</span> وَكُلَّ شَيْءٍ اَحْصَيْنَاهُ كِتَابًا <span class="cevsen-verse-number">۝٢٩</span> فَذُوقُوا فَلَنْ نَزٖيدَكُمْ اِلَّا عَذَابًا ۟ <span class="cevsen-verse-number">۝٣٠</span> اِنَّ لِلْمُتَّقٖينَ مَفَازًا<span class="arabic-waqf">ۙ</span> <span class="cevsen-verse-number">۝٣١</span> حَدَٓائِقَ وَاَعْنَابًا<span class="arabic-waqf">ۙ</span> <span class="cevsen-verse-number">۝٣٢</span> وَكَوَاعِبَ اَتْرَابًا<span class="arabic-waqf">ۙ</span> <span class="cevsen-verse-number">۝٣٣</span> وَكَأْسًا دِهَاقًا<span class="arabic-waqf">ۜ</span> <span class="cevsen-verse-number">۝٣٤</span> لَا يَسْمَعُونَ فٖيهَا لَغْوًا وَلَا كِذَّابًا<span class="arabic-waqf">ۚ</span> <span class="cevsen-verse-number">۝٣٥</span> جَزَٓاءً مِنْ رَبِّكَ عَطَٓاءً حِسَابًا<span class="arabic-waqf">ۙ</span> <span class="cevsen-verse-number">۝٣٦</span> رَبِّ السَّمٰوَاتِ وَالْاَرْضِ وَمَا بَيْنَهُمَا<span class="arabic-waqf">ۙ</span> الرَّحْمٰنِ لَا يَمْلِكُونَ مِنْهُ خِطَابًا<span class="arabic-waqf">ۙ</span> <span class="cevsen-verse-number">۝٣٧</span> يَوْمَ يَقُومُ الرُّوحُ وَالْمَلٰٓئِكَةُ صَفًّا<span class="arabic-waqf">ۜ</span> لَا يَتَكَلَّمُونَ اِلَّا مَنْ اَذِنَ لَهُ الرَّحْمٰنُ وَقَالَ صَوَابًا <span class="cevsen-verse-number">۝٣٨</span> ذٰلِكَ الْيَوْمُ الْحَقُّ<span class="arabic-waqf">ۚ</span> فَمَنْ شَٓاءَ اتَّخَذَ اِلٰى رَبِّهٖ مَاٰبًا <span class="cevsen-verse-number">۝٣٩</span> اِنَّٓا اَنْذَرْنَاكُمْ عَذَابًا قَرٖيبًا<span class="arabic-waqf">ۚ</span> يَوْمَ يَنْظُرُ الْمَرْءُ مَا قَدَّمَتْ يَدَاهُ وَيَقُولُ الْكَافِرُ يَا لَيْتَنٖي كُنْتُ تُرَابًا <span class="cevsen-verse-number">۝٤٠</span></p>
</div>
TESBIHAT_PAGE_003,
            ],
            [
                'page_number' => 4,
                'content' => <<<'TESBIHAT_PAGE_004'
<div class="page" id="4">
<p class="text-end page-number">#4</p>
<p class="text-center"><strong>Maghrib – Avondgebed</strong></p>

<p class="text-center">Na het verplichte deel van het avondgebed en de afsluitende vredesgroet zeg je:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ اَنْتَ السَّلَامُ وَمِنْكَ السَّلَامُ تَبَارَكْتَ يَاذَا الْجَلَالِ وَالْاِكْرَامِ</p>
<p class="text-center">Hef daarna je handen op met de handpalmen naar boven en reciteer de smeekbede Salâtan Tunjînâ:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِ سَيِّدِنَا مُحَمَّدٍ صَلَاةً تُنْجٖينَا بِهَا مِنْ جَمٖيعِ الْاَهْوَالِ وَالْاٰفَاتِ وَتَقْضٖي لَنَا بِهَا جَمٖيعَ الْحَاجَاتِ وَتُطَهِّرُنَا بِهَا مِنْ جَمٖيعِ السَّيِّئَاتِ وَتَرْفَعُنَا بِهَا عِنْدَكَ اَعْلَى الدَّرَجَاتِ وَتُبَلِّغُنَا بِهَا اَقْصَى الْغَايَاتِ مِنْ جَمٖيعِ الْخَيْرَاتِ فِي الْحَيَاةِ وَبَعْدَ الْمَمَاتِ اٰمٖينَ يَامُجٖيبَ الدَّعَوَاتِ وَالْحَمْدُ لِلّٰهِ رَبِّ الْعَالَمٖينَ <span class="cevsen-separator">۞</span></p>
<p class="text-center">Verricht daarna het afsluitende soennagebed van het avondgebed. Zeg vervolgens eenmaal <span class="text-arabic" dir="rtl" lang="ar">اٰمَنَّا بِاَنَّهُ</span> en reciteer daarna negenmaal:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">لَٓا اِلٰهَ اِلَّا اللّٰهُ وَحْدَهُ لَا شَرٖيكَ لَهُ، لَهُ الْمُلْكُ وَلَهُ الْحَمْدُ يُحْيٖ وَيُمٖيتُ بِيَدِهِ الْخَيْرُ وَهُوَ عَلٰى كُلِّ شَيْءٍ قَدٖيرٌ <span class="cevsen-separator">۞</span></p>
<p class="text-center">Vul de tiende herhaling als volgt aan:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">لَٓا اِلٰهَ اِلَّا اللّٰهُ وَحْدَهُ لَا شَرٖيكَ لَهُ، لَهُ الْمُلْكُ وَلَهُ الْحَمْدُ يُحْيٖ وَيُمٖيتُ وَهُوَ حَيٌّ لَا يَمُوتُ بِيَدِهِ الْخَيْرُ وَهُوَ عَلٰى كُلِّ شَيْءٍ قَدٖيرٌ وَاِلَيْهِ الْمَصٖيرُ <span class="cevsen-separator">۞</span></p>
<p class="text-center">Draai daarna je handpalmen naar beneden en zeg drie-, vijf- of zevenmaal: <span class="text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ اَجِرْنَا مِنَ النَّارِ</span> Ga vervolgens verder met:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ اَجِرْنَا مِنْ كُلِّ نَارٍ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ فِتْنَةِ الدّٖينِيَّةِ وَالدُّنْيَوِيَّةِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ فِتْنَةِ اٰخِرِ الزَّمَانِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ فِتْنَةِ الْمَسٖيحِ الدَّجَّالِ وَالسُّفْيَانِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنَ الضَّلَالَاتِ وَالْبِدْعِيَّاتِ وَالْبَلِيَّاتِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ شَرِّ النَّفْسِ الْاَمَّارَةِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ شُرُورِ النُّفُوسِ الْاَمَّارَاتِ الْفِرْعَوْنِيَّةِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ شَرِّ النِّسَاءِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ بَلَاءِ النِّسَاءِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ فِتْنَةِ النِّسَاءِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ عَذَابِ الْقَبْرِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ عَذَابِ يَوْمِ الْقِيَامَةِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ عَذَابِ جَهَنَّمَ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ عَذَابِ قَهْرِكَ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ نَارِ قَهْرِكَ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ عَذَابِ الْقَبْرِ وَالنّٖيرَانِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنَ الرِّيَاءِ وَالسُّمْعَةِ وَالْعُجُبِ وَالْفَخْرِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ تَجَاوُزِ الْمُلْحِدٖينَ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ شَرِّ الْمُنَافِقٖينَ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا مِنْ فِتْنَةِ الْفَاسِقٖينَ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَجِرْنَا وَاَجِرْ وَالِدَيْنَا وَطَلَبَةَ رَسَائِلِ النُّورِ الصَّادِقٖينَ فٖي خِدْمَةِ الْقُراٰنِ وَالْاٖيمَانِ وَاَحْبَابَنَا الْمُؤْمِنٖينَ الْمُخْلِصٖينَ وَاَقْرِبَائَنَا وَاَجْدَادَنَا مِنَ النَّارِ <span class="cevsen-separator">۞</span></p>
<p class="text-center">Draai je handpalmen naar boven en ga verder met:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِعَفْوِكَ يَا مُجٖيرُ <span class="cevsen-separator">۞</span> بِفَضْلِكَ يَا غَفَّارُ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَدْخِلْنَا الْجَنَّةَ مَعَ الْاَبْرَارِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَدْخِلْنَا الْجَنَّةَ مَعَ الْاَبْرَارِ <span class="cevsen-separator">۞</span> اَللّٰهُمَّ اَدْخِلْنَا وَاَدْخِلْ اُسْتَاذَنَا سَعٖيدَ النُّورْسٖى ( رَضِيَ اللّٰهُ عَنْهُ ) وَوَالِدَيْنَا وَطَلَبَةَ رَسَائِلِ النُّورِ الصَّادِقٖينَ وَاِخْوَانَنَا وَاَخَوَاتِنَا وَاَقْرِبَائَنَا وَاَجْدَادَنَا وَاَحْبَابَنَا الْمُؤْمِنٖينَ الْمُخْلِصٖينَ فٖي خِدْمَةِ الْاٖيمَانِ وَالْقُرْاٰنِ اَلْجَنَّةَ مَعَ الْاَبْرَارِ صَلِّ عَلٰى نَبِيِّكَ الْمُخْتَارِ وَاٰلِهِ الْاَطْهَارِ وَاَصْحَابِهِ الْاَخْيَارِ وَسَلِّمْ مَا دَامَ الَّيْلُ وَالنَّهَارُ اٰمٖينَ وَالْحَمْدُ لِلّٰهِ رَبِّ الْعَالَمٖينَ <span class="cevsen-separator">۞</span></p>
<p class="text-center">Spreek vervolgens zegeningen uit over de Profeet en reciteer deze smeekbede:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَ اللّٰهِ وَالْحَمْدُ لِلّٰهِ وَلَٓا اِلٰهَ اِلَّا اللّٰهُ وَاللّٰهُ اَكْبَرُ وَلَا حَوْلَ وَلَا قُوَّةَ اِلَّا بِاللّٰهِ الْعَلِيِّ الْعَظٖيمِ</p>
<p class="text-center">Reciteer Ayat al-Kursi (het Troonvers, soera Al-Baqara, vers 255):</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحٖيمِ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُ لَٓا اِلٰهَ اِلَّا هُوَ<span class="arabic-waqf">ۚ</span> اَلْحَيُّ الْقَيُّومُ<span class="arabic-waqf">ۚ</span> لَا تَأْخُذُهُ سِنَةٌ وَلَا نَوْمٌ<span class="arabic-waqf">ۜ</span> لَهُ مَا فِي السَّمٰوَاتِ وَمَا فِي الْاَرْضِ<span class="arabic-waqf">ۜ</span> مَنْ ذَا الَّذٖي يَشْفَعُ عِنْدَهُٓ اِلَّا بِاِذْنِهٖ<span class="arabic-waqf">ۜ</span> يَعْلَمُ مَا بَيْنَ اَيْدٖيهِمْ وَمَا خَلْفَهُمْ<span class="arabic-waqf">ۚ</span> وَلَا يُحٖيطُونَ بِشَيْءٍ مِنْ عِلْمِهٖٓ اِلَّا بِمَا شَٓاءَ<span class="arabic-waqf">ۚ</span> وَسِعَ كُرْسِيُّهُ السَّمٰوَاتِ وَالْاَرْضَ<span class="arabic-waqf">ۚ</span> وَلَا يَ<span class="arabic-madd-below">ؤُ</span>دُهُ حِفْظُهُمَا<span class="arabic-waqf">ۚ</span> وَهُوَ الْعَلِيُّ الْعَظٖيمُ <span class="cevsen-verse-number">۝٢٥٥</span></p>
<p class="text-center">Zeg daarna:</p>
<p class="text-center">33 keer: <span class="text-arabic" dir="rtl" lang="ar">سُبْحَانَ اللّٰهِ</span></p>
<p class="text-center">33 keer: <span class="text-arabic" dir="rtl" lang="ar">اَلْحَمْدُ لِلّٰهِ</span></p>
<p class="text-center">33 keer: <span class="text-arabic" dir="rtl" lang="ar">اَللّٰهُ اَكْبَرُ</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">لَٓا اِلٰهَ اِلَّا اللّٰهُ وَحْدَهُ لَا شَرٖيكَ لَهُ، لَهُ الْمُلْكُ وَلَهُ الْحَمْدُ يُحْيٖ وَيُمٖيتُ وَهُوَ حَيٌّ لَا يَمُوتُ بِيَدِهِ الْخَيْرُ وَهُوَ عَلٰى كُلِّ شَيْءٍ قَدٖيرٌ <span class="cevsen-separator">۞</span></p>
<p class="text-center">Verricht hierna een persoonlijke smeekbede. Zeg daarna eenmaal <span class="text-arabic" dir="rtl" lang="ar">فَاعْلَمْ اَنَّهُ</span> en ga verder met de geloofsgetuigenis van Gods eenheid.</p>
<p class="text-center">33 keer: <span class="text-arabic" dir="rtl" lang="ar">لَٓا اِلٰهَ اِلَّا اللّٰهُ</span> Sluit daarna af met: <span class="text-arabic" dir="rtl" lang="ar">مُحَمَّدٌ رَسُولُ اللّٰهِ صَلَّى اللّٰهُ تَعَالٰى عَلَيْهِ وَسَلَّمَ</span> Ga vervolgens verder met de tesbihat:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحٖيمِ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اِنَّ اللّٰهَ وَمَلٰٓئِكَتَهُ يُصَلُّونَ عَلَى النَّبِيِّ<span class="arabic-waqf">ۜ</span> يَٓا اَيُّهَا الَّذٖينَ اٰمَنُوا صَلُّوا عَلَيْهِ وَسَلِّمُوا تَسْلٖيمًا <span class="cevsen-separator">۞</span> لَبَّيْكَ‥</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِ سَيِّدِنَا مُحَمَّدٍ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِعَدَدِ كُلِّ دَاءٍ وَدَوَاءٍ وَبَارِكْ وَسَلِّمْ عَلَيْهِ وَعَلَيْهِمْ كَثٖيرًا <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِ سَيِّدِنَا مُحَمَّدٍ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِعَدَدِ كُلِّ دَاءٍ وَدَوَاءٍ وَبَارِكْ وَسَلِّمْ عَلَيْهِ وَعَلَيْهِمْ كَثٖيرًا <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِ سَيِّدِنَا مُحَمَّدٍ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِعَدَدِ كُلِّ دَاءٍ وَدَوَاءٍ وَبَارِكْ وَسَلِّمْ عَلَيْهِ وَعَلَيْهِمْ كَثٖيرًا كَثٖيرًا <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">صَلِّ وَسَلِّمْ يَا رَبِّ عَلٰى حَبٖيبِكَ مُحَمَّدٍ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">وَعَلٰى جَمٖيعِ الْاَنْبِيَاءِ وَالْمُرْسَلٖينَ وَعَلٰى اٰلِ كُلٍّ وَصَحْبِ كُلٍّ اَجْمَعٖينَ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اٰمٖينَ وَالْحَمْدُ لِلّٰهِ رَبِّ الْعَالَمٖينَ <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَلْفُ اَلْفِ صَلَاةٍ وَاَلْفُ اَلْفِ سَلَامٍ عَلَيْكَ يَا رَسُولَ اللّٰهِ <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَلْفُ اَلْفِ صَلَاةٍ وَاَلْفُ اَلْفِ سَلَامٍ عَلَيْكَ يَا حَبٖيبَ اللّٰهِ <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَلْفُ اَلْفِ صَلَاةٍ وَاَلْفُ اَلْفِ سَلَامٍ عَلَيْكَ يَا اَمٖينَ وَحْيِ اللّٰهِ <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ وَسَلِّمْ وَبَارِكْ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِهٖ وَاَصْحَابِهٖ بِعَدَدِ اَوْرَاقِ الْاَشْجَارِ وَاَمْوَاجِ الْبِحَارِ وَقَطَرَاتِ الْاَمْطَارِ وَاغْفِرْلَنَا وَارْحَمْنَا وَالْطُفْ بِنَا وَبِاُسْتَاذِنَا سَعٖيدِ النُّورْسٖى ( رَضِيَ اللّٰهُ عَنْهُ ) وَوَالِدَيْنَا وَبِطَلَبَةِ رَسَائِلِ النُّورِ الصَّادِقٖينَ يَا اِلٰهَنَا بِكُلِّ صَلَاةٍ مِنْهَا اَشْهَدُ اَنْ لَٓا اِلٰهَ اِلَّا اللّٰهُ وَاَشْهَدُ اَنَّ مُحَمَّدًا رَسُولُ اللّٰهِ صَلَّى اللّٰهُ تَعَالٰى عَلَيْهِ وَسَلَّمَ <span class="cevsen-separator">۞</span></p>
<hr class="hr-tesbihat">
<p class="text-center">Reciteer de smeekbede İsm-i A’zâm:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحٖيمِ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا جَمٖيلُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١</span> يَا قَرٖيبُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مُجٖيبُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣</span> يَا حَبٖيبُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٤</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا رَؤُ۫فٌ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٥</span> يَا عَطُوفُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٦</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَعْرُوفُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٧</span> يَا لَطٖيفُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٨</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا عَظٖيمُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٩</span> يَا حَنَّانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٠</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنَّانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١١</span> يَا دَيَّانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٢</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا سُبْحَانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٣</span> يَا اَمَانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٤</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا بُرْهَانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٥</span> يَا سُلْطَانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٦</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مُسْتَعَانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٧</span> يَا مُحْسِنُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٨</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مُتَعَالُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٩</span> يَا رَحْمٰنُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٠</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا رَحٖيمُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢١</span> يَا كَرٖيمُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٢</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَجٖيدُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٣</span> يَا فَرْدُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٤</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا وِتْرُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٥</span> يَا اَحَدُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٦</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا صَمَدُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٧</span> يَا مَحْمُودُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٨</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا صَادِقَ الْوَعْدِ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٩</span> يَا عَلِيُّ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٠</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا غَنِيُّ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣١</span> يَا شَافِى يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٢</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا كَافِى يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٣</span> يَا مُعَافِى يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٤</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا بَاقٖي يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٥</span> يَا هَادٖي يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٦</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا قَادِرُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٧</span> يَا سَاتِرُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٨</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا قَهَّارُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٩</span> يَا جَبَّارُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٤٠</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا غَفَّارُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٤١</span> يَا فَتَّاحُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٤٢</span></p>
<p class="text-center">Open je handen met de handpalmen naar boven en reciteer:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا رَبَّ السَّمٰوَاتِ وَالْاَرْضِ <span class="cevsen-separator">۞</span> يَا ذَا الْجَلَالِ وَالْاِكْرَامِ <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَسْئَلُكَ بِحَقِّ هٰذِهِ الْاَسْمَاءِ كُلِّهَا اَنْ تُصَلِّيَ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِ مُحَمَّدٍ وَارْحَمْ مُحَمَّدًا كَمَا صَلَّيْتَ وَسَلَّمْتَ وَبَارَكْتَ وَرَحِمْتَ وَتَرَحَّمْتَ عَلٰى اِبْرَاهٖيمَ وَعَلٰى اٰلِ اِبْرَاهٖيمَ فِي الْعَالَمٖينَ رَبَّنَا اِنَّكَ حَمٖيدٌ مَجٖيدٌ بِرَحْمَتِكَ يَا اَرْحَمَ الرَّاحِمٖينَ وَالْحَمْدُ لِلّٰهِ رَبِّ الْعَالَمٖينَ <span class="cevsen-separator">۞</span></p>
<hr class="hr-tesbihat">
<p class="text-center">Reciteer de verzen 20 tot en met 24 van soera Al-Hashr:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحٖيمِ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">لَا يَسْتَوٖٓي اَصْحَابُ النَّارِ وَاَصْحَابُ الْجَنَّةِ<span class="arabic-waqf">ۜ</span> اَصْحَابُ الْجَنَّةِ هُمُ الْفَٓائِزُونَ <span class="cevsen-verse-number">۝٢٠</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">لَوْ اَنْزَلْنَا هٰذَا الْقُرْاٰنَ عَلٰى جَبَلٍ لَرَاَيْتَهُ خَاشِعًا مُتَصَدِّعًا مِنْ خَشْيَةِ اللّٰهِ<span class="arabic-waqf">ۜ</span> وَتِلْكَ الْاَمْثَالُ نَضْرِبُهَا لِلنَّاسِ لَعَلَّهُمْ يَتَفَكَّرُونَ <span class="cevsen-verse-number">۝٢١</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">هُوَ اللّٰهُ الَّذٖي لَٓا اِلٰهَ اِلَّا هُوَ<span class="arabic-waqf">ۚ</span> عَالِمُ الْغَيْبِ وَالشَّهَادَةِ<span class="arabic-waqf">ۚ</span> هُوَ الرَّحْمٰنُ الرَّحٖيمُ <span class="cevsen-verse-number">۝٢٢</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">هُوَ اللّٰهُ الَّذٖي لَٓا اِلٰهَ اِلَّا هُوَ<span class="arabic-waqf">ۚ</span> اَلْمَلِكُ الْقُدُّوسُ السَّلَامُ الْمُؤْمِنُ الْمُهَيْمِنُ الْعَزٖيزُ الْجَبَّارُ الْمُتَكَبِّرُ<span class="arabic-waqf">ۜ</span> سُبْحَانَ اللّٰهِ عَمَّا يُشْرِكُونَ <span class="cevsen-verse-number">۝٢٣</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">هُوَ اللّٰهُ الْخَالِقُ الْبَارِئُ الْمُصَوِّرُ لَهُ الْاَسْمَٓاءُ الْحُسْنٰى<span class="arabic-waqf">ۜ</span> يُسَبِّحُ لَهُ مَا فِي السَّمٰوَاتِ وَالْاَرْضِ<span class="arabic-waqf">ۚ</span> وَهُوَ الْعَزٖيزُ الْحَكٖيمُ <span class="cevsen-verse-number">۝٢٤</span></p>
</div>
TESBIHAT_PAGE_004,
            ],
            [
                'page_number' => 5,
                'content' => <<<'TESBIHAT_PAGE_005'
<div class="page" id="5">
<p class="text-end page-number">#5</p>
<p class="text-center"><strong>Isha – Nachtgebed</strong></p>

<p class="text-center">Na het verplichte deel van het nachtgebed en de afsluitende vredesgroet zeg je:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ اَنْتَ السَّلَامُ وَمِنْكَ السَّلَامُ تَبَارَكْتَ يَاذَا الْجَلَالِ وَالْاِكْرَامِ</p>
<p class="text-center">Hef daarna je handen op met de handpalmen naar boven en reciteer de smeekbede Salâtan Tunjînâ:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِ سَيِّدِنَا مُحَمَّدٍ صَلَاةً تُنْجٖينَا بِهَا مِنْ جَمٖيعِ الْاَهْوَالِ وَالْاٰفَاتِ وَتَقْضٖي لَنَا بِهَا جَمٖيعَ الْحَاجَاتِ وَتُطَهِّرُنَا بِهَا مِنْ جَمٖيعِ السَّيِّئَاتِ وَتَرْفَعُنَا بِهَا عِنْدَكَ اَعْلَى الدَّرَجَاتِ وَتُبَلِّغُنَا بِهَا اَقْصَى الْغَايَاتِ مِنْ جَمٖيعِ الْخَيْرَاتِ فِي الْحَيَاةِ وَبَعْدَ الْمَمَاتِ اٰمٖينَ يَامُجٖيبَ الدَّعَوَاتِ وَالْحَمْدُ لِلّٰهِ رَبِّ الْعَالَمٖينَ <span class="cevsen-separator">۞</span></p>
<p class="text-center">Verricht daarna het afsluitende soennagebed van het nachtgebed en het witrgebed. Spreek vervolgens zegeningen uit over de Profeet en reciteer deze smeekbede:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">سُبْحَانَ اللّٰهِ وَالْحَمْدُ لِلّٰهِ وَلَٓا اِلٰهَ اِلَّا اللّٰهُ وَاللّٰهُ اَكْبَرُ وَلَا حَوْلَ وَلَا قُوَّةَ اِلَّا بِاللّٰهِ الْعَلِيِّ الْعَظٖيمِ</p>
<p class="text-center">Reciteer Ayat al-Kursi (het Troonvers, soera Al-Baqara, vers 255):</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحٖيمِ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُ لَٓا اِلٰهَ اِلَّا هُوَ<span class="arabic-waqf">ۚ</span> اَلْحَيُّ الْقَيُّومُ<span class="arabic-waqf">ۚ</span> لَا تَأْخُذُهُ سِنَةٌ وَلَا نَوْمٌ<span class="arabic-waqf">ۜ</span> لَهُ مَا فِي السَّمٰوَاتِ وَمَا فِي الْاَرْضِ<span class="arabic-waqf">ۜ</span> مَنْ ذَا الَّذٖي يَشْفَعُ عِنْدَهُٓ اِلَّا بِاِذْنِهٖ<span class="arabic-waqf">ۜ</span> يَعْلَمُ مَا بَيْنَ اَيْدٖيهِمْ وَمَا خَلْفَهُمْ<span class="arabic-waqf">ۚ</span> وَلَا يُحٖيطُونَ بِشَيْءٍ مِنْ عِلْمِهٖٓ اِلَّا بِمَا شَٓاءَ<span class="arabic-waqf">ۚ</span> وَسِعَ كُرْسِيُّهُ السَّمٰوَاتِ وَالْاَرْضَ<span class="arabic-waqf">ۚ</span> وَلَا يَ<span class="arabic-madd-below">ؤُ</span>دُهُ حِفْظُهُمَا<span class="arabic-waqf">ۚ</span> وَهُوَ الْعَلِيُّ الْعَظٖيمُ <span class="cevsen-verse-number">۝٢٥٥</span></p>
<p class="text-center">Zeg daarna:</p>
<p class="text-center">33 keer: <span class="text-arabic" dir="rtl" lang="ar">سُبْحَانَ اللّٰهِ</span></p>
<p class="text-center">33 keer: <span class="text-arabic" dir="rtl" lang="ar">اَلْحَمْدُ لِلّٰهِ</span></p>
<p class="text-center">33 keer: <span class="text-arabic" dir="rtl" lang="ar">اَللّٰهُ اَكْبَرُ</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">لَٓا اِلٰهَ اِلَّا اللّٰهُ وَحْدَهُ لَا شَرٖيكَ لَهُ، لَهُ الْمُلْكُ وَلَهُ الْحَمْدُ يُحْيٖ وَيُمٖيتُ وَهُوَ حَيٌّ لَا يَمُوتُ بِيَدِهِ الْخَيْرُ وَهُوَ عَلٰى كُلِّ شَيْءٍ قَدٖيرٌ <span class="cevsen-separator">۞</span></p>
<p class="text-center">Verricht hierna een persoonlijke smeekbede. Zeg daarna eenmaal <span class="text-arabic" dir="rtl" lang="ar">فَاعْلَمْ اَنَّهُ</span> en ga verder met de geloofsgetuigenis van Gods eenheid.</p>
<p class="text-center">33 keer: <span class="text-arabic" dir="rtl" lang="ar">لَٓا اِلٰهَ اِلَّا اللّٰهُ</span> Sluit daarna af met: <span class="text-arabic" dir="rtl" lang="ar">مُحَمَّدٌ رَسُولُ اللّٰهِ صَلَّى اللّٰهُ تَعَالٰى عَلَيْهِ وَسَلَّمَ</span> Ga vervolgens verder met de tesbihat:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحٖيمِ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اِنَّ اللّٰهَ وَمَلٰٓئِكَتَهُ يُصَلُّونَ عَلَى النَّبِيِّ<span class="arabic-waqf">ۜ</span> يَٓا اَيُّهَا الَّذٖينَ اٰمَنُوا صَلُّوا عَلَيْهِ وَسَلِّمُوا تَسْلٖيمًا <span class="cevsen-separator">۞</span> لَبَّيْكَ‥</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِ سَيِّدِنَا مُحَمَّدٍ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِعَدَدِ كُلِّ دَاءٍ وَدَوَاءٍ وَبَارِكْ وَسَلِّمْ عَلَيْهِ وَعَلَيْهِمْ كَثٖيرًا <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِ سَيِّدِنَا مُحَمَّدٍ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِعَدَدِ كُلِّ دَاءٍ وَدَوَاءٍ وَبَارِكْ وَسَلِّمْ عَلَيْهِ وَعَلَيْهِمْ كَثٖيرًا <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِ سَيِّدِنَا مُحَمَّدٍ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِعَدَدِ كُلِّ دَاءٍ وَدَوَاءٍ وَبَارِكْ وَسَلِّمْ عَلَيْهِ وَعَلَيْهِمْ كَثٖيرًا كَثٖيرًا <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">صَلِّ وَسَلِّمْ يَا رَبِّ عَلٰى حَبٖيبِكَ مُحَمَّدٍ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">وَعَلٰى جَمٖيعِ الْاَنْبِيَاءِ وَالْمُرْسَلٖينَ وَعَلٰى اٰلِ كُلٍّ وَصَحْبِ كُلٍّ اَجْمَعٖينَ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اٰمٖينَ وَالْحَمْدُ لِلّٰهِ رَبِّ الْعَالَمٖينَ <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَلْفُ اَلْفِ صَلَاةٍ وَاَلْفُ اَلْفِ سَلَامٍ عَلَيْكَ يَا رَسُولَ اللّٰهِ <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَلْفُ اَلْفِ صَلَاةٍ وَاَلْفُ اَلْفِ سَلَامٍ عَلَيْكَ يَا حَبٖيبَ اللّٰهِ <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَلْفُ اَلْفِ صَلَاةٍ وَاَلْفُ اَلْفِ سَلَامٍ عَلَيْكَ يَا اَمٖينَ وَحْيِ اللّٰهِ <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ وَسَلِّمْ وَبَارِكْ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِهٖ وَاَصْحَابِهٖ بِعَدَدِ اَوْرَاقِ الْاَشْجَارِ وَاَمْوَاجِ الْبِحَارِ وَقَطَرَاتِ الْاَمْطَارِ وَاغْفِرْلَنَا وَارْحَمْنَا وَالْطُفْ بِنَا وَبِاُسْتَاذِنَا سَعٖيدِ النُّورْسٖى ( رَضِيَ اللّٰهُ عَنْهُ ) وَوَالِدَيْنَا وَبِطَلَبَةِ رَسَائِلِ النُّورِ الصَّادِقٖينَ يَا اِلٰهَنَا بِكُلِّ صَلَاةٍ مِنْهَا اَشْهَدُ اَنْ لَٓا اِلٰهَ اِلَّا اللّٰهُ وَاَشْهَدُ اَنَّ مُحَمَّدًا رَسُولُ اللّٰهِ صَلَّى اللّٰهُ تَعَالٰى عَلَيْهِ وَسَلَّمَ <span class="cevsen-separator">۞</span></p>
<hr class="hr-tesbihat">
<p class="text-center">Reciteer de smeekbede İsm-i A’zâm:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحٖيمِ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا جَمٖيلُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١</span> يَا قَرٖيبُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مُجٖيبُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣</span> يَا حَبٖيبُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٤</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا رَؤُ۫فٌ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٥</span> يَا عَطُوفُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٦</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَعْرُوفُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٧</span> يَا لَطٖيفُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٨</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا عَظٖيمُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٩</span> يَا حَنَّانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٠</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَنَّانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١١</span> يَا دَيَّانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٢</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا سُبْحَانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٣</span> يَا اَمَانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٤</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا بُرْهَانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٥</span> يَا سُلْطَانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٦</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مُسْتَعَانُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٧</span> يَا مُحْسِنُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٨</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مُتَعَالُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝١٩</span> يَا رَحْمٰنُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٠</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا رَحٖيمُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢١</span> يَا كَرٖيمُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٢</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا مَجٖيدُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٣</span> يَا فَرْدُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٤</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا وِتْرُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٥</span> يَا اَحَدُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٦</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا صَمَدُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٧</span> يَا مَحْمُودُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٨</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا صَادِقَ الْوَعْدِ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٢٩</span> يَا عَلِيُّ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٠</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا غَنِيُّ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣١</span> يَا شَافِى يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٢</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا كَافِى يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٣</span> يَا مُعَافِى يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٤</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا بَاقٖي يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٥</span> يَا هَادٖي يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٦</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا قَادِرُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٧</span> يَا سَاتِرُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٨</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا قَهَّارُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٣٩</span> يَا جَبَّارُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٤٠</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا غَفَّارُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٤١</span> يَا فَتَّاحُ يَٓا اَللّٰهُ <span class="cevsen-verse-number">۝٤٢</span></p>
<p class="text-center">Open je handen met de handpalmen naar boven en reciteer:</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">يَا رَبَّ السَّمٰوَاتِ وَالْاَرْضِ <span class="cevsen-separator">۞</span> يَا ذَا الْجَلَالِ وَالْاِكْرَامِ <span class="cevsen-separator">۞</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اَسْئَلُكَ بِحَقِّ هٰذِهِ الْاَسْمَاءِ كُلِّهَا اَنْ تُصَلِّيَ عَلٰى سَيِّدِنَا مُحَمَّدٍ وَعَلٰى اٰلِ مُحَمَّدٍ وَارْحَمْ مُحَمَّدًا كَمَا صَلَّيْتَ وَسَلَّمْتَ وَبَارَكْتَ وَرَحِمْتَ وَتَرَحَّمْتَ عَلٰى اِبْرَاهٖيمَ وَعَلٰى اٰلِ اِبْرَاهٖيمَ فِي الْعَالَمٖينَ رَبَّنَا اِنَّكَ حَمٖيدٌ مَجٖيدٌ بِرَحْمَتِكَ يَا اَرْحَمَ الرَّاحِمٖينَ وَالْحَمْدُ لِلّٰهِ رَبِّ الْعَالَمٖينَ <span class="cevsen-separator">۞</span></p>
<hr class="hr-tesbihat">
<p class="text-center">Reciteer de verzen 285 en 286 van soera Al-Baqara (Âmene’r-rasûlü):</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحٖيمِ</p>
<p class="text-center text-arabic" dir="rtl" lang="ar">اٰمَنَ الرَّسُولُ بِمَٓا اُنْزِلَ اِلَيْهِ مِنْ رَبِّهٖ وَالْمُؤْمِنُونَ<span class="arabic-waqf">ۜ</span> كُلٌّ اٰمَنَ بِاللّٰهِ وَمَلٰٓئِكَتِهٖ وَكُتُبِهٖ وَرُسُلِهٖ<span class="arabic-waqf">ۜ</span> لَا نُفَرِّقُ بَيْنَ اَحَدٍ مِنْ رُسُلِهٖ<span class="arabic-waqf">ࣞ</span> وَقَالُوا سَمِعْنَا وَاَطَعْنَا غُفْرَانَكَ رَبَّنَا وَاِلَيْكَ الْمَصٖيرُ <span class="cevsen-verse-number">۝٢٨٥</span></p>
<p class="text-center text-arabic" dir="rtl" lang="ar">لَا يُكَلِّفُ اللّٰهُ نَفْسًا اِلَّا وُسْعَهَا<span class="arabic-waqf">ۜ</span> لَهَا مَا كَسَبَتْ وَعَلَيْهَا مَا اكْتَسَبَتْ<span class="arabic-waqf">ۜ</span> رَبَّنَا لَا تُؤَاخِذْنَٓا اِنْ نَسٖينَا اَوْ اَخْطَأْنَا<span class="arabic-waqf">ۚ</span> رَبَّنَا وَلَا تَحْمِلْ عَلَيْنَٓا اِصْرًا كَمَا حَمَلْتَهُ عَلَى الَّذٖينَ مِنْ قَبْلِنَا<span class="arabic-waqf">ۚ</span> رَبَّنَا وَلَا تُحَمِّلْنَا مَا لَا طَاقَةَ لَنَا بِهٖ<span class="arabic-waqf">ۚ</span> وَاعْفُ عَنَّا<span class="arabic-waqf">ࣞ</span> وَاغْفِرْ لَنَا<span class="arabic-waqf">ࣞ</span> وَارْحَمْنَا<span class="arabic-waqf">ࣞ</span> اَنْتَ مَوْلٰينَا فَانْصُرْنَا عَلَى الْقَوْمِ الْكَافِرٖينَ <span class="cevsen-verse-number">۝٢٨٦</span></p>
</div>
TESBIHAT_PAGE_005,
            ],
        ];

        return $pages;
    }
}

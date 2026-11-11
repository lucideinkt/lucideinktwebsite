<?php

namespace Database\Seeders;

class RegatheringEnglishPagesSeeder extends BookPagesSeeder
{
    protected function productSlug(): string
    {
        return 'the-regathering-english'; // Verify against DatabaseSeeder
    }

    protected function bookTitle(): string
    {
        return 'The Regathering';
    }

    protected function pages(): array
    {
        return [
            [
                'page_number' => 5,
                'content' => <<<'REGATHERING_PAGE_005'
<div class="page" id="5">
 <p class="text-end page-number">#5</p>

<p class="text-center text-red small-title"><strong>Note from the Translators </strong></p>

<p>First and foremost, we recognize that a masterpiece such as the Risale-i Nur cannot be fully captured in translation. Therefore, any shortcomings in this translation belong solely to the translators.</p>

<p>Secondly, we wish to clarify why we have translated the term <strong>“Haşr/al-Hashr”</strong> as <strong>“Regathering,”</strong> rather than the conventional rendering, <strong>“Resurrection.”</strong> The Arabic root <strong>ḥ-sh-r</strong> (<span class="text-arabic-inline" dir="rtl" lang="ar">ح-ش-ر</span>) literally means <strong>“to gather,”</strong> and in Turkish usage<em> – as employed in the original treatise – </em>it refers specifically to the Grand Gathering in the Hereafter, during which all humanity will stand before Divine Judgment. Bediüzzaman Said Nursî explains that in the course of this momentous event, three key processes will unfold: the reunion of souls with their respective bodies, the revival of those bodies, and their reconstitution from the dispersed particles that once composed them. Thus, although bodily resurrection is an integral aspect of the Grand Gathering, it does not convey the full meaning of <strong>“al-Hashr.”</strong> To better reflect the term’s nuance, we find that <strong>“Regathering”</strong> offers a more precise and faithful rendering.</p>

<p>We have also chosen not to translate certain core terms, as no existing English equivalents can adequately convey their full depth of meaning. Replacing them with simplified English renderings would inevitably compromise the author’s subtle and layered message. We therefore invite the reader to explore the richness of these concepts, rather than settle for an oversimplified translation.</p>
</div>

REGATHERING_PAGE_005,
            ],
            [
                'page_number' => 6,
                'content' => <<<'REGATHERING_PAGE_006'
<div class="page" id="6">
 <p class="text-end page-number">#6</p>

<p class="text-italic"><strong>The most significant among these terms include:</strong></p>

<p style="margin-bottom: 0"><strong>“Âyât”</strong> <em>(Arabic:</em> <span class="text-arabic-inline" dir="rtl" lang="ar">آيَات</span>, <em>plural of Âyah:</em> <span class="text-arabic-inline" dir="rtl" lang="ar">آيَة</span><em>)</em>.</p>

<p>While typically translated as <strong>“verses”</strong> of the Qur’an, Âyât encompasses the more expansive meaning of <strong>“signs.”</strong> In this broader sense, <strong>“Âyât”</strong> may refer not only to Qur’anic verses, but also to phenomena within the universe that serve as signs pointing toward the Creator. To preserve its layered meanings, we have retained the original term.</p>

<p style="margin-bottom: 0"><strong>“Haqq”</strong> <em>(Arabic:</em> <span class="text-arabic-inline" dir="rtl" lang="ar">حق</span><em>)</em></p>

<p>This term conveys both <strong>“truth”</strong> and <strong>“right.”</strong> The author frequently employs it within the well-established Turkish honorific <strong>“Cenab-ı Hak”</strong> when referring to ALLAH. This title characterizes God not only as the Absolute Truth from Whom all truths originate, but also as the Sovereign Holder of all rights, over Whom none holds any right whatsoever. As no single English word fully captures this dual meaning, <strong>“Haqq”</strong> is preserved in its original form.</p>

<p style="margin-bottom: 0"><strong>“Nafs”</strong> <em>(Arabic:</em> <span class="text-arabic-inline" dir="rtl" lang="ar">نفس</span><em>)</em></p>

<p>A multifaceted term that, in most contexts, refers to the <strong>“inner self”</strong> or to a core component that constitutes the human being. More broadly, it may denote the individual identity of any entity, or the inner reality of any matter. Its precise meaning varies by context. For example, <strong>“nafs al-amr”</strong> <em>(the self of the matter) </em>refers to objective reality as it truly is, independent of perception or opinion, whereas <strong>“nafs al-ammarah”</strong> <em>(the evil-commanding self)</em> refers to the inner human self that persistently urges one toward evil.</p>

</div>
REGATHERING_PAGE_006,
            ],
            [
                'page_number' => 7,
                'content' => <<<'REGATHERING_PAGE_007'
<div class="page" id="7">
 <p class="text-end page-number">#7</p>

<p style="margin-bottom: 0"><strong>“Samad”</strong> <em>(Arabic: <span class="text-arabic-inline" dir="rtl" lang="ar">صمد</span>)</em></p>

<p>A Divine Name that describes ALLAH as the Sole Self-Sufficient Refuge<strong> – <em>the Absolute Independent upon Whom all of creation is dependent in every respect.</em></strong></p>

<p>Having preserved certain core terms while translating others with greater precision, we hope the reader will attain a deeper understanding of this remarkable spiritual tafsir <em>(exegesis)</em> of the Qur’an.</p>

<p>Lastly, we wish to highlight the Divine Name Rabb, commonly rendered as <strong>“Lord.”</strong> Although <strong>“Lord”</strong> is the standard rendering, Rabb conveys far more than mere sovereign rule; it denotes a compassionate nurturing that directs, sustains, and oversees the development of creation. For example, when the Name Rabb manifests in a seed, God’s nurturing Lordship gradually raises it into a flourishing tree, with each stage of its growth revealing yet another facet of this Divine Name. And just as all physical development unfolds by the grace of this Name, so too is spiritual growth sustained by its manifestation.</p>

<p>Hence, if we aspire to grow in accordance with the design our Creator has willed for us, we ought to heed ALLAH’s first command to the Prophet Muhammad <span class="honorific" dir="rtl" lang="ar">عليه الصلاة والسلام</span>: <strong>“Read in the Name of your Lord.”</strong> For just as our Rabb nurtured us physically from a single drop of fluid into an intricately designed human being, so too is He willing to nurture us spiritually toward a most refined maturity, provided we seek knowledge and growth in His Name.</p>

<p style="max-width: 450px; margin: 0 auto 18px;" class="text-center"><strong>May ALLAH make this treatise beneficial for its readers and accept it as a service in His cause.</strong></p>

<p style="text-align: right;"><em>The Translators</em></p>
</div>
REGATHERING_PAGE_007,
            ],
            [
                'page_number' => 8,
                'content' => <<<'REGATHERING_PAGE_008'
<div class="page" id="8">
 <p class="text-end page-number">#8</p>

</div>
REGATHERING_PAGE_008,
            ],
            [
                'page_number' => 9,
                'content' => <<<'REGATHERING_PAGE_009'
<div class="page" id="9">
    <p class="text-end page-number">#9</p>


<div class="text-center page-title-chapter delima-font">
    <h2>The Tenth Word</h2>
    <p><em>Regarding “Hashr”</em></p>

<p><em>— The Regathering —</em></p>
</div>
<p class="text-red small-title"><strong>Note</strong></p>

<p>In these treatises, I have written the metaphors and comparisons in the form of stories to facilitate understanding and to demonstrate how rational, harmonious, well-founded, and mutually reinforcing the truths of Islam are. The meanings of the stories unfold in the truths that follow them. Their allegorical structure solely serves to point to those truths. Hence, in essence, they are not fictitious tales but genuine truths.</p>

<p class="text-center text-arabic-bismillah arabic fn-ref-text" dir="rtl" lang="ar" role="button" tabindex="0" aria-label="Open voetnoot 1">
    <span class="bismillah-svg bismillah-svg-light reader-themed-image" style="--image-mask: url(&quot;https://lucideinktwebshop.test/images/bismillah%20.svg&quot;);"><img src="/images/bismillah%20.svg" alt="Bismillah" class=""></span>
    <span class="bismillah-svg bismillah-svg-dark reader-themed-image" style="--image-mask: url(&quot;https://lucideinktwebshop.test/images/bismillah-dark.svg&quot;);"><img src="/images/bismillah-dark.svg" alt="Bismillah" class=""></span>
    <span class="fn-ref-wrap"><span class="fn-ref-word"></span><button class="fn-ref" type="button" aria-label="Voetnoot 1" data-fn="1" data-html="&lt;p class=&quot;footnote-p footnote-content fn-popover__para&quot;&gt;
     “In de Naam van ALLAH, de Barmhartige, de Genadige.”
    &lt;/p&gt;"><span class="fn-ref-num" aria-hidden="true" style="--badge-num-shift-x: 0.00px; --badge-num-shift-y: 0.00px;">1</span></button></span>
    </p>

<p style="margin: 0 auto 15px;max-width: 500px" class="text-center text-arabic delima-font" dir="rtl" lang="ar">فَانْظُرْ اِلٰٓى اٰثَارِ رَحْمَتِ اللّٰهِ كَيْفَ يُحْيِى الْاَرْضَ بَعْدَ مَوْتِهَا اِنَّ ذٰلِكَ لَمُحْيِى الْمَوْتٰى وَهُوَ عَلٰى كُلِّ شَىْءٍ قَدٖيرٌ<sup>2</sup></p>

<p>Brother, if you wish for a clear explanation regarding the Regathering and the Hereafter in simple and plain language, then join my nafs <em>(my inner self)</em>, and let us observe this symbolic story. Listen...</p>
<div class="page-footnote">
    <hr class="hr-footnote" />
    <p class="footnote-p"><sup>1</sup> “In the Name of ALLAH, the Merciful, the Compassionate.”</p>

<p class="footnote-p"><sup>2</sup> “Behold the signs of ALLAH's Mercy: how He revives the earth after its death. Indeed, it is He Who brings the dead to life, and He has Power over all things.” - Qur’ân, 30:50</p>
</div>
</div>
REGATHERING_PAGE_009,
            ],
            [
                'page_number' => 10,
                'content' => <<<'REGATHERING_PAGE_010'
<div class="page" id="10">
 <p class="text-end page-number">#10</p>

<p>Once upon a time, two men journeyed toward a land of heavenly beauty <em>(referring to this world)</em>. When they arrived, they noticed that all the inhabitants kept the entrances to their homes and shops open and unattended. Goods and money lay out in the open with no owner in sight. One of the men began grabbing whatever he desired, either stealing or looting it. Succumbing to his urges, he indulged in all kinds of injustice and indecency. None of the locals prevented him. Finally, his friend said to him:</p>

<p><em>“What are you doing? You will be punished, and you will drag me into trouble as well. These goods are state property. All the people here, along with their families and children, are either soldiers or officials. Currently, they have been assigned to carry out certain civilian duties, which is why they’re not taking action against you for now. However, strict order reigns here! The king has installed telephones in every corner, and his agents are everywhere. Now come to your senses and repent.”</em></p>

<p>The foolish traveler, however, stubbornly insisted:</p>

<p><em>“You are wrong! These goods are not state property. They are more like charity items, belonging to no one in particular. Anyone can freely make use of them as they please. I see no reason to refrain from enjoying these lovely things. Unless I see some concrete proof with my eyes, I simply will not believe you.” </em></p>

<p>He went on to spout various philosophical fallacies, which sparked a serious debate between the two. First, the foolish traveler questioned:</p>

<p><em>“What king are you talking about? I don’t acknowledge his existence.”</em></p>
</div>
REGATHERING_PAGE_010,
            ],
            [
                'page_number' => 11,
                'content' => <<<'REGATHERING_PAGE_011'
<div class="page" id="11">
 <p class="text-end page-number">#11</p>

<p>His friend answered:</p>

<p><strong><em>“No village is without a mayor. No pin is without a maker; it must have an owner. No letter can come into being without a writer – you know this. How, then, can this infinitely well-ordered land be without a ruler? </strong><em>Moreover, every hour, a train</em><sup>1</sup><em> fully laden with precious, artfully crafted goods appears from the unknown, unloads its treasures, then vanishes again… How can such abundant wealth have no owner? And what about all the widely displayed declaration letters and explanatory writings, the seals, stamps, and signatures on all items, and all the flags waving in every corner? How could they be ownerless? You seem to have delved into some Western studies. However, you cannot read these Islamic scriptures, nor do you bother to ask experts what they contain. Now come, let me read to you the king’s greatest decree.”</em></p>

<p>The foolish traveler interrupted him and said:</p>

<p><em>“Alright, let’s say such a king exists… Still, what harm would my meager consumption inflict on him? What would he lose from his treasury? Besides, there are no such things as prisons here; not a glimpse of punishment is to be seen.”</em></p>

<p>His friend then replied:</p>

<p><em>“This land before our eyes is a training field. At the same time, it is a gallery of His Majesty’s unique artworks. Furthermore, it is a temporary, unstable royal guesthouse. Haven’t you noticed that each day a caravan appears while another departs and disappears?</em></p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> This refers to a year. Indeed, every spring is a food wagon appearing from the unknown.</p>
</div>
</div>
REGATHERING_PAGE_011,
            ],
            [
                'page_number' => 12,
                'content' => <<<'REGATHERING_PAGE_012'
<div class="page" id="12">
 <p class="text-end page-number">#12</p>

<p><em> There is a constant stream of arrival and departure. In due time, this entire country will be reshaped. Its inhabitants shall be transferred to a different, permanent realm. There, everyone will be either punished or rewarded in accordance with their service.” </em></p>

<p>Yet again, the treacherous fool opposed and said:</p>

<p><em>“I don’t believe you. Is it at all possible that this land will be destroyed, and all will be transferred to some other realm?”</em></p>

<p>In response, his trusted friend said:</p>

<p><em>“Since you’re being so adamant and obstinate, follow me… From among the endless proofs, I shall present </em><strong><em>“Twelve Outlooks”</em></strong><em> to show you: an Ultimate Judgment will take place; a realm of reward and bestowal exists, just as a realm of punishment and imprisonment exists, and this land, which is partly filled and emptied daily, will one day be completely cleared and destroyed.”</em></p>

<p class="text-center text-red small-title"><strong>FIRST OUTLOOK</strong></p>

<p>Is it at all possible that an empire <em>– especially one so splendid –</em> reserves no reward for obedient servants, nor punishment for defiant rebels? Both reward and punishment are practically non-existent here…</p>

<p class="text-center text-center-constrained"><strong>Thus, an Ultimate Judgment shall take place elsewhere.</strong></p>

<p class="text-center text-red small-title"><strong>SECOND OUTLOOK</strong></p>

<p>Behold these developments, these enactments! Be it the poorest, be it the weakest, everyone is provided with exquisitely prepared sustenance. The lonesome sick are perfectly taken care of.</p>
</div>
REGATHERING_PAGE_012,
            ],
            [
                'page_number' => 13,
                'content' => <<<'REGATHERING_PAGE_013'
<div class="page" id="13">
 <p class="text-end page-number">#13</p>

<p>Notice all the delicious dishes, valuable bowls, bejeweled emblems, ornate garments, and majestic feasts. Look around you! Apart from fools like you, everyone is deeply focused on their duty. No one oversteps their bounds in the slightest. Even the grandest personage performs his service with utmost obedience, under an aura of humble fear and awe. Hence, the owner of this empire possesses tremendous generosity and extensive compassion, along with great dignity, and awe-inspiring glory and honor.</p>

<p>In essence, generosity requires bestowal. Compassion is incomplete without beneficence. Dignity demands rectification. Glory and honor necessitate disciplining the wicked. Yet not a thousandth of what befits such compassion and dignity materializes in these lands. The oppressors remain in their pride, and the oppressed in their humiliation, as both depart and migrate from these lands…</p>

<p class="text-center text-center-constrained"><strong>Thus, their reckoning is reserved for an Ultimate Judgment.</strong></p>

<p class="text-center text-red small-title"><strong>THIRD OUTLOOK</strong></p>

<p>Behold with what lofty wisdom and order processes unfold, and with what perfect justice and balance affairs are managed.</p>

<p>In essence, wise governance requires bestowing grace upon those who seek refuge under the empire’s protective wing. Justice necessitates upholding citizens’ rights to keep the government’s honor and the empire’s splendor intact. However, not a thousandth of what befits such wisdom and justice materializes in these regions. Often, fools like you migrate from here and disappear without being punished.</p>
</div>
REGATHERING_PAGE_013,
            ],
            [
                'page_number' => 14,
                'content' => <<<'REGATHERING_PAGE_014'
<div class="page" id="14">
 <p class="text-end page-number">#14</p>

<p class="text-center text-center-constrained"><strong>Thus, these matters are reserved for an Ultimate Judgment.</strong></p>

<p class="text-center text-red small-title"><strong>FOURTH OUTLOOK</strong></p>

<p>Behold! The innumerable unique gems displayed throughout these galleries, and the incomparable delicacies laden upon these tables, indicate that the king of these regions possesses boundless munificence and bounteous treasures. In essence, such munificence and inexhaustible treasures call for feasts in an eternal realm where all that is desired is ever-present. Moreover, they necessitate the everlasting presence of delighted attendees who enjoy those feasts, ensuring that finitude and separation never torment them. For as the cessation of pain brings joy, the cessation of joy brings pain.</p>

<p>Now gaze at these galleries! Heed these announcements! Listen to these heralds who present and display the antique artworks of a wondrous king; they reveal his perfections, unveil his peerless inner beauty, and describe the subtleties of his hidden elegance. Thus, the king possesses pivotal, stunning perfections and spiritual beauty.</p>

<p>Naturally, an impeccable hidden perfection longs to be revealed in the presence of appreciative witnesses who celebrate it with invocations of <strong>“mâshâ’ALLAH.”</strong> Similarly, a concealed beauty without any beholders will wish to see and be seen. That is, it will want to view its own beauty in <strong>two ways: <em>first</em>,</strong> by directly beholding it in various mirrors; <strong><em>second</em>,</strong> by perceiving it through the gaze of passionate observers and amazed admirers.</p>
</div>
REGATHERING_PAGE_014,
            ],
            [
                'page_number' => 15,
                'content' => <<<'REGATHERING_PAGE_015'
<div class="page" id="15">
 <p class="text-end page-number">#15</p>

<p>Hence, it desires both to see and be seen; it longs to behold constantly and be beheld forever. Furthermore, such infinite beauty will desire the everlasting existence of passionate observers and admirers. For an infinite beauty cannot settle for a transient admirer. After all, an observer condemned to disappear without any hope of return will find his love souring into enmity at the thought of his demise. His amazement and admiration will turn to resentment, as man is hostile toward the inconceivable and unattainable. Within this realm, everyone swiftly departs from these guesthouses and disappears. Visitants only see a glimpse, or a faint shadow, of that perfection and beauty before suddenly leaving unsatiated.</p>

<p class="text-center text-center-constrained"><strong>Thus, they journey forth to an eternal viewing haven.</strong></p>

<p class="text-center text-red small-title"><strong>FIFTH OUTLOOK</strong></p>

<p>Behold! Amid these progressions, it is evident that this peerless eminence possesses tremendous compassion. For he rushes aid to every victim of misfortune. He responds to every question and request. In fact, look! The moment he notices even the slightest need from his least significant subject, he compassionately meets it. Should a shepherd’s sheep injure its hoof, he immediately sends ointment or a veterinarian.</p>

<p>Now, come, let us proceed. On that island in the distance, a great meeting is taking place. All the notables of this country have gathered there. Look! A noble royal adjutant, wearing a highly distinguished emblem, delivers a speech. As he conveys his requests to his compassionate king, the entire community echoes in affirmation:<em> “Yes! We share the same wishes!” </em></p>
</div>
REGATHERING_PAGE_015,
            ],
            [
                'page_number' => 16,
                'content' => <<<'REGATHERING_PAGE_016'
<div class="page" id="16">
 <p class="text-end page-number">#16</p>

<p>They confirm and support him. Now, let us listen…</p>

<p>This king’s beloved says:</p>

<p><strong><em>“O Sultan who nourishes us with His favors! Reveal to us the archetypes and sources of the examples and shadows You have shown us here. Guide us to the center of Your Empire. Do not leave us to perish in these deserts. Admit us into Your presence. Have mercy on us. Grant us the privilege to rejoice in the delightful favors You have allowed us to taste here. Spare us the agony of finitude and abandonment. Do not forsake and annihilate these loyal and grateful subjects of Yours who long for You.” </em></strong></p>

<p>He voices his wishes and pleads fervently; you hear it as well...</p>

<p>Now, is it at all possible that such a compassionate and powerful king, who meticulously satisfies even the smallest request of his least significant subject, will not grant the most beautiful wish of his dearest adjutant? Especially when that beloved’s wish embodies everyone’s wish, the king’s will, and the necessities of his royal mercy and justice. Fulfilling this wish is not burdensome for the king either; on the contrary, it is rather easy for him. In fact, it is less challenging than maintaining the ephemeral parks in these guesthouses.</p>

<p>Given that His Majesty has invested so extensively in these temporary viewing areas to display samples of his favors for a few fleeting days and has thereby established this country, it is evident that he will reveal his true treasuries, perfections, and excellences at the center of his empire, unveiling viewing areas that will captivate the minds with sheer astonishment.</p>
</div>
REGATHERING_PAGE_016,
            ],
            [
                'page_number' => 17,
                'content' => <<<'REGATHERING_PAGE_017'
<div class="page" id="17">
 <p class="text-end page-number">#17</p>

<p class="text-center text-center-constrained"><strong>Thus, those within this arena of trial are not abandoned to their own devices; blissful palaces and terrifying dungeons await them...</strong></p>

<p class="text-center text-red small-title"><strong>SIXTH OUTLOOK</strong></p>

<p>Come and behold! These marvelous trains, airplanes, armaments, storehouses, and galleries, along with these active enactments, all demonstrate that behind the veil, a phenomenal, omnidominant sultanate exists.<sup>1</sup></p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> <strong>For example,</strong> during a present-day battle drill on a training field, executing the command: <em>“Present arms! Fix bayonets!”</em> makes a vast army resemble a thorny oak forest.</p>

<p class="footnote-p"><strong>Similarly,</strong> during ceremonial parades on a National Day, heeding the command: <em>“Don your uniforms and pin on your emblems!”</em> turns an entire army camp into a fully flourished ornamental garden teeming with colorful flowers.</p>

<p class="footnote-p"><strong>Likewise,</strong> among the Timeless Sultan’s boundless types of soldiers <em>– such as angels, jinn, humans, and animals –</em> the non-sentient plants across the Earth’s fields constitute a division subject to the law: <span class="text-arabic-inline" dir="rtl" lang="ar">كُنْ فَيَكُونُ</span> <em>“(ALLAH says) Be! And it is.”</em> During their jihad for survival, the moment they receive the Divine Command: <em>“Take up arms, equip yourselves, and stand your ground,”</em> all thorny trees and plants draw their bayonets, making the entire globe resemble a majestic army camp bristling with armed soldiers.</p>

<p class="footnote-p"><strong>Furthermore,</strong> as each day and each week of spring serves as a celebration for a specific unit of the plant division, each unit presents itself to the Observant Gaze of the Timeless Sultan with the jeweled emblems He has pinned on them, parading in succession to showcase the lovely gifts He has granted them. In this grand display, all plants and trees heed the Lord’s implicit command: <em>“Adorn yourselves with the jewels of thy Lord’s Artistry, pin on the emblems of Divine Origination known as ‘flowers and fruits,’ and flourish!” </em> &rarr;</p>
</div>
</div>
REGATHERING_PAGE_017,
            ],
            [
                'page_number' => 18,
                'content' => <<<'REGATHERING_PAGE_018'
<div class="page" id="18">
 <p class="text-end page-number">#18</p>

<p class="text-center text-center-constrained"><strong>An empire of such grandeur deserves worthy subjects. </strong></p>

<p><strong>However,</strong> as you can see, all subjects have gathered here in this <strong><em>guesthouse</em></strong>, while the guesthouse fills and empties each day.</p>

<p><strong>Moreover,</strong> these subjects reside in this <strong><em>arena of trial</em></strong> to train, while the arena is altered every hour.</p>

<p><strong>Furthermore,</strong> the subjects spend only a few minutes in this <strong><em>gallery</em></strong> to view examples of the king’s precious gifts and the antiques of his extraordinary artistry on display, while the gallery changes by the minute. Those who leave do not return; those who enter inevitably leave.</p>

<p>This state of affairs conclusively shows that beyond this guesthouse, this arena, and these displays, there exist permanent palaces and eternal abodes amidst gardens and treasuries brimming with the pure and supreme archetypes of these examples and images.</p>

<p class="text-center text-center-constrained"><strong><em>Thus, the efforts here are for them… His Majesty assigns work here and offers reward there.</em></strong></p>

<p class="text-center text-center-constrained"><strong>Everyone there possesses some form of bliss, tailored to their own individual potential…</strong></p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p">Consequently, the Earth’s surface turns into a resplendent army camp, where soldiers in ornate uniforms and bejeweled emblems stage a parade on a phenomenal festive day.</p>

<p class="footnote-p"><strong>Such wise and organized armaments and adornments clearly show to the non-blind that they materialize at the behest of an Almighty Sultan and All-Wise Ruler.</strong></p>
</div>
</div>
REGATHERING_PAGE_018,
            ],
            [
                'page_number' => 19,
                'content' => <<<'REGATHERING_PAGE_019'
<div class="page" id="19">
 <p class="text-end page-number">#19</p>

<p class="text-center text-red small-title"><strong>SEVENTH OUTLOOK</strong></p>

<p>Come, let us roam around for a bit and see what goes on in this sophisticated society. Behold! In every area, on every corner, multiple cameras have been set up, capturing images. Look, various scribes are seated in every location, taking notes. They record everything. Even the least significant services, the most mundane events, are being documented. Look up there! Atop that high peak, a huge camera has been set up exclusively for the king,<sup>1</sup> capturing all that transpires within these regions. This indicates that His Majesty has mandated that all interactions and affairs in his kingdom are to be archived. Hence, that sublime eminence has all events recorded and their images preserved. Such diligent storage and preservation are clearly meant for an accounting.</p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> Some of the meanings implied in this <strong>Outlook</strong> are revealed in <strong>“The Seventh Truth.”</strong> Here, we would just like to clarify that the king’s huge exclusive camera symbolizes the <strong>“Preserved Tablet”</strong> (<span class="text-arabic-inline" dir="rtl" lang="ar">لَوْحِ مَحْفُوظْ</span>).</p>

<p class="footnote-p">In <strong>“The Twenty-Sixth Word,”</strong> the reality of the Preserved Tablet’s existence is proven as follows:</p>

<p class="footnote-p">Small identity cards signify the existence of a great population register, little receipts indicate the presence of a general ledger, and consistent droplets reveal the existence of a huge water source. <strong><em>Similarly,</em></strong> serving as minuscule identity cards, embodying the meaning of miniature Preserved Tablets, and flowing as dot-like droplets from the Pen that inscribed the Great Preserved Tablet, the memories of humans, the fruits of trees, and the seeds of fruits clearly signify, indicate, and verify the existence of a Grand Memory, a Divine Ledger, and a Supreme Preserved Tablet, making them apparent to discerning minds...</p>
</div>
</div>
REGATHERING_PAGE_019,
            ],
            [
                'page_number' => 20,
                'content' => <<<'REGATHERING_PAGE_020'
<div class="page" id="20">
 <p class="text-end page-number">#20</p>

<p>Now, is it at all possible that an all-preserving ruler, who does not overlook even the most trivial act of his least significant subject, would not preserve, judge, and duly reward or punish the grandest deeds of his paramount subjects? In fact, behaviors defying His Majesty’s honor and sovereignty, exceeding the tolerance of his merciful disposition, proceed from among those prominent figures, yet they remain unpunished here.</p>

<p class="text-center text-center-constrained"><strong>Thus, their reckoning is reserved for an Ultimate Judgment.</strong></p>

<p class="text-center text-red small-title"><strong>EIGHTH OUTLOOK</strong></p>

<p>Come, I will now read to you the king’s decrees. Behold! He consistently conveys promises and fierce threats, declaring:</p>

<p><em>“I shall remove you from your present abodes and bring you to the center of my empire, where I shall delight the obedient and imprison the defiant. I shall demolish that ephemeral land and raise another realm, containing eternal palaces and dungeons.”</em></p>

<p>Fulfilling his promises is effortless for him. To his subjects, it is of primary concern. Deviating from his promise, on the other hand, starkly contrasts with the dignity of his authority.</p>

<p>Now observe, O fool! You endorse your false illusion, your deluded mind, and your deceitful nafs. Meanwhile, you belie a majesty who is under no obligation to waver or deviate, whose integrity cannot harmonize with inconsistency, and whose sincerity is attested by all apparent activities. Surely, you deserve severe punishment for this!</p>
</div>
REGATHERING_PAGE_020,
            ],
            [
                'page_number' => 21,
                'content' => <<<'REGATHERING_PAGE_021'
<div class="page" id="21">
 <p class="text-end page-number">#21</p>

<p>Your condition resembles that of a traveler who shuts his eyes to the sunlight and turns inward, gazing into the realm of his imagination, where his illusion <em>– akin to a firefly –</em> tries to light his dreadful path with the dim glow of the lantern inside his head. Verily, once the king makes a promise, he is certain to fulfill it. And while fulfilling it is easy for him, to us and to everything else, including himself and his empire, it is of utmost importance.</p>

<p class="text-center text-center-constrained"><strong>Thus, an Ultimate Judgment shall take place, and sublime bliss does exist.</strong></p>

<p class="text-center text-red small-title"><strong>NINTH OUTLOOK</strong></p>

<p>Come, let us now visit a few leaders of these circles and communities,<sup>1</sup> each of whom possesses a private phone for direct contact with the king. Some have even ascended to his presence. Listen to their declarations; unanimously, they report:</p>

<p><em>“The king has prepared a resplendent realm and a fearsome domain for reward and retribution. He makes solemn promises and issues fierce threats. Note that his honor and majesty would never stoop to betraying a promise, nor bear the disgrace it would bring.”</em></p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> The meanings established in this <strong>“Outlook” </strong>will be revealed in <strong>“The Eighth Truth.”</strong> For example, the leaders of the circles in this parable refer to the Prophets and the saints. The phone represents the connection with the Lord that extends from the heart, which is the projector of revelation <em>(Wahy)</em> and the receiver of inspiration <em>(Ilham)</em>; <em>the heart serves as both the mouthpiece and earpiece of that telephone.</em></p>
</div>
</div>
REGATHERING_PAGE_021,
            ],
            [
                'page_number' => 22,
                'content' => <<<'REGATHERING_PAGE_022'
<div class="page" id="22">
 <p class="text-end page-number">#22</p>

<p>As their multitude forges massive chains of narration and their unanimity wields the strength of general consensus, the bearers of these tidings unitedly report that the nucleus and center of the grand empire, glimpses of which occasionally appear, lie elsewhere, in another realm, far distant from here… The buildings in this arena of trial are temporary; one day, they will be transformed into eternal palaces. These environments are destined to change. For such a splendorous and imperishable sultanate, whose grandeur is noticeable from its traces, cannot be founded and perpetuated on transient, inconsistent, unstable, trivial, volatile, impermanent, flawed, and incomplete realities.</p>

<p>Hence, it stands on enduring, unwavering, imperishable, stable, perfect, and magnificent realities worthy of that sultanate.</p>

<p class="text-center text-center-constrained"><strong>Thus, a realm beyond this world exists; migration to that realm shall come to pass.</strong></p>

<p class="text-center text-red small-title"><strong>TENTH OUTLOOK</strong></p>

<p>Come, today is Royal New Year’s Day.<sup>1</sup> A transition is approaching; extraordinary phenomena are about to unfold. On this beautiful spring day, let us explore that green desert land adorned with lovely flowers.</p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> The symbolism in this Outlook will be revealed in <strong>“The Ninth Truth.”</strong> For example, New Year’s Day <em>(Nowruz)</em> refers to the spring season. The green, flowery desert represents the Earth's surface during spring. The changing scenes and sceneries symbolize the species of spring beings, the divisions of summer creations, and the various forms of nourishment essential for the sustenance of animals and humans – <em>all of which the All-Mighty and Glorious Artificer, the All-Wise and Elegant Originator, changes with perfect order, refreshes with utmost mercy, and sends forth one after the other from the onset of spring to the end of summer.</em></p>
</div>
</div>
REGATHERING_PAGE_022,
            ],
            [
                'page_number' => 23,
                'content' => <<<'REGATHERING_PAGE_023'
<div class="page" id="23">
 <p class="text-end page-number">#23</p>

<p>Look, the locals are heading this way as well. There’s a sense of magic in the air. Structures that once stood there have suddenly collapsed; their shapes have changed. Behold, a miracle unfolds! Those ruined structures are being rebuilt here. This desolate desert has virtually turned into a civilized city. Observe! Like scenes on a cinema screen, each hour reveals a different world, assuming a different form. Notice how, amid these complex, rapid, and varied scenes of reality, an impeccable order prevails; everything falls perfectly into place. Even fictitious movie scenes cannot be this organized. Millions of skilled magicians cannot replicate these artistries. Thus, the king whom we cannot see is capable of phenomenal miracles.</p>

<p>O fool! You ask:</p>

<p><em>“How could this vast land be destroyed and rebuilt elsewhere?”</em></p>

<p>Much like this country’s transition, which your mind refuses to accept, myriad changes and transitions occur before your very eyes every hour. These gatherings, scatterings, and circumstances indicate that these swift assemblies and dispersals, constructions and destructions, serve a deeper purpose... A decade’s worth of expense is invested in a gathering that merely lasts an hour. Hence, these present circumstances in themselves are not the ultimate objective; they are more like a representation, a simulation. His Majesty miraculously brings them into being so their images can be captured and compiled, and their results can be preserved and noted <em>– similar to how every detail during a military examination on a drill field is registered and noted. </em></p>
</div>
REGATHERING_PAGE_023,
            ],
            [
                'page_number' => 24,
                'content' => <<<'REGATHERING_PAGE_024'
<div class="page" id="24">
 <p class="text-end page-number">#24</p>

<p>Consequently, at the dawn of a major gathering, the future course of affairs will revolve around the outcome of these events. Moreover, the recorded visuals will forever be displayed in a grand gallery. Hence, these fleeting, impermanent settings yield permanent images and eternal fruits.</p>

<p class="text-center text-center-constrained"><strong>Thus, these ceremonies are meant for sublime bliss, an Ultimate Judgment, and other exalted ends unknown to us.</strong></p>

<p class="text-center text-red small-title"><strong>ELEVENTH OUTLOOK</strong></p>

<p>Come, O stubborn friend! Let us embark on a journey by plane, then board a train traveling eastward or westward <em>– that is, to the past or the future.</em> Let’s see what kind of miracles this wondrous entity has displayed in other regions. Behold! Remarkable wonders such as the stays, fields, and galleries we witnessed earlier are found everywhere. Only in terms of art and appearance do they differ from one another. Pay close attention! For all throughout those unstable stays, those unenduring fields, those impermanent galleries, arrangements of such striking wisdom, signs of such unmistakable aid, glimpses of such exalted justice, and fruits of such comprehensive mercy are so profoundly evident that anyone who is not shortsighted acknowledges with full certainty that a wisdom more perfect, an aid more beautiful, a mercy more comprehensive, and a justice more exalted than His Majesty’s are neither possible nor imaginable.</p>
</div>
REGATHERING_PAGE_024,
            ],
            [
                'page_number' => 25,
                'content' => <<<'REGATHERING_PAGE_025'
<div class="page" id="25">
 <p class="text-end page-number">#25</p>

<p>Suppose we were to entertain your imagination and assume that within the sphere of his empire, there are no permanent stays, no lofty spaces, no stable stations, or perpetual dwellings inhabited by permanent residents and blissful subjects. The fact remains that the truths of the aforementioned wisdom, aid, mercy, and justice clearly cannot find their expression in this transitory land. If no other place exists where they can fully manifest, then, like a madman denying the sun at noon while witnessing its light, one would be forced to deny the wisdom we perceive, the aid we witness, the mercy we enjoy, and the justice whose signs are apparent before our eyes.</p>

<p>Moreover, one would have to regard the entity behind these wise enactments, benevolent activities, and gracious favors as <em>– God forbid –</em> a vile trickster and a cruel tyrant. This equates to turning truths into their opposites. However, with the exception of senseless sophists who deny the existence of all things, all intellectuals unanimously agree that the inversion of truths is not possible.</p>

<p class="text-center"><strong>Thus, beyond this realm, there is another realm where an Ultimate Judgment, a Grand Rectification, and a Sublime Bestowal shall unfold, allowing this mercy, wisdom, aid, and justice to fully manifest.</strong></p>

<p class="text-center text-red small-title"><strong>TWELFTH OUTLOOK</strong></p>

<p>Come, let us return now. We are going to meet with the leaders and officers of these communities and examine their equipment to ascertain whether it was provided merely to survive for a fleeting time in the arena of trial or to attain a long life of bliss in another realm. We cannot examine every individual and each piece of equipment, but to gain some insight, let us take a look at this officer’s identity card and handbook.</p>
</div>
REGATHERING_PAGE_025,
            ],
            [
                'page_number' => 26,
                'content' => <<<'REGATHERING_PAGE_026'
<div class="page" id="26">
 <p class="text-end page-number">#26</p>

<p>This card lists the officer’s rank, salary, assignments, aspirations, and code of conduct.</p>

<p>Look, this rank isn’t meant for just a few days; it can only be granted for the long term. It reads here, <em>“You shall receive this salary from the Royal Treasury on ‘such and such’ a date. ”</em> However, that date lies in the distant future, beyond the closure of this arena. As for these assignments, they are not designed for this temporal field; rather, they have been given to attain infinite bliss in the proximity of the king. Moreover, these aspirations cannot find fulfillment within the confines of a few days’ stay in this guesthouse; only a long and blissful life can satisfy them. Lastly, this code of conduct clearly reveals that the holder of this identity card is destined for another realm; his efforts are oriented toward another world.</p>

<p>Look, these handbooks explain the usage of the equipment and what responsibilities come with it. However, if no other exalted and everlasting realm exists beyond this arena, then these official handbooks and certified identity cards will be completely meaningless. Furthermore, this honorable officer, noble commander, and distinguished leader will descend to the lowest of states, becoming the most wretched, helpless, miserable, agonized, deprived, and frail among all beings. Now, expand this analysis, for every single thing you examine will testify that this evanescence is merely a prelude to an eternity.</p>

<p>Hence, O friend, this transient land serves as a harvest field. It is an education center and a marketplace. Surely, an Ultimate Judgment and sublime bliss are bound to follow.</p>
</div>
REGATHERING_PAGE_026,
            ],
            [
                'page_number' => 27,
                'content' => <<<'REGATHERING_PAGE_027'
<div class="page" id="27">
 <p class="text-end page-number">#27</p>

<p>Should you deny this, then you will also have to deny the identity cards, handbooks, equipment, and codes of conduct of all these officers. In fact, you will be forced to reject all the order in this land, and even the very existence of the government, along with all its active enactments. At that point, you would be deemed neither human nor sentient, becoming more senseless than the sophists.</p>

<p>Be careful not to assume that the proofs for this country’s transition are limited to these <strong>“Twelve Outlooks.” </strong>There are, in fact, innumerable signs and evidences confirming that this unstable, ever-changing land will transition into an imperishable, stable realm. Additionally, there are countless clues and signs indicating that these inhabitants will be taken from these temporary guesthouses and transferred to the timeless capital of the empire.</p>

<p>Come, to conclude, I shall present one more proof, even stronger than the preceding <strong>“Twelve Outlooks.”</strong> Behold! Far in the distance, amid that vast crowd, stands the bearer of the grand emblem: the noble adjutant whom we previously encountered on the island. He conveys a message. Let us go and listen. Look, that illustrious adjutant informs the people about the supreme decree engraved upon that lofty height, proclaiming:</p>

<p><em>“Prepare yourselves! You will be journeying to another, permanent land… one that makes this country seem like a prison. You are destined to travel to the center of our king’s empire, where you shall partake in his mercy and his favors, provided you properly listen to this decree and abide by it. Otherwise, if you rebel and refuse to listen, you will be cast into dreadful dungeons.”</em></p>
</div>
REGATHERING_PAGE_027,
            ],
            [
                'page_number' => 28,
                'content' => <<<'REGATHERING_PAGE_028'
<div class="page" id="28">
 <p class="text-end page-number">#28</p>

<p>Thus, he enlightens the people. As you can see, that supreme decree bears a seal so miraculous that it is inimitable in every respect. Aside from fools like you, everyone knows with unwavering certainty that this decree is from the king. Moreover, that brilliant adjutant wears emblems so distinct that, apart from blind souls like you, everyone confidently identifies him as the king’s most veracious conveyor of commands.</p>

<p>As that noble adjutant, in unison with the Supreme Decree, proclaims and conveys the transition of this land with all his strength, can this matter even be up for debate? Surely it cannot! Unless, of course, you decide to deny everything we have witnessed thus far…</p>

<p><strong><em>Well then, my friend. The floor is yours. Speak. Say what you have to say!</em></strong></p>

<p><em>– “What is there to say? Can anything be said against this? Is it possible to oppose the sun at its zenith? I can only say: Alhamdulillah, I am infinitely grateful, for I am liberated from the dominance of delusions and desires, freed from the grip of my nafs and my whims, and saved from permanent imprisonment and confinement, as I am now convinced that beyond these chaotic, unstable guesthouses, there exists a land of bliss in the proximity of the king; and we are candidates for it.”</em></p>

<p><strong>Here ends the symbolic story that alludes to the Regathering and the Hereafter. By Divine Grace, we shall now advance to the paramount truths. Corresponding to the preceding <em>“Twelve Outlooks,”</em> we shall present <em>“Twelve Cohesive Truths,”</em> beginning with a “Prologue.”</strong></p>
</div>
REGATHERING_PAGE_028,
            ],
            [
                'page_number' => 29,
                'content' => <<<'REGATHERING_PAGE_029'
<div class="page" id="29">
 <p class="text-end page-number">#29</p>

<div class="text-center page-title-chapter delima-font">
    <h2 class="chapter-title">Prologue</h2>
    </div>

<p>[With a few signs, we shall reference some matters
that are explained in other sections – <em>namely in the
<strong>Twenty-Second</strong>, <strong>Nineteenth</strong>, and <strong>Twenty-Sixth Words</strong>.</em>]</p>    

<p class="text-center text-red small-title"><strong>First Sign</strong></p>

<p>The foolish man and his trusted friend mentioned in the story embody three truths.</p>

<p><strong>•	 Firstly,</strong> they symbolize my evil-commanding nafs and my heart.</p>

<p><strong>•	 Secondly,</strong> they represent the students of philosophy and the disciples of the Wise Qur'ân.</p>

<p><strong>•	 Thirdly,</strong> they symbolize the Ummah of Islam and the people of unbelief.</p>

<p>The gravest heresy of the philosophy students, the unbelievers, and the evil-commanding nafs lies in their nonrecognition of the Divine Haqq.</p>

<p>Just as the trusted man in the story stated:</p>

<p><em>“A letter cannot come into being without a writer; a law cannot be enforced without a ruler.”</em></p>

<p>We too state:</p>

<p>A book, particularly one in which each word contains another book written with a fine pen, and each letter includes a structured ode inscribed in micro-script, surely cannot possibly come into being without a scribe.</p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p">[With a few signs, we shall reference some matters that are explained in other sections – <em>namely in the</em> <strong>Twenty-Second</strong><em>, </em><strong>Nineteenth</strong><em>, and </em><strong>Twenty-Sixth Words</strong><em>.</em>]</p>
</div>
</div>
REGATHERING_PAGE_029,
            ],
            [
                'page_number' => 30,
                'content' => <<<'REGATHERING_PAGE_030'
<div class="page" id="30">
 <p class="text-end page-number">#30</p>

<p>Similarly, the premise that this universe lacks an Author is a multilayered impossibility of the highest order. For this universe is such a book, that each of its pages encompasses many books. In fact, within each of its words exists a book, within each of its letters resides an ode. The face of the Earth is a page; look how many books it bears. A tree is a word; notice how many pages it covers. A fruit is a letter; a seed is a dot. That dot conceals the program and blueprint of a massive tree. Verily, such a book can only have flowed forth from the Mighty Pen of a Glorious Entity Who possesses Awe-Inspiring and Beautiful Attributes, along with Infinite Power and Wisdom. Hence, witnessing the world inevitably leads to imaan <em>(faith)</em>, unless one is drunk on misguidance…</p>

<p>Moreover, a house cannot exist without a builder, particularly if the house in question is a palace, embellished with wondrous artworks, amazing engravings, and unique ornaments, with each piece of stone encapsulating the entire palace’s artistry. Its existence without a builder is a notion no rational mind can accept, as it requires a highly skilled artisan. Notably, within this palace, actual structures fluidly materialize every hour like projections on a cinema screen, seamlessly changing with sublime order, as if changing garments. In fact, within each actual projection that appears, numerous microstructures are created.</p>

<p>Similarly, this universe requires an Infinitely Wise, Omniscient, and Almighty Artificer. For this splendorous universe is a palace: the moon and the sun are its lamps; the stars are its candles.</p>
</div>
REGATHERING_PAGE_030,
            ],
            [
                'page_number' => 31,
                'content' => <<<'REGATHERING_PAGE_031'
<div class="page" id="31">
 <p class="text-end page-number">#31</p>

<p>Time is a thread, a line upon which the Glorious Artificer annually establishes a different world for display. In each established world, He meticulously refreshes its appearances in three hundred and sixty ways, applying changes with impeccable order and wisdom. He fashioned the Earth’s surface as a spread of favors, embellishing it each spring with three hundred thousand types of artworks, showering it with innumerable varieties of gifts. Despite their intricate intermingling and medley, these artworks and gifts arise distinct from one another with utmost clarity and definition. Analyze other aspects along these lines…</p>

<p class="text-center text-center-constrained"><strong>How can anyone remain heedless of such a palace’s Artificer?</strong></p>

<p>Furthering this reasoning: during a cloudless noon, when the sun’s brilliance and reflection are visible on every bubble across the ocean surface, every shiny object on dry land, and every snow particle, denying the sun would be nothing short of a delirious delusion. For at that moment, denying and not acknowledging one single sun entails acknowledging as many actual and independent micro-suns as there are droplets, bubbles, and reflective particles. This compels one to accept that within each particle, despite having room for only one particle, resides the reality of a giant sun.</p>

<p>Similarly, witnessing this well-ordered universe undergoing wise changes and harmonious rejuvenations in a consistent sequence, yet denying the Glorious Creator and His Perfect Attributes, would amount to an even worse heretical delusion, akin to a madman’s delirium. For such denial necessitates acknowledging that everything, even each and every particle, inherently possesses Absolute Divinity.</p>
</div>
REGATHERING_PAGE_031,
            ],
            [
                'page_number' => 32,
                'content' => <<<'REGATHERING_PAGE_032'
<div class="page" id="32">
 <p class="text-end page-number">#32</p>

<p><strong>For example,</strong> every single particle of air can penetrate and affect any flower, fruit, or leaf. If this particle were not a designated agent, then it would have to be familiar with the designs, shapes, and structures of all the creations it can enter and affect in order to function effectively. Hence, it must inherently possess comprehensive knowledge and power to do what it does.</p>

<p><strong>For example,</strong> every single particle of soil can be the nucleus and cradle for all the varieties of seeds and kernels. If it were not a designated agent, then the particle would need to encompass as many immaterial devices and machines as there are plants and trees. Alternatively, it must possess the artistry and power to comprehend and produce all of their designs, enabling it to identify and tailor the exact shapes they are clothed in. Extend this analogy to other beings, and you’ll come to realize that numerous proofs of Divine Unity are inherently manifest in all things.</p>

<p>Indeed, creating all things from one and one thing from all is an act exclusively reserved for the All-Creator. Take heed of the esteemed Decree: <sup>1</sup><span class="text-arabic-inline" dir="rtl" lang="ar">وَ اِنْ مِنْ شَيْءٍ اِلَّا يُسَبِّحُ بِحَمْدِهِ</span>. Thus, refusing to acknowledge the One and Only inevitably entails acknowledging as many gods as there are existent beings.</p>

<p class="text-center text-red small-title"><strong>Second Sign</strong></p>

<p>The story featured a noble adjutant, about whom it was stated: <em>“Anyone who is not blind can tell by his emblems that he operates at the king’s behest; he is His Majesty’s chosen servant.”</em></p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> There is not a thing that does not glorify Him with praise.</p>
</div>
</div>
REGATHERING_PAGE_032,
            ],
            [
                'page_number' => 33,
                'content' => <<<'REGATHERING_PAGE_033'
<div class="page" id="33">
 <p class="text-end page-number">#33</p>

<p class="text-center text-center-constrained"><strong>Verily, that noble adjutant is God’s Noblest Messenger </strong><span class="honorific" dir="rtl" lang="ar">عليه الصلاة والسلام</span><strong>. </strong></p>

<p>Indeed, to the Holy Artificer of a universe so resplendent, such a Noble Messenger is as essential as light is to the sun. For just as it is unthinkable for the sun not to emit light, so too is it impossible for Divinity not to send Prophets to reveal Itself.</p>

<p>Besides, could it ever be that a Beauty imbued with Infinite Perfection would not desire to reveal Itself through a revelatory and descriptive medium?</p>

<p>And could it be that a perfect Artistry, infused with Sublime Beauty, would not long to display Itself through a gaze-drawing herald?</p>

<p>And could it ever be that an Omni-Dominant Lordship, presiding over an All-Encompassing Sultanate, would not wish to declare Its Unity and Self-Sufficiency across all the layers of multiplicity and particularity through a two-winged envoy? One wing symbolizes the envoy’s universal servanthood, addressing the Divine Court as the spokesman for the realms of multiplicity, while the other wing signifies his closeness to God and his Messengership, addressing these realms as the ambassador of the Divine Court.</p>

<p>And could it ever be that an intrinsic Possessor of Infinite Elegance would not desire to behold and reveal the splendors of His Beauty and the subtleties of His Elegance through mirrors? That is, through a Beloved Messenger who, as His Beloved, endears himself to Him through his servanthood, serving as His mirror, while as His Messenger, ignites love for Him throughout His creations, displaying His Divine Names.</p>
</div>
REGATHERING_PAGE_033,
            ],
            [
                'page_number' => 34,
                'content' => <<<'REGATHERING_PAGE_034'
<div class="page" id="34">
 <p class="text-end page-number">#34</p>

<p>And could it ever be that an Owner of treasuries filled with stunning miracles and mysterious gems would have no will or desire to present them to the public eye through an expert describer and eloquent revealer, unveiling His hidden Perfections? And could it be that He would beautify this universe with creations expressing the Perfections of all His Names, likening it to a museal palace embellished with rare and exquisite artworks, without designating a guide to provide enlightenment?</p>

<p>And could it ever be that the Owner of this cosmos would not deploy an envoy to decipher the complex talisman encapsulating the plan and purpose behind the universe’s transitions, and unravel the enigma surrounding the three perplexing questions of existence:</p>

<p><em>“Where do we come from? Where are we heading? What is our essence?”</em></p>

<p>And could it ever be that the Awe-Inspiring Artificer, Who introduces Himself to sentient beings with such appealing artworks and endears Himself with such precious favors, would not convey through an envoy how to attain His Pleasure and act in accordance with His Will in return?</p>

<p>And could it ever be that He Who created humanity with a consciousness drawn to multiplicity and a potential primed for universal servanthood would not wish to shift their focus from multiplicity to Unity through an illuminating guide?</p>

<p>Thus, there are many more tasks pertaining to Prophethood, each constituting decisive proof that Divinity cannot be without Messengership.</p>
</div>
REGATHERING_PAGE_034,
            ],
            [
                'page_number' => 35,
                'content' => <<<'REGATHERING_PAGE_035'
<div class="page" id="35">
 <p class="text-end page-number">#35</p>

<p>In light of the aforementioned traits and tasks, we now ought to ask: <strong><em>Has anyone ever emerged in the world more qualified and comprehensive than Muhammad the Arabian </strong><span class="honorific" dir="rtl" lang="ar">عليه الصلاة والسلام</span><strong><em>?</em> <em>Has time ever shown anyone more worthy and fitting for the role of Messengership and the task of conveying Divine tidings than he?</em></strong> Not once, not ever!</p>

<p>He is indeed the Master of all Messengers, the imam of all Prophets, the mentor of all purified sages, the foremost among the recipients of God’s Nearness, the most perfect of all creations, and the Sultan of all spiritual guides.</p>

<p>Verily, aside from the innumerable proofs of His Prophethood derived from nearly a thousand miracles that Investigators of Truth unanimously confirm <em>– such as the splitting of the moon and the water flowing from his fingers –</em> the Glorious Qur’an, embodying an ocean of truths with Its forty miraculous aspects, stands as a supreme miracle sufficient to illumine his Messengership as clearly as the sun. Having expounded upon nearly forty miraculous aspects of the Qur’an in other treatises, particularly in <strong>“The Twenty-Fifth Word,”</strong> we shall now bring our discussion to a close</p>

<p class="text-center text-red small-title"><strong>Third Sign</strong></p>

<p>The following thought should not come to mind:</p>

<p><em>“What significance does this puny human really hold, that this vast world would need to close for the accounting of his deeds, and a new realm should unfold?” </em></p>

<p>For in light of this diminutive human’s comprehensive nature, he is a master among these beings, a herald of the Divine Sultanate, and a paragon of universal servanthood, thus holding paramount significance.</p>
</div>
REGATHERING_PAGE_035,
            ],
            [
                'page_number' => 36,
                'content' => <<<'REGATHERING_PAGE_036'
<div class="page" id="36">
 <p class="text-end page-number">#36</p>

<p>One should also avoid the thought:</p>

<p><em>“How could a brief lifetime warrant eternal punishment?”</em></p>

<p>For, despite this universe’s status and value as <strong>“Scriptures of The Absolute Refuge (As’Samad)”</strong>, unbelief plunges it into an abyss of meaninglessness and purposelessness, thereby insulting the entire cosmos. Moreover, unbelief’s inherent denial entails rejecting all of God’s Holy Names, whose reflections and weavings are manifest in all apparent beings. At the same time, unbelief belies all the infinite proofs that attest to the Truthfulness and Faithfulness of the Divine Haqq. <strong><em>Therefore, unbelief is a boundless crime – and a boundless crime begets boundless punishment.</em></strong></p>

<p class="text-center text-red small-title"><strong>Fourth Sign</strong></p>

<p>As we have seen in the story through <strong>“Twelve Outlooks,”</strong> it is in no way possible for a king of such stature to possess a land resembling a transient guesthouse, yet not own another stable and everlasting domain at the center of his grand sultanate, where his majesty can fully manifest.</p>

<p>Similarly, it is by no means possible that the Eternal Creator of this fleeting Earth would design this world without designing an eternal one. It is impossible for the Timeless Artificer of this peerless and ephemeral cosmos to create this universe without crafting another stable and everlasting one. Indeed, it is impossible for the All-Wise, Almighty, and Merciful Originator to have fashioned this globe as a gallery, an arena of trial, and a harvest field without having created the realm of the afterlife where all the purposes of this world culminate.</p>
</div>
REGATHERING_PAGE_036,
            ],
            [
                'page_number' => 37,
                'content' => <<<'REGATHERING_PAGE_037'
<div class="page" id="37">
 <p class="text-end page-number">#37</p>

<p>This truth can be accessed through <strong>“Twelve Gates.”</strong> These gates can be unlocked with <strong>“Twelve Truths.”</strong> We shall begin with the most concise and clear truth.</p>
</div>
REGATHERING_PAGE_037,
            ],
            [
                'page_number' => 38,
                'content' => <<<'REGATHERING_PAGE_038'
<div class="page" id="38">
 <p class="text-end page-number">#38</p>

</div>
REGATHERING_PAGE_038,
            ],
            [
                'page_number' => 39,
                'content' => <<<'REGATHERING_PAGE_039'
<div class="page" id="39">
 <p class="text-end page-number">#39</p>

<p class="text-center text-red small-title"><strong>First Truth</strong></p>

<p class="text-center text-center-constrained"><strong><em>The Gate of Lordship and Sultanate; A glimpse of the Name </em>“Rabb” (Lord)<em>.</em></strong></p>

<p>Is it at all possible that the Disposition of God’s Lordship and the Sultanate of His Divinity would bring this universe into being to display His Perfections through exalted aims and lofty purposes, yet not ordain rewards for the believers who respond to those aims and purposes with faith and servanthood, nor punishment for the deviators who oppose those purposes with rejection and disdain?</p>

<p class="text-center text-red small-title"><strong>Second Truth</strong></p>

<p class="text-center text-center-constrained"><strong><em>The Gate of Generosity and Mercy; A glimpse of the Names: “The Generous and The Merciful”</em></strong> (<span class="text-arabic-inline" dir="rtl" lang="ar">اَلْكَرٖيمُ وَالرَّحٖيمُ</span>)</p>

<p>Is it at all possible that the Lord of this world, Whose observable works reveal Him as Possessor of Infinite Generosity and Mercy, as well as Infinite Dignity and Sovereignty, reserves no rewards worthy of His Generosity and Mercy, nor punishments befitting His Dignity and Sovereignty?</p>
</div>
REGATHERING_PAGE_039,
            ],
            [
                'page_number' => 40,
                'content' => <<<'REGATHERING_PAGE_040'
<div class="page" id="40">
 <p class="text-end page-number">#40</p>

<p>Verily, upon observing the course of this world, it becomes apparent that every living being, from the most powerless and weakest<sup>1</sup> to the strongest, is provided with befitting sustenance. The weakest and frailest are granted the finest provisions. Remedy is rushed to every troubled individual from unanticipated sources. Feasts and treats are laid forth with such exalted generosity that they clearly show the orchestration of an Infinitely Generous Hand.</p>

<p>For example, as the spring season dawns, all trees are garbed like the maidens of Paradise in silken garments, bejeweled with ornate flowers and fruits, resembling servants gracefully extending their hands fashioned as branches, offering us a lush variety of the most delicious, sublimely designed fruits… And from the hands of a venomous insect, we are fed the healthiest, sweetest of honeys… And from the hand of a handless larva, we are clothed in the finest, softest of fabrics… And within a small seed, a vast treasury of Mercy is stored for us.</p>

<p>Evidently, these phenomena reveal the magnitude of the beautiful Generosity and subtle Mercy from which they emanate.</p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> Halal sustenance is not obtained by skill, but rather granted due to need. Conclusive evidence of this lies in how unskilled infants receive wholesome sustenance as opposed to how skilled predators acquire meager sustenance, or in the plumpness of unintelligent fish in contrast to the scrawny physiques of intelligent, cunning foxes and monkeys that struggle for their provision. Hence, sustenance is inversely proportional to skill and choice. The more one relies on skill and choice, the heavier the burdens of subsistence become.</p>
</div>
</div>
REGATHERING_PAGE_040,
            ],
            [
                'page_number' => 41,
                'content' => <<<'REGATHERING_PAGE_041'
<div class="page" id="41">
 <p class="text-end page-number">#41</p>

<p>Moreover, with the exception of humans and certain beasts, all things <em>– ranging from the sun, the moon, and the Earth down to the tiniest creature – </em>fulfill their duty with utmost diligence, never transgressing their bounds by even an atom. This universal obedience under a Grand Throne of Majesty signifies that all act at the behest of One Who holds great Awe and Dignity.</p>

<p>Moreover, the compassionate care of all mothers,<sup>1</sup> <em>– be they plant, animal, or human –</em> and the wholesome nourishment, like milk, tailored to the upbringing of their frail and vulnerable offspring, clearly highlight how extensively a glimpse of Divine Mercy pervades. Thus, the Governor of this world possesses Infinite Generosity and Mercy, along with Infinite Glory and Dignity. Infinite Glory and Dignity demand disciplining the insolent; Infinite Generosity requires endless bestowal; Infinite Mercy necessitates befitting beneficence.</p>

<p>However, in this ephemeral world and fleeting life, only a millionth fraction of these necessities, akin to a drop from an ocean, can take root and manifest.</p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> Indeed, a hungry lioness prioritizing her weak cub over herself, foregoing the meat she has captured to feed it to her young; a cowardly chicken attacking a dog or lion to protect its hatchling; a fig tree subsisting on mud while bestowing pure milk upon its progeny – <em>its fruits </em>– clearly demonstrate to the non-blind that they operate in accordance with the Plan of an Infinitely Merciful, Generous, and Compassionate Entity.</p>
 <p class="footnote-p">Indeed, the fact that beings lacking consciousness, such as plants and animals, perform tasks requiring a high level of awareness and wisdom conclusively reveals the existence of an Omniscient and Wise Entity Who orchestrates their actions; they operate in His Name.</p>
</div>
</div>
REGATHERING_PAGE_041,
            ],
            [
                'page_number' => 42,
                'content' => <<<'REGATHERING_PAGE_042'
<div class="page" id="42">
 <p class="text-end page-number">#42</p>

<p>Therefore, a realm of bliss worthy of such Generosity and Mercy is bound to materialize. Otherwise, much like denying the sun’s existence as it bathes the day in its light, the very existence of this apparent Mercy would have to be denied. For irreversible demise turns compassion into misery, love into bitterness, blessings into curses, intellect into a torture device, and pleasure into pain <em>– driving the truth of Mercy to extinction…</em></p>

<p>Moreover, a realm of retribution befitting Infinite Glory and Dignity must also arise. For often, the oppressors remain in their pride and the oppressed in their humiliation, as both migrate from this world and depart.<strong> Thus, their cases are reserved for an Ultimate Judgment; they are not disregarded but deferred.</strong></p>

<p>At times, Divine punishment may also be imposed on Earth. The calamities that befell rebellious and obstinate nations in previous eras demonstrate that humans are not left to their own devices; they are always subject to the lash from Divine Glory and Dignity.</p>

<p>Indeed, among all beings, it is man who is endowed with an eminent task and immense potential. Now, as the Lord of man makes Himself known through countless well-designed works of art, yet man fails to acknowledge Him in return with faith; and as He inspires love through innumerable embellished fruits of Mercy, yet man fails to evoke His Love in return with servanthood; and as He displays His Grace and Mercy through abundant varieties of favors, yet man fails to honor Him in return with praise and gratitude <strong><em>– can it then be deemed possible that such a man will remain unpunished?</em></strong> Would he be left to roam around freely? Would the Awe-Inspiring Possessor of Sovereignty and Dignity not prepare a realm of retribution?</p>
</div>
REGATHERING_PAGE_042,
            ],
            [
                'page_number' => 43,
                'content' => <<<'REGATHERING_PAGE_043'
<div class="page" id="43">
 <p class="text-end page-number">#43</p>

<p>And as for the believers who acknowledge Him with faith as He makes Himself known; who love and endear Him through servanthood as He inspires love; and who honor Him with gratitude in response to His Mercy – <strong>is it at all possible that the All-Merciful, the All-Compassionate, would not reward them with a world of Eternal Bliss?</strong></p>

<p class="text-center text-red small-title"><strong>Third Truth</strong></p>

<p class="text-center text-center-constrained"><strong><em>The Gate of Wisdom and Justice; A reflection of the Names:</em> “The Wise and The Just” (</strong> <span class="text-arabic-inline" dir="rtl" lang="ar">اَلْحَكٖيمُ وَالْعَادِلُ</span> <strong>)</strong></p>

<p>Is it at all possible<sup>1</sup> that the Awe-Inspiring Entity, Who displays the Sultanate of His Lordship through Wisdom and harmony, through Justice and balance that extend from particles to suns, would not grace the believers who seek refuge under the protective Wing of His Lordship and attune themselves to that Wisdom and Justice through faith and servanthood? And would He not chasten the insolent who defy that Wisdom and Justice with denial and disobedience?</p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> Indeed, the phrase <strong><em>“Is it at all possible”</em></strong> is repeated frequently, for it conveys a profound secret:</p>

 <p class="footnote-p">Most unbelief and misguidance stem from incomprehensibility. In other words, when people deem something remote from reason and improbable, they tend to deny it.</p>

 <p class="footnote-p">However, <strong>“The Treatise on the Regathering”</strong> irrefutably demonstrates that true incomprehensibility, actual improbability, remoteness from reason, and insurmountable difficulties flood the alley of unbelief and the path of misguidance. In contrast, realistic possibilities, reasoned probabilities, and inevitable plausibilities are rooted in the path of faith and the avenue of Islam.</p>

 <p class="footnote-p"><strong>In conclusion,</strong> while philosophers lean toward unbelief due to incomprehensibility, <strong>“The Tenth Word”</strong> exposes where true incomprehensibility lies by repeatedly posing this rhetorical question, delivering them a silencing blow.</p>
</div>

</div>
REGATHERING_PAGE_043,
            ],
            [
                'page_number' => 44,
                'content' => <<<'REGATHERING_PAGE_044'
<div class="page" id="44">
 <p class="text-end page-number">#44</p>

<p>In this temporal world, not even a thousandth of what befits such Wisdom and Justice is enacted upon humanity; their true fulfillment is deferred. The majority of the misguided go unpunished, whereas most of the believers remain unrewarded upon departing from this world.<strong> Thus, an Ultimate Judgment and sublime bliss are yet to come. </strong></p>

<p><strong><em>Verily, it is apparent that the Entity Who governs this world manages affairs with Infinite Wisdom. Do you seek proof?</em> </strong> Observe His commitment to benefit and welfare in every matter. </p>

<p>Do you not see that every part of a human being <em>– from limbs and bones to vessels and even the cells of the body –</em> is aligned with benefits and wisdom? In fact, akin to a fruit-laden tree, certain organs are richly endowed with innumerable beneficial fruits of Wisdom, revealing that all affairs are managed by a Hand of Infinite Wisdom.</p>

<p>Moreover, the presence of infinite order within the artful design of all things demonstrates that affairs are managed with Infinite Wisdom. Indeed, the way a beautiful flower’s intricate program is embedded within a tiny seed, and a vast tree’s page of deeds, life chronicle, and list of components are inscribed within a small kernel by the spiritual Pen of Destiny, clearly reveals that a Pen of Infinite Wisdom is at work.</p>

</div>
REGATHERING_PAGE_044,
            ],
            [
                'page_number' => 45,
                'content' => <<<'REGATHERING_PAGE_045'
<div class="page" id="45">
 <p class="text-end page-number">#45</p>

<p>Furthermore, the presence of exceedingly fine Artistry in the creation of all things signifies that they are woven by an Infinitely Wise Artificer.</p>

<p>Indeed, the way the index of the entire universe, the keys to all treasures of Mercy, and the mirrors of all Divine Names are woven into a tiny human body demonstrates Wisdom embedded within the highest degree of fine Artistry.</p>

<p><strong><em>Now, is it at all possible that such Wisdom, reigning throughout the enactments of Divine Lordship, would not desire to reward and eternally bless the faithful believers who seek refuge under the protective Wing of that Lordship?</em></strong></p>

<p><strong><em>Do you also seek proof that affairs are managed with Justice and balance?</em></strong></p>

<p>Then behold how each being is brought into existence, clothed in a body, and placed in an environment according to precise proportions and specific measures <em>– for it demonstrates that affairs are managed with Infinite Justice and balance.</em></p>

<p>Moreover, the way every being is granted its rights in proportion to its potential <em>– meaning that all the necessities for its existence and all the provisions for its survival are provided in the most fitting manner – </em>reveals a Divine Hand of Infinite Justice.</p>

<p>Furthermore, the constant response to every appeal and request <em>– whether expressed through the language of potential, the language of innate need, or the language of desperation –</em> demonstrates an infinite degree of Justice and Wisdom.</p>
</div>
REGATHERING_PAGE_045,
            ],
            [
                'page_number' => 46,
                'content' => <<<'REGATHERING_PAGE_046'
<div class="page" id="46">
 <p class="text-end page-number">#46</p>

<p>Now, is it at all possible that such Justice and Wisdom, despite rushing to fulfill even the slightest need of the tiniest creature, would overlook the paramount need of the foremost among creation, namely, mankind’s innate desire for eternity? Would it leave humanity’s most urgent plea and deepest request unanswered? Would it not uphold the Majesty of Divine Lordship by securing the rights of Its servants?</p>

<p>Human beings, passing through a fleeting life in this ephemeral world, cannot <em>– and will not –</em> experience the reality of such Justice here. Thus, their account is left to an Ultimate Judgment. For true justice demands that this diminutive human be rewarded or punished not by his physical minuteness, but by the weight of his crime, the value of his being, and the greatness of his duty. Since this impermanent, fleeting world is remote from manifesting such Justice and Wisdom for man, who is fashioned for eternity, it follows that the Just, All-Glorious Possessor of Beauty, and the Wise, All-Beauteous Possessor of Glory, holds dominion over a permanent Hell and an eternal Paradise.</p>

<p class="text-center text-red small-title"><strong>Fourth Truth</strong></p>

<p class="text-center text-center-constrained"><strong><em>The Gate of Munificence and Beauty; A reflection of the Names:</em> “The Munificent and The Beauteous” (</strong> <span class="text-arabic-inline" dir="rtl" lang="ar">اَلْجَوَّادُ وَالْجَمٖيلُُ</span> <strong>)</strong></p>

<p>Is it at all possible that boundless Munificence and Bounteousness; endless wealth; inexhaustible treasures; peerless, timeless Beauty; and flawless, perpetual Perfection would not desire a world of bliss and a feasting haven where grateful supplicants, yearning mirrors, and amazed beholders reside forever?</p>
</div>
REGATHERING_PAGE_046,
            ],
            [
                'page_number' => 47,
                'content' => <<<'REGATHERING_PAGE_047'
<div class="page" id="47">
 <p class="text-end page-number">#47</p>

<p>Verily, beautifying the face of the world with ornate artworks; setting the moon and sun as lamps; shaping the Earth’s surface as a spread of favors laden with the finest varieties of sustenance; fashioning fruit-bearing trees as bountiful bowls; and orchestrating many renewals each season are all acts that demonstrate boundless Munificence and Bounteousness.</p>

<p>Such infinite Munificence and Bounteousness, such inexhaustible treasures and Mercy, call for an everlasting feasting haven and a realm of bliss where all that is desired is ever-present. They also undoubtedly require that those who rejoice in those feasts remain in that blissful realm, residing there forever, lest they be haunted by cessation and separation.</p>

<p class="text-center"><strong>For just as the cessation of pain brings joy, the cessation of joy brings pain. Such boundless Bounteousness does not will to cause such pain; rather, it desires an eternal Paradise inhabited by ever-reliant dwellers.</strong></p>

<p>For infinite Munificence and Bounteousness seek to bestow infinite favors and gifts. Infinite favors and gifts, in turn, require infinite gratitude and receptivity. This necessitates the perpetual existence of beneficiaries, so they may express gratitude and appreciation for those ceaseless bestowals and endless favors. Otherwise, a fragmentary, fleeting joy bound to turn bitter due to its transience cannot harmonize with the demands of such Munificence and Bounteousness.</p>

<p>Moreover, behold the regions of the world fashioned as galleries of Divine Art.</p>
</div>
REGATHERING_PAGE_047,
            ],
            [
                'page_number' => 48,
                'content' => <<<'REGATHERING_PAGE_048'
<div class="page" id="48">
 <p class="text-end page-number">#48</p>

<p>Pay attention to the Lord’s declarations inscribed within the palms of all plants and animals across the globe.<sup>1</sup> Listen to the Prophets and saints, the heralds of the beauties that emanate from Divine Lordship. In unity, they reveal and declare the impeccable perfection of the Awe-Inspiring Artificer, displaying His marvelous artistry as they captivate the attentive eye.</p>

<p>Thus, the Artificer of this world possesses supremely precious and stunning hidden Perfections, which He wills to unveil through these wondrous works of art. For flawless, veiled Perfections desire to be revealed in the presence of witnesses who appreciate and admire them with exclamations of <strong>“Mâshâ’ALLAH.”</strong></p>

<p>Furthermore, eternal Perfections long for perpetual display, which in turn necessitates the everlasting existence of appreciative admirers. For in the eyes of an impermanent admirer, the value of perfections will diminish.<sup>2</sup></p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> Indeed, at the tip of a hair-thin branch of a bone-dry tree, an ornately designed flower and an artfully bejeweled fruit flourish as written declarations, inviting sentient beings to read the resplendent Artistry of a Wondrous, Wise, and Divinely Artistic Artificer. Now expand this analogy from plants to animals...</p>

 <p class="footnote-p"><sup>2</sup> Indeed, consider the classic example: A beauty with no equal in the world once banished a common man from her presence due to his obsessive infatuation. To console himself, he muttered, <em>“Ugh, how ugly she is,”</em> thus denying the beauty’s beauty.</p>

 <p class="footnote-p">Similarly, a bear once wandered beneath a sweet grapevine, longing to eat its fruit. Yet, he could neither reach the grapes nor climb the vine. To soothe himself, he grunted in his own tongue, <em>“They’re sour anyway,” </em>as he lumbered off grumbling.<em>”</em></p>
</div>
</div>
REGATHERING_PAGE_048,
            ],
            [
                'page_number' => 49,
                'content' => <<<'REGATHERING_PAGE_049'
<div class="page" id="49">
 <p class="text-end page-number">#49</p>

<p>And just as the light of day reveals the sun, these exceedingly beautiful, artistic, radiant, and ornate beings spread across the face of the universe reveal the splendors of an incomparable spiritual Beauty and hint at the subtleties of a peerless, hidden Elegance.<sup>1</sup> Such glimpses of Transcendent Elegance and Sacred Beauty signify that each distinct Divine Name contains numerous concealed treasures.</p>

<p>Verily, a hidden Beauty of such unparalleled exaltedness longs to behold Its own Resplendence in a mirror, observing the degrees of Its Elegance and the dimensions of Its Beauteousness in a sentient, desirous reflection. Likewise, It desires to be perceived by others, so that It may witness Its beloved Beauty through their eyes.</p>

<p><strong>Thus, It wills to behold Its own Beauty in two ways:</strong></p>

<p><strong>•	 First,</strong> by directly beholding It in mirrors of varying colors;</p>

<p><strong>•	 Second,</strong> by viewing It through the gazes of desirous beholders and amazed admirers.</p>

<p>Hence, beauty and elegance desire to see and be seen. These acts of seeing and being seen, in turn, necessitate the existence of yearning beholders and amazed admirers.</p>

<div class="page-footnote">
 <hr class="hr-footnote" />
<p class="footnote-p"><sup>1</sup> As beings, in their roles as mirrors, fade and vanish in succession, glimpses of the same elegance and beauty reappear upon the forms and faces of their successors, revealing that beauty is not theirs. Rather, those beauties are Âyât; they are signs of a Transcendent Elegance and a Sacred Beauty.</p>
</div>
</div>
REGATHERING_PAGE_049,
            ],
            [
                'page_number' => 50,
                'content' => <<<'REGATHERING_PAGE_050'
<div class="page" id="50">
 <p class="text-end page-number">#50</p>

<p>Since the Beauty and Elegance in question are eternal and timeless, they also require the perpetual existence of their admirers <em>– for an everlasting Beauty cannot be content with a fleeting admirer. </em>After all, a spectator facing mortality with no hope of return will find his love turning into enmity at the thought of his demise. His wonder will descend into disdain, his reverence will devolve into contempt. For humans, in their self-centeredness, are not only hostile toward the incomprehensible but also resentful of the unattainable. As a result, even before a Beauty worthy of infinite love, boundless passion, and endless admiration, a person may respond with concealed enmity, resentment, and denial. This elucidates the mystery of why the kuffâr are enemies of ALLAH.</p>

<p><strong>In conclusion:</strong></p>

<p>The endless Bounteousness and Munificence, the peerless Beauty and Elegance, and the impeccable Perfections in question necessitate everlasting admirers who are eternally grateful and desirous. Nevertheless, as we observe in this worldly guesthouse, visitors soon depart and disappear. They only get to taste a fraction of that Bounteousness; their appetite is awakened, yet they leave without partaking. Guests merely cast a brief glance at a spark or a faint shadow of that Beauty and Perfection before leaving unsatiated.</p>

<p class="text-center text-center-constrained"><strong>Thus, they journey forth toward an eternal viewing haven.</strong></p>

<p><strong>Overall,</strong> just as this world, with all its existences, conclusively points to its Awe-Inspiring Artificer, so too do the Artificer’s Attributes and Holy Names prove, indicate, and necessitate the Realm of the Hereafter.</p>
</div>
REGATHERING_PAGE_050,
            ],
            [
                'page_number' => 51,
                'content' => <<<'REGATHERING_PAGE_051'
<div class="page" id="51">
 <p class="text-end page-number">#51</p>

<p class="text-center text-red small-title"><strong>Fifth Truth</strong></p>

<p class="text-center text-center-constrained"><strong><em>The Gate of Compassion and Muhammadan Servanthood </em></strong><span class="honorific" dir="rtl" lang="ar">عليه الصلاة والسلام</span><strong><em>; A glimpse of the Names:</em> “The Responder and The Merciful” (</strong> <span class="text-arabic-inline" dir="rtl" lang="ar">اَلْمُجٖيبُ وَالرَّحٖيمُ</span> <strong>)</strong></p>

<p>Is it at all possible that a Lord of Infinite Compassion and Mercy, Who sees the slightest need of His least significant creation and meets it with perfect compassion from unexpected sources; Who hears the softest invocation of His most hidden creature and rushes to its aid; and Who responds to every plea expressed through the language of both being and speech, would see, yet not meet and fulfill the deepest need of His greatest servant,<sup>1</sup> the dearest among His creation?</p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> Indeed, an Eminence whose ever-flourishing sultanate has endured for more than 1,350 years; whose nation has, for the greater part of that span, numbered over 350 million adherents; and whose entire following renews its oath of allegiance to him day by day, bearing witness to his excellence and submitting to his commands with perfect obedience, has imbued half the globe and one-fifth of humanity with his spiritual hue. As the beloved of hearts and the nourisher of souls, he stands, beyond all doubt, as the greatest servant of the Lord Who presides over the universe.</p>

 <p class="footnote-p">Moreover, as nearly every form of existence in the universe bears one of his miraculous fruits in tribute to his task and mission, no doubt remains that this Noble One is the dearest creation of the Cosmic Creator.</p>

<p class="footnote-p">And as eternity is a need that the entirety of humanity, with all its potential, longs for <em>– a need that elevates man from the lowest depths to the loftiest heights –</em> it is indeed the greatest of all needs;<strong> and the greatest of all servants shall beseech the Fulfiller of Needs to grant it on behalf of all.</strong></p>

</div>
</div>
REGATHERING_PAGE_051,
            ],
            [
                'page_number' => 52,
                'content' => <<<'REGATHERING_PAGE_052'
<div class="page" id="52">
 <p class="text-end page-number">#52</p>

<p><strong>Would He hear, yet not accept the loftiest of prayers?</strong></p>

<p>Indeed, the evident beneficence and ease in the nourishment and upbringing of weak and young animals demonstrate that the Owner of this universe wields His Lordship with Infinite Mercy. Could it ever be that such Compassion, so graciously woven into His Lordship, would refuse to grant the most beautiful prayer from the most virtuous of creation?</p>

<p>Drawing from my explanation in <strong>“The Nineteenth Word,”</strong> we shall once again shed light on this truth.</p>

<p><strong><em>O friend who listens along with my nafs!</em></strong></p>

<p>In the symbolic story, we spoke of a gathering on an island where a most noble adjutant delivered a speech. The truth this alludes to is as follows:</p>

<p>Come, let us first detach ourselves from the present, journey in our minds to the Era of Bliss, and envision the Arabian Peninsula. There, we shall visit and observe God’s Noblest Messenger as he carries out his mission, immersed in his servanthood.</p>

<p>Behold! Just as this Eminence, on the basis of his Messengership and guidance, is the key and means to attaining Eternal Bliss, so too is he, on the basis of his servanthood and prayer, the very reason for both the existence of that bliss and the creation of Paradise.</p>

<p>Now observe! As this Eminence prays for Eternal Bliss, he stands in such a sublime Salat, in such an exalted act of worship, that it is as though this entire peninsula<em> – and even the whole world –</em> joins him in his majestic prayer, pleading alongside him.</p>
</div>
REGATHERING_PAGE_052,
            ],
            [
                'page_number' => 53,
                'content' => <<<'REGATHERING_PAGE_053'
<div class="page" id="53">
 <p class="text-end page-number">#53</p>

<p>For his servanthood encompasses not only the servanthood of his loyal Ummah, but also, through the secret of spiritual unity, the essence of the collective servanthood fulfilled by all the Prophets.</p>

<p>Furthermore, he performs that sublime Salat and supplicates amid such a vast communion, that in essence all the luminous and exemplary children of Adam <em>– from Adam’s era to our present age, and onward to the Day of the Arising –</em> follow him in prayer and say <strong>‘Âmîn’</strong> to his supplications.<sup>1</sup></p>

<p>Behold! He prays for needs so universal <em>– such as eternity –</em> that not only the inhabitants of Earth, but also the dwellers of the heavens, and even all of existence, partake in his supplication; in the language of their very being, they say:</p>

<p><strong><em>“Yes, our Lord! Fulfill his wish! Hear his prayer! We also long for it!”</em></strong></p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> Indeed, from the time the Ahmadic supplication <span class="honorific" dir="rtl" lang="ar">عليه الصلاة والسلام</span> was first raised until this very day, all the peace and blessings invoked upon him by his entire Ummah have been an unwavering <em>“Âmîn” </em>to his prayer, in which they all partake. In fact, each <strong>“Salawât”</strong> sent upon him serves as an <em>“Âmîn”</em> to his prayer.</p>

<p class="footnote-p">The peace and blessings offered to him by every member of his Ummah in each Salat, and the invocation recited for him by the Shâfi'îs after every iqâmah, constitute a powerful and universal <em>“Âmîn”</em> to his plea for Eternal Bliss.</p> 

<p class="footnote-p">Verily, as the entirety of humanity, through the language of its being, pleads with all its might for eternal life and bliss, the Ahmadan Eminence <span class="honorific" dir="rtl" lang="ar">عليه الصلاة والسلام</span> intercedes on behalf of all. In response, the luminous segment of humanity aligns behind him, chanting <em>“Âmîn.”</em> Now, could such a prayer ever go unanswered?</p>
</div>
</div>
REGATHERING_PAGE_053,
            ],
            [
                'page_number' => 54,
                'content' => <<<'REGATHERING_PAGE_054'
<div class="page" id="54">
 <p class="text-end page-number">#54</p>

<p>And look! He voices his pleas for Eternal Bliss so emotively, so lovingly, so longingly, and so humbly that he moves the entire universe to tears, inspiring it to join in his prayer.</p>

<p>Observe! In his supplications and prayers for bliss, he pursues purposes so profound that he elevates humanity and all of creation from the lowest depths of complete annihilation, ruin, insignificance, worthlessness, and futility, to the loftiest heights of value, eternity, and exalted designations, raising them to the status of <strong>“Scriptures of The Absolute Refuge (As’Samad).”</strong></p>

<p>Look! He voices his wishes with such pleading intensity and supplicates with such sweet invocations that his prayer reaches and entrances all beings, echoing through the heavens up to the Supreme Throne, stirring them to exclaim: <em>“Âmîn, O ALLAH, Âmîn!”<sup>1</sup></em></p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> Indeed, as the Governor of this world observably orchestrates all His affairs with Awareness, Knowledge, and Wisdom, it is by no means possible for such a Governor to be unaware of the actions undertaken by the most distinguished individual among His creation. Furthermore, it is in no way possible that this All-Knowing Governor, while aware of that distinguished individual’s actions and prayers, would remain indifferent and disregard their significance. Moreover, it is in no sense possible that this Almighty and Merciful Governor, while not indifferent to his prayers, would not grant them. Indeed, by the Light of the Ahmadan Eminence <span class="text-arabic-inline" dir="rtl" lang="ar">عليه الصلاة والسلام</span> the world’s appearance has changed. The true nature of man and the entire cosmos unfolded under that radiant light, revealing that each being in this universe is a letter from the Absolute Refuge <strong>(As'Samad)</strong> through which Divine Names can be read. Every being is a designated official, graced with a precious and meaningful existence, </p>
</div>
</div>
REGATHERING_PAGE_054,
            ],
            [
                'page_number' => 55,
                'content' => <<<'REGATHERING_PAGE_055'
<div class="page" id="55">
 <p class="text-end page-number">#55</p>

<p>Behold! The One Whom he beseeches for bliss and eternity is an Almighty so Hearing and Generous, an All-Knowing so Seeing and Merciful, that even the most concealed wish and the quietest plea of the most hidden lifeform are seen, heard, and compassionately answered by Him. He responds even to supplications expressed through the language of being. He provides and replies in ways so wise, perceptive, and kind that it leaves no room for doubt:</p>

<p><strong>It is He alone </strong><em>– the All-Hearing and All-Seeing, the Generous and Merciful –</em><strong> Who can extend such nurture and care.</strong></p>

<p>Now, as the honor of mankind <strong>– the sole paragon of all creation and time –</strong> stands upon this Earth, immersed in the reality of Ahmadan servanthood <span class="text-arabic-inline" dir="rtl" lang="ar">عليه الصلاة والسلام</span> <em>– which embodies the very essence of humanity’s </em></p>

<p><em>collective servanthood –</em> he gathers all of Adam’s children behind him, raises his palms toward the Supreme Throne, and prays...</p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p">destined for eternity. Were it not for that Light, all beings would have remained submerged within the darkness of delusions as useless, futile, and random playthings of chance, devoid of value and meaning, condemned to absolute annihilation. Hence, due to this secret, it is not only humans who respond with <em>“Âmîn”</em> to the prayers of the Ahmadan Eminence <span class="text-arabic-inline" dir="rtl" lang="ar">عليه الصلاة والسلام</span>, but all existences <em>– spanning from the Supreme Throne to the terrestrial surface, from the geosphere to the Pleiades –</em> proudly display their attachment to his Light. In essence, the very soul of Ahmadan servanthood <span class="text-arabic-inline" dir="rtl" lang="ar">عليه الصلاة والسلام</span> is prayer. In fact, all the motions and functions of the cosmos are forms of prayer. For instance, the movement of a seed is a form of prayer to its Creator, as it seeks to flourish into a tree.</p>
</div>
</div>
REGATHERING_PAGE_055,
            ],
            [
                'page_number' => 56,
                'content' => <<<'REGATHERING_PAGE_056'
<div class="page" id="56">
 <p class="text-end page-number">#56</p>

<p>Let us now hear what the Pride of the Universe is requesting:</p>

<p>Observe! For both himself and his Ummah, he beseeches everlasting bliss. He seeks eternity; he pleads for Paradise. Moreover, in his pleas, he incorporates the desires of all the Divine Names that reveal Their Beauties in the mirrors of existence. He calls upon Those Names to intercede; as you can see…</p>

<p>Even if the countless compelling reasons and proofs for the existence of the Hereafter were missing, a single prayer from this exalted individual alone would suffice to summon Paradise into existence, which, in light of the Merciful Creator’s Power, is as easy as bringing forth our spring.<sup>1</sup></p>

<p>Indeed, how could the creation of Paradise pose any challenge for the Almighty, Who turns Earth’s surface into a gathering ground and brings forth one hundred thousand examples of the Regathering each spring?</p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> Indeed, displaying countless wondrous examples of artistry and depictions of both the Regathering and the Arising upon Earth’s surface <em>– which is but a cramped page in comparison to the Hereafter –</em> and weaving three hundred thousand varieties of perfectly proportioned creations like beautifully written books onto that single page, is unquestionably more challenging than constructing and creating the elegant and well-arranged Paradise in the vast expanse of the Hereafter. Verily, it may be said that as much as Paradise excels spring in loftiness, the creation of Earth’s spring gardens exceeds that of Paradise in complexity and peculiarity.</p>
</div>
</div>
REGATHERING_PAGE_056,
            ],
            [
                'page_number' => 57,
                'content' => <<<'REGATHERING_PAGE_057'
<div class="page" id="57">
 <p class="text-end page-number">#57</p>

<p>Hence, just as the final Prophet’s Messengership is the reason this realm of trial materialized<em> – making him the recipient of the mystery:</em> <sup>1</sup><span class="text-arabic-inline" dir="rtl" lang="ar">لَوْلَاكَ لَوْلَاكَ لَمَا خَلَقْتُ اْلأَفْلَاكَ</span> <em>–</em> so too is his servanthood the reason the realm of bliss in the Hereafter shall arise.</p>

<p>Now, is it at all possible that this mind-astonishing universal Order, this vast Mercy imbued with immaculate Artistry, and this peerless Beauty of Divine Lordship would ever accept something as ugly, merciless, and disharmonious as leaving his prayer unanswered? Could it be that He would heed and fulfill the smallest, least significant wishes and invocations, yet deem the most valuable and crucial ones insignificant, and thus not hear, acknowledge, and fulfill them? God forbid, by no means! Such Beauty could never embrace such ugliness and thereby become ugly Itself.<sup>2</sup> Thus, just as God’s Noblest Messenger <span class="text-arabic-inline" dir="rtl" lang="ar">عليه الصلاة والسلام</span> has opened the gate to this world through his Messengership, so too shall he open the gate to the Hereafter through his servanthood.</p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> <strong>“Were it not for thee, were it not for thee, I would not have created the heavenly spheres.”</strong></p>

<p class="footnote-p"><sup>2</sup> Indeed, it is universally acknowledged that the inversion of truths is impossible. Among such impossibilities, the most preposterous would be the inversion of something into its exact opposite <em>– especially while retaining its essential nature.</em> Consider, for instance, an infinite beauty being both truly beautiful and truly ugly at the same time. Within the context of our discussion, this would imply that the observable and truly existent Beauty of Divine Lordship could somehow maintain its inherent Beauty while simultaneously becoming pure ugliness. <strong>Verily, of all the impossibilities and falsities in the world, this one stands out as the epitome of absurdity.</strong></p>
</div>
</div>
REGATHERING_PAGE_057,
            ],
            [
                'page_number' => 58,
                'content' => <<<'REGATHERING_PAGE_058'
<div class="page" id="58">
 <p class="text-end page-number">#58</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar">عَلَيْهِ صَلَوَاتُ الرَّحْمٰنِ مِلْءَ الدُّنْيَا وَدَارِ الْجِنَانِ</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ وَ سَلِّمْ عَلٰى عَبْدِكَ وَ رَسُولِكَ ذٰلِكَ الْحَبٖيبِ الَّذٖى هُوَ سَيِّدُ الْكَوْنَيْنِ وَ فَخْرُ الْعَالَمَيْنِ وَ حَيَاتُ الدَّارَيْنِ وَ وَسٖيلَةُ السَّعَادَتَيْنِ وَ ذُو الْجَنَاحَيْنِ وَ رَسُولُ الثَّقَلَيْنِ وَ عَلٰى اٰلِهٖ وَ صَحْبِهٖ اَجْمَعٖينَ وَ عَلٰى اِخْوَانِهٖ مِنَ النَّبِيّٖينَ وَ الْمُرْسَلٖينَ اٰمٖينَ</p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> Upon him be the blessings of the All-Merciful, filling the world and the Abode of Paradises. O ALLAH, bestow Your blessings and peace upon Your Servant and Messenger<em> – that Beloved who is the Master of both dimensions, the Pride of both worlds, the Life of both abodes, and the Means to both blisses, the Two-winged Messenger to both man and jinn – </em>and upon all his family and companions, and upon his brethren among the Prophets and Messengers. Âmîn.</p>
</div>
</div>
REGATHERING_PAGE_058,
            ],
            [
                'page_number' => 59,
                'content' => <<<'REGATHERING_PAGE_059'
<div class="page" id="59">
 <p class="text-end page-number">#59</p>

<p><strong>Sixth Truth</strong></p>

<p><strong><em>The Gate of Majesty and Timelessness; A glimpse of the Names:</em> “The Glorious and The Eternal” (</strong><span class="text-arabic-inline" dir="rtl" lang="ar">اَلْجَلٖيلُ وَالْبَاقٖى</span><strong>)</strong></p>

<p>Is it at all possible that a Majestic Lordship, under which all beings<em> – from suns and trees to the smallest particles – </em>are subjugated and governed like obedient soldiers, would be confined to pitiable mortals living fleeting lives in this worldly guesthouse? Would the Supreme Ruler not establish a timeless, eternal sphere befitting His Majesty; an everlasting, exalted center befitting His Lordship?</p>

<p>Indeed, majestic enactments such as the shifting of seasons; grand motions like the maneuvers of planets resembling flying vessels; compelling subjugations exemplified by the Earth serving as man’s cradle and the sun functioning as the world’s lamp; grand transitions like the revival and beautification of a perished, withered globe; and similar visible phenomena across the universe all reveal the presence of a sublime Lordship behind the veil, reigning supreme over a resplendent Sultanate. A Lordship presiding over such a Sultanate seeks worthy subjects and a befitting realm for Its manifestation.</p>

<p>However, as you can see, the subjects and servants endowed with the most comprehensive and prominent nature have briefly gathered in this worldly guesthouse amid a state of turmoil. As for the guesthouse, it fills and empties on a daily basis.</p>
</div>
REGATHERING_PAGE_059,
            ],
            [
                'page_number' => 60,
                'content' => <<<'REGATHERING_PAGE_060'
<div class="page" id="60">
 <p class="text-end page-number">#60</p>

<p>Moreover, all subjects are temporarily stationed in this arena of trial to be tested in service. As for the arena, it consistently changes by the hour.</p>

<p>Furthermore, all those subjects pass through this gallery with a merchant’s eye, viewing samples of the Awe-Inspiring Artificer’s precious gifts and antique artworks arrayed across the sections of the global market. They gaze for a few minutes, then vanish. As for this gallery, it transitions every minute. Whoever leaves never returns; whoever enters inevitably leaves.</p>

<p>Verily, this state and condition conclusively indicate that beyond this guesthouse, this arena, and these galleries, in a realm that is to become the nucleus and manifestation center of that timeless Sultanate, eternal palaces and permanent dwellings exist, surrounded by gardens and treasures filled with the purest and loftiest archetypes of all the examples and images we encounter in this world. Hence, the efforts here are for them; the Lord assigns tasks here and bestows rewards there. A bliss tailored to each person’s potential awaits there, provided one does not forfeit it.</p>

<p>Indeed, such a timeless Sultanate cannot rest upon these transient beings and fleeting shadows. Consider this truth through the lens of the following parable:</p>

<p>As you journey along a path, a roadside mansion catches your eye. You come to realize that a royal figure has constructed it for his guests, spending millions in gold on its decoration to offer them an evening of both enjoyment and reflection.</p>
</div>
REGATHERING_PAGE_060,
            ],
            [
                'page_number' => 61,
                'content' => <<<'REGATHERING_PAGE_061'
<div class="page" id="61">
 <p class="text-end page-number">#61</p>

<p>Visitors are given a brief time to glance at a select few of those decorations and taste a tiny portion of the offerings before departing unsatiated. However, each guest carries a personal camera, capturing images of the things they encounter within the mansion. Moreover, the royal figure’s servants carefully monitor and register each guest’s conduct. You also notice that with each new dawn, the royal host disassembles most of the precious decorations, replacing them with new ones for the forthcoming visitors.</p>

<p>After seeing this, would you still doubt that the one who built this roadside mansion also possesses everlasting, exalted abodes; inexhaustible, invaluable treasures; and perpetual, majestic bounteousness? Through the hospitality he demonstrates in this mansion, he ignites his guests’ appetites for the delights he keeps within his royal presence, awakening a desire for the gifts he has prepared for them.</p>

<p>Similarly, if you observe the state of this worldly guesthouse attentively, without succumbing to drunkenness, you will come to understand the following <strong>“Nine Fundamentals.”</strong></p>

<p><strong>First Fundamental</strong></p>

<p>You will come to understand that this world, much like that mansion, does not exist for its own sake, nor could it have assumed this form by itself. Rather, it is a wisely constructed guesthouse, filling and emptying as the caravans of creation come and go.</p>

<p><strong>Second Fundamental</strong></p>

<p>You will also come to understand that the inhabitants here are but guests; their Generous Lord invites them to the Abode of Peace.</p>
</div>
REGATHERING_PAGE_061,
            ],
            [
                'page_number' => 62,
                'content' => <<<'REGATHERING_PAGE_062'
<div class="page" id="62">
 <p class="text-end page-number">#62</p>

<p><strong>Third Fundamental</strong> You will also come to understand that the adornments of this world are not merely for pleasure or amusement. For while they may offer some momentary joy, their eventual departure leaves behind lingering sorrow. They give you a taste, ignite your appetite, but fail to satiate. Either their lifespan or yours is too short to grant fulfillment. Thus, these precious yet ephemeral embellishments are meant to evoke reflection<sup>1</sup>, inspire gratitude, and kindle a desire for their imperishable archetypes. Hence, they serve many other lofty purposes.</p>

<p><strong>Fourth Fundamental</strong> You will also come to understand that the ornaments of this world serve as examples and illustrations of the favors reserved by the All-Merciful’s Grace for the believers in Paradise.<sup>2</sup></p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> Indeed, although the value and intricate artistry of all things are elevated and beautiful, their duration is brief; their lifespan is short. This indicates that such creations are examples; they serve as images of other realities. And since they naturally seem to redirect the gazes of their audience toward their archetypes, it may surely be concluded, reasoned, and affirmed that these adornments in this world are examples of Paradisal favors, prepared by the Grace of the Compassionate and All-Merciful for His beloved servants.</p>

<p class="footnote-p"><sup>2</sup> Indeed, every being is endowed with an existence that serves multiple purposes and a life that yields diverse outcomes. Contrary to what the misguided assume, beings are not restricted to purposes pertaining solely to this world and the nafs, lest their existence be tainted by the absence of reason and wisdom. In truth, the purposes of every being’s existence and the outcomes of its life are divided into three categories.</p>
</div>
</div>
REGATHERING_PAGE_062,
            ],
            [
                'page_number' => 63,
                'content' => <<<'REGATHERING_PAGE_063'
<div class="page" id="63">
 <p class="text-end page-number">#63</p>


<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><strong>The first and loftiest</strong> one pertains to the being’s Artificer. Its role in this regard is to parade the marvelous jewels of Divine Artistry it is adorned with, presenting them before the Gaze of the Timeless Witness. A mere moment of life will suffice for this Divine Gaze. In fact, even a latent potential prior to materialization, akin to an unrealized intention, is sufficient. Verily, delicate creations that quickly decay, and marvels of Artistry crafted as seeds and kernels that fail to materialize <em>– that is, fail to germinate –</em> fully fulfill this purpose. They are immune to vanity and futility. Thus, the primary purpose of each being is to display the miracles of its Artificer’s Power and the works of His Artistry through its life and existence, presenting them before the Gaze of the Awe-Inspiring Sultan. <strong>The second category</strong> regarding the purpose of existence and the result of life pertains to conscious beings. In this light, every being is a truth-revealing letter, a grace-reflecting ode, and a Wisdom-bearing word from the Awe-Inspiring Artificer, presented before the eyes of angels, jinn, animals, and humans, inviting them to contemplate. Hence, to any conscious observer, it becomes an enlightening source of contemplation. <strong>The third category</strong> regarding the purpose of existence and the result of life pertains to a being’s nafs, which revolves around personal ends such as pleasure, amusement, survival, and comfort. Consider, for instance, the purpose of a servant helming a vast sultan’s ship: only one percent of all ship affairs pertain to his personal wages, while ninety-nine percent serve the sultan’s interests. Similarly, if one aspect of a being’s purpose pertains to its nafs and worldly affairs, the remaining ninety-nine are devoted to its Artificer. Verily, it is by virtue of these varied purposes that Wisdom and frugality harmonize with Munificence and infinite Bounteousness, despite their seeming opposition. The mystery of this harmony unfolds as follows: </p>
</div>
</div>
REGATHERING_PAGE_063,
            ],
            [
                'page_number' => 64,
                'content' => <<<'REGATHERING_PAGE_064'
<div class="page" id="64">
 <p class="text-end page-number">#64</p>

<p><strong>Fifth Fundamental</strong></p>

<p>You will also come to understand that these ephemeral creations are not destined for annihilation; they were not created to make a brief appearance only to then dissolve into oblivion.</p>

<p>Rather, they gather in existence temporarily, assuming a desired state so that their appearances may be recorded, their likenesses preserved, their meanings deciphered, and their outcomes retained. This culminates, for example, in the weaving of timeless displays for the society of eternity. Moreover, they will serve other purposes in the eternal realm...</p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p">From the perspective of specific purposes, Munificence and Bounteousness prevail, manifesting the Name: <strong>“al-Jawwad”</strong> <em>(the Munificent)</em>. In light of these purposes, fruits and grains are beyond calculation, displaying infinite Munificence. Conversely, from the perspective of universal purposes, Wisdom prevails, manifesting the Name: <strong>“al-Hakîm”</strong> <em>(the All-Wise)</em>. Just as a laden tree bears many fruits, every fruit encompasses a multitude of purposes, which are divided into the aforementioned three categories. These universal purposes demonstrate infinite Wisdom and frugality. Thus, despite their seeming incompatibility, infinite Wisdom and infinite Munificence intertwine in perfect harmony. <strong>For example</strong>, one purpose of an army is to maintain public order. To fulfill this objective, the number of available soldiers is more than adequate, and may even seem excessive. However, for duties such as guarding borders and engaging in combat, this number proves to be just sufficient, and thus perfectly aligned with wisdom. Consequently, the wisdom of governance seamlessly harmonizes with its majesty. Hence, it may be asserted that no excess exists within the structure of an army.</p>
</div>
</div>
REGATHERING_PAGE_064,
            ],
            [
                'page_number' => 65,
                'content' => <<<'REGATHERING_PAGE_065'
<div class="page" id="65">
 <p class="text-end page-number">#65</p>

<p>All things are created for eternity, not destruction; their physical disappearance is merely a discharge following the completion of their duty. For as an ephemeral being meets its end in one respect, it continues to exist in many others.</p>

<p>Look, for instance, at this word of Divine Power manifesting as a flower. She briefly glances at us with a smile, then swiftly hides behind the veil of cessation. Yet, like a word flowing from your mouth, she leaves behind thousands of her likenesses for her perceivers, immortalizing her meanings in the minds of her entire audience. Having fulfilled her role of expressing meaning, she departs. But before she fades, she leaves behind her physical form in the memories of each beholder and her spiritual being in every one of her seeds.</p>

<p><strong>Each memory and every seed becomes, as it were, a picture preserving her beauty and a vessel perpetuating her existence.</strong></p>

<p>If such is the case for a creation at the simplest level of life, it becomes clear how deeply mankind<em> – positioned at the highest level of life and endowed with an eternal soul –</em> is interwoven with eternity. For even amid turbulent transitions, the law of formation <em>– which resembles a soul –</em> and the physical likeness of every vast, flowering, and fruit-bearing plant are meticulously perpetuated and preserved within tiny seeds. This signifies how profoundly the human soul <em>– elevated and encompassing by nature, a conscious and luminous law of Divine Command cloaked in a physical body – </em>is bound and inseparably connected to eternity.</p>
</div>
REGATHERING_PAGE_065,
            ],
            [
                'page_number' => 66,
                'content' => <<<'REGATHERING_PAGE_066'
<div class="page" id="66">
 <p class="text-end page-number">#66</p>

<p><strong>Sixth Fundamental</strong></p>

<p>You will also come to understand that man is not a beast with a loose leash around his neck, left to graze wherever he pleases without oversight. On the contrary, the images of all his deeds are captured, and the outcomes of all his actions are recorded for reckoning.</p>

<p><strong>Seventh Fundamental</strong></p>

<p>You will also come to understand that during fall, the withering of the lovely creatures that flourished throughout the realms of summer and spring is not an annihilation, but rather a release upon the completion of their duties.<sup>1</sup> It is also a clearing for the creatures that are to appear in the coming spring<em> – a preparation to receive new appointees and accommodate future officials.</em> At the same time, it serves as a warning from the All-Glorious to conscious beings against the heedlessness that leads them to neglect their duties, and the drunkenness that causes them to forsake their gratitude.</p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> Indeed, as a nourishing treasury of Divine Mercy assumes the form of a tree, the fruits, flowers, and leaves at its tips and twigs gradually age from the moment they appear. Once they conclude their task, they must take their leave, lest the gate be closed to those that follow. Otherwise, the reach of Divine Mercy and the service of their future kin would be obstructed. Moreover, with the withering of their youth, they themselves would fall into a miserable state of despair. Verily, in this light, spring too is a fruitful tree, reminiscent of the Regathering. Every era in human history is a tree of enlightenment. The astonishing gathering ground of the Earth is likewise a tree of power. Indeed, even the entire world is a wondrous tree whose fruits are conveyed to the bazaar of the beyond.</p>
</div>
</div>
REGATHERING_PAGE_066,
            ],
            [
                'page_number' => 67,
                'content' => <<<'REGATHERING_PAGE_067'
<div class="page" id="67">
 <p class="text-end page-number">#67</p>

<p><strong>Eighth Fundamental</strong></p>

<p>You will also come to understand that the Timeless Artificer of this temporal world possesses another, eternal realm to which He guides and draws His servants.</p>

<p><strong>Ninth Fundamental</strong></p>

<p>You will also come to understand that in that realm, the All-Compassionate shall bestow upon His chosen servants: gifts no eye has ever seen, no ear has ever heard, no human heart has ever conceived. <strong>This is our belief. Seventh Truth</strong></p>

<p><strong><em>The Gate of Protection and Preservation;</em> “The Preserver and The Watchful” (</strong> <span class="text-arabic-inline" dir="rtl" lang="ar">اَلْحَفٖيظُ وَالرَّقٖيبُ</span> <strong>) <em>A glimpse of the Names: </em></strong></p>

<p>Is it at all possible that throughout the skies, lands, shores, and seas, Divine Preservation pervades everything <em>– be it wet or dry, small or great, ordinary or exalted –</em> preserving all things within perfect order and balance, sieving their results through a process of accounting, while, on the other hand, when it comes to man <em>– who embodies the grand nature of humanity, holds the rank of Supreme Khilâfah, and carries the task of the Highest Responsibility –</em> will his deeds and actions, despite being tied to God’s universal Lordship, not be preserved, not be filtered through the sieve of accounting, and not be weighed on the scales of Justice to determine befitting punishment or reward? <strong>This can never be the case! </strong></p>

<p>Indeed, the Entity Who governs this universe preserves everything in order and balance.</p>
</div>
REGATHERING_PAGE_067,
            ],
            [
                'page_number' => 68,
                'content' => <<<'REGATHERING_PAGE_068'
<div class="page" id="68">
 <p class="text-end page-number">#68</p>

<p>Order and balance are reflections of Knowledge and Wisdom, as well as Will and Power.</p>

<p>For we see that every creation is brought into existence with perfect order and proportion. Moreover, each physical change it undergoes throughout its life unfolds in an orderly progression, while its overall structure is also subject to a well-ordered system.</p>

<p>Indeed, we see that once a being completes its duty, its life ends as it departs from this visible world. However, the Awe-Inspiring Preserver stores various images of that being in memories<em> – which serve as preserved tablets</em><sup>1</sup><em> –</em> and in mirrors of similitudes. He inscribes much of its life story within its seeds and outcomes, perpetuating it in both overt and covert mirrors.</p>

<p><strong>For example,</strong> the memory of man, the fruit of a tree, the kernel of a fruit, and the seed of a flower each demonstrates the encompassing grandeur of the Law of Preservation.</p>

<p>Do you not see how all the flowering and fruit-bearing beings of a splendorous spring, along with all their specific pages of deeds, laws of formation, and physical likenesses, are written and preserved within compact seeds? In a subsequent spring, these pages unfold according to a reckoning befitting them, giving rise to yet another vast realm of spring with perfect Order and Wisdom, demonstrating how powerfully and comprehensively Divine Preservation pervades.</p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> Look at the footnote in the <strong>“Seventh Outlook.”</strong></p>
</div>
</div>
REGATHERING_PAGE_068,
            ],
            [
                'page_number' => 69,
                'content' => <<<'REGATHERING_PAGE_069'
<div class="page" id="69">
 <p class="text-end page-number">#69</p>

<p>Now, if such fleeting, mundane, impermanent, and insignificant things are preserved with such diligence, could it be that the deeds of man <em>– which yield profound fruits in the hidden world, the Hereafter, the realm of souls, and the universal dominion of Divine Lordship –</em> would not be carefully preserved under a Watchful Eye? By no means!</p>

<p>Indeed, from this particular manifestation of Preservation, it becomes clear that the Owner of all existence devotes great care to the oversight of all that transpires within His Dominion. He wields His Authority with supreme vigilance, upholding His Lordship throughout His Sultanate with utmost attention <strong>– so much so that He Himself records, and commands others to record, even the smallest incident and the merest service.</strong> He preserves the image of whatever unfolds within His Kingdom in various forms. This Preservation signifies that a Grand Ledger of deeds will be opened for accounting. And man in particular, who is endowed with the most comprehensive, noble, and dignified nature among all creation, shall have his significant deeds and weighty actions subjected to a major reckoning and weighing. The pages of his deeds will be laid bare.</p>

<p>Now, could it ever be that man, ennobled with the Khilâfah and the Highest Responsibility, would become a witness to the universal dispositions of Lordship, proclaim his role as <strong>‘Herald of Divine Unity’ </strong>throughout the realms of multiplicity, partake in the glorifications and services of nearly all existences, and ascend to the rank of overseer and witness, only to end up slumbering in the grave, never to be awakened? Will he not be called to account for every one of his deeds, both minor and major? Will he not advance to the grand gathering ground and face the Ultimate Judgment? Absolutely impossible!</p>
</div>
REGATHERING_PAGE_069,
            ],
            [
                'page_number' => 70,
                'content' => <<<'REGATHERING_PAGE_070'
<div class="page" id="70">
 <p class="text-end page-number">#70</p>

</div>
REGATHERING_PAGE_070,
            ],
            [
                'page_number' => 71,
                'content' => <<<'REGATHERING_PAGE_071'
<div class="page" id="71">
 <p class="text-end page-number">#71</p>

<p>Moreover, the Lord’s Power over all future possibilities<sup>1</sup> is attested by all past events that have manifested as miracles of His Might, as He perpetually brings forth winter and spring in the vivid likeness of the Arising and the Regathering. How could any human being hope to vanish into nothingness or hide beneath the soil to escape such an Awe-Inspiring Almighty?</p>

<p>Since this world fails to deliver the reckoning and judgment humanity deserves, it is certain that Ultimate Judgment will come, and sublime bliss will follow.</p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> Indeed, the span of past time, extending from the present back to the very dawn of creation, is entirely composed of actualities. Each day, each year, and each century that has come to pass is a line, a page, or a book outlined by the Pen of Destiny. The Hand of Power has inscribed within them its miraculous Âyât with perfect Wisdom and Order. The realm of the future, on the other hand, spanning from now to the Arising, toward Paradise, and onward into infinity, is an entire domain of possibilities. Hence, the past consists of actualities; the future consists of possibilities. Verily, when these two chains of time are set in contrast, no doubt remains that the One Who brought forth yesterday with all its ordained beings is fully capable of bringing forth tomorrow with all its potential existences. It is also beyond doubt that the beings and wonders within the mysterious expanse of the past are miracles of an Awe-Inspiring Almighty. They bear firm witness that the Almighty is capable of giving rise to the entire future with all its possibilities, unveiling every wonder it contains. Indeed, the creation of a single apple requires the ability to create all the apples in the world and give rise to a splendorous spring. One who cannot bring forth a spring cannot create a single apple, for that apple is woven on the loom of spring. He Who creates one apple can also create an entire spring. In fact, an apple is a miniature illustration of a tree, a garden, and perhaps even the whole universe. Moreover, in terms of artistry, an apple’s seed, which encapsulates the entire life chronicle of a vast tree, is such a wondrous work of art that the One Who designed it with such mastery could never be powerless against anything. In similar fashion, the One Who created the present day can create the Day of the Arising, and the One Who brings forth spring is capable of calling forth the Regathering. </p>

<p class="footnote-p">He Who arranged and displayed all prior worlds upon the thread of time with perfect Wisdom and Order can indeed <strong>– and surely will –</strong> attach and display yet another universe upon the timeline of the future. In various Words, most notably in <strong>“The Twenty-Second Word,”</strong> we have decisively proven that one who cannot create everything cannot create anything, whereas He Who creates a single thing can create all things. Furthermore, when the creation of beings is attributed to One Sole Entity, bringing all beings into existence becomes as effortless as creating a single being, enabling ease to prevail. However, if the act of creation is distributed among a multitude of causes and entrusted to multiplicity, then bringing a single being into existence becomes as difficult as the creation of all things, yielding insurmountable complications.</p>
</div>
</div>
REGATHERING_PAGE_071,
            ],
            [
                'page_number' => 72,
                'content' => <<<'REGATHERING_PAGE_072'
<div class="page" id="72">
 <p class="text-end page-number">#72</p>

<p><strong>Eighth Truth</strong></p>

<p><strong><em>The Gate of Promise and Threat; A glimpse of the Names:</em> “The Beauteous and The Glorious” (</strong> <span class="text-arabic-inline" dir="rtl" lang="ar">اَلْجَمٖيلُ وَالْجَلٖيلُ</span> <strong>)</strong></p>

<p>Is it at all possible that the All-Knowing and Almighty Artificer of these creations would fail to fulfill His repeated Promises and Divine Threats, conveyed through <strong>tawâtur</strong> <em>(mass transmission)</em> by all Prophets and attested through <strong>ijma’</strong> <em>(scholarly consensus)</em> by all faithful devotees and Saints, and thereby <em>– God forbid –</em> display incapacity and ignorance?</p>

<p>Yet, the fulfillment of His Promises and Threats bears no weight upon His Power; it is effortless for Him. In fact, fulfilling them is as easy for Him as bringing back the countless beings of a past spring <em>– whether in exact form</em><sup>1</sup><em> or in likeness</em> <sup>2</sup><em> –</em> in the spring to come.</p>

<p><strong>As for fulfilling His Promise,</strong> it holds utmost importance for us and for all beings <em>– including Himself and the Lordship He wields throughout His Sultanate.</em></p>

<p><strong>Breaking His Promise, </strong>by contrast, contradicts the dignity of His Authority and the comprehensiveness of His Knowledge. For failing to fulfill a promise stems either from ignorance or incapacity.</p>

<p><strong>O denier! Are you aware of how foolish a crime you perpetrate due to your unbelief and denial?</strong></p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> Like roots of trees and grasses.</p>

<p class="footnote-p"><sup>2</sup> Like leaves and fruits.</p>
</div>
</div>
REGATHERING_PAGE_072,
            ],
            [
                'page_number' => 73,
                'content' => <<<'REGATHERING_PAGE_073'
<div class="page" id="73">
 <p class="text-end page-number">#73</p>

<p>For by endorsing your false imagination, your deluded mind, and your deceitful nafs, you belie a Being Who is absolutely unbound by any form of inconsistency or falsity. No breach befits His Honor and Integrity, while all observable matters and affairs attest to His Truthfulness and Veracity. In your limitless insignificance, you commit an infinitely grave crime! You surely deserve severe, infinite punishment for this. Reports of some hell-dwellers having teeth the size of mountains are narrated as a measure to depict the magnitude of their crimes.</p>

<p>Your condition resembles that of a traveler who shuts his eyes to the sunlight and turns inward, gazing into the realm of his imagination, where his illusion <em>– like a firefly –</em> attempts to light his dreadful path with the dim glow of the lantern inside his head.</p>

<p>Indeed, as these manifest beings stand as His sincere Words of truth, and these occurrences in the universe embody His eloquent Âyât of reality, the Divine Haqq has declared a Promise! Surely, He shall fulfill His Promise, establish Ultimate Judgment, and grant sublime bliss!</p>
</div>
REGATHERING_PAGE_073,
            ],
            [
                'page_number' => 74,
                'content' => <<<'REGATHERING_PAGE_074'
<div class="page" id="74">
 <p class="text-end page-number">#74</p>

<p><strong>Ninth Truth</strong></p>

<p><strong><em>The Gate of Giving Life and Death; A glimpse of the Names: </em>“The Ever-Living Sustainer, The Giver of Life and Death” (</strong> <span class="text-arabic-inline" dir="rtl" lang="ar">اَلْحَىُّ الْقَيُّومُ ۞ اَلْمُحْيٖى وَالْمُمٖيتُ</span> <strong>)</strong></p>

<p>Is it at all possible that He Who revives the vast, dead, and withered Earth, and Who <em>– throughout this revival –</em> gathers and presents over three hundred thousand diverse forms of creation, each kind revived as wondrously as the Regathering of humanity, thus demonstrating <strong>His Power</strong>; and Who <em>– throughout this gathering and presentation –</em> weaves perfect distinctions and differentiations throughout their infinitely complex intermingling, thus displaying the comprehensiveness of <strong>His Knowledge</strong>; and Who, in all of His Heavenly Decrees, promises the Regathering of humanity, drawing the gaze of all His servants toward Eternal Bliss; Who aligns all beings side by side, shoulder to shoulder, hand in hand, making them revolve within the sphere of His Command and Will, appointing them as interdependent helpers to one another, thus exhibiting the grandeur of <strong>His Lordship</strong>; Who fashions <em>‘man’</em> as the most encompassing, delicate, tender, precious, and needy fruit from the Tree of Creation, choosing him as His addressee, subjugating all things to his service, thus revealing how highly He values humanity <strong>– all in all, is it at all possible that such a Merciful Almighty, such an All-Knowing All-Wise, would not bring about the Arising? </strong></p>

<p><strong>Would or could He not bring to pass the Regathering and revive mankind? </strong></p>
</div>
REGATHERING_PAGE_074,
            ],
            [
                'page_number' => 75,
                'content' => <<<'REGATHERING_PAGE_075'
<div class="page" id="75">
 <p class="text-end page-number">#75</p>

<p><strong>Would He not be able to establish the Ultimate Judgment, and create both Paradise and Hell? God forbid!</strong></p>

<p>Indeed, every century, every year, and every day, the Glorious Governor of this world unfolds upon this Earth’s narrow, temporal surface, numerous likenesses, examples, and signs of the Grand Gathering and the Field of the Arising.</p>

<p>For instance, during the spring gathering, we witness that within five to six days, He gathers and presents over three hundred thousand species of animals and plants, both small and large. He revives the roots of all trees and grasses, along with certain animals, restoring them to their former state. Other species He brings forth as near-perfect replicas of their predecessors. Although seeds with subtle material differences lie so densely intermingled, within a span of six days or six weeks, they emerge with clear-cut distinctions and unique identities, as they are swiftly, extensively, and seamlessly brought to life with perfect order and balance. Could anything ever weigh heavily upon the One performing these tasks? Would He be unable to create the heavens and the Earth in six days, or regather mankind with a single call? God forbid!</p>

<p>Imagine a scribe of miraculous skill who, within one hour, beautifully rewrites and fully restores three hundred thousand books <em>– whose letters had either become blurred or lost –</em> all onto a single page, without any confusion, omission, or flaw. Now suppose someone says to you: <em>“This writer, who originally authored your book that fell into the water, will completely rewrite it from memory in less than a minute.”</em> Could you then say: <em>“Impossible; I don’t believe it!”</em> ?</p>
</div>
REGATHERING_PAGE_075,
            ],
            [
                'page_number' => 76,
                'content' => <<<'REGATHERING_PAGE_076'
<div class="page" id="76">
 <p class="text-end page-number">#76</p>

<p><strong>Or imagine a sultan</strong> of miraculous authority who, with a mere gesture, moves mountains, reshapes continents, and turns seas into land, all as a display of power, offering both reflection and enjoyment. After witnessing this, you notice that a massive boulder has rolled into a valley, blocking the path of the guests whom the sultan had personally invited to his feast. They are unable to proceed...</p>

<p>Now, if someone were to tell you: <em>“With one gesture, the sultan will move or shatter that boulder, however large it may be. He will not leave his guests stranded on the road.” </em></p>

<p>Would you then say: <em>“He will not move that boulder”</em> ? Or:<em> “He is incapable of doing so”</em> ?</p>

<p><strong>Or imagine a ruler</strong> who, in a single day, raises an entire army of immense magnitude. Soon after, someone declares: <em>“With the sound of a horn, that ruler will summon the resting soldiers of the dispersed battalions, rallying them back into formation.” </em></p>

<p>If you were then to say: <em>“I don’t believe it,” </em>you would surely recognize how absurd that response would be…</p>

<p>Verily, if these three parables are clear to you, then behold! Before our very eyes, the Timeless Author turns over the white page of winter, unfolds the green leaves of spring and summer, and wields the Pen of Power and Destiny, composing upon Earth’s surface over three hundred thousand species in the finest of forms: intricately interwoven, yet distinctly separate; inscribed simultaneously, but never overlapping; in diverse designs, all are drafted impeccably, unblemished by any confusion or flaw.</p>
</div>
REGATHERING_PAGE_076,
            ],
            [
                'page_number' => 77,
                'content' => <<<'REGATHERING_PAGE_077'
<div class="page" id="77">
 <p class="text-end page-number">#77</p>

<p>Indeed, as the All-Wise Preserver places and preserves the soul-program of a grand tree within a dotsized seed, who could question His Ability to preserve the souls of the deceased? And as the Almighty spins the globe like a pebble in a sling, who could doubt His Power to remove or scatter the Earth from the path of His guests journeying to the beyond?</p>

<p>Moreover, as the Awe-Inspiring Entity raises all legions of life from nothing, recruiting and positioning particles with perfect order into the battalions of their <sup>1</sup><span class="text-arabic-inline" dir="rtl" lang="ar">كُنْ فَيَكُونُ</span> ,thereby physical bodies by His command: bringing forth new armies, who could question His Ability to gather <strong>– with one call –</strong> the fundamental particles and core elements of these battalion-like bodies, which have been mutually acquainted since their initial assembly?</p>

<p>Furthermore, much like the spring gathering, in every era and century of the world, in every alternation of day and night, and even in the formation and dissipation of each cloud in the sky, you witness with your own eyes how many of the patterns He weaves can serve as examples, illustrations, and signs of the Regathering. If you picture yourself a thousand years ago and compare the two wings of time <em>– the past and the future –</em> you will behold as many illustrations of the Regathering and examples of the Arising as the number of centuries and days they span. Hence, having witnessed so many examples and illustrations, if you were still to regard the physical Regathering as beyond reason and reject it as improbable, you surely would realize how nonsensical that would be.</p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> “<em>(ALLAH says)</em> Be! and it is.”</p>
</div>
</div>
REGATHERING_PAGE_077,
            ],
            [
                'page_number' => 78,
                'content' => <<<'REGATHERING_PAGE_078'
<div class="page" id="78">
 <p class="text-end page-number">#78</p>

<p>See what the Supreme Decree declares regarding the truth we are discussing:</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar">فَانْظُرْ اِلٰۤى اٰثَارِ رَحْمَتِ اللّٰهِ كَيْفَ يُحْيِى اْلأَرْضَ بَعْدَ مَوْتِهَا اِنَّ ذٰلِكَ لَمُحْيِ الْمَوْتٰى وَهُوَ عَلٰى كُلِّ شَىْءٍ قَدٖيرٌ<sup>1</sup></p>

<p><strong>In conclusion: nothing opposes the Regathering, whereas everything necessitates it.</strong> Indeed, He Who gives death and grants life to this marvelous gathering ground <em>– this vast Earth –</em> as though it were a simple life-form, and makes it serve as a comfortable cradle, a magnificent ship for both man and beast; He Who sets the sun as an illuminating, warming lamp for the inhabitants of this guesthouse, and ordains the planets as flying vessels for His angels, wields such a splendorous and timeless Lordship, such a majestic and universal Dominion, that it surely cannot rest and stand solely upon these fleeting, discontinuous, uncertain, trivial, ever-changing, impermanent, deficient, and incomplete affairs of the world.</p>

<p>Thus, beyond this earthly life, there exists a perpetual, imperishable, and resplendent realm <em>– one worthy of His Lordship and Dominion.</em> He possesses another, eternal Kingdom, toward which He directs our efforts and to which He invites us all… And all the leading bearers of radiant souls, luminous hearts, and enlightened minds <em>– those who have ascended from the apparent to the Truth, and have been honored with the nearness of His Presence –</em> bear witness that He shall transfer us there.</p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> “Behold the signs of ALLAH's Mercy: how He revives the earth after its death. Indeed, it is He Who brings the dead to life, and He has Power over all things.” - Qur’ân, 30:50</p>
</div>
</div>
REGATHERING_PAGE_078,
            ],
            [
                'page_number' => 79,
                'content' => <<<'REGATHERING_PAGE_079'
<div class="page" id="79">
 <p class="text-end page-number">#79</p>

<p>Unanimously, they declare that He has prepared both reward and punishment, as they consistently relay His unwavering promises and fierce threats. As for breaking a promise, it is both disgraceful and dishonorable <strong>– forever distanced from His Glory and Holiness.</strong> As for withdrawing a threat, it stems either from forgiveness or from incapacity. However, unbelief is an ultimate crime<sup>1</sup> beyond forgiveness, and the Almighty is exalted and sanctified above all incapacity.</p>

<p>As for the witnesses and reporters, despite differing in their paths, mentalities, and madhhabs, they are in perfect agreement on the essence of this matter. In terms of number, they have reached the level of <strong>tawâtur</strong> <em>(mass transmission)</em>. In terms of authority, they bear the strength of <strong>ijmâ’</strong> <em>(scholarly consensus)</em>. In status, each of them is a radiant star of humanity, a vigilant eye of a community, and a revered figure of a nation. In terms of their significance, they are both experts and verifiers in this matter.</p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> Indeed, since unbelief <em>(kufr)</em> robs all beings of their worth and accuses them of meaninglessness, it is an insult to the entire universe. And since it denies the glimpses of God’s Names reflected in the mirrors of all existence, it constitutes a mockery of all the Divine Names. And since it rejects the testimonies of all creation to Divine Unity, it amounts to a denial of all beings. Thus, it corrupts human potential to the point where all worthiness to accept righteousness and goodness is lost. It is an immense injustice; a transgression against the rights of all creation and all Divine Names. The preservation of these rights, coupled with the inability of the unbelieving nafs to accept goodness, renders unbelief unforgivable. <span class="text-arabic-inline" dir="rtl" lang="ar">اِنَّ الشِّرْكَ لَظُلْمٌ عَظٖيمٌ</span><em>“ Indeed, ascribing partners to God is a grievous injustice.” </em>- Qur’ân, 31:13 conveys this very meaning.</p>
</div>
</div>
REGATHERING_PAGE_079,
            ],
            [
                'page_number' => 80,
                'content' => <<<'REGATHERING_PAGE_080'
<div class="page" id="80">
 <p class="text-end page-number">#80</p>

<p>In any branch of science or art, two experts outweigh thousands of non-experts; and in the field of reporting, two verifiers are favored over thousands of deniers. For example, if two men report the appearance of the Ramadan crescent, their testimony nullifies the denial of thousands.</p>

<p><strong>All in all, in this world, there can be no report more reliable, no claim more solid, no truth more evident than this. Thus, it is beyond doubt that this world is a seedbed. The Gathering Ground is a threshing floor. And Paradise and Hell are the storehouses of the harvest.</strong></p>

<p><strong>Tenth Truth</strong></p>

<p><strong><em>The Gate of Wisdom, Providence, Mercy and Justice; A reflection of the Names: </em>“The All-Wise, The Generous, The Just, and The Merciful.” (</strong> <span class="text-arabic-inline" dir="rtl" lang="ar">اَلْحَكٖيمُ ۞ اَلْكَرٖيمُ ۞ اَلْعَادِلُ ۞ اَلرَّحٖيمُ</span> <strong>)</strong></p>

<p>Is it at all possible that in this impermanent guesthouse of the world, this ephemeral arena of trial, this unstable gallery of the Earth, the Awe-Inspiring Owner of all Dominion would display signs of such radiant Wisdom, such evident Providence, such overwhelming Justice, and such vast Mercy, and yet within the sphere of His Domain <em>– spanning both the outer and inner worlds –</em> there would be no perpetual dwellings with everlasting dwellers, nor permanent habitations with eternal inhabitants, thus causing the truths of this manifest Wisdom, Providence, Justice, and Mercy to fade into oblivion?</p>
</div>
REGATHERING_PAGE_080,
            ],
            [
                'page_number' => 81,
                'content' => <<<'REGATHERING_PAGE_081'
<div class="page" id="81">
 <p class="text-end page-number">#81</p>

<p>And could it ever be that this All-Wise Entity, Who chose man above all creation as His comprehensive addressee and universal mirror, would allow him to taste, measure, and identify all that lies within the treasuries of His Mercy, revealing Himself to him through all His Divine Names, loving him and making him beloved, only to ultimately deny this piteous man entry into His eternal Kingdom? Would He not invite him to that haven of everlasting joy and grant him bliss?</p>

<p>Moreover, is it at all conceivable that He would charge even a being as tiny as a seed with the task of a tree, endow it with wisdom as varied as its blossoms, and enrich it with benefits as abundant as its fruits, only to devote all those tasks, all that wisdom, and all those benefits to a worldly end as minute as a seed? Would He confine their ultimate aim to an earthly existence worth less than a mustard seed? Would He not ordain them as seeds for the realm of meaning and as seedbeds for the realm of the Hereafter, enabling them to attain their true and worthy purposes? Would He leave all these grand ceremonies without purpose, all void and in vain? Would He not turn their faces toward the realm of meaning and the world of the Hereafter, so that their true purposes and their befitting fruits may come to light?</p>

<p>Indeed, is it at all possible that by rendering these matters so contrary to the truth, He would portray His true Attributes <strong>– the Wise, the Generous, the Just, and the Merciful –</strong> as, God forbid, their very opposites, thereby belying all the truths in the universe that bear witness to His Wisdom and Generosity, His Justice and Mercy? Would He reject the testimonies of all beings and invalidate the proofs presented by all creation?</p>
</div>
REGATHERING_PAGE_081,
            ],
            [
                'page_number' => 82,
                'content' => <<<'REGATHERING_PAGE_082'
<div class="page" id="82">
 <p class="text-end page-number">#82</p>

<p>And can the mind ever conceive that He would burden man’s outer and inner faculties with tasks as numerous as the hairs on his head, only to reward him with a mere strand’s worth of earthly gain? Would He perform an act that violates His perfect Justice and defies His perfect Wisdom?</p>

<p>And is it at all possible that He would endow every living being, each organ <em>– such as the tongue –</em> and every creation with as many varieties of wisdom and benefits as the fruits of a tree, thereby proving and demonstrating Himself to be the Absolute All-Wise, yet when it comes to the greatest wisdom, the foremost benefit, and the paramount outcome <em>– those that define wisdom as wisdom, favor as favor, and mercy as mercy, embodying the very source and purpose of all wisdoms, favors, mercies, and benefits –</em> namely, the granting of eternal existence, everlasting union, and infinite bliss, would He then suddenly draw back and cast all His works into the abyss of sheer futility? Would He liken Himself to one who builds a magnificent palace, adorning each stone with thousands of motifs, decorating every wall with thousands of embellishments, and furnishing every room with thousands of valuable tools and household necessities, only to leave it without a roof, causing everything within to decay and spoil in vain? <strong>God forbid!</strong></p>

<p><strong>From pure Goodness comes forth goodness. From Pure Beauty comes forth beauty. From the Absolute All-Wise, nothing futile can ever arise.</strong></p>
</div>
REGATHERING_PAGE_082,
            ],
            [
                'page_number' => 83,
                'content' => <<<'REGATHERING_PAGE_083'
<div class="page" id="83">
 <p class="text-end page-number">#83</p>

<p>Indeed, whoever mounts the steed of thought and journeys through the corridors of history will find that this world, which we now experience as a temporal abode, an arena of trial, and a gallery of creations, has been preceded by as many abodes, arenas, galleries, and worlds as there are bygone years. Though they may differ in appearance and condition, they all share a resemblance in order and wonder, each displaying the Artificer’s Power and Wisdom.</p>

<p>Moreover, amid those unstable abodes, those ephemeral arenas, and those impermanent galleries, the explorer of history will behold orderly manifestations of a Wisdom so striking, signs of a Providence so clear, indications of a Justice so overwhelming, and fruits of a Mercy so encompassing that <em>– provided he is not blind –</em> he will fully discern that a Wisdom more perfect, a Providence more beautiful, a Justice more glorious, and a Mercy more embracing lie beyond all bounds of possibility and imagination.</p>

<p>If, assuming the impossible, within the Dominion of the Timeless Sultan <em>– Who governs these affairs, replaces these guests, and changes these guest quarters –</em> there were to be no permanent stays, no lofty spaces, no stable stations, nor perpetual dwellings inhabited by eternal residents and blissful subjects, then the truths of the four Spiritual Elements <strong>– Wisdom, Justice, Providence, and Mercy –</strong> which pervade as powerfully and universally as light, air, water, and earth, would have to be rejected. Their very existence, as perceptible as these four physical elements, would likewise have to be denied. For this ephemeral world and all it contains clearly cannot fully express their truths.</p>
</div>
REGATHERING_PAGE_083,
            ],
            [
                'page_number' => 84,
                'content' => <<<'REGATHERING_PAGE_084'
<div class="page" id="84">
 <p class="text-end page-number">#84</p>

<p>Should there be no other realm where they can fully manifest, then <em>– akin to the lunacy of denying the sun’s existence while beholding the day bathed in its light –</em> one would have to deny the Wisdom evident in all that lies before our eyes, the Providence we continually witness within ourselves and throughout creation, the Justice<sup>1</sup> whose powerful signs are clearly visible, and the Mercy we perceive across all of existence. Moreover, one would have to presume that the Orchestrator of all these wise enactments, generous deeds, and gracious gifts we observe in the universe is <em>– God forbid –</em> a reckless trickster and a cruel tyrant, which constitutes an utterly impossible inversion of truths. Even the deluded Sophists who deny all existence, including their own being, would hesitate to entertain such a thought.</p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> Indeed, Justice has two forms: distributive and retributive. <strong>Distributive Justice entails</strong> granting each being its due rights. This form of Justice exerts an observable influence in this world. For, as proven in the <strong>“Third Truth</strong><em>,</em><strong>”</strong> every being’s appeal to the Awe-Inspiring Originator <em>– whether expressed through the language of potentiality, innate need, or desperation –</em> is visibly answered in accordance with precise balances and subtle measurements, ensuring that all the rights essential to its existence and life are justly provided. Thus, this form of Justice is as certain as existence and life itself. <strong>The second form is retributive,</strong> which entails disciplining the wrongdoers. That is, delivering Justice to the unjust through chastisement and punishment. Although this form does not fully manifest in this world, countless signs and indications render the presence of this truth perceptible. Indeed, from the tribes of Âd and Thamud to the rebellious nations of our era, the disciplinary blows and torturous lashes that struck them plainly display the reign of a supremely exalted Justice.</p>
</div>
</div>
REGATHERING_PAGE_084,
            ],
            [
                'page_number' => 85,
                'content' => <<<'REGATHERING_PAGE_085'
<div class="page" id="85">
 <p class="text-end page-number">#85</p>

<p><strong>In conclusion:</strong></p>

<p><strong>T</strong>hese visible dispositions of the world <em>– encompassing the vast gatherings of life and swift separations of death, the magnificent assemblies and rapid dispersals, the majestic ceremonies and grand manifestations – </em>are utterly disproportionate to their minor earthly yields and fleeting, futile purposes we perceive in this transitory world. It is as though a mere pebble were endowed with mountains of wisdom and purpose, while a massive mountain were assigned a purpose worth but a mere pebble <em>– a notion no reason or intelligence can accept.</em></p>

<p>Thus, the fact that these beings and dispositions are so disproportionate to their worldly purposes attests with absolute certainty that these existences have their faces turned toward the world of meaning. Their befitting fruits are borne there; their eyes are fixed upon the Sacred Names; their aims are directed toward that higher realm. Their essences flourish beneath the soil of earthly life; their blossoms bloom in the World of Similitudes. Man, in proportion to his potential, sows and is sown here <em>– he shall reap his harvest in the Hereafter. </em></p>

<p>Indeed, if you behold the faces of created things oriented toward the Divine Names and the world of the Hereafter, you will see that each seed, emerging as a Miracle of Power, encapsulates a purpose as grand as</p>

<p>a tree.</p>
</div>
REGATHERING_PAGE_085,
            ],
            [
                'page_number' => 86,
                'content' => <<<'REGATHERING_PAGE_086'
<div class="page" id="86">
 <p class="text-end page-number">#86</p>

<p>Each flower, unfurling as a Word of Wisdom, contains meanings as plenteous as the blossoms on a tree. And each fruit, appearing as a marvel of Artistry and a symphony of Mercy, bears wisdoms as abundant as the fruits on a tree. Serving as our sustenance is but one wisdom among thousands; once it fulfills its duty and conveys its meaning, it perishes as it is buried in our stomach.</p>

<p>Given that these fleeting beings yield eternal fruits elsewhere, leave behind everlasting images, express immortal meanings, and offer timeless glorifications, and since perceiving these facets of things enables man to truly attain humanity <em>– finding a path to eternity amid the ephemeral –</em> it follows that these beings, which gather and disperse in the vortex of life and death, serve a higher purpose.</p>

<p><strong>The use of similitudes is not amiss:</strong></p>

<p>These conditions resemble scenarios designed and structured for imitation and representation. At times, brief gatherings and dispersals are arranged at great expense, with the aim of capturing and compiling images for perpetual cinematic display.</p>

<p>Similarly, in this world, the purpose of experiencing a brief personal and communal life includes capturing and compiling images, collecting and preserving the results of deeds, so that they may be judged in a grand assembly, displayed in a magnificent exposition, and presented as testimony to one’s suitability for sublime bliss. Hence, this truth is conveyed in the Sacred Hadîth:</p>

<p><strong>“This world is a harvest field for the Hereafter.”</strong></p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> <strong>Question: If asked:</strong> <em>“Why do you primarily draw examples from flowers, seeds, and fruits?”</em> <strong>The answer:</strong> Because they are among the most antique, wondrous, and delicate miracles of Power. Moreover, since naturalists, philosophers, and the people of misguidance failed to read the fine script inscribed within them by the Pen of Destiny and Power, they plunged into the swamp of naturalism and drowned in it…</p>
</div>
</div>
REGATHERING_PAGE_086,
            ],
            [
                'page_number' => 87,
                'content' => <<<'REGATHERING_PAGE_087'
<div class="page" id="87">
 <p class="text-end page-number">#87</p>

<p>Since the world exists, and since Wisdom, Providence, Mercy, and Justice also exist <em>– as evidenced by their traces in the world – </em>it is as certain as the world’s own existence that the Hereafter also exists. Given that everything in this world is <em>– in one way or another –</em> oriented toward that realm, it follows that we are journeying toward it. Thus, denying the Hereafter is equivalent to denying the world and all that it contains.</p>

<p><strong>All in all, just as the fated hour and the grave await man, so too do Heaven and Hell longingly await his arrival.</strong></p>
</div>
REGATHERING_PAGE_087,
            ],
            [
                'page_number' => 88,
                'content' => <<<'REGATHERING_PAGE_088'
<div class="page" id="88">
 <p class="text-end page-number">#88</p>

<p><strong>Eleventh Truth</strong></p>

<p><strong><em>The Gate of Humanity; A glimpse of the Name:</em> “The Haqq” (</strong> <span class="text-arabic-inline" dir="rtl" lang="ar">اَلْحَقُّ</span> <strong>)</strong></p>

<p>Is it at all possible that the Divine Haqq, the Rightfully Worshiped One, in view of His Absolute Lordship over all worlds within this universe, would create man as His most significant servant before His Universal Lordship; the most contemplative addressee of His Glorious Discourses; and the most encompassing mirror to the manifestation of His Names, enabling him to reflect both the <strong>“Grandest Name”</strong> and the grandest degree of each Divine Name by fashioning him in the finest of forms; as the most beautiful miracle of Power; as an analyst equipped with the most intricate scales and instruments to measure, recognize, and explore the treasures of His Mercy; making him the most reliant on His endless favors, the most pained by annihilation, the most desirous of eternity; the most frail, sensitive, poor, and needy among all living beings; the most prone to suffering and misery in worldly life, yet the most exalted and elevated in potential and nature; only to ultimately deny him admission to an eternal realm befitting his potential, yearning, and worth, thereby negating the very truth of humanity? Would He thus flagrantly defy His Own Veracity by perpetrating an injustice utterly repugnant in the sight of truth?</p>

<p>Moreover, can it at all be that the Rightful Ruler, the All-Merciful One, would endow man with such potential, empowering him to shoulder the Highest Responsibility that the Earth, the skies, and the mountains dared not bear; that is, to assess and recognize <em>– through his personal, finite measures and endeavors –</em> the encompassing Attributes, universal Dispositions, and infinite manifestations of his Creator, Who created him as the most frail, delicate, sensitive, powerless, and weak among all earthly beings, yet appointed him as an official steward over all the plant and animal species on Earth, allowing him to partake in their glorifications and worship, thus portraying him as a microcosm of His Divine activities across the cosmos, revealing through him, in both word and deed, His Glorious Lordship over the universe, favoring him over His angels, and granting him the rank of Khilâfah, only to then withhold from him the ultimate aim, result, and fruit of all these bestowals <strong>– namely, Eternal Bliss?</strong> Would He cast him down into the most wretched, hopeless, miserable, sorrowful, and demeaning of states among all creation, converting the most blessed, luminous, and blissful gift from Divine Wisdom <strong>– the intellect –</strong> into a cursed, dark tool of torture for that poor mortal, inflicting a cruelty utterly contrary to His Absolute Wisdom and wholly opposed to His Absolute Mercy? <strong>God forbid! Never!</strong></p>
</div>
REGATHERING_PAGE_088,
            ],
            [
                'page_number' => 89,
                'content' => <<<'REGATHERING_PAGE_089'
<div class="page" id="89">
 <p class="text-end page-number">#89</p>

<p><strong>In conclusion: </strong></p>

<p>As portrayed in the symbolic story, when we looked at an officer’s identity card and handbook, his rank, his assignments, his salary, his code of conduct, and his equipment all showed that his service was not confined to that temporal arena of duty, but rather designed for a permanent homeland awaiting his arrival; likewise, all the subtleties in the <strong>“identity card”</strong> of the human heart, all the senses in the <strong>“handbook”</strong> of the human mind, and all the tools embedded in human potential are entirely and unitedly oriented toward, designed for, and provided in accordance with Eternal Bliss. Investigators of Truth and spiritual explorers unanimously attest to this.</p>

<p>For example, if the servant and portraitist of the mind, known as the <strong>“faculty of imagination,”</strong> were told: <em>“You shall be granted a million years of life, along with dominion over the entire world, but in the end, you will unavoidably vanish into nothingness,”</em> then, provided that delusions do not mislead and the nafs does not intrude, one would not respond with a cry of joy but with a sigh of sorrow. This shows that even the greatest offering of the ephemeral cannot satisfy the smallest of man’s inner faculties.</p>

<p>Verily, it is due to this human potential that his ambitions <em>– which extend toward eternity –</em> his thoughts <em>– which encompass the whole universe –</em> and his desires <em>– which stretch across all the varieties of Eternal Bliss –</em> all show that man is created for eternity and is journeying toward infinity. This world is but a guesthouse for him, a waiting salon for his everlasting afterlife.</p>
</div>
REGATHERING_PAGE_089,
            ],
            [
                'page_number' => 90,
                'content' => <<<'REGATHERING_PAGE_090'
<div class="page" id="90">
 <p class="text-end page-number">#90</p>

<p><strong>Twelfth Truth</strong></p>

<p><strong><em>The Gate of Prophethood and Revelation; A glimpse of: “In the Name of ALLAH, The Merciful, The Compassionate”</em></strong></p>

<p class="text-center text-arabic-bismillah" dir="rtl" lang="ar"><img src="/images/bismillah .svg" alt="Bismillah" class="bismillah-svg bismillah-svg-light"><img src="/images/bismillah-dark.svg" alt="Bismillah" class="bismillah-svg bismillah-svg-dark"></p>

<p>Verily, as all Prophets <em>– supported by their miracles –</em> endorsed his words; as all saints <em>– supported by their spiritual discoveries (kashf) and karamât –</em> affirmed his call; and as all purified sages <em>– supported by their investigations –</em> testified to his veracity, the Noblest Messenger ,<span class="text-arabic-inline" dir="rtl" lang="ar">ﷺ</span> drawing strength from a thousand verified miracles, wielded all his might in unity with the All-Wise Qur'ân <em>– which itself is miraculous in forty aspects, resting upon thousands of indisputable Âyât –</em> as he definitively laid bare the path to the Hereafter and opened the gate to Paradise. Now, is it at all possible that flimsy whims, no stronger than a fly's wing, could ever seal what he has laid open?</p>

<p>From the foregoing <strong>“Truths,”</strong> it has become clear that the <strong>“Regathering”</strong> is such a firmly rooted truth that not even a force powerful enough to hurl the Earth out of its orbit and shatter it could so much as shake it. For this truth is established by the Divine Haqq, as necessitated by all His Names and Attributes; it is affirmed by the Noblest Messenger through all his miracles and proofs; it is substantiated by the All-Wise Qur’an through all Its Âyât and truths; and it is attested to by the universe itself, through all its cosmic Âyât and its wisdom-infused dispositions.</p>
</div>
REGATHERING_PAGE_090,
            ],
            [
                'page_number' => 91,
                'content' => <<<'REGATHERING_PAGE_091'
<div class="page" id="91">
 <p class="text-end page-number">#91</p>

<p>Now, could it ever be that in the matter of the <strong>“Regathering,”</strong> the Necessary Being and all of existence <em>– apart from the kuffâr –</em> stand united, yet satanic whispers and doubts, without even the strength of a single hair, could shake and shatter such a deeply rooted, lofty mountain of truth? <strong>God forbid – never!</strong></p>

<p>Do not presume that the proofs of the Regathering are limited to the <strong>“Twelve Truths”</strong> we have discussed. Far from it! The Qur’an al-Hakîm alone <em>– beyond teaching us these </em><strong>“Twelve Truths” </strong><em>–</em> alludes to thousands of other aspects, each constituting a powerful sign that our Creator shall transfer us from this ephemeral world to an eternal realm.</p>

<p>Moreover, as we pointed out earlier, do not assume that the Divine Names requiring the Regathering are restricted to the Names: <strong>“the All-wise,” “the Generous,” “the Merciful,” “the Just,”</strong> and <strong>“the Preserver.”</strong> Far from it! All the Divine Names that manifest in the governance of the universe not only necessitate, but indeed demand the Hereafter.</p>

<p>Furthermore, do not presume that the cosmic Âyât throughout the universe indicating the Regathering are confined to those we have explored thus far. Far from it! Like curtains revealing both left and right when drawn, most beings possess aspects and capacities that, on one side, attest to the Artificer, and on the other, point to the Regathering. <strong>For example,</strong> just as the exquisite artistry within the finest form bestowed upon man reveals the Artificer, so too does the swift demise of his encompassing capacity, housed within that sublime form, reveal the Regathering.</p>
</div>
REGATHERING_PAGE_091,
            ],
            [
                'page_number' => 92,
                'content' => <<<'REGATHERING_PAGE_092'
<div class="page" id="92">
 <p class="text-end page-number">#92</p>

<p><strong>Sometimes, viewing one aspect from two perspectives can reveal both the Artificer and the Regathering. </strong></p>

<p><strong>For example</strong>, the ordering of Wisdom, the beautification of Providence, the balancing of Justice, and the bestowal of Mercy are observable throughout most of existence. Just as a gaze upon their inner nature will reveal that they proceed from the Mighty Hand of a Wise, Generous, Just, and Merciful Artificer, so too will a gaze upon their power and boundlessness, set against the fleeting lives of these ephemeral beings that reflect them, unveil the Hereafter. Thus, through the language of their being, all beings recite and inspire to recite: <sup>1</sup><span class="text-arabic-inline" dir="rtl" lang="ar">اٰمَنْتُ بِاللّٰهِ وَبِالْيَوْمِ اْلاٰخِرِ</span>.</p>

<div class="page-footnote">
 <hr class="hr-footnote" />
 <p class="footnote-p"><sup>1</sup> “I believe in ALLAH and in the Last Day.”</p>
</div>
</div>
REGATHERING_PAGE_092,
            ],
            [
                'page_number' => 93,
                'content' => <<<'REGATHERING_PAGE_093'
<div class="page" id="93">
 <p class="text-end page-number">#93</p>

<p class="text-center text-red small-title"><strong>Epilogue</strong></p>

<p>The preceding <strong>“Twelve Truths”</strong> mutually confirm, complete, and strengthen one another. United as one, they collectively point to the same conclusion. What delusion could breach these twelve ironclad walls of diamond and shake the fortified fortress of faith in the Regathering?</p>

<p>The noble Ayah: <sup>1</sup><span class="text-arabic-inline" dir="rtl" lang="ar">مَا خَلْقُكُمْ وَلَا بَعْثُكُمْ إِلَّا كَنَفْسٍ وَاحِدَةٍ</span> declares that before Divine Power, the creation and Regathering of all humanity is as effortless as the creation and summoning of a sole human being. And so it is, indeed. In a treatise titled <strong>“Nokta”</strong> <em>(The Point)</em>, within its chapter on the Regathering, I have written extensively on the truth this Ayah conveys. Here, we shall merely offer a brief glimpse into its essence through select similitudes from that treatise. Should you desire further insight, you may consult <strong>“Nokta.”</strong> <sup>2</sup><span class="text-arabic-inline" dir="rtl" lang="ar">وَلِلّٰهِ الْمَثَلُ اْلأَعْلٰى</span> – <em>the use of similitudes is not amiss. </em></p>

<p>If, by the mystery of <strong>“luminosity,”</strong> the sun could grant its reflection by its own will, it would bestow it with equal ease upon both a single particle and countless transparent objects.</p>

<div class="page-footnote">
<hr class="hr-footnote" />
<p class="footnote-p"><sup>1</sup> “Neither your creation nor your resurrection differs from that of a single nafs.” - Qur’an, 31:28</p>

<p class="footnote-p"><sup>2</sup> “To ALLAH belongs the highest similitude.” - Qur’an, 16:60</p>
</div>
</div>
REGATHERING_PAGE_093,
            ],
            [
                'page_number' => 94,
                'content' => <<<'REGATHERING_PAGE_094'
<div class="page" id="94">
 <p class="text-end page-number">#94</p>

<p>Likewise, by the mystery of <strong>“transparency,”</strong> the tiny pupil of a transparent particle and the vast face of the ocean are equally receptive to the sun’s reflection.</p>

<p>Moreover, by the mystery of <strong>“order,”</strong> a child can set both his toy boat and a massive dreadnought spinning with a mere touch of a finger.</p>

<p>Furthermore, by the mystery of <strong>“obedience,”</strong> a commander can set both a single soldier and an entire army into motion with the same command.</p>

<p>Lastly, by the mystery of <strong>“balance,”</strong> let us envision that within the vastness of space, there exists a celestial scale, so precise, so sensitive, and so immense that it can sense the presence of two walnuts placed upon its twin pans, and can likewise bear and weigh two suns. Just as it can move one walnut on its pan heavenward and the other on the opposite pan earthward, so too, with the very same force, it can raise one sun to the Supreme Throne and lower the other to the terrestrial plain.</p>

<p>Thus, in this mundane, deficient, and ephemeral world of possibilities, the mysteries of <strong>“luminosity,” “transparency,” “order,” “obedience,”</strong> and <strong>“balance”</strong> equate the largest with the smallest, causing innumerable things to appear as one.</p>
</div>
REGATHERING_PAGE_094,
            ],
            [
                'page_number' => 95,
                'content' => <<<'REGATHERING_PAGE_095'
<div class="page" id="95">
 <p class="text-end page-number">#95</p>

<p>Hence, by the mysteries of the luminous manifestations of the Almighty’s intrinsic, infinite, and supremely perfect Power; the spiritual transparency of all things; the order of Wisdom and Destiny; the complete obedience of beings to the Divine laws of creation; and the balance of possibilities wherein being and nonbeing stand equal<em> – </em><strong>“many”</strong><em> or </em><strong>“few,” “great”</strong><em> or </em><strong>“small”</strong><em> – </em>all are equivalent before Him. With a single call, He can summon all of humanity to the Regathering as effortlessly as calling forth a single soul.</p>

<p>Moreover, degrees of strength and weakness arise from the intervention of their opposites. For example, the degrees of heat emerge through the intervention of cold. The levels of beauty appear through the intervention of ugliness. The intensity of light results from the intervention of darkness. However, if a quality is intrinsic and not accidental, its opposite cannot intervene <em>– for that would entail the coexistence of two opposites, which is inherently impossible.</em> Thus, in that which is essential and intrinsic, no degrees exist.</p>

<p>Since the Power of the Almighty is intrinsic and not accidental <em>– unlike beings within the realm of possibility –</em> and since it stands at the apex of perfection, no opposite, no shadow of weakness can ever intervene. Therefore, giving rise to a spring is as effortless for His Awe-Inspiring Majesty as creating a flower. Were creation to be attributed to causes, the formation of one flower would become as burdensome as bringing forth an entire spring. Thus, for Him, reviving and regathering all of humanity is as easy as reviving a single nafs.</p>

<p>From the beginning until now, all our explanations in the symbolic <strong>“Outlooks”</strong> and the <strong>“Truths”</strong> regarding the matter of the Regathering have been drawn from the illumination of the Wise Qur’an. They serve to prepare the nafs for submission and the heart for acceptance.</p>

<p>Yet the true Word belongs to the <strong>Qur’an <em>– for it is the Word, and the Word is His.</em></strong></p>
</div>
REGATHERING_PAGE_095,
            ],
            [
                'page_number' => 96,
                'content' => <<<'REGATHERING_PAGE_096'
<div class="page" id="96">
 <p class="text-end page-number">#96</p>

<p><em>Let us listen:</em> “Thus, unto <strong>ALLAH</strong> belongs the decisive proof.”</p>

<p class="text-center text-red small-title">- Qur’an, 6:149</p>

<p>“Behold the signs of <strong>ALLAH</strong>'s Mercy: how He revives the earth after its death. Indeed, it is He Who brings the dead to life, and He has Power over all things.”</p>

<p class="text-center text-red small-title">- Qur’an, 30:50</p>

<p>“He (the unbeliever) asks, <em>‘Who will revive the bones after they have crumbled?’</em> Say: ‘He Who initially created them will revive them, and He is Knowing of all creation.”</p>

<p class="text-center text-red small-title">- Qur’an, 36:78-79</p>
</div>
REGATHERING_PAGE_096,
            ],
            [
                'page_number' => 97,
                'content' => <<<'REGATHERING_PAGE_097'
<div class="page" id="97">
 <p class="text-end page-number">#97</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar">فَلِلّٰهِ الْحُجَّةُ الْبَالِغَةُ ۞</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar">فَانْظُرْ اِلٰۤى اٰثَارِ رَحْمَتِ اللّٰهِ كَيْفَ يُحْيِى اْلأَرْضَ بَعْدَ مَوْتِهَا اِنَّ ذٰلِكَ لَمُحْيِ الْمَوْتٰى وَهُوَ عَلٰى كُلِّ شَىْءٍ قَدٖيرٌ ۞</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar">قَالَ مَنْ يُحْيِ الْعِظَامَ وَهِىَ رَمِيمٌ ۞ قُلْ يُحْيِيهَا الَّذِى اَنْشَاَهَا اَوَّلَ مَرَّةٍ وَهُوَ بِكُلِّ خَلْقٍ عَلِيمٌ ۞</p>
</div>
REGATHERING_PAGE_097,
            ],
            [
                'page_number' => 98,
                'content' => <<<'REGATHERING_PAGE_098'
<div class="page" id="98">
 <p class="text-end page-number">#98</p>

<p>“O mankind, fear your Lord; for the tremor of the Hour is a thing of immensity! On that Day, thou shalt behold: every nursing mother shall forget her suckling, and every pregnant one shall drop her burden, and mankind shall appear unto thee as though drunken – though they be not drunk – but the punishment of <strong>ALLAH</strong> is severe indeed!”</p>

<p class="text-center text-red small-title">- Qur’an, 22:1-2</p>
</div>
REGATHERING_PAGE_098,
            ],
            [
                'page_number' => 99,
                'content' => <<<'REGATHERING_PAGE_099'
<div class="page" id="99">
 <p class="text-end page-number">#99</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar">يَا أَيُّهَا النَّاسُ اتَّقُوا رَبَّكُمْ اِنَّ زَلْزَلَةَ السَّاعَةِ شَىْءٌ عَظِيمٌ ۞ يَوْمَ تَرَوْنَهَا تَذْهَلُ كُلُّ مُرْضِعَةٍ عَمَّا أَرْضَعَتْ وَتَضَعُ كُلُّ ذَاتِ حَمْلٍ حَمْلَهَا وَتَرَى النَّاسَ سُكَارٰى وَمَا هُمْ بِسُكَارٰى وَلٰكِنَّ عَذَابَ اللّٰهِ شَدِيدٌ ۞</p>
</div>
REGATHERING_PAGE_099,
            ],
            [
                'page_number' => 100,
                'content' => <<<'REGATHERING_PAGE_100'
<div class="page" id="100">
 <p class="text-end page-number">#100</p>

<p><strong>“ALLAH</strong> <em>– beyond Whom no God exists –</em> will gather you on the Day of the Arising, of this there is no doubt! And who is truer in speech than ALLAH?”</p>

<p class="text-center text-red small-title">- Qur’an, 4:87</p>

<p>“Indeed, the pious rejoice in bliss, whilst the wicked burn in the Blaze.”</p>

<p class="text-center text-red small-title">- Qur’an, 82:13-14</p>
</div>
REGATHERING_PAGE_100,
            ],
            [
                'page_number' => 101,
                'content' => <<<'REGATHERING_PAGE_101'
<div class="page" id="101">
 <p class="text-end page-number">#101</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar">اَللّٰهُ لَا إِلٰهَ إِلَّا هُوَ لَيَجْمَعَنَّكُمْ إِلٰى يَوْمِ الْقِيَامَةِ لَا رَيْبَ فِيهِ وَمَنْ أَصْدَقُ مِنَ اللّٰهِ حَدِيثًا ۞</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar">إِنَّ الْأَبْرَارَ لَفِى نَعِيمٍ وَإِنَّ الْفُجَّارَ لَفِى جَحِيمٍ</p>
</div>
REGATHERING_PAGE_101,
            ],
            [
                'page_number' => 102,
                'content' => <<<'REGATHERING_PAGE_102'
<div class="page" id="102">
 <p class="text-end page-number">#102</p>

<p>“When the Earth shudders in her final tremor and unloads her burdens, and man asks, ‘What has befallen her?’ on that Day she shall recount her chronicles by the inspiration of thy Lord. On that day, people will emerge in groups to witness their doings. Whosoever does an atom’s weight of good shall behold it, and whosoever does an atom’s weight of evil shall also behold it.”</p>

<p class="text-center text-red small-title">- Qur’an, 99:1-8</p>
</div>
REGATHERING_PAGE_102,
            ],
            [
                'page_number' => 103,
                'content' => <<<'REGATHERING_PAGE_103'
<div class="page" id="103">
 <p class="text-end page-number">#103</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar">اِذَا زُلْزِلَتِ الْأَرْضُ زِلْزَالَهَا ۞ وَأَخْرَجَتِ الْأَرْضُ أَثْقَالَهَا ۞ وَقَالَ الْإِنْسَانُ مَالَهَا ۞ يَوْمَئِذٍ تُحَدِّثُ أَخْبَارَهَا ۞ بِأَنَّ رَبَّكَ أَوْحٰى لَهَا ۞ يَوْمَئِذٍ يَصْدُرُ النَّاسُ أَشْتَاتًا لِيُرَوْا أَعْمَالَهُمْ ۞ فَمَنْ يَعْمَلْ مِثْقَالَ ذَرَّةٍ خَيْرًا يَرَهُ ۞ وَمَنْ يَعْمَلْ مِثْقَالَ ذَرَّةٍ شَرًّا يَرَهُ ۞</p>
</div>
REGATHERING_PAGE_103,
            ],
            [
                'page_number' => 104,
                'content' => <<<'REGATHERING_PAGE_104'
<div class="page" id="104">
 <p class="text-end page-number">#104</p>

<p>“Al-Qâri’ah! What is Al-Qâri’ah? And what can make you fathom Al-Qâri’ah? A day when mankind shall be like scattered moths, and mountains like flakes of wool. Then, as for him whose scales are heavy — he shall embrace a life of bliss. But as for him whose scales are light — his mother shall be Hawiyah. And what can make you fathom what she is? A scorching inferno!”</p>

<p class="text-center text-red small-title">- Qur’an, 99:1-8</p>
</div>
REGATHERING_PAGE_104,
            ],
            [
                'page_number' => 105,
                'content' => <<<'REGATHERING_PAGE_105'
<div class="page" id="105">
 <p class="text-end page-number">#105</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar">اَلْقَارِعَةُ ۞ مَا الْقَارِعَةُ وَمَٓا أَدْرٰيكَ مَا الْقَارِعَةُ ۞ يَوْمَ يَكُونُ النَّاسُ كَالْفَرَاشِ الْمَبْثُوثِ ۞ وَتَكُونُ الْجِبَالُ كَالْعِهْنِ الْمَنْفُوشِ ۞ فَأَمَّا مَنْ ثَقُلَتْ مَوَازِينُهُ ۞ فَهُوَ فِى عِيشَةٍ رَاضِيَةٍ ۞ وَأَمَّا مَنْ خَفَّتْ مَوَازِينُهُ ۞ فَأُمُّهُ هَاوِيَةٌ ۞ وَمَٓا أَدْرٰيكَ مَا هِيَهْ ۞ نَارٌ حَامِيَةٌ ۞</p>
</div>
REGATHERING_PAGE_105,
            ],
            [
                'page_number' => 106,
                'content' => <<<'REGATHERING_PAGE_106'
<div class="page" id="106">
 <p class="text-end page-number">#106</p>

<p>“Unto <strong>ALLAH</strong> belongs what is hidden within the Heavens and the Earth. And the coming of the Hour is but as the blink of an eye; or even nearer. Verily, <strong>ALLAH</strong> has Power over all things.”</p>

<p class="text-center text-red small-title">- Qur’an, 16:77</p>
</div>
REGATHERING_PAGE_106,
            ],
            [
                'page_number' => 107,
                'content' => <<<'REGATHERING_PAGE_107'
<div class="page" id="107">
 <p class="text-end page-number">#107</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar">وَلِلّٰهِ غَيْبُ السَّمٰوَاتِ وَالْأَرْضِ وَمَٓا أَمْرُ السَّاعَةِ إِلَّا كَلَمْحِ الْبَصَرِ أَوْ هُوَ أَقْرَبُ ۞ إِنَّ اللّٰهَ عَلٰى كُلِّ شَىْءٍ قَدِيرٌ</p>
</div>
REGATHERING_PAGE_107,
            ],
            [
                'page_number' => 108,
                'content' => <<<'REGATHERING_PAGE_108'
<div class="page" id="108">
 <p class="text-end page-number">#108</p>

<p>Let us thus heed such illuminating Âyât of the Qur'an and declare: <strong>( We believe and affirm.)</strong></p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar">اٰمَنْتُ بِاللّٰهِ وَ مَلٰئِكَتِهٖ وَ كُتُبِهٖ وَ رُسُلِهٖ وَ الْيَوْمِ الْاٰخِرِ وَ بِالْقَدَرِ خَيْرِهٖ وَ شَرِّهٖ مِنَ اللّٰهِ تَعَالٰى وَ الْبَعْثُ بَعْدَ الْمَوْتِ حَقٌّ وَ اَنَّ الْجَنَّةَ حَقٌّ وَ النَّارَ حَقٌّ وَ اَنَّ الشَّفَاعَةَ حَقٌّ وَ اَنَّ مُنْكَرًا وَ نَكٖيرًا حَقٌّ وَ اَنَّ اللّٰهَ يَبْعَثُ مَنْ فِى الْقُبُورِ اَشْهَدُ اَنْ لَا اِلٰهَ اِلَّا اللّٰهُ وَ اَشْهَدُ اَنَّ مُحَمَّدًا رَسُولُ اللّٰهِ</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar">اَللّٰهُمَّ صَلِّ عَلٰى اَلْطَفِ وَ اَشْرَفِ وَ اَكْمَلِ وَ اَجْمَلِ ثَمَرَاتِ طُوبَاءِ رَحْمَتِكَ الَّذٖى اَرْسَلْتَهُ رَحْمَةً لِلْعَالَمٖينَ وَ وَسٖيلَةً لِوُصُولِنَا اِلٰى اَزْيَنِ وَ اَحْسَنِ وَ اَجْلٰى وَ اَعْلٰى ثَمَرَاتِ تِلْكَ الطُّوبَاءِ الْمُتَدَلِّيَةِ عَلٰى دَارِ الْاٰخِرَةِ اَىِ الْجَنَّةِ. اَللّٰهُمَّ اَجِرْنَا وَ اَجِرْ وَالِدَيْنَا مِنَ النَّارِ وَ اَدْخِلْنَا وَ اَدْخِلْ وَالِدَيْنَا الْجَنَّةَ مَعَ الْاَبْرَارِ بِجَاهِ نَبِيِّكَ الْمُخْتَارِ اٰمٖينَ</p>
</div>
REGATHERING_PAGE_108,
            ],
            [
                'page_number' => 109,
                'content' => <<<'REGATHERING_PAGE_109'
<div class="page" id="109">
 <p class="text-end page-number">#109</p>

<p>“I believe in <strong>ALLAH</strong>, His <strong>angels</strong>, His <strong>Books</strong>, and His <strong>Messengers</strong>; in the <strong>Last Day</strong>, and in <strong>Destiny</strong> – its good and its evil – as ordained by <strong>ALLAH</strong>.</p>

<p>I believe in the reality of resurrection after death, the reality of Paradise, the reality of Hellfire, the reality of intercession, and the reality of <strong>'Munkar and Nakir'</strong>, and I believe that <strong>ALLAH</strong> shall raise the dead from their graves. I bear witness that there is no God but <strong>ALLAH</strong>, and I bear witness that Muhammad is the Messenger of <strong>ALLAH</strong>.”</p>

<p><em>“</em><strong>O ALLAH</strong><em>, bestow blessings upon Your most subtle, most noble, most perfect, and most resplendent fruit from the Tûba tree of Your Mercy – he whom You sent as a Mercy to all worlds, and as a means for us to attain the most ornate, sublime, splendid, and exalted fruits of the Tûba tree, hanging in the heights of the Hereafter, within the gardens of Paradise.”</em></p>

<p><em>“</em><strong>O ALLAH</strong><em>, protect us and our parents from the Fire, and admit us and our parents into Paradise among the pious – by the honor of Your chosen Prophet, Âmîn.”</em></p>

<p>O brother who studies this treatise with fairness! Do not say: <em>“Why can I not fully grasp this </em><strong>“Tenth Word”</strong> <em>all at once?” </em>And do not feel disheartened for not comprehending it entirely. For even a philosophical genius like Ibn Sînâ stated:<span class="text-arabic-inline" dir="rtl" lang="ar">اَلْحَشْرُ لَيْسَ عَلٰى مَقَايٖيسَ عَقْلِيَّةٍ</span> <sup>1</sup>.</p>
<div class="page-footnote">
<hr class="hr-footnote" />
<p class="footnote-p"><sup>1</sup> “The Regathering lies beyond the measures of the mind.”</p>
</div>
</div>
REGATHERING_PAGE_109,
            ],
            [
                'page_number' => 110,
                'content' => <<<'REGATHERING_PAGE_110'
<div class="page" id="110">
 <p class="text-end page-number">#110</p>

<p>And he concluded:<em> “We believe, but the intellect cannot tread this path.”</em></p>

<p>Moreover, all Islamic scholars unanimously concluded: <em>“The Regathering is a matter of transmission. It is based on transmitted evidence and cannot be reached by reason alone.”</em></p>

<p>Hence, such a profound and spiritually elevated path cannot suddenly become an intellectual avenue accessible to all. Nevertheless, in this era <em>– wherein blind imitation has waned and submission has weakened –</em> we ought to offer a thousand thanks that, by the illumination of the Qur’an and the Grace of the Merciful Creator, we have been so generously favored along such a profound and lofty path. For it suffices to secure our îmân <em>(faith)</em>. We should be content with what we have grasped, and strive to deepen our understanding through repeated study.</p>

<p>A secret as to why the Regathering is not approached intellectually is this:</p>

<p>The Grand Gathering shall unfold through the manifestation of ALLAH’s Grandest Name. Thus, it is only upon beholding and presenting the grand acts of the Divine Haqq <em>– acts that become apparent through the manifestation of both His Grandest Name and the grandest degree of each Divine Name –</em> that the Grand Gathering can be proven with the clarity of spring, yielding full conviction and conscious faith. By the illumination of the Qur’an, this <strong>“Tenth Word”</strong> presents and demonstrates these acts in that very manner. Otherwise, were the mind left solely to itself, confined to its narrow and petty principles, it would remain powerless and be forced to resort to blind imitation.</p>
</div>
REGATHERING_PAGE_110,
            ],
            [
                'page_number' => 111,
                'content' => <<<'REGATHERING_PAGE_111'
<div class="page" id="111">
 <p class="text-end page-number">#111</p>

</div>
REGATHERING_PAGE_111,
            ],
            [
                'page_number' => 112,
                'content' => <<<'REGATHERING_PAGE_112'
<div class="page" id="112">
 <p class="text-end page-number">#112</p>

<p><em>Although </em><strong>“The Tenth Word”</strong><em> concludes here, the author’s original work included several addenda drawn from the Risale-i Nur. Regrettably, we were unable to translate these supplementary sections for this edition. May ALLAH enable us to translate and incorporate them into a future edition.</em></p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar">رَبَّنَا لَا تُزِغْ قُلُوبَنَا بَعْدَ إِذْ هَدَيْتَنَا وَهَبْ لَنَا مِن لَّدُنكَ رَحْمَةً إِنَّكَ أَنتَ الْوَهَّابُ</p>

<p><strong>“Our Lord! Do not let our hearts stray after You have guided us, and bestow upon us from Your Endless Mercy. Indeed, You are the Benevolent Bestower.</strong>”</p>

<p class="text-center text-red small-title">- Qur’an, 3:8</p>

<p class="text-center text-arabic delima-font" dir="rtl" lang="ar">وَآخِرُ دَعْوَاهُمْ أَنِ الْحَمْدُ لِلّٰهِ رَبِّ الْعَالَمِينَ</p>

<p><strong>“And the conclusion of their prayer will be, 'Praise be to ALLAH, Lord of the worlds.'</strong>”</p>

<p class="text-center text-red small-title">- Qur’an, 10:10</p>

<p class="text-center text-red small-title">The Translators</p>
</div>
REGATHERING_PAGE_112,
            ],
        ];
    }
}

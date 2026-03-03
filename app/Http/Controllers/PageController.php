<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class PageController extends Controller
{
    public function home(): View
    {
        return view('home', [
            'SEOData' => new SEOData(
                title: 'Lucide Inkt | Nederlandse en Engelse vertalingen van de Risale-i Nur',
                description: 'Lucide Inkt is een non-profit organisatie die zich richt op de verspreiding van geloofswaarheden die omschreven zijn in de boekenreeks van de Risale-i Nur.',
                url: route('home'),
                image: secure_url('images/books_standing_new.webp'),
                author: 'Lucide Inkt',
                locale: 'nl_NL',
                site_name: 'Lucide Inkt',
                type: 'website',
            ),
        ]);
    }

    public function saidNursi(): View
    {
        return view('saidnursi', [
            'SEOData' => new SEOData(
                title: 'Lucide Inkt | Bediüzzaman Said Nursi',
                description: 'Ik zal de wereld bewijzen dat de Qur’an een spirituele Zon is Die nimmer zal doven en door niemand kan worden uitgedoofd!',
                url: route('saidnursi'),
                image: secure_url('images/said_nursi_sharp.jpg'),
                author: 'Lucide Inkt',
                locale: 'nl_NL',
                site_name: 'Lucide Inkt',
                type: 'article',
            ),
        ]);
    }

    public function risale(): View
    {
        return view('risale', [
            'SEOData' => new SEOData(
                title: 'Lucide Inkt | Wat is de Risale-i Nur?',
                description: 'Als een ware spirituele tafsir van de Qur’an voldoet de Risale-i Nur aan alle behoeften van deze tijd. Het enige wat van de lezer gevraagd wordt, is lezen met een aandachtige blik en een onbevooroordeeld hart.',
                url: route('risale'),
                image: secure_url('images/books-stapel.webp'),
                author: 'Lucide Inkt',
                locale: 'nl_NL',
                site_name: 'Lucide Inkt',
                type: 'article',
            ),
        ]);
    }

    public function herzameling(): View
    {
        return view('herzameling', [
            'SEOData' => new SEOData(
                title: 'Lucide Inkt | Het Traktaat over de Herzameling',
                description: 'Definitieve antwoorden op zulke cruciale bestaansvragen zijn te vinden in dit waardevolle werk. Met onbetwistbare redenaties maakt het helder dat de herzameling in het hiernamaals noodzakelijk is.',
                url: route('herzameling'),
                image: secure_url('images/books/herzameling/NederlandsHerzameling.webp'),
                author: 'Lucide Inkt',
                locale: 'nl_NL',
                site_name: 'Lucide Inkt',
                type: 'article',
            ),
        ]);
    }

    public function contact(): View
    {
        return view('contact', [
            'SEOData' => new SEOData(
                title: 'Lucide Inkt | Contact',
                description: 'Neem contact op met Lucide Inkt voor vragen over de Risale-i Nur vertalingen of onze diensten.',
                url: route('contact'),
                image: secure_url('images/books_standing_new.webp'),
                author: 'Lucide Inkt',
                locale: 'nl_NL',
                site_name: 'Lucide Inkt',
                type: 'website',
            ),
        ]);
    }
}

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
                title: 'Lucide Inkt | Risale-i Nur Vertalingen',
                description: 'Lucide Inkt is een non-profit organisatie toegewijd aan het verlenen van diensten volgens de Qur\'anische richtlijnen van de Risale-i Nur. Met Nederlandse en Engelse vertalingen van deze boekenreeks streven wij ernaar zoekers te voorzien van antwoorden op de belangrijkste bestaansvragen van de mens.',
                url: route('home'),
                image: secure_url('images/logo_newest.webp'),
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
                title: 'Bediüzzaman Said Nursi - Lucide Inkt',
                description: 'Bediüzzaman Said Nursi, de vertolker van de Risale-i Nur. Een uitzonderlijk individu dat zich met verheven vaardigheden en gezegende kennis op een volwaardige wijze aan het verspreiden en authenticeren van de Mohammedaanse religie heeft gewijd.',
                url: route('saidnursi'),
                image: secure_url('images/logo_newest.webp'),
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
                title: 'Risale-i Nur - De Verlichting van de Qur\'an',
                description: 'De Risale-i Nur is een commentaar op de Qur\'an die de geloofswaarheden aan het licht brengt met krachtige redeneringen. Ontdek deze spirituele Tafsir en haar diepgaande wijsheid.',
                url: route('risale'),
                image: secure_url('images/logo_newest.webp'),
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
                title: 'Herzameling - Het Hiernamaals | Lucide Inkt',
                description: 'Definitieve antwoorden op cruciale bestaansvragen. Ontdek waarom de herzameling in het hiernamaals noodzakelijk is met onbetwistbare redenaties uit de Risale-i Nur.',
                url: route('herzameling'),
                image: secure_url('images/logo_newest.webp'),
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
                title: 'Contact - Lucide Inkt',
                description: 'Neem contact op met Lucide Inkt voor vragen over de Risale-i Nur vertalingen of onze diensten.',
                url: route('contact'),
                image: secure_url('images/logo_newest.webp'),
                author: 'Lucide Inkt',
                locale: 'nl_NL',
                site_name: 'Lucide Inkt',
                type: 'website',
            ),
        ]);
    }
}

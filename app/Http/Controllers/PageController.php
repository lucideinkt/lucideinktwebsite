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
                title: 'Lucide Inkt - Risale-i Nur Vertalingen',
                description: 'Lucide Inkt is een non-profit organisatie toegewijd aan het verlenen van diensten volgens de Qur\'anische richtlijnen van de Risale-i Nur. Met Nederlandse en Engelse vertalingen van deze boekenreeks streven wij ernaar zoekers te voorzien van antwoorden op de belangrijkste bestaansvragen van de mens.',
                url: route('home'),
                image: asset('images/logo_new_2.webp'),
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
                image: asset('images/logo_new_2.webp'),
            ),
        ]);
    }
}
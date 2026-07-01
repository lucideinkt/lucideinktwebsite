<?php

namespace App\Http\Controllers;

use App\Services\SEOService;
use App\Models\HomepageQuote;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $quotes = HomepageQuote::active()->ordered()->get();

        return view('home', [
            'SEOData' => SEOService::getPageSEO('home'),
            'quotes'  => $quotes,
        ]);
    }

    public function saidNursi(): View
    {
        return view('saidnursi', [
            'SEOData' => SEOService::getPageSEO('saidnursi'),
        ]);
    }

    public function risale(): View
    {
        return view('risale', [
            'SEOData' => SEOService::getPageSEO('risale'),
        ]);
    }

    public function herzameling(): View
    {
        return view('herzameling', [
            'SEOData' => SEOService::getPageSEO('herzameling'),
        ]);
    }

    public function contact(): View
    {
        return view('contact', [
            'SEOData' => SEOService::getPageSEO('contact'),
        ]);
    }

    public function nieuwsbrief(): View
    {
        return view('nieuwsbrief', [
            'SEOData' => SEOService::getPageSEO('nieuwsbrief'),
        ]);
    }

    public function algemeneVoorwaarden(): View
    {
        return view('algemene-voorwaarden', [
            'SEOData' => SEOService::getPageSEO('algemene-voorwaarden'),
        ]);
    }

    public function privacybeleid(): View
    {
        return view('privacybeleid', [
            'SEOData' => SEOService::getPageSEO('privacybeleid'),
        ]);
    }

    public function retourbeleid(): View
    {
        return view('retourbeleid', [
            'SEOData' => SEOService::getPageSEO('retourbeleid'),
        ]);
    }

    public function verzendingLevering(): View
    {
        return view('verzending-levering', [
            'SEOData' => SEOService::getPageSEO('verzending-levering'),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\SEOService;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('home', [
            'SEOData' => SEOService::getPageSEO('home'),
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
}

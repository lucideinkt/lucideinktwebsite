<?php

namespace App\Http\Controllers;

use App\Services\SEOService;
use App\Models\Artikel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Schema;

class PageController extends Controller
{
    public function home(): View
    {
        $artikelen = Schema::hasTable('artikelen')
            ? Artikel::published()->ordered()->take(3)->get()
            : collect();

        return view('home', [
            'SEOData' => SEOService::getPageSEO('home'),
            'artikelen' => $artikelen,
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

    public function artikelen(): View
    {
        $isAdmin = auth()->check() && auth()->user()->role === 'admin';

        $query = Artikel::ordered();
        if (!$isAdmin) {
            $query->published();
        }

        $artikelen = $query->get();

        return view('artikelen', [
            'SEOData'   => SEOService::getPageSEO('artikelen'),
            'artikelen' => $artikelen,
            'isAdmin'   => $isAdmin,
        ]);
    }

    public function artikelDetail(string $slug): View
    {
        $isAdmin = auth()->check() && auth()->user()->role === 'admin';

        $query = Artikel::where('slug', $slug);
        if (!$isAdmin) {
            $query->published();
        }

        $artikel = $query->firstOrFail();

        return view('artikel-detail', [
            'SEOData' => SEOService::getArtikelSEO($artikel),
            'artikel' => $artikel,
            'isAdmin' => $isAdmin,
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

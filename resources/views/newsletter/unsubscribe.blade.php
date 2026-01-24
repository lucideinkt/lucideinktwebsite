<x-layout>
    <main class="container page" style="padding: 4rem 0; text-align: center;">
        <div style="max-width: 600px; margin: 0 auto; background: white; padding: 3rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <i class="fa-solid fa-envelope-open-text" style="font-size: 4rem; color: #28a745; margin-bottom: 1.5rem;"></i>

            <h1 style="margin-bottom: 1rem; color: #333;">{{ $message }}</h1>

            <p style="color: #6c757d; margin-bottom: 2rem;">
                U ontvangt geen e-mails meer van onze nieuwsbrief.
            </p>

            <div style="padding-top: 2rem; border-top: 1px solid #dee2e6;">
                <a href="{{ route('home') }}" class="btn btn-primary" style="display: inline-block; padding: 0.75rem 2rem; text-decoration: none;">
                    <i class="fa-solid fa-home"></i> Terug naar homepage
                </a>
            </div>
        </div>
    </main>
</x-layout>

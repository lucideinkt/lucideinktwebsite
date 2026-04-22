<x-dashboard-layout>
    <main class="container page dashboard">
        <div style="margin-bottom: 2rem;">
            <a href="{{ route('newsletter.campaigns.show', $newsletter) }}" class="btn" style="background: #6c757d; color: white;">
                <i class="fa-solid fa-arrow-left"></i> Terug
            </a>
        </div>

        <h2 style="margin-bottom: 2rem;">Nieuwsbrief Bewerken</h2>

        <form action="{{ route('newsletter.campaigns.update', $newsletter) }}" method="POST" style="background: white; padding: 2rem; border-radius: 8px;">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 1.5rem;">
                <label for="subject" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">
                    Onderwerp <span style="color: #dc3545;">*</span>
                </label>
                <input
                    type="text"
                    id="subject"
                    name="subject"
                    value="{{ old('subject', $newsletter->subject) }}"
                    required
                    placeholder="Bijv. Nieuwe producten en updates - januari 2026"
                    style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem;">
                @error('subject')
                    <span style="color: #dc3545; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="content" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">
                    Inhoud <span style="color: #dc3545;">*</span>
                </label>
                <textarea
                    id="content"
                    name="content"
                    style="width: 100%; min-height: 400px;">{{ old('content', $newsletter->content) }}</textarea>
                @error('content')
                    <span style="color: #dc3545; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-save"></i> Opslaan
                </button>
                <a href="{{ route('newsletter.campaigns.show', $newsletter) }}" class="btn" style="background: #6c757d; color: white;">
                    Annuleren
                </a>
            </div>
        </form>
    </main>

    {{-- TinyMCE Editor --}}
    <script src="https://cdn.tiny.cloud/1/ge8uicnju7uxjcg4xyl35hvyqz5v0ikkrrrg0dga71hkxczy/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#content',
            height: 500,
            menubar: true,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | bold italic underline | forecolor backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link image | removeformat | code | help',
            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; font-size: 16px; line-height: 1.6; }',
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            }
        });
    </script>
</x-dashboard-layout>

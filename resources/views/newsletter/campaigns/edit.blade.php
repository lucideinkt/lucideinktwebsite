<x-dashboard-layout>

{{-- Page header --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <a href="{{ route('newsletter.campaigns.show', $newsletter) }}"
           class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white mb-1">
            <i class="fa-solid fa-arrow-left text-xs"></i>
            Terug naar campagne
        </a>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Nieuwsbrief Bewerken</h1>
    </div>
</div>

@if($errors->any())
<div id="alert-error" class="flex items-start p-4 mb-6 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
    <svg class="shrink-0 w-4 h-4 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
    <div class="ms-2">
        <p class="text-sm font-medium mb-1">Er zijn fouten gevonden:</p>
        <ul class="text-sm list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <button type="button" onclick="document.getElementById('alert-error').remove()" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg p-1.5 hover:bg-red-200 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700">
        <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
    </button>
</div>
@endif

<form action="{{ route('newsletter.campaigns.update', $newsletter) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-4">

        {{-- Subject --}}
        <div class="mb-6">
            <label for="subject" class="block mb-1.5 text-sm font-semibold text-gray-900 dark:text-white">
                Onderwerp <span class="text-red-500">*</span>
            </label>
            <input
                type="text"
                id="subject"
                name="subject"
                value="{{ old('subject', $newsletter->subject) }}"
                required
                placeholder="Bijv. Nieuwe producten en updates - januari 2026"
                class="bg-gray-50 border @error('subject') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            @error('subject')
                <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        {{-- Content --}}
        <div>
            <label for="content" class="block mb-1.5 text-sm font-semibold text-gray-900 dark:text-white">
                Inhoud <span class="text-red-500">*</span>
            </label>
            <textarea
                id="content"
                name="content"
                class="@error('content') border-red-500 @enderror">{{ old('content', $newsletter->content) }}</textarea>
            @error('content')
                <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Actions --}}
    <div class="flex items-center gap-3">
        <button type="submit"
            class="inline-flex items-center gap-2 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
            <i class="fa-solid fa-floppy-disk"></i>
            Opslaan
        </button>
        <a href="{{ route('newsletter.campaigns.show', $newsletter) }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white py-2.5 px-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
            Annuleren
        </a>
    </div>
</form>

{{-- TinyMCE Editor --}}
<script src="https://cdn.tiny.cloud/1/ge8uicnju7uxjcg4xyl35hvyqz5v0ikkrrrg0dga71hkxczy/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    (function initTinyMCE() {
        const dark = document.documentElement.classList.contains('dark');
        tinymce.init({
            selector: '#content',
            height: 540,
            menubar: true,
            skin: dark ? 'oxide-dark' : 'oxide',
            content_css: dark ? 'dark' : 'default',
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
    })();
</script>

</x-dashboard-layout>

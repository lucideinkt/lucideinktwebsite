<x-dashboard-layout>
    <main class="container page dashboard product-form">
        <h2>{{ isset($product) ? 'Product bewerken' : 'Product aanmaken' }}</h2>
        @if(session('success'))
        <div class="alert alert-success" style="position: relative;">
            {{ session('success') }}
            <button type="button" class="alert-close"
                onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
        @endif

        <form action="{{ isset($product) ? route('productUpdate', $product->id) : route('productStore') }}" method="POST" class="form" enctype="multipart/form-data">
            @if(isset($product))
                @method('PUT')
            @endif
            @csrf
            <div class="grid-box">
                {{-- Beschrijving --}}
                <div class="section">
                    <div class="form-input">
                        <label for="is_published">Publiceren</label>
                        <select name="is_published" id="is_published">
                            <option value="0" {{ old('is_published', isset($product) ? $product->is_published : '0') == '0' ? 'selected' : '' }}>Nee</option>
                            <option value="1" {{ old('is_published', isset($product) ? $product->is_published : '0') == '1' ? 'selected' : '' }}>Ja</option>
                        </select>
                        @error('is_published')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label for="title">Titel</label>
                        <input type="text" name="title" value="{{ old('title', $product->title ?? '') }}">
                        @error('title')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label for="short_description">Korte omschrijving</label>
                        <textarea class="short_description"
                            name="short_description">{{ old('short_description', $product->short_description ?? '') }}</textarea>
                        @error('short_description')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label for="long_description">Lange omschrijving</label>
                        <textarea class="long_description" name="long_description">{{ old('long_description', $product->long_description ?? '') }}</textarea>
                        @error('long_description')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="section">
                    <div class="form-input">
                        <label for="price">Prijs</label>
                        <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}" step="0.01">
                        @error('price')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label for="stock">Voorraad</label>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock ?? '') }}">
                        @error('stock')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label for="category">Categorie</label>
                        <select name="category_id" id="category_id">
                            <option value="">-- Kies categorie --</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-input">
                        <label for="product_copy_id">Exemplaar</label>
                        <select name="product_copy_id" id="product_copy_id">
                            <option value="">-- Kies exemplaar --</option>
                            @if (!empty($productCopies))
                                @foreach ($productCopies as $productCopy)
                                    <option value="{{ $productCopy->id }}" {{ old('product_copy_id', $product->product_copy_id ?? '') == $productCopy->id ? 'selected' : '' }}>
                                        {{ $productCopy->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('product_copy_id')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- Dimensions and weight --}}
                <div class="section">
                    <div class="form-input">
                        <label for="weight">Gewicht (gr.)</label>
                        <input type="number" name="weight" value="{{ old('weight', $product->weight ?? '') }}">
                        @error('weight')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label for="height">Hoogte (cm)</label>
                        <input type="number" name="height" value="{{ old('height', $product->height ?? '') }}">
                        @error('height')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label for="width">Breedte (cm)</label>
                        <input type="number" name="width" value="{{ old('width', $product->width ?? '') }}">
                        @error('width')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label for="depth">Diepte (cm)</label>
                        <input type="number" name="depth" value="{{ old('depth', $product->depth ?? '') }}">
                        @error('depth')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Book Information --}}
                <div class="section">
                    <div class="form-input">
                        <label for="pages">Aantal pagina's</label>
                        <input type="number" name="pages" id="pages" value="{{ old('pages', $product->pages ?? '') }}" min="1">
                        @error('pages')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label for="binding_type">Uitvoering</label>
                        <select name="binding_type" id="binding_type">
                            <option value="">-- Kies uitvoering --</option>
                            <option value="hardcover" {{ old('binding_type', $product->binding_type ?? '') == 'hardcover' ? 'selected' : '' }}>Hardcover</option>
                            <option value="softcover" {{ old('binding_type', $product->binding_type ?? '') == 'softcover' ? 'selected' : '' }}>Softcover</option>
                        </select>
                        @error('binding_type')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label for="ean_code">EAN Code</label>
                        <input type="text" name="ean_code" id="ean_code" value="{{ old('ean_code', $product->ean_code ?? '') }}" maxlength="13" placeholder="9781234567890">
                        <small class="help-text">13-cijferige EAN barcode (bijv. 9781234567890)</small>
                        @error('ean_code')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Images --}}
                <div class="section images">
                    @for ($i = 1; $i <= 4; $i++)
                    <div class="form-input">
                        <label for="image_{{ $i }}">
                            @if($i == 1)
                                Hoofdafbeelding
                            @else
                                Afbeelding {{ $i }}
                            @endif
                        </label>
                        <div class="custom-file-input-wrapper">
                            <input type="file" name="image_{{ $i }}" id="image_{{ $i }}" accept="image/*" class="custom-file-input">
                            <label for="image_{{ $i }}" class="custom-file-label">
                                <span id="image_{{ $i }}_label_text">Kies afbeelding...</span>
                            </label>

                            {{-- Preview afbeelding --}}
                            <div id="image_{{ $i }}_preview" style="display: flex; align-items:center;margin-top:5px;">
                                @if(isset($product) && $product->{'image_'.$i})
                                    <img
                                      src="{{ e(
                                        Str::startsWith($product->{'image_'.$i}, 'https://')
                                          ? $product->{'image_'.$i}
                                          : (Str::startsWith($product->{'image_'.$i}, 'image/books/')
                                            ? asset($product->{'image_'.$i})
                                            : (Str::startsWith($product->{'image_'.$i}, 'images/books/')
                                              ? asset($product->{'image_'.$i})
                                              : asset('storage/' . $product->{'image_'.$i})
                                            )
                                          )
                                      ) }}"
                                      alt=""
                                      style="max-width:60px;max-height:60px;">
                                @endif
                            </div>

                            @if(isset($product))
                                <button type="button" class="btn small"
                                    data-input="image_{{ $i }}"
                                    data-label="image_{{ $i }}_label_text"
                                    data-preview="image_{{ $i }}_preview"
                                    style="{{ $product->{'image_'.$i} ? '' : 'display:none;' }}">
                                    Verwijder
                                </button>
                                <input type="checkbox" name="delete_image_{{ $i }}" id="delete_image_{{ $i }}" value="1" style="display:none;">
                            @else
                                <button type="button" class="remove-image-btn"
                                    data-input="image_{{ $i }}"
                                    data-label="image_{{ $i }}_label_text"
                                    data-preview="image_{{ $i }}_preview"
                                    style="display:none;">
                                    Verwijder
                                </button>
                            @endif
                        </div>
                        @if(!isset($product) && old('image_' . $i))
                            <div class="info">Bestand geselecteerd: {{ old('image_' . $i) }}</div>
                        @endif
                        @error('image_' . $i)
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    @endfor
                </div>

                {{-- PDF File for Online Reading --}}
                <div class="section pdf-section">
                    <h3>Online Lezen</h3>
                    <div class="form-input">
                        <label for="pdf_file">PDF Bestand</label>
                        <div class="custom-file-input-wrapper">
                            <input type="file" name="pdf_file" id="pdf_file" accept="application/pdf" class="custom-file-input">
                            <label for="pdf_file" class="custom-file-label">
                                <span id="pdf_file_label_text">
                                    @if(isset($product) && $product->pdf_file)
                                        {{ basename($product->pdf_file) }}
                                    @else
                                        Kies PDF bestand...
                                    @endif
                                </span>
                            </label>

                            {{-- Current PDF info --}}
                            @if(isset($product) && $product->pdf_file)
                                <div style="margin-top: 10px;">
                                    <p class="current-file">
                                        <i class="fa-solid fa-file-pdf"></i>
                                        Huidig bestand:
                                        <a href="{{ asset('storage/' . $product->pdf_file) }}" target="_blank" style="color: var(--green-2); text-decoration: underline;">
                                            Bekijk PDF
                                        </a>
                                    </p>
                                    <button type="button" class="btn small" id="remove-pdf-btn">
                                        Verwijder PDF
                                    </button>
                                    <input type="checkbox" name="delete_pdf_file" id="delete_pdf_file" value="1" style="display:none;">
                                </div>
                            @endif
                        </div>
                        <small class="help-text">Upload een PDF bestand om dit boek beschikbaar te maken in de Online Lezen bibliotheek. Max 50MB.</small>
                        @error('pdf_file')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-input">
                        <label for="online_lezen_image">Online Lezen Afbeelding</label>
                        <div class="custom-file-input-wrapper">
                            <input type="file" name="online_lezen_image" id="online_lezen_image" accept="image/*" class="custom-file-input">
                            <label for="online_lezen_image" class="custom-file-label">
                                <span id="online_lezen_image_label_text">Kies afbeelding...</span>
                            </label>

                            {{-- Preview afbeelding --}}
                            <div id="online_lezen_image_preview" style="display: flex; align-items:center;margin-top:5px;">
                                @if(isset($product) && $product->online_lezen_image)
                                    <img
                                      src="{{ asset($product->online_lezen_image) }}"
                                      alt="Online Lezen"
                                      style="max-width:150px;max-height:150px;">
                                @endif
                            </div>

                            @if(isset($product) && $product->online_lezen_image)
                                <button type="button" class="btn small" id="remove-online-lezen-image-btn">
                                    Verwijder Afbeelding
                                </button>
                                <input type="checkbox" name="delete_online_lezen_image" id="delete_online_lezen_image" value="1" style="display:none;">
                            @endif
                        </div>
                        <small class="help-text">Upload een afbeelding die gebruikt wordt op de Online Lezen index pagina. Aanbevolen formaat: 800x1200px. Max 5MB.</small>
                        @error('online_lezen_image')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Audio File for Online Listening --}}
                <div class="section audio-section">
                    <h3>Online Luisteren</h3>
                    <div class="form-input">
                        <label for="audio_file">Audio Bestand</label>
                        <div class="custom-file-input-wrapper">
                            <input type="file" name="audio_file" id="audio_file" accept="audio/*,.mp3,.m4a,.ogg,.wav" class="custom-file-input">
                            <label for="audio_file" class="custom-file-label">
                                <span id="audio_file_label_text">
                                    @if(isset($product) && $product->audio_file)
                                        {{ basename($product->audio_file) }}
                                    @else
                                        Kies audio bestand...
                                    @endif
                                </span>
                            </label>

                            {{-- Current Audio info --}}
                            @if(isset($product) && $product->audio_file)
                                <div style="margin-top: 10px;">
                                    <p class="current-file">
                                        <i class="fa-solid fa-headphones"></i>
                                        Huidig bestand:
                                        <a href="{{ asset('storage/' . $product->audio_file) }}" target="_blank" style="color: var(--green-2); text-decoration: underline;">
                                            Beluister Audio
                                        </a>
                                    </p>
                                    <button type="button" class="btn small" id="remove-audio-btn">
                                        Verwijder Audio
                                    </button>
                                    <input type="checkbox" name="delete_audio_file" id="delete_audio_file" value="1" style="display:none;">
                                </div>
                            @endif
                        </div>
                        <small class="help-text">Upload een audiobestand om dit boek beschikbaar te maken in de Audioboeken bibliotheek. Max 100MB. Formaten: MP3, M4A, OGG, WAV.</small>
                        @error('audio_file')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- SEO Fields --}}
                <div class="section seo-section">
                    <h3>SEO Instellingen</h3>
                    <div class="form-input">
                        <label for="seo_description">SEO Beschrijving</label>
                        <textarea name="seo_description" id="seo_description" rows="3" maxlength="160">{{ old('seo_description', $product->seo_description ?? '') }}</textarea>
                        <small class="help-text">Aanbevolen: 150-160 tekens. Laat leeg om korte omschrijving te gebruiken. De producttitel en hoofdafbeelding worden automatisch gebruikt.</small>
                        @error('seo_description')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label for="seo_tags">SEO Tags/Keywords</label>
                        <input type="text" name="seo_tags" id="seo_tags" value="{{ old('seo_tags', isset($product) && $product->seo_tags ? implode(', ', $product->seo_tags) : '') }}" placeholder="tag1, tag2, tag3">
                        <small class="help-text">Komma-gescheiden lijst van tags of keywords (bijv. "islam, boeken, religie"). Wordt gebruikt voor OpenGraph tags.</small>
                        @error('seo_tags')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label for="seo_author">SEO Auteur</label>
                        <input type="text" name="seo_author" id="seo_author" value="{{ old('seo_author', $product->seo_author ?? '') }}">
                        <small class="help-text">Naam van de auteur (optioneel).</small>
                        @error('seo_author')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label for="seo_robots">SEO Robots</label>
                        <select name="seo_robots" id="seo_robots">
                            <option value="">Standaard (index, follow)</option>
                            <option value="noindex, nofollow" {{ old('seo_robots', $product->seo_robots ?? '') == 'noindex, nofollow' ? 'selected' : '' }}>noindex, nofollow</option>
                            <option value="noindex, follow" {{ old('seo_robots', $product->seo_robots ?? '') == 'noindex, follow' ? 'selected' : '' }}>noindex, follow</option>
                            <option value="index, nofollow" {{ old('seo_robots', $product->seo_robots ?? '') == 'index, nofollow' ? 'selected' : '' }}>index, nofollow</option>
                        </select>
                        <small class="help-text">Instellen hoe zoekmachines deze pagina moeten indexeren.</small>
                        @error('seo_robots')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label for="seo_canonical_url">Canonical URL</label>
                        <input type="text" name="seo_canonical_url" id="seo_canonical_url" value="{{ old('seo_canonical_url', $product->seo_canonical_url ?? '') }}" placeholder="https://example.com/product">
                        <small class="help-text">Canonical URL als deze pagina een duplicaat is. Laat leeg om standaard URL te gebruiken.</small>
                        @error('seo_canonical_url')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="form-input">
                <button type="submit" class="btn"><span class="loader"></span>Opslaan</button>
            </div>
        </form>

        <script>
            // PDF file upload handler
            document.addEventListener('DOMContentLoaded', function() {
                const pdfInput = document.getElementById('pdf_file');
                const pdfLabel = document.getElementById('pdf_file_label_text');
                const removePdfBtn = document.getElementById('remove-pdf-btn');
                const deletePdfCheckbox = document.getElementById('delete_pdf_file');

                if (pdfInput) {
                    pdfInput.addEventListener('change', function(e) {
                        if (e.target.files.length > 0) {
                            const fileName = e.target.files[0].name;
                            if (pdfLabel) {
                                pdfLabel.textContent = fileName;
                            }
                        }
                    });
                }

                if (removePdfBtn && deletePdfCheckbox) {
                    removePdfBtn.addEventListener('click', function() {
                        if (confirm('Weet u zeker dat u dit PDF bestand wilt verwijderen?')) {
                            deletePdfCheckbox.checked = true;
                            removePdfBtn.style.display = 'none';
                            if (pdfLabel) {
                                pdfLabel.textContent = 'PDF wordt verwijderd bij opslaan';
                            }
                        }
                    });
                }

                // Online Lezen Image upload handler
                const onlineLezenImageInput = document.getElementById('online_lezen_image');
                const onlineLezenImageLabel = document.getElementById('online_lezen_image_label_text');
                const onlineLezenImagePreview = document.getElementById('online_lezen_image_preview');
                const removeOnlineLezenImageBtn = document.getElementById('remove-online-lezen-image-btn');
                const deleteOnlineLezenImageCheckbox = document.getElementById('delete_online_lezen_image');

                if (onlineLezenImageInput) {
                    onlineLezenImageInput.addEventListener('change', function(e) {
                        if (e.target.files.length > 0) {
                            const file = e.target.files[0];
                            const fileName = file.name;
                            if (onlineLezenImageLabel) {
                                onlineLezenImageLabel.textContent = fileName;
                            }

                            // Show preview
                            const reader = new FileReader();
                            reader.onload = function(event) {
                                if (onlineLezenImagePreview) {
                                    onlineLezenImagePreview.innerHTML = '<img src="' + event.target.result + '" alt="Preview" style="max-width:150px;max-height:150px;">';
                                }
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                }

                if (removeOnlineLezenImageBtn && deleteOnlineLezenImageCheckbox) {
                    removeOnlineLezenImageBtn.addEventListener('click', function() {
                        if (confirm('Weet u zeker dat u deze afbeelding wilt verwijderen?')) {
                            deleteOnlineLezenImageCheckbox.checked = true;
                            removeOnlineLezenImageBtn.style.display = 'none';
                            if (onlineLezenImagePreview) {
                                onlineLezenImagePreview.innerHTML = '';
                            }
                            if (onlineLezenImageLabel) {
                                onlineLezenImageLabel.textContent = 'Afbeelding wordt verwijderd bij opslaan';
                            }
                        }
                    });
                }

                // Audio file upload handler
                const audioInput = document.getElementById('audio_file');
                const audioLabel = document.getElementById('audio_file_label_text');
                const removeAudioBtn = document.getElementById('remove-audio-btn');
                const deleteAudioCheckbox = document.getElementById('delete_audio_file');

                if (audioInput) {
                    audioInput.addEventListener('change', function(e) {
                        if (e.target.files.length > 0) {
                            const fileName = e.target.files[0].name;
                            if (audioLabel) {
                                audioLabel.textContent = fileName;
                            }
                        }
                    });
                }

                if (removeAudioBtn && deleteAudioCheckbox) {
                    removeAudioBtn.addEventListener('click', function() {
                        if (confirm('Weet u zeker dat u dit audiobestand wilt verwijderen?')) {
                            deleteAudioCheckbox.checked = true;
                            removeAudioBtn.style.display = 'none';
                            if (audioLabel) {
                                audioLabel.textContent = 'Audio wordt verwijderd bij opslaan';
                            }
                        }
                    });
                }
            });
        </script>
    </main>
</x-dashboard-layout>

// Image upload preview functionality

/**
 * Initialize image pickers with preview functionality
 * Handles images 1-4
 */
export function initImagePickers() {
    for (let i = 1; i <= 4; i++) {
        const input = document.getElementById(`image_${i}`);
        if (!input) continue;

        const label = document.getElementById(`image_${i}_label_text`);
        const preview = document.getElementById(`image_${i}_preview`);
        const removeBtn = document.querySelector(`[data-input="image_${i}"]`);
        const deleteCheckbox = document.getElementById(`delete_image_${i}`);

        input.addEventListener('change', (event) => {
            const files = event.target.files;

            if (files.length > 0) {
                const file = files[0];

                if (label) label.textContent = file.name;

                const reader = new FileReader();
                reader.onload = (e) => {
                    if (preview) {
                        preview.innerHTML = `<img src="${e.target.result}" style="max-width:60px;max-height:60px;" alt="Preview">`;
                    }
                };
                reader.readAsDataURL(file);

                if (removeBtn) removeBtn.style.display = 'inline-block';
                if (deleteCheckbox) deleteCheckbox.checked = false;
            } else {
                if (label) label.textContent = "Kies afbeelding...";
                if (preview) preview.innerHTML = '';
                if (removeBtn) removeBtn.style.display = 'none';
                if (deleteCheckbox) deleteCheckbox.checked = false;
            }
        });

        if (removeBtn) {
            removeBtn.addEventListener('click', () => {
                input.value = "";
                if (label) label.textContent = "Kies afbeelding...";
                if (preview) preview.innerHTML = '';
                removeBtn.style.display = 'none';
                if (deleteCheckbox) deleteCheckbox.checked = true;
            });
        }
    }
}

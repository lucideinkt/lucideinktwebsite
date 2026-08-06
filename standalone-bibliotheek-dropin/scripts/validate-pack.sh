#!/usr/bin/env zsh
set -euo pipefail

BASE="$(cd "$(dirname "$0")/.." && pwd)"

required=(
  "app/Http/Controllers/OnlineLezenController.php"
  "app/Models/Product.php"
  "app/Models/BookPage.php"
  "resources/views/online-lezen.blade.php"
  "resources/views/online-lezen-html-reader.blade.php"
  "resources/js/main.js"
  "resources/js/features/reader-book.js"
  "resources/css/front-end-style.css"
  "resources/css/bookshelf.css"
  "resources/css/reader-book.css"
  "database/migrations/2026_08_06_120000_create_products_table.php"
  "database/migrations/2026_08_06_120100_create_book_pages_table.php"
  "database/seeders/DatabaseSeeder.php"
  "routes/web.php"
  "vite.config.js"
  "README.md"
)

for file in "${required[@]}"; do
  if [[ ! -f "$BASE/$file" ]]; then
    echo "Missing required file: $file"
    exit 1
  fi
done

echo "Standalone drop-in pack is complete."


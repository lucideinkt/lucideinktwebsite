#!/usr/bin/env zsh
set -euo pipefail

if [[ $# -ne 1 ]]; then
  echo "Usage: $0 /absolute/path/to/fresh-laravel-app"
  exit 1
fi

SOURCE_DIR="$(cd "$(dirname "$0")/.." && pwd)"
TARGET_DIR="$1"

if [[ ! -d "$TARGET_DIR" ]]; then
  echo "Target directory not found: $TARGET_DIR"
  exit 1
fi

for p in app resources database routes config public vite.config.js; do
  if [[ -e "$SOURCE_DIR/$p" ]]; then
    rsync -a "$SOURCE_DIR/$p" "$TARGET_DIR/"
  fi
done

echo "Copied standalone bibliotheek files into: $TARGET_DIR"
echo "Next: install npm deps and run migrate/seed (see README.md)."


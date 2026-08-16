## Lucide Inkt Website

### Mobile books API (React Native app)

Set a shared key in `.env`:

```env
MOBILE_API_KEY=your-long-random-key
```

Send that key as request header:

```http
X-Mobile-Api-Key: your-long-random-key
```

Available endpoints:

- `GET /api/mobile/v1/books/manifest`
- `GET /api/mobile/v1/books/{slug}`
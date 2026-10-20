import assert from 'node:assert/strict';
import test from 'node:test';
import { getShelfSections } from '../../resources/js/bookshelf.js';

function book(id, language = '', type = '', readerUrl = '/bibliotheek/boek/lees') {
    return { dataset: { productId: String(id), language, bookType: type, readerUrl } };
}

test('groups languages and prayer books without showing empty sections', () => {
    const books = [
        book(1, 'nl', 'leesboek'),
        book(2, 'en', 'leesboek'),
        book(3, 'tr', 'leesboek'),
        book(4, 'nl', 'duaboek'),
        book(5, 'en', 'quran'),
        book(6),
    ];
    const sections = getShelfSections(books, []);
    assert.deepEqual(sections.map(section => section.key), ['nl', 'en', 'tr', 'dua-quran', 'other']);
    assert.deepEqual(sections.map(section => section.books.length), [1, 1, 1, 2, 1]);
    assert.deepEqual(getShelfSections([books[0]], []).map(section => section.key), ['nl']);
    assert.deepEqual(getShelfSections([], []), []);
});

test('recent reading is newest first, deduplicated, and only includes visible readable books', () => {
    const books = [book(1, 'nl'), book(2, 'en'), book(3, 'tr', '', '')];
    const sections = getShelfSections(books, [
        { productId: 1, page: 14, timestamp: 100 },
        { productId: '2', page: '25', timestamp: 300 },
        { productId: 1, page: 15, timestamp: 200 },
        { productId: 3, page: 10, timestamp: 500 },
        { productId: 99, page: 10, timestamp: 600 },
        null,
    ]);
    assert.equal(sections[0].key, 'recent');
    assert.deepEqual(sections[0].books.map(entry => [entry.book.dataset.productId, entry.page]), [
        ['2', 25], ['1', 15],
    ]);
    assert.equal(sections.find(section => section.key === 'nl').books[0].book, books[0]);
});

test('filters apply to recent reading and categories alike', () => {
    const hidden = book(1, 'nl');
    hidden.dataset.hidden = '1';
    assert.deepEqual(getShelfSections([hidden], [{ productId: 1, page: 5 }]), []);
});

test('invalid history and page numbers do not break regular sections', () => {
    const books = [book(1, 'nl')];
    for (const history of [null, {}, 'invalid']) {
        assert.deepEqual(getShelfSections(books, history).map(section => section.key), ['nl']);
    }
    for (const page of [-1, 0, 2.5, 'invalid']) {
        assert.equal(getShelfSections(books, [{ productId: 1, page }])[0].books[0].page, null);
    }
});

// Formatting utility functions

/**
 * Format a number as Euro currency
 * @param {number} value - The value to format
 * @returns {string} Formatted Euro string (e.g., "€ 10,50")
 */
export function formatEuro(value) {
    return '€ ' + value.toFixed(2).replace('.', ',');
}

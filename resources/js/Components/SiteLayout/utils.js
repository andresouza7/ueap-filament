/**
 * Resolve URLs para links internos e externos
 * @param {string} url - URL a ser resolvida
 * @returns {string} URL resolvida
 */
export const resolveUrl = (url) => {
    if (!url) return '#';
    // Se começar com http, //, #, /, mailto ou tel, mantem original
    if (/^(http:\/\/|https:\/\/|\/\/|#|\/|mailto:|tel:)/.test(url)) {
        return url;
    }
    // Caso contrário, assume que é um path interno sem / inicial e adiciona
    return `/${url}`;
};

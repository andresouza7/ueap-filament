import React from 'react';

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

// Helper para formatar datas (PT-BR)
export const formatDate = (dateString, includeTime = false) => {
    if (!dateString) return null;
    const date = new Date(dateString);
    if (isNaN(date.getTime())) return dateString; // Fallback se não for data válida

    const options = { day: 'numeric', month: 'short', year: 'numeric' };
    if (includeTime) {
        options.hour = '2-digit';
        options.minute = '2-digit';
    }
    return date.toLocaleDateString('pt-BR', options);
};

// Helper para formatar números (1000+ = 1k)
export const formatNumber = (num) => {
    if (!num) return 0;
    if (num >= 1000) {
        return (num / 1000).toFixed(1).replace(/\.0$/, '') + 'k';
    }
    return num;
};
import React, { useState } from 'react';
import { Search, X } from 'lucide-react';
import { route } from 'ziggy-js';

const SearchModal = ({ isOpen, onClose }) => {
    const [term, setTerm] = useState('');

    const handleSearch = () => {
        if (term.trim()) {
            window.location.href = route('site.post.list', { search: term });
            onClose();
        }
    };

    if (!isOpen) return null;
    return (
        <div className="fixed inset-0 z-[100] flex items-center justify-center px-4">
            <div className="absolute inset-0 bg-[#003D99]/90 backdrop-blur-sm animate-in fade-in duration-300" onClick={onClose}></div>
            <div className="relative w-full max-w-3xl bg-white shadow-2xl rounded-sm overflow-hidden animate-in zoom-in-95 duration-300">
                <div className="flex items-center p-6 border-b border-gray-100">
                    <button onClick={handleSearch} className="mr-4 text-ueap-primary hover:scale-110 transition-transform">
                        <Search size={24} />
                    </button>
                    <input
                        autoFocus
                        type="text"
                        placeholder="O que você procura?"
                        className="flex-1 bg-transparent border-none focus:ring-0 text-xl font-medium text-contrast-heading placeholder:text-contrast-subtle"
                        value={term}
                        onChange={(e) => setTerm(e.target.value)}
                        onKeyDown={(e) => e.key === 'Enter' && handleSearch()}
                    />
                    <button onClick={onClose} className="p-2 hover:bg-gray-100 rounded-full transition-colors text-contrast-muted hover:text-ueap-primary"><X size={24} /></button>
                </div>
                <div className="p-8 bg-gray-50 text-left">
                    <h4 className="text-[10px] font-bold text-contrast-muted uppercase tracking-widest mb-4">Sugestões de busca</h4>
                    <div className="flex flex-wrap gap-2">
                        {['Calendário Acadêmico', 'Edital', 'Matrícula', 'Bolsa', 'Inscrições'].map(tag => (
                            <button
                                key={tag}
                                onClick={() => { setTerm(tag); window.location.href = route('site.post.list', { search: tag }); onClose(); }}
                                className="px-4 py-2 bg-white border border-gray-200 text-[10px] font-bold text-ueap-primary hover:bg-ueap-accent hover:border-ueap-accent transition-all uppercase tracking-widest"
                            >
                                {tag}
                            </button>
                        ))}
                    </div>
                </div>
            </div>
        </div>
    );
};

export default SearchModal;

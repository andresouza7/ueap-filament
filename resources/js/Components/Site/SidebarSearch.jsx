import React, { useState } from 'react';
import { Search } from 'lucide-react';
import { route } from 'ziggy-js';

const SidebarSearch = () => {
    const [term, setTerm] = useState('');

    const handleSearch = () => {
        if (term.trim()) {
            window.location.href = route('site.post.list', { search: term });
        }
    };

    return (
        <div className="bg-gray-50 p-6 border-l-4 border-ueap-primary">
            <h3 className="text-xs font-bold text-ueap-primary uppercase tracking-widest mb-4">Pesquisar no Portal</h3>
            <div className="relative">
                <input
                    type="text"
                    placeholder="O que você procura?"
                    className="w-full pl-4 pr-10 py-3 border border-gray-200 text-sm focus:outline-none focus:border-ueap-accent transition-colors"
                    value={term}
                    onChange={(e) => setTerm(e.target.value)}
                    onKeyDown={(e) => e.key === 'Enter' && handleSearch()}
                />
                <button onClick={handleSearch} className="absolute right-3 top-3 text-contrast-subtle hover:text-ueap-primary transition-colors">
                    <Search size={18} />
                </button>
            </div>
        </div>
    );
};

export default SidebarSearch;

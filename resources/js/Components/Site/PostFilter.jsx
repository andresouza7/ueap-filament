import React from 'react';
import { Search, ChevronDown } from 'lucide-react';

const PostFilter = ({ searchTerm, onSearchChange, onSearchSubmit, filterType, onFilterChange }) => {
    return (
        <div className="mb-10 p-1 bg-gray-100 rounded-sm flex flex-col md:flex-row gap-1">
            <div className="flex-1 relative">
                <input
                    type="text"
                    placeholder="Pesquisar notícias, eventos ou páginas..."
                    className="w-full pl-12 pr-4 py-4 bg-white border-none text-xs font-medium focus:ring-2 focus:ring-[#0052CC] transition-all uppercase placeholder:normal-case"
                    value={searchTerm}
                    onChange={(e) => onSearchChange(e.target.value)}
                    onKeyDown={onSearchSubmit}
                />
                <Search className="absolute left-4 top-4 text-gray-300" size={18} />
            </div>
            <div className="relative">
                <select
                    value={filterType}
                    onChange={onFilterChange}
                    className="w-full md:w-56 appearance-none pl-6 pr-12 py-4 bg-white border-none text-[10px] font-bold uppercase tracking-widest focus:ring-2 focus:ring-[#0052CC] cursor-pointer"
                >
                    <option value="todos">Todos os Formatos</option>
                    <option value="news">Notícia</option>
                    <option value="event">Evento</option>
                    <option value="page">Página</option>
                </select>
                <ChevronDown className="absolute right-4 top-5 text-gray-400 pointer-events-none" size={14} />
            </div>
        </div>
    );
};

export default PostFilter;

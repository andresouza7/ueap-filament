import React, { useState } from 'react';
import { Search, Clock, Mail, Send } from 'lucide-react';
import { route } from 'ziggy-js';

const DefaultSidebar = ({ recentNews = [] }) => {
    const [term, setTerm] = useState('');

    const handleSearch = () => {
        if (term.trim()) {
            window.location.href = route('site.post.list', { search: term });
        }
    };

    return (
        <div className="space-y-12">
            {/* Pesquisa */}
            <div className="bg-gray-50 p-6 border-l-4 border-[#0052CC]">
                <h3 className="text-xs font-bold text-[#0052CC] uppercase tracking-widest mb-4">Pesquisar Notícias</h3>
                <div className="relative">
                    <input
                        type="text"
                        placeholder="O que você procura?"
                        className="w-full pl-4 pr-10 py-3 border border-gray-200 text-sm focus:outline-none focus:border-[#A3E635] transition-colors"
                        value={term}
                        onChange={(e) => setTerm(e.target.value)}
                        onKeyDown={(e) => e.key === 'Enter' && handleSearch()}
                    />
                    <button onClick={handleSearch} className="absolute right-3 top-3 text-gray-300 hover:text-[#0052CC] transition-colors">
                        <Search size={18} />
                    </button>
                </div>
            </div>

            {/* Últimas Notícias */}
            {recentNews.length > 0 && (
                <div>
                    <h3 className="text-xs font-bold text-[#0052CC] uppercase tracking-widest mb-6 flex items-center gap-2">
                        <Clock size={16} /> Últimas Notícias
                    </h3>
                    <div className="space-y-6">
                        {recentNews.map(item => (
                            <a
                                key={item.id}
                                href={route('site.post.show', item.slug || item.id)} // Assuming slug is available or we use id as fallback? Best to use slug if possible.
                                className="flex gap-4 group text-left w-full"
                            >
                                <div className="w-20 h-20 bg-gray-100 shrink-0 overflow-hidden">
                                    <img src={item.image_url} alt={item.title} className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                                </div>
                                <div>
                                    <h4 className="text-xs font-bold text-gray-800 group-hover:text-[#0052CC] transition-colors leading-snug line-clamp-2 uppercase">
                                        {item.title}
                                    </h4>
                                    <span className="text-[9px] text-gray-400 font-bold mt-1 block uppercase tracking-tighter">{item.date}</span>
                                </div>
                            </a>
                        ))}
                    </div>
                </div>
            )}

            {/* Newsletter Sidebar */}
            <div className="bg-[#0052CC] p-8 text-white relative overflow-hidden">
                <div className="absolute -top-4 -right-4 opacity-10">
                    <Mail size={80} />
                </div>
                <h3 className="text-lg font-bold uppercase tracking-tighter mb-2 relative z-10">Newsletter</h3>
                <p className="text-[10px] text-white/70 font-bold uppercase tracking-wider mb-6 relative z-10">Receba atualizações oficiais</p>
                <div className="space-y-3 relative z-10">
                    <input type="email" placeholder="Seu e-mail" className="w-full px-4 py-3 bg-white/10 border border-white/20 text-xs focus:outline-none focus:bg-white focus:text-[#0052CC] transition-all placeholder:text-white/50" />
                    <button className="w-full bg-[#A3E635] text-[#0052CC] py-3 text-[10px] font-bold uppercase tracking-widest hover:bg-white transition-colors">Inscrever</button>
                </div>
            </div>

            {/* Categorias */}
            <div>
                <h3 className="text-xs font-bold text-[#0052CC] uppercase tracking-widest mb-6">Categorias</h3>
                <div className="flex flex-wrap gap-2">
                    {['Direito', 'Química', 'Engenharia', 'Artes', 'Editais', 'Processo Seletivo', 'Eventos'].map(cat => (
                        <a key={cat} href="#" className="px-4 py-2 bg-gray-100 hover:bg-[#A3E635] text-[10px] font-bold text-gray-600 hover:text-[#0052CC] uppercase tracking-widest transition-colors rounded-full">
                            {cat}
                        </a>
                    ))}
                </div>
            </div>
        </div>
    );
};

export default DefaultSidebar;

import React, { useState } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import { Home, ChevronRight, Search, ChevronDown, Calendar, ArrowUpRight, ChevronLeft } from 'lucide-react';
import { route } from 'ziggy-js';
import { router, Link } from '@inertiajs/react';

const PostList = ({ posts, categories, searchString, latestPosts }) => {
    const [searchTerm, setSearchTerm] = useState(searchString || '');
    const [filterType, setFilterType] = useState('todos');

    const handleSearch = (e) => {
        if (e.key === 'Enter') {
            router.get(route('site.post.list'), { search: searchTerm, type: filterType !== 'todos' ? filterType : undefined }, { preserveState: true });
        }
    };

    const handleFilterChange = (e) => {
        const newType = e.target.value;
        setFilterType(newType);
        router.get(route('site.post.list'), { search: searchTerm, type: newType !== 'todos' ? newType : undefined }, { preserveState: true });
    };

    // Helper for recentNews items adaptation
    const recentNews = latestPosts?.map(p => ({
        id: p.id,
        title: p.title,
        image_url: p.image_url || "https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&q=80&w=400",
        date: p.created_at ? new Date(p.created_at).toLocaleDateString() : "Recente",
        slug: p.slug
    })) || [];

    return (
        <SidebarLayout recentNews={recentNews}>
            {/* Cabeçalho da Página de Listagem */}
            <div className="mb-10 text-left">
                <nav className="flex items-center gap-2 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">
                    <Link href={route('site.home')} className="hover:text-[#0052CC] transition-colors flex items-center gap-1"><Home size={12} /> Home</Link>
                    <ChevronRight size={12} />
                    <span className="text-[#0052CC]">Publicações</span>
                </nav>
                <h2 className="text-4xl md:text-5xl font-bold text-[#0052CC] uppercase tracking-tighter mb-2">Explorar Publicações</h2>
                <div className="h-1.5 w-20 bg-[#A3E635]"></div>
            </div>

            {/* Filtro e Pesquisa Superior */}
            <div className="mb-10 p-1 bg-gray-100 rounded-sm flex flex-col md:flex-row gap-1">
                <div className="flex-1 relative">
                    <input
                        type="text"
                        placeholder="Pesquisar notícias, eventos ou páginas..."
                        className="w-full pl-12 pr-4 py-4 bg-white border-none text-xs font-medium focus:ring-2 focus:ring-[#0052CC] transition-all uppercase placeholder:normal-case"
                        value={searchTerm}
                        onChange={(e) => setSearchTerm(e.target.value)}
                        onKeyDown={handleSearch}
                    />
                    <Search className="absolute left-4 top-4 text-gray-300" size={18} />
                </div>
                <div className="relative">
                    <select
                        value={filterType}
                        onChange={handleFilterChange}
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

            {/* Lista de Notícias em formato Paisagem */}
            <div className="space-y-10">
                {posts.data.map((item) => (
                    <div
                        key={item.id}
                        className="group flex flex-col md:flex-row gap-8 pb-10 border-b border-gray-100 last:border-0 cursor-pointer"
                    >
                        <Link href={route('site.post.show', item.slug)} className="contents">
                            {/* Container da Imagem em Paisagem (16:9) */}
                            <div className="w-full md:w-72 aspect-video bg-gray-200 overflow-hidden shrink-0 shadow-md">
                                <img
                                    src={item.image_url || `https://picsum.photos/seed/${item.id + 50}/600/338`}
                                    alt={item.title}
                                    className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                />
                            </div>

                            <div className="flex flex-col justify-center py-2">
                                <div className="flex items-center gap-4 mb-3">
                                    <span className="text-[9px] font-bold text-[#0052CC] bg-[#A3E635] px-2.5 py-1 uppercase tracking-widest">
                                        {item.category?.name || "GERAL"}
                                    </span>
                                    <span className="text-[9px] font-bold text-gray-400 uppercase tracking-widest flex items-center gap-1.5">
                                        <Calendar size={12} className="text-[#A3E635]" /> {new Date(item.created_at).toLocaleDateString()}
                                    </span>
                                </div>
                                <h3 className="text-xl md:text-2xl font-bold text-gray-800 group-hover:text-[#0052CC] transition-colors leading-tight uppercase tracking-tighter line-clamp-4">
                                    {item.title}
                                </h3>
                                <div className="mt-5 flex items-center gap-2 text-[10px] font-bold text-[#0052CC] group-hover:gap-4 transition-all uppercase tracking-widest">
                                    Continuar Lendo <ArrowUpRight size={14} />
                                </div>
                            </div>
                        </Link>
                    </div>
                ))}
            </div>

            {/* Paginação */}
            <div className="mt-16 pt-10 border-t border-gray-50 flex items-center justify-between">
                <span className="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                    Página {posts.current_page} de {posts.last_page}
                </span>
                <div className="flex gap-2">
                    {posts.links.map((link, i) => (
                        <Link
                            key={i}
                            href={link.url || '#'}
                            className={`p-3 border text-xs font-bold transition-all ${link.active
                                ? 'bg-[#0052CC] text-white border-[#0052CC]'
                                : 'border-gray-100 text-gray-500 hover:border-[#0052CC] hover:text-[#0052CC]'
                                } ${!link.url && 'opacity-50 cursor-not-allowed'}`}
                            dangerouslySetInnerHTML={{ __html: link.label }}
                            preserveState
                        />
                    ))}
                </div>
            </div>
        </SidebarLayout>
    );
};

export default PostList;

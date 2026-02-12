import React, { useState } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import PostFilter from '@/Components/Site/PostFilter';
import PostCard from '@/Components/Site/PostCard';
import Pagination from '@/Components/Site/Pagination';
import SidebarNews from '@/Components/Site/SidebarNews';
import SidebarNewsletter from '@/Components/Site/SidebarNewsletter';
import SidebarCategories from '@/Components/Site/SidebarCategories';
import { Home, ChevronRight } from 'lucide-react';
import { route } from 'ziggy-js';
import { router, Link } from '@inertiajs/react';

const PostList = ({ posts, categories, searchString, latestPosts, activeCategory, postType }) => {
    const [searchTerm, setSearchTerm] = useState(searchString || '');
    const [filterType, setFilterType] = useState(postType || 'todos');

    const handleSearch = (e) => {
        if (e.key === 'Enter') {
            router.get(route('site.post.list'), {
                search: searchTerm,
                type: filterType !== 'todos' ? filterType : undefined,
                category: activeCategory?.slug
            }, { preserveState: true });
        }
    };

    const handleFilterChange = (e) => {
        const newType = e.target.value;
        setFilterType(newType);
        router.get(route('site.post.list'), {
            search: searchTerm,
            type: newType !== 'todos' ? newType : undefined,
            category: activeCategory?.slug
        }, { preserveState: true });
    };

    const clearFilters = () => {
        setSearchTerm('');
        setFilterType('todos');
        router.get(route('site.post.list'));
    };

    // Helper for recentNews items adaptation
    const recentNews = latestPosts?.map(p => ({
        id: p.id,
        title: p.title,
        image_url: p.image_url || "https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&q=80&w=400",
        date: p.created_at ? new Date(p.created_at).toLocaleDateString() : "Recente",
        slug: p.slug
    })) || [];

    // Header Content similar to DocumentList
    const headerContent = (
        <div className="bg-gray-50 border-b border-gray-100 pt-12 md:pt-20 pb-8 md:pb-12 text-left">
            <div className="max-w-7xl mx-auto px-4">
                <nav className="flex items-center gap-2 text-[10px] font-bold text-contrast-muted uppercase tracking-widest mb-6">
                    <Link href={route('site.home')} className="hover:text-ueap-primary transition-colors flex items-center gap-1"><Home size={12} /> Home</Link>
                    <ChevronRight size={12} />
                    <span className="text-ueap-primary">Publicações</span>
                </nav>
                <h2 className="text-4xl md:text-5xl font-black text-contrast-heading uppercase tracking-tighter mb-4">Explorar Publicações</h2>
                <div className="h-2 w-24 bg-ueap-primary"></div>
            </div>
        </div>
    );

    // Custom Sidebar without duplicate search
    const sidebarContent = (
        <div className="space-y-12">
            <SidebarNews recentNews={recentNews} />
            <SidebarNewsletter />
            <SidebarCategories categories={categories} />
        </div>
    );

    const hasActiveFilters = searchString || activeCategory || (postType && postType !== 'todos');

    return (
        <SidebarLayout recentNews={recentNews} header={headerContent} sidebar={sidebarContent} >

            <PostFilter
                searchTerm={searchTerm}
                onSearchChange={setSearchTerm}
                onSearchSubmit={handleSearch}
                filterType={filterType}
                onFilterChange={handleFilterChange}
            />

            {hasActiveFilters ? (
                <div className="mb-8 p-4 bg-gray-50 border border-gray-100 flex flex-wrap items-center justify-between gap-4">
                    <div className="flex flex-wrap items-center gap-4">
                        <div className="flex flex-wrap items-center gap-2">
                            <span className="text-[10px] font-bold text-contrast-muted uppercase tracking-widest">Filtrando por:</span>

                            {searchString && (
                                <span className="inline-flex items-center gap-1.5 px-3 py-1 bg-white border border-gray-200 text-ueap-primary text-[10px] font-bold uppercase tracking-wider">
                                    Busca: "{searchString}"
                                </span>
                            )}

                            {activeCategory && (
                                <span className="inline-flex items-center gap-1.5 px-3 py-1 bg-white border border-gray-200 text-ueap-primary text-[10px] font-bold uppercase tracking-wider">
                                    Categoria: {activeCategory.name}
                                </span>
                            )}

                            {postType && postType !== 'todos' && (
                                <span className="inline-flex items-center gap-1.5 px-3 py-1 bg-white border border-gray-200 text-ueap-primary text-[10px] font-bold uppercase tracking-wider">
                                    Tipo: {postType === 'news' ? 'Notícias' : 'Eventos'}
                                </span>
                            )}
                        </div>

                        <div className="h-4 w-px bg-gray-200 hidden md:block"></div>

                        <span className="text-[10px] font-bold text-contrast-muted uppercase tracking-widest">
                            {posts.total} {posts.total === 1 ? 'Resultado' : 'Resultados'}
                        </span>
                    </div>

                    <button
                        onClick={clearFilters}
                        className="text-[10px] font-bold text-red-500 uppercase tracking-widest hover:underline"
                    >
                        Limpar Filtros
                    </button>
                </div>
            ) : (
                <div className="mb-8 text-[10px] font-bold text-contrast-muted uppercase tracking-[0.2em]">
                    {posts.total} {posts.total === 1 ? 'Publicação encontrada' : 'Publicações encontradas'}
                </div>
            )}

            {/* Lista de Notícias em formato Paisagem */}
            <div className="space-y-10">
                {posts.data.map((item) => (
                    <PostCard key={item.id} item={item} />
                ))}
            </div>

            {/* Paginação */}
            <Pagination
                links={posts.links}
                currentPage={posts.current_page}
                lastPage={posts.last_page}
            />
        </SidebarLayout>
    );
};

export default PostList;

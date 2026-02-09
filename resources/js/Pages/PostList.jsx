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

    // Header Content similar to DocumentList
    const headerContent = (
        <div className="bg-white border-b border-gray-100 pt-12 md:pt-20 pb-8 md:pb-12 text-left">
            <div className="max-w-7xl mx-auto px-4">
                <nav className="flex items-center gap-2 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-6">
                    <Link href={route('site.home')} className="hover:text-[#0052CC] transition-colors flex items-center gap-1"><Home size={12} /> Home</Link>
                    <ChevronRight size={12} />
                    <span className="text-[#0052CC]">Publicações</span>
                </nav>
                <h2 className="text-4xl md:text-5xl font-black text-gray-800 uppercase tracking-tighter mb-4">Explorar Publicações</h2>
                <div className="h-2 w-24 bg-ueap-primary"></div>
            </div>
        </div>
    );

    // Custom Sidebar without duplicate search
    const sidebarContent = (
        <div className="space-y-12">
            <SidebarNews recentNews={recentNews} />
            <SidebarNewsletter />
            <SidebarCategories />
        </div>
    );

    return (
        <SidebarLayout recentNews={recentNews} header={headerContent} sidebar={sidebarContent}>

            <PostFilter
                searchTerm={searchTerm}
                onSearchChange={setSearchTerm}
                onSearchSubmit={handleSearch}
                filterType={filterType}
                onFilterChange={handleFilterChange}
            />

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

import React from 'react';
import { Link } from '@inertiajs/react';
import { route } from 'ziggy-js';

const RelatedPosts = ({ posts }) => {
    if (!posts || posts.length === 0) return null;

    const formatDate = (dateString) => {
        if (!dateString) return '';
        return new Date(dateString).toLocaleDateString('pt-BR', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
    };

    return (
        <div className="mt-20 pt-16 border-t border-gray-100 animate-fade-in-up">
            <div className="flex items-center gap-4 mb-10">
                <div className="h-8 w-1.5 bg-[#A3E635]"></div>
                <h3 className="text-2xl font-black text-[#0052CC] uppercase tracking-tighter">Veja Também</h3>
            </div>

            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                {posts.map((post) => (
                    <Link
                        key={post.id}
                        href={route('site.post.show', post.slug)}
                        className="group cursor-pointer flex flex-col"
                    >
                        <div className="aspect-video overflow-hidden mb-4 bg-gray-100 shadow-sm border border-gray-50 rounded-none relative">
                            <img
                                src={post.image_url || "https://placehold.co/600x400?text=UEAP"}
                                className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                alt={post.title}
                            />
                            <div className="absolute top-0 right-0 bg-[#A3E635] text-[#0052CC] px-2 py-0.5 font-black text-[8px] uppercase tracking-widest">
                                {post.category?.name || 'Notícia'}
                            </div>
                        </div>
                        <p className="text-[8px] text-gray-400 font-bold mb-2 uppercase tracking-widest">{formatDate(post.created_at)}</p>
                        <h4 className="text-xs font-bold text-gray-800 group-hover:text-[#0052CC] transition-colors leading-snug uppercase tracking-tight line-clamp-3">
                            {post.title}
                        </h4>
                    </Link>
                ))}
            </div>
        </div>
    );
};

export default RelatedPosts;

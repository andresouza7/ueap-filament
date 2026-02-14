import React from 'react';
import { Clock } from 'lucide-react';
import { route } from 'ziggy-js';
import { usePage } from '@inertiajs/react';
import { formatDate } from '@/Components/SiteLayout/utils';

const SidebarNews = () => {
    const { latestPosts } = usePage().props;

    if (!latestPosts || latestPosts.length === 0) return null;

    const recentNews = latestPosts?.map(p => ({
        id: p.id,
        title: p.title,
        image_url: p.image_url,
        date: formatDate(p.created_at),
        slug: p.slug
    })) || [];

    return (
        <div>
            <div className="flex items-center justify-between mb-6">
                <h3 className="text-xs font-bold text-ueap-primary uppercase tracking-widest flex items-center gap-2">
                    <Clock size={16} /> Últimas Notícias
                </h3>
                <a
                    href={route('site.post.list', { type: 'news' })}
                    className="text-[10px] font-bold text-contrast-muted hover:text-ueap-primary uppercase tracking-widest transition-colors"
                >
                    Ver todas
                </a>
            </div>
            <div className="space-y-6">
                {recentNews.map(item => (
                    <a
                        key={item.id}
                        href={route('site.post.show', item.slug || item.id)}
                        className="flex gap-4 group text-left w-full items-center"
                    >
                        <div className="w-24 h-16 bg-gray-100 shrink-0 overflow-hidden">
                            <img src={item.image_url} alt={item.title} className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                        </div>
                        <div className="flex flex-col justify-center">
                            <span className="text-[10px] text-contrast-muted font-bold mb-1 block uppercase tracking-tight">{item.date}</span>
                            <h4 className="text-sm font-semibold text-contrast-heading group-hover:text-ueap-primary transition-colors leading-snug line-clamp-2">
                                {item.title}
                            </h4>
                        </div>
                    </a>
                ))}
            </div>
        </div>
    );
};

export default SidebarNews;

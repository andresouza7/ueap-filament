import React from 'react';
import { Link } from '@inertiajs/react';
import { route } from 'ziggy-js';
import { Calendar, ArrowUpRight } from 'lucide-react';

const PostCard = ({ item }) => {
    return (
        <div className="group flex flex-col md:flex-row gap-3 md:gap-6 pb-8 border-b border-gray-100 last:border-0 cursor-pointer">
            <Link href={route('site.post.show', item.slug)} className="contents">
                {/* Container da Imagem em Paisagem (16:9 movel, fixo desktop) */}
                <div className="w-full aspect-video md:w-48 md:h-32 md:aspect-auto bg-gray-200 overflow-hidden shrink-0 shadow-md self-start">
                    <img
                        src={item.image_url || `https://picsum.photos/seed/${item.id + 50}/600/338`}
                        alt="" // Decorative since title is present in the link content
                        className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                        aria-hidden="true"
                    />
                </div>

                <div className="flex flex-col justify-center py-2">
                    <div className="flex items-center gap-4 mb-3">
                        <span className="text-[9px] font-bold text-ueap-primary bg-ueap-accent px-2.5 py-1 uppercase tracking-widest">
                            {item.category?.name || "GERAL"}
                        </span>
                        <span className="text-[9px] font-bold text-contrast-muted uppercase tracking-widest flex items-center gap-1.5">
                            <Calendar size={12} className="text-ueap-accent" aria-hidden="true" /> {new Date(item.created_at).toLocaleDateString()}
                        </span>
                    </div>
                    <h3 className="text-xl md:text-lg font-semibold text-contrast-heading group-hover:text-ueap-primary transition-colors leading-tight tracking-tight line-clamp-4">
                        {item.title}
                    </h3>
                    <div className="mt-5 flex items-center gap-2 text-[10px] font-bold text-ueap-primary group-hover:gap-4 transition-all uppercase tracking-widest">
                        Continuar Lendo <ArrowUpRight size={14} aria-hidden="true" />
                    </div>
                </div>
            </Link>
        </div>
    );
};

export default PostCard;

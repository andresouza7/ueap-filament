import React from 'react';
import { ChevronRight, ArrowUpRight } from 'lucide-react';
import { route } from 'ziggy-js';

const HeroSection = ({ featured = [] }) => {
    // Ensure we have at least one featured item to show the main highlight
    // If not, we could return null or skeleton, but for now check existence
    const mainHighlight = featured.length > 0 ? featured[0] : null;
    const secondaryHighlights = featured.length > 1 ? featured.slice(1) : [];

    if (!mainHighlight) {
        return null; // Or a placeholder
    }

    return (
        <section className="bg-[#0052CC] py-12 md:py-16 relative">
            <div className="absolute inset-0 opacity-10" style={{ backgroundImage: 'radial-gradient(white 1px, transparent 1px)', backgroundSize: '40px 40px' }}></div>

            <div className="max-w-7xl mx-auto px-4 relative z-10">
                <div className="grid grid-cols-1 lg:grid-cols-3 gap-6 h-auto lg:h-[550px]">

                    {/* NOTÍCIA PRINCIPAL (ESQUERDA) */}
                    <div className="lg:col-span-2 relative group overflow-hidden bg-gray-900 shadow-2xl rounded-sm">
                        <img
                            src={mainHighlight.image_url || "https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80&w=1200"} // Fallback image if needed
                            className="w-full h-full object-cover opacity-60 group-hover:scale-105 group-hover:opacity-40 transition-all duration-1000"
                            alt={mainHighlight.title}
                        />
                        <div className="absolute inset-0 p-8 md:p-14 flex flex-col justify-end">
                            <div className="bg-[#A3E635] text-[#0052CC] inline-block w-fit px-3 py-1 font-bold text-[10px] md:text-xs mb-4 uppercase tracking-[0.2em]">
                                {mainHighlight.category?.name || "DESTAQUE"}
                            </div>
                            <h2 className="text-white text-3xl md:text-5xl font-bold mb-8 tracking-tighter leading-tight max-w-2xl group-hover:text-[#A3E635] transition-colors">
                                {mainHighlight.title}
                            </h2>
                            <a href={route('site.post.show', mainHighlight.slug)} className="bg-[#A3E635] text-[#0052CC] px-8 py-4 w-fit font-bold text-xs uppercase tracking-[0.2em] hover:bg-white transition-all flex items-center gap-2 group/btn">
                                LER MATÉRIA COMPLETA <ChevronRight size={18} className="group-hover/btn:translate-x-1 transition-transform" />
                            </a>
                        </div>
                    </div>

                    {/* NOTÍCIA SECUNDÁRIAS (DIREITA) */}
                    <div className="flex flex-col gap-6">
                        {secondaryHighlights.map((item, idx) => (
                            <div key={item.id || idx} className="flex-1 relative group overflow-hidden bg-gray-900 shadow-xl rounded-sm min-h-[200px]">
                                <img
                                    src={item.image_url || "https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&q=80&w=800"} // Fallback
                                    className="absolute inset-0 w-full h-full object-cover opacity-50 group-hover:scale-110 group-hover:opacity-30 transition-all duration-700"
                                    alt={item.title}
                                />
                                <div className="absolute inset-0 p-6 flex flex-col justify-end">
                                    <span className="text-[#A3E635] text-[10px] font-bold uppercase mb-2 block tracking-widest">
                                        {item.category?.name || "NOTÍCIA"}
                                    </span>
                                    <h3 className="text-white text-lg md:text-xl font-bold uppercase leading-tight group-hover:text-[#A3E635] transition-colors">
                                        {item.title}
                                    </h3>
                                    <a href={route('site.post.show', item.slug)} className="absolute inset-0 z-20"></a>
                                    <div className="mt-4 opacity-0 group-hover:opacity-100 transition-all transform translate-y-2 group-hover:translate-y-0 text-[#A3E635] flex items-center gap-1 text-[10px] font-bold tracking-[0.2em]">
                                        SAIBA MAIS <ArrowUpRight size={14} />
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>

                </div>
            </div>
        </section>
    );
};

export default HeroSection;

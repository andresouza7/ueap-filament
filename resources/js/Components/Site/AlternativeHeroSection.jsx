import React from 'react';
import { ChevronRight, ArrowUpRight } from 'lucide-react';
import { route } from 'ziggy-js';

const AlternativeHeroSection = ({ featured = [] }) => {
    // Adapter for props to match the layout's expectations if necessary
    // or just use featured directly.
    const highlights = featured.length > 0 ? featured : [
        {
            title: "PS UEAP 2025: CHAMADA OFICIAL DO RESULTADO PRELIMINAR",
            category: { name: "PROCESSO SELETIVO" },
            image_url: "https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80&w=1200",
            slug: '#'
        },
        {
            title: "SUFRAMA CREDENCIA UEAP PARA INVESTIMENTOS",
            category: { name: "INOVAÇÃO" },
            image_url: "https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&q=80&w=800",
            slug: '#'
        },
        {
            title: "RENOVAÇÃO DE BOLSAS PIBEX",
            category: { name: "EXTENSÃO" },
            image_url: "https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=800",
            slug: '#'
        }
    ];

    const mainHighlight = highlights[0];
    const secondaryHighlights = highlights.slice(1, 3);

    return (
        /* SEÇÃO NOTÍCIAS DESTAQUE (DESIGN COM FUNDO VERDE - MESMA ALTURA, LARGURAS DIFERENTES) */
        <section className="bg-[#A3E635] relative overflow-hidden">
            <div className="grid grid-cols-1 lg:grid-cols-5 gap-0 h-auto lg:h-[650px] items-stretch">

                {/* COLUNA ESQUERDA: Maior (60% / col-span-3) */}
                <a
                    href={route('site.post.show', mainHighlight.slug || '#')}
                    className="lg:col-span-3 relative overflow-hidden group cursor-pointer h-full block"
                >
                    <img
                        src={mainHighlight.image_url}
                        className="w-full h-full object-cover group-hover:scale-105 transition-all duration-1000 brightness-[0.4] group-hover:brightness-[0.3]"
                        alt={mainHighlight.title}
                    />
                    <div className="absolute inset-0 p-8 md:p-16 flex flex-col justify-end text-left z-10">
                        <span className="bg-[#0052CC] text-white inline-block w-fit px-3 py-1 font-bold text-[10px] md:text-xs mb-6 uppercase tracking-[0.2em]">
                            {mainHighlight.category?.name || "DESTAQUE"}
                        </span>
                        <h2 className="text-white text-3xl md:text-6xl font-black mb-10 tracking-tighter leading-tight uppercase drop-shadow-2xl max-w-2xl group-hover:text-[#A3E635] transition-colors">
                            {mainHighlight.title}
                        </h2>
                        <div className="bg-[#0052CC] text-white px-10 py-5 w-fit font-bold text-xs uppercase tracking-[0.2em] hover:bg-white hover:text-[#0052CC] transition-all flex items-center gap-3 shadow-2xl">
                            LER MATÉRIA COMPLETA <ChevronRight size={20} />
                        </div>
                    </div>
                    {/* Elemento visual do brasão oculto no fundo */}
                    <div className="absolute -top-10 -right-10 opacity-[0.03] pointer-events-none rotate-12">
                        <img
                            src="/img/site/logo.png"
                            className="w-[500px] h-auto"
                            onError={(e) => { e.target.style.display = 'none'; }}
                            alt=""
                        />
                    </div>
                </a>

                {/* COLUNA DIREITA: Menor (40% / col-span-2) */}
                <div className="lg:col-span-2 flex flex-col gap-0 h-full">
                    {secondaryHighlights.map((item, idx) => (
                        <a
                            key={item.id || idx}
                            href={route('site.post.show', item.slug || '#')}
                            className="flex-1 relative group overflow-hidden cursor-pointer border-l lg:border-l-0 lg:border-b border-white/10 last:border-b-0 block"
                        >
                            <img
                                src={item.image_url}
                                className="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-all duration-700 brightness-50 group-hover:brightness-[0.4]"
                                alt={item.title}
                            />
                            <div className="absolute inset-0 bg-gradient-to-t from-[#0052CC]/90 via-transparent to-transparent opacity-60"></div>
                            <div className="absolute inset-0 p-8 flex flex-col justify-end text-left z-10">
                                <span className="text-[#A3E635] text-[10px] font-bold uppercase mb-2 block tracking-widest">
                                    {item.category?.name || "NOTÍCIA"}
                                </span>
                                <h3 className="text-white text-xl md:text-2xl font-bold uppercase leading-tight group-hover:text-[#A3E635] transition-colors">
                                    {item.title}
                                </h3>
                                <div className="mt-4 flex items-center gap-2 text-[#A3E635] text-[9px] font-bold tracking-[0.2em] opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all">
                                    SAIBA MAIS <ArrowUpRight size={14} />
                                </div>
                            </div>
                        </a>
                    ))}
                </div>
            </div>
        </section>
    );
};

export default AlternativeHeroSection;

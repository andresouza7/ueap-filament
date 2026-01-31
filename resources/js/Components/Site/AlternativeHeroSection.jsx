import React from 'react';
import { ChevronRight, ArrowUpRight } from 'lucide-react';
import { route } from 'ziggy-js';
import QuickAccessSection from '@/Components/Site/QuickAccessSection';

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
        /* SEÇÃO NOTÍCIAS DESTAQUE (DESIGN CLEAN/COMPACTO) */
        <section className="relative overflow-hidden py-20 z-10 bg-gradient-to-b from-[#F5F9FF] to-gray-50">


            {/* Geometric Hollow Shapes (Side Decorations) */}
            <div className="absolute top-0 right-0 w-[600px] h-[600px] border-[4px] border-[#A3E635] rounded-full opacity-20 pointer-events-none translate-x-1/3 -translate-y-1/3"></div>
            <div className="absolute bottom-0 left-0 w-[500px] h-[500px] border-[4px] border-[#0052CC] rounded-[3rem] rotate-45 opacity-10 pointer-events-none -translate-x-1/3 translate-y-1/3"></div>

            <div className="max-w-7xl mx-auto px-4 relative z-10">
                <div className="grid grid-cols-1 lg:grid-cols-6 gap-0 h-auto lg:h-[550px] items-stretch bg-gray-900 shadow-xl ml-1 mr-1 lg:mx-0">

                    {/* COLUNA ESQUERDA: Maior (66% / col-span-4) */}
                    <a
                        href={route('site.post.show', mainHighlight.slug || '#')}
                        className="lg:col-span-4 relative overflow-hidden group cursor-pointer h-full block shadow-sm hover:shadow-2xl transition-all duration-500"
                    >
                        <img
                            src={mainHighlight.image_url}
                            className="w-full h-full object-cover group-hover:scale-105 transition-all duration-1000 brightness-75 group-hover:brightness-50"
                            alt={mainHighlight.title}
                        />
                        <div className="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>

                        <div className="absolute inset-0 p-8 md:p-12 flex flex-col justify-end text-left z-10">
                            <span className="bg-[#A3E635] text-[#0052CC] inline-flex w-fit items-center justify-center px-3 py-1 font-bold text-[10px] md:text-xs mb-4 uppercase tracking-[0.2em] shadow-lg transform group-hover:-translate-y-1 transition-transform">
                                {mainHighlight.category?.name || "DESTAQUE"}
                            </span>
                            <h2 className="text-white text-2xl md:text-5xl font-black mb-6 tracking-tighter leading-tight uppercase drop-shadow-xl max-w-3xl group-hover:text-[#A3E635] transition-colors">
                                {mainHighlight.title}
                            </h2>
                            <div className="text-white w-fit font-bold text-xs uppercase tracking-[0.2em] group-hover:text-[#A3E635] transition-all flex items-center gap-2 border-b-2 border-transparent group-hover:border-[#A3E635] pb-1">
                                LER MATÉRIA COMPLETA <ChevronRight size={16} className="group-hover:translate-x-2 transition-transform" />
                            </div>
                        </div>
                    </a>

                    {/* COLUNA DIREITA: Menor (33% / col-span-2) */}
                    <div className="lg:col-span-2 flex flex-col gap-0 h-full overflow-hidden">
                        {secondaryHighlights.map((item, idx) => (
                            <a
                                key={item.id || idx}
                                href={route('site.post.show', item.slug || '#')}
                                className="flex-1 relative group overflow-hidden cursor-pointer block shadow-sm hover:shadow-xl transition-all duration-500"
                            >
                                <img
                                    src={item.image_url}
                                    className="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-all duration-700 brightness-75 group-hover:brightness-50"
                                    alt={item.title}
                                />
                                <div className="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/50 to-transparent opacity-80 group-hover:opacity-95 transition-opacity"></div>
                                <div className="absolute inset-0 p-8 flex flex-col justify-end text-left z-10">
                                    <span className="text-[#A3E635] text-[10px] font-bold uppercase mb-2 block tracking-widest drop-shadow-md">
                                        {item.category?.name || "NOTÍCIA"}
                                    </span>
                                    <h3 className="text-white text-lg md:text-2xl font-bold uppercase leading-tight group-hover:text-[#A3E635] transition-colors drop-shadow-lg">
                                        {item.title}
                                    </h3>
                                    <div className="mt-4 flex items-center gap-2 text-white/80 text-[9px] font-bold tracking-[0.2em] opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                                        SAIBA MAIS <ArrowUpRight size={14} className="text-[#A3E635]" />
                                    </div>
                                </div>
                            </a>
                        ))}
                    </div>
                </div>
            </div>

            <QuickAccessSection />
        </section>
    );
};

export default AlternativeHeroSection;

import React, { useState, useEffect, useMemo } from 'react';
import { ChevronRight, ArrowUpRight, ChevronLeft } from 'lucide-react';
import { route } from 'ziggy-js';
import QuickAccessSection from '@/Components/Site/QuickAccessSection';

const HeroSection = ({ featured = [], banners = [] }) => {
    // Adapter for props to match the layout's expectations if necessary
    // or just use featured directly.
    const highlights = useMemo(() => featured.length > 0 ? featured : [], [featured]);

    const mainHighlight = highlights[0];
    const secondaryHighlights = useMemo(() => (banners && banners.length > 0) ? highlights.slice(0, 2) : highlights.slice(1, 3), [banners, highlights]);

    // Carousel State
    const [currentBanner, setCurrentBanner] = useState(0);
    const [isMobile, setIsMobile] = useState(false);

    useEffect(() => {
        const handleResize = () => setIsMobile(window.innerWidth < 1024);
        handleResize();
        window.addEventListener('resize', handleResize);
        return () => window.removeEventListener('resize', handleResize);
    }, []);

    const carouselItems = useMemo(() => {
        if (!isMobile) return banners || [];

        const newsItems = secondaryHighlights.map((item, idx) => ({
            id: item.id || `news-${idx}`,
            url: item.slug ? route('site.post.show', item.slug) : '#',
            image_url: item.image_url,
            title: item.title,
            description: item.category?.name || 'NOTÍCIA'
        }));

        return [...(banners || []), ...newsItems];
    }, [isMobile, banners, secondaryHighlights]);

    useEffect(() => {
        if (currentBanner >= carouselItems.length) {
            setCurrentBanner(0);
        }
    }, [carouselItems.length]);

    // Auto-play carousel
    useEffect(() => {
        if (carouselItems.length > 1) {
            const interval = setInterval(() => {
                setCurrentBanner((prev) => (prev >= carouselItems.length - 1 ? 0 : prev + 1));
            }, 5000);
            return () => clearInterval(interval);
        }
    }, [carouselItems.length]);

    const nextBanner = (e) => {
        if (e && e.preventDefault) e.preventDefault();
        setCurrentBanner((prev) => (prev >= carouselItems.length - 1 ? 0 : prev + 1));
    };

    const prevBanner = (e) => {
        if (e && e.preventDefault) e.preventDefault();
        setCurrentBanner((prev) => (prev === 0 ? carouselItems.length - 1 : prev - 1));
    };

    // Drag/Swipe Logic
    const [dragStart, setDragStart] = useState(null);

    const handleTouchStart = (e) => setDragStart(e.touches[0].clientX);
    const handleTouchEnd = (e) => {
        if (dragStart === null) return;
        const diff = dragStart - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 50) diff > 0 ? nextBanner() : prevBanner();
        setDragStart(null);
    };

    const handleMouseDown = (e) => setDragStart(e.clientX);
    const handleMouseUp = (e) => {
        if (dragStart === null) return;
        const diff = dragStart - e.clientX;
        if (Math.abs(diff) > 50) diff > 0 ? nextBanner() : prevBanner();
        setDragStart(null);
    };

    return (
        /* SEÇÃO NOTÍCIAS DESTAQUE (DESIGN CLEAN/COMPACTO) */
        <section className="relative overflow-hidden py-0 md:py-20 z-10 bg-gradient-to-b from-[#F5F9FF] to-gray-50">


            {/* Geometric Hollow Shapes (Side Decorations) */}
            <div className="absolute top-0 right-0 w-[600px] h-[600px] border-[4px] border-[#A3E635] rounded-full opacity-20 pointer-events-none translate-x-1/3 -translate-y-1/3"></div>
            <div className="absolute bottom-0 left-0 w-[500px] h-[500px] border-[4px] border-[#0052CC] rounded-[3rem] rotate-45 opacity-10 pointer-events-none -translate-x-1/3 translate-y-1/3"></div>

            <div className="max-w-7xl mx-auto px-0 lg:px-4 relative z-10">
                <div className="grid grid-cols-1 lg:grid-cols-6 gap-0 lg:h-[550px] items-stretch bg-gray-900 shadow-xl mx-0">

                    {/* COLUNA ESQUERDA: BANNERS ou NOTÍCIA DESTAQUE (66% / col-span-4) */}
                    <div
                        className="lg:col-span-4 relative overflow-hidden h-[250px] lg:h-full block group cursor-grab active:cursor-grabbing"
                        onTouchStart={handleTouchStart}
                        onTouchEnd={handleTouchEnd}
                        onMouseDown={handleMouseDown}
                        onMouseUp={handleMouseUp}
                        onMouseLeave={() => setDragStart(null)}
                    >
                        {carouselItems.length > 0 ? (
                            <div className="relative w-full h-full">
                                {carouselItems.map((banner, index) => (
                                    <div
                                        key={banner.id}
                                        className={`absolute inset-0 transition-opacity duration-1000 ease-in-out ${index === currentBanner ? 'opacity-100 z-10' : 'opacity-0 z-0'}`}
                                    >
                                        <a href={banner.url || '#'} className="block w-full h-full">
                                            <img
                                                src={banner.image_url}
                                                alt={banner.title}
                                                className="w-full h-full object-cover"
                                            />
                                            {/* Gradiente e Texto Opcional no Banner */}
                                            {/* Gradiente e Texto Opcional no Banner - Overlay Unificado */}
                                            <div className="absolute inset-0 bg-linear-to-t from-gray-900 via-gray-900/40 to-transparent opacity-80 z-10"></div>
                                            {(banner.title || banner.description) && (
                                                <div className="absolute bottom-0 left-0 px-6 pb-10 pt-6 md:p-12 z-20 w-full">
                                                    {banner.description && (
                                                        <span className="text-[#A3E635] font-bold uppercase tracking-widest text-[10px] md:text-xs mb-2 block">{banner.description}</span>
                                                    )}
                                                    {banner.title && (
                                                        <h2 className="text-white text-base md:text-4xl lg:text-5xl font-bold md:font-black uppercase tracking-tighter shadow-black drop-shadow-lg leading-tight md:leading-none">
                                                            {banner.title}
                                                        </h2>
                                                    )}
                                                </div>
                                            )}
                                        </a>
                                    </div>
                                ))}

                                {/* Controls */}
                                {carouselItems.length > 1 && (
                                    <>
                                        <button
                                            onClick={prevBanner}
                                            className="absolute left-2 md:left-4 top-1/2 -translate-y-1/2 z-30 w-12 h-12 md:w-16 md:h-16 flex items-center justify-center text-white/50 hover:text-white transition-all rounded-full bg-transparent"
                                        >
                                            <ChevronLeft size={32} strokeWidth={1.5} />
                                        </button>
                                        <button
                                            onClick={nextBanner}
                                            className="absolute right-2 md:right-4 top-1/2 -translate-y-1/2 z-30 w-12 h-12 md:w-16 md:h-16 flex items-center justify-center text-white/50 hover:text-white transition-all rounded-full bg-transparent"
                                        >
                                            <ChevronRight size={32} strokeWidth={1.5} />
                                        </button>

                                        {/* Indicators */}
                                        <div className="absolute bottom-6 right-6 z-30 flex gap-2">
                                            {carouselItems.map((_, idx) => (
                                                <button
                                                    key={idx}
                                                    onClick={() => setCurrentBanner(idx)}
                                                    className={`h-1.5 transition-all duration-300 rounded-full ${idx === currentBanner ? 'w-8 bg-[#A3E635]' : 'w-2 bg-white/50 hover:bg-white'}`}
                                                />
                                            ))}
                                        </div>
                                    </>
                                )}
                            </div>
                        ) : (
                            <a
                                href={route('site.post.show', mainHighlight.slug || '#')}
                                className="relative overflow-hidden group cursor-pointer h-full block shadow-sm hover:shadow-2xl transition-all duration-500"
                            >
                                <img
                                    src={mainHighlight.image_url}
                                    className="w-full h-full object-cover group-hover:scale-105 transition-all duration-1000 brightness-75 group-hover:brightness-50"
                                    alt={mainHighlight.title}
                                />
                                <div className="absolute inset-0 bg-linear-to-t from-gray-900 via-gray-900/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>

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
                        )}
                    </div>

                    {/* COLUNA DIREITA: Menor (33% / col-span-2) */}
                    <div className="hidden lg:flex lg:col-span-2 flex-col gap-0 h-[400px] lg:h-full overflow-hidden">
                        {secondaryHighlights.map((item, idx) => {
                            const dateObj = new Date(item.created_at);
                            const formatter = new Intl.DateTimeFormat('pt-BR', { day: '2-digit', month: 'short' });
                            const dateStr = !isNaN(dateObj) ? formatter.format(dateObj).toUpperCase().replace('.', '') : null;

                            return (
                                <a
                                    key={item.id || idx}
                                    href={route('site.post.show', item.slug || '#')}
                                    className="flex-1 relative group overflow-hidden cursor-pointer block shadow-sm hover:shadow-xl transition-all duration-500"
                                >
                                    <img
                                        src={item.image_url}
                                        className="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-all duration-700 brightness-75 group-hover:brightness-100"
                                        alt={item.title}
                                    />
                                    {/* Overlay gradiente lateral para separar da coluna principal sem escurecer tudo */}
                                    <div className="absolute inset-0 bg-gradient-to-r from-black/20 via-black/10 to-transparent group-hover:from-black/10 group-hover:via-black/5 transition-all duration-500"></div>
                                    <div className="absolute inset-0 bg-linear-to-t from-gray-900 via-gray-900/40 to-transparent opacity-80 group-hover:opacity-95 transition-opacity"></div>
                                    <div className="absolute inset-0 p-8 flex flex-col justify-end text-left z-10">
                                        <div className="flex items-center gap-2 text-[#A3E635] text-[10px] font-bold uppercase mb-2 tracking-widest drop-shadow-md">
                                            <span>{item.category?.name || "NOTÍCIA"}</span>
                                            {dateStr && (
                                                <>
                                                    <span className="text-gray-400 opacity-60">•</span>
                                                    <span className="text-gray-400 font-medium tracking-wider">{dateStr}</span>
                                                </>
                                            )}
                                        </div>
                                        <h3 className="text-white text-base uppercase font-bold leading-tight group-hover:text-[#A3E635] transition-colors drop-shadow-lg line-clamp-3">
                                            {item.title}
                                        </h3>
                                        <div className="mt-4 flex items-center gap-2 text-white/80 text-[9px] font-bold tracking-[0.2em] opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                                            SAIBA MAIS <ArrowUpRight size={14} className="text-[#A3E635]" />
                                        </div>
                                    </div>
                                </a>
                            );
                        })}
                    </div>
                </div>
            </div>

            <QuickAccessSection />
        </section>
    );
};

export default HeroSection;

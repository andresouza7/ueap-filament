import React, { useState, useRef } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import RelatedPosts from '@/Components/Site/RelatedPosts';
import { Calendar, Eye, Share2, Hash, Sparkles, Loader2, ChevronRight, ChevronLeft, Clock } from 'lucide-react';
import { route } from 'ziggy-js';

// --- CONFIGURAÇÃO E UTILITÁRIO GEMINI API ---
const apiKey = import.meta.env.VITE_GEMINI_API_KEY || "";

async function callGemini(prompt, systemInstruction = "") {
    if (!apiKey) {
        console.warn("Gemini API Key missing");
        return "Erro de configuração: Chave de API não encontrada.";
    }

    const url = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-preview-09-2025:generateContent?key=${apiKey}`;

    const payload = {
        contents: [{ parts: [{ text: prompt }] }],
        systemInstruction: systemInstruction ? { parts: [{ text: systemInstruction }] } : undefined
    };

    const maxRetries = 1;
    let delay = 1000;

    for (let i = 0; i < maxRetries; i++) {
        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });

            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

            const result = await response.json();
            return result.candidates?.[0]?.content?.parts?.[0]?.text || "Desculpe, não consegui processar sua solicitação.";
        } catch (error) {
            console.error(error);
            if (i === maxRetries - 1) throw error;
            await new Promise(resolve => setTimeout(resolve, delay));
            delay *= 2;
        }
    }
}

// --- COMPONENTES DO RENDERIZADOR DE BLOCOS ---

// 1. Text Block
const TextBlock = ({ data }) => (
    <div
        className="prose-custom text-lg leading-relaxed font-medium mb-6 space-y-6 text-[#002855]"
        dangerouslySetInnerHTML={{ __html: data.body || '' }}
    />
);

// 2. Quote Block
const QuoteBlock = ({ data }) => (
    <div className="my-10 relative">
        <div className="absolute -top-4 -left-2 text-[#A3E635] text-7xl font-serif opacity-50">“</div>
        <blockquote className="bg-white border-l-[12px] border-[#0052CC] rounded-r-3xl p-8 shadow-md">
            <p className="text-[#002855] text-2xl font-black italic leading-tight">
                {data.text}
            </p>
        </blockquote>
    </div>
);

// 3. Gallery/Image Block
const GalleryBlock = ({ data }) => {
    const images = Array.isArray(data.images) ? data.images : (data.path ? [data.path] : []); // Normalize images
    const [active, setActive] = useState(0);
    const sliderRef = useRef(null);

    const scrollTo = (index) => {
        if (sliderRef.current) {
            setActive(index);
            sliderRef.current.scrollTo({
                left: sliderRef.current.clientWidth * index,
                behavior: 'smooth'
            });
        }
    };

    if (!images.length) return null;

    return (
        <figure className="w-full flex flex-col my-8">
            <div className="relative overflow-hidden aspect-video bg-white rounded-[2rem] border-[6px] border-[#A3E635] shadow-xl group">
                {/* Scrollable Container */}
                <div
                    ref={sliderRef}
                    className="flex h-full overflow-x-auto snap-x snap-mandatory scrollbar-hide scroll-smooth"
                    onScroll={(e) => {
                        const index = Math.round(e.target.scrollLeft / e.target.clientWidth);
                        if (index !== active) setActive(index);
                    }}
                >
                    {images.map((src, idx) => (
                        <div key={idx} className="snap-center shrink-0 w-full h-full overflow-hidden">
                            <img
                                src={src}
                                alt={`Imagem ${idx + 1}`}
                                className="w-full h-full object-cover transition-transform duration-700 hover:scale-105"
                            />
                        </div>
                    ))}
                </div>

                {/* Controls (if > 1 image) */}
                {images.length > 1 && (
                    <>
                        <div className="absolute inset-0 flex items-center justify-between px-4 pointer-events-none">
                            <button
                                onClick={() => scrollTo(active === 0 ? images.length - 1 : active - 1)}
                                className="pointer-events-auto bg-[#0052CC] text-white p-2 rounded-full hover:bg-black transition-colors shadow-lg"
                            >
                                <ChevronLeft size={24} />
                            </button>
                            <button
                                onClick={() => scrollTo(active === images.length - 1 ? 0 : active + 1)}
                                className="pointer-events-auto bg-[#0052CC] text-white p-2 rounded-full hover:bg-black transition-colors shadow-lg"
                            >
                                <ChevronRight size={24} />
                            </button>
                        </div>

                        {/* Dots */}
                        <div className="absolute bottom-4 left-0 w-full flex justify-center gap-2">
                            {images.map((_, idx) => (
                                <button
                                    key={idx}
                                    onClick={() => scrollTo(idx)}
                                    className={`h-2 rounded-full transition-all duration-300 ${active === idx ? 'w-8 bg-[#A3E635]' : 'w-2 bg-white/60'}`}
                                />
                            ))}
                        </div>
                    </>
                )}
            </div>

            {/* Caption / Credits */}
            {(data.subtitle || data.credits) && (
                <figcaption className="mt-4 px-2 flex flex-col gap-1">
                    <div className="flex items-center gap-2">
                        <div className="h-4 w-1 bg-[#0052CC]"></div>
                        <span className="text-[#002855] font-black uppercase text-sm tracking-widest">
                            {data.subtitle || 'Galeria UEAP'}
                        </span>
                    </div>
                    {data.credits && (
                        <span className="text-xs font-bold text-gray-500 uppercase ml-3">
                            Foto: {data.credits}
                        </span>
                    )}
                </figcaption>
            )}
        </figure>
    );
};

const PostBlockRenderer = ({ blocks }) => {
    if (!Array.isArray(blocks) || blocks.length === 0) return null;

    return (
        <div className="space-y-8">
            {blocks.map((block, idx) => {
                switch (block.type) {
                    case 'text':
                        return <TextBlock key={idx} data={block.data} />;
                    case 'quote':
                        return <QuoteBlock key={idx} data={block.data} />;
                    case 'image':
                    case 'gallery':
                        return <GalleryBlock key={idx} data={block.data} />;
                    default:
                        console.warn(`Unknown block type: ${block.type}`);
                        return null;
                }
            })}
        </div>
    );
};

const PostShow = ({ post, latestPosts, relatedPosts, categories }) => {
    const [summary, setSummary] = useState('');
    const [loadingSummary, setLoadingSummary] = useState(false);

    // Helper para formatar datas (PT-BR)
    const formatDate = (dateString, includeTime = false) => {
        if (!dateString) return null;
        const date = new Date(dateString);
        if (isNaN(date.getTime())) return dateString; // Fallback se não for data válida

        const options = { day: 'numeric', month: 'long', year: 'numeric' };
        if (includeTime) {
            options.hour = '2-digit';
            options.minute = '2-digit';
        }
        return date.toLocaleDateString('pt-BR', options);
    };

    const newsData = {
        title: post?.title,
        category: post?.category?.name,
        image: post?.image_url,
        date: formatDate(post?.published_at || post?.created_at),
        views: post?.hits ? `${post.hits} Acessos` : null
    };

    const recentNews = latestPosts?.map(p => ({
        id: p.id,
        title: p.title,
        image_url: p.image_url,
        date: formatDate(p.created_at),
        slug: p.slug
    })) || [];

    // Determine content to render
    let contentToRender = [];
    if (post?.content) {
        if (Array.isArray(post.content)) {
            contentToRender = post.content;
        } else if (typeof post.content === 'string') {
            try {
                const parsed = JSON.parse(post.content);
                if (Array.isArray(parsed)) contentToRender = parsed;
                else contentToRender = [{ type: 'text', data: { body: post.content } }];
            } catch (e) {
                contentToRender = [{ type: 'text', data: { body: post.content } }];
            }
        }
    }

    const generateAISummary = async () => {
        if (loadingSummary) return;
        setLoadingSummary(true);
        try {
            const prompt = `Resuma em 3 pontos curtos e objetivos a notícia: ${newsData.title}. O conteúdo é institucional e acadêmico.`;
            const res = await callGemini(prompt, "Você é um assistente da universidade que sintetiza notícias para acadêmicos.");
            setSummary(res);
        } catch (err) {
            setSummary("Erro ao gerar resumo.");
        } finally {
            setLoadingSummary(false);
        }
    };

    const headerContent = (
        <div className="animate-fade-in-up bg-white border-b border-gray-100 w-full">
            <div className="max-w-7xl mx-auto px-4 py-8 md:py-12">
                {/* Breadcrumb */}
                <nav className="flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-8">
                    <a href={route('site.home')} className="hover:text-[#0052CC] transition-colors">Início</a>
                    <span className="text-gray-300">/</span>
                    <span className="text-[#0052CC]">{newsData.category}</span>
                </nav>

                <div className="flex flex-wrap justify-between items-center gap-4 mb-4">
                    <span className="inline-block px-3 py-1 bg-[#A3E635] text-[#0052CC] text-[10px] font-black uppercase rounded-none tracking-[0.2em]">
                        {newsData.category}
                    </span>
                    <button onClick={generateAISummary} className="flex items-center gap-2 px-4 py-1.5 bg-[#0052CC] text-white text-[10px] font-bold uppercase rounded-none shadow-lg hover:bg-[#A3E635] hover:text-[#0052CC] transition-all">
                        {loadingSummary ? <Loader2 size={14} className="animate-spin" /> : <Sparkles size={14} />} {summary ? "✨ Atualizado" : "✨ Resumo IA"}
                    </button>
                </div>

                <h1 className="text-2xl md:text-5xl font-black text-[#0052CC] mb-6 leading-[1.1] uppercase tracking-tighter max-w-4xl group-hover:text-[#003D99] transition-colors">
                    {newsData.title}
                </h1>

                <div className="flex flex-wrap items-center gap-8 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                    <div className="flex items-center gap-2 border-r border-gray-200 pr-8 last:border-0"><Calendar size={14} className="text-[#A3E635]" /> {newsData.date}</div>
                    <div className="flex items-center gap-2 border-r border-gray-200 pr-8 last:border-0"><Eye size={14} className="text-[#A3E635]" /> {newsData.views}</div>
                    <button className="ml-auto flex items-center gap-2 text-[#0052CC] hover:text-[#A3E635] transition-colors"><Share2 size={14} /> Compartilhar</button>
                </div>
            </div>
        </div>
    );

    return (
        <SidebarLayout
            recentNews={recentNews}
            menu={post?.menu}
            header={headerContent}
            bottom={<RelatedPosts posts={relatedPosts} />}
        >
            {summary && (
                <div className="mb-12 bg-gray-50 border-l-4 border-[#A3E635] p-8 rounded-none animate-in fade-in slide-in-from-left-4">
                    <div className="flex items-center gap-2 mb-4 text-[#0052CC] font-black text-xs uppercase tracking-widest"><Sparkles size={18} className="text-[#A3E635]" /> Resumo Inteligente por IA</div>
                    <div className="text-sm text-gray-600 leading-relaxed font-medium italic prose prose-sm max-w-none whitespace-pre-line">{summary}</div>
                </div>
            )}

            <article className="article-body">
                <PostBlockRenderer blocks={contentToRender} />
            </article>

            {post?.updated_at && (
                <div className="mt-8 flex items-center justify-end text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                    <div className="flex items-center gap-2">
                        <Clock size={12} className="text-[#A3E635]" />
                        Atualizado em: {formatDate(post.updated_at, true)}
                    </div>
                </div>
            )}
        </SidebarLayout>
    );
};

export default PostShow;
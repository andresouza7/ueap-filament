import React, { useState } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import RelatedPosts from '@/Components/Site/RelatedPosts';
import PostBlockRenderer from '@/Components/Site/Blocks/PostBlockRenderer';
import { callGemini } from '@/Services/GeminiService';
import { Calendar, Eye, Share2, Sparkles, Loader2, Clock, ChevronRight, Bookmark } from 'lucide-react';
import { route } from 'ziggy-js';

const PostShow = ({ post, latestPosts, relatedPosts, categories }) => {
    const [summary, setSummary] = useState('');
    const [loadingSummary, setLoadingSummary] = useState(false);

    // Helper para formatar datas (PT-BR)
    const formatDate = (dateString, includeTime = false) => {
        if (!dateString) return null;
        const date = new Date(dateString);
        if (isNaN(date.getTime())) return dateString; // Fallback se não for data válida

        const options = { day: 'numeric', month: 'short', year: 'numeric' };
        if (includeTime) {
            options.hour = '2-digit';
            options.minute = '2-digit';
        }
        return date.toLocaleDateString('pt-BR', options);
    };

    // Helper para formatar números (1000+ = 1k)
    const formatNumber = (num) => {
        if (!num) return 0;
        if (num >= 1000) {
            return (num / 1000).toFixed(1).replace(/\.0$/, '') + 'k';
        }
        return num;
    };

    const newsData = {
        title: post?.title,
        category: post?.category?.name,
        categorySlug: post?.category?.slug,
        image: post?.image_url,
        date: formatDate(post?.published_at || post?.created_at),
        views: post?.hits ? `${formatNumber(post.hits)} Leituras` : null
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
    const handleShare = async () => {
        if (navigator.share) {
            try {
                await navigator.share({
                    title: newsData.title,
                    text: newsData.category,
                    url: window.location.href,
                });
            } catch (error) {
                console.log('Error sharing', error);
            }
        } else {
            navigator.clipboard.writeText(window.location.href);
            alert('Link copiado para a área de transferência!');
        }
    };

    const headerContent = (
        <div className="relative overflow-hidden bg-gray-50 border-b border-gray-200">

            <div className="max-w-7xl mx-auto px-4 py-8 md:py-16 relative z-10">
                {/* Breadcrumb refinado e mais próximo do título */}
                <nav className="flex items-center gap-2 text-[11px] font-bold uppercase tracking-[0.15em] text-gray-400 mb-6">
                    <a href="#" className="hover:text-[#0052CC] transition-colors">Início</a>
                    <ChevronRight size={10} className="text-gray-300" />
                    <span className="text-gray-900">{newsData.category}</span>
                </nav>

                <div className="flex flex-wrap justify-between items-end gap-6 mb-6">
                    <div className="space-y-4 flex-1 min-w-[300px]">
                        <a
                            href={route('site.post.list', { category: newsData.categorySlug })}
                            className="inline-flex items-center px-3 py-1 bg-[#0052CC] text-white text-[10px] font-black uppercase tracking-[0.2em] hover:bg-[#A3E635] hover:text-[#0052CC] transition-colors"
                        >
                            {newsData.category}
                        </a>
                        {/* Fonte do título reduzida e espaçamento entre linhas ajustado */}
                        <h1 className="text-3xl md:text-4xl font-black text-gray-900 leading-[1.05] tracking-tighter uppercase break-words max-w-4xl">
                            {newsData.title}
                        </h1>
                    </div>

                    {/* <button
                        onClick={() => generateAISummary()}
                        className="group relative flex items-center gap-3 px-5 py-2.5 bg-white border-2 border-[#0052CC] text-[#0052CC] text-[10px] font-black uppercase tracking-widest hover:bg-[#0052CC] hover:text-white transition-all duration-300 shadow-[3px_3px_0px_0px_#A3E635] hover:shadow-none hover:translate-x-[1px] hover:translate-y-[1px]"
                    >
                        {loadingSummary ? (
                            <Loader2 size={14} className="animate-spin" />
                        ) : (
                            <Sparkles size={14} className="group-hover:animate-pulse" />
                        )}
                        {summary ? "Resumo Atualizado" : "Resumo IA"}
                    </button> */}
                </div>

                {/* Meta Info mais compacto */}
                <div className="flex flex-wrap items-center gap-4 md:gap-10 pt-6 border-t border-gray-900/10 text-[10px] font-bold text-gray-500 uppercase tracking-widest">
                    <div className="flex items-center gap-2.5">
                        <div className="w-7 h-7 rounded-full bg-gray-100 flex items-center justify-center">
                            <Calendar size={12} className="text-[#0052CC]" />
                        </div>
                        <span>{newsData.date}</span>
                    </div>
                    <div className="flex items-center gap-2.5">
                        <div className="w-7 h-7 rounded-full bg-gray-100 flex items-center justify-center">
                            <Eye size={12} className="text-[#0052CC]" />
                        </div>
                        <span>{newsData.views}</span>
                    </div>
                    <div className="mx-auto md:mx-0 md:ml-auto flex items-center gap-3 mt-6 md:mt-0">
                        <span className="hidden sm:block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Compartilhar</span>
                        <div className="flex items-center gap-5 md:gap-3">
                            <a
                                href={`https://api.whatsapp.com/send?text=${encodeURIComponent(newsData.title + ' - ' + window.location.href)}`}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-[#25D366] hover:text-white transition-all duration-300"
                                title="WhatsApp"
                            >
                                <i className="fa-brands fa-whatsapp text-sm" />
                            </a>
                            <a
                                href={`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.href)}`}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-[#1877F2] hover:text-white transition-all duration-300"
                                title="Facebook"
                            >
                                <i className="fa-brands fa-facebook-f text-sm" />
                            </a>
                            <button
                                onClick={handleShare}
                                className="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-[#0052CC] hover:text-white transition-all duration-300 cursor-pointer"
                                title="Mais opções de compartilhamento"
                            >
                                <i className="fa-solid fa-share-nodes text-sm" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );



    return (
        <SidebarLayout
            recentNews={recentNews}
            categories={categories}
            menu={post?.web_menu}
            header={headerContent}
            bottom={<RelatedPosts posts={relatedPosts} />}
        >
            {/* ... (rest of the component) */}

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
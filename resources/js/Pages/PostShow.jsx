import React, { useState } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import RelatedPosts from '@/Components/Site/RelatedPosts';
import PostBlockRenderer from '@/Components/Site/Blocks/PostBlockRenderer';
import { callGemini } from '@/Services/GeminiService';
import { Calendar, Eye, Share2, Sparkles, Loader2, Clock } from 'lucide-react';
import { route } from 'ziggy-js';

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
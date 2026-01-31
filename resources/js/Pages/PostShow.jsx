import React, { useState } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import { Calendar, Eye, Share2, Hash, Sparkles, Loader2 } from 'lucide-react';
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

const PostShow = ({ post, latestPosts, relatedPosts, categories }) => {
    const [summary, setSummary] = useState('');
    const [loadingSummary, setLoadingSummary] = useState(false);

    const newsData = {
        title: post?.title || "PS UEAP 2025: CHAMADA OFICIAL DO RESULTADO PRELIMINAR",
        category: post?.category?.name || "PROCESSO SELETIVO",
        image: post?.image_url || "https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80&w=1200",
        date: "12/01/2026",
        views: "1.248 Acessos"
    };

    const recentNews = latestPosts?.map(p => ({
        id: p.id,
        title: p.title,
        image_url: p.image_url || "https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&q=80&w=400",
        date: p.created_at || "Recente",
        slug: p.slug
    })) || [];

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
        <div className="animate-fade-in-up">
            <div className="flex flex-wrap justify-between items-center gap-4 mb-6">
                <span className="inline-block px-3 py-1 bg-[#A3E635] text-[#0052CC] text-[10px] font-black uppercase rounded-none tracking-[0.2em]">
                    {newsData.category}
                </span>
                <button onClick={generateAISummary} className="flex items-center gap-2 px-4 py-1.5 bg-[#0052CC] text-white text-[10px] font-bold uppercase rounded-none shadow-lg hover:bg-[#A3E635] hover:text-[#0052CC] transition-all">
                    {loadingSummary ? <Loader2 size={14} className="animate-spin" /> : <Sparkles size={14} />} {summary ? "✨ Atualizado" : "✨ Resumo IA"}
                </button>
            </div>

            <h1 className="text-3xl md:text-6xl font-black text-[#0052CC] mb-10 leading-[1.1] uppercase tracking-tighter max-w-5xl group-hover:text-[#003D99] transition-colors">
                {newsData.title}
            </h1>

            <div className="flex flex-wrap items-center gap-8 text-[10px] font-bold text-gray-400 uppercase tracking-widest pb-8 border-b border-gray-100">
                <div className="flex items-center gap-2 border-r border-gray-200 pr-8 last:border-0"><Calendar size={14} className="text-[#A3E635]" /> {newsData.date}</div>
                <div className="flex items-center gap-2 border-r border-gray-200 pr-8 last:border-0"><Eye size={14} className="text-[#A3E635]" /> {newsData.views}</div>
                <button className="ml-auto flex items-center gap-2 text-[#0052CC] hover:text-[#A3E635] transition-colors"><Share2 size={14} /> Compartilhar</button>
            </div>
        </div>
    );

    return (
        <SidebarLayout recentNews={recentNews} menu={post?.menu} header={headerContent}>
            {summary && (
                <div className="mb-12 bg-gray-50 border-l-4 border-[#A3E635] p-8 rounded-none animate-in fade-in slide-in-from-left-4">
                    <div className="flex items-center gap-2 mb-4 text-[#0052CC] font-black text-xs uppercase tracking-widest"><Sparkles size={18} className="text-[#A3E635]" /> Resumo Inteligente por IA</div>
                    <div className="text-sm text-gray-600 leading-relaxed font-medium italic prose prose-sm max-w-none whitespace-pre-line">{summary}</div>
                </div>
            )}

            <div className="mb-12 aspect-video overflow-hidden rounded-none shadow-2xl border border-gray-100">
                <img src={newsData.image} alt="Destaque" className="w-full h-full object-cover" />
            </div>

            <article className="prose max-w-none text-gray-600 leading-relaxed space-y-10">
                <div dangerouslySetInnerHTML={{
                    __html: post?.content || `
                    <p class="text-xl font-bold text-gray-800 first-letter:text-7xl first-letter:font-black first-letter:text-[#0052CC] first-letter:mr-4 first-letter:float-left uppercase tracking-tight">
                        A Universidade do Estado do Amapá (UEAP) continua sua trajetória de expansão e excelência acadêmica. Este novo marco representa o compromisso renovado com a formação de profissionais qualificados.
                    </p>
                    <p className="font-medium">
                        Os investimentos em laboratórios têm permitido que alunos de diversos cursos tenham acesso a equipamentos que são referência nacional. A universidade reforça seu papel como motor do desenvolvimento regional no Amapá através da pesquisa aplicada e da extensão comunitária.
                    </p>
                    <div class="p-8 bg-gray-50 border-r-8 border-[#A3E635] my-12">
                        <p class="text-lg italic font-bold text-[#0052CC]">"Nossa missão é transformar a realidade do Amapá através do conhecimento técnico e científico de alto nível."</p>
                    </div>`
                }} />
            </article>

            <div className="mt-16 pt-8 border-t border-gray-100 flex items-center gap-4">
                <Hash size={18} className="text-gray-300" />
                <div className="flex gap-2">
                    {['ENSINO', 'PESQUISA', 'EXTENSÃO'].map(t => (
                        <span key={t} className="text-[10px] font-bold text-gray-400 bg-gray-50 px-3 py-1 hover:text-[#0052CC] cursor-pointer transition-colors uppercase">{t}</span>
                    ))}
                </div>
            </div>
        </SidebarLayout>
    );
};

export default PostShow;
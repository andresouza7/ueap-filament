import React from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import { Calendar, Clock, Share2, Hash } from 'lucide-react';

const PostShow = ({ post, latestPosts, relatedPosts, categories }) => {
    // Adapter to match expected props if necessary, or pass directly
    // Using props passed from controller: latestPosts (similar to recentNews)

    // Mock data if props are missing/incomplete for now to match UI design from before
    const newsData = {
        title: post?.title || "PS UEAP 2025: CHAMADA OFICIAL DO RESULTADO PRELIMINAR",
        category: post?.category?.name || "PROCESSO SELETIVO",
        image_url: post?.image_url || "https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80&w=1200",
        date: "12/01/2026",
        updated: "há 2 horas"
    };

    // Use latestPosts for recentNews in sidebar
    const recentNews = latestPosts?.map(p => ({
        id: p.id,
        title: p.title,
        image_url: p.image_url || "https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&q=80&w=400",
        date: p.created_at || "Recente",
        slug: p.slug
    })) || [
            // Fallback mock if empty
            {
                id: 1,
                title: "O bacharelado em Direito da Ueap é o curso mais recente da universidade",
                image_url: "https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&q=80&w=400",
                date: "12 HORAS ATRÁS"
            },
            {
                id: 2,
                title: "Laboratório de Química Analítica recebe novos equipamentos de ponta",
                image_url: "https://images.unsplash.com/photo-1532187875605-2fe358a71424?auto=format&fit=crop&q=80&w=400",
                date: "1 DIA ATRÁS"
            },
            {
                id: 3,
                title: "Exposição celebra a diversidade no Campus Macapá",
                image_url: "https://images.unsplash.com/photo-1541913057-07409062fc62?auto=format&fit=crop&q=80&w=400",
                date: "2 DIAS ATRÁS"
            }
        ];

    return (
        <SidebarLayout recentNews={recentNews} menu={post?.menu}>
            {/* Header da Notícia */}
            <div className="mb-8">
                <span className="inline-block px-3 py-1 bg-[#A3E635] text-[#0052CC] text-[10px] font-bold uppercase tracking-widest mb-4">
                    {newsData.category}
                </span>
                <h1 className="text-3xl md:text-5xl font-bold text-[#0052CC] mb-6 leading-tight uppercase tracking-tighter">
                    {newsData.title}
                </h1>

                <div className="flex flex-wrap items-center gap-6 py-6 border-y border-gray-100 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                    <div className="flex items-center gap-2"><Calendar size={14} className="text-[#A3E635]" /> Publicado em {newsData.date}</div>
                    <div className="flex items-center gap-2"><Clock size={14} className="text-[#A3E635]" /> Atualizado {newsData.updated}</div>
                    <button className="ml-auto flex items-center gap-2 text-[#0052CC] hover:text-[#A3E635] transition-colors">
                        <Share2 size={14} /> Compartilhar
                    </button>
                </div>
            </div>

            {/* Imagem de Destaque */}
            <div className="mb-10 aspect-video overflow-hidden shadow-2xl">
                <img src={newsData.image_url} alt="Destaque" className="w-full h-full object-cover" />
            </div>

            {/* Corpo da Notícia (Alternando Texto e Imagem) */}
            <article className="prose max-w-none text-gray-600 leading-relaxed space-y-8">
                {/* 
                   Here we would ideally parse the HTML content from post.content 
                   For now using static content as requested by user ("com o codigo utilizado nessa pagina") 
                   but adaptable to dynamic content 
                */}
                <div dangerouslySetInnerHTML={{
                    __html: post?.content || `
                    <p class="text-lg font-medium text-gray-800 first-letter:text-5xl first-letter:font-bold first-letter:text-[#0052CC] first-letter:mr-3 first-letter:float-left">
                        A Universidade do Estado do Amapá (UEAP) continua sua trajetória de expansão e excelência acadêmica. Este novo marco representa não apenas um avanço tecnológico, mas também um compromisso renovado com a formação de profissionais qualificados para o mercado local e regional.
                    </p>
                    <p>
                        Os investimentos realizados em infraestrutura e laboratórios têm permitido que alunos de diversos cursos, especialmente os de áreas tecnológicas e biológicas, tenham acesso a equipamentos que são referência nacional. A integração entre teoria e prática é o pilar fundamental do nosso método de ensino.
                    </p>
                    <div class="my-12">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center bg-gray-50 p-6 md:p-10 border-r-8 border-[#A3E635]">
                            <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&q=80&w=600" class="w-full h-auto shadow-lg" alt="Laboratório" />
                            <div>
                                <h4 class="text-lg font-bold text-[#0052CC] uppercase mb-4 tracking-tighter">Inovação no Campus</h4>
                                <p class="text-sm italic">"Nosso objetivo é transformar o Amapá em um polo de desenvolvimento científico, utilizando a biodiversidade amazônica como nossa maior aliada."</p>
                                <p class="text-xs font-bold mt-4 uppercase text-[#A3E635]">— Pró-reitoria de Pesquisa</p>
                            </div>
                        </div>
                    </div>
                `}} />
            </article>

            {/* Tags de Fim de Post */}
            <div className="mt-16 pt-8 border-t border-gray-100 flex items-center gap-4">
                <Hash size={18} className="text-gray-300" />
                <div className="flex gap-2">
                    {categories?.map(c => c.name) || ['EDUCAÇÃO', 'AMAZÔNIA', 'PESQUISA'].map(t => (
                        <span key={t} className="text-[10px] font-bold text-gray-400 bg-gray-50 px-3 py-1 hover:text-[#0052CC] cursor-pointer transition-colors">{t}</span>
                    ))}
                </div>
            </div>
        </SidebarLayout>
    );
};

export default PostShow;
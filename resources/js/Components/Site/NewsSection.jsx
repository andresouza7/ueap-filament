import React from 'react';
import { Mail, Send } from 'lucide-react';
import { route } from 'ziggy-js';
import NewsletterForm from './NewsletterForm';

const NewsSection = ({ posts = [] }) => {
    // Garantindo que temos 4 itens para o exemplo de layout
    const displayPosts = posts.slice(0, 4);

    return (
        <section className="max-w-7xl mx-auto px-6 py-12 md:py-20">
            {/* Header Section */}
            <div className="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
                <div className="border-l-4 border-ueap-primary pl-4 md:pl-5">
                    <h2 className="text-2xl md:text-4xl font-extrabold text-ueap-primary tracking-tighter uppercase leading-none">
                        Notícias <span className="font-light text-contrast-body">Recentes</span>
                    </h2>
                    <p className="block text-contrast-muted font-bold text-[9px] md:text-xs mt-2 tracking-[0.2em] uppercase">
                        Comunicados e Atualizações Oficiais
                    </p>
                </div>

                <a
                    href={route('site.post.list', { type: 'news' })}
                    className="w-full md:w-auto text-center group text-ueap-primary font-bold uppercase text-[11px] tracking-widest flex items-center justify-center gap-2 border-2 border-ueap-primary px-6 py-3 hover:bg-ueap-primary hover:text-ueap-secondary transition-all duration-300"
                >
                    Ver acervo completo
                </a>
            </div>

            {/* Grid de Notícias - Agora com 4 colunas em lg: */}
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                {displayPosts.map((news) => (
                    <a href={route('site.post.show', news.slug)} key={news.id} className="group cursor-pointer block">
                        <div className="relative aspect-video md:aspect-[4/3] overflow-hidden mb-5 bg-gray-100 rounded-sm">
                            <img
                                src={news.image_url || "https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&q=80&w=400"}
                                className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                alt={news.title}
                            />
                            <div className="absolute top-0 right-0 bg-ueap-accent text-ueap-primary px-2 py-1 font-black text-[9px] uppercase tracking-tighter shadow-md">
                                {news.category?.name || "GERAL"}
                            </div>
                        </div>

                        <div className="flex items-center gap-2 mb-3">
                            <span className="w-6 h-[2px] bg-ueap-accent group-hover:w-10 transition-all duration-300"></span>
                            <p className="text-[10px] text-contrast-muted font-bold tracking-widest uppercase">
                                {new Date(news.created_at).toLocaleDateString('pt-BR')}
                            </p>
                        </div>

                        {/* Tipografia do Título Melhorada */}
                        <h4 className="text-base md:text-lg font-medium text-contrast-primary group-hover:text-ueap-primary transition-colors leading-[1.2] tracking-tight">
                            {news.title}
                        </h4>
                    </a>
                ))}
            </div>

            <div className="mt-12 md:mt-20 p-8 md:p-12 bg-ueap-primary relative overflow-hidden shadow-2xl rounded-sm flex flex-col md:flex-row items-center justify-between gap-8">
                {/* Decorative Element */}
                <div className="absolute top-0 right-0 w-32 h-32 bg-white/5 rotate-45 transform translate-x-16 -translate-y-16 pointer-events-none"></div>

                <div className="max-w-md text-center md:text-left relative z-10">
                    <div className="flex items-center justify-center md:justify-start gap-4 mb-2 text-ueap-secondary">
                        <Mail size={32} />
                        <h3 className="text-3xl font-bold uppercase tracking-tighter">Fique por dentro</h3>
                    </div>
                    <p className="text-ueap-secondary/80 text-sm font-medium tracking-wide">Assine nossa newsletter e receba semanalmente as últimas notícias diretamente no seu e-mail.</p>
                </div>

                <NewsletterForm variant="default" />

            </div>
        </section>
    );
};

export default NewsSection;
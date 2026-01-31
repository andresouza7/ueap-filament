import React from 'react';
import { Mail, Send } from 'lucide-react';
import { route } from 'ziggy-js';

const NewsSection = ({ posts = [] }) => {
    return (
        <section className="max-w-7xl mx-auto px-4 py-20">
            <div className="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                <div className="border-l-4 border-[#0052CC] pl-6">
                    <h2 className="text-3xl font-bold text-[#0052CC] uppercase tracking-tighter">Notícias Recentes</h2>
                    <p className="text-gray-400 font-bold text-[10px] mt-1 tracking-[0.2em] uppercase">Comunicados e Atualizações</p>
                </div>
                <a href={route('site.post.list')} className="text-[#0052CC] font-bold uppercase text-xs tracking-widest flex items-center gap-2 group relative pb-1">
                    Ver todas notícias
                    <span className="absolute bottom-0 left-0 w-full h-[2px] bg-[#A3E635] transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></span>
                </a>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-3 gap-10">
                {posts.map((news) => (
                    <a href={route('site.post.show', news.slug)} key={news.id} className="group cursor-pointer block">
                        <div className="relative aspect-16/10 overflow-hidden mb-6 bg-gray-100 rounded-sm">
                            <img
                                src={news.image_url || "https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&q=80&w=400"}
                                className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                alt={news.title}
                            />
                            <div className="absolute top-0 right-0 bg-[#A3E635] text-[#0052CC] px-3 py-1 font-bold text-[9px] uppercase tracking-widest shadow-sm">
                                {news.category?.name || "GERAL"}
                            </div>
                        </div>
                        <p className="text-[9px] text-gray-400 font-bold mb-2 tracking-widest uppercase">{new Date(news.created_at).toLocaleDateString()}</p>
                        <h4 className="text-lg font-bold text-gray-800 group-hover:text-[#0052CC] transition-colors leading-tight">
                            {news.title}
                        </h4>
                    </a>
                ))}
            </div>

            {/* NEWSLETTER BOX */}
            <div className="mt-20 p-8 md:p-12 bg-gray-50 border-t-4 border-[#0052CC] flex flex-col md:flex-row items-center justify-between gap-8 rounded-sm shadow-sm">
                <div className="max-w-md text-center md:text-left">
                    <div className="flex items-center justify-center md:justify-start gap-3 mb-2 text-[#0052CC]">
                        <Mail size={24} />
                        <h3 className="text-2xl font-bold uppercase tracking-tighter">Fique por dentro</h3>
                    </div>
                    <p className="text-gray-500 text-sm font-medium">Assine nossa newsletter e receba as últimas notícias e editais diretamente no seu e-mail institucional ou pessoal.</p>
                </div>
                <div className="flex w-full md:w-auto gap-2">
                    <input
                        type="email"
                        placeholder="seu-email@exemplo.com"
                        className="flex-1 md:w-80 px-4 py-3 border border-gray-200 focus:outline-none focus:border-[#0052CC] text-sm font-medium transition-colors"
                    />
                    <button className="bg-[#0052CC] text-white px-6 py-3 font-bold text-[10px] uppercase tracking-widest hover:bg-[#A3E635] hover:text-[#0052CC] transition-all shadow-md flex items-center gap-2 group">
                        Inscrever <Send size={14} className="group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform" />
                    </button>
                </div>
            </div>
        </section>
    );
};

export default NewsSection;

import React from 'react';
import { Calendar, Info, FileText, MessageSquare, ChevronRight, Instagram, Youtube } from 'lucide-react';
import { route } from 'ziggy-js';

const EventsSection = ({ events = [] }) => {
    return (
        <section className="max-w-7xl mx-auto px-4 py-24">
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-24">

                {/* Coluna de Eventos */}
                <div>
                    <div className="flex items-center gap-4 mb-14">
                        <Calendar className="text-[#0052CC]" size={32} />
                        <h3 className="text-3xl font-bold text-[#0052CC] uppercase tracking-tighter">Eventos & Ações</h3>
                    </div>
                    <div className="space-y-12">
                        {events.map((event, i) => (
                            <a href={route('site.post.show', event.slug)} key={event.id || i} className="flex flex-col sm:flex-row gap-8 group cursor-pointer border-b border-gray-100 pb-10 last:border-0">
                                {event.image_url ? (
                                    <div className="w-full sm:w-44 h-28 overflow-hidden shrink-0 shadow-lg bg-gray-200">
                                        <img src={event.image_url} className="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700" alt={event.title} />
                                    </div>
                                ) : (
                                    <div className="w-full sm:w-44 h-28 bg-[#0052CC] shrink-0 flex items-center justify-center p-4 text-center">
                                        <span className="text-white font-bold text-[10px] uppercase tracking-widest opacity-40 italic">PUBLICAÇÃO INSTITUCIONAL</span>
                                    </div>
                                )}
                                <div className="flex flex-col justify-center">
                                    <h4 className="text-lg font-bold text-gray-800 group-hover:text-[#0052CC] transition-colors leading-tight mb-2 uppercase">{event.title}</h4>
                                    <p className="text-[10px] font-bold text-gray-400 uppercase tracking-widest flex items-center gap-2 group-hover:text-gray-600">
                                        <Info size={14} /> MAIS INFORMAÇÕES NA PÁGINA
                                    </p>
                                </div>
                            </a>
                        ))}
                    </div>
                </div>

                {/* Coluna Institucional */}
                <div className="space-y-16">
                    <div>
                        <h3 className="text-3xl font-bold text-[#0052CC] uppercase tracking-tighter mb-10">
                            Plataformas Digitais
                        </h3>
                        <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <a href="#" className="flex items-center justify-between p-6 bg-white border border-gray-100 hover:border-[#A3E635] hover:shadow-lg transition-all group">
                                <div className="flex items-center gap-4">
                                    <FileText className="text-[#0052CC]" size={20} />
                                    <span className="font-bold text-[10px] uppercase tracking-[0.2em]">Carta de Serviços</span>
                                </div>
                                <ChevronRight size={18} className="text-gray-200 group-hover:text-[#0052CC] transition-colors" />
                            </a>
                            <a href="#" className="flex items-center justify-between p-6 bg-white border border-gray-100 hover:border-[#A3E635] hover:shadow-lg transition-all group">
                                <div className="flex items-center gap-4">
                                    <MessageSquare className="text-[#0052CC]" size={20} />
                                    <span className="font-bold text-[10px] uppercase tracking-[0.2em]">Ouvidoria</span>
                                </div>
                                <ChevronRight size={18} className="text-gray-200 group-hover:text-[#0052CC] transition-colors" />
                            </a>
                        </div>
                    </div>

                    <div className="bg-[#0052CC] p-12 relative overflow-hidden shadow-2xl rounded-sm">
                        <div className="absolute top-0 right-0 w-32 h-32 bg-white/5 rotate-45 transform translate-x-16 -translate-y-16"></div>
                        <div className="relative z-10">
                            <h4 className="text-4xl font-bold text-white uppercase mb-4 tracking-tighter">CONECTE-SE À <span className="text-[#A3E635]">UEAP</span></h4>
                            <p className="text-white/60 font-bold text-[10px] mb-10 uppercase tracking-[0.3em] leading-relaxed">Siga nossos canais oficiais para novidades em tempo real.</p>

                            <div className="flex flex-col sm:flex-row gap-4">
                                <a href="#" className="flex-1 bg-white text-[#0052CC] flex items-center justify-center gap-3 py-4 font-bold text-[10px] uppercase tracking-[0.2em] hover:bg-[#A3E635] transition-all group">
                                    <Instagram size={20} /> INSTAGRAM
                                </a>
                                <a href="#" className="flex-1 bg-[#A3E635] text-[#0052CC] flex items-center justify-center gap-3 py-4 font-bold text-[10px] uppercase tracking-[0.2em] hover:bg-white transition-all group">
                                    <Youtube size={20} /> YOUTUBE
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
};

export default EventsSection;

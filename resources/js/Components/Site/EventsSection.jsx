import React from 'react';
import { Calendar, Info, FileText, MessageSquare, ChevronRight, Instagram, Youtube } from 'lucide-react';
import { route } from 'ziggy-js';

const EventsSection = ({ events = [] }) => {
    return (
        <section className="max-w-7xl mx-auto px-4 py-24">
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-24">

                {/* Coluna de Eventos */}
                <div>
                    <div className="flex items-center gap-4 mb-12">
                        <Calendar className="text-[#0052CC]" size={32} />
                        <h3 className="text-3xl font-bold text-[#0052CC] uppercase tracking-tighter">Eventos & Ações</h3>
                    </div>
                    <div className="flex flex-col gap-10">
                        {events.slice(0, 3).map((event, i) => (
                            <a href={route('site.post.show', event.slug)} key={event.id || i} className="flex flex-col sm:flex-row gap-6 group cursor-pointer border-b border-gray-100 pb-8 last:border-0 last:pb-0">
                                {event.image_url ? (
                                    <div className="w-full sm:w-40 h-28 overflow-hidden shrink-0 shadow-sm bg-gray-200">
                                        <img src={event.image_url} className="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700" alt={event.title} />
                                    </div>
                                ) : (
                                    <div className="w-full sm:w-40 h-28 bg-[#0052CC] shrink-0 flex items-center justify-center p-4 text-center">
                                        <span className="text-white font-bold text-[10px] uppercase tracking-widest opacity-40 italic">PUBLICAÇÃO INSTITUCIONAL</span>
                                    </div>
                                )}
                                <div className="flex flex-col justify-center">
                                    <p className="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 flex items-center gap-2">
                                        <Calendar size={12} className="text-[#A3E635]" />
                                        {event.created_at ? new Date(event.created_at).toLocaleDateString() : 'DATA INDEFINIDA'}
                                    </p>
                                    <h4 className="text-lg font-bold text-gray-800 group-hover:text-[#0052CC] transition-colors leading-tight uppercase line-clamp-3">
                                        {event.title}
                                    </h4>
                                </div>
                            </a>
                        ))}
                    </div>
                    <div className="mt-8 pt-4 border-t border-gray-100">
                        <a href={route('site.post.list', { type: 'event' })} className="inline-flex items-center gap-2 text-[10px] font-bold text-[#0052CC] uppercase tracking-[0.2em] hover:text-[#A3E635] transition-colors group">
                            VER TODOS OS EVENTOS <ChevronRight size={14} className="group-hover:translate-x-1 transition-transform" />
                        </a>
                    </div>
                </div>

                {/* Coluna Institucional */}
                <div className="space-y-16">
                    <div>
                        <h3 className="text-3xl font-bold text-[#0052CC] uppercase tracking-tighter mb-10">
                            Canais de Atendimento
                        </h3>
                        <div className="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <a href="#" className="flex flex-col items-center justify-center p-8 bg-white border border-gray-100 hover:border-[#A3E635] hover:shadow-xl hover:-translate-y-1 transition-all group text-center gap-4 rounded-sm">
                                <FileText className="text-[#0052CC] group-hover:scale-110 transition-transform duration-300" size={32} />
                                <span className="font-bold text-xs uppercase tracking-[0.2em] text-[#0052CC]">Carta de Serviços</span>
                            </a>
                            <a href="#" className="flex flex-col items-center justify-center p-8 bg-white border border-gray-100 hover:border-[#A3E635] hover:shadow-xl hover:-translate-y-1 transition-all group text-center gap-4 rounded-sm">
                                <MessageSquare className="text-[#0052CC] group-hover:scale-110 transition-transform duration-300" size={32} />
                                <span className="font-bold text-xs uppercase tracking-[0.2em] text-[#0052CC]">Ouvidoria</span>
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

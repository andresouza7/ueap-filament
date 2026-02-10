import React from 'react';
import { Calendar, FileText, MessageSquare, ChevronRight, Instagram, Youtube } from 'lucide-react';
import { route } from 'ziggy-js';

const EventsSection = ({ events = [] }) => {
    return (
        <section className="w-full bg-gradient-to-r from-gray-50 to-gray-100/60">
            <div className="max-w-7xl mx-auto px-4 py-12 md:py-24">
                {/* items-start garante que as colunas comecem no mesmo topo */}
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-start">

                    {/* Coluna de Eventos */}
                    <div className="flex flex-col">
                        <div className="flex items-center gap-3 mb-12">
                            {/* Removido p-3 para alinhar perfeitamente ao topo da coluna direita */}
                            <Calendar className="text-[#0052CC] shrink-0" size={32} />
                            <h3 className="text-2xl md:text-3xl font-bold text-[#0052CC] uppercase tracking-tighter">
                                Eventos & Ações
                            </h3>
                        </div>

                        <div className="flex flex-col gap-10">
                            {events.slice(0, 3).map((event, i) => (
                                <a
                                    href={route('site.post.show', event.slug)}
                                    key={event.id || i}
                                    className="flex flex-col sm:flex-row gap-6 group cursor-pointer border-b border-gray-200/60 pb-8 last:border-0 last:pb-0"
                                >
                                    {event.image_url ? (
                                        <div className="w-full sm:w-40 h-48 sm:h-28 overflow-hidden shrink-0 shadow-md bg-gray-200 rounded-sm">
                                            <img src={event.image_url} className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt={event.title} />
                                        </div>
                                    ) : (
                                        <div className="w-full sm:w-40 h-48 sm:h-28 bg-[#0052CC] shrink-0 flex items-center justify-center p-4 text-center shadow-md rounded-sm">
                                            <span className="text-white font-bold text-[10px] uppercase tracking-widest opacity-40 italic">PUBLICAÇÃO INSTITUCIONAL</span>
                                        </div>
                                    )}
                                    <div className="flex flex-col justify-center">
                                        <p className="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2 flex items-center gap-2">
                                            <Calendar size={12} className="text-[#89c02e]" />
                                            {event.created_at ? new Date(event.created_at).toLocaleDateString() : 'DATA INDEFINIDA'}
                                        </p>
                                        <h4 className="text-lg font-medium text-gray-900 group-hover:text-[#0052CC] transition-colors leading-tight line-clamp-3">
                                            {event.title}
                                        </h4>
                                    </div>
                                </a>
                            ))}
                        </div>

                        <div className="mt-8 pt-4 border-t border-gray-200/60">
                            <a href={route('site.post.list', { type: 'event' })} className="inline-flex items-center gap-2 text-[10px] font-bold text-[#0052CC] uppercase tracking-[0.2em] hover:text-[#89c02e] transition-colors group">
                                VER TODOS OS EVENTOS <ChevronRight size={14} className="group-hover:translate-x-1 transition-transform" />
                            </a>
                        </div>
                    </div>

                    {/* Coluna Institucional */}
                    <div className="space-y-12 md:space-y-16">
                        <div>
                            {/* Alinhado com o h3 da esquerda */}
                            <h3 className="text-2xl md:text-3xl font-bold text-[#0052CC] uppercase tracking-tighter mb-12 lg:mb-10">
                                Canais de Atendimento
                            </h3>

                            <div className="grid grid-cols-1 gap-4">
                                <a href="https://cartaservico.portal.ap.gov.br/carta-de-servico-publica/orgao/46/servicos" target="_blank" className="flex items-center justify-between p-5 md:p-6 bg-white border-l-4 border-gray-100 hover:border-l-[#A3E635] shadow-sm hover:shadow-md transition-all group">
                                    <div className="flex items-center gap-4">
                                        <div className="p-3 bg-blue-50 text-[#0052CC] rounded-full group-hover:bg-[#0052CC] group-hover:text-white transition-colors">
                                            <FileText size={24} />
                                        </div>
                                        <div>
                                            <h4 className="font-bold text-[#0052CC] uppercase tracking-widest text-sm mb-1">Carta de Serviços</h4>
                                            <p className="text-[13px] text-gray-500 font-medium">Consulte os serviços disponíveis</p>
                                        </div>
                                    </div>
                                    <ChevronRight size={20} className="text-gray-300 group-hover:text-[#A3E635] transition-colors" />
                                </a>

                                <a href="https://ouvamapa.portal.ap.gov.br/" target="_blank" className="flex items-center justify-between p-5 md:p-6 bg-white border-l-4 border-gray-100 hover:border-l-[#A3E635] shadow-sm hover:shadow-md transition-all group">
                                    <div className="flex items-center gap-4">
                                        <div className="p-3 bg-blue-50 text-[#0052CC] rounded-full group-hover:bg-[#0052CC] group-hover:text-white transition-colors">
                                            <MessageSquare size={24} />
                                        </div>
                                        <div>
                                            <h4 className="font-bold text-[#0052CC] uppercase tracking-widest text-sm mb-1">Ouvidoria</h4>
                                            <p className="text-[13px] text-gray-500 font-medium">Registre sua manifestação</p>
                                        </div>
                                    </div>
                                    <ChevronRight size={20} className="text-gray-300 group-hover:text-[#A3E635] transition-colors" />
                                </a>
                            </div>
                        </div>

                        {/* Card de Redes Sociais - Padding ajustado para Mobile */}
                        <div className="bg-[#0052CC] p-8 md:p-12 relative overflow-hidden shadow-2xl rounded-sm">
                            <div className="absolute top-0 right-0 w-32 h-32 bg-white/10 rotate-45 transform translate-x-16 -translate-y-16"></div>
                            <div className="absolute bottom-0 left-0 w-24 h-24 bg-black/5 rounded-full transform -translate-x-8 translate-y-8"></div>

                            <div className="relative z-10">
                                <h4 className="text-3xl md:text-4xl font-bold text-white uppercase mb-4 tracking-tighter leading-none">
                                    CONECTE-SE À <span className="text-[#A3E635]">UEAP</span>
                                </h4>
                                <p className="text-white/80 font-bold text-[10px] mb-8 md:mb-10 uppercase tracking-[0.3em] leading-relaxed">
                                    Siga nossos canais oficiais.
                                </p>

                                <div className="flex flex-col sm:flex-row gap-4">
                                    <a href="https://www.instagram.com/ueapoficial/" className="flex-1 bg-white text-[#0052CC] flex items-center justify-center gap-3 py-4 font-bold text-[10px] uppercase tracking-[0.2em] hover:bg-gray-200 transition-all group">
                                        <Instagram size={20} /> INSTAGRAM
                                    </a>
                                    <a href="https://www.youtube.com/channel/UCB6gc6QS_nJmCP5rNBh0kQQ" className="flex-1 bg-[#A3E635] text-[#0052CC] flex items-center justify-center gap-3 py-4 font-bold text-[10px] uppercase tracking-[0.2em] hover:bg-[#89c02e] transition-all group">
                                        <Youtube size={20} /> YOUTUBE
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
};

export default EventsSection;
import React from 'react';
import { Calendar, Scale, FileCheck, Scroll, Briefcase, UserPlus } from 'lucide-react';

const QuickAccessSection = () => {
    const quickAccessLinks = [
        { label: 'Calendário Acadêmico', icon: <Calendar size={20} />, href: '/calendario-academico' },
        { label: 'Legislação UEAP', icon: <Scale size={20} />, href: '/pagina/legislacao.html' },
        { label: 'Instruções Normativas', icon: <FileCheck size={20} />, href: '/pagina/instrucoes_normativas.html' },
        { label: 'Resoluções CONSU', icon: <Scroll size={20} />, href: '/consu/resolucoes' },
        { label: 'Licitações', icon: <Briefcase size={20} />, href: 'https://transparencia.ueap.edu.br/licitacoes' },
        { label: 'Processos Seletivos', icon: <UserPlus size={20} />, href: '/pagina/area-processos-seletivos.html' },
    ];

    return (
        /* SEÇÃO ACESSO RÁPIDO (BARRA BRANCA COM DETALHE LIME) */
        <div className="max-w-7xl mx-auto px-0 lg:px-4 relative z-20">
            <div className="bg-white shadow-xl border-t-4 border-[#A3E635] grid grid-cols-3 md:grid-cols-3 lg:grid-cols-6">
                {quickAccessLinks.map((link, idx) => (
                    <a key={idx} href={link.href} className="group p-6 flex flex-col items-center justify-center text-center hover:bg-blue-50/50 transition-all duration-300 border-r border-gray-100 last:border-r-0 lg:last:border-r-0 [&:nth-child(2)]:border-r-0 md:[&:nth-child(2)]:border-r lg:[&:nth-child(2)]:border-r [&:nth-child(3)]:border-r-0 lg:[&:nth-child(3)]:border-r md:[&:nth-child(3)]:border-r">
                        <div className="mb-3 text-[#0052CC] group-hover:scale-110 group-hover:text-[#A3E635] transition-all duration-300 transform">
                            {link.icon}
                        </div>
                        <span className="text-[10px] font-bold text-gray-600 group-hover:text-[#0052CC] uppercase tracking-widest leading-tight transition-colors">
                            {link.label}
                        </span>
                    </a>
                ))}
            </div>
        </div>
    );
};

export default QuickAccessSection;

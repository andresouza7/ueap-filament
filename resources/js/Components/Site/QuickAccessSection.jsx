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
            <div className="bg-white shadow-xl border-t-4 border-t-ueap-accent grid grid-cols-3 md:grid-cols-3 lg:grid-cols-6 border-b border-b-gray-100 lg:border-b-0">
                {quickAccessLinks.map((link, idx) => (
                    <a key={idx} href={link.href} className="group p-4 md:p-6 flex flex-col items-center justify-center text-center hover:bg-blue-50/50 transition-all duration-300 border-gray-100 border-r [&:nth-child(3n)]:border-r-0 lg:[&:nth-child(3)]:border-r lg:last:border-r-0 [&:nth-child(-n+3)]:border-b lg:[&:nth-child(-n+3)]:border-b-0">
                        <div className="mb-2 md:mb-3 text-ueap-primary group-hover:scale-110 group-hover:text-ueap-accent transition-all duration-300 transform">
                            {link.icon}
                        </div>
                        <span className="text-[10px] font-bold text-contrast-body group-hover:text-ueap-primary uppercase tracking-widest leading-tight transition-colors">
                            {link.label}
                        </span>
                    </a>
                ))}
            </div>
        </div>
    );
};

export default QuickAccessSection;

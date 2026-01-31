import React from 'react';
import { Calendar, Scale, FileCheck, Scroll, Briefcase, UserPlus } from 'lucide-react';

const QuickAccessSection = () => {
    const quickAccessLinks = [
        { label: 'Calendário Acadêmico', icon: <Calendar size={20} /> },
        { label: 'Legislação UEAP', icon: <Scale size={20} /> },
        { label: 'Instruções Normativas', icon: <FileCheck size={20} /> },
        { label: 'Resoluções CONSU', icon: <Scroll size={20} /> },
        { label: 'Licitações', icon: <Briefcase size={20} /> },
        { label: 'Processos Seletivos', icon: <UserPlus size={20} /> },
    ];

    return (
        /* SEÇÃO ACESSO RÁPIDO */
        <section className="bg-gray-50 border-b border-gray-100 py-12 font-sans">
            <div className="max-w-7xl mx-auto px-4">
                <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    {quickAccessLinks.map((link, idx) => (
                        <a key={idx} href="#" className="bg-white p-6 border border-gray-100 shadow-sm hover:shadow-xl hover:border-[#A3E635] transition-all group flex flex-col items-center text-center">
                            <div className="mb-4 text-[#0052CC] group-hover:text-[#A3E635] group-hover:scale-110 transition-all duration-300">{link.icon}</div>
                            <span className="text-[10px] font-bold text-gray-500 group-hover:text-[#0052CC] uppercase tracking-widest leading-tight transition-colors">{link.label}</span>
                        </a>
                    ))}
                </div>
            </div>
        </section>
    );
};

export default QuickAccessSection;

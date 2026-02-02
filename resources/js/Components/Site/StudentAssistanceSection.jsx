import React from 'react';
import { BookOpen, GraduationCap, Users, Info, FlaskConical, Mic, Search, Cpu } from 'lucide-react';

const StudentAssistanceSection = () => {
    const programasAssistencia = [
        { sigla: 'PIBID', desc: 'Iniciação à Docência', url: '/pagina/pibid.html', icon: <BookOpen size={28} /> },
        { sigla: 'PRP', desc: 'Residência Pedagógica', url: '/pagina/prp.html', icon: <GraduationCap size={28} /> },
        { sigla: 'PROACE', desc: 'Ações Comunitárias', url: '/pagina/proace.html', icon: <Users size={28} /> },
        { sigla: 'PROAPE', desc: 'Apoio Pedagógico', url: '/pagina/proape.html', icon: <Info size={28} /> },
        { sigla: 'PROBICT', desc: 'Bolsas de C&T', url: '/pagina/probict.html', icon: <FlaskConical size={28} /> },
        { sigla: 'MONITORIA', desc: 'Apoio Acadêmico', url: '/pagina/promonitoria.html', icon: <Mic size={28} /> },
        { sigla: 'PIBIC', desc: 'Iniciação Científica', url: '/pagina/pibic.html', icon: <Search size={28} /> },
        { sigla: 'PIBT', desc: 'Inovação Tecnológica', url: '/pagina/pibt.html', icon: <Cpu size={28} /> },
    ];

    return (
        <section className="relative py-32 border-y border-gray-200 overflow-hidden bg-gray-50">

            <div className="max-w-7xl mx-auto px-4 relative z-10">
                <div className="flex flex-col md:flex-row md:items-end md:justify-between gap-8 mb-20 relative">
                    <div className="space-y-4">
                        <div className="flex items-center gap-3">
                            <div className="w-8 h-1 bg-[#A3E635]"></div>
                            <span className="text-gray-400 font-bold text-xs uppercase tracking-[0.3em]">Programas & Auxílios</span>
                        </div>
                        <h2 className="text-5xl md:text-6xl font-black text-[#0052CC] uppercase tracking-tighter leading-[0.9]">
                            Assistência<br />Estudantil
                        </h2>
                    </div>

                    <div className="md:text-right max-w-sm pb-1 border-l-4 md:border-l-0 md:border-r-4 border-[#A3E635] pl-6 md:pl-0 md:pr-6">
                        <p className="text-sm text-gray-500 font-medium leading-relaxed">
                            Ações de <span className="font-bold text-[#0052CC]">incentivo à pesquisa</span> e <span className="font-bold text-[#0052CC]">apoio à permanência</span> estudantil na universidade.
                        </p>
                    </div>
                </div>

                <div className="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                    {programasAssistencia.map((p, idx) => (
                        <a key={idx} href={p.url} className="bg-white p-6 md:p-8 shadow-md rounded-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex flex-col items-start justify-center relative overflow-hidden h-full">
                            <div className="absolute top-0 right-0 p-3 opacity-10 group-hover:opacity-100 transition-opacity duration-300 text-[#0052CC]">
                                {React.cloneElement(p.icon, { size: 24, className: 'group-hover:rotate-12 transition-transform duration-500' })}
                            </div>
                            <h3 className="text-xl md:text-2xl font-black text-[#0052CC] mb-2 tracking-tighter relative z-10">{p.sigla}</h3>
                            <p className="text-[10px] text-gray-500 font-bold uppercase tracking-widest group-hover:text-gray-800 transition-colors relative z-10 leading-tight">{p.desc}</p>
                        </a>
                    ))}
                </div>
            </div>
        </section>
    );
};

export default StudentAssistanceSection;

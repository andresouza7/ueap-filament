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
        /* py-32 reduzido para py-16 no mobile para melhor fluxo */
        <section className="relative py-16 md:py-32 border-y border-gray-200 overflow-hidden bg-white">
            <div className="max-w-7xl mx-auto px-4 relative z-10">

                {/* Cabeçalho Responsivo */}
                <div className="flex flex-col md:flex-row md:items-end md:justify-between gap-8 mb-12 md:mb-20 relative">
                    <div className="space-y-4">
                        <div className="flex items-center gap-3">
                            <div className="w-8 h-1 bg-ueap-accent"></div>
                            <span className="text-contrast-body font-bold text-xs uppercase tracking-[0.3em]">Programas & Auxílios</span>
                        </div>
                        {/* Ajuste de tamanho de fonte no mobile (text-3xl) vs desktop (md:text-5xl) */}
                        <h2 className="text-4xl md:text-5xl font-black text-ueap-primary uppercase tracking-tighter leading-[0.9]">
                            Assistência<br />Estudantil
                        </h2>
                    </div>

                    <div className="md:text-right max-w-sm pb-1 border-l-4 md:border-l-0 md:border-r-4 border-ueap-accent pl-6 md:pl-0 md:pr-6">
                        <p className="text-sm text-contrast-body font-medium leading-relaxed">
                            Ações de <span className="font-bold text-ueap-primary">incentivo à pesquisa</span> e <span className="font-bold text-ueap-primary">apoio à permanência</span> estudantil na universidade.
                        </p>
                    </div>
                </div>

                {/* Grid de Cards - gap menor no mobile para otimizar espaço */}
                <div className="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6">
                    {programasAssistencia.map((p, idx) => (
                        <a
                            key={idx}
                            href={p.url}
                            className="bg-white p-5 md:p-8 shadow-md rounded-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex flex-col items-start justify-center relative overflow-hidden h-full border border-gray-200"
                        >
                            {/* Ícone oculto em telas muito pequenas (opcional) ou mantido como decorativo */}
                            <div className="absolute top-0 right-0 p-2 md:p-3 opacity-10 group-hover:opacity-100 transition-opacity duration-300 text-ueap-primary">
                                {React.cloneElement(p.icon, {
                                    size: 24,
                                    className: 'group-hover:rotate-12 transition-transform duration-500 w-5 h-5 md:w-6 md:h-6'
                                })}
                            </div>

                            <h3 className="text-lg md:text-2xl font-black text-ueap-primary mb-2 tracking-tighter relative z-10 break-words w-full">
                                {p.sigla}
                            </h3>

                            <p className="text-[9px] md:text-[10px] text-contrast-body font-bold uppercase tracking-widest group-hover:text-contrast-primary transition-colors relative z-10 leading-tight">
                                {p.desc}
                            </p>
                        </a>
                    ))}
                </div>
            </div>
        </section>
    );
};

export default StudentAssistanceSection;
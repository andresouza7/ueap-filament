import React from 'react';

const StudentAssistanceSection = () => {
    const programasAssistencia = [
        { sigla: 'PIBID', desc: 'INICIAÇÃO À DOCÊNCIA', url: '#' },
        { sigla: 'PRP', desc: 'RESIDÊNCIA PEDAGÓGICA', url: '#' },
        { sigla: 'PROACE', desc: 'AÇÕES COMUNITÁRIAS', url: '#' },
        { sigla: 'PROAPE', desc: 'APOIO PEDAGÓGICO', url: '#' },
        { sigla: 'PROBICT', desc: 'BOLSAS DE C&T', url: '#' },
        { sigla: 'MONITORIA', desc: 'APOIO ACADÊMICO', url: '#' },
        { sigla: 'PIBIC', desc: 'INICIAÇÃO CIENTÍFICA', url: '#' },
        { sigla: 'PIBT', desc: 'INOVAÇÃO TECNOLÓGICA', url: '#' },
    ];

    return (
        <section className="relative py-32 border-y border-gray-200 overflow-hidden bg-gradient-to-b from-[#F5F9FF] to-gray-50">


            {/* Decorative Green Accent */}
            <div className="absolute top-0 right-0 w-96 h-96 border-[2px] border-[#A3E635] rounded-full opacity-10 pointer-events-none translate-x-1/3 -translate-y-1/3"></div>
            <div className="absolute top-10 right-10 w-64 h-64 bg-[#A3E635] rounded-full mix-blend-multiply filter blur-[80px] opacity-10 pointer-events-none"></div>

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

                <div className="grid grid-cols-2 lg:grid-cols-4 gap-6">
                    {programasAssistencia.map((p, idx) => (
                        <a key={idx} href={p.url} className="bg-white p-8 shadow-md rounded-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex flex-col items-start justify-center">
                            <h3 className="text-2xl font-black text-[#0052CC] mb-2 tracking-tighter">{p.sigla}</h3>
                            <p className="text-[10px] text-gray-500 font-bold uppercase tracking-widest group-hover:text-gray-800 transition-colors">{p.desc}</p>
                        </a>
                    ))}
                </div>
            </div>
        </section>
    );
};

export default StudentAssistanceSection;

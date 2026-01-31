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
        <section className="bg-white py-20 border-y border-gray-100">
            <div className="max-w-7xl mx-auto px-4 text-center">
                <h2 className="text-4xl font-bold text-[#0052CC] uppercase tracking-tighter mb-16">
                    Assistência Estudantil
                </h2>

                <div className="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    {programasAssistencia.map((p, idx) => (
                        <a key={idx} href={p.url} className="bg-white p-8 border border-transparent hover:border-[#A3E635] hover:shadow-xl transition-all group flex flex-col items-center justify-center">
                            <h3 className="text-2xl font-bold text-[#0052CC] mb-2 group-hover:text-[#A3E635] transition-colors">{p.sigla}</h3>
                            <p className="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{p.desc}</p>
                        </a>
                    ))}
                </div>
            </div>
        </section>
    );
};

export default StudentAssistanceSection;

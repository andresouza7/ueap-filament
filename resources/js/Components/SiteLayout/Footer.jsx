import React from 'react';

const Footer = () => (
    <footer id="main-footer" className="bg-ueap-footer pt-16 md:pt-20 pb-8 relative overflow-hidden">
        {/* Decorative layer */}
        <div className="hidden 2xl:block absolute top-0 left-0 w-1/4 h-full bg-white/[0.02] -skew-x-12 -translate-x-1/2 pointer-events-none"></div>

        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            {/* GRID DE LINKS */}
            <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-x-8 gap-y-10 mb-12 lg:mb-16">
                {[
                    {
                        title: "Institucional",
                        links: [
                            { label: "Sobre a UEAP", url: "/pagina/historia.html" },
                            { label: "Reitoria", url: "/pagina/reitoria.html" },
                            { label: "Pró-Reitorias", url: "/pagina/pro_reitorias.html" },
                            { label: "Imprensa", url: "/pagina/sala_de_imprensa.html" },
                        ]
                    },
                    {
                        title: "Ensino",
                        links: [
                            { label: "Biblioteca", url: "/pagina/biblioteca.html" },
                            { label: "Portal do Aluno", url: "https://sigaa.ueap.edu.br/sigaa/" },
                            { label: "Portal de Periódicos", url: "https://periodicos.ueap.edu.br/" },
                            { label: "Calendário", url: "/calendario-academico" }
                        ]
                    },
                    {
                        title: "Cursos",
                        links: [
                            { label: "Graduação", url: "/cursos/graduacao" },
                            { label: "Pós-Graduação", url: "/cursos/pos" },
                            { label: "Extensão", url: "/cursos/ext" }
                        ]
                    },

                    {
                        title: "Comunidade",
                        links: [
                            { label: "Notícias", url: "/postagens?type=news" },
                            { label: "Eventos", url: "/postagens?type=event" },
                            { label: "Editais", url: "https://processoseletivo.ueap.edu.br" }
                        ]
                    },
                    {
                        title: "Transparência",
                        links: [
                            { label: "Prestação de Contas", url: "http://transparencia.ueap.edu.br/" },
                            { label: "Licitações", url: "https://transparencia.ueap.edu.br/licitacoes" },
                            { label: "Ouvidoria", url: "https://ouvamapa.portal.ap.gov.br/" }
                        ]
                    }
                ].map((section, i) => (
                    <nav key={i} aria-label={`Menu ${section.title}`}>
                        <div className="flex items-center gap-2 mb-4">
                            <span className="w-4 h-[2px] bg-ueap-accent"></span>
                            <h4 className="text-xs font-bold uppercase tracking-widest text-ueap-accent">
                                {section.title}
                            </h4>
                        </div>
                        <ul className="space-y-3 text-sm text-footer-primary-light font-medium">
                            {section.links.map((link, j) => (
                                <li key={j}>
                                    <a href={link.url} className="hover:text-ueap-secondary transition-colors">
                                        {link.label}
                                    </a>
                                </li>
                            ))}
                        </ul>
                    </nav>
                ))}
            </div>

            {/* INFO PRINCIPAL */}
            <div className="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-12 border-t border-white/5 pt-12 mb-12">
                {/* Bloco Institucional */}
                <div className="relative pl-6 border-l border-white/10 max-w-lg group">
                    {/* Animated Active Border */}
                    <div className="absolute left-[-1px] top-0 h-8 w-[1px] bg-ueap-accent group-hover:h-full transition-all duration-500 ease-out"></div>

                    <div className="flex flex-col gap-5">
                        <div className="flex items-center gap-4">
                            <img src="/img/nova_logo_white.png" alt="UEAP" className="h-10 w-auto brightness-0 invert opacity-90 group-hover:opacity-100 transition-opacity" onError={(e) => { e.target.src = "/img/nova_logo_white.png"; }} />
                            <span className="px-2 py-0.5 bg-ueap-accent/10 border border-ueap-accent/20 text-ueap-accent text-[9px] font-bold uppercase tracking-widest rounded-sm">
                                Desde 2006
                            </span>
                        </div>

                        <div>
                            {/* <h3 className="text-xl text-ueap-secondary font-medium leading-tight mb-2">
                                Universidade do Estado do Amapá
                            </h3> */}

                            <p className="text-footer-primary-subtle text-sm leading-relaxed font-light">
                                Promovendo educação de qualidade e desenvolvimento sustentável para a região amazônica.
                            </p>
                        </div>
                    </div>
                </div>

                {/* Selo MEC */}
                <a
                    href="https://emec.mec.gov.br/emec/consulta-cadastro/detalhamento/d96957f455f6405d14c6542552b0f6eb/NTcwMQ=="
                    target="_blank"
                    rel="noopener noreferrer"
                    className="group flex items-center gap-4 bg-white/5 p-4 rounded-lg hover:bg-white/10 transition-colors"
                >
                    <div className="text-right">
                        <p className="text-[10px] font-bold uppercase tracking-widest text-ueap-accent mb-1">
                            Credenciada
                        </p>
                        <p className="text-xs text-ueap-secondary font-bold">
                            Portal e-MEC
                        </p>
                    </div>

                    <div className="bg-white p-1 rounded-sm w-24 h-24 flex items-center justify-center">
                        <img className="max-w-full max-h-full" src="/img/site/banner_mec.png" alt="Selo e-MEC" />
                    </div>
                </a>
            </div>

            {/* ENDEREÇOS */}
            <section className="mb-12 border-b border-white/5 pb-12" aria-labelledby="footer-enderecos-title">
                <h5 id="footer-enderecos-title" className="text-[10px] font-bold uppercase tracking-widest text-ueap-accent/60 mb-6 flex items-center gap-3">
                    <span className="w-8 h-[1px] bg-ueap-accent/30"></span>
                    Nossos endereços
                </h5>

                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-6 gap-x-8">
                    {[
                        { nome: "Campus I", end: "Av. Presidente Vargas, 650 - Centro" },
                        { nome: "Território dos Lagos", end: "Av. Desidério Antônio, 470 - Amapá-AP" },
                        { nome: "Administrativo", end: "Rua Tiradentes, 284 - Centro" },
                        { nome: "Anexo Graziela", end: "Av. Duque de Caxias, 60 - Centro" },
                        { nome: "NTE", end: "Av. 13 de Setembro, 2081 - Buritizal" },
                        { nome: "Campus III", end: "Av. Mendonça Furtado - Centro" }
                    ].map((item, i) => (
                        <div key={i} className="flex flex-col">
                            <h5 className="text-xs font-bold text-ueap-secondary uppercase tracking-wider mb-1">
                                {item.nome}
                            </h5>
                            <p className="text-xs text-footer-primary-subtle">
                                {item.end}
                            </p>
                        </div>
                    ))}
                </div>
            </section>

            {/* BOTTOM */}
            <div className="flex flex-col md:flex-row justify-between items-center gap-6">
                <p className="text-footer-primary-subtle text-[10px] font-bold uppercase tracking-widest">
                    © 2026 UEAP — Desenvolvido pela <span className="text-ueap-secondary">DINFO</span><i className="fa-solid fa-code text-ueap-accent ml-1"></i>.
                </p>
                <div className="flex gap-4">
                    <a
                        href="https://www.youtube.com/channel/UCB6gc6QS_nJmCP5rNBh0kQQ"
                        target="_blank"
                        rel="noopener noreferrer"
                        className="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center hover:bg-ueap-accent transition-all text-footer-primary-subtle hover:text-ueap-secondary"
                        aria-label="YouTube da UEAP"
                    >
                        <i className="fa-brands fa-youtube text-sm" aria-hidden="true"></i>
                    </a>
                    <a
                        href="https://www.instagram.com/ueapoficial/"
                        target="_blank"
                        rel="noopener noreferrer"
                        className="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center hover:bg-ueap-accent transition-all text-footer-primary-subtle hover:text-ueap-secondary"
                        aria-label="Instagram da UEAP"
                    >
                        <i className="fa-brands fa-instagram text-sm" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
);

export default Footer;

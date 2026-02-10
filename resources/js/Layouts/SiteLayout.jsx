import React, { useState } from 'react';
import { Menu, X, Search, Instagram, Youtube, ChevronDown } from 'lucide-react';
import { Link, router, usePage } from '@inertiajs/react';
import { route } from 'ziggy-js';
import AIChatbot from '@/Components/Site/AIChatbot';

const SearchModal = ({ isOpen, onClose }) => {
    const [term, setTerm] = useState('');

    const handleSearch = () => {
        if (term.trim()) {
            window.location.href = route('site.post.list', { search: term });
            onClose();
        }
    };

    if (!isOpen) return null;
    return (
        <div className="fixed inset-0 z-[100] flex items-center justify-center px-4">
            <div className="absolute inset-0 bg-[#003D99]/90 backdrop-blur-sm animate-in fade-in duration-300" onClick={onClose}></div>
            <div className="relative w-full max-w-3xl bg-white shadow-2xl rounded-sm overflow-hidden animate-in zoom-in-95 duration-300">
                <div className="flex items-center p-6 border-b border-gray-100">
                    <button onClick={handleSearch} className="mr-4 text-[#0052CC] hover:scale-110 transition-transform">
                        <Search size={24} />
                    </button>
                    <input
                        autoFocus
                        type="text"
                        placeholder="O que você procura?"
                        className="flex-1 bg-transparent border-none focus:ring-0 text-xl font-medium text-gray-800 placeholder:text-gray-300"
                        value={term}
                        onChange={(e) => setTerm(e.target.value)}
                        onKeyDown={(e) => e.key === 'Enter' && handleSearch()}
                    />
                    <button onClick={onClose} className="p-2 hover:bg-gray-100 rounded-full transition-colors text-gray-400 hover:text-[#0052CC]"><X size={24} /></button>
                </div>
                <div className="p-8 bg-gray-50 text-left">
                    <h4 className="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Sugestões de busca</h4>
                    <div className="flex flex-wrap gap-2">
                        {['Calendário Acadêmico', 'Edital', 'Matrícula', 'Bolsa', 'Inscrições'].map(tag => (
                            <button
                                key={tag}
                                onClick={() => { setTerm(tag); window.location.href = route('site.post.list', { search: tag }); onClose(); }}
                                className="px-4 py-2 bg-white border border-gray-200 text-[10px] font-bold text-[#0052CC] hover:bg-[#A3E635] hover:border-[#A3E635] transition-all uppercase tracking-widest"
                            >
                                {tag}
                            </button>
                        ))}
                    </div>
                </div>
            </div>
        </div>
    );
};

const TopBar = () => (
    <div className="bg-[#0052CC] text-white py-1.5 px-2 md:px-6 border-b border-white/5">
        <div className="max-w-7xl mx-auto px-4 flex justify-end md:justify-between items-center">
            {/* Texto alinhado à esquerda conforme solicitado */}
            <span className="hidden md:inline-block text-[9px] font-bold uppercase tracking-[0.15em] opacity-70">Portal Institucional</span>

            <nav className="flex gap-4 items-center">
                <a href="https://sigaa.ueap.edu.br/sigaa/" target="_blank" rel="noopener noreferrer" className="text-[9px] font-bold hover:text-[#A3E635] transition-colors uppercase tracking-[0.15em] opacity-90">SIGAA</a>
                <a href="http://intranet.ueap.edu.br/" target="_blank" rel="noopener noreferrer" className="text-[9px] font-bold hover:text-[#A3E635] transition-colors uppercase tracking-[0.15em] opacity-90">Intranet</a>
                <a href="http://transparencia.ueap.edu.br/" target="_blank" rel="noopener noreferrer" className="text-[9px] font-bold hover:text-[#A3E635] transition-colors uppercase tracking-[0.15em] opacity-90">Transparência</a>
                <a href="https://servicedesk.ueap.edu.br/" target="_blank" rel="noopener noreferrer" className="text-[9px] font-bold hover:text-[#A3E635] transition-colors uppercase tracking-[0.15em] opacity-90">Service Desk</a>
            </nav>
        </div>
    </div>
);

const resolveUrl = (url) => {
    if (!url) return '#';
    // Se começar com http, //, #, /, mailto ou tel, mantem original
    if (/^(http:\/\/|https:\/\/|\/\/|#|\/|mailto:|tel:)/.test(url)) {
        return url;
    }
    // Caso contrário, assume que é um path interno sem / inicial e adiciona
    return `/${url}`;
};

const MobileMenuItem = ({ item }) => {
    const [isOpen, setIsOpen] = useState(false);
    const hasSubMenu = item.sub_itens && item.sub_itens.length > 0;

    return (
        <div className="border-b border-gray-100 last:border-0">
            <div className="flex items-center justify-between py-3">
                {hasSubMenu ? (
                    <button
                        onClick={() => setIsOpen(!isOpen)}
                        className="flex-1 flex items-center justify-between text-left text-sm font-bold text-[#0052CC] uppercase tracking-widest"
                    >
                        {item.name}
                        <ChevronDown size={16} className={`transition-transform duration-300 ${isOpen ? 'rotate-180' : ''}`} />
                    </button>
                ) : (
                    <a href={resolveUrl(item.url)} className="block w-full text-sm font-bold text-[#0052CC] uppercase tracking-widest">
                        {item.name}
                    </a>
                )}
            </div>

            {hasSubMenu && (
                <div className={`overflow-hidden transition-all duration-300 ${isOpen ? 'max-h-96 opacity-100 mb-4' : 'max-h-0 opacity-0'}`}>
                    <div className="flex flex-col gap-3 pl-4 border-l-2 border-[#A3E635] ml-1">
                        {item.sub_itens.map(subItem => (
                            <a
                                key={subItem.id}
                                href={resolveUrl(subItem.url)}
                                className="text-xs font-medium text-gray-600 hover:text-[#0052CC] uppercase tracking-widest block py-1"
                            >
                                {subItem.name}
                            </a>
                        ))}
                    </div>
                </div>
            )}
        </div>
    );
};

const NavBar = ({ isMenuOpen, setIsMenuOpen, menus, onSearchOpen }) => (
    <nav className="sticky top-0 z-50">
        <div className="absolute inset-0 bg-gray-50/90 backdrop-blur-md shadow-md z-20 pointer-events-none"></div>
        <div className="max-w-7xl mx-auto px-4 relative">
            <div className="flex justify-between h-16 lg:h-20">
                <div className="flex items-center">
                    <Link href={route('site.home')} className="flex items-center gap-4 transition-all hover:translate-x-1 group text-left relative z-30">
                        <img src="/img/site/logo.png" alt="Brasão UEAP" className="h-10 lg:h-14 w-auto object-contain" onError={(e) => { e.target.src = "https://ueap.edu.br/img/nova_logo_black.png"; e.target.className = "h-10 w-auto object-contain opacity-20 grayscale"; }} />
                        <div className="-ml-4">
                            {/* Fonte Inter aplicada e cores ajustadas para quebrar o excesso de azul */}
                            <h1 className="text-green-800/85 font-extrabold text-xl lg:text-2xl leading-none uppercase" style={{ fontFamily: 'Rubik, sans-serif' }}>
                                UEAP
                            </h1>
                            <p className="text-[7px] md:text-[8px] font-medium text-gray-500 uppercase tracking-widest leading-tight mt-0.5">
                                Universidade do <br />
                                <span className="text-gray-800 font-bold">Estado do Amapá</span>
                            </p>
                        </div>
                    </Link>
                </div>
                <div className="hidden lg:flex flex-1 items-center justify-between">
                    <div className="flex-1 flex justify-center items-center gap-1">
                        {menus && menus.items && menus.items.length > 0 ? menus.items.map((item) => {
                            const hasSubMenu = item.sub_itens && item.sub_itens.length > 0;
                            return (
                                <div key={item.id} className="relative group h-full flex items-center">
                                    {hasSubMenu ? (
                                        <>
                                            <button className="text-gray-800 hover:text-[#0052CC] font-bold text-[11px] uppercase tracking-[0.1em] transition-all relative py-8 px-2 z-30">
                                                {item.name}
                                                <span className="absolute bottom-6 left-0 w-0 h-0.5 bg-[#A3E635] transition-all group-hover:w-full"></span>
                                            </button>

                                            <div className="absolute top-[65%] left-0 w-64 bg-white shadow-2xl py-4 pt-10 hidden group-hover:block animate-in fade-in slide-in-from-top-2 z-10">
                                                {item.sub_itens.map(subItem => (
                                                    <a
                                                        key={subItem.id}
                                                        href={resolveUrl(subItem.url)}
                                                        className="px-6 py-3 text-[10px] font-bold text-gray-600 hover:text-[#0052CC] hover:bg-gray-50 uppercase tracking-widest transition-colors flex items-center gap-2 border-l-2 border-transparent hover:border-[#A3E635]"
                                                    >
                                                        {subItem.name}
                                                    </a>
                                                ))}
                                            </div>
                                        </>
                                    ) : (
                                        <a
                                            href={resolveUrl(item.url)}
                                            className="text-gray-800 hover:text-[#0052CC] font-bold text-[11px] uppercase tracking-[0.1em] transition-all relative py-8 px-2 z-30 flex items-center"
                                        >
                                            {item.name}
                                            <span className="absolute bottom-6 left-0 w-0 h-0.5 bg-[#A3E635] transition-all group-hover:w-full"></span>
                                        </a>
                                    )}
                                </div>
                            );
                        }) : (
                            <span className="text-xs text-gray-400 relative z-30">Carregando menu...</span>
                        )}
                    </div>

                    <div className="flex items-center gap-2">
                        <div className="h-6 w-px bg-gray-200 relative z-30"></div>
                        <button onClick={onSearchOpen} className="text-[#0052CC] hover:text-[#A3E635] transition-transform hover:scale-110 p-2 relative z-30"><Search size={20} /></button>
                    </div>
                </div>
                <div className="flex lg:hidden items-center gap-4">
                    <button onClick={onSearchOpen} className="text-[#0052CC] p-2 relative z-30"><Search size={22} /></button>
                    <button onClick={() => setIsMenuOpen(!isMenuOpen)} className="text-[#0052CC] p-2 relative z-30">{isMenuOpen ? <X size={24} /> : <Menu size={24} />}</button>
                </div>
            </div>
        </div >
        {isMenuOpen && (
            <div className="lg:hidden bg-white border-t border-gray-100 p-6 animate-in slide-in-from-top-4 text-left relative z-20 h-[calc(100vh-80px)] overflow-y-auto">
                {menus && menus.items && menus.items.map((item) => (
                    <MobileMenuItem key={item.id} item={item} />
                ))}
            </div>
        )}
    </nav >
);

const SiteLayout = ({ children }) => {
    const [isMenuOpen, setIsMenuOpen] = useState(false);
    const [isSearchOpen, setIsSearchOpen] = useState(false);
    const { menus } = usePage().props;

    console.log(menus)

    return (
        <div className="min-h-screen bg-white font-sans text-gray-900 overflow-x-hidden flex flex-col">
            <SearchModal isOpen={isSearchOpen} onClose={() => setIsSearchOpen(false)} />

            <TopBar />

            <NavBar
                isMenuOpen={isMenuOpen}
                setIsMenuOpen={setIsMenuOpen}
                menus={menus}
                onSearchOpen={() => setIsSearchOpen(true)}
            />

            {/* MAIN CONTENT */}
            <main className="flex-grow">
                {children}
            </main>

            {/* RODAPÉ */}
            <footer className="bg-[#003D99] pt-16 md:pt-20 pb-8 relative overflow-hidden">
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
                                    { label: "Conselhos", url: "#" },
                                    { label: "Campi e Polos", url: "#" }
                                ]
                            },
                            {
                                title: "Cursos",
                                links: [
                                    { label: "Graduação", url: "#" },
                                    { label: "Pós-Graduação", url: "#" },
                                    { label: "Extensão", url: "#" },
                                    { label: "EAD", url: "#" }
                                ]
                            },
                            {
                                title: "Ensino",
                                links: [
                                    { label: "Biblioteca", url: "/pagina/biblioteca.html" },
                                    { label: "Portal do Aluno", url: "https://sigaa.ueap.edu.br/sigaa/" },
                                    { label: "Calendário", url: "/documentos/calendar" }
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
                                    { label: "Dados Abertos", url: "#" },
                                    { label: "Licitações", url: "https://transparencia.ueap.edu.br/licitacoes" },
                                    { label: "Ouvidoria (e-SIC)", url: "https://ouvamapa.portal.ap.gov.br/" }
                                ]
                            }
                        ].map((section, i) => (
                            <nav key={i} aria-label={`Menu ${section.title}`}>
                                <div className="flex items-center gap-2 mb-4">
                                    <span className="w-4 h-[2px] bg-[#A3E635]"></span>
                                    <h4 className="text-xs font-bold uppercase tracking-widest text-[#A3E635]">
                                        {section.title}
                                    </h4>
                                </div>
                                <ul className="space-y-3 text-sm text-blue-100/70 font-medium">
                                    {section.links.map((link, j) => (
                                        <li key={j}>
                                            <a href={link.url} className="hover:text-white transition-colors">
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
                        <div className="flex flex-col gap-4 max-w-lg">
                            <div className="flex items-center gap-3">
                                <span className="px-2 py-0.5 bg-[#A3E635]/10 border border-[#A3E635]/20 text-[#A3E635] text-[10px] font-bold uppercase tracking-widest rounded-sm">
                                    Desde 2006
                                </span>
                                <img src="/img/nova_logo_white.png" alt="UEAP" className="h-12 lg:h-10 w-auto grayscale brightness-250 contrast-150" onError={(e) => { e.target.src = "/img/nova_logo_white.png"; }} />
                            </div>

                            <h3 className="text-xl text-white font-medium leading-tight">
                                Universidade do Estado do Amapá
                            </h3>

                            <p className="text-blue-100/60 text-sm leading-relaxed">
                                Promovendo educação de qualidade e desenvolvimento sustentável para a região amazônica.
                            </p>
                        </div>

                        {/* Selo MEC */}
                        <a
                            href="https://emec.mec.gov.br/emec/consulta-cadastro/detalhamento/d96957f455f6405d14c6542552b0f6eb/NTcwMQ=="
                            target="_blank"
                            rel="noopener noreferrer"
                            className="group flex items-center gap-4 bg-white/5 p-4 rounded-lg hover:bg-white/10 transition-colors"
                        >
                            <div className="text-right">
                                <p className="text-[10px] font-bold uppercase tracking-widest text-[#A3E635] mb-1">
                                    Credenciada
                                </p>
                                <p className="text-xs text-white font-bold">
                                    Portal e-MEC
                                </p>
                            </div>

                            <div className="bg-white p-1 rounded-sm w-20 h-20 flex items-center justify-center">
                                <img className="max-w-full max-h-full" src="/img/site/banner_mec.png" alt="Selo e-MEC" />
                            </div>
                        </a>
                    </div>

                    {/* ENDEREÇOS */}
                    <section className="mb-12 border-b border-white/5 pb-12" aria-labelledby="footer-enderecos-title">
                        <h5 id="footer-enderecos-title" className="text-[10px] font-bold uppercase tracking-widest text-[#A3E635]/60 mb-6 flex items-center gap-3">
                            <span className="w-8 h-[1px] bg-[#A3E635]/30"></span>
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
                                    <h5 className="text-xs font-bold text-white uppercase tracking-wider mb-1">
                                        {item.nome}
                                    </h5>
                                    <p className="text-xs text-blue-100/50">
                                        {item.end}
                                    </p>
                                </div>
                            ))}
                        </div>
                    </section>

                    {/* BOTTOM */}
                    <div className="flex flex-col md:flex-row justify-between items-center gap-6">
                        <p className="text-blue-100/40 text-[10px] font-bold uppercase tracking-widest">
                            © 2026 UEAP — Desenvolvido pela <span className="text-white">DINFO</span><i className="fa-solid fa-code text-[#A3E635] ml-1"></i>.
                        </p>
                        <div className="flex gap-4">
                            <a
                                href="https://www.youtube.com/channel/UCB6gc6QS_nJmCP5rNBh0kQQ"
                                target="_blank"
                                rel="noopener noreferrer"
                                className="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center hover:bg-[#A3E635] transition-all text-blue-100/40 hover:text-white"
                            >
                                <i className="fa-brands fa-youtube text-sm"></i>
                            </a>
                            <a
                                href="https://www.instagram.com/ueapoficial/"
                                target="_blank"
                                rel="noopener noreferrer"
                                className="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center hover:bg-[#A3E635] transition-all text-blue-100/40 hover:text-white"
                            >
                                <i className="fa-brands fa-instagram text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </footer>

            {/* <AIChatbot /> */}
        </div>
    );
};

export default SiteLayout;

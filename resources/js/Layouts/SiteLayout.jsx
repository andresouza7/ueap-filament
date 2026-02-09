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
                        placeholder="O que você está procurando na UEAP?"
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
                        {['Processo Seletivo 2025', 'Calendário Acadêmico', 'Editais Proace', 'Matrícula Online', 'Bolsas Pibex'].map(tag => (
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
    <div className="bg-[#0052CC] text-white py-1.5 px-6 border-b border-white/5">
        <div className="max-w-7xl mx-auto px-4 flex justify-between items-center">
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
                        className="flex-1 flex items-center justify-between text-left text-sm font-black text-[#0052CC] uppercase tracking-widest"
                    >
                        {item.name}
                        <ChevronDown size={16} className={`transition-transform duration-300 ${isOpen ? 'rotate-180' : ''}`} />
                    </button>
                ) : (
                    <a href={resolveUrl(item.url)} className="block w-full text-sm font-black text-[#0052CC] uppercase tracking-widest">
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
                                className="text-xs font-bold text-gray-600 hover:text-[#0052CC] uppercase tracking-widest block py-1"
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
        <div className="absolute inset-0 bg-gray-100/90 backdrop-blur-md shadow-md z-20 pointer-events-none"></div>
        <div className="max-w-7xl mx-auto px-4 relative">
            <div className="flex justify-between h-20">
                <div className="flex items-center">
                    <Link href={route('site.home')} className="flex items-center gap-4 transition-all hover:translate-x-1 group text-left relative z-30">
                        <img src="/img/site/logo.png" alt="Brasão UEAP" className="h-14 w-auto object-contain" onError={(e) => { e.target.src = "https://ueap.edu.br/img/nova_logo_black.png"; e.target.className = "h-10 w-auto object-contain opacity-20 grayscale"; }} />
                        <div className="-ml-4">
                            {/* Fonte Inter aplicada e cores ajustadas para quebrar o excesso de azul */}
                            <h1 className="text-green-800/85 font-black text-2xl leading-none uppercase font-sans">
                                UEAP
                            </h1>
                            <p className="text-[7px] md:text-[8px] font-medium text-gray-500 uppercase tracking-widest leading-tight mt-0.5">
                                Universidade do <br />
                                <span className="text-gray-800 font-bold">Estado do Amapá</span>
                            </p>
                        </div>
                    </Link>
                </div>
                <div className="hidden lg:flex items-center space-x-8">
                    {menus && menus.items && menus.items.length > 0 ? menus.items.map((item) => {
                        const hasSubMenu = item.sub_itens && item.sub_itens.length > 0;
                        return (
                            <div key={item.id} className="relative group h-full flex items-center">
                                {hasSubMenu ? (
                                    <>
                                        <button className="text-gray-800 hover:text-[#0052CC] font-bold text-[11px] uppercase tracking-[0.1em] transition-all relative py-8 z-30">
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
                                        className="text-gray-800 hover:text-[#0052CC] font-bold text-[11px] uppercase tracking-[0.1em] transition-all relative py-8 z-30 flex items-center"
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

                    <div className="h-6 w-px bg-gray-200 relative z-30"></div>
                    <button onClick={onSearchOpen} className="text-[#0052CC] hover:text-[#A3E635] transition-transform hover:scale-110 p-2 relative z-30"><Search size={20} /></button>
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
            <footer className="bg-white pt-24 pb-12 border-t border-gray-100">
                <div className="max-w-7xl mx-auto px-4">
                    <div className="grid grid-cols-1 md:grid-cols-4 gap-16 mb-24 text-center md:text-left">
                        <div className="md:col-span-1 flex flex-col items-center md:items-start">
                            <div className="flex items-center gap-3 mb-8 grayscale opacity-70">
                                <img src="/img/site/logo.png" alt="UEAP" className="h-10 w-auto" onError={(e) => { e.target.src = "https://ueap.edu.br/img/nova_logo_black.png"; }} />
                                <h4 className="font-bold text-gray-800 text-lg tracking-tighter">UEAP</h4>
                            </div>
                            <p className="text-[9px] text-gray-400 font-bold uppercase tracking-[0.2em] leading-loose max-w-[200px]">
                                UNIVERSIDADE DO ESTADO DO AMAPÁ — FORMANDO PROFISSIONAIS PARA O DESENVOLVIMENTO DA AMAZÔNIA.
                            </p>
                        </div>

                        {[
                            { title: "INSTITUCIONAL", links: ["HISTÓRICO", "REITORIA", "CAMPI", "TRANSPARÊNCIA"] },
                            { title: "SISTEMAS", links: ["WEBMAIL", "SIGAA", "BIBLIOTECA", "EDITAIS"] },
                            { title: "CONTATO", links: ["FALE CONOSCO", "LOCALIZAÇÃO", "OUVIDORIA"] }
                        ].map((col, i) => (
                            <div key={i}>
                                <h5 className="font-bold text-[#0052CC] uppercase mb-8 text-[10px] tracking-[0.2em]">{col.title}</h5>
                                <ul className="space-y-4">
                                    {col.links.map(link => (
                                        <li key={link}>
                                            <a href="#" className="text-[10px] font-bold text-gray-400 uppercase hover:text-[#0052CC] transition-colors tracking-widest relative group">
                                                {link}
                                                <span className="absolute -bottom-1 left-0 w-0 h-[1px] bg-[#A3E635] transition-all group-hover:w-full"></span>
                                            </a>
                                        </li>
                                    ))}
                                </ul>
                            </div>
                        ))}
                    </div>

                    <div className="pt-10 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center text-[9px] text-gray-300 font-bold uppercase tracking-[0.4em]">
                        <p>© 2026 UEAP — SECRETARIA DE TECNOLOGIA DA INFORMAÇÃO</p>
                        <div className="mt-6 md:mt-0 flex gap-8">
                            <a href="#" className="hover:text-[#0052CC] transition-colors">POLÍTICA DE PRIVACIDADE</a>
                            <a href="#" className="hover:text-[#0052CC] transition-colors">TERMOS DE USO</a>
                        </div>
                    </div>
                </div>
            </footer>

            <AIChatbot />
        </div>
    );
};

export default SiteLayout;

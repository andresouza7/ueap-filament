import React from 'react';
import { Menu, X, Search, ChevronDown } from 'lucide-react';
import { Link } from '@inertiajs/react';
import { route } from 'ziggy-js';
import { resolveUrl } from './utils';
import MobileMenuItem from './MobileMenuItem';

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
                            <p className="text-[7px] md:text-[8px] font-medium text-contrast-body uppercase tracking-widest leading-tight mt-0.5">
                                Universidade do <br />
                                <span className="text-contrast-heading font-bold">Estado do Amapá</span>
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
                                            <button className="text-contrast-heading hover:text-ueap-primary font-bold text-[11px] uppercase tracking-[0.1em] transition-all relative py-8 px-2 z-30">
                                                {item.name}
                                                <span className="absolute bottom-6 left-0 w-0 h-0.5 bg-ueap-accent transition-all group-hover:w-full"></span>
                                            </button>

                                            <div className="absolute top-[65%] left-0 w-64 bg-white shadow-2xl py-4 pt-10 hidden group-hover:block animate-in fade-in slide-in-from-top-2 z-10">
                                                {item.sub_itens.map(subItem => (
                                                    <a
                                                        key={subItem.id}
                                                        href={resolveUrl(subItem.url)}
                                                        className="px-6 py-3 text-[10px] font-bold text-contrast-body hover:text-ueap-primary hover:bg-gray-50 uppercase tracking-widest transition-colors flex items-center gap-2 border-l-2 border-transparent hover:border-ueap-accent"
                                                    >
                                                        {subItem.name}
                                                    </a>
                                                ))}
                                            </div>
                                        </>
                                    ) : (
                                        <a
                                            href={resolveUrl(item.url)}
                                            className="text-contrast-heading hover:text-ueap-primary font-bold text-[11px] uppercase tracking-[0.1em] transition-all relative py-8 px-2 z-30 flex items-center"
                                        >
                                            {item.name}
                                            <span className="absolute bottom-6 left-0 w-0 h-0.5 bg-ueap-accent transition-all group-hover:w-full"></span>
                                        </a>
                                    )}
                                </div>
                            );
                        }) : (
                            <span className="text-xs text-contrast-muted relative z-30">Carregando menu...</span>
                        )}
                    </div>

                    <div className="flex items-center gap-2">
                        <div className="h-6 w-px bg-gray-200 relative z-30"></div>
                        <button onClick={onSearchOpen} className="text-ueap-primary hover:text-ueap-accent transition-transform hover:scale-110 p-2 relative z-30"><Search size={20} /></button>
                    </div>
                </div>
                <div className="flex lg:hidden items-center gap-4">
                    <button onClick={onSearchOpen} className="text-ueap-primary p-2 relative z-30"><Search size={22} /></button>
                    <button onClick={() => setIsMenuOpen(!isMenuOpen)} className="text-ueap-primary p-2 relative z-30">{isMenuOpen ? <X size={24} /> : <Menu size={24} />}</button>
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

export default NavBar;

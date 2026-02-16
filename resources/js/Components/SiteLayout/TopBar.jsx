import React from 'react';

const TopBar = ({ onSearchOpen }) => (
    <div className="bg-ueap-primary text-ueap-secondary py-1.5 px-2 md:px-6 border-b border-white/5">
        <div className="max-w-7xl mx-auto px-4 flex justify-end md:justify-between items-center">
            {/* Menu de Acessibilidade */}
            <nav className="hidden md:flex items-center gap-3 md:gap-4 text-[8px] md:text-[9px] font-bold uppercase tracking-[0.05em] text-ueap-secondary/70" aria-label="Menu de Acessibilidade">
                <a href="#main-content" accessKey="1" className="hover:text-ueap-secondary transition-colors" title="Ir para o conteúdo (Alt+1)">
                    Ir para o conteúdo <span className="bg-white/10 px-1 rounded text-[7px] ml-0.5">1</span>
                </a>
                <a href="#main-navigation" accessKey="2" className="hover:text-ueap-secondary transition-colors" title="Ir para o menu (Alt+2)">
                    Ir para o menu <span className="bg-white/10 px-1 rounded text-[7px] ml-0.5">2</span>
                </a>
                <button onClick={onSearchOpen} accessKey="3" className="hover:text-ueap-secondary transition-colors uppercase cursor-pointer" title="Ir para a busca (Alt+3)">
                    Ir para a busca <span className="bg-white/10 px-1 rounded text-[7px] ml-0.5">3</span>
                </button>
                <a href="#main-footer" accessKey="4" className="hover:text-ueap-secondary transition-colors" title="Ir para o rodapé (Alt+4)">
                    Ir para o rodapé <span className="bg-white/10 px-1 rounded text-[7px] ml-0.5">4</span>
                </a>
            </nav>

            <nav className="flex gap-4 items-center pl-4 border-l border-white/10">
                <a href="https://sigaa.ueap.edu.br/sigaa/" target="_blank" rel="noopener noreferrer" className="text-[9px] font-bold hover:text-ueap-accent transition-colors uppercase tracking-[0.15em] opacity-90">SIGAA</a>
                <a href="http://intranet.ueap.edu.br/" target="_blank" rel="noopener noreferrer" className="text-[9px] font-bold hover:text-ueap-accent transition-colors uppercase tracking-[0.15em] opacity-90">Intranet</a>
                <a href="http://transparencia.ueap.edu.br/" target="_blank" rel="noopener noreferrer" className="text-[9px] font-bold hover:text-ueap-accent transition-colors uppercase tracking-[0.15em] opacity-90">Transparência</a>
                <a href="https://servicedesk.ueap.edu.br/" target="_blank" rel="noopener noreferrer" className="text-[9px] font-bold hover:text-ueap-accent transition-colors uppercase tracking-[0.15em] opacity-90">Service Desk</a>
            </nav>
        </div>
    </div>
);

export default TopBar;

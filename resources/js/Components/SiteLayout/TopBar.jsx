import React from 'react';

const TopBar = () => (
    <div className="bg-ueap-primary text-ueap-secondary py-1.5 px-2 md:px-6 border-b border-white/5">
        <div className="max-w-7xl mx-auto px-4 flex justify-end md:justify-between items-center">
            {/* Texto alinhado à esquerda conforme solicitado */}
            <span className="hidden md:inline-block text-[9px] font-bold uppercase tracking-[0.15em] opacity-70">Portal Institucional</span>

            <nav className="flex gap-4 items-center">
                <a href="https://sigaa.ueap.edu.br/sigaa/" target="_blank" rel="noopener noreferrer" className="text-[9px] font-bold hover:text-ueap-accent transition-colors uppercase tracking-[0.15em] opacity-90">SIGAA</a>
                <a href="http://intranet.ueap.edu.br/" target="_blank" rel="noopener noreferrer" className="text-[9px] font-bold hover:text-ueap-accent transition-colors uppercase tracking-[0.15em] opacity-90">Intranet</a>
                <a href="http://transparencia.ueap.edu.br/" target="_blank" rel="noopener noreferrer" className="text-[9px] font-bold hover:text-ueap-accent transition-colors uppercase tracking-[0.15em] opacity-90">Transparência</a>
                <a href="https://servicedesk.ueap.edu.br/" target="_blank" rel="noopener noreferrer" className="text-[9px] font-bold hover:text-ueap-accent transition-colors uppercase tracking-[0.15em] opacity-90">Service Desk</a>
            </nav>
        </div>
    </div>
);

export default TopBar;

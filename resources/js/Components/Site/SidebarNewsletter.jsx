import React from 'react';
import { Mail } from 'lucide-react';

const SidebarNewsletter = () => {
    return (
        <div className="bg-[#0052CC] p-8 text-white relative overflow-hidden">
            <div className="absolute -top-4 -right-4 opacity-10">
                <Mail size={80} />
            </div>
            <h3 className="text-lg font-bold uppercase tracking-tighter mb-2 relative z-10">Newsletter</h3>
            <p className="text-[10px] text-white/70 font-bold uppercase tracking-wider mb-6 relative z-10">Receba atualizações oficiais</p>
            <div className="space-y-3 relative z-10">
                <input type="email" placeholder="Seu e-mail" className="w-full px-4 py-3 bg-white/10 border border-white/20 text-xs focus:outline-none focus:bg-white focus:text-[#0052CC] transition-all placeholder:text-white/50" />
                <button className="w-full bg-[#A3E635] text-[#0052CC] py-3 text-[10px] font-bold uppercase tracking-widest hover:bg-white transition-colors">Inscrever</button>
            </div>
        </div>
    );
};

export default SidebarNewsletter;

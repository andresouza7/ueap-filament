import React from 'react';

const SidebarCategories = () => {
    return (
        <div>
            <h3 className="text-xs font-bold text-[#0052CC] uppercase tracking-widest mb-6">Categorias</h3>
            <div className="flex flex-wrap gap-2">
                {['Direito', 'Química', 'Engenharia', 'Artes', 'Editais', 'Processo Seletivo', 'Eventos'].map(cat => (
                    <a key={cat} href="#" className="px-4 py-2 bg-gray-100 hover:bg-[#A3E635] text-[10px] font-bold text-gray-600 hover:text-[#0052CC] uppercase tracking-widest transition-colors rounded-full">
                        {cat}
                    </a>
                ))}
            </div>
        </div>
    );
};

export default SidebarCategories;

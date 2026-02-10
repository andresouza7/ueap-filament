import React from 'react';
import { route } from 'ziggy-js';

const SidebarCategories = ({ categories = [] }) => {
    if (!categories || categories.length === 0) {
        return null;
    }

    return (
        <div>
            <h3 className="text-xs font-bold text-[#0052CC] uppercase tracking-widest mb-6">Assuntos</h3>
            <div className="flex flex-wrap gap-2">
                {categories.map(cat => (
                    <a
                        key={cat.id}
                        href={route('site.post.list', { category: cat.slug })}
                        className="px-4 py-2 bg-gray-100 hover:bg-[#A3E635] text-[10px] font-bold text-gray-600 hover:text-[#0052CC] uppercase tracking-widest transition-colors rounded-full"
                    >
                        {cat.name}
                    </a>
                ))}
            </div>
        </div>
    );
};

export default SidebarCategories;

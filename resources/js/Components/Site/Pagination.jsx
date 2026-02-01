import React from 'react';
import { Link } from '@inertiajs/react';

const Pagination = ({ links, currentPage, lastPage }) => {
    return (
        <div className="mt-16 pt-10 border-t border-gray-50 flex items-center justify-between">
            <span className="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                Página {currentPage} de {lastPage}
            </span>
            <div className="flex gap-2">
                {links.map((link, i) => (
                    <Link
                        key={i}
                        href={link.url || '#'}
                        className={`p-3 border text-xs font-bold transition-all ${link.active
                            ? 'bg-[#0052CC] text-white border-[#0052CC]'
                            : 'border-gray-100 text-gray-500 hover:border-[#0052CC] hover:text-[#0052CC]'
                            } ${!link.url && 'opacity-50 cursor-not-allowed'}`}
                        dangerouslySetInnerHTML={{ __html: link.label }}
                        preserveState
                    />
                ))}
            </div>
        </div>
    );
};

export default Pagination;

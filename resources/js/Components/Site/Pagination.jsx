import React from 'react';
import { Link } from '@inertiajs/react';

const Pagination = ({ links, currentPage, lastPage }) => {
    if (!links || links.length <= 3) return null;

    const translateLabel = (label) => {
        if (label.includes('Previous')) return 'Anterior';
        if (label.includes('Next')) return 'Próximo';
        return label;
    };

    return (
        <div className="mt-16 pt-10flex flex-col items-center gap-4">
            <div className="flex flex-wrap justify-center gap-2">
                {links.map((link, i) => (
                    <Link
                        key={i}
                        href={link.url || '#'}
                        className={`px-4 py-2 border text-[10px] font-bold uppercase tracking-wider transition-all ${link.active
                            ? 'bg-ueap-primary text-ueap-secondary border-ueap-primary'
                            : 'border-gray-100 text-contrast-body hover:border-ueap-primary hover:text-ueap-primary bg-white'
                            } ${!link.url && 'opacity-50 cursor-not-allowed hover:border-gray-100 hover:text-contrast-body'}`}
                        dangerouslySetInnerHTML={{ __html: translateLabel(link.label) }}
                        preserveState
                    />
                ))}
            </div>
            <div className="w-full mt-2 text-center text-[10px] font-bold text-contrast-muted uppercase tracking-widest">
                Página {currentPage} de {lastPage}
            </div>
        </div>
    );
};

export default Pagination;

import React, { useState } from 'react';
import { ChevronDown } from 'lucide-react';
import { resolveUrl } from './utils';

const MobileMenuItem = ({ item }) => {
    const [isOpen, setIsOpen] = useState(false);
    const hasSubMenu = item.sub_itens && item.sub_itens.length > 0;

    return (
        <div className="border-b border-gray-100 last:border-0">
            <div className="flex items-center justify-between py-3">
                {hasSubMenu ? (
                    <button
                        onClick={() => setIsOpen(!isOpen)}
                        className="flex-1 flex items-center justify-between text-left text-sm font-bold text-ueap-primary uppercase tracking-widest"
                    >
                        {item.name}
                        <ChevronDown size={16} className={`transition-transform duration-300 ${isOpen ? 'rotate-180' : ''}`} />
                    </button>
                ) : (
                    <a href={resolveUrl(item.url)} className="block w-full text-sm font-bold text-ueap-primary uppercase tracking-widest">
                        {item.name}
                    </a>
                )}
            </div>

            {hasSubMenu && (
                <div className={`overflow-hidden transition-all duration-300 ${isOpen ? 'max-h-96 mb-3' : 'max-h-0'}`}>
                    <div className="flex flex-col gap-3 pl-4 border-l-2 border-ueap-accent ml-1">
                        {item.sub_itens.map((subItem, idx) => (
                            <a
                                key={idx}
                                href={resolveUrl(subItem.url)}
                                className="text-xs font-medium text-contrast-body hover:text-ueap-primary uppercase tracking-widest block py-1"
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

export default MobileMenuItem;

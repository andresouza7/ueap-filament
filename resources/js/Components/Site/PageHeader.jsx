import React from 'react';
import { Link } from '@inertiajs/react';
import { Home, ChevronRight } from 'lucide-react';
import { route } from 'ziggy-js';

const PageHeader = ({ title, breadcrumbs = [], description }) => {
    return (
        <div className="bg-gray-50 border-b border-gray-100 pt-12 md:pt-20 pb-8 md:pb-16 text-left">
            <div className="max-w-7xl mx-auto px-4">
                <nav className="flex items-center gap-2 text-[10px] font-bold text-contrast-muted uppercase tracking-widest mb-6">
                    <Link href={route('site.home')} className="hover:text-ueap-primary transition-colors flex items-center gap-1">
                        <Home size={12} /> Início
                    </Link>

                    {breadcrumbs.map((crumb, index) => (
                        <React.Fragment key={index}>
                            <ChevronRight size={12} />
                            {crumb.href ? (
                                <Link href={crumb.href} className="hover:text-ueap-primary transition-colors">
                                    {crumb.label}
                                </Link>
                            ) : (
                                <span className={index === breadcrumbs.length - 1 ? "text-ueap-primary" : ""}>
                                    {crumb.label}
                                </span>
                            )}
                        </React.Fragment>
                    ))}
                </nav>
                <h2 className="text-4xl md:text-5xl font-black text-contrast-heading uppercase tracking-tighter mb-4">
                    {title}
                </h2>
                <div className="h-2 w-24 bg-ueap-primary mb-6"></div>
                {description && (
                    <p className="text-contrast-body max-w-4xl text-[13px] lg:text-sm leading-relaxed font-medium">
                        {description}
                    </p>
                )}
            </div>
        </div>
    );
};

export default PageHeader;

import React from 'react';
import SiteLayout from '@/Layouts/SiteLayout';
import SidebarSearch from '@/Components/Site/SidebarSearch';
import SidebarNews from '@/Components/Site/SidebarNews';
import SidebarNewsletter from '@/Components/Site/SidebarNewsletter';
import SidebarCategories from '@/Components/Site/SidebarCategories';

const SidebarLayout = ({ children, menu, recentNews, header, bottom, sidebar }) => {
    return (
        <SiteLayout>
            {header && (
                <div className="w-full mb-12">
                    {header}
                </div>
            )}
            <div className="max-w-7xl mx-auto px-4 py-6 md:py-12">
                <div className="flex flex-col lg:flex-row gap-12">
                    {/* Main Content Area */}
                    <main className="lg:w-2/3">
                        {children}
                    </main>

                    {/* Sidebar Area */}
                    <aside className="lg:w-1/3">
                        {sidebar ? (
                            sidebar
                        ) : menu ? (
                            /* Page Menu Navigation */
                            <nav className="space-y-2">
                                <h4 className="text-[9px] font-black text-slate-400 uppercase tracking-[0.3em] mb-4">
                                    Nesta Seção
                                </h4>
                                {menu.items && menu.items.length > 0 ? (
                                    menu.items.map((item, index) => {
                                        const isActive = window.location.href === item.url;
                                        return (
                                            <a
                                                key={index}
                                                href={'/' + item.url}
                                                className={`group flex items-center justify-between px-4 py-3 rounded-lg border transition-all ${isActive
                                                    ? 'bg-[#0052CC] border-[#0052CC] text-white shadow-md'
                                                    : 'bg-gray-50 border-gray-100 text-gray-800 hover:border-[#A3E635] hover:bg-white hover:shadow-sm'
                                                    }`}
                                            >
                                                <span className="text-[10px] font-bold uppercase tracking-wide">
                                                    {item.name}
                                                </span>
                                                <div
                                                    className={`w-6 h-6 rounded-full flex items-center justify-center transition-all shrink-0 ml-2 ${isActive
                                                        ? 'bg-[#A3E635]'
                                                        : 'bg-white shadow-sm group-hover:bg-[#A3E635]'
                                                        }`}
                                                >
                                                    <svg
                                                        className={`w-2.5 h-2.5 ${isActive ? 'text-[#0052CC]' : 'text-gray-600 group-hover:text-[#0052CC]'}`}
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            strokeLinecap="round"
                                                            strokeLinejoin="round"
                                                            strokeWidth={2.5}
                                                            d="M9 5l7 7-7 7"
                                                        />
                                                    </svg>
                                                </div>
                                            </a>
                                        );
                                    })
                                ) : (
                                    <p className="text-xs text-gray-500">Nenhum item disponível.</p>
                                )}
                            </nav>
                        ) : (
                            <div className="space-y-12">
                                <SidebarSearch />
                                <SidebarNews recentNews={recentNews} />
                                <SidebarNewsletter />
                                <SidebarCategories />
                            </div>
                        )}
                    </aside>
                </div>

                {bottom && (
                    <div className="w-full">
                        {bottom}
                    </div>
                )}
            </div>
        </SiteLayout>
    );
};

export default SidebarLayout;

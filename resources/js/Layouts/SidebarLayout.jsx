import React from 'react';
import SiteLayout from '@/Layouts/SiteLayout';
import DefaultSidebar from '@/Components/Site/DefaultSidebar';

const SidebarLayout = ({ children, menu, recentNews }) => {
    return (
        <SiteLayout>
            <div className="max-w-7xl mx-auto px-4 py-12 md:py-20">

                <div className="flex flex-col lg:flex-row gap-12">
                    {/* Main Content Area */}
                    <main className="lg:w-2/3">
                        {children}
                    </main>

                    {/* Sidebar Area */}
                    <aside className="lg:w-1/3">
                        {menu ? (
                            /* Placeholder for future menu implementation */
                            <div className="bg-gray-50 p-6 border-l-4 border-[#0052CC]">
                                <h3 className="text-xs font-bold text-[#0052CC] uppercase tracking-widest mb-4">Menu</h3>
                                <div className="space-y-2">
                                    {/* Render menu items here in future */}
                                    <p className="text-sm text-gray-500">Menu content goes here.</p>
                                </div>
                            </div>
                        ) : (
                            <DefaultSidebar recentNews={recentNews} />
                        )}
                    </aside>
                </div>
            </div>
        </SiteLayout>
    );
};

export default SidebarLayout;

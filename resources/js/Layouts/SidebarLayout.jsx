import React from 'react';
import SiteLayout from '@/Layouts/SiteLayout';
import SidebarSearch from '@/Components/Site/SidebarSearch';
import SidebarNewsletter from '@/Components/Site/SidebarNewsletter';

const PageMenu = ({ menu, mobile = false }) => {
    const [isDrawerOpen, setIsDrawerOpen] = React.useState(false);
    const currentMenuItem = menu?.items?.find(item => window.location.pathname.includes(item.url));

    if (!menu || !menu.items) return null;

    if (mobile) {
        return (
            <div className="lg:hidden mb-6 sticky top-20 z-30">
                <button
                    onClick={() => setIsDrawerOpen(!isDrawerOpen)}
                    className="w-full bg-ueap-primary text-ueap-secondary p-4 rounded-lg shadow-lg flex items-center justify-between font-bold uppercase text-xs tracking-widest"
                >
                    <span>{currentMenuItem ? currentMenuItem.name : 'Nesta Seção'}</span>
                    <span className={`transform transition-transform ${isDrawerOpen ? 'rotate-180' : ''}`}>▼</span>
                </button>

                {/* Mobile Drawer */}
                <div className={`absolute top-full left-0 w-full bg-white shadow-xl border border-gray-100 rounded-b-lg transition-all duration-300 origin-top z-40 ${isDrawerOpen ? 'max-h-[60vh] overflow-y-auto opacity-100' : 'max-h-0 overflow-hidden opacity-0 pointer-events-none'}`}>
                    <nav className="flex flex-col p-2">
                        {menu.items.map((item, index) => {
                            const isActive = window.location.pathname.includes(item.url);
                            return (
                                <a
                                    key={index}
                                    href={'/' + item.url}
                                    className={`py-3 px-4 border-l-4 transition-colors text-xs font-bold uppercase tracking-wider ${isActive
                                        ? 'border-ueap-accent bg-blue-50 text-ueap-primary'
                                        : 'border-transparent text-contrast-body hover:bg-gray-50'}`}
                                >
                                    {item.name}
                                </a>
                            );
                        })}
                    </nav>
                </div>
            </div>
        );
    }

    return (
        <nav className="space-y-2 sticky top-24 max-w-xs">
            <h4 className="text-[9px] font-black text-slate-400 uppercase tracking-[0.3em] mb-4">
                Nesta Seção
            </h4>
            {menu.items.length > 0 ? (
                menu.items.map((item, index) => {
                    const isActive = window.location.pathname.includes(item.url);
                    return (
                        <a
                            key={index}
                            href={'/' + item.url}
                            className={`group relative flex items-center justify-between py-2 px-3 border-l-[3px] transition-all hover:bg-gray-50 hover:pl-4 ${isActive
                                ? 'border-ueap-primary text-ueap-primary bg-blue-50 font-black'
                                : 'border-transparent text-contrast-body font-bold hover:border-ueap-accent hover:text-contrast-primary'
                                }`}
                        >
                            <span className="text-[11px] uppercase tracking-wider">
                                {item.name}
                            </span>
                        </a>
                    );
                })
            ) : (
                <p className="text-xs text-contrast-body">Nenhum item disponível.</p>
            )}
        </nav>
    );
};

const SidebarLayout = ({ children, menu, header, sidebar }) => {
    return (
        <SiteLayout>
            {header && (
                <div className="w-full mb-2 md:mb-12">
                    {header}
                </div>
            )}
            <div className="max-w-7xl mx-auto px-4 py-6 md:py-12 relative">

                {/* Mobile Menu Toggle (Only if menu exists) */}
                {menu && <PageMenu menu={menu} mobile />}

                <div className="flex flex-col lg:flex-row gap-12">
                    {/* Main Content Area */}
                    <main className="lg:w-2/3">
                        {children}
                    </main>

                    {/* Sidebar Area (Desktop Only for Menu) */}
                    <aside className={`lg:w-1/3 ${menu ? 'hidden lg:block' : ''}`}>
                        {menu ? (
                            <PageMenu menu={menu} />
                        ) : sidebar ? (
                            sidebar
                        ) : (
                            <div className="space-y-12">
                                <SidebarSearch />
                                <SidebarNewsletter />
                            </div>
                        )}
                    </aside>
                </div>

            </div>
        </SiteLayout>
    );
};

export default SidebarLayout;

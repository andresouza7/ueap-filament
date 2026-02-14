import React from 'react';
import SiteLayout from '@/Layouts/SiteLayout';
import { Head, Link, usePage } from '@inertiajs/react';
import { Home, ChevronRight, Search, FileText, Eye, Download } from 'lucide-react';
import SidebarNewsletter from '../Components/Site/SidebarNewsletter';
import SidebarCategories from '../Components/Site/SidebarCategories';
import Pagination from '@/Components/Site/Pagination';

const DocumentList = ({ title = "Documentos e Publicações", documents = [], onNavigate }) => {
    // Handle pagination data if provided by Laravel
    const docs = documents.data ? documents.data : documents;
    const links = documents.links ? documents.links : [];

    const { latestPosts, categories } = usePage().props;

    // Search State
    const [searchTerm, setSearchTerm] = React.useState(new URLSearchParams(window.location.search).get('search') || '');

    const handleNavigate = (page) => {
        if (onNavigate) onNavigate(page);
        else window.location.href = route('site.home');
    }

    const handleSearch = () => {
        const url = new URL(window.location.href);
        if (searchTerm) {
            url.searchParams.set('search', searchTerm);
        } else {
            url.searchParams.delete('search');
        }
        url.searchParams.set('page', '1'); // Reset to page 1
        window.location.href = url.toString();
    };

    return (
        <SiteLayout>
            <Head title={title} />
            <div className="font-sans">
                {/* Cabeçalho da Página */}
                <div className="bg-gray-50 border-b border-gray-100 pt-12 md:pt-20 pb-8 md:pb-12 text-left">
                    <div className="max-w-7xl mx-auto px-4">
                        <nav className="flex items-center gap-2 text-[10px] font-bold text-contrast-muted uppercase tracking-widest mb-6">
                            <button onClick={() => handleNavigate('home')} className="hover:text-ueap-primary transition-colors flex items-center gap-1"><Home size={12} /> Home</button>
                            <ChevronRight size={12} />
                            <span className="text-ueap-primary">Repositório Digital</span>
                        </nav>
                        <h2 className="text-4xl md:text-5xl font-black text-contrast-heading uppercase tracking-tighter mb-4">{title}</h2>
                        <div className="h-2 w-24 bg-ueap-primary/80"></div>
                    </div>
                </div>

                <div className="max-w-7xl mx-auto px-4 py-12 md:py-16 text-left">
                    <div className="flex flex-col lg:flex-row gap-16">

                        {/* LISTAGEM DE DOCUMENTOS */}
                        <main className="lg:w-2/3">
                            {/* Filtros Simples */}
                            <div className="mb-12 flex flex-col md:flex-row gap-4">
                                <div className="flex-1 relative">
                                    <input
                                        type="text"
                                        placeholder="Filtrar por nome do documento..."
                                        className="w-full pl-12 pr-4 py-4 bg-gray-50 border-none text-xs font-bold uppercase placeholder:normal-case focus:ring-1 focus:ring-ueap-primary transition-all rounded-none"
                                        value={searchTerm}
                                        onChange={(e) => setSearchTerm(e.target.value)}
                                        onKeyDown={(e) => e.key === 'Enter' && handleSearch()}
                                    />
                                    <Search className="absolute left-4 top-4 text-ueap-primary" size={18} />
                                </div>
                                <button onClick={handleSearch} className="bg-ueap-primary text-ueap-secondary px-8 py-4 font-black text-[10px] uppercase tracking-widest hover:bg-ueap-accent hover:text-ueap-primary transition-all rounded-none shadow-lg">Buscar</button>
                            </div>

                            <div className="space-y-0 border-t border-gray-100">
                                {docs.length > 0 ? docs.map((doc, idx) => (
                                    <div key={idx} className="group flex items-center gap-4 py-3 px-4 border-b border-gray-100 hover:bg-gray-50 transition-all cursor-pointer">
                                        <div className="w-10 h-10 bg-gray-50 flex items-center justify-center text-ueap-primary shrink-0 group-hover:bg-ueap-accent transition-colors rounded-sm">
                                            <FileText size={20} />
                                        </div>
                                        <div className="flex-1">
                                            <div className="flex items-center gap-3 mb-1">
                                                {doc.category && <div>
                                                    <span className="text-[9px] font-black text-ueap-primary uppercase tracking-widest">{doc.category}</span>
                                                    <span className="w-1 h-1 bg-gray-300 rounded-full"></span>
                                                </div>}
                                                <span className="text-[9px] font-bold text-contrast-muted uppercase tracking-widest">{doc.date || '-'}</span>
                                            </div>
                                            <h3 className="text-sm font-semibold text-contrast-heading group-hover:text-ueap-primary transition-colors tracking-normal leading-snug">
                                                {doc.url ? (
                                                    <a href={doc.url} target="_blank" rel="noopener noreferrer">
                                                        {doc.title}
                                                    </a>
                                                ) : doc.title}
                                            </h3>
                                        </div>
                                        <div className="hidden md:flex items-center gap-4">
                                            {doc.url && (
                                                <a href={doc.url} download className="p-2 text-contrast-subtle hover:text-ueap-accent transition-colors" title="Baixar PDF"><Download size={20} /></a>
                                            )}
                                        </div>
                                    </div>
                                )) : (
                                    <div className="text-center py-10 text-contrast-body">Nenhum documento encontrado.</div>
                                )}
                            </div>

                            {/* Paginação Documentos */}
                            <div className="mt-12">
                                <Pagination links={links} currentPage={documents.current_page} lastPage={documents.last_page} />
                            </div>
                        </main>

                        {/* SIDEBAR DIREITA */}
                        <aside className="lg:w-1/3 space-y-16">
                            <div className="p-8 bg-gray-50 border-l-4 border-ueap-accent rounded-none">
                                <h3 className="text-xs font-black text-ueap-primary uppercase tracking-widest mb-4">Ajuda</h3>
                                <p className="text-[10px] font-bold text-contrast-body uppercase leading-relaxed">Não encontrou o documento? Sugerimos entrar em contato diretamente com o setor responsável.</p>
                            </div>
                            <SidebarCategories categories={categories} />
                        </aside>
                    </div>
                </div>
            </div>
        </SiteLayout>
    );
};

export default DocumentList;

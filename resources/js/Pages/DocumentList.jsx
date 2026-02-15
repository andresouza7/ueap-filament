import React from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import PageHeader from '@/Components/Site/PageHeader';
import { Head, Link, usePage } from '@inertiajs/react';
import { Search, FileText, Download } from 'lucide-react';
import SidebarCategories from '../Components/Site/SidebarCategories';
import Pagination from '@/Components/Site/Pagination';

const DocumentList = ({ title = "Documentos e Publicações", documents = [], onNavigate }) => {
    // Handle pagination data if provided by Laravel
    const docs = documents.data ? documents.data : documents;
    const links = documents.links ? documents.links : [];

    // Search State
    const [searchTerm, setSearchTerm] = React.useState(new URLSearchParams(window.location.search).get('search') || '');
    const [selectedYear, setSelectedYear] = React.useState(new URLSearchParams(window.location.search).get('year') || '');

    // Generate last 10 years
    const currentYear = new Date().getFullYear();
    const years = Array.from({ length: 11 }, (_, i) => currentYear - i);

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
        if (selectedYear) {
            url.searchParams.set('year', selectedYear);
        } else {
            url.searchParams.delete('year');
        }

        url.searchParams.set('page', '1'); // Reset to page 1
        window.location.href = url.toString();
    };

    const headerContent = (
        <PageHeader
            title={title}
            breadcrumbs={[{ label: 'Repositório Digital' }]}
            description="Acesse documentos oficiais e outras publicações da universidade. Nosso repositório digital garante transparência e fácil acesso à informação."
        />
    );

    // Sidebar Content
    const sidebarContent = (
        <div className="space-y-16">
            <div className="p-8 bg-gray-50 border-l-4 border-ueap-accent rounded-none">
                <h3 className="text-xs font-black text-ueap-primary uppercase tracking-widest mb-4">Ajuda</h3>
                <p className="text-[10px] font-bold text-contrast-body uppercase leading-relaxed">Não encontrou o documento? Sugerimos entrar em contato diretamente com o setor responsável.</p>
            </div>
            <SidebarCategories />
        </div>
    );

    return (
        <SidebarLayout header={headerContent} sidebar={sidebarContent}>
            <Head>
                <title>{title}</title>
                <meta name="description" content={`Acesse ${title} da UEAP. Documentos, portarias, editais e publicações oficiais.`} />

                <meta property="og:type" content="website" />
                <meta property="og:title" content={`${title} - UEAP`} />
                <meta property="og:description" content={`Consulte ${title} e outros documentos oficiais da Universidade do Estado do Amapá.`} />
                <meta property="og:url" content={window.location.href} />
                <meta property="og:image" content="https://ueap.edu.br/img/nova_logo_black.png" />

                <meta property="twitter:card" content="summary" />
                <meta property="twitter:title" content={`${title} - UEAP`} />
                <meta property="twitter:description" content={`Acesse documentos e publicações da UEAP: ${title}.`} />
            </Head>
            <div className="font-sans">

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

                    <div className="w-full md:w-48">
                        <select
                            value={selectedYear}
                            onChange={(e) => setSelectedYear(e.target.value)}
                            className="w-full h-full pl-4 pr-8 py-4 bg-gray-50 border-none text-xs font-bold uppercase text-contrast-body focus:ring-1 focus:ring-ueap-primary transition-all rounded-none appearance-none cursor-pointer"
                        >
                            <option value="">Todos os anos</option>
                            {years.map(year => (
                                <option key={year} value={year}>{year}</option>
                            ))}
                        </select>
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

            </div>
        </SidebarLayout>
    );
};

export default DocumentList;

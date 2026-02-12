import React, { cloneElement, useState } from 'react';
import SidebarLayout from '@/Layouts/SidebarLayout';
import SidebarNews from '@/Components/Site/SidebarNews';
import SidebarNewsletter from '@/Components/Site/SidebarNewsletter';
import SidebarCategories from '@/Components/Site/SidebarCategories';
import {
    Home, ChevronRight, ArrowRight,
    Sprout,
    Droplets,
    Waves,
    FlaskConical,
    HardHat,
    Book,
    Users,
    Music,
    Calculator,
    Scale,
    Briefcase,
    PenTool,
    GraduationCap
} from 'lucide-react';
import { Link } from '@inertiajs/react';
import { route } from 'ziggy-js';

const CourseList = ({ slug, cursos, categories, latestPosts }) => {
    const [busca, setBusca] = useState('');
    const normalizedSlug = slug?.toLowerCase();
    const title = normalizedSlug === 'graduacao' ? 'Cursos de Graduação' : (normalizedSlug === 'ext' ? 'Cursos de Extensão' : 'Pós-Graduação');

    const description = normalizedSlug === 'graduacao'
        ? "Explore nossos cursos de graduação e inicie sua jornada acadêmica na UEAP. Oferecemos formações sólidas que preparam profissionais capacitados para enfrentar os desafios do mercado de trabalho e contribuir com o desenvolvimento científico e social da nossa região."
        : normalizedSlug === 'ext'
            ? "Programas e projetos de extensão da UEAP que promovem a interação entre a universidade e a sociedade. Através de cursos, eventos e prestação de serviços, buscamos compartilhar o conhecimento e fortalecer os vínculos com a comunidade local."
            : "Nossos programas de pós-graduação visam o aperfeiçoamento profissional e a produção de conhecimento avançado. Com foco na pesquisa e inovação, buscamos a excelência acadêmica para transformar a realidade da Amazônia e do Brasil.";

    // Adapt latestPosts for the sidebar (follow PostList pattern)
    const recentNews = latestPosts?.map(p => ({
        id: p.id,
        title: p.title,
        image_url: p.image_url,
        date: p.created_at ? new Date(p.created_at).toLocaleDateString() : "Recente",
        slug: p.slug
    })) || [];

    const headerContent = (
        <div className="bg-gray-50 border-b border-gray-100 pt-12 md:pt-20 pb-8 md:pb-12 text-left">
            <div className="max-w-7xl mx-auto px-4">
                <nav className="flex items-center gap-2 text-[10px] font-bold text-contrast-muted uppercase tracking-widest mb-6">
                    <Link href={route('site.home')} className="hover:text-ueap-primary transition-colors flex items-center gap-1">
                        <Home size={12} /> Início
                    </Link>
                    <ChevronRight size={12} />
                    <span className="text-ueap-primary">{title}</span>
                </nav>
                <h2 className="text-4xl md:text-5xl font-black text-contrast-heading uppercase tracking-tighter mb-4">
                    {title}
                </h2>
                <div className="h-2 w-24 bg-ueap-primary mb-6"></div>
                <p className="text-contrast-body max-w-4xl text-sm leading-relaxed font-medium">
                    {description}
                </p>
            </div>
        </div>
    );

    const sidebarContent = (
        <div className="space-y-12">
            <SidebarNews recentNews={recentNews} />
            <SidebarNewsletter />
            <SidebarCategories categories={categories} />
        </div>
    );

    const getCourseStyle = (name) => {
        const n = name.toLowerCase();

        // ENGENHARIAS E NATUREZA
        if (n.includes('agronômica') || n.includes('florestal') || n.includes('bionorte'))
            return { icon: <Sprout />, color: 'text-emerald-600', bg: 'bg-emerald-50' };
        if (n.includes('ambiental') || n.includes('recursos naturais'))
            return { icon: <Droplets />, color: 'text-cyan-600', bg: 'bg-cyan-50' };
        if (n.includes('pesca'))
            return { icon: <Waves />, color: 'text-blue-500', bg: 'bg-blue-50' };
        if (n.includes('química'))
            return { icon: <FlaskConical />, color: 'text-pink-600', bg: 'bg-pink-50' };
        if (n.includes('segurança do trabalho') || n.includes('produção'))
            return { icon: <HardHat />, color: 'text-orange-600', bg: 'bg-orange-50' };

        // EDUCAÇÃO E HUMANAS
        if (n.includes('letras') || n.includes('literatura') || n.includes('filosofia'))
            return { icon: <Book />, color: 'text-indigo-600', bg: 'bg-indigo-50' };
        if (n.includes('pedagogia') || n.includes('ensino') || n.includes('escolar'))
            return { icon: <Users />, color: 'text-purple-600', bg: 'bg-purple-50' };
        if (n.includes('música'))
            return { icon: <Music />, color: 'text-rose-500', bg: 'bg-rose-50' };
        if (n.includes('matemática'))
            return { icon: <Calculator />, color: 'text-amber-600', bg: 'bg-amber-50' };

        // DIREITO E GESTÃO
        if (n.includes('direito') || n.includes('advocacia'))
            return { icon: <Scale />, color: 'text-slate-700', bg: 'bg-slate-100' };
        if (n.includes('gestão') || n.includes('operações'))
            return { icon: <Briefcase />, color: 'text-blue-700', bg: 'bg-blue-50' };
        if (n.includes('design') || n.includes('inovação'))
            return { icon: <PenTool />, color: 'text-fuchsia-600', bg: 'bg-fuchsia-50' };

        // PADRÃO
        return { icon: <GraduationCap />, color: 'text-contrast-body', bg: 'bg-gray-50' };
    };

    // Filtra os cursos conforme o usuário digita
    const cursosFiltrados = cursos?.filter(curso =>
        curso.name.toLowerCase().includes(busca.toLowerCase())
    );

    return (
        <SidebarLayout recentNews={recentNews} categories={categories} header={headerContent} sidebar={sidebarContent}>
            {/* SEÇÃO DE PESQUISA */}
            <div className="mb-10">
                <div className="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                    <div>
                        <h2 className="text-2xl font-bold text-contrast-heading">Cursos Disponíveis</h2>
                        <p className="text-contrast-body text-sm">Explore nossa lista completa de cursos</p>
                    </div>

                    <div className="relative group w-full md:w-96">
                        <i className="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-contrast-muted group-focus-within:text-blue-600 transition-colors"></i>
                        <input
                            type="text"
                            placeholder="O que você procura?"
                            className="w-full pl-12 pr-4 py-3 bg-white border border-gray-200 rounded-2xl outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all shadow-sm"
                            value={busca}
                            onChange={(e) => setBusca(e.target.value)}
                        />
                        {busca && (
                            <button
                                onClick={() => setBusca('')}
                                className="absolute right-4 top-1/2 -translate-y-1/2 text-contrast-muted hover:text-red-500"
                            >
                                <i className="fa-solid fa-xmark"></i>
                            </button>
                        )}
                    </div>
                </div>

                {/* Contador de resultados */}
                <div className="text-xs font-bold text-contrast-muted uppercase tracking-widest mb-4">
                    {cursosFiltrados?.length} {cursosFiltrados?.length === 1 ? 'Curso encontrado' : 'Cursos encontrados'}
                </div>
            </div>

            {/* Grid de Cursos */}
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                {cursosFiltrados.length > 0 ? (
                    cursosFiltrados.map((item, index) => {
                        const style = getCourseStyle(item.name);

                        return (
                            <a
                                key={index}
                                href={item.url.startsWith('http') ? item.url : `/${item.url}`}
                                className="group relative bg-white rounded-xl border border-gray-200 p-5 transition-all duration-300 hover:shadow-2xl hover:border-transparent flex flex-col justify-between overflow-hidden"
                            >
                                {/* Indicador lateral colorido */}
                                <div className={`absolute left-0 top-0 bottom-0 w-1 ${style.color.replace('text', 'bg')} opacity-0 group-hover:opacity-100 transition-opacity`} />

                                <div className="flex items-start gap-4 relative z-10">
                                    {/* Ícone com cor dinâmica */}
                                    <div className={`w-14 h-14 shrink-0 rounded-lg ${style.bg} ${style.color} flex items-center justify-center transition-all duration-500 group-hover:scale-110`}>
                                        {cloneElement(style.icon, { size: 28, strokeWidth: 1.5 })}
                                    </div>

                                    <div className="flex-1">

                                        <h3 className="text-base font-semibold text-contrast-heading group-hover:text-ueap-primary transition-colors leading-tight mb-4">
                                            {item.name}
                                        </h3>

                                        <span className="flex items-center gap-1.5 text-xs font-semibold text-contrast-body group-hover:text-ueap-primary transition-all">
                                            Ver detalhes
                                            <ArrowRight size={14} className="group-hover:translate-x-1 transition-transform" />
                                        </span>
                                    </div>
                                </div>

                                {/* Marca d'água sutil no fundo */}
                                <div className={`absolute -right-2 -bottom-2 opacity-0 group-hover:opacity-[0.08] transition-opacity ${style.color}`}>
                                    {cloneElement(style.icon, { size: 70 })}
                                </div>
                            </a>
                        );
                    })) : (
                    <div className="col-span-full py-12 text-center">
                        <p className="text-contrast-muted font-bold uppercase text-[10px] tracking-widest">Nenhum curso encontrado</p>
                    </div>
                )}
            </div>
        </SidebarLayout>
    );
};

export default CourseList;

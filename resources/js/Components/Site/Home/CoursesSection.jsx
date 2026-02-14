import React, { cloneElement } from 'react';
import { Link } from '@inertiajs/react';
import { route } from 'ziggy-js';
import {
    Sprout, Droplets, Waves, FlaskConical, HardHat, Book, Users,
    Music, Calculator, Scale, Briefcase, PenTool, GraduationCap, ArrowRight
} from 'lucide-react';

const CoursesSection = ({ coursesGraduacao, coursesPos }) => {
    const [activeTab, setActiveTab] = React.useState('graduacao');
    const [startIndex, setStartIndex] = React.useState(0);

    const activeCourses = activeTab === 'graduacao' ? coursesGraduacao : coursesPos;
    const itemsPerPage = 4;

    React.useEffect(() => {
        setStartIndex(0);
    }, [activeTab]);

    const handleNext = () => {
        if (startIndex + itemsPerPage < activeCourses.length) {
            setStartIndex(startIndex + itemsPerPage);
        }
    };

    const handlePrev = () => {
        if (startIndex > 0) {
            setStartIndex(Math.max(0, startIndex - itemsPerPage));
        }
    };

    const displayCourses = activeCourses.slice(startIndex, startIndex + itemsPerPage);

    if (!activeCourses || activeCourses.length === 0) return null;

    const getCourseStyle = (name) => {
        const n = name.toLowerCase();
        if (n.includes('agronômica') || n.includes('florestal') || n.includes('bionorte'))
            return { icon: <Sprout />, color: 'text-emerald-600', bg: 'bg-emerald-50', headerBg: 'bg-emerald-600' };
        if (n.includes('ambiental') || n.includes('recursos naturais'))
            return { icon: <Droplets />, color: 'text-cyan-600', bg: 'bg-cyan-50', headerBg: 'bg-cyan-600' };
        if (n.includes('pesca'))
            return { icon: <Waves />, color: 'text-blue-500', bg: 'bg-blue-50', headerBg: 'bg-blue-500' };
        if (n.includes('química'))
            return { icon: <FlaskConical />, color: 'text-pink-600', bg: 'bg-pink-50', headerBg: 'bg-pink-600' };
        if (n.includes('segurança do trabalho') || n.includes('produção'))
            return { icon: <HardHat />, color: 'text-orange-600', bg: 'bg-orange-50', headerBg: 'bg-orange-600' };
        if (n.includes('letras') || n.includes('literatura') || n.includes('filosofia'))
            return { icon: <Book />, color: 'text-indigo-600', bg: 'bg-indigo-50', headerBg: 'bg-indigo-600' };
        if (n.includes('pedagogia') || n.includes('ensino') || n.includes('escolar'))
            return { icon: <Users />, color: 'text-purple-600', bg: 'bg-purple-50', headerBg: 'bg-purple-600' };
        if (n.includes('música'))
            return { icon: <Music />, color: 'text-rose-500', bg: 'bg-rose-50', headerBg: 'bg-rose-500' };
        if (n.includes('matemática'))
            return { icon: <Calculator />, color: 'text-amber-600', bg: 'bg-amber-50', headerBg: 'bg-amber-600' };
        if (n.includes('direito') || n.includes('advocacia'))
            return { icon: <Scale />, color: 'text-slate-700', bg: 'bg-slate-100', headerBg: 'bg-slate-800' };
        if (n.includes('gestão') || n.includes('operações'))
            return { icon: <Briefcase />, color: 'text-blue-700', bg: 'bg-blue-50', headerBg: 'bg-blue-700' };
        if (n.includes('design') || n.includes('inovação'))
            return { icon: <PenTool />, color: 'text-fuchsia-600', bg: 'bg-fuchsia-50', headerBg: 'bg-fuchsia-600' };

        return { icon: <GraduationCap />, color: 'text-gray-600', bg: 'bg-gray-50', headerBg: 'bg-gray-700' };
    };

    return (
        <section className="py-20 md:py-28 bg-gradient-to-br from-[#003B95] via-[#002D72] to-[#001F4D] relative overflow-hidden">
            <div className="absolute right-[-5%] top-1/2 -translate-y-1/2 text-white opacity-[0.04] pointer-events-none select-none">
                <GraduationCap size={700} strokeWidth={0.5} />
            </div>

            <div className="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
                <div className="flex flex-col md:flex-row justify-between items-center md:items-end mb-12 md:mb-16 gap-8">
                    <div className="max-w-2xl text-center md:text-left">
                        <span className="text-blue-400 text-sm font-bold tracking-widest uppercase mb-3 block">Excelência Acadêmica</span>
                        <h3 className="text-3xl md:text-4xl font-black text-white uppercase tracking-tight leading-none">
                            Conheça Nossos Cursos
                        </h3>
                        <div className="h-1.5 w-20 bg-blue-500 mt-4 mx-auto md:mx-0 rounded-full"></div>
                    </div>

                    <div className="flex p-1.5 bg-black/20 backdrop-blur-md rounded-2xl border border-white/10">
                        {['graduacao', 'pos'].map((tab) => (
                            <button
                                key={tab}
                                onClick={() => setActiveTab(tab)}
                                className={`px-6 py-2.5 rounded-xl text-xs md:text-sm font-bold uppercase transition-all duration-300 ${activeTab === tab
                                    ? 'bg-white text-[#003B95] shadow-lg'
                                    : 'text-white/70 hover:text-white hover:bg-white/5'
                                    }`}
                            >
                                {tab === 'graduacao' ? 'Graduação' : 'Pós-Graduação'}
                            </button>
                        ))}
                    </div>
                </div>

                <div className="relative group/carousel">
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                        {displayCourses.map((post, index) => {
                            const style = getCourseStyle(post.name);
                            return (
                                <Link
                                    key={`${activeTab}-${post.id || index}`}
                                    href={post.url && post.url.startsWith('http') ? post.url : `/${post.url}`}
                                    className="group bg-white rounded-xl md:rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 flex flex-row md:flex-col h-full border-2 border-white/10"
                                >
                                    <div className={`w-0 md:w-full h-auto md:h-32 ${style.headerBg} relative overflow-hidden flex items-center px-0 md:px-6 shrink-0`}>
                                        <svg className="hidden md:block absolute right-0 top-0 h-full w-32 text-white opacity-10 transform translate-x-4 skew-x-12" viewBox="0 0 100 100" fill="currentColor">
                                            <rect x="0" y="0" width="100" height="100"></rect>
                                        </svg>

                                        <div className="hidden md:flex w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl items-center justify-center text-white border border-white/10 relative z-10">
                                            {cloneElement(style.icon, { size: 24, strokeWidth: 1.5 })}
                                        </div>

                                        <span className="hidden md:block absolute top-4 right-4 bg-black/20 backdrop-blur-md text-white text-[9px] font-black px-2.5 py-1 rounded-lg uppercase tracking-widest border border-white/10 z-10">
                                            {activeTab === 'graduacao' ? 'Grad' : 'Pós'}
                                        </span>
                                    </div>

                                    <div className="p-5 md:p-7 flex-1 flex flex-col bg-white min-w-0">
                                        <div className="md:hidden flex items-center gap-2 mb-2">
                                            <div className={`${style.color}`}>
                                                {cloneElement(style.icon, { size: 16 })}
                                            </div>
                                            <span className={`text-[9px] font-black uppercase tracking-widest ${style.color}`}>
                                                {activeTab === 'graduacao' ? 'Graduação' : 'Pós-Graduação'}
                                            </span>
                                        </div>

                                        <h3 className="text-base md:text-lg font-bold text-slate-800 leading-tight mb-4 line-clamp-2 md:h-12 group-hover:text-blue-700 transition-colors">
                                            {post.name}
                                        </h3>

                                        <div className="mt-auto pt-3 border-t border-slate-50 flex items-center justify-between">
                                            <span className="text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:text-blue-600 transition-colors">
                                                Detalhes
                                            </span>
                                            <div className={`w-6 h-6 md:w-8 md:h-8 rounded md:rounded-xl ${style.bg} flex items-center justify-center transition-all duration-300 group-hover:rotate-[-45deg]`}>
                                                <ArrowRight className={`w-3.5 h-3.5 md:w-4 md:h-4 ${style.color}`} />
                                            </div>
                                        </div>
                                    </div>
                                </Link>
                            );
                        })}
                    </div>

                    <div className="flex flex-row items-center justify-between mt-10 md:mt-12">
                        <div className="flex gap-2">
                            {Array.from({ length: Math.ceil(activeCourses.length / itemsPerPage) }).map((_, idx) => (
                                <div
                                    key={idx}
                                    className={`h-1.5 rounded-full transition-all duration-500 ${Math.floor(startIndex / itemsPerPage) === idx ? 'w-8 md:w-10 bg-blue-400' : 'w-2 bg-white/20'
                                        }`}
                                />
                            ))}
                        </div>

                        <div className="flex items-center gap-3 md:gap-4">
                            <button onClick={handlePrev} disabled={startIndex === 0} className="p-3 md:p-4 rounded-xl md:rounded-2xl border border-white/20 text-white transition-all disabled:opacity-20">
                                <ArrowRight size={18} className="rotate-180" />
                            </button>
                            <button onClick={handleNext} disabled={startIndex + itemsPerPage >= activeCourses.length} className="p-3 md:p-4 rounded-xl md:rounded-2xl border border-white/20 text-white transition-all disabled:opacity-20">
                                <ArrowRight size={18} />
                            </button>
                        </div>
                    </div>
                </div>

                <div className="mt-12 md:mt-16 flex justify-center">
                    <Link
                        href={route('site.documentos.course.list', activeTab)}
                        className="group inline-flex items-center px-6 py-3 md:px-10 md:py-4 font-black text-blue-900 bg-white rounded-xl md:rounded-2xl transition-all hover:scale-105 shadow-xl text-xs md:text-sm"
                    >
                        VER TODOS OS CURSOS
                        <ArrowRight size={16} className="ml-2 group-hover:translate-x-1 transition-transform" />
                    </Link>
                </div>
            </div>
        </section>
    );
};

export default CoursesSection;
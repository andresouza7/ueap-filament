import React, { useState } from 'react';
import { useForm } from '@inertiajs/react';
import { Mail, Send, Loader2, CheckCircle, AlertCircle } from 'lucide-react';

const NewsletterForm = ({ variant = 'default' }) => {
    const { data, setData, post, processing, errors, reset, recentlySuccessful } = useForm({
        email: '',
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('newsletter.subscribe'), {
            preserveScroll: true,
            onSuccess: () => reset(),
        });
    };

    if (variant === 'sidebar') {
        return (
            <div className="bg-[#0052CC] p-8 text-white relative overflow-hidden">
                <div className="absolute -top-4 -right-4 opacity-10">
                    <Mail size={80} />
                </div>
                <h3 className="text-lg font-bold uppercase tracking-tighter mb-2 relative z-10">Newsletter</h3>
                <p className="text-[10px] text-white/70 font-bold uppercase tracking-wider mb-6 relative z-10">Receba atualizações oficiais</p>

                <form onSubmit={submit} className="space-y-3 relative z-10">
                    <div>
                        <input
                            type="email"
                            name="email"
                            value={data.email}
                            onChange={(e) => setData('email', e.target.value)}
                            placeholder="Seu e-mail"
                            className="w-full px-4 py-3 bg-white/10 border border-white/20 text-xs focus:outline-none focus:bg-white focus:text-[#0052CC] transition-all placeholder:text-white/50"
                            required
                        />
                        {errors.email && <div className="text-[#A3E635] text-[10px] uppercase font-bold mt-1">{errors.email}</div>}
                    </div>

                    <button
                        type="submit"
                        disabled={processing}
                        className="w-full bg-[#A3E635] text-[#0052CC] py-3 text-[10px] font-bold uppercase tracking-widest hover:bg-white transition-colors flex justify-center items-center disabled:opacity-75"
                    >
                        {processing ? <Loader2 className="animate-spin" size={14} /> : recentlySuccessful ? <span className="flex items-center gap-2"><CheckCircle size={14} /> Inscrito!</span> : 'Inscrever'}
                    </button>
                </form>
            </div>
        );
    }

    // Default variant (Homepage footer style)
    return (
        <form onSubmit={submit} className="flex flex-col sm:flex-row w-full md:w-auto gap-3 relative z-10">
            <div className="w-full sm:w-80 flex flex-col">
                <input
                    type="email"
                    name="email"
                    value={data.email}
                    onChange={(e) => setData('email', e.target.value)}
                    placeholder="seu-email@exemplo.com"
                    className={`w-full px-4 py-3 bg-white/10 border ${errors.email ? 'border-red-400' : 'border-white/20'} focus:outline-none focus:border-[#A3E635] text-sm font-medium text-white placeholder:text-white/50 transition-colors rounded-sm`}
                    required
                />
                {errors.email && <span className="text-red-300 text-[10px] mt-1 font-bold uppercase tracking-wider flex items-center gap-1"><AlertCircle size={10} /> {errors.email}</span>}
                {recentlySuccessful && <span className="text-[#A3E635] text-[10px] mt-1 font-bold uppercase tracking-wider flex items-center gap-1"><CheckCircle size={10} /> Inscrito com sucesso!</span>}
            </div>

            <button
                type="submit"
                disabled={processing}
                className="w-full sm:w-auto bg-[#A3E635] text-[#0052CC] px-6 py-3 font-bold text-[10px] uppercase tracking-widest hover:bg-white hover:text-[#0052CC] transition-all shadow-md flex items-center justify-center gap-2 group rounded-sm h-[46px]"
            >
                {processing ? <Loader2 className="animate-spin" size={16} /> : (
                    <>
                        Inscrever <Send size={14} className="group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform" />
                    </>
                )}
            </button>
        </form>
    );
};

export default NewsletterForm;

import React, { useState } from 'react';
import { useForm } from '@inertiajs/react';
import { Mail, Send, Loader2, CheckCircle, AlertCircle } from 'lucide-react';

const NewsletterForm = ({ variant = 'default' }) => {
    // Destructure additional helpers from useForm
    const { data, setData, errors, setError, clearErrors, reset } = useForm({
        email: '',
    });

    const [processing, setProcessing] = useState(false);
    const [recentlySuccessful, setRecentlySuccessful] = useState(false);

    const submit = async (e) => {
        e.preventDefault();
        setProcessing(true);
        clearErrors();

        try {
            await window.axios.post(route('newsletter.subscribe'), data);

            reset();
            setRecentlySuccessful(true);
            setTimeout(() => setRecentlySuccessful(false), 3000);

        } catch (error) {
            if (error.response?.status === 429) {
                // Handle 429 specifically
                setError('email', 'Muitas tentativas. Aguarde um momento.');
            } else if (error.response?.data?.errors) {
                // Handle validation errors
                Object.keys(error.response.data.errors).forEach(key => {
                    setError(key, error.response.data.errors[key][0]);
                });
            } else {
                setError('email', 'Ocorreu um erro. Tente novamente.');
            }
        } finally {
            setProcessing(false);
        }
    };

    if (variant === 'sidebar') {
        return (
            <div className="bg-ueap-primary p-8 text-ueap-secondary relative overflow-hidden">
                <div className="absolute -top-4 -right-4 opacity-10">
                    <Mail size={80} />
                </div>
                <h3 className="text-lg font-bold uppercase tracking-tighter mb-2 relative z-10">Newsletter</h3>
                <p className="text-[10px] text-ueap-secondary/70 font-bold uppercase tracking-wider mb-6 relative z-10">Receba semanalmente as últimas publicações</p>

                <form onSubmit={submit} className="space-y-3 relative z-10">
                    <div>
                        <label htmlFor="newsletter-email-sidebar" className="sr-only">Seu e-mail</label>
                        <input
                            id="newsletter-email-sidebar"
                            type="email"
                            name="email"
                            value={data.email}
                            onChange={(e) => setData('email', e.target.value)}
                            placeholder="Seu e-mail"
                            className="w-full px-4 py-3 bg-white/10 border border-white/20 text-xs focus:outline-none focus:bg-white focus:text-ueap-primary transition-all placeholder:text-ueap-secondary/50"
                            required
                            aria-invalid={errors.email ? 'true' : 'false'}
                            aria-describedby={errors.email ? "newsletter-error-sidebar" : undefined}
                        />
                        {errors.email && <div id="newsletter-error-sidebar" className="text-red-300 text-[10px] uppercase font-bold mt-1" role="alert">{errors.email}</div>}
                    </div>

                    <button
                        type="submit"
                        disabled={processing}
                        className="w-full bg-ueap-accent text-ueap-primary py-3 text-[10px] font-bold uppercase tracking-widest hover:bg-white transition-colors flex justify-center items-center disabled:opacity-75"
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
                <label htmlFor="newsletter-email-default" className="sr-only">Seu e-mail</label>
                <input
                    id="newsletter-email-default"
                    type="email"
                    name="email"
                    value={data.email}
                    onChange={(e) => setData('email', e.target.value)}
                    placeholder="seu-email@exemplo.com"
                    className={`w-full px-4 py-3 bg-white/10 border ${errors.email ? 'border-red-400' : 'border-white/20'} focus:outline-none focus:border-ueap-accent text-sm font-medium text-ueap-secondary placeholder:text-ueap-secondary/50 transition-colors rounded-sm`}
                    required
                    aria-invalid={errors.email ? 'true' : 'false'}
                    aria-describedby={errors.email ? "newsletter-error-default" : undefined}
                />
                <div aria-live="polite">
                    {errors.email && <span id="newsletter-error-default" className="text-red-300 text-[10px] mt-1 font-bold uppercase tracking-wider flex items-center gap-1"><AlertCircle size={10} aria-hidden="true" /> {errors.email}</span>}
                    {recentlySuccessful && <span className="text-ueap-accent text-[10px] mt-1 font-bold uppercase tracking-wider flex items-center gap-1"><CheckCircle size={10} aria-hidden="true" /> Inscrito com sucesso!</span>}
                </div>
            </div>

            <button
                type="submit"
                disabled={processing}
                className="w-full sm:w-auto bg-ueap-accent text-ueap-primary px-6 py-3 font-bold text-[10px] uppercase tracking-widest hover:bg-white hover:text-ueap-primary transition-all shadow-md flex items-center justify-center gap-2 group rounded-sm h-[46px]"
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

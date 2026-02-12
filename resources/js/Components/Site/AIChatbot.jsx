import React, { useState } from 'react';
import { Sparkles, X, Loader2, Send, Bot } from 'lucide-react';

// --- CONFIGURAÇÃO E UTILITÁRIO GEMINI API ---
const apiKey = import.meta.env.VITE_GEMINI_API_KEY || ""; // Tenta ler do .env se disponível

async function callGemini(prompt, systemInstruction = "") {
    if (!apiKey) {
        console.warn("Gemini API Key missing");
        return "Erro de configuração: Chave de API não encontrada.";
    }

    const url = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-preview-09-2025:generateContent?key=${apiKey}`;

    const payload = {
        contents: [{ parts: [{ text: prompt }] }],
        systemInstruction: systemInstruction ? { parts: [{ text: systemInstruction }] } : undefined
    };

    const maxRetries = 2; // Reduced retries for better UX on failure
    let delay = 1000;

    for (let i = 0; i < maxRetries; i++) {
        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });

            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

            const result = await response.json();
            return result.candidates?.[0]?.content?.parts?.[0]?.text || "Desculpe, não consegui processar sua solicitação.";
        } catch (error) {
            console.error(error);
            if (i === maxRetries - 1) throw error;
            await new Promise(resolve => setTimeout(resolve, delay));
            delay *= 2;
        }
    }
}

const AIChatbot = () => {
    const [isOpen, setIsOpen] = useState(false);
    const [messages, setMessages] = useState([
        { role: 'ai', text: 'Olá! Sou o Assistente ✨ UEAP. Como posso ajudar você hoje?' }
    ]);
    const [input, setInput] = useState('');
    const [loading, setLoading] = useState(false);

    const [lastMessageTime, setLastMessageTime] = useState(0);

    const handleSend = async () => {
        if (!input.trim() || loading) return;

        const now = Date.now();
        if (now - lastMessageTime < 5000) {
            setMessages(prev => [...prev, { role: 'ai', text: '⏳ Por favor, aguarde alguns segundos antes de enviar outra mensagem.' }]);
            return;
        }

        const userMsg = input;
        setInput('');
        setMessages(prev => [...prev, { role: 'user', text: userMsg }]);
        setLoading(true);
        setLastMessageTime(now);

        try {
            const systemPrompt = "Você é um assistente virtual oficial da UEAP (Universidade do Estado do Amapá). Sua missão é ajudar alunos e interessados com informações sobre cursos, processos seletivos, localização dos campi e programas de assistência como Pibid, Pibic e Proace. Seja formal, mas acolhedor. IMPORTANTE: Você deve fornecer APENAS informações verdadeiras e verificáveis sobre a UEAP. Se você não souber a resposta exata ou se a informação não estiver disponível no seu conhecimento, NÃO invente dados. Em vez disso, informe explicitamente que não possui essa informação e instrua o usuário a buscar a resposta no site oficial da UEAP (www.ueap.edu.br) ou a entrar em contato diretamente com o departamento responsável.";
            const response = await callGemini(userMsg, systemPrompt);
            setMessages(prev => [...prev, { role: 'ai', text: response }]);
        } catch (err) {
            setMessages(prev => [...prev, { role: 'ai', text: 'Ops, tive um problema técnico. Tente novamente em breve.' }]);
        } finally {
            setLoading(false);
        }
    };

    return (
        <div className="fixed bottom-6 right-6 z-[100] flex flex-col items-end print:hidden">
            {isOpen && (
                <div className="mb-4 w-80 md:w-96 bg-white shadow-2xl rounded-xl overflow-hidden border border-gray-100 flex flex-col h-[500px] animate-in slide-in-from-bottom-4">
                    <div className="bg-ueap-primary p-4 text-ueap-secondary flex justify-between items-center">
                        <div className="flex items-center gap-2">
                            <Sparkles size={20} className="text-ueap-accent animate-pulse" />
                            <span className="font-bold text-sm uppercase tracking-widest">Assistente ✨ UEAP</span>
                        </div>
                        <button onClick={() => setIsOpen(false)} className="hover:bg-white/10 p-1 rounded"><X size={20} /></button>
                    </div>

                    <div className="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50">
                        {messages.map((m, i) => (
                            <div key={i} className={`flex ${m.role === 'user' ? 'justify-end' : 'justify-start'}`}>
                                <div className={`max-w-[80%] p-3 rounded-lg text-xs leading-relaxed shadow-sm ${m.role === 'user' ? 'bg-ueap-accent text-ueap-primary font-bold' : 'bg-white text-contrast-body border border-gray-100'}`}>
                                    {m.text}
                                </div>
                            </div>
                        ))}
                        {loading && (
                            <div className="flex justify-start">
                                <div className="bg-white p-3 rounded-lg border border-gray-100 flex items-center gap-2">
                                    <Loader2 size={16} className="animate-spin text-ueap-primary" />
                                    <span className="text-[10px] font-bold text-contrast-muted uppercase tracking-widest">Pensando...</span>
                                </div>
                            </div>
                        )}
                    </div>

                    <div className="p-4 border-t border-gray-100 bg-white">
                        <div className="flex gap-2">
                            <input
                                type="text"
                                value={input}
                                onChange={e => setInput(e.target.value)}
                                onKeyDown={e => e.key === 'Enter' && handleSend()}
                                placeholder="Tire suas dúvidas acadêmicas..."
                                className="flex-1 px-3 py-2 bg-gray-100 border-none text-xs focus:ring-1 focus:ring-ueap-primary rounded-md outline-none"
                            />
                            <button onClick={handleSend} className="bg-ueap-primary text-ueap-secondary p-2 rounded-md hover:bg-ueap-accent hover:text-ueap-primary transition-colors">
                                <Send size={18} />
                            </button>
                        </div>
                    </div>
                </div>
            )}
            <button
                onClick={() => setIsOpen(!isOpen)}
                className="w-14 h-14 bg-ueap-primary text-ueap-secondary rounded-full shadow-2xl flex items-center justify-center hover:scale-110 transition-transform border-4 border-ueap-accent"
            >
                {isOpen ? <X size={28} /> : <Bot size={28} />}
            </button>
        </div>
    );
};

export default AIChatbot;

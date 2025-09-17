import { driver } from "driver.js";
import "driver.js/dist/driver.css";

/**
 * Tour interativo da Intranet para novos e antigos usuários.
 * Apresenta funcionalidades principais, destacando mudanças e mantendo familiaridade.
 */
document.addEventListener("DOMContentLoaded", () => {
    const driverObj = driver({
        // Configurações de navegação do tour
        prevBtnText: 'Anterior',
        nextBtnText: 'Próximo',
        doneBtnText: 'Finalizar',
        showProgress: true,
        allowClose: false,

        onNextClick: function (e) {
            const step = driverObj.getActiveIndex();

            if (window.Alpine && Alpine.store('sidebar')) {
                const sidebar = Alpine.store('sidebar');

                // Example logic: open sidebar at step 0, close at step 5
                sidebar.isOpen = (step === 0) ? true : (step === 5 ? false : sidebar.isOpen);
            }

            driverObj.moveNext();
        },

        onPrevClick: function (e) {
            const step = driverObj.getActiveIndex();

            if (window.Alpine && Alpine.store('sidebar')) {
                const sidebar = Alpine.store('sidebar');

                // Example logic: open sidebar at step 0, close at step 5
                sidebar.isOpen = (step >= 0 && step <= 6) ? true : false;
            }

            driverObj.movePrevious()
        },

        onDestroyed: () => {
            fetch('/tutorial/complete', { method: 'GET', credentials: 'same-origin' })
                .then(response => response.json())
                .then(data => console.log('Tutorial marcado como concluído:', data))
                .catch(err => console.error('Erro ao marcar tutorial como concluído:', err));
        },

        // Passos do tour
        steps: [
            {
                popover: {
                    title: 'Olá Servidor(a)!',
                    description: `
                    A Intranet mudou. A nova versão oferece mais usabilidade, segurança e compatibilidade com tecnologias modernas, mantendo o layout familiar para facilitar sua adaptação. 
                    <br><br>
                    Novidades:
                    <ul>
                        <li>✅ Framework atualizado com foco em desempenho e segurança.</li>
                        <li>✅ Layout mais intuitivo, com ordenação e filtros aprimorados.</li>
                        <li>✅ Novo tema escuro, ajudando a reduzir o cansaço visual.</li>
                        <li>✅ Melhor responsividade em dispositivos móveis.</li>
                        <li>✅ Maior aderência a boas práticas, facilitando futuras melhorias.</li>
                    </ul>
                    Acompanhe este tour para explorar e conhecer as principais seções.
                `
                }
            },
            {
                element: ".fi-sidebar",
                popover: { title: "Menu Lateral", description: "Aqui está a barra lateral do painel, que permite acessar as seções principais." }
            },
            {
                element: ".fi-sidebar-group:nth-child(2)",
                popover: { title: "Minha Área", description: "Acesse perfil, dados funcionais, folha de ponto e portarias." }
            },
            {
                element: ".fi-sidebar-group:nth-child(3)",
                popover: { title: "Social", description: "Consulte dados institucionais, informativos, benefícios, saúde e bem-estar." }
            },
            {
                element: ".fi-sidebar-group:nth-last-child(1)",
                popover: {
                    title: "Protocolo Digital",
                    description: "Consulte aqui o histórico de processos físicos anteriores ao PRODOC."
                }
            },
            {
                element: ".fi-sidebar",
                popover: {
                    title: "Gestão e Transparência",
                    description: "Usuários com permissão também tem acesso neste menu a gestão de documentos, recursos, transparência e site institucional."
                }
            },
            {
                element: ".fi-ta-record",
                popover: { title: "Postagens", description: "Seção destinada à comunicação institucional. Clique no link de postagens na seção social para criar uma publicação." }
            },
            {
                element: "#ocorrencia-ponto",
                popover: { title: "Ocorrências de Ponto", description: "Visualize feriados, alterações e registros de ponto." }
            },
            {
                element: ".fi-avatar",
                popover: { title: "Perfil", description: "Acesse opções de alteração de perfil, troca de tema ou efetue logout." }
            },
            {
                popover: {
                    title: "Suporte e Sugestões",
                    description: `
                        Para dúvidas sobre o uso do sistema ou procedimentos institucionais, entre em contato com a DINFO pelo e-mail 
                        <a href="mailto:dinfo@ueap.edu.br" class="text-blue-600 underline">dinfo@ueap.edu.br</a>.<br><br>
                        Para suporte, sugestões de melhorias ou novas funcionalidades, faça um chamado pelo Service Desk: 
                        <a href="servicedesk@ueap.edu.br" class="text-blue-600 underline">servicedesk@ueap.edu.br</a>.<br><br>
                        Estamos à disposição para atendê-los!
                    `
                }
            }

        ]
    });

    window.driver = driverObj;
    driverObj.drive();
});

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
                    description: 'A Intranet foi atualizada para oferecer melhor usabilidade e maior segurança, utilizando tecnologias mais modernas. Muitas funcionalidades e o layout permanecem familiares, facilitando sua adaptação. Acompanhe este tour se precisar de orientação.'
                }
            },
            {
                element: ".fi-sidebar",
                popover: { title: "Sidebar", description: "Aqui está a barra lateral do painel, que permite acessar as seções principais." }
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
                element: ".fi-ta-record",
                popover: { title: "Postagens", description: "Seção destinada à comunicação institucional. Clique no link de postagens na seção social para criar uma publicação." }
            },
            {
                element: ".fi-input",
                popover: { title: "Caixa de Pesquisa", description: "Use esta caixa para filtrar publicações." }
            },
            {
                element: "#ocorrencia-ponto",
                popover: { title: "Ocorrências de Ponto", description: "Visualize feriados, alterações e registros de ponto." }
            },
            {
                element: ".fi-avatar",
                popover: { title: "Perfil", description: "Acesse opções de alteração de perfil, tema claro e escuro ou efetue logout." }
            },
            {
                popover: { title: "Suporte e Sugestões", description: "Para dúvidas, relato de erros ou sugestões de melhoria, abra um chamado no Service Desk da UEAP." }
            }
        ]
    });

    window.driver = driverObj;

    // Inicia o tour apenas na dashboard
    if (window.location.pathname === '/app') driverObj.drive();
});

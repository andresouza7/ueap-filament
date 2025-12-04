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
                    description: `
                    A folha de ponto UEAP mudou. A nova versão oferece um novo modo de enviar os seus pontos, com mais segurança e confiabilidade no tratamento dos dados. 
                    <br><br>
                    <strong>Novidades: </strong>
                    <ul>
                        <li>✅ Nova aba "Enviar Ponto", com funcionalidades melhoradas em relação à versão anterior.</li>
                    </ul>                `
                }
            },
            
            
            {
                element: () => [...document.querySelectorAll('.fi-tabs-item-label')]
                .find(el => el.textContent.includes("Enviar Ponto")),
                popover: {
                    title: "Enviar Ponto",
                    description: "Nesta aba você pode encaminhar sua folha de ponto digitalizada para análise do RH. " },
                onHighlightStarted: () => {
                    const el = [...document.querySelectorAll('.fi-tabs-item-label')]
                        .find(el => el.textContent.includes("Enviar Ponto"));

                    if (el) el.click(); // 🔥 abre a aba automaticamente
                }
            },

            {
                element: "#form-submit-ponto",
                popover: {
                    title: "Formulário de Envio",
                    description: `
                        Preencha os dados da folha de ponto que deseja enviar.<br><br>
                        <strong>Mês</strong> e <strong>Ano</strong> identificam o período da folha.<br>
                        No campo <strong>Arquivo PDF</strong>, selecione o documento digitalizado da sua folha de ponto.<br><br>
                        Após preencher, clique em <strong>Enviar</strong> para encaminhar ao setor responsável.
                    `
                }
            },

            {
                element: "#form-submit-ponto",
                popover: {
                    title: "Observações",
                    description: `
                        Campo opcional para registrar informações adicionais relacionadas ao envio da folha de ponto.<br>
                        As observações são encaminhadas junto ao documento para análise do RH.
                    `
                }
            },

            {
                element: ".fi-ta",
                popover: {
                    title: "Histórico de Envios",
                    description: `
                        Aqui você acompanha todas as folhas de ponto já enviadas.<br><br>
                        A tabela mostra:
                        <ul>
                            <li><strong>Mês e Ano</strong> da folha enviada;</li>
                            <li><strong>Status</strong> da análise pelo RH;</li>
                            <li><strong>Data de envio</strong> e <strong>data de avaliação</strong>;</li>
                            <li><strong>Avaliador</strong> responsável;</li>
                            <li><strong>Justificativa</strong> caso seja necessário reenviar.</li>
                        </ul>
                        Use estas informações para acompanhar o andamento do seu envio.
                    `,
                },
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

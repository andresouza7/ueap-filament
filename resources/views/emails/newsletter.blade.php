<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter UEAP</title>
    <style>
        body {
            background-color: #f3f4f6;
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        /* Responsividade básica */
        @media only screen and (max-width: 600px) {
            .container {
                width: 100% !important;
            }

            .content {
                padding: 30px 20px !important;
            }
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #0052CC;
            padding: 40px 32px;
            text-align: center;
            border-bottom: 4px solid #A3E635;
        }

        .news-item-row {
            border-bottom: 1px solid #edf2f7;
            padding-bottom: 24px;
            margin-bottom: 24px;
        }

        .news-item-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .btn-link {
            display: inline-block;
            color: #0052CC;
            font-weight: 800;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 0.05em;
            border-bottom: 2px solid #A3E635;
            padding-bottom: 2px;
        }

        .footer {
            background-color: #003D99;
            padding: 32px;
            text-align: center;
        }
    </style>
</head>

<body style="background-color: #f3f4f6; padding: 40px 0;">
    <center>
        <table class="container" width="600" cellpadding="0" cellspacing="0" role="presentation"
            style="background-color: #ffffff; width: 600px; max-width: 600px;">

            <tr>
                <td class="header" align="center"
                    style="background-color: #0052CC; padding: 40px 32px; border-bottom: 4px solid #A3E635;">
                    <h1
                        style="color: #ffffff; font-size: 28px; font-weight: 900; text-transform: uppercase; margin: 0; font-style: italic;">
                        UEAP<span style="color: #A3E635;">NOTÍCIAS</span>
                    </h1>
                    <span class="tag"
                        style="color: #A3E635; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 3px; display: block; margin-top: 8px;">
                        Resumo Semanal
                    </span>
                </td>
            </tr>

            <tr>
                <td style="padding: 32px 32px 16px 32px; text-align: left; color: #6b7280; font-size: 14px;">
                    Confira os últimos destaques e atualizações oficiais da Universidade.
                </td>
            </tr>

            <tr>
                <td class="content" style="padding: 0 32px 40px 32px;">
                    @foreach ($content as $post)
                        <table width="100%" cellpadding="0" cellspacing="0" role="presentation" class="news-item-row">
                            <tr>
                                <td valign="top" align="left">
                                    <div
                                        style="color: #0052CC; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 4px;">
                                        {{ $post->publishedAt }}
                                    </div>
                                    <h2
                                        style="color: #111827; font-size: 16px; font-weight: 700; line-height: 1.4; margin: 0 0 8px 0; text-transform: uppercase;">
                                        <a href="{{ $post->url }}" style="color: #111827; text-decoration: none;">
                                            {{ $post->title }}
                                        </a>
                                    </h2>
                                    <a href="{{ $post->url }}" class="btn-link">
                                        LER MATÉRIA COMPLETA &rarr;
                                    </a>
                                </td>
                            </tr>
                        </table>
                    @endforeach
                </td>
            </tr>

            <tr>
                <td class="footer" align="center" style="background-color: #003D99; padding: 32px;">
                    <p style="color: #bfdbfe; font-size: 11px; line-height: 1.6; margin: 0;">
                        <strong style="color: #ffffff; text-transform: uppercase;">Universidade do Estado do
                            Amapá</strong><br>
                        Assessoria de Comunicação<br><br>
                        Você está recebendo este e-mail porque se inscreveu em nossa newsletter através do site
                        oficial.<br><br>
                        <a href="{{ route('newsletter.unsubscribe', $subscriber->unsubscribe_token ?? '') }}"
                            style="color: #ffffff; font-weight: 700; text-decoration: underline; text-decoration-color: #A3E635;">
                            Cancelar inscrição aqui
                        </a>
                    </p>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>

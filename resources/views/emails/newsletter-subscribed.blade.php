<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscrição Confirmada - UEAP</title>
    <style>
        body {
            background-color: #f3f4f6;
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }

        .header {
            background-color: #0052CC;
            padding: 40px 20px;
            text-align: center;
        }

        .content {
            padding: 40px 30px;
            text-align: center;
        }

        .footer {
            background-color: #003D99;
            padding: 32px;
            text-align: center;
            font-size: 11px;
            color: #bfdbfe;
        }
    </style>
</head>

<body style="background-color: #f3f4f6; font-family: sans-serif; margin: 0; padding: 40px 0;">
    <center>
        <table width="600" cellpadding="0" cellspacing="0" role="presentation"
            style="background-color: #ffffff; max-width: 600px; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <!-- Header -->
            <tr>
                <td align="center" style="background-color: #0052CC; padding: 40px 20px;">
                    <h1
                        style="color: #ffffff; font-size: 24px; font-weight: 800; text-transform: uppercase; margin: 0; letter-spacing: 2px;">
                        UEAP<span style="color: #A3E635;">NOTÍCIAS</span>
                    </h1>
                </td>
            </tr>

            <!-- Content -->
            <tr>
                <td align="center" style="padding: 40px 30px; text-align: center;">
                    <div style="color: #A3E635; font-size: 48px; margin-bottom: 20px;">✓</div>
                    <h2
                        style="color: #0052CC; font-size: 22px; font-weight: 700; margin-bottom: 16px; text-transform: uppercase;">
                        Inscrição Confirmada!</h2>
                    <p style="color: #4b5563; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                        Obrigado por se inscrever na nossa newsletter.<br>
                        Agora você receberá as principais publicações da Universidade do Estado do Amapá diretamente no
                        seu e-mail.
                    </p>
                    <a href="{{ route('site.home') }}"
                        style="display: inline-block; background-color: #A3E635; color: #0052CC; font-weight: 800; text-decoration: none; padding: 14px 32px; border-radius: 4px; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">
                        Voltar para o Site
                    </a>
                </td>
            </tr>

            <!-- Footer -->
            <tr>
                <td align="center" style="background-color: #003D99; padding: 32px; color: #bfdbfe; font-size: 11px;">
                    <p style="margin: 0; opacity: 0.8; margin-bottom: 16px;">
                        &copy; {{ date('Y') }} Universidade do Estado do Amapá.<br>
                        Todos os direitos reservados.
                    </p>
                    <p style="margin: 0;">
                        Caso não deseje mais receber,
                        <a href="{{ route('newsletter.unsubscribe', $subscriber->unsubscribe_token ?? '') }}"
                            style="color: #ffffff; font-weight: 700; text-decoration: underline;">
                            remova sua inscrição aqui
                        </a>
                    </p>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscrição Confirmada - UEAP</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            color: #1f2937;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            overflow: hidden;
        }

        .header {
            background-color: #0052CC;
            padding: 40px 20px;
            text-align: center;
        }

        .logo-text {
            color: #ffffff;
            font-size: 24px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0;
        }

        .content {
            padding: 40px 30px;
            text-align: center;
        }

        .icon-check {
            color: #A3E635;
            font-size: 48px;
            margin-bottom: 20px;
            display: block;
        }

        h1 {
            color: #0052CC;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        p {
            font-size: 16px;
            color: #4b5563;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            background-color: #A3E635;
            color: #0052CC;
            font-weight: 800;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 4px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer {
            background-color: #003D99;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #93c5fd;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1 class="logo-text">UEAP<span style="color: #A3E635;">NOTÍCIAS</span></h1>
        </div>

        <!-- Content -->
        <div class="content">
            <span class="icon-check">✓</span>
            <h1>Inscrição Confirmada!</h1>
            <p>
                Obrigado por se inscrever na nossa newsletter.<br>
                Agora você receberá as principais notícias, editais e atualizações da Universidade do Estado do Amapá
                diretamente no seu e-mail.
            </p>
            <a href="{{ route('site.home') }}" class="btn">Voltar para o Site</a>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p style="margin: 0; color: #ffffff80;">
                &copy; {{ date('Y') }} Universidade do Estado do Amapá.<br>
                Todos os direitos reservados.
            </p>
        </div>
    </div>
</body>

</html>

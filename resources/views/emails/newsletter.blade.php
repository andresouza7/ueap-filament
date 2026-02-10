<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #f3f4f6;
            padding-bottom: 40px;
        }

        .main {
            background-color: #ffffff;
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
            border-spacing: 0;
            color: #1f2937;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Header */
        .header {
            background-color: #0052CC;
            padding: 40px 30px;
            text-align: center;
        }

        .logo-text {
            color: #ffffff;
            font-size: 28px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: -1px;
            margin: 0;
            line-height: 1;
        }

        .logo-sub {
            color: #A3E635;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-top: 8px;
            display: block;
        }

        /* Body */
        .intro {
            padding: 30px 30px 10px 30px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }

        .content {
            padding: 20px 30px 40px 30px;
        }

        /* News Card */
        .news-card {
            margin-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
            background-color: #ffffff;
            padding-bottom: 20px;
        }

        .news-card:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .news-img {
            width: 120px;
            height: 90px;
            object-fit: cover;
            border-radius: 4px;
            display: block;
            background-color: #e5e7eb;
        }

        .news-img-col {
            width: 120px;
            padding-right: 20px;
        }

        .news-body {
            vertical-align: top;
        }

        .news-date {
            color: #0052CC;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }

        .news-title {
            color: #111827;
            font-size: 15px;
            font-weight: 800;
            line-height: 1.3;
            margin: 0 0 8px 0;
            text-transform: uppercase;
        }

        .news-title a {
            color: #111827;
            text-decoration: none;
        }

        .btn-link {
            display: inline-block;
            color: #0052CC;
            font-weight: 800;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 1px;
            border-bottom: 2px solid #A3E635;
            padding-bottom: 1px;
        }

        /* Footer */
        .footer {
            background-color: #003D99;
            padding: 30px;
            text-align: center;
            margin-top: 20px;
        }

        .footer-text {
            color: #93c5fd;
            font-size: 11px;
            line-height: 1.6;
            margin: 0;
        }

        .footer a {
            color: #ffffff;
            font-weight: bold;
            text-decoration: none;
        }

        @media screen and (max-width: 600px) {
            .main {
                width: 100% !important;
            }

            .content {
                padding: 15px !important;
            }

            .news-img-col {
                width: 100px !important;
                padding-right: 15px !important;
            }

            .news-img {
                width: 100px !important;
                height: 75px !important;
            }
        }
    </style>
</head>

<body>
    <center class="wrapper">
        <table class="main" width="100%" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Header -->
            <tr>
                <td class="header">
                    <h1 class="logo-text">UEAP<span style="color: #A3E635;">NOTÍCIAS</span></h1>
                    <span class="logo-sub">Resumo Semanal</span>
                </td>
            </tr>

            <!-- Intro -->
            <tr>
                <td class="intro">
                    Confira os últimos destaques e atualizações oficiais da Universidade.
                </td>
            </tr>

            <!-- Content -->
            <tr>
                <td class="content">
                    @foreach ($content as $post)
                        <div class="news-card">
                            <table width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                    @if (!empty($post->image_url))
                                        <td width="200" valign="top" class="news-img-col">
                                            <a href="{{ $post->url }}">
                                                <img src="{{ $post->image_url }}" alt="{{ $post->title }}"
                                                    class="news-img">
                                            </a>
                                        </td>
                                    @endif
                                    <td valign="top" class="news-body">
                                        <div class="news-date">{{ $post->publishedAt }}</div>
                                        <h2 class="news-title">
                                            <a href="{{ $post->url }}">{{ $post->title }}</a>
                                        </h2>
                                        <a href="{{ $post->url }}" class="btn-link">LER MATÉRIA COMPLETA &rarr;</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @endforeach
                </td>
            </tr>

            <!-- Footer -->
            <tr>
                <td class="footer">
                    <p class="footer-text">
                        <strong>UNIVERSIDADE DO ESTADO DO AMAPÁ</strong><br>
                        Assessoria de Comunicação<br><br>
                        Você está recebendo este e-mail porque se inscreveu em nossa newsletter.<br>
                        <a href="{{ route('newsletter.unsubscribe', $subscriber->unsubscribe_token ?? '') }}">Cancelar
                            inscrição</a>
                    </p>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>

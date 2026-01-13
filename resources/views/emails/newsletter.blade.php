<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: 'Helvetica', Arial, sans-serif; background-color: #020617; margin: 0; padding: 0; }
        .wrapper { width: 100%; background-color: #020617; padding: 20px 0; }
        .main { background-color: #ffffff; margin: 0 auto; width: 100%; max-width: 600px; border-spacing: 0; color: #1e293b; border-radius: 4px; overflow: hidden; }
        
        /* Header Tech Style */
        .header { background-color: #020617; padding: 35px 25px; text-align: left; border-bottom: 4px solid #10b981; }
        .lvl-tag { color: #10b981; font-family: monospace; font-size: 10px; letter-spacing: 3px; font-weight: bold; margin-bottom: 8px; }
        .title { color: #ffffff; font-size: 26px; font-weight: 900; text-transform: uppercase; font-style: italic; margin: 0; line-height: 1; }
        
        /* Body / Cards */
        .container { padding: 30px 25px; }
        .post-card { margin-bottom: 40px; border-bottom: 1px solid #f1f5f9; padding-bottom: 35px; }
        .post-card:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
        
        .meta { color: #10b981; font-family: monospace; font-size: 10px; font-weight: bold; margin-bottom: 10px; text-transform: uppercase; }
        .post-title { font-size: 20px; font-weight: 800; color: #0f172a; text-transform: uppercase; text-decoration: none; line-height: 1.2; display: block; margin-bottom: 12px; }
        .post-excerpt { font-size: 14px; color: #64748b; line-height: 1.6; margin: 0 0 20px 0; }
        
        /* Button */
        .btn-table { background-color: #0f172a; border-radius: 2px; }
        .btn-link { display: inline-block; color: #ffffff !important; padding: 12px 20px; text-decoration: none; font-size: 10px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; font-family: monospace; }
        
        /* Footer */
        .footer { padding: 30px; text-align: center; background-color: #f8fafc; border-top: 1px solid #f1f5f9; }
        .footer-text { font-size: 10px; color: #94a3b8; font-family: monospace; line-height: 1.5; }
        .unsub { color: #ef4444; text-decoration: underline; font-weight: bold; }
    </style>
</head>
<body>
    <center class="wrapper">
        <table class="main" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
                <td class="header">
                    <div class="lvl-tag">DEPT_COMUNICACAO // BROADCAST</div>
                    <h1 class="title">Newsletter <span style="color: #10b981;">UEAP</span></h1>
                </td>
            </tr>

            <tr>
                <td class="container">
                    @foreach($content as $post)
                        <div class="post-card">
                            {{-- Lendo as propriedades do DTO --}}
                            <div class="meta">
                                [ PUBLICADO_EM: {{ $post->publishedAt }} ]
                            </div>
                            
                            <a href="{{ $post->url }}" class="post-title">
                                {{ $post->title }}
                            </a>
                            
                            <p class="post-excerpt">
                                {{ $post->excerpt }}
                            </p>

                            <table class="btn-table" role="presentation" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>
                                        <a href="{{ $post->url }}" class="btn-link">
                                            LER_NA_INTEGRA_
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @endforeach
                </td>
            </tr>

            <tr>
                <td class="footer">
                    <p class="footer-text">
                        <strong>UNIVERSIDADE DO ESTADO DO AMAPÁ</strong><br>
                        SISTEMA DE DIVULGAÇÃO CIENTÍFICA E INSTITUCIONAL<br>
                        <br>
                        Caso não deseje mais receber, <a href="#" class="unsub">remova aqui</a>.
                    </p>
                </td>
            </tr>
        </table>
    </center>
</body>
</html>
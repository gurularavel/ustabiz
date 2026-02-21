<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Texniki Baxım – {{ \App\Models\Setting::get('site_title', 'USTA.BİZ.AZ') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: linear-gradient(135deg, #12121E 0%, #0D1F3C 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            padding: 20px;
        }
        .card {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 24px;
            padding: 60px 48px;
            max-width: 520px;
            width: 100%;
            text-align: center;
        }
        .icon {
            font-size: 64px;
            margin-bottom: 28px;
            display: block;
            animation: spin 4s linear infinite;
        }
        @keyframes spin {
            0%,100% { transform: rotate(0deg); }
            25% { transform: rotate(-10deg); }
            75% { transform: rotate(10deg); }
        }
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,107,53,0.15);
            border: 1px solid rgba(255,107,53,0.35);
            color: #FF6B35;
            border-radius: 100px;
            padding: 6px 18px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 24px;
        }
        .badge-dot {
            width: 7px; height: 7px;
            background: #FF6B35;
            border-radius: 50%;
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:0.3} }
        h1 {
            font-size: 36px;
            font-weight: 900;
            letter-spacing: -1px;
            margin-bottom: 16px;
            line-height: 1.15;
        }
        h1 span { color: #FF6B35; }
        p {
            font-size: 16px;
            color: rgba(255,255,255,0.6);
            line-height: 1.7;
            margin-bottom: 36px;
        }
        .divider {
            height: 1px;
            background: rgba(255,255,255,0.08);
            margin: 36px 0;
        }
        .contact-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 15px;
            color: rgba(255,255,255,0.75);
        }
        .contact-row a {
            color: #FF6B35;
            text-decoration: none;
            font-weight: 600;
        }
        .contact-row a:hover { text-decoration: underline; }
        .logo {
            font-size: 22px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 8px;
        }
        .logo span { color: #FF6B35; }
        @media(max-width:480px){
            .card { padding: 40px 24px; }
            h1 { font-size: 26px; }
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo">USTA<span>.BİZ.AZ</span></div>
        <div style="margin-top:6px;margin-bottom:32px;font-size:13px;color:rgba(255,255,255,0.3);">
            {{ \App\Models\Setting::get('site_title', 'Peşəkar Ev Texnikası Təmiri') }}
        </div>

        <span class="icon">🔧</span>

        <div class="badge">
            <div class="badge-dot"></div>
            Texniki baxım rejimi
        </div>

        <h1>Sayt üzərində <span>işlər</span> aparılır</h1>
        <p>
            Hal-hazırda saytımız yeniləmə prosesindədir.<br>
            Tezliklə yenidən xidmətinizdə olacağıq.
        </p>

        <div class="divider"></div>

        @php $phone = \App\Models\Setting::get('phone', ''); $phoneClean = preg_replace('/\D/', '', $phone); @endphp
        @if($phone)
        <div class="contact-row">
            <span>📞</span>
            <span>Təcili olaraq zəng edin:</span>
            <a href="tel:+{{ $phoneClean }}">{{ $phone }}</a>
        </div>
        @endif
    </div>
</body>
</html>

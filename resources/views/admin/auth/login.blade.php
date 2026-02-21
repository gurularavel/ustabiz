<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Giriş – USTA.Biz.AZ</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', -apple-system, sans-serif; background: #12121E; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-box { background: #fff; border-radius: 16px; padding: 40px; width: 100%; max-width: 400px; box-shadow: 0 25px 50px rgba(0,0,0,.4); }
        .login-logo { display: flex; align-items: center; gap: 12px; margin-bottom: 32px; }
        .login-logo-icon { width: 44px; height: 44px; background: #FF6B35; border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .login-logo-text { font-size: 22px; font-weight: 700; }
        .login-logo-text span { color: #FF6B35; }
        .login-subtitle { font-size: 13px; color: #9ca3af; margin-top: 2px; }
        h2 { font-size: 20px; font-weight: 600; margin-bottom: 24px; color: #111827; }
        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: 13px; font-weight: 500; margin-bottom: 6px; color: #374151; }
        .form-control { width: 100%; padding: 10px 14px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px; color: #111827; outline: none; transition: border-color .15s; }
        .form-control:focus { border-color: #FF6B35; box-shadow: 0 0 0 3px rgba(255,107,53,.12); }
        .error-list { background: #fee2e2; border: 1px solid #fca5a5; border-radius: 8px; padding: 10px 14px; margin-bottom: 18px; font-size: 13px; color: #991b1b; }
        .btn-submit { width: 100%; padding: 11px; background: #FF6B35; color: #fff; border: none; border-radius: 8px; font-size: 15px; font-weight: 600; cursor: pointer; transition: background .15s; }
        .btn-submit:hover { background: #e55a24; }
        .form-remember { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #374151; margin-bottom: 20px; }
        .form-remember input { accent-color: #FF6B35; }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="login-logo">
            <div class="login-logo-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>
            </div>
            <div>
                <div class="login-logo-text">USTA<span>.BİZ.AZ</span></div>
                <div class="login-subtitle">Admin Panel</div>
            </div>
        </div>

        <h2>Xoş gəldiniz</h2>

        @if($errors->any())
            <div class="error-list">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <div class="form-group">
                <label class="form-label" for="email">E-poçt</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="admin@ustam.az">
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Şifrə</label>
                <input type="password" id="password" name="password" class="form-control" required placeholder="••••••••">
            </div>
            <label class="form-remember">
                <input type="checkbox" name="remember"> Məni xatırla
            </label>
            <button type="submit" class="btn-submit">Daxil ol</button>
        </form>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') – USTA.AZ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --sidebar-bg: #12121E;
            --sidebar-width: 240px;
            --accent: #FF6B35;
            --accent-dark: #e55a24;
            --text-muted: #9ca3af;
            --border: #e5e7eb;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #3b82f6;
        }
        body { font-family: 'Inter', -apple-system, sans-serif; background: #f3f4f6; color: #111827; display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            position: fixed; top: 0; left: 0; bottom: 0;
            display: flex; flex-direction: column;
            z-index: 100;
            transition: transform .3s;
        }
        .sidebar-logo {
            padding: 20px 20px 16px;
            border-bottom: 1px solid rgba(255,255,255,.08);
            display: flex; align-items: center; gap: 10px;
            text-decoration: none;
        }
        .sidebar-logo-icon {
            width: 36px; height: 36px; background: var(--accent); border-radius: 8px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .sidebar-logo-text { color: #fff; font-size: 17px; font-weight: 700; }
        .sidebar-logo-text span { color: var(--accent); }
        .sidebar-subtitle { color: rgba(255,255,255,.4); font-size: 11px; margin-top: 2px; }

        .sidebar-nav { flex: 1; padding: 12px 0; overflow-y: auto; }
        .nav-section { padding: 8px 16px 4px; color: rgba(255,255,255,.3); font-size: 10px; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; }
        .sidebar-link {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 16px; color: rgba(255,255,255,.65); text-decoration: none;
            font-size: 14px; font-weight: 500; transition: all .15s; border-radius: 0;
            margin: 1px 8px; border-radius: 8px;
        }
        .sidebar-link:hover { background: rgba(255,255,255,.07); color: #fff; }
        .sidebar-link.active { background: var(--accent); color: #fff; }
        .sidebar-link .icon { width: 18px; text-align: center; flex-shrink: 0; }

        .sidebar-footer {
            padding: 16px; border-top: 1px solid rgba(255,255,255,.08);
        }
        .sidebar-user { color: rgba(255,255,255,.5); font-size: 12px; margin-bottom: 10px; }
        .sidebar-user strong { display: block; color: rgba(255,255,255,.85); font-size: 13px; }
        .btn-logout {
            display: flex; align-items: center; gap: 8px; width: 100%;
            background: rgba(255,255,255,.07); border: none; color: rgba(255,255,255,.6);
            padding: 8px 12px; border-radius: 8px; font-size: 13px; cursor: pointer;
            transition: background .15s; text-decoration: none;
        }
        .btn-logout:hover { background: rgba(239,68,68,.2); color: #fca5a5; }

        /* MAIN CONTENT */
        .main { margin-left: var(--sidebar-width); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }
        .topbar {
            background: #fff; border-bottom: 1px solid var(--border);
            padding: 14px 24px; display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 50;
        }
        .topbar h1 { font-size: 18px; font-weight: 600; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .site-link { color: var(--accent); text-decoration: none; font-size: 13px; }
        .site-link:hover { text-decoration: underline; }

        .content { padding: 24px; flex: 1; }

        /* CARDS */
        .card { background: #fff; border-radius: 12px; border: 1px solid var(--border); overflow: hidden; }
        .card-header { padding: 16px 20px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
        .card-title { font-size: 15px; font-weight: 600; }
        .card-body { padding: 20px; }

        /* STATS */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px,1fr)); gap: 16px; margin-bottom: 24px; }
        .stat-card { background: #fff; border-radius: 12px; padding: 20px; border: 1px solid var(--border); }
        .stat-label { font-size: 12px; color: var(--text-muted); margin-bottom: 6px; }
        .stat-value { font-size: 28px; font-weight: 700; }
        .stat-card.blue .stat-value  { color: var(--info); }
        .stat-card.orange .stat-value { color: var(--warning); }
        .stat-card.green .stat-value  { color: var(--success); }
        .stat-card.red .stat-value    { color: var(--danger); }
        .stat-card.gray .stat-value   { color: #6b7280; }

        /* TABLE */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        th { text-align: left; padding: 10px 14px; font-size: 12px; font-weight: 600; color: var(--text-muted); border-bottom: 1px solid var(--border); white-space: nowrap; }
        td { padding: 10px 14px; border-bottom: 1px solid var(--border); vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f9fafb; }

        /* BADGES */
        .badge { display: inline-flex; align-items: center; padding: 2px 10px; border-radius: 999px; font-size: 11px; font-weight: 600; }
        .badge-new         { background: #dbeafe; color: #1d4ed8; }
        .badge-in_progress { background: #fef3c7; color: #92400e; }
        .badge-done        { background: #d1fae5; color: #065f46; }
        .badge-cancelled   { background: #fee2e2; color: #991b1b; }
        .badge-active      { background: #d1fae5; color: #065f46; }
        .badge-inactive    { background: #f3f4f6; color: #6b7280; }

        /* BUTTONS */
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: 8px 14px; border-radius: 8px; font-size: 13px; font-weight: 500; cursor: pointer; border: 1px solid transparent; text-decoration: none; transition: all .15s; }
        .btn-primary { background: var(--accent); color: #fff; border-color: var(--accent); }
        .btn-primary:hover { background: var(--accent-dark); }
        .btn-secondary { background: #fff; color: #374151; border-color: var(--border); }
        .btn-secondary:hover { background: #f9fafb; }
        .btn-danger { background: #fff; color: var(--danger); border-color: #fca5a5; }
        .btn-danger:hover { background: #fee2e2; }
        .btn-sm { padding: 5px 10px; font-size: 12px; }

        /* FORMS */
        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: 13px; font-weight: 500; margin-bottom: 6px; color: #374151; }
        .form-control {
            width: 100%; padding: 9px 12px; border: 1px solid var(--border); border-radius: 8px;
            font-size: 14px; color: #111827; background: #fff; transition: border-color .15s;
            outline: none;
        }
        .form-control:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(255,107,53,.12); }
        textarea.form-control { resize: vertical; min-height: 100px; }
        .form-check { display: flex; align-items: center; gap: 8px; }
        .form-check input { width: 16px; height: 16px; accent-color: var(--accent); }
        .form-hint { font-size: 11px; color: var(--text-muted); margin-top: 4px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

        /* ALERTS */
        .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; }
        .alert-success { background: #d1fae5; color: #065f46; border: 1px solid #6ee7b7; }
        .alert-error   { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }

        /* ERROR LIST */
        .error-msg { color: var(--danger); font-size: 12px; margin-top: 4px; }

        /* PAGINATION */
        .pagination { display: flex; gap: 4px; align-items: center; padding: 16px 0 4px; }
        .pagination a, .pagination span { padding: 6px 12px; border-radius: 6px; font-size: 13px; text-decoration: none; border: 1px solid var(--border); color: #374151; }
        .pagination a:hover { background: #f3f4f6; }
        .pagination .active span { background: var(--accent); color: #fff; border-color: var(--accent); }
        .pagination .disabled span { color: #d1d5db; }

        /* STATUS SELECT */
        select.form-control { cursor: pointer; }

        /* ICON PICKER */
        .icon-picker-group { display: flex; align-items: center; gap: 10px; }
        .icon-current {
            width: 56px; height: 56px; font-size: 28px;
            background: #f9fafb; border: 1.5px solid var(--border); border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: border-color .15s; flex-shrink: 0; user-select: none;
        }
        .icon-current:hover { border-color: var(--accent); background: #fff4f0; }
        .icon-picker-modal {
            display: none; position: fixed; inset: 0; z-index: 9000;
            background: rgba(0,0,0,.5); align-items: center; justify-content: center;
        }
        .icon-picker-modal.open { display: flex; }
        .icon-picker-box {
            background: #fff; border-radius: 16px; width: 560px; max-width: 95vw; max-height: 82vh;
            display: flex; flex-direction: column; overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,.25);
        }
        .icon-picker-header {
            padding: 14px 18px; border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between; flex-shrink: 0;
        }
        .icon-picker-header h3 { font-size: 15px; font-weight: 600; }
        .icon-picker-close {
            background: none; border: none; font-size: 18px; cursor: pointer;
            color: #9ca3af; line-height: 1; padding: 4px 8px; border-radius: 6px;
        }
        .icon-picker-close:hover { background: #f3f4f6; color: #374151; }
        .icon-picker-search { padding: 10px 16px; border-bottom: 1px solid var(--border); flex-shrink: 0; }
        .icon-picker-search input {
            width: 100%; padding: 8px 12px; border: 1px solid var(--border);
            border-radius: 8px; font-size: 14px; outline: none;
        }
        .icon-picker-search input:focus { border-color: var(--accent); }
        .icon-picker-body { overflow-y: auto; padding: 10px 16px 16px; flex: 1; }
        .icon-cat-label {
            font-size: 11px; font-weight: 600; color: var(--text-muted);
            letter-spacing: .05em; text-transform: uppercase; margin: 12px 0 6px;
        }
        .icon-cat-label:first-child { margin-top: 2px; }
        .icon-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(46px, 1fr)); gap: 3px; margin-bottom: 2px; }
        .icon-option {
            width: 46px; height: 46px; font-size: 22px; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            border-radius: 8px; transition: background .1s; border: 1.5px solid transparent;
        }
        .icon-option:hover { background: #f3f4f6; border-color: #e5e7eb; }
        .icon-option.selected { background: #fff4f0; border-color: var(--accent); }

        /* HAMBURGER */
        .hamburger { display: none; background: none; border: none; cursor: pointer; padding: 4px; }
        .hamburger span { display: block; width: 22px; height: 2px; background: #374151; margin: 5px 0; border-radius: 2px; transition: .3s; }

        /* OVERLAY */
        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.4); z-index: 99; }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay.open { display: block; }
            .main { margin-left: 0; }
            .hamburger { display: block; }
            .form-row { grid-template-columns: 1fr; }
        }
    </style>
    @stack('styles')
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<aside class="sidebar" id="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
        <div class="sidebar-logo-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>
        </div>
        <div>
            <div class="sidebar-logo-text">USTA<span>.AZ</span></div>
            <div class="sidebar-subtitle">Admin Panel</div>
        </div>
    </a>

    <nav class="sidebar-nav">
        <div class="nav-section">Əsas</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="icon">📊</span> Dashboard
        </a>
        <a href="{{ route('admin.orders.index') }}" class="sidebar-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
            <span class="icon">📋</span> Sifarişlər
        </a>

        <div class="nav-section">Məzmun</div>
        <a href="{{ route('admin.services.index') }}" class="sidebar-link {{ request()->routeIs('admin.services*') ? 'active' : '' }}">
            <span class="icon">🔧</span> Xidmətlər
        </a>
        <a href="{{ route('admin.portfolio.index') }}" class="sidebar-link {{ request()->routeIs('admin.portfolio*') ? 'active' : '' }}">
            <span class="icon">🖼️</span> Portfolio
        </a>
        <a href="{{ route('admin.team.index') }}" class="sidebar-link {{ request()->routeIs('admin.team*') ? 'active' : '' }}">
            <span class="icon">👨‍🔧</span> Komanda
        </a>
        <a href="{{ route('admin.testimonials.index') }}" class="sidebar-link {{ request()->routeIs('admin.testimonials*') ? 'active' : '' }}">
            <span class="icon">⭐</span> Rəylər
        </a>
        <a href="{{ route('admin.faqs.index') }}" class="sidebar-link {{ request()->routeIs('admin.faqs*') ? 'active' : '' }}">
            <span class="icon">❓</span> FAQ
        </a>

        <div class="nav-section">Səhifələr</div>
        <a href="{{ route('admin.pages.hero') }}" class="sidebar-link {{ request()->routeIs('admin.pages.hero*') ? 'active' : '' }}">
            <span class="icon">🏠</span> Ana səhifə – Hero
        </a>
        <a href="{{ route('admin.pages.home') }}" class="sidebar-link {{ request()->routeIs('admin.pages.home*') ? 'active' : '' }}">
            <span class="icon">📝</span> Ana səhifə – Məzmun
        </a>
        <a href="{{ route('admin.pages.about') }}" class="sidebar-link {{ request()->routeIs('admin.pages.about*') ? 'active' : '' }}">
            <span class="icon">📄</span> Haqqımızda
        </a>
        <a href="{{ route('admin.pages.contact') }}" class="sidebar-link {{ request()->routeIs('admin.pages.contact*') ? 'active' : '' }}">
            <span class="icon">📬</span> Əlaqə səhifəsi
        </a>

        <div class="nav-section">Sistem</div>
        <a href="{{ route('admin.settings') }}" class="sidebar-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
            <span class="icon">⚙️</span> Tənzimləmələr
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <strong>{{ Auth::user()->name }}</strong>
            {{ Auth::user()->email }}
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Çıxış
            </button>
        </form>
    </div>
</aside>

<div class="main">
    <div class="topbar">
        <div style="display:flex;align-items:center;gap:12px;">
            <button class="hamburger" onclick="toggleSidebar()">
                <span></span><span></span><span></span>
            </button>
            <h1>@yield('title', 'Dashboard')</h1>
        </div>
        <div class="topbar-right">
            <a href="{{ route('home') }}" class="site-link" target="_blank">← Sayta get</a>
        </div>
    </div>

    <div class="content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @yield('content')
    </div>
</div>

{{-- ICON PICKER MODAL --}}
<div class="icon-picker-modal" id="iconPickerModal">
    <div class="icon-picker-box">
        <div class="icon-picker-header">
            <h3>İkon / Emoji seç</h3>
            <button class="icon-picker-close" onclick="closeIconPicker()" type="button">✕</button>
        </div>
        <div class="icon-picker-search">
            <input type="text" id="iconSearchInput" placeholder="🔍  Axtar..." autocomplete="off">
        </div>
        <div class="icon-picker-body" id="iconPickerBody"></div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function () {
        $('.summernote').summernote({
            height: 300,
            lang: 'en-US',
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                ['view', ['codeview']],
            ],
        });
    });

    /* ── ICON PICKER ── */
    var _iconPickerTarget = null;
    var _iconCategories = {
        '🔧 Alətlər və təmir': ['🔧','🔨','⚙️','🛠️','🔌','🪛','🔋','🪝','💡','🔩','🧰','🗜️','🪜','🧲','⛏️','🪚','📏','📐','🔮','🧪','🔬','🔭'],
        '🏠 Ev texnikası': ['📺','💻','🖥️','📱','📷','📻','🎮','📡','🖨️','🔊','📠','☎️','📞','🖱️','⌨️','💾','💿','📀'],
        '❄️ Soyuducu / Kondisioner': ['❄️','🧊','🌡️','💨','🌬️','♨️','🌊','💧','🔥','⚡','🌞','🌙','☀️','🌩️','🌀','🌪️'],
        '🚿 Santexnika': ['🚿','🛁','🚰','🪣','🪟','🚪','🏠','🏡','🛏️','🛋️','🪴','🧹','🧺','🚽','🪠','🧻'],
        '👨‍🔧 İnsanlar': ['👨‍🔧','👷','👩‍🔧','🧑‍🔧','👨‍💼','👩‍💼','👨‍🔬','👩‍🔬','🧑‍💻','👨‍🏭','👩‍🏭','🧑','👤','👥','🤝','👐'],
        '⭐ Ümumi': ['⭐','💎','🏆','🎯','✅','❎','📊','📈','💼','📋','🎁','🏅','🥇','✨','💫','🎉','📌','🔑','🛡️','⚠️','ℹ️','🆕','🔔','💬','📣'],
    };

    function openIconPicker(fieldId) {
        _iconPickerTarget = fieldId;
        _buildIconGrid();
        var current = document.getElementById('icon_val_' + fieldId).value;
        document.querySelectorAll('.icon-option').forEach(function(el) {
            el.classList.toggle('selected', el.dataset.emoji === current);
        });
        document.getElementById('iconSearchInput').value = '';
        _filterIcons('');
        document.getElementById('iconPickerModal').classList.add('open');
        setTimeout(function(){ document.getElementById('iconSearchInput').focus(); }, 80);
    }

    function closeIconPicker() {
        document.getElementById('iconPickerModal').classList.remove('open');
        _iconPickerTarget = null;
    }

    function _selectIcon(emoji) {
        if (!_iconPickerTarget) return;
        var hiddenEl = document.getElementById('icon_val_' + _iconPickerTarget);
        var displayEl = document.getElementById('icon_display_' + _iconPickerTarget);
        hiddenEl.value = emoji;
        if (displayEl) displayEl.textContent = emoji;
        hiddenEl.dispatchEvent(new Event('input', {bubbles: true}));
        closeIconPicker();
    }

    function _buildIconGrid() {
        var body = document.getElementById('iconPickerBody');
        if (body.dataset.built) return;
        var html = '';
        for (var cat in _iconCategories) {
            html += '<div class="icon-cat-label">' + cat + '</div><div class="icon-grid">';
            _iconCategories[cat].forEach(function(em) {
                html += '<button type="button" class="icon-option" data-emoji="' + em + '">' + em + '</button>';
            });
            html += '</div>';
        }
        body.innerHTML = html;
        body.dataset.built = '1';
        body.addEventListener('click', function(e) {
            var btn = e.target.closest('.icon-option');
            if (btn) _selectIcon(btn.dataset.emoji);
        });
    }

    function _filterIcons(query) {
        var q = query.trim().toLowerCase();
        document.querySelectorAll('.icon-grid').forEach(function(grid) {
            var visible = 0;
            grid.querySelectorAll('.icon-option').forEach(function(btn) {
                var show = !q || btn.dataset.emoji.includes(q);
                btn.style.display = show ? '' : 'none';
                if (show) visible++;
            });
            var label = grid.previousElementSibling;
            var hide = (q && visible === 0);
            if (label) label.style.display = hide ? 'none' : '';
            grid.style.display = hide ? 'none' : '';
        });
    }

    document.getElementById('iconSearchInput').addEventListener('input', function() {
        _filterIcons(this.value);
    });
    document.getElementById('iconPickerModal').addEventListener('click', function(e) {
        if (e.target === this) closeIconPicker();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeIconPicker();
    });

    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('sidebarOverlay').classList.toggle('open');
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sidebarOverlay').classList.remove('open');
    }
</script>
@stack('scripts')
</body>
</html>

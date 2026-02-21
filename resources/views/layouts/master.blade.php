<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Pendataan Kios & Kontrakan')</title>
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/unit.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/penyewa.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sewa.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/pembayaran.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/pengeluaran.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/laporan.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body>

    {{-- Sidebar Overlay (mobile tap to close) --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    @include('layouts.sidebar')

    <!-- MAIN -->
    <div class="main">

        @include('layouts.navbar')

        <!-- CONTENT -->
        <div class="content">
            @yield('content')
        </div>

    </div>

    <!-- Floating Clock -->
    <div id="floatingClock">
        <span id="clockText"></span>
    </div>

    <script>
        // ─── Real-time Clock ───────────────────────────
        function updateClock() {
            const now = new Date();
            const days   = ['Min','Sen','Sel','Rab','Kam','Jum','Sab'];
            const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
            const d     = days[now.getDay()];
            const date  = now.getDate();
            const month = months[now.getMonth()];
            const year  = now.getFullYear();
            const time  = now.toLocaleTimeString('id-ID', { hour:'2-digit', minute:'2-digit', second:'2-digit' });
            document.getElementById('clockText').innerText = `${d}, ${date} ${month} ${year}  ${time}`;
        }
        setInterval(updateClock, 1000);
        updateClock();

        // ─── Draggable Clock ───────────────────────────
        const clock = document.getElementById('floatingClock');
        let isDragging = false, offsetX, offsetY;

        clock.addEventListener('mousedown', function(e) {
            isDragging = true;
            offsetX = e.clientX - clock.offsetLeft;
            offsetY = e.clientY - clock.offsetTop;
            clock.style.right = 'auto';
        });
        document.addEventListener('mousemove', function(e) {
            if (!isDragging) return;
            clock.style.left = (e.clientX - offsetX) + 'px';
            clock.style.top  = (e.clientY - offsetY) + 'px';
        });
        document.addEventListener('mouseup', () => { isDragging = false; });

        // ─── Sidebar Toggle (Mobile) ──────────────────
        const sidebar        = document.querySelector('.sidebar');
        const overlay        = document.getElementById('sidebarOverlay');
        const hamburgerBtn   = document.getElementById('hamburgerBtn');

        function openSidebar() {
            sidebar.classList.add('open');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden'; // cegah scroll body saat sidebar terbuka
        }

        function closeSidebar() {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        hamburgerBtn.addEventListener('click', function() {
            if (sidebar.classList.contains('open')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });

        // Tap overlay → tutup sidebar
        overlay.addEventListener('click', closeSidebar);

        // Tutup sidebar otomatis saat klik link menu (mobile UX)
        document.querySelectorAll('.menu a').forEach(function(link) {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    closeSidebar();
                }
            });
        });

        // Tutup sidebar saat resize ke desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                closeSidebar();
            }
        });
    </script>

    @stack('scripts')
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>

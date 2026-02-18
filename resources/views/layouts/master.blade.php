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
        // Real-time clock
        function updateClock() {
            const now = new Date();
            const days = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            const d = days[now.getDay()];
            const date = now.getDate();
            const month = months[now.getMonth()];
            const year = now.getFullYear();
            const time = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            document.getElementById('clockText').innerText = `${d}, ${date} ${month} ${year}  ${time}`;
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Draggable clock
        const clock = document.getElementById('floatingClock');
        let isDragging = false,
            offsetX, offsetY;

        clock.addEventListener('mousedown', function(e) {
            isDragging = true;
            offsetX = e.clientX - clock.offsetLeft;
            offsetY = e.clientY - clock.offsetTop;
            clock.style.right = 'auto';
        });

        document.addEventListener('mousemove', function(e) {
            if (!isDragging) return;
            clock.style.left = (e.clientX - offsetX) + 'px';
            clock.style.top = (e.clientY - offsetY) + 'px';
        });

        document.addEventListener('mouseup', () => {
            isDragging = false;
        });
    </script>

    @stack('scripts')

</body>

</html>

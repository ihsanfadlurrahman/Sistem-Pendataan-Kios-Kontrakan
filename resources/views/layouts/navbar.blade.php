<!-- TOPBAR / NAVBAR -->
<div class="topbar">
    <div class="topbar-left">
        <button class="hamburger-btn" id="hamburgerBtn" aria-label="Toggle menu">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
        <h3>Sistem Pendataan Kios &amp; Kontrakan</h3>
        <div class="page-breadcrumb">@yield('page-title', 'Dashboard')</div>
    </div>

    <div class="topbar-right">
        <div class="topbar-user">
            <div class="user-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <span class="user-name">{{ auth()->user()->name ?? 'Admin' }}</span>
        </div>
    </div>
</div>

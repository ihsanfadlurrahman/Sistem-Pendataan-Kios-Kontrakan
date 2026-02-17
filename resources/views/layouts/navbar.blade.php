<!-- TOPBAR / NAVBAR -->
<div class="topbar">
    <div class="topbar-left">
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

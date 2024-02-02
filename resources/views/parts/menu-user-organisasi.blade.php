<ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item active">
        <a href="{{route('user.dashboard')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Kegiatan</span></li>
    <li class="menu-item">
        <a href="{{route('user.kegiatan')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-grid"></i>
            <div data-i18n="Basic">Kegiatan dan RPD</div>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{route('user.pelaksanaan')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-stats"></i>
            <div data-i18n="Basic">Pelaksanaan / Dokumen Pencairan</div>
        </a>
    </li>
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Proses Pencairan</span></li>
    <li class="menu-item">
        <a href="#" class="menu-link">
            <i class="menu-icon tf-icons bx bx-transfer-alt"></i>
            <div data-i18n="Basic">Tracking</div>
        </a>
    </li>
</ul>
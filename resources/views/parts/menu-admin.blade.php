<ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item active">
        <a href="index.html" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Kegiatan</span></li>
    <li class="menu-item">
        <a href="{{route('admin.rpd')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-collection"></i>
            <div data-i18n="Basic">RPD</div>
        </a>
    </li>
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Pengaturan</span></li>
    <li class="menu-item">
        <a href="{{route('admin.tahun.anggaran')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-collection"></i>
            <div data-i18n="Basic">DIPA & Bendahara</div>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{route('admin.tahun.anggaran')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-collection"></i>
            <div data-i18n="Basic">Kelola User</div>
        </a>
    </li>
</ul>
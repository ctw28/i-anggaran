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
            <div data-i18n="Basic">Daftar Kegiatan</div>
        </a>
    </li>
    <!-- <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-task"></i>
            <div data-i18n="Extended UI">RPD</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item">
                <a href="{{route('user.kegiatan')}}" class="menu-link">
                    <div data-i18n="Perfect Scrollbar">Rencana</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <div data-i18n="Text Divider">Realisasi RPD</div>
                </a>
            </li>
        </ul>
    </li> -->

    <!-- <li class="menu-item">
        <a href="{{route('user.pelaksanaan')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-stats"></i>
            <div data-i18n="Basic">Pelaksanaan / Dokumen Pencairan</div>
        </a>
    </li> -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Pencairan</span></li>
    <li class="menu-item">
        <a href="{{route('dokumen-pencairan')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-stats"></i>
            <div data-i18n="Basic">Dokumen Pencairan</div>
        </a>
    </li>
    <!-- <li class="menu-item">
        <a href="{{route('tracking')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-transfer-alt"></i>
            <div data-i18n="Basic">Tracking Dokumen</div>
        </a>
    </li> -->
</ul>
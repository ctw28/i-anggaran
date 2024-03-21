<ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item active">
        <a href="{{route('spi.dashboard')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Verifikator`</span></li>
    <!-- <li class="menu-item">
        <a href="{{route('spi.usulan')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-hive"></i>
            <div data-i18n="Basic">Usulan Periksa</div>
        </a>
    </li> -->

    <li class="menu-item open">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-food-menu"></i>
            <div data-i18n="Extended UI">Verifikasi Dokumen</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item">
                <a href="{{route('spi.periksa-dokumen')}}" class="menu-link">
                    <div data-i18n="Perfect Scrollbar">Pencairan</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <div data-i18n="Text Divider">Barjas</div>
                </a>
            </li>
        </ul>
    </li>

</ul>
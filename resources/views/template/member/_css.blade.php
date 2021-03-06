<style type="text/css">
    /* Change Primary */
    ::selection {background-color: {{ get_warna_primer() }}!important;}
    ::-moz-selection {background-color: {{ get_warna_primer() }}!important;}
    a {color: {{ get_warna_primer() }};}
    a:hover {color: {{ get_warna_sekunder() }};}
    .page-link {color: {{ get_warna_primer() }};}
    .page-link:hover {color: {{ get_warna_sekunder() }};}
    .nav-pills .nav-link.active, .nav-pills .show > .nav-link {background-color: {{ get_warna_primer() }}!important;}
    .material-half-bg .cover {background-color: {{ get_warna_primer() }}!important;}
    .app-sidebar {background-color: {{ get_warna_primer() }}!important;}
    .app-sidebar__toggle:focus, .app-sidebar__toggle:hover {background-color: {{ get_warna_sekunder() }}!important;}
    .text-primary {color: {{ get_warna_primer() }}!important;}
    .btn-primary {background-color: {{ get_warna_primer() }}!important; border-color: {{ get_warna_primer() }}!important;}
    .btn-primary:hover {background-color: {{ get_warna_sekunder() }}!important; border-color: {{ get_warna_sekunder() }}!important;}
    .page-item.active .page-link {background-color: {{ get_warna_primer() }}!important; border-color: {{ get_warna_primer() }}!important;}
    .form-control:focus {border-color: {{ get_warna_primer() }}!important;}
    .animated-checkbox input[type="checkbox"]:checked + .label-text:before {color: {{ get_warna_primer() }}!important;}
    .widget-small.primary.coloured-icon .icon {background-color: {{ get_warna_primer() }}!important;}
    .dropdown-item.active, .dropdown-item:active {background-color: {{ get_warna_primer() }}!important;}
	.treeview-menu {background-color: {{ get_warna_sekunder() }}!important;}
    .progress-bar {background-color: {{ get_warna_primer() }}!important;}
    .btn-outline-primary {color: {{ get_warna_primer() }}; background-color: transparent; background-image: none; border-color: {{ get_warna_primer() }};}
    .btn-outline-primary:hover {color: #FFF; background-color: {{ get_warna_primer() }}; border-color: {{ get_warna_primer() }};}
    .btn-outline-primary:not(:disabled):not(.disabled):active, .btn-outline-primary:not(:disabled):not(.disabled).active, .show > .btn-outline-primary.dropdown-toggle {color: #FFF; background-color: {{ get_warna_primer() }}; border-color: {{ get_warna_primer() }};}

    .login-content .login-box {min-height: 430px;}
    .app-menu__item.active, .app-menu__item:hover, .app-menu__item:focus {border-left-color: #fdd100!important;}
    .treeview.is-expanded [data-toggle='treeview'] {border-left-color: #fdd100!important;}
    .treeview-item .icon {margin-right: 10px;}
    .btn .icon, .btn .fa {margin-right: 0; width: 14px;}
    .app-header {background-color: #555!important;}
    .app-sidebar__user-avatar {border-radius: 0!important;}
    .app-menu {border-top: 1px solid #bbb;}
    .app-menu__submenu {margin-top: 2rem; padding: 8px 15px;}
    .app-menu__submenu .app-menu__label {color: #fff; font-size: 1rem; font-weight: bold; text-transform: uppercase;}
    .tab-content {border-top: 1px solid {{ get_warna_primer() }};}
    .separator {width: 100%; margin: 1rem; border-top: 1px solid #ddd;}
    .hidden-date {display: none;}

    @media(max-width: 767px){
	    .app-header__logo {display: none;}
	}

    @media(min-width: 768px){
	    .app-header__logo {background-color: {{ get_warna_primer() }}80!important; font-family: 'Lato'; text-transform: uppercase;}
	}
</style>
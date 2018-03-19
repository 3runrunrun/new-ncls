<body data-open="hover" data-menu="horizontal-top-icon-menu" data-col="2-columns" class="horizontal-layout horizontal-top-icon-menu 2-columns menu-expanded pace-done">
  <!-- pace -->
  <div class="pace pace-inactive">
    <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
      <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div>
  </div>
  <!-- /pace -->

  <!-- navbar -->
  <nav class="header-navbar navbar navbar-with-menu undefined navbar-light navbar-border">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav">
          <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="fa fa-bars"></i></a></li>
          <li class="nav-item"><a href="index.html" class="navbar-brand nav-link"><img alt="branding logo" src="<?php echo base_url() ?>/img/logo-small.png" data-expand="<?php echo base_url() ?>/img/logo-small.png" data-collapse="<?php echo base_url() ?>/img/logo-small.png" class="brand-logo"></a></li>
          <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="fa fa-user-circle"></i></a></li>
        </ul>
      </div>
      <?php var_dump($this->session->userdata()); ?>
      <div class="navbar-container content container-fluid">
        <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
          <ul class="nav navbar-nav float-xs-right">
            <li class="dropdown dropdown-user nav-item">
                <a href="#" data-toggle="dropdown" class="nav-link dropdown-user-link">
                  <span class="avatar avatar-online"></span>
                  <span class="user-name">John Doe</span>
                </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a href="#" class="dropdown-item"><i class="fa fa-user"></i> My Profile</a>
                <div class="dropdown-divider"></div><a href="#" class="dropdown-item"><i class="fa fa-sign-out"></i> Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- /navbar -->

  <!-- Horizontal navigation-->
  <div role="navigation" data-menu="menu-wrapper" class="header-navbar navbar navbar-horizontal navbar-fixed bg-blue navbar-without-dd-arrow navbar-bordered navbar-shadow">
    <!-- Horizontal menu content-->
    <div data-menu="menu-container" class="navbar-container main-menu-content">
      <ul id="main-menu-navigation" data-menu="menu-navigation" class="nav navbar-nav">
        <!-- dashboard -->
        <li class="nav-item">
          <a href="<?php echo site_url() ?>/dashboard" class="nav-link"><i class="fa fa-tachometer "></i>Dashboard</a>
        </li>
        <!-- dashboard -->

        <!-- master -->
        <li data-menu="dropdown" class="dropdown nav-item"><a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link menu"><i class="fa fa-user"></i>Master</a>
          <ul class="dropdown-menu">
            <li data-menu=""><a href="<?php echo site_url() ?>/master-area" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-map-marker"></i>Master Area</a>
            </li>
            <li data-menu=""><a href="<?php echo site_url() ?>/master-distributor" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-truck"></i>Master Distributor</a>
            </li>
            <li data-menu=""><a href="<?php echo site_url() ?>/master-subdistributor" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-shopping-basket"></i>Master Subdistributor</a>
            </li>
            <li data-menu=""><a href="<?php echo site_url() ?>/master-detailer" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-at"></i>Master Detailer</a>
            </li>
            <li data-menu=""><a href="<?php echo site_url() ?>/master-operasional" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-money"></i>Master Operasional</a>
            </li>
            <li data-menu=""><a href="<?php echo site_url() ?>/master-cogm" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-stack-overflow"></i>Master COGM</a>
            </li>
            <li data-menu=""><a href="<?php echo site_url() ?>/master-aset" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-archive"></i>Master Aset</a>
            </li>
            <li data-menu=""><a href="<?php echo site_url() ?>/master-customer" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-user"></i>Master Customer</a>
            </li>
            <li data-menu=""><a href="<?php echo site_url() ?>/master-customer-non" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-users"></i>Master Customer (Non)</a>
            </li>
            <li data-menu=""><a href="<?php echo site_url() ?>/master-outlet" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-building-o"></i>Master Outlet</a>
            </li>
            <li data-menu=""><a href="<?php echo site_url() ?>/master-product" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-medkit"></i>Master Produk</a>
            </li>
          </ul>
        </li>
        <!-- /master -->

        <!-- transaction -->
        <li data-menu="dropdown" class="dropdown nav-item"><a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link"><i class="fa fa-money"></i>Transaction</a>
          <ul class="dropdown-menu">
            <li data-menu=""><a href="<?php echo site_url() ?>/subdist" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-money"></i>Subdist</a>
            </li>
            <li data-menu=""><a href="<?php echo site_url() ?>/prospek-ineks" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-money"></i>Prospek Intensifikasi Ekstensifikasi</a>
            </li>
            <li data-menu=""><a href="<?php echo site_url() ?>/fixed-cost" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-money"></i>Fixed Cost &amp; Ratio</a>
            </li>
            <li data-menu=""><a href="<?php echo site_url() ?>/rtd" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-money"></i>Prospect RTD</a>
            </li>
            <li data-menu=""><a href="<?php echo site_url() ?>/pma" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-money"></i>Prospect Marketing Activity</a>
            </li>
            <li data-menu=""><a href="<?php echo site_url() ?>/evaluasi-target-customer" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-money"></i>Evaluasi Target Customer</a>
            </li>
            <li data-menu="dropdown-submenu" class="dropdown dropdown-submenu"><a href="#" data-toggle="dropdown" class="dropdown-item dropdown-toggle"><i class="fa fa-money"></i>Monthly Call Plan</a>
              <ul class="dropdown-menu">
                <li data-menu="" ><a href="<?php echo site_url(); ?>/target-call-plan" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-money"></i>Target Call Plan</a>
                </li>
                <li data-menu="" ><a href="<?php echo site_url(); ?>/evaluasi-call-plan" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-money"></i>Evaluasi Call Plan</a>
                </li>
              </ul>
            </li>
            <li data-menu=""><a href="<?php echo site_url(); ?>/wpr" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-money"></i>WPR</a>
            </li>
            <li data-menu=""><a href="<?php echo site_url(); ?>/promo-trial" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-money"></i>Promo Trial</a>
            </li>
            <li data-menu="dropdown-submenu" class="dropdown dropdown-submenu"><a href="#" data-toggle="dropdown" class="dropdown-item dropdown-toggle"><i class="fa fa-money"></i>Surat Permohonan Disc. On &amp; Off Faktur</a>
              <ul class="dropdown-menu">
                <li data-menu="" ><a href="<?php echo site_url(); ?>/daftar-faktur" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-money"></i>Daftar Faktur</a>
                </li>
                <li data-menu="" ><a href="<?php echo site_url(); ?>/ko-general" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-money"></i>General</a>
                </li>
                <li data-menu="" ><a href="<?php echo site_url(); ?>/ko-tender" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-money"></i>Tender</a>
                </li>
              </ul>
            </li>

          </ul>
        </li>
        <!-- /transaction -->

        <!-- report -->
        <li data-menu="dropdown" class="dropdown nav-item"><a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link"><i class="fa fa-table"></i>Report</a>
          <ul class="dropdown-menu">
            <li data-menu="dropdown-submenu" class="dropdown dropdown-submenu"><a href="#" data-toggle="dropdown" class="dropdown-item dropdown-toggle"><i class="fa fa-table"></i>Daily Sales</a>
              <ul class="dropdown-menu">
                <li data-menu="" ><a href="<?php echo site_url() ?>/daily-sales-product" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-table"></i>per Product</a>
                </li>
                <li data-menu=""><a href="<?php echo site_url() ?>/daily-sales-outlet" data-toggle="dropdown" class="dropdown-item"><i  class="fa fa-table"></i>per Outlet</a>
                </li>
              </ul>
            </li>
            <li data-menu=""><a href="<?php echo site_url() ?>/sales-distributor" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-table"></i>Data Sales Distributor dan Jenis Product (all area per year)</a>
            </li>
            <li data-menu=""><a href="<?php echo site_url() ?>/stock-product-nucleus" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-table"></i>Data Stock Product (Nucleus)</a>
            </li>
            <li data-menu=""><a href="<?php echo site_url(); ?>/stock-product-distributor" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-table"></i>Data Stock Product (Distributor)</a>
            </li>
            <li data-menu="dropdown-submenu" class="dropdown dropdown-submenu"><a href="#" data-toggle="dropdown" class="dropdown-item dropdown-toggle"><i class="fa fa-table"></i>Entry Breakdown Analisis Sales</a>
              <ul class="dropdown-menu">
                <li data-menu="dropdown-submenu" class="dropdown dropdown-submenu"><a href="#" data-toggle="dropdown" class="dropdown-item dropdown-toggle"><i class="fa fa-table"></i>per Outlet</a>
                  <ul class="dropdown-menu">
                    <li data-menu="" ><a href="<?php echo site_url() ?>/entry-breakdown-general" data-toggle="dropdown" class="dropdown-item">General</a>
                    </li>
                    <li data-menu=""><a href="<?php echo site_url() ?>/entry-breakdown-product" data-toggle="dropdown" class="dropdown-item">per Produk</a>
                  </ul>
                </li>
              </ul>
            </li>
            <li data-menu=""><a href="<?php echo site_url() ?>" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-table"></i>Laporan Pemindahan Sales</a>
            </li>
            <li data-menu=""><a href="<?php echo site_url() ?>/actual-sales" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-table"></i>Laporan Actual Sales per Year</a>
            </li>
            <li data-menu=""><a href="<?php echo site_url() ?>" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-table"></i>Reward</a>
            </li>
            <li data-menu="dropdown-submenu" class="dropdown dropdown-submenu"><a href="#" data-toggle="dropdown" class="dropdown-item dropdown-toggle"><i class="fa fa-table"></i>Key Loyalty Management (KLM)</a>
              <ul class="dropdown-menu">
                <li data-menu="" ><a href="<?php echo site_url() ?>/daily-sales-product" data-toggle="dropdown" class="dropdown-item"><i class="fa fa-table"></i>Sales (Leveling)</a>
                </li>
                <li data-menu=""><a href="<?php echo site_url() ?>/daily-sales-outlet" data-toggle="dropdown" class="dropdown-item"><i  class="fa fa-table"></i>Dana</a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <!-- /report -->
      </ul>
    </div>
    <!-- /horizontal menu content-->
  </div>
  <!-- Horizontal navigation-->

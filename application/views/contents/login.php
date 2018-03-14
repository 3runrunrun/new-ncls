<body data-open="hover" data-menu="horizontal-top-icon-menu" data-col="1-column" class="horizontal-layout horizontal-top-icon-menu 1-column  blank-page blank-page">
<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body"><section class="flexbox-container">
<div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1  box-shadow-2 p-0">
    <div class="card border-grey border-lighten-3 m-0">
        <div class="card-header no-border">
            <div class="card-title text-xs-center">
                <div class="p-1"><img src="<?php echo base_url(); ?>/img/logo-small.png" alt="branding logo"></div>
            </div>
            <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2"><span>Login</span></h6>
        </div>
        <div class="card-body collapse in">
            <div class="card-block">
                <form class="form-horizontal form-simple" action="<?php echo site_url(); ?>/auth" method="POST" role="form">
                    <fieldset class="form-group position-relative has-icon-left mb-0">
                        <input type="text" name="username" class="form-control form-control-lg input-lg" id="user-name" placeholder="Your Username" required>
                        <div class="form-control-position">
                            <i class="fa fa-user"></i>
                        </div>
                    </fieldset>
                    <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" name="password" class="form-control form-control-lg input-lg" id="user-password" placeholder="Enter Password" required>
                        <div class="form-control-position">
                            <i class="fa fa-unlock"></i>
                        </div>
                    </fieldset>
                    <fieldset class="form-group position-relative has-icon-left">
                        <input type="number" name="tahun" class="form-control form-control-lg input-lg" id="tahun" placeholder="Year" min="2017" max="<?php echo date('Y'); ?>" required>
                        <div class="form-control-position">
                            <i class="fa fa-flag"></i>
                        </div>
                        <p>*) Masukkan tahun laporan yang akan dibuka</p>
                    </fieldset>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->
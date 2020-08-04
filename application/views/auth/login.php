<div id="notifikasi"><?php echo $this->session->flashdata('msg'); ?></div>
<form class="login100-form validate-form" id="sign_in" method="POST" autocomplete="off" action="<?php echo base_url(); ?>auth/login">
  <div class="login100-form-avatar">
    <img src="<?php echo base_url(); ?>assets/loginv2/images/logo.png" alt="AVATAR">
  </div>

  <span class="login100-form-title p-t-20 p-b-45">

  </span>

  <div class="wrap-input100 validate-input m-b-10" data-validate="Username is required">
    <input class="input100" type="text" name="username" placeholder="Username">
    <span class="focus-input100"></span>
    <span class="symbol-input100">
      <i class="fa fa-user"></i>
    </span>
  </div>

  <div class="wrap-input100 validate-input m-b-10" data-validate="Password is required">
    <input class="input100" name="password" placeholder="Password" placeholder="Password" type="password">
    <span class="focus-input100"></span>
    <span class="symbol-input100">
      <i class="fa fa-lock"></i>
    </span>
  </div>

  <div class="container-login100-form-btn p-t-10">
    <button class="login100-form-btn" name="submit" type="submit">
      Login
    </button>
  </div>

  <div class="text-center w-full p-t-25 p-b-230">
    <a href="#" class="txt1">

    </a>
  </div>

  <div class="text-center w-full">
    <a class="txt1" href="#">

      <i class="fa fa-long-arrow-right"></i>
    </a>
  </div>
</form>
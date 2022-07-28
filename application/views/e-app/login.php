
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8">
    <!-- Fontfaces CSS-->
    <link href="<?=base_url();?>e-app/css/font-face.css" rel="stylesheet" media="all">
    <!-- Bootstrap CSS-->
    <link href="<?=base_url();?>e-app/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="<?=base_url();?>e-app/css/theme.css" rel="stylesheet" media="all">

    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="<?=base_url();?>e-app/images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <?php
											 $x=array('class'=>'form',
															'id' =>'approval'); 
											  echo form_open('ldap/',$x);				
											 ?>
                                <div class="form-group">
                                    <label>User ID </label>
                                    <input class="au-input au-input--full" type="user" name="user" placeholder="User Windows">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="pwd" placeholder="Password">
                                </div>
                                <div class="login-checkbox">
                                    <label>
									<?php if(isset($msg)){echo $msg;}else{ ?>
									 <input type="checkbox" name="remember">Remember Me
									<?php }?>
                                       
                                    </label>
                                    <label>
                                        <a href="#">Forgotten Password?</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                                <div class="social-login-content">
                                    <div class="social-button">
                                        <button class="au-btn au-btn--block au-btn--blue m-b-20">sign in with facebook</button>
                                        <button class="au-btn au-btn--block au-btn--blue2">sign in with twitter</button>
                                    </div>
                                </div>
                            </form>
                            <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="#">Sign Up Here</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
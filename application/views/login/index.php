<head>
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Panasonic</title>
	<link rel="stylesheet" href="<?=base_url();?>assets/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url();?>assets/assets/css/style.css">
	<script src="<?=base_url();?>assets/assets/js/jquery-1.10.2.min.js"></script>
	<script src="<?=base_url();?>assets/assets/js/bootstrap.min.js"></script>
	<script src="<?=base_url();?>assets/assets/js/custom.js"></script>
	<link rel="shortcut icon" href="<?=base_url();?>assets/ico/p.png">
</head>
<body>
<form  ACTION="log_in" method='POST'>
<div class="container">
    <div id="loginbox" style="margin-top:23%;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Login<?php if(isset($messg)) echo $messg;?></div>
                <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
            </div>     
            <div style="padding-top:30px;background: #eff4f9;" class="panel-body" >
                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                <form id="loginform" class="form-horizontal" method="post" role="form">
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="email" type="text" class="form-control" name="username" value="" placeholder="id">
                    </div>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="password" placeholder="password">
                    </div>
                    <div class="input-group">
                        <div class="checkbox">
                            <label>
                              <input id="remember" type="checkbox" name="remember" value="1"> Remember me
                            </label>
                        </div>
                    </div>
                    <div style="margin-top:10px" class="form-group" >
						 <div class="text-center"> <button style="width:50%" class="btn btn-primary btn-sx" type="submit" type="button">Login</button>
						 </div>
                    </div>
                </form> 
				<div class="form-group">
                    <div class="col-md-12 control">
                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                            Don't have an account! 
                        </div>
                    </div>
                </div>    
            </div>                     
        </div>  
    </div>
</div>
</body>

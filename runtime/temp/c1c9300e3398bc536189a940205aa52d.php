<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:61:"D:\wamp\www\OneBase\public/../app/admin\view\login\login.html";i:1505185598;s:60:"D:\wamp\www\OneBase\public/../app/admin\view\layout\top.html";i:1505376769;s:63:"D:\wamp\www\OneBase\public/../app/admin\view\layout\bottom.html";i:1505376432;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>OneBase <?php if(!(empty($ob_title) || (($ob_title instanceof \think\Collection || $ob_title instanceof \think\Paginator ) && $ob_title->isEmpty()))): ?> | <?php echo $ob_title; endif; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="__STATIC__/ext/adminlte/bootstrap/css/bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="__STATIC__/ext/adminlte/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="__STATIC__/ext/adminlte/dist/css/skins/_all-skins.css">
    <link rel="stylesheet" href="__STATIC__/ext/toastr/toastr.min.css">
    <link rel="stylesheet" href="__STATIC__/ext/btnloading/dist/ladda-themeless.min.css">
    <link rel="stylesheet" href="__STATIC__/admin/css/onebase.css">
    <link rel="stylesheet" type="text/css" href="__STATIC__/ext/remodal/remodal.css" media="all">
    <link rel="stylesheet" type="text/css" href="__STATIC__/ext/remodal/remodal-default-theme.css" media="all">
    <!-- jQuery 2.2.3 -->
    <script src="__STATIC__/ext/adminlte/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="__STATIC__/ext/adminlte/bootstrap/js/bootstrap.min.js"></script>
    <script src="__STATIC__/admin/js/init.js"></script>
    
    <link rel="stylesheet" href="__STATIC__/ext/adminlte/dist/css/font-awesome.min.css">
    <link rel="stylesheet" href="__STATIC__/ext/adminlte/dist/css/ionicons.min.css">
</head>
<body class="hold-transition login-page admin-login-body-background">
    
<script src="__STATIC__/admin/js/login_background.js"></script>

<canvas></canvas>

<div class="admin-login-box">
  <div class="login-logo">
      <a href="" class="login-logo-a"><b>One</b>Base</a>
  </div>

  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">请输入您的登录信息</p>

    <form action="<?php echo url('loginHandle'); ?>" method="post" class="admin-login-form">
      <div class="form-group has-feedback">
           <input type="text" name="username" value="demo" class="form-control" placeholder="请输入您的用户名">
           <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
           <input type="password" name="password" value="111111" class="form-control" placeholder="请输入您的密码">
           <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
        
        <div>
            <img src="<?php echo captcha_src(); ?>" alt="captcha" class="admin-login-captcha-img captcha_change" id="captcha_img"/>
        </div>
        <br/>
      <div class="row">
        <div class="col-xs-8">
          <input type="text" name="verify" class="form-control verify" placeholder="请输入您的验证码">
          <span class="glyphicon glyphicon-open form-control-feedback admin-login-captcha-input-icon"></span>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="button" class="btn btn-primary btn-block btn-flat captcha_change">换一张</button>
        </div>
        <!-- /.col -->
      </div>

        <div class="social-auth-links text-center">
            
          <button  type="submit" class="btn btn-block btn-facebook ladda-button login-submit-button" data-style="slide-up">
              <span class="ladda-label">登 录</span>
          </button>
            
          <button  type="button" class="btn btn-block btn-google btn-flat">忘记密码</button>
        </div>
    </form>

    <!-- /.social-auth-links -->
    <!--<a href="#">找回密码</a><br>-->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<script src="__STATIC__/ext/adminlte/dist/js/app.min.js"></script>
<script src="__STATIC__/ext/adminlte/dist/js/init.js"></script>
<script src="__STATIC__/ext/toastr/toastr.min.js"></script>
<script src="__STATIC__/ext/btnloading/dist/spin.min.js"></script>
<script src="__STATIC__/ext/btnloading/dist/ladda.min.js"></script>
<script src="__STATIC__/ext/remodal/remodal.min.js"></script>
<script src="__STATIC__/admin/js/onebase.js"></script>
<link rel="stylesheet" href="__STATIC__/admin/css/ob_skin.css">
<script type="text/javascript">setTimeout(function(){ $('.fakeloader').hide(); }, 500);</script>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit(); /*a:9:{s:62:"D:\wamp\www\OneBase\public/../app/admin\view\api\api_edit.html";i:1505185598;s:56:"D:\wamp\www\OneBase\public/../app/admin\view\layout.html";i:1505185598;s:60:"D:\wamp\www\OneBase\public/../app/admin\view\layout\top.html";i:1505185598;s:63:"D:\wamp\www\OneBase\public/../app/admin\view\layout\header.html";i:1505185598;s:69:"D:\wamp\www\OneBase\public/../app/admin\view\layout\sidebar_left.html";i:1505185598;s:63:"D:\wamp\www\OneBase\public/../app/admin\view\layout\crumbs.html";i:1505185598;s:63:"D:\wamp\www\OneBase\public/../app/admin\view\layout\footer.html";i:1505185598;s:70:"D:\wamp\www\OneBase\public/../app/admin\view\layout\sidebar_right.html";i:1505185598;s:63:"D:\wamp\www\OneBase\public/../app/admin\view\layout\bottom.html";i:1505185598;}*/ ?>
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
    <link rel="stylesheet" type="text/css" href="__STATIC__/ext/animsition/dist/css/animsition.min.css" media="all">
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
    <script src="__STATIC__/ext/animsition/dist/js/jquery.animsition.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="__STATIC__/ext/adminlte/bootstrap/js/bootstrap.min.js"></script>
    <script src="__STATIC__/admin/js/init.js"></script>
    
    <link rel="stylesheet" href="__STATIC__/ext/adminlte/dist/css/font-awesome.min.css">
    <link rel="stylesheet" href="__STATIC__/ext/adminlte/dist/css/ionicons.min.css">
    
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper animsition">
  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo url('Index/index'); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>OB</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>OneBase</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">导航开关</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
              
<!--            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>-->
              
            <ul class="dropdown-menu">
              <li class="header">您有4个消息</li>
              
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="__STATIC__/ext/adminlte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                         张三
                        <small><i class="fa fa-clock-o"></i> 5 分钟前</small>
                      </h4>
                      <p>吃饭了吗？</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="__STATIC__/ext/adminlte/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        李四
                        <small><i class="fa fa-clock-o"></i> 2 小时前</small>
                      </h4>
                      <p>麻烦发下今天的文章哦。</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">查看所有消息</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
<!--            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>-->
            <ul class="dropdown-menu">
              <li class="header">您有10个通知</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 今天有5个新成员加入
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> 这是一条系统警告通知。
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 销售了25个产品喔
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> 用户名修改通知
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">查看所有通知</a></li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="__STATIC__/ext/adminlte/dist/img/user3-128x128.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $member_info['nickname']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="__STATIC__/ext/adminlte/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">

                <p>
                    <?php echo $member_info['nickname']; ?>
                  <small>上次登录时间：<?php echo $member_info['update_time']; ?></small>
                </p>
              </li>
              <!-- Menu Body -->
<!--              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">个人中心</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">修改头像</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">修改密码</a>
                  </div>
                </div>
                 /.row 
              </li>-->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat clear_cache" url="<?php echo url('Login/clearCache'); ?>">清理缓存</a>
                </div>
                <div class="pull-right">
                  <a class="btn btn-default btn-flat logout" url="<?php echo url('Login/logout'); ?>">安全退出</a>
                </div>
              </li>
            </ul>
          </li>
          
          <!-- 控制栏切换按钮 -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- 左侧导航栏 -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="__STATIC__/ext/adminlte/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p><?php echo $member_info['nickname']; ?></p>
            <?php echo $member_info['update_time']; ?>
          <!--<a href="#"><i class="fa fa-circle text-success"></i> 在线状态</a>-->
        </div>
      </div>
      
      
      <!-- search form -->
<!--      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="请输入搜索内容...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>-->
      <!-- /.search form -->
      
      <!-- 左侧菜单 -->
      <ul class="sidebar-menu">
        <?php echo $menu_view; ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php if(!(empty($ob_title) || (($ob_title instanceof \think\Collection || $ob_title instanceof \think\Paginator ) && $ob_title->isEmpty()))): ?><?php echo $ob_title; endif; if(!(empty($ob_describe) || (($ob_describe instanceof \think\Collection || $ob_describe instanceof \think\Paginator ) && $ob_describe->isEmpty()))): ?><small><?php echo $ob_describe; ?></small><?php endif; ?>
      </h1>
      <?php echo $crumbs_view; ?>
    </section>

    <!-- Main content -->
    <section class="content">
<form action="<?php echo url(); ?>" method="post" class="form_single">
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>名称</label>
              <span>（API接口名称）</span>
              <input class="form-control" name="name" placeholder="请输入API接口名称" value="<?php echo (isset($info['name']) && ($info['name'] !== '')?$info['name']:''); ?>" type="text">
            </div>
          </div>
            
          <div class="col-md-6">
            <div class="form-group">
              <label>排序</label>
              <span>（API接口排序值）</span>
              <input class="form-control" name="sort" placeholder="请输入API接口排序值" value="<?php echo (isset($info['sort']) && ($info['sort'] !== '')?$info['sort']:'0'); ?>" type="text">
            </div>
          </div>
            
            
          <div class="col-md-6">
            <div class="form-group">
              <label>请求地址</label>
              <span>（控制器/方法名）</span>
              <input class="form-control" name="api_url" placeholder="请输入请求地址" value="<?php echo (isset($info['api_url']) && ($info['api_url'] !== '')?$info['api_url']:''); ?>" type="text">
            </div>
          </div>
            
          <div class="col-md-6">
            <div class="form-group">
              <label>请求类型</label>
              <span>（POST）</span>
                <select name="request_type" class="form-control">
                    <option value="0">POST</option>
                    <!--<option value="1">GET</option>-->
                </select>
            </div>
          </div>
            
            
        <div class="col-md-6">
          <div class="form-group">
            <label>是否为分页接口</label>
            <span>（若为分页接口则需传递分页相关参数）</span>
              <div>
                  <label class="margin-r-5"><input type="radio" checked="checked" name="is_page"  value="0"> 否</label>
                  <label><input type="radio" name="is_page" value="1"> 是</label>
              </div>
          </div>
        </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>研发者</label>
                <select name="developer" class="form-control">
                    <?php $_result=parse_config_array('team_developer');if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $key; ?>"><?php echo $vo; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
          </div>

            
          <div class="col-md-6">
            <div class="form-group">
              <label>请求数据</label>
              <span>（若为否则无需添加请求字段）</span>
                <div>
                    <label class="margin-r-5"><input type="radio" checked="checked" name="is_request_data"  value="0"> 否</label>
                    <label><input type="radio" name="is_request_data" value="1"> 是</label>
                </div>
              <table id="request_data_table" style="display : none;"></table>
            </div>
          </div>
            
          <div class="col-md-6">
              
            <div class="form-group">
              <label>响应数据</label>
              <span>（若为否则无需添加响应字段）</span>
                <div>
                    <label class="margin-r-5"><input type="radio" checked="checked" name="is_response_data"  value="0"> 否</label>
                    <label><input type="radio" name="is_response_data" value="1"> 是</label>
                </div>
              <table id="response_data_table" style="display : none;"></table>
            </div>
          </div>
        </div>
          <div class="row">

              
            <div class="col-md-6">

              <div class="form-group">
                <label>是否验证用户令牌：user_token</label>
                <span>（若为否则为无需验证身份的接口，若为是则需要登录后获取 user_token）</span>
                  <div>
                      <label class="margin-r-5"><input type="radio" checked="checked" name="is_user_token"  value="0"> 否</label>
                      <label><input type="radio" name="is_user_token" value="1"> 是</label>
                  </div>
              </div>
            </div>

            <div class="col-md-6">

              <div class="form-group">
                <label>是否响应数据签名：data_sign</label>
                <span>（若为否则无需验证数据签名，若为是则会返回 data_sign 用于验证数据是否安全）</span>
                  <div>
                      <label  class="margin-r-5"><input type="radio" checked="checked" name="is_data_sign"  value="0"> 否</label>
                      <label><input type="radio" name="is_data_sign" value="1"> 是</label>
                  </div>
              </div>
            </div>
              
          <div class="col-md-6">
            <div class="form-group">
              <label>分组</label>
                <select name="group_id" class="form-control">
                    <option value="0">---请选择分组---</option>
                    <?php if(is_array($group_list) || $group_list instanceof \think\Collection || $group_list instanceof \think\Paginator): $i = 0; $__LIST__ = $group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
          </div>
              
            
          <div class="col-md-6">
            <div class="form-group">
              <label>接口状态</label>
                <select name="api_status" class="form-control">
                    <?php $_result=parse_config_array('api_status_option');if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $key; ?>"><?php echo $vo; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
          </div>
              
          <div class="col-md-6">
            <div class="form-group">
                <label>接口响应示例</label>
                <textarea class="form-control" name="response_examples" rows="3" placeholder="请输入接口响应示例"><?php echo (isset($info['response_examples']) && ($info['response_examples'] !== '')?$info['response_examples']:''); ?></textarea>
            </div>
          </div>
              
          <div class="col-md-6">
            <div class="form-group">
                <label>接口简介</label>
                <textarea class="form-control" name="describe" rows="3" placeholder="请输入接口简介"><?php echo (isset($info['describe']) && ($info['describe'] !== '')?$info['describe']:''); ?></textarea>
            </div>
          </div>

              
          <div class="col-md-12">
            <div class="form-group">
                <label>接口文本描述</label>
                <textarea class="form-control textarea_editor" name="describe_text" placeholder="请输入接口文本描述"><?php echo (isset($info['describe_text']) && ($info['describe_text'] !== '')?$info['describe_text']:''); ?></textarea>
            </div>
          </div>
              
              
        </div>
          
        </div>
        
        
        
        
      <div class="box-footer">
          
        <input type="hidden" name="id" value="<?php echo (isset($info['id']) && ($info['id'] !== '')?$info['id']:'0'); ?>"/>
        
        <button  type="submit" class="btn ladda-button ajax-post" data-style="slide-up" target-form="form_single">
            <span class="ladda-label">确 定</span>
        </button>
         
        <a class="btn" onclick="javascript:history.back(-1);return false;"> 返 回</a>
      </div>
        
      </div>

    

    
    
</form>

<?php echo hook('ArticleEditor', array('name'=> 'describe_text')); ?>

<script type="text/javascript">

    ob.setValue("request_type", <?php echo (isset($info['request_type']) && ($info['request_type'] !== '')?$info['request_type']:0); ?>);
    ob.setValue("is_page", <?php echo (isset($info['is_page']) && ($info['is_page'] !== '')?$info['is_page']:0); ?>);
    ob.setValue("developer", <?php echo (isset($info['developer']) && ($info['developer'] !== '')?$info['developer']:0); ?>);
    ob.setValue("is_request_data", <?php echo (isset($info['is_request_data']) && ($info['is_request_data'] !== '')?$info['is_request_data']:0); ?>);
    ob.setValue("is_response_data", <?php echo (isset($info['is_response_data']) && ($info['is_response_data'] !== '')?$info['is_response_data']:0); ?>);
    ob.setValue("is_user_token", <?php echo (isset($info['is_user_token']) && ($info['is_user_token'] !== '')?$info['is_user_token']:0); ?>);
    ob.setValue("is_data_sign", <?php echo (isset($info['is_data_sign']) && ($info['is_data_sign'] !== '')?$info['is_data_sign']:0); ?>);
    ob.setValue("group_id", <?php echo (isset($info['group_id']) && ($info['group_id'] !== '')?$info['group_id']:0); ?>);
    ob.setValue("api_status", <?php echo (isset($info['api_status']) && ($info['api_status'] !== '')?$info['api_status']:0); ?>);

    showOrHideFieldData(<?php echo (isset($info['is_request_data']) && ($info['is_request_data'] !== '')?$info['is_request_data']:0); ?>, 'request_data_table'); 
    showOrHideFieldData(<?php echo (isset($info['is_response_data']) && ($info['is_response_data'] !== '')?$info['is_response_data']:0); ?>, 'response_data_table'); 

    $(function(){

        $("input[name=is_request_data]").click(function(){ showOrHideFieldData($(this).val(), 'request_data_table'); });
        $("input[name=is_response_data]").click(function(){ showOrHideFieldData($(this).val(), 'response_data_table'); });
    });


    function showOrHideFieldData(handle, mark)
    {
        if (1 == handle) { $('#' + mark).show(); } else { $('#' + mark).hide(); }
    }
    
    var default_text_name = 'request_data[field_name][]';
    var api_data_type_option = "<?php echo $api_data_type_option; ?>";
    
</script>

<script src="__STATIC__/ext/edittable/jquery.edittable.js"></script>
<link rel="stylesheet" href="__STATIC__/ext/edittable/jquery.edittable.min.css">

<script type="text/javascript">

var request_data_table = $('#request_data_table').editTable({
    field_templates: {
        'request_data_field_describe' : {
            html: "<textarea name='request_data[field_describe][]'/>",
            getValue: function (input) {
                return $(input).val();
            },
            setValue: function (input, value) {
                return $(input).text(value);
            }
        },
        'request_data_is_require' : {
            html: "<select name='request_data[is_require][]' style='margin: 5px;'><option value='1'>是</option><option  value='0'>否</option></select>",
            getValue: function (input) {
                return $(input).val();
            },
            setValue: function (input, value) {
                var select = $(input);
                select.find('option').filter(function() {
                    return $(this).val() == value; 
                }).attr('selected', true);
                return select;
            }
        },
        'request_data_type' : {
            html: "<select name='request_data[data_type][]' style='margin: 5px;'>"+api_data_type_option+"</select>",
            getValue: function (input) {
                return $(input).val();
            },
            setValue: function (input, value) {
                var select = $(input);
                select.find('option').filter(function() {
                    return $(this).val() == value; 
                }).attr('selected', true);
                return select;
            }
        }
    },
    row_template: ['text', 'request_data_type', 'request_data_is_require', 'request_data_field_describe'],
    headerCols: ['字段名称', '数据类型', '&nbsp;&nbsp;是否必填&nbsp;&nbsp;' , '字段描述'],
    first_row: false,
    data: [],
    tableClass: 'inputtable custom'
});

request_data_table.loadData(<?php echo $info['request_data_json']; ?>);

default_text_name = 'response_data[field_name][]';

var response_data_table = $('#response_data_table').editTable({
    field_templates: {
        'response_data_field_describe' : {
            html: "<textarea name='response_data[field_describe][]'/>",
            getValue: function (input) {
                return $(input).val();
            },
            setValue: function (input, value) {
                return $(input).text(value);
            }
        },
        'response_data_type' : {
            html: "<select name='response_data[data_type][]' style='margin: 5px;'>"+api_data_type_option+"</select>",
            getValue: function (input) {
                return $(input).val();
            },
            setValue: function (input, value) {
                var select = $(input);
                select.find('option').filter(function() {
                    return $(this).val() == value; 
                }).attr('selected', true);
                return select;
            }
        }
    },
    row_template: ['text', 'response_data_type', 'response_data_field_describe'],
    headerCols: ['字段名称', '数据类型', '字段描述'],
    first_row: false,
    data: [],
    tableClass: 'inputtable custom'
});

response_data_table.loadData(<?php echo $info['response_data_json']; ?>);

</script>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>版本号</b> 1.0.0
    </div>
    <strong>
        版权©2014 - 2016 OneBase .
    </strong>
      保留所有权利。
  </footer>
  <!-- 控制栏 -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
<!--    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-bell-o"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>-->
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
<!--        <h3 class="control-sidebar-heading">通知开关</h3>
        
          <div class="form-group">
            <label class="control-sidebar-subheading">
              异常登录是否通知
              <input type="checkbox" class="pull-right" checked>
            </label>
            <p>
              不在常用地区或常用IP登录是否通知用户，默认为是。
            </p>
          </div>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              行为异常是否限制
              <input type="checkbox" class="pull-right" checked>
            </label>
            <p>
              用户行为异常是否限制其操作，默认为是。
            </p>
          </div>-->
        
      </div>
      
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
<!--        <form method="post">
          <h3 class="control-sidebar-heading">系统开关</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              是否允许注册
              <input type="checkbox" class="pull-right" checked>
            </label>
            <p>
              若勾选后则不允许用户注册，默认为是。
            </p>
          </div>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              是否调试模式
              <input type="checkbox" class="pull-right" checked>
            </label>
            <p>
              若为调试模式页面将显示Trace信息，默认为是。
            </p>
          </div>
        </form>-->
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script src="__STATIC__/ext/adminlte/dist/js/app.min.js"></script>
<script src="__STATIC__/ext/adminlte/dist/js/init.js"></script>
<script src="__STATIC__/ext/toastr/toastr.min.js"></script>
<script src="__STATIC__/ext/btnloading/dist/spin.min.js"></script>
<script src="__STATIC__/ext/btnloading/dist/ladda.min.js"></script>
<script src="__STATIC__/ext/remodal/remodal.min.js"></script>
<script src="__STATIC__/admin/js/onebase.js"></script>
<link rel="stylesheet" href="__STATIC__/admin/css/ob_skin.css">
</body>
</html>
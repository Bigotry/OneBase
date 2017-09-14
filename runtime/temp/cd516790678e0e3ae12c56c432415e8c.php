<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"D:\wamp\www\OneBase\public/../app/api\view\index\content_default.html";i:1505185598;s:59:"D:\wamp\www\OneBase\public/../app/api\view\index\index.html";i:1505376059;s:34:"../app/common/view/fakeloader.html";i:1505374936;}*/ ?>
<!DOCTYPE html>
<html><head>
    <title>OneBase API文档</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="__STATIC__/api/bootstrap.css" rel="stylesheet" media="screen">
    <link href="__STATIC__/api/style.css" rel="stylesheet">
    <script src="__STATIC__/api/jquery-2.2.3.min.js"></script>
    <script src="__STATIC__/api/jquery.form.js"></script>
    </head>
<body>

<div class="fakeloader"></div>
<link href="__STATIC__/ext/fakeloader/css/fakeLoader.css" rel="stylesheet">
<script src="__STATIC__/ext/fakeloader/js/fakeLoader.min.js"></script>
<script type="text/javascript">
    
    $(".fakeloader").fakeLoader({
        timeToHide:99999,
        bgColor:"rgba(52, 52, 52, .5)",
        spinner:"spinner7"
    });
    
    $('.fakeloader').hide();
</script>
    
<div class="container-fluid">
    <div class="row-fluid">
        <div id="sidenav" class="span2">
        <nav id="scrollingNav">
          <ul class="sidenav nav nav-list">
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li class="nav-header">
                        <a><?php echo $vo['name']; ?></a>
                    </li>
                    <?php if(!(empty($vo['api_list']) || (($vo['api_list'] instanceof \think\Collection || $vo['api_list'] instanceof \think\Paginator ) && $vo['api_list']->isEmpty()))): if(is_array($vo['api_list']) || $vo['api_list'] instanceof \think\Collection || $vo['api_list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['api_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                            <li>
                                <a onclick="apiDetails(this)" url="<?php echo url('details', array('id' => $v['id'])); ?>" style="cursor:pointer;"><?php echo $v['name']; ?></a>
                            </li>
                        <?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>
          </ul>
        </nav>
    </div>

    <div id="content">
        <?php echo $content; ?>
    </div>
    </div>
</div>

<script>

    function apiDetails(obj)
    {
        
        $('.fakeloader').show();

        $.get($(obj).attr('url'), {}, success, "text");
        return false;
        function success(data)
        {
            
            $("#content").html(data);
            
            setTimeout(function(){ $('.fakeloader').hide(); }, 500);
        }
    }
</script>

</body>
</html>
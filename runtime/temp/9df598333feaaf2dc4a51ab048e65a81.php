<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:66:"E:\Wamp\www\OneBase/application/admin\view\auth_manager\index.html";i:1469948378;s:59:"E:\Wamp\www\OneBase/application/admin\view\Public\base.html";i:1471186081;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $meta_title; ?>|OneThink管理平台</title>
    <link href="__ROOT__/Public/favicon.ico" type="image/x-icon" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="__CSS__/base.css" media="all">
    <link rel="stylesheet" type="text/css" href="__CSS__/common.css" media="all">
    <link rel="stylesheet" type="text/css" href="__CSS__/module.css">
    <link rel="stylesheet" type="text/css" href="__CSS__/style.css" media="all">
    <link rel="stylesheet" type="text/css" href="__CSS__/<?php echo \think\Config::get('COLOR_STYLE'); ?>.css" media="all">
     <!--[if lt IE 9]>
    <script type="text/javascript" src="__STATIC__/jquery-1.10.2.min.js"></script>
    <![endif]--><!--[if gte IE 9]><!-->
    <script type="text/javascript" src="__STATIC__/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="__JS__/jquery.mousewheel.js"></script>
    <!--<![endif]-->
    
</head>
<body>
    <!-- 头部 -->
    <div class="header">
        <!-- Logo -->
        <span class="logo"></span>
        <!-- /Logo -->

        <!-- 主导航 -->
        <ul class="main-nav">
            <?php if(is_array($__menu__['main']) || $__menu__['main'] instanceof \think\Collection): $i = 0; $__LIST__ = $__menu__['main'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?>
                <li class="<?php echo (isset($menu['class']) && ($menu['class'] !== '')?$menu['class']:''); ?>"><a href="<?php echo url($menu['url']); ?>"><?php echo $menu['title']; ?></a></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <!-- /主导航 -->

        <!-- 用户栏 -->
        <div class="user-bar">
            <a href="javascript:;" class="user-entrance"><i class="icon-user"></i></a>
            <ul class="nav-list user-menu hidden">
                <li class="manager">你好，<em title="<?php echo session('member_auth.member_id'); ?>"><?php echo session('member_auth.member_id'); ?></em></li>
                <li><a href="<?php echo url('User/updatePassword'); ?>">修改密码</a></li>
                <li><a href="<?php echo url('User/updateNickname'); ?>">修改昵称</a></li>
                <li><a href="<?php echo url('AdminPublic/logout'); ?>">退出</a></li>
            </ul>
        </div>
    </div>
    <!-- /头部 -->

    <!-- 边栏 -->
    <div class="sidebar">
        <!-- 子导航 -->
        
            <div id="subnav" class="subnav">
                <?php if(!(empty($_extra_menu) || ($_extra_menu instanceof \think\Collection && $_extra_menu->isEmpty()))): ?>
                    
                    <?php echo extra_menu($_extra_menu,$__menu__); endif; if(is_array($__menu__['child']) || $__menu__['child'] instanceof \think\Collection): $i = 0; $__LIST__ = $__menu__['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?>
                    <!-- 子导航 -->
                    <?php if(!(empty($sub_menu) || ($sub_menu instanceof \think\Collection && $sub_menu->isEmpty()))): if(!(empty($key) || ($key instanceof \think\Collection && $key->isEmpty()))): ?><h3><i class="icon icon-unfold"></i><?php echo $key; ?></h3><?php endif; ?>
                        <ul class="side-sub-menu">
                            <?php if(is_array($sub_menu) || $sub_menu instanceof \think\Collection): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?>
                                <li>
                                    <a class="item" href="<?php echo url($menu['url']); ?>"><?php echo $menu['title']; ?></a>
                                </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    <?php endif; ?>
                    <!-- /子导航 -->
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        
        <!-- /子导航 -->
    </div>
    <!-- /边栏 -->

    <!-- 内容区 -->
    <div id="main-content">
        <div id="top-alert" class="fixed alert alert-error" style="display: none;">
            <button class="close fixed" style="margin-top: 4px;">&times;</button>
            <div class="alert-content">这是内容</div>
        </div>
        <div id="main" class="main">
            
            <!-- nav -->
            <?php if(!(empty($_show_nav) || ($_show_nav instanceof \think\Collection && $_show_nav->isEmpty()))): ?>
            <div class="breadcrumb">
                <span>您的位置:</span>
                <assign name="i" value="1" />
                <?php if(is_array($_nav) || $_nav instanceof \think\Collection): if( count($_nav)==0 ) : echo "" ;else: foreach($_nav as $k=>$v): ?>
                    <if condition="$i eq count($_nav)">
                    <span><?php echo $v; ?></span>
                    <else />
                    <span><a href="<?php echo $k; ?>"><?php echo $v; ?></a>&gt;</span>
                    </if>
                    <assign name="i" value="$i+1" />
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <?php endif; ?>
            <!-- nav -->
            

            
	<!-- 标题栏 -->
	<div class="main-title">
		<h2><?php echo $meta_title; ?></h2>
	</div>

    <div class="tools auth-botton">
        <a id="add-group" class="btn" href="<?php echo url('editGroup'); ?>">新 增</a>
        <a url="<?php echo url('changestatus?method=resumeGroup'); ?>" class="btn ajax-post" target-form="ids" >启 用</a>
        <a url="<?php echo url('changestatus?method=forbidGroup'); ?>" class="btn ajax-post" target-form="ids" >禁 用</a>
        <a url="<?php echo url('changestatus?method=deleteGroup'); ?>" class="btn ajax-post confirm" target-form="ids" >删 除</a>
    </div>
	<!-- 数据列表 -->
	<div class="data-table table-striped">
	<table class="">
    <thead>
        <tr>
		<th class="row-selected row-selected"><input class="check-all" type="checkbox"/></th>
		<th class="">用户组</th>
		<th class="">描述</th>

		<th class="">授权</th>
		<th class="">状态</th>
		<th class="">操作</th>
		</tr>
    </thead>
    <tbody>
		<?php if(!(empty($list) || ($list instanceof \think\Collection && $list->isEmpty()))): if(is_array($list) || $list instanceof \think\Collection): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
		<tr>
            <td><input class="ids" type="checkbox" name="id[]" value="<?php echo $vo['id']; ?>" /></td>
			<td><a href="<?php echo url('editGroup?id='.$vo['id']); ?>"><?php echo $vo['title']; ?></a> </td>
			<td><span><?php echo mb_strimwidth($vo['description'],0,60,"...","utf-8"); ?></span></td>


			<td>
                            <a href="<?php echo url('AuthManager/access?group_name='.$vo['title'].'&group_id='.$vo['id']); ?>" >访问授权</a>
                            <a href="<?php echo url('AuthManager/user?group_name='.$vo['title'].'&group_id='.$vo['id']); ?>" >成员授权</a>
			</td>
			<td><?php echo $vo['status']; ?></td>
			<td><?php if($vo['status'] == '1'): ?>
				<a href="<?php echo url('AuthManager/changeStatus?method=forbidGroup&id='.$vo['id']); ?>" class="ajax-get">禁用</a>
				<?php else: ?>
				<a href="<?php echo url('AuthManager/changeStatus?method=resumeGroup&id='.$vo['id']); ?>" class="ajax-get">启用</a>
				<?php endif; ?>
				<a href="<?php echo url('AuthManager/changeStatus?method=deleteGroup&id='.$vo['id']); ?>" class="confirm ajax-get">删除</a>
                </td>
		</tr>
		<?php endforeach; endif; else: echo "" ;endif; else: ?>
		<td colspan="6" class="text-center"> aOh! 暂时还没有内容! </td>
		<?php endif; ?>
	</tbody>
    </table>

	</div>
    <div class="page">
        <?php echo $list->render(); ?>
    </div>

        </div>
        <div class="cont-ft">
            <div class="copyright">
                <div class="fl">感谢使用<a href="http://www.onethink.cn" target="_blank">OneThink</a>管理平台</div>
                <div class="fr">V1.0</div>
            </div>
        </div>
    </div>
    <!-- /内容区 -->
    <script type="text/javascript">
    (function(){
        var ThinkPHP = window.Think = {
            "ROOT"   : "__ROOT__", //当前网站地址
            "APP"    : "__APP__", //当前项目地址
            "PUBLIC" : "__PUBLIC__", //项目公共目录地址
            "DEEP"   : "<?php echo config('URL_PATHINFO_DEPR'); ?>", //PATHINFO分割符
            "MODEL"  : ["<?php echo config('URL_MODEL'); ?>", "<?php echo config('URL_CASE_INSENSITIVE'); ?>", "<?php echo config('URL_HTML_SUFFIX'); ?>"],
            "VAR"    : ["<?php echo config('VAR_MODULE'); ?>", "<?php echo config('VAR_CONTROLLER'); ?>", "<?php echo config('VAR_ACTION'); ?>"]
        }
    })();
    </script>
    <script type="text/javascript" src="__STATIC__/think.js"></script>
    <script type="text/javascript" src="__JS__/common.js"></script>
    <script type="text/javascript">
        +function(){
            var $window = $(window), $subnav = $("#subnav"), url;
            $window.resize(function(){
                $("#main").css("min-height", $window.height() - 130);
            }).resize();

            /* 左边菜单高亮 */
            url = window.location.pathname + window.location.search;
            url = url.replace(/(\/(p)\/\d+)|(&p=\d+)|(\/(id)\/\d+)|(&id=\d+)|(\/(group)\/\d+)|(&group=\d+)/, "");
            $subnav.find("a[href='" + url + "']").parent().addClass("current");

            /* 左边菜单显示收起 */
            $("#subnav").on("click", "h3", function(){
                var $this = $(this);
                $this.find(".icon").toggleClass("icon-fold");
                $this.next().slideToggle("fast").siblings(".side-sub-menu:visible").
                      prev("h3").find("i").addClass("icon-fold").end().end().hide();
            });

            $("#subnav h3 a").click(function(e){e.stopPropagation()});

            /* 头部管理员菜单 */
            $(".user-bar").mouseenter(function(){
                var userMenu = $(this).children(".user-menu ");
                userMenu.removeClass("hidden");
                clearTimeout(userMenu.data("timeout"));
            }).mouseleave(function(){
                var userMenu = $(this).children(".user-menu");
                userMenu.data("timeout") && clearTimeout(userMenu.data("timeout"));
                userMenu.data("timeout", setTimeout(function(){userMenu.addClass("hidden")}, 100));
            });

	        /* 表单获取焦点变色 */
	        $("form").on("focus", "input", function(){
		        $(this).addClass('focus');
	        }).on("blur","input",function(){
				        $(this).removeClass('focus');
			        });
		    $("form").on("focus", "textarea", function(){
			    $(this).closest('label').addClass('focus');
		    }).on("blur","textarea",function(){
			    $(this).closest('label').removeClass('focus');
		    });

            // 导航栏超出窗口高度后的模拟滚动条
            var sHeight = $(".sidebar").height();
            var subHeight  = $(".subnav").height();
            var diff = subHeight - sHeight; //250
            var sub = $(".subnav");
            if(diff > 0){
                $(window).mousewheel(function(event, delta){
                    if(delta>0){
                        if(parseInt(sub.css('marginTop'))>-10){
                            sub.css('marginTop','0px');
                        }else{
                            sub.css('marginTop','+='+10);
                        }
                    }else{
                        if(parseInt(sub.css('marginTop'))<'-'+(diff-10)){
                            sub.css('marginTop','-'+(diff-10));
                        }else{
                            sub.css('marginTop','-='+10);
                        }
                    }
                });
            }
        }();
    </script>
    
<script type="text/javascript" charset="utf-8">
    //导航高亮
    highlight_subnav('<?php echo url('AuthManager/index'); ?>');
</script>

</body>
</html>

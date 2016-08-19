<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:60:"E:\Wamp\www\OneBase/application/admin\view\config\group.html";i:1469957820;s:59:"E:\Wamp\www\OneBase/application/admin\view\Public\base.html";i:1471186081;}*/ ?>
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
            

            
	<div class="main-title">
		<h2>网站设置</h2>
	</div>
		<div class="tab-wrap">
		<ul class="tab-nav nav">
		<?php if(is_array($config_group_list) || $config_group_list instanceof \think\Collection): $i = 0; $__LIST__ = $config_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?>

			<li <?php if($id == $key): ?> class="current" <?php endif; ?> > <a href="<?php echo url('?id='.$key); ?>"><?php echo $group; ?>配置</a></li>

		<?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
		<div class="tab-content">
	<form action="<?php echo url('save'); ?>" method="post" class="form-horizontal">
	<?php if(is_array($list) || $list instanceof \think\Collection): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$config): $mod = ($i % 2 );++$i;?>
		<div class="form-item">
			<label class="item-label"><?php echo $config['title']; ?><span class="check-tips">（<?php echo $config['remark']; ?>）</span> </label>
			<div class="controls">
			<?php switch($config['type']): case "0": ?>
			<input type="text" class="text input-small" name="config[<?php echo $config['name']; ?>]" value="<?php echo $config['value']; ?>">
			<?php break; case "1": ?>
			<input type="text" class="text input-large" name="config[<?php echo $config['name']; ?>]" value="<?php echo $config['value']; ?>">
			<?php break; case "2": ?>
			<label class="textarea input-large">
				<textarea name="config[<?php echo $config['name']; ?>]"><?php echo $config['value']; ?></textarea>
			</label>
			<?php break; case "3": ?>
			<label class="textarea input-large">
				<textarea name="config[<?php echo $config['name']; ?>]"><?php echo $config['value']; ?></textarea>
			</label>
			<?php break; case "4": ?>
			<select name="config[<?php echo $config['name']; ?>]">
                            <?php $_result=parse_config_attr($config['extra']);if(is_array($_result) || $_result instanceof \think\Collection): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $key; ?>" <?php if($config['value'] == $key): ?> selected <?php endif; ?> ><?php echo $vo; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
			<?php break; endswitch; ?>
				
			</div>
		</div>
		<?php endforeach; endif; else: echo "" ;endif; ?>
		<div class="form-item">
			<label class="item-label"></label>
			<div class="controls">
                            <?php if(empty($list) || ($list instanceof \think\Collection && $list->isEmpty())): ?>
                                <button type="submit" disabled class="btn submit-btn disabled" target-form="form-horizontal">确 定</button>
                                <?php else: ?>
                                <button type="submit" class="btn submit-btn ajax-post" target-form="form-horizontal">确 定</button>
                            <?php endif; ?>

                            <button class="btn btn-return" onclick="javascript:history.back(-1);return false;">返 回</button>
			</div>
		</div>
	</form>
			</div>
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
    


</body>
</html>

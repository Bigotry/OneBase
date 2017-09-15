<?php if (!defined('THINK_PATH')) exit(); /*a:7:{s:59:"D:\wamp\www\OneBase\app/index/view/default/index\index.html";i:1505466025;s:54:"D:\wamp\www\OneBase\app/index/view/default/layout.html";i:1505185598;s:58:"D:\wamp\www\OneBase\app/index/view/default/layout\top.html";i:1505466067;s:61:"D:\wamp\www\OneBase\app/index/view/default/layout\header.html";i:1505375208;s:34:"../app/common/view/fakeloader.html";i:1505377319;s:69:"D:\wamp\www\OneBase\app/index/view/default/index\tmpl\index_tmpl.html";i:1505379858;s:61:"D:\wamp\www\OneBase\app/index/view/default/layout\footer.html";i:1505185598;}*/ ?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<?php echo parse_string_val($seo_info, get_defined_vars()) ?>
<link href="__STATIC__/ext/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="__STATIC__/ext/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<link href="__STATIC__/ext/bootstrap/css/docs.css" rel="stylesheet">
<link href="__STATIC__/ext/bootstrap/css/onebase.css" rel="stylesheet">
<link href="__STATIC__/ext/toastr/toastr.min.css" rel="stylesheet">
<script type="text/javascript" src="__STATIC__/js/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="__STATIC__/js/jquery.tmpl.min.js"></script>
<script type="text/javascript" src="__STATIC__/ext/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="__STATIC__/js/common.js"></script>
<script src="__STATIC__/ext/toastr/toastr.min.js"></script>
<script src="__STATIC__/js/js.cookie.js"></script>

<div class="fakeloader"></div>
<link href="__STATIC__/ext/fakeloader/css/fakeLoader.css" rel="stylesheet">
<script src="__STATIC__/ext/fakeloader/js/fakeLoader.min.js"></script>
<script type="text/javascript">
    
    $(".fakeloader").fakeLoader({
        timeToHide:99999,
        bgColor:"rgba(52, 52, 52, .5)",
        spinner:"spinner<?php echo $loading_icon; ?>"
    });
    
    $('.fakeloader').hide();
</script>

<script type="text/javascript">
    var api_domain      = "<?php echo $api_domain; ?>";
    
    var access_token    = "<?php echo $access_token; ?>";
</script>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="/">OneBase</a>
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="nav-collapse collapse">
                <ul class="nav">
                        <li>
                            <a href="/">首页</a>
                        </li>
                        <li>
                            <a target="_blank" href="/api">接口文档</a>
                        </li>
                        <li>
                            <a target="_blank" href="https://www.kancloud.cn/onebase/onebase">开发文档</a>
                        </li>
                        <li>
                            <a target="_blank" href="http://www.onebase.org/admin">后台演示</a>
                        </li>
                        <li>
                            <a target="_blank" href="https://git.oschina.net/Bigotry/OneBase">源码下载</a>
                        </li>
                </ul>
            </div>
            <div class="nav-collapse collapse pull-right">
                <ul class="nav login_true" style="display: none;">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-left:0;padding-right:0"><span id="nickname_span"></span> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo url('changePassword'); ?>">修改密码</a></li>
                            <li><a href="javascript:;" onclick="logout()">退出</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav login_false">
                    <li>
                        <a href="<?php echo url('login'); ?>">登录 or 注册</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<header class="jumbotron subhead" id="overview">
    <div class="container">
        <h2>源自相同起点，演绎不同精彩！</h2>
        <p class="lead"></p>
    </div>
</header>

<div id="main-container" class="container">
    <div class="row">
        
        <div class="span3 bs-docs-sidebar">
            <ul class="nav nav-list bs-docs-sidenav" id="article_category_ul"></ul>
        </div>

        <div class="span9">
            <section id="article_ul"></section>
            <div id='page_div'></div>
        </div>
        
    </div>
</div>

<div class="tmpl_div"  style="display: none;">

    <!--首页文章分类模板-->
    <div id='article_category_ul_tmpl'>
        <li class="article_category_li_${id}"><a href="/?cid=${id}"><i class='icon-chevron-right'></i>${name}</a></li> 
    </div>
    
    <!--首页文章列表模板-->
    <div id='article_ul_tmpl'>
        <div class="">
            <h3><a href="?act=details&id=${id}">${name}</a></h3>
        </div>
        <div>
            <p class="lead">${describe}</p>
        </div>
        <div>
            <span><a href="?act=details&id=${id}">查看全文</a></span>
            <span class="pull-right">
            <span>发布时间：${create_time}</span>
            </span>
        </div>
        <hr/>
    </div>

</div>

<script type="text/javascript">

    function getPageHtml(data)
    {
        
        $.post("<?php echo url('common/page'); ?>", {current_page:data.current_page,last_page:data.last_page}, success, "text");
        return false;
        
        function success(data)
        {
            $('#page_div').html(data);
        }
    }

    $(function(){
        
        $('.fakeloader').show();
        
        $.template("article_category_ul_tmpl", $('#article_category_ul_tmpl'));
        $.template("article_ul_tmpl", $('#article_ul_tmpl') );
        
        var page = getUrlParam('page');
        
        if (null == page) { page = 1;}
        
        var cid = "<?php echo $cid; ?>";
        
        $.post(api_domain + '/api/combination/index.html', {access_token:access_token,list_rows:5, page:page, category_id:cid}, success, "json");
        return false;
        
        function success(data)
        {
            
            $.tmpl("article_category_ul_tmpl", data.data.article_category_list).appendTo("#article_category_ul");
            $.tmpl("article_ul_tmpl", data.data.article_list.data).appendTo("#article_ul");
            
            getPageHtml(data.data.article_list);
            
            $('.article_category_li_' + "<?php echo $cid; ?>").addClass('active');
            
            setTimeout(function(){ $('.fakeloader').hide(); }, 500);
        }
        
    });
</script>

<footer class="footer">
  <div class="container">
      <p> 本站由 <strong><a href="http://www.onebase.org" target="_blank">OneBase</a></strong> 强力驱动</p>
  </div>
</footer>


<script type="text/javascript">
    $(function(){
        
        $(window).resize(function(){ $("#main-container").css("min-height", window.screen.height - 480); }).resize();
            
        var login_info = Cookies.get('login_info');
        
        // 登录成功
        if(!(typeof(login_info)=="undefined"))
        {
            var login_info = JSON.parse(login_info);
            
            $('#nickname_span').text(login_info.nickname);

            $('.login_true').show();
            $('.login_false').hide();
        }
        
    });
    
    
    function logout()
    {
        
        Cookies.remove('login_info');
         
        toast.success('注销成功');
        
        setTimeout(function(){ window.location.href = '/'; }, 500);
    }
</script>
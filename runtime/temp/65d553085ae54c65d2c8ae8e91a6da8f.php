<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"D:\wamp\www\OneBase\public/../app/api\view\index\content_template.html";i:1505185598;}*/ ?>
<div id="project">
    <div class="pull-left">
      <h2><?php echo $info['name']; ?></h2>
    </div>
    <div class="pull-right">
    <div class="btn-group">
      <button id="version" class="btn btn-large dropdown-toggle" data-toggle="dropdown">
            接口状态：<?php echo $info['api_status_text']; ?>
      </button>
    </div>
    </div>
  <div class="clearfix"></div>
</div>
<?php if(!(empty($info['describe']) || (($info['describe'] instanceof \think\Collection || $info['describe'] instanceof \think\Paginator ) && $info['describe']->isEmpty()))): ?>
<div id="header">
    <p><?php echo $info['describe']; ?></p>
</div>
<?php endif; ?>
<article>
    <div class="pull-left">
      <h2>接口请求地址</h2>
    </div>
    <br/>
    <pre class="prettyprint language-html prettyprinted" data-type="<?php echo $info['request_type_text']; ?>" style=""><?php echo $info['api_url']; ?></pre>

<?php if(!(empty($info['request_data']) || (($info['request_data'] instanceof \think\Collection || $info['request_data'] instanceof \think\Paginator ) && $info['request_data']->isEmpty()))): ?>

    <h2>请求参数</h2>
    <table>
      <thead>
        <tr>
          <th>名称</th>
          <th>类型</th>
          <th>必填</th>
          <th>描述</th>
        </tr>
      </thead>
      <tbody>

          <?php if(is_array($info['request_data']) || $info['request_data'] instanceof \think\Collection || $info['request_data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['request_data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
              <tr>
                  <td><?php echo $vo['field_name']; ?></td>
                  <td><?php echo $vo['data_type']; ?></td>
                  <td><?php echo $vo['is_require']; ?></td>
                  <td><p><?php echo $vo['field_describe']; ?></p></td>
              </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
    </table>
    
<?php endif; if(!(empty($info['response_data']) || (($info['response_data'] instanceof \think\Collection || $info['response_data'] instanceof \think\Paginator ) && $info['response_data']->isEmpty()))): ?>
    <h2>响应字段</h2>
    <table>
      <thead>
        <tr>
          <th>名称</th>
          <th>类型</th>
          <th>描述</th>
        </tr>
      </thead>
      <tbody>

            <?php if(is_array($info['response_data']) || $info['response_data'] instanceof \think\Collection || $info['response_data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['response_data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
              <tr>
                  <td><?php echo $vo['field_name']; ?></td>
                  <td><?php echo $vo['data_type']; ?></td>
                  <td><p><?php echo $vo['field_describe']; ?></p></td>
              </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
    </table>

<?php endif; if(!(empty($info['response_examples']) || (($info['response_examples'] instanceof \think\Collection || $info['response_examples'] instanceof \think\Paginator ) && $info['response_examples']->isEmpty()))): ?>

    <ul class="nav nav-tabs nav-tabs-examples">
        <li class="active">
          <a>响应数据样例</a>
        </li>
    </ul>

    <div class="tab-content">
      <div class="tab-pane active" id="error-examples-User-GetUser-0_3_0-0">
        <pre class="prettyprint language-json prettyprinted" data-type="json" style=""><code><?php echo html_entity_decode($info['response_examples']); ?></code></pre>
      </div>
    </div>

<?php endif; if(!(empty($info['describe_text']) || (($info['describe_text'] instanceof \think\Collection || $info['describe_text'] instanceof \think\Paginator ) && $info['describe_text']->isEmpty()))): ?>
    <ul class="nav nav-tabs nav-tabs-examples">
        <li class="active">
          <a>详细文本描述</a>
        </li>
    </ul>
    <br/>
    <div>
        <?php echo html_entity_decode($info['describe_text']); ?>
    </div>
    <hr/>
<?php endif; ?>

<h2>测试接口</h2>

测试Access_Token：<?php echo $test_access_token; ?>
<br/><br/>

<form class="form-horizontal" action="<?php echo url($info['api_url']); ?>" method="<?php echo $info['request_type_text']; ?>" enctype="multipart/form-data">


    <div class="User-GetUser-0_3_0-sample-request-param-fields">
        
        <?php if(is_array($info['request_data']) || $info['request_data'] instanceof \think\Collection || $info['request_data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['request_data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="control-group">
                <label><?php echo $vo['field_name']; ?>（<?php echo $vo['field_describe']; ?>） <?php if($vo['is_require'] == '是'): ?><span style="color: red;"> * </span><?php endif; ?></label>
                  <div class="input-append">
                        <?php switch($vo['data_type']): case "字符": ?>
                                <input name="<?php echo $vo['field_name']; ?>" placeholder="请输入<?php echo $vo['field_name']; ?>" class="input-xxlarge sample-request-param" type="text">
                            <?php break; case "文本": ?>
                                <input name="<?php echo $vo['field_name']; ?>" placeholder="请输入<?php echo $vo['field_name']; ?>" class="input-xxlarge sample-request-param" type="text">
                            <?php break; case "数组": ?>
                                <input name="<?php echo $vo['field_name']; ?>[]" placeholder="请输入<?php echo $vo['field_name']; ?>" class="input-xxlarge sample-request-param" type="text">
                                <button class="btn btn-default" onclick="addField(this)" type="button">新增一项</button>
                            <?php break; case "文件": ?>
                            <input style="border: 1px solid #CCC;  height: 28px;" name="<?php echo $vo['field_name']; ?>" placeholder="请输入<?php echo $vo['field_name']; ?>" class="input-xxlarge sample-request-param" type="file">
                            <?php break; endswitch; ?>
                    
                        <span class="add-on"><?php echo $vo['data_type']; ?></span>
                  </div>
            </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        
    </div>
    <hr/>
    <button type="submit" class="btn btn-default sample-request-send">提交数据</button>

</form>

<div id="api_response" style="display: none;">
    <ul class="nav nav-tabs nav-tabs-examples">
        <li class="active">
          <a>测试接口响应数据</a>
        </li>
    </ul>

    
    
    <div class="tab-content">
      <div class="tab-pane active" id="error-examples-User-GetUser-0_3_0-0">
        <pre class="prettyprint language-json prettyprinted api_response_pre" data-type="json" style=""></pre>
      </div>
    </div>
</div>
</article>

       
<div id="generator">
      <div class="content">
        Copyright ©2017 <a href="http://onebase.org/">OneBase</a>
      </div>
</div>


<script type="text/javascript">
    
function addField(obj)
{
    var obj_parent = $(obj).parent().parent();

    obj_parent.parent().append(obj_parent.clone());
}


$(document).ajaxStart(function(){ $("button:submit").attr("disabled", true);}).ajaxStop(function(){$("button:submit").attr("disabled", false);});
                
$("form").submit(function()
{
    var self = $(this);
    
    self.ajaxSubmit({
        
        dataType:'json',
        success : function(data){
            
            $(".api_response_pre").html(JSON.stringify(data, null, 4));
            
            $("#api_response").show(500);
        }
      });
      
    return false;
});
</script>
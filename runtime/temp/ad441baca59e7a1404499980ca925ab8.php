<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"D:\wamp\www\OneBase\public/../app/api\view\index\content_default.html";i:1505185598;}*/ ?>
<div id="project">
  <div class="pull-left">
    <h2>OneBase1.0 API文档</h2>
  </div>
  <div class="clearfix"></div>
</div>
    <div id="header">
        <p>
        
            此文档为OneBase官方网站提供数据接口，仅供参考，开发者可参考二次开发手册进行API接口二次研发。
            
            <br/><br/>
            
            <a target="_blank" href="//shang.qq.com/wpa/qunwpa?idkey=3807aa892b97015a8e016778909dee8f23bbd54a4305d827482eda88fcc55b5e"><img border="0" src="//pub.idqqimg.com/wpa/images/group.png" alt="OneBase ①" title="OneBase ①"></a>
        
        <hr/>
        
        <div id="project">
          <div class="pull-left">
            <h2>错误码规范</h2>
            code 第1位（错误提示级别）,第2-3位（错误模块）,第4-7位（错误代码）<br/><br/>
          </div>
          <div class="clearfix"></div>
        </div>
         
        <table>
            <thead>
            <tr>
              <th>class</th>
              <th>property</th>
              <th>code</th>
              <th>msg</th>
            </tr>
            </thead>
            <tbody>

            <?php if(is_array($code_list) || $code_list instanceof \think\Collection || $code_list instanceof \think\Paginator): $i = 0; $__LIST__ = $code_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                  <td><?php echo $vo['class']; ?></td>
                  <td><?php echo $vo['property']; ?></td>
                  <td><?php echo $vo['code']; ?></td>
                  <td><?php echo $vo['msg']; ?></td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
            
        </p>
</div>
<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:52:"D:\wamp\www\OneBase\addon\imgs\view\index\index.html";i:1506306572;}*/ ?>
<input type="file" name="file" id="upload_picture_<?php echo $addons_data['name']; ?>">

<input type="hidden" name="<?php echo $addons_data['name']; ?>" id="<?php echo $addons_data['name']; ?>" value="<?php echo $addons_data['value']; ?>"/>

<div class="upload-img-box<?php echo $addons_data['name']; ?>">
    <?php if(!(empty($info[$addons_data['name']]) || (($info[$addons_data['name']] instanceof \think\Collection || $info[$addons_data['name']] instanceof \think\Paginator ) && $info[$addons_data['name']]->isEmpty()))): $img_ids_list = $info[$addons_data['name'] . '_array']; if(is_array($img_ids_list) || $img_ids_list instanceof \think\Collection || $img_ids_list instanceof \think\Paginator): $i = 0; $__LIST__ = $img_ids_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="upload-pre-item" style="float:left; margin: 10px;">
                <div style="cursor:pointer; color:red;" class="pic_del"  onclick="picDel<?php echo $addons_data['name']; ?>(this, <?php echo $vo; ?>)" >删除</div> 
                <a target="_blank" href="<?php echo get_picture_url((isset($vo) && ($vo !== '')?$vo:'0')); ?>">
                    <img style="max-width: <?php echo $addons_config['maxwidth']; ?>;" src="<?php echo get_picture_url((isset($vo) && ($vo !== '')?$vo:'0')); ?>"/>
                </a>
            </div>
        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
</div>

<script type="text/javascript">
    
    var maxwidth = "<?php echo $addons_config['maxwidth']; ?>";
    
    var name = "<?php echo $addons_data['name']; ?>";
    
    $("#upload_picture_" + name).uploadify({
        "height"          : 30,
        "swf"             : "<?php echo $static_path; ?>uploadify.swf",
        "fileObjName"     : "file",
        "buttonText"      : "上传图片",
        "uploader"        : "<?php echo url('File/pictureUpload',array('session_id'=>session_id())); ?>",
        "width"           : 120,
        'removeTimeout'	  : 1,
        'fileTypeExts'	  : "<?php echo $addons_config['allow_postfix']; ?>",
        "onUploadSuccess" : uploadPicture<?php echo $addons_data['name']; ?>,
        'onFallback' : function() { alert('未检测到兼容版本的Flash.'); }
    });
    
    function uploadPicture<?php echo $addons_data['name']; ?>(file, data){
        
        var data = $.parseJSON(data);
        
        var img_ids = $("#" + name).val();
        
        var add_id = data.id;
        
        if(img_ids){ var lastChar = img_ids.charAt(img_ids.length - 1);  if(lastChar != ','){  add_id = img_ids + ',' + add_id; } }
        
        $("#" + name).val(add_id);
        
        var src = '/upload/picture/' + data.path;
        
        $(".upload-img-box" + name).append('<div class="upload-pre-item" style="float:left; margin: 10px;"> <div style="cursor:pointer; color:red;" class="pic_del"  onclick="picDel<?php echo $addons_data['name']; ?>(this,'+data.id+')" >删除</div> <a target="_blank" href="' + src + '"> <img style="max-width: ' + maxwidth + ';" src="' + src + '"/></a></div>');
    }
    
    function picDel<?php echo $addons_data['name']; ?>(obj, pic_id)
    {
        
        var img_ids = $("#" + name).val();
        
        
        if(img_ids.indexOf(",") > 0)
        {
            
            img_ids.indexOf(pic_id) == 0 ? img_ids = img_ids.replace(pic_id + ',', '') : img_ids = img_ids.replace(',' + pic_id, '');
            
            $("#" + name).val(img_ids);
        }else{
            
            $("#" + name).val('');
        }
        
        $(obj).parent().remove();
    }
</script>
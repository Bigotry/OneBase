<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:50:"D:\wamp\www\OneBase\addon\file\view\index\img.html";i:1506161317;}*/ ?>
<input type="file" name="file" id="upload_picture_<?php echo $addons_data['name']; ?>">

<input type="hidden" name="<?php echo $addons_data['name']; ?>" id="<?php echo $addons_data['name']; ?>" value="<?php echo $addons_data['value']; ?>"/>


<div class="upload-img-box<?php echo $addons_data['name']; ?>">
    <?php if(!(empty($info[$addons_data['name']]) || (($info[$addons_data['name']] instanceof \think\Collection || $info[$addons_data['name']] instanceof \think\Paginator ) && $info[$addons_data['name']]->isEmpty()))): ?>
    <div class="upload-pre-item"><a target="_blank" href="<?php echo get_picture_url((isset($info[$addons_data['name']]) && ($info[$addons_data['name']] !== '')?$info[$addons_data['name']]:'0')); ?>"><img style="max-width: <?php echo $addons_config['maxwidth']; ?>;" src="<?php echo get_picture_url((isset($info[$addons_data['name']]) && ($info[$addons_data['name']] !== '')?$info[$addons_data['name']]:'0')); ?>"/></a></div>
    <?php endif; ?>
</div>

<script type="text/javascript">
    
    var maxwidth = "<?php echo $addons_config['maxwidth']; ?>";
    
    $("#upload_picture_<?php echo $addons_data['name']; ?>").uploadify({
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
        
        $("#<?php echo $addons_data['name']; ?>").val(data.id);
        
        var src = '/upload/picture/' + data.path;
        
        $(".upload-img-box<?php echo $addons_data['name']; ?>").html('<div class="upload-pre-item"> <a target="_blank" href="' + src + '"> <img style="max-width: ' + maxwidth + ';" src="' + src + '"/></a></div>');
    }
    
</script>
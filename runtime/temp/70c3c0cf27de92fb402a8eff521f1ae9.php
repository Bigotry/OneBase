<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:51:"D:\wamp\www\OneBase\addon\file\view\index\file.html";i:1506161131;}*/ ?>
<input type="file" name="file" id="upload_file_<?php echo $addons_data['name']; ?>">

<input type="hidden" name="<?php echo $addons_data['name']; ?>" id="<?php echo $addons_data['name']; ?>" value="<?php echo $addons_data['value']; ?>"/>

<div class="upload-img-box<?php echo $addons_data['name']; ?>">
    <?php if(!(empty($info[$addons_data['name']]) || (($info[$addons_data['name']] instanceof \think\Collection || $info[$addons_data['name']] instanceof \think\Paginator ) && $info[$addons_data['name']]->isEmpty()))): ?>
    <div class="upload-pre-file"><span class="upload_icon_all"></span><a target="_blank" href="<?php echo get_file_url((isset($info[$addons_data['name']]) && ($info[$addons_data['name']] !== '')?$info[$addons_data['name']]:'')); ?>"><?php echo get_file_url((isset($info[$addons_data['name']]) && ($info[$addons_data['name']] !== '')?$info[$addons_data['name']]:'')); ?></a></div>
    <?php endif; ?>
</div>

<script type="text/javascript">
    
    $("#upload_file_<?php echo $addons_data['name']; ?>").uploadify({
        "height"          : 30,
        "swf"             : "<?php echo $static_path; ?>uploadify.swf",
        "fileObjName"     : "file",
        "buttonText"      : "上传文件",
        "uploader"        : "<?php echo url('File/fileUpload',array('session_id'=>session_id())); ?>",
        "width"           : 120,
        'removeTimeout'	  : 1,
        'fileTypeExts'	  : "<?php echo $addons_config['allow_postfix']; ?>",
        "onUploadSuccess" : uploadFile<?php echo $addons_data['name']; ?>,
        'onFallback' : function() { alert('未检测到兼容版本的Flash.'); }
    });
    
    function uploadFile<?php echo $addons_data['name']; ?>(file, data){
        
        var data = $.parseJSON(data);
        
        $("#<?php echo $addons_data['name']; ?>").val(data.id);
        
        var src = '/upload/file/' + data.path;
        
        $(".upload-img-box<?php echo $addons_data['name']; ?>").html('<div class="upload-pre-file"><span class="upload_icon_all"></span><a target="_blank" href="'+src+'"> ' + src + ' <a></div>');
    }
    
</script>
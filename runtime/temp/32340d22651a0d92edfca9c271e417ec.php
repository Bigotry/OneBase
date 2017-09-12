<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"D:\wamp\www\OneBase\addon\imginput\view\index\index.html";i:1505185598;}*/ ?>
    <link rel="stylesheet" href="<?php echo $static_path; ?>css/webuploader.css" />
    <link rel="stylesheet" href="<?php echo $static_path; ?>css/style.css" />
    
    <div id="wrapper" style="width: 80%;" class="remodal"  role="dialog" aria-labelledby="image_upload" aria-describedby="图片上传">
        
        <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
        
        <div id="container">
            <!--头部，相册选择和格式选择-->

            <div id="uploader">
                <div class="queueList">
                    <div id="dndArea" class="placeholder">
                        <div id="filePicker"></div>
                        <p>支持拖动照片上传，与QQ截图粘贴上传。</p>
                    </div>
                </div>
                <div class="statusBar" style="display:none;">
                    
                    <div class="progress">
                        <span class="text">0%</span>
                        <span class="percentage"></span>
                    </div>
                    
                    <div class="info"></div>
                    <div class="btns">
                        <div id="filePicker2"></div><div class="uploadBtn">开始上传</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script src="<?php echo $static_path; ?>dist/webuploader.min.js"></script>
<script src="<?php echo $static_path; ?>js/upload.js"></script>
    
<script type="text/javascript">

var upload_id = "<?php echo $addons_data['id']; ?>";

var max_number = "<?php echo $addons_data['max_number']; ?>";

$("#" + upload_id).click(function(){
    
    $('#wrapper').remodal().open();
});

var img_upload_url = "<?php echo url('File/pictureUpload'); ?>";

var upload_param = {
        pick: {
            id: '#filePicker',
            label: '点击选择图片'
        },
        formData: {
            uid: 0
        },
        dnd: '#dndArea',
        paste: '#uploader',
        swf: '/addon/imginput/static/dist/Uploader.swf',
        chunked: false,
        chunkSize: 512 * 1024,
        server: img_upload_url,
        // 禁掉全局的拖拽功能。这样不会出现图片拖进页面的时候，把图片打开。
        disableGlobalDnd: true,
        fileNumLimit: max_number,
        fileSizeLimit: 200 * 1024 * 1024,    // 200 M
        fileSingleSizeLimit: 50 * 1024 * 1024,    // 50 M
        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/jpg,image/jpeg,image/png'
        }
    };
    
</script>
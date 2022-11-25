<input type="hidden" name="<?php echo $field; ?>" id="path_<?php echo $field; ?>" value="<?php if($files): ?><?php echo e($files['path']); ?><?php endif; ?>"/>
<div class="layui-input-block">
    <div class="layui-upload-drag" id="uploadImage_<?php echo $field; ?>">

            <i class="layui-icon layui-icon-upload-drag"></i>
            <p>点击上传，或将文件拖拽到此处</p>

            <?php if($files): ?>
            <hr/>
            <div class="">

                <img id="image_<?php echo $field; ?>" src="<?php echo url("/image/original".$files['path']); ?>" style="max-width: 196px">
            </div>
            <?php else: ?>
            <hr/>
            <div class="layui-hide">
                <img id="image_<?php echo $field; ?>" src="" style="max-width: 196px">
            </div>
            <?php endif; ?>

    </div>
</div>
<script>
    layui.use(['jquery','element','form','table','upload'], function(){
        var $ = layui.$;
        var form = layui.form;
        var upload = layui.upload;
        upload.render({
            elem: '#uploadImage_<?php echo $field; ?>'
            ,accept:'images'
            ,url: '<?php echo $url; ?>'
            ,data: {
                '_token':$('meta[name="csrf-token"]').attr('content')
            }
            ,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
                layer.load(); //上传loading
                obj.preview(function(index, file, result){
                    $('#image_<?php echo $field; ?>').show().attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res, index, upload){
                console.log(res)
                $('.layui-upload-view').removeClass('layui-hide');
                $("#path_<?php echo $field; ?>").val(res.data.path);
                layer.closeAll('loading'); //关闭loading
                layer.msg(res.message);

            }
            ,error: function(index, upload){
                layer.closeAll('loading'); //关闭loading
            }
        });
    });
</script>
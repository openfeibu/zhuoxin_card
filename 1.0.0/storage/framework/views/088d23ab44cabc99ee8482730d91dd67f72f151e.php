<div class="main">
    <?php echo Theme::widget('breadcrumb')->render(); ?>

    <div class="main_full">
        <?php echo Theme::partial('message'); ?>

        <div class="layui-col-md12">
            <div class="fb-main-table">
                <form class="layui-form" action="<?php echo e(guard_url('setting/updateStation')); ?>" method="post" lay-filter="fb-form">
                    <div class="layui-form-item">
                        <label class="layui-form-label">站点名称</label>
                        <div class="layui-input-inline">
                            <input type="text" name="station_name" lay-verify="companyName" autocomplete="off" placeholder="请输入站点名称" class="layui-input" value="<?php echo e($setting['station_name']); ?>">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">Logo</label>
                        <?php echo $setting['logo']->files('value')->field('logo')
                        ->url($setting['logo']->getUploadUrl('value'))
                        ->uploader(); ?>

                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">版权声明</label>
                        <div class="layui-input-inline">
                            <input type="text" name="right" lay-verify="companyName" autocomplete="off" placeholder="版权" class="layui-input" value="<?php echo e($setting['right']); ?>">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit="" lay-filter="demo1"><?php echo e(trans('app.submit_now')); ?></button>
                        </div>
                    </div>
                    <?php echo Form::token(); ?>

                </form>
            </div>

        </div>
    </div>
</div>
<script>
    layui.use(['jquery','element','form','table','upload'], function(){
        var form = layui.form;
        var $ = layui.$;
        //监听提交
        form.on('submit(demo1)', function(data){
            data = JSON.stringify(data.field);
            data = JSON.parse(data);
            data['_token'] = "<?php echo csrf_token(); ?>";
            var load = layer.load();
            $.ajax({
                url : "<?php echo e(guard_url('setting/updateStation')); ?>",
                data :  data,
                type : 'POST',
                success : function (data) {
                    layer.close(load);
                    layer.msg('更新成功');
                },
                error : function (jqXHR, textStatus, errorThrown) {
                    layer.close(load);
                    layer.msg('服务器出错');
                }
            });
            return false;
        });

    });
</script>
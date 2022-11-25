<div class="main">
    <?php echo Theme::widget('breadcrumb')->render(); ?>

    <div class="main_full">
        <?php echo Theme::partial('message'); ?>

        <div class="layui-col-md12">
            <div class="fb-main-table">
                <form class="layui-form" action="<?php echo e(guard_url('job_category')); ?>" method="post" lay-filter="fb-form">
                    <div class="layui-form-item">
                        <label class="layui-form-label">上级</label>
                        <div class="layui-input-inline">
                            <select name="parent_id" class="layui-select">
                                <option value="0">顶级</option>
                                <?php $__currentLoopData = $tops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $top): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($top->id); ?>"><?php echo e($top->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <!--
                    <div class="layui-form-item fb-form-item2">
                        <label class="layui-form-label">* 上级</label>
                        <div class="layui-input-inline">
                            <input type="text" name="parent_id" id="parent_tree" lay-verify="tree" autocomplete="off" placeholder="请选择上级" class="layui-input">
                        </div>
                    </div>
                    -->
                    <div class="layui-form-item">
                        <label class="layui-form-label">* <?php echo e(trans('nav.label.name')); ?></label>
                        <div class="layui-input-inline">
                            <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输入<?php echo e(trans('nav.label.name')); ?>" class="layui-input" >
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo e(trans('app.order')); ?></label>
                        <div class="layui-input-inline">
                            <input type="text" name="order" value="50" autocomplete="off" class="layui-input" >
                        </div>
                    </div>
                    <div class="layui-form-item button-group"><div class="layui-input-block"><button class="layui-btn layui-btn-normal layui-btn-lg" lay-submit="" lay-filter="demo1"><?php echo e(trans('app.submit_now')); ?></button></div></div>
                    <?php echo Form::token(); ?>

                </form>
            </div>

        </div>
    </div>
</div>

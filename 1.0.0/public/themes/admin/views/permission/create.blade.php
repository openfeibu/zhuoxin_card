<div class="main">
    {!! Theme::widget('breadcrumb')->render() !!}
    <div class="main_full">
        {!! Theme::partial('message') !!}
        <div class="layui-col-md12">
            <div class="fb-main-table">
                <form class="layui-form" action="{{guard_url('permission')}}" method="post" lay-filter="fb-form">
                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('permission.label.name') }}</label>
                        <div class="layui-input-inline">
                            <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输入{{ trans('permission.label.name') }}" class="layui-input" value="">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('permission.label.slug') }}</label>
                        <div class="layui-input-inline">
                            <input type="text" name="slug" autocomplete="off" placeholder="请输入{{ trans('permission.label.slug') }}" class="layui-input" value="">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('permission.label.icon') }}</label>
                        <div class="layui-input-inline">
                            <input type="text" name="icon" lay-verify="icon" autocomplete="off" placeholder="请输入{{ trans('permission.label.icon') }}" class="layui-input" value="">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('permission.label.order') }}</label>
                        <div class="layui-input-inline">
                            <input type="text" name="order" lay-verify="order" autocomplete="off" placeholder="请输入{{ trans('permission.label.order') }}" class="layui-input" value="0">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">是否菜单</label>
                        <div class="layui-input-block">
                            <input type="checkbox" name="is_menu_switch" lay-skin="switch" lay-filter="is_menu_switch" lay-text="菜单|否" >
                            <input type="hidden" name="is_menu" id="is_menu" value="0">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">所属权限组</label>
                        <div class="layui-input-block">
                            <select name="parent_id">
                                <option value="0">顶级权限</option>
                                @foreach($father as $key => $father)
                                    <option value="{{ $father->id }}" @if($permission->parent_id == $father->id) selected @endif>{{ $father->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">是否含以下{{ trans('app.actions') }}</label>
                        <div class="layui-input-block">
                            <input type="checkbox" name="subs[create]" title="创建" value="创建">
                            <input type="checkbox" name="subs[show]" title="{{ trans('app.edit') }}" value="{{ trans('app.edit') }}">
                            <input type="checkbox" name="subs[destroy]" title="{{ trans('app.delete') }}" value="{{ trans('app.delete') }}">
                            <input type="checkbox" name="subs[destroy_all]" title="批量{{ trans('app.delete') }}" value="批量{{ trans('app.delete') }}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit="" lay-filter="demo1">{{ trans('app.submit_now') }}</button>
                        </div>
                    </div>
                    {!!Form::token()!!}
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    layui.use(['form','jquery'], function(){
        var form = layui.form;
        var $ = layui.$;
        form.on('switch(is_menu_switch)', function(data){
            if(data.elem.checked == true)
            {
                $("#is_menu").val('1');
            }else{
                $("#is_menu").val('0');
            }
            form.render();
        });
    });
</script>
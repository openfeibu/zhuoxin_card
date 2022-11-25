<div class="main">
    {!! Theme::widget('breadcrumb')->render() !!}
    <div class="main_full">
        {!! Theme::partial('message') !!}
        <div class="layui-col-md12">
            <div class="fb-main-table">
                <form class="layui-form" action="{{guard_url('admin_user/'.$admin_user->id)}}" method="post" lay-filter="fb-form">
                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans("admin_user.label.email") }}</label>
                        <div class="layui-input-inline">
                            <input type="text" name="email" value="{{ $admin_user->email }}" lay-verify="title" autocomplete="off" placeholder="请输入{{ trans("admin_user.label.email") }}" class="layui-input" disabled>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans("admin_user.label.new_password") }}</label>
                        <div class="layui-input-inline">
                            <input type="password" name="password" placeholder="请输入{{ trans("admin_user.label.password") }}，不改则留空" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux">请输入密码，不改则留空</div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans("admin_user.label.roles") }}</label>
                        <div class="layui-input-block">
                            @foreach($roles as $key => $role)
                            <input type="radio" name="roles[]" value="{{ $role->id }}" title="{{ $role->name }}" {{ !($admin_user->hasRole($role->slug)) ? :'checked'}}>
                            @endforeach
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit="" lay-filter="demo1">{{ trans('app.submit_now') }}</button>
                        </div>
                    </div>
                    {!!Form::token()!!}
                    <input type="hidden" name="_method" value="PUT">
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    layui.use('form', function(){
        var form = layui.form;

        form.render();
    });
</script>


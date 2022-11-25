<div class="main">
    {!! Theme::widget('breadcrumb')->render() !!}
    <div class="main_full">
        {!! Theme::partial('message') !!}
        <div class="layui-col-md12">
            <div class="fb-main-table">
                <form class="layui-form" action="{{guard_url('job')}}" method="post" lay-filter="fb-form">

                    <div class="layui-form-item">
                        <label class="layui-form-label">* {{ trans('app.name') }}</label>
                        <div class="layui-input-inline">
                            <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输入{{ trans('app.name') }}" class="layui-input" >
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">* {{ trans('app.en_name') }}</label>
                        <div class="layui-input-inline">
                            <input type="text" name="en_name" lay-verify="required" autocomplete="off" placeholder="请输入{{ trans('app.en_name') }}" class="layui-input" >
                        </div>
                    </div>
                    
                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('app.order') }}</label>
                        <div class="layui-input-inline">
                            <input type="text" name="order" value="50" autocomplete="off" class="layui-input" >
                        </div>
                        <div class="layui-form-mid layui-word-aux">从小到大排序</div>
                    </div>
                    <div class="layui-form-item button-group"><div class="layui-input-block"><button class="layui-btn layui-btn-normal layui-btn-lg" lay-submit="" lay-filter="demo1">{{ trans('app.submit_now') }}</button></div></div>
                    {!!Form::token()!!}
                </form>
            </div>

        </div>
    </div>
</div>

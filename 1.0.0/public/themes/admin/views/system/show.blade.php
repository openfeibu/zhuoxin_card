<div class="main">
    {!! Theme::widget('breadcrumb')->render() !!}
    <div class="main_full">
        {!! Theme::partial('message') !!}
        <div class="layui-col-md12">
            <div class="fb-main-table">
                <form class="layui-form" action="{{guard_url('system_page/'.$page->id)}}" method="post" lay-filter="fb-form">
                    <div class="layui-form-item">
                        <label class="layui-form-label">标题</label>
                        <div class="layui-input-inline">
                            <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input" value="{{$page->title}}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">标示</label>
                        <div class="layui-input-inline">
                            <input type="text" name="slug" lay-verify="title" autocomplete="off" placeholder="请输入标示" class="layui-input" value="{{$page->slug}}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">封面</label>
                        {!! $page->files('image')
                        ->url($page->getUploadUrl('image'))
                        ->uploader()!!}
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">内容</label>
                        <div class="layui-input-block">
                            <script type="text/plain" id="content" name="content" style="width:1000px;height:240px;">
                                {!! $page->content !!}
                            </script>
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

{!! Theme::asset()->container('ueditor')->scripts() !!}
<script>
    var ue = getUe();
</script>
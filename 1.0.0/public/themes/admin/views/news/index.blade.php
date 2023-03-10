<div class="main">
    {!! Theme::widget('breadcrumb')->render() !!}
    <div class="main_full">
        {!! Theme::partial('message') !!}
        <div class="layui-col-md12">
            <div class="tabel-message">
                <div class="layui-inline tabel-btn">
                    <button class="layui-btn layui-btn-warm "><a href="{{guard_url('news/create')}}">{{ trans('app.add') }}新闻动态</a></button>
                    <button class="layui-btn layui-btn-primary " data-type="del" data-events="del">{{ trans('app.delete') }}</button>
                </div>
                <div class="layui-inline">
                    <input class="layui-input search_key" name="title" id="demoReload" placeholder="{{ trans('app.search') }}标题" autocomplete="off">
                </div>
                <button class="layui-btn" data-type="reload">{{ trans('app.search') }}</button>
            </div>

            <table id="fb-table" class="layui-table"  lay-filter="fb-table">

            </table>
        </div>
    </div>
</div>
<script type="text/html" id="checkboxTEM">
    <input type="checkbox" name="home_recommend" value="@{{d.id}}" lay-skin="switch" lay-text="首页|否" lay-filter="lock" @{{ d.home_recommend == true ? 'checked' : '' }}>
</script>
<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-sm" lay-event="edit">{{ trans('app.edit') }}</a>
    <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">{{ trans('app.delete') }}</a>
</script>
<script type="text/html" id="imageTEM">
    <a href="@{{d.image}}" target="_blank"><img src="@{{d.sm_image}}" alt="" height="28"></a>
</script>

<script>
    var main_url = "{{guard_url('news')}}";
    var delete_all_url = "{{guard_url('news/destroyAll')}}";
    layui.use(['jquery','element','table'], function(){
        var table = layui.table;
        var form = layui.form;
        var $ = layui.$;
        table.render({
            elem: '#fb-table'
            ,url: main_url
            ,cols: [[
                {checkbox: true, fixed: true}
                ,{field:'id',title:'ID', width:80, sort: true}
                ,{field:'title',title:'标题', width:200}
                ,{field:'image',title:'封面', toolbar:'#imageTEM'}
                ,{field:'home_recommend',title:'首页推荐', width:200,toolbar:'#checkboxTEM' }
//                ,{field:'order',title:'{{ trans('app.order') }}', width:80, sort: true}
                ,{field:'score',title:'{{ trans('app.actions') }}', width:200, align: 'right',fixed: 'right',toolbar:'#barDemo'}
            ]]
            ,id: 'fb-table'
            ,page: true
            ,limit: 20
            ,height: 'full-200'
            ,error: function(e,t){
                console.log(e);
                $.ajax_table_error(e);
            }
        });

        //监听锁定
        form.on('switch(lock)', function(obj){
            $.post("{{guard_url('news/updateRecommend')}}",{"id":this.value,"home_recommend":obj.elem.checked,'_token':"{!! csrf_token() !!}" },function(){

            })
            // layer.tips(this.value + ' ' + this.name + '：'+ obj.elem.checked, obj.othis);
        });

    });
</script>
{!! Theme::partial('common_handle_js') !!}
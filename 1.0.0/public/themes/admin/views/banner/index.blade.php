<div class="main">
    {!! Theme::widget('breadcrumb')->render() !!}
    <div class="main_full">
        {!! Theme::partial('message') !!}
        <div class="layui-col-md12">
            <div class="tabel-message">
                <div class="layui-inline tabel-btn">
                    <button class="layui-btn layui-btn-warm "><a href="{{ url('/admin/banner/create') }}">{{ trans('app.add') }}</a></button>
                    <button class="layui-btn layui-btn-primary " data-type="del" data-events="del">{{ trans('app.delete') }}</button>
                </div>
                <!--  <div class="layui-inline">
                   <input class="layui-input" name="id" id="demoReload" placeholder="{{ trans('app.search') }}轮播图" autocomplete="off">
                 </div>
                 <button class="layui-btn" data-type="reload">{{ trans('app.search') }}</button> -->
            </div>

            <table id="fb-table" class="layui-table"  lay-filter="fb-table">

            </table>
        </div>
    </div>
</div>
<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-sm" lay-event="edit">{{ trans('app.edit') }}</a>
    <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">{{ trans('app.delete') }}</a>
</script>
<script type="text/html" id="imageTEM">
    <a href="@{{d.image}}" target="_blank"><img src="@{{d.sm_image}}" alt="" height="28"></a>
</script>
<script>
    var main_url = "{{guard_url('banner')}}";
    var delete_all_url = "{{guard_url('banner/destroyAll')}}";
    layui.use(['jquery','element','table'], function(){
        var $ = layui.$;
        var table = layui.table;
        var form = layui.form;
        table.render({
            elem: '#fb-table'
            ,url: '{{guard_url('banner')}}'
            ,cols: [[
                {checkbox: true, fixed: true}
                ,{field:'id',title:'ID', width:80, sort: true}
                ,{field:'title',title:'{{ trans('app.title') }}', sort: true,edit:'text'}
                ,{field:'sm_image',title:'{{ trans('app.image') }}', width:200,toolbar:'#imageTEM',}
                ,{field:'url',title:'{{ trans('banner.label.url') }}', sort: true}
                ,{field:'order',title:'{{ trans('app.order') }}', sort: true}
                ,{field:'type_desc',title:'{{ trans('app.type') }}', sort: true}
                ,{field:'score',title:'{{ trans('app.actions') }}', width:200, align: 'right',toolbar:'#barDemo'}
            ]]
            ,id: 'fb-table'
            ,height: 'full-200'
            ,page: false
        });
    });
</script>
{!! Theme::partial('common_handle_js') !!}
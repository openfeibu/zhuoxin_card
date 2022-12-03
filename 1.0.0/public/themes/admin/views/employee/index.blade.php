<div class="main">
    {!! Theme::widget('breadcrumb')->render() !!}
    <div class="main_full">
        {!! Theme::partial('message') !!}
        <div class="layui-col-md12">
            <div class="tabel-message">
                <div class="layui-inline tabel-btn">
                    <button class="layui-btn layui-btn-warm "><a href="{{guard_url('employee/create')}}">{{ trans('app.add') }}{{ trans('employee.name') }}</a></button>
                    <button class="layui-btn layui-btn-primary " data-type="del" data-events="del">{{ trans('app.delete') }}</button>
                </div>
                <div class="layui-inline">
                    <input type="text" name="job_category_id" id="category_tree" lay-verify="tree" autocomplete="off" placeholder="请选择分类(加载中)" class="layui-input search_key">
                </div>

                <div class="layui-inline">
                    <input class="layui-input search_key" name="name" id="demoReload" placeholder="{{ trans('app.name') }}" autocomplete="off">
                </div>
                <div class="layui-inline">
                    <button class="layui-btn" data-type="reload">{{ trans('app.search') }}</button>
                </div>
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
    <img src="@{{d.image}}" alt="" height="28">
</script>

<script>
    var main_url = "{{guard_url('employee')}}";
    var delete_all_url = "{{guard_url('employee/destroyAll')}}";
    layui.use(['jquery','element','table','treeSelect'], function(){
        var treeSelect= layui.treeSelect;
        var table = layui.table;
        var form = layui.form;
        var $ = layui.$;

        treeSelect.render({
            elem: '#category_tree',
            data: '{{guard_url('job_categories_tree')}}',
            headers: {},
            type: 'get',
            // 占位符
            placeholder: '请选择分类',
            //多选
            showCheckbox: false,
            //连线
            showLine: true,
            //选中节点(依赖于 showCheckbox 以及 key 参数)。
            //checked: [11, 12],
            //展开节点(依赖于 key 参数)
            spread: [1],
            // 点击回调
            click: function(obj){

            },
            // 加载完成后的回调函数
            success: function (d) {
                console.log(d);
            }
        });

        table.render({
            elem: '#fb-table'
            ,url: main_url
            ,cols: [[
                {checkbox: true, fixed: true}
                ,{field:'id',title:'ID', width:80, sort: true}
                ,{field:'name',title:'{{ trans('app.name') }}',edit:'text'}
                ,{field:'en_name',title:'{{ trans('app.en_name') }}',edit:'text'}
                ,{field:'job_category_name',title:'{{ trans('job_category.name') }}'}
                ,{field:'job_names',title:'{{ trans('job.name') }}'}
                ,{field:'order',title:'{{ trans('app.order') }}', width:200,edit:'text'}
                ,{field:'score',title:'{{ trans('app.actions') }}', width:200, align: 'right',toolbar:'#barDemo'}
            ]]
            ,id: 'fb-table'
            ,page: true
            ,limit: 20
            ,height: 'full-200'
        });


    });
</script>
{!! Theme::partial('common_handle_js') !!}
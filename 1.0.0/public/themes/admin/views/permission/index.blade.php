<div class="main">
    {!! Theme::widget('breadcrumb')->render() !!}

    <div class="main_full">
        {!! Theme::partial('message') !!}
        <div class="layui-col-md12">
            <div class="tabel-message">
                <div class="layui-inline tabel-btn">
                    <button class="layui-btn layui-btn-warm "><a href="{{guard_url('permission/create')}}">{{ trans('app.add') }}{{ trans('permission.name') }}</a></button>
                    <button class="layui-btn layui-btn-primary " data-type="del" data-events="del">{{ trans('app.delete') }}</button>
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
<script type="text/html" id="checkboxTEM">
    <input type="checkbox" name="is_menu" value="@{{d.id}}" lay-skin="switch" lay-text="菜单|否" lay-filter="lock" @{{ d.is_menu == 1 ? 'checked' : '' }}>
</script>
<script>
    var main_url = "{{guard_url('permission')}}";
    var delete_all_url = "{{guard_url('permission/destroyAll')}}";

    layui.use(['element','table'], function(){
        var table = layui.table;
        var form = layui.form;
        table.render({
            elem: '#fb-table'
            ,url: main_url
            ,cols: [[
                {checkbox: true, fixed: true}
                ,{field:'id',title:'ID', width:80, sort: true}
                ,{field:'name',title:'{{ trans('permission.label.name') }}',edit: 'text', minWidth:100}
                ,{field:'slug',title:'{{ trans('permission.label.slug') }}',edit: 'text', minWidth:100}
                ,{field:'icon',title:'{{ trans('permission.label.icon') }}',edit: 'text', minWidth:100}
                ,{field:'order',title:'{{ trans('permission.label.order') }}',edit: 'text'}
                ,{field:'is_menu',title:'是否菜单', width:200,toolbar:'#checkboxTEM' }
                ,{field:'score',title:'{{ trans('app.actions') }}', width:200, align: 'right',toolbar:'#barDemo'}
            ]]
            ,id: 'fb-table'
            ,page: false
            ,height: 'full-200'
        });
        //监听工具条
        table.on('tool(fb-table)', function(obj){
            var data = obj.data;
            data['_token'] = "{!! csrf_token() !!}";
            if(obj.event === 'detail'){
                layer.msg('ID：'+ data.id + ' 的查看{{ trans('app.actions') }}');
            } else if(obj.event === 'del'){
                layer.confirm('真的{{ trans('app.delete') }}行么', function(index){
                    layer.close(index);
                    var load = layer.load();
                    $.ajax({
                        url : main_url+'/'+data.id,
                        data : data,
                        type : 'delete',
                        success : function (data) {
                            obj.del();
                            layer.close(load);
                        },
                        error : function (jqXHR, textStatus, errorThrown) {
                            layer.close(load);
                            layer.msg('服务器出错');
                        }
                    });
                });
            } else if(obj.event === 'edit'){
                window.location.href=main_url+'/'+data.id
            }
        });
        table.on('edit(fb-table)', function(obj){
            var data = obj.data;
            var value = obj.value //得到修改后的值
                    ,data = obj.data //得到所在行所有键值
                    ,field = obj.field; //得到字段
            var ajax_data = {};
            ajax_data['_token'] = "{!! csrf_token() !!}";
            ajax_data[field] = value;
            // 加载样式
            var load = layer.load();
            $.ajax({
                url : main_url+'/'+data.id,
                data : ajax_data,
                type : 'PUT',
                success : function (data) {
                    layer.close(load);
                },
                error : function (jqXHR, textStatus, errorThrown) {
                    layer.close(load);
                    layer.msg('服务器出错');
                }
            });
        });
        var $ = layui.$, active = {
            reload: function(){
                var demoReload = $('#demoReload');

                //执行重载
                table.reload('fb-table', {
                    page: {
                        curr: 1 //重新从第 1 页开始
                    }
                    ,where: {
                        name: demoReload.val()
                    }
                });
            },
            del:function(){
                var checkStatus = table.checkStatus('fb-table')
                        ,data = checkStatus.data;
                var data_id_obj = {};
                var i = 0;
                data.forEach(function(v){ data_id_obj[i] = v.id; i++});
                data.length == 0 ?
                        layer.msg('请选择要{{ trans('app.delete') }}的数据', {
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        })
                        :
                        layer.confirm('是否{{ trans('app.delete') }}已选择的数据',{title:'提示'},function(index){
                            layer.close(index);
                            var load = layer.load();
                            $.ajax({
                                url : delete_all_url,
                                data :  {'ids':data_id_obj,'_token' : "{!! csrf_token() !!}"},
                                type : 'POST',
                                success : function (data) {
                                    var nPage = $(".layui-laypage-curr em").eq(1).text();
                                    //执行重载
                                    table.reload('fb-table', {

                                    });
                                    layer.close(load);
                                },
                                error : function (jqXHR, textStatus, errorThrown) {
                                    layer.close(load);
                                    layer.msg('服务器出错');
                                }
                            });
                        })  ;

            }
        };
        $('.tabel-message .layui-btn').on('click', function(){
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });
        //监听锁定
        form.on('switch(lock)', function(obj){
            var is_menu = 0;
            if(obj.elem.checked)
            {
                is_menu = 1;
            }
            $.ajax({
                url : main_url+'/'+this.value,
                data : {'is_menu' : is_menu , '_token' : "{!! csrf_token() !!}"},
                type : 'PUT',
                success : function (data) {
                    //layer.close(load);
                },
                error : function (jqXHR, textStatus, errorThrown) {
                    //layer.close(load);
                    //layer.msg('服务器出错');
                }
            });
            // layer.tips(this.value + ' ' + this.name + '：'+ obj.elem.checked, obj.othis);
        });
    });
</script>
<script>
    var active = {};
    layui.use(['jquery','element','table','laytpl'], function() {
        var table = layui.table;
        var form = layui.form;
        var laytpl = layui.laytpl;
        var $ = layui.$;
        var element = layui.element;
        //监听工具条
        table.on('tool(fb-table)', function(obj){
            var data = obj.data;
            data['_token'] = "{!! csrf_token() !!}";
            if(obj.event === 'detail'){
                layer.msg('ID：'+ data.id + ' 的查看{{ trans('app.actions') }}');
            } else if(obj.event === 'del'){
                layer.confirm('{{ trans('messages.confirm_delete') }}', function(index){
                    layer.close(index);
                    var load = layer.load();
                    $.ajax({
                        url : main_url+'/'+data.id,
                        data : data,
                        type : 'delete',
                        success : function (data) {
                            layer.close(load);
                            if(data.code == 0)
                            {
                                obj.del();
                            }else{
                                layer.msg(data.message);
                            }
                        },
                        error : function (jqXHR, textStatus, errorThrown) {
                            layer.close(load);
                            $.ajax_error(jqXHR, textStatus, errorThrown);
                        }
                    });
                });
            } else if(obj.event === 'edit'){
                // console.log(data.id)
                window.location.href=main_url+'/'+data.id
                // layer.alert('编辑行：<br>'+ JSON.stringify(data))
            }
            if(typeof $.extend_tool == 'function'){
                $.extend_tool(obj);
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
                    if(data.code == 0)
                    {
                    }else{
                        layer.msg(data.msg);
                    }
                },
                error : function (jqXHR, textStatus, errorThrown) {
                    layer.close(load);
                    $.ajax_error(jqXHR, textStatus, errorThrown);
                }
            });
        });
        var $ = layui.$;
        active = {
            reload: function(){
                var demoReload = $('#demoReload');
                var where = {};
                $(".search_key").each(function(){
                    var name = $(this).attr('name');
                    where["search["+name+"]"] = $(this).val();
                });
                //执行重载
                table.reload('fb-table', {
                    page: {
                        curr: 1 //重新从第 1 页开始
                    }
                    ,where: where
                    ,error:function(res, curr, count)
                    {
                        console.log(res)
                        $.ajax_error(jqXHR, textStatus, errorThrown);
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
                        layer.msg('请选择要删除的数据', {
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        })
                        :
                        layer.confirm('是否删除已选择的数据',{title:'提示'},function(index){
                            layer.close(index);
                            var load = layer.load();
                            $.ajax({
                                url : delete_all_url,
                                data :  {'ids':data_id_obj,'_token' : "{!! csrf_token() !!}"},
                                type : 'POST',
                                success : function (data) {
                                    layer.close(load);
                                    if(data.code == 0)
                                    {
                                        var nPage = $(".layui-laypage-curr em").eq(1).text();
                                        //执行重载
                                        table.reload('fb-table', {
                                            page: {
                                                curr: nPage //重新从第 1 页开始
                                            }
                                        });
                                    }else{
                                        layer.msg(data.message);
                                    }
                                },
                                error : function (jqXHR, textStatus, errorThrown) {
                                    layer.close(load);
                                    $.ajax_error(jqXHR, textStatus, errorThrown);
                                }
                            });
                        })  ;

            }
        };
        $('.tabel-message .layui-btn').on('click', function(){
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });
    });
</script>
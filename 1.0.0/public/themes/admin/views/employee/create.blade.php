<div class="main">
    {!! Theme::widget('breadcrumb')->render() !!}
    <div class="main_full">
        {!! Theme::partial('message') !!}
        <div class="layui-col-md12">
            <div class="fb-main-table">
                <form class="layui-form" action="{{guard_url('employee')}}" method="post" lay-filter="fb-form">
                    <div class="layui-form-item">
                        <label class="layui-form-label">* {{ trans('job_category.name') }}</label>
                        <div class="layui-input-inline">
                            <select name="job_category_id" class="layui-select" lay-verify="required">
                                @foreach($job_categories as $key => $job_category)
                                    <option value="{{ $job_category['id'] }}" @if($job_category['parent_id'] == 0) disabled @endif>{{ $job_category['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans("job.name") }}</label>
                        <div class="layui-input-block">
                            <?php $i=1 ?>
                            @foreach($jobs as $key => $job)
                                <input type="checkbox" name="jobs[]" value="{{ $job->id }}" title="{{ $job->name }}" >
                                <?php $i++ ?>
                            @endforeach
                        </div>
                    </div>

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
                        <label class="layui-form-label">{{ trans('app.phone_number') }}</label>
                        <div class="layui-input-inline">
                            <input type="text" name="phone_number" autocomplete="off" placeholder="请输入{{ trans('app.phone_number') }}" class="layui-input" >
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('app.tel') }}</label>
                        <div class="layui-input-inline">
                            <input type="text" name="tel" autocomplete="off" placeholder="请输入{{ trans('app.tel') }}" class="layui-input" >
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('app.email') }}</label>
                        <div class="layui-input-inline">
                            <input type="text" name="email" autocomplete="off" placeholder="请输入{{ trans('app.email') }}" class="layui-input" >
                        </div>
                    </div>
                    <!--
                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('app.address') }}</label>
                        <div class="layui-input-inline">
                            <input type="text" name="address" autocomplete="off" placeholder="请输入{{ trans('app.address') }}" class="layui-input" >
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">英文{{ trans('app.address') }}</label>
                        <div class="layui-input-inline">
                            <input type="text" name="en_address" autocomplete="off" placeholder="请输入英文{{ trans('app.address') }}" class="layui-input" >
                        </div>
                    </div>

                    -->
                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('app.intro') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="intro"  placeholder="请输入{{  trans('app.intro') }}"  class="layui-textarea"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">英文{{ trans('app.intro') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="en_intro"  placeholder="请输入英文{{  trans('app.intro') }}"  class="layui-textarea"></textarea>

                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">* {{ trans('employee.label.image') }}</label>
                        {!! $employee->files('image')
                        ->url($employee->getUploadUrl('image'))
                        ->uploader()!!}
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">* {{ trans('employee.label.wechat_qrcode') }}</label>
                        {!! $employee->files('wechat_qrcode')
                        ->url($employee->getUploadUrl('wechat_qrcode'))
                        ->uploader()!!}
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('employee.label.education') }}</label>
                        <div class="layui-input-inline">
                            <script type="text/plain" id="education" name="education" style="width:1000px;height:240px;"></script>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">英文{{ trans('employee.label.education') }}</label>
                        <div class="layui-input-inline">
                            <script type="text/plain" id="en_education" name="en_education" style="width:1000px;height:240px;"></script>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('employee.label.field') }}</label>
                        <div class="layui-input-inline">
                            <script type="text/plain" id="field" name="field" style="width:1000px;height:240px;"></script>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">英文{{ trans('employee.label.field') }}</label>
                        <div class="layui-input-inline">
                            <script type="text/plain" id="en_field" name="en_field" style="width:1000px;height:240px;"></script>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('employee.label.employment_record') }}</label>
                        <div class="layui-input-inline">
                            <script type="text/plain" id="employment_record" name="employment_record" style="width:1000px;height:240px;"></script>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">英文{{ trans('employee.label.employment_record') }}</label>
                        <div class="layui-input-inline">
                            <script type="text/plain" id="en_employment_record" name="en_employment_record" style="width:1000px;height:240px;"></script>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('employee.label.language') }}</label>
                        <div class="layui-input-inline">
                            <script type="text/plain" id="language" name="language" style="width:1000px;height:240px;"></script>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">英文{{ trans('employee.label.language') }}</label>
                        <div class="layui-input-inline">
                            <script type="text/plain" id="en_language" name="en_language" style="width:1000px;height:240px;"></script>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('employee.label.work_experience') }}</label>
                        <div class="layui-input-inline">
                            <script type="text/plain" id="work_experience" name="work_experience" style="width:1000px;height:240px;"></script>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">英文{{ trans('employee.label.work_experience') }}</label>
                        <div class="layui-input-inline">
                            <script type="text/plain" id="en_work_experience" name="en_work_experience" style="width:1000px;height:240px;"></script>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('employee.label.social_duties_honors') }}</label>
                        <div class="layui-input-inline">
                            <script type="text/plain" id="social_duties_honors" name="social_duties_honors" style="width:1000px;height:240px;"></script>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">英文{{ trans('employee.label.social_duties_honors') }}</label>
                        <div class="layui-input-inline">
                            <script type="text/plain" id="en_social_duties_honors" name="en_social_duties_honors" style="width:1000px;height:240px;"></script>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('employee.label.professional_book') }}</label>
                        <div class="layui-input-inline">
                            <script type="text/plain" id="professional_book" name="professional_book" style="width:1000px;height:240px;"></script>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">英文{{ trans('employee.label.professional_book') }}</label>
                        <div class="layui-input-inline">
                            <script type="text/plain" id="en_professional_book" name="en_professional_book" style="width:1000px;height:240px;"></script>
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
{!! Theme::asset()->container('ueditor')->scripts() !!}
<script>
    var toolbars = [
        [
            'source', //源代码
            'anchor', //锚点
            'undo', //撤销
            'redo', //重做
            'bold', //加粗
            'indent', //首行缩进
            'italic', //斜体
            'underline', //下划线
            'strikethrough', //删除线
            'subscript', //下标
            'fontborder', //字符边框
            'superscript', //上标
            'formatmatch', //格式刷
            'blockquote', //引用
            'pasteplain', //纯文本粘贴模式
            'selectall', //全选
            'horizontal', //分隔线
            'removeformat', //清除格式
            'unlink', //取消链接
            'splittorows', //拆分成行
            'splittocols', //拆分成列
            'splittocells', //完全拆分单元格
            'deletecaption', //删除表格标题
            'inserttitle', //插入标题
            'mergecells', //合并多个单元格
            'deletetable', //删除表格
            'cleardoc', //清空文档
            'insertparagraphbeforetable', //"表格前插入行"
            'fontfamily', //字体
            'fontsize', //字号
            'paragraph', //段落格式
            'edittable', //表格属性
            'edittd', //单元格属性
            'justifyleft', //居左对齐
            'justifyright', //居右对齐
            'justifycenter', //居中对齐
            'justifyjustify', //两端对齐
            'forecolor', //字体颜色
            'backcolor', //背景色
            'insertorderedlist', //有序列表
            'insertunorderedlist', //无序列表
            'fullscreen', //全屏
            'directionalityltr', //从左向右输入
            'directionalityrtl', //从右向左输入
            'imagenone', //默认
            'imageleft', //左浮动
            'imageright', //右浮动
            'imagecenter', //居中
            'lineheight', //行间距
            'edittip ', //编辑提示
            'customstyle', //自定义标题
            'autotypeset', //自动排版
            'touppercase', //字母大写
            'tolowercase', //字母小写
            'inserttable', //插入表格
        ]
    ];
    <?php $arr= ['education','field','employment_record','language','work_experience','social_duties_honors','professional_book'];?>
    @foreach($arr as $item)
    var ue_{{ $item }} = getUeCopy("{{ $item }}",toolbars);
    var ue_en_{{ $item }} = getUeCopy("en_{{ $item }}",toolbars);
    @endforeach
</script>
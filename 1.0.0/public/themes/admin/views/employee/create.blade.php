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
                            <textarea name="intro" placeholder="请输入{{  trans('app.intro') }}"  class="layui-textarea"></textarea>
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
                            <textarea name="education"  placeholder="请输入{{  trans('employee.label.education') }}"  class="layui-textarea"></textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">英文{{ trans('employee.label.education') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="en_education"  placeholder="请输入英文{{  trans('employee.label.education') }}"  class="layui-textarea"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('employee.label.field') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="field"  placeholder="请输入{{  trans('employee.label.field') }}"  class="layui-textarea"></textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">英文{{ trans('employee.label.field') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="en_field"  placeholder="请输入英文{{  trans('employee.label.field') }}"  class="layui-textarea"></textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('employee.label.employment_record') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="employment_record"  placeholder="请输入{{  trans('employee.label.employment_record') }}"  class="layui-textarea"></textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">英文{{ trans('employee.label.employment_record') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="en_employment_record"  placeholder="请输入英文{{  trans('employee.label.employment_record') }}"  class="layui-textarea"></textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('employee.label.language') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="language"  placeholder="请输入{{  trans('employee.label.language') }}"  class="layui-textarea"></textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">英文{{ trans('employee.label.language') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="en_language"  placeholder="请输入英文{{  trans('employee.label.language') }}"  class="layui-textarea"></textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('employee.label.work_experience') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="work_experience"  placeholder="请输入{{  trans('employee.label.work_experience') }}"  class="layui-textarea"></textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">英文{{ trans('employee.label.work_experience') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="en_work_experience"  placeholder="请输入英文{{  trans('employee.label.work_experience') }}"  class="layui-textarea"></textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('employee.label.social_duties_honors') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="social_duties_honors"  placeholder="请输入{{  trans('employee.label.social_duties_honors') }}"  class="layui-textarea"></textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">英文{{ trans('employee.label.social_duties_honors') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="en_social_duties_honors"  placeholder="请输入英文{{  trans('employee.label.social_duties_honors') }}"  class="layui-textarea"></textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('employee.label.professional_book') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="professional_book"  placeholder="请输入{{  trans('employee.label.professional_book') }}"  class="layui-textarea"></textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">英文{{ trans('employee.label.professional_book') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="en_professional_book"  placeholder="请输入英文{{  trans('employee.label.professional_book') }}"  class="layui-textarea"></textarea>
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

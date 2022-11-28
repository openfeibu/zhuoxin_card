<div class="main">
    {!! Theme::widget('breadcrumb')->render() !!}
    <div class="main_full">
        {!! Theme::partial('message') !!}
        <div class="layui-col-md12">
            <div class="fb-main-table">
                <form class="layui-form" action="{{guard_url('employee/'.$employee->id)}}" method="post" method="post" lay-filter="fb-form">
                    <div class="layui-form-item">
                        <label class="layui-form-label">* {{ trans('app.name') }}</label>
                        <div class="layui-input-inline">
                            <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输入{{ trans('app.name') }}"  class="layui-input" value="{{ $employee['name'] }}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">* {{ trans('app.en_name') }}</label>
                        <div class="layui-input-inline">
                            <input type="text" name="en_name" lay-verify="required" autocomplete="off" placeholder="请输入{{ trans('app.en_name') }}"  class="layui-input" value="{{ $employee['en_name'] }}" >
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">* {{ trans('app.phone_number') }}</label>
                        <div class="layui-input-inline">
                            <input type="text" name="phone_number" lay-verify="required" autocomplete="off" placeholder="请输入{{ trans('app.phone_number') }}"  class="layui-input" value="{{ $employee['phone_number'] }}" >
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">* {{ trans('app.tel') }}</label>
                        <div class="layui-input-inline">
                            <input type="text" name="tel" lay-verify="required" autocomplete="off" placeholder="请输入{{ trans('app.tel') }}"  class="layui-input" value="{{ $employee['tel'] }}" >
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">* {{ trans('app.email') }}</label>
                        <div class="layui-input-inline">
                            <input type="text" name="email" lay-verify="required" autocomplete="off" placeholder="请输入{{ trans('app.email') }}"  class="layui-input" value="{{ $employee['email'] }}" >
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">* {{ trans('app.address') }}</label>
                        <div class="layui-input-inline">
                            <input type="text" name="address" lay-verify="required" autocomplete="off" placeholder="请输入{{ trans('app.address') }}"  class="layui-input" value="{{ $employee['address'] }}" >
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">* 英文{{ trans('app.address') }}</label>
                        <div class="layui-input-inline">
                            <input type="text" name="en_address" lay-verify="required" autocomplete="off" placeholder="请输入英文{{ trans('app.address') }}"  class="layui-input" value="{{ $employee['en_address'] }}" >
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">* {{ trans('app.intro') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="intro"  placeholder="请输入{{  trans('employee.label.intro') }}"  class="layui-textarea">{{ $employee['intro'] }}</textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">* 英文{{ trans('app.intro') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="en_intro"  placeholder="请输入英文{{  trans('employee.label.intro') }}"  class="layui-textarea">{{ $employee['en_intro'] }}</textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('employee.label.image') }}</label>
                        {!! $employee->files('image')
                        ->url($employee->getUploadUrl('image'))
                        ->uploader()!!}
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('employee.label.education') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="education"  placeholder="请输入{{  trans('employee.label.education') }}"  class="layui-textarea">{{ $employee['education'] }}</textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">英文{{ trans('employee.label.education') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="en_education"  placeholder="请输入英文{{  trans('employee.label.education') }}"  class="layui-textarea">{{ $employee['en_education'] }}</textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('employee.label.field') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="field"  placeholder="请输入{{  trans('employee.label.field') }}"  class="layui-textarea">{{ $employee['field'] }}</textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">英文{{ trans('employee.label.field') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="en_field"  placeholder="请输入英文{{  trans('employee.label.field') }}"  class="layui-textarea">{{ $employee['en_field'] }}</textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('employee.label.employment_record') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="employment_record"  placeholder="请输入{{  trans('employee.label.employment_record') }}"  class="layui-textarea">{{ $employee['employment_record'] }}</textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">英文{{ trans('employee.label.employment_record') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="en_employment_record"  placeholder="请输入英文{{  trans('employee.label.employment_record') }}"  class="layui-textarea">{{ $employee['en_employment_record'] }}</textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('employee.label.language') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="language"  placeholder="请输入{{  trans('employee.label.language') }}"  class="layui-textarea">{{ $employee['language'] }}</textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">英文{{ trans('employee.label.language') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="en_language"  placeholder="请输入英文{{  trans('employee.label.language') }}"  class="layui-textarea">{{ $employee['en_language'] }}</textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('employee.label.work_experience') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="work_experience"  placeholder="请输入{{  trans('employee.label.work_experience') }}"  class="layui-textarea">{{ $employee['work_experience'] }}</textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">英文{{ trans('employee.label.work_experience') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="en_work_experience"  placeholder="请输入英文{{  trans('employee.label.work_experience') }}"  class="layui-textarea">{{ $employee['en_work_experience'] }}</textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('employee.label.social_duties_honors') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="social_duties_honors"  placeholder="请输入{{  trans('employee.label.social_duties_honors') }}"  class="layui-textarea">{{ $employee['social_duties_honors'] }}</textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">英文{{ trans('employee.label.social_duties_honors') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="en_social_duties_honors"  placeholder="请输入英文{{  trans('employee.label.social_duties_honors') }}"  class="layui-textarea">{{ $employee['en_social_duties_honors'] }}</textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('employee.label.professional_book') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="professional_book"  placeholder="请输入{{  trans('employee.label.professional_book') }}"  class="layui-textarea">{{ $employee['professional_book'] }}</textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">英文{{ trans('employee.label.professional_book') }}</label>
                        <div class="layui-input-inline">
                            <textarea name="en_professional_book"  placeholder="请输入英文{{  trans('employee.label.professional_book') }}"  class="layui-textarea">{{ $employee['en_professional_book'] }}</textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('app.order') }}</label>
                        <div class="layui-input-inline">
                            <input type="text" name="order" autocomplete="off"  class="layui-input" value="{{ $employee['order'] }}" >
                        </div>
                        <div class="layui-form-mid layui-word-aux">从小到大排序</div>
                    </div>
                    <div class="layui-form-item button-group"><div class="layui-input-block"><button class="layui-btn layui-btn-normal layui-btn-lg" lay-submit="" lay-filter="demo1">{{ trans('app.submit_now') }}</button></div></div>
                    {!!Form::token()!!}
                    <input type="hidden" name="_method" value="PUT">
                </form>
            </div>

        </div>
    </div>
</div>

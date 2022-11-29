<div class="main">
    {!! Theme::widget('breadcrumb')->render() !!}
    <div class="main_full">
        {!! Theme::partial('message') !!}
        <div class="layui-col-md12">
            <div class="fb-main-table">
                <form class="layui-form" action="{{guard_url('job_category/'.$job_category->id)}}" method="post" method="post" lay-filter="fb-form">
                    <div class="layui-form-item">
                        <label class="layui-form-label">上级</label>
                        <div class="layui-input-inline">
                            <select name="parent_id" class="layui-select">
                                <option value="0">顶级</option>
                                @foreach($tops as $key => $top)
                                    <option value="{{ $top->id }}" @if($top->id == $job_category->parent_id) selected @endif @if($top->id == $job_category->id) disabled @endif>{{ $top->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">* {{ trans('app.name') }}</label>
                        <div class="layui-input-inline">
                            <input type="text" name="name"  lay-verify="required" autocomplete="off" placeholder="请输入{{ trans('app.name') }}" class="layui-input" value="{{$job_category['name']}}">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">{{ trans('app.order') }}</label>
                        <div class="layui-input-inline">
                            <input type="text" name="order" autocomplete="off" placeholder="" class="layui-input" value="{{$job_category['order']}}" lay-verify="number">
                        </div>
                        <div class="layui-form-mid layui-word-aux">从小到大排序</div>
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
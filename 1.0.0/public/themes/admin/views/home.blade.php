<div class="main">
    <div class="main_full" style="margin-top: 15px;">
        <div class="layui-col-md12">

            <div class="layui-card-box layui-col-space15  fb-clearfix">

                @if(Auth::user()->isSuperuser() )
                    <div class="layui-col-sm6 layui-col-md3">
                        <div class="layui-card">
                            <div class="layui-card-header">
                                <b>公告总数</b>
                                <label>(条)</label>
                                <span class="layui-badge layui-bg-blue layuiadmin-badge">总</span>
                            </div>
                            <div class="layui-card-body layuiadmin-card-list">
                                <p class="layuiadmin-big-font">1</p>
                            </div>
                        </div>
                    </div>
                    <div class="layui-col-sm6 layui-col-md3">
                        <div class="layui-card">
                            <div class="layui-card-header">
                                <b>公告总数</b>
                                <label>(条)</label>
                                <span class="layui-badge layui-bg-blue layuiadmin-badge">总</span>
                            </div>
                            <div class="layui-card-body layuiadmin-card-list">
                                <p class="layuiadmin-big-font">1</p>
                            </div>
                        </div>
                    </div>
                    <div class="layui-col-sm6 layui-col-md3">
                        <div class="layui-card">
                            <div class="layui-card-header">
                                <b>公告总数</b>
                                <label>(条)</label>
                                <span class="layui-badge layui-bg-blue layuiadmin-badge">总</span>
                            </div>
                            <div class="layui-card-body layuiadmin-card-list">
                                <p class="layuiadmin-big-font">1</p>
                            </div>
                        </div>
                    </div>
                    <div class="layui-col-sm6 layui-col-md3">
                        <div class="layui-card">
                            <div class="layui-card-header">
                                <b>公告总数</b>
                                <label>(条)</label>
                                <span class="layui-badge layui-bg-blue layuiadmin-badge">总</span>
                            </div>
                            <div class="layui-card-body layuiadmin-card-list">
                                <p class="layuiadmin-big-font">1</p>
                            </div>
                        </div>
                    </div>
                @endif


            </div>
            <!--
            <div class="layui-card-box fb-clearfix layui-col-space15">

                <div class="layui-col-sm6 layui-col-md6">
                    <div class="power-box fb-clearfix">
                        <p>常用功能</p>
                        <div class="power-box-con">
                            @if(Auth::user()->isSuperuser() || Auth::user()->hasPermission('news.index'))
                                <div class="power-box-item layui-col-md6">
                                    <a href="{{ guard_url('news') }}">
                                        {{ trans('news.name') }}
                                    </a>
                                </div>
                            @endif
                            @if(Auth::user()->isSuperuser() || Auth::user()->hasPermission('video.index'))
                                <div class="power-box-item layui-col-md6">
                                    <a href="{{ guard_url('video') }}">
                                        {{ trans('video.name') }}
                                    </a>
                                </div>
                            @endif
                            @if(Auth::user()->isSuperuser() || Auth::user()->hasPermission('product.index'))
                                <div class="power-box-item layui-col-md6">
                                    <a href="{{ guard_url('product') }}">
                                        {{ trans('product.name') }}
                                    </a>
                                </div>
                            @endif
                            @if(Auth::user()->isSuperuser() || Auth::user()->hasPermission('page.company_announcement.index'))
                                <div class="power-box-item layui-col-md6">
                                    <a href="{{ guard_url('page/company_announcement') }}">
                                        {{ trans('company_announcement.name') }}
                                    </a>
                                </div>
                            @endif
                            @if(Auth::user()->isSuperuser() || Auth::user()->hasPermission('page.chairman.index'))
                                <div class="power-box-item layui-col-md6">
                                    <a href="{{ guard_url('page/chairman') }}">
                                        {{ trans('chairman.name') }}
                                    </a>
                                </div>
                            @endif
                            @if(Auth::user()->isSuperuser() || Auth::user()->hasPermission('page.profile.index'))
                                <div class="power-box-item layui-col-md6">
                                    <a href="{{ guard_url('page/profile') }}">
                                        {{ trans('profile.name') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="layui-col-sm6 layui-col-md6">
                    <div class="message">
                        <div class="message-t"><a href="{{ guard_url('feedback') }}">最新留言</a></div>
                        <div class="message-con">
                            @if(isset($feedbacks))
                                @foreach($feedbacks as $key => $feedback)
                                    <div class="message-item fb-clearfix">
                                        <div class="message-item-l layui-col-sm6 layui-col-md6">{{ $feedback->created_at }}</div>
                                        <div class="message-item-l layui-col-sm6 layui-col-md6">{{ $feedback->content }}</div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            -->
        </div>
    </div>
</div>

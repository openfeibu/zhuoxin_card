function getUe() {
	return ue = UE.getEditor('content',{
		toolbars: [
			[
				'source', //源代码
				'anchor', //锚点
				'undo', //撤销
				'redo', //重做
				'bold', //加粗
				'indent', //首行缩进
				'snapscreen', //截图
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
				'print', //打印
				'preview', //预览
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
				'insertcode', //代码语言
				'fontfamily', //字体
				'fontsize', //字号
				'paragraph', //段落格式
				'simpleupload', //单图上传
				'insertimage', //多图上传
				'edittable', //表格属性
				'edittd', //单元格属性
				'link', //超链接
				'emotion', //表情
				'map', //Baidu地图
				'insertvideo', //视频
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
				'attachment', //附件
				'imagecenter', //居中
				'wordimage', //图片转存
				'lineheight', //行间距
				'edittip ', //编辑提示
				'customstyle', //自定义标题
				'autotypeset', //自动排版
				'touppercase', //字母大写
				'tolowercase', //字母小写
				'background', //背景
				'inserttable', //插入表格
			]
		]

	});
	// body...
}
function getUeCopy(id) {
	return ue_copy = UE.getEditor(id,{
		toolbars: [
			[
				'source', //源代码
				'anchor', //锚点
				'undo', //撤销
				'redo', //重做
				'bold', //加粗
				'indent', //首行缩进
				'snapscreen', //截图
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
				'print', //打印
				'preview', //预览
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
				'insertcode', //代码语言
				'fontfamily', //字体
				'fontsize', //字号
				'paragraph', //段落格式
				'simpleupload', //单图上传
				'insertimage', //多图上传
				'edittable', //表格属性
				'edittd', //单元格属性
				'link', //超链接
				'emotion', //表情
				'map', //Baidu地图
				'insertvideo', //视频
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
				'attachment', //附件
				'imagecenter', //居中
				'wordimage', //图片转存
				'lineheight', //行间距
				'edittip ', //编辑提示
				'customstyle', //自定义标题
				'autotypeset', //自动排版
				'touppercase', //字母大写
				'tolowercase', //字母小写
				'background', //背景
				'inserttable', //插入表格
			]
		]

	});
	// body...

}
function getContent(id) {
	if(!id)
	{
		id = 'content';
	}
	if(UE.getEditor(id).queryCommandState('source')!=0)
	{
		UE.getEditor(id).execCommand('source');
	}
}
/* ========================================================================
 * Bootstrap: alert.js v3.1.0
 * http://getbootstrap.com/javascript/#alerts
 * ========================================================================
 * Copyright 2011-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */

layui.use('jquery', function(){
	var $ = layui.$;
	var dismiss = '[data-dismiss="alert"]'
	var Alert   = function (el) {
		$(el).on('click', dismiss, this.close)
	}

	Alert.prototype.close = function (e) {
		var $this    = $(this)
		var selector = $this.attr('data-target')

		if (!selector) {
			selector = $this.attr('href')
			selector = selector && selector.replace(/.*(?=#[^\s]*$)/, '') // strip for ie7
		}

		var $parent = $(selector)

		if (e) e.preventDefault()

		if (!$parent.length) {
			$parent = $this.hasClass('alert') ? $this : $this.parent()
		}

		$parent.trigger(e = $.Event('close.bs.alert'))

		if (e.isDefaultPrevented()) return

		$parent.removeClass('in')

		function removeElement() {
			$parent.trigger('closed.bs.alert').remove()
		}

		$.support.transition && $parent.hasClass('fade') ?
			$parent
				.one($.support.transition.end, removeElement)
				.emulateTransitionEnd(150) :
			removeElement()
	}


	// ALERT PLUGIN DEFINITION
	// =======================

	var old = $.fn.alert

	$.fn.alert = function (option) {
		return this.each(function () {
			var $this = $(this)
			var data  = $this.data('bs.alert')

			if (!data) $this.data('bs.alert', (data = new Alert(this)))
			if (typeof option == 'string') data[option].call($this)
		})
	}

	$.fn.alert.Constructor = Alert


	// ALERT NO CONFLICT
	// =================

	$.fn.alert.noConflict = function () {
		$.fn.alert = old
		return this
	}


	// ALERT DATA-API
	// ==============

	$(document).on('click.bs.alert.data-api', dismiss, Alert.prototype.close)
})

layui.use(['form'], function(){
	var form = layui.form;
	form.render();
});

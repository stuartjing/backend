<?php
#富文本/编辑器
class HtmlAttr extends IAttr{
	
	/**
	 * 展示
	 */
	public function view($vo=array()){
		return isset($vo['val'])?$vo['val']:'';
		
//		$str .= '
//			<div>
//				<iframe src="require_order_view.php?edit_id='.$vo['code'].'" frameborder="0" scrolling="no" onload="this.height=this.contentWindow.document.body.scrollHeight" allowtransparency="true" style="width:100%;"></iframe>
//			</div>
//		';
	}
}
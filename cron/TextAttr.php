<?php
#输入框
class TextAttr extends IAttr{
	
	/**
	 * 展示
	 */
	public function view($vo=array()){
		return isset($vo['val'])?$vo['val']:'';
	}
}
<?php
#多行输入框
class TextareaAttr extends IAttr{
	
	/**
	 * 展示
	 */
	public function view($vo=array()){
		return isset($vo['val'])?$vo['val']:'';
	}
}
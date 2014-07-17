<?php
#浮点数
class FloatAttr extends IAttr{
	
	/**
	 * 展示
	 */
	public function view($vo=array()){
		return isset($vo['val'])?$vo['val']:'';
	}
	
}
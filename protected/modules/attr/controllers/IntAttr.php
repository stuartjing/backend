<?php
#数值
class IntAttr extends IAttr{
	
	/**
	 * 展示
	 */
	public function view($vo=array()){
		return isset($vo['val'])?$vo['val']:'';
	}
	
}
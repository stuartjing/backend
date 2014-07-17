<?php
#单选框
class RadioAttr extends IAttr{
	
	/**
	 * 展示
	 */
	public function view($vo=array()){
		$def = isset($vo['val'])?$vo['val']:'';
		$options = $this->makeOption(isset($vo['option'])?$vo['option']:'');
		$def = isset($options[$def])?$options[$def]:'';
		return $def;
	}
}
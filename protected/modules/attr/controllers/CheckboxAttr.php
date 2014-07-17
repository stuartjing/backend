<?php
#多选框
class CheckboxAttr extends IAttr{
	
	/**
	 * 展示
	 */
	public function view($vo=array()){
		$def = (isset($vo['val'])&&$vo['val'])?$vo['val']:array();
		$options = $this->makeOption(isset($vo['option'])?$vo['option']:'');
		foreach ($def as $key=>$val){
			$def[$key] = isset($options[$val])?$options[$val]:'';
		}
		return implode(',', $def);
	}
}
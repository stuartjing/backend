<?php
/**
 * 属性接口
 * 实体属性显示和处理类集合，仅占用模块位置，无法作为模块使用
 * @author lyj
 */
abstract Class IAttr {
	
	/**
	 * 表单
	 * @param string $vo 属性配置，默认空数组
	 * @return string 显示的html代码
	 */
	//abstract public function input($vo=array());
	
	/**
	 * 保存
	 * @param array $ob 属性值，默认空数组
	 * @return array 可保存的值
	 */
	//abstract public function save($ob=array());
	
	/**
	 * 显示
	 * @param string $vo 属性配置，默认空数组
	 * @return string 显示的html代码
	 */
	abstract public function view($vo=array());
	
	/**
	 * 获取子元素对象
	
	public function attrOb($type){
		$obj = null;
		$type = ucfirst($type);
		if(file_exists(YiiBase::getPathOfAlias('application.modules.attr.controllers').'/'.ucfirst($type).'Attr.php')){	//存在验证
			eval('
				$obj = new '.$type.'Attr();
			');
		}
		return $obj;
	}
	 */
	/**
	 * 根据字符串获取候选项（单选，复选）
	 * @param $option string	候选项字符串
	 * @return array	可用候选项数组
	 */
	public function makeOption($option){
		$options = explode(',', $option);
		//支持给定键值
		$new_options = array();
		foreach ($options as $key=>$oo){
			if(strpos($oo, '=>')){
				$ookv = explode('=>', $oo);
				$key = $ookv[0];
				$oo = $ookv[1];
			}else{
				$key = $oo;
			}
			$new_options[$key] = $oo;
		}
		return $new_options;
	}
}

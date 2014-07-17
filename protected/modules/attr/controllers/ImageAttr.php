<?php
#图片
class ImageAttr extends IAttr{
	
	/**
	 * 展示
	 */
	public function view($vo=array()){
		$val = isset($vo['val'])?$vo['val']:'';
		$return = isset($vo['return'])?$vo['return']:false;	//返回数据
		
		if(empty($return)){
			//格式化内容
			$params = array(
				'/\{\d\}/' => empty($val)?'-':$val
			);
			//$val = preg_replace(array_keys($params), array_values($params), $vo['url']);
		}
		
		return $val;
	}
}
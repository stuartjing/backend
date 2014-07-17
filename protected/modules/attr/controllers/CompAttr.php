<?php
#组合框
class CompAttr extends IAttr{
	
	/**
	 * 展示
	 */
	public function view($vo=array()){
		$def = isset($vo['val'])?$vo['val']:'';				//默认值
		$format = isset($vo['format'])?$vo['format']:'';	//格式
		$childs = $vo['child'];								//包含元素
		$return = isset($vo['return'])?$vo['return']:false;	//返回数组
		if($return){
			$val = $def;
		}else{
			$sub_html = array(); 		//子类型集合
			foreach($childs as $ckey=>$child){
				$child_ob = $this->attrOb($child['type']);				//子节点操作对象
				$child['is_child'] = ''.$vo['code'].']['.$child['id'];	//子节点名称
				$child['val'] = isset($def[$ckey])?$def[$ckey]:'';		//子节点默认值
				$true_val = $child_ob->view($child);
				$sub_html['/\{'.$child['id'].'\}/'] = empty($true_val)?'-':$true_val;	//替换内容
			}
			$val = preg_replace(array_keys($sub_html), array_values($sub_html), $format);
		}
		return $val;
	}
	
}
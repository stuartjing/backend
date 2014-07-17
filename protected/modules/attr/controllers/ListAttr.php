<?php
#关联列表
class ListAttr extends IAttr{
	
	/**
	 * 展示
	 */
	public function view($vo=array()){
		$val = isset($vo['val'])?$vo['val']:'';				//显存值
		$return = isset($vo['return'])?$vo['return']:false;	//返回数组
		$child = $vo['child'];								//包含元素
		$child['return'] = $return;							//子节点返回类型
		$child_ob = $this->attrOb($child['type']);			//子节点操作对象
		
		if(empty($child_ob)){
			return '';			//创建失败则返回空串
		}
		
		$new_vo = array();
		//获取真实数据
		if($val){
			foreach($val as $id){
				$child['val'] = $id;
				$new_vo[] = $child_ob->view($child);
			}
		}
		
		if(!$return){
			$nstr = array();
			foreach($new_vo as $nvo){
				if(is_array($nvo)){
					$nstr[] = isset($nvo['name'])?$nvo['name']:'';
				}else{
					$nstr[] = $nvo;
				}
			}
			$new_vo = implode(',', $nstr);
		}
		return $new_vo;
	}
	
}
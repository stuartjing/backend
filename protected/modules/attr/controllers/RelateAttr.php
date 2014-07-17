<?php
#关联类型
class RelateAttr extends IAttr{
	
	/**
	 * 展示
	 */
	public function view($vo=array()){
		
		$cache = Yii::app()->cache;
		$login_user = Yii::app()->user->getState('info');
		$gid = Yii::app()->params['dbGame'];		
		$val = isset($vo['val'])?$vo['val']:'';				//显存值
		$return = isset($vo['return'])?$vo['return']:false;	//返回数组
		$new_vo = array();
		
		//获取真实数据
		if($val){
			if(preg_match('/^[a-z0-9]{24}$/', $val)){
				$val = new MongoId($val);
			}
			$info = Entity::model('entity_'.$gid.'_'.$vo['object'])->findByPk($val);	//查询
			$softFields = $info->getSoftAttributeNames();								//配置字段
			$new_vo = array(
				'id' 	=> $val,
				'name' 	=> $info['name'],
			);
			
			//处理额外字段
			if(is_array($return)){
				foreach($return as $rf){
					if(in_array($rf, $softFields)){	//只接收模型中存在字段
						$new_vo[$rf] = $info[$rf];
					}
				}
			}
			
		}

		return $return?$new_vo:(isset($new_vo['name'])?$new_vo['name']:'');
	}
}
<?php
/**
 * 属性挂件
 * 功能：显示一个实体属性
 */
class AttrW extends Widget{
	public $id; 			//属性id
	public $relate;			//关联信息 实体类型-字段名  如：hero-Abilities
	
	public function init(){
		ob_start();
	}
	
	public function run(){
		//获取内容
		$content = ob_get_contents();	//获取
		ob_end_clean();					//清空输出
		$info  = $_GET['widget_info'];
		
		//获取属性值
		$v = isset($info[$this->id])?$info[$this->id]:'';
		
		//关联属性处理
		if(empty($this->relate)){
			//如果是自定义属性，则根据属性配置处理
			if(!in_array($this->id, array('_id','name','addtime'))){
				//获取属性值配置
				$tableName = $info['trueCollection'];
				$tableInfo = explode('_', $tableName);
				$attr = Attr::model()->getAll($tableInfo[2]);	//获取实体
				$attr = $attr[$this->id];
	
				//属性处理
				$check_ids = empty($v)?array():$v;
				
				//统一结构
				if(!is_array($check_ids)){
					$check_ids = array($check_ids);
				}
				
				//若为mongid格式则进行查询
				if($check_ids && isset($attr['child']) && ($attr['child']['type']=='relate')){
					$check_game = $tableInfo[1];				//游戏代码，全局配置变量,当前从表明中获取
					if($attr['type']==='list'){
						$check_object = $attr['child']['object'];	//实体代码，属性id最后一段字符
					}elseif($attr['type']==='relate'){
						$check_object = $attr['object'];	//实体代码，属性id最后一段字符
					}else{
						$check_object = '';
					}
					
					//游戏和实体都存在时才进行查询
					if($check_game && $check_object){
						//获取数据
						$new_v = array();
						foreach($check_ids as $rid){
							if(preg_match('/^[a-z0-9]{24}$/', $rid)){
								$rid = new MongoId($rid);
							}
							$one_info = Entity::model('entity_'.$check_game.'_'.$check_object)->findByPk($rid);
							if($one_info){
								$new_v[] = $one_info->toArray();
							}
						}
						$v = $new_v;
						
					}
				}
			}
		}else{
			$relateInfo = explode('-', $this->relate);
			if(count($relateInfo==2)){
				$cond = is_array($v)?'$in':'==';
				$criteria = new EMongoCriteria();
				$criteria->addCond($relateInfo[1], $cond, $v);	//非隐藏数据
				$v = Entity::model('entity_'.Yii::app()->params['dbGame'].'_'.$relateInfo[0])->findAll($criteria);
			}
		}
		
		
		
		//内容解析
		if($content){	//有内容
			//非list，checkbox，comp属性将直接显示第一个结果的名字；若是list型，则直接返回结果集以供循环使用
			if(empty($this->relate) && is_array($v) && !in_array($attr['type'],array('list','checkbox','comp'))){
				$v = $v[0]['name'];
			}
			$content = $this->initTwig($content, array('v'=>$v));		//解析内容
		}else{			//无内容
			$content = is_array($v)?$v[0]['name']:$v;
		}
		
		echo $content;		//直接输出处理后内容
	}
} 
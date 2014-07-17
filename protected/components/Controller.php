<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	
	/**
	 * 根据
	 * @param DBModel	模型对象
	 * @param int 		记录id
	 * @return DBModel 获取数据后的模型对象
	 * @throws CHttpException
	 */
	public function loadDBModel($model, $id){
		if(preg_match('/^[a-z0-9]{24}$/', $id)){
			$id = new MongoId($id);
		}
		$model = $model->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'数据还不存在。');
		return $model;
	}
	
	/**
	 * 将结果集转为一维列表,兼容attr属性
	 * @param $rs	array	数据集
	 * @param $val	str		做为值的数据键值
	 * @param $key	str		做为键的数据键值
	 * @return array 一维列表
	 */
	public function list_from_rs($rs,$val='id',$key=''){
		$list = array();
		if(empty($rs)){
			return $list;
		}
		
		foreach($rs as $k => $v){
			if(is_object($v)){
				$v = $v->toArray();
			}
			
			if($k==='attr'){continue;}
			
			if(isset($v[$val])){
				if(empty($key)){
					$list[] = $v[$val];
				}else{
					$list[''.$v[$key]] = $v[$val];
				}
			}else{
				if(empty($key)){
					$list[] = $v['attr'][$val];
				}else{
					$list[$v['attr'][$key]] = $v['attr'][$val];
				}
			}
		}
		
		return $list;
	}
	
	/**
	 * 将一维列表转为下拉框选项
	 * @param $list	array	数据源
	 * @param $def	str		默认选中值
	 * @return str		下拉框选项html
	 */
	public function option_from_list($list, $def='0'){
		$str = '<option value="0">请选择</option>';
		//为空则返回提示
		if(empty($list)){
			return '<option value="0">没有数据</option>';
		}

		foreach($list as $k => $v){
			if(!empty($k)||!empty($v)){
				$sub_html = '';
				if(''.$def==$k){
					$sub_html = ' selected="selected" ';
				}
				$str .= '<option '.$sub_html.' value="'.$k.'">'.$v.'</option>';
			}
		}
		return $str;
	}
	
	/**
	 * 页面数据输出函数,数据为空则显示其它符号代替
	 * @param val mixed 需输出数据
	 * @param key mixed 需输出val中 key 对应数据
	 * @param def mixed 默认替代符号
	 * @author lyj
	 */
	public function mkd($rs="",$key=false,$def='-'){
		$val = $rs;
		if(is_array($rs)&&$key!==false){
			//不存在或职位空，则返回默认值
			if(isset($rs[$key]) && !empty($rs[$key])){
				$val = $rs[$key];
			}else{
				return $def;
			}
		}
		$val = $this->_mkd($val,$def);
		return $val;
	}
	
	public function _mkd($val="",$def='-'){
		if(empty($val)||$val=='0000-00-00 00:00:00'||$val=='0000-00-00'){
			$val =  $def;
		}
		return $val;
	}
	
	/**
	 * 执行属性处理对象调用
	 * @param string $type 属性类型
	 * @param string $act 调用方法
	 * @param mixed  $val 参数	
	 * @return 调用结果
	 */
	public function getAttrExe($act, $val, $def_type=''){
		$type = empty($def_type)?(isset($val['type'])?$val['type']:''):$def_type;		//获取类型
		$rs = false;

		//验证
		if(empty($type)){return $rs;}
		
		$type = ucfirst($type);
		$cpath = 'application.modules.attr.controllers';
		if(file_exists(YiiBase::getPathOfAlias($cpath).'/'.$type.'Attr.php')){	//存在验证
			eval('
				$obj = new '.$type.'Attr();
				$rs = $obj->'.$act.'($val);
			');
		}
		return $rs;
	}
	
	/**
	 * 生成属性html展示代码
	 * @param array $vo 属性配置	
	 * @param mixed  $val 属性值
	 * @return html代码
	 */
	public function getAttrView($vo=array(), $val=''){
		$vo['val'] = $val;
		return $this->getAttrExe('view', $vo);
	}
	
	/**
	 * 分页查询
	 * @param DBModel			$model		数据所在表的模型对象
	 * @param EMongoCriteria  	$criteria 	查询过滤器
	 * @param int  				$size 		每页记录数，默认10
	 * @return 包含查询结果[rs]和分页信息[pages]的数组
	 */
	public function makePage($model, $criteria=array(), $size=10){
		$count = $model->count($criteria);    
        
        //创建分页数据并加入到查询器中
        $pager = new CPagination($count);
        $pager->pageSize = $size;
		$criteria->offset($pager->getCurrentPage()*$pager->getPageSize());	//无法使用$pager->applyLimit($criteria);代替
		$criteria->limit($pager->getPageSize());
        
    	//获取用户数据
        $rs = $model->findAll($criteria); 
		return array('rs'=>$rs,'pages'=>$pager);
	}
	
	/**
	 * 分页显示，直接输出分页信息
	 * @param CPagination 	$pages	分页信息
	 * @return null
	 */
	public function showPage($pages){
		if($pages){
			$this->widget('CLinkPager',array(    
				'header'=>'',
				'firstPageLabel' => '首页',
				'lastPageLabel' => '末页',
				'prevPageLabel' => '上一页',
				'nextPageLabel' => '下一页',
				'pages' => $pages,
				'maxButtonCount'=>13
			));
		}
	}
	
	
	/**
	 * 设置缓存数据
	 * @param array $index 	索引
	 * @param array $data 	数据	
	 * @param int 	$hour	失效小时数
	 * @param ob 	$dependency	依赖条件 ，默认为空
	 * @return 设置结果
	 */
	public function setC($index='', $data=array(), $hour=24, $dependency=null){
		$cache = Yii::app()->cache;
		return $cache->set($index, $data, 3600*$hour, $dependency);
	}
	
	/**
	 * 获取缓存数据
	 * @param string $index	索引
	 * @return mixed  数据
	 */
	public function getC($index=''){
		$cache = Yii::app()->cache;
		$data = $cache->get($index);
		return empty($data)?'':$data;
	}
	
	/**
	 * 设置实体
	 * @return 设置结果
	 */
	public function setObject($object_id){
		return $this->setC($this->get_login_user('_id').'_current_object', $object_id);
	}
	public function getObject(){
		return $this->getC($this->get_login_user('_id').'_current_object');
	}
	
	##################### 查询列表，前台独有 ##########################
	
	/**
	 * 不做unicode操作的json_encode
	 * @param $array array			源数据
	 * @return array				处理后数据
	 */
	function json_encode_china($array) {
	    return urldecode(json_encode($this->_url_encode($array)));      
	}  
	function _url_encode($str) {  
	    if(is_array($str)) {  
	        foreach($str as $key=>$value) {
	        	$key_dump = urlencode($key);
	        	if($key_dump!==$key){
	        		unset($str[$key]);
	        	}
	            $str[$key_dump] = $this->_url_encode($value);  
	        }  
	    } else {  
	        $str = urlencode($str);  
	    }  
	    return $str;  
	}
	
	/**
	 * 查询数据
	 * @param $object_code	string		查询实体类型
	 * @param $wheres		array		解析后过滤器array('name'=>array('cond'=>'==', 'val'=>'龙龙'))
	 * @param $fields		array		字段列表
	 * @return array	查询结果集
	 */
	protected function _query_filter($object_code, $wheres, $fields=array()){
		$data = array();	//查询结果
		
		//应用过滤
		$criteria = new EMongoCriteria();
		$criteria->addCond('hidden', 'notin', array(1, true));	//非隐藏数据
		foreach ($wheres as $fk=>$fo){
			if($fo['val']){
				$criteria->addCond($fk, $fo['cond'],$fo['val']);
			}
		}
		//字段
		if($fields){
			$criteria->select($fields);
		}
		$criteria->sort('_id', EMongoCriteria::SORT_ASC);		//默认排序为_id正序排序
		$rs = Entity::model('entity_'.Yii::app()->params['dbGame'].'_'.$object_code)->findAll($criteria);
		
		foreach($rs as $vo){
			if($fields){
				$one = array();
				//获取所需数据
				foreach($fields as $av){
					$one[] = $vo[$av];		//中文动态字段无法使用isset判定，直接赋值
				}
				$data[] = $one;
			}else{
				$data[] = $vo->toArray();
			}
		}
		return $data;
	}
	
	/**
	 * 解析过滤器并重构为二维数组
	 * @param $filter string 过滤器 如：filter/cr=name:0;crs=*:1;crv=41412:2132
	 * @return array	二维数组形式
	 */
	protected function _search_fields($object_code){
		$attr = Attr::model()->getAll('dota2', $object_code, array('search'=>'yes'));	//可查询字段
		$new_attrs = array();
		foreach($attr as $val){
			$new_attrs[]=$val['code'];
		}
		$attr = $new_attrs;
		return $attr;
	}
	
	/**
	 * 解析过滤器并重构为二维数组
	 * @param $filter string 过滤器 如：filter/cr=name:0;crs=*:1;crv=41412:2132
	 * @return array	二维数组形式
	 */
	protected function _structure_filter($filter){
		$ws = array();
		if($filter){
			$filter = $this->ce($filter);	//编码检测及转换
			$check = str_replace(array('cr=','crs=','crv='),'', $filter);
			$a = explode(';', $check);
			$a1 = explode(':', $a[0]);
			$a2 = explode(':', $a[1]);
			$a3 = explode(':', $a[2]);
			//完整性验证
			if(count($a1)!=count($a2) || count($a2)!=count($a3)){
				return $ws;
			}
			//结构重组
			foreach($a1 as $key=>$field){
				if(!empty($a3[$key])){
					$val = $a3[$key];
					if(in_array($a2[$key], array('in', 'all')) || in_array(Controller::$conds[$a2[$key]], array('in', 'all'))){
						$val = explode(',', $val);
					}
					
					$ws[$field] = array(
						'cond'=>$a2[$key],
						'val'=>$val,
					);
				}
			}
			unset($a1);unset($a2);unset($a3);
		}
		return $ws;
	}
	
	/**
	 * 对过滤器特殊字符和代号进行转换
	 * @param $filter array	过滤器数组	
	 * @param $attr array	允许查询的字段
	 * @return array		真实查询数组
	 */
	protected function _parse_filter($filter, $attr=array()){
		$ws = array();
		
		//代号替换
		$new_filter = array();
		foreach($filter as $field=>$fo){
			$field = $field==='name'?$field:$attr[$field];
			$fo['cond'] = $fo['cond']==='*'?'==':Controller::$conds[$fo['cond']];
			$new_filter[$field] = $fo;
		}
		$filter = $new_filter;
		unset($new_filter);
		
		return $filter;
	}
	
	/**
	 * 字符编码判定和转换
	 * @param $str string 需要处理的字符串
	 * @return utf-8 字符串
	 */
	public function ce($str=''){
		$encode = mb_detect_encoding($str, array('UTF-8','GB2312','GBK','EUC-CN')); 	//目标编码放在前
		if (!in_array($encode,array("UTF-8","CP936")) && !empty($str)){ 
			$str = iconv('gbk','utf-8',$str);
		}
		return $str;	
	}
	
	/**
	 * 生成页面缓存
	 * @param $text 页面内容，不为空为设置缓存，为空为获取缓存
	 * @return 返回页面内容
	 */
	public function make_page_cache($text=false){
		//启用缓存处理
		if(Yii::app()->params['pageCache']){
			$url = $_SERVER['REQUEST_URI'];		//当前url做键值
			$rs = '';
			//传内容了则设置缓存
			if($text!==false){
				$lock_url = YiiBase::getPathOfAlias('application.runtime').'\\cache.lock';	//缓存锁文件,file_put_contents($lock_url, 'lock');	//每次修改完数据均会使缓存过期
				$this->setC($url, $text, 0, new CFileCacheDependency($lock_url));	//文件依赖，时间上永不过期
				$rs = $text;
			}else{
				$rs = $this->getC($url);
			}
			
			if(empty($rs)){	//内容为空则返回
				return $rs;
			}else{
				//echo (microtime(true)-$_POST['stime']).'秒';
				echo $rs;	//不为空则输出页面内容
				exit();
			}
		//禁用页面缓存时，直接打印内容
		}else{
			echo $text;
		}
	}
	
	/**
	 * 返回上一页
	 * @return null
	 */
	public function redirect_back(){
		$url = array('index');		//控制器首页
		if(isset($_SERVER['HTTP_REFERER'])){
			Yii::app()->user->returnUrl = $_SERVER['HTTP_REFERER'];
			$url = Yii::app()->user->returnUrl;
		}
     	$this->redirect($url);	//返回上一页
	}
	/**
	 * 获取版本号
	 * @return null
	 */
	public function get_bbh(){
		$criteria = new EMongoCriteria(array(
			'select'=>array('updatetime', 'name'),
		));
		$data = Entity::model('entity_'.Yii::app()->params['dbGame'].'_bbh')->find($criteria);
		return $data;
	}
	
	//可查询操作定义，序号不可改变
	public static $conds = array(
		1	=> '==',
		2	=> '>',
		3	=> '>=',
		4	=> '<',
		5	=> '<=',
		6	=> 'in',
		7	=> 'all',
	);
	
	
}
<?php
/**
 * 趋势
 */
class TrendController extends Controller
{
	public $heroimg = array('力量'=>'pip_llyx.png', '敏捷'=>'pip_agi_mjyx.png', '智力'=>'pip_int_zlyx.png');
	public $dateType = array('周'=>1, '月'=>2);
	public $type_arr = array('出场数'=>'count', '胜率'=>'win', '杀人'=>'kills_ave', '助攻'=>'ass_ave', '被杀'=>'deaths_ave', '金钱'=>'goldPM_ave','经验'=>'xpPM_ave');
	// 取后一位的值
	private $type_one = array('kills_ave','ass_ave','deaths_ave','win');
	/**
	 * 趋势页
	 */
	public function actionIndex()
	{
		$hero1 = isset($_POST['hero1']) ? $_POST['hero1'] : '';
		$hero2 = isset($_POST['hero2']) ? $_POST['hero2'] : '';
		$date = isset($_POST['date']) ? $_POST['date'] : '';
		$type = isset($_POST['type']) ? $_POST['type'] : '';
		if($date == '周'){
			$date = 1;
			$tmp = 0;
		}elseif($date == '月'){
			$date = 2;
			$tmp = 30;
		}else{
			$bbh_ob = $this->get_bbh();
			$date = $bbh_ob['updatetime'];
			if(strtotime('-30 days') > strtotime($date)){
				$date = date("Ymd",strtotime('-30 days'));
				$tmp = 30;
			}else{
				$tmp = round((strtotime(date("Ymd",time())) - strtotime($date))/3600/24);
			}
		}

		// 定义数据类型的描述
		if(array_key_exists($type, $this->type_arr)){
			$heroInfo['ordinatesTag'] = $type;
			$type = $this->type_arr[$type];
		}else{
			$heroInfo['ordinatesTag'] = '出场数';
			$type = 'count';
		}
		// 时间轴
		$heroInfo['timeLine'] = $this->getTimeLine($date);
		$trend = new Trend();
		// 获取最大值
		$heroInfo['ordinatesMax'] = $trend->getMaxDate($date, $type);
		// 获取最小值
		$heroInfo['ordinatesMin'] = $trend->getMinDate($date, $type);
		// 判断是否保留小数
		if(in_array($type, $this->type_one)){
			$heroInfo['hasPoint'] = 1;
		}else{
			$heroInfo['hasPoint'] = 0;
		}
		if(!empty($hero1)){
			$hero_id = $trend->getHero_id($hero1);
			if(!empty($hero_id)){
				$heroInfo['hero1']['heroName'] = $hero_id['name'];
				$heroInfo['hero1']['heroHeadImg'] = Yii::app()->params->imgUrl.'/images/hero_circle/hero_shot_'.$hero_id['_id'].'.png';
			}else{
				$heroInfo['hero1']['heroName'] = '';
				$heroInfo['hero1']['heroHeadImg'] = '';
			}
			$heroInfo['hero1']['heroData'] = $trend->getInfo($hero1, $date, $type);
			if($tmp > 0){
				$heroDataLength = count($heroInfo['hero1']['heroData']);
				if($heroDataLength < $tmp){
					for($i=1; $i<=$tmp-$heroDataLength; $i++){
						array_unshift($heroInfo['hero1']['heroData'], 0);
					}
				}
			}
		}
		if(!empty($hero2)){
			$hero_id = $trend->getHero_id($hero2);
			if(!empty($hero_id)){
				$heroInfo['hero2']['heroName'] = $hero_id['name'];
				$heroInfo['hero2']['heroHeadImg'] = Yii::app()->params->imgUrl.'/images/hero_circle/hero_shot_'.$hero_id['_id'].'.png';
			}else{
				$heroInfo['hero2']['heroName'] = '';
				$heroInfo['hero2']['heroHeadImg'] = '';
			}
			$heroInfo['hero2']['heroData'] = $trend->getInfo($hero2, $date, $type);
			if($tmp > 0){
				$heroDataLength = count($heroInfo['hero2']['heroData']);
				if($heroDataLength < $tmp){
					for($i=1; $i<=$tmp-$heroDataLength; $i++){
						array_unshift($heroInfo['hero2']['heroData'], 0);
					}
				}
			}
		}
		echo json_encode($heroInfo);
	}
	/**
	 * 获取英雄头像
	 */
	public function actionGetImg()
	{
		$trend = new Trend();
		$hero_arr = $trend -> getHeroImg();
		krsort($hero_arr);
		ksort($hero_arr['天辉']);
		ksort($hero_arr['夜魇']);
		$lich = $hero_arr['夜魇']['智力'][3];
		$hero_arr['夜魇']['智力'][3] = $hero_arr['夜魇']['智力'][2];
		$hero_arr['夜魇']['智力'][2] = $hero_arr['夜魇']['智力'][1];
		$hero_arr['夜魇']['智力'][1] = $lich;
		$i=1;
		$result = '';
		if(!empty($hero_arr) && is_array($hero_arr)){
			foreach($hero_arr as $hKey=>$hValue){
				$result .= '<div class="pn">';
				if($i==1){
					$result .= '<div class="pn-close" onclick="closeClick();"><img src="'.Yii::app()->params->imgUrl.'/images/close.png" /></div>';
				}
				$result .= '<div class="pn-hd"><h2 class="tit">'.$hKey.'</h2></div> <div class="pn-bd clearfix">'.$this->getHeroValue($hValue).' </div></div>';
				if($i==1){
					$result .= '<div class="line"></div>';
				}
				$i++;
			}
		}
		echo $result;
	}
	function getHeroValue($kValue)
	{
		$result = '';
		$i = 1;
		foreach($kValue as $key=>$value){
			$result .= '<div class="mod-comm1 col'.$i.'"> <div class="hd">
                        <h3 class="tit"><img src="'.Yii::app()->params->imgUrl.'/images/dotaimg/'.$this->heroimg[$key].'" class="pic-t png" alt="'.$key.'"  />'.$key.'</h3>
                    	</div> <div class="bd"> '.$this->getImgList($value).'</div> </div>';
			$i++;
		}
		return $result;
	}
	function getImgList($kValue)
	{
		$result = '';
		foreach($kValue as $key=>$value){
			$result .= '<a href="javascript:void(0);" class="link-hero" title="'.$value['name'].'" onclick="setHero2('.$value['numId'].');"><img src="'.Yii::app()->params->imgUrl.'/images/data/hero_shot_'.$value['_id'].'.jpg" class="pic-hero" alt=""/></a>';
		}
		return $result;
	}
	/**
	 * 处理时间轴
	 * 日期: 1:周， 2：月, 版本
	 */
	public function getTimeLine($dateType)
	{
		switch ($dateType)
		{
			case 1:
				$timeLine = $this->setTimeLine(7);
				break;
			case 2:
				$timeLine = $this->setTimeLine(30);
				break;
			default:
				$time = round((strtotime(date("Ymd",time())) - strtotime($dateType))/3600/24);
				$timeLine = $this->setTimeLine($time);
				break;
		}
		return $timeLine;
	}
	/**
	 * 设置时间轴
	 * Enter description here ...
	 * @param unknown_type $d
	 */
	public function setTimeLine($d)
	{
		for($i=0; $i<$d; $i++)
		{
			$days = "-".($d-$i)." days";
			$timeLine[] = date("m.d",strtotime($days));
		}
		return $timeLine;
	}
}
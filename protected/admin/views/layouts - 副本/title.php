<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta name="keywords" content="<?php echo $this->getPageState('keywords'); ?>" />
	<meta name="description" content="<?php echo $this->getPageState('description'); ?>" />
	
	<!--globalHeadBegin-->
	<link type="image/x-icon" rel="icon" href="http://ue2.17173.itc.cn/images/lib/v1/favicon-hd.ico">
	<link type="image/x-icon" rel="shortcut icon" href="http://ue3.17173.itc.cn/images/lib/v1/favicon.ico">
	
	<!--#include virtual="/inc-site/head-begin.shtml" wait="yes"-->
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/reset-and-utils-1.0.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/article-zhuanqu-v1.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" >
	
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tabs.all.min.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/dota2-script.js"></script>
	<!--#include virtual="/inc-site/head-end.shtml" wait="yes"-->
	<!--[if IE 6]>
		<script type="text/javascript" src="http://ue1.17173.itc.cn/lib-v1/ddpng-0.0.8a.min.js"></script>
	    <script type="text/javascript">
	    	DD_belatedPNG.fix('.side-left-in');
	        DD_belatedPNG.fix('.side-right-top');
	        DD_belatedPNG.fix('.btn');
	        DD_belatedPNG.fix('.box-footer');
	        DD_belatedPNG.fix('.tit-main .txt .cate');
	    </script>
	<![endif]-->
	
	<link type="text/css" id="css-gtp" href="<?php echo Yii::app()->request->baseUrl; ?>/css/global-topbar.css" rel="stylesheet">
	<!-- tips -->
	<script type="text/javascript">
		var host = '<?php echo Yii::app()->request->baseUrl?>';
		var imgUrl = '<?php echo Yii::app()->params->imgUrl?>';
		
	</script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tips.js"></script>
</head>

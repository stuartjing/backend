<?php
/**
 * 过滤器扩展
 * @author user
 */
class Twig_Extension_My extends Twig_Extension{
	public function getName(){
        return 'my';
    }
    
    //过滤器配置
	public function getFilters(){
        return array(
            'n2br' => new Twig_Filter_Method($this, 'n2brFilter'),
        );
    }
    
    /**
     * 将换行符转为<br/>标签
     * @param $string
     * @return unknown_type
     */
	public function n2brFilter($string){
        return preg_replace("/(\\r\\n|\\n)/i", '<br/>', $string);
    }
    
}
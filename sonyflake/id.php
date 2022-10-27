<?php 
namespace thefunpower\sonyflake;
/**
* 生成唯一ID
* 
*/
class id{ 
	public static $config;
	public static $snowflake_obj;
	/**
	* 使用Sonyflake生成唯一值，确保并发时生成唯一ID,最长可用174年
	* $id = \thefunpower\sonyflake\id::create();
	* 如果需要不同的sequence，可传值\thefunpower\sonyflake\id::create($center_id=0,$work_id=1); 
	* https://github.com/godruoyi/php-snowflake
	*/
	public static function create($center_id=0,$work_id=0){
	    $config = self::$config;
	    $snowflake_obj = self::$snowflake_obj;
	    $key = $center_id.$work_id;
	    if(!isset($snowflake_obj[$key])){
	        $redis_config = $config['redis'];
	        $sony_flake  = $config['sony_flake'];
	        $start_date  = $sony_flake['from_date']?:"2022-10-27"; 
	        $redis = new \Redis(); 
	        $redis->connect($redis_config['host'], $redis_config['port']); 
	        if($redis_config['auth']){
	            $redis->auth($redis_config['auth']);    
	        }       
	        $snowflake = new \Godruoyi\Snowflake\Sonyflake($center_id, $work_id);
	        $snowflake->setStartTimeStamp(strtotime(date($start_date))*1000)
	                ->setSequenceResolver(new \Godruoyi\Snowflake\RedisSequenceResolver($redis));
	        $snowflake_obj[$key] = $snowflake;
	    } 
	    $id = $snowflake_obj[$key]->id(); 
	    return $id;
	}   
	/**
	* 设置配置
	* $config['redis'] = [
	*   'host'=>'',
	*   'port'=>'',
	*   'auth'=>'', 
	* ];
	* 
	* $config['sony_flake'] = [ 
	*   'from_date'=>'2022-10-27',
	* ];
	*/
	public static function set($config){
		self::$config = $config;
	}

}
<?php 

include __DIR__.'/vendor/autoload.php';


//redis配置
$config['redis'] = [
	'host'=>'127.0.0.1',
	'port'=>'6379',
	'auth'=>'', 
];
//sony_flake 生成订单号
$config['sony_flake'] = [  
	'from_date'=>'2022-10-27',
];

thefunpower\sonyflake\id::set($config);

$id = thefunpower\sonyflake\id::create(0,1);
echo $id;
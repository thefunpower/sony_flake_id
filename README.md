# sony_flake_id
生成sony_flake


配置
~~~
$config['redis'] = [
  'host'=>'',
  'port'=>'',
  'auth'=>'', 
];

$config['sony_flake'] = [ 
  'from_date'=>'2022-10-27',
];
thefunpower\sonyflake\id::set($config);
~~~


生成

~~~
thefunpower\sonyflake\id::create($center_id=0,$work_id=1)
~~~


## License

[Apache License 2.0](LICENSE)
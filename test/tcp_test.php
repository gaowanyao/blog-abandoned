<?php

use Workerman\Worker;
require_once __DIR__."/../Workerman/Autoloader.php";

//创建一个Worker监听2347端口，不使用任何应用层协议
$tcp_worker = new Worker("http://0.0.0.0:2347");

//启动4个进程对外提供服务
$tcp_worker->count = 4;


//当客户端发来数据时
$tcp_worker->onMessage = function ($connection,$data){
  $connection->send("hellod".json_encode($data));
};

Worker::runAll();


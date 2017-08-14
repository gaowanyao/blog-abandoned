<?php

use Workerman\Worker;
require_once __DIR__."/../Workerman/Autoloader.php";
require_once __DIR__."/../Workerman/vendor/autoload.php";
use Workerman\Lib\Timer;

$worker = new Worker('http://0.0.0.0:2346');
$worker->onWorkerStart = function($worker)
{
    // 将db实例存储在全局变量中(也可以存储在某类的静态成员中)
    global $db;
    $db = new Workerman\MySQL\Connection('127.0.0.1', '3306', 'root', 'gcan007', 'gcan');

    // 定时，每10秒一次
    Timer::add(5, function()use($worker)
    {
        // 遍历当前进程所有的客户端连接，发送当前服务器的时间
        foreach($worker->connections as $connection)
        {
//            $connection->send(time());
            var_dump($connection->id);
        }
    });


};
$worker->onMessage = function($connection, $data)
{
    // 通过全局变量获得db实例
    global $db;
    // 执行SQL
    $all_tables = $db->query('show tables');
//    $connection->send(json_encode($all_tables));

    // 获取所有数据
    $res = $db->select('ID,user_name,password')->from('think_user')->query();
//等价于
//    $db->select('ID,user_name,password')->from('think_user')->where("sex= 'F' ")->query();
//等价于
//    $db->query("SELECT ID,Sex FROM `Persons` WHERE sex='M'");

    $connection->send(json_encode($all_tables).json_encode($res));


};



// 运行worker
Worker::runAll();




?>
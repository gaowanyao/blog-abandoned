<?php
namespace app\push\controller;
use think\Controller;
use think\Db;
use think\worker\Server;
use Workerman\Worker;
use PHPSocketIO\SocketIO;

require_once __DIR__ . '/../../../vendor/autoload.php';
    // listen port 2021 for socket.io client
        $io = new SocketIO(2346);

        $io->on('connection', function($socket)use($io){
            $m = Db::name("Article");

            $article = $m->select();
            dump("dd33");

            $socket->emit('con', $article);


            $socket->on('chat message', function($msg)use($socket){


                $socket->emit('chat message', $msg);

//            $io->emit('haha2', "ll");
            });

        });



    Worker::runAll();



<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
use think\Session;

class Coin extends Controller
{



    public function firstcny(){

        ignore_user_abort();//关闭浏览器仍然执行
        set_time_limit(0);//让程序一直执行下去
        $interval=1;//每隔一定时间运行
        do{

            $url = "https://yunbi.com//api/v2/tickers/1stcny.json";
            $result = $this->http_curl($url,"get","");

            $result = json_decode($result,true);

            $data['buy'] = $result['ticker']['buy'];
            $data['sell'] = $result['ticker']['sell'];
            $data['low'] = $result['ticker']['low'];
            $data['high'] = $result['ticker']['high'];
            $data['last'] = $result['ticker']['last'];
            $data['vol'] = $result['ticker']['vol'];


            $path = ROOT_PATH."public/coinlog/firstcny.log";

            $json = json_encode($data); //数组变为json字符串
            $get = json_decode(file_get_contents($path),true); //取出的是字符串 转为数组

            if($data == $get){  //相同

            }else{//不同就存入数据库并放入log
                file_put_contents($path,$json);//存入的也是字符串

                $map = $data;


                $map['timestamp'] = $result['at'];
                Db::name("firstcny")->insert($map);
            }


            sleep($interval);//等待时间，进行下一次操作。
        }while(true);

    }


    public function sntcny(){

        ignore_user_abort();//关闭浏览器仍然执行
        set_time_limit(0);//让程序一直执行下去
        $interval=1;//每隔一定时间运行
        do{

            $url = "https://yunbi.com//api/v2/tickers/sntcny.json";
            $result = $this->http_curl($url,"get","");

            $result = json_decode($result,true);

            $data['buy'] = $result['ticker']['buy'];
            $data['sell'] = $result['ticker']['sell'];
            $data['low'] = $result['ticker']['low'];
            $data['high'] = $result['ticker']['high'];
            $data['last'] = $result['ticker']['last'];
            $data['vol'] = $result['ticker']['vol'];


            $path = ROOT_PATH."public/coinlog/sntcny.log";

            $json = json_encode($data); //数组变为json字符串
            $get = json_decode(file_get_contents($path),true); //取出的是字符串 转为数组

            if($data == $get){  //相同

            }else{//不同就存入数据库并放入log
                file_put_contents($path,$json);//存入的也是字符串

                $map = $data;


                $map['timestamp'] = $result['at'];
                Db::name("sntcny")->insert($map);
            }


            sleep($interval);//等待时间，进行下一次操作。
        }while(true);


    }

    public function test(){
        $url = "https://yunbi.com//api/v2/tickers/1stcny.json";
        $result = $this->http_curl($url,"get","");

        $result = json_decode($result,true);

        $data['buy'] = $result['ticker']['buy'];
        $data['sell'] = $result['ticker']['sell'];
        $data['low'] = $result['ticker']['low'];
        $data['high'] = $result['ticker']['high'];
        $data['last'] = $result['ticker']['last'];
        $data['vol'] = $result['ticker']['vol'];


        $path = ROOT_PATH."public/coinlog/firstcny.log";

        $json = json_encode($data); //数组变为json字符串
        $get = json_decode(file_get_contents($path),true); //取出的是字符串 转为数组

        dump($json);
        dump($data);
        dump($get);


    }


    public function firstcny2(){

        ignore_user_abort();//关闭浏览器仍然执行
        set_time_limit(0);//让程序一直执行下去
        $interval=1;//每隔一定时间运行
        do{

            $url = "https://yunbi.com//api/v2/tickers/1stcny.json";
            $result = $this->http_curl($url,"get","");

            $result = json_decode($result,true);

            $data['timestamp'] = $result['at'];
            $data['buy'] = $result['ticker']['buy'];
            $data['sell'] = $result['ticker']['sell'];
            $data['low'] = $result['ticker']['low'];
            $data['high'] = $result['ticker']['high'];
            $data['last'] = $result['ticker']['last'];
            $data['vol'] = $result['ticker']['vol'];


            if(isset($_SESSION['first_ticker'])){


                if($_SESSION['first_ticker']['buy'] == $data['buy'] && $_SESSION['first_ticker']['sell'] == $data['sell'] && $_SESSION['first_ticker']['low'] == $data['low'] && $_SESSION['first_ticker']['high'] == $data['high'] && $_SESSION['first_ticker']['last'] == $data['last'] && $_SESSION['first_ticker']['vol'] == $data['vol']){

                }else{
                    Db::name("firstcny")->insert($data);
                    $_SESSION['first_ticker'] = $result['ticker'];

                }

            }else{


                $_SESSION['first_ticker'] = $result['ticker'];
            }

            sleep($interval);//等待时间，进行下一次操作。
        }while(true);

    }




    /**
     * @param $url
     * @param $type
     * @param $jsonpost
     * @return mixed|json
     */
    function http_curl($url, $type, $jsonpost)
    {



//        $this->log_time("http_start");

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT,10);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);

        //如果使用代理需加上属性
//        if(C('IF_PROXY')==true){
//            $str= $url;
//
//            $needle= '127.0.0.1';
//
//            $pos = strpos($str, $needle);
//
//            if($pos==false){
//
//                curl_setopt ($ch, CURLOPT_PROXY, C('PROXY'));
//
//                curl_setopt ($ch, CURLOPT_USERAGENT, C('USERAGENT'));
//
//            }
//        }
        if ($type == "post") {
            //传输数据
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonpost);
        }
        $json = curl_exec($ch);
        if (curl_errno($ch)) {
            $json = curl_error($ch);
            $json = json_encode($json, JSON_UNESCAPED_UNICODE);
//            echo $json;
        }
        curl_close($ch);
//        if (C('IF_PROXY') == true) {
//
//            $header = preg_replace('/{.*/i', "", $json);
//
//            if($header!=""){
//
//                $json = explode($header, $json);
//
//                $json = $json[1];
//
//            }
//
//        }
//        $this->log_time("http_end");

        return $json;
    }


}
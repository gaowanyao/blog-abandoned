<?php
namespace app\index\controller;

use think\Config;
use think\Db;
use think\Controller;
use think\Session;

class Index extends Controller
{

    /**
     * tp5邮件
     * @param
     * @author staitc7 <static7@qq.com>
     * @return mixed
     */
    public function send() {
        $toemail='1528667112@qq.com';
        $name='';
        $subject='tp5邮箱发送测试';
        $content='恭喜您，邮件测试成功。';
        dump(send_mail($toemail,$name,$subject,$content));
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

    public function firstcny_trade_msg(){

        $res = Db::name("firstcny")->select();

//        $res = json_encode($res);

//        dump($res);
//
        return $res;



    }

    public function firstcny(){



        return $this->fetch();

    }


    public function firstcny_msg(){

        $url = "https://yunbi.com//api/v2/tickers/1stcny.json";
        $result = $this->http_curl($url,"get","");

        $result = json_decode($result,true);

        $ticker = $result['ticker'];
//        ["buy"] => string(3) "7.0"
//        ["sell"] => string(4) "7.02"
//        ["low"] => string(5) "6.555"
//        ["high"] => string(4) "7.26"
//        ["last"] => string(4) "7.02"
//        ["vol"] => string(11) "9784513.985"

        $buy = $ticker['buy'];
        $sell = $ticker['sell'];
        $low = $ticker['low'];
        $high = $ticker['high'];
        $last = $ticker['last'];
        $vol = $ticker['vol'];
        $time = date("Y-m-d H:i:s",$result['at']);

        $toemail = "1528667112@qq.com";
        $name = "高万耀";
        $subject='第一滴血当前买入价'.$buy;


        $content = "当前买入价：".$buy."<br>".
            "当前卖出价：".$sell."<br>".
            "过去24小时之内的最低价：".$low."<br>".
            "过去24小时之内的最高价：".$high."<br>".
            "最后成交价：".$last."<br>".
            "过去24小时之内的总成交量：".$vol."<br>".
            "时间：".$time."<br>";


        if(send_mail($toemail,$name,$subject,$content) == true){
            return "发送成功";
//                $this->success("Reg to your email address ".$toemail.", please activate!","signin",5);
        }else{
            return "发送失败";

//                $this->error("Sign Up Error,Please Sign Up Again!");
        }


//        if(Session::has("num")){
//            dump("has");
//            dump("has");
//            Session::set("num",1);
//
//        }else{
//            Session::set("num",1);
//
//            dump("not");
//        }
//        $num = Session::get("num");
//
//        if($num == 7.3  && $buy < 7.3){
//            Session::set("num",1);
//        }
//
//        if($num == 7.2  && $buy < 7.2){
//            Session::set("num",1);
//        }
//
//        if($num == 7.1  && $buy < 7.1){
//            Session::set("num",1);
//        }
//
//        if($num == 6.95  && $buy < 6.95){
//            Session::set("num",1);
//        }
//
//        if($num == 6.8  && $buy < 6.8){
//            Session::set("num",1);
//        }
//
//
//
//        if($num == 6.65  && $buy < 6.65){
//            Session::set("num",1);
//        }
//
//
//        if($num == 6.5  && $buy < 6.5){
//            Session::set("num",1);
//        }
//
//
//        dump($num);
////++++++++++++++++++++++++++++++++++++++++++++++++++++
//        if($buy >= 7.3 && $num == 1){
//            Session::set("num",7.3);
//        }
//
//        if($buy >= 7.2 && $buy < 7.3  && $num == 1){
//            Session::set("num",7.2);
//        }
//
//
//        if($buy >= 7.1 && $buy < 7.2 && $num == 1){
//            Session::set("num",7.1);
//        }
//
//        if($buy >= 6.95 && $buy < 7.1 && $num == 1){
//            Session::set("num",6.95);
//        }
//
//
//        if($buy >= 6.8 && $buy < 6.95 && $num == 1){
//            Session::set("num",6.8);
//        }
//
//        if($buy >= 6.65 && $buy < 6.8 && $num == 1){
//            Session::set("num",6.65);
//        }
//
//        if($buy >= 6.5 && $buy < 6.65 && $num == 1){
//            Session::set("num",6.5);
//        }
//
//
//        $num = Session::get("num");
//
//        dump($num);
//
//
//        dump($result);


    }


    public function picture(){
        return $this->fetch();

    }



//    查询页
    public function search(){
        if(!empty($_GET['search'] && isset($_GET['search']))) {

            $this->message();
            $this->recent_article();//近期文章

            $this->tag_field();

            $search = $_GET['search'];

            $map['title'] = array("like", "%$search%");
            $map['author'] = array("like", "%$search%");
            $map['tag'] = array("like", "%$search%");
            $map['create_time'] = array("like", "%$search%");
            $map['released'] = array("like", 1);
            $res = Db::name("Article")->where('title|author|tag|create_time','like',"%$search%")->where("released",1)->order("create_time desc")->paginate(5);
//            dump($res);
            $this->assign("article_list", $res);
            $this->assign("search", $search);

            return $this->fetch();
        }
    }


//    标签页
    public function tag(){

        if(!empty($_GET['tag'] && isset($_GET['tag']))){



            $this->message();
            $this->recent_article();//近期文章

            $this->tag_field();

            $tag = $_GET['tag'];

            $map['tag'] = array("like","%$tag%");
            $map['released'] = array("like",1);
            $res = Db::name("Article")->where($map)->order("create_time desc")->paginate(5);
            $this->assign("article_list",$res);
            $this->assign("tag",$tag);

            return $this->fetch();
        }


    }



    public function message(){

        if(Session::has("account") != true){ //用户不存在

            $this->assign("switch","off");//用户不存在
            $this->assign("account",null);


        }else{//用户存在
            $this->assign("switch","on");//用户存在


            $this->assign("account",Session::get("account"));

        }

        $this->assign("access","/blog/public/index/index/");


    }

//    退出
    public function logout(){

        $res = Session::clear();

        if(Session::has("account") == false){
            $this->success("Exit successfully. Please login next time!","signin");
        }else{
            $this->success("Exit anomaly!");
        }
    }

//    博客右侧数据 近期文章
    public function recent_article(){

        $res = Db::name("Article")->where("released",1)->order("create_time desc")->limit(4)->select();
        $this->assign("recent_article_list",$res);

    }

//    博客主页列表
    public function index(){

        $this->message();
        $this->recent_article();//近期文章

        $this->tag_field();//标签

        $res = Db::name("Article")->where("released",1)->order("create_time desc")->paginate(5);
        $this->assign("article_list",$res);
        return $this->fetch();
//        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }

    public function signin(){

        return $this->fetch();
    }

    public function signup(){

        return $this->fetch();
    }


    public function signin_msg(){



        $data = $_POST;
        $data['user_name'] = $_POST['username'];
        $data['password'] = md5($_POST['password']);
        unset($data['username']);
        unset($data['remember']);
        $sel = Db::name("User")->field("uid,active,user_name,user_name,fullname,email,address,country,admin,headpicture")->where("user_name|email","like",$data['user_name'])->where("password",$data['password'])->find();
        if($sel){
//            $data['create_time'] = date("Y-m-d H:i:s");
//            $data['uid'] = $sel['uid'];
//            $res = Db::name("User")->update($data);

            if($sel['active'] == 0){
                $this->error("Sign In Error，Your email ".$sel['email']." has not been activated!");
            }else{
                Session::set("account",$sel);
                $this->success("Sign In Success","index");
            }


        }else{
            $this->error("Sign In Error，Please check your username and password!");
        }
    }

    public function mail(){


        $email = urlsafe_b64decode(urlsafe_b64decode($_GET['cc']));

        $sel = Db::name("User")->field("uid,active,user_name,user_name,fullname,email,address,country,admin,headpicture")->where("email",$email)->find();

        if($sel){

            $data['uid']= $sel['uid'];
            $data['active'] = 1;
            $res = Db::name("User")->update($data);
            if($res){
                Session::set("account",$sel);
                $this->success("Email activation Success!","index");
            }else{
                if($sel['active'] == 1){
                    $this->error("Email has been activated!","index");
                }else{
                    $this->error("Email activation error!","index");
                }
            }

        }else{

            $this->error("The illegal log in!","index");

        }




    }

    public function signup_msg(){
        $data = $_POST;
        $data['email'] = $_POST['email'];
        $data['user_name'] = $_POST['username'];
        $data['create_time'] = date("Y-m-d H:i:s");
        unset($data['username']);
        unset($data['rpassword']);
        $data['password'] = md5($_POST['password']);
        $sel = Db::name("User")->where("user_name",$data['user_name'])->find();
        if(!$sel){

            $sel2 = Db::name("User")->where("email",$data['email'])->find();

            if($sel2){
                $this->error("This email already exists!");
            }else{
                $res = Db::name("User")->insert($data);
                if($res){

                    $toemail = $_POST['email'];
                    $name = $data['user_name'];
                    $subject='GCAN激活邮件';
                    $a = Config::get('domain')."/blog/public/index/index/mail?cc=".urlsafe_b64encode(urlsafe_b64encode($toemail))."&vv=".urlsafe_b64encode(time())."&ccvv=".sha1($subject);
                    $content='您好，'.$name."!<br/>欢迎加入GCAN，请点击下面的链接来激活您的邮件。
                        <br/><a href='".$a."'>".$a."</a><br/>如果您的邮箱不支持链接点击，请将以上链接地址拷贝到您的浏览器地址栏中进行激活！<br/>";


                    if(send_mail($toemail,$name,$subject,$content) == true){
                        $this->success("Registered successfully, the activation email has been sent to your email address ".$toemail.", please activate!","signin",5);
                    }else{
                        $this->error("Sign Up Error,Please Sign Up Again!");
                    }

                }else{
                    $this->error("Sign Up Error,Please Sign Up Again!");
                }
            }




        }else{
            $this->error("This user already exists!");
        }
    }


    //单篇文章
    public function single_page(){



//        echo Config::get('domain');
        $this->message();

        $this->recent_article();

        $this->tag_field();


        if(!empty($_GET['cc'])){

            if($this->is_pc() == true){
                $this->assign("pc","pc");
            }else{
                $this->assign("pc","notpc");
            }


            $id = $_GET['cc'];
            $res = Db::name("Article")->where("id",$id)->find();
            $this->assign("article",$res);
            return $this->fetch();
        }


    }

    function is_weixin(){
        if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
//            dump("weixin");
            return true;
        }
//        dump("not weixin");

        return false;
    }

    function is_pc(){
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $is_pc = (strpos($agent, 'windows nt')) ? true : false;
        return $is_pc;
    }

    public function tag_field(){
        $m = Db::name("Article");
        $res = $m->field("tag")->select();

        $str = "";
        $count = count($res);
        for($i=0;$i<$count;$i++){
            if($i != $count-1){
                $str .= $res[$i]['tag'].",";

            }else{
                $str .= $res[$i]['tag'];

            }
        }

        $res = explode(",",$str);
        $res = array_unique($res);
        $res = array_merge($res);

        $this->assign("tag_list",$res);
    }



}

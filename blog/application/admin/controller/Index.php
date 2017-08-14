<?php
namespace app\admin\controller;
use think\File;
use think\Db;
use think\Session;

use think\Controller;

class Index extends Controller
{



    public function message(){

        if(Session::has("account") != true){
            $this->error("Please Sign In","signin");
            $this->assign("account",null);

        }else{

//            dump(Session::get("account"));

            if(Session::get("account.admin") == 9999){
                $this->assign("account",Session::get("account"));
            }else{
                $this->error("You do not have access to the System!");
            }


        }

    }


//文章图片
    public function article_picture(){
        $this->message();

        $res = Db::name("Article")->field("id,title,article_picture")->order("create_time desc")->select();

        $this->assign("article_picture",$res);


        return $this->fetch();
    }

    public function article_picture_path(){
        $this->message();

        if(!empty($_GET['id']) && isset($_GET['id'])){
            $id = $_GET['id'];
            $res = Db::name("Article")->where("id",$id)->find();

            $this->assign("article",$res);


            return $this->fetch();
        }
    }

    public function signin(){
        return $this->fetch();
    }

    public function logout(){

        $res = Session::clear();

        if(Session::has("account") == false){
            $this->success("Exit successfully. Please login next time!","signin");
        }else{
            $this->success("Exit anomaly!");
        }
    }

    public function signin_msg(){
        $data = $_POST;
        $data['user_name'] = $_POST['username'];
        $data['password'] = md5($_POST['password']);
        unset($data['username']);
        unset($data['remember']);
        $sel = Db::name("User")->field("uid,user_name,user_name,fullname,email,address,country,admin")->where($data)->find();
        if($sel){
//            $data['create_time'] = date("Y-m-d H:i:s");
//            $data['uid'] = $sel['uid'];
//            $res = Db::name("User")->update($data);

            if($sel['admin'] == 0){
                $this->error("You do not have access to the System!");
            }

            if($sel['admin'] == 9999){
                Session::set("account",$sel);
                $this->success("Sign In Success","article");
            }else{
                $this->error("You do not have access to the System!");
            }


        }else{
            $this->error("Sign In Error，Please check your username and password!");
        }
    }

    public function signup_msg(){
        $data = $_POST;
        $data['user_name'] = $_POST['username'];
        $data['create_time'] = date("Y-m-d H:i:s");
        unset($data['username']);
        unset($data['rpassword']);
        $data['password'] = md5($_POST['password']);
        $sel = Db::name("User")->where("user_name",$data['user_name'])->find();
        if(!$sel){
            $res = Db::name("User")->insert($data);
            if($res){
                $this->success("Sign Up Successful,Please Sign In!","signin");
            }else{
                $this->error("Sign Up Error,Please Sign Up Again!");
            }
        }else{
            $this->error("This user already exists!");
        }
    }


    public function signup(){
        return $this->fetch();
    }

    public function index(){


//        dump(phpversion());


        $this->message();

        $res = Db::name("Article")->order("create_time desc")->select();
        $this->assign("article_list",$res);
        return $this->fetch();
    }

    public function article(){

        $this->message();

        $res = Db::name("Article")->order("create_time desc")->select();
        $this->assign("article_list",$res);
        return $this->fetch();
    }

    public function content($time,$content){

        $myfile = fopen(ROOT_PATH."public/static/article/".$time.".html","w") or die("Unable to open file!");
        $result = fwrite($myfile, $content);  //返回的是字数
        fclose($myfile);
    }

    public function haha(){

       $this->content("123","");

    }
    public function release_article(){
        if(!empty($_GET['id']) && isset($_GET['released'])){
            $released = $_GET['released'];
            if($released == 0){
                $released = 1;
                $data['id'] = $_GET['id'];
                $data['released'] = $released;

                $res = Db::name('Article')->update($data);
                if($res){

                    $this->success("文章发布成功","index");
                }else{
                    $this->error("文章发布失败");
                }
            }else if($released == 1){
                $released = 0;
                $data['id'] = $_GET['id'];
                $data['released'] = $released;

                $res = Db::name('Article')->update($data);
                if($res){

                    $this->success("禁用文章成功，当前文章为草稿，如有需要，请发布","index");
                }else{
                    $this->error("禁用文章失败");
                }
            }else{

            }



        }


    }
    public function test(){

        return $this->fetch();
    }
    public function add_article(){
        $this->message();

        return $this->fetch();
    }



    public function delete_article(){
        $this->message();

        if(!empty($_GET['id']) && isset($_GET['time'])){
            $id= $_GET['id'];


            $time = $_GET['time'];
            $result = unlink(ROOT_PATH."public/static/article/".$time.".html");


            if($result == true){
                $res = Db::name("Article")->where("id",$id)->delete();

                if($res){
                    $this->success("文章删除成功");
                }else{
                    $this->error("文章删除失败");

                }
            }



        }

    }
    public function update_article(){

        $this->message();

        if(!empty($_GET['id'])){
           $id= $_GET['id'];
           $res = Db::name("Article")->where("id",$id)->find();

           $time = $res['content'];

           $content = file_get_contents(ROOT_PATH."public/static/article/".$time.".html");


           if($res){
               $this->assign("article",$res);
               $this->assign("content",$content);
               return $this->fetch();
           }else{

           }

        }


    }

    public function add_article_msg()
    {
        $this->message();

        $data = $_POST;
        $time = time();
        $data['create_time'] = date("Y-m-d H:i:s",$time);
        $data['content'] = $time;

        $data['tag'] = explode(",",$data['tag']);
        $data['tag'] =array_unique($data['tag']);
        $data['tag'] = implode(",",$data['tag']);



//        dump(ROOT_PATH . 'public' . DS . 'uploads');
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('article_picture');
        if($file != NULL){

// 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->validate(['size'=>1356780,'ext'=>'jpg,png,gif,jpeg'])->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'uploads'. DS . 'article/');
            if($info){
// 成功上传后 获取上传信息
                $data['article_picture'] = "/blog/public/static/uploads/article/".$info->getSaveName();
            }else{
// 上传失败获取错误信息
//                echo $file->getError();
                $this->error($file->getError());
            }
        }
//        dump($data);

        $this->content($time,$_POST['content']);

        $res = Db::name('Article')->insert($data);
        if($res){
            $this->success("新增文章成功","index");
        }else{
            $this->error("新增文章失败");
        }
    }

    public function update_article_picture_msg(){
        $this->message();

        $data = $_POST;
        $data['create_time'] = date("Y-m-d H:i:s",time());
        $res = Db::name('Article')->update($data);
        if($res){
            $this->success("文章图片路径修改成功","article_picture");
        }else{
            $this->error("章图片路径修改失败");
        }


    }
    public function update_article_msg()
    {
        $this->message();

        $data = $_POST;

        unset($data["time"]);
        $time = $_POST['time'];
        $data['create_time'] = date("Y-m-d H:i:s",time());
        $data['content'] = $time;

        $data['tag'] = explode(",",$data['tag']);
        $data['tag'] =array_unique($data['tag']);
        $data['tag'] = implode(",",$data['tag']);

//        dump(ROOT_PATH . 'public' . DS . 'uploads');
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('article_picture');
        if($file != NULL){

// 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->validate(['size'=>1356780,'ext'=>'jpg,png,gif,jpeg'])->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'uploads'. DS . 'article/');
            if($info){
// 成功上传后 获取上传信息
                $data['article_picture'] = "/blog/public/static/uploads/article/".$info->getSaveName();
            }else{
// 上传失败获取错误信息
//                echo $file->getError();
                $this->error($file->getError());
            }
        }

        $this->content($time,$_POST['content']);

//        dump($data);
        $res = Db::name('Article')->update($data);
        if($res){
            $this->success("修改文章成功","index");
        }else{
            $this->error("修改文章失败");
        }
    }



}

<?php
namespace App\Http\Controllers;


class BaodanController extends Controller{
    private $method = [];
    private $doc = "[toc]\n\n## 接口文档\n\n> * 服务器 ： http://192.168.0.155 \n> * 端口 ： 80 \n\n";

    private $comm = ["name","method","uri","param","response"];

    public function __construct(){}

    //获取所有需要解释成文档的控制器
    private function files(){
        $apis = config("doc.baodan");
        return $apis;
    }

    //获取控制器内所有方法和注释
    private function methods(){
        $handlers = $this->files();
        //$method = [];
        foreach($handlers as $val){
            $class = new \ReflectionClass($val);

            $methods = $class->getMethods(\ReflectionProperty::IS_PUBLIC);

            $method = [];
            foreach($methods as $m){
                if($m->class == $val && $m->name != "__construct"){
                    $comment = $m->getDocComment();
                    $classComment = $class->getDocComment();
                    $method["class"] = $m->class;
                    $method["comment"] = $classComment;
                    $method[] = [
                        "name"=>$m->name,
                        "comment"=>$comment
                    ];
                }
            }
            $this->method[] = $method;
            //print_r($method);
        }
        return $this->method;
    }

    //匹配name并获取name信息
    private function matchComment($str, $match = ["name"]){
        $match_arr = [];
        foreach($match as $m){
            if(preg_match_all('/@'.$m.'{1} (.*)/', $str, $matchstr)){
                $match_arr[$m] = str_replace(array("\r\n", "\r", "\n"), '', $matchstr[1]);
            }
        }

        return $match_arr;
    }

    private function createFile($str,$filename){
        $docDir = storage_path()."/doc/";
        if(!file_exists($docDir) || !is_dir($docDir)){
            mkdir($docDir, 0777, true);
        }

        file_put_contents($docDir.$filename, $str);
    }

    private function matchParam($params) {

        foreach ($params as $k => $param) {
            $arr = explode(' ',$param);
            if (isset($arr[0])) {
                $parr[$k]['name'] = $arr[0];
            } else {
                $parr[$k]['name'] = '';
            }

            if (isset($arr[1])) {
                $parr[$k]['type'] = $arr[1];
            } else {
                $parr[$k]['type'] = '';
            }

            if (isset($arr[2])) {
                $parr[$k]['note'] = $arr[2];
            } else {
                $parr[$k]['note'] = '';
            }

        }

        return $parr;

    }

    //获取注释信息
    private function comment(){
        $methods = $this->methods();
        $comment_doc = [];
        foreach($methods as $m){
            $doc = [];
            if(!empty($m["comment"])){
                $m_comment = $this->matchComment($m["comment"]);
            }
            if(isset($m_comment["name"])){
                $doc["class_name"] = $m_comment["name"];
            }

            $comment = [];
            foreach($m as $method){
                if(is_array($method)){
                    $comment = $this->matchComment($method["comment"],$this->comm);
                }

                if (!empty($comment["param"])) {
                    $comment["param"] = $this->matchParam($comment["param"]);
                }

                if (!empty($comment["response"])) {
                    $comment["response"] = $this->matchParam($comment["response"]);
                }

                if(!empty($comment)){
                    $doc[] = ["comment" => $comment];
                }

            }
            if(!empty($doc)){
                $comment_doc[] = $doc;
            }
        }

        return $comment_doc;
    }

    //解析comment成json
    public function json(){
        $comment = $this->comment();
        $json = json_encode($comment);
        $this->createFile($json,"doc.json");
        //return $json;
    }

    //解析成markdown
    public function md(){
        $comment = $this->comment();
        foreach($comment as $com){

            $doc = "\n";
            foreach($com as $cm){
                if(isset($cm["comment"])){
                    foreach($cm as $mdoc) {
                        //name
                        if (empty($mdoc["name"])) {
                            return "需解析的注释必须包含 name";
                            exit;
                        } else {
                            foreach ($mdoc["name"] as $name) {
                                $doc .= "### " . $name . "\n\n";
                            }
                        }

                        //uri
                        if (empty($mdoc["uri"])) {
                            return "需解析的注释必须包含 uri";
                            exit;
                        } else {
                            foreach ($mdoc["uri"] as $uri) {
                                $doc .= "* **Uri :** " . $uri . "\n";
                            }
                        }

                        //method
                        if (empty($mdoc["method"])) {
                            return "需解析的注释必须包含 method";
                            exit;
                        } else {
                            foreach ($mdoc["method"] as $method) {
                                $doc .= "* **Method :** " . strtoupper($method) . "\n";
                            }
                        }

                        //param
                        if (!empty($mdoc["param"])) {
                            $p = "";
                            foreach ($mdoc["param"] as $param) {
                                $p .= "> * " . $param . "\n";

                            }
                            $doc .= "* **Param :** \n" . $p . "\n";
                        }

                        //response
                        if (!empty($mdoc["response"])) {
                            $s = "";
                            foreach ($mdoc["response"] as $res) {
                                $s .= "> * " . $res . "\n";

                            }
                            $doc .= "* **Response :** \n" . $s . "\n";
                        }

                        //fail
                        /*if (!empty($mdoc["fail"])) {
                            $f = "";
                            foreach ($mdoc["fail"] as $fail) {
                                $f .= "> * " . $fail . "\n";

                            }
                            $doc .= "* **Fail :** \n" . $f . "\n\n --- \n\n";
                        }*/

                    }

                }

            }
            $this->doc .= $doc;
        }
        $this->doc .= "\n### 注：\n > * 接口返回数据以实际返回为准，文档只提供参考";

        $this->createFile($this->doc,"doc.md");
        // print_r($this->doc);

    }

    public function testview(){
        $this->json();
        $filepath = storage_path()."/doc/doc.json";
        $json = file_get_contents($filepath);
        $array = json_decode($json, true);
        return view("baodan",["json"=>$array]);
    }

}
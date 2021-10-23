<?php

class deneme extends Controller{

    public function index(){

        $model = $this->model("users");

        
        $arr = array();

        for($i=0;$i<60000;$i++){

        
            array_push($arr,"denemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedeneme
            denemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedeneme
            denemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedeneme
            denemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedeneme
            denemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedeneme
            denemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedeneme
            denemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedeneme
            denemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedeneme
            ".$i);



        }

        $myJSON = json_encode($arr);

        $insert = $model->deneme("deneme",$myJSON);

    }


    public function denemeview(){

        $model = $this->model("users");
        $sorgu = $model->denemeselect();

        $view = $this->view("denemeview",["sorgu" =>$sorgu]);
    }

}


?>
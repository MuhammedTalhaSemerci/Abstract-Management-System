<?php

class login extends Controller
{


     public function goaway($refer)
        {
    
            if(isset($_SESSION["user"]))
                {
                    if(intval($_SESSION["user"]["uye_yetki"]) == 0)
                    {
                        header("location:/abstract_index".$refer);
                        exit();
                    }
                    else if(intval($_SESSION["user"]["uye_yetki"]) == 1)
                    {
                        header("location:/editor_index".$refer);
                        exit();
                    }
                    else if(intval($_SESSION["user"]["uye_yetki"]) == 2)
                    {
                        header("location:/referee_index".$refer);
                        exit();
                    }
    
                    else if(intval($_SESSION["user"]["uye_yetki"]) == 3)
                    {
                        header("location:/admin_index".$refer);
                        exit();
                    }
                    else
                    {
                        header("location:/login");
                        exit();
                    }
                }
            else
            {
                header("location:/login");
                exit();
            }
    
    
        }



    public function index()
    {
        session_start();

        $language = $this->language();
        if(isset($_SESSION["register_language"]))
        {
            $language = $language[$_SESSION["register_language"]]["login"];
            $uye_dil = $_SESSION["register_language"];
        }
        else
        {
            $language = $language["tr"]["login"];
            $uye_dil = "tr";
        }
 

        $user_model = $this->model("users");
        $abstract_model = $this->model("model_abstract");
        $virtual_congress_model = $this->model("virtual_congress_model");

        $result = $user_model->getAll();
        $abstract_websites = $abstract_model->allcategorywebsites()[0];
        $all_admins = $virtual_congress_model->getAllPermittedUsers("uye","3");

        $withdrawal_state = -1;
        if(isset($_SESSION["user"])){
            $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
            
            if($abstract_websites["congress_start_time"] > date("U"))
            {
                $this->goaway("");
            }
            else
            {
                $withdrawal_state = json_decode($user_index["withdrawals"])[0][3];
                if($user_index["withdrawals"] == null || $withdrawal_state != 1)
                {
                    //$this->goaway("");
                    $withdrawal_state = 0;
                }
            }
        }
        $this->view('out_of_indexes/socket_notifications',["language"=>$language,"uye_dil"=>$uye_dil, "abstract_websites"=>$abstract_websites,"user_index"=>$user_index,"all_admins"=>$all_admins]);
        
        $this->view('login',["language"=>$language,"uye_dil"=>$uye_dil, "abstract_websites"=>$abstract_websites,"user_index"=>$user_index,"all_admins"=>$all_admins,"withdrawal_state"=>$withdrawal_state]);
        
    }

    public function system_login()
    {
        session_start();
        
        $kayit_basari="";

        $kullanici_mail ="";
        $kullanici_sifre = "" ;
        if (isset($_POST['mail']) && isset($_POST['sifre']))
        {
            
        $kullanici_mail = $_POST['mail'];
        $kullanici_sifre = $_POST['sifre'];
 

        $user = $this->model("users");
        $abstract_model = $this->model("model_abstract");
   
        $mail_sorgu = $user->getuserreset("uye",$kullanici_mail);
        $abstract_websites = $abstract_model->allcategorywebsites();
        if ($mail_sorgu) {
          
        $kayit_basari ="uyetrue";
          
            
        }

        else{

            $kayit_basari = "uyefalse";

            header('Location:/?kayit_basari='.$kayit_basari);
            exit();
        }


        $result = $user->getuserindex("uye",$kullanici_mail,$kullanici_sifre);

        if ($result and $kayit_basari =="uyetrue") {
           
            $_SESSION['user'] = $result;

            $kayit_basari = "true";
            if($abstract_websites[0]["congress_start_time"] > date("U"))
            {
                if(intval($_SESSION["user"]["uye_yetki"]) == 0)
                {
                    header("location:/abstract_index");
                    exit();
                }
                else if(intval($_SESSION["user"]["uye_yetki"]) == 1)
                {
                    header("location:/editor_index");
                    exit();
                }
                else if(intval($_SESSION["user"]["uye_yetki"]) == 2)
                {
                    header("location:/referee_index");
                    exit();
                }
                else if(intval($_SESSION["user"]["uye_yetki"]) == 3)
                {
                    header("location:/admin_index");
                    exit();
                }
                else{
                }
            }
            else
            {
                header("location:/");
                exit();
            }
        }

        else{

            $kayit_basari = "false";
            header('Location:/?kayit_basari='.$kayit_basari);

        }

        $this->view('login',["data"=>$result]);

       

        }


     


    }

    public function post()
    {
        print_r($_POST);
    }

}
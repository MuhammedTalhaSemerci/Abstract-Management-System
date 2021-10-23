<?php

    class language extends Controller
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

        public function language_changer()
        {
            session_start();
            if(isset($_GET["page"]))
            {
                if(isset($_POST["language"]))
                {
                    $_SESSION["register_language"] = $_POST["language"];
                    header("location:/".$_GET["page"]);
                }

                if(isset($_GET["language"]))
                {
                    $_SESSION["register_language"] = $_GET["language"];
                    header("location:/".$_GET["page"]);
                }
            }
            else
            {
                header("location:/login");
            }
            
        }

        public function main_language_changer()
        {
            session_start();
            $user_model =$this->model("users");
            if(isset($_SESSION["user"]))
            {
                $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);

                if($user_index && isset($_POST["language"]) && isset($_GET["page"]))
                {
                    $result = $user_model->main_language_changer("uye",$_POST["language"],$_SESSION["user"]["uye_mail"]);
                    $this->goaway("?sayfa=".$_GET["page"]);
                }
            }
            header("location:/login");
        }
    } 

?>
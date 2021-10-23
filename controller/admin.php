
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'controller/PHPMailer/src/Exception.php';
require 'controller/PHPMailer/src/PHPMailer.php';
require 'controller/PHPMailer/src/SMTP.php';

    class admin extends Controller
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

            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3){            
            }
            else{
                $this->goaway("");
            }
    
                            
            $user_model = $this->model("users");
            $admin_model = $this->model("admin_model");
            $abstract_model = $this->model("model_abstract");
            $language = $this->language();

            $all_abstracts= $abstract_model->getallabstracts($_SESSION["user"]["id"]); 
            $all_abstracts_main_author= $abstract_model->getallabstracts_main_author($_SESSION["user"]["id"]); 
            $all_users = $admin_model->getallusers();

            if(isset($_GET["admin_user_id"]))
            {
                $user_index = $admin_model->getuserbyadmin("uye",$_GET["admin_user_id"]);
                $primer_user = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
            }

            else
            {
                $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
                $primer_user = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
                $register_id = $user_index["id"];
            }
            
            //categories
            $congress_name = $_POST["congress"] ?? $_GET["congress"] ?? "";
            if($congress_name != "")
            {
                $abstract_websites = $abstract_model->allcategorywebsites($congress_name);
            }
            else
            {
                $abstract_websites = $abstract_model->allcategorywebsites();
            }
            
         

            if(isset($_GET["sayfa"])){
                if($_GET["sayfa"] == "congress_document_upload"){
        
                    if( empty($user_index["withdrawals"])){
                    $this->goaway("?sayfa=congress_register");
                    }
                    
                            
                }
        
                if($_GET["sayfa"] == "congress_register"){
    
                    if($user_index["withdrawals"] != null){
                    $this->goaway("?sayfa=congress_register_status");
                    }          
                }
            }
            


            if(isset($_GET["sayfa"])){
                $language = $language[$primer_user["uye_dil"]][$_GET["sayfa"]];
            }
            else
            {
            }
    

            if(isset($_GET["abstract_id"])){
                $abstract_no= intval($_GET["abstract_id"]);
                $update_abstract= $abstract_model->getabstractinfo($abstract_no);  
            }
            else{
                $update_abstract=null;  
            }

            if(isset($_GET["abstract_presentation_id"]) && isset($_GET["sayfa"]) && $_GET["sayfa"] == "abstract_presentations")
            {
                $update_abstract= $abstract_model->getabstractinfo($_GET["abstract_presentation_id"]);
                if(intval($update_abstract["register_id"]) == intval($register_id) && intval($update_abstract["accepted"]) == 1 || 
                (intval($update_abstract["main_author_id"]) == intval($register_id) && intval($update_abstract["accepted"]) == 1))
                {}
                else
                {
                    $this->goaway("?sayfa=my_abstracts");
                }  
            }

            if(isset($_GET["sayfa"]) && $_GET["sayfa"]=="abstract_authorization" && isset($_GET["abstract_id"]))
            {
                $referee_users =[];
                for($i=0;$i<count($all_users);$i++)
                {
                    if((intval($all_users[$i]["uye_yetki"]) == 1 || (intval($all_users[$i]["uye_yetki"]) == 2 && $all_users[$i]["referee_category"] && $all_users[$i]["uye_turu"] == "Hakem") || intval($all_users[$i]["uye_yetki"]) == 3))
                    {
                        $user_category = json_decode($all_users[$i]["referee_category"])[2];
                        if(intval($all_users[$i]["uye_yetki"]) == 2)
                        {
                            if($update_abstract["abstract_sub_category"] == $user_category)
                            {
                                array_push($referee_users,$all_users[$i]);
                            }
                        }
                        else
                        {
                            array_push($referee_users,$all_users[$i]);
                        }
                    }
                }
            }
            else
            {
                $referee_users = null;
            }
            


            $referee_all_abstracts_arr=[];
            $referee_all_abstracts = $abstract_model->getallusersabstracts();

            if(is_array($referee_all_abstracts))
            {
                for($i=0;$i<count($referee_all_abstracts);$i++)
                {
                    $cakisma = 0;
                    $will_change = 0;
                    $changed = 0; 

                    if($referee_all_abstracts[$i]["referee_ids"] )
                    {
                        $referee_ids = json_decode($referee_all_abstracts[$i]["referee_ids"]);

                        for($a=0;$a<count($referee_ids);$a++)
                        {
                            if($referee_ids[$a] == $_SESSION["user"]["id"])
                            {
                                $edit_requests = json_decode($referee_all_abstracts[$i]["edit_requests"]);

                            
                                $cakisma = 1;
                                break;
                            }
                            else
                            {
                                continue;
                            }
                        }
                    }
                    else
                    {
                        continue;
                    }
                    
                    if($cakisma == 1)
                    {
                         
                        $abstract_id = $referee_all_abstracts[$i]["abstract_no"];
                        $abstract_title = strip_tags($referee_all_abstracts[$i]["title"]);
                        $abstract_sub_category = $referee_all_abstracts[$i]["abstract_sub_category"];
                        $abstract_type = $referee_all_abstracts[$i]["abstract_type"];


                        array_push($referee_all_abstracts_arr, [$abstract_id,$abstract_title,$abstract_sub_category,$abstract_type]);
                    }
                    else 
                    {
                        continue;
                    }
                }
            }




            
            $admin_all_abstracts_arr=[];
            $admin_all_abstracts = $abstract_model->getallusersabstracts();
            $admin_all_abstracts_arr = $this->all_abstracts($admin_all_abstracts);
            


            $this->view(
            "admin/index",
                [
                    "all_users"=>$all_users,
                    "abstract_websites"=>$abstract_websites,
                    "uye_dil"=>strval($primer_user["uye_dil"]),
                    "language"=>$language,
                    "all_abstracts"=>$all_abstracts,
                    "all_abstracts_main_author"=>$all_abstracts_main_author,
                    "update_abstract"=>$update_abstract,
                    "user_name"=>$_SESSION["user"]["uye_adi"],
                    "user_index"=>$user_index,
                    "primer_user"=>$primer_user,
                    "admin_all_abstracts"=>$admin_all_abstracts_arr,
                    "referee_users"=>$referee_users,
                    "referee_all_abstracts"=>$referee_all_abstracts_arr,
                    "scientific_program_all_abstracts"=>$admin_all_abstracts_arr,
                ]
            );

            $this->view("out_of_indexes/socket_notifications",["abstract_websites"=>$abstract_websites,"user_index"=>$primer_user]);

        }




        public function abstract_booker()
        {
            session_start();

            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3){            
            }
            else{
                $this->goaway("");
            }
            
            $abstract_model = $this->model("model_abstract");
            $user_model = $this->model("users");
            $abstracts = [];
    
            $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
            $language = $this->language()[$user_index["uye_dil"]]["abstract_booker"];

            $abstract_categories = json_decode($abstract_model->allcategorywebsites()[0]["categories"])->{"tr"};
            $all_categories=[];
            for($a=0;$a<count($abstract_categories);$a++)
            {
                array_push($all_categories,$abstract_categories[$a][0]->{"category"});
            
            }
            for($i=0;$i<count($all_categories);$i++)
            {
                $abstracts_db = $abstract_model->get_all_abstracts_by_category_booker("abstracts",$all_categories[$i],"Sözlü Sunum");
                for($a=0;$a<count($abstracts_db);$a++)
                {
                    array_push($abstracts,$abstracts_db[$a]);
                }

                $abstracts_db = $abstract_model->get_all_abstracts_by_category_booker("abstracts",$all_categories[$i],"E-poster");

                for($a=0;$a<count($abstracts_db);$a++)
                {
                    array_push($abstracts,$abstracts_db[$a]);
                }
            
            }
            for($i=0;$i<count($abstracts);$i++)
            {
                if($abstracts[$i]["accepted"] == 1)
                {
                    if($abstracts[$i]["abstract_language"] == "turkish-english")
                    {
                        $abstracts[$i]["uye_dil"] = $this->language()["tr"]["abstract_booker"];
                    }
                    else if($abstracts[$i]["abstract_language"] == "english")
                    {
                        $abstracts[$i]["uye_dil"] = $this->language()["en"]["abstract_booker"];
                    }
                }
                else
                {
                    array_splice($abstracts,$i,1);
                }
            }
            $this->view(
            "admin/abstract_booker",
                [
                    "language"=>$language,
                    "admin_all_abstracts"=>$abstracts,
                    "user_index"=>$user_index,
                ]
            );
            
        
        }




        public function search()
        {
            session_start();

            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3){            
            }
            else{
                $this->goaway("");
            }
            
          
            $abstract_model = $this->model("model_abstract");
            $admin_model = $this->model("admin_model");
            $user_model = $this->model("users");

            if(isset($_POST["value"])){
                if(isset($_POST["users"]))
                {
                    $primer_user = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
                    $value=explode("@",$_POST["value"]);
                    try 
                    {
                        switch ($value[0]) 
                        {
                            case "getall":
        
                                $sorgu = $admin_model->getallusers();
        
                                break;

                            case "withdrawal_none":

                                $sorgu_db = $admin_model->getallusers();
                                $sorgu = [];

                                for($i=0;$i<count($sorgu_db);$i++)
                                {

                                    $withdrawal = json_decode($sorgu_db[$i]["withdrawals"]);
                                    if($withdrawal[0][3] == $value[1] && $withdrawal != null)
                                    {
                                        array_push($sorgu,$sorgu_db[$i]);
                                    }
                                }

                                break;
                        

                            case "abstract":
                                
                                $sorgu_db = $admin_model->getallusers();
                                $sorgu = [];

                                for($i=0;$i<count($sorgu_db);$i++)
                                {
                                    $abstract_db = $abstract_model->getallabstracts($sorgu_db[$i]["id"]);
                                    
                                    if($value[1] == 1 && $abstract_db)
                                    {
                                        array_push($sorgu,$sorgu_db[$i]);
                                    }
                                    else if($value[1] == 0 && !$abstract_db)
                                    {
                                        array_push($sorgu,$sorgu_db[$i]);
                                    }
                                    else{continue;}

                                }

                                break;
                    
                            case 1:
        
                                $sorgu = $admin_model->getwithone("uye",$value[1],$value[2]);
        
        
                                break;
        
                            case 2:
                            
        
                                $sorgu = $admin_model->getwithtwo("uye",$value[1],$value[2],$value[3],$value[4]);
        
                                break;
                        
                            case 3:
                            
        
                                $sorgu = $admin_model->getwiththree("uye",$value[1],$value[2],$value[3],$value[4],$value[5],$value[6]);
                                break;
        
                            default:
                                break;
                        }
                    } 
                    catch (\Throwable $th) 
                    {
                        echo $th;
                    }
                
                $this->view("admin/index",["all_users"=>$sorgu,"user_name"=>$_SESSION["user"]["uye_adi"],"primer_user"=>$primer_user]);

                }
                if(isset($_POST["abstract"]))
                {
                    $primer_user = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
                    $value = explode("@",$_POST["value"]);
                    try 
                    {
                        switch ($value[0]) 
                        {
                            case "getall":
        
                                $sorgu=[];
                                $admin_all_abstracts = $abstract_model->getallusersabstracts();
                                $sorgu = $this->all_abstracts($admin_all_abstracts);
                               
        
                                break;
    
                            case "withdrawal_none":


                                $sorgu=[];
                                $admin_all_abstracts = $abstract_model->getallusersabstracts();
                    
                                for($i=0;$i<count($admin_all_abstracts);$i++)
                                {
                                    $user_db = $admin_model->getuserbyadmin("uye",$admin_all_abstracts[$i]["register_id"]);
                                    $withdrawal = json_decode($user_db["withdrawals"]);
                                    if($withdrawal[0][3] == $value[1] || ($value[1] == 0 && $withdrawal == null))
                                    {
                                        array_push($sorgu,$this->all_abstracts([$admin_all_abstracts[$i]])[0]);
                                    }
                                }
    
                                break;
                           

                            case "acception_status":


                                $sorgu=[];
                                $admin_all_abstracts = $abstract_model->getallusersabstracts();
                    
                                for($i=0;$i<count($admin_all_abstracts);$i++)
                                {
                                    
                                    if($admin_all_abstracts[$i]["accepted"] == $value[1])
                                    {
                                        array_push($sorgu,$this->all_abstracts([$admin_all_abstracts[$i]])[0]);
                                    }
                                }
    
                                break;


                            case "abstract_type":


                                $sorgu=[];
                                $admin_all_abstracts = $abstract_model->getallusersabstracts();
                    
                                for($i=0;$i<count($admin_all_abstracts);$i++)
                                {
                                    
                                    if($admin_all_abstracts[$i]["abstract_type"] == $value[1])
                                    {
                                        array_push($sorgu,$this->all_abstracts([$admin_all_abstracts[$i]])[0]);
                                    }
                                }
    
                                break;

                           
                            case 1:
        
                                $sorgu = $admin_model->getwithone("uye",$value[1],$value[2]);
        
        
                                break;
        
                            case 2:
                            
        
                                $sorgu = $admin_model->getwithtwo("uye",$value[1],$value[2],$value[3],$value[4]);
        
                                break;
                        
                            case 3:
                            
        
                                $sorgu = $admin_model->getwiththree("uye",$value[1],$value[2],$value[3],$value[4],$value[5],$value[6]);
                                break;
        
                            default:
                                break;
                        }
                    } 
                    
                    catch (\Throwable $th) 
                    {
                        echo $th;
                    }
                 
                    $this->view("admin/index",["admin_all_abstracts"=>$sorgu,"user_name"=>$_SESSION["user"]["uye_adi"],"primer_user"=>$primer_user]);
    
                }


            }
            else{
                $primer_user = null;
                $sorgu = null;
                $this->goaway("?sayfa=all_abstracts");

            }

    
                
        }

            
        public function admin_authority_change()
        {

        session_start();

            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3 ){            
            }
            else{
                $this->goaway("");
            }

            $admin_model = $this->model("admin_model");
            if(isset($_GET["id"]) && isset($_GET["uye_yetki"]))
            {
                $sorgu = $admin_model->admin_authority_change("uye",$_GET["uye_yetki"],$_GET["id"]);
        
                if($sorgu)
                {
                    $user_index = $admin_model->getuserbyadmin("uye",$_GET["id"]);
                    if(intval($user_index["uye_yetki"]) == 2)
                    {
                        if($user_index["referee_category"])
                        {
                            $referee_category = json_decode($user_index["referee_category"]);
                        }
                        else
                        {
                            $referee_category=["","",""];
                        }
                        $this->mailer_setup("Bitki Koruma Kongresi Bilim Kurulu Hk.","<h3>Nutuva Organizasyon Bildiri Yönetim Sistemine Hoşgeldiniz</h3><br>

                        Sayın ".$user_index["uye_adi"]." ".$user_index["uye_soyadi"].",<br>
                        
                        Uluslararası Katılımlı 8. Bitki Koruma Kongresi ".$referee_category[2]." Bilim Kurulu Üyesi kaydınız tamamlanmıştır.<br>
                        
                            Değerlendirmeniz gereken bildiriler için daha sonra hatırlatma maili alacaksınız. 
                        <a href='http://ekongre.nutuva.com/ '>http://ekongre.nutuva.com </a>web sitesi üzerinden mail adresi ve şifrenizle giriş yaparak değerlendirmeniz gereken bildirileri görebilir değerlendirme sonucunuzu girebilirsiniz.<br>
                        <br>
                        Nutuva Organizasyon<br>
                        
                        <br>
                        Bu ileti size Nutuva Organizasyon aracılığıyla gönderilmiştir.
                        
                        <hr>

                        <h3>You are welcome to Nutuva Abstract Management System.</h3><br>
                        Dear ". $user_index["uye_adi"]." ".$user_index["uye_soyadi"].", <br>
                        
                        Your scientific Committee Member registration of the 8th Plant Protection Congress with International Participation has been completed. <br>
                        
                            You will receive reminder e-mails for abstracts that you need to judge.
                        You can judge by logging in with your e-mail address and password on <a href='http://ekongre.nutuva.com/'> http://ekongre.nutuva.com </a> website, and enter your judgement. <br>
   
                        <br>
                        Nutuva Organization<br>
                        
                        <br>
                        This message has been sent to you through Nutuva Organization.",$user_index["uye_mail"]);
                    }
                    else
                    {
                    }
                    $this->goaway("?sayfa=profile_change&admin_user_id=".$_GET["id"]."&state=authority_true");
                }
                else
                {
                    $this->goaway("?sayfa=profile_change&admin_user_id=".$_GET["id"]."&state=authority_false");
                }
                 
            }
            else{
                $this->goaway("?sayfa=all_users&value=getall");
            }
            
          

        }




        
    public function admin_new_user_save(){

        session_start();

        if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3){            
        }
        else{
            $this->goaway("");
        }

        $uye_adi = $_POST["kadi"];
        $uye_soyadi = $_POST["ksoyadi"];
        $uye_tel = $_POST["tel"];
        $uye_sehir = $_POST["sehir"];
        $uye_unvan = $_POST["unvan"];
        $uye_uzmanlik = $_POST["uzmanlik"];
        $uye_turu = $_POST["uye_turu"];
        $uye_kurum = $_POST["kurum"];
        $uye_mail = $_POST["mail"];
        $uye_sifre = bin2hex(random_bytes(5));

        $manager_arr =[];
        if($uye_turu == "Hakem"){
            
            $abstract_website    = $_POST["abstract_website"];
            $abstract_categories = $_POST["abstract_categories"];
            $abstract_sub_check  = $_POST["abstract_sub_check"];
            $manager_arr =[$abstract_website,$abstract_categories,$abstract_sub_check];
            $manager_json = json_encode($manager_arr,JSON_UNESCAPED_UNICODE);

        }
        else
        {
            $manager_json =null;
        }

        $user_model = $this->model('users');
        $user_control = $user_model->getuserreset("uye",$uye_mail);



        if(empty($user_control)){
            $users = $user_model->insertuser("uye",$uye_adi,$uye_soyadi,$uye_tel,$uye_sehir,$uye_unvan,$uye_uzmanlik,$uye_turu,$uye_kurum,$uye_mail,$uye_sifre,$manager_json);
            
            if(isset($_POST["bursluluk"]))
            {
                $user_index = $user_model->getuserindex("uye",$uye_mail,$uye_sifre);
                if($user_index && isset($_POST["burslulukaciklama"]))
                {
                    $description = $_POST["burslulukaciklama"];
                    $result = $user_model->congress_pre_register_description("uye",$user_index["uye_mail"],$description);
                }
                if($user_index)
                {
                    $data = [["Bitki Koruma Kongresi","Burslu Kayıt/--/Erken Kayıt",[],1]];
                    $result = $user_model->congress_pre_register("uye",$user_index["uye_mail"],json_encode($data,JSON_UNESCAPED_UNICODE));
                }
                

            }



            $to = $uye_mail;



            $this->mailer_setup('Kayıt Bilgilendirme',"<h3>Nutuva Organizasyon Bildiri Yönetim Sistemine Hoşgeldiniz</h3><br>
            
            <p>Sayın ".$uye_adi." ".$uye_soyadi.", Nutuva Organizasyon Bildiri Yönetim Sistemi kayıt işleminiz gerçekleştirilmiştir.</p><br>
            Kongre ile ilgili bilgilendirmeleri bu mail üzerinden alacaksınız.  <a href='http://ekongre.nutuva.com/ '>http://ekongre.nutuva.com </a>. Mail adresi ve şifreniz ile sisteme giriş yapabilirsiniz.
            Kongre kaydınızı ve bildiri yükleme işlemlerini online olarak gerçekleştirebilirsiniz. Bildiri değerlendirme sonucunu sistem üzerinden takip edebilirsiniz.</p><br><br>
            <p>Bu mail Nutuva Organizasyon tarafından gönderilmiştir.</p>
            
            <h5>Giriş Bilgileri:</h5>

            <p> Mail Adresiniz: ".$uye_mail."</p>
            <p> Şifreniz: ".$uye_sifre."</p>

            <br>
            Nutuva Organizasyon<br>
            
            <br>
            Bu ileti size Nutuva Organizasyon aracılığıyla gönderilmiştir.
            
            <hr>

            <h3>You are welcome to Nutuva Abstract Management System.</h3><br>

            <p>Dear ".$uye_adi." ".$uye_soyadi.", Your registration for Nutuva Organization Abstract Management System has been completed. </p> <br>
            You will receive information about the congress via this e-mail. <a href='http://ekongre.nutuva.com/'> http://ekongre.nutuva.com </a>. You can log in to the system with your e-mail address and password.
            You are able to do the congress registration and abstract upload processes via the online system. You can view the abstract judgement result on the system. </p> <br> <br>
            <p> This mail was sent by Nutuva Organization.</p>

            <h5>Login Informations:</h5>

            <p> Your mail address: ".$uye_mail."</p>
            <p> Your password: ".$uye_sifre."</p>

            <br>
            Nutuva Organization<br>
            
            <br>
            This message has been sent to you through Nutuva Organization.
            
            
            ",$to);
            
            $this->goaway("?sayfa=new_user&kayit_basari=true");
        }
        else{
            $this->goaway("?sayfa=new_user&kayit_basari=false");
        }
        
        
        
    }





        public function admin_user_update(){

            session_start();
    
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3){            
            }
            else{
                $this->goaway("");
            }
    
    
            $uye_adi = $_POST["kadi"];
            $uye_soyadi = $_POST["ksoyadi"];
            $uye_tel = $_POST["tel"];
            $uye_sehir = $_POST["sehir"];
            $uye_unvan = $_POST["unvan"];
            $uye_uzmanlik = $_POST["uzmanlik"];
            $uye_kurum = $_POST["kurum"];
            $uye_turu = $_POST["uye_turu"];

            if(isset($_POST["burslulukaciklama"]))
            {
                $description = $_POST["burslulukaciklama"];
            }

            if(isset($_POST["referee_website"]) && isset($_POST["referee_categories"]) && isset($_POST["referee_sub_check"]) && $uye_turu =="Hakem")
            {
                $referee_website = $_POST["referee_website"];
                $referee_categories = $_POST["referee_categories"];
                $referee_sub_check = $_POST["referee_sub_check"];
                $referee_arr = json_encode([$referee_website,$referee_categories,$referee_sub_check],JSON_UNESCAPED_UNICODE);
            }
            else
            {
                $referee_arr = null;   
            }
            

            $admin_model = $this->model("admin_model");
            $user_model = $this->model("users");

            $user_result = $admin_model->admin_user_update($_GET["id"],$uye_adi,$uye_soyadi,$uye_tel,$uye_sehir,$uye_unvan,$uye_uzmanlik,$uye_kurum,$uye_turu,$referee_arr);
            if($description)
            {
                $user_index = $admin_model->getuserbyadmin("uye",$_GET["id"]);
                $user_index_desc = $user_model->congress_pre_register_description("uye",$user_index["uye_mail"],$description);
                if($user_result && $user_index_desc)
                {
                    $this->goaway("?sayfa=profile_change&admin_user_id=".$_GET["id"]."&status=true");
                }
                else
                {
                    $this->goaway("?sayfa=profile_change&admin_user_id=".$_GET["id"]."&status=false");
                }
            }
            else
            {
                 if($user_result)
                {
                    $this->goaway("?sayfa=profile_change&admin_user_id=".$_GET["id"]."&status=true");
                }
                else
                {
                    $this->goaway("?sayfa=profile_change&admin_user_id=".$_GET["id"]."&status=false");
                }
            }
           
           
        }


        public function admin_withdrawal_update()
        {

            //kongrelere göre işlem yapmak için burası düzenlenecek.
            session_start();
    
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3){            
            }
            else{
                $this->goaway("");
            }
            $id = $_GET["id"];

            $withdrawal_change = $_GET["withdrawal"];
            $admin_model =$this->model("admin_model");

            $user_index = $admin_model->getwithone("uye","id",$id)[0];
          

            if($user_index && $id && $withdrawal_change >=0)
            {
                $withdrawal = json_decode($user_index["withdrawals"]);
                
                if(intval($withdrawal_change) == 0)
                {
                    $withdrawal[0][3] = $withdrawal_change;
                /* $withdrawal[0][3] = $withdrawal_change;
                    $withdrawal_state = explode("/",$withdrawal[0][1]);
                    $withdrawal_state[2] = "Ön Kayıt";
                    $withdrawal[0][1] = $withdrawal_state[0]."/".$withdrawal_state[1]."/".$withdrawal_state[2];*/
                }
                else if(intval($withdrawal_change) == 1)
                {
                    $withdrawal[0][3] = $withdrawal_change;
                    $this->mailer_setup("Bitki Koruma Kongresi Kongre Kayıt Hk.","<h3>Nutuva Organizasyon Bildiri Yönetim Sistemine Hoşgeldiniz</h3><br>

                    Sayın ".$user_index["uye_adi"]." ".$user_index["uye_soyadi"].",<br>
                    
                    Uluslararası Katılımlı 8. Bitki Koruma Kongresi ödeme işleminiz onaylanmıştır.<br>
                    
                         
                    <a href='http://ekongre.nutuva.com/ '>http://ekongre.nutuva.com </a> web sitesi üzerinden mail adresi ve şifrenizle giriş yaparak kongre davet mektubunuzu 'Kayıt Durumu Sorgulama' ekranından ulaşabilirsiniz.<br>
                    <br>
                    Nutuva Organizasyon<br>
                    
                    <br>
                    Bu ileti size Nutuva Organizasyon aracılığıyla gönderilmiştir.

                    <hr>

                    <h3>You are welcome to Nutuva Abstract Management System.</h3><br>
                    Dear ". $user_index["uye_adi"]." ".$user_index["uye_soyadi"].", <br>
                    
                    Your payment transaction has been approved for the 8th Plant Protection Congress with International Participation. <br>
                    
                    You can access your congress invitation letter from the 'Registration Status' screen by logging in with your e-mail address and password on the <a href='http://ekongre.nutuva.com/'> http://ekongre.nutuva.com </a> website. <br>

                    <br>
                    Nutuva Organization<br>
                    
                    <br>
                    This message has been sent to you through Nutuva Organization.",$user_index["uye_mail"]);

                /*  $withdrawal[0][3] = $withdrawal_change;
                    $withdrawal_state = explode("/",$withdrawal[0][1]);
                    $withdrawal_state[2] = "Kesin Kayıt";
                    $withdrawal[0][1] = $withdrawal_state[0]."/".$withdrawal_state[1]."/".$withdrawal_state[2];
                    $this->mailer_setup("Bitki Koruma Kongresi Ödeme Onay Hk.",)*/
                }
                else if(intval($withdrawal_change) == 2)
                {
                    $withdrawal[0][3] = $withdrawal_change;
                    $this->mailer_setup("Bitki Koruma Kongresi Kongre Kayıt Hk.","<h3>Nutuva Organizasyon Bildiri Yönetim Sistemine Hoşgeldiniz</h3><br>

                    Sayın ".$user_index["uye_adi"]." ".$user_index["uye_soyadi"].",<br>
                    
                    Uluslararası Katılımlı 8. Bitki Koruma Kongresi ödeme işleminiz reddedilmiştir.<br>
                    
                         
                    <a href='http://ekongre.nutuva.com/ '>http://ekongre.nutuva.com </a> web sitesi üzerinden mail adresi ve şifrenizle giriş yaparak 
                    kongre kayıt sonucunuza 'Kayıt Durumu Sorgulama' ekranından ulaşabilirsiniz.<br>

                    <br>
                    Nutuva Organizasyon<br>
                    
                    <br>
                    Bu ileti size Nutuva Organizasyon aracılığıyla gönderilmiştir.
                    
                    <hr>

                    <h3>You are welcome to Nutuva Abstract Management System.</h3><br>
                    Dear ". $user_index["uye_adi"]." ".$user_index["uye_soyadi"].", <br>
                    
                    Your payment transaction has been rejected for the 8th Plant Protection Congress with International Participation. <br>
                    
                    You can access your congress invitation letter from the 'Registration Status' screen by logging in with your e-mail address and password on the 
                    <a href='http://ekongre.nutuva.com/'> http://ekongre.nutuva.com </a> website. <br>

                    <br>
                    Nutuva Organization<br>
                    
                    <br>
                    This message has been sent to you through Nutuva Organization.",$user_index["uye_mail"]);
                }
                else{}
                $withdrawal = json_encode($withdrawal,JSON_UNESCAPED_UNICODE);
                $user_update = $admin_model->admin_withdrawal_update("uye",$id,$withdrawal);
                
                if($user_update){
    
                  
                    $this->goaway("?sayfa=all_users");
                }
                else{
                    $this->goaway("?sayfa=all_users");
                }
            }
            else
            {
            }
        }


        public function admin_paid_val_update()
        {
            session_start();

            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3){            
            }
            else{
                $this->goaway("");
            }

            $admin_model = $this->model("admin_model");
            
            if(isset($_GET["value"]) && isset($_GET["id"]))
            {
                $paid_val = $_GET["value"];
                $id = $_GET["id"];
                $user_update = $admin_model->admin_paid_val_update("uye",$id,$paid_val);
                
                if($user_update)
                {
                    $this->goaway("?sayfa=all_users");
                }
                else
                {
                    $this->goaway("?sayfa=all_users");
                }
            }
            $this->goaway("?sayfa=all_users");

        }
        

        public function admin_sponsor_authorization_update()
        {
            session_start();
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3){            
            }
            else{
                $this->goaway("");
            }

            $admin_model = $this->model("admin_model");
            if(isset($_GET["sponsor_company"]) && isset($_GET["id"]))
            {
                $sponsor_company = $_GET["sponsor_company"];
                $user_id = $_GET["id"];
                
                $result = $admin_model->admin_sponsor_authorization_update("uye",$sponsor_company,$user_id);

                if($result)
                {
                    $this->goaway("?sayfa=profile_change&admin_user_id=".$_GET["id"]."&status=true");
                }
                else
                {
                    $this->goaway("?sayfa=profile_change&admin_user_id=".$_GET["id"]."&status=false");
                }
            }
            else
            {
                if(isset($_GET["id"]))
                {
                    $user_id = $_GET["id"];
                    $result = $admin_model->admin_sponsor_authorization_update("uye",null,$user_id);
                    $this->goaway("?sayfa=profile_change&admin_user_id=".$_GET["id"]."&status=false");
                
                }
                $this->goaway("?sayfa=all_users");
              
            }
        }


        public function admin_stand_authorization_update()
        {
            session_start();
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3){            
            }
            else{
                $this->goaway("");
            }

            $admin_model = $this->model("admin_model");
            if(isset($_GET["sponsor_company"]) && isset($_GET["id"]))
            {
                $sponsor_company = $_GET["sponsor_company"];
                $user_id = $_GET["id"];
                
                $result = $admin_model->admin_stand_authorization_update("uye",$sponsor_company,$user_id);

                if($result)
                {
                    $this->goaway("?sayfa=profile_change&admin_user_id=".$_GET["id"]."&status=true");
                }
                else
                {
                    $this->goaway("?sayfa=profile_change&admin_user_id=".$_GET["id"]."&status=false");
                }
            }
            else
            {
                if(isset($_GET["id"]))
                {
                    $user_id = $_GET["id"];
                    $result = $admin_model->admin_stand_authorization_update("uye",null,$user_id);
                    $this->goaway("?sayfa=profile_change&admin_user_id=".$_GET["id"]."&status=false");
                
                }
                $this->goaway("?sayfa=all_users");
              
            }
        }

        



        public function registration_replace()
        {
            session_start();
    
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3){            
            }
            else{
                $this->goaway("");
            }
            if($_GET["kayit_durum"])
            {
                
                $data = null;

                $model = $this->model("users");
                $admin_model =$this->model("admin_model");

                $user_index = $admin_model->getwithone("uye","id",$_GET["id"])[0];
                $result = $model->congress_pre_register("uye",$user_index["uye_mail"],$data);
                
            }
            else
            {
                $data = [["Bitki Koruma Kongresi",$_GET["Kayit_ucreti"],[],$_GET["Kayit_onay"]]];

                $data = json_encode($data,JSON_UNESCAPED_UNICODE);

                $model = $this->model("users");
                $admin_model =$this->model("admin_model");

                $user_index = $admin_model->getwithone("uye","id",$_GET["id"])[0];
                $result = $model->congress_pre_register("uye",$user_index["uye_mail"],$data);
            }

            if($result && $_GET["Kayit_onay"] == 1)
            {
                $this->mailer_setup("Kayıt Bilgilendirme Hk.","<h3>Nutuva Organizasyon Bildiri Yönetim Sistemine Hoşgeldiniz</h3><br>

                Sayın ".$user_index["uye_adi"]." ".$user_index["uye_soyadi"].",<br>
                
                Uluslararası Katılımlı 8. Bitki Koruma Kongresi ödeme işleminiz onaylanmıştır.<br>
                
                     
                <a href='http://ekongre.nutuva.com/ '>http://ekongre.nutuva.com </a> web sitesi üzerinden mail adresi ve şifrenizle giriş yaparak kongre davet mektubunuzu 'Kayıt Durumu Sorgulama' ekranından ulaşabilirsiniz.<br>
                <br>
                Nutuva Organizasyon<br>
                
                <br>
                Bu ileti size Nutuva Organizasyon aracılığıyla gönderilmiştir.

                <hr>

                <h3>You are welcome to Nutuva Abstract Management System.</h3><br>
                Dear ". $user_index["uye_adi"]." ".$user_index["uye_soyadi"].", <br>
                
                Your payment transaction has been approved for the 8th Plant Protection Congress with International Participation. <br>
                
                You can access your congress invitation letter from the 'Registration Status' screen by logging in with your e-mail address and password on the <a href='http://ekongre.nutuva.com/'> http://ekongre.nutuva.com </a> website. <br>

                <br>
                Nutuva Organization<br>
                
                <br>
                This message has been sent to you through Nutuva Organization.",$user_index["uye_mail"]);
            }
            

            if($result){

                $this->goaway("?sayfa=profile_change&admin_user_id=".$_GET["id"]);
            }
            else{
                $this->goaway("?sayfa=profile_change&admin_user_id=".$_GET["id"]);
            }


        }

        public function congress_payment_date_control()
        {
            session_start();
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3){            
            }
            else{
                $this->goaway("");
            }

            $admin_model = $this->model("admin_model");
            $user_model = $this->model("users");
            $abstract_model = $this->model("model_abstract");

            $all_users = $user_model->getAll();
            $abstract_websites = $abstract_model->allcategorywebsites();

            if(date("U") > intval($abstract_websites["registration_time_limit"]))
            {
                for($i=0;$i<count($all_users);$i++)
                {
                    $withdrawal = json_decode($all_users[$i]["withdrawals"]);
                    $registration_type_text="";
                    if($withdrawal[0][3] == 0 && isset($all_users[$i]["withdrawals"]))
                    {
                        $registration_type = explode("/",$withdrawal[0][1]);
                        $registration_type_text = $registration_type[0]."/".$registration_type[1]."/Geç Kayıt";
                        $withdrawal[0][1] = $registration_type_text;

                        $data = json_encode($withdrawal,JSON_UNESCAPED_UNICODE);
                        $result = $user_model->congress_pre_register("uye",$all_users[$i]["uye_mail"],$data);


                    }

                }
            }
            $this->goaway("?sayfa=all_users");

        }

        public function admin_abstract_authorization()
        {
            session_start();
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3){            
            }
            else{
                $this->goaway("");
            }
            
            $admin_model =$this->model("admin_model");
            $abstract_model = $this->model("model_abstract");

            if(isset($_POST["submit"]) && isset($_GET["abstract_id"]))
            {
                
                $abstract_id = $_GET["abstract_id"];
                $update_abstract= $abstract_model->getabstractinfo($abstract_id); 
                if(isset($_POST["referee_ids"]))
                {
                    $referee_ids_arr =[];
                    foreach($_POST["referee_ids"] as $referee_ids)
                    {
                        array_push($referee_ids_arr,$referee_ids);
                    }
                  
                    $referee_ids_db = $admin_model->admin_abstract_authorization_update(json_encode($referee_ids_arr,JSON_UNESCAPED_UNICODE),$abstract_id);
                  
                        
                    if($referee_ids_db)
                    {
                        $main_author = json_decode($update_abstract["main_author"]);
                        $author_mails = [$main_author[3],$update_abstract["alt_contact"]];

                        $referee_mails = [];

                        for($i=0;$i<count($referee_ids_arr);$i++)
                        {
                            $user_index = $admin_model->getuserbyadmin("uye",$referee_ids_arr[$i]);
                            array_push($referee_mails,$user_index["uye_mail"]);
                        }
                        //bilim kurulu üyesi
                        $this->mailer_setup("Bildiri Değerlendirme Hk.","<h3>Nutuva Organizasyon Bildiri Yönetim Sistemine Hoşgeldiniz</h3><br>

                        Kıymetli Bilim Kurulu üyesi ,<br>
                        Uluslararası Katılımlı 8. Bitki Koruma Kongresi kapsamında değerlendirilmek üzere aşağıda detayları verilen
                        bildiriyi Nutuva Bildiri Yönetim Sistemi üzerinden mail adresi ve şifrenizle giriş yaparak değerlendirmenizi rica ederiz.<br>
                        <a href='http://ekongre.nutuva.com/ '>http://ekongre.nutuva.com </a><br><br>


                        <b>Bildiri Başlığı</b>: ".strip_tags($update_abstract["title"])."<br>
                        <b>Bildiri Kategorisi</b>: ".strip_tags($update_abstract["abstract_sub_category"])."<br>
                        <b>Bildiri Türü</b>: ".strip_tags($update_abstract["abstract_type"])."<br>
                        <br>
                        Nutuva Organizasyon<br>
                        
                        <br>
                        Bu ileti size Nutuva Organizasyon aracılığıyla gönderilmiştir.
                        
                        <hr>

                        <h3>You are welcome to Nutuva Abstract Management System.</h3><br>

                        Esteemed Scientific Board Member, <br>
                        There is an abstract that is came to 8th Plant Protection Congress with International Participation
                        We kindly ask you to judge the abstract by logging in with your e-mail address and password via Nutuva Abstract Management System. <br>
                        <a href='http://ekongre.nutuva.com/ '>http://ekongre.nutuva.com </a><br><br>
                      
                   
                        <br>
                        Nutuva Organization<br>
                        
                        <br>
                        This message has been sent to you through Nutuva Organization.",$referee_mails);

                        //yazarlar
                        $this->mailer_setup("Bildiri Değerlendirme Hk.","<h3>Nutuva Organizasyon Bildiri Yönetim Sistemine Hoşgeldiniz</h3><br>

                        
                        Uluslararası Katılımlı 8. Bitki Koruma Kongresine göndermiş olduğunuz aşağıda detayları belirtilen
                        bildiriniz değerlendirilmek üzere bilim kurulu üyesine gönderilmiştir. Değerlendirme süreci ve sonucunu 
                        Nutuva Bildiri Yönetim Sistemi üzerinden takip edebilirsiniz.<br>
                        <a href='http://ekongre.nutuva.com/ '>http://ekongre.nutuva.com </a><br><br>

                        <b>Bildiri No</b>: ".strip_tags($update_abstract["abstract_no"])."<br>
                        <b>Bildiri Başlığı</b>: ".strip_tags($update_abstract["title"])."<br>
                        <b>Bildiri Kategorisi</b>: ".strip_tags($update_abstract["abstract_sub_category"])."<br>
                        <b>Bildiri Türü</b>: ".strip_tags($update_abstract["abstract_type"])."<br>
                        <br>
                        Nutuva Organizasyon<br>
                        
                        <br>
                        Bu ileti size Nutuva Organizasyon aracılığıyla gönderilmiştir.
                        
                        <hr>

                        <h3>You are welcome to Nutuva Abstract Management System.</h3><br>

                        You have sent to the 8th Plant Protection Congress with International Participation.
                        Your paper has been sent to the scientific committee member for judging.
                        You can follow judgement process and outcome on Nutuva Abstract Management System. <br>
                        <a href='http://ekongre.nutuva.com/ '>http://ekongre.nutuva.com </a><br><br>
                      
                   
                        <br>
                        Nutuva Organization<br>
                        
                        <br>
                        This message has been sent to you through Nutuva Organization.",$author_mails);

                        
                        $this->goaway("?sayfa=abstract_authorization&abstract_id=".$abstract_id);
                    }
                    else
                    {
                        $this->goaway("?sayfa=abstract_authorization&abstract_id=".$abstract_id);
                    }
                }
                else
                {
                    $referee_ids_arr =null;
                    $referee_ids_db = $admin_model->admin_abstract_authorization_update($referee_ids_arr,$abstract_id);
                    $this->goaway("?sayfa=abstract_authorization&abstract_id=".$abstract_id);
                  
                }
            }
            else
            {
                $this->goaway("?sayfa=all_abstracts");
            }
        }


        public function abstract_main_author_id_save()
        {
            session_start();
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3){            
            }
            else{
                $this->goaway("");
            }
            $admin_model = $this->model("admin_model");

            if(isset($_POST["main_author_id"]) && isset($_POST["abstract_id"]))
            {
                $result = $admin_model->abstract_main_author_id_save("abstracts",intval($_POST["main_author_id"]),intval($_POST["abstract_id"]));
                if($result)
                {
                    echo 1;
                }
                else
                {
                    echo 0;
                }
            }
            else
            {
                echo 0;
            }
     
        }



        public function admin_abstract_accept()
        {
            session_start();
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3){            
            }
            else{
                $this->goaway("");
            }

            $admin_model =$this->model("admin_model");
            $abstract_model = $this->model("model_abstract");

            if(isset($_GET["abstract_id"])&& isset($_GET["acception"]))
            {
                $abstract_acception = $_GET["acception"];
                $abstract_no = $_GET["abstract_id"];
                $abstract_info= $abstract_model->getabstractinfo($abstract_no); 
                $same_category_type_abstracts = $admin_model->get_all_abstracts_by_category("abstracts",$abstract_info["abstract_category"],$abstract_info["abstract_type"]);
                if($abstract_acception == 1)
                {
                    if($abstract_info["last_abstract_no"] == null || $abstract_info["last_abstract_no"] == "" || intval($abstract_info["last_abstract_no"]) == 0)
                    {
                        $sorgu = $admin_model->admin_abstract_accept("abstracts",$abstract_acception,intval($same_category_type_abstracts["last_abstract_no"])+1,$abstract_no);
                    }

                    else
                    {
                     
                        if($same_category_type_abstracts["abstract_no"] == $abstract_info["abstract_no"])
                        {
                            $sorgu = $admin_model->admin_abstract_accept("abstracts",$abstract_acception,$same_category_type_abstracts["last_abstract_no"],$abstract_no);
                        }
                        else
                        {
                            $sorgu = $admin_model->admin_abstract_accept("abstracts",$abstract_acception,intval($same_category_type_abstracts["last_abstract_no"])+1,$abstract_no);

                        }
                    }
                   
                }
                else
                {
                    $sorgu = $admin_model->admin_abstract_accept("abstracts",$abstract_acception,$abstract_info["last_abstract_no"],$abstract_no);

                }

                if($sorgu)
                {

                    $main_author = json_decode($abstract_info["main_author"])[3];
                    $alt_contact = $abstract_info["alt_contact"];


                    if($abstract_acception > 0)
                    {
                        $this->mailer_setup("Bildiri Değerlendirme Hk.","<h3>Nutuva Organizasyon Bildiri Yönetim Sistemine Hoşgeldiniz</h3><br>

                        
                        Uluslararası Katılımlı 8. Bitki Koruma Kongresine göndermiş olduğunuz aşağıda detayları belirtilen
                        bildirinizin değerlendirme süreci sonuçlanmıştır. Sonucu 
                        Nutuva Bildiri Yönetim Sistemi üzerinden mail adresi ve şifrenizle giriş yaparak görüntüleyebilirsiniz.<br>
                        <a href='http://ekongre.nutuva.com/ '>http://ekongre.nutuva.com </a><br><br>

                        <b>Bildiri No</b>: ".strip_tags($abstract_info["abstract_no"])."<br>
                        <b>Bildiri Başlığı</b>: ".strip_tags($abstract_info["title"])."<br>
                        <b>Bildiri Kategorisi</b>: ".strip_tags($abstract_info["abstract_sub_category"])."<br>
                        <b>Bildiri Türü</b>: ".strip_tags($abstract_info["abstract_type"])."<br>
                        <br>
                        Nutuva Organizasyon<br>
                        
                        <br>
                        Bu ileti size Nutuva Organizasyon aracılığıyla gönderilmiştir.
                        
                              
                        <hr>

                        <h3>You are welcome to Nutuva Abstract Management System.</h3><br>

                        You have sent an abstract to the 8th Plant Protection Congress with International Participation.
                        The judgement process of your abstract has been concluded.
                        You can view the results by logging in with your e-mail address and password on Nutuva Abstract Management System. <br>
                        <a href='http://ekongre.nutuva.com/ '>http://ekongre.nutuva.com </a><br><br>
                      
                   
                        <br>
                        Nutuva Organization<br>
                        
                        <br>
                        This message has been sent to you through Nutuva Organization.",[$main_author,$alt_contact]);
                    }
                    $this->goaway("?sayfa=all_abstracts");
                }
                else{}
            }
            else
            {
                $this->goaway("?sayfa=all_abstracts");
            }
        }


        public function admin_abstract_delete()
        {
           
            session_start();
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3){            
            }
            else{
                $this->goaway("");
            }
    
            $abstract_no = $_GET["abstract_id"]; 
            
            $model = $this->model("admin_model");
    
            $bildiri_sorgu = $model->admin_abstract_delete($abstract_no);
    
            $this->goaway("?sayfa=all_abstracts");
    
        }



        public function admin_scientific_program_save()
        {
            session_start();
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3){            
            }
            else{
                $this->goaway("");
            }

            if(isset($_POST["scientific_program"]))
            {
                $user_model = $this->model("users");
                $admin_model = $this->model("admin_model");
                $abstract_model = $this->model("model_abstract");
                
                if(isset($_POST["scientific_program"]))
                {
                    $scientific_program = $_POST["scientific_program"];
                    $scientific_program_arr = json_decode($_POST["scientific_program"]);

                    $result = $admin_model->admin_scientific_program_save("categories",$scientific_program);

                    if($result)
                    {
                        $all_users = $admin_model->getallusers();
                        $all_users_mails =[];
                        for($i=0;$i<count($all_users);$i++)
                        {
                            array_push($all_users_mails,$all_users[$i]["uye_mail"]);
                        }

                        $all_accepted_abstracts = $abstract_model->getallusersacceptedabstracts();

                        $corresponding_and_alt_cont=[];
                        $accepted_abstracts_users_mails = [];
                        for($a=0;$a<count($all_accepted_abstracts);$a++)
                        {
                            array_push($corresponding_and_alt_cont,json_decode($all_accepted_abstracts[$a]["main_author"])[3]);
                            array_push($corresponding_and_alt_cont,$all_accepted_abstracts[$a]["alt_contact"]);
                            for($i=0;$i<count($all_users);$i++)
                            {
                                if($all_users[$i]["id"] == $all_accepted_abstracts[$a]["register_id"])
                                {
                                    array_push($accepted_abstracts_users_mails,$all_users[$i]["uye_mail"]);
                                }
                            }
                        }
                        
                        /*$manager_mails=[];
                        foreach($scientific_program as $day)
                        {
                            if($day != "tr" && $day != "en")
                            {
                                foreach($scientific_program[$day] as $saloon)
                                {
                                    if($saloon != "tr" && $saloon != "en")
                                    {
                                        foreach($scientific_program[$day][$saloon] as $session)
                                        {
                                            if($scientific_program[$day][$saloon][$session]->{"break"} ==0)
                                            {
                                                $manager_id =$scientific_program[$day][$saloon][$session]->{"manager"};
                                                for($i=0;$i<count($all_users);$i++)
                                                {
                                                    if($all_users[$i]["id"] == $manager_id)
                                                    {
                                                        array_push($manager_mails,$all_users[$i]["id"]);
                                                    }
                                                }
                                                continue;
                                            }
                                        }
                                    }
                                }
                            }
                        }*/


                        //kullanılacak bölüm

                        /*$this->mailer_setup("Bilimsel Program Hk.","<h3>Nutuva Organizasyon Bildiri Yönetim Sistemine Hoşgeldiniz</h3><br>

                            
                            Uluslararası Katılımlı 8. Bitki Koruma Kongresi Bilimsel Programı oluşturulmuştur. Bilimsel Programı 
                            Nutuva Bildiri Yönetim Sistemi üzerinden mail adresi ve şifrenizle giriş yaparak görüntüleyebilirsiniz.<br>
                            <a href='http://ekongre.nutuva.com/ '>http://ekongre.nutuva.com </a><br><br>

                            <br>
                            Nutuva Organizasyon<br>
                            
                            <br>
                            Bu ileti size Nutuva Organizasyon aracılığıyla gönderilmiştir.
                            
                                
                            <hr>

                            <h3>You are welcome to Nutuva Abstract Management System.</h3><br>

                            Abstract claim process has been finished for 8th Plant Protection Congress with International Participation. 
                            You can view the scientific program by logging in with your e-mail address and password on Nutuva Abstract Management System. <br>
                            <a href='http://ekongre.nutuva.com/ '>http://ekongre.nutuva.com </a><br><br>
                        
                    
                            <br>
                            Nutuva Organization<br>
                            
                            <br>
                            This message has been sent to you through Nutuva Organization.",$all_users_mails);


                            $this->mailer_setup("Bildiri Özeti Sunum Hk.","<h3>Nutuva Organizasyon Bildiri Yönetim Sistemine Hoşgeldiniz</h3><br>

                            
                            Uluslararası Katılımlı 8. Bitki Koruma Kongresi Bilimsel Programı oluşturulmuştur.
                            Bilimsel Programda bulunan bildirilerinizi \"Oturum Bilgileri\" sayfasından görüntüleyebilirsiniz. 
                            Bildiri özetlerinizin sunumlarını 16.08.2021 tarihine kadar \"Online İşlemler\" Sisteminde bulunan \"Bildirilerim\" 
                            sayfasında \"Sunum Yükle\" butonu ile PDF formatında yüklemenizi önemle rica ederiz.<br>
                            <a href='http://ekongre.nutuva.com/ '>http://ekongre.nutuva.com </a><br><br>

                            <br>
                            Nutuva Organizasyon<br>
                            
                            <br>
                            Bu ileti size Nutuva Organizasyon aracılığıyla gönderilmiştir.
                            
                                
                            <hr>

                            <h3>You are welcome to Nutuva Abstract Management System.</h3><br>

                            Abstract claim process has been finished for 8th Plant Protection Congress with International Participation. 
                            You can view your abstract informations on \"Session Infos\" page. We have pleased you to upload your presentations on \"My Abstracts\" page in the \"Online Processes\" System until 16.08.2021.
                            <a href='http://ekongre.nutuva.com/ '>http://ekongre.nutuva.com </a><br><br>
                        
                    
                            <br>
                            Nutuva Organization<br>
                            
                            <br>
                            This message has been sent to you through Nutuva Organization.",$accepted_abstracts_users_mails);
                    */
                    }
                    else
                    {

                    }
                }
                $this->goaway("?sayfa=scientific_program");


            }
            else
            {
                $this->goaway("?sayfa=scientific_program");
            }


        }
        

        public function admin_abstract_main_author_mail_compare()
        {
            session_start();
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3){            
            }
            else{
                $this->goaway("");
            }
            
            $abstract_model= $this->model("model_abstract");
            $admin_model= $this->model("admin_model");
            $user_model= $this->model("users");


            $all_abstracts = $abstract_model->getallusersabstracts();

            for($i=0;$i<count($all_abstracts);$i++)
            {
                $main_author_mail = json_decode($all_abstracts[$i]["main_author"])[3];
                $uye_info = $admin_model->getwithone("uye","uye_mail",$main_author_mail);
                if($uye_info)
                {
                    $result = $admin_model->admin_abstract_main_author_mail_compare_save("abstracts",$uye_info[0]["id"],$all_abstracts[$i]["abstract_no"]);
                    if($result)
                    {
                        continue;
                    }
                }
            }

            $this->goaway("?sayfa=all_abstracts");
            
        }

        public function admin_presentation_archiver()
        {
            session_start();
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3){            
            }
            else{
                $this->goaway("");
            }

            $abstract_model = $this->model("model_abstract");
            $admin_model = $this->model("admin_model");
            $all_abstracts = $abstract_model->getallusersabstracts();



            // Get real path for our folder
            $rootPath = realpath("view/abstracts/presentations/Bitki Koruma Kongresi/");

            // Initialize archive object
            $zip = new ZipArchive();
            
            $zip->open('view/abstracts/presentation_zip_archive/file.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);


            if(isset($_GET["get_presentations"]))
            {
                if($_GET["get_presentations"] == "all_presentations")
                {
                                

                    // Create recursive directory iterator
                    /** @var SplFileInfo[] $files */
                    $files = new RecursiveIteratorIterator(
                        new RecursiveDirectoryIterator($rootPath),
                        RecursiveIteratorIterator::LEAVES_ONLY
                    );


                    

                    foreach ($files as $name => $file)
                    {

                        // Skip directories (they would be added automatically)
                        if (!$file->isDir())
                        {
                            // Get real and relative path for current file
                            $filePath = $file->getRealPath();

                            $relativePath = substr($filePath, strlen($rootPath) + 1);
                            
                            $relativePath_arr = explode("/",$relativePath);

                            for($i=0; $i<count($all_abstracts);$i++)
                            {
                                //Çoklu kongreler için düzenlenecek
                                  
                                $abstract_category_char = mb_strtoupper($all_abstracts[$i]["abstract_category"][0]);
                                if(strpos($all_abstracts[$i]["abstract_type"],"-"))
                                {
                                    $abstract_type_char = mb_strtoupper($all_abstracts[$i]["abstract_type"][strpos($all_abstracts[$i]["abstract_type"],"-")+1]);
                                }
                                else
                                {
                                    $abstract_type_char = mb_strtoupper($all_abstracts[$i]["abstract_type"][0]);
                                }
                                $last_abstract_no = intval($all_abstracts[$i]["last_abstract_no"]);
                                if("Bitki Koruma Kongresi" == $all_abstracts[$i]["abstract_site"] && $abstract_category_char.$abstract_type_char.$all_abstracts[$i]["last_abstract_no"] == $relativePath_arr[0])
                                {
                                    $zip->addFile($filePath, $relativePath);
                                }
                            }
                        }
                    }
                }
                else
                {
                    // Create recursive directory iterator
                    /** @var SplFileInfo[] $files */
                    $files = new RecursiveIteratorIterator(
                        new RecursiveDirectoryIterator($rootPath),
                        RecursiveIteratorIterator::LEAVES_ONLY
                    );
                    $abstract_websites = $abstract_model->allcategorywebsites();

                    $scientific_program = json_decode($abstract_websites[0]["scientific_program"]);

                    $day = json_decode($_GET["get_presentations"])[0];
                    $saloon = json_decode($_GET["get_presentations"])[1]; 
                    $session = json_decode($_GET["get_presentations"])[2]; 


                    
                    foreach ($files as $name => $file)
                    {

                        // Skip directories (they would be added automatically)
                        if (!$file->isDir())
                        {
                            // Get real and relative path for current file
                            $filePath = $file->getRealPath();

                            $relativePath = substr($filePath, strlen($rootPath) + 1);
                            
                            $relativePath_arr = explode("/",$relativePath);
                            for($i=0;$i<count($scientific_program->{$day}->{$saloon}->{$session}->{"abstracts"});$i++)
                            {
                                $abstract_info = $abstract_model->getabstractinfo($scientific_program->{$day}->{$saloon}->{$session}->{"abstracts"}[$i][0]);
        
        
                                $abstract_category_char = mb_strtoupper($abstract_info["abstract_category"][0]);
                                if(strpos($abstract_info["abstract_type"],"-"))
                                {
                                    $abstract_type_char = mb_strtoupper($abstract_info["abstract_type"][strpos($abstract_info["abstract_type"],"-")+1]);
                                }
                                else
                                {
                                    $abstract_type_char = mb_strtoupper($abstract_info["abstract_type"][0]);
                                }
                                $last_abstract_no = intval($abstract_info["last_abstract_no"]);
        
        
                                if($abstract_info)
                                {
                                    $presentation_files = json_decode($abstract_info["presentation_files"]);
                                    for($a=0;$a<count($presentation_files);$a++)
                                    {
                                        if($relativePath_arr[1] == $presentation_files[$a])
                                        {
                                            $zip->addFile($filePath, $relativePath);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            // Zip archive will be created only after closing object
            $zip->close();


            $url = "view/abstracts/presentation_zip_archive/file.zip";

            //Define header information
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($url).'"');
            header('Content-Length: ' . filesize($url));
            header('Pragma: public');

            //Clear system output buffer
            flush();

            //Read the size of the file
            readfile($url,true);
            exit;  
        }

       

        public function virtual_congress_button_info_save()
        {
            session_start();
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3){            
            }
            else{
                $this->goaway("");
            }

            $admin_model = $this->model("admin_model");
           
            if(isset($_POST["data"]))
            {
                if(is_object(json_decode($_POST["data"])))
                {
                    $result = $admin_model->virtual_congress_button_info_save($_POST["data"],4);
                    if($result)
                    {
                        echo 1;
                    }
                }
                else
                {
                    echo 0;
                }
            }
            else
            {
                echo 0;
            }
        }


        public function admin_accept_users_bill_info()
        {
            session_start();
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3){            
            }
            else{
                $this->goaway("");
            }
            $admin_model = $this->model("admin_model");

            if(isset($_POST["state"]) && isset($_POST["id"]) )
            {
                $result = $admin_model->admin_accept_users_bill_info($_POST["state"],$_POST["id"]);
                if($result)
                {
                    echo 1;
                }
                else
                {
                    echo 0;
                }
            }
            else
            {
                echo 0;
            }
        }

        public function admin_accept_users_cargo_info()
        {
            session_start();
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3){            
            }
            else{
                $this->goaway("");
            }
            $admin_model = $this->model("admin_model");

            if(isset($_POST["state"]) && isset($_POST["id"]) )
            {
                $result = $admin_model->admin_accept_users_cargo_info($_POST["state"],$_POST["id"]);
                if($result)
                {
                    echo 1;
                }
                else
                {
                    echo 0;
                }
            }
            else
            {
                echo 0;
            }
        }

        
        //////////MAILER SYSTEM////////////////

        public function mailer_setup($subject,$message,$user_mail)
        {
           
            $headers = "From: fikretakdis <fikret@nutuva.com>\r\n";
    
            $headers .= "Reply-To: fikretakdis <fikret@nutuva.com>\r\n";
    
            $headers .= "Content-type: text/html\r\n";
    
        
    
    try {


           
            $name = $subject;
            $subj = $subject;
            $msg =  '
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
            </head>
            <body>
                '.$message.'
            </body>
            </html>';
                
            
    
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth = true; 
            $mail->SMTPSecure = 'tls';
            $mail->Host = 'ssl://n3plcpnl0084.prod.ams3.secureserver.net';
            $mail->Port = 465;  
            $mail->Username = 'bilgi@asmguncesi.com';
            $mail->Password = 'fk1441';   
    
            $mail->FromName="Nutuva Organizasyon Bildiri Sistemi";
            $mail->IsHTML(true);
            $mail->SetLanguage("tr", "PHPMailer/language");
            $mail->CharSet  ="utf-8";
            $mail->From='bilgi@asmguncesi.com';
        
            $mail->Sender='bilgi@asmguncesi.com';
            
            $mail->Subject = $subj;
            $mail->Body = $msg;
            if(is_array($user_mail))
            {
                for($i=0;$i<count($user_mail);$i++)
                {
                    $mail->addBCC($user_mail[$i]);
                }
            }
            else
            {
                $mail->addBCC($user_mail);
            }
            $mail->Send();
                    
        
    
            } 
    
            catch (Exception $e) {
         
            }
            

        }


        public function admin_auto_mailer()
        {

            session_start();
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3){            
            }
            else{
                $this->goaway("");
            }
            $admin_model = $this->model("admin_model");
            //The mail goes to all subscribers at a time
            if(isset($_GET["mail_type"]))
            {
                if($_GET["mail_type"] == "list_members" && isset($_POST["users"]) && isset($_POST["contant"]))
                {
                    $all_users = json_decode($_POST["users"]);
                    $this->mailer_setup("Nutuva Organizasyon Bilgilendirme",$_POST["contant"],$all_users);
                    $this->goaway("?sayfa=all_users");
                }
                

            }
            $this->goaway("?sayfa=all_users");

        }

        public function admin_manuel_mailer()
        {
            session_start();
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 3){            
            }
            else{
                $this->goaway("");
            }

            //The mail goes to one person at a time
            $admin_model = $this->model("admin_model");
            if(isset($_GET["mail_type"]) && isset($_POST["user_mail"]) && isset($_POST["contant"]))
            {
                $user_mail = $_POST["user_mail"];

                if($_GET["mail_type"] == "price")
                {
                    $this->mailer_setup("Nutuva Organizasyon Bilgilendirme",$_POST["contant"],$user_mail);
                }
                $this->goaway("?sayfa=all_users");
            }

            $this->goaway("?sayfa=all_users");
        }


    }

?>
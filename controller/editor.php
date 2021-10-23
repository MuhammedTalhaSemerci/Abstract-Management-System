<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'controller/PHPMailer/src/Exception.php';
require 'controller/PHPMailer/src/PHPMailer.php';
require 'controller/PHPMailer/src/SMTP.php';

    class editor extends Controller
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

            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 1){            
            }
            else{
                $this->goaway("");
            }
    
                            
            $user_model = $this->model("users");
            $editor_model = $this->model("editor_model");
            $abstract_model = $this->model("model_abstract");
            $language = $this->language();
           
            $all_abstracts= $abstract_model->getallabstracts($_SESSION["user"]["id"]); 
            $all_abstracts_main_author= $abstract_model->getallabstracts_main_author($_SESSION["user"]["id"]); 
            $all_users = $editor_model->getallusers();

            if(isset($_GET["editor_user_id"]))
            {
                $user_index = $editor_model->getuserbyeditor("uye",$_GET["editor_user_id"]);
                $primer_user = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
            }

            else
            {
                $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
                $primer_user = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);;
                $register_id = $user_index["id"];
            }

            //categories
            $abstract_websites = $abstract_model->allcategorywebsites();
        
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
                    if($referee_all_abstracts[$i]["referee_ids"] )
                    {
                        $referee_ids = json_decode($referee_all_abstracts[$i]["referee_ids"]);
                        for($a=0;$a<count($referee_ids);$a++)
                        {
                            if($referee_ids[$a] == $_SESSION["user"]["id"])
                            {
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

            $editor_all_abstracts_arr=[];
            $editor_all_abstracts = $abstract_model->getallusersabstracts();
            $editor_all_abstracts_arr = $this->all_abstracts($editor_all_abstracts);

        


            $this->view(
            "editor/index",
                [
                    "all_users"=>$all_users,
                    "abstract_websites"=>$abstract_websites,
                    "all_abstracts"=>$all_abstracts,
                    "all_abstracts_main_author"=>$all_abstracts_main_author,
                    "update_abstract"=>$update_abstract,
                    "uye_dil"=>strval($primer_user["uye_dil"]),
                    "language" => $language,
                    "user_name"=>$_SESSION["user"]["uye_adi"],
                    "user_index"=>$user_index,
                    "primer_user"=>$primer_user,
                    "editor_all_abstracts"=>$editor_all_abstracts_arr,
                    "referee_users"=>$referee_users,
                    "referee_all_abstracts"=>$referee_all_abstracts_arr,
                    "scientific_program_all_abstracts"=>$editor_all_abstracts_arr,
                ]
            );


            $this->view("out_of_indexes/socket_notifications",["abstract_websites"=>$abstract_websites[0],"user_index"=>$primer_user]);

        }

        public function search()
        {
            session_start();

            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 1){            
            }
            else{
                $this->goaway("");
            }
            
          
            $abstract_model = $this->model("model_abstract");
            $editor_model = $this->model("editor_model");
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
        
                                $sorgu = $editor_model->getallusers();
        
                                break;

                            case "withdrawal_none":

                                $sorgu_db = $editor_model->getallusers();
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
                        
                        
                            case 1:
        
                                $sorgu = $editor_model->getwithone("uye",$value[1],$value[2]);
        
        
                                break;
        
                            case 2:
                            
        
                                $sorgu = $editor_model->getwithtwo("uye",$value[1],$value[2],$value[3],$value[4]);
        
                                break;
                        
                            case 3:
                            
        
                                $sorgu = $editor_model->getwiththree("uye",$value[1],$value[2],$value[3],$value[4],$value[5],$value[6]);
                                break;
        
                            default:
                                break;
                        }
                    } 
                    catch (\Throwable $th) 
                    {
                        echo $th;
                    }
                
                    $this->view("editor/index",["all_users"=>$sorgu,"user_name"=>$_SESSION["user"]["uye_adi"],"primer_user"=>$primer_user]);

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
                                $editor_all_abstracts = $abstract_model->getallusersabstracts();
                                $sorgu = $this->all_abstracts($editor_all_abstracts);
                               
        
                                break;
    
                            case "withdrawal_none":


                                $sorgu=[];
                                $editor_all_abstracts = $abstract_model->getallusersabstracts();
                    
                                for($i=0;$i<count($editor_all_abstracts);$i++)
                                {
                                    $user_db = $admin_model->getuserbyadmin("uye",$editor_all_abstracts[$i]["register_id"]);
                                    $withdrawal = json_decode($user_db["withdrawals"]);
                                    if($withdrawal[0][3] == $value[1] || ($value[1] == 0 && $withdrawal == null))
                                    {
                                        array_push($sorgu,$this->all_abstracts([$editor_all_abstracts[$i]])[0]);
                                    }
                                }
    
                                break;
                            

                            case "acception_status":


                                $sorgu=[];
                                $editor_all_abstracts = $abstract_model->getallusersabstracts();
                    
                                for($i=0;$i<count($editor_all_abstracts);$i++)
                                {
                                    
                                    if($editor_all_abstracts[$i]["accepted"] == $value[1])
                                    {
                                        array_push($sorgu,$this->all_abstracts([$editor_all_abstracts[$i]])[0]);
                                    }
                                }
    
                                break;


                            case "abstract_type":


                                $sorgu=[];
                                $editor_all_abstracts = $abstract_model->getallusersabstracts();
                    
                                for($i=0;$i<count($editor_all_abstracts);$i++)
                                {
                                    
                                    if($editor_all_abstracts[$i]["abstract_type"] == $value[1])
                                    {
                                        array_push($sorgu,$this->all_abstracts([$editor_all_abstracts[$i]])[0]);
                                    }
                                }
    
                                break;

                           
                            case 1:
        
                                $sorgu = $editor_model->getwithone("uye",$value[1],$value[2]);
        
        
                                break;
        
                            case 2:
                    
        
                                $sorgu = $editor_model->getwithtwo("uye",$value[1],$value[2],$value[3],$value[4]);
        
                                break;
                        
                            case 3:
                            
        
                                $sorgu = $editor_model->getwiththree("uye",$value[1],$value[2],$value[3],$value[4],$value[5],$value[6]);
                                break;
        
                            default:
                                break;
                        }
                    } 
                    
                    catch (\Throwable $th) 
                    {
                        echo $th;
                    }
                 
                    $this->view("editor/index",["editor_all_abstracts"=>$sorgu,"user_name"=>$_SESSION["user"]["uye_adi"],"primer_user"=>$primer_user]);
    
                }


            }
            else{
                $primer_user = null;
                $sorgu = null;
                $this->goaway("?sayfa=all_abstracts");

            }

    



        }


        public function editor_authority_change()
        {

        session_start();

            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 1 ){            
            }
            else{
                $this->goaway("");
            }

            $editor_model = $this->model("editor_model");
            if(isset($_GET["id"]) && isset($_GET["uye_yetki"]))
            {
                $sorgu = $editor_model->editor_authority_change("uye",$_GET["uye_yetki"],$_GET["id"]);
        
                if($sorgu)
                {
                    $user_index = $editor_model->getuserbyeditor("uye",$_GET["id"]);
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
                        Dear ". $User_index["uye_adi"]." ".$user_index["uye_soyadi"].", <br>
                        
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
                    $this->goaway("?sayfa=profile_change&editor_user_id=".$_GET["id"]."&state=authority_true");
                }
                else
                {
                    $this->goaway("?sayfa=profile_change&editor_user_id=".$_GET["id"]."&state=authority_false");
                }
                 
            }
            else{
                $this->goaway("?sayfa=all_users&value=getall");
            }
            
          

        }

        public function editor_user_update(){

            session_start();
    
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 1){            
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
            

            $editor_model = $this->model("editor_model");
            $user_index = $editor_model->editor_user_update($_GET["id"],$uye_adi,$uye_soyadi,$uye_tel,$uye_sehir,$uye_unvan,$uye_uzmanlik,$uye_kurum,$uye_turu,$referee_arr);
    
            if($user_index){
                $this->goaway("?sayfa=profile_change&editor_user_id=".$_GET["id"]."&status=true");
            }
            else{
                $this->goaway("?sayfa=profile_change&editor_user_id=".$_GET["id"]."&status=false");
            }
        }

        public function editor_abstract_authorization()
        {
            session_start();
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 1){            
            }
            else{
                $this->goaway("");
            }
            
            $editor_model =$this->model("editor_model");
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
                  
                    $referee_ids_db = $editor_model->editor_abstract_authorization_update(json_encode($referee_ids_arr,JSON_UNESCAPED_UNICODE),$abstract_id);
                  
                        
                    if($referee_ids_db)
                    {
                        $main_author = json_decode($update_abstract["main_author"]);
                        $author_mails = [$main_author[3],$update_abstract["alt_contact"]];

                        $referee_mails = [];

                        for($i=0;$i<count($referee_ids_arr);$i++)
                        {
                            $user_index = $editor_model->getuserbyeditor("uye",$referee_ids_arr[$i]);
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
                    $referee_ids_db = $editor_model->editor_abstract_authorization_update(json_encode($referee_ids_arr,JSON_UNESCAPED_UNICODE),$abstract_id);
                    $this->goaway("?sayfa=abstract_authorization&abstract_id=".$abstract_id);
                  
                }
            }
            else
            {
                $this->goaway("?sayfa=all_abstracts");
            }
        }

   

        public function editor_abstract_accept()
        {
            session_start();
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 1){            
            }
            else{
                $this->goaway("");
            }

            $editor_model =$this->model("editor_model");
            $abstract_model = $this->model("model_abstract");

            if(isset($_GET["abstract_id"])&& isset($_GET["acception"]))
            {
                $abstract_acception = $_GET["acception"];
                $abstract_no = $_GET["abstract_id"];
                $abstract_info= $abstract_model->getabstractinfo($abstract_no); 
                $same_category_type_abstracts = $editor_model->get_all_abstracts_by_category("abstracts",$abstract_info["abstract_category"],$abstract_info["abstract_type"]);
                if($abstract_acception == 1)
                {
                    if($abstract_info["last_abstract_no"] == null || $abstract_info["last_abstract_no"] == "" || intval($abstract_info["last_abstract_no"]) == 0)
                    {
                        $sorgu = $editor_model->editor_abstract_accept("abstracts",$abstract_acception,intval($same_category_type_abstracts["last_abstract_no"])+1,$abstract_no);
                    }
                    else
                    {
                        if($same_category_type_abstracts["abstract_no"] == $abstract_info["abstract_no"])
                        {
                            $sorgu = $editor_model->editor_abstract_accept("abstracts",$abstract_acception,$same_category_type_abstracts["last_abstract_no"],$abstract_no);
                        }
                        else
                        {
                            $sorgu = $editor_model->editor_abstract_accept("abstracts",$abstract_acception,intval($same_category_type_abstracts["last_abstract_no"])+1,$abstract_no);

                        }
                    }
                   
                }
                else
                {
                    $sorgu = $editor_model->editor_abstract_accept("abstracts",$abstract_acception,$abstract_info["last_abstract_no"],$abstract_no);

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

        public function editor_abstract_delete()
        {
            session_start();
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 1){            
            }
            else{
                $this->goaway("");
            }
    
            $abstract_no = $_GET["abstract_id"]; 
            
            $model = $this->model("editor_model");
    
            $bildiri_sorgu = $model->editor_abstract_delete($abstract_no);
    
            $this->goaway("?sayfa=all_abstracts");
        }

        public function editor_presentation_archiver()
        {
            
            session_start();
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 1){            
            }
            else{
                $this->goaway("");
            }
    

            $abstract_model = $this->model("model_abstract");
            $editor_model = $this->model("editor_model");
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



        public function editor_auto_mailer()
        {

            session_start();
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 1){            
            }
            else{
                $this->goaway("");
            }
            $editor_model = $this->model("editor_model");
            //The mail goes to all subscribers at a time
            if(isset($_GET["mail_type"]))
            {
                //subscribers
                if($_GET["mail_type"] == "list_members" && isset($_POST["users"]) && isset($_POST["contant"]))
                {
                    $all_users = json_decode($_POST["users"]);
                    for($i=0;$i<count($all_users);$i++)
                    {
                    $this->mailer_setup("Nutuva Organizasyon Bilgilendirme",$_POST["contant"],$all_users[$i]);
                    }
                    $this->goaway("?sayfa=all_users");
                }

                //abstracter
                /*
                else if($_GET["mail_type"] == "abstract_remember" && isset($_POST["users"]))
                {
                    $all_users = json_decode($_POST["users"]);
                    for($i=0;$i<count($all_users);$i++)
                    {
                    $this->mailer_setup("Nutuva Organizasyon Bilgilendirme","<p>Bitki Koruma Kongresi bildirinizin.</p>",$all_users[$i]);
                    }
                    $this->goaway("?sayfa=all_users");
                }
                
               */

            }
            $this->goaway("?sayfa=all_users");

        }

        public function editor_manuel_mailer()
        {
            session_start();
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 1){            
            }
            else{
                $this->goaway("");
            }

            //The mail goes to one person at a time
            $editor_model = $this->model("editor_model");
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
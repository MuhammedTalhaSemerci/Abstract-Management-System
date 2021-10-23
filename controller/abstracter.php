<?php
       
function turkce($k)
{
    return iconv('UTF-8','ASCII//TRANSLIT',$k);
}


require(__DIR__.'/fpdf183/fpdf.php'); 
require(__DIR__.'/tfpdf/tfpdf.php'); 



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'controller/PHPMailer/src/Exception.php';
require 'controller/PHPMailer/src/PHPMailer.php';
require 'controller/PHPMailer/src/SMTP.php';


class abstracter extends Controller {

    public function striptext_html($html) {
    
        $html = str_get_html($html)->plaintext;
        
        return $html;
    }
    
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

        if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 0){            
        }
        else{
            $this->goaway("");
        }

                        
      
        $user_model = $this->model("users");
        $model = $this->model("model_abstract");
       

        $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
        $register_id = $user_index["id"];

        $language = $this->language();
        $abstracter_language = $language[$user_index["uye_dil"]]["abstracter_language"];
        //categories
          //categories
          $congress_name = $_POST["congress"] ?? $_GET["congress"] ?? "";
          if($congress_name != "")
          {
              $abstract_websites = $abstract_model->onecategorywebsite($congress_name);
          }
          else
          {
              $abstract_websites = $abstract_model->allcategorywebsites();
          }
          
       

        $all_abstracts= $model->getallabstracts($_SESSION["user"]["id"]); 
        $all_abstracts_main_author= $model->getallabstracts_main_author($_SESSION["user"]["id"]); 
        $all_users = $user_model->getAll();
   

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
            $language = $language[$user_index["uye_dil"]][$_GET["sayfa"]];
        }
        else
        {
        }
    

        
        if(isset($_GET["abstract_id"]))
        {
            $abstract_no= intval($_GET["abstract_id"]);
            
            $abstract_by_id = $model->getabstractinfo($abstract_no);

            if(intval($abstract_by_id["register_id"]) == intval($register_id))
            {
                if($abstract_by_id["referee_ids"] && is_array(json_decode($abstract_by_id["referee_ids"])))
                {
                    if(intval($abstract_by_id["accepted"]) == 3)
                    {
                        
                    }
                    else
                    {
                        $this->goaway("?sayfa=my_abstracts");
                    }
                }
                else
                {
                }
            }
            
            else
            {
                $this->goaway("?sayfa=my_abstracts");
            }

            
            $update_abstract= $model->getabstractinfo($abstract_no);  
    
        }
        else{
            $update_abstract=null;  
        }
        if(isset($_GET["abstract_presentation_id"]) && isset($_GET["sayfa"]) && $_GET["sayfa"] == "abstract_presentations")
        {
            $update_abstract= $model->getabstractinfo($_GET["abstract_presentation_id"]);
            if((intval($update_abstract["register_id"]) == intval($register_id) && intval($update_abstract["accepted"]) == 1) || 
            (intval($update_abstract["main_author_id"]) == intval($register_id) && intval($update_abstract["accepted"]) == 1))
            {}
            else
            {
                $this->goaway("?sayfa=my_abstracts");
            }  
        }

        
        $scientific_program_all_abstracts_arr=[];
        $scientific_program_all_abstracts = $model->getallusersabstracts();


        $scientific_program_all_abstracts_arr = $this->all_abstracts($scientific_program_all_abstracts);
        


    

        $this->view("abstracts/index",[
            "abstract_websites"=>$abstract_websites,
            "all_abstracts"=>$all_abstracts,
            "all_abstracts_main_author"=>$all_abstracts_main_author,
            "update_abstract"=>$update_abstract,
            "user_name"=>$_SESSION["user"]["uye_adi"],
            "all_users"=>$all_users,
            "user_index"=>$user_index,
            'primer_user'=>$_SESSION["user"],
            "uye_dil"=>strval($user_index["uye_dil"]),
            "language"=>$language,
            "abstracter_language"=>$abstracter_language,
            "scientific_program_all_abstracts"=>$scientific_program_all_abstracts_arr,
        ]);

        $this->view("out_of_indexes/socket_notifications",["abstract_websites"=>$abstract_websites[0],"user_index"=>$user_index]);


    }

    public function abstract_viewer(){

        session_start();

        
         $model = $this->model("model_abstract");
         if(isset($_GET["abstract_id"]))
         {
            $abstract_no= $_GET["abstract_id"];
         }
         else
         {
            $this->goaway("");
         }

        $abstract_viewer= $model->getabstractinfo($abstract_no);  

        if((isset($_SESSION["user"]) && $abstract_viewer["register_id"] == $_SESSION["user"]["id"]) || intval($_SESSION["user"]["uye_yetki"])== 3 || intval($_SESSION["user"]["uye_yetki"])== 1)
        {            
        }
        else{
            if(intval($_SESSION["user"]["uye_yetki"])== 2 && $abstract_viewer["referee_ids"])
            {
                $referee_ids = json_decode($abstract_viewer["referee_ids"]);
                $cakisma = 0;
                for($i=0;$i<count($referee_ids);$i++)
                {
                    if($_SESSION["user"]["id"] == $referee_ids[$i])
                    {
                        $cakisma=1;
                        break;
                    }
                    else 
                    {
                        continue;
                    }
                }
                if($cakisma ==1)
                {}
                else
                {
                    $this->goaway("");
                }
            }
            else
            {
                $this->goaway("");
            }
        }
        $language = [];
        if($abstract_viewer["abstract_language"] == "turkish-english")
        {
            $language = $this->language()["tr"]["abstract_viewer"];
        }
        else if($abstract_viewer["abstract_language"] == "english")
        {
            $language = $this->language()["en"]["abstract_viewer"];
        }

        $this->view("abstracts/abstract_viewer",["abstract_viewer"=>$abstract_viewer,'user_index'=>$_SESSION["user"],"language"=>$language]);
    }


    public function abstract_edit_request_viewer(){

        session_start();

        
         $model = $this->model("model_abstract");
         $user_model = $this->model("users");
         if(isset($_GET["abstract_id"]) )
         {
            $abstract_no= $_GET["abstract_id"];

            $abstract_viewer= $model->getabstractinfo($abstract_no); 
            if($abstract_viewer)
            {}
            else
            {
                $this->goaway("");
            }
         }
         else
         {
            $this->goaway("");
         }

     

        if((isset($_SESSION["user"]) && $_SESSION["user"]["id"] == $abstract_viewer["register_id"] && intval($abstract_viewer["accepted"]) == 3 ) || intval($_SESSION["user"]["uye_yetki"])== 3 || intval($_SESSION["user"]["uye_yetki"])== 1)
        {         
            if($_SESSION["user"]["uye_yetki"] == 0)
            {
                $uye_yetki = 0; 
            }
            else
            {
                $uye_yetki = 1; 
            }  
        }
        else{
            if(intval($_SESSION["user"]["uye_yetki"])== 2 && $abstract_viewer["referee_ids"])
            {
                $referee_ids = json_decode($abstract_viewer["referee_ids"]);
                $cakisma = 0;
                for($i=0;$i<count($referee_ids);$i++)
                {
                    if($_SESSION["user"]["id"] == $referee_ids[$i])
                    {
                        $cakisma=1;
                        break;
                    }
                    else
                    {
                        continue;
                    }
                }
                if($cakisma ==1)
                {$uye_yetki = 1;}
                else
                {
                    $this->goaway("");
                }
            }
            else
            {
                $this->goaway("");
            }
        }

        $referee_ids = json_decode($abstract_viewer["referee_ids"]);
        if(isset($_GET["referee_id"]) )
        {
            $referee_id = $_GET["referee_id"];
            $cakisma = 0;

            for($i=0;$i<count($referee_ids);$i++)
            {
                if($referee_ids[$i] == $referee_id)
                {
                    $cakisma =1;
                    break;
                }
            
            }
            if($cakisma == 1)
            {}
            else
            {
                $this->goaway("");
            }

        }
        else
        {
            $referee_id = $_SESSION["user"]["id"];
            for($i=0;$i<count($referee_ids);$i++)
            {
                if($referee_ids[$i] == $referee_id)
                {
                    $cakisma =1;
                    break;
                }
            
            }
            if($cakisma == 1)
            {}
            else
            {
                $this->goaway("");
            }
        }
        $edit_requests = json_decode($abstract_viewer["edit_requests"]);
        $abstract_viewer["edit_requests"] = "";
        $abstract_viewer["edit_request_type"] = 0;
        $abstract_viewer["edit_request_type1"] = 0;
        for($i=0;$i<count($edit_requests);$i++)
        {
            if($edit_requests[$i][0] == $referee_id)
            {
                $abstract_viewer["edit_requests"] = json_encode($edit_requests[$i][1],JSON_UNESCAPED_UNICODE);
                $abstract_viewer["edit_contant_turkish"] = json_encode($edit_requests[$i][3],JSON_UNESCAPED_UNICODE);
                $abstract_viewer["edit_contant_english"] = json_encode($edit_requests[$i][4],JSON_UNESCAPED_UNICODE);

                if($edit_requests[$i][2] != null)
                {
                    $abstract_viewer["edit_request_type"] = intval($edit_requests[$i][2]);
                }
            }
          
          
        }

        $referee_comments = json_decode($abstract_viewer["referee_comments"]);
        $abstract_viewer["referee_comments"] = "";
        for($i=0;$i<count($referee_comments);$i++)
        {
            if($referee_comments[$i][0] == $referee_id)
            {
                $abstract_viewer["referee_comments"] = $referee_comments[$i][1];
                if($referee_comments[$i][2] != null)
                {
                    $abstract_viewer["edit_request_type1"] = intval($referee_comments[$i][2]);
                }
            }
           
        }
        $referee_info = $user_model->getuserbyid("uye",$referee_id);

        $this->view("abstracts/abstract_edit_request_viewer",["abstract_viewer"=>$abstract_viewer,'user_index'=>$_SESSION["user"],"uye_yetki"=>$uye_yetki,"referee_info"=>$referee_info]);
    }
    

    public function save()
    {
        session_start();

        $user_model = $this->model("users");
        if(isset($_POST["abstract_upload"]) && isset($_SESSION["user"]))
        {
            
            $abstract_site      = $_POST["abstract_website"];
            $abstract_category  = $_POST["abstract_category"];
            $abstract_sub_category  = $_POST["abstract_sub_category"];
        
            $abstract_type      = $_POST["abstract_type"];
            $abstract_language  = $_POST["abstract_language"];
            $title              = $_POST["title"];
            $contant            = $_POST["contant"];
            $keywords           = $_POST["keywords"];



            if(isset($_POST["alt_contact"])){
                $alt_contact = $_POST["alt_contact"];
            }

            else{
                $alt_contact= null;
            }



            if(isset($_POST["other_author"])){
                $other_author = $_POST["other_author"];
            }

            else{
                $other_author = null;
            }




            if(isset($_POST["title_english"])){
                $title_english = $_POST["title_english"];
            }

            else{
                $title_english = null;
            }



            if(isset($_POST["contant_english"])){
                $contant_english = $_POST["contant_english"];
            }

            else{
                $contant_english= null;
            }



            if(isset($_POST["keywords_english"])){
                $keywords_english = $_POST["keywords_english"];
            }

            else{
                $keywords_english= null ;
            }



            if(isset($_POST["supports"])){
                $supports = $_POST["supports"];
            }

            else{
                $supports= null ;
            }



            if(isset($_POST["comments"])){
                $comments = $_POST["comments"];
            }

            else{
                $comments= null ;
            }

            

            if(isset($_POST["main_author"])){


                $main_author = $_POST["main_author"];
            }
            else{
             
                
                $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
                
                $main_author=[];
              

               

               
                array_push($main_author,$user_index["uye_adi"]);
                array_push($main_author,$user_index["uye_soyadi"]);
                array_push($main_author,$user_index["uye_kurum"]);
                array_push($main_author,$user_index["uye_mail"]);
                array_push($main_author,1);
                $main_author = json_encode($main_author,JSON_UNESCAPED_UNICODE);
            
            }
            
     
            $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
            $register_id = $user_index;
            
            
            $model = $this->model("model_abstract");

            $bildiri_sorgu = $model->abstract_save($register_id["id"],$abstract_site,$abstract_category,$abstract_sub_category,$main_author,$other_author,$alt_contact,$abstract_type,$abstract_language,$title,$contant,$keywords,$title_english,$contant_english,$keywords_english,$supports,$comments);
            
            $main_author = json_decode($main_author);

            $this->mailer_setup("Bitki Koruma Kongresi Bildiri Hk.","<h3>Nutuva Organizasyon Bildiri Yönetim Sistemine Hoşgeldiniz</h3><br>

            Uluslararası Katılımlı 8. Bitki Koruma Kongresi kapsamında aşağıda detayları verilen
            bildiriniz yüklenmiştir. Nutuva Bildiri Yönetim Sistemi üzerinden mail adresi ve şifrenizle giriş yaparak \"bildirilerim\" kısmında bildiriniz ile ilgili süreçleri takip edebilirsiniz.<br>
            <a href='http://ekongre.nutuva.com/ '>http://ekongre.nutuva.com </a><br><br>

            <b>Bildiri Başlığı</b>: ".strip_tags($title)."<br>
            <b>Bildiri Kategorisi</b>: ".strip_tags($abstract_sub_category)."<br>
            <b>Bildiri Türü</b>: ".strip_tags($abstract_type)."<br>
            <br>
            Nutuva Organizasyon<br>
            
            <br>
            Bu ileti size Nutuva Organizasyon aracılığıyla gönderilmiştir.
            
            <hr>

            <h3>You are welcome to Nutuva Abstract Management System.</h3><br>

            The abstract that you tried to upload to 8th Plant Protection Congress with International Participation has been uploaded. By logging in with your e-mail address and password through the Nutuva Abstract Management System, you can follow the processes related to your report in 'My Abstracts '  section.

            <br>
            Nutuva Organization<br>
            
            <br>
            This message has been sent to you through Nutuva Organization.
            
            ",[$user_index["uye_mail"],$main_author[3],$alt_contact]);

            echo 1;

        }
        else{
            echo 0;
        }
    }

    public function update()
    {

        session_start();
        if(isset($_POST["abstract_update"]) && isset($_SESSION["user"]))
        {
            $abstract_no        = $_POST["abstract_no"]; 

            $supports = $_POST["supports"];
            $comments = $_POST["comments"];
            $abstract_type      = $_POST["abstract_type"];
            $abstract_language  = $_POST["abstract_language"];
            $title              = $_POST["title"];
            $contant            = $_POST["contant"];
            $keywords           = $_POST["keywords"];


            if(isset($_POST["alt_contact"])){
                $alt_contact = $_POST["alt_contact"];
            }

            else{
                $alt_contact= null;
            }



            if(isset($_POST["title_english"])){
                $title_english = $_POST["title_english"];
            }

            else{
                $title_english = null;
            }



            if(isset($_POST["contant_english"])){
                $contant_english = $_POST["contant_english"];
            }

            else{
                $contant_english= null;
            }



            if(isset($_POST["keywords_english"])){
                $keywords_english = $_POST["keywords_english"];
            }

            else{
                $keywords_english= null ;
            }



            if(isset($_POST["supports"])){
                $supports = $_POST["supports"];
            }

            else{
                $supports= null ;
            }



            if(isset($_POST["comments"])){
                $comments = $_POST["comments"];
            }

            else{
                $comments= null ;
            }

            
            $user_model = $this->model("users");
            $model = $this->model("model_abstract");
            
            $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
            $register_id = $user_index["id"];
            
            $abstract_by_id = $model->getabstractinfo($abstract_no);
            $bildiri_sorgu = null;
            if  ($user_index["uye_yetki"] == 3  || $user_index["uye_yetki"] == 1)
            {
               

                if(intval($abstract_by_id["accepted"]) == 1)
                {

                    $same_category_type_abstracts = $model->get_all_abstracts_by_category("abstracts",$abstract_by_id["abstract_category"],$abstract_type);
                    
                    if($same_category_type_abstracts["abstract_no"] == $abstract_by_id["abstract_no"])
                    {
                        if(intval($same_category_type_abstracts["abstract_no"]) == 0 )
                        {
                            $sorgu = $model->last_abstract_accept("abstracts",intval($abstract_by_id["accepted"]),intval($same_category_type_abstracts["last_abstract_no"])+1,$abstract_no);
                        }
                        else
                        {
                            $sorgu = $model->last_abstract_accept("abstracts",intval($abstract_by_id["accepted"]),$same_category_type_abstracts["last_abstract_no"],$abstract_no);
                        }
                        
                    }
                    else
                    {
                        $sorgu = $model->last_abstract_accept("abstracts",intval($abstract_by_id["accepted"]),intval($same_category_type_abstracts["last_abstract_no"])+1,$abstract_no);

                    }
                    $bildiri_sorgu = $model->abstract_update($abstract_no,$alt_contact,$abstract_type,$abstract_language,$title,
                    $contant,$keywords,$title_english,$contant_english,$keywords_english,$supports,$comments,intval($abstract_by_id["accepted"]));

                }
                else
                {

                    if(intval($abstract_by_id["accepted"]) == 3)
                    {
    
                        $bildiri_sorgu = $model->abstract_update($abstract_no,$alt_contact,$abstract_type,$abstract_language,$title,
                        $contant,$keywords,$title_english,$contant_english,$keywords_english,$supports,$comments,3);
    
                        if($bildiri_sorgu)
                        {
                            $all_admin_editor = $model->get_all_admin_editor();
                            $admin_editor_mail = [];
                            for($i=0;$i<count($all_admin_editor);$i++)
                            {
                                array_push($admin_editor_mail,$all_admin_editor[$i]["uye_mail"]);
                            }
    
                            $this->mailer_setup("Bildiri Düzenleme Hk.","<h3>Nutuva Organizasyon Bildiri Yönetim Sistemine Hoşgeldiniz</h3><br>
    
                            
                            Uluslararası Katılımlı 8. Bitki Koruma Kongresine gönderilmiş olan aşağıda detayları belirtilen
                            bildirinin düzenlemesi ".$user_index["uye_adi"]." ".$user_index["uye_soyadi"]." tarafından yapılmıştır. Bildiri değerlendirmesini
                            Nutuva Bildiri Yönetim Sistemi üzerinden mail adresi ve şifrenizle giriş yaparak gerçeleştirebilirsiniz.<br>
                            <a href='http://ekongre.nutuva.com/ '>http://ekongre.nutuva.com </a><br><br>
    
                            <b>Bildiri No</b>: ".strip_tags($abstract_by_id["abstract_no"])."<br>
                            <b>Bildiri Başlığı</b>: ".strip_tags($abstract_by_id["title"])."<br>
                            <b>Bildiri Kategorisi</b>: ".strip_tags($abstract_by_id["abstract_sub_category"])."<br>
                            <b>Bildiri Türü</b>: ".strip_tags($abstract_by_id["abstract_type"])."<br>
                            <br>
                            Nutuva Organizasyon<br>
                            
                            <br>
                            Bu ileti size Nutuva Organizasyon aracılığıyla gönderilmiştir.
                            
                            <hr>
    
                            <h3>You are welcome to Nutuva Abstract Management System.</h3><br>
    
                            The mail have been sent from the 8th Plant Protection Congress with International Participation.
                            The arrangement of the Abstract was made by ".$user_index["uye_adi"]." ".$user_index["uye_soyadi"].".
                            You can perform paper jadgement by logging in with your e-mail address and password to Nutuva Declaration Management System. <br>
                
                    
                            <br>
                            Nutuva Organization<br>
                            
                            <br>
                            This message has been sent to you through Nutuva Organization.
                            
                            ",$admin_editor_mail);
                        }
                    }
                    else
                    {                   
                        $bildiri_sorgu = $model->abstract_update($abstract_no,$alt_contact,$abstract_type,$abstract_language,$title,
                        $contant,$keywords,$title_english,$contant_english,$keywords_english,$supports,$comments,intval($abstract_by_id["accepted"]));
                    }


                }
                if($bildiri_sorgu ){
    
                    echo 1;
    
                }
                else
                {
                    echo 0;
                }
               
            }

            else if($user_index["uye_yetki"] == 0 || $user_index["uye_yetki"] == 2)
            {
                $bildiri_sorgu = null;

                if($abstract_by_id["register_id"] == $register_id)
                {
                    if(intval($abstract_by_id["accepted"]) == 3)
                    {
    
                        $bildiri_sorgu = $model->abstract_update($abstract_no,$alt_contact,$abstract_type,$abstract_language,$title,
                        $contant,$keywords,$title_english,$contant_english,$keywords_english,$supports,$comments,3);
                    }
                    else if(intval($abstract_by_id["accepted"]) == 0)
                    {
                        $bildiri_sorgu = $model->abstract_update($abstract_no,$alt_contact,$abstract_type,$abstract_language,$title,
                        $contant,$keywords,$title_english,$contant_english,$keywords_english,$supports,$comments,0);
                    }
                    else{}
                    if($bildiri_sorgu ){
    
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


    public function abstract_arrangement_save(){

        session_start();
        if(isset($_GET["abstract_id"]) && isset($_SESSION["user"]))
        {

            $abstract_no = $_GET["abstract_id"]; 
            $user_model = $this->model("users");
            $model = $this->model("model_abstract");
            
            $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
            $register_id = $user_index["id"];
            
            $abstract_by_id = $model->getabstractinfo($abstract_no);
            $bildiri_sorgu = null;


            if($user_index["uye_yetki"] == 3  || $user_index["uye_yetki"] == 1)
            {
                $bildiri_sorgu = $model->arrangement_save("abstracts",4,$abstract_no);
                $this->goaway("?sayfa=all_abstracts");

            }
            else if($user_index["uye_yetki"] == 0 || $user_index["uye_yetki"] == 2)
            {
                if($abstract_by_id["register_id"] == $register_id && intval($abstract_by_id["accepted"]) == 3)
                {

                    $bildiri_sorgu = $model->arrangement_save("abstracts",4,$abstract_no);

                    if($bildiri_sorgu)
                    {
    
                        
    
                        $all_admin_editor = $model->get_all_admin_editor();
                        $admin_editor_mail = [];
                        for($i=0;$i<count($all_admin_editor);$i++)
                        {
                            array_push($admin_editor_mail,$all_admin_editor[$i]["uye_mail"]);
                        }
        
                        $this->mailer_setup("Bildiri Düzenleme Hk.","<h3>Nutuva Organizasyon Bildiri Yönetim Sistemine Hoşgeldiniz</h3><br>
        
                        
                        Uluslararası Katılımlı 8. Bitki Koruma Kongresine gönderilmiş olan aşağıda detayları belirtilen
                        bildirinin düzenlemesi ".$user_index["uye_adi"]." ".$user_index["uye_soyadi"]." tarafından yapılmıştır. Bildiri değerlendirmesini
                        Nutuva Bildiri Yönetim Sistemi üzerinden mail adresi ve şifrenizle giriş yaparak gerçeleştirebilirsiniz.<br>
                        <a href='http://ekongre.nutuva.com/ '>http://ekongre.nutuva.com </a><br><br>
        
                        <b>Bildiri No</b>: ".strip_tags($abstract_by_id["abstract_no"])."<br>
                        <b>Bildiri Başlığı</b>: ".strip_tags($abstract_by_id["title"])."<br>
                        <b>Bildiri Kategorisi</b>: ".strip_tags($abstract_by_id["abstract_sub_category"])."<br>
                        <b>Bildiri Türü</b>: ".strip_tags($abstract_by_id["abstract_type"])."<br>
                        <br>
                        Nutuva Organizasyon<br>
                        
                        <br>
                        Bu ileti size Nutuva Organizasyon aracılığıyla gönderilmiştir.
                        
                        <hr>
        
                        <h3>You are welcome to Nutuva Abstract Management System.</h3><br>
        
                        The mail have been sent from the 8th Plant Protection Congress with International Participation.
                        The arrangement of the Abstract was made by ".$user_index["uye_adi"]." ".$user_index["uye_soyadi"].".
                        You can perform paper jadgement by logging in with your e-mail address and password to Nutuva Declaration Management System. <br>
            
                
                        <br>
                        Nutuva Organization<br>
                        
                        <br>
                        This message has been sent to you through Nutuva Organization.
                        
                        ",$admin_editor_mail);
                        
                    }
                    $this->goaway("?sayfa=my_abstracts");
                }
                else
                {
                    $this->goaway("?sayfa=my_abstracts");
                }
            }
        }
    }


    public function authorupdate()
    {

        session_start();
        if(isset($_POST["abstract_update"]))
        {
            $abstract_no        = $_POST["abstract_no"]; 

            if(isset($_POST["main_author"])){
                $main_author= $_POST["main_author"];

            }
            else{
                $main_author="";
            }

            
            if(isset($_POST["other_author"])){
                $other_author= $_POST["other_author"];

            }
            else{
                $other_author="";
            }

            
            $user_model = $this->model("users");
            $model = $this->model("model_abstract");
            
            $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
            $register_id = $user_index["id"];

            $abstract_by_id = $model->getabstractinfo($abstract_no);

            if($abstract_by_id["register_id"] == $register_id || intval($user_index["uye_yetki"]) == 1 || intval($user_index["uye_yetki"]) == 3)
            {
                
            }
            
            else
            {
                $this->goaway("?sayfa=my_abstracts");
            }

             
            


            $bildiri_sorgu = $model->abstract_author_update($abstract_no,$main_author,$other_author);
            if($bildiri_sorgu ){

                echo 1;

            }
            else{
                echo 0;
            }
        }
        else{
            echo 0;
        }
    }



    public function categoryupdate()
    {

        session_start();
        if(isset($_POST["abstract_update"]))
        {

            $abstract_no        = $_POST["abstract_no"]; 
            $abstract_website   = $_POST["abstract_website"]; 
            $abstract_category  = $_POST["abstract_category"];
            $abstract_sub_category = $_POST["abstract_sub_category"];

            

            $model = $this->model("model_abstract");
            $user_model = $this->model("users");

            $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
            $same_category_type_abstracts = $model->get_all_abstracts_by_category("abstracts",$abstract_info["abstract_category"],$abstract_info["abstract_type"]);
            $abstract_by_id = $model->getabstractinfo($abstract_no);
            

            if($user_index["uye_yetki"] == 3  || $user_index["uye_yetki"] == 1)
            {
                if(intval($abstract_by_id["accepted"]) == 1)
                {
                    
    
                    $same_category_type_abstracts = $model->get_all_abstracts_by_category("abstracts",$abstract_category,$abstract_by_id["abstract_type"]);
    
                    if($same_category_type_abstracts["abstract_no"] == $abstract_by_id["abstract_no"])
                    {

                        if(intval($same_category_type_abstracts["abstract_no"]) == 0 )
                        {
                            $sorgu = $model->last_abstract_accept("abstracts",intval($abstract_by_id["accepted"]),intval($same_category_type_abstracts["last_abstract_no"])+1,$abstract_no);
                        }
                        else
                        {
                            $sorgu = $model->last_abstract_accept("abstracts",intval($abstract_by_id["accepted"]),intval($same_category_type_abstracts["last_abstract_no"]),$abstract_no);
                        }
                    }
                    else
                    {
                        $sorgu = $model->last_abstract_accept("abstracts",intval($abstract_by_id["accepted"]),intval($same_category_type_abstracts["last_abstract_no"])+1,$abstract_no);
    
                    }
                    $bildiri_sorgu = $model->abstract_category_update($abstract_no,$abstract_website,$abstract_category,$abstract_sub_category);
                }
                else
                {
                    $bildiri_sorgu = $model->abstract_category_update($abstract_no,$abstract_website,$abstract_category,$abstract_sub_category);
                }
            }
            else if($user_index["uye_yetki"] == 0  || $user_index["uye_yetki"] == 2)
            {
                if(intval($abstract_by_id["accepted"]) == 3 || intval($abstract_by_id["accepted"]) == 0)
                {
                    $bildiri_sorgu = $model->abstract_category_update($abstract_no,$abstract_website,$abstract_category,$abstract_sub_category);
                }
                else{}
            }

          


            if($bildiri_sorgu ){

                echo 1;

            }
            else{
                echo 0;
            }
        }
        else{
            echo 0;
        }
    }


    public function profileupdate(){

        session_start();

        if(isset($_SESSION["user"])){            
        }
        else{
            header("location:/login");
            exit();
        }


        $uye_adi = (isset($_POST["kadi"]))? $_POST["kadi"]:null;
        $uye_soyadi = (isset($_POST["ksoyadi"]))? $_POST["ksoyadi"]:null;
        $uye_tel = (isset($_POST["tel"]))? $_POST["tel"]:null;
        $uye_sehir = (isset($_POST["sehir"]))? $_POST["sehir"]:null;
        $uye_unvan = (isset($_POST["unvan"]))? $_POST["unvan"]:null;
        $uye_uzmanlik = (isset($_POST["uzmanlik"]))? $_POST["uzmanlik"]:null;
        $uye_kurum = (isset($_POST["kurum"]))? $_POST["kurum"]:null;

        $uye_fatura_isim = (isset($_POST["fatura_isim"]))? $_POST["fatura_isim"]:null;
        $uye_fatura_vergi_no = (isset($_POST["fatura_vergi_no"]))? $_POST["fatura_vergi_no"]:null;
        $uye_fatura_vergi_dairesi = (isset($_POST["fatura_vergi_dairesi"]))? $_POST["fatura_vergi_dairesi"]:null;
        $uye_fatura_not = (isset($_POST["fatura_not"]))? $_POST["fatura_not"]:null;
        $uye_fatura_mail = (isset($_POST["fatura_mail"]))? $_POST["fatura_mail"]:null;

        $uye_fatura_adres = (isset($_POST["fatura_adres"]))? $_POST["fatura_adres"]:null;
        $uye_kargo_adres = (isset($_POST["kargo_adres"]))? $_POST["kargo_adres"]:null;
        
    

        $user_model = $this->model("users");
        $user_index = $user_model->profileupdate($_SESSION["user"]["uye_mail"],$uye_adi,$uye_soyadi,$uye_tel,$uye_sehir,$uye_unvan,$uye_uzmanlik,$uye_kurum,$uye_fatura_isim,$uye_fatura_vergi_no,$uye_fatura_vergi_dairesi,$uye_fatura_not,$uye_fatura_mail,$uye_fatura_adres,$uye_kargo_adres);

        if($user_index){
            $this->goaway("?sayfa=profile_update&status=true");
        }
        else{
            $this->goaway("?sayfa=profile_update&status=false");
        }
    }


    
    public function delete()
    {
       
        session_start();

        if(isset($_SESSION["user"])){            
        }
        else{
            $this->goaway("");
        }

        
        
        $model = $this->model("model_abstract");

        $user_model = $this->model("users");
        $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
        $register_id = $user_index["id"];

         
        if(isset($_GET["abstract_id"])){
            $abstract_no= intval($_GET["abstract_id"]);
            
            $abstract_by_id = $model->getabstractinfo($abstract_no);

            if(intval($abstract_by_id["register_id"]) == intval($register_id))
            {
                if($abstract_by_id["referee_ids"] && is_array(json_decode($abstract_by_id["referee_ids"])))
                {
                    $this->goaway("?sayfa=my_abstracts");
                }
                else
                {}
            }
            
            else
            {
                $this->goaway("?sayfa=my_abstracts");
            }

            
            $update_abstract= $model->getabstractinfo($abstract_no);  
    
        }
        else{
            $update_abstract=null;  
        }
    
        $bildiri_sorgu = $model->abstract_delete($abstract_no,$register_id);

            $this->goaway("?sayfa=my_abstracts");

    }

    
    public function accepted_abstract_document()
    {
        //Düzenlenmeli (bitki koruma kongresi yazısı)
        include __DIR__."/simple_html_dom.php";
   
        session_start();

        if(isset($_SESSION["user"]) ){            
        }
        else{
            header("location:/login");
            exit;
        }

        if (isset($_GET["abstract_id"]))
        {
            $abstract_no = $_GET["abstract_id"];
        }
        else
        {
            $this->goaway("?sayfa=my_abstracts");
        }



        $user_model = $this->model("users");
        $abstract_model = $this->model("model_abstract");

        $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
        $register_id =$user_index["id"];
          
        
        if(isset($_GET["abstract_id"])){
            $abstract_no= intval($_GET["abstract_id"]);
            
            $abstract_by_id = $abstract_model->getabstractinfo($abstract_no);
            if($abstract_by_id)
            {
                if((intval($abstract_by_id["register_id"]) == intval($register_id) && intval($abstract_by_id["accepted"]) == 1) || 
                (intval($abstract_by_id["main_author_id"]) == intval($user_index["id"]) && intval($abstract_by_id["accepted"]) == 1) || 
                (intval($user_index["uye_yetki"]) == 3))
                {
                
                }
                
                else
                {
                    $this->goaway("?sayfa=my_abstracts");
                }
            }
            else
            {
                $this->goaway("?sayfa=my_abstracts");
            }
            
            $abstract_info= $abstract_model->getabstractinfo($abstract_no);  
    
        }
        else{
            $abstract_info=null;  
        }
        
        $language = $this->language()[$user_index["uye_dil"]]["accepted_abstract_document"];


        $location="";
        for($i=1;$i<count(explode("/",__DIR__))-1;$i++)
        {
            $location .= "/".explode("/",__DIR__)[$i];
        }

        $main_author = json_decode($abstract_info["main_author"]);
        $other_author = json_decode($abstract_info["other_author"]);
        
        $main_author_name = mb_convert_case($main_author[0], MB_CASE_TITLE, "UTF-8")." ".mb_strtoupper($main_author[1]);

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

        $all_author_names ="";
        if(count($main_author) >= 4 )
        {
            if($main_author[4])
            {
                array_splice($other_author,intval($main_author[4])-1,0,[$main_author]);
                $abstract_all_authors = $other_author; 
            }
            else
            {
                $main_author[4] = 1;
                array_splice($other_author,0,0,[$main_author]);
                $abstract_all_authors = $other_author; 
            }

        }
        for($i=0;$i<count($other_author);$i++)
        {
              
         if($i == 0)
         {
            $all_author_names .= mb_strtoupper($other_author[$i][0])." ".mb_strtoupper($other_author[$i][1]);
         }
        else
        {
            $all_author_names .= ", ".mb_strtoupper($other_author[$i][0])." ".mb_strtoupper($other_author[$i][1]);
        }          
        }
        $abstract_type_lang ="";

        if($user_index["uye_dil"] == "tr")
        {
            for($i=0;$i<count($language[0][0]);$i++)
            {
                if($language[0][0][$i] == $abstract_info["abstract_type"])
                {
                    $abstract_type_lang = $language[0][0][$i];
                }
            }    
        }
        else
        {
            for($i=0;$i<count($language[0][0]);$i++)
            {
                if($language[0][0][$i] == $abstract_info["abstract_type"])
                {
                    $abstract_type_lang = $language[0][1][$i];
                }
            }    
        }

        
        setlocale(LC_ALL, "tr_TR");


    
        $abstract_title = str_replace("\n"," ",strip_tags(html_entity_decode($abstract_info["title"],ENT_QUOTES,"UTF-8"))); // my definition for abstract_title variable
       

        $pdf = new tFPDF('P','mm',"A4");
        $pdf->AddPage(); 
        $pdf->AddFont('Times New Roman','','AverBold-4YlW.ttf',true);
        if($user_index["uye_dil"] == 'tr')
        {
            $pdf->Image($location.'/view/abstracts/pdfsamples/Bitki_Koruma_Kongresi/kabul_mektubu.png',0,0,210,300,'PNG');
        }
        else
        {
            $pdf->Image($location.'/view/abstracts/pdfsamples/Bitki_Koruma_Kongresi/kabul_mektubu_'.$user_index["uye_dil"].'.png',0,0,210,300,'PNG');
        }
        $pdf->SetTextColor(45, 55, 55);
        //sorumluyazar
        $pdf->SetFont('Times New Roman','',11);
        $pdf->SetXY(71,43.20);
        $pdf->Write(10,$main_author_name);
        //bildiri no
        $pdf->SetFont('Times New Roman','',11);
        $pdf->SetXY(94,171.5);
        $pdf->Write(10,$abstract_category_char.$abstract_type_char.$last_abstract_no);
        //bildiri türü
        $pdf->SetXY(94,181.6);
        $pdf->Write(10,$abstract_type_lang);
        //sorumlu yazar
        $pdf->SetFont('Times New Roman','',11);
        $pdf->SetXY(96,191.4);
        $pdf->Write(10,$main_author_name);
        //tüm yazarlar
        $pdf->SetFont('Times New Roman','',9);
        $pdf->SetXY(94,203.8);
        $pdf->MultiCell(105,5,$all_author_names);
        //bildiri başlık
        $pdf->SetFont('Times New Roman','',11);
        $pdf->SetXY(94,223.5);
        $pdf->MultiCell(105,5,$abstract_title,0,"L");
        //değer. sonucu
        $pdf->SetFont('Times New Roman','',11);
 
        $pdf->SetXY(180,184);
        $pdf->MultiCell(40,5,$language[1]);
      
        $pdf->Output();
    }


    public function session_manager_document()
    {

        
        function hour_replace($hours)
        {
            $find = [",","/","-",":","_","|",";"];
     
            for($i=0;$i<count($find);$i++)
            {
                $hours = str_replace($find[$i],".",$hours);
            }
            return $hours;
        }

        function secs_to_hours($secs)
        {
            $hours = intval($secs/(60*60));
            $mins = intval(($secs-($hours*60*60))/60) ;

            return ($mins < 10) ? $hours."."."0".strval($mins) : $hours.".".strval($mins);
        } 

        function hours_to_secs($hours)
        {

            $hours = hour_replace($hours);
            $hours_mins = explode(".",$hours);
            $secs = intval($hours_mins[0])*60*60+intval($hours_mins[1])*60;
            return $secs;

        
        }
        //Düzenlenmeli (bitki koruma kongresi yazısı)
        include __DIR__."/simple_html_dom.php";
   
        session_start();

        if(isset($_SESSION["user"]) ){            
        }
        else{
            header("location:/login");
            exit;
        }

     
        if(isset($_GET["day"]) && isset($_GET["saloon"]) && isset($_GET["session"]))
        {
            $user_model = $this->model("users");
            $abstract_model = $this->model("model_abstract");

            $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
            $register_id =$user_index["id"];
            
            $scientific_program = json_decode($abstract_model->allcategorywebsites()[0]["scientific_program"]);
            
        
            
            $language = $this->language()[$user_index["uye_dil"]]["accepted_abstract_document"];


            $location="";
            for($i=1;$i<count(explode("/",__DIR__))-1;$i++)
            {
                $location .= "/".explode("/",__DIR__)[$i];
            }

        
            setlocale(LC_ALL, "tr_TR");

            $session_name ="";
            $session_date = "";
            $session_time = "";
            $saloon_name = "";
            $member_program_lang="";
            $cakisma=0;
            if($user_index["uye_dil"] != "tr")
            {
                $member_program_lang = "_".$user_index["uye_dil"];
            }
            foreach($scientific_program as $day => $value0)
            {
                foreach ($scientific_program->{$day} as $saloon=> $value1) 
                {
                    $saloon_start_time = intval(hours_to_secs($scientific_program->{$day}->{$saloon}->{"start_time"}));
                    foreach ($scientific_program->{$day}->{$saloon} as $session => $valu2) 
                    {
                        if($scientific_program->{$day}->{$saloon}->{$session}->{"manager"} == $user_index["id"] && $day == $_GET["day"] && $saloon == $_GET["saloon"] && $session == $_GET["session"] )
                        {
                            $session_name = $scientific_program->{$day}->{$saloon}->{$session}->{"name".$member_program_lang};
                            $session_date = $scientific_program->{$day}->{$user_index["uye_dil"]};
                            $session_time = secs_to_hours($saloon_start_time);
                            $saloon_name = $scientific_program->{$day}->{$saloon}->{$user_index["uye_dil"]};

                            $pdf = new tFPDF('P','mm',"A4");
                            $pdf->AddPage(); 
                            $pdf->AddFont('Times New Roman','','AverBold-4YlW.ttf',true);
                            if($user_index["uye_dil"] == 'tr')
                            {
                                $pdf->Image($location.'/view/abstracts/pdfsamples/Bitki_Koruma_Kongresi/oturum_baskani.png',0,0,210,300,'PNG');
                            }
                            else
                            {
                                $pdf->Image($location.'/view/abstracts/pdfsamples/Bitki_Koruma_Kongresi/oturum_baskani_'.$user_index["uye_dil"].'.png',0,0,210,300,'PNG');
                            }
                            $pdf->SetTextColor(45, 55, 55);
                            //oturum başkanı adı
                            $pdf->SetFont('Times New Roman','',11);
                            $pdf->SetXY(71,94.3);
                            $pdf->Write(10,$user_index["uye_adi"]." ".$user_index["uye_soyadi"]);
                            //bildiri no
                            $pdf->SetXY(104,183);
                            $pdf->Write(10,$session_name);
                            //bildiri türü
                            $pdf->SetXY(104,197);
                            $pdf->Write(10,$session_date);
                            //
                            $pdf->SetXY(104,210);
                            $pdf->MultiCell(105,5,$saloon_name);
                            //sorumlu yazar
                            $pdf->SetXY(180,197);
                            $pdf->Write(10,$session_time);
                            $pdf->Output();
                            $cakisma=1;
                            return;

                        }
                        $saloon_start_time += intval($scientific_program->{$day}->{$saloon}->{$session}->{"time"})*60;

                    }
                }
            }
            if($cakisma == 0)
            {
                $this->goaway("?sayfa=session_abstract_info");
            }
        }
        else
        {
            $this->goaway("?sayfa=session_abstract_info");
        }

      
    }







    public function presentation_upload()
    {
        session_start();

        if(isset($_SESSION["user"])){            
        }
        else{
            header("location:/login");
            exit;
        }
       
        $abstract_model = $this->model("model_abstract");
        $user_model = $this->model("users");
        $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
        


        if( isset( $_POST['presentation_upload'] )  && !empty( $_FILES['down_files']) && isset($_POST["abstract_id"])){

            $abstract_no = $_POST["abstract_id"];
            $abstract_info = $abstract_model->getabstractinfo($abstract_no);
            if(($user_index["id"] == $abstract_info["register_id"]) || ($user_index["id"] == $abstract_info["main_author_id"]))
            {
                $presentation_files = $abstract_info["presentation_files"];
            }
            else
            {
                $this->goaway("?sayfa=my_abstracts");
            }


            
                    
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
            
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            $old = getcwd();
            chdir('view/abstracts/presentations/Bitki Koruma Kongresi');


            
            //create directory if not exists
            if (!file_exists($abstract_category_char.$abstract_type_char.$last_abstract_no)) {
            
                mkdir($abstract_category_char.$abstract_type_char.$last_abstract_no, 0777, true);
                
            }
            chdir($old);
            
        
            $files = $_FILES['down_files'];
            $allowedExts = array( "pdf");
        
        
        
            $coklu_resim_count = count($_FILES['down_files']['name']); 
        
            $down_files=[];

            for($i=0; $i < $coklu_resim_count ;$i++){ 
        
        
        
            $files_name = $files['name'][$i];
            //get image extension
            $ext = strtolower(pathinfo($files_name, PATHINFO_EXTENSION));
            //assign unique name to image
            $name = $files['name'][$i];
        
        
            array_push($down_files,strval($name));
                
                
                    
            //$name = $image_name;
            //image size calcuation in KB
            $files_size = $files["size"][$i] / 3200;
            $files_flag = true;
            //max image size
            $max_size = 10000;
            if( in_array($ext, $allowedExts) && $files_size < $max_size ){
                $files_flag = true;
            } else {
                $files_flag = false;
            
            } 
            
            if( $files["error"][$i] > 0 ){
                $files_flag = false;
        
            }
            
            if($files_flag){
                
                $old = getcwd();
                chdir("view/abstracts/presentations/Bitki Koruma Kongresi/".$abstract_category_char.$abstract_type_char.$last_abstract_no."/");
                move_uploaded_file($files["tmp_name"][$i],$name);
                chdir($old);


                
                ////////////////////////////////////////////Veritabanı ////////////////////
                        
            }
            
        
        
        
            }

           if($files_flag)
           {
               if($presentation_files == null)
               {
                $presentation_files = [];
               }
               else
               {
                $presentation_files = json_decode($presentation_files);
               }

                for($a=0;$a<count($down_files);$a++)
                {
                    
                    $value=0;
                    for($i=0;$i<count($presentation_files);$i++)
                    {

                        if($presentation_files[$i] == $down_files[$a])
                        {
                            $value=1;
                            break;
                            
                        }

                        else
                        {
                            continue;
                        }
                      
                    }
                    
                    if($value == 0)
                    {
                        array_push($presentation_files,$down_files[$a]); 
                    }
                    else{}
                    

                }
            
                $presentation_files = json_encode($presentation_files,JSON_UNESCAPED_UNICODE);
            
                $result = $abstract_model->presentation_upload("abstracts",$presentation_files,$abstract_no);
                if($result){
                    $this->goaway("?abstract_presentation_id=".$abstract_no."&sayfa=abstract_presentations");
                }
                else
                {
                    $this->goaway("?abstract_presentation_id=".$abstract_no."&sayfa=abstract_presentations");
                }
            }
           
            else
            {
                $this->goaway("?abstract_presentation_id=".$abstract_no."&sayfa=abstract_presentations");
            }
        
        }
        
        
        
        else {
        
        
        
        
        
            
        }
    }


    public function presentation_delete()
    {
        session_start();

        if(isset($_SESSION["user"])){            
        }
        else{
            header("location:/login");
            exit;
        }


        if(isset($_POST["document_delete"]))
        {

            if(isset($_POST["document"]) && isset($_POST["abstract_id"]))
            {
                $document = $_POST["document"];
                $abstract_no = $_POST["abstract_id"];

            }
            else
            {
                $this->goaway("?sayfa=my_abstracts");
            }

        }
        else
        {
            $this->goaway("?sayfa=my_abstracts");
        }

        $user_model = $this->model("users");
        $abstract_model = $this->model("model_abstract");
        
        $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
        $abstract_info = $abstract_model->getabstractinfo($abstract_no);

        if(($user_index["id"] == $abstract_info["register_id"]) || ($user_index["id"] == $abstract_info["main_author_id"]))
        {
            $presentation_files = json_decode($abstract_info["presentation_files"]);
        }
        else
        {
            $this->goaway("?sayfa=my_abstracts");
        }

                    
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

       
        $old = getcwd();
        chdir('view/abstracts/presentations/Bitki Koruma Kongresi/'.$abstract_category_char.$abstract_type_char.$last_abstract_no."/");
        $presentation_files = array_values($presentation_files);
        for($i=0;$i<count($presentation_files);$i++){
            
            if($presentation_files[$i] == $document )
            {
                unlink($presentation_files[$i]);
                unset($presentation_files[$i]);
                break;
            }   
        }
       
        $presentation_files = array_values($presentation_files);

        chdir($old);
        
        $presentation_files = json_encode($presentation_files,JSON_UNESCAPED_UNICODE);
            
        $result = $abstract_model->presentation_upload("abstracts",$presentation_files,$abstract_no);

        if($result){

            $this->goaway("?abstract_presentation_id=".$abstract_no."&sayfa=abstract_presentations");
        }
        else
        {
            $this->goaway("?abstract_presentation_id=".$abstract_no."&sayfa=abstract_presentations");
        }
    
    }



    
    public function sponsor_document_upload()
    {
        session_start();

        if(isset($_SESSION["user"])){            
        }
        else{
            header("location:/login");
            exit;
        }
       
        $abstract_model = $this->model("model_abstract");
        $user_model = $this->model("users");
        $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
        $abstract_websites = $abstract_model->allcategorywebsites()[0];


        if( isset( $_POST['sponsor_document_upload'] )  && !empty( $_FILES['down_files'])){

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            $old = getcwd();
            chdir('view/abstracts/sponsor_documents/Bitki Koruma Kongresi');


            
            //create directory if not exists
            if (!file_exists($user_index["sponsor_company"])) {
            
                mkdir($user_index["sponsor_company"], 0777, true);
                
            }
            chdir($old);
            
        
            $files = $_FILES['down_files'];
            $allowedExts = array( "pdf","jpeg","jpg","png");
        
        
        
            $coklu_resim_count = count($_FILES['down_files']['name']); 
        
            $down_files=[];

            for($i=0; $i < $coklu_resim_count ;$i++){ 
        
        
        
            $files_name = $files['name'][$i];
            //get image extension
            $ext = strtolower(pathinfo($files_name, PATHINFO_EXTENSION));
            //assign unique name to image
            $name = $files['name'][$i];
        
        
            array_push($down_files,strval($name));
                
                
                    
            //$name = $image_name;
            //image size calcuation in KB
            $files_size = $files["size"][$i] / 3200;
            $files_flag = true;
            //max image size
            $max_size = 10000;
            if( in_array($ext, $allowedExts) && $files_size < $max_size ){
                $files_flag = true;
            } else {
                $files_flag = false;
            
            } 
            
            if( $files["error"][$i] > 0 ){
                $files_flag = false;
        
            }
            
            if($files_flag){
                
                $old = getcwd();
                chdir("view/abstracts/sponsor_documents/Bitki Koruma Kongresi/".$user_index["sponsor_company"]."/");
                move_uploaded_file($files["tmp_name"][$i],$name);
                chdir($old);


                
                ////////////////////////////////////////////Veritabanı ////////////////////
                        
            }
            
        
        
        
            }

           if($files_flag)
           {
                if($abstract_websites["sponsor_congress_logo_but_infos"] == "")
                {
                    $sponsor_documents = [];
                }
                else
                {
                    $sponsor_documents = json_decode($abstract_websites["sponsor_congress_logo_but_infos"]);
                }

                for($a=0;$a<count($down_files);$a++)
                {
                    
                    $value=0;
                    for($i=0;$i<count($sponsor_documents->{$user_index["sponsor_company"]}->{"documents"});$i++)
                    {

                        if($sponsor_documents->{$user_index["sponsor_company"]}->{"documents"}[$i] == $down_files[$a])
                        {
                            $value=1;
                            break;
                            
                        }

                        else
                        {
                            continue;
                        }
                      
                    }
                    
                    if($value == 0)
                    {
                        if(empty($sponsor_documents->{$user_index["sponsor_company"]}->{"documents"}))
                        {
                            $sponsor_documents->{$user_index["sponsor_company"]}->{"documents"}=[];
                            array_push($sponsor_documents->{$user_index["sponsor_company"]}->{"documents"},$down_files[$a]); 
                        }
                        else
                        {
                            array_push($sponsor_documents->{$user_index["sponsor_company"]}->{"documents"},$down_files[$a]); 
                        }
                    }
                    else{}
                    

                }
            
                $sponsor_documents = json_encode($sponsor_documents,JSON_UNESCAPED_UNICODE);
            
                $result = $abstract_model->sponsor_document_upload("categories",$sponsor_documents,$abstract_websites["id"]);
                if($result){
                    $this->goaway("?sayfa=virtual_congress_sponsor_documents");
                }
                else
                {
                    $this->goaway("?sayfa=virtual_congress_sponsor_documents");
                }
            }
           
            else
            {
                $this->goaway("?sayfa=virtual_congress_sponsor_documents");
            }
        
        }
        
        
        
        else {
        
        
        
        
        
            
        }
    }






    public function sponsor_document_delete()
    {
        session_start();

        if(isset($_SESSION["user"])){            
        }
        else{
            header("location:/login");
            exit;
        }


        if(isset($_POST["document_delete"]))
        {

            if(isset($_POST["document"]))
            {
                $document = $_POST["document"];

            }
            else
            {
            $this->goaway("?sayfa=virtual_congress_sponsor_documents");
            }

        }
        else
        {
            $this->goaway("?sayfa=virtual_congress_sponsor_documents");
        }

        $user_model = $this->model("users");
        $abstract_model = $this->model("model_abstract");
        
        $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
        $abstract_websites = $abstract_model->allcategorywebsites()[0];

        if($user_index["sponsor_company"] != null)
        {
            $sponsor_documents = json_decode($abstract_websites["sponsor_congress_logo_but_infos"]);
        }
        else
        {
            $this->goaway("?sayfa=virtual_congress_sponsor_documents");
        }

                    
        $old = getcwd();
        chdir('view/abstracts/sponsor_documents/Bitki Koruma Kongresi/'.$user_index["sponsor_company"]."/");
        $sponsor_documents->{$user_index["sponsor_company"]}->{"documents"} = array_values($sponsor_documents->{$user_index["sponsor_company"]}->{"documents"});
        for($i=0;$i<count($sponsor_documents->{$user_index["sponsor_company"]}->{"documents"});$i++){
            
            if($sponsor_documents->{$user_index["sponsor_company"]}->{"documents"}[$i] == $document )
            {
                unlink($sponsor_documents->{$user_index["sponsor_company"]}->{"documents"}[$i]);
                unset($sponsor_documents->{$user_index["sponsor_company"]}->{"documents"}[$i]);
                break;
            }   
        }
       
        $sponsor_documents->{$user_index["sponsor_company"]}->{"documents"} = array_values($sponsor_documents->{$user_index["sponsor_company"]}->{"documents"});

        chdir($old);
                
        $result = $abstract_model->sponsor_document_upload("categories",json_encode($sponsor_documents,JSON_UNESCAPED_UNICODE),$abstract_websites["id"]);

        if($result){

            $this->goaway("?sayfa=virtual_congress_sponsor_documents");
        }
        else
        {
            $this->goaway("?sayfa=virtual_congress_sponsor_documents");
        }
    
    }








    public function sponsor_video_upload()
    {
        session_start();

        if(isset($_SESSION["user"])){            
        }
        else{
            header("location:/login");
            exit;
        }
       
        $abstract_model = $this->model("model_abstract");
        $user_model = $this->model("users");
        $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
        $abstract_websites = $abstract_model->allcategorywebsites()[0];


        if( isset( $_POST['sponsor_video_upload'] )  && !empty( $_FILES['down_files'])){

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            $old = getcwd();
            chdir('view/abstracts/sponsor_videos/Bitki Koruma Kongresi');


            
            //create directory if not exists
            if (!file_exists($user_index["sponsor_company"])) {
            
                mkdir($user_index["sponsor_company"], 0777, true);
                
            }
            chdir($old);
            
        
            $files = $_FILES['down_files'];
            $allowedExts = array( "mp4","webm");
        
        
        
            $coklu_resim_count = count($_FILES['down_files']['name']); 
        
            $down_files=[];

            for($i=0; $i < $coklu_resim_count ;$i++){ 
        
        
        
            $files_name = $files['name'][$i];
            //get image extension
            $ext = strtolower(pathinfo($files_name, PATHINFO_EXTENSION));
            //assign unique name to image
            $name = $files['name'][$i];
        
        
            array_push($down_files,strval($name));
                
                
                    
            //$name = $image_name;
            //image size calcuation in KB
            $files_size = $files["size"][$i] / 3200;
            $files_flag = true;
            //max image size
            $max_size = 55000;
            if( in_array($ext, $allowedExts) && $files_size < $max_size ){
                $files_flag = true;
            } else {
                $files_flag = false;
            
            } 
            
            if( $files["error"][$i] > 0 ){
                $files_flag = false;
        
            }
            
            if($files_flag){
                
                $old = getcwd();
                chdir("view/abstracts/sponsor_videos/Bitki Koruma Kongresi/".$user_index["sponsor_company"]."/");
                move_uploaded_file($files["tmp_name"][$i],$name);
                chdir($old);


                
                ////////////////////////////////////////////Veritabanı ////////////////////
                        
            }
            
        
        
        
            }

           if($files_flag)
           {
                if($abstract_websites["sponsor_congress_logo_but_infos"] == "")
                {
                    $sponsor_videos = [];
                }
                else
                {
                    $sponsor_videos = json_decode($abstract_websites["sponsor_congress_logo_but_infos"]);
                }

                for($a=0;$a<count($down_files);$a++)
                {
                    
                    $value=0;
                    for($i=0;$i<count($sponsor_videos->{$user_index["sponsor_company"]}->{"videos"});$i++)
                    {

                        if($sponsor_videos->{$user_index["sponsor_company"]}->{"videos"}[$i] == $down_files[$a])
                        {
                            $value=1;
                            break;
                            
                        }

                        else
                        {
                            continue;
                        }
                      
                    }
                    
                    if($value == 0)
                    {
                        if(empty($sponsor_videos->{$user_index["sponsor_company"]}->{"videos"}))
                        {
                            $sponsor_videos->{$user_index["sponsor_company"]}->{"videos"}=[];
                            array_push($sponsor_videos->{$user_index["sponsor_company"]}->{"videos"},$down_files[$a]); 
                        }
                        else
                        {
                            array_push($sponsor_videos->{$user_index["sponsor_company"]}->{"videos"},$down_files[$a]); 
                        }
                    }
                    else{}
                    

                }
            
                $sponsor_videos = json_encode($sponsor_videos,JSON_UNESCAPED_UNICODE);
            
                $result = $abstract_model->sponsor_document_upload("categories",$sponsor_videos,$abstract_websites["id"]);
                if($result){
                    $this->goaway("?sayfa=virtual_congress_sponsor_videos");
                }
                else
                {
                    $this->goaway("?sayfa=virtual_congress_sponsor_videos");
                }
            }
           
            else
            {
                $this->goaway("?sayfa=virtual_congress_sponsor_videos");
            }
        
        }
        
        
        
        else {
        
        
        
        
        
            
        }
    }






    public function sponsor_video_delete()
    {
        session_start();

        if(isset($_SESSION["user"])){            
        }
        else{
            header("location:/login");
            exit;
        }


        if(isset($_POST["video_delete"]))
        {

            if(isset($_POST["video"]))
            {
                $video = $_POST["video"];

            }
            else
            {
            $this->goaway("?sayfa=virtual_congress_sponsor_videos");
            }

        }
        else
        {
            $this->goaway("?sayfa=virtual_congress_sponsor_videos");
        }

        $user_model = $this->model("users");
        $abstract_model = $this->model("model_abstract");
        
        $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
        $abstract_websites = $abstract_model->allcategorywebsites()[0];

        if($user_index["sponsor_company"] != null)
        {
            $sponsor_videos = json_decode($abstract_websites["sponsor_congress_logo_but_infos"]);
        }
        else
        {
            $this->goaway("?sayfa=virtual_congress_sponsor_videos");
        }

                    
        $old = getcwd();
        chdir('view/abstracts/sponsor_videos/Bitki Koruma Kongresi/'.$user_index["sponsor_company"]."/");
        $sponsor_videos->{$user_index["sponsor_company"]}->{"videos"} = array_values($sponsor_videos->{$user_index["sponsor_company"]}->{"videos"});
        for($i=0;$i<count($sponsor_videos->{$user_index["sponsor_company"]}->{"videos"});$i++){
            
            if($sponsor_videos->{$user_index["sponsor_company"]}->{"videos"}[$i] == $video )
            {
                unlink($sponsor_videos->{$user_index["sponsor_company"]}->{"videos"}[$i]);
                unset($sponsor_videos->{$user_index["sponsor_company"]}->{"videos"}[$i]);
                break;
            }   
        }
       
        $sponsor_videos->{$user_index["sponsor_company"]}->{"videos"} = array_values($sponsor_videos->{$user_index["sponsor_company"]}->{"videos"});

        chdir($old);
                
        $result = $abstract_model->sponsor_document_upload("categories",json_encode($sponsor_videos,JSON_UNESCAPED_UNICODE),$abstract_websites["id"]);

        if($result){

            $this->goaway("?sayfa=virtual_congress_sponsor_videos");
        }
        else
        {
            $this->goaway("?sayfa=virtual_congress_sponsor_videos");
        }
    
    }





    public function sponsor_virtual_congress_button_info_save()
    {
      session_start();
  
      if(isset($_SESSION["user"])){            
      }
      else{
          header("location:/");
          exit;
      }
  
      $abstract_model = $this->model("model_abstract");
      $user_model = $this->model("users");
      $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
      $abstract_websites = $abstract_model->allcategorywebsites();

      if(isset($_POST["data"]) && isset($_POST["saloon"]) && isset($_POST["all_saloons"]) && isset($_POST["index"]) && $user_index["sponsor_company"] != null)
      {
            $sponsor_infos = ($abstract_websites[0]["sponsors"])? json_decode($abstract_websites[0]["sponsor_congress_logo_but_infos"]):[];
            for($i=0;$i<count($_POST["all_saloons"]);$i++)
            {
                if(empty($sponsor_infos->{$user_index["sponsor_company"]}->{$_POST["all_saloons"][$i]}))
                {
                    $sponsor_infos->{$user_index["sponsor_company"]}->{$_POST["all_saloons"][$i]} = (object) array();
                }
              
                
            }
            $sponsor_infos->{$user_index["sponsor_company"]}->{$_POST["saloon"]}->{$_POST["index"]} = json_decode($_POST["data"]);
           
            $result = $abstract_model->sponsor_congress_logo_but_infos_save(json_encode($sponsor_infos,JSON_UNESCAPED_UNICODE),$abstract_websites[0]["id"]);
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
  

    //MAİLER SYSTEM
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

  
}


?>

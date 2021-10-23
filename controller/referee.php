<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'controller/PHPMailer/src/Exception.php';
    require 'controller/PHPMailer/src/PHPMailer.php';
    require 'controller/PHPMailer/src/SMTP.php';
    class referee extends Controller
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

            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 2){            
            }
            else{
                $this->goaway("");
            }

            $user_model = $this->model("users");
            $referee_model = $this->model("referee_model");
            $abstract_model = $this->model("model_abstract");
            $language = $this->language();
            $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
            $register_id = $user_index["id"];
            
             //categories
            $abstract_websites = $abstract_model->allcategorywebsites();
            $all_abstracts= $abstract_model->getallabstracts($_SESSION["user"]["id"]); 
            $all_abstracts_main_author= $abstract_model->getallabstracts_main_author($_SESSION["user"]["id"]); 
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
    
 
            if(isset($_GET["abstract_id"])){
                $abstract_no= intval($_GET["abstract_id"]);
                
                $abstract_by_id = $abstract_model->getabstractinfo($abstract_no);

                if(intval($abstract_by_id["register_id"]) == intval($register_id))
                {
                    if($abstract_by_id["referee_ids"] && is_array(json_decode($abstract_by_id["referee_ids"])))
                    {
                        if(intval($abstract_by_id["accepted"]) == 3 )
                        {
                            
                        }
                        else
                        {
                            $this->goaway("?sayfa=my_abstracts");
                        }
                    }
                    else
                    {}
                }
                
                else
                {
                    $this->goaway("?sayfa=my_abstracts");
                }

                
                $update_abstract= $abstract_model->getabstractinfo($abstract_no);  
        
            }
            else{
                $update_abstract=null;  
            }

            if(isset($_GET["abstract_presentation_id"]) && isset($_GET["sayfa"]) && $_GET["sayfa"] == "abstract_presentations")
            {
                $update_abstract= $abstract_model->getabstractinfo($_GET["abstract_presentation_id"]);
                if((intval($update_abstract["register_id"]) == intval($register_id) && intval($update_abstract["accepted"]) == 1) || 
                (intval($update_abstract["main_author_id"]) == intval($register_id) && intval($update_abstract["accepted"]) == 1))
                {}
                else
                {
                    $this->goaway("?sayfa=my_abstracts");
                }  
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


                   
        $scientific_program_all_abstracts_arr=[];
        $scientific_program_all_abstracts = $abstract_model->getallusersabstracts();
        $scientific_program_all_abstracts_arr = $this->all_abstracts($scientific_program_all_abstracts);

      
        

            $this->view(
                "referee/index",
                    [
                        "abstract_websites"=>$abstract_websites,
                        "all_abstracts"=>$all_abstracts,
                        "all_abstracts_main_author"=>$all_abstracts_main_author,
                        "update_abstract"=>$update_abstract,
                        "uye_dil"=>strval($user_index["uye_dil"]),
                        "language" => $language,
                        "all_users"=>$all_users,
                        "user_name"=>$_SESSION["user"]["uye_adi"],
                        "user_index"=>$user_index,
                        "primer_user"=>$user_index,
                        "referee_all_abstracts"=>$referee_all_abstracts_arr,
                        "scientific_program_all_abstracts"=>$scientific_program_all_abstracts_arr,
                    ]
                );

            $this->view("out_of_indexes/socket_notifications",["abstract_websites"=>$abstract_websites[0],"user_index"=>$user_index]);

        }



        
        public function search()
        {
            session_start();

            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 2){            
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
                
                    $this->view("referee/index",["all_users"=>$sorgu,"user_name"=>$_SESSION["user"]["uye_adi"],"primer_user"=>$primer_user]);

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
        
                                $referee_all_abstracts = $abstract_model->getallusersabstracts();
                                $sorgu = [];
                                for($i=0;$i<count($referee_all_abstracts);$i++)
                                {
                                    
                                    $user_db = $editor_model->getuserbyeditor("uye",$referee_all_abstracts[$i]["register_id"]);
                            
                                  
                                    $mail = $user_db["uye_mail"];
                                    $abstract_id = $referee_all_abstracts[$i]["abstract_no"];
                                    $abstract_title = strip_tags($referee_all_abstracts[$i]["title"]);
                                    $abstract_sub_category = $referee_all_abstracts[$i]["abstract_sub_category"];
                                    $abstract_type = $referee_all_abstracts[$i]["abstract_type"];


                                    array_push($sorgu, [$mail,$abstract_id,$abstract_title,$abstract_sub_category,$abstract_type]);
                                
                                    
    
                                }
        
                                break;
    
                            case "withdrawal_none":
    
                                $referee_all_abstracts = $abstract_model->getallusersabstracts();
                                $sorgu = [];
                                for($i=0;$i<count($referee_all_abstracts);$i++)
                                {
                                    
                                    $user_db = $editor_model->getuserbyeditor("uye",$referee_all_abstracts[$i]["register_id"]);
                                    
    
                                    $withdrawal = json_decode($user_db["withdrawals"]);
                                    if($withdrawal[0][3] == $value[1] && $withdrawal != null)
                                    {
                                         
                                        $mail = $user_db["uye_mail"];
                                        $abstract_id = $referee_all_abstracts[$i]["abstract_no"];
                                        $abstract_title = strip_tags($referee_all_abstracts[$i]["title"]);
                                        $abstract_sub_category = $referee_all_abstracts[$i]["abstract_sub_category"];
                                        $abstract_type = $referee_all_abstracts[$i]["abstract_type"];


                                        array_push($sorgu, [$mail,$abstract_id,$abstract_title,$abstract_sub_category,$abstract_type]);
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
                 
                    $this->view("referee/index",["referee_all_abstracts"=>$sorgu,"user_name"=>$_SESSION["user"]["uye_adi"],"primer_user"=>$primer_user]);
    
                }


            }
            else{
                $primer_user = null;
                $sorgu = null;
                $this->goaway("?sayfa=all_abstracts");

            }

    



        }


        public function abstract_edit_requester()
        {
            session_start();

            if((isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 2) ||  intval($_SESSION["user"]["uye_yetki"]) == 3 ||  intval($_SESSION["user"]["uye_yetki"]) == 1 ){            
            }
            else{
                $this->goaway("");
            }

            if(isset($_GET["abstract_id"]))
            {
                $abstract_no= $_GET["abstract_id"];
            }
            else
            {
                $this->goaway("?sayfa=all_abstracts");
            }

            $abstract_model = $this->model("model_abstract");
            $abstract_viewer= $abstract_model->getabstractinfo($abstract_no);  

            if($abstract_viewer)
            {
                $cakisma = 0;
                $referee_ids = json_decode($abstract_viewer["referee_ids"]);
                for($i=0;$i<count($referee_ids);$i++)
                {
                    if($referee_ids[$i] == $_SESSION["user"]["id"])
                    {
                        $cakisma=1;
                        break;
                    }
                    else
                    {
                        continue;
                    }
                }
                if($cakisma == 1)
                {
                    $this->view("referee/abstract_edit_requester",["abstract_viewer"=>$abstract_viewer]);
                }
                else if($cakisma == 0)
                {
                    $this->goaway("?sayfa=all_abstracts");
                }
            }
            else
            {
                $this->goaway("?sayfa=all_abstracts");
            }
            

        }
        

        public function referee_abstract_edit_request_save()
        {
            session_start();

            if((isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 2) ||  intval($_SESSION["user"]["uye_yetki"]) == 3 ||  intval($_SESSION["user"]["uye_yetki"]) == 1 ){            
            }
            else{
                $this->goaway("");
            }

            
            $user_model = $this->model("users");
            $referee_model = $this->model("referee_model");
            $abstract_model = $this->model("model_abstract");

            if(isset($_GET["abstract_id"]) && isset($_POST["referee_edit_state"]))
            {

                $abstract_no= $_GET["abstract_id"];
                $referee_edit_state = $_POST["referee_edit_state"];

                $update_abstract= $abstract_model->getabstractinfo($abstract_no);  

                $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
                $referee_ids = json_decode($update_abstract["referee_ids"]);

                $referee_cakisma = 0;
                for($a=0;$a<count($referee_ids);$a++)
                {
                    if($referee_ids[$a] == $user_index["id"])
                    {
                        $referee_cakisma = 1;
                        break;
                    }
                }

                if($referee_cakisma == 1)
                {
                    $contant_turkish = $_POST["contant_turkish"];
                    $contant_english = $_POST["contant_english"];
                    //edit_sentence
                    if(isset($_POST["edit_sentences"]) && count(json_decode($_POST["edit_sentences"]))>0)
                    {
                        $edit_sentences = json_decode($_POST["edit_sentences"]);
                        $edit_requests = json_decode($update_abstract["edit_requests"]);
          
    
                        if(is_array($edit_requests) && $edit_requests)
                        {
                            $cakisma = 0;
                            for($i=0;$i<count($edit_requests);$i++)
                            {
                                if($edit_requests[$i][0] == $user_index["id"])
                                {
                                    $edit_requests[$i][1] = $edit_sentences;
                                    $edit_requests[$i][2] = $referee_edit_state;
                                    $edit_requests[$i][3] = $contant_turkish;
                                    $edit_requests[$i][4] = $contant_english;

                                    
                                    $cakisma = 1;
                                    break;
                                }
                            }
                            if($cakisma == 0)
                            {
                                array_push($edit_requests, [$user_index["id"],$edit_sentences,$referee_edit_state,$contant_turkish,$contant_english]);
                            }
                        }
                        else
                        {
                            $edit_requests=[];
                            array_push($edit_requests, [$user_index["id"],$edit_sentences,$referee_edit_state,$contant_turkish,$contant_english]);
                        }
                        $edit_sentences_json = json_encode($edit_requests,JSON_UNESCAPED_UNICODE);
                       
                    }
                    else
                    {
                        
                        $edit_requests = json_decode($update_abstract["edit_requests"]);

                        if(is_array($edit_requests) && $edit_requests)
                        {
                            $cakisma = 0;
                            for($i=0;$i<count($edit_requests);$i++)
                            {
                                if($edit_requests[$i][0] == $user_index["id"])
                                {
                                    $edit_requests[$i][1] = "";
                                    $edit_requests[$i][2] = $referee_edit_state;
                                    $edit_requests[$i][3] = $contant_turkish;
                                    $edit_requests[$i][4] = $contant_english;

                                    $cakisma = 1;
                                    break;

                                }
                            }
                            if($cakisma == 0)
                            {
                                array_push($edit_requests, [$user_index["id"],"",$referee_edit_state,$contant_turkish,$contant_english]);
                            }
                        }
                        else
                        {
                            $edit_requests=[];
                            array_push($edit_requests, [$user_index["id"],"",$referee_edit_state,$contant_turkish,$contant_english]);
                        }
                        $edit_sentences_json = json_encode($edit_requests,JSON_UNESCAPED_UNICODE);
                       
                    }

                    //referee_comments
                    if(isset($_POST["referee_comment"]) && $_POST["referee_comment"] !="")
                    {
                        $referee_comment = $_POST["referee_comment"];
                        $referee_comments = json_decode($update_abstract["referee_comments"]);


                        if(is_array($referee_comments) && $referee_comments)
                        {
                            $cakisma = 0;
                            for($i=0;$i<count($referee_comments);$i++)
                            {
                                if($referee_comments[$i][0] == $user_index["id"])
                                {
                                    $referee_comments[$i][1] = $referee_comment;
                                    $referee_comments[$i][2] = $referee_edit_state;
                                    $cakisma = 1;
                                    break;
                                }
                            }
                            if($cakisma == 0)
                            {
                                array_push($referee_comments, [$user_index["id"],$referee_comment,$referee_edit_state]);
                            }
                        }
                        else
                        {
                            $referee_comments=[];
                            array_push($referee_comments, [$user_index["id"],$referee_comment,$referee_edit_state]);
                        }
                        $referee_comments_json = json_encode($referee_comments,JSON_UNESCAPED_UNICODE);

                    }
                    else
                    {
                        $referee_comments = json_decode($update_abstract["referee_comments"]);

                        if(is_array($referee_comments) && $referee_comments)
                        {
                            $cakisma = 0;
                            for($i=0;$i<count($referee_comments);$i++)
                            {
                                if($referee_comments[$i][0] == $user_index["id"])
                                {
                                    $referee_comments[$i][1] = "";
                                    $referee_comments[$i][2] = $referee_edit_state;
                                    $cakisma = 1;
                                    break;
                                }
                            }
                            if($cakisma == 0)
                            {
                                array_push($referee_comments, [$user_index["id"],"",$referee_edit_state]);
                            }
                        }
                        else
                        {
                            $referee_comments=[];
                            array_push($referee_comments, [$user_index["id"],"",$referee_edit_state]);
                        }
                        
                        $referee_comments_json = json_encode($referee_comments,JSON_UNESCAPED_UNICODE);
                    }
                    
                    $sorgu = $referee_model->referee_abstract_edit_request_save("abstracts",$edit_sentences_json,$referee_comments_json,$abstract_no);
                    
                    if($sorgu)
                    {
                        $all_admin_editor = $referee_model->get_all_admin_editor();
                        $admin_editor_mail = [];
                        for($i=0;$i<count($all_admin_editor);$i++)
                        {
                            array_push($admin_editor_mail,$all_admin_editor[$i]["uye_mail"]);
                        }
                        $this->mailer_setup("Bildiri Değerlendirme Hk.","<h3>Nutuva Organizasyon Bildiri Yönetim Sistemine Hoşgeldiniz</h3><br>

                        
                        Uluslararası Katılımlı 8. Bitki Koruma Kongresine gönderilmiş olan aşağıda detayları belirtilen
                        bildirinin değerlendirmesi Bilim Kurulu Üyesi ".$user_index["uye_adi"]." ".$user_index["uye_soyadi"]." tarafından gerçekleştirilmiştir. Sonucu 
                        Nutuva Bildiri Yönetim Sistemi üzerinden mail adresi ve şifrenizle giriş yaparak görüntüleyebilirsiniz.<br>
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

                      The Abstract was judged by the Scientific Committee Member ".$user_index["uye_adi"]." ".$user_index["uye_soyadi"].".
                      You can view results by logging in with your e-mail address and password on Nutuva Abstract Management System. <br>

                        <a href='http://ekongre.nutuva.com/ '>http://ekongre.nutuva.com </a><br>
                      
                   
                        <br>
                        Nutuva Organization<br>
                        
                        <br>
                        This message has been sent to you through Nutuva Organization.",$admin_editor_mail);

                        $this->goaway("?sayfa=all_abstracts");
                    }
                    else
                    {
                        $this->goaway("?sayfa=all_abstracts");
                    }
                }

                else
                {
                    $this->goaway("?sayfa=all_abstracts");
                }
              

            }
            else
            {
                $this->goaway("?sayfa=all_abstracts");
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



        public function referee_auto_mailer()
        {

            session_start();
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 2){            
            }
            else{
                $this->goaway("");
            }
            $referee_model = $this->model("referee_model");
            //The mail goes to all subscribers on the list at a time
            if(isset($_GET["mail_type"]))
            {
                if($_GET["mail_type"] == "list_members" && isset($_POST["users"]) && isset($_POST["contant"]))
                {
                    $all_users = json_decode($_POST["users"]);
                    for($i=0;$i<count($all_users);$i++)
                    {
                    $this->mailer_setup("Nutuva Organizasyon Bilgilendirme",$_POST["contant"],$all_users[$i]);
                    }
                    $this->goaway("?sayfa=all_users");
                }
                

            }
            $this->goaway("?sayfa=all_users");

        }

        public function referee_manuel_mailer()
        {
            session_start();
            if(isset($_SESSION["user"]) && intval($_SESSION["user"]["uye_yetki"]) == 2){            
            }
            else{
                $this->goaway("");
            }

            $referee_model = $this->model("referee_model");
            //The mail goes to one person at a time
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
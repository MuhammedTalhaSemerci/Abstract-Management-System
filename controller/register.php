<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'controller/PHPMailer/src/Exception.php';
require 'controller/PHPMailer/src/PHPMailer.php';
require 'controller/PHPMailer/src/SMTP.php';

class register extends Controller
{

    public function index()
    {
        session_start();

        $language = $this->language();
        if(isset($_SESSION["register_language"]))
        {
            $language = $language[$_SESSION["register_language"]]["register"];
            $uye_dil = $_SESSION["register_language"];
        }
        else
        {
            $language = $language["tr"]["register"];
            $uye_dil = "tr";
        }

        $model = $this->model("model_abstract");
         //categories
         $abstract_websites = $model->allcategorywebsites();
   
         
        $this->view('kayit',["abstract_websites"=>$abstract_websites,"language"=>$language,"uye_dil"=>$uye_dil]);
    }


  


    
    public function save(){

        $uye_adi = $_POST["kadi"];
        $uye_soyadi = $_POST["ksoyadi"];
        $uye_tel = $_POST["tel"];
        $uye_sehir = $_POST["sehir"];
        $uye_unvan = $_POST["unvan"];
        $uye_uzmanlik = $_POST["uzmanlik"];
        $uye_turu = $_POST["uye_turu"];
        $uye_kurum = $_POST["kurum"];
        $uye_mail = $_POST["mail"];
        $uye_sifre = $_POST["sifre"];

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

        $usermodel = $this->model('users');
        $user_control = $usermodel->getuserreset("uye",$uye_mail);



        if(empty($user_control)){
            $users = $usermodel->insertuser("uye",$uye_adi,$uye_soyadi,$uye_tel,$uye_sehir,$uye_unvan,$uye_uzmanlik,$uye_turu,$uye_kurum,$uye_mail,$uye_sifre,$manager_json);
            
            $to = $uye_mail;
            $subject = "Kayıt Bilgilendirme";
    
            $message = "<h3>Nutuva Organizasyon Bildiri Yönetim Sistemine Hoşgeldiniz</h3><br>
            
            <p>Sayın ".$uye_adi." ".$uye_soyadi.", Nutuva Organizasyon Bildiri Yönetim Sistemi kayıt işleminiz gerçekleştirilmiştir.</p><br>
            Kongre ile ilgili bilgilendirmeleri bu mail üzerinden alacaksınız.  <a href='http://ekongre.nutuva.com/ '>http://ekongre.nutuva.com </a>. Mail adresi ve şifreniz ile sisteme giriş yapabilirsiniz.
            Kongre kaydınızı ve bildiri yükleme işlemlerini online olarak gerçekleştirebilirsiniz. Bildiri değerlendirme sonucunu sistem üzerinden takip edebilirsiniz.</p><br><br>
            <p>Bu mail Nutuva Organizasyon tarafından gönderilmiştir.</p>
            
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

    
            <br>
            Nutuva Organization<br>
            
            <br>
            This message has been sent to you through Nutuva Organization.
            
            
            ";
    
           
    
            $headers = "From: fikretakdis <fikret@nutuva.com>\r\n";
    
            $headers .= "Reply-To: fikretakdis <fikret@nutuva.com>\r\n";
    
            $headers .= "Content-type: text/html\r\n";
    
        
    
    try {
    
            $to   = $uye_mail ;
            $from = 'bilgi@asmguncesi.com';
            $name = 'Nutuva organizasyon bilgilendirme';
            $subj = ' Nutuva organizasyon bilgilendirme:';
            $msg =  $message;
                
            
    
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
            $mail->From="bilgi@asmguncesi.com";
        
            $mail->Sender=$from;
            
            $mail->Subject = $subj;
            $mail->Body = $msg;
            $mail->AddAddress($to);
            $mail->Send();
                    
            echo 'Message has been sent';
    
    
            } 
    
            catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            
            header("location:/?kayit_basari=true");
            exit();
        }
        else{
            header("location:/?kayit_basari=false");
            exit();
        }
        
        
        
    }

    public function update(){

        
        $uye_sifre = $_POST["sifre"];

        $usermodel = $this->model('users');
        $users = $usermodel->insertuser("uye",$uye_adi,$uye_tel,$uye_sehir,$uye_unvan,$uye_uzmanlik,$uye_mail,$uye_sifre);
        header("location:/");
        
    }


    public function post()
    {
        print_r($_POST);
    }

}
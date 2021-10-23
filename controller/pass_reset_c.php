<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'controller/PHPMailer/src/Exception.php';
require 'controller/PHPMailer/src/PHPMailer.php';
require 'controller/PHPMailer/src/SMTP.php';

class pass_reset_c extends Controller{


    public function index(){

        session_start();
        
        $this->view("sifreyenile",[]);


    }

    public function pass_reset(){

        session_start();
        
        $kullanici_mail ="";
        $kullanici_sifre = "" ;

    
        if (!empty($_SESSION["user"])){
            header('Location:/login');
            exit();
        }


        if (!$_POST['email']){
    
            header("location:/login");
            exit();

        }

      

      
               

        if (isset($_POST['reset_request'])){




        $Selector = bin2hex(random_bytes(8));
        $Token = random_bytes(32);
        $url = "http://".$_SERVER["SERVER_NAME"]."/yenisifreolustur?selector=".$Selector."&validator=".bin2hex($Token);
        $Expires = date("U") + 1800;


       
        $user_email = $_POST['email'];

        $dbuye_mail = $this->model("users");
        $dbuye_mail_result= $dbuye_mail->getuserreset("uye",$user_email);




        if ($dbuye_mail_result){


            $dbpwd_mail_pwd = $dbuye_mail->getpwdreset("pwdreset",$user_email);
            
                
                    if($dbpwd_mail_pwd)    {

                        $dbpwd_delete = $dbuye_mail->replacepwdreset("pwdReset",$user_email,$Selector,$Token,$Expires);

                        
                    }
                


                    else{

                        $dbpwd_insert = $dbuye_mail->insertpwdreset("pwdReset",$user_email,$Selector,$Token,$Expires);

                        
                    }


                    

                    $to = $user_email;
                    $subject = "şifre yenileme";

                    $message = "<p>Nutuva Organizasyon olarak şifrenizi değiştirmek için bir istek aldık. Eğer ki şifrenizi değiştirmek istemiyorsanız bu mail'i silebilirsiniz.</p>";

                    $message .= '<p>Şifre yenileme linkiniz: <br>';
                    
                    $message .= '<a href = "'.$url.'">'.$url.'</a></p>';

                    $headers = "From: fikretakdis <fikret@nutuva.com>\r\n";

                    $headers .= "Reply-To: fikretakdis <fikret@nutuva.com>\r\n";

                    $headers .= "Content-type: text/html\r\n";

                

        try {

                    $to   = $user_email ;
                    $from = 'bilgi@asmguncesi.com';
                    $name = 'Nutuva Organizasyon Bildiri Sistemi Şifre Yenileme';
                    $subj = 'Nutuva Organizasyon Bildiri Sistemi Şifre Yenileme :';
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
            header("Location: /sifreyenile?reset=success");
            exit();
        } 

        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

                    

                
            }

            else{

                header("location:/login");
                exit();

            }


        }

        else{


        header("location:/login");
        exit();
        }



    }

    public function new_pass()
    {

        session_start();
        if (isset($_SESSION["user"])){
        header('Location:../login');
        exit();
        }
    

        $this->view("sifreyenile/yenisifreolustur",[]);


    }


    public function new_pass_save()
    {



        $Selector = $_POST['selector'];
        $Token = $_POST['validator'];

        $sifre = $_POST['sifre'];
        $sifretekrar = $_POST['sifretekrar'];

        if(empty($sifre) || empty($sifretekrar)){

            header("location:yenisifreolustur?newpwd=empty");
            exit();

        }

        else if($sifre != $sifretekrar){

            header("location:yenisifreolustur?newpwd=pwdnotsame");
            exit();

        }

        $currentDate = date("U");



        $db_sorgu = $this->model("users");

        $dbuye_pwd = $db_sorgu->getpwd_by_ts("pwdreset",$Token,$Selector);


        if ( $dbuye_pwd["pwdResetSelector"] == $Selector || $dbuye_pwd["pwdResetToken"] == $Token ){

            $db_expire_time = $dbuye_pwd["pwdResetExpires"];
            if ($db_expire_time >= $currentDate){

                $dbuye_pwd = $db_sorgu->insertnewpass("pwdreset",$sifre,$dbuye_pwd);
            
                header("location:/login?sifre_yenile=success");
                exit();
            }
        
            else{

      
                $dbuye_pwd = $db_sorgu->deletepwd("pwdreset",$Token,$Selector);

                header("location:/login?sifre_yenile=timeout");
                exit();
            }
        
        }





    }


}


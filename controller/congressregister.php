<?php 
        
    function turkce($k)
    {
        return iconv('utf-8','iso-8859-9',$k);
    }

  
    require(__DIR__.'/fpdf183/fpdf.php'); 


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'controller/PHPMailer/src/Exception.php';
    require 'controller/PHPMailer/src/PHPMailer.php';
    require 'controller/PHPMailer/src/SMTP.php';
    class congressregister extends Controller
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
       
        public function preregister()
        {
            session_start();

            if(isset($_SESSION["user"])){            
            }
            else
            {
                header("location:/login");
                exit;
            }

            $data = [["Bitki Koruma Kongresi",$_POST["Kayit_ucreti"],[],0]];

            $data = json_encode($data,JSON_UNESCAPED_UNICODE);

            $model = $this->model("users");

            $user_index = $model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);

            $result = $model->congress_pre_register("uye",$user_index["uye_mail"],$data);

            if($result)
            {
                $this->mailer_setup("Kayıt Bilgilendirme Hk.","<h3>Nutuva Organizasyon Kongre Kayıt Bilgilendirme </h3><br>

                Uluslararası Katılımlı 8. Bitki Koruma Kongresine yapmış olduğunuz ön kaydınız başarıyla oluşturulmuştur. İlgili ödeme 
                işlemlerini gerçekleştirdikten sonra dekont gönderimi yapmanız gerekmektedir. Admin onayı sonrası
                davet mektubunuza bildiri yönetim sistemi üzerinden erişebilirsiniz.<br>
                <a href='http://ekongre.nutuva.com/ '>http://ekongre.nutuva.com </a><br><br>
    
              
                <br>
                Nutuva Organizasyon<br>
                
                <br>
                Bu ileti size Nutuva Organizasyon aracılığıyla gönderilmiştir.
                
                <hr>

                <h3>You are welcome to Nutuva Abstract Management System.</h3><br>
    
                Your pre-registration for the 8th Plant Protection Congress with International Participation has been successfully created. 
                After the payment, you need to send a receipt to the Nutuva Abstract Management System. After admin approval,
                you can access your invitation letter through the 'registration status page' of the system. <br>
                <a href='http://ekongre.nutuva.com/'> http://ekongre.nutuva.com </a> <br> <br>

                <br>
                Nutuva Organization<br>
                
                <br>
                This message has been sent to you through Nutuva Organization.
                
                
                ",$user_index["uye_mail"]);
            }
            

            if($result){

                $this->goaway("?sayfa=congress_register_status");
            }
            else{
                echo 'Ön kayıt işlemi sırasında bir hata oluştu.<a href="/abstract_index">Ana Sayfaya gitmek için tıklayın.</a>';
            }


        }



       


        public function imageupload()
        {

            session_start();

            if(isset($_SESSION["user"])){            
            }
            else{
                header("location:/login");
                exit;
            }
            $user_model = $this->model("users");
            $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
            $user_congress_register = json_decode($user_index["withdrawals"]);



            if( isset( $_POST['image_upload'] )  && !empty( $_FILES['down_files'])){

                $document_type= $_POST["document_type"];

               
                
                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                }
                $old = getcwd();
                chdir('view/abstracts/down_files');
                
                //create directory if not exists
                if (!file_exists($_SESSION["user"]["uye_mail"])) {
                
                    mkdir($_SESSION["user"]["uye_mail"], 0777, true);
                    
                }
                chdir($old);
                
            
                $files = $_FILES['down_files'];
                $allowedExts = array("gif", "jpeg", "jpg", "png", "docx", "pdf");
            
            
            
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
                $max_size = 3000;
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
                    chdir("view/abstracts/down_files/".$_SESSION["user"]["uye_mail"]."/");
                    move_uploaded_file($files["tmp_name"][$i],$name);
                    chdir($old);


                    
                    ////////////////////////////////////////////Veritabanı ////////////////////
                            
                }
                
            
            
            
                }

               if($files_flag)
               {
                    for($a=0;$a<count($down_files);$a++){
                        
                        for($i=0;$i<count($user_congress_register);$i++){

                            $value=0;

                            for($b=0;$b<count($user_congress_register[$i][2]);$b++){

                                if($user_congress_register[$i][2][$b][1] == $down_files[$a])
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
                                array_push($user_congress_register[$i][2],[$document_type,$down_files[$a]]); 
                            }
                            else{}
                        }
                        

                    }
                
                    $user_congress_register = json_encode($user_congress_register,JSON_UNESCAPED_UNICODE);
                
                    $result = $user_model->congress_pre_register("uye",$_SESSION["user"]["uye_mail"],$user_congress_register);
                    if($result){
                        $this->goaway("?sayfa=congress_document_upload");
                    }
                }
               
                else
                {
                    $this->goaway("?sayfa=congress_document_upload");
                }
            
            }
            
            
            
            else {
            
            
            
            
            
                
            }
            
            
            
            


        }

        public function imagedelete()
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

            }

            $user_model = $this->model("users");
            $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
            $user_congress_register = json_decode($user_index["withdrawals"]);



            $cakisma =[];
            for($i=0;$i<count($user_congress_register);$i++){
        

                $user_congress_register[$i][2] = array_values($user_congress_register[$i][2]);
                $old = getcwd();
                chdir('view/abstracts/down_files/'.$_SESSION["user"]["uye_mail"]."/");
                for($a=0;$a<count($user_congress_register[$i][2]);$a++){
                    
                    if($user_congress_register[$i][2][$a][1] == $document )
                    {
                        $cakisma = [$i,$a];
                        
                        break;
                    }
                
                }
                
                if(is_array($cakisma))
                {
                    unlink($user_congress_register[$cakisma[0]][2][$cakisma[1]][1]);
                    unset($user_congress_register[$cakisma[0]][2][$cakisma[1]]);
                }    

                chdir($old);


                
                
            $user_congress_register[$i][2] = array_values($user_congress_register[$i][2]);
            }

            

            $user_congress_register = json_encode($user_congress_register,JSON_UNESCAPED_UNICODE);
            
            $result = $user_model->congress_pre_register("uye",$_SESSION["user"]["uye_mail"],$user_congress_register);

            if($result){

                $this->goaway("?sayfa=congress_document_upload");
            }
        

        }


        public function delete_congress_registration()
        {
            session_start();

            if(isset($_SESSION["user"])){            
            }
            else{
                header("location:/login");
                exit;
            }

            $user_model = $this->model("users");

            $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
            $withdrawal = json_decode($user_index["withdrawals"]);

            if($withdrawal[0][3] == 0)
            {
                $sorgu = $user_model->delete_congress_registration("uye",$_SESSION["user"]["uye_mail"]);

                if($sorgu){

                    $this->goaway("?sayfa=congress_register_status");
                }
                else
                {
                    $this->goaway("?sayfa=congress_register_status");   
                }
            }
            else
            {
                $this->goaway("?sayfa=congress_register_status");   
            }
        }

        public function congress_register_document()
        {
            //Düzenlenmeli (bitki koruma kongresi yazısı)
       
            session_start();

            if(isset($_SESSION["user"])){            
            }
            else{
                header("location:/login");
                exit;
            }

            $user_model = $this->model("users");


            $location="";
            for($i=1;$i<count(explode("/",__DIR__))-1;$i++)
            {
                $location .= "/".explode("/",__DIR__)[$i];
            }


            $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);

            //kongre düzenleme
            $withdrawal = json_decode($user_index["withdrawals"]);

            if($withdrawal)
            {
                if(intval($withdrawal[0][3]) == 1)
                {}
                else
                {
                    $this->goaway("?sayfa=congress_register_status");   
                }

                $pdf = new FPDF('P','mm',"A4");
                $pdf->AddPage(); 
                $pdf->AddFont('arial_tr','','arial_tr.php');
                $pdf->AddFont('arial_tr','B','arial_tr_bold.php');
                if($user_index["uye_dil"] == "tr")
                {
                    $pdf->Image($location.'/view/abstracts/pdfsamples/Bitki_Koruma_Kongresi/davet_mektubu.png',0,0,210,300,'PNG');
                }
                else
                {
                    $pdf->Image($location.'/view/abstracts/pdfsamples/Bitki_Koruma_Kongresi/davet_mektubu_'.$user_index["uye_dil"].'.png',0,0,210,300,'PNG');
                }
                $pdf->SetTextColor(45, 55, 55);
                $pdf->SetFont('arial_tr','B',10);
                $pdf->SetXY(63,40);
                $pdf->Write(10,turkce($user_index["uye_adi"]." ".$user_index["uye_soyadi"]));
                $pdf->SetFont('arial_tr','',10);
                $pdf->SetXY(63,48);//eğer ki multicell fonksiyonu y ekseni uzunluğu tespit edilemezse değerini düşür.
                $pdf->MultiCell(60,5,turkce($user_index["uye_kurum"]));
                $pdf->SetXY(63,$pdf->GetY());
                $pdf->Write(10,turkce($user_index["uye_mail"]));
                $pdf->SetXY(73,94.5);
                $pdf->Write(10,turkce($user_index["uye_adi"]." ".$user_index["uye_soyadi"]));


                
                $pdf->Output();

            }
            else
            {
                $this->goaway("?sayfa=congress_register_status");
            }
        }
        

        //////////MAILER SYSTEM////////////////

        public function mailer_setup($subject,$message,$user_mail)
        {
           
            $headers = "From: fikretakdis <fikret@nutuva.com>\r\n";
    
            $headers .= "Reply-To: fikretakdis <fikret@nutuva.com>\r\n";
    
            $headers .= "Content-type: text/html\r\n";
    
        
    
            try 
            {


           
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
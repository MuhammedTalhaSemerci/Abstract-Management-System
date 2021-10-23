<?php

include("../baglan.php");


if($_POST["admin_aidat_gonder"]){

    $aidat_list = $_GET["input_list"];

    for($i=0; $i < intval($aidat_list); $i++){

        $aidat_bilgi = $_POST["uye_aidat_".$i];
        $uye_ad = $_POST["uye_ad_".$i];

    

        $dbuye_aidat= $db->prepare("UPDATE uye SET aidat_ucreti=? WHERE uye_adi=?");
        $result=      $dbuye_aidat->execute([$aidat_bilgi,$uye_ad]);

   
    
    }


        header("location:index.php?sayfa=admin_uye_islem&islem=admin_aidat&basari=success");
       

}


if($_GET["kontrol"]== "admin"){




    session_start();
    
    include("../baglan.php");
    
    $input_sira = 0;
    
    $icerik = $db->query("select * from uye where der_uye_durum ='Evet' order by id desc");
    $icerik-> execute();
    
    
    
    
    while($row = $icerik->fetch(PDO::FETCH_ASSOC)){
    
    	$id = $row['id'];
        $uye_ad = $row["uye_adi"];
        $aidat_ucreti = $row["aidat_ucreti"];
        $kayitdonem= $row['aidat_sonkontrol'];

        if (empty($kayitdonem) || empty($aidat_ucreti))

        {
            
            $kayitdonemi= date("d")."/".date("m")."/".date("y");
            
            $dbuye_aidat= $db->prepare("UPDATE uye SET aidat_ucreti=? , aidat_sonkontrol=? WHERE uye_adi=?");
            $result=      $dbuye_aidat->execute([0,$kayitdonemi,$uye_ad]);
            
        
        }

        else

        {$kayitdonemi=$kayitdonem;}
        
        $kayityil=substr($kayitdonemi,0,2); 

        $kayitay=substr($kayitdonemi,3,2);

        $kayityil=substr($kayitdonemi,6,2); 

        $suanyil=date("y");

        $suanay=date("m");

        $suangun=date("d");

        $ayfarki=$suanay-$kayitay;

        $yilfarki=$suanyil-$kayityil;

        $donemkontrol=12*$yilfarki;

        $aidatzamani=$donemkontrol+$ayfarki;

        if (0 < $aidatzamani)
        {

            $kayitdonemi= date("d")."/".date("m")."/".date("y");
            
            $dbuye_aidat= $db->prepare("UPDATE uye SET aidat_ucreti=? , aidat_sonkontrol=? WHERE uye_adi=?");
            $result=      $dbuye_aidat->execute([$aidatzamani*100,$kayitdonemi,$uye_ad]);

            header("location:index.php?sayfa=admin_uye_islem&islem=admin_aidat");


        }
    
        else
        {

            header("location:index.php?sayfa=admin_uye_islem&islem=admin_aidat");

        }   

 



    
    
    }
    
    
    header("location:index.php?sayfa=admin_uye_islem&islem=admin_aidat");



}




?>
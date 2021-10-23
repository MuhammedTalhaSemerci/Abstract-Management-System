

<?php

session_start();
$k_adi = "antahed";
$k_sifre = "antahed+12";


if($_POST["admin_gonder"]){

$giris_kadi = $_POST["giris_kadi"];
$giris_sifre = $_POST{"giris_sifre"};


        if($k_adi == $giris_kadi && $k_sifre == $giris_sifre){


            $admin_user = array( "k_adi" => $giris_kadi , "k_sifre" => $giris_sifre);

            $_SESSION['admin_user'] = $admin_user;

            echo "Giriş yapıldı.";


        }

        else{

            header("location:./admin_giris.php");
            
        }

}



else{

    if($_SESSION["admin_user"]["k_adi"] == $k_adi && $_SESSION["admin_user"]["k_sifre"] == $k_sifre){

        
        echo "Zaten giriş yapılmış";

    }
else{


    header("location:./admin_giris.php");
    
}



}










?>




<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title> Admin Sayfası</title>
</head>
<body>
    
<style>


body{


    
}

.canliyayin{

    all:unset;
   

margin:auto;
margin-bottom:3%;
width:30%;
height:auto;
font-size:1.5vw;
text-align:center;

font-family: Arial;

display:block;
position:relative;
float:none;




}

.menu-direct{

float:left;
width:50%;
height:auto;



border-bottom: 1px solid black;
border-right: 1px solid black;

border-radius: 0px 0px 1vw 0px;

    


}

.odullu-soru-div{


    width:50%;
height:auto;

margin-left:auto;
margin-right:auto;
margin-bottom:3%;


}





</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
    
    


<div class="menu-direct col-md-6">

<a href="/canliyayin.php" target="_blank"  style=" text-decoration: none; " ><button class="canliyayin form-control col-5">Canlı Yayın Sayfasına Git</button></a>
<div class="odullu-soru-div col-5"> <h3 id="baslik">Soru Bölümü</h3></div>
<a href="/adminpage.php?islem=odullu-soru-sor"style=" text-decoration: none;"><button class="canliyayin form-control col-md-5 col-sm-5 col-5">Ödüllü Soru Sor</button></a>
<a href="/adminpage.php?sayfa=odullu_cevaplar"  style=" text-decoration: none;"><button class="canliyayin form-control col-md-5 col-sm-5 col-5">Ödüllü Soru Cevap Onayla</button></a>
<a href="/adminpage.php?islem=odullu_cekilis" style=" text-decoration: none;"><button class="canliyayin form-control col-md-5 col-sm-5 col-5">Ödüllü Soru Çekiliş Yap</button></a>
<div class="odullu-soru-div col-5"> <h3 id="baslik">Yorumlar Bölümü</h3></div>
<a href="/adminpage.php?sayfa=yorumlar" style=" text-decoration: none;"><button class="canliyayin form-control col-md-5 col-sm-5 col-5">Soru ve Yorumlar</button></a>
<div class="odullu-soru-div col-5"> <h3 id="baslik">Kullanıcı Etkileşimleri</h3></div>
<a href="/adminpage.php?sayfa=admin_aidat" style=" text-decoration: none;"><button class="canliyayin form-control col-md-5 col-sm-5 col-5">Aidat Kontrolü</button></a>
<div class="odullu-soru-div col-5"> <h3 id="baslik">Siteyi Düzenle</h3></div>
<a href="/adminpage.php?sayfa=anasayfa_resim&islem=index" style=" text-decoration: none;"><button class="canliyayin form-control col-md-5 col-sm-5 col-5">Ana Sayfayı Düzenle</button></a>
<a href="/adminpage.php?sayfa=program_akisi&islem=index" style=" text-decoration: none;"><button class="canliyayin form-control col-md-5 col-sm-5 col-5">Program Akışını Düzenle</button></a>
<a href="/adminpage.php?sayfa=eski_yayinlar&islem=index" style=" text-decoration: none;"><button class="canliyayin form-control col-md-5 col-sm-5 col-5">Geçmiş Yayınları Düzenle</button></a>
<a href="/adminpage.php?sayfa=wowza_link" style=" text-decoration: none;"><button class="canliyayin form-control col-md-5 col-sm-5 col-5">Wowza Kaynağı Ekle/Değiştir</button></a>

<div class="odullu-soru-div col-5"> <h3>Bot Ekle</h3></div>

    <form action="adminpage.php" method="POST"  style=" text-decoration: none;">

        <input type="text" name="bot_sayi" class="canliyayin form-control col-md-5 col-sm-5 col-5">

        <input type="submit" name = "gonder" class="canliyayin form-control col-md-5 col-sm-5 col-5">

    </form>

</div>


<div  style="
margin-left:auto;
margin-right:auto;
display:inline-block;

"  class="col-md-6"><?php

if($_GET["islem"] == "odullu-soru-sor"){

    include("odullu_soru_sor.php");

}



if($_GET["sayfa"] == "odullu_cevaplar"){

    include("odullu_cevaplar.php");

}





if($_GET["islem"] == "odullu_cekilis"){

    include("odullu_cekilis.php");

}




if($_GET["sayfa"] == "yorumlar"){

    include("yorumlar.php");

}


if($_GET["sayfa"] == "admin_aidat"){

    include("admin_aidat.php");

}



if($_GET["sayfa"] == "anasayfa_resim"){

    include("anasayfa_resim.php");

}



if($_GET["sayfa"] == "program_akisi"){

    include("program_akisi.php");

}

if($_GET["sayfa"] == "eski_yayinlar"){

    include("admin_eski_yayin.php");

}


if($_GET["sayfa"] == "wowza_link"){

    include("admin_wowza.php");

}

?></div>



</body>
</html>


<?php

include("baglan.php");

if($_POST["gonder"]){

$bot_sayi = $_POST["bot_sayi"]; 

$db_bot = $db->prepare("UPDATE bot SET bot_sayi = ? ");
$db_bot = $db_bot->execute([$bot_sayi]);

if($db_bot){


    header("location:adminpage.php?kayit=true");


}

else{


    echo "başarısız oldu";


}

}

?>


<?php
include("../baglan.php");

$db_kontrol = $db->query("SELECT * FROM wowza_link")->fetch();

?>

<h3>Wowza Kaynağı Ekle/Değiştir</h3>

<form action="./index.php?sayfa=wowza_link" method="POST">    
<textarea class="form-control" name="wowza_link"><?php echo $db_kontrol["wowza_link"];?></textarea>
<input type="submit" name="wowza_gonder">
</form>

<?php



if($_POST["wowza_gonder"]){


$wowza_link = $_POST["wowza_link"];


if (strpos($wowza_link, 'wowza_player') !== false) {

$db_kontrol = $db->query("SELECT * FROM wowza_link")->fetch();

if($db_kontrol){


    $db_update=$db->prepare("UPDATE wowza_link SET wowza_link = ? ");
        $result=$db_update->execute([$wowza_link]);

        
        header("location:index.php?sayfa=wowza_link");

}

else{


    $db_ekle = $db->prepare("INSERT INTO wowza_link SET wowza_link = ?");
    $db_ekle->execute([$wowza_link]);

         header("location:index.php?sayfa=wowza_link");


}




}


else{


    header("location:index.php?sayfa=wowza_link");



}



}





?>

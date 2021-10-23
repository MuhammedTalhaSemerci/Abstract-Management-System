

<?php 
 include("../baglan.php");
switch(@$_GET["islem"]){
case "index":
   
?>


<html>
<head>
<meta http-equiv="refresh" content="5" >
</head>
<body>

 


<h3>Geçmiş Yayınları Düzenle</h3>


<a href='index.php?islem=yeni_ekle&id=$id&sayfa=eski_yayinlar' align="center">Geçmiş Yayın Ekle</a>

<?php
$icerik = $db->query("select * from eskiyayinlar order by id desc");
$icerik-> execute();
while($row = $icerik->fetch(PDO::FETCH_ASSOC)){
	$id = $row['id'];
	$konu = $row['konu'];
	$konusmaci = $row['konusmaci'];
	$tarih = $row['tarih'];
	$url = $row['url_dir'];

echo"<div align='center'>
<table>



<tr><td ><font color='red'><b>Konu:</b></font></td></tr>
<tr><td > <colspan='2'><b>$konu</b></td></tr>
<tr><td ><font color='red'><b>Konuşmacı:</b></font></td></tr>
<tr><td > <colspan='2'><b>$konusmaci</b></td></tr>
<tr><td ><font color='red'><b>Tarih:</b></font></td></tr>
<tr><td > <colspan='2'><b>$tarih</b></td></tr>
<tr><td ><font color='red'><b>Url:</b></font></td></tr>
<tr><td > <colspan='2'><b>$url</b></td></tr>

<tr>
<td ><br />
<a href='index.php?islem=duzenleislem&id=$id&sayfa=eski_yayinlar'>Düzenle</a> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href='index.php?islem=silislem&id=$id&sayfa=eski_yayinlar'>Sil</a>
</td>
<td></td>
<td></td></tr>
</table>
</div> <hr />";
}

?>




 <?php
break;
?>



<?php


case "silislem":
    include("baglan.php");
$id=$_GET["id"];
$icerik = $db -> query("DELETE FROM eskiyayinlar WHERE id=$id");
if($icerik){header("Location:index.php?islem=index&sayfa=eski_yayinlar");}else{echo"Silme İşleminde hata oluştu";}
break;






case "duzenleislem":

    include("baglan.php");

    $id_duzenle = $_GET["id"];
    $db_kontrol= $db->query("SELECT * FROM eskiyayinlar WHERE id = '$id_duzenle'")->fetch();
    ?>

<form action="index.php?sayfa=eski_yayinlar&islem=db_duzenle&id=<?php echo $id_duzenle;?>" method="post">
        
        <P style="all:unset;">Konu:</P>&emsp;&emsp;<input style="width:100%" type="text" name="konu" value="<?php echo $db_kontrol["konu"];?>"><br>
        <P style="all:unset;">Konuşmacı:</P><input style="width:100%" type="text" name="konusmaci" value="<?php echo $db_kontrol["konusmaci"];?>"><br>
        <P style="all:unset;">Tarih:</P>&emsp;&emsp;&emsp;<input type="text" name="tarih" value="<?php echo $db_kontrol["tarih"];?>"><br>
        <P style="all:unset;">Url:</P>&emsp;&emsp;&emsp; <textarea class="form-control" name="url" ><?php echo $db_kontrol["url_dir"];?></textarea><br>
        <input type="submit" value="Gönder" >

</form>


<?php
break;

case "db_duzenle":

    include("baglan.php");
  
    $id_duzenle = $_GET["id"];

    $konu = $_POST["konu"];
    $konusmaci = $_POST["konusmaci"];
    $tarih = $_POST["tarih"];
    $url = $_POST["url"];

    $db_duzenle=$db->prepare("UPDATE eskiyayinlar SET konu = ? , konusmaci = ?,  tarih = ? , url_dir = ?  WHERE id = ?");
    $result=$db_duzenle->execute([$konu,$konusmaci,$tarih,$url,$id_duzenle]);

        if($result){

            header("Location:index.php?islem=index&sayfa=eski_yayinlar");

        }

        else{

            header("Location:index.php?islem=index&sayfa=eski_yayinlar");

        }
   
    

break;







case "yeni_ekle":
    include("baglan.php");
?>

<form action="index.php?islem=yeni_ekle&sayfa=eski_yayinlar" method="post" enctype="multipart/form-data">



        <P style="all:unset;">Konu:</P>&emsp;&emsp;<input style="width:100%" type="text" name="konu" ><br><br>
        <P style="all:unset;">Konuşmacı:</P><input style="width:100%" type="text" name="konusmaci" ><br><br>
        <P style="all:unset;">Tarih:</P>&emsp;&emsp;&emsp;<input type="text" name="tarih" ><br><br>
        <P style="all:unset;">Url:</P>&emsp;&emsp;&emsp;<textarea class="form-control" name="url" ></textarea><br>

         <input type="submit" value="Gönder" name="submit">

  
</form>


    <?php

 


   




    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {

        $ekle11 = $db->prepare("INSERT INTO eskiyayinlar SET konu = ? , konusmaci = ? , tarih = ? , url_dir = ?");
        $ekle11 ->execute([$_POST["konu"],$_POST["konusmaci"],$_POST["tarih"],$_POST["url"]]);
        if($ekle11){
        
    
        header("Location:adminpage.php");
        
        }
        else{
            header("Location:index.php?islem=index&sayfa=eski_yayinlar");
        }

    
}
break;


default:

break;
}
?>
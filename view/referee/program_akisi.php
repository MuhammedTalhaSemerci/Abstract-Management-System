

<?php
session_start();
ob_start();
?>



<?php 
include("../baglan.php");
switch(@$_GET["islem"]){
case "index":
?>



 <h3>Program Akışını Düzenle</h3>



<?php

echo '<a href="index.php?islem=yeni_ekle&sayfa=program_akisi" align="center">Yeni Program Ekle</a>';

$icerik = $db->query("select * from program_akisi order by id desc");
$icerik-> execute();
while($row = $icerik->fetch(PDO::FETCH_ASSOC)){
	$id = $row['id'];
	$cevap_ad = $row['konu'];
	$soru = $row['konusmaci'];
	$cevap = $row['moderator'];
    $tarih = $row['tarih'];
    $saat = $row['saat'];
    $sponsor_res = $row['sponsor_res'];
echo"<div align='center'>
<table>



<tr><td ><font color='red'><b>Konu:</b></font></td></tr>
<tr><td > <colspan='2'><b>$cevap_ad</b></td></tr>
<tr><td ><font color='red'><b>Konuşmacı</b></font></td></tr>
<tr><td > <colspan='2'><b>$soru</b></td></tr>
<tr><td ><font color='red'><b>Moderatör:</b></font></td></tr>
<tr><td>  <colspan='2'>$cevap</td></tr>
<tr><td ><font color='red'><b>Tarih ve Saat:</b></font></td></tr>
<tr><td>  <colspan='2'>$tarih - $saat </td></tr>
<tr><td ><font color='red'><b>Sponsor Resiminin İsmi:</b></font></td></tr>
<tr><td>  <colspan='2'>$sponsor_res </td></tr>
<tr>
<td ><br />
<a href='index.php?islem=duzenleislem&id=$id&sayfa=program_akisi'>Düzenle</a> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href='index.php?islem=silislem&id=$id&sayfa=program_akisi'>Sil</a>
</td>
<td></td>
<td></td></tr>
</table>
</div> <hr />";
}


break;
?>



<?php


case "silislem":
  
$id=$_GET["id"];

$db_kontrol= $db->query("SELECT * FROM program_akisi WHERE id = '$id'")->fetch();

  $old = getcwd(); // Save the current directory
	chdir("../sponsor_res");
	unlink($db_kontrol["sponsor_res"]);
	chdir($old);

$icerik = $db -> query("DELETE FROM program_akisi WHERE id=$id");
if($icerik){header("Location:index.php?islem=index&sayfa=program_akisi");}else{echo"Silme İşleminde hata oluştu";}
break;

case "cikis":
session_destroy();
header("Location:index.php");
break;



case "duzenleislem":

    $id_duzenle = $_GET["id"];
    $db_kontrol= $db->query("SELECT * FROM program_akisi WHERE id = '$id_duzenle'")->fetch();
    ?>

<form action="index.php?sayfa=program_akisi&islem=db_duzenle&id=<?php echo $id_duzenle;?>" method="post" enctype="multipart/form-data">
        <P style="all:unset;">Konu:</P>&emsp;&emsp;<input style="width:100%" type="text" name="konu" value="<?php echo $db_kontrol["konu"];?>"><br>
        <P style="all:unset;">Konuşmacı:</P><input style="width:100%" type="text" name="konusmaci" value="<?php echo $db_kontrol["konusmaci"];?>"><br>
        <P style="all:unset;">Moderatör:</P><input style="width:100%" type="text" name="moderator" value="<?php echo $db_kontrol["moderator"];?>"><br>
        <P style="all:unset;">Tarih:</P>&emsp;&emsp;&emsp;<input type="text" name="tarih" value="<?php echo $db_kontrol["tarih"];?>"><br>
        <P style="all:unset;">Saat:</P>&emsp;&emsp;&emsp;<input type="text" name="saat" value="<?php echo $db_kontrol["saat"];?>"><br>
        Yüklemek için bir resim seçin:
        <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
        <input type="submit" value="Gönder" name="submit">

</form>


<?php
break;

case "db_duzenle":
  
    $id_duzenle = $_GET["id"];

    $konu = $_POST["konu"];
    $konusmaci = $_POST["konusmaci"];
    $moderator = $_POST["moderator"];
    $tarih = $_POST["tarih"];
    $saat = $_POST["saat"];


    
   
    
    
        $target_dir = "../sponsor_res/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
    
    
       
    
    
    
    
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {


          $db_kontrol= $db->query("SELECT * FROM program_akisi WHERE id = '$id_duzenle'")->fetch();
          $old = getcwd(); // Save the current directory
          chdir("../sponsor_res/");
          unlink($db_kontrol["sponsor_res"]);
          chdir($old);

        $db_duzenle=$db->prepare("UPDATE program_akisi SET konu = ? , konusmaci = ?, moderator = ? , tarih = ? , saat = ? , sponsor_res = ? WHERE id = ?");
        $result=$db_duzenle->execute([$konu,$konusmaci,$moderator,$tarih,$saat,$_FILES["fileToUpload"]["name"],$id_duzenle]);

            if($result){

              $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
              if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
              } else {
                echo "File is not an image.";
                $uploadOk = 0;
              }
           
            
            // Check if file already exists
            if (file_exists($target_file)) {
              echo "Sorry, file already exists.";
              $uploadOk = 0;
            }
            
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 5000000) {
              echo "Sorry, your file is too large.";
              $uploadOk = 0;
            }
            
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
              echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
              $uploadOk = 0;
            }
            
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
              echo "Sorry, your file was not uploaded.";
              header("Location:index.php?islem=index&sayfa=program_akisi");
            // if everything is ok, try to upload file
            } else {
              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                header("Location:index.php?islem=index&sayfa=program_akisi");
              } else {
                echo "Sorry, there was an error uploading your file.";
                header("Location:index.php?islem=index&sayfa=program_akisi");
              }
            }
          
            }


          else{
              header("Location:index.php?islem=index&sayfa=program_akisi");
          }

             

            }

            else{

                header("Location:index.php?islem=index&sayfa=program_akisi");

            }
    
    
    
       
            
          
        
    
      
    
    

break;


case "yeni_ekle":


?>
    <form action="index.php?sayfa=program_akisi&islem=db_yeni_ekle" method="post" enctype="multipart/form-data">
        <p style="all:unset;">Konu: </p>&emsp;&emsp;<input style="width:100%" type="text" name="konu" placeholder="Örnek: Ankara'nın fethi"><br>
        <p style="all:unset;">Konuşmacı: </p><input style="width:100%" type="text" name="konusmaci" placeholder="Örnek: Dr. Kahraman Çelik"><br>
        <p style="all:unset;">Moderatör:</p><input style="width:100%" type="text" name="moderator" placeholder="Örnek: Doç. Dr. Eyüp Karaca"><br>
        <p style="all:unset;">Tarih:</p>&emsp;&emsp;&emsp;<input type="text" name="tarih" placeholder="Örnek: 12/10/2020"><br>
        <P style="all:unset;">Saat:</P>&emsp;&emsp;&emsp;<input type="text" name="saat" placeholder="Örnek: 12.30-17.30"><br>
       

        Yüklemek için bir resim seçin:
        <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
     
        <input type="submit" value="Gönder" name="submit">

  
</form>



<?php
break;

case "db_yeni_ekle":

    $konu = $_POST["konu"];
    $konusmaci = $_POST["konusmaci"];
    $moderator = $_POST["moderator"];
    $tarih = $_POST["tarih"];
    $saat = $_POST["saat"];


    
    $target_dir = "../sponsor_res/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    


   




    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {



        $ekle = $db->prepare("INSERT INTO program_akisi SET konu = ?, konusmaci = ? , moderator = ? , tarih = ? , saat = ? , sponsor_res = ?");
        $ekle ->execute([$konu,$konusmaci,$moderator,$tarih,$saat,$_FILES["fileToUpload"]["name"]]);
        if($ekle){
        
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
              echo "File is an image - " . $check["mime"] . ".";
              $uploadOk = 1;
            } else {
              echo "File is not an image.";
              $uploadOk = 0;
            }
         
          
          // Check if file already exists
          if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
          }
          
          // Check file size
          if ($_FILES["fileToUpload"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
          }
          
          // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
          }
          
          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            header("Location:index.php?islem=index&sayfa=program_akisi");
          // if everything is ok, try to upload file
          } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
              echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
              header("Location:index.php?islem=index&sayfa=program_akisi");
            } else {
              echo "Sorry, there was an error uploading your file.";
              header("Location:index.php?islem=index&sayfa=program_akisi");
            }
          }
        
        }
        else{
            header("Location:index.php?islem=index&sayfa=program_akisi");
        }
    

  
}


break;


default:

break;
}

ob_end_flush();
?>









<?php
session_start();
ob_start();
?>
<h5>Yorumları kopyalamak için yorumların üzerine tıklamanız gerekmektedir.</h5><br>
<a href="index.php?islem=onaybekleyen&sayfa=yorumlar">Onay Bekleyen Yorumlar</a>
<a href="index.php?islem=onaylanan&sayfa=yorumlar">Onaylanmış Yorumlar</a>



<html>
<head>
<meta http-equiv="refresh" content="5" >
</head>
<body>

<?php 
include("../baglan.php");
switch(@$_GET["islem"]){
case "onaybekleyen":




?>



 

<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

<script type="text/javascript">





function copyStringToClipboard (str) {
   // Create new element
   var el = document.createElement('textarea');
   // Set value (string to be copied)
   el.value = str;
   // Set non-editable to avoid focus and move outside of view
   el.setAttribute('readonly', '');
   el.style = {position: 'absolute', left: '-9999px'};
   document.body.appendChild(el);
   // Select text inside element
   el.select();
   // Copy text to clipboard
   document.execCommand('copy');
   // Remove temporary element
   document.body.removeChild(el);
}



function kopyala(kopyala_id,html){

	
		
		cleanText = html.split('</font>');
		cleanText[0] = cleanText[0].replace(/<\/?[^>]+(>|$)/g , "");
		cleanText[1] = cleanText[1].replace(/<\/?[^>]+(>|$)/g , "");
    
  copyStringToClipboard(cleanText[0]+" - "+cleanText[1]);
  alert("Yorum Kopyalandı.")
        
    }







</script>





<?php

$yorum_index = 0 ;

$icerik = $db->query("select * from yorumlar where onay='0' order by id desc");
$icerik-> execute();
while($row = $icerik->fetch(PDO::FETCH_ASSOC)){
	$id = $row['id'];
	$ekleyen = $row['ekleyen'];
	$yorum = $row['yorum'];
	


echo'<div>
<table>
<tr>
<td ><font color="red"><b>Ad-Soyad</b></font></td></tr>

<tr><td>

<button style="all:unset; word-break: break-all; type="button" class="button"  id="ekleyen_'.$yorum_index.'"   onClick="kopyala(this.id,this.innerHTML);" ><font color="0099FF">'.$ekleyen."</font> <br> ".$yorum.'</button><br><br>

</tr></td>

<tr>
<td ><br />
<a href="index.php?islem=onaylaislem&id='.$id.'&sayfa=yorumlar"><img src="images/ok.png" alt="onayla" title="onayla" width="25px" height="25px"/></a> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="index.php?islem=onaysizsilislem&id='.$id.'&sayfa=yorumlar"><img src="images/del.png" alt="sil" title="sil" width="25px" height="25px"/></a>
</td>
</tr>
</table>
</div> <hr />';

$yorum_index += 1;

}


?>




 <?php
break;
case "onaylanan":
?>
<script> src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

<script type="text/javascript">





function copyStringToClipboard (str) {
   // Create new element
   var el = document.createElement('textarea');
   // Set value (string to be copied)
   el.value = str;
   // Set non-editable to avoid focus and move outside of view
   el.setAttribute('readonly', '');
   el.style = {position: 'absolute', left: '-9999px'};
   document.body.appendChild(el);
   // Select text inside element
   el.select();
   // Copy text to clipboard
   document.execCommand('copy');
   // Remove temporary element
   document.body.removeChild(el);
}



function kopyala(kopyala_id,html){

	
		
		cleanText = html.split('</font>');
		cleanText[0] = cleanText[0].replace(/<\/?[^>]+(>|$)/g , "");
		cleanText[1] = cleanText[1].replace(/<\/?[^>]+(>|$)/g , "");
    
  copyStringToClipboard(cleanText[0]+" - "+cleanText[1]);
  alert("Yorum Kopyalandı.")
        
    }







</script>

<?php
$icerik = $db->query("select * from yorumlar where onay='1' order by id desc");
$icerik-> execute();
while($row = $icerik->fetch(PDO::FETCH_ASSOC)){
	$id = $row['id'];
	$ekleyen = $row['ekleyen'];
	$yorum = $row['yorum'];


echo'<div>
<table>
<tr>
<td ><font color="red"><b>Ad-Soyad</b></font></td></tr>
<tr><td>

<button style="all:unset; word-break: break-all; type="button" class="button"  id="ekleyen_'.$yorum_index.'"   onClick="kopyala(this.id,this.innerHTML);" ><font color="0099FF">'.$ekleyen."</font> <br> ".$yorum.'</button><br><br>

</tr></td>

<tr>
<td ><br />

<a href="index.php?islem=onaylisilislem&id='.$id.'&sayfa=yorumlar"><img src="images/del.png" alt="sil" title="sil" width="25px" height="25px"/></a>
</td>
</tr>

</table>
</div> <hr />';
}
?>


<?php
break;
case "onaylaislem":
$id=$_GET["id"];
$icerik = $db -> query("UPDATE yorumlar SET onay = '1' WHERE id ='$id'");
if($icerik){header("Location:index.php?islem=onaybekleyen&sayfa=yorumlar");}else{echo"onaylama İşleminde hata oluştu";}
break;

case "onaylisilislem":
$id=$_GET["id"];
$icerik = $db -> query("DELETE FROM yorumlar WHERE id=$id");
if($icerik){header("Location:index.php?islem=onaylanan&sayfa=yorumlar");}else{echo"Silme İşleminde hata oluştu";}
break;

case "onaysizsilislem":
$id=$_GET["id"];
$icerik = $db -> query("DELETE FROM yorumlar WHERE id=$id");
if($icerik){header("Location:index.php?islem=onaybekleyen&sayfa=yorumlar");}else{echo"Silme İşleminde hata oluştu";}
break;

case "cikis":
session_destroy();
header("Location:index.php");
break;
default:
?>

<?php
break;
}

ob_end_flush();
?>

</body>
</html>






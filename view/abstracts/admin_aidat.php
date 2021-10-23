


<a href="./admin_aidat_backend.php?kontrol=admin" align="center"> <button>Otomatik Aidat Kontrolü</button></a>

<br><br>

<?php

session_start();

include("../baglan.php");

$input_sira = 0;

$icerik = $db->query("select * from uye where der_uye_durum ='Evet' order by id desc");
$icerik-> execute();




while($row = $icerik->fetch(PDO::FETCH_ASSOC)){



$input_sira += 1;

}







echo '




<form action="./admin_aidat_backend.php?input_list='.$input_sira.'" method="post">

<div align="center">
<input type="submit" name="admin_aidat_gonder" value="Manuel Kontrol" style="margin:auto;"></div>';


if($_GET["basari"]== "success"){


    echo "Kayıt işlemi başarılı oldu";

}

$input_sira = 0;
$icerik = $db->query("select * from uye where der_uye_durum ='Evet' order by id desc");
$icerik-> execute();

while($row = $icerik->fetch(PDO::FETCH_ASSOC)){
	$id = $row['id'];
    $uye_ad = $row["uye_adi"];
	$aidat_ucreti = $row["aidat_ucreti"];

echo'<div align="center">
<table>




<tr><td ><font color="red"><b>Ad-Soyad:</b></font></td></tr>
<tr><td > <colspan="2"><b>'.$uye_ad.'</b></td></tr>



<tr>
<td ><br />

<input type="hidden" value="'.$uye_ad.'" name="uye_ad_'.$input_sira.'">
<h5>Aidat Ücreti:</h5>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" value="'.$aidat_ucreti.'" name="uye_aidat_'.$input_sira.'">
</td>
<td></td>
<td></td></tr>
</table>
</div> <hr />';

$input_sira += 1;

}






?>

</form>
<a href="./index.php?sayfa=admin_uye_islem&islem=uye_ekle" align="center"> Yeni Üye Ekle</a>
<a href="./index.php?sayfa=admin_uye_islem&islem=uye_sil" align="center">Üye Sil</a>
<a href="./index.php?sayfa=admin_uye_islem&islem=admin_aidat" align="center">Üye Aidat Kontrolü</a>

<br>
<?php


include("../baglan.php");
switch(@$_GET["islem"]){
    case "admin_aidat":

        include("./admin_aidat.php");

        break;


    case "uye_ekle":

        $yorum_index = 0 ;

        $icerik = $db->query("select * from uye where der_uye_durum <>'Evet' order by id desc");
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
        <a href="index.php?islem=db_uye_ekle&id='.$id.'&sayfa=admin_uye_islem">Üye Yap</a> 

        </td>
        <td></td>
        <td></td></tr>
        </table>
        </div> <hr />';

        $input_sira += 1;

        }


        break;


    case "db_uye_ekle":
        $id = $_GET["id"];

        $dbuye_aidat= $db->prepare("UPDATE uye SET der_uye_durum=?  WHERE id=?");
        $result=      $dbuye_aidat->execute(["Evet",$id]);

        header("location:index.php?sayfa=admin_uye_islem&islem=uye_ekle");

        break;


    case "uye_sil":

        $yorum_index = 0 ;

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
        <a href="index.php?islem=db_uye_sil&id='.$id.'&sayfa=admin_uye_islem">Üye Sil</a> 

        </td>
        <td></td>
        <td></td></tr>
        </table>
        </div> <hr />';

        $input_sira += 1;
        }
        break;


    case "db_uye_sil":
        $id = $_GET["id"];

        $dbuye_aidat= $db->prepare("UPDATE uye SET der_uye_durum=?  WHERE id=?");
        $result=      $dbuye_aidat->execute(["hayır",$id]);

        header("location:index.php?sayfa=admin_uye_islem&islem=uye_sil");

        break;    

    default:

        break;

    }






?>






















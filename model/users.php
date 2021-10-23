<?php

class Users extends Model {

    public function getAll()
    {
        return $this->db->query('SELECT * FROM uye ORDER BY id DESC')->fetchAll();
    }


    public function getuserindex($table,$first,$second)
    {

        return $this->db->query("SELECT * FROM $table WHERE uye_mail = '$first' AND uye_sifre='$second' ")->fetch(PDO::FETCH_ASSOC);
    }

    public function getuserreset($table,$first)
    {

        return $this->db->query("SELECT * FROM $table WHERE uye_mail = '$first'")->fetch(PDO::FETCH_ASSOC);
    }

    
    public function getuserbyid($table,$first)
    {
        return $this->db->query("SELECT * FROM $table WHERE id = '$first' ")->fetch(PDO::FETCH_ASSOC);
    }


//////////////////pwd bölgesi////////////


    public function getpwdreset($table,$first)
    {

        return $this->db->query("SELECT * FROM $table WHERE pwdResetEmail = '$first'")->fetch(PDO::FETCH_ASSOC);
    }



    public function getpwd_by_ts($table,$Token,$Selector)
    {

        return $this->db->query("SELECT * FROM $table WHERE pwdResetToken = '$Token' AND pwdResetSelector='$Selector'")->fetch(PDO::FETCH_ASSOC);
    }



    public function replacepwdreset($table,$user_email,$Selector,$Token,$Expires)
    {


        $sil = $this->db->prepare("DELETE FROM pwdreset WHERE pwdResetEmail = ?");

        $sil -> execute ([$user_email] );

        $hata  = $sil -> errorInfo();



        $ekle = $this->db->prepare("INSERT INTO pwdreset SET pwdResetEmail = ?, pwdresetSelector = ? , pwdResetToken = ? , pwdResetExpires = ?");
        $db_result = $ekle ->execute([$user_email , $Selector , bin2hex($Token) , $Expires]);
        if($db_result){

            return $db_result;

        }
        else{

            return NULL;
            
        }
    }


    public function insertpwdreset($table,$user_email,$Selector,$Token,$Expires)
    {


        
        $ekle = $this->db->prepare("INSERT INTO pwdreset SET pwdResetEmail = ?, pwdresetSelector = ? , pwdResetToken = ? , pwdResetExpires = ?");
        $db_result = $ekle ->execute([$user_email , $Selector ,bin2hex($Token), $Expires]);
       
        if($db_result){

            return $db_result;

        }
        else{

            return NULL;
            
        }

    }


    public function insertnewpass($table,$sifre,$dbuye_pwd)
    {


        $stmt=$this->db->prepare("UPDATE uye SET uye_sifre=? WHERE uye_mail=?");
        $result=$stmt->execute([$sifre,$dbuye_pwd["pwdResetEmail"]]);

        if($result){

            return $result;

        }
        else{

            return NULL;
            
        }

    }


    public function deletepwd($table,$Token,$Selector)
    {

        $stmt=$this->db->prepare("DELETE FROM uye WHERE pwdResetToken=? , pwdResetSelector ");
        $result=$stmt->execute([$Token,$Selector]);

        if($result){

            return $result;

        }
        else{

            return NULL;
            
        }



    }

    

/////////////////////////////////////

    public function insertuser($table,$uye_adi,$uye_soyadi,$uye_tel,$uye_sehir,$uye_unvan,$uye_uzmanlik,$uye_turu,$uye_kurum,$uye_mail,$uye_sifre,$manager_json)
    {	



        $db_sorgu = $this->db->prepare("INSERT INTO uye SET uye_adi = ?,uye_soyadi=?, uye_tel = ?, uye_sehir = ?, uye_unvan = ?,uye_uzmanlik=?, uye_turu=?, uye_kurum=?, uye_mail = ?, uye_sifre = ?, referee_category=?, uye_yetki = ?, uye_kod=? ");
        $db_result = $db_sorgu->execute([$uye_adi,$uye_soyadi,$uye_tel,$uye_sehir,$uye_unvan,$uye_uzmanlik,$uye_turu,$uye_kurum,$uye_mail,$uye_sifre,$manager_json,'0','0']);
        
        if($db_result){

            return $db_result;

        }
        else{

            return NULL;
            
        }
    }    


    public function profileupdate($uye_mail,$uye_adi,$uye_soyadi,$uye_tel,$uye_sehir,
    $uye_unvan,$uye_uzmanlik,$uye_kurum,$uye_fatura_isim,$uye_fatura_vergi_no,
    $uye_fatura_vergi_dairesi,$uye_fatura_not,$uye_fatura_mail,$uye_fatura_adres,$uye_kargo_adres)
    {

        $sorgu = $this->db->prepare("UPDATE uye SET uye_adi=?,uye_soyadi=?, uye_tel=?, uye_sehir=?, uye_unvan=?, uye_uzmanlik=?, uye_kurum=?, uye_fatura_isim=?, uye_fatura_vergi_no=?, uye_fatura_vergi_dairesi=?, uye_fatura_not=?, uye_fatura_mail=?, uye_fatura_adres=?, uye_kargo_adres=? WHERE uye_mail=?");
        $db_result = $sorgu->execute([$uye_adi,$uye_soyadi,$uye_tel,$uye_sehir,
        $uye_unvan,$uye_uzmanlik,$uye_kurum,$uye_fatura_isim,$uye_fatura_vergi_no,
        $uye_fatura_vergi_dairesi,$uye_fatura_not,$uye_fatura_mail,$uye_fatura_adres,$uye_kargo_adres,$uye_mail]);

        if($db_result){

            return $db_result;

        }
        else{

            return NULL;
            
        }

    }


    public function congress_pre_register($table,$uye_mail,$data)
    {

        $sorgu = $this->db->prepare("UPDATE $table SET withdrawals=? WHERE uye_mail=?");
        $db_result = $sorgu->execute([$data,$uye_mail]);

        if($db_result){

            return $db_result;

        }
        else{

            return NULL;
            
        }

    }



    public function congress_pre_register_description($table,$uye_mail,$data)
    {

        $sorgu = $this->db->prepare("UPDATE $table SET uye_aciklama=? WHERE uye_mail=?");
        $db_result = $sorgu->execute([$data,$uye_mail]);

        if($db_result){

            return $db_result;

        }
        else{

            return NULL;
            
        }

    }
    
    public function delete_congress_registration($table,$uye_mail)
    {

        $sorgu = $this->db->prepare("UPDATE $table SET withdrawals=? WHERE uye_mail=?");
        $db_result = $sorgu->execute([null,$uye_mail]);

        if($db_result){

            return $db_result;

        }
        else{

            return NULL;
            
        }

    }


    
    public function main_language_changer($table,$uye_dil,$uye_mail)
    {

        $sorgu = $this->db->prepare("UPDATE $table SET uye_dil=? WHERE uye_mail=?");
        $db_result = $sorgu->execute([$uye_dil,$uye_mail]);

        if($db_result){

            return $db_result;

        }
        else{

            return NULL;
            
        }

    }

/*
    public function deneme($table,$html){

        $db_sorgu = $this->db->prepare("INSERT INTO deneme SET deneme=?");
        $db_result = $db_sorgu->execute([$html]);
        
        if(isset($db_result)){

            return $db_result;

        }
        else{

            return NULL;
            
        }


    }



    public function denemeselect(){

        return $this->db->query("SELECT * FROM deneme")->fetch();
        
        
      


    }
*/
    
}



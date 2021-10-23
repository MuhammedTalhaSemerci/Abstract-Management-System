<?php

class Users extends Model {

    public function getAll()
    {
        return $this->db->query('SELECT * FROM uye')->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getuserindex($table,$first,$second)
    {

        return $this->db->query("SELECT * FROM $table WHERE uye_mail = '$first' AND uye_sifre='$second' ")->fetch();
    }

    public function getuserreset($table,$first)
    {

        return $this->db->query("SELECT * FROM $table WHERE uye_mail = '$first'")->fetch();
    }





//////////////////pwd bölgesi////////////


    public function getpwdreset($table,$first)
    {

        return $this->db->query("SELECT * FROM $table WHERE pwdResetEmail = '$first'")->fetch();
    }



    public function getpwd_by_ts($table,$Token,$Selector)
    {

        return $this->db->query("SELECT * FROM $table WHERE pwdResetToken = '$Token' AND pwdResetSelector='$Selector'")->fetch();
    }



    public function replacepwdreset($table,$user_email,$Selector,$Token,$Expires)
    {


        $sil = $this->db->prepare("DELETE FROM pwdreset WHERE pwdResetEmail = ?");

        $sil -> execute ([$user_email] );

        $hata  = $sil -> errorInfo();



        $ekle = $this->db->prepare("INSERT INTO pwdreset SET pwdResetEmail = ?, pwdresetSelector = ? , pwdResetToken = ? , pwdResetExpires = ?");
        $db_result = $ekle ->execute([$user_email , $Selector , bin2hex($Token) , $Expires]);
        if(isset($db_result)){

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
       
        if(isset($db_result)){

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

        if(isset($result)){

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

        if(isset($result)){

            return $result;

        }
        else{

            return NULL;
            
        }



    }

/////////////////////////////////////

    public function insertuser($table,$uye_adi,$uye_tel,$uye_sehir,$uye_unvan,$uye_uzmanlik,$uye_mail,$uye_sifre)
    {	

        $db_sorgu = $this->db->prepare("INSERT INTO uye SET uye_adi = ?, uye_tel = ?, uye_sehir = ?, uye_unvan = ?, uye_uzmanlik = ?, uye_mail = ?, uye_sifre = ?, uye_yetki = ?, uye_kod=? ");
        $db_result = $db_sorgu->execute([$uye_adi,$uye_tel,$uye_sehir,$uye_unvan,$uye_uzmanlik,$uye_mail,$uye_sifre,'0','0']);
        
        if(isset($db_result)){

            return $db_result;

        }
        else{

            return NULL;
            
        }
    }    


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

        return $this->db->query("SELECT * FROM deneme order by is desc ")->fetch();
        
        
      


    }

    
}



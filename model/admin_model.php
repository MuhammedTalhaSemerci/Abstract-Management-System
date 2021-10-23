<?php

    class admin_model extends Model 
    {

        public function getallusers()
        {

            return $this->db->query("SELECT * FROM uye ORDER BY id DESC ")->fetchAll();


        }

        public function getwithone($table,$tableone,$one)
        {

            return $this->db->query("SELECT * FROM $table WHERE $tableone='$one'")->fetchAll();


        }


        public function getwithtwo($table,$tableone,$one,$tabletwo,$two)
        {

            return $this->db->query("SELECT * FROM $table WHERE $tableone='$one' AND $tabletwo='$two'")->fetchAll();


        }


        public function getwiththree($table,$tableone,$one,$tabletwo,$two,$tablethree,$three)
        {

            return $this->db->query("SELECT * FROM $table WHERE $tableone='$one' AND $tabletwo='$two' AND $tablethree='$three'")->fetchAll();


        }

        public function getuserbyadmin($table,$first)
        {
            return $this->db->query("SELECT * FROM $table WHERE id = '$first' ")->fetch(PDO::FETCH_ASSOC);
        }


        public function get_all_abstracts_by_category($table,$abstract_category,$abstract_type)
        {
            return $this->db->query("SELECT * FROM $table WHERE abstract_category = '$abstract_category' AND abstract_type = '$abstract_type' order by last_abstract_no desc")->fetch(PDO::FETCH_ASSOC);
        }
            
        public function admin_authority_change($table,$uye_yetki,$uye_id)
        {

            $sorgu = $this->db->prepare("UPDATE $table SET uye_yetki=? WHERE id=? ");
            $sorgu->bindParam(1, $uye_yetki, PDO::PARAM_STR);
            $sorgu->bindParam(2, $uye_id, PDO::PARAM_STR);

    
            $sorgu->execute();

        
            if($sorgu){

                return $sorgu;

            }
            else{

                return NULL;
                
            }



        }

        
        public function admin_user_update($uye_id,$uye_adi,$uye_soyadi,$uye_tel,$uye_sehir,$uye_unvan,$uye_uzmanlik,$uye_kurum,$uye_turu,$referee_arr)
        {

            $sorgu = $this->db->prepare("UPDATE uye SET uye_adi=?,uye_soyadi=?, uye_tel=?, uye_sehir=?, uye_unvan=?, uye_uzmanlik=?, uye_kurum=?, uye_turu=?, referee_category=? WHERE id=?");
            $db_result = $sorgu->execute([$uye_adi,$uye_soyadi,$uye_tel,$uye_sehir,$uye_unvan,$uye_uzmanlik,$uye_kurum,$uye_turu,$referee_arr,$uye_id]);

            if($db_result){

                return $db_result;

            }
            else{

                return NULL;
                
            }

        }
        
        public function admin_sponsor_authorization_update($table,$sponsor_company,$id)
        {
            $sorgu = $this->db->prepare("UPDATE $table SET sponsor_company=? WHERE id=?");
            $db_result = $sorgu->execute([$sponsor_company,$id]);

            if($db_result){

                return $db_result;

            }
            else{

                return NULL;
                
            }
        }

        public function admin_stand_authorization_update($table,$stand_info,$id)
        {
            $sorgu = $this->db->prepare("UPDATE $table SET stand_info=? WHERE id=?");
            $db_result = $sorgu->execute([$stand_info,$id]);

            if($db_result){

                return $db_result;

            }
            else{

                return NULL;
                
            }
        }

        public function admin_withdrawal_update($table,$uye_id,$withdrawal)
        {

            $sorgu = $this->db->prepare("UPDATE $table SET withdrawals=? WHERE id=?");
            $db_result = $sorgu->execute([$withdrawal,$uye_id]);

            if($db_result){

                return $db_result;

            }
            else{

                return NULL;
                
            }

        }
        public function admin_paid_val_update($table,$uye_id,$paid_val)
        {

            $sorgu = $this->db->prepare("UPDATE $table SET uye_odenen=? WHERE id=?");
            $db_result = $sorgu->execute([$paid_val,$uye_id]);

            if($db_result){

                return $db_result;

            }
            else{

                return NULL;
                
            }

        }

        public function admin_abstract_authorization_update($referee_ids,$abstract_no)
        {
    
            $sorgu = $this->db->prepare("UPDATE abstracts SET  referee_ids=? WHERE abstract_no=?");
            $db_result = $sorgu->execute([$referee_ids,$abstract_no]);

            if($db_result){

                return $db_result;

            }
            else{

                return NULL;
                
            }
    
        }

          public function abstract_main_author_id_save($table,$main_author_id,$abstract_no)
        {

            $sorgu = $this->db->prepare("UPDATE $table SET main_author_id=? WHERE abstract_no=?");
            $db_result = $sorgu->execute([$main_author_id,$abstract_no]);

            if($db_result){

                return $db_result;

            }
            else{

                return NULL;
                
            }

        }
        

        public function admin_abstract_main_author_mail_compare_save($table,$main_author_id,$abstract_no)
        {

            $sorgu = $this->db->prepare("UPDATE $table SET main_author_id=? WHERE abstract_no=?");
            $db_result = $sorgu->execute([$main_author_id,$abstract_no]);

            if($db_result){

                return $db_result;

            }
            else{

                return NULL;
                
            }

        }

        public function admin_abstract_accept($table,$acception,$last_abstract_no,$abstract_no)
        {

            $sorgu = $this->db->prepare("UPDATE $table SET accepted=?, last_abstract_no=? WHERE abstract_no=?");
            $db_result = $sorgu->execute([$acception,$last_abstract_no,$abstract_no]);

            if($db_result){

                return $db_result;

            }
            else{

                return NULL;
                
            }

        }
        


        public function admin_scientific_program_save($table,$scientific_program)
        {

            $sorgu = $this->db->prepare("UPDATE $table SET scientific_program=? WHERE id=?");
            $db_result = $sorgu->execute([$scientific_program,"4"]);

            if($db_result){

                return $db_result;

            }
            else{

                return NULL;
                
            }

        }


        
            
        public function admin_abstract_delete($abstract_no)
        {
        
            $abstract_control = $this->db->query("SELECT * FROM abstracts WHERE  abstract_no='$abstract_no' ");

            if(isset($abstract_control)){

                $abstract_delete = $this->db->prepare("DELETE FROM abstracts WHERE abstract_no=? ");
                $abstract_result = $abstract_delete->execute([$abstract_no]);
        
                if(isset($abstract_result)){
        
                    return $abstract_result;
        
                }
                else{
        
                    return NULL;
                    
                }
        

            }
            else{
                return NULL;
            }
        


        }


        public function admin_accept_users_bill_info($data,$id)
        {

            $sorgu = $this->db->prepare("UPDATE uye SET  uye_fatura_kontrol=? WHERE id=?");
            $db_result = $sorgu->execute([$data,$id]);

            if($db_result){

                return $db_result;

            }
            else{

                return NULL;
                
            }

        }


        
        public function admin_accept_users_cargo_info($data,$id)
        {

            $sorgu = $this->db->prepare("UPDATE uye SET  uye_kargo_kontrol=? WHERE id=?");
            $db_result = $sorgu->execute([$data,$id]);

            if($db_result){

                return $db_result;

            }
            else{

                return NULL;
                
            }

        }


         
        public function virtual_congress_button_info_save($data,$congress)
        {

            $sorgu = $this->db->prepare("UPDATE categories SET  admin_virtual_congress_but_infos=? WHERE id=?");
            $db_result = $sorgu->execute([$data,$congress]);

            if($db_result){

                return $db_result;

            }
            else{

                return NULL;
                
            }

        }


        
        


    }
   



?>
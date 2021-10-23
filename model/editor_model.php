<?php

    class editor_model extends Model 
    {

        public function getallusers()
        {

            return $this->db->query("SELECT * FROM uye")->fetchAll();


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

        public function getuserbyeditor($table,$first)
        {
            return $this->db->query("SELECT * FROM $table WHERE id = '$first' ")->fetch(PDO::FETCH_ASSOC);
        }


        public function get_all_abstracts_by_category($table,$abstract_category,$abstract_type)
        {
            return $this->db->query("SELECT * FROM $table WHERE abstract_category = '$abstract_category' AND abstract_type = '$abstract_type' order by last_abstract_no desc")->fetch(PDO::FETCH_ASSOC);
        }
            
        public function editor_authority_change($table,$uye_yetki,$uye_id)
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

        
        public function editor_user_update($uye_id,$uye_adi,$uye_soyadi,$uye_tel,$uye_sehir,$uye_unvan,$uye_uzmanlik,$uye_kurum,$uye_turu,$referee_arr)
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
        


        public function editor_abstract_authorization_update($referee_ids,$abstract_no)
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


        public function editor_abstract_accept($table,$acception,$last_abstract_no,$abstract_no)
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

        
        
    public function editor_abstract_delete($abstract_no)
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


    }
   



?>
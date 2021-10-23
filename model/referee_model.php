<?php

    class referee_model extends Model 
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

        public function getuserbyreferee($table,$first)
        {
            return $this->db->query("SELECT * FROM $table WHERE id = '$first' ")->fetch(PDO::FETCH_ASSOC);
        }

        public function get_all_admin_editor()
        {
            return $this->db->query("SELECT * FROM uye WHERE uye_yetki = '1' OR uye_yetki ='3' ")->fetchAll();
        }

        


        public function referee_abstract_accept($table,$acception,$abstract_no)
        {

            $sorgu = $this->db->prepare("UPDATE $table SET accepted=? WHERE abstract_no=?");
            $db_result = $sorgu->execute([$acception,$abstract_no]);

            if($db_result){

                return $db_result;

            }
            else{

                return NULL;
                
            }

        }
        

        public function referee_abstract_edit_request_save($table,$edit_sentences_json,$referee_comments_json,$abstract_no)
        {

            $sorgu = $this->db->prepare("UPDATE $table SET edit_requests=?, referee_comments=? WHERE abstract_no=?");
            $db_result = $sorgu->execute([$edit_sentences_json,$referee_comments_json,$abstract_no]);

            if($db_result){

                return $db_result;

            }
            else{

                return NULL;
                
            }

        }

    }
   



?>
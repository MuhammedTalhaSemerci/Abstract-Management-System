<?php

    class virtual_congress_model extends Model
    {
        public function allcategorywebsites()
        {
            return $this->db->query("SELECT * FROM categories ")->fetchAll();
        }

        public function getallabstractsbytype($type)
        {
            return $this->db->query("SELECT * FROM abstracts WHERE abstract_type='$type' ORDER BY abstract_no DESC")->fetchAll();
        }

        public function getStandOfficers($table,$company)
        {
            return $this->db->query("SELECT * FROM $table WHERE stand_info='$company' ORDER BY id DESC")->fetchAll();
        }

        public function getAllPermittedUsers($table,$value)
        {
            return $this->db->query("SELECT * FROM $table WHERE uye_yetki='$value' ORDER BY id DESC")->fetchAll();
        }

        public function test_session_connection_time($test_session_connection_time,$uye_mail)
        {
            $sorgu = $this->db->prepare("UPDATE uye SET test_session_connection_time=? WHERE uye_mail =?");
            $result = $sorgu->execute([$test_session_connection_time,$uye_mail]);
            if($result)
            {
                return $db_result;
            }
            else{
                return NULL;
            }
        }

    }


?>
<?php


class model_abstract extends Model
{

                                    
    public function abstract_save($register_id,$abstract_site,$abstract_category,$abstract_sub_category,$main_author,$other_author,$alt_contact,$abstract_type,$abstract_language,$title,$contant,$keywords,$title_english,$contant_english,$keywords_english,$supports,$comments)
    {

        $abstract_save = $this->db->prepare("INSERT INTO abstracts SET abstract_site=?, register_id=?, abstract_category=?,abstract_sub_category=?, main_author=?, other_author=?, alt_contact=?, abstract_type=?, abstract_language=?, title=?,contant=?, keywords=?,title_english=?,contant_english=?, keywords_english=?, supports=?, comments=?");
        $abstract_result = $abstract_save->execute([$abstract_site,$register_id,$abstract_category,$abstract_sub_category,$main_author,$other_author,$alt_contact,$abstract_type,$abstract_language,$title,$contant,$keywords,$title_english,$contant_english,$keywords_english,$supports,$comments]);

        if(isset($abstract_result)){

            return $abstract_result;

        }
        else{

            return NULL;
            
        }



    }



    public function abstract_update($abstract_no,$alt_contact,$abstract_type,$abstract_language,$title,$contant,$keywords,$title_english,$contant_english,$keywords_english,$supports,$comments,$accepted)
    {

        $sorgu = $this->db->prepare("UPDATE abstracts SET alt_contact=?, abstract_type=?, abstract_language=?, title=?,contant=?, keywords=?, title_english=?,contant_english=?, keywords_english=?, supports=?, comments=?, accepted=? WHERE abstract_no=? ");
        $sorgu->bindParam(1, $alt_contact, PDO::PARAM_STR);
        $sorgu->bindParam(2, $abstract_type, PDO::PARAM_STR);
        $sorgu->bindParam(3, $abstract_language, PDO::PARAM_STR);
        $sorgu->bindParam(4, $title, PDO::PARAM_STR);
        $sorgu->bindParam(5, $contant, PDO::PARAM_STR);
        $sorgu->bindParam(6, $keywords, PDO::PARAM_STR);
        $sorgu->bindParam(7, $title_english, PDO::PARAM_STR);
        $sorgu->bindParam(8, $contant_english, PDO::PARAM_STR);
        $sorgu->bindParam(9, $keywords_english, PDO::PARAM_STR);
        $sorgu->bindParam(10, $supports, PDO::PARAM_STR);
        $sorgu->bindParam(11, $comments, PDO::PARAM_STR);
        $sorgu->bindParam(12, $accepted, PDO::PARAM_INT);
        $sorgu->bindParam(13, $abstract_no, PDO::PARAM_INT);
        $sorgu->execute();

      
        if(isset($sorgu)){

            return $sorgu;

        }
        else{

            return NULL;
            
        }



    }


    public function abstract_author_update($abstract_no,$main_author,$other_author)
    {

        $sorgu = $this->db->prepare("UPDATE abstracts SET main_author=?, other_author=? WHERE abstract_no=? ");
        $sorgu->bindParam(1, $main_author, PDO::PARAM_STR);
        $sorgu->bindParam(2, $other_author, PDO::PARAM_STR);
        $sorgu->bindParam(3, $abstract_no, PDO::PARAM_INT);
   
        $sorgu->execute();

      
        if(isset($sorgu)){

            return $sorgu;

        }
        else{

            return NULL;
            
        }



    }


    
    public function abstract_category_update($abstract_no,$abstract_website,$abstract_category,$abstract_sub_category)
    {

        $sorgu = $this->db->prepare("UPDATE abstracts SET abstract_site=?, abstract_category=?, abstract_sub_category=? WHERE abstract_no=? ");
        $sorgu->bindParam(1, $abstract_website, PDO::PARAM_STR);
        $sorgu->bindParam(2, $abstract_category, PDO::PARAM_STR);
        $sorgu->bindParam(3, $abstract_sub_category, PDO::PARAM_STR);
        $sorgu->bindParam(4, $abstract_no, PDO::PARAM_INT);
   
        $sorgu->execute();

      
        if(isset($sorgu)){

            return $sorgu;

        }
        else{

            return NULL;
            
        }



    }


    public function abstract_delete($abstract_no,$register_id)
    {
       
        $abstract_control = $this->db->query("SELECT * FROM abstracts WHERE register_id='$register_id' AND abstract_no='$abstract_no' ");

        if(isset($abstract_control)){

            $abstract_delete = $this->db->prepare("DELETE FROM abstracts WHERE abstract_no=? AND register_id=? ");
            $abstract_result = $abstract_delete->execute([$abstract_no,$register_id]);
    
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


    
        public function last_abstract_accept($table,$acception,$last_abstract_no,$abstract_no)
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


        public function arrangement_save($table,$acception,$abstract_no)
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

        public function presentation_upload($table,$presentation_files,$abstract_no)
        {

            $sorgu = $this->db->prepare("UPDATE $table SET presentation_files=?  WHERE abstract_no=?");
            $db_result = $sorgu->execute([$presentation_files,$abstract_no]);

            if($db_result){

                return $db_result;

            }
            else{

                return NULL;
                
            }

        }
        
        
        public function sponsor_document_upload($table,$sponsor_congress_logo_but_infos,$id)
        {

            $sorgu = $this->db->prepare("UPDATE $table SET sponsor_congress_logo_but_infos=?  WHERE id=?");
            $db_result = $sorgu->execute([$sponsor_congress_logo_but_infos,$id]);

            if($db_result){

                return $db_result;

            }
            else{

                return NULL;
                
            }

        }
        
        
        public function sponsor_congress_logo_but_infos_save($but_infos,$id)
        {
            $sorgu = $this->db->prepare("UPDATE categories SET sponsor_congress_logo_but_infos=?  WHERE id=?");
            $db_result = $sorgu->execute([$but_infos,$id]);

            if($db_result){

                return $db_result;

            }
            else{

                return NULL;
                
            }
        }


    public function allcategorywebsites()
    {
        return $this->db->query("SELECT * FROM categories ")->fetchAll();
    }

    public function onecategorywebsite($congress)
    {
        return $this->db->query("SELECT * FROM categories WHERE congress='$congress'")->fetch(PDO::FETCH_ASSOC);
    }

    public function getallusersabstracts(){

        return $this->db->query("SELECT * FROM abstracts order by abstract_no desc")->fetchAll();

    }

    public function getallusersacceptedabstracts(){

        return $this->db->query("SELECT * FROM abstracts WHERE accepted='1' order by abstract_no desc")->fetchAll();

    }

    public function getallabstracts($user_id){

        return $this->db->query("SELECT * FROM abstracts WHERE register_id='$user_id' order by abstract_no desc")->fetchAll();

    }

    public function getallabstracts_main_author($user_id){

        return $this->db->query("SELECT * FROM abstracts WHERE main_author_id='$user_id' order by abstract_no desc")->fetchAll();

    }
    
    public function getabstractinfo($abstract_no){

        return $this->db->query("SELECT * FROM abstracts WHERE abstract_no='$abstract_no' ")->fetch(PDO::FETCH_ASSOC);

    }

    public function get_all_admin_editor()
    {
        return $this->db->query("SELECT * FROM uye WHERE uye_yetki = '1' OR uye_yetki ='3' ")->fetchAll();
    }

    public function get_all_abstracts_by_category($table,$abstract_category,$abstract_type)
    {
        return $this->db->query("SELECT * FROM $table WHERE abstract_category = '$abstract_category' AND abstract_type = '$abstract_type' order by last_abstract_no desc")->fetch(PDO::FETCH_ASSOC);
    }
    public function get_all_abstracts_by_category_booker($table,$abstract_category,$abstract_type)
    {
        return $this->db->query("SELECT * FROM $table WHERE abstract_category = '$abstract_category' AND abstract_type = '$abstract_type' AND accepted ='1' order by last_abstract_no")->fetchAll();
    }

}
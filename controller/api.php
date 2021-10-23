<?php

class api extends Controller
{
    public function all_abstracts($all_abstracts)
        {

            $all_abstracts_arr = [];

            for($i=0;$i<count($all_abstracts);$i++)
            {




                $abstract_main_name= json_decode($all_abstracts[$i]["main_author"])[0];
                $abstract_main_surname= json_decode($all_abstracts[$i]["main_author"])[1];
                $abstract_main_mail= json_decode($all_abstracts[$i]["main_author"])[3];
                $abstract_other_contact = $all_abstracts[$i]["alt_contact"];
                $abstract_id = $all_abstracts[$i]["abstract_no"];
                $accepted = $all_abstracts[$i]["accepted"];
                $abstract_title = strip_tags($all_abstracts[$i]["title"]);
                $abstract_sub_category = $all_abstracts[$i]["abstract_sub_category"];
                $abstract_edit_requests = $all_abstracts[$i]["edit_requests"];
                $abstract_referee_comments = $all_abstracts[$i]["referee_comments"];
                $abstract_referee_ids = $all_abstracts[$i]["referee_ids"];
                $abstract_type = $all_abstracts[$i]["abstract_type"];
                $register_id = $all_abstracts[$i]["register_id"];
                $abstract_english_title = strip_tags($all_abstracts[$i]["title_english"]);
                $abstract_main_author_id = strip_tags($all_abstracts[$i]["main_author_id"]);
                $abstract_category = strip_tags($all_abstracts[$i]["abstract_category"]);


                
                




                ##########################################
                $abstract_main_author = json_decode($all_abstracts[$i]["main_author"]);
                $abstract_other_author = json_decode($all_abstracts[$i]["other_author"]);

                if($abstract_other_author != null)
                {
                    if(array_key_exists(4,$abstract_main_author))
                    {
                        array_splice($abstract_other_author,intval($abstract_main_author[4])-1,0,[$abstract_main_author]);
                        $abstract_all_authors = $abstract_other_author; 
                    }
                    else
                    {
                        $abstract_main_author[4] = 1;
                        array_splice($abstract_other_author,0,0,[$abstract_main_author]);
                        $abstract_all_authors = $abstract_other_author; 
                    }
                }
    
                else
                {
                    $abstract_main_author[4] = 1;
                    $abstract_all_authors = [$abstract_main_author];
                }
                $abstract_main_author = [];
                $abstract_other_author = [];

                $abstract_all_authors_html ="";

                for($a=0;$a<count($abstract_all_authors);$a++)
                {
                    if(array_key_exists(4,$abstract_all_authors[$a]) && $abstract_all_authors[$a][4] == ($a+1))
                    {
                        if($a == 0)
                        {
                            $abstract_all_authors_html .= '<u>'.mb_convert_case($abstract_all_authors[$a][0], MB_CASE_TITLE, "UTF-8").' '.mb_strtoupper($abstract_all_authors[$a][1]).'</u>';
                        }
                        else
                        {
                            $abstract_all_authors_html .= ', <u>'.mb_convert_case($abstract_all_authors[$a][0], MB_CASE_TITLE, "UTF-8").' '.mb_strtoupper($abstract_all_authors[$a][1]).'</u>';
                        }
                    }
                    else
                    {
                        if($a == 0)
                        {
                            $abstract_all_authors_html .= mb_convert_case($abstract_all_authors[$a][0], MB_CASE_TITLE, "UTF-8").' '.mb_strtoupper($abstract_all_authors[$a][1]);
                        }
                        else
                        {
                            $abstract_all_authors_html .= ', '.mb_convert_case($abstract_all_authors[$a][0], MB_CASE_TITLE, "UTF-8").' '.mb_strtoupper($abstract_all_authors[$a][1]);
                        }
                    }
                }

                ###################################################


                if($all_abstracts[$i])

                $abstract_category_char = mb_strtoupper($all_abstracts[$i]["abstract_category"][0]);
                if(strpos($all_abstracts[$i]["abstract_type"],"-"))
                {
                    $abstract_type_char = mb_strtoupper($all_abstracts[$i]["abstract_type"][strpos($all_abstracts[$i]["abstract_type"],"-")+1]);
                }
                else
                {
                    $abstract_type_char = mb_strtoupper($all_abstracts[$i]["abstract_type"][0]);
                }
                $last_abstract_no = intval($all_abstracts[$i]["last_abstract_no"]);
                
            
                array_push($all_abstracts_arr, 
                [
                    $abstract_main_name,
                    $abstract_main_surname,
                    $abstract_main_mail,
                    $abstract_other_contact,
                    $abstract_id,
                    $accepted,
                    $abstract_title,
                    $abstract_sub_category,
                    $abstract_edit_requests,
                    $abstract_referee_comments,
                    $abstract_referee_ids,
                    $abstract_all_authors_html,
                    $abstract_type,
                    $last_abstract_no,
                    $register_id,
                    $abstract_english_title,
                    $abstract_main_author_id,
                    $abstract_category
                ]);
                
            }

            return $all_abstracts_arr;
        }

    public function scientific_program_iframe()
    {
        $salt ="8943yrt049pwgf3tgbı3pğv0wefrgn90h530pg3emnı0";

        $user_model = $this->model("users");
        $admin_model = $this->model("admin_model");
        $abstract_model = $this->model("model_abstract");

        if(isset($_GET["salt"]) && isset($_GET["lang"]))
        {
            if($salt == $_GET["salt"])
            {
                $all_abstracts = $abstract_model->getallusersabstracts();
                $all_users = $admin_model->getallusers();
                $language = $this->language()[$_GET["lang"]]["scientific_program_viewer"];
                //categories
                $abstract_websites = $abstract_model->allcategorywebsites();
                $all_abstracts = $this->all_abstracts($all_abstracts);
                $this->view("abstracts/scientific_program_viewer",[
                    "all_users"=>$all_users,
                    "language"=>$language,
                    "abstract_websites"=>$abstract_websites,
                    "scientific_program_all_abstracts"=>$all_abstracts,
                    "uye_dil"=>$_GET["lang"],
                ]);
            }
        }
    }

}

?>
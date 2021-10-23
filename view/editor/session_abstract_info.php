<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
    
        :is(p,h1,h2,h3,h4,h5,h6)
        {
            margin-left:20px;
        }


     
        table
        {
            margin:20px; 
        }

       
    </style>

</head>

<body>
    <br>
    <?php
    
    function hour_replace($hours)
    {
        $find = [",","/","-",":","_","|",";"];
 
        for($i=0;$i<count($find);$i++)
        {
            $hours = str_replace($find[$i],".",$hours);
        }
        return $hours;
    }

    function secs_to_hours($secs)
    {
        $hours = intval($secs/(60*60));
        $mins = intval(($secs-($hours*60*60))/60) ;

        return ($mins < 10) ? $hours."."."0".strval($mins) : $hours.".".strval($mins);
    } 

    function hours_to_secs($hours)
    {

        $hours = hour_replace($hours);
        $hours_mins = explode(".",$hours);
        $secs = intval($hours_mins[0])*60*60+intval($hours_mins[1])*60;
        return $secs;

    
    }

   



    $cakisma = 0;
    $scientific_program = json_decode($abstract_websites[0]["scientific_program"]);

    foreach($scientific_program as $gun => $value)
    {
        foreach($scientific_program->{$gun} as $saloon => $value1)
        {
            $saloon_start_time = hours_to_secs($scientific_program->{$gun}->{$saloon}->{"start_time"});
        
            foreach($scientific_program->{$gun}->{$saloon} as $session => $value2)
            {
                if($session != "tr" && $session != "en" && $session != "start_time")
                {
                    if($scientific_program->{$gun}->{$saloon}->{$session}->{"manager"} == $primer_user["id"])
                    {     

                        if($cakisma == 0)
                        {
                            echo'<h4 style="margin-top:20px;">'.$language[0].'</h4>';

                        }
                        $session_presentation_files = [];
                        $bbb_session_name = "";
                        echo '<table>';

                        

                            $name ="";
                            if($uye_dil == "tr")
                            {
                                $name = "name";
                            } 
                            else
                            {
                                $name = "name_".$uye_dil;
                            }
                            if($scientific_program->{$gun}->{$saloon}->{$session}->{"break"} == 1)
                            {
                                $session_delay_secs = intval($scientific_program->{$gun}->{$saloon}->{$session}->{"time"})*60;
                                echo '<tr class=" abstract_list gun_'.$gun_index.' salon_'.$saloon_index.'"><td style="border: 1px solid black;background-color:rgba(255, 231, 36,1);color:white;">'.hour_replace(secs_to_hours($saloon_start_time)).'-'.hour_replace(secs_to_hours($saloon_start_time+$session_delay_secs)).'</td><td colspan="3" style="border: 1px solid black;background-color:rgba(255, 231, 36,1);color:white;">'.$scientific_program->{$gun}->{$saloon}->{$session}->{$name}.'</td></tr>';
                                $saloon_start_time += $session_delay_secs;
                            }

                            else if($scientific_program->{$gun}->{$saloon}->{$session}->{"break"} == 2)
                            {
                                if(intval($session_delay_secs = $scientific_program->{$gun}->{$saloon}->{$session}->{"time"}) > 0)
                                {
                                    $session_delay_secs = intval($scientific_program->{$gun}->{$saloon}->{$session}->{"time"})*60;
                                    echo '<tr class=" abstract_list gun_'.$gun_index.' salon_'.$saloon_index.'"><td style="border: 1px solid black;background-color:purple;color:white;">'.hour_replace(secs_to_hours($saloon_start_time)).'-'.hour_replace(secs_to_hours($saloon_start_time+$session_delay_secs)).'</td><td style="border: 1px solid black;background-color:purple;color:white;">'.$scientific_program->{$gun}->{$saloon}->{$session}->{"cell_".$uye_dil."_2"}.'</td><td style="border: 1px solid black;background-color:purple;color:white;">'.$scientific_program->{$gun}->{$saloon}->{$session}->{"cell_".$uye_dil."_3"}.'</td><td style="border: 1px solid black;background-color:purple;color:white;"></td></tr>';
                                    $saloon_start_time += $session_delay_secs;
                                    
                                }
                
                                else
                                {
                                    echo '<tr class=" abstract_list gun_'.$gun_index.' salon_'.$saloon_index.'"><td style="border: 1px solid black;background-color:purple;color:white;"></td><td style="border: 1px solid black;background-color:purple;color:white;">'.$scientific_program->{$gun}->{$saloon}->{$session}->{"cell_".$uye_dil."_2"}.'</td><td style="border: 1px solid black;background-color:purple;color:white;">'.$scientific_program->{$gun}->{$saloon}->{$session}->{"cell_".$uye_dil."_3"}.'</td><td style="border: 1px solid black;background-color:purple;color:white;"></td></tr>';
                                }
                            }
                            else
                            {
                                $bbb_session_name = $scientific_program->{$gun}->{$saloon}->{$session}->{"name"};
                                $suggestion_sum_time = 0;
                                $suggestion_count =0;

                                for($a=0;$a<count($scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"});$a++)
                                {
                                    if($scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"}[$a][0] == "suggestion")
                                    {
                                        $suggestion_sum_time += intval($scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"}[$a][3]);
                                        $suggestion_count +=1;
                                    }
                                }

                                $abstracts_delay_secs = (intval(count($scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"})) > 0) ? ((intval($scientific_program->{$gun}->{$saloon}->{$session}->{"time"})-$suggestion_sum_time)/intval(count($scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"})-$suggestion_count))*60 : intval($scientific_program->{$gun}->{$saloon}->{$session}->{"time"})*60;
                                $session_delay_secs = intval($scientific_program->{$gun}->{$saloon}->{$session}->{"time"})*60;
                                
                                $manager_degree = "";
                                $manager_name = "";
                                $manager_surname = "";
                                for($i=0;$i<count($all_users);$i++)
                                {
                                    if($scientific_program->{$gun}->{$saloon}->{$session}->{"manager"} == $all_users[$i]["id"])
                                    {
                                    
                                        $manager_name = mb_convert_case($all_users[$i]["uye_adi"], MB_CASE_TITLE, "UTF-8");
                                        $manager_surname = mb_strtoupper($all_users[$i]["uye_soyadi"]);
                                        $manager_degree = $language[1].' '.$all_users[$i]["uye_unvan"];
                                    
                                    }
                                    else
                                    {
                                        continue;
                                    }
                                }
                                
                                echo '<tr class=" abstract_list gun_'.$gun_index.' salon_'.$saloon_index.'"><td style="border: 1px solid black;background-color:purple;color:white;">'.hour_replace(secs_to_hours($saloon_start_time)).'-'.hour_replace(secs_to_hours($saloon_start_time+$session_delay_secs)).'</td><td colspan="2" style="border: 1px solid black;background-color:purple;color:white;">'.$scientific_program->{$gun}->{$saloon}->{$session}->{$name}.'</td><td style="border: 1px solid black;background-color:purple;color:white;">'.$manager_degree.' '.$manager_name." ".$manager_surname.'</td></tr>';
                                
                                $suggestion=0;
                                $abstract_time_finish=$saloon_start_time;
                                for($a=0;$a<count($scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"});$a++)
                                {        
                                    for($i=0;$i<count($scientific_program_all_abstracts);$i++)
                                    {
                                      

                                        if($scientific_program_all_abstracts[$i][4] == $scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"}[$a][0])
                                        {
                                            $abstract_time = $abstract_time_finish;
                                            $abstract_time_hour =($scientific_program->{$gun}->{$saloon}->{$session}->{"time_state"} == 1)? secs_to_hours($abstract_time):"";
                                            $abstract_time_finish = $abstract_time_finish+$abstracts_delay_secs;
                                            $abstract_finish_time_hour = ($scientific_program->{$gun}->{$saloon}->{$session}->{"time_state"} == 1)? secs_to_hours($abstract_time_finish):"";
                                            
                                            $abstract_category_char = mb_strtoupper($scientific_program_all_abstracts[$i][17][0]);
                                            if(strpos($scientific_program_all_abstracts[$i][12],"-"))
                                            {
                                                $abstract_type_char = mb_strtoupper($scientific_program_all_abstracts[$i][12][strpos($scientific_program_all_abstracts[$i][12],"-")+1]);
                                            }
                                            else
                                            {
                                                $abstract_type_char = mb_strtoupper($scientific_program_all_abstracts[$i][12][0]);
                                            }
                                            $last_abstract_no = intval($scientific_program_all_abstracts[$i][13]);

                                            array_push($session_presentation_files,$abstract_category_char.$abstract_type_char.$last_abstract_no."/".$scientific_program_all_abstracts[$i][18]);
                             
                                            if($uye_dil == "tr")
                                            {
                                                echo '<tr class="abstract_list gun_'.$gun_index.' salon_'.$saloon_index.'"><td style="border: 1px solid black;">'.$abstract_time_hour.'-'.$abstract_finish_time_hour.'</td><td style="border: 1px solid black;">'.$abstract_category_char.$abstract_type_char.$last_abstract_no.'</td><td style="border: 1px solid black;">'.$scientific_program_all_abstracts[$i][6].'</td><td style="border: 1px solid black;">'.$scientific_program_all_abstracts[$i][11].'</td></tr>';
                                            }
                                            else
                                            {
                                                if(isset($scientific_program_all_abstracts[$i][15]))
                                                {
                                                    echo '<tr class="abstract_list gun_'.$gun_index.' salon_'.$saloon_index.'"><td style="border: 1px solid black;">'.$abstract_time_hour.'-'.$abstract_finish_time_hour.'</td><td style="border: 1px solid black;">'.$abstract_category_char.$abstract_type_char.$last_abstract_no.'</td><td style="border: 1px solid black;">'.$scientific_program_all_abstracts[$i][15].'</td><td style="border: 1px solid black;">'.$scientific_program_all_abstracts[$i][11].'</td></tr>';
                                                }
                                                else
                                                {
                                                    echo '<tr class="abstract_list gun_'.$gun_index.' salon_'.$saloon_index.'"><td style="border: 1px solid black;">'.$abstract_time_hour.'-'.$abstract_finish_time_hour.'</td><td style="border: 1px solid black;">'.$abstract_category_char.$abstract_type_char.$last_abstract_no.'</td><td style="border: 1px solid black;">'.$scientific_program_all_abstracts[$i][6].'</td><td style="border: 1px solid black;">'.$scientific_program_all_abstracts[$i][11].'</td></tr>';
                                                }
                                                
                                            }
                                        }
                                    }
                                    if($scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"}[$a][0] === "suggestion")
                                    {
                                        $abstract_time = $abstract_time_finish;
                                        $abstract_time_hour =($scientific_program->{$gun}->{$saloon}->{$session}->{"time_state"} == 1)? secs_to_hours($abstract_time):"";
                                        $suggestion = intval($scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"}[$a][3])*60;
                                        $abstract_time_finish = $abstract_time_finish+$suggestion;
                                        $abstract_finish_time_hour = ($scientific_program->{$gun}->{$saloon}->{$session}->{"time_state"} == 1)? secs_to_hours($abstract_time_finish):"";
                                        $tartisma = ($uye_dil =="tr")? $scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"}[$a][1]:$scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"}[$a][2];
                                        echo '<tr class="abstract_list gun_'.$gun_index.' salon_'.$saloon_index.'"><td style="border: 1px solid black;">'.$abstract_time_hour.'-'.$abstract_finish_time_hour.'</td><td colspan="3" style="border: 1px solid black;">'.$tartisma.'</td></tr>';
                                                
                                    }
                                }
                                $session_take_moment = $saloon_start_time;
                                $saloon_start_time += $session_delay_secs;

                            }
                            

                        
                        echo '</table>';


                        $session_name_str = ($uye_dil == "tr")? "name": "name_".$uye_dil; 
                                            
                        $manager_name = mb_convert_case($primer_user["uye_adi"], MB_CASE_TITLE, "UTF-8");
                        $manager_surname = mb_strtoupper($primer_user["uye_soyadi"]);
                        echo '
                        <p><font color="red">'.$language[2].'</font>'.$scientific_program->{$gun}->{$uye_dil}.'</p>
                        <p><font color="red">'.$language[3].'</font>'.$scientific_program->{$gun}->{$saloon}->{$uye_dil}.'</p>
                        <p><font color="red">'.$language[4].'</font> '.$scientific_program->{$gun}->{$saloon}->{$session}->{$session_name_str}.'</p>
                        <p><font color="red">'.$language[5].'</font> '.secs_to_hours($session_take_moment).'</p>
                        <p><a target="_blank" href="/session_manager_document?day='.$gun.'&saloon='.$saloon.'&session='.$session.'">'.$language[6].'</a></p>
                        <p><button class="form-control" onclick="virtual_congress_index_moderator(\''.$bbb_session_name.'\',JSON.parse(JSON.stringify('.htmlspecialchars(json_encode($session_presentation_files,JSON_UNESCAPED_UNICODE)).')))">'.$language[7].'</button></p>
                        ';
                        
                        echo '<hr>';
                        
                        $cakisma = 1;
                        
                    }
                    else
                    {
                        $session_delay_secs = intval($scientific_program->{$gun}->{$saloon}->{$session}->{"time"})*60;
                        $saloon_start_time += $session_delay_secs;
                    }
               
                }
            }
        }
    }


    ?>
</body>

<script>
        
    function postForm(path, params, method) {
        method = method || 'post';

        var form = document.createElement('form');
        form.setAttribute('method', method);
        form.setAttribute('action', path);

        for (var key in params) {
            if (params.hasOwnProperty(key)) {
                var hiddenField = document.createElement('input');
                hiddenField.setAttribute('type', 'hidden');
                hiddenField.setAttribute('name', key);
                hiddenField.setAttribute('value', params[key]);

                form.appendChild(hiddenField);
            }
        }

        document.body.appendChild(form);
        form.submit();
    }

    virtual_congress_index_moderator = function(session_name,session_infos)
    {
        postForm("/virtual_congress_index",{session_name:session_name,session_infos:JSON.stringify(session_infos),user_type:"moderator"});
    }


</script>
</html>
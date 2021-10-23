<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
     
</head>
<body>

    <style>

        .abstract_list
        {
            display:none;
        }

     
        table
        {
            margin:20px; 
        }
    </style>
    
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
    
        $gun_index = 0;
        echo '<div style="display:flex">';
        $scientific_program = json_decode($abstract_websites[0]["scientific_program"]);
        foreach($scientific_program as $gun => $value)
        {
            if($gun != "tr" && $gun != "en")
            {
                echo '<button style="height:auto;" class=" form-control" onclick="gun_secim(\''.$gun_index.'\')">'.$scientific_program->{$gun}->{$uye_dil}.'</button>';
                $gun_index += 1;
            }
        }


        echo '</div>';

    ?>

        <hr>
    
    <?php
        $gun_index = 0;
        $saloon_index = 0;
        echo '<div style="display:flex">';
        $scientific_program = json_decode($abstract_websites[0]["scientific_program"]);
        foreach($scientific_program as $gun => $value)
        {
            foreach($scientific_program->{$gun} as $saloon => $value1)
            {
                if($saloon != "tr" && $saloon != "en")
                {
                    echo '<button style="height:auto;" class="form-control salon_secim salon_secim_'.$gun_index.'" onclick="salon_secim(\''.$gun_index.'\',\''.$saloon_index.'\')">'.$scientific_program->{$gun}->{$saloon}->{$uye_dil}.'</button>';
                    $saloon_index += 1;
                }
            }
            $gun_index += 1;
        }


        echo '</div>';

    ?>




    
    <?php
        $gun_index = 0;
        $saloon_index = 0;
        $scientific_program = json_decode($abstract_websites[0]["scientific_program"]);
        echo '<table>';
        foreach($scientific_program as $gun => $value)
        {
            if($gun != "tr" && $gun != "en")
            {
                foreach($scientific_program->{$gun} as $saloon => $value1)
                {
                    $saloon_start_time = hours_to_secs($scientific_program->{$gun}->{$saloon}->{"start_time"});
        
                    if($saloon != "tr" && $saloon != "en" && $saloon != "en")
                    {
                        echo '<tr class="abstract_list gun_'.$gun_index.' salon_'.$saloon_index.'"><td colspan="4" style="border: 1px solid black;font-size:20px;background-color:pink;color:white;">'.$scientific_program->{$gun}->{$saloon}->{$uye_dil}.'</td></tr>';

                        foreach($scientific_program->{$gun}->{$saloon} as $session => $value2)
                        {
                            if($session != "tr" && $session != "en" && $session != "start_time")
                            {

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
                                    echo '<tr class=" abstract_list gun_'.$gun_index.' salon_'.$saloon_index.'"><td style="border: 1px solid black;background-color:rgba(255, 231, 36,1);color:black;">'.hour_replace(secs_to_hours($saloon_start_time)).'-'.hour_replace(secs_to_hours($saloon_start_time+$session_delay_secs)).'</td><td colspan="3" style="border: 1px solid black;background-color:rgba(255, 231, 36,1);color:black;">'.$scientific_program->{$gun}->{$saloon}->{$session}->{$name}.'</td></tr>';
                                    $saloon_start_time += $session_delay_secs;
                                    continue;
                                }

                                else if($scientific_program->{$gun}->{$saloon}->{$session}->{"break"} == 2)
                                {
                                    if(intval($session_delay_secs = $scientific_program->{$gun}->{$saloon}->{$session}->{"time"}) > 0)
                                    {
                                        $session_delay_secs = intval($scientific_program->{$gun}->{$saloon}->{$session}->{"time"})*60;
                                        echo '<tr class=" abstract_list gun_'.$gun_index.' salon_'.$saloon_index.'"><td style="border: 1px solid black;background-color:purple;color:white;">'.hour_replace(secs_to_hours($saloon_start_time)).'-'.hour_replace(secs_to_hours($saloon_start_time+$session_delay_secs)).'</td><td style="border: 1px solid black;background-color:purple;color:white;">'.$scientific_program->{$gun}->{$saloon}->{$session}->{"cell_".$uye_dil."_2"}.'</td><td style="border: 1px solid black;background-color:purple;color:white;">'.$scientific_program->{$gun}->{$saloon}->{$session}->{"cell_".$uye_dil."_3"}.'</td><td style="border: 1px solid black;background-color:purple;color:white;"></td></tr>';
                                        $saloon_start_time += $session_delay_secs;
                                        continue;
                                    }
                   
                                    else
                                    {
                                        echo '<tr class=" abstract_list gun_'.$gun_index.' salon_'.$saloon_index.'"><td style="border: 1px solid black;background-color:purple;color:white;"></td><td style="border: 1px solid black;background-color:purple;color:white;">'.$scientific_program->{$gun}->{$saloon}->{$session}->{"cell_".$uye_dil."_2"}.'</td><td style="border: 1px solid black;background-color:purple;color:white;">'.$scientific_program->{$gun}->{$saloon}->{$session}->{"cell_".$uye_dil."_3"}.'</td><td style="border: 1px solid black;background-color:purple;color:white;"></td></tr>';
                                        continue;
                                    }
                                }
                                else
                                {
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
                                            $manager_degree = $language[0].' '.$all_users[$i]["uye_unvan"];
                                        
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
                                    
                                    $saloon_start_time += $session_delay_secs;

                                }
                               

                            }
                        }
                        $saloon_index += 1;
                    }
                }
            }
            $gun_index += 1;
        }

        echo '</table>';


    ?>
<script>

    $(document).ready(function(){
        gun_secim(0);
    });


    function gun_secim(gun_index){
        $(".salon_secim").css("display","none");
        $(".salon_secim_"+gun_index).css("display","block");
        $(".abstract_list").css("display","none");
        $(".gun_"+gun_index).css("display","table-row");

    }


    function salon_secim(gun_index,saloon_index){

    $(".salon_secim").css("display","none");
    $(".salon_secim_"+gun_index).css("display","block");
    $(".abstract_list").css("display","none");
    $(".salon_"+saloon_index).css("display","table-row");

    }
</script>





</body>
</html>
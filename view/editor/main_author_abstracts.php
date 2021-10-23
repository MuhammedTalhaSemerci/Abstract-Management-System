<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    
    <style>
    
    .baslik :is(h1, h2, h3, h4, h5, h6, p){

    font-size:25px;
    margin-top:5px;
    margin-bottom:5px;
    }

    .referee_update_warning
    {
        transition:2s;
        display:inline-block;
        position:absolute;
        text-decoration:none; 
        font-size:20px; 
        right:20px;
        width:50px;
        height:50px;
        background-color:yellow;
        opacity:.6;
        border:1px;
        border-radius:10px;
        text-align: center;
        z-index:10;
        animation: top_shake 4s infinite;
    }

    .referee_update_text
    {
        transition:2s;
        display:inline-block;
        text-decoration:none; 
        font-size:20px; 
        width:50px;
        height:50px;
        background-color:yellow;
        opacity:.6;
        border:1px;
        border-radius:10px;
        text-align: center;
        animation: top_shake 4s infinite;

    }

    @keyframes top_shake {
        0%{right:20px;}
        7% {right:60px;}
        14% {right:20px;}
        21% {right:60px;}
        28% {right:20px;}
        35% {right:60px;}
        42% {right:20px;}
        56% {right:60px;}
        70% {right:20px;}
        85% {right:60px;}
        100% {right:20px;}



    }

    
    </style>
<br>



<?php

abstracts($all_abstracts_main_author,$language,$abstract_websites,$scientific_program_all_abstracts,$uye_dil,true);


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
function abstracts($all_abstracts,$language,$abstract_websites,$scientific_program_all_abstracts,$uye_dil,$main_author=false)
{
  
    if($main_author == true)
    {
        echo'<h4 style="margin-top:20px;margin-left:20px;">'.$language[0].' </h4>';

    }
    if(count($all_abstracts) > 0)
    {
        for($i=0;$i<count($all_abstracts);$i++){

            echo '<table style="margin-left:20px;">';
                
            $scientific_program = json_decode($abstract_websites[0]["scientific_program"]);
                
                

            $cakisma = 0;
            $bbb_session_name="";
            $session_presentation_files=[];
            foreach($scientific_program as $gun => $value)
            {
                foreach($scientific_program->{$gun} as $saloon => $value1)
                {
                    $saloon_start_time = hours_to_secs($scientific_program->{$gun}->{$saloon}->{"start_time"});
                    if($saloon != "tr"&& $saloon != "en")
                    {
                        foreach($scientific_program->{$gun}->{$saloon} as $session => $value2)
                        {
                            if($session != "tr"&& $session != "en" && $session != "start_time")
                            {
                                if($scientific_program->{$gun}->{$saloon}->{$session}->{"break"} == 0)
                                {
                                    $abstracts_delay_secs = (intval(count($scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"})) > 0) ? ((intval($scientific_program->{$gun}->{$saloon}->{$session}->{"time"})-$suggestion_sum_time)/intval(count($scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"})-$suggestion_count))*60 : intval($scientific_program->{$gun}->{$saloon}->{$session}->{"time"})*60;
                                    $session_delay_secs = intval($scientific_program->{$gun}->{$saloon}->{$session}->{"time"})*60;        
                                    $suggestion=0;
                                    $abstract_time_finish=$saloon_start_time;

                                    $session_abstract_condition=0;
                                    for($a=0;$a<count($scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"});$a++)
                                    {
                                        if($scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"}[$a][0] == $all_abstracts[$i]['abstract_no'])
                                        {
                                            $session_abstract_condition = 1;
                                        }
                                    }


                                    for($a=0;$a<count($scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"});$a++)
                                    {
                                        for($b=0;$b<count($scientific_program_all_abstracts);$b++)
                                        {
                                        
                                            if($scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"}[$a][0] == $scientific_program_all_abstracts[$b][4]  && $scientific_program_all_abstracts[$b][18] != "" && $session_abstract_condition == 1)
                                            {
                                                $abstract_category_char = mb_strtoupper($scientific_program_all_abstracts[$b][17][0]);
                                                if(strpos($scientific_program_all_abstracts[$b][12],"-"))
                                                {
                                                    $abstract_type_char = mb_strtoupper($scientific_program_all_abstracts[$b][12][strpos($scientific_program_all_abstracts[$b][12],"-")+1]);
                                                }
                                                else
                                                {
                                                    $abstract_type_char = mb_strtoupper($scientific_program_all_abstracts[$b][12][0]);
                                                }
                                                $last_abstract_no = intval($scientific_program_all_abstracts[$b][13]);
                                                
                                                array_push($session_presentation_files,$abstract_category_char.$abstract_type_char.$last_abstract_no."/".$scientific_program_all_abstracts[$b][18]);
                                            }
                                            if(($scientific_program_all_abstracts[$b][4] == $scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"}[$a][0]) && $scientific_program_all_abstracts[$b][4] == $all_abstracts[$i]['abstract_no'])
                                            {
                                                $bbb_session_name = $scientific_program->{$gun}->{$saloon}->{$session}->{"name"};
                                            
                                                $abstract_time = $abstract_time_finish;
                                                $abstract_time_hour =secs_to_hours($abstract_time);
                                                $abstract_time_finish = $abstract_time_finish+$abstracts_delay_secs;
                                                $abstract_finish_time_hour = ($scientific_program->{$gun}->{$saloon}->{$session}->{"time_state"} == 1)? secs_to_hours($abstract_time_finish):"";
                                            
                                                $session_name_str = ($uye_dil == "tr")? "name": "name_".$uye_dil; 
                                                $abstract_category_char = mb_strtoupper($scientific_program_all_abstracts[$b][17][0]);
                                                if(strpos($scientific_program_all_abstracts[$b][12],"-"))
                                                {
                                                    $abstract_type_char = mb_strtoupper($scientific_program_all_abstracts[$b][12][strpos($scientific_program_all_abstracts[$b][12],"-")+1]);
                                                }
                                                else
                                                {
                                                    $abstract_type_char = mb_strtoupper($scientific_program_all_abstracts[$b][12][0]);
                                                }
                                                $last_abstract_no = intval($scientific_program_all_abstracts[$b][13]);
                                                
                                                echo '
                                                <tr><td><p><font color="red">'.$language[1].'</font>'.$scientific_program->{$gun}->{$uye_dil}.'</p></td></tr>
                                                <tr><td><p><font color="red">'.$language[2].'</font>'.$scientific_program->{$gun}->{$saloon}->{$uye_dil}.'</p></td></tr>
                                                <tr><td><p><font color="red">'.$language[3].'</font>'.secs_to_hours($saloon_start_time).'</p></td></tr>
                                                <tr><td><p><font color="red">'.$language[4].'</font>'.$scientific_program_all_abstracts[$b][4]."(".$abstract_category_char.$abstract_type_char.$scientific_program_all_abstracts[$b][13].")".'</p></td></tr>
                                                <tr><td><p><font color="red">'.$language[5].'</font>'.$scientific_program_all_abstracts[$b][6].'</p></td></tr>
                                                <tr><td><p><font color="red">'.$language[6].'</font>'.$scientific_program_all_abstracts[$b][11].'</p></td></tr>
                                                ';
                                            
                                                $cakisma = 1;
                                            }
                                        }
                                        if($scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"}[$a][0] === "suggestion")
                                        {
                                            $abstract_time = $abstract_time_finish;
                                            $abstract_time_hour =($scientific_program->{$gun}->{$saloon}->{$session}->{"time_state"} == 1)? secs_to_hours($abstract_time):"";
                                            $suggestion = intval($scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"}[$a][3])*60;
                                            $abstract_time_finish = $abstract_time_finish+$suggestion;
                                            $abstract_finish_time_hour = ($scientific_program->{$gun}->{$saloon}->{$session}->{"time_state"} == 1)? secs_to_hours($abstract_time_finish):"";
                                                
                                        }
                                    }
                                    $saloon_start_time += intval($scientific_program->{$gun}->{$saloon}->{$session}->{"time"})*60;
                                }
                                else if($scientific_program->{$gun}->{$saloon}->{$session}->{"break"} == 1)
                                {
                                    $saloon_start_time += intval($scientific_program->{$gun}->{$saloon}->{$session}->{"time"})*60;
                                }
                                else if($scientific_program->{$gun}->{$saloon}->{$session}->{"break"} == 2)
                                {
                                    $saloon_start_time += intval($scientific_program->{$gun}->{$saloon}->{$session}->{"time"})*60;
                                }
                            }
                        } 
                    }
                }
            }
            echo '
            <tr>
                <td>';
                if(intval($all_abstracts[$i]["accepted"]) == 1)
                {
                    echo '
                    <a target="_blank" href="editor_index?abstract_presentation_id='.$all_abstracts[$i]["abstract_no"].'&sayfa=abstract_presentations"">'.$language[7].'</a> 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
                    <a target="_blank" href="accepted_abstract_document?abstract_id='.$all_abstracts[$i]["abstract_no"].'">'.$language[8].'</a> 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp';
                }
                echo '</td>
                
            </tr>';
        
            echo '<tr ><td><button class="form-control" onclick="virtual_congress_index_moderator(\''.$bbb_session_name.'\',JSON.parse(JSON.stringify('.htmlspecialchars(json_encode($session_presentation_files,JSON_UNESCAPED_UNICODE)).')))">'.$language[9].'</button></td></td>';

            echo '</table>
            <hr />';

        }
    }
    else
    {
        echo '<h4 style="margin-left:20px;" > Herhangi bir sunum bilgisi bulunamadı. </h4>';
    }

}

?>

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



</body>
</html>
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

    .form-control
    {
        height:auto;
    }
    </style>
<br>

<div class="col-md-12 col-lg-12">

    <div class="col-md-6 col-lg-6 " style="margin:auto;">

        <label for="session_name">Oturum Adı:</label><input class="form-control" type="text" id="session_name"><br>
        <label for="user_name">Kullanıcı Adı:</label><input class="form-control" type="text" id="user_name"><br>
        <button class="form-control" onclick="bbb_session_create()" style="margin-top:20px;">Oturumu Başlat</button><br>

        <button class="form-control" onclick="moderator_bbb_link_generation()">Moderator Linki Oluştur</button>
        <button class="form-control" onclick="attendee_bbb_link_generation()" style="margin-top:20px;">Katılımcı Linki Oluştur</button><br>
        <button class="form-control" onclick="attendee_bbb_system_link_generation()" style="margin-top:20px;">İzleyici Linki Oluştur</button><br>


        <label for="generated_bbb_link">Link:</label><input class="form-control" type="text" id="generated_bbb_link">

    </div>

</div>
<hr>
<h4 style="margin-left:20px;">Tüm Oturumlar</h4>

<button class="form-control" style="margin:20px;margin-right(100%-20px)" onclick="bbb_get_meeting_infos()">Oturumları Ön İzle</button>
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
 

    echo '<table class="table" style="margin-left:20px;">';
        
    $scientific_program = json_decode($abstract_websites[0]["scientific_program"]);
    
    $cakisma = 0;

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
                            $bbb_session_name="";
                            $session_presentation_files=[];

                            $abstracts_delay_secs = (intval(count($scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"})) > 0) ? ((intval($scientific_program->{$gun}->{$saloon}->{$session}->{"time"})-$suggestion_sum_time)/intval(count($scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"})-$suggestion_count))*60 : intval($scientific_program->{$gun}->{$saloon}->{$session}->{"time"})*60;
                            $session_delay_secs = intval($scientific_program->{$gun}->{$saloon}->{$session}->{"time"})*60;        
                            $suggestion=0;
                            $abstract_time_finish=$saloon_start_time;

                            echo '<tr class="session_infos" data-sessionname="'.$scientific_program->{$gun}->{$saloon}->{$session}->{"name"}.'">';

                            for($a=0;$a<count($scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"});$a++)
                            {
                                for($b=0;$b<count($scientific_program_all_abstracts);$b++)
                                {
                                
                                    if($scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"}[$a][0] == $scientific_program_all_abstracts[$b][4]  && $scientific_program_all_abstracts[$b][18] != "")
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
                                    if(($scientific_program_all_abstracts[$b][4] == $scientific_program->{$gun}->{$saloon}->{$session}->{"abstracts"}[$a][0]) )
                                    {
                                       
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
                                        
                               
                                    
                                        $cakisma = 1;
                                    }
                                }
                            

                            }
                            $bbb_session_name = $scientific_program->{$gun}->{$saloon}->{$session}->{"name"};

                            echo '
                            <td> <button class="form-control" onclick="virtual_congress_index_moderator(\''.$bbb_session_name.'\',JSON.parse(JSON.stringify('.htmlspecialchars(json_encode($session_presentation_files,JSON_UNESCAPED_UNICODE)).')))">Oturuma Katıl</button></td>
                            <td onclick="copy_clipboard(this,String(\''.$scientific_program->{$gun}->{$saloon}->{$session}->{"name"}.'\'))">'.$scientific_program->{$gun}->{$saloon}->{$session}->{"name"}.'</td>
                            <td>'.$scientific_program->{$gun}->{$uye_dil}.' </td>
                            <td>'.$scientific_program->{$gun}->{$saloon}->{$uye_dil}.'</td>
                            <td>'.secs_to_hours($saloon_start_time).'</td>
                            <td data-sessionindex="'.$scientific_program->{$gun}->{$saloon}->{$session}->{"name"}.'" data></td>

                            ';


                            $admin_page_infos =json_decode($abstract_websites["admin_virtual_congress_but_infos"])->{"login_page"};
                            $links_str = "";
                            foreach($admin_page_infos as $login_page => $index)
                            {
                                if(property_exists($admin_page_infos->{$login_page},"0") && property_exists($admin_page_infos->{$login_page},"is_saloon") && $admin_page_infos->{$login_page}->{"is_saloon"} == "1" && $admin_page_infos->{$login_page}->{"0"} != "")
                                {
                                    $links_str .= '                
                                        if(i == "'.intval($login_page).'")
                                        {
                                            $.post("/get_saloon_info",{but_index:"'.$login_page.'"},function(returnval){
                                                if(returnval == 0)
                                                {
                                                    alert("Oturum henüz başlatılmamıştır");
                                                }    
                                                else
                                                {
                                                    window.location.href = encodeURIComponent(returnval.replace(" ","+"));
                                                }
                                            });
                                            encounter += 1;
                                        }
                                    ';
                                }
                    
                            }





                            echo '</tr>';
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



    echo '</table>
    <hr />';


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



function copy_clipboard(e,val) {
    variable = "https://"+document.domain+"/virtual_congress_index?session_name="+val;
    navigator.clipboard.writeText(variable);

}
virtual_congress_index_moderator = function(session_name,session_infos)
{
    postForm("/virtual_congress_index",{session_name:session_name,session_infos:JSON.stringify(session_infos),user_type:"moderator"});
}

function moderator_bbb_link_generation()
{
    session_name = $("#session_name").val();
    user_name = $("#user_name").val();
    if(session_name && user_name)
    {

        $.post("/bbb_join_as_moderator",{session_name:session_name,user_name:user_name},function(res){
            if(res.search("https://") != -1)
            {
                $("#generated_bbb_link").val(res);
            }

        }).fail(function(){
            alert("Link dönüşümü sırasında bir hata oluştu");
        });
    }
    else
    {
        alert("Eksik bilgi girildi");
    }

}

function attendee_bbb_link_generation()
{
    session_name = $("#session_name").val();
    user_name = $("#user_name").val();

    if(session_name && user_name)
    {
        $.post("/bbb_join_as_attendee",{session_name:session_name,user_name:user_name},function(res){
            if(res.search("https://") != -1)
            {
                $("#generated_bbb_link").val(res);
            }

        }).fail(function(){
            alert("Link dönüşümü sırasında bir hata oluştu");
        });
    }
    else
    {
        alert("Eksik bilgi girildi");
    }
}

function attendee_bbb_system_link_generation()
{
    session_name = $("#session_name").val();
    if(session_name && user_name)
    {
        $("#generated_bbb_link").val("https://"+document.domain+"/virtual_congress_index?session_name="+session_name);
    }
    else
    {
        alert("Eksik bilgi girildi");
    }
}

function bbb_get_meeting_infos()
{
    var session_control =null;
    var sessions = $(".session_infos");

    for(i=0;i<sessions.length;i++)
    {
        window.session_index = sessions[i];
        site_link = "";
      
        site_link = showGetResult("/bbb_get_meeting_infos",{session_name:sessions[i].getAttribute("data-sessionname")});
      
        result = $.parseXML(showGetResult(site_link));
        if(result.getElementsByTagName("returncode")[0].textContent == "SUCCESS")
        {
            $("td[data-sessionindex='"+sessions[i].getAttribute("data-sessionname") +"']").html('<i style="width:40px; color:green;" class="fas fa-check-square"></i>');
        }
        else
        {
            $("td[data-sessionindex='"+sessions[i].getAttribute("data-sessionname") +"']").html('<i style="color:red;" class="fas fa-times-circle"></i>');
        }
    }
        
     
    
}

function bbb_session_create()
{
    var session_name = $("#session_name").val();
    if(session_name)
    {
        var result = showGetResult("/bbb_create_without_preupload",{session_name:session_name});
        if(result.search("https://") != -1)
        {
            last_result = showGetResult(result);
            parser = new DOMParser();
            last_result = parser.parseFromString(last_result, "application/xml");
            if(last_result.getElementsByTagName("returncode")[0].textContent == "SUCCESS")
            {
                alert("İşlem başarıyla gerçekleştirilmiştir");
            }
            else if(last_result.getElementsByTagName("returncode")[0].textContent == "FAİLED")
            {
                alert("İşlem gerçekleştirilirken bir hata oluştu");
            }


        
        }
     
    }
    else
    {
        alert("Eksik bilgi girildi");
    }
}

function showGetResult( url,data="" )
{
     var result = null;
     var scriptUrl = url;
     $.ajax({
        url: scriptUrl,
        type: 'post',
        dataType: 'html',
        async: false,
        data:data,
        success: function(data) {
            result = data;
        } 
     });
     return result;
}

function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}
referee_edits_over = function(abstract_no,referee_ids,element) 
{
    referee_ids = referee_ids.split("/");
    var referee_ids_html = "";

        if(referee_ids.length > 0)
        {
            for(i=0;i<referee_ids.length;i++)
            {
                referee_ids_html +='<a  target="_blank" style="text-decoration:none;" href="/abstract_edit_request_viewer?abstract_id='+abstract_no+'&referee_id='+referee_ids[i]+'">'+(i+1)+'. <?php echo $language[31];?></a><br>';
            }

            element.style.transition = "1s";
            element.style.width = "400px";
            element.style.height = "200px";
            element.style.opacity = ".75";

            setTimeout(() => {
                if(parseInt(element.style.width) > 340)
                {
                    $(".referee_update_warning").html(referee_ids_html);
                    element.style.animation = "none";

                }
            },550 );
                
  
        }
}

referee_edits_out = function (element)
{
   
    element.style.transition = "1s";
    element.style.width = "50px";
    element.style.height = "50px";
    element.style.opacity = ".6";
    setTimeout(() => {
        if(parseInt(element.style.width)< 340)
        {
            $(".referee_update_warning").html('<a href="#">!</a>');
            element.style.animation = "top_shake 4s infinite";
            
        }
    },130 );
      
        

}

</script>



</body>
</html>
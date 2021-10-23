<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        
    <style>


   .h_visibility
   {
       visibility:hidden;
   }

    .saloon-div
    {
        visibility:hidden;
    }

    .days-newdaybut
    {
        margin-top:20px;
        margin-bottom:20px;
    }
    .days-newsaloonbut
    {
        margin-top:20px;
        margin-bottom:20px;
    }
    .lang-select-label
    {
        margin-top:24px;
        margin-bottom:24px;
    }


    .user_to_session_div
    {

    }

    </style>

</head>
<body>

<div style="margin:auto;">
    <button   data-toggle="modal" data-target="#exampleModal">Kullanıcı Ara</button>
    <button  onclick="admin_scientific_program_save()">Kaydet</button>

</div>

    <div class="col-lg-12 col-md-12 col-12" style="display:flex;">
        <div class="scientific-program col-md-6 col-lg-6 "  >
            <table>
                <tr>
                   

                   <td>
                    <div class="days-div" >
                            <button class="days-newdaybut " onclick="daydelete()" style="display:block"> Günü Sil</button>
                            <button class="days-newdaybut " onclick="newdayfunc()" style="display:block"> Yeni Gün Ekle</button>
                            <Select class="days-select">
                                <option value="">Seçim Yapınız</option>
                            </Select>

                        </div>

                   </td>
                    
                    <td>
                        <div class="saloon-div" >
                        <button class="days-newdaybut " onclick="saloondelete()" style="display:block"> Salonu Sil</button>
                            <button class="days-newsaloonbut " onclick="newsaloonfunc()" style="display:block"> Yeni Salon Ekle</button>
                            <select class="saloon-select">
                                <option value="">Seçim Yapınız</option>
                            </select>
                        </div>
                    </td>
                </tr>
            </table>



            <div style="display:block;margin-top:30px; " >
                <table>
                    <tr>
                        <td class="new-session">
                            <button class="new-break-btn" onclick="newcell()">Hücre Ekle</button>
                            <button class="new-break-btn" onclick="newbreak()">Ara Ekle</button>
                            <button class="new-session-btn"  data-toggle="modal" data-target="#exampleModal_Session"  >Oturum Ekle</button>
                        </td>
                        <td class="new-abstract">
                            <button class="new-abstract-btn" onclick="newabstract()" >Bildiri Ekle</button>
                        </td>
                    </tr>
                </table>
                <div class="session-box"style="visiblity:hidden;height:300px; overflow-y:scroll;">
                    <table class="session-box-table col-md-12 col-lg-12">
                     
                    </table>
                </div>

             
            </div>

        </div>

        <div class="col-md-6 col-lg-6 " >
            <div style="visiblity:hidden;">

            <br>
           
            <select class="abstract_cat_change">
                <?php

                    $abstract_websites_php = json_decode($abstract_websites[0]["categories"]);

                    for($i=0;$i<count($abstract_websites_php->{"tr"});$i++)
                    {
                        for($a=1;$a<count($abstract_websites_php->{"tr"}[$i]);$a++)
                        {
                            echo '<option value="'.$abstract_websites_php->{"tr"}[$i][$a].'">'.$abstract_websites_php->{"tr"}[$i][$a].'</option>';
                        }
                    }
                ?>
                
            </select>
            <br>
            
            <select class="abstract_type_change">
                <option value="E-poster">E-poster</option>
                <option value="Sözlü Sunum">Sözlü Sunum</option>
            </select>

            <br><br><br>
            <h5>Bildiriler</h5> 


                <table class="abstracts-nonuse">
                    <tr>
                        <td style="border:1px solid black;">Bildiri no</td>
                        <td style="border:1px solid black;">Bildiri baslik</td>
                        <td style="border:1px solid black;">Bildiri kategori</td>


                    </tr>
                    <?php
                        for($i=0;$i<count($admin_all_abstracts);$i++)
                        {
                            if(intval($admin_all_abstracts[$i][5]) == 1)
                            {
                                
                                //Onayı olmayan bildiriler burada ayıklanacak
                                echo '<tr ><td style="border:1px solid black;">'.$admin_all_abstracts[$i][4].'</td>
                                <td style="border:1px solid black;">';
                                if(strlen($admin_all_abstracts[$i][6])>30)
                                {
                                    echo mb_substr($admin_all_abstracts[$i][6],0,30).'...'; 
                                    $admin_all_abstracts[$i][6] = mb_substr($admin_all_abstracts[$i][6],0,30).'...';
                                }
                                else{
                                    echo $admin_all_abstracts[$i][6];
                                }
                                echo '</td>
                                <td style="border:1px solid black;">'.$admin_all_abstracts[$i][7].'</td></tr>';
                            
                            }
                            else
                            {
                                array_splice($admin_all_abstracts,$i,1);
                                $i--;
                                continue;
                            }
                        }

                    ?>
                </table>
            </div>
         
            <!-- Search Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kulanıcılar Arasında Arama Yap</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input class="form-control model_user_search" type="text" placeholder="kullanıcı id'si, ad-soyadı, telefon numarası veya mail adresi">
                    </div>
                    <div class="modal-body model_user_search_result">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                        <button type="button" class="btn btn-primary" onclick="open_user_search()">Arama Yap</button>
                    </div>
                    </div>
                </div>
            </div>


             <!-- Session Manager Modal -->
             <div class="modal fade" id="exampleModal_Session" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Oturum Başkanı Belirle</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input class="form-control model_user_to_session_search" type="text" placeholder="kullanıcı id'si, ad-soyadı, telefon numarası veya mail adresi">
                    </div>
                    <div class="modal-body model_user_to_session_search_result">
                    </div>
                    <div class="modal-footer">
                        <input class="form-control model_user_to_session_value" type="text" placeholder="Kullanıcı id'si giriniz.">
                        <button type="button" class="btn btn-primary" onclick="newsession()" data-dismiss="modal">Oturum Başkanı Ata</button>
                    </div>
                    </div>
                </div>
            </div>
        
          <!-- Session Manager Change Modal -->
          <div class="modal fade" id="exampleModal_Session_Change" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Oturum Başkanı Belirle</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input class="form-control model_user_to_session_change_search" type="text" placeholder="kullanıcı id'si, ad-soyadı, telefon numarası veya mail adresi">
                    </div>
                    <div class="modal-body model_user_to_session_search_change_result">
                    </div>
                    <div class="modal-footer">
                        <input class="form-control model_user_to_session_change_value" type="text" placeholder="Kullanıcı id'si giriniz.">
                        <button type="button" class="btn btn-primary session_manager_change_but" onclick="session_arrangement()" data-dismiss="modal">Oturum Başkanı Ata</button>
                    </div>
                    </div>
                </div>
            </div>
        
        </div>
       

    </div>


    <script>



var day_index = null;
var saloon_index = null;
var session_index = 0;
var abstract_index = 0;

function hour_replace(hours)
{
    find = [",","/","-",":","_","|",";"];
    for(i=0;i<find.length;i++)
    {
        hours = hours.replace(find[i],".");
    }
    return hours;
}

function secs_to_hours(secs)
{
    hours = parseInt(secs/(60*60));
    mins = parseInt((secs-(hours*60*60))/60) ;

    return (mins < 10) ? hours+"."+"0"+String(mins) : hours+"."+String(mins);
} 

function hours_to_secs(hours)
{

    hours = hour_replace(hours);
    hours_mins = hours.split(".");
    secs = parseInt(hours_mins[0])*60*60+parseInt(hours_mins[1])*60;
    return secs;

 
}

//secs_to_hours("12.30");
//hours_to_secs(45000);
all_users = JSON.parse(JSON.stringify(<?php echo json_encode($all_users,JSON_UNESCAPED_UNICODE);?>));


abstracts = JSON.parse(JSON.stringify(<?php echo json_encode($admin_all_abstracts,JSON_UNESCAPED_UNICODE);?>));
abstracts_inuse=[];

$(".saloon-div").css("visibility","hidden");
$(".session-box").css("visibility","hidden");
$(".new-session").css("visibility","hidden");
$(".new-abstract").css("visibility","hidden");
    

<?php 
    if($abstract_websites[0]["scientific_program"] != null && $abstract_websites[0]["scientific_program"] != "") 
    {
        echo 'scientific_program = JSON.parse(JSON.stringify('.$abstract_websites[0]["scientific_program"].'));';
    
    }
    else
    {
        echo 'scientific_program = {};';
    }
?>


$(document).ready(function() {
    if(JSON.stringify(scientific_program) != "{}")
    {
        days_html ="<option value=''>Seçim Yapınız</option>";
        saloon_html = "<option value=''>Seçim Yapınız</option>";
        session_html ="";

        days_obj = $(".days-select");
        saloon_obj = $(".saloon-select");


        Object.keys(scientific_program).forEach(days => 
        {
            days_html += '<option value="'+days+'">'+scientific_program[days].tr+'</option>';
            Object.keys(scientific_program[days]).forEach(saloon => 
            {
                saloon_html += '<option value="'+saloon+'">'+scientific_program[days][saloon].tr+'</option>';
                if(Object.size(scientific_program[days][saloon]) > 3)
                {
                    Object.keys(scientific_program[days][saloon]).forEach(session => 
                    {
                    
                        if(scientific_program[days][saloon][session].break == 0)
                        {
                            var abstracts_usable = scientific_program[days][saloon][session].abstracts;

                            for(i=0;i<abstracts_usable.length;i++)
                            {
                                for(a=0;a<abstracts.length;a++)
                                {
                                    if(abstracts_usable[i][0] == abstracts[a][4])
                                    {
                                        abstracts_inuse.push(abstracts[a]);
                                        abstracts.splice(a,1);
                                    }
                                }
                            }

                            if(scientific_program[days][saloon][session].time_state == 0 || 
                            scientific_program[days][saloon][session].time_state == 1)
                            {}
                            else
                            {
                                scientific_program[days][saloon][session].time_state = 1;
                            }
                            

                        }
                       
                    })
                }
            });
        });
        

        days_obj.html(days_html);
        saloon_obj.html(saloon_html);
        

        $(".days-div").css("visibility","visible");
    }
});


function open_user_search()
{

    user_info_html='';
    search_text = $(".model_user_search").val();
    found_search_index = 0;
    for(i=0;i<all_users.length;i++)
    {
        if((all_users[i].id.toLowerCase().match(search_text.toLowerCase()) != -1 || 
        all_users[i].uye_tel.toLowerCase().match(search_text.toLowerCase()) != -1 || 
        all_users[i].uye_mail.toLowerCase().match(search_text.toLowerCase()) != -1 || 
        all_users[i].uye_adi.toLowerCase().match(search_text.toLowerCase()) != -1 || 
        all_users[i].uye_soyadi.toLowerCase().match(search_text.toLowerCase()) != -1) && 
        found_search_index < 4 )
        {

            user_info_html += ' <tr><td style="border:1px solid black;padding:5px;">'+all_users[i]["id"]+'</td><td style="border:1px solid black;padding:5px;">'+all_users[i]["uye_adi"]+'</td><td style="border:1px solid black;padding:5px;">'+all_users[i]["uye_soyadi"]+'</td><td style="border:1px solid black;padding:5px;">'+all_users[i]["uye_tel"]+'</td></tr>';
            found_search_index += 1;
        }
    }

    $(".model_user_search_result").html(user_info_html);

}

$(".model_user_search").keyup(function(){

    user_info_html='';
    search_text = $(".model_user_search").val();
    found_search_index = 0;
    for(i=0;i<all_users.length;i++)
    {
        if((all_users[i].id.toLowerCase().match(search_text.toLowerCase()) != -1 || 
        all_users[i].uye_tel.toLowerCase().match(search_text.toLowerCase()) != -1 || 
        all_users[i].uye_mail.toLowerCase().match(search_text.toLowerCase()) != -1 || 
        all_users[i].uye_adi.toLowerCase().match(search_text.toLowerCase()) != -1 || 
        all_users[i].uye_soyadi.toLowerCase().match(search_text.toLowerCase()) != -1) && 
        found_search_index < 4 )
        {

            user_info_html += ' <tr><td style="border:1px solid black;padding:5px;">'+all_users[i]["id"]+'</td><td style="border:1px solid black;padding:5px;">'+all_users[i]["uye_adi"]+'</td><td style="border:1px solid black;padding:5px;">'+all_users[i]["uye_soyadi"]+'</td><td style="border:1px solid black;padding:5px;">'+all_users[i]["uye_tel"]+'</td></tr>';
            found_search_index += 1;
        }
    }

    $(".model_user_search_result").html(user_info_html);
    
});



$(".model_user_to_session_search").keyup(function()
{

    user_info_html='';
    found_search_index = 0;
    for(i=0;i<all_users.length;i++)
    {
        if((all_users[i].id.search($(".model_user_to_session_search").val()) != -1 || all_users[i].uye_tel.search($(".model_user_to_session_search").val()) != -1 || all_users[i].uye_mail.search($(".model_user_to_session_search").val()) != -1 || all_users[i].uye_adi.search($(".model_user_to_session_search").val()) != -1 || all_users[i].uye_soyadi.search($(".model_user_to_session_search").val()) != -1) && found_search_index < 4 )
        {

            user_info_html += ' <tr><td style="border:1px solid black;padding:5px;">'+all_users[i]["id"]+'</td><td style="border:1px solid black;padding:5px;">'+all_users[i]["uye_adi"]+'</td><td style="border:1px solid black;padding:5px;">'+all_users[i]["uye_soyadi"]+'</td><td style="border:1px solid black;padding:5px;">'+all_users[i]["uye_tel"]+'</td></tr>';
            found_search_index += 1;
        }
    }

    $(".model_user_to_session_search_result").html(user_info_html);
});



$(".model_user_to_session_change_search").keyup(function()
{

    user_info_html='';
    found_search_index = 0;
    for(i=0;i<all_users.length;i++)
    {
        if((all_users[i].id.search($(".model_user_to_session_change_search").val()) != -1 ||
         all_users[i].uye_tel.search($(".model_user_to_session_change_search").val()) != -1 || 
         all_users[i].uye_mail.search($(".model_user_to_session_change_search").val()) != -1 || 
         all_users[i].uye_adi.search($(".model_user_to_session_change_search").val()) != -1 || 
         all_users[i].uye_soyadi.search($(".model_user_to_session_change_search").val()) != -1) && 
         found_search_index < 4 )
        {

            user_info_html += ' <tr><td style="border:1px solid black;padding:5px;">'+all_users[i]["id"]+'</td><td style="border:1px solid black;padding:5px;">'+all_users[i]["uye_adi"]+'</td><td style="border:1px solid black;padding:5px;">'+all_users[i]["uye_soyadi"]+'</td><td style="border:1px solid black;padding:5px;">'+all_users[i]["uye_tel"]+'</td></tr>';
            found_search_index += 1;
        }
    }

    $(".model_user_to_session_search_change_result").html(user_info_html);
});



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




$(document).ready(function(){

    $(".days-select").change(function(){

        
        var day = $(this).val();
        

        var html = '';

        Object.keys(scientific_program[day]).forEach(saloon => {
            if(saloon !="tr" && saloon !="en")
            {
                html += '<option value="'+saloon+'">'+scientific_program[day][saloon].tr+'</option>';
            }
        });

        $('.saloon-select').html('<option value="">Seçim Yapınız</option>'+html);
        $(".saloon-div").css("visibility","visible");
        $(".session-box").css("visibility","hidden");
        $(".new-session").css("visibility","hidden");
        $(".new-abstract").css("visibility","hidden");
        
    })

});

function saloon_refresh(days,saloon,session_index = 0)
{
    var abstracts_html = '<tr><td style="border: 1px solid black;">Konum Değişimi</td><td style="border: 1px solid black;">Saat</td><td style="border: 1px solid black;">Konu Başlığı</td><td style="border: 1px solid black;">Konuşmacı</td><td style="border: 1px solid black;">İşlemler</td></tr>';
    $('.session-box-table').html(abstracts_html);
    if(Object.size(scientific_program[days][saloon]) > 3)
    {
        var saloon_start_time = hours_to_secs(scientific_program[days][saloon].start_time);
        Object.keys(scientific_program[days][saloon]).forEach(element => 
        {
            
            if(element !="tr" && element !="en")
            {
            
                if(scientific_program[days][saloon][element].break == 1)
                {
                    var session_delay_secs = scientific_program[days][saloon][element].time*60;
                    abstracts_html += '<tr class="session_'+session_index+'"><td style="border: 1px solid black;" ><button onclick="session_break_cell_pos_change(\''+element+'\',1)" style="background-color:#34eb99;border:0px;"><i class="fas fa-sort-numeric-up"></i></button><button onclick="session_break_cell_pos_change(\''+element+'\',-1)" style="background-color:#34eb99;border:0px;"><i class="fas fa-sort-numeric-down"></i></button></td><td  style="border: 1px solid black;background-color:rgba(255, 231, 36,1);color:white" >'+hour_replace(secs_to_hours(saloon_start_time))+' - '+hour_replace(secs_to_hours(saloon_start_time+session_delay_secs))+'</td><td  style="border: 1px solid black;background-color:rgba(255, 231, 36,1);color:white" >'+scientific_program[days][saloon][element].name+'</td><td  style="border: 1px solid black;background-color:rgba(255, 231, 36,1);color:white"></td><td style="border: 1px solid black;background-color:rgba(255, 231, 36,1);color:white"><button class="sessiondelete_but_'+session_index+'"   style="background-color:red;border:0px;"><i class="far fa-trash-alt"></i></button><button class="session_arrangement_but_'+session_index+'" onclick="break_arrangement(\''+session_index+'\',\''+element+'\',\''+scientific_program[days][saloon][element].name+'\',\''+scientific_program[days][saloon][element].name_en+'\',\''+scientific_program[days][saloon][element].time+'\')" style="background-color:#34cfeb;border:0px;"><i class="fas fa-pen-square"></i></button></td></tr>';
                    $(".new-abstract").css("visibility","hidden");
                    $('.session-box-table').html(abstracts_html);
                    $(".sessiondelete_but_"+session_index)[0].setAttribute("onclick",'sessiondelete(\''+session_index+'\',\''+element+'\')');
                    abstracts_html = $('.session-box-table').html();
                    saloon_start_time += session_delay_secs;
                    session_index +=1;
                    return true;
                }
                else if(scientific_program[days][saloon][element].break == 2)
                {
                    if(parseInt(scientific_program[days][saloon][element].time) > 0)
                    {
                        var session_delay_secs = scientific_program[days][saloon][element].time*60;
                        abstracts_html += '<tr class="session_'+session_index+'"><td style="border: 1px solid black;"><button onclick="session_break_cell_pos_change(\''+element+'\',1)" style="background-color:#34eb99;border:0px;"><i class="fas fa-sort-numeric-up"></i></button><button onclick="session_break_cell_pos_change(\''+element+'\',-1)" style="background-color:#34eb99;border:0px;"><i class="fas fa-sort-numeric-down"></i></button></td><td  style="border: 1px solid black;background-color:rgba(255, 231, 36,1);color:white" >'+hour_replace(secs_to_hours(saloon_start_time))+' - '+hour_replace(secs_to_hours(saloon_start_time+session_delay_secs))+'</td><td  style="border: 1px solid black;background-color:rgba(255, 231, 36,1);color:white" >'+scientific_program[days][saloon][element].cell_tr_2+'</td><td  style="border: 1px solid black;background-color:rgba(255, 231, 36,1);color:white">'+scientific_program[days][saloon][element].cell_tr_3+'</td><td style="border: 1px solid black;background-color:rgba(255, 231, 36,1);color:white"><button class="sessiondelete_but_'+session_index+'"   style="background-color:red;border:0px;"><i class="far fa-trash-alt"></i></button><button class="session_arrangement_but_'+session_index+'" onclick="cell_arrangement(\''+session_index+'\',\''+element+'\',\''+scientific_program[days][saloon][element].cell_tr_2+'\',\''+scientific_program[days][saloon][element].cell_tr_3+'\',\''+scientific_program[days][saloon][element].cell_en_2+'\',\''+scientific_program[days][saloon][element].cell_en_3+'\',\''+scientific_program[days][saloon][element].time+'\')" style="background-color:#34cfeb;border:0px;"><i class="fas fa-pen-square"></i></button></td></tr>';
                        $(".new-abstract").css("visibility","hidden");
                        $('.session-box-table').html(abstracts_html);
                        $(".sessiondelete_but_"+session_index)[0].setAttribute("onclick",'sessiondelete(\''+session_index+'\',\''+element+'\')');
                        abstracts_html = $('.session-box-table').html();
                        saloon_start_time += session_delay_secs;
                        session_index +=1;
                        return true;
                    }
                    else
                    {
                         abstracts_html += '<tr class="session_'+session_index+'"><td style="border: 1px solid black;"><button onclick="session_break_cell_pos_change(\''+element+'\',1)" style="background-color:#34eb99;border:0px;"><i class="fas fa-sort-numeric-up"></i></button><button onclick="session_break_cell_pos_change(\''+element+'\',-1)" style="background-color:#34eb99;border:0px;"><i class="fas fa-sort-numeric-down"></i></button></td><td  style="border: 1px solid black;background-color:rgba(255, 231, 36,1);color:white" ></td><td  style="border: 1px solid black;background-color:rgba(255, 231, 36,1);color:white" >'+scientific_program[days][saloon][element].cell_tr_2+'</td><td  style="border: 1px solid black;background-color:rgba(255, 231, 36,1);color:white">'+scientific_program[days][saloon][element].cell_tr_3+'</td><td style="border: 1px solid black;background-color:rgba(255, 231, 36,1);color:white"><button class="sessiondelete_but_'+session_index+'"   style="background-color:red;border:0px;"><i class="far fa-trash-alt"></i></button><button class="session_arrangement_but_'+session_index+'" onclick="cell_arrangement(\''+session_index+'\',\''+element+'\',\''+scientific_program[days][saloon][element].cell_tr_2+'\',\''+scientific_program[days][saloon][element].cell_tr_3+'\',\''+scientific_program[days][saloon][element].cell_en_2+'\',\''+scientific_program[days][saloon][element].cell_en_3+'\',\''+scientific_program[days][saloon][element].time+'\')" style="background-color:#34cfeb;border:0px;"><i class="fas fa-pen-square"></i></button></td></tr>';
                        $(".new-abstract").css("visibility","hidden");
                        $('.session-box-table').html(abstracts_html);
                        $(".sessiondelete_but_"+session_index)[0].setAttribute("onclick",'sessiondelete(\''+session_index+'\',\''+element+'\')');
                        abstracts_html = $('.session-box-table').html();
                        session_index +=1;
                        return true;
                    }
                }
                else if(scientific_program[days][saloon][element].break == 0)
                {
                    
                    var suggestion_sum_time = 0;
                    suggestion_count =0;
                    for(a=0;a<scientific_program[days][saloon][element].abstracts.length;a++)
                    {
                        if(scientific_program[days][saloon][element].abstracts[a][0] === "suggestion")
                        {
                            suggestion_sum_time += parseInt(scientific_program[days][saloon][element].abstracts[a][3]);
                            suggestion_count +=1;
                        }
                    }

                    var abstracts_delay_secs = (parseInt(scientific_program[days][saloon][element].abstracts.length) > 0) ? ((parseInt(scientific_program[days][saloon][element].time)-suggestion_sum_time)/parseInt(scientific_program[days][saloon][element].abstracts.length-suggestion_count))*60 : parseInt(scientific_program[days][saloon][element].time)*60;
                    var session_delay_secs = parseInt(scientific_program[days][saloon][element].time)*60;
                   
                    manager_name = "";
                    manager_surname = "";
                    
                    for(i=0;i<all_users.length;i++)
                    {
                        if(scientific_program[days][saloon][element].manager == all_users[i].id)
                        {
                            manager_name = all_users[i].uye_adi;
                            manager_surname = all_users[i].uye_soyadi;

                        }
                    }
                    if(scientific_program[days][saloon][element].time_state == 0 || 
                    scientific_program[days][saloon][element].time_state == 1)
                    {
                        time_state_val = scientific_program[days][saloon][element].time_state;
                        time_state = (time_state_val == 1)? 'checked':''; 
                    }
                    else
                    {
                        time_state_val = scientific_program[days][saloon][element].time_state;
                        time_state = (time_state_val == 1)? 'checked':''; 

                    }
                     
                    abstracts_html += '<tr class="session_'+session_index+'"><td style="border: 1px solid black;"><button onclick="session_break_cell_pos_change(\''+element+'\',1)" style="background-color:#34eb99;border:0px;"><i class="fas fa-sort-numeric-up"></i></button><button onclick="session_break_cell_pos_change(\''+element+'\',-1)" style="background-color:#34eb99;border:0px;"><i class="fas fa-sort-numeric-down"></i></button></td><td  style="border: 1px solid black;background-color:rgba(0, 0, 255, 0.5);color:white" >'+hour_replace(secs_to_hours(saloon_start_time))+' - '+hour_replace(secs_to_hours(saloon_start_time+session_delay_secs))+'</td><td  style="border: 1px solid black;background-color:rgba(0, 0, 255, 0.5);color:white" >'+scientific_program[days][saloon][element].name+'</td><td  style="border: 1px solid black;background-color:rgba(0, 0, 255, 0.5);color:white">'+manager_name+" "+manager_surname+'</td><td style="border: 1px solid black;background-color:rgba(0, 0, 255, 0.5);color:white"><button class="sessiondelete_but_'+session_index+'"   style="background-color:red;border:0px;"><i class="far fa-trash-alt"></i></button><button onclick="value_changer(\'.model_user_to_session_change_value\',\''+scientific_program[days][saloon][element].manager+'\'),click_event_changer(\'.session_manager_change_but\',\''+element+'\',\''+session_index+'\', [\''+scientific_program[days][saloon][element].name+'\',\''+scientific_program[days][saloon][element].name_en+'\',\''+scientific_program[days][saloon][element].time+'\'])" data-toggle="modal" data-target="#exampleModal_Session_Change" class="session_arrangement_but_'+session_index+'"  style="background-color:#34cfeb;border:0px;"><i class="fas fa-pen-square"></i></button><button onclick="newabstract(\''+element+'\',\''+session_index+'\',1)" style="background-color:#34cfeb;border:0px;"><i class="fas fa-file-alt"></i></button><button onclick="newsuggestion(\''+element+'\',\''+session_index+'\')" style="background-color:yellow;border:0px;"><i class="fas fa-people-arrows"></i></button><input type="checkbox" onclick="session_time_state_change(\''+element+'\',this)" class="session_time_state_change" value="'+time_state_val+'" '+time_state+'></td></tr>';
                    $(".new-abstract").css("visibility","visible");
            
               //,\''+scientific_program[days][saloon][element].name+'\',\''+scientific_program[days][saloon][element].name_en+'\',\''+scientific_program[days][saloon][element].time+'\'
                    var suggestion=0;
                    var abstract_time_finish=saloon_start_time;
                    for(a=0;a<scientific_program[days][saloon][element].abstracts.length;a++)
                    {
                        
                        for(b=0;b<abstracts_inuse.length;b++)
                        {
                            if(parseInt(scientific_program[days][saloon][element].abstracts[a][0]) == parseInt(abstracts_inuse[b][4]))
                            {
                                abstract_time = abstract_time_finish;
                                abstract_time_hour =(scientific_program[days][saloon][element].time_state == 1)? secs_to_hours(abstract_time):"";
                                abstract_time_finish = abstract_time_finish+abstracts_delay_secs
                                abstract_finish_time_hour = (scientific_program[days][saloon][element].time_state == 1)? secs_to_hours(abstract_time_finish):"";
                                abstracts_html +='<tr class="abstract_'+abstracts_inuse[b][4]+' session_'+session_index+'"><td style="border: 1px solid black;"><button onclick="abstract_pos_change(\''+element+'\',\''+abstracts_inuse[b][4]+'\',1)" style="background-color:#34eb99;border:0px;"><i class="fas fa-sort-numeric-up"></i></button><button onclick="abstract_pos_change(\''+element+'\',\''+abstracts_inuse[b][4]+'\',-1)" style="background-color:#34eb99;border:0px;"><i class="fas fa-sort-numeric-down"></i></button></td><td  style="border: 1px solid black;">'+abstract_time_hour+' - '+abstract_finish_time_hour+'</td><td style="border: 1px solid black;">'+abstracts_inuse[b][6]+'</td><td style="border: 1px solid black;">'+abstracts_inuse[b][11]+'</td><td style="border: 1px solid black;background-color:rgba(0, 0, 255, 0.5);color:white"><button class="abstractdelete_but_'+abstracts_inuse[b][4]+'"  onclick="abstract_delete(\''+abstracts_inuse[b][4]+'\',\''+element+'\')" style="background-color:red;border:0px;"><i class="far fa-trash-alt"></i></button><button class="abstractdelete_but_'+abstracts_inuse[b][4]+'"  onclick="abstract_arrangement(\''+abstracts_inuse[b][4]+'\',\''+element+'\')" style="background-color:#34cfeb;border:0px;"><i class="fas fa-pen-square"></i></button></td></tr>';
                                break;
                            }
                        }
                        if(scientific_program[days][saloon][element].abstracts[a][0] === "suggestion")
                        {
                            abstract_time = abstract_time_finish;
                            abstract_time_hour =(scientific_program[days][saloon][element].time_state == 1)? secs_to_hours(abstract_time):"";
                            suggestion = parseInt(scientific_program[days][saloon][element].abstracts[a][3])*60;
                            abstract_time_finish = abstract_time_finish+suggestion;
                            abstract_finish_time_hour = (scientific_program[days][saloon][element].time_state == 1)? secs_to_hours(abstract_time_finish):"";
                            abstracts_html +='<tr><td style="border: 1px solid black;"><button onclick="suggestion_pos_change(\''+element+'\',\''+a+'\',1)" style="background-color:#34eb99;border:0px;"><i class="fas fa-sort-numeric-up"></i></button><button onclick="suggestion_pos_change(\''+element+'\',\''+a+'\',-1)" style="background-color:#34eb99;border:0px;"><i class="fas fa-sort-numeric-down"></i></button></td><td  style="border: 1px solid black;">'+abstract_time_hour+' - '+abstract_finish_time_hour+'</td><td style="border: 1px solid black;">'+scientific_program[days][saloon][element].abstracts[a][1]+'</td><td style="border: 1px solid black;"></td><td style="border: 1px solid black;background-color:rgba(0, 0, 255, 0.5);color:white"><button onclick="suggestion_delete(\''+a+'\',\''+element+'\')" style="background-color:red;border:0px;"><i class="far fa-trash-alt"></i></button><button class="abstractdelete_but_'+a+'"  onclick="suggestion_arrangement(\''+a+'\',\''+element+'\',\''+scientific_program[days][saloon][element].abstracts[a][1]+'\',\''+scientific_program[days][saloon][element].abstracts[a][2]+'\',\''+scientific_program[days][saloon][element].abstracts[a][3]+'\')" style="background-color:#34cfeb;border:0px;"><i class="fas fa-pen-square"></i></button></td></tr>';   
                           
                        }
                    }
                    saloon_start_time += session_delay_secs;
                    $('.session-box-table').html(abstracts_html);
                    $(".sessiondelete_but_"+session_index)[0].setAttribute("onclick",'sessiondelete(\''+session_index+'\',\''+element+'\',\''+JSON.stringify(scientific_program[days][saloon][element].abstracts)+'\')');
                    abstracts_html = $('.session-box-table').html();
                }
                
            
                

                $(".session-box").css("visibility","visible");
            
                session_index +=1;
            }
        });

    }
}

function value_changer(element,value)
{
    $(element).val(value);
}

function click_event_changer(element,json_element,session_index,value="")
{
    console.log(value);

    str_to_session_click="";
    for(i=0;i<value.length;i++)
    {
        str_to_session_click += ',\''+value[i]+'\'';
    }
    $(element)[0].setAttribute("onclick",'session_arrangement(\''+session_index+'\',\''+json_element+'\''+str_to_session_click+')');        
}



    function session_time_state_change(session,element){
        
        var days = $(".days-select").val();
        var saloon = $(".saloon-select").val();
        if(element.checked === true)
        {
            scientific_program[days][saloon][session].time_state = 1;
        }
        else if(element.checked === false)
        {

            scientific_program[days][saloon][session].time_state = 0;
        }
        saloon_refresh(days,saloon);

    }


$(document).ready(function()
{

    $(".saloon-select").change(function()
    {

        $(".new-abstract").css("visibility","hidden");

        var days = $(".days-select").val();
        var saloon = $(this).val();
        
        var session_box = $('.session-box-table').html();

     
        session_index=0;
        saloon_refresh(days,saloon);

        
        $(".session-box").css("visibility","visible");
        $(".new-session").css("visibility","visible");
        
    })

});



$(document).ready(function(){

$(".abstract_cat_change").change(function(){

        
        abstracts_html = "";
        abstracts_html += '<tr><td style="border:1px solid black;">Bildiri no</td><td style="border:1px solid black;">Bildiri baslik</td><td style="border:1px solid black;">Bildiri kategori</td><td style="border:1px solid black;">Bildiri Türü</td></tr>';
        for(a=0;a<abstracts.length;a++)
        {
            if($(this).val() == abstracts[a][7] && $(".abstract_type_change").val()== abstracts[a][12])
            {
                abstracts_html +='<tr><td style="border: 1px solid black;">'+abstracts[a][4]+'</td><td style="border: 1px solid black;">'+abstracts[a][6]+'</td><td style="border: 1px solid black;">'+abstracts[a][7]+'</td><td style="border: 1px solid black;">'+abstracts[a][12]+'</td></tr>';
            }
                
        }
        $(".abstracts-nonuse").html(abstracts_html);
    
}).change();




$(".abstract_type_change").change(function(){

        
abstracts_html = "";
abstracts_html += '<tr><td style="border:1px solid black;">Bildiri no</td><td style="border:1px solid black;">Bildiri baslik</td><td style="border:1px solid black;">Bildiri kategori</td><td style="border:1px solid black;">Bildiri Türü</td></tr>';
for(a=0;a<abstracts.length;a++)
{
    if($(".abstract_cat_change").val() == abstracts[a][7] && $(this).val() == abstracts[a][12])
    {
        abstracts_html +='<tr><td style="border: 1px solid black;">'+abstracts[a][4]+'</td><td style="border: 1px solid black;">'+abstracts[a][6]+'</td><td style="border: 1px solid black;">'+abstracts[a][7]+'</td><td style="border: 1px solid black;">'+abstracts[a][12]+'</td></tr>';
    }
        
}
$(".abstracts-nonuse").html(abstracts_html);

}).change();





});

Object.size = function(obj) {
  var size = 0,
    key;
  for (key in obj) {
    if (obj.hasOwnProperty(key)) size++;
  }
  return size;
};


function day_index_count()
{
    if(Object.size(scientific_program) > 0)
    {
        arr=[];
        Object.keys(scientific_program).forEach(day =>{
            if(day != "tr" && day != "en")
            {
                arr.push(day);
            
            }
        });
        arr.sort();
        return (arr.length > 0)? Math.max(...arr) : 0;
    }
    else
    {
        return 0;
    }
}




function newdayfunc()
{
    var value = prompt("Türkçe bir gün belirtiniz");
    var value1 = prompt("İngilizce bir gün belirtiniz");


    if(value && value1)
    {
        current_day_index = day_index_count();
        var days = $(".days-select").html();
        scientific_program[(current_day_index+1)] ={tr:value,en:value1};
        
        $(".days-select").html(days+'<option value="'+(current_day_index+1)+'">'+value+'</option>');
        $(".saloon-div").css("visibility","hidden");
        $(".session-box").css("visibility","hidden");
        $(".new-session").css("visibility","hidden");
        $(".new-abstract").css("visibility","hidden");
    }
}



function saloon_index_count(day)
{
    if(Object.size(scientific_program[day]) > 0)
    {
        arr=[];
        Object.keys(scientific_program[day]).forEach(saloon =>{
            if(saloon != "tr" && saloon != "en")
            {
                arr.push(saloon);
            
            }
        });
        return (arr.length > 0)? Math.max(...arr) : 0;
    }
    else
    {
        return 0;
    }
}


function newsaloonfunc()
{
    var value = prompt("Türkçe bir salon adı belirtiniz");
    var value1 = prompt("İngilizce bir salon adı belirtiniz");
    var start_time = prompt("Başlangıç saati belirtiniz");

    if(value && value1)
    {
        
        var days = $(".days-select").val();
        var saloon = $(".saloon-select").html();
        current_saloon_index = saloon_index_count(days);

        scientific_program[days][current_saloon_index+1] ={
            tr:value,
            en:value1,
            start_time: start_time,
        };

        $(".saloon-select").html(saloon+'<option value="'+(current_saloon_index+1)+'">'+value+'</option>');
        $(".session-box").css("visibility","hidden");
        $(".new-session").css("visibility","hidden");
        $(".new-abstract").css("visibility","hidden");
    }
}



function session_index_count(day,saloon)
{
    if(Object.size(scientific_program[day][saloon]) > 0)
    {
        arr=[];
        Object.keys(scientific_program[day][saloon]).forEach(session =>{
            if(session != "tr" && session != "en" && session != "start_time")
            {
                arr.push(session);
            
            }
        });
        return (arr.length > 0)? Math.max(...arr) : 0;
    }
    else
    {
        return 0;
    }
}

function newsession()
{
    var session_name = prompt("Türkçe bir oturum adı belirtiniz");
    var session_name_en = prompt("İngilizce bir oturum adı belirtiniz");
    var session_manager = $(".model_user_to_session_value").val();
    var session_time = prompt("Oturum süresini dakika cinsinde, sayı olarak belirtiniz");

    if(session_name && session_name_en && session_manager && session_time)
    {
        
        var days = $(".days-select").val();
        var saloon = $(".saloon-select").val();
        var sessions = $(".session-box-table").html();
        current_session_index = session_index_count(days,saloon);
        
        scientific_program[days][saloon][current_session_index+1] ={
            name:session_name,
            name_en:session_name_en,
            time: session_time,
            manager:session_manager,
            abstracts:[],
            break:0,
        };
        manager_name = "";
        manager_surname = ""; 
        for(i=0;i<all_users.length;i++)
        {
            if(session_manager == all_users[i].id)
            {
                manager_name = all_users[i].uye_adi;
                manager_surname = all_users[i].uye_soyadi;
            }
        }
        saloon_refresh(days,saloon,session_index);
        $(".new-abstract-btn")[0].setAttribute("onclick","newabstract('"+(current_session_index+1)+"','"+session_index+"')");
        $(".new-abstract").css("visibility","visible");
        
        session_index +=1;

        
    }
    else
    {
        alert("İçerikte lütfen virgül işareti kullanmayın");
    }
}




function newcell()
{
    var cell_tr_2 = prompt("Hücreye Türkçe değer girin (1/2)");
    var cell_tr_3 = prompt("Hücreye Türkçe değer girin (2/2)");
    var cell_en_2 = prompt("Hücreye İngilizce değer girin (1/2)");
    var cell_en_3 = prompt("Hücreye İngilizce değer girin (1/2)");
    var cell_time = prompt("Hücre süresini dakika cinsinde, sayı olarak belirtiniz");

    var days = $(".days-select").val();
    var saloon = $(".saloon-select").val();
    var sessions = $(".session-box-table").html();

    current_session_index = session_index_count(days,saloon);
    
    scientific_program[days][saloon][current_session_index+1] ={
        time:(cell_time != null)?cell_time:"",
        cell_tr_2:(cell_tr_2 != null)?cell_tr_2:"",
        cell_tr_3:(cell_tr_3 != null)?cell_tr_3:"",
        cell_en_2:(cell_en_2 != null)?cell_en_2:"",
        cell_en_3:(cell_en_3 != null)?cell_en_3:"",
        break:2,
    };


    saloon_refresh(days,saloon,session_index);
    $(".new-abstract").css("visibility","hidden");
    
    session_index +=1;



}



function newbreak()
{
    var session_name = prompt("Ara'ya Türkçe bir isim verin");
    var session_name_en = prompt("Ara'ya İngilizce bir isim verin");
    var session_time = prompt("Ara'nın uzunluğunu dakika cinsinde sayı olarak belirtiniz");

    if(session_name && session_name_en && session_time)
    {
        
        var days = $(".days-select").val();
        var saloon = $(".saloon-select").val();
        var sessions = $(".session-box-table").html();

        current_session_index = session_index_count(days,saloon);
        
        scientific_program[days][saloon][current_session_index+1] ={
            name:session_name,
            name_en:session_name_en,
            time: session_time,
            break:1,
        };
        saloon_refresh(days,saloon,session_index);
        $(".new-abstract").css("visibility","hidden");
        
        session_index +=1;

    }

    else
    {
        alert("İçerikte lütfen virgül işareti kullanmayın");
    }
}




function newabstract(session_index_json,session_index, specific_session = null)
{
    var abstract_id = prompt("Bir bildiri numarası belirtiniz");
    if(abstract_id)
    {
        
        var days = $(".days-select").val();
        var saloon = $(".saloon-select").val();
        var sessions = $(".session-box-table").html();
        var current_session_index = (specific_session != null)? session_index_json :session_index_count(days,saloon);


        cakisma =0;
        for(i=0;i<abstracts.length;i++)
        {
            if(parseInt(abstracts[i][4]) == parseInt(abstract_id) && $(".abstract_cat_change").val() == abstracts[i][7] && $(".abstract_type_change").val() == abstracts[i][12])
            {
                scientific_program[days][saloon][current_session_index].abstracts.push([abstract_id]); 

                cakisma +=1;
                abstracts_inuse.push(abstracts[i]);
                abstracts.splice(i,1);
            }
        }
        abstracts_html = "";
        abstracts_html += '<tr><td style="border:1px solid black;">Bildiri no</td><td style="border:1px solid black;">Bildiri baslik</td><td style="border:1px solid black;">Bildiri kategori</td><td style="border:1px solid black;">Bildiri Türü</td></tr>';
        for(a=0;a<abstracts.length;a++)
        {

            if($(".abstract_cat_change").val() == abstracts[a][7] && $(".abstract_type_change").val()== abstracts[a][12])
            {
                abstracts_html +='<tr ><td style="border: 1px solid black;">'+abstracts[a][4]+'</td><td style="border: 1px solid black;">'+abstracts[a][6]+'</td><td style="border: 1px solid black;">'+abstracts[a][7]+'</td><td style="border: 1px solid black;">'+abstracts[a][12]+'</td></tr>';
            }
           
        }
        saloon_refresh(days,saloon,session_index);
        $(".abstracts-nonuse").html(abstracts_html);
        $(".sessiondelete_but_"+session_index)[0].setAttribute("onclick",'sessiondelete(\''+session_index+'\',\''+current_session_index+'\',\''+JSON.stringify(scientific_program[days][saloon][current_session_index].abstracts)+'\')');
        if(cakisma == 0)
        {
            alert('Ekleme işlemi başarısız oldu');
        }
        
    }
}
function newsuggestion(element,session_index)
{

   
    var suggestion_name = prompt("Tartışmaya'ya Türkçe bir isim verin");
    var suggestion_name_en = prompt("Tartışmaya'ya İngilizce bir isim verin");
    var time = prompt("Tartışmanın ne kadar süreceğini dakika cinsinde sayı olarak yazınız");

    if(suggestion_name && suggestion_name_en && time)
    {
        
        var days = $(".days-select").val();
        var saloon = $(".saloon-select").val();


        scientific_program[days][saloon][element].abstracts.push(["suggestion",suggestion_name,suggestion_name_en,time]); 

      
        saloon_refresh(days,saloon,session_index);
        $(".sessiondelete_but_"+session_index)[0].setAttribute("onclick",'sessiondelete(\''+session_index+'\',\''+element+'\',\''+JSON.stringify(scientific_program[days][saloon][element].abstracts)+'\')');
     
    }
}

function session_arrangement(session_index,element,name,name_en,time)
{
    var days = $(".days-select").val();
    var saloon = $(".saloon-select").val();
    var session_name = prompt("Türkçe bir oturum adı belirtiniz",name);
    var session_name_en = prompt("İngilizce bir oturum adı belirtiniz",name_en);
    var session_manager = $(".model_user_to_session_change_value").val();
    var session_time = prompt("Oturum süresini dakika cinsinde, sayı olarak belirtiniz",time);

    if(session_name && session_name_en && session_manager && session_time)
    {
        
     
        var sessions = $(".session-box-table").html();
        session_abstracts = scientific_program[days][saloon][element].abstracts;
        scientific_program[days][saloon][element] ={
            name:session_name,
            name_en:session_name_en,
            time: session_time,
            manager:session_manager,
            break:0,
            abstracts:session_abstracts,
            time_state:scientific_program[days][saloon][element].time_state,
        };
        manager_name = "";
        manager_surname = ""; 
        for(i=0;i<all_users.length;i++)
        {
            if(session_manager == all_users[i].id)
            {
                manager_name = all_users[i].uye_adi;
                manager_surname = all_users[i].uye_soyadi;
            }
        }
        saloon_refresh(days,saloon,session_index);
        $(".new-abstract-btn")[0].setAttribute("onclick","newabstract('"+element+"','"+session_index+"')");
        $(".new-abstract").css("visibility","visible");
        
    
    }
    else
    {
    }
}



function break_arrangement(session_index,element,name,name_en,time)
{
    var session_name = prompt("Ara'ya Türkçe bir isim verin",name);
    var session_name_en = prompt("Ara'ya İngilizce bir isim verin",name_en);
    var session_time = prompt("Ara'nın uzunluğunu dakika cinsinde sayı olarak belirtiniz",time);

        if(session_name && session_name_en && session_time)
        {
            
            var days = $(".days-select").val();
            var saloon = $(".saloon-select").val();
            var sessions = $(".session-box-table").html();
            scientific_program[days][saloon][element] ={
                name:session_name,
                name_en:session_name_en,
                time: session_time,
                break:1,
            };
            saloon_refresh(days,saloon,session_index);
            $(".new-abstract").css("visibility","hidden");
            
            session_index +=1;

        }
        else
        {
            alert("İçerikte lütfen virgül işareti kullanmayın");
        }
}


function cell_arrangement(session_index,element,cell_tr_2,cell_tr_3,cell_en_2,cell_en_3,time)
{
    var cell_tr_2 = prompt("Hücreye Türkçe değer girin (1/2)",cell_tr_2);
    var cell_tr_3 = prompt("Hücreye Türkçe değer girin (2/2)",cell_tr_3);
    var cell_en_2 = prompt("Hücreye İngilizce değer girin (1/2)",cell_en_2);
    var cell_en_3 = prompt("Hücreye İngilizce değer girin (2/2)",cell_en_3);
    var cell_time = prompt("Hücre süresini dakika cinsinde, sayı olarak belirtiniz",time);


    if(!cell_tr_2 && !cell_tr_3 && !cell_en_2 && !cell_en_3 && !cell_time)
    {
        return;
    }
    
    var days = $(".days-select").val();
    var saloon = $(".saloon-select").val();
    var sessions = $(".session-box-table").html();
    scientific_program[days][saloon][element] ={
        time:(cell_time != null)?cell_time:"",
        cell_tr_2:(cell_tr_2 != null)?cell_tr_2:"",
        cell_tr_3:(cell_tr_3 != null)?cell_tr_3:"",
        cell_en_2:(cell_en_2 != null)?cell_en_2:"",
        cell_en_3:(cell_en_3 != null)?cell_en_3:"",
        break:2,
    };


    saloon_refresh(days,saloon,session_index);
    $(".new-abstract").css("visibility","hidden");
    
    session_index +=1;

    
}

function abstract_arrangement(abstract_id,element)
{

    var abstract_id_change = prompt("Bir bildiri numarası belirtiniz",abstract_id);

    if(element && abstract_id_change)
    {
        
        var days = $(".days-select").val();
        var saloon = $(".saloon-select").val();
        var sessions = $(".session-box-table").html();



        cakisma =0;

        for(b=0;b<abstracts.length;b++)
        {
            if(parseInt(abstracts[b][4]) == parseInt(abstract_id_change) && $(".abstract_cat_change").val() == abstracts[b][7] && $(".abstract_type_change").val() == abstracts[b][12])
            {
                cakisma =1;
                abstracts_inuse.push(abstracts[b]);
                abstracts.splice(b,1);
                for(i=0;i<scientific_program[days][saloon][element].abstracts.length;i++)
                {
                    if(abstract_id == scientific_program[days][saloon][element].abstracts[i][0])
                    {
                        scientific_program[days][saloon][element].abstracts.splice(i,1,[abstract_id_change]);
                    }
                

                }

            }

        }

        cakisma1 =0;
        for(i=0;i<abstracts_inuse.length;i++)
        {
            if(parseInt(abstracts_inuse[i][4]) == parseInt(abstract_id) && cakisma == 1)
            {
                cakisma1 =1;
                abstracts.unshift(abstracts_inuse[i]);
                abstracts_inuse.splice(i,1);
           
            }
           
        }

     
     
        abstracts_html = "";
        abstracts_html += '<tr><td style="border:1px solid black;">Bildiri no</td><td style="border:1px solid black;">Bildiri baslik</td><td style="border:1px solid black;">Bildiri kategori</td><td style="border:1px solid black;">Bildiri Türü</td></tr>';
        for(a=0;a<abstracts.length;a++)
        {

            if($(".abstract_cat_change").val() == abstracts[a][7] && $(".abstract_type_change").val()== abstracts[a][12])
            {
                abstracts_html +='<tr ><td style="border: 1px solid black;">'+abstracts[a][4]+'</td><td style="border: 1px solid black;">'+abstracts[a][6]+'</td><td style="border: 1px solid black;">'+abstracts[a][7]+'</td><td style="border: 1px solid black;">'+abstracts[a][12]+'</td></tr>';
            }
        
        }

      
        $(".abstracts-nonuse").html(abstracts_html);

        saloon_refresh(days,saloon);
    
        if(cakisma1 ==0)
        {
        }
       
    }

}
function suggestion_arrangement(suggestion_index,element,name,name_en,time)
{
    
    var suggestion_name = prompt("Tartışmaya'ya Türkçe bir isim verin",name);
    var suggestion_name_en = prompt("Tartışmaya'ya İngilizce bir isim verin",name_en);
    var time = prompt("Tartışmanın ne kadar süreceğini dakika cinsinde sayı olarak yazınız",time);

    if(suggestion_name && suggestion_name_en && time && element && suggestion_index)
    {
        
        var days = $(".days-select").val();
        var saloon = $(".saloon-select").val();

        if(scientific_program[days][saloon][element].abstracts[suggestion_index][0] === "suggestion")
        {
            scientific_program[days][saloon][element].abstracts[suggestion_index] = ["suggestion",suggestion_name,suggestion_name_en,time]
        }
        saloon_refresh(days,saloon);
    }
}

function closest_index(object,right_pos)
{
    arr=[];
    Object.keys(object).forEach(indexes =>{

        if(indexes != "tr" && indexes != "en" && indexes != "start_time")
        {
            arr.push(indexes);
        }
    });
    var diffArr = arr.map(x => Math.abs(parseInt(right_pos) - x));
    var minNumber = Math.min(...diffArr);
    var index = diffArr.findIndex(x => x === minNumber);
    return [arr,index];
}



function session_break_cell_pos_change(element,pos_change = null)
{   
    if(pos_change != null)
    {
   

        var days = $(".days-select").val();
        var saloon = $(".saloon-select").val();
        if(pos_change == 1)
        {
            var pos_infos = closest_index(scientific_program[days][saloon],element);
            var arr = pos_infos[0];
            var index = pos_infos[1];

            if(Object.size(scientific_program[days][saloon][arr[parseInt(index)-1]])>0)
            {
                ust_sıra_arr = scientific_program[days][saloon][arr[parseInt(index)-1]];
                scientific_program[days][saloon][arr[parseInt(index)-1]] = scientific_program[days][saloon][parseInt(element)];
                scientific_program[days][saloon][parseInt(element)] = ust_sıra_arr;
            }
         
        }
        else if(pos_change == -1)
        {
            var pos_infos = closest_index(scientific_program[days][saloon],element);
            var arr = pos_infos[0];
            var index = pos_infos[1]; 
            if(Object.size(scientific_program[days][saloon][arr[parseInt(index)+1]])>0)
            {
                alt_sıra_arr = scientific_program[days][saloon][arr[parseInt(index)+1]];
                scientific_program[days][saloon][arr[parseInt(index)+1]] = scientific_program[days][saloon][parseInt(element)];
                scientific_program[days][saloon][parseInt(element)] = alt_sıra_arr;
            }
        }

        saloon_refresh(days,saloon);
    }
    else
    {
        alert("İşlem gerçekleştirilirken bir hata oluştu");  
    }
} 


function abstract_pos_change(element,abstract_id,pos_change = null)
{
    if(pos_change != null)
    {        
        var days = $(".days-select").val();
        var saloon = $(".saloon-select").val();
        if(pos_change == 1)
        {
            for(i=1;i<scientific_program[days][saloon][element].abstracts.length;i++)
            {
                if(scientific_program[days][saloon][element].abstracts[i][0] == abstract_id)
                {
                    ust_sıra_arr = scientific_program[days][saloon][element].abstracts[i-1];
                    scientific_program[days][saloon][element].abstracts[i-1]= scientific_program[days][saloon][element].abstracts[i];
                    scientific_program[days][saloon][element].abstracts[i] = ust_sıra_arr;
                    break;
                }
            }
          
        }
        else if(pos_change == -1)
        {
            for(i=0;i<scientific_program[days][saloon][element].abstracts.length-1;i++)
            {
                if(scientific_program[days][saloon][element].abstracts[i][0] == abstract_id )
                {
                    alt_sıra_arr = scientific_program[days][saloon][element].abstracts[i+1];
                    scientific_program[days][saloon][element].abstracts[i+1]= scientific_program[days][saloon][element].abstracts[i];
                    scientific_program[days][saloon][element].abstracts[i] = alt_sıra_arr;
                    break;
                }
            }
        }
        saloon_refresh(days,saloon);
    }
    else
    {
        alert("İşlem gerçekleştirilirken bir hata oluştu");  
    }
} 

function suggestion_pos_change(element,suggestion_index,pos_change = null)
{
    if(pos_change != null)
    {        
        var days = $(".days-select").val();
        var saloon = $(".saloon-select").val();
        if(pos_change == 1)
        {
            if(parseInt(suggestion_index) >0)
            {

                ust_sıra_arr = scientific_program[days][saloon][element].abstracts[parseInt(suggestion_index)-1];
                scientific_program[days][saloon][element].abstracts[parseInt(suggestion_index)-1]= scientific_program[days][saloon][element].abstracts[parseInt(suggestion_index)];
                scientific_program[days][saloon][element].abstracts[parseInt(suggestion_index)] = ust_sıra_arr;
            }
        }
        else if(pos_change == -1)
        {
            if(parseInt(suggestion_index) < scientific_program[days][saloon][element].abstracts.length-1)
            {
                alt_sıra_arr = scientific_program[days][saloon][element].abstracts[parseInt(suggestion_index)+1];
                scientific_program[days][saloon][element].abstracts[parseInt(suggestion_index)+1]= scientific_program[days][saloon][element].abstracts[parseInt(suggestion_index)];
                scientific_program[days][saloon][element].abstracts[parseInt(suggestion_index)] = alt_sıra_arr;
            }
        }
        saloon_refresh(days,saloon);
    }
    else
    {
        alert("İşlem gerçekleştirilirken bir hata oluştu");  
    }
} 



function daydelete()
{
    var y ;
     if (confirm("Bildirinizi silmek istediğinizden emin misiniz ?") == true) {
        var days = $(".days-select").val();
        Object.keys(scientific_program).forEach(days_arr => {
            if(days_arr == days)
            {
                Object.keys(scientific_program[days_arr]).forEach(saloon_arr => {
                    if(Object.size(scientific_program[days_arr][saloon_arr]) > 3)
                    {
                        Object.keys(scientific_program[days_arr][saloon_arr]).forEach(session_arr => {
                            if(scientific_program[days_arr][saloon_arr][session_arr].break == 0)
                            {
                                for(i=0;i<scientific_program[days_arr][saloon_arr][session_arr].abstracts.length;i++)
                                {
                                    for(a=0;a<abstracts_inuse.length;a++)
                                    {
                                        if(scientific_program[days_arr][saloon_arr][session_arr].abstracts[i][0] == abstracts_inuse[a][4])
                                        {
                                            abstracts.unshift(abstracts_inuse[a]);
                                            abstracts_inuse.splice(a,1);
                                        }   
                                    }
                                }
                            }
                        });
                    }
                });

                $(".days-select option[value='"+days+"']").remove();
                delete scientific_program[days_arr];
                $(".saloon-div").css("visibility","hidden");
                $(".session-box").css("visibility","hidden");
                $(".new-session").css("visibility","hidden");

                abstracts_html = "";
                abstracts_html += '<tr><td style="border:1px solid black;">Bildiri no</td><td style="border:1px solid black;">Bildiri baslik</td><td style="border:1px solid black;">Bildiri kategori</td><td style="border:1px solid black;">Bildiri Türü</td></tr>';
                for(a=0;a<abstracts.length;a++)
                {
                    if($(".abstract_cat_change").val() == abstracts[a][7] && $(".abstract_type_change").val() == abstracts[a][12])
                    {
                        abstracts_html +='<tr><td style="border: 1px solid black;">'+abstracts[a][4]+'</td><td style="border: 1px solid black;">'+abstracts[a][6]+'</td><td style="border: 1px solid black;">'+abstracts[a][7]+'</td><td style="border: 1px solid black;">'+abstracts[a][12]+'</td></tr>';
                    }
                        
                }
                $(".abstracts-nonuse").html(abstracts_html);
                return;
            }
        });

     } 
     else 
     {
         y = "Bildiri silme işleminiz iptal edildi!";
         alert(y); 
     }
}



function saloondelete()
{
    var y ;
     if (confirm("Bildirinizi silmek istediğinizden emin misiniz ?") == true) {
        var saloon = $(".saloon-select").val();
        Object.keys(scientific_program).forEach(days_arr => {
            Object.keys(scientific_program[days_arr]).forEach(saloon_arr => {

                if(saloon_arr == saloon)
                {
                    if(Object.size(scientific_program[days_arr][saloon_arr]) > 3)
                    {
                        Object.keys(scientific_program[days_arr][saloon_arr]).forEach(session_arr => {
                            if(scientific_program[days_arr][saloon_arr][session_arr].break == 0)
                            {
                                for(i=0;i<scientific_program[days_arr][saloon_arr][session_arr].abstracts.length;i++)
                                {
                                    for(a=0;a<abstracts_inuse.length;a++)
                                    {
                                        if(scientific_program[days_arr][saloon_arr][session_arr].abstracts[i][0] == abstracts_inuse[a][4])
                                        {
                                            abstracts.unshift(abstracts_inuse[a]);
                                            abstracts_inuse.splice(a,1);
                                        }   
                                    }
                                }
                            }
                        });
                    }
                    $(".saloon-select option[value='"+saloon+"']").remove();
                    delete scientific_program[days_arr][saloon_arr];
                    $(".session-box").css("visibility","hidden");
                    $(".new-session").css("visibility","hidden");
                    abstracts_html = "";
                    abstracts_html += '<tr><td style="border:1px solid black;">Bildiri no</td><td style="border:1px solid black;">Bildiri baslik</td><td style="border:1px solid black;">Bildiri kategori</td><td style="border:1px solid black;">Bildiri Türü</td></tr>';
                    for(a=0;a<abstracts.length;a++)
                    {
                        if($(".abstract_cat_change").val() == abstracts[a][7] && $(".abstract_type_change").val() == abstracts[a][12])
                        {
                            abstracts_html +='<tr><td style="border: 1px solid black;">'+abstracts[a][4]+'</td><td style="border: 1px solid black;">'+abstracts[a][6]+'</td><td style="border: 1px solid black;">'+abstracts[a][7]+'</td><td style="border: 1px solid black;">'+abstracts[a][12]+'</td></tr>';
                        }
                            
                    }
                    $(".abstracts-nonuse").html(abstracts_html);
                    return;

                }
            });
        });

     } 
     else 
     {
         y = "Bildiri silme işleminiz iptal edildi!";
         alert(y); 
     }
}


function sessiondelete(session_index,session_tr_tag,abstracts_remove ="" )
{

    
    var days = $(".days-select").val();
    var saloon = $('.saloon-select').val();

    if(abstracts_remove != "")
    {
 
        abstracts_remove = JSON.parse(abstracts_remove);
        for(i=0;i<abstracts_remove.length;i++)
        {
            for(b=0;b<abstracts_inuse.length;b++)
            {
                if(abstracts_inuse[b][4] == abstracts_remove[i][0])
                {
                    abstracts.unshift(abstracts_inuse[b]);
                    abstracts_inuse.splice(b,1);
                }
            }
        }

    }



        abstracts_html = "";
        abstracts_html += '<tr><td style="border:1px solid black;">Bildiri no</td><td style="border:1px solid black;">Bildiri baslik</td><td style="border:1px solid black;">Bildiri kategori</td><td style="border:1px solid black;">Bildiri Türü</td></tr>';
        for(a=0;a<abstracts.length;a++)
        {

            if($(".abstract_cat_change").val() == abstracts[a][7] && $(".abstract_type_change").val() == abstracts[a][12])
            {
                abstracts_html +='<tr><td style="border: 1px solid black;">'+abstracts[a][4]+'</td><td style="border: 1px solid black;">'+abstracts[a][6]+'</td><td style="border: 1px solid black;">'+abstracts[a][7]+'</td><td style="border: 1px solid black;">'+abstracts[a][12]+'</td></tr>';
            }
            
        }
        $(".abstracts-nonuse").html(abstracts_html);
        $(".new-abstract").css("visibility","hidden");
        saloon_refresh(days,saloon,session_index);
        
        delete scientific_program[days][saloon][session_tr_tag];
}

function abstract_delete(abstract_id,sessiondelete_but_index_func)
{

    
    var days = $(".days-select").val();
    var saloon = $(".saloon-select").val();

    for(b=0;b<abstracts_inuse.length;b++)
    {
        if(abstracts_inuse[b][4] == abstract_id)
        {
            abstracts.unshift(abstracts_inuse[b]);
            abstracts_inuse.splice(b,1);
        }
    }

    for(i=0;i<scientific_program[days][saloon][sessiondelete_but_index_func].abstracts.length;i++)
    {
        if(abstract_id == scientific_program[days][saloon][sessiondelete_but_index_func].abstracts[i][0])
        {
            scientific_program[days][saloon][sessiondelete_but_index_func].abstracts.splice(i,1);
        }
    }

    
    abstracts_html = "";
    abstracts_html += '<tr><td style="border:1px solid black;">Bildiri no</td><td style="border:1px solid black;">Bildiri baslik</td><td style="border:1px solid black;">Bildiri kategori</td><td style="border:1px solid black;">Bildiri Türü</td></tr>';
    for(a=0;a<abstracts.length;a++)
    {

        if($(".abstract_cat_change").val() == abstracts[a][7] && $(".abstract_type_change").val() == abstracts[a][12])
        {
            abstracts_html +='<tr><td style="border: 1px solid black;">'+abstracts[a][4]+'</td><td style="border: 1px solid black;">'+abstracts[a][6]+'</td><td style="border: 1px solid black;">'+abstracts[a][7]+'</td><td style="border: 1px solid black;">'+abstracts[a][12]+'</td></tr>';
        }
        
    }
    $(".abstracts-nonuse").html(abstracts_html);
    saloon_refresh(days,saloon,session_index);


}


function suggestion_delete(suggestion_index,element)
{
    
    
    var days = $(".days-select").val();
    var saloon = $(".saloon-select").val();

    if(scientific_program[days][saloon][element].abstracts[suggestion_index][0] === "suggestion")
    {
        scientific_program[days][saloon][element].abstracts.splice(suggestion_index,1);
    }
    

    saloon_refresh(days,saloon,session_index);
}

function admin_scientific_program_save()
{
    postForm("/admin_scientific_program_save",{scientific_program:JSON.stringify(scientific_program)});
}

</script>
</body>
</html>
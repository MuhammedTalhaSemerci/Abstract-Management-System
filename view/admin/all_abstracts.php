<?php



?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

 
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/a9da6c256f.js" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

</head>
<body>
    


    <style>
    
   
     td {
    border: 1px solid black;
    }

    table
    {
        font-size:10px;
    }
    button
    {
        font-size:10px;
    }
    </style>

    <!--
        katılımcı:0
        editör:1
        hakem:2
        admin:3
    -->
    <div style="display:flex;">
        <select name="search" id="" style="width:200px;margin-left:20px;margin-top:20px;" class="form-control">
            <option value="getall"selected>Arama filtresini Seçin</option>
            <option value="getall" >Tüm Bildiriler</option>
            <option value="withdrawal_none@0">Ödeme Yapmayanlar</option>
            <option value="withdrawal_none@1">Ödeme Yapanlar</option>
            <option value="acception_status@0">Değerlendirilmemiş</option>
            <option value="acception_status@1">Onaylanmış</option>
            <option value="acception_status@2">Reddedilmiş</option>
            <option value="acception_status@3">Düzenleme İstenmiş</option>
            <option value="acception_status@4">Düzenleme yapılmış</option>
            <option value="abstract_type@E-poster">E-Posterler</option>
            <option value="abstract_type@Sözlü Sunum">Sözlü Sunumlar</option>

            
        </select>
        
        <br>
        <input style="width:200px;margin-left:20px;margin-top:20px;" type="text" class="form-control col-lg-4 col-md 4 abstract_search" placeholder="Arama yap.">

        <button class="form-control" style="width:200px;margin-left:20px;margin-top:20px;" onclick="all_presentations()"> Tüm Sunumları İndir </button>

        <button class="form-control" style="width:200px;margin-left:20px;margin-top:20px;height:auto;" onclick="admin_abstract_main_author_mail_compare()"> Sorumlu Yazarları Kullanıcılarla İlişkilendir </button>

        

    </div>
   



    <?php
        $gun_index = 0;
        $saloon_index = 0;
        $scientific_program = json_decode($abstract_websites[0]["scientific_program"]);
        //echo '<h4 style="margin-left:20px;margin-top:20px;" >İndirmek istediğiniz oturumu seçin</h4>';
        echo '<select class="form-control col-4 presentations_by_session" style="margin-left:20px;margin-top:20px;">';
        echo '<option> İndirmek istediğiniz oturumu seçin </option>';
        foreach($scientific_program as $gun => $value)
        {
            foreach($scientific_program->{$gun} as $saloon => $value1)
            {

                foreach($scientific_program->{$gun}->{$saloon} as $session => $value2)
                {
                    if($saloon != "tr" && $saloon != "en" && $session != "tr" && $session != "en" && $session != "start_time")
                    {
                        
                        if($scientific_program->{$gun}->{$saloon}->{$session}->{"break"} == 1 && $scientific_program->{$gun}->{$saloon}->{$session}->{"break"} == 2)
                        {
                            continue;
                        }
                        else if($scientific_program->{$gun}->{$saloon}->{$session}->{"break"} == 0)
                        {
                            
                            $day_info = $scientific_program->{$gun}->{"tr"};
                            $saloon_info = $scientific_program->{$gun}->{$saloon}->{"tr"};
                            $session_info = $scientific_program->{$gun}->{$saloon}->{$session}->{"name"};
                            echo "<option value='[\"".$gun."\",\"".$saloon."\",\"".$session."\"]'>".$day_info." / ".$saloon_info." / ".$session_info."</option>";

                        }

                   }
                  
                  
                }
                $saloon_index += 1;
            }
            $gun_index += 1;
        }

        echo '</select>';


    ?>
    

  <!-- <h4 style="margin-left:20px;">Listedeki kullanıcılar için toplu mail hatırlatması yap.</h4>

    <button style="margin-left:20px;" class="form-control col-md-3 col-lg-3" onclick="editor_list_member_mailer()" >Ödeme maili gönder.</button><br>
-->
    <hr>
    <label style="margin-left:20px;">Listedeki kullanıcılar için toplu mail hatırlatması yap.</label>
    <textarea style = "margin-left:20px;" id="summernote" name="contant"></textarea>
    <br>
    <button style="margin-left:20px;" class="form-control col-md-3 col-lg-3" onclick="admin_list_member_mailer()" >Toplu mail gönder.</button><br>
    <br>
    <hr>

<?php



echo '<div style="margin-top:20px;"><table class="all_abstracts" style="margin-left:20px;">
        <tr>
            <td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Sıra </b></font></td>
            <td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Son Bildiri <br>No </b></font></td>
            <td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Bildiri <br>No </b></font></td>
            <td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Bildiri <br> Başlık: </b></font></td>
            <td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Bildiri <br> Kategori: </b></font></td>
            <td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Bildiri <br> Türü: </b></font></td>
            <td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Atama Durum: </b></font></td>
            <td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Sorumlu <br> Yazar Adı </b></font></td>
            <td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Soyadı </b></font></td>
            <td style="padding-left:7px; padding-right:7px; text-align:center;"><font color="red"><b>B. K. Üye Değ. </b></font></td>
            <td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Onayla </b></font></td>
            <td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>İşlemler</b></font></td>
            <td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Sorumlu Yazar ID</b></font></td>
            <td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Sunum</b></font></td>

        </tr>
        ';

for($i=0;$i<count($admin_all_abstracts);$i++){


    
    //çoklu kongrelerde düzenlenecek
    $congress_categories = json_decode($abstract_websites[0]["categories"]);

    if($uye_dil == "tr")
    {
    
    }
    
    else
    {
        $location=[];
        for($a=0;$a<count($congress_categories->{"tr"});$a++)
        {
            for($b=1;$b<count($congress_categories->{"tr"}[$a]);$b++)
                if($congress_categories->{"tr"}[$a][$b] == $admin_all_abstracts[$i][7])
                {
                    $admin_all_abstracts[$i][7] = $congress_categories->{$uye_dil}[$a][$b];
                }
        }
    }


    $referee_ids = [];
    $referee_ids1 = [];
    $referee_ids_last=[];
    $referee_ids_href = "";

    $edit_requests = json_decode($admin_all_abstracts[$i][8]);
    $referee_comments = json_decode($admin_all_abstracts[$i][9]);

    if(is_array($edit_requests))
    {
        for($a=0;$a<count($edit_requests);$a++)
        {
            array_push($referee_ids,strval($edit_requests[$a][0]));
        }
    }

    if(is_array($referee_comments))
    {
        for($b=0;$b<count($referee_comments);$b++)
        {    
            array_push($referee_ids1,strval($referee_comments[$b][0]));
        }
    }

    for($a=0;$a<count($referee_ids);$a++)
    {
        for($b=0;$b<count($referee_ids1);$b++)
        {
            if($referee_ids[$a] == $referee_ids1[$b])
            {
                unset($referee_ids1[$b]);
                $referee_ids1 = array_values($referee_ids1);
  
            }
        }
    }

    $referee_ids_last = array_merge($referee_ids,$referee_ids1);


    if(is_array($referee_ids_last) && $referee_ids_last)
    {
        for($a=0;$a<count($referee_ids_last);$a++)
        {
            $referee_ids_href .= '<a  target="_blank" style="text-decoration:none; " href="/abstract_edit_request_viewer?abstract_id='.$admin_all_abstracts[$i][4].'&referee_id='.$referee_ids_last[$a].'" title="'.($a+1).'. Bilim Kurulu Üye Değerlendirmesi"><i class="far fa-edit"></i>&nbsp;&nbsp;</a>';
        }
        
    }
    else
    {
        $referee_ids_href .= "";
    }

    array_push($admin_all_abstracts[$i],$referee_ids_href);



    $abstract_category_char = mb_strtoupper($admin_all_abstracts[$i][17][0]);
    if(strpos($admin_all_abstracts[$i][12],"-"))
    {
        $abstract_type_char = mb_strtoupper($admin_all_abstracts[$i][12][strpos($admin_all_abstracts[$i][12],"-")+1]);
    }
    else
    {
        $abstract_type_char = mb_strtoupper($admin_all_abstracts[$i][12][0]);
    }
    $last_abstract_no = intval($admin_all_abstracts[$i][13]);



echo '

<tr >
    <td style="padding-left:7px; padding-right:7px; "> '.($i+1).' </td>
    <td style="padding-left:7px; padding-right:7px; "> '.$abstract_category_char.$abstract_type_char.$last_abstract_no.' </td>
    <td style="padding-left:7px; padding-right:7px; ">'.$admin_all_abstracts[$i][4].'</td>
    <td style="padding-left:7px; padding-right:7px; " title="'.$admin_all_abstracts[$i][6].'">'; 
    
    if(strlen($admin_all_abstracts[$i][6])>35)
    {
        echo mb_substr($admin_all_abstracts[$i][6],0,35)."...";
    }
    else
    {
       echo $admin_all_abstracts[$i][6];
    }
    echo '</td>

    <td style="padding-left:7px; padding-right:7px; " title="'.$admin_all_abstracts[$i][7].'">'; 
    
    if(strlen($admin_all_abstracts[$i][7])>10)
    {
        echo mb_substr($admin_all_abstracts[$i][7],0,10)."...";
    }
    else
    {
       echo $admin_all_abstracts[$i][7];
    }
    echo '</td>';

    echo '<td style="padding-left:7px; padding-right:7px; ">'.$admin_all_abstracts[$i][12].'</td>';
    if(count(json_decode($admin_all_abstracts[$i][10]))>0 && is_array(json_decode($admin_all_abstracts[$i][10])))
    {
        echo '<td style="font-size:20px; text-align:center;color:green;"><i style="width:40px;" class="fas fa-check-square"></i></td>';
    }
    else
    {
        echo '<td style="font-size:20px; text-align:center;color:red;"><i  class="fas fa-times-circle"></i></td>';
    }

    echo '<td style="padding-left:7px; padding-right:7px; " >'.$admin_all_abstracts[$i][0].'</td>
    <td style="padding-left:7px; padding-right:7px; " >'.$admin_all_abstracts[$i][1].'</td>
    ';


    echo '<td>'.$referee_ids_href.'</td>';
    
    echo '<td style="padding-left:7px; padding-right:7px;">';
    if(intval($admin_all_abstracts[$i][5]) == 4)
    {
        echo '<i style="background-color:yellow" class="warning fas fa-exclamation-triangle"></i>';
    }

    echo '<select id="acception_state_'.$i.'" name="acception_state_'.$i.'" onChange="admin_abstract_accept(\'acception_state_'.$i.'\')">';

    

        echo '<option value="abstract_id='.$admin_all_abstracts[$i][4].'&acception=0"';if(intval($admin_all_abstracts[$i][5]) == 0){echo "selected";} echo'>Değerlendirilmemiş</option>';
        echo '<option value="abstract_id='.$admin_all_abstracts[$i][4].'&acception=1"';if(intval($admin_all_abstracts[$i][5]) == 1){echo "selected";} echo'>Onayla</option>'; 
        echo '<option value="abstract_id='.$admin_all_abstracts[$i][4].'&acception=2"';if(intval($admin_all_abstracts[$i][5]) == 2){echo "selected";} echo'>Reddet</option>'; 
        echo '<option value="abstract_id='.$admin_all_abstracts[$i][4].'&acception=3"';if(intval($admin_all_abstracts[$i][5]) == 3){echo "selected";} echo'>Düzenleme İste</option>'; 

        
    echo '</select></td>';

    echo '<td style="padding-left:7px; padding-right:7px;" >
     <a target="_blank" href="/admin_index?sayfa=abstract_authorization&abstract_id='.$admin_all_abstracts[$i][4].'"><i class="fas fa-user-plus" title="Bilim Kurulu Üyesi Ata"></i></a>&nbsp;&nbsp;
    <button class="btn" onclick="admin_abstract_delete(\''.$admin_all_abstracts[$i][4].'\')"><i class="fas fa-trash-alt" title="Bildiri Sil"></i></button>&nbsp;
    <a target="_blank" href="/abstract_viewer?abstract_id='.$admin_all_abstracts[$i][4].'"><i class="fas fa-file-alt" title="Görüntüle"></i></a> &nbsp;
    <a target="_blank" href="/admin_index?sayfa=abstract_update&abstract_id='.$admin_all_abstracts[$i][4].'"><i class="fas fa-pencil-ruler" title="Bildiriyi Düzenle"></i></a> &nbsp;
    <a target="_blank" href="/admin_index?sayfa=abstract_category_update&abstract_id='.$admin_all_abstracts[$i][4].'"><i class="fas fa-list" title="Bildiri Kategorisini Düzenle"></i></a> 
    <a target="_blank" href="/admin_index?sayfa=abstract_author_update&abstract_id='.$admin_all_abstracts[$i][4].'"><i class="fas fa-address-book" title="Bildiri Yazarlarını Düzenle"></i></a></td>

    <td><input type="number" data-id="'.$admin_all_abstracts[$i][4].'" class="abstract_main_author_id" value="'.$admin_all_abstracts[$i][16].'"></td>';
    echo '<td>';
    if(count($admin_all_abstracts[$i][18]) > 0)
    {
        echo '<a target="_blank" href="/view/abstracts/presentations/Bitki Koruma Kongresi/'.$abstract_category_char.$abstract_type_char.$last_abstract_no.'/'.$admin_all_abstracts[$i][18].'">Sunum</a>';
    }
    echo '</td>';
   
   echo ' </tr>

 ';

}

echo '
</table></div>';

?>

<script>

$('#summernote').summernote({
        placeholder: 'Bildiri özeti...',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['font', ['bold', 'italic','superscript', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });



var all_abstracts = JSON.parse(JSON.stringify(<?php echo json_encode($admin_all_abstracts,JSON_UNESCAPED_UNICODE)?>));



$(document).ready(function(){

    $(".abstract_search").change(function(){

        var search_text = $(".abstract_search").val();
        var abstract_index =1;
        var all_searched_abstracts ='<tr>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Sıra </b></font></td>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Bildiri <br>No </b></font></td>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Son Bildiri <br>No </b></font></td>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Bildiri <br> Başlık: </b></font></td>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Bildiri <br> Kategori: </b></font></td>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Bildiri <br> Türü: </b></font></td>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Atama Durum: </b></font></td>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Sorumlu <br> Yazar Adı </b></font></td>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Soyadı </b></font></td>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;"><font color="red"><b>B. K. Üye Değ. </b></font></td>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Onayla </b></font></td>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>İşlemler</b></font></td>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Sorumlu Yazar ID</b></font></td>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Sunum</b></font></td>';
            all_searched_abstracts += '</tr>';
        for(i=0;i<all_abstracts.length;i++)
        {
            if(String(all_abstracts[i][0]).toLowerCase().match(search_text.toLowerCase()) ||
            String(all_abstracts[i][1]).toLowerCase().match(search_text.toLowerCase()) ||
            String(all_abstracts[i][2]).toLowerCase().match(search_text.toLowerCase()) ||
            String(all_abstracts[i][3]).toLowerCase().match(search_text.toLowerCase()) ||
            String(all_abstracts[i][4]).toLowerCase().match(search_text.toLowerCase()) ||
            String(all_abstracts[i][6]).toLowerCase().match(search_text.toLowerCase()) ||
            String(all_abstracts[i][7]).toLowerCase().match(search_text.toLowerCase()) ||
            String(all_abstracts[i][12]).toLowerCase().match(search_text.toLowerCase()))
            {
    
                abstract_category_char = all_abstracts[i][17][0].toUpperCase();
                if(all_abstracts[i][12].search("-") != -1)
                {
                    abstract_type_char = all_abstracts[i][12][all_abstracts[i][12].search("-")+1].toUpperCase();
                }
                else
                {
                    abstract_type_char = all_abstracts[i][12][0].toUpperCase();
                }
                last_abstract_no = all_abstracts[i][13];

                all_searched_abstracts += '<tr>';
                all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; "> '+abstract_index+' </td>';
                all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; "> '+abstract_category_char+abstract_type_char+last_abstract_no+' </td>';
                all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; ">'+all_abstracts[i][4]+'</td>';
                all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; " title="'+all_abstracts[i][6]+'">';
                if(all_abstracts[i][6].length > 35)
                {
                    all_searched_abstracts += all_abstracts[i][6].substring(0,35)+'...';
                }
                else
                {
                    all_searched_abstracts += all_abstracts[i][6];
                }
                all_searched_abstracts += '</td>';

                all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; " title="'+all_abstracts[i][7]+'">';
                if(all_abstracts[i][7].length > 10)
                {
                    all_searched_abstracts += all_abstracts[i][7].substring(0,10)+'...';
                }
                else
                {
                    all_searched_abstracts += all_abstracts[i][7];
                }
                all_searched_abstracts += '</td>';
                
                all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; ">'+all_abstracts[i][12]+'</td>';
                if(Array.isArray(JSON.parse(all_abstracts[i][10])))
                {
                    
                    all_searched_abstracts += '<td style="font-size:20px; text-align:center;color:green;"><i style="width:40px;" class="fas fa-check-square"></i></td>';
                }
                else
                {
                    all_searched_abstracts += '<td style="font-size:20px; text-align:center;color:red;"><i  class="fas fa-times-circle"></i></td>';
                }

                if((all_abstracts[i][0] == "null" && all_abstracts[i][1] == "null") || (all_abstracts[i][0] == null && all_abstracts[i][1] == null))
                {
                    all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; " ></td>';
                    all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; " ></td>';
               
                }
                else
                {
                    all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; " >'+all_abstracts[i][0]+'</td>';
                    all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; " >'+all_abstracts[i][1]+'</td>';
               
                }

                all_searched_abstracts += '<td>'+all_abstracts[i][all_abstracts[i].length-1]+'</td>';

                all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px;">';

                if(all_abstracts[i][5] == 4)
                {
                    all_searched_abstracts += '<i style="background-color:yellow" class="warning fas fa-exclamation-triangle"></i>';
                }
                all_searched_abstracts += '<select id="acception_state_'+i+'" name="acception_state_'+i+'" onChange="admin_abstract_accept(\'acception_state_'+i+'\')">';

                     
                all_searched_abstracts += '<option value="abstract_id='+all_abstracts[i][4]+'&acception=0"';if(parseInt(all_abstracts[i][5]) == 0){all_searched_abstracts += "selected";} all_searched_abstracts +='>Değerlendirilmemiş</option>';
                all_searched_abstracts += '<option value="abstract_id='+all_abstracts[i][4]+'&acception=1"';if(parseInt(all_abstracts[i][5]) == 1){all_searched_abstracts += "selected";} all_searched_abstracts +='>Onayla</option>'; 
                all_searched_abstracts += '<option value="abstract_id='+all_abstracts[i][4]+'&acception=2"';if(parseInt(all_abstracts[i][5]) == 2){all_searched_abstracts += "selected";} all_searched_abstracts +='>Reddet</option>'; 
                all_searched_abstracts += '<option value="abstract_id='+all_abstracts[i][4]+'&acception=3"';if(parseInt(all_abstracts[i][5]) == 3){all_searched_abstracts += "selected";} all_searched_abstracts +='>Düzenleme İste</option>'; 


                all_searched_abstracts += '</select></td>';

                all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px;" >';
                all_searched_abstracts += '<a target="_blank" href="/admin_index?sayfa=abstract_authorization&abstract_id='+all_abstracts[i][4]+'"><i class="fas fa-user-plus" title="Bilim Kurulu Üyesi Ata"></i><a>&nbsp;&nbsp';
                all_searched_abstracts += '<button class="btn" onclick="admin_abstract_delete(\''+all_abstracts[i][4]+'\')"><i class="fas fa-trash-alt" title="Bildiri Sil"></i></button>&nbsp';
                all_searched_abstracts += '<a target="_blank" href="/abstract_viewer?abstract_id='+all_abstracts[i][4]+'"><i class="fas fa-file-alt" title="Görüntüle"></i></a> &nbsp';
                all_searched_abstracts += '<a target="_blank" href="/admin_index?sayfa=abstract_update&abstract_id='+all_abstracts[i][4]+'"><i class="fas fa-pencil-ruler" title="Bildiriyi Düzenle"></i></a> &nbsp';
                all_searched_abstracts += '<a target="_blank" href="/admin_index?sayfa=abstract_category_update&abstract_id='+all_abstracts[i][4]+'"><i class="fas fa-list" title="Bildiri Kategorisini Düzenle"></i></a> </td>';
                all_searched_abstracts += '<td><input type="number" data-id="'+all_abstracts[i][4]+'" class="abstract_main_author_id" value="'+all_abstracts[i][16]+'"></td>';
                all_searched_abstracts += '<td>';
                if(admin_all_abstracts[i][18].length > 0)
                {
                    all_searched_abstracts += '<a target="_blank" href="/view/abstracts/presentations/Bitki Koruma Kongresi/'+abstract_category_char+abstract_type_char+last_abstract_no+'/'+admin_all_abstracts[i][18]+'">Sunum</a></td>';
                }
                all_searched_abstracts += '</td>';

                all_searched_abstracts += '</tr>';
                abstract_index += 1;
            }
        }
        $(".all_abstracts").html(all_searched_abstracts);
        

    });

});


$(document).ready(function(){

    $(".warning").click(function(){

        alert('Yazar bildiri düzenlemesini gerçekleştirmiştir.');

    });

});


myFunction = function(x) {
    var y ;
     if (confirm("Bildirinizi silmek istediğinizden emin misiniz ?") == true) {
        setTimeout(function(){window.location.href='abstract_delete?id='+x;},10);
     } else {
         y = "Bildiri silme işleminiz iptal edildi!";
         alert(y); 
     }
    
}


function all_presentations()
{
    window.location.href= "/admin_presentation_archiver?get_presentations=all_presentations";
}

function admin_abstract_main_author_mail_compare()
{
    window.location.href= "/admin_abstract_main_author_mail_compare";
}



$(document).ready(function(){
    $(".presentations_by_session").change(function(){
        window.location.href= "/admin_presentation_archiver?get_presentations="+this.value;
    });
});





value=0;

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



$( "select[name=search]" )
  .change(function () {

    if(value<=2){

        value+=1;

    }

    if(value>1){

    let str ="";
        $( "select[name=search] option:selected" ).each(function() {
        str += $( this ).val();
        });
        
        postForm('/admin_search?sayfa=all_abstracts', {value:str,abstract:1});


    }
    
    
  })
  .change();

</script>

<?php

$user_that_mail = [];

for($i=0;$i<count($admin_all_abstracts);$i++)
{

    array_push($user_that_mail,$admin_all_abstracts[$i][2]);
    array_push($user_that_mail,$admin_all_abstracts[$i][3]);


}

?>

<script>


function admin_list_member_mailer()
  {
    var all_users = JSON.stringify(<?php echo json_encode($user_that_mail,JSON_UNESCAPED_UNICODE); ?>);
    var summernote = $("#summernote").val();
    var y ;
     if (confirm("Mail gönderme işlemini onaylıyor musunuz?") == true) 
     {
        postForm('/admin_auto_mailer?mail_type=list_members', {users:all_users,contant:summernote});
     } 
     else 
     {
         y = "Mail gönderme işlemi sonlandırıldı!";
         alert(y); 
     }
    
  }


  function admin_manuel_price_mailer(user_mail)
  {

    var y ;
     if (confirm("Mail gönderme işlemini onaylıyor musunuz?") == true) 
     {
        postForm('/admin_manuel_mailer?mail_type=price', {user_mail:user_mail});
     } 
     else 
     {
         y = "Mail gönderme işlemi sonlandırıldı!";
         alert(y); 
     }

  }

  function admin_abstract_accept(id) {

  

    let str ="";
        $( "select[name="+id+"] option:selected" ).each(function() {
        str += $( this ).val();
        });
        
        var y ;
        if (confirm("Bildiri onay durumu değiştirilsin mi?") == true) 
        {
            postForm('/admin_abstract_accept?'+str, {value:str});
        }
        else 
        {
            y = "Bildiri onay durum değişikliği işlemi sonlandırıldı!";
            alert(y); 
        }
    }

     function admin_abstract_delete(id) {

            var y ;
        if (confirm("Bildiriyi silmek istediğinizden emin misiniz ?") == true) {
            setTimeout(function(){window.location.href='admin_abstract_delete?abstract_id='+id;},10);
        } else {
            y = "Bildiri silme işleminiz iptal edildi!";
            alert(y); 
        }
    }

    $(".abstract_main_author_id").change(function(){
        var main_author_id = $(this).val();
        var abstract_id = $(this).data("id");
        $.post("/abstract_main_author_id_save",{main_author_id:main_author_id,abstract_id:abstract_id},function(sucess){
            if(sucess == 1)
            {
                alert("Kayıt başarıyla gerçekleştirilmiştir.");
            }
            else if(sucess == 0)
            {
                alert("Kayıt sırasında bir hata oluşmuştur.");
            }
        });

    });

 
</script>

</body>
</html>
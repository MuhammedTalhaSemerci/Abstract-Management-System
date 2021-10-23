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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/a9da6c256f.js" crossorigin="anonymous"></script>
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

  <!-- <h4 style="margin-left:20px;">Listedeki kullanıcılar için toplu mail hatırlatması yap.</h4>

    <button style="margin-left:20px;" class="form-control col-md-3 col-lg-3" onclick="editor_list_member_mailer()" >Ödeme maili gönder.</button><br>
-->
</div>
    <br>
    <br>

<?php



echo '<div><table class="all_abstracts"  style="margin-left:20px;">
        <tr>
            <td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Sıra </b></font></td>
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
        </tr>
        ';

for($i=0;$i<count($editor_all_abstracts);$i++){


    
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
                if($congress_categories->{"tr"}[$a][$b] == $editor_all_abstracts[$i][7])
                {
                    $editor_all_abstracts[$i][7] = $congress_categories->{$uye_dil}[$a][$b];
                }
        }
    }


    $referee_ids = [];
    $referee_ids1 = [];
    $referee_ids_last=[];
    $referee_ids_href = "";

    $edit_requests = json_decode($editor_all_abstracts[$i][8]);
    $referee_comments = json_decode($editor_all_abstracts[$i][9]);

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
            $referee_ids_href .= '<a  target="_blank" style="text-decoration:none; " href="/abstract_edit_request_viewer?abstract_id='.$editor_all_abstracts[$i][4].'&referee_id='.$referee_ids_last[$a].'" title="'.($a+1).'. Bilim Kurulu Üye Değerlendirmesi"><i class="far fa-edit"></i>&nbsp;&nbsp;</a>';
        }
        
    }
    else
    {
        $referee_ids_href .= "";
    }

    
    array_push($editor_all_abstracts[$i],$referee_ids_href);


echo '

<tr >
    <td style="padding-left:7px; padding-right:7px; "> '.($i+1).' </td>      
    <td style="padding-left:7px; padding-right:7px; ">'.$editor_all_abstracts[$i][4].'</td>
        <td style="padding-left:7px; padding-right:7px; " title="'.$editor_all_abstracts[$i][6].'">'; 
    
    if(strlen($editor_all_abstracts[$i][6])>35)
    {
        echo mb_substr($editor_all_abstracts[$i][6],0,35)."...";
    }
    else
    {
       echo $editor_all_abstracts[$i][6];
    }
    echo '</td>

    <td style="padding-left:7px; padding-right:7px; " title="'.$editor_all_abstracts[$i][7].'">'; 
    
    if(strlen($editor_all_abstracts[$i][7])>10)
    {
        echo mb_substr($editor_all_abstracts[$i][7],0,10)."...";
    }
    else
    {
       echo $editor_all_abstracts[$i][7];
    }
    echo '</td>';

    echo '<td style="padding-left:7px; padding-right:7px; ">'.$editor_all_abstracts[$i][12].'</td>';
    if(count(json_decode($editor_all_abstracts[$i][10]))>0 && is_array(json_decode($editor_all_abstracts[$i][10])))
    {
        echo '<td style="font-size:20px; text-align:center;color:green;"><i style="width:40px;" class="fas fa-check-square"></i></td>';
    }
    else
    {
        echo '<td style="font-size:20px; text-align:center;color:red;"><i  class="fas fa-times-circle"></i></td>';
    }
    echo'
        <td style="padding-left:7px; padding-right:7px; " >'.$editor_all_abstracts[$i][0].'</td>
        <td style="padding-left:7px; padding-right:7px; " >'.$editor_all_abstracts[$i][1].'</td>
    ';


    echo '<td>'.$referee_ids_href.'</td>';

    echo '<td style="padding-left:7px; padding-right:7px;">';
    if(intval($editor_all_abstracts[$i][5]) == 4)
    {
        echo '<i style="background-color:yellow" class="warning fas fa-exclamation-triangle"></i>';
    }

    echo '<select id="acception_state_'.$i.'" name="acception_state_'.$i.'" onChange="editor_abstract_accept(\'acception_state_'.$i.'\')">';
 
    echo '<option value="abstract_id='.$editor_all_abstracts[$i][4].'&acception=0"';if(intval($editor_all_abstracts[$i][5]) == 0){echo "selected";} echo'>Değerlendirilmemiş</option>';
    echo '<option value="abstract_id='.$editor_all_abstracts[$i][4].'&acception=1"';if(intval($editor_all_abstracts[$i][5]) == 1){echo "selected";} echo'>Onayla</option>'; 
    echo '<option value="abstract_id='.$editor_all_abstracts[$i][4].'&acception=2"';if(intval($editor_all_abstracts[$i][5]) == 2){echo "selected";} echo'>Reddet</option>'; 
    echo '<option value="abstract_id='.$editor_all_abstracts[$i][4].'&acception=3"';if(intval($editor_all_abstracts[$i][5]) == 3){echo "selected";} echo'>Düzenleme İste</option>'; 

    
    echo '</select></td>';

    echo '<td style="padding-left:7px; padding-right:7px;" > 
    <a target="_blank" href="/editor_index?sayfa=abstract_authorization&abstract_id='.$editor_all_abstracts[$i][4].'"><i class="fas fa-user-plus" title="Bilim Kurulu Üyesi Ata"></i><a>&nbsp;
    <button class="btn" onclick="editor_abstract_delete(\''.$editor_all_abstracts[$i][4].'\')"><i class="fas fa-trash-alt" title="Bildiri Sil"></i></button>&nbsp;
    <a target="_blank" href="/abstract_viewer?abstract_id='.$editor_all_abstracts[$i][4].'"><i class="fas fa-file-alt" title="Görüntüle"></i></a>&nbsp;&nbsp;
    <a target="_blank" href="/editor_index?sayfa=abstract_update&abstract_id='.$editor_all_abstracts[$i][4].'"><i class="fas fa-pencil-ruler" title="Bildiriyi Düzenle"></i></a> &nbsp;
    <a target="_blank" href="/editor_index?sayfa=abstract_category_update&abstract_id='.$editor_all_abstracts[$i][4].'"><i class="fas fa-list" title="Bildiri Kategorisini Düzenle"></i></a>
    </td>
</tr>

 ';

}

echo '
</table></div>';

?>

<script >


var all_abstracts = JSON.parse(JSON.stringify(<?php echo json_encode($editor_all_abstracts,JSON_UNESCAPED_UNICODE)?>));



$(document).ready(function(){

    $(".abstract_search").change(function(){

        var search_text = $(".abstract_search").val();
        var abstract_index =1;
        var all_searched_abstracts ='<tr>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Sıra </b></font></td>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Bildiri <br>No </b></font></td>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Bildiri <br> Başlık: </b></font></td>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Bildiri <br> Kategori: </b></font></td>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Bildiri <br> Türü: </b></font></td>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Atama Durum: </b></font></td>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Sorumlu <br> Yazar Adı </b></font></td>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Soyadı </b></font></td>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;"><font color="red"><b>B. K. Üye Değ. </b></font></td>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>Onayla </b></font></td>';
            all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; text-align:center;" ><font color="red"><b>İşlemler</b></font></td>';
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
    
                all_searched_abstracts += '<tr>';
                all_searched_abstracts += '<td style="padding-left:7px; padding-right:7px; "> '+abstract_index+' </td>';
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

                abstract_index += 1;
            }
        }
        $(".all_abstracts").html(all_searched_abstracts);
        

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
    window.location.href= "/editor_presentation_archiver?get_presentations=all_presentations";
}


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
        
        postForm('/editor_search?sayfa=all_abstracts', {value:str,abstract:1});


    }
    
    
  })
  .change();

</script>

<?php

$user_that_mail = [];

for($i=0;$i<count($all_users);$i++)
{

    array_push($user_that_mail,$all_users[$i]["uye_mail"]);

}

?>

<script>


$(document).ready(function(){

$(".warning").click(function(){

    alert('Yazar bildiri düzenlemesini gerçekleştirmiştir.');

});

});

  function editor_list_member_mailer()
  {
    var all_users = '<?php echo json_encode($user_that_mail,JSON_UNESCAPED_UNICODE); ?>';

    var y ;
     if (confirm("Mail gönderme işlemini onaylıyor musunuz?") == true) 
     {
        postForm('/editor_auto_mailer?mail_type=list_members', {users:all_users});
     } 
     else 
     {
         y = "Mail gönderme işlemi sonlandırıldı!";
         alert(y); 
     }
    
  }


  function editor_manuel_price_mailer(user_mail)
  {

    var y ;
     if (confirm("Mail gönderme işlemini onaylıyor musunuz?") == true) 
     {
        postForm('/editor_manuel_mailer?mail_type=price', {user_mail:user_mail});
     } 
     else 
     {
         y = "Mail gönderme işlemi sonlandırıldı!";
         alert(y); 
     }

  }

  function editor_abstract_accept(id) {

  

    let str ="";
        $( "select[name="+id+"] option:selected" ).each(function() {
        str += $( this ).val();
        });
        
        var y ;
        if (confirm("Bildiri onay durumu değiştirilsin mi?") == true) 
        {
            postForm('/editor_abstract_accept?'+str, {value:str});
        }
        else 
        {
            y = "Bildiri onay durum değişikliği işlemi sonlandırıldı!";
            alert(y); 
        }
    }

     function editor_abstract_delete(id) {

            var y ;
        if (confirm("Bildiriyi silmek istediğinizden emin misiniz ?") == true) {
            setTimeout(function(){window.location.href='editor_abstract_delete?abstract_id='+id;},10);
        } else {
            y = "Bildiri silme işleminiz iptal edildi!";
            alert(y); 
        }
    }

 
</script>

</body>
</html>
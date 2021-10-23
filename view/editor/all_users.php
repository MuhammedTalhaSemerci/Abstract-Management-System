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
        font-size:15px;
    }
    button
    {
        font-size:5px;
    }
    </style>

    <!--
        katılımcı:0
        editör:1
        hakem:2
        admin:3
    -->

    <?php

$user_that_mail = [];

for($i=0;$i<count($all_users);$i++)
{

    array_push($user_that_mail,$all_users[$i]["uye_mail"]);

}

?>

    <label style="margin-left:20px;" for="search">Arama:</label>
    <select name="search" id="" style="width:200px;margin-left:20px;margin-top:20px;" class="form-control">
        <option value="getall"selected>Arama filtresini Seçin</option>
        <option value="getall" >Tüm Üyeler</option>
        <option value="1@uye_yetki@0">Sadece katılımcılar</option>
        <option value="1@uye_yetki@1">Sadece Editörler</option>
        <option value="1@uye_yetki@2">Sadece Bilim Kurulu Üyeleri</option>
        <option value="1@uye_yetki@3">Sadece Adminler</option>
    </select>
    <br><hr>
   <!-- <label style="margin-left:20px;">Listedeki kullanıcılar için toplu mail hatırlatması yap.</label>
    <textarea style = "margin-left:20px;" id="summernote" name="contant"></textarea>
    <br>
    <button style="margin-left:20px;" class="form-control col-md-3 col-lg-3" onclick="editor_list_member_mailer()" >Toplu mail gönder.</button><br>
    <hr>-->
    <label style="margin-left:20px;">Kullanıcılar:</label>


    <br>
<?php



echo '<div><table style="margin-left:20px;">
        <tr>
            <td ><font color="red"><b>Sıra: </b></font></td>
            <td ><font color="red"><b>Üye Düzenle: </b></font></td>
            <td ><font color="red"><b>Adı: </b></font></td>
            <td ><font color="red"><b>Soyadı: </b></font></td>
            <td ><font color="red"><b>Ünvan: </b></font></td>
            <td ><font color="red"><b>Üyelik Türü: </b></font></td>
            <td><font color="red"><b>Belgeler: </b></font> </td>
        </tr>
        ';

for($i=0;$i<count($all_users);$i++){


$user_withdrawal = json_decode($all_users[$i]["withdrawals"]);


echo '

<tr>
    <td style="padding:4px;">'.($i+1).'</td>
    <td> <a href="/editor_index?sayfa=profile_change&editor_user_id='.$all_users[$i]["id"].'">Düzenle</a> </td>
    <td >'.$all_users[$i]["uye_adi"].'</td>
    <td >'.$all_users[$i]["uye_soyadi"].'</td>
    <td >'.$all_users[$i]["uye_unvan"].'</td>
    ';

    if($all_users[$i]["uye_yetki"] == 0 && isset($user_withdrawal))
    {
        if($all_users[$i]["uye_yetki"] == 0 && intval($user_withdrawal[0][3]) == 2)
        {
            echo '<td>üye</td>';
        }

        else if($all_users[$i]["uye_yetki"] == 0 && intval($user_withdrawal[0][3]) == 1)
        {
            echo '<td>Kongre Katılımcısı</td>';
        }
        else if($all_users[$i]["uye_yetki"] == 0 && intval($user_withdrawal[0][3]) == 0)
        {
            echo '<td>Üye</td>';
        }
    }
    else if($all_users[$i]["uye_yetki"] == 0 && empty($user_withdrawal))
    {
        echo '<td>Üye</td>';
    }   
    else if($all_users[$i]["uye_yetki"] == 1)
    {
        echo '<td>Editör</td>';
    }
    else if($all_users[$i]["uye_yetki"] == 2)
    {
        echo '<td><b>Bilim kurulu üyesi</b></td>';
    }
    else if($all_users[$i]["uye_yetki"] == 3)
    {
        echo '<td>Admin</td>';
    }
    else
    {
    }

    if(isset($all_users[$i]["withdrawals"]))
    {
        $user_withdrawal = json_decode($all_users[$i]["withdrawals"]);
        //withdrawal işlemi ###################################################
        if( count($user_withdrawal[0][2])>0)
        {
            echo '<td>';

            for($a=0;$a<count($user_withdrawal[0][2]);$a++)
            {
                echo '<a href="/view/abstracts/down_files/'.$all_users[$i]["uye_mail"]."/".strval($user_withdrawal[0][2][$a][1]).'" target="_blank"> '.strval($user_withdrawal[0][2][$a][0]).'</a><br>';
            }
            echo '</td>';

        }
        else
        {
            echo '<td></td>';
        }
    }
    else
    {
        echo '<td></td>';
    }
    echo '
    
</tr>

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

myFunction = function(x) {
    var y ;
     if (confirm("Bildirinizi silmek istediğinizden emin misiniz ?") == true) {
        setTimeout(function(){window.location.href='abstract_delete?id='+x;},10);
     } else {
         y = "Bildiri silme işleminiz iptal edildi!";
         alert(y); 
     }
    
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
        
        postForm('/editor_search?sayfa=all_users', {value:str,users:1});


    }
    
    
  })
  .change();



  function editor_list_member_mailer()
  {
    var all_users = '<?php echo json_encode($user_that_mail,JSON_UNESCAPED_UNICODE); ?>';
    var summernote = $("#summernote").val();
    var y ;
     if (confirm("Mail gönderme işlemini onaylıyor musunuz?") == true) 
     {
        postForm('/editor_auto_mailer?mail_type=list_members', {users:all_users,contant:summernote});
     } 
     else 
     {
         y = "Mail gönderme işlemi sonlandırıldı!";
         alert(y); 
     }
    
  }


  function editor_manuel_price_mailer(user_mail)
  {
    var summernote = $("#summernote").val();
    var y ;
     if (confirm("Mail gönderme işlemini onaylıyor musunuz?") == true) 
     {
        postForm('/editor_manuel_mailer?mail_type=price', {user_mail:user_mail,contant:summernote});
     } 
     else 
     {
         y = "Mail gönderme işlemi sonlandırıldı!";
         alert(y); 
     }

  }



  value1=0;

function editor_withdrawal_update(id) {

  

  let str ="";
      $( "select[name="+id+"] option:selected" ).each(function() {
      str += $( this ).val();
      });
      
      postForm('/editor_withdrawal_update?'+str, {value:str});


}

</script>

</body>
</html>
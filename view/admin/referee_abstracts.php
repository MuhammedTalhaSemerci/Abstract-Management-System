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
        font-size:15px;
    }
    button
    {
        font-size:15px;
    }

    .td-margin
    {
        margin-left:7px;
        margin-right:7px;
        text-decoration:none;
    }

    </style>

    <!--
        katılımcı:0
        editör:1
        hakem:2
        admin:3
    -->




    <br>
<?php
if($referee_all_abstracts)
{
    echo '<div><table style="margin-left:20px;margin-bottom:20px;">
            <tr>
                <td ><font color="red"><b class="td-margin">Bildiri Başlık </b></font></td>
                <td><font color="red"><b class="td-margin">Bildiri Kategori </b></font></td>
                <td ><font color="red"><b class="td-margin">Bildiri Türü </b></font></td>
                <td ><font color="red"><b class="td-margin">İşlemler </b></font></td>

            </tr>
            ';

          

    for($i=0;$i<count($referee_all_abstracts);$i++){

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
                    if($congress_categories->{"tr"}[$a][$b] == $referee_all_abstracts[$i][2])
                    {
                        $referee_all_abstracts[$i][2] = $congress_categories->{$uye_dil}[$a][$b];
                    }
            }
        }


    echo '

    <tr>
        <td > <ah class="td-margin" >';
        if(strlen($referee_all_abstracts[$i][1])>10)
        {
            echo substr($referee_all_abstracts[$i][1],0,10)."...";
        }
        else
        {
           echo $referee_all_abstracts[$i][1];
        }
        echo '</ah ></td>
        <td > <ah class="td-margin" >'.$referee_all_abstracts[$i][2].'</ah ></td>
        <td > <ah class="td-margin" >'.$referee_all_abstracts[$i][3].'</ah ></td>
        <td > <a class="td-margin"  target="_blank" href="/abstract_viewer?abstract_id='.$referee_all_abstracts[$i][0].'" title="Görüntüle"><i class="fas fa-eye"></i>&nbsp;</a>
        <a class="td-margin" target="_blank" href="/abstract_edit_requester?abstract_id='.$referee_all_abstracts[$i][0].'" title="Değerlendir"><i class="far fa-edit"></i>&nbsp;</a>
        <a class="td-margin" target="_blank" href="/abstract_edit_request_viewer?abstract_id='.$referee_all_abstracts[$i][0].'" title="Değerlendirmeyi Ön izle"> <i class="fas fa-search"></i></a></td>
        
    </tr>

    ';

    }

    echo '
    </table></div>';
}
else
{
    echo '<h4 style="margin-left:20px;">Ataması yapılmış herhangi bir bildiri özeti bulunamadı.</h4>';
}
?>

<script>

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
        
        postForm('/referee_search?sayfa=all_abstracts', {value:str,abstract:1});


    }
    
    
  })
  .change();


  function referee_abstract_accept(id) {

  

    let str ="";
        $( "select[name="+id+"] option:selected" ).each(function() {
        str += $( this ).val();
        });
        
        var y ;
        if (confirm("Bildiri onay durumunu değiştirilsin mi?") == true) 
        {
            postForm('/referee_abstract_accept?'+str, {value:str});
        }
        else 
        {
            y = "Bildiri onay durum değişikliği işlemi sonlandırıldı!";
            alert(y); 
        }
    }

 
</script>

</body>
</html>
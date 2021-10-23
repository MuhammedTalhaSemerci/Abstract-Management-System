<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a9da6c256f.js" crossorigin="anonymous"></script>
    <style>
 
   
     td {
    word-wrap: break-word;
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
</head>
<body>
    
    <a href="/editor_index?sayfa=all_abstracts">Geri Dön</a>
    <form action="/editor_abstract_authorization?abstract_id=<?php echo $update_abstract["abstract_no"];?>" method="post"> 

    
<?php



echo '
<div class="row">
    <div class="col-md-6 col-lg-6">
    <div class="col-md-11 col-lg-11">
        <table class="table" style="margin-left:20px; margin-right:20px;">
            <tr>
                <td ><font color="red"><b>Hakem Atama: </b></font></td>
                <td ><font color="red"><b>Adı: </b></font></td>
                <td ><font color="red"><b>Soyadı: </b></font></td>
            </tr>
    ';
    $abstract_referee_ids = json_decode($update_abstract["referee_ids"]);
    $abstract_author_infos ="";
    for($i=0;$i<count($editor_all_abstracts);$i++)
    {
        if($update_abstract["abstract_no"] == $editor_all_abstracts[$i][4])
        {
            $abstract_author_infos .= $editor_all_abstracts[$i][11];
        }
    }


    for($i=0;$i<count($referee_users);$i++){
        $cakisma = 0;
        if($abstract_referee_ids)
        {
            
            for($a=0;$a<count($abstract_referee_ids);$a++)
            {
                if($abstract_referee_ids[$a] == $referee_users[$i]["id"])
                {
                    $cakisma = 1;
                    break;
                }
                else
                {
                    continue;
                }
            }
        }



        $permited_abstracts=0;

        for($a=0;$a<count($editor_all_abstracts);$a++)
        {
            if($editor_all_abstracts[$a][10] != null)
            {
                $referee_ids = json_decode($editor_all_abstracts[$a][10]);
                for($b=0;$b<count($referee_ids);$b++)
                {
                    if($referee_ids[$b] == $referee_users[$i]["id"])
                    {
                        $permited_abstracts+=1;
                        break;
                    }
                }
            }

        }

            
        $judged_abstracts=0;

        for($z=0;$z<count($editor_all_abstracts);$z++)
        {
            
            $referee_ids = 0;
            $referee_ids1 = 0;
        
            if($editor_all_abstracts[$z][8] !=null && $editor_all_abstracts[$z][9] != null)
            {
                $edit_requests = json_decode($editor_all_abstracts[$z][8]);
                $referee_comments = json_decode($editor_all_abstracts[$z][9]);

                if(is_array($edit_requests))
                {
                    for($a=0;$a<count($edit_requests);$a++)
                    {
                        if($edit_requests[$a][0] == $referee_users[$i]["id"])
                        {
                            $referee_ids = 1;
                            break;
                        }
                    }
                }

                if(is_array($referee_comments))
                {
                    for($b=0;$b<count($referee_comments);$b++)
                    {    
                        if($referee_comments[$b][0] == $referee_users[$i]["id"])
                        {
                            $referee_ids1 = 1;
                            break;
                        }
                        
                    }
                }

                if($referee_ids == 1 && $referee_ids1 ==1)
                {
                    $judged_abstracts += 1;
                    
                }
    
            }
    

        }

    
    echo '
    <tr>
        <td><input type="checkbox" name="referee_ids[]" value="'.$referee_users[$i]["id"].'" ';if($cakisma == 1){echo "checked";}else{} echo'> <font color="red">('.$permited_abstracts.'/'.$judged_abstracts.')</font></td>
        <td >'.$referee_users[$i]["uye_adi"].'</td>
        <td >'.$referee_users[$i]["uye_soyadi"].'</td>
    </tr>';


}

echo '
        </table>
    </div>
    </div>
    <div class="col-md-6 col-lg-6">
    <div class="col-md-11 col-lg-11 ">
        <label style="color:blue; margin-left:20px;" for="table">Hakem ataması yapılacak bildiri:</label>
        <table class="table" >
            <tr>
                <td ><font color="red"><b>Bildiri Başlık: </b></font></td>
                <td ><font color="red"><b>Yazar Bilgileri: </b></font></td>
            </tr>

            <tr>
                <td>'.strip_tags($update_abstract["title"]).'</td>
                <td>'.$abstract_author_infos.'</td>
            </tr>
        </table>
    </div>
    </div>
</div>
';

?>
<br>
<div class="row d-flex justify-content-center ">
<input class="form-control col-3"  type="submit" name="submit" value="Bilim Kurulu Üyesi Ata">
</div>    
</form>



</body>
</html>
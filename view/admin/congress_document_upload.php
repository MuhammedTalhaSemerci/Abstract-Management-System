<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/a9da6c256f.js" crossorigin="anonymous"></script>


<h4 style="margin-left:20px;"><?php echo $language[0];?></h4>

<form style="margin-left:20px;"  enctype="multipart/form-data" name='imageform' role="form" id="imageform" method="post" action="/congress_document_upload" >
    <select class="form-control col-md-3 col-lg-3" name="document_type">
        <option value="Öğrenci Belgesi"><?php echo $language[1];?></option>
        <option value="Dekont"><?php echo $language[2];?></option>
    </select>
    <br><br>
    <input class="form-control" class='file' type="file" class="form-control" name="down_files[]" id="down_files" placeholder="Lütfen dosya seçiniz" language="en" multiple >
    <br>
   
    <input class="form-control" type="submit" value="<?php echo $language[3];?>" name="image_upload" id="image_upload" />
</form>  
<br>
<hr>

<h5 style="margin-left:20px;"><?php echo $language[4];?>:</h5>


<?php
    $user_congress_register=json_decode($user_index["withdrawals"]);

    $data = $language[5] ;
    for($i=0; $i<count($user_congress_register);$i++)
    {

        for($a=(count($user_congress_register[$i][2])-1);$a>=0;$a--)
        {
            
            if($uye_dil == "tr")
            {
                
            }
            else
            {
                for($b=0;$b<count($data[0]);$b++)
                {
                   if(strval($user_congress_register[$i][2][$a][0]) == $data[0][$b])
                   {
                        $user_congress_register[$i][2][$a][0] = $data[1][$b];
                   } 
                }
            }

            echo ' <a style="margin-left:20px;" href="view/abstracts/down_files/'.$_SESSION["user"]["uye_mail"]."/".strval($user_congress_register[$i][2][$a][1]).'" download> '.strval($user_congress_register[$i][2][$a][0]).': '.strval($user_congress_register[$i][2][$a][1]).'</a> ';
       
            echo '  <form   style="margin-left:20px;" action="/congress_document_delete" method="POST">
            
                        <input class="form-control" type="hidden" name="document" value="'.strval($user_congress_register[$i][2][$a][1]).'"></input>
                        <input class="form-control col-md-3 col-lg-3" type="submit" name="document_delete" value="'.$language[6].'"/>
                    </form><br><hr>';
            
        }

    }

?>
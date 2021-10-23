<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/a9da6c256f.js" crossorigin="anonymous"></script>


<h4 style="margin-left:20px;"><?php echo $language[0];?></h4>

<form style="margin-left:20px;"  enctype="multipart/form-data" name='imageform' role="form" id="imageform" method="post" action="/presentation_upload" >
   
    <br>
    <input type="hidden" name="abstract_id" value="<?php echo strval($update_abstract["abstract_no"]);?>"></input>
    <input class="form-control" class='file' type="file" class="form-control" name="down_files[]" id="down_files" placeholder="Lütfen dosya seçiniz" language="en" multiple >
    <br>
   
    <input class="form-control" type="submit" value="<?php echo $language[1];?>" name="presentation_upload" id="presentation_upload" />
</form>  
<br>
<hr>

<h5 style="margin-left:20px;"><?php echo $language[2];?>:</h5>


<?php
    $presentation_files = json_decode($update_abstract["presentation_files"]);

    $abstract_category_char = mb_strtoupper($update_abstract["abstract_category"][0]);
    if(strpos($update_abstract["abstract_type"],"-"))
    {
        $abstract_type_char = mb_strtoupper($update_abstract["abstract_type"][strpos($update_abstract["abstract_type"],"-")+1]);
    }
    else
    {
        $abstract_type_char = mb_strtoupper($update_abstract["abstract_type"][0]);
    }
    $last_abstract_no = intval($update_abstract["last_abstract_no"]);


    for($i=0; $i<count($presentation_files);$i++)
    {

    

            echo ' <a style="margin-left:20px;" href="view/abstracts/presentations/Bitki Koruma Kongresi/'.$abstract_category_char.$abstract_type_char.$last_abstract_no."/".strval($presentation_files[$i]).'" download> '.strval($presentation_files[$i]).'</a> ';
       
            echo '  <form   style="margin-left:20px;" action="/presentation_delete" method="POST">
            
                        <input  type="hidden" name="abstract_id" value="'.strval($update_abstract["abstract_no"]).'"></input>
                        <input  type="hidden" name="document" value="'.strval($presentation_files[$i]).'"></input>
                        <input class="form-control col-md-3 col-lg-3" type="submit" name="document_delete" value="'.$language[3].'"/>
                    </form><br><hr>';
            
        

    }

?>
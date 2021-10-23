
<h4 style="margin-left:20px;"><?php echo $language[0];?></h4>
<br>

<h5 style="margin-left:20px;"><?php echo $language[1];?></h5>

<form style="margin-left:20px;"  enctype="multipart/form-data" name='imageform' role="form" id="imageform" method="post" action="/sponsor_document_upload" >
   
    <br>
    <input type="hidden" name="abstract_id" value="<?php echo strval($update_abstract["abstract_no"]);?>"></input>
    <input class="form-control" class='file' type="file" class="form-control" name="down_files[]" id="down_files" placeholder="Lütfen dosya seçiniz" language="en" multiple >
    <br>
   
    <input class="form-control" type="submit" value="<?php echo $language[2];?>" name="sponsor_document_upload" id="sponsor_document_upload" />
</form>  
<br>
<hr>

<h5 style="margin-left:20px;"><?php echo $language[3];?>:</h5>


<?php
    $button_infos = json_decode($abstract_websites[0]["sponsor_congress_logo_but_infos"])->{$primer_user["sponsor_company"]};

    if(isset($button_infos->{"documents"}))
    {
        for($i=0; $i<count($button_infos->{"documents"});$i++)
        {
    
        
    
                echo ' <a style="margin-left:20px;" href="view/abstracts/sponsor_documents/Bitki Koruma Kongresi/'.$primer_user["sponsor_company"]."/".strval($button_infos->{"documents"}[$i]).'" download> '.strval($button_infos->{"documents"}[$i]).'</a> ';
           
                echo '  <form   style="margin-left:20px;" action="/sponsor_document_delete" method="POST">
                
                            <input  type="hidden" name="document" value="'.strval($button_infos->{"documents"}[$i]).'"></input>
                            <input class="form-control col-md-3 col-lg-3" type="submit" name="document_delete" value="'.$language[4].'"/>
                        </form><br><hr>';
            
        }
    }
   

?>

<h4 style="margin-left:20px;"><?php echo $language[0];?></h4>
<br>

<h5 style="margin-left:20px;"><?php echo $language[1];?></h5>

<form style="margin-left:20px;"  enctype="multipart/form-data" name='imageform' role="form" id="imageform" method="post" action="/sponsor_video_upload" >
   
    <br>
    <input type="hidden" name="abstract_id" value="<?php echo strval($update_abstract["abstract_no"]);?>"></input>
    <input class="form-control" class='file' type="file" class="form-control" name="down_files[]" id="down_files" placeholder="Lütfen dosya seçiniz" language="en" multiple >
    <br>
   
    <input class="form-control video-upload" type="submit" value="<?php echo $language[2];?>" name="sponsor_video_upload" id="sponsor_video_upload" />
    <div id="wait-message-div"></div>
</form>  
<br>
<hr>

<h5 style="margin-left:20px;"><?php echo $language[3];?>:</h5>


<?php
    $button_infos = json_decode($abstract_websites[0]["sponsor_congress_logo_but_infos"])->{$primer_user["sponsor_company"]};

    if(isset($button_infos->{"videos"}))
    {
        for($i=0;$i<count($button_infos->{"videos"});$i++)
        {
    
        
    
                echo ' <a style="margin-left:20px;" href="view/abstracts/sponsor_videos/Bitki Koruma Kongresi/'.$primer_user["sponsor_company"]."/".strval($button_infos->{"videos"}[$i]).'" download> '.strval($button_infos->{"videos"}[$i]).'</a> ';
           
                echo '  <form   style="margin-left:20px;" action="/sponsor_video_delete" method="POST">
                
                            <input  type="hidden" name="video" value="'.strval($button_infos->{"videos"}[$i]).'"></input>
                            <input class="form-control col-md-3 col-lg-3" type="submit" name="video_delete" value="'.$language[4].'"/>
                        </form><br><hr>';
            
        }
    }
   

?>

<script>
    var save_but = document.getElementsByClassName("video-upload")[0];
    var wait_message_div = document.getElementById("wait-message-div");

    
    save_but.addEventListener("click",function(el){
        save_but.style.display = "none";
        wait_message_div.innerHTML = "<h4 style='text-align:center;'>Lütfen bekleyin.</h4>";
    },true);

</script>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $language[0];?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    
    <style>
    
    .baslik :is(h1, h2, h3, h4, h5, h6, p){

    font-size:25px;
    margin-top:5px;
    margin-bottom:5px;
    }

    .referee_update_warning
    {
        transition:2s;
        display:inline-block;
        position:absolute;
        text-decoration:none; 
        font-size:20px; 
        right:20px;
        width:50px;
        height:50px;
        background-color:yellow;
        opacity:.6;
        border:1px;
        border-radius:10px;
        text-align: center;
        z-index:10;
        animation: top_shake 4s infinite;
    }

    .referee_update_text
    {
        transition:2s;
        display:inline-block;
        text-decoration:none; 
        font-size:20px; 
        width:50px;
        height:50px;
        background-color:yellow;
        opacity:.6;
        border:1px;
        border-radius:10px;
        text-align: center;
        animation: top_shake 4s infinite;

    }

    @keyframes top_shake {
        0%{right:20px;}
        7% {right:60px;}
        14% {right:20px;}
        21% {right:60px;}
        28% {right:20px;}
        35% {right:60px;}
        42% {right:20px;}
        56% {right:60px;}
        70% {right:20px;}
        85% {right:60px;}
        100% {right:20px;}



    }

 
    </style>
<br>


<?php



for($i=0;$i<count($all_abstracts);$i++){

    //çoklu kongrelerde düzenlenecek
    

    $referee_ids = [];
    $referee_ids1 = [];
    $referee_ids_last=[];

    $referee_ids_str = "";
    $edit_requests = json_decode($all_abstracts[$i]["edit_requests"]);
    $referee_comments = json_decode($all_abstracts[$i]["referee_comments"]);
    $referee_ids_ref = json_decode($all_abstracts[$i]["referee_ids"]);
    $main_author = json_decode($all_abstracts[$i]["main_author"]);
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
            if($congress_categories->{"tr"}[$a][$b] == $all_abstracts[$i]["abstract_sub_category"])
            {
                $all_abstracts[$i]["abstract_sub_category"] = $congress_categories->{$uye_dil}[$a][$b];
            }
        }
    }
    



    for($a=0;$a<count($edit_requests);$a++)
    {
        array_push($referee_ids,strval($edit_requests[$a][0]));
    }

    for($b=0;$b<count($referee_comments);$b++)
    {
        array_push($referee_ids1,strval($referee_comments[$b][0]));
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


    for($a=0;$a<count($referee_ids_last);$a++)
    {
        $cakisma = 0;
        $index;
        for($b=0;$b<count($referee_ids_ref);$b++)
        {
            if($referee_ids_last[$a] == $referee_ids_ref[$b])
            {
                $cakisma = 1;
                break;
            }
        }

        if($cakisma == 1)
        {}
        else
        {
            unset($referee_ids_last[$a]);
            $referee_ids_last = array_values($referee_ids_last);
        }
    }

    for($a=0;$a<count($referee_ids_last);$a++)
    {
        if($a<count($referee_ids_last)-1)
        {
            $referee_ids_str .= $referee_ids_last[$a]."/";
        }
        else
        {
            $referee_ids_str .= $referee_ids_last[$a];
        }
    }



    
    $bildiri_durum ="";


    if($all_abstracts[$i]["accepted"] == 0 ){

        $bildiri_durum = $language[1];

    }

    else if($all_abstracts[$i]["accepted"] == 1 ){

        $bildiri_durum = $language[2];

    }

    else if($all_abstracts[$i]["accepted"] == 2 ){

        $bildiri_durum = $language[3];

    }
    else if($all_abstracts[$i]["accepted"] == 3 ){

        $bildiri_durum = $language[4];

    }
    else if($all_abstracts[$i]["accepted"] == 4 ){

    $bildiri_durum = $language[5];

    }
    else{}

    if( is_array($referee_ids_ref) && $all_abstracts[$i]["accepted"] == 0)
    {
     
        $bildiri_durum = $language[6];

    }

    echo '<div>';
    

    if( $referee_ids_last && $all_abstracts[$i]["accepted"] == 3 )
    {
        echo '
        
            <div class="referee_update_warning" onmouseenter="referee_edits_over(\''.$all_abstracts[$i]["abstract_no"].'\',\''.$referee_ids_str.'\',this)" onmouseleave="referee_edits_out(this)">
            <a href="#">!</a>
            </div>
        
        ';

    }
  

    echo '<table style = "margin-left:20px;">

    <tr ><td ><font color="red"><b>'.$language[7].':</b></font> '.$all_abstracts[$i]["abstract_no"].'</td></tr>
    <td ><font color="red"><b>'.$language[8].':</b></font> '.$main_author[0].' '.$main_author[1].'<br></td>

    <tr><td>
    <br>
    <div class="baslik"><font color="red">'.$language[9].':</font><p>'.strip_tags($all_abstracts[$i]["title"]).'</p></div>
    <br><font color="red">'.$language[10].': </font>'.$all_abstracts[$i]["abstract_sub_category"].'

    <h6><b><font color="0099FF"> '.$language[11].': </b></font>  '.$bildiri_durum.'</h6>

    </tr></td>';

    echo '<tr>
    
    <td style="">';
    
    if( $referee_ids_last && $all_abstracts[$i]["accepted"] == 3 )
    {
        echo 'Bilim Kurulu Üye Değerlendirmeleri:<br>';
        for($a=0;$a<count($referee_ids_last);$a++)
        {
            echo '<a  target="_blank" style="text-decoration:none;" href="/abstract_edit_request_viewer?abstract_id='.$all_abstracts[$i]["abstract_no"].'&referee_id='.$referee_ids[$a].'">'.($a+1).". ".$language[12].'</a><br>';
        }
       

    }
    else{}


    echo '</td>';
    
  

    echo '</tr>';

    echo '<tr><td ><br />';

    if(intval($all_abstracts[$i]["accepted"]) == 1)
    {
        echo '
        <a target="_blank" href="editor_index?abstract_presentation_id='.$all_abstracts[$i]["abstract_no"].'&sayfa=abstract_presentations"">'.$language[13].'</a> 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
        <a target="_blank" href="accepted_abstract_document?abstract_id='.$all_abstracts[$i]["abstract_no"].'">'.$language[14].'</a> 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp';
    }
    else{}

    if($all_abstracts[$i]["referee_ids"]!= null && is_array(json_decode($all_abstracts[$i]["referee_ids"])))
    {
     
        if (intval($all_abstracts[$i]["accepted"]) == 3)
        { 
            echo '
            
            <button  style="border:0px; border-radius:0px; background-color:white; color:red;" onclick="abstract_arrangement_save(\''.$all_abstracts[$i]["abstract_no"].'\')">'.$language[15].'</button> 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <a href="editor_index?abstract_id='.$all_abstracts[$i]["abstract_no"].'&sayfa=abstract_update">'.$language[16].'</a> 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
            <a href="editor_index?abstract_id='.$all_abstracts[$i]["abstract_no"].'&sayfa=abstract_category_update">'.$language[17].'</a> 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
            <a href="editor_index?abstract_id='.$all_abstracts[$i]["abstract_no"].'&sayfa=abstract_author_update">'.$language[18].'</a> 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
            <a target="_blank" href="abstract_viewer?abstract_id='.$all_abstracts[$i]["abstract_no"].'">'.$language[19].'</a> 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
          ';
        }
        else
        {
            echo '<a target="_blank" href="abstract_viewer?abstract_id='.$all_abstracts[$i]["abstract_no"].'">'.$language[20].'</a>';
        }
    }
    else
    {
        if (intval($all_abstracts[$i]["accepted"]) == 3 || intval($all_abstracts[$i]["accepted"]) == 0)
        {
            echo '
            <a href="editor_index?abstract_id='.$all_abstracts[$i]["abstract_no"].'&sayfa=abstract_update">'.$language[21].'</a> 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <a href="editor_index?abstract_id='.$all_abstracts[$i]["abstract_no"].'&sayfa=abstract_category_update">'.$language[22].'</a> 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <a href="editor_index?abstract_id='.$all_abstracts[$i]["abstract_no"].'&sayfa=abstract_author_update">'.$language[23].'</a> 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <a target="_blank" href="abstract_viewer?abstract_id='.$all_abstracts[$i]["abstract_no"].'">'.$language[24].'</a> 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <button style="border:0px; border-radius:0px; background-color:white; color:red;" onclick="myFunction('.$all_abstracts[$i]["abstract_no"].')">'.$language[25].'</button>';
        }
        else
        {
            echo '<a target="_blank" href="abstract_viewer?abstract_id='.$all_abstracts[$i]["abstract_no"].'">'.$language[26].'</a>';
        }
    }
    echo '</td>
    </tr>';

   

    echo '</table>
    </div> <hr />';

}


?>

<script>

myFunction = function(x) {
    var y ;
     if (confirm("<?php echo $language[27];?>") == true) {
        setTimeout(function(){window.location.href='abstract_delete?abstract_id='+x;},10);
     } else {
         y = "<?php echo $language[28];?>";
         alert(y); 
     }
    
}


abstract_arrangement_save = function(abstract_id)
{
    var y ;
     if (confirm("<?php echo $language[29];?>") == true) {
        setTimeout(function(){window.location.href='abstract_arrangement_save?abstract_id='+abstract_id;},10);
     } else {
         y = "<?php echo $language[30];?>";
         alert(y); 
     }
}




referee_edits_over = function(abstract_no,referee_ids,element) 
{
    referee_ids = referee_ids.split("/");
    var referee_ids_html = "";

        if(referee_ids.length > 0)
        {
            for(i=0;i<referee_ids.length;i++)
            {
                referee_ids_html +='<a  target="_blank" style="text-decoration:none;" href="/abstract_edit_request_viewer?abstract_id='+abstract_no+'&referee_id='+referee_ids[i]+'">'+(i+1)+'. <?php echo $language[31];?></a><br>';
            }

            element.style.transition = "1s";
            element.style.width = "400px";
            element.style.height = "200px";
            element.style.opacity = ".75";

            setTimeout(() => {
                if(parseInt(element.style.width) > 340)
                {
                    $(".referee_update_warning").html(referee_ids_html);
                    element.style.animation = "none";

                }
            },550 );
                
  
        }
}

referee_edits_out = function (element)
{
   
    element.style.transition = "1s";
    element.style.width = "50px";
    element.style.height = "50px";
    element.style.opacity = ".6";
    setTimeout(() => {
        if(parseInt(element.style.width)< 340)
        {
            $(".referee_update_warning").html('<a href="#">!</a>');
            element.style.animation = "top_shake 4s infinite";
            
        }
    },130 );
      
        

}

</script>



</body>
</html>
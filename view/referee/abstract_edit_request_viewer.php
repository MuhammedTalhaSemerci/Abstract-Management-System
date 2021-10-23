<?php
    include __DIR__."/simple_html_dom.php";

     function str_oto_edit($inputText) {
        $search  = array("'");
        $replace = array("\'");
        $outputText=str_replace($search, $replace, $inputText);
        return $outputText;
    }

    function strip_tags_content($text, $tags = '', $invert = FALSE) {

    preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
    $tags = array_unique($tags[1]);
    
    if(is_array($tags) AND count($tags) > 0) {
        if($invert == FALSE) {
        return preg_replace('@<(?!(?:'. implode('|', $tags) .')\b)(\w+)\b.*?>.*?</\1>@si', '', $text);
        }
        else {
        return preg_replace('@<('. implode('|', $tags) .')\b.*?>.*?</\1>@si', '', $text);
        }
    }
    elseif($invert == FALSE) {
        return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);
    }
    return $text;
    }


    function stripAttributes($html,$attribs) {
        
        $html = str_get_html($html);

        for($i=0;$i<count($attribs);$i++)
        {
            foreach($html->find($attribs[$i]) as $key => $p_tags) {
                $p_tags->removeAttribute("style");
                $p_tags->removeAttribute("id");
                $p_tags->removeAttribute("class");

            }
        }
        return $html;
    }

    $page="";

    if(isset($abstract_viewer) && is_array($abstract_viewer)){
    $page.='
    <html lang="en" >
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  
        </head>
    <body>
    
    <style>
    
    .contant{
        
        margin:auto;
        width:85%;
        height:auto;

        word-wrap: break-word;
        
        position:relative;
        
        
    }
    .contant_turkish
    {
        float:left;
    }
    .contant_english
    {
        float:left;
    }
    p
    {
        font-size:15px;
        margin-top:5px;
        margin-bottom:5px;
        text-align:justify;
    }
    
    .authors p
    {

        text-align:center;
    }

   
    .merkez p{
     
        text-align:center;
        font-size:20px;
        margin-top:5px;
        margin-bottom:5px;
    }

    .merkez h1{
     
        text-align:center;
        font-size:20px;
        margin-top:5px;
        margin-bottom:5px;
    }
    .merkez h2{
     
        text-align:center;
        font-size:20px;
        margin-top:5px;
        margin-bottom:5px;
    }
    .merkez h3{
     
        text-align:center;
        font-size:20px;
        margin-top:5px;
        margin-bottom:5px;
    }
    .merkez h4{
     
        text-align:center;
        font-size:20px;
        margin-top:5px;
        margin-bottom:5px;
    }
    .merkez h5{
     
        text-align:center;
        font-size:20px;
        margin-top:5px;
        margin-bottom:5px;
    }
    .merkez h6{
     
        text-align:center;
        font-size:20px;
        margin-top:5px;
        margin-bottom:5px;
    }

    .html_pdf_button
    {
        width:150px;
        height:50px;
        background-color:white;
        color:black;
        border-radius:5px;
        
    }

    
    .merkez1
    {
        margin: 0;
        position: absolute;
        display:inline-block;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }
    .italic
    {
        font-style:italic;
        word-wrap: break-word;
    }    
    .justify
    {
        text-align:justify;
        word-wrap: break-word;
    }

    .duzenleme_istek
    {
        background-color:yellow;
        border:1px;
        border-radius:2px;

    }

    .editable
    {
        background-color:yellow;
    }
    </style>';
   
    
    $page.= '

    <button class="html_pdf_button" onclick="html_pdf()" >Pdf indir</button>

    <div id="body">



<div></div>


<br><br>

<div class="contant"> 
    <div class="merkez justify"><h3>';  

    if($uye_yetki ==1 && $abstract_viewer["edit_request_type"] == $abstract_viewer["edit_request_type1"])
    {
        $page .= ' <div class="merkez1">';
        
        if($abstract_viewer["edit_request_type"] == 0)
        {
            $page .= '<h4 style="color:red;"> Bilim kurulu üyesi bu bildiriye düzenleme yapmamıştır.</h4>';
        }
        if($abstract_viewer["edit_request_type"] == 1)
        {
            $page .= '<h4 style="color:red;"> Bilim kurulu üyesi bu bildiriyi kabul etmiştir.</h4>';
        }
        if($abstract_viewer["edit_request_type"] == 2)
        {
            $page .= '<h4 style="color:red;"> Bilim kurulu üyesi bu bildiriyi reddetmiştir.</h4>';
        }

        if($abstract_viewer["edit_request_type"] == 3)
        {
            $page .= '<h4 style="color:red;"> Bilim kurulu üyesi bu bildiride düzenleme istemektedir.</h4>';
        }

        $page .= '</div><br>';
    }
  
    $atr = "b><i><sup><sub><strong><span><p><h1><h2><h3><h4><h5><h6><div>";
    $attribs = ["b","i","sup","sub","strong","span","p"];
        
        //turkish title

        $turkish_title = strip_tags($abstract_viewer["title"],$attribs);
        $turkish_title = stripAttributes($turkish_title,$attribs);
        if($turkish_title && $abstract_viewer["edit_requests"])
        {

            $key_edit_sentences = json_decode($abstract_viewer["edit_requests"]);
        
            $key_edit_index;
            $cakisma = 0;
            for($a=0;$a<count($key_edit_sentences);$a++)
            {
                if($key_edit_sentences[$a][0] == str_replace(["'",'"',"(",")","\n","\r"]," ",html_entity_decode(strip_tags($turkish_title))))
                {
                    $key_edit_index = $a;
                    $cakisma = 1;
                    break;
                }
                else
                {
                    continue;
                }
            }
            if($cakisma == 1)
            {
                $page .= '<sup><button class="duzenleme_istek" onclick="abstract_sentence_control(\''.str_replace(["'",'"',"(",")","\n","\r"],"--",html_entity_decode(strip_tags($key_edit_sentences[$key_edit_index][1]))).'\')">?</button></sup>'.$turkish_title;
            }
            else
            {
                $page .= $turkish_title;
            }
            

        }
        else if($turkish_title && !$abstract_viewer["edit_requests"])
        {
            $page .= $turkish_title;
        }

        $page .= '</h3></div>';
        /*
    $page.='<div class="authors"><p style="">';
    
        $abstract_location= [];
    
        $abstract_author_index=1;
        $abstract_main_author = json_decode($abstract_viewer["main_author"]);
    
        array_push($abstract_location,[$abstract_main_author[2],[$abstract_main_author]]);

        $abstract_other_author = json_decode($abstract_viewer["other_author"]);
        
        if(isset($abstract_other_author) && count($abstract_other_author) > 0 ){

            for($i=0;$i<count($abstract_other_author);$i++){
                
                $k=0;
            
        
                
                for($a=0;$a<count($abstract_location);$a++){
        
                
                            if($abstract_location[$a][0] ==$abstract_other_author[$i][2]){
                
                            $cakisma =1;
                            $k = $a;
                            break;
                            
                            
                    
                            }
                            else{
                                $cakisma =0;
                            
                            }
                
                        
            
        
                }
                if($cakisma == 1){
                    
                    array_push($abstract_location[$k][1],$abstract_other_author[$i]);
                
                }
                else{
        
                    array_push($abstract_location,[$abstract_other_author[$i][2],[$abstract_other_author[$i]]]);
        
                
                }
            
            }
        
        }

        for($i=0; $i<count($abstract_location);$i++){
    
            for($a=0;$a<count($abstract_location[$i][1]);$a++){
    
                $toplu_str="";
                $toplu_str1="";
                for($b=0; $b<2;$b++){
                    if($b == 1){
            
                        $toplu_str1 =  " ".mb_strtoupper(strval($abstract_location[$i][1][$a][1]));
                    }
                    else{
            
                        $abstract_main_author_arr = mb_str_split(strval($abstract_location[$i][1][$a][0]));
                        $bosluk=0;

                        for($c=0; $c<count($abstract_main_author_arr);$c++){
            
                            if($c > 0){
                                
                                if($abstract_main_author_arr[$c] == " " && $bosluk == 0){
                                    $toplu_str .=  $abstract_main_author_arr[$c];
                                    $bosluk=1;
                                }

                                else if($abstract_main_author_arr[$c] != " " && $bosluk == 0) {
                                    
                                    $toplu_str .=  mb_strtolower($abstract_main_author_arr[$c]);
                                }

                                else if($abstract_main_author_arr[$c] != " " && $bosluk == 1){
                                    $toplu_str .=  mb_strtoupper($abstract_main_author_arr[$c]);
                                    $bosluk = 0;
                                }
                            }
                            else{
                             $toplu_str .= mb_strtoupper($abstract_main_author_arr[$c]) ;
                            }
                            
                        }
                        
                    }
            
                }
    
    
                if($i == 0 && $a ==0){
    
                    $page.=  $toplu_str." ".$toplu_str1.'<sup>'.($i+1).'*</sup> ';
    
                }
               else{
    
                $page.= ", ".$toplu_str." ".$toplu_str1.'<sup>'.($i+1).'</sup> ';
    
               }
    
            }
    
        }
        $page .= "</p></div>";
    
        
    
        for($i=0; $i<count($abstract_location);$i++){
    
            
            $page .= ' <p class="italic"> <sup>'.($i+1).'</sup>'.$abstract_location[$i][0]."</p>";
            
        }
    
        $page .= '<p class="italic"> Sorumlu Yazar: '.$abstract_main_author[3].'</p>';
*/
    
        $page .= "</div>";
    
        $page .= '<div class="contant">';


        //turkish contant
        $page .=  '<p class="justify">';
   

        if($abstract_viewer["edit_contant_turkish"])
        {
            $turkish_contant = json_decode($abstract_viewer["edit_contant_turkish"]);
            $page .= $turkish_contant;

        }
        else
        {
            $page .= $abstract_viewer["contant"];
        }

        $page .= '</p>';
        //turkish keywords

        $page .=  '<p class="italic"><b>Anahtar Kelimeler:</b>:';

        $turkish_keywords = strip_tags($abstract_viewer["keywords"],$attribs);
        $turkish_keywords = stripAttributes($turkish_keywords,$attribs);

        $turkish_keywords = explode(",",$abstract_viewer["keywords"]);
        if($turkish_keywords && $abstract_viewer["edit_requests"])
        {
            $key_edit_sentences = json_decode($abstract_viewer["edit_requests"]);
            
            for($i=0;$i<count($turkish_keywords);$i++)
            {
                $cakisma = 0;
                $key_edit_index;
                for($a=0;$a<count($key_edit_sentences);$a++)
                {
                    if($key_edit_sentences[$a][0] == str_replace(["'",'"',"(",")","\n","\r"]," ",html_entity_decode(strip_tags($turkish_keywords[$i]))))
                    {
                        $key_edit_index=$a;
                        $cakisma = 1;
                        break;
                    }
                    else
                    {
                        continue;
                    }
                }
               if($cakisma == 1)
               {
                if($i<count($turkish_keywords)-1)
                {
                    $page .= $turkish_keywords[$i].',<sup><button class="duzenleme_istek" onclick="abstract_sentence_control(\''.str_replace(["'",'"',"(",")","\n","\r"],"--",html_entity_decode(strip_tags($key_edit_sentences[$key_edit_index][1]))).'\')">?</button></sup>';
                }
                else
                {
                    $page .= $turkish_keywords[$i].'<sup><button class="duzenleme_istek" onclick="abstract_sentence_control(\''.str_replace(["'",'"',"(",")","\n","\r"],"--",html_entity_decode(strip_tags($key_edit_sentences[$key_edit_index][1]))).'\')">?</button></sup>';
                }
                
                continue;
               }
               else
               {
                    if($i<count($turkish_keywords)-1)
                    {
                        $page .= $turkish_keywords[$i].",";
                    }
                    else
                    {
                        $page .= $turkish_keywords[$i];
                    }
                    continue;
               }
            }

        }

        else if($turkish_keywords && !$abstract_viewer["edit_requests"])
        {
            for($i=0;$i<count($turkish_keywords);$i++)
            {
                if($i<count($turkish_keywords)-1)
                {
                    $page .= $turkish_keywords[$i].",";
                }
                else
                {
                    $page .= $turkish_keywords[$i];
                }
                continue;
                
            }
        }


        $page .= '</p><hr>';
    
        //english_title
        if( $abstract_viewer["title_english"] !=""  || $abstract_viewer["title_english"] != null)
        {

            


            $page .= '<div class="merkez"><h3>';

            $english_title = strip_tags($abstract_viewer["title_english"],$attribs);
            $english_title = stripAttributes($english_title,$attribs);
            if($english_title && $abstract_viewer["edit_requests"])
            {
                $key_edit_sentences = json_decode($abstract_viewer["edit_requests"]);
                $key_edit_index;
                $cakisma = 0;
                for($a=0;$a<count($key_edit_sentences);$a++)
                {
                    if($key_edit_sentences[$a][0] == str_replace(["'",'"',"(",")","\n","\r"]," ",html_entity_decode(strip_tags($english_title))))
                    {
                        $key_edit_index = $a;
                        $cakisma = 1;
                        break;
                    }
                    else
                    {
                        continue;
                    }
                }
                if($cakisma == 1)
                {
                    $page .= '<sup><button class="duzenleme_istek" onclick="abstract_sentence_control(\''.str_replace(["'",'"',"(",")","\n","\r"],"--",html_entity_decode(strip_tags($key_edit_sentences[$key_edit_index][1]))).'\')">?</button></sup>'.$english_title;
                }
                else
                {
                    $page .= $english_title;
                }
            
    
            }
            else if($english_title && !$abstract_viewer["edit_requests"])
            {
                $page .= $english_title;  
            }

            $page .='</h3></div>';
        }
        else{}
    
    //english contant
    if($abstract_viewer["contant_english"] !="" || $abstract_viewer["contant_english"] != null)
    {


        $page .=  '<p class="justify">';

        if($abstract_viewer["edit_contant_english"])
        {
            $english_contant = json_decode($abstract_viewer["edit_contant_english"]);
            $page .= $english_contant;
        }
        else
        {
            $page .= $abstract_viewer["contant_english"];
        }

        
        $page .= '</p>';
        
    }
    else{}
    //english keywords
    if( $abstract_viewer["keywords_english"] != "" || $abstract_viewer["keywords_english"] != null)
    {


        $page .=  '<div style="float:none;"><p class="italic"><b>Keywords</b>:';

        $english_keywords = strip_tags($abstract_viewer["keywords_english"],$attribs);
        $english_keywords = stripAttributes($english_keywords,$attribs);
        $english_keywords = explode(",",$abstract_viewer["keywords_english"]);
        if($english_keywords && $abstract_viewer["edit_requests"])
        {
            $key_edit_sentences = json_decode($abstract_viewer["edit_requests"]);
            
            for($i=0;$i<count($english_keywords);$i++)
            {
                $key_edit_index;
                $cakisma = 0;
                for($a=0;$a<count($key_edit_sentences);$a++)
                {
                    if($key_edit_sentences[$a][0] == str_replace(["'",'"',"(",")","\n","\r"]," ",html_entity_decode(strip_tags($english_keywords[$i]))))
                    {
                        $key_edit_index = $a;
                        $cakisma = 1;
                        break;
                    }
                    else
                    {
                        continue;
                    }
                }
               if($cakisma == 1)
               {
                if($i<count($english_keywords)-1)
                {
                    $page .= $english_keywords[$i].',<sup><button class="duzenleme_istek" onclick="abstract_sentence_control(\''.str_replace(["'",'"',"(",")","\n","\r"],"--",html_entity_decode(strip_tags($key_edit_sentences[$key_edit_index][1]))).'\')">?</button></sup>';
                }
                else
                {
                    $page .= $english_keywords[$i].'<sup><button class="duzenleme_istek" onclick="abstract_sentence_control(\''.str_replace(["'",'"',"(",")","\n","\r"],"--",html_entity_decode(strip_tags($key_edit_sentences[$key_edit_index][1]))).'\')">?</button></sup>';
                }
                
                continue;
               }
               else
               {
                    if($i<count($english_keywords)-1)
                    {
                        $page .= $english_keywords[$i].",";
                    }
                    else
                    {
                        $page .= $english_keywords[$i];
                    }
                    continue;
               }
            }

        }
        else if($english_keywords && !$abstract_viewer["edit_requests"])
        {
            for($i=0;$i<count($english_keywords);$i++)
            {
                    if($i<count($english_keywords)-1)
                    {
                        $page .= $english_keywords[$i].",";
                    }
                    else
                    {
                        $page .= $english_keywords[$i];
                    }
                    continue;
                
            }
        }
        $page .= '</p></div>';
    }
    else{}
    //supports
    if($abstract_viewer["supports"] !="" || $abstract_viewer["supports"] != null)
    {

        
        $key_edit_sentences = json_decode($abstract_viewer["edit_requests"]);
        if($key_edit_sentences)
        {
            $page .=  '<p class="italic">';

            $cakisma = 0;
            $key_edit_index;
            for($a=0;$a<count($key_edit_sentences);$a++)
            {
                if($key_edit_sentences[$a][0] == str_replace(["'",'"',"(",")","\n","\r"]," ",html_entity_decode(strip_tags($abstract_viewer["supports"]))))
                {
                    $cakisma = 1;
                    $key_edit_index = $a;

                    break;
                }
                else
                {
                    continue;
                }
            }
            if($cakisma == 1)
            {
                $page .= $abstract_viewer["supports"].'.<sup><button class="duzenleme_istek" onclick="abstract_sentence_control(\''.str_replace(["'",'"',"(",")","\n","\r"],"--",html_entity_decode(strip_tags($key_edit_sentences[$key_edit_index][1]))).'\')">?</button></sup>';
            }
            else
            {
                $page .= $abstract_viewer["supports"].".";
            }
            
            $page .= '</p>';

        }

        else if(!$key_edit_sentences)
        {
            $page .= '<p class="italic">'.$abstract_viewer["supports"].'</p>';  
        }
        else{}
        
    }
    
    if($abstract_viewer["referee_comments"])
    {
        $page .= '<br><p><b>Bilim Kurulu Üyesi Yorumu: </b></p>';
        $page .= '<p class="italic">'.$abstract_viewer["referee_comments"].'</p>';
    }
    $page .= '</p></div>
    </div>
    </body>
    </html>';
}
echo $page;




?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
var abstract_sentence_control_arr = [];




 function abstract_sentence_control(sentence)
{
    var sentence_edit = alert("Düzenleme isteği: "+sentence);
}


</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js" integrity="sha512-pdCVFUWsxl1A4g0uV6fyJ3nrnTGeWnZN2Tl/56j45UvZ1OMdm9CIbctuIHj+yBIRTUUyv6I9+OivXj4i0LPEYA==" crossorigin="anonymous"></script>
<script>

$(document).ready(function(){

    $(".editable").click(function(){

        alert('Düzenleme İsteği:  '+this.lang);
        
    });

});




function html_pdf (){


    var element = document.getElementById('body');
    html2pdf(element, {
    margin:       10,
    filename:     'bildiri_<?php echo $abstract_viewer["abstract_no"];?>.pdf',
    image:        { type: 'jpeg', quality: 2 },
    html2canvas:  { scale: 2, logging: true, dpi: 192, letterRendering: true },
    jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
    });

}




</script>


<?php
     function turkce($inputText) {
        $search  = array('ç', 'Ç', 'ğ', 'Ğ', 'ı', 'İ', 'ö', 'Ö', 'ş', 'Ş', 'ü', 'Ü');
        $replace = array('c', 'C', 'g', 'G', 'i', 'I', 'o', 'O', 's', 'S', 'u', 'U');
        $outputText=str_replace($search, $replace, $inputText);
        return $outputText;
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


    </style>';
   
    

    $page.= '

    <button class="html_pdf_button" onclick="html_pdf()" >Pdf indir</button>

    <div id="body">
        <div class="merkez"><h3>'.  $abstract_viewer["title"].'</h3></div>';
        
    $page.= '<div class="contant">';
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
            
                        $abstract_main_author_arr = str_split(strval($abstract_location[$i][1][$a][0]));
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
    
        $page .= "</div>";

    
        $page .= '<div class="contant">';
    

        $page .=  '<p class="justify">'.$abstract_viewer["contant"].'</p>';
        $page .= '<p  class="italic"><b>Anahtar Kelimeler</b>: '. $abstract_viewer["keywords"].'</p><br><hr>';
    

        if( $abstract_viewer["title_english"] !="" ){

            $page .= '<div class="merkez"><h3>'.  $abstract_viewer["title_english"].'</h3></div>';
        }
        else{
        }
    
    
    if($abstract_viewer["contant_english"] !=""){

        $page .= '<p class="justify">'. $abstract_viewer["contant_english"].'</p>';
        
    }
    else{
    }

    if( $abstract_viewer["keywords_english"] != ""){

        $page .= '<p  class="italic"><b>Keywords</b>: '. $abstract_viewer["keywords_english"].'</p>';
    }
    else{
    }
    
    
    
    
    
        $page .= '<p class="italic">'. $abstract_viewer["supports"].'</p></div>
        </div>
        </body>
        </html>';
    }
echo $page;


?>


<script src= 
        "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> 
            </script>

<script>

$('p').removeAttr('style');
 $('h1').removeAttr('style');
 $('h2').removeAttr('style');
 $('h3').removeAttr('style');
 $('span').removeAttr('style');
 $('strong').removeAttr('style');


</script>
   
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js" integrity="sha512-pdCVFUWsxl1A4g0uV6fyJ3nrnTGeWnZN2Tl/56j45UvZ1OMdm9CIbctuIHj+yBIRTUUyv6I9+OivXj4i0LPEYA==" crossorigin="anonymous"></script>
<script>
function html_pdf (){

    $('p').removeAttr('style');
    $('h1').removeAttr('style');
    $('h2').removeAttr('style');
    $('h3').removeAttr('style');
    $('span').removeAttr('style');
    $('strong').removeAttr('style');
    var element = document.getElementById('body');
    html2pdf(element, {
    margin:       10,
    filename:     'bildiri<?php echo $_GET["id"];?>.pdf',
    image:        { type: 'jpeg', quality: 2 },
    html2canvas:  { scale: 2, logging: true, dpi: 192, letterRendering: true },
    jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
    });

}

</script>


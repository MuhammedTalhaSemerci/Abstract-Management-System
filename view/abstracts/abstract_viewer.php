<?php
 include __DIR__."/simple_html_dom.php";



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

    $attribs = ["b","i","sup","sub","strong","span","p"];
    $page="";

    if(isset($abstract_viewer) && is_array($abstract_viewer)){
    $page.='
    <!DOCTYPE html>
    <html lang="en" >
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>'.$language[0].'</title>
    
        
        </head>
    <body>';
    
    
   
    $turkish_title = strip_tags($abstract_viewer["title"],$attribs);
    $turkish_title = stripAttributes($turkish_title,$attribs);

    $page.= '

    <button class="html_pdf_button" onclick="html_pdf()" >'.$language[1].'</button>
    <button class="html_word_button"  >'.$language[2].'</button>


    <div id="body">';

    $page .=
    '<style>
    
    .contant{
    
    margin:auto;
    width:90%;
    height:auto;

    

  
    word-wrap: break-word;
    
    position:relative;
    
    
    }

    p
    {
        font-size:13px;
        margin-top:5px;
        margin-bottom:5px;
        text-align:justify;
    }

   

    
    .authors p
    {

        text-align:center;
    }

   
    .merkez p{
        font-family: "Times New Roman", Times, serif;
        text-align:center;
        font-size:16px;
        margin-top:5px;
        margin-bottom:5px;
    }

    .merkez h1{
        font-family: "Times New Roman", Times, serif;
        text-align:center;
        font-size:16px;
        margin-top:5px;
        margin-bottom:5px;
    }
    .merkez h2{
        font-family: "Times New Roman", Times, serif;
        text-align:center;
        font-size:16px;
        margin-top:5px;
        margin-bottom:5px;
    }
    .merkez h3{
        font-family: "Times New Roman", Times, serif;
        text-align:center;
        font-size:16px;
        margin-top:5px;
        margin-bottom:5px;
    }
    .merkez h4{
        font-family: "Times New Roman", Times, serif;
        text-align:center;
        font-size:16px;
        margin-top:5px;
        margin-bottom:5px;
    }
    .merkez h5{
        font-family: "Times New Roman", Times, serif;
        text-align:center;
        font-size:16px;
        margin-top:5px;
        margin-bottom:5px;
    }
    .merkez h6{
        font-family: "Times New Roman", Times, serif;
        text-align:center;
        font-size:16px;
        margin-top:5px;
        margin-bottom:5px;
    }

   .merkez  span {
        font-size:13px;
        margin-top:5px;
        margin-bottom:5px;
        text-align:justify;
    }

   

  .html_pdf_button, .html_word_button
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

    .margin-top
    {
        margin-top:20px;
    }

    .margin-top-info
    {
        margin-top:40px;
    }
    
    .center
    {
        text-align:center;
    }

    </style>';
    $page .= '<div class="contant" >
        <div class="merkez"><h3>'.  $turkish_title.'</h3></div>
    </div>

    <div class="contant" style="margin-top:15px;margin-bottom:15px;">';
        
    
        if($user_index["uye_yetki"] == 2)
        {
            
        }
        else
        {
            $page.='<div class="authors"><p style="">';
    
            $abstract_location= [];
        
            $abstract_author_index=1;
            $abstract_main_author = json_decode($abstract_viewer["main_author"]);
            $abstract_other_author = json_decode($abstract_viewer["other_author"]);
            
            if(count($abstract_main_author) >= 4 )
            {
                if($abstract_viewer["other_author"])
                {
                    $abstract_all_authors = array_merge([$abstract_main_author], $abstract_other_author);
                }
                else
                {
                    $abstract_all_authors = [$abstract_main_author];
                }
                array_push($abstract_location,[$abstract_main_author[2],[$abstract_main_author]]);
            
                
                if(isset($abstract_other_author) && count($abstract_other_author) > 0 )
                {
        
                    for($i=0;$i<count($abstract_other_author);$i++){
                        
                        $k=0;
                    
                
                        
                        for($a=0;$a<count($abstract_location);$a++){
                
                        
                                    if($abstract_location[$a][0] ==$abstract_other_author[$i][2]){
                        
                                    $cakisma =1;
                                    $k = $a;
                                    break;
                                    
                                    
                            
                                    }
                                    else{
                                        $cakisma = 0;
                                    
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

                if($abstract_other_author != null)
                {
                    if($abstract_main_author[4])
                    {
                        array_splice($abstract_other_author,intval($abstract_main_author[4])-1,0,[$abstract_main_author]);
                        $abstract_all_authors = $abstract_other_author; 
                    }
                    else
                    {
                        $abstract_main_author[4] = 1;
                        array_splice($abstract_other_author,0,0,[$abstract_main_author]);
                        $abstract_all_authors = $abstract_other_author; 
                    }
                }

                else
                {
                    $abstract_main_author[4] = 1;
                    $abstract_all_authors = [$abstract_main_author];
                }

            
                
        


                for($k=0;$k<count($abstract_all_authors);$k++)
                {
                    for($i=0; $i<count($abstract_location);$i++)
                    {
                
                        for($a=0;$a<count($abstract_location[$i][1]);$a++)
                        {
                            $toplu_str="";
                            $toplu_str1="";
                        
                            if(($abstract_all_authors[$k][0] == $abstract_location[$i][1][$a][0] && $abstract_all_authors[$k][1] == $abstract_location[$i][1][$a][1]))
                            {
                                
                                for($b=0; $b<2;$b++)
                                {
                                    if($b == 1){
                            
                                        $toplu_str1 =  " ".mb_strtoupper(strval($abstract_location[$i][1][$a][1]));
                                    }
                                    else{
                            
                                        $abstract_main_author_arr = mb_str_split($abstract_location[$i][1][$a][0]);
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
                                            $toplu_str .= mb_strtoupper($abstract_main_author_arr[$c]);
                                            }
                                            
                                        }
                                        
                                    }
                            
                                }
                    
                    
                                if($k == 0){
                    
                                    if($abstract_all_authors[$k][4])
                                    {
                                        $page .= "<u>".$toplu_str." ".$toplu_str1.'<sup>'.($i+1).'</sup></u>';
                                    }
                                    else
                                    {
                                        $page .= $toplu_str." ".$toplu_str1.'<sup>'.($i+1).'</sup>';
                                    }
                                }
                                else
                                {
                                    if($abstract_all_authors[$k][4])
                                    {
                                        $page .= ", <u>".$toplu_str." ".$toplu_str1.'<sup>'.($i+1).'</sup>'."</u>";                                     
                                    }
                                    else
                                    {
                                        $page .= ", ".$toplu_str." ".$toplu_str1.'<sup>'.($i+1).'</sup>';
                                    }

                                }

                            
                            }
                
                        }
                    }
                }
                            
            
            

                $page .= "</p></div>";
            
            
                for($i=0; $i<count($abstract_location);$i++)
                {
                    $page .= ' <p class="italic authors_institute" > <sup>'.($i+1).'</sup>'.mb_convert_case($abstract_location[$i][0], MB_CASE_TITLE, "UTF-8")."</p>";
                }
            
                $page .= '<p class="italic "  > '.$language[3].' '.$abstract_main_author[3].'</p>';
            }
        }
  
    

        $page .= "</div>";

    
        $page .= '<div class="contant">';
    
        $page .= '<div id="contant_turkish">';
        $turkish_contant = strip_tags($abstract_viewer["contant"],$attribs);
        $turkish_contant = stripAttributes($turkish_contant,$attribs);    
        $page .=  '<p class="justify " style="justify-content">'.$turkish_contant.'</p>';
        $page .= '</div>';


        $page .= '<p  class="italic margin-top" ><b>'.$language[4].'</b> '. $abstract_viewer["keywords"].'</p><br>';
        
        $page .='<div id="html_page_break" class="html_page_break"></div>';

  
        if( $abstract_viewer["title_english"] !="" ){
            $turkish_title_english = strip_tags($abstract_viewer["title_english"],$attribs);
            $turkish_title_english = stripAttributes($turkish_title_english,$attribs);    
            $page .= '<div class="merkez"><h3>'.  $turkish_title_english.'</h3></div>';
        }
        else{
        }
        
        
        if($abstract_viewer["contant_english"] !=""){
            $page .= '<div id="contant_english">';

            $turkish_contant_english = strip_tags($abstract_viewer["contant_english"],$attribs);
            $turkish_contant_english = stripAttributes($turkish_contant_english,$attribs);    
            $page .= '<p class="justify " style="justify-content">'. $turkish_contant_english.'</p>';
            $page .= '</div>';
        
        }
        else{
        }

        if( $abstract_viewer["keywords_english"] != ""){

            $turkish_keywords_english = strip_tags($abstract_viewer["keywords_english"],$attribs);
            $turkish_keywords_english = stripAttributes($turkish_keywords_english,$attribs);  
            $page .= '<p  class="italic margin-top"><b>'.$language[5].'</b> '. $turkish_keywords_english.'</p>';
        }
        else{
        }
    
    
    
    
        if($abstract_viewer["supports"])
        {
            $page .= '<p class="italic margin-top-info" >'. $abstract_viewer["supports"].'</p><br><br>';
        }
        
            $page .= '
            
            </div>
        </div>
        </body>
    ';
      
    if($abstract_viewer["comments"] && $user_index["uye_yetki"] != 2)
    {
        $page.= '<footer class="contant">
                <p class="italic"><b>'.$language[6].' </b>'. $abstract_viewer["comments"].'</p>
            </footer>'; 
    }
  
        

    $page .= ' </html>';
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js" integrity="sha512-Qlv6VSKh1gDKGoJbnyA5RMXYcvnpIqhO++MhIM2fStMcGT9i2T//tSwYFlcyoRRDcDZ+TYHpH8azBBCyhpSeqw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>


    $(document).ready(function(){

        var element = document.getElementById('html_page_break');
        var contant_turkish = $('#contant_turkish');
        var contant_english = $('#contant_english');
        var authors_institute = $('.authors_institute');
        
        

        if((contant_turkish.text().length+contant_english.text().length > 4000) || authors_institute.length > 4)
        {
            element.className = "html2pdf__page-break";
        }
 
        else
        {
            element.innerHTML ="<hr>";
        }
        
    });

         
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
filename:     'bildiri_<?php echo $abstract_viewer["abstract_no"];?>.pdf',
image:        { type: 'jpeg', quality: 2 },
html2canvas:  { scale: 4, logging: true, dpi: 192, letterRendering: true },
jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
});



}



if (typeof jQuery !== "undefined" && typeof saveAs !== "undefined") {
    (function($) {
        $.fn.wordExport = function(fileName) {

            fileName = typeof fileName !== 'undefined' ? fileName : "jQuery-Word-Export";
            var static = {
                mhtml: {
                    top: "Mime-Version: 1.0\nContent-Base: " + location.href + "\nContent-Type: Multipart/related; boundary=\"NEXT.ITEM-BOUNDARY\";type=\"text/html\"\n\n--NEXT.ITEM-BOUNDARY\nContent-Type: text/html; charset=\"utf-8\"\nContent-Location: " + location.href + "\n\n<!DOCTYPE html>\n<html>\n_html_</html>",
                    head: "<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n<style>\n_styles_\n</style>\n</head>\n",
                    body: "<body>_body_</body>"
                }
            };
            var options = {
                maxWidth: 624
            };
            // Clone selected element before manipulating it
            var markup = $(this).clone();

            // Remove hidden elements from the output
            markup.each(function() {
                var self = $(this);
                if (self.is(':hidden'))
                    self.remove();
            });

            // Embed all images using Data URLs
            var images = Array();
            var img = markup.find('img');
            for (var i = 0; i < img.length; i++) {
                // Calculate dimensions of output image
                var w = Math.min(img[i].width, options.maxWidth);
                var h = img[i].height * (w / img[i].width);
                // Create canvas for converting image to data URL
                var canvas = document.createElement("CANVAS");
                canvas.width = w;
                canvas.height = h;
                // Draw image to canvas
                var context = canvas.getContext('2d');
                context.drawImage(img[i], 0, 0, w, h);
                // Get data URL encoding of image
                var uri = canvas.toDataURL("image/png");
                $(img[i]).attr("src", img[i].src);
                img[i].width = w;
                img[i].height = h;
                // Save encoded image to array
                images[i] = {
                    type: uri.substring(uri.indexOf(":") + 1, uri.indexOf(";")),
                    encoding: uri.substring(uri.indexOf(";") + 1, uri.indexOf(",")),
                    location: $(img[i]).attr("src"),
                    data: uri.substring(uri.indexOf(",") + 1)
                };
            }

            // Prepare bottom of mhtml file with image data
            var mhtmlBottom = "\n";
            for (var i = 0; i < images.length; i++) {
                mhtmlBottom += "--NEXT.ITEM-BOUNDARY\n";
                mhtmlBottom += "Content-Location: " + images[i].location + "\n";
                mhtmlBottom += "Content-Type: " + images[i].type + "\n";
                mhtmlBottom += "Content-Transfer-Encoding: " + images[i].encoding + "\n\n";
                mhtmlBottom += images[i].data + "\n\n";
            }
            mhtmlBottom += "--NEXT.ITEM-BOUNDARY--";

            //TODO: load css from included stylesheet
            var styles = "";

            // Aggregate parts of the file together
            var fileContent = static.mhtml.top.replace("_html_", static.mhtml.head.replace("_styles_", styles) + static.mhtml.body.replace("_body_", markup.html())) + mhtmlBottom;

            // Create a Blob with the file contents
            var blob = new Blob([fileContent], {
                type: "application/msword;charset=utf-8"
            });
            saveAs(blob, fileName + ".doc");
        };
    })(jQuery);
} else {
    if (typeof jQuery === "undefined") {
        console.error("jQuery Word Export: missing dependency (jQuery)");
    }
    if (typeof saveAs === "undefined") {
        console.error("jQuery Word Export: missing dependency (FileSaver.js)");
    }
}




$(".html_word_button").click(function(event) {
            $("#body").wordExport("Bildiri kitapçığı");
        });

</script>


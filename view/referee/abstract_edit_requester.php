<?php
    include __DIR__."/simple_html_dom.php";
     function str_oto_edit($inputText) {
        $search  = array("'");
        $replace = array("\'");
        $outputText=str_replace($search, $replace, $inputText);
        return $outputText;
    }

    function stripAttributes($html,$attribs) {
        
        $html = str_get_html($html);
        $deneme = "";
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
    <!DOCTYPE HTML>
    <html lang="en" >
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.1/tinymce.min.js" integrity="sha512-RnlQJaTEHoOCt5dUTV0Oi0vOBMI9PjCU7m+VHoJ4xmhuUNcwnB5Iox1es+skLril1C3gHTLbeRepHs1RpSCLoQ==" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    
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
    p,h1,h2,h3,h4,h5,h6,h7,div,span,strong
    {
        line-height:1.6;
  
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



    .duzenleme_istek_title,.duzenleme_istek_contant,.duzenleme_istek_keywords,
    .duzenleme_istek_title_english,.duzenleme_istek_contant_english,.duzenleme_istek_keywords_english,.duzenleme_istek_supports 
    {
        z-index:10;
     
        font-size:10px;
        background-color:yellow;
        border:1px;
        border-radius:2px;
        display:none;

    }


    //title
    .editable_title .duzenleme_istek_title
    {
        display:none;
    }

    .editable_title:hover .duzenleme_istek_title
    {
        display:inline-block;
    }

    
    //contant
    .editable_contant .duzenleme_istek_contant
    {
        display:none;
    }

    .editable_contant:hover .duzenleme_istek_contant
    {
        display:inline-block;
    }
    


    
    //keywords
    .editable_keywords .duzenleme_istek_keywords
    {
        display:none;
    }

    .editable_keywords:hover .duzenleme_istek_keywords
    {
        display:inline-block;
    }



    //title_english
    .editable_title_english .duzenleme_istek_title_english
    {
        display:none;
    }

    .editable_title_english:hover .duzenleme_istek_title_english
    {
        display:inline-block;
    }

    
    //contant_english
    .editable_contant_english .duzenleme_istek_contant_english
    {
        display:none;
    }

    .editable_contant_english:hover .duzenleme_istek_contant_english
    {
        display:inline-block;
    }
    


    
    //keywords_english
    .editable_keywords_english .duzenleme_istek_keywords_english
    {
        display:none;
    }

    .editable_keywords_english:hover .duzenleme_istek_keywords_english
    {
        display:inline-block;
    }

    //supports
    .editable_supports .duzenleme_istek_supports
    {
        display:none;
    }

    .editable_supports:hover .duzenleme_istek_supports
    {
        display:inline-block;
    }

    


    </style>';
   
    
    $page.= '


    <div id="body">




    <div></div>



    <div class="contant">
            ';  
    $none_strips = "b><i><sup><sub><strong><span><p><h1><h2><h3><h4><h5><h6><div>";
        $attribs = ["b","i","sup","sub","strong","p"];
        //turkish title
        
        $turkish_title = strip_tags($abstract_viewer["title"],$attribs);
        $turkish_title = stripAttributes($turkish_title,$attribs);
        $page .= '<div class="merkez" >';
        $page .= '<h3 class="editable_title">'.$turkish_title.'<sup><button class="duzenleme_istek_title" onclick="abstract_sentence_control(\''.str_replace(["'",'"',"(",")","\n","\r"]," ",strip_tags($turkish_title)).'\')"><i class="fas fa-pen"></i></button></sup></h3>' ;
        $page .= '</div>';
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
        $turkish_contant = strip_tags($abstract_viewer["contant"],$attribs);
        $turkish_contant = stripAttributes($turkish_contant,$attribs);
        $page .= '
        <div class="contant">
            <textarea id="contant_turkish" class="contant_turkish">'.$turkish_contant.'
            </textarea>
        ';
        //turkish keywords
        
        $turkish_keywords = strip_tags($abstract_viewer["keywords"],$attribs);
        $turkish_keywords = stripAttributes($turkish_keywords,$attribs);
        $turkish_keywords = explode(",",$turkish_keywords);

        $page .=  '<div class="italic editable_keywords"><b>Anahtar Kelimeler:</b>';

            for($i=0;$i<count($turkish_keywords);$i++)
            {
                if($i<count($turkish_keywords)-1)
                {
                    $page .= ''.$turkish_keywords[$i].',<sup><button class="duzenleme_istek_keywords" onclick="abstract_sentence_control(\''.str_replace(["'",'"',"(",")","\n","\r"]," ",strip_tags($turkish_keywords[$i])).'\')"><i class="fas fa-pen"></i></button></sup>';
                }
                else
                {
                    $page .= ''.$turkish_keywords[$i].'<sup><button class="duzenleme_istek_keywords" onclick="abstract_sentence_control(\''.str_replace(["'",'"',"(",")","\n","\r"]," ",strip_tags($turkish_keywords[$i])).'\')"><i class="fas fa-pen"></i></button></sup>';
                }
                
            }
            
        $page .= '</div><hr>';
    
        //english_title
        if( $abstract_viewer["title_english"] !=""  || $abstract_viewer["title_english"] != null)
        {

            $english_title = strip_tags($abstract_viewer["title_english"],$attribs);
            $english_title = stripAttributes($english_title,$attribs);

            $page .= '<div class="merkez"><h3 class="editable_title_english">';
            $page .= $english_title.'<sup><button class="duzenleme_istek_title_english" onclick="abstract_sentence_control(\''.str_replace(["'",'"',"(",")","\n","\r"]," ",strip_tags($english_title)).'\')"><i class="fas fa-pen"></i></button></sup>' ;
            $page .='</h3></div>';
        }
        else{
        }
    
    //english contant
    if($abstract_viewer["contant_english"] !="" || $abstract_viewer["contant_english"] != null){
        
        $english_contant = strip_tags($abstract_viewer["contant_english"],$attribs);
        $english_contant = stripAttributes($english_contant,$attribs);
        $page .=  '
        <div class="justify editable_contant_english">
            <textarea id="contant_english" class="contant_english">'.$english_contant.'
            </textarea>
        </div>';
        
    }
    else{}
    //english keywords
    if( $abstract_viewer["keywords_english"] != "" || $abstract_viewer["keywords_english"] != null){

        $english_keywords = strip_tags($abstract_viewer["keywords_english"],$attribs);
        $english_keywords = stripAttributes($english_keywords,$attribs);
        $english_keywords = explode(",",$english_keywords);

        $page .=  '<div class="italic editable_keywords_english"><b>Keywords</b>:';

            for($i=0;$i<count($english_keywords);$i++)
            {
                if($i<count($english_keywords)-1)
                {
                    $page .= ''.$english_keywords[$i].',<sup><button class="duzenleme_istek_keywords_english" onclick="abstract_sentence_control(\''.str_replace(["'",'"',"(",")","\n","\r"]," ",strip_tags($english_keywords[$i])).'\')"><i class="fas fa-pen"></i></button></sup>';
                }
                else
                {
                    $page .= ''.$english_keywords[$i].'<sup><button class="duzenleme_istek_keywords_english" onclick="abstract_sentence_control(\''.str_replace(["'",'"',"(",")","\n","\r"]," ",strip_tags($english_keywords[$i])).'\')"><i class="fas fa-pen"></i></button></sup>';
                }
                
            }
            
        $page .= '</div></div>';
    }
    else{}
    
        if($abstract_viewer["supports"] !="" || $abstract_viewer["supports"] != null)
        {

            $page .=  '<p class=" contant italic editable_supports">';
            $page .= $abstract_viewer["supports"].'<sup"><button class="duzenleme_istek_supports" onclick="abstract_sentence_control(\''.str_replace(["'",'"',"(",")","\n","\r"]," ",strip_tags($abstract_viewer["supports"])).'\')"><i class="fas fa-pen"></i></button></sup>' ;
            $page .= '</p>';
        }
        
    
        $page .= '</p>
        <div class="merkez" ><h2 >Bilim Kurulu Üyesi Yorum Alanı</h2></div>
        <textarea class="referee_comment" style = " margin-left:40px;width:calc(100% - 80px);height:250px;" id="summernote" name="contant" placeholder="Bilim kurulu üyesi yorum alanı"></textarea>
        
        </div>


        </div><br>
        <div class="merkez1">
            <label for="referee_edit_state"  style="color:red">Bildiri hakkındaki görüşünüzü seçiniz</label><br>
        </div><br>
        <div class="merkez1">
            <select class="referee_edit_state">
                <option value="">Seçim Yapınız!</option>
                <option value="1">Kabul Et</option>
                <option value="2">Reddet</option>
                <option value="3">Düzenleme İste</option>
            </select>
        </div>

        </body>
        <br>
        <br>
        <br>
      
        <div class="merkez1">

           
        
            <button class="html_pdf_button" style="text-align:center;" onclick="referee_abstract_edit_request_save(\''.$abstract_viewer["abstract_no"].'\')">Değişiklikleri kaydet</button></div>
        </html>';
    }
echo $page;




?>



<script>



var abstract_sentence_control_arr = [];


 function abstract_sentence_control(sentence)
{

    var sentence_edit = prompt("Düzenleme istediğiniz metin: "+sentence);
    if(sentence_edit==null || sentence_edit=="")
    {
        alert("Değer girmediğiniz için düzenleme isteği kaydedilmedi.");
    }
    else
    {
        cakisma=0;
        if(abstract_sentence_control_arr.length>0)
        {
            var sentence_index;
            for(i=0;i<abstract_sentence_control_arr.length;i++)
            {
                if(abstract_sentence_control_arr[i][0] == sentence)
                {
                    sentence_index=i;
                    cakisma=1;
                    break
                }
                else{}
            }
            if(cakisma==1)
            {
                abstract_sentence_control_arr[sentence_index][1] = sentence_edit;
                alert("Düzenleme isteğinin ön kaydı yapılmıştır.");
            }
            else if(cakisma==0)
            {
                abstract_sentence_control_arr[(abstract_sentence_control_arr.length)]=[sentence,sentence_edit];
                alert("Düzenleme isteğinin ön kaydı yapılmıştır.");
            }
        }
        else
        {
            abstract_sentence_control_arr[0] = [sentence,sentence_edit];
            alert("Düzenleme isteğinin ön kaydı yapılmıştır.");
        }
    }
        


}


</script>


<script>


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


function referee_abstract_edit_request_save(abstract_id) {

    tinyMCE.triggerSave();
    contant_turkish = $(".contant_turkish").val();
    contant_english = $(".contant_english").val();
    referee_edit_state = $(".referee_edit_state").val();
    if(referee_edit_state == null || referee_edit_state =="")
    {
        alert("Lütfen eksik alan bırakmayınız !").stop();
    }
    referee_comment = $(".referee_comment").val();
    abstract_sentence_control_str = JSON.stringify(abstract_sentence_control_arr);
    var y ;
     if (confirm("Değişiklikleri kaydetmek istediğinizden emin misiniz ?") == true) 
     {
        postForm('/referee_abstract_edit_request_save?abstract_id='+abstract_id, {edit_sentences:abstract_sentence_control_str,referee_comment:referee_comment,referee_edit_state:referee_edit_state,contant_turkish:contant_turkish,contant_english:contant_english});
     } 
     else 
     {
         y = "Değişiklikler kaydedilmedi!";
         alert(y); 
     }
    


}


   




</script>





<script>

var html="";
var id_index = 0;
tinymce.init({

  menubar: false,
  selector: 'textarea.contant_turkish#contant_turkish',
  toolbar: 'customInsertButton customDateButton',
  setup: function (editor) {

    editor.ui.registry.addButton('customInsertButton', {
      text: 'Düzenleme İste',
      onAction: function (_) 
      {

        tinymce.EditorManager.get('contant_turkish').focus();

        if(tinymce.activeEditor.selection.getContent().search('class="editable"')!= -1)
          {
            alert('Bu şekilde bir düzenlemeye izin verilememektedir.');
            return;
          }

        var deger = prompt('Düzenleme isteğinizi giriniz.');
        var cakisma = 0 ;
     
          try {

              dom_doc = $(tinymce.activeEditor.selection.getContent());
              for(i=0;i<dom_doc.length;i++)
              {
                if(dom_doc[i].tagName == null)
                {

                }
              else
              {
                tag_parse = dom_doc[i].tagName.split("");
                if(tag_parse[0] == 'H' || tag_parse[0] == 'P' || dom_doc[i].tagName == 'DIV')
                {
                  cakisma =1;
                  break;
                }
              }

            }
          } catch (error) {
            
          }
       

        if(deger != null && cakisma == 0)
        {
          //editor.insertContent('<span  class="editable" id="comment" lang="'+deger+'">'+tinymce.activeEditor.selection.getContent()+'</span>');

    
        var el = tinymce.activeEditor.dom.create('span', {id: 'editable-'+id_index, 'class': 'editable','lang':deger},String(tinymce.activeEditor.selection.getContent())  );
        tinymce.activeEditor.selection.setNode(el);
        id_index+=1;
        
        }
        else
        {
          if(cakisma == 1)
          {
            alert('Bu şekilde bir düzenlemeye izin verilememektedir.');
          }
          return;
        }
   
      }
    });

  },
  init_instance_callback: function (editor) {
    editor.on('click', function (e) {
      tinymce.EditorManager.get('contant_turkish').focus();



   try {
    if(e.target.className == 'editable')
              {
                if(e.target.tagName =='SPAN' && e.target.className =="editable" &&  e.target.className != null)
                {
                  if(confirm('Düzenleme İsteği:  '+e.target.lang+'\n'+'Düzenleme Silinsin mi ?'))
                  {
                    e.target.outerHTML = e.target.innerHTML;
                  }
          
              
                }
              }

              else if(e.target.parentElement.className == 'editable')
              {
                if(e.target.parentElement.tagName =='SPAN' && e.target.parentElement.className =="editable" &&  e.target.parentElement != null )
                {
                  if(confirm('Düzenleme İsteği:  '+e.target.parentElement.lang+'\n'+'Düzenleme Silinsin mi ?'))

                  {

                    e.target.parentElement.outerHTML= e.target.parentElement.innerHTML;
                  }
          
                }

              }

              else if(e.target.parentElement.parentElement.className == 'editable')
              {
                if(e.target.parentElement.parentElement.tagName =='SPAN' && e.target.parentElement.parentElement.className =="editable" &&  e.target.parentElement.parentElement != null )
                {
                  if(confirm('Düzenleme İsteği:  '+e.target.parentElement.parentElement.lang+'\n'+'Düzenleme Silinsin mi ?'))
                  {
                    e.target.parentElement.parentElement.outerHTML= e.target.parentElement.parentElement.innerHTML;
                  }
                
                }

              }

                
              else if(e.target.parentElement.parentElement.parentElement.className == 'editable')
              {
                if(e.target.parentElement.parentElement.parentElement.tagName =='SPAN' && e.target.parentElement.parentElement.parentElement.className =="editable" &&  e.target.parentElement.parentElement.parentElement != null )
                {
                  if(confirm('Düzenleme İsteği:  '+e.target.parentElement.parentElement.parentElement.lang+'\n'+'Düzenleme Silinsin mi ?'))

                  {
                    e.target.parentElement.parentElement.parentElement.outerHTML= e.target.parentElement.parentElement.parentElement.innerHTML;

                  }

                }

              }
   } catch (error) {
     
   }
        
  
    /*
        try {
          if(e.target.className == 'editable')
              {
                if(e.target.tagName =='SPAN' && e.target.className =="editable" &&  e.target.className != null)
                {
                  alert( e.target.lang);
                }
              }

              else if(e.target.parentElement.className == 'editable')
              {
                if(e.target.parentElement.tagName =='SPAN' && e.target.parentElement.className =="editable" &&  e.target.parentElement != null )
                {
                  alert( e.target.parentElement.lang);
                }

              }

              else if(e.target.parentElement.parentElement.className == 'editable')
              {
                if(e.target.parentElement.parentElement.tagName =='SPAN' && e.target.parentElement.parentElement.className =="editable" &&  e.target.parentElement.parentElement != null )
                {
                  alert( e.target.parentElement.parentElement.lang);
                }

              }

                
              else if(e.target.parentElement.parentElement.parentElement.className == 'editable')
              {
                if(e.target.parentElement.parentElement.parentElement.tagName =='SPAN' && e.target.parentElement.parentElement.parentElement.className =="editable" &&  e.target.parentElement.parentElement.parentElement != null )
                {
                  alert( e.target.parentElement.parentElement.parentElement.lang);
                }

              }
        } catch (error) {
        }
   
*/

   


   
      /*
      $('.comments-area').css("display","block");
      $(String('#'+(e.target.id))).css("display","block");*/
    });
  },
  content_style: '.comments{  display:none;}.editable{background-color:yellow;opacity:0.6}.editable:hover{background-color:red;opacity:0.6} em{z-index:-1;}b{z-index:-1;}sup{z-index:-1;}sub{z-index:-1;}'
});




var html="";
var id_index = 0;
tinymce.init({

    
  menubar: false,
  selector: 'textarea.contant_english#contant_english',
  toolbar: 'customInsertButton customDateButton',
  setup: function (editor) {
    editor.ui.registry.addButton('customInsertButton', {
      text: 'Düzenleme İste',
      tooltip:"duzenleme",
      
      onAction: function (e) 
      {
        tinymce.EditorManager.get('contant_english').focus();

        if(tinymce.activeEditor.selection.getContent().search('class="editable"')!= -1)
        {
        alert('Bu şekilde bir düzenlemeye izin verilememektedir.');
        return;
        }
        var deger = prompt('Düzenleme isteğinizi giriniz.');
        var cakisma = 0 ;
     
          try {

              dom_doc = $(tinymce.activeEditor.selection.getContent());
              for(i=0;i<dom_doc.length;i++)
              {
                if(dom_doc[i].tagName == null)
                {

                }
              else
              {
                tag_parse = dom_doc[i].tagName.split("");
                if(tag_parse[0] == 'H' || tag_parse[0] == 'P' || dom_doc[i].tagName == 'DIV')
                {
                  cakisma =1;
                  break;
                }
              }

            }
          } catch (error) {
            
          }
       

        if(deger != null && cakisma == 0)
        {
          //editor.insertContent('<span  class="editable" id="comment" lang="'+deger+'">'+tinymce.activeEditor.selection.getContent()+'</span>');

    
            var el = tinymce.activeEditor.dom.create('span', {id: 'editable-'+id_index, 'class': 'editable','lang':deger},String(tinymce.activeEditor.selection.getContent())  );
            tinymce.activeEditor.selection.setNode(el);
            id_index+=1;
        
    
        }
        else
        {
          if(cakisma == 1)
          {
            alert('Bu şekilde bir düzenlemeye izin verilememektedir.');
          }
          return;
        }
      $("iframe").contents().find("body").attr("contenteditable","false");
   
      }
    });

  },
  init_instance_callback: function (editor) {
    editor.on('click', function (e) {

      tinymce.EditorManager.get('contant_english').focus();

   try {
    if(e.target.className == 'editable')
              {
                if(e.target.tagName =='SPAN' && e.target.className =="editable" &&  e.target.className != null)
                {
                  if(confirm('Düzenleme İsteği:  '+e.target.lang+'\n'+'Düzenleme Silinsin mi ?'))
                  {
                    e.target.outerHTML = e.target.innerHTML;
                  }
          
              
                }
              }

              else if(e.target.parentElement.className == 'editable')
              {
                if(e.target.parentElement.tagName =='SPAN' && e.target.parentElement.className =="editable" &&  e.target.parentElement != null )
                {
                  if(confirm('Düzenleme İsteği:  '+e.target.parentElement.lang+'\n'+'Düzenleme Silinsin mi ?'))

                  {

                    e.target.parentElement.outerHTML= e.target.parentElement.innerHTML;
                  }
          
                }

              }

              else if(e.target.parentElement.parentElement.className == 'editable')
              {
                if(e.target.parentElement.parentElement.tagName =='SPAN' && e.target.parentElement.parentElement.className =="editable" &&  e.target.parentElement.parentElement != null )
                {
                  if(confirm('Düzenleme İsteği:  '+e.target.parentElement.parentElement.lang+'\n'+'Düzenleme Silinsin mi ?'))
                  {
                    e.target.parentElement.parentElement.outerHTML= e.target.parentElement.parentElement.innerHTML;
                  }
                
                }

              }

                
              else if(e.target.parentElement.parentElement.parentElement.className == 'editable')
              {
                if(e.target.parentElement.parentElement.parentElement.tagName =='SPAN' && e.target.parentElement.parentElement.parentElement.className =="editable" &&  e.target.parentElement.parentElement.parentElement != null )
                {
                  if(confirm('Düzenleme İsteği:  '+e.target.parentElement.parentElement.parentElement.lang+'\n'+'Düzenleme Silinsin mi ?'))

                  {
                    e.target.parentElement.parentElement.parentElement.outerHTML= e.target.parentElement.parentElement.parentElement.innerHTML;

                  }

                }

              }
   } catch (error) {
     
   }
  $("iframe").contents().find("body").attr("contenteditable","false");
        
  
    });
  },
  content_style: '.comments{  display:none;}.editable{background-color:yellow;opacity:0.6}.editable:hover{background-color:red;opacity:0.6} em{z-index:-1;}b{z-index:-1;}sup{z-index:-1;}sub{z-index:-1;}'
});

setTimeout(() => {
  $("iframe").contents().find("body").attr("contenteditable","false");
 
}, 2000);


/*

  function getSelectionParentElement() {
          var parentEl = null, sel;
          if (window.getSelection) {
              sel = window.getSelection();
              if (sel.rangeCount) {
                  parentEl = sel.getRangeAt(0).commonAncestorContainer;
                  if (parentEl.nodeType != 1) {
                      parentEl = parentEl.parentNode;
                  }
              }
          } else if ( (sel = document.selection) && sel.type != "Control") {
              parentEl = sel.createRange().parentElement();
          }
          return parentEl;
      }
  
  
      function isHTML(str) {
    var a = document.createElement('div');
    a.innerHTML = str;
  
    for (var c = a.childNodes, i = c.length; i--; ) {
      if (c[i].nodeType == 1) return true; 
    }
  
    return false;
  }
  
  var HightlightButton = function(context) {
  
  
    var ui = $.summernote.ui;
    console.log(context);
    var button = ui.button({
      contents: '<i class="fa fa-pencil"/> Highlight3',
      tooltip: 'Highlight text with red color',
      click: function() {
        var deger = prompt();
      context.invoke('editor.underline');
      var text = context.invoke('editor.getSelectedText');

      var tags = $("u");
      tags.each(function(i) {
     
          $(this).attr("class","editable");

        
      });

      $(".comments-area").html('<span class="comments">'+deger+'</span>');
        
      }
    
    });
  
    return button.render();
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  $(document).ready(function() {
    $('#summernote').summernote({
      toolbar: [
        ['style', ['highlight', 'bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['view', ['codeview']]
      ],
   
      buttons: {
        highlight: HightlightButton,
      },
      shortcuts: false,
  
      
    });
  });
  
  


    
  
  $(document).ready(function() {
    $('#summernote').summernote({
      toolbar: [
        ['style', ['highlight', 'bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['view', ['codeview']]
      ],
      styleTags: [
      'u',
          { title: 'Blockquote', tag: 'blockquote', className: 'blockquote', value: 'blockquote' },
    ],
      buttons: {
        highlight: HightlightButton,
      },
      shortcuts: false,
  
      
    });
  });
  
  
  */











  
  </script>


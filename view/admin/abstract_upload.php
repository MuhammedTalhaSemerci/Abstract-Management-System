<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  
    <title><?php echo $language[0];?></title> 


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

    <div style="display:flex;background-color:white; height:50px; ">
      <div class="lower-pre-next"style="display:flex;background-color:#dae0df; border:4px;justify-content:center;width:100%;z-index:10;padding-top:10px;padding-bottom:10px;border-radius:3px;">
      
        <button onclick="previous(this)" name="previouspage" style="border:0px;display:none;border-radius:2px;"><?php echo $language[1];?> <img style="width:40px;" src="/view/abstracts/dist/img/arrow-right.png" alt=""></button>
        <button onclick="next(this)" name="nextpage" style="border:0px;display:block;border-radius:2px;"><img style="width:40px;"src="/view/abstracts/dist/img/arrow-left.png" alt=""><?php echo $language[2];?></button>
      <div style="border-radius:1px;"> <span style="margin-left:100px;"><span style="color:red;"> <?php echo $language[3];?>: </span>4/</span><span  name="pageindex">1</span></div>
      </div>
    </div>

    <?php
   
      for($i=0;$i<count($abstract_websites);$i++ ){

        $abstract_website_arr = json_decode($abstract_websites[$i]["abstract_website"]);

        $arrwebsite = explode(" ",$abstract_website_arr->{"tr"});
        $arr_yazi ="";
        for($a=0; $a<count($arrwebsite);$a++){

          $arr_yazi.=$arrwebsite[$a];          

        }
        echo '<input type="hidden" name="'.$arr_yazi.'"' ."value='".$abstract_websites[$i]["categories"]."'> ";
      } 
      ?>
       
  </head>
  <body>
  <div name="abstract_category_div" style="display:none;">
            <label style = "margin:20px; width: calc(100% - 20px);" for="abstract_website"><?php echo $language[4];?></label>
          
      <select style = "margin-left:20px; width: calc(100% - 20px);" name="abstract_website" style="width:30%"  id=":1.confirm">

        <?php 

        echo '<option value="">'.$language[5].'</option>';
        for($i=0;$i<count($abstract_websites);$i++ ){

          $abstract_website_arr = json_decode($abstract_websites[$i]["abstract_website"]);
          echo '<option value="'.$abstract_website_arr->{"tr"}.'" >'.$abstract_website_arr->{$uye_dil}.'</option>';
        }
          
        ?>
        
      </select>
      <br>
    
      <label style = "margin-left:20px; width: calc(100% - 20px); display:none;" class="abstract_categories_lbl" for="abstract_categories"><?php echo $language[6];?></label>
        
      <select style = "margin-left:20px; width: calc(100% - 20px); display:none;"name="abstract_categories" class="abstract_categories" style="width:30%"></select>

      

      <label style="margin-left:20px; width: calc(100% - 20px); " class="abstract_sub_categories_lbl" for="abstract_categories"> <?php echo $language[7];?></label>
      <div style="margin-left:20px; width: calc(100% - 20px); " name="abstract_sub_categories" class="radio" style="width:30%"> </div>
      <br>

    </div>

    <div name="authors" style="display:none;">    
      <label style = "margin-left:20px;  width: calc(100% - 20px);" for="author_num"><?php echo $language[8];?></label>
      <input style = "margin-left:20px;  width: calc(100% - 20px);"  type="number" name="author_num" id="author_num" value="" style="width:30%" placeholder="<?php echo $language[9];?>">
      <div style = "margin-left:20px;  width: calc(100% - 20px);" name="authors" class="authors" style="width:50%"></div>
      <br>
    </div>  

    <div name="abstract_type" style="display:none;">
      <label style = "margin-left:20px;  width: calc(100% - 20px);" for="abstract_type"><?php echo $language[10];?></label>
      <select style = "margin-left:20px;  width: calc(100% - 20px);" name="abstract_type" style="width:30%">
    
      <?php

        $data = $language[11];
        if($uye_dil == "tr")
        {
          for($i=0;$i<count($data[0]);$i++){

            echo '<option value="'.$data[0][$i].'" >'.$data[0][$i].'</option>';

          }
        }
        else
        {
          for($i=0;$i<count($data[0]);$i++){

            echo '<option value="'.$data[0][$i].'" >'.$data[1][$i].'</option>';

          }
        }
      ?>
      </select>
    </div>
    <br>
    <div name="abstract_lang_select" style="display:none;">
    <label style = "margin-left:20px; width: calc(100% - 20px);" for="abstract_lang_select"><?php echo $language[12];?></label>
      <select style = "margin-left:20px; width: calc(100% - 20px);" name="abstract_lang_select">
        <option value="turkish-english"><?php echo $language[13];?></option>
        <option value="english"><?php echo $language[14];?></option>
      </select>
    <br>
<br>
    </div>

    
    <div name="alt_contact" style="display:none;">
      <label style = "margin-left:20px; width: calc(100% - 20px);" for="alt_contact"><?php echo $language[15];?></label><br>
      <input style = "margin-left:20px; width: calc(100% - 20px);" type="email" name="alt_contact" style="width:30%" required>
      <br>
      <hr>
      <br>
    </div>
    
    <div name="abstract_turkish_english" class="abstract_turkish_english" style="display:none; ">
      <label style = "margin-left:20px; width: calc(100% - 20px);" for="title"><?php echo $language[16];?> </label>
      <textarea style = "margin-left:20px; resize:none;" id="summernotetitle" placeholder="Bildiri Başlığı (Türkçe)"name="title" required></textarea>
      <br>
      <label style = "margin-left:20px; width: calc(100% - 20px);" for="contant"><?php echo $language[17];?> &nbsp;&nbsp; <span style="color:red;"> <?php echo $language[18];?> 350/</span> <span style="color:red;" id="abstract_contant0_length">0 </span> <span style="color:red;" id="abstract_contant0_limit"></span></label>
      <textarea style = "margin-left:20px; width: calc(100% - 20px);" id="summernote0" name="contant" placeholder="Bildiri Özeti (Türkçe)"></textarea>
      <br>
      <label style = "margin-left:20px; width: calc(100% - 20px);" for="keywords"><?php echo $language[19];?></label><br>
      <input style = "margin-left:20px; width: calc(100% - 20px);" type="text" name="keywords" placeholder="<?php echo $language[20];?>">
      </br>
      <hr>
      </br>
      <label style = "margin-left:20px; width: calc(100% - 20px);" for="title_english"><?php echo $language[21];?></label>
      <textarea style = "margin-left:20px; width: calc(100% - 20px);" id="summernotetitle1" placeholder="Bildiri Başlığı (İngilizce)"name="title_english" required></textarea>
      <br>
      <label style = "margin-left:20px; width: calc(100% - 20px);" for="contant_english"><?php echo $language[22];?> &nbsp;&nbsp; <span style="color:red;"> <?php echo $language[23];?> 350/</span> <span style="color:red;" id="abstract_contant1_length">0 </span> <span style="color:red;" id="abstract_contant1_limit"></span></label>
      <textarea style = "margin-left:20px; width: calc(100% - 20px);" id="summernote1" name="contant_english" placeholder="Bildiri Özeti (İngilizce)"></textarea>
      <br>
      <label style = "margin-left:20px; width: calc(100% - 20px);" for="keywords_english"><?php echo $language[24];?></label><br>
      <input style = "margin-left:20px; width: calc(100% - 20px);" type="text" name="keywords_english" placeholder="<?php echo $language[25];?>">
    </div>

    <div name="abstract_english" class="abstract_english" style="display:none;">
      <label style = "margin-left:20px; width: calc(100% - 20px);" for="title"><?php echo $language[26];?></label>
      <textarea style = "margin-left:20px; resize:none;" id="summernotetitle2" placeholder="Bildiri Başlığı (İngilizce)"name="title1" required></textarea>
      <br>
      <label style = "margin-left:20px; width: calc(100% - 20px);" for="contant"><?php echo $language[27];?> &nbsp;&nbsp; <span style="color:red;"> <?php echo $language[28];?> 350/</span> <span style="color:red;" id="abstract_contant2_length">0 </span> <span style="color:red;" id="abstract_contant2_limit"></span></label>
      <textarea style = "margin-left:20px; width: calc(100% - 20px);" id="summernote2" name="contant1" placeholder="Bildiri Özeti (İngilizce)"></textarea>
      <br>
      <label style = "margin-left:20px; width: calc(100% - 20px);" for="keywords"><?php echo $language[29];?></label><br>
      <input style = "margin-left:20px; width: calc(100% - 20px);" type="text" name="keywords1" placeholder="<?php echo $language[30];?>">
      
    <hr>
    <br>
    </div>
    <div name="supports_and_comments" style="display:none;">
      <label style = "margin-left:20px; width: calc(100% - 20px);" for="supports"><?php echo $language[31];?></label>
      <input style = "margin-left:20px; width: calc(100% - 20px);" type="text" name="supports" placeholder="<?php echo $language[32];?>">
      <br>
      <label style = "margin-left:20px; width: calc(100% - 20px);" for="comments"><?php echo $language[33];?></label>
      <textarea style = "margin-left:20px; width: calc(100% - 20px);"  name="comments"></textarea>
      <br>
      <button style = "margin-left:20px; width: calc(100% - 20px);" name="gonder" onclick="yazi_kaydet()"><?php echo $language[34];?></button>
      <h4 class="warning" style="
      color:red;
      text-align:center;
      display:none;
      "><?php echo $language[35];?></h4>
   </div>
    





    <script>
      $('#summernote0').summernote({
        placeholder: '<?php echo $language[36];?>',
        tabsize: 2,
        height: 120,
        toolbar: [['font', ['bold', 'italic','superscript','subscript','underline', 'clear']]],

      });

      
      var mySec = 100;
        var myEvent;

        var summernote = [$("#summernote0"),$("#summernote1"),$("#summernote2")];

        $('#summernote0').on("summernote.keyup", function (e) {
            clearTimeout(myEvent);

            myEvent = setTimeout(function(){
              setTimeout(limitar(0), 10);

            }, mySec);
        });



        $('#summernote0').on("summernote.paste", function (e) {
            clearTimeout(myEvent);

            myEvent = setTimeout(function(){
              setTimeout(limitar(0), 10);

            }, mySec);
        });




      $('#summernote1').summernote({
        placeholder: '<?php echo $language[37];?>',
        tabsize: 2,
        height: 120,
        toolbar: [['font', ['bold', 'italic','superscript','subscript','underline', 'clear']]],

      });


      $('#summernote1').on("summernote.keyup", function (e) {
            clearTimeout(myEvent);

            myEvent = setTimeout(function(){
              setTimeout(limitar(1), 10);

            }, mySec);
        });



      $('#summernote1').on("summernote.paste", function (e) {
          clearTimeout(myEvent);

          myEvent = setTimeout(function(){
            setTimeout(limitar(1), 10);

          }, mySec);
      });




      $('#summernote2').summernote({
        placeholder: '<?php echo $language[38];?>',
        tabsize: 2,
        height: 120,
        toolbar: [['font', ['bold', 'italic','superscript','subscript','underline', 'clear']]],

      });

      $('#summernote2').on("summernote.keyup", function (e) {
            clearTimeout(myEvent);

            myEvent = setTimeout(function(){
              setTimeout(limitar(2), 10);

            }, mySec);
        });



      $('#summernote2').on("summernote.paste", function (e) {
          clearTimeout(myEvent);

          myEvent = setTimeout(function(){
            setTimeout(limitar(2), 10);

          }, mySec);
      });



      $('#summernotetitle').summernote({
        placeholder: '<?php echo $language[39];?>',
        tabsize: 2,
        height: 50,
        toolbar: [['font', ['bold', 'italic','superscript','subscript','underline', 'clear']]],

        
        focus: true,
        disableResizeEditor: true
        
      });



      $('#summernotetitle1').summernote({
        placeholder: '<?php echo $language[40];?>',
        tabsize: 2,
        height: 50,
        toolbar: [['font', ['bold', 'italic','superscript','subscript','underline', 'clear']]],
        focus: true,
        disableResizeEditor: true
      });


      $('#summernotetitle2').summernote({
        placeholder: '<?php echo $language[41];?>',
        tabsize: 2,
        height: 50,
        toolbar: [['font', ['bold', 'italic','superscript','subscript','underline', 'clear']]],
        focus: true,
        disableResizeEditor: true
      });


    

    var timeout, limite = 350;

    function limitar(value) {

       var conteudo = summernote[value].summernote("code");
       conteudo = conteudo.replace(/<[^>]+>/g, "");
       conteudo = conteudo.split(" ");
       if (conteudo.length > limite) {
         $('#abstract_contant'+value+'_length').text(conteudo.length);
         $('#abstract_contant'+value+'_limit').text("<?php echo $language[42];?>");

         $('button[name=previouspage]').css('display','none');
         $('button[name=nextpage]').css('display','none');
         

       }
       else
       {
        $('#abstract_contant'+value+'_limit').text("");
        $('#abstract_contant'+value+'_length').text(conteudo.length);

        $('button[name=previouspage]').css('display','block');
        $('button[name=nextpage]').css('display','block');
       }
    }
   

      var site;
      var uye_dil = "<?php echo $uye_dil; ?>";


      String.prototype.turkishToLower = function(){
	var string = this;
	var letters = { "İ": "i", "I": "ı", "Ş": "ş", "Ğ": "ğ", "Ü": "ü", "Ö": "ö", "Ç": "ç" };
	string = string.replace(/(([İIŞĞÜÇÖ]))/g, function(letter){ return letters[letter]; })
	return string.toLowerCase();
}	
$(".abstract_sub_categories_lbl").css("display", "none");
$(".abstract_categories_lbl").css("display", "none");
$(".abstract_categories").css("display", "none");
$("input[name=abstract_sub_categories]").css("display", "none");




  $( "select[name=abstract_website]" )
  .change(function () {

    var str = "";
    $( "select[name=abstract_website] option:selected" ).each(function() {
      str += $( this ).val();
    });

    str = str.split(" ");
    newstr="";
    for(i=0;i<str.length;i++){
      newstr += str[i];

    }
    site = $("input[name="+newstr+"]").val();
    var site_categories = JSON.parse(site);
    site_cat_html="";


    site_cat_html += '<option value=""><?php echo $language[43];?></option>';
    for(i=0; i<site_categories.tr.length; i++){
      

        site_cat_html += '<option value="'+site_categories.tr[i][0].category+'">'+site_categories[uye_dil][i][0].category+'</option>';
     

    }

    $(".abstract_categories_lbl").css("display", "block");
    $(".abstract_categories").css("display", "block");
    $(".abstract_categories").html(site_cat_html);


    
  });
 









  $( "select[name=abstract_categories]" )
  .change(function () {

    let str = "";
    let str_subcategories ="";
    $( "select[name=abstract_categories] option:selected" ).each(function() {
      str_subcategories += $( this ).val();
    });

    
   
    var site_categories = JSON.parse(site);
    
    site_cat_html="";


    var i;
    var newstr;
    for(i=0; i<site_categories.tr.length; i++){
      

      for(k=0;k<site_categories.tr[i].length;k++){

        if(site_categories.tr[i][k].category == str_subcategories){

          newstr = i;

        }
        else{
          
        }
      }
       
     

    }

    for(k=1;k<site_categories.tr[newstr].length;k++){

      site_cat_html +=   '<label style="margin-left:20px;"><input type="radio" name="abstract_sub_check" style="margin-left:20px;" value="'+site_categories.tr[newstr][k] +'">&nbsp;'+site_categories[uye_dil][newstr][k] +'</label><br/>';

    }
    $(".abstract_sub_categories_lbl").css("display", "block");
    $("div[name=abstract_sub_categories]").html(site_cat_html);


    
  }) .change();
    </script>

    <script>
    
//////Yazı Ekle //////////
      function yazi_kaydet(){
   
        var abstract_website  = $("select[name=abstract_website] option:selected").val();
        var abstract_category  = $("select[name=abstract_categories] option:selected").val();
        var abstract_sub_category = $("input[name=abstract_sub_check]:checked").val();

        
        var abstract_language = $( "select[name=abstract_lang_select] option:selected" ).val();

        var alt_contact        = $("input[name=alt_contact]").val();

        if(abstract_language == "turkish-english")
        {
        var title              = $("textarea[name=title]").val();
        var contant            = $("textarea[name=contant]").val();
        var keywords           = $("input[name=keywords]").val();
        
        var title_english              = $("textarea[name=title_english]").val();
        var contant_english            = $("textarea[name=contant_english]").val();
        var keywords_english           = $("input[name=keywords_english]").val();

        }
        else if(abstract_language == "english")
        {
        var title              = $("textarea[name=title1]").val();
        var contant            = $("textarea[name=contant1]").val();
        var keywords           = $("input[name=keywords1]").val();
        var title_english= null;
        var contant_english = null;
        var keywords_english = null;
        }


        var abstract_type      = $("select[name=abstract_type] option:selected").val();

        var supports           = $("input[name=supports]").val();
        var comments           = $("textarea[name=comments]").val();
  

        var author_num         = parseInt($("input[name=author_num]").val());
        
 
        if((abstract_language == "turkish-english")&&(abstract_sub_category==null || title=="" || title=="<p><br></p>" || contant=="" || contant=="<p><br></p>" || keywords=="" || title_english=="" || title_english=="<p><br></p>" || contant_english=="" || contant_english=="<p><br></p>" || keywords_english=="" || abstract_website =="" || abstract_category==""  || abstract_type=="") )
        {
          alert("Lütfen eksik alan bırakmayınız !").stop();
          return false;
        }

        else if((abstract_language == "english")&&(abstract_sub_category==null || title=="" || title=="<p><br></p>" || contant=="" || contant=="<p><br></p>" || keywords=="" || abstract_website =="" || abstract_category==""  || abstract_type=="") )
        {
          alert("Lütfen eksik alan bırakmayınız !").stop();
          return false;
        }
        else{}

      if(author_num > 0){

        var deg_list=[] ;
        var deg_list_other=[];
        
      }
      else{

        var deg_list ;
        var deg_list_other;
      }

        var infos=[];
          
        
        for(i=1;i<author_num+1;i++){
          

          infos[0]= $("input[name=name_first"+i+"]").val();
          infos[1]= $("input[name=name_last"+i+"]").val();
          infos[2]= $("input[name=organization"+i+"]").val();
          infos[3]= $("input[name=email"+i+"]").val();

          if($("#s_yazar"+i).is(':checked') == true)
          {
            infos[4] = $("#s_yazar"+i).val();
          }
          else
          {}
          
          if((infos[0] !="" && infos[1] !="" && infos[2] !=""&& infos[3] !="") && (infos[0] != null  && infos[1] != null  && infos[2] != null && infos[3] != null ) ){

            
              if(i==infos[4]){

              
                for(b=0;b<infos.length;b++){

                  deg_list[b] = infos[b];

                
                }

         
               
              }
              else{

                if(author_num-1 >=1){
              
                deg_list_other.push([infos[0],infos[1],infos[2],infos[3]]);

              }

               

              }
              
          }

          

          else{

            alert("Lütfen eksik alan bırakmayınız !").stop();
            return false;

          }
        

      }

      $("button[name=gonder]").css("display", "none");
        $(".warning").css("display", "block");
    
        var main_author = JSON.stringify(deg_list);
        var other_author= JSON.stringify(deg_list_other);
        $.post("/abstract_save",
        {
          abstract_upload:1,
          register_id :0,
          contant     : contant, 
          main_author : main_author,
          other_author : other_author,
          abstract_website:abstract_website,
          abstract_category:abstract_category,
          abstract_sub_category:abstract_sub_category,
          accepted:0,
          alt_contact:alt_contact,
          abstract_type:abstract_type,
          abstract_language:abstract_language,
          title : title,
          contant : contant, 
          keywords:keywords,

          title_english : title_english,
          contant_english : contant_english, 
          keywords_english:keywords_english,

          supports:supports,
          comments:comments
        },
        function(data,status){

          $("button[name=gonder]").css("display", "block");
        $(".warning").css("display", "none");
          if(data == 1){
            

          alert("Bildiri başarıyla kaydedilmiştir.");
          }
          else{
          alert("Bildiri yüklenirken bir hata oluştu.");
          }
          setTimeout(function(){window.location.href='/admin_index?sayfa=my_abstracts&islem=index';},500);
        });
          
             
      }

    
          
    
    
    </script>



    <script type="text/javascript">

   
    var i = 0;
    // Add validation check
    $( "input[name=author_num]" )
  .keyup(function () {
    var html="";
    var author_num = parseInt($("input[name=author_num]").val());

    if(author_num > 0 && author_num < 20){
      for(b=1; b<author_num+1; b++){
     
       if(b==1){

        html+='<fieldset id="ocauthor'+b+'"><legend  style="color:red;"><?php echo $language[44];?> </legend><table class="field"><tr><td><label for="name_first'+b+'"><?php echo $language[45];?></label></td><td> <input name="name_first'+b+'" id="name_first'+b+'" size="60" maxlength="60" value=""></td></tr><tr><td><label for="name_last'+b+'"><?php echo $language[46];?></label></td><td><input name="name_last'+b+'" id="name_last'+b+'" size="60" maxlength="40" value=""></td></tr><tr><td> <label for="organization'+b+'"><?php echo $language[47];?></label></td><td><input name="organization'+b+'" id="organizatio'+b+'" size="60" maxlength="150" value=""></td></tr>';

     
        html+='<tr><td><label for="email'+b+'"><?php echo $language[48];?></label></td><td><input name="email'+b+'" id="email'+b+'" type="email" size="60" maxlength="100" value=""></td> </tr>             <tr><td><label for="s_yazar'+b+'"><?php echo $language[49];?></label></td><td><input type="radio" name="s_yazar"  id="s_yazar'+b+'" size="60" maxlength="100" value="'+b+'"></td> </tr></table></fieldset></br></br>';
        $( ".authors" ).html(html);

       }


       else{

      
        html+='<fieldset id="ocauthor'+b+'"><legend  style="color:red;"><?php echo $language[50];?>  '+b+'</legend><table class="field"><tr><td><label for="name_first'+b+'"><?php echo $language[51];?> </label></td><td> <input name="name_first'+b+'" id="name_first'+b+'" size="60" maxlength="60" value=""></td></tr><tr><td><label for="name_last'+b+'"><?php echo $language[52];?></label></td><td><input name="name_last'+b+'" id="name_last'+b+'" size="60" maxlength="40" value=""></td></tr><tr><td> <label for="organization'+b+'"><?php echo $language[53];?> </label></td><td><input name="organization'+b+'" id="organizatio'+b+'" size="60" maxlength="150" value=""></td></tr>';

     
        html+='<tr><td><label for="email'+b+'"><?php echo $language[54];?> </label></td><td><input name="email'+b+'" id="email'+b+'" type="email" size="60" maxlength="100" value=""></td> </tr>             <tr><td><label for="s_yazar'+b+'"><?php echo $language[55];?></label></td><td><input type="radio" name="s_yazar" id="s_yazar'+b+'" size="60" maxlength="100" value="'+b+'"></td> </tr></table></fieldset></br></br>';
        $( ".authors" ).html(html);
            
       }
      }
  }
    
    i++;
  });




  var tab = 0;
  
  $("div[name=abstract_category_div]").css("display","block");
  $("div[name=abstract_type]").css("display","block");
  $("div[name=authors]").css("display","none");
  $("div[name=abstract_lang_select]").css("display","none");
  $(".abstract_turkish_english").css("display", "none");
  $(".abstract_english").css("display", "none");
  $("div[name=alt_contact]").css("display","none");
  $("div[name=supports_and_comments]").css("display","none");

 function next(element)
 {

      if(tab<3)
      {
        tab+=1;

      }else{}

      $("span[name=pageindex]").text(tab+1);


      if(tab > 0 && tab !=3)
      {
        $("button[name=nextpage]").css("display","block");
        $("button[name=previouspage]").css("display","block");

      }
      else if(tab > 0 && tab == 3)
      {
        $("button[name=nextpage]").css("display","none");
        $("button[name=previouspage]").css("display","block");
      }
      else
      {
        $("button[name=nextpage]").css("display","block");
        $("button[name=previouspage]").css("display","none");

      }

      if(tab == 1)
      {
        $("div[name=abstract_category_div]").css("display","none");
        $("div[name=abstract_type]").css("display","none");
        $("div[name=authors]").css("display","block");
        $("div[name=abstract_lang_select]").css("display","none");
        $(".abstract_turkish_english").css("display", "none");
        $(".abstract_english").css("display", "none");
        $("div[name=alt_contact]").css("display","none");
        $("div[name=supports_and_comments]").css("display","none");
        
        
      }    

      if(tab == 2)
      {
        str="";
        $("div[name=abstract_category_div]").css("display","none");
        $("div[name=abstract_type]").css("display","none");
        $("div[name=authors]").css("display","none");
        $("div[name=abstract_lang_select]").css("display","block");
/////////////////////////////
        $( "select[name=abstract_lang_select] option:selected" ).each(function() {
          str += $( this ).val();
        });

        if(str =="turkish-english")
        {


          $(".abstract_turkish_english").css("display", "block");
          $(".abstract_english").css("display", "none");

        }
        else if(str =="english")
        {
          $(".abstract_turkish_english").css("display", "none");
          $(".abstract_english").css("display", "block");

        }
///////////////////////////////
        $("div[name=alt_contact]").css("display","none");
        $("div[name=supports_and_comments]").css("display","none");
      }

  

      if(tab == 3)
      {
        $("div[name=abstract_category_div]").css("display","none");
        $("div[name=abstract_type]").css("display","none");
        $("div[name=authors]").css("display","none");
        $("div[name=abstract_lang_select]").css("display","none");
        $(".abstract_turkish_english").css("display", "none");
        $(".abstract_english").css("display", "none");
        $("div[name=alt_contact]").css("display","block");
        $("div[name=supports_and_comments]").css("display","block");
      }

 }

 function previous(element)
 {
      if(tab >0)
      {
        tab -=1;

      }else{}

      $("span[name=pageindex]").text(tab+1);

      if(tab < 3 && tab !=0)
      {
        $("button[name=previouspage]").css("display","block");
        $("button[name=nextpage]").css("display","block");

      }
      else if(tab < 3 && tab == 0)
      {
        $("button[name=previouspage]").css("display","none");
        $("button[name=nextpage]").css("display","block");
      }
      else
      {
        $("button[name=previouspage]").css("display","block");
        $("button[name=nextpage]").css("display","none");
      }
      
      if(tab == 0)
      {
        $("div[name=abstract_category_div]").css("display","block");
        $("div[name=abstract_type]").css("display","block");
        $("div[name=authors]").css("display","none");
        $("div[name=abstract_lang_select]").css("display","none");
        $(".abstract_turkish_english").css("display", "none");
        $(".abstract_english").css("display", "none");
        $("div[name=alt_contact]").css("display","none");
        $("div[name=supports_and_comments]").css("display","none");
        
        
      }    
      if(tab == 1)
      {
        $("div[name=abstract_category_div]").css("display","none");
        $("div[name=abstract_type]").css("display","none");
        $("div[name=authors]").css("display","block");
        $("div[name=abstract_lang_select]").css("display","none");
        $(".abstract_turkish_english").css("display", "none");
        $(".abstract_english").css("display", "none");
        $("div[name=alt_contact]").css("display","none");
        $("div[name=supports_and_comments]").css("display","none");
        
        
      }    

      if(tab == 2)
      {
        str="";
        $("div[name=abstract_category_div]").css("display","none");
        $("div[name=abstract_type]").css("display","none");
        $("div[name=authors]").css("display","none");
        $("div[name=abstract_lang_select]").css("display","block");
/////////////////////////////
$( "select[name=abstract_lang_select] option:selected" ).each(function() {
          str += $( this ).val();
        });

        if(str =="turkish-english")
        {


          $(".abstract_turkish_english").css("display", "block");
          $(".abstract_english").css("display", "none");

        }
        else if(str =="english")
        {
          $(".abstract_turkish_english").css("display", "none");
          $(".abstract_english").css("display", "block");

        }
///////////////////////////////
        $("div[name=alt_contact]").css("display","none");
        $("div[name=supports_and_comments]").css("display","none");
      }

  

      if(tab == 3)
      {
        $("div[name=abstract_category_div]").css("display","none");
        $("div[name=abstract_type]").css("display","none");
        $("div[name=authors]").css("display","none");
        $("div[name=abstract_lang_select]").css("display","none");
        $(".abstract_turkish_english").css("display", "none");
        $(".abstract_english").css("display", "none");
        $("div[name=alt_contact]").css("display","block");
        $("div[name=supports_and_comments]").css("display","block");
      }

 }


 $( "select[name=abstract_lang_select]" )
  .change(function () {
    var str="";
    if(tab == 2)
    {
      $( "select[name=abstract_lang_select] option:selected" ).each(function() {
        str += $( this ).val();
      });

      if(str =="turkish-english")
      {


        $(".abstract_turkish_english").css("display", "block");
        $(".abstract_english").css("display", "none");

      }
      else if(str =="english")
      {
        $(".abstract_turkish_english").css("display", "none");
        $(".abstract_english").css("display", "block");

      }

 
    }
  })
  .change();



  var fixmeTop = $('.lower-pre-next').offset().top;       // get initial position of the element

$(window).scroll(function() {                  // assign scroll event listener

    var currentScroll = $(window).scrollTop(); // get current position

    if (currentScroll >= fixmeTop) {           // apply position: fixed if you
        $('.lower-pre-next').css({                      // scroll to that element or below it
          position: 'fixed',
          top:'0',
          left:'0',
        });
    } else {                                   // apply position: static
        $('.lower-pre-next').css({   
          
          position: 'relative',
          // if you scroll above it
       
        });
    }

});


  
    </script>


<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  </body>
</html>



















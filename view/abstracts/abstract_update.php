<html lang="en">
  <head>
  <meta charset="utf-8">
    <title><?php echo $language[0];?></title>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">


    <?php 

    
      echo  '<input type="hidden" name="update_abstract" value="'.$update_abstract["abstract_no"].'">';
      ?>
       
  </head>
  <body>
        
    

    <br>

    <label style = "margin-left:20px;" for="abstract_type"><?php echo $language[1];?></label>
    <select style = "margin-left:20px;" name="abstract_type" style="width:30%">

    <?php

      $data = $language[2];
      if($uye_dil =="tr")
      {
        
        for($i=0;$i<count($data[0]);$i++){


            if($update_abstract["abstract_type"] == $data[0][$i]){
                echo '<option value="'.$data[0][$i].'" selected>'.$data[0][$i].'</option>';
            }
            else{
                echo '<option value="'.$data[0][$i].'" >'.$data[0][$i].'</option>';
            }
        }
      }
      else
      {
        
        for($i=0;$i<count($data[0]);$i++){


            if($update_abstract["abstract_type"] == $data[0][$i]){
                echo '<option value="'.$data[0][$i].'" selected>'.$data[1][$i].'</option>';
            }
            else{
                echo '<option value="'.$data[0][$i].'" >'.$data[1][$i].'</option>';
            }
        }
      }
    ?>
      
    </select>
      <br>
    <label style = "margin-left:20px;" for="abstract_lang_select"><?php echo $language[3];?></label>
    <select style = "margin-left:20px;" name="abstract_lang_select">
      <option value="turkish-english" <?php if($update_abstract["abstract_language"] =="turkish-english"){echo "selected";}?>><?php echo $language[4];?></option>
      <option value="english" <?php if($update_abstract["abstract_language"] =="english"){echo "selected";}?>><?php echo $language[5];?></option>
    </select>

    <br>
    
    <label style = "margin-left:20px;" for="alt_contact"><?php echo $language[6];?></label>
    <input style = "margin-left:20px;" type="email" name="alt_contact" style="width:30%" value ="<?php echo $update_abstract["alt_contact"] ;?>" required>
    <br>

    <hr>


    <br>
    <div class="abstract_turkish_english" style="display:none; ">
      <label style = "margin-left:20px; width: calc(100% - 20px);" for="title"><?php echo $language[7];?></label>
      <textarea style = "margin-left:20px; resize:none;" id="summernotetitle" placeholder="Bildiri Başlığı (Türkçe)"name="title" required><?php echo $update_abstract["title"] ;?></textarea>
      <br>
      <label style = "margin-left:20px; width: calc(100% - 20px);" for="contant"><?php echo $language[8];?></label>
      <textarea style = "margin-left:20px; width: calc(100% - 20px);" id="summernote" name="contant" placeholder="Bildiri Özeti (Türkçe)"></textarea>
      <br>
      <label style = "margin-left:20px; width: calc(100% - 20px);" for="keywords"><?php echo $language[9];?></label><br>
      <input style = "margin-left:20px; width: calc(100% - 20px);" type="text" name="keywords" placeholder="<?php echo $language[10];?>" value="<?php echo $update_abstract["keywords"] ;?>">
      </br>
      <hr>
      </br>
      <label style = "margin-left:20px; width: calc(100% - 20px);" for="title_english"><?php echo $language[11];?></label>
      <textarea style = "margin-left:20px; width: calc(100% - 20px);" id="summernotetitle1" placeholder="Bildiri Başlığı (İngilizce)"name="title_english" required><?php echo $update_abstract["title_english"] ;?></textarea>
      <br>
      <label style = "margin-left:20px; width: calc(100% - 20px);" for="contant_english"><?php echo $language[12];?></label>
      <textarea style = "margin-left:20px; width: calc(100% - 20px);" id="summernote1" name="contant_english" placeholder="Bildiri Özeti (İngilizce)"></textarea>
      <br>
      <label style = "margin-left:20px; width: calc(100% - 20px);" for="keywords_english"><?php echo $language[13];?></label><br>
      <input style = "margin-left:20px; width: calc(100% - 20px);" type="text" name="keywords_english" placeholder="<?php echo $language[14];?>" value="<?php echo $update_abstract["keywords_english"] ;?>">
    </div>

    <div class="abstract_english" style="display:none;">
      <label style = "margin-left:20px; width: calc(100% - 20px);" for="title"><?php echo $language[15];?></label>
      <textarea style = "margin-left:20px; resize:none;" id="summernotetitle2" placeholder="Bildiri Başlığı (İngilizce)"name="title1" required><?php echo $update_abstract["title"] ;?></textarea>
      <br>
      <label style = "margin-left:20px; width: calc(100% - 20px);" for="contant"><?php echo $language[16];?></label>
      <textarea style = "margin-left:20px; width: calc(100% - 20px);" id="summernote2" name="contant1" placeholder="Bildiri Özeti (İngilizce)"></textarea>
      <br>
      <label style = "margin-left:20px; width: calc(100% - 20px);" for="keywords"><?php echo $language[17];?></label><br>
      <input style = "margin-left:20px; width: calc(100% - 20px);" type="text" name="keywords1" placeholder="<?php echo $language[18];?>" value="<?php echo $update_abstract["keywords"] ;?>">
    </div>

    <hr>
    <br>
    <label style = "margin-left:20px;" for="supports"><?php echo $language[19];?></label>
    <input style = "margin-left:20px;" type="text" name="supports" value ="<?php echo $update_abstract["supports"] ;?>" placeholder="<?php echo $language[20];?>">
    <br>
    <label style = "margin-left:20px;" for="comments"><?php echo $language[21];?></label>
    <textarea style = "margin-left:20px;" id="summernote1" name="comments" ><?php echo $update_abstract["comments"];?></textarea>
    <br>
    <button onclick="yazi_kaydet()" name="gonder"><?php echo $language[22];?></button>

    <h4 class="warning" style="
    color:red;
    text-align:center;
    visibility:hidden;
    "><?php echo $language[23];?></h4>
   
    





    <script>

      $("#summernote").summernote("destroy"); 
      $("#summernote").text( <?php echo json_encode($update_abstract["contant"]);?> );
      $('#summernote').summernote({
        emptyPara:"",
        placeholder: '<?php echo $language[24];?>',
        tabsize: 2,
        height: 120,
        toolbar: [['font', ['bold', 'italic','superscript','subscript','underline', 'clear']]],

      });


      $("#summernote1").summernote("destroy"); 
      $("#summernote1").text( <?php echo json_encode($update_abstract["contant_english"]);?> );
      $('#summernote1').summernote({
        placeholder: '<?php echo $language[25];?>',
        tabsize: 2,
        height: 120,
        toolbar: [['font', ['bold', 'italic','superscript','subscript','underline', 'clear']]],

      });
      

      $("#summernote2").summernote("destroy"); 
      $("#summernote2").text( <?php echo json_encode($update_abstract["contant"]);?> );
      $('#summernote2').summernote({
        placeholder: '<?php echo $language[26];?>',
        tabsize: 2,
        height: 120,
        toolbar: [['font', ['bold', 'italic','superscript','subscript','underline', 'clear']]],

      });


      $("#summernotetitle").summernote("destroy"); 
      $("#summernotetitle").text( <?php echo json_encode($update_abstract["title"]);?> );
      $('#summernotetitle').summernote({
        placeholder: '<?php echo $language[27];?>',
        tabsize: 2,
        height: 50,
        toolbar: [['font', ['bold', 'italic','superscript','subscript','underline', 'clear']]],


        
        focus: true,
        disableResizeEditor: true
        
      });



      $("#summernotetitle1").summernote("destroy"); 
      $("#summernotetitle1").text( <?php echo json_encode($update_abstract["title_english"]);?> );
      $('#summernotetitle1').summernote({
        placeholder: '<?php echo $language[28];?>',
        tabsize: 2,
        height: 50,
        toolbar: [['font', ['bold', 'italic','superscript','subscript','underline', 'clear']]],

        focus: true,
        disableResizeEditor: true
      });


      $("#summernotetitle2").summernote("destroy"); 
      $("#summernotetitle2").text( <?php echo json_encode($update_abstract["title"]);?> );
      $('#summernotetitle2').summernote({
        placeholder: '<?php echo $language[29];?>',
        tabsize: 2,
        height: 50,
        toolbar: [['font', ['bold', 'italic','superscript','subscript','underline', 'clear']]],

        focus: true,
        disableResizeEditor: true
      });


    </script>

    <script>
    
//////Yazı Ekle //////////
      function yazi_kaydet(){
 

        var update_abstract    = $("input[name=update_abstract]").val();
        var alt_contact        = $("input[name=alt_contact]").val();

        var abstract_language = $( "select[name=abstract_lang_select] option:selected" ).val();


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
        
        if((abstract_language == "turkish-english")&&( title=="<p><br></p>" || contant=="<p><br></p>" || keywords=="" || title_english=="<p><br></p>" || contant_english=="<p><br></p>" || keywords_english=="" || abstract_type=="") ){
          alert("Lütfen eksik alan bırakmayınız !").stop();
        }

        else if((abstract_language == "english")&&( title=="<p><br></p>" || contant=="<p><br></p>" || keywords=="" || abstract_type=="") ){
          alert("Lütfen eksik alan bırakmayınız !").stop();
        }

        $("button[name=gonder]").css("visibility", "hidden");
        $(".warning").css("visibility", "visible");

        $.post("/abstract_update",
        {
          abstract_update:1,
          abstract_no : update_abstract,

          accepted:0,
          alt_contact:alt_contact,
          abstract_type:abstract_type,
          abstract_language:abstract_language,
          title : title,
          contant : contant, 
          keywords:keywords,

          title_english : title_english,
          contant_english : contant_english, 
          keywords_english : keywords_english,

          supports:supports,
          comments:comments
        },
        function(data,status){
        $("button[name=gonder]").css("visibility", "visible");
        $(".warning").css("visibility", "hidden");
            if(data == 1){

            alert("Bildiri başarıyla kaydedilmiştir.");
            }
            else{
            alert("Bildiri yüklenirken bir hata oluştu.");
            }
            setTimeout(function(){window.location.href='/abstract_index?sayfa=my_abstracts&islem=index';},500);
        });
          
             
      }
          
    


      $( "select[name=abstract_lang_select]" )
     .change(function () {
      var str="";
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

  
      
    })
    .change();

    
    </script>




  </body>
</html>



















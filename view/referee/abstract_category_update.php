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
      for($i=0;$i<count($abstract_websites);$i++ ){
        $abstract_website_arr = json_decode($abstract_websites[$i]["abstract_website"]);
        
        $arrwebsite = explode(" ",$abstract_website_arr->{"tr"});
        $arr_yazi ="";
        for($a=0; $a<count($arrwebsite);$a++){

          $arr_yazi.=$arrwebsite[$a];          

        }
        echo '<input type="hidden" name="'.$arr_yazi.'"' ."value='".$abstract_websites[$i]["categories"]."'> ";
      } 
      echo '<input type="hidden" name="update_abstract"' ."value='".$update_abstract["abstract_no"]."'> ";
      echo '<input type="hidden" name="abstract_sub_category"' ."value='".$update_abstract["abstract_sub_category"]."'> ";
      ?>
       
  </head>
  <body>
          <label style = "margin:20px;" for="abstract_website"><?php echo $language[1];?></label>
        
    <select style = "margin-left:20px;" name="abstract_website" style="width:30%">

      <?php 

      echo '<option value="">'.$language[2].'</option>';

      for($i=0;$i<count($abstract_websites);$i++ ){

        $abstract_website_arr = json_decode($abstract_websites[$i]["abstract_website"]);

        if($abstract_website_arr->{"tr"}==$update_abstract["abstract_site"]) {

            echo '<option value="'.$abstract_website_arr->{"tr"}.'" selected>'.$abstract_website_arr->{$uye_dil}.'</option>';
        }

        else{

            echo '<option value="'.$abstract_website_arr->{"tr"}.'" >'.$abstract_website_arr->{$uye_dil}.'</option>';
        }

      }
        
      ?>
      
    </select>
    <br>
   
    <label style = "margin-left:20px;" class="abstract_categories_lbl" for="abstract_categories"><?php echo $language[3];?></label>
       

    <select style = "margin-left:20px;"name="abstract_categories" class="abstract_categories" style="width:30%">
        <?php
 $site_cat_html="";
      for($i=0;$i<count($abstract_websites);$i++ ){

        $abstract_website_arr = json_decode($abstract_websites[$i]["abstract_website"]);
        if($abstract_website_arr->{"tr"}==$update_abstract["abstract_site"]) {


            $site_cat_html.= '<option value="">'.$language[4].'</option>';
            $abstract_categories=json_decode($abstract_websites[$i]["categories"]);
        
            for($a=0;$a<count($abstract_categories->{"tr"});$a++){
              echo $abstract_categories->{"tr"}[$a][0]->{"category"};
                    if($update_abstract["abstract_category"] == $abstract_categories->{"tr"}[$a][0]->{"category"}){

                        $site_cat_html .= '<option value="'.$abstract_categories->{"tr"}[$a][0]->{"category"}.'" selected>'.$abstract_categories->{$uye_dil}[$a][0]->{"category"}.'</option>';
                 
                    }
                    else{
                        $site_cat_html .= '<option value="'.$abstract_categories->{"tr"}[$a][0]->{"category"}.'">'.$abstract_categories->{$uye_dil}[$a][0]->{"category"}.'</option>';
                    }

            }
    
          
        }

       
      }

        

            
      
              
           
      
echo $site_cat_html;
        ?>
    </select>

    <br>

    <label style="margin-left:20px;" class="abstract_sub_categories_lbl" for="abstract_categories"><?php echo $language[5];?></label>
    <div style="margin-left:20px;" name="abstract_sub_categories" class="radio" style="width:30%">
  <!--Alt kategoriler javascriptle yapılıyor-->
    </div>


      
      
    <br>

  
    <button name="gonder" onclick="yazi_kaydet()"><?php echo $language[6];?></button>
    <h4 class="warning" style="
    color:red;
    text-align:center;
    visibility:hidden;
    "><?php echo $language[7];?></h4>
   
    





    <script>
 
      var site;
      var uye_dil = "<?php echo $uye_dil; ?>";

      String.prototype.turkishToLower = function(){
	var string = this;
	var letters = { "İ": "i", "I": "ı", "Ş": "ş", "Ğ": "ğ", "Ü": "ü", "Ö": "ö", "Ç": "ç" };
	string = string.replace(/(([İIŞĞÜÇÖ]))/g, function(letter){ return letters[letter]; })
	return string.toLowerCase();
}	





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


    site_cat_html += '<option value=""><?php echo $language[8];?></option>';
    for(i=0; i<site_categories["tr"].length; i++){
      

        site_cat_html += '<option value="'+site_categories.tr[i][0].category+'">'+site_categories[uye_dil][i][0].category+'</option>';
     

    }

 
    $(".abstract_categories").html(site_cat_html);


    
  });
 



  $( "select[name=abstract_categories]" )
  .change(function () {

 
    let str_subcategories ="";
    $( "select[name=abstract_categories] option:selected" ).each(function() {
      str_subcategories += $( this ).val();
    });
    //////////////////////////////
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
   //////////////////////////////
    var site_categories = JSON.parse(site);
    
    site_cat_html="";


    var i;
    var newstr;
    for(i=0; i<site_categories.tr.length; i++){
      

      for(k=0;k<site_categories.tr[i].length;k++){

        if(site_categories.tr[i][k].category == str_subcategories){

          newstr = i;
          break;
        }
        else{
          
        }
      }
       
     

    }
    abstract_sub_category = $("input[name=abstract_sub_category").val();
    for(k=1;k<site_categories.tr[newstr].length;k++){

      if(abstract_sub_category ==site_categories.tr[newstr][k]){

        site_cat_html +=   '<label style="margin-left:20px;"><input type="radio" name="abstract_sub_check" style="margin-left:20px;" value="'+site_categories.tr[newstr][k] +'" checked>&nbsp;'+site_categories[uye_dil][newstr][k] +'</label><br/>';

      }
      else{
        site_cat_html +=   '<label style="margin-left:20px;"><input type="radio" name="abstract_sub_check" style="margin-left:20px;" value="'+site_categories.tr[newstr][k] +'">&nbsp;'+site_categories[uye_dil][newstr][k] +'</label><br/>';

      }
     
    }
    $("div[name=abstract_sub_categories]").html(site_cat_html);

    
  })
  .change();
    </script>

    <script>
    
//////Yazı Ekle //////////
      function yazi_kaydet(){
        var update_abstract    = $("input[name=update_abstract]").val();
        var abstract_website  = $("select[name=abstract_website] option:selected").val();
        var abstract_category  = $("select[name=abstract_categories] option:selected").val();
        var abstract_sub_category = $("input[name=abstract_sub_check]:checked").val();



        if(abstract_sub_category==null || abstract_category==""  || abstract_website==""){
          alert("Lütfen eksik alan bırakmayınız !").stop();
        }

    

      $("button[name=gonder]").css("visibility", "hidden");
        $(".warning").css("visibility", "visible");
    

        $.post("/abstract_category_update",
        {
          abstract_update:1,
          abstract_no:update_abstract,
          abstract_website:abstract_website,
          abstract_category:abstract_category,
          abstract_sub_category:abstract_sub_category,
       
        },
        function(data,status){

          $("button[name=gonder]").css("visibility", "visible");
        $(".warning").css("visibility", "hidden");
          if(data == 1){
            

          alert("Kategori başarıyla güncellenmiştir.");
          }
          else{
          alert("Kategori güncellenirken bir hata oluştu.");
          }
          setTimeout(function(){window.location.href='/referee_index?sayfa=my_abstracts&islem=index';},500);
        });
          
             
      }
          
    
    
    </script>


  </body>
</html>



















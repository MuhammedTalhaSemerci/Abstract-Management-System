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
   
        echo '<input type="hidden" name="update_abstract"' ."value='".$update_abstract["abstract_no"]."'> ";
    

      ?>
       
  </head>
  <body>
   
 
    <br>

    <br>

  
    <label style = "margin-left:20px;" for="author_num"><?php echo $language[1];?></label>
    <input style = "margin-left:20px;"  type="number" name="author_num" id="author_num" value="<?php if(isset($update_abstract["other_author"]) && is_array(json_decode($update_abstract["other_author"]))){echo count(json_decode($update_abstract["other_author"]))+1;}else{echo 1;}?>" style="width:30%" placeholder="<?php echo $language[2];?>"/>
    <div style = "margin-left:20px;" class="authors" style="width:50%">
    
    <?php
    
    $abstract_main_author=json_decode($update_abstract["main_author"]);

    $abstract_authors = json_decode($update_abstract["other_author"]);


    array_splice($abstract_authors,intval($abstract_main_author[4])-1,0,[$abstract_main_author]);
  
    $html = '';

        for($a=1;$a<count($abstract_authors)+1;$a++){


          $html .='<fieldset id="ocauthor'.$a.'"><legend  style="color:red;">'.$language[3].' '.$a.'</legend><table class="field"><tr><td><label for="name_first'.$a.'">'.$language[4].'</label></td><td> <input name="name_first'.$a.'" id="name_first'.$a.'" size="60" maxlength="60" value="'.$abstract_authors[$a-1][0].'"></td></tr><tr><td><label for="name_last'.$a.'">'.$language[5].'</label></td><td><input name="name_last'.$a.'" id="name_last'.$a.'" size="60" maxlength="40" value="'.$abstract_authors[$a-1][1].'"></td></tr><tr><td> <label for="organization'.$a.'">'.$language[6].'</label></td><td><input name="organization'.$a.'" id="organizatio'.$a.'" size="60" maxlength="150" value="'.$abstract_authors[$a-1][2].'"></td></tr>';

     
          $html .='<tr><td><label for="email'.$a.'">'.$language[7].'</label></td><td><input name="email'.$a.'" id="email'.$a.'" type="email" size="60" maxlength="100" value="'.$abstract_authors[$a-1][3].'"></td> </tr>       <tr><td><label for="s_yazar'.$a.'">'.$language[8].'</label></td><td><input type="radio" name="s_yazar"  id="s_yazar'.$a.'" size="60" maxlength="100" value="'.$a.'" '; if(intval($abstract_authors[$a-1][4]) == $a ){$html.= "checked";} $html.='></td> </tr>       </table></fieldset></br></br>';


      
    }
    echo $html;
    ?>

    </div>
    <br>



    <button name="gonder" onclick="yazi_kaydet()"><?php echo $language[9];?></button>
    <h4 class="warning" style="
    color:red;
    text-align:center;
    visibility:hidden;
    "><?php echo $language[10];?></h4>
   
    






    <script>
    
//////Yazı Ekle //////////
      function yazi_kaydet(){
   

  

        var update_abstract    = $("input[name=update_abstract]").val();
        var author_num         = parseInt($("input[name=author_num]").val());

      

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
          
          if(infos[0] !="" && infos[1] !="" && infos[2] !=""&& infos[3] !=""){

            
            if(i==infos[4]){

                          
              for(b=0;b<infos.length;b++){

                deg_list[b] = infos[b];


              }



            }
            else
            {

              if(author_num-1 >=1){

              deg_list_other.push([infos[0],infos[1],infos[2],infos[3]]);

              }



            }
              
          }

          

          else{

            alert("Lütfen eksik alan bırakmayınız !").stop();
          }
        

      }

      $("button[name=gonder]").css("visibility", "hidden");
        $(".warning").css("visibility", "visible");
    
        var main_author = JSON.stringify(deg_list);
        var other_author= JSON.stringify(deg_list_other);
        $.post("/abstract_author_update",
        {
          abstract_update:1,
          abstract_no : update_abstract,

          main_author : main_author,
          other_author : other_author,
       
        },
        function(data,status){

          $("button[name=gonder]").css("visibility", "visible");
        $(".warning").css("visibility", "hidden");
          if(data == 1){
            

          alert("Yazarlar başarıyla güncellenmiştir.");
          }
          else{
          alert("Yazarlar güncellenirken bir hata oluştu.");
          }
          setTimeout(function(){window.location.href='/editor_index?sayfa=my_abstracts&islem=index';},500);
        });
          
             
      }
          
    
    
    </script>




    <script type="text/javascript">

   
    var i = 0;
    // Add validation check
    $( "input[name=author_num]" )
  .change(function () {

    if(i==0){
      i+=1;
    }

    else{
      
    var html="";
    var author_num = parseInt($("input[name=author_num]").val());

    if(author_num > 0 && author_num < 20){
      for(b=1; b<author_num+1; b++){
     
       if(b==1){

        html+='<fieldset id="ocauthor'+b+'"><legend  style="color:red;"><?php echo $language[11]?> </legend><table class="field"><tr><td><label for="name_first'+b+'"><?php echo $language[12]?></label></td><td> <input name="name_first'+b+'" id="name_first'+b+'" size="60" maxlength="60" value=""></td></tr><tr><td><label for="name_last'+b+'"><?php echo $language[13]?></label></td><td><input name="name_last'+b+'" id="name_last'+b+'" size="60" maxlength="40" value=""></td></tr><tr><td> <label for="organization'+b+'"><?php echo $language[14]?></label></td><td><input name="organization'+b+'" id="organizatio'+b+'" size="60" maxlength="150" value=""></td></tr>';

     
        html+='<tr><td><label for="email'+b+'"><?php echo $language[15]?></label></td><td><input name="email'+b+'" id="email'+b+'" type="email" size="60" maxlength="100" value=""></td> </tr>         <tr><td><label for="s_yazar'+b+'"><?php echo $language[16]?></label></td><td><input type="radio" name="s_yazar"  id="s_yazar'+b+'" size="60" maxlength="100" value="'+b+'"></td> </tr>    </table></fieldset></br></br>';
        $( ".authors" ).html(html);

       }


       else{


        html+='<fieldset id="ocauthor'+b+'"><legend  style="color:red;"><?php echo $language[17]?> '+b+'</legend><table class="field"><tr><td><label for="name_first'+b+'"><?php echo $language[18]?></label></td><td> <input name="name_first'+b+'" id="name_first'+b+'" size="60" maxlength="60" value=""></td></tr><tr><td><label for="name_last'+b+'"><?php echo $language[19]?></label></td><td><input name="name_last'+b+'" id="name_last'+b+'" size="60" maxlength="40" value=""></td></tr><tr><td> <label for="organization'+b+'"><?php echo $language[20]?></label></td><td><input name="organization'+b+'" id="organizatio'+b+'" size="60" maxlength="150" value=""></td></tr>';

     
        html+='<tr><td><label for="email'+b+'"><?php echo $language[21]?></label></td><td><input name="email'+b+'" id="email'+b+'" type="email" size="60" maxlength="100" value=""></td> </tr>      <tr><td><label for="s_yazar'+b+'"><?php echo $language[22]?></label></td><td><input type="radio" name="s_yazar"  id="s_yazar'+b+'" size="60" maxlength="100" value="'+b+'"></td> </tr>    </table></fieldset></br></br>';
          $( ".authors" ).html(html);
            
       }
      }
  }
    
  

    
  }
  })
  .change();
    </script>
  </body>
</html>



















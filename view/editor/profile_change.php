

<!DOCTYPE html>

<html>

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie-edge" />
    <title>8. Uluslararası Katılımlı Bitki Koruma Kongresi</title>
	
	<meta name="author" content="nutuva.com">
<meta class="viewport" name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

	
 <script src="https://kit.fontawesome.com/a9da6c256f.js" crossorigin="anonymous"></script>
<link rel="shortcut icon" type="image/png" href="images/favicon/favicon-32x32.png"/>
<link rel="apple-touch-icon" sizes="57x57" href="images/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="images/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="images/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="images/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="images/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="images/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="images/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="images/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
<link rel="manifest" href="images/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

	
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


 
    <style>
        a {
            text-decoration: none;
            background-color: transparent;
        }

        .giris {
            color: #000 !important;
        }
    </style>
	
	
	<script src="view/js/mobilemask.debug.js" type="text/javascript"></script>

	
</head>
<body>
   
<script src="http://www.turkpediatri.tv/ScriptResource.axd?d=D9drwtSJ4hBA6O8UhT6CQsfET3aMp3eabpLVvNadVeUyv674QlzjrfqaLgn56pxal_fZbX66eNQtuwBr0YX-KsxLs_uDNmv9QIHDTN8fWwwFaDFUvxicxontNjrxYeE0VCf3Xj7rGqLE92Tbq1UJKOGLM781&amp;t=ffffffffce034dab" type="text/javascript"></script>






			
		

		<!-- Modal -->
			<div >
			
				<div class="modal-dialog" role="document">
					<div class="modal-content">
                    <a style="margin-left:20px;" href="/editor_index?sayfa=all_users&value=getall">Bir önceki sayfaya git</a>

						<div class="modal-header">
                			<h5 class="modal-title" id="exampleModalLabel">Profil Düzenleme Sayfası</h5>
							
							
						</div>
						
						
						<div class="modal-body">
                        
                        <label for="authority">Üye yetkisi: </label>
                    <?php
                        if(intval($user_index["uye_yetki"]) == 3)
                        {
                            echo'<font color="red">Bu üyenin yetkisi değiştirilemez.</font>';
                        }
                        else
                        {
                        
                        echo '<select name="authority" id="">';

                                echo '<option value="id='.$user_index["id"].'&uye_yetki=0"';if(intval($user_index["uye_yetki"]) == 0){echo "selected";} echo'>Katılımcı Yetkisi</option>';
                                echo '<option value="id='.$user_index["id"].'&uye_yetki=1"';if(intval($user_index["uye_yetki"]) == 1){echo "selected";} echo'>Editör Yetkisi</option>';
                                echo '<option value="id='.$user_index["id"].'&uye_yetki=2"';if(intval($user_index["uye_yetki"]) == 2){echo "selected";} echo'>Bilim Kurulu Üye Yetkisi</option>';
                           
                        echo '</select>';
                        }

                    ?>
                <br>

                <label for="withdrawal_state">Ücret ödeme durumu: </label>
                    <?php
    
                        //kongrelere göre işlem yapmak için burası düzenlenecek.
                        $withdrawal= json_decode($user_index["withdrawals"]);
                        if(is_array($withdrawal)){
                        $withdrawal = $withdrawal[0][3];

                        if(intval($user_index["uye_yetki"]) == 3)
                        {
                            echo'<font color="red">Bu üyenin ödeme bilgisine erişilemez.</font>';
                        }
                        else
                        {
                        
                        echo '<select name="withdrawal_state" id="">';

                            echo '<option value="id='.$all_users[$i]["id"].'&withdrawal=0"';if(intval($withdrawal) == 0){echo "selected";} echo'>Ödeme yapılmadı</option>';
                            echo '<option value="id='.$all_users[$i]["id"].'&withdrawal=1"';if(intval($withdrawal) == 1){echo "selected";} echo'>Ödeme yapıldı</option>'; 
                            echo '<option value="id='.$all_users[$i]["id"].'&withdrawal=2"';if(intval($withdrawal) == 2){echo "selected";} echo'>Ödeme geçersiz</option>'; 

                           
                        echo '</select>';
                        }
                    }
                    else{

                        echo'<font color="red">Bu üyenin kongre kaydı bulunmamaktadır.</font>';
                    }


                    if(isset($_GET["authority_state"]))
                    {
                        if($_GET["authority_state"] == "true")
                        {
                            echo '<font color="green">Yetki başarıyla güncellendi.</font>';
                        }
                        else if($_GET["authority_state"] == "false")
                        {
                            echo "<font color='red'>Yetki güncellenirken bir hata oluştu.</font>";
                        }
                    }
                    ?>





<br><br>

	<form action="/editor_user_update?id=<?php echo $user_index["id"];?>" method="POST">
		<label>* Ad</label>
		<input class="form-control" type="text" value="<?php echo $user_index["uye_adi"] ;?>" name="kadi" onchange="toUpper(this)" onkeyup="toUpper(this)" style="width:100%;" required>
       
        <label>* Soyad</label>
		<input class="form-control" type="text" value="<?php echo $user_index["uye_soyadi"] ;?>" name="ksoyadi" onchange="toUpper(this)" onkeyup="toUpper(this)" style="width:100%;" required>
								
		<label>* Cep Telefonu</label>
		<input name="tel" type="text" value="<?php echo $user_index["uye_tel"] ;?>" id="ContentPlaceHolder2_txtCepTelefonu" class="form-control" placeholder="(5xx) xxx xx xx" / required>
								
		<label>Şehir</label>
		<select name="sehir" class="form-control" type="text" >
		<option value="">Seçiniz</option>


        <?php
        
        $sehirler = ["Adana","Adiyaman","Afyon","Agri","Aksaray","Amasya","Ankara","Antalya","Ardahan","Artvin","Aydin","Balikesir","Bartin","Batman","Bayburt","Bilecik","Bingol","Bitlis","Bolu","Burdur","Bursa","Canakkale","Cankiri","Corum","Denizli","Diyarbakir","Duzce","Edirne","Elazig","Erzincan","Erzurum","Eskisehir","Gaziantep","Giresun","Gumushane","Hakkari","Hatay","Igdir","Isparta","Istanbul","Izmir","Kahramanmaras","Karabuk","Karaman","Kars","Kastamonu","Kayseri","Kilis","Kirikkale","Kirklareli","Kirsehir","Kocaeli","Konya","Kutahya","Malatya","Manisa","Mardin","Mersin","Mugla","Mus","Nevsehir","Nigde","Ordu","Osmaniye","Rize","Sakarya","Samsun","Sanliurfa","Siirt","Sinop","Sirnak","Sivas","Tekirdag","Tokat","Trabzon","Tunceli","Usak","Van","Yalova","Yozgat","Zonguldak"];

            if($user_index["uye_sehir"] == 'Türkiye Dışı')
            {
                echo '<option value="Türkiye Dışı" selected>Türkiye Dışı</option>';
            }
            else
            {
                echo '<option value="Türkiye Dışı" >Türkiye Dışı</option>';
            }

            for($i=0;$i<count($sehirler);$i++){

                if($sehirler[$i] == $user_index["uye_sehir"]){
                    echo '<option value="'.$sehirler[$i].'" selected>'.$sehirler[$i].'</option>';
                }
               else{
                echo '<option value="'.$sehirler[$i].'">'.$sehirler[$i].'</option>';
               }
            }
        
        ?>

		</select>
				
		
		<label>Ünvan</label>
		<select name="unvan" class="form-control" type="text" >
        <option value="Yok">Se&#231;iniz</option>
        <?php

            $unvan = ["Öğrenci","Asistan","Dr.","Dr. Öğr. Gör.","Doç. Dr.","Prof. Dr."];

            for($i=0;$i<count($unvan);$i++){

               if($unvan[$i]==$user_index["uye_unvan"]){
                echo '<option value="'.$unvan[$i].'" selected>'.$unvan[$i].'</option>';
               }
               else{
                echo '<option value="'.$unvan[$i].'">'.$unvan[$i].'</option>';
               }
            }

        ?>

	
	

		
		</select>	
        
        
        
	
<label for="uye_turu">* Uyelik Türü</label>
        <select  class="form-control" name="uye_turu" required>

            <option value="" >Seçim Yapın</option>
            <option value="Kongre Katılımcısı" <?php if($user_index["uye_turu"] == "Kongre Katılımcısı"){echo "selected";}?>>Kongre Katılımcısı</option>
            <option value="Hakem" <?php if($user_index["uye_turu"] =="Hakem"){echo "selected";}?>>Bilim Kurulu Üyesi</option>

        </select>

  
    <label class="referee_website_lbl" for="referee_website">Kongre seçin.</label>
        
    <select class="form-control referee_website"  name="referee_website" >

    <?php 
    $user_referee_state ="";
    if($user_index["referee_category"] != null)
    {
        $user_referee_state = json_decode($user_index["referee_category"]);
        echo '<option value="">Seçim Yapın</option>';

        for($i=0;$i<count($abstract_websites);$i++ ){

            $abstract_website_arr = json_decode($abstract_websites[$i]["abstract_website"]);
            if($abstract_website_arr->{"tr"}==$user_referee_state[0]) {

                echo '<option value="'.$abstract_website_arr->{"tr"}.'" selected>'.$abstract_website_arr->{$uye_dil}.'</option>';
            }

            else{

                echo '<option value="'.$abstract_website_arr->{"tr"}.'" >'.$abstract_website_arr->{$uye_dil}.'</option>';
            }

        }
    }
    else
    {
        echo '<option value="">Seçim Yapın</option>';
        
        for($i=0;$i<count($abstract_websites);$i++ ){

            
            echo '<option value="'.$abstract_website_arr->{"tr"}.'" >'.$abstract_website_arr->{$uye_dil}.'</option>';
            
    
        }
    }

?>


    <?php

    ?>
      
    </select>
    <br>
   
    <label  class="referee_categories_lbl" for="referee_categories">Kategori seçin</label>
       
    <select  name="referee_categories" class="form-control referee_categories" >
      <?php 
       if($user_index["referee_category"] != null)
       {

           $user_referee_state = json_decode($user_index["referee_category"]);
           
            $site_cat_html="";
            for($i=0;$i<count($abstract_websites);$i++ ){
                $congress_website_arr = json_decode($abstract_websites[$i]["abstract_website"]);

                if($congress_website_arr->{"tr"}==$user_referee_state[0]) {


                    $site_cat_html.= '<option value="">Seçim Yapın</option>';
                    $congress_categories=json_decode($abstract_websites[$i]["categories"]);
    
                    for($a=0;$a<count($congress_categories->{"tr"});$a++){

                        if($user_referee_state[1] == $congress_categories->{"tr"}[$a][0]->{"category"}){

                            $site_cat_html .= '<option value="'.$congress_categories->{"tr"}[$a][0]->{"category"}.'" selected>'.$congress_categories->{$uye_dil}[$a][0]->{"category"}.'</option>';
                        
                        }
                        else{
                            $site_cat_html .= '<option value="'.$congress_categories->{"tr"}[$a][0]->{"category"}.'">'.$congress_categories->{$uye_dil}[$a][0]->{"category"}.'</option>';
                        }

                    }

                    
                }

                else{

                }

            }

            

                
            
                    
                
            
            echo $site_cat_html;
        }

      ?>
    </select>

    <br>

    <label class="referee_sub_categories_lbl" for="referee_categories" > Alt kategori seçin.</label>
    <div    name="referee_sub_categories" class="radio referee_sub_categories" ></div>

       
        <label>* Uzmanlik</label>
		<input class="form-control" type="text" value="<?php echo $user_index["uye_uzmanlik"] ;?>"  name="uzmanlik" required>
											
		<label>* Kurum</label>
		<input class="form-control" type="text" value="<?php echo $user_index["uye_kurum"] ;?>"  name="kurum" required>
				

	
    
							
							
								<br>
		<button type="submit" class="btn btn-success"><i class="fas fa-user-plus"></i>&nbsp;&nbsp;Profili Güncelle</button>
		
		</form>
		
						</div>
						
						<?php
                        
                        if(isset($_GET["status"])){

                            if($_GET["status"] == "true"){
                                echo '<h6>Profil başarılı bir şekilde güncellendi.</h6>';
                            }
                            else {
                                echo '<h6>Profil güncellenirken bir hata oluştu.</h6>';
                            }

                        }
                    
   

                
                        ?>
						
	
						
					</div>
				</div>
			
			</div>

			
		

	
        
		


	<script src="js/jquery.mask.min.js"></script>
<script>
        function pageLoad(sender, args) {
            $(ContentPlaceHolder2_txtCepTelefonu).mask("(500) 000 00 00", { clearIfNotMatch: true });
        }
</script>
    <style>
        .calisan {
            padding: 5px;
            color: #fff;
        }
    </style>

		  
<section style="z-index:-1;" >



<div class="wave wave1"></div>
<div class="wave wave2"></div>
<div class="wave wave3"></div>
<div class="wave wave4"></div>
</section>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
	



    <script>

myFunction = function(x) {
    var y ;
     if (confirm("Bildirinizi silmek istediğinizden emin misiniz ?") == true) {
        setTimeout(function(){window.location.href='abstract_delete?id='+x;},10);
     } else {
         y = "Bildiri silme işleminiz iptal edildi!";
         alert(y); 
     }
    
}


value=0;

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



$( "select[name=authority]" )
  .change(function () {

    if(value<=2){

        value+=1;

    }

    if(value>1){


        var y ;
        if (confirm("Yetki değişimi yapmak istediğinizden emin misiniz ?") == true) {
            
            let str ="";
            $( "select[name=authority] option:selected" ).each(function() {
            str += $( this ).val();
            });
            
            postForm('/editor_authority_change?'+str, {value:str});


        }

        else 
        {
            y = "Yetki değiştirme işlemi iptal edildi!";
            alert(y); 
        }


    }
        



    
    
    
  }).change();



  value1=0;

  $( "select[name=withdrawal_state]" )
  .change(function () {

    if(value1<=2){

        value1+=1;

    }

    if(value1>1){

    let str ="";
        $( "select[name=withdrawal_state] option:selected" ).each(function() {
        str += $( this ).val();
        });
        
        postForm('/editor_withdrawal_update?'+str, {value:str});


    }
    
    
  }).change();


</script>


<script>
var site;
var uye_dil = "<?php echo $uye_dil; ?>";


	


<?php 
        if($user_index["referee_category"] == null)
        {
            echo '
            $(".referee_website_lbl").css("display", "none");
            $(".referee_website").css("display", "none");
            $(".referee_categories").css("display", "none");
            $(".referee_categories_lbl").css("display", "none");
            $(".referee_sub_categories").css("display", "none");
            $(".referee_sub_categories_lbl").css("display", "none");
            $("input[name=referee_sub_categories]").css("display", "none");';
        }
        else
        {
            echo '
            $(".referee_website_lbl").css("display", "block");
            $(".referee_website").css("display", "block");
            $(".referee_categories").css("display", "block");
            $("input[name=referee_sub_categories]").css("display", "block");';
        }

    ?>
	
$( "select[name=uye_turu]" )
.change(function () {

   	
var str = "";
$( "select[name=uye_turu] option:selected" ).each(function() {
str += $( this ).val();
});

str = str.split(" ");
newstr="";
for(i=0;i<str.length;i++){
newstr += str[i];

}

if(newstr =="Hakem"){


$(".referee_website_lbl").css("display", "block");
$(".referee_website").css("display", "block");
$(".referee_website").attr("required", "true");
$(".referee_categories").html(site_cat_html);

}

else{

    $(".referee_website_lbl").css("display", "none");
$(".referee_website").css("display", "none");
$(".referee_categories").css("display", "none");
$(".referee_categories_lbl").css("display", "none");
$(".referee_sub_categories").css("display", "none");
$(".referee_sub_categories_lbl").css("display", "none");
$("input[name=referee_sub_categories]").css("display", "none");

$('.referee_website').removeAttr('required');
$('.referee_categories').removeAttr('required');
$('.referee_sub_categories').removeAttr('required');
$('input[name=referee_sub_check]').removeAttr('required');




}


});



$( "select[name=referee_website]" )
.change(function () {

$('.referee_categories').removeAttr('required');
$('.referee_sub_categories').removeAttr('required');
$('input[name=referee_sub_check]').removeAttr('required');

$("input[name=referee_sub_categories]").css("display", "none"); 
var str = "";
$( "select[name=referee_website] option:selected" ).each(function() {
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


site_cat_html += '<option value="">Seçim Yapın</option>';
for(i=0; i<site_categories.tr.length; i++){


  site_cat_html += '<option value="'+site_categories.tr[i][0].category+'">'+site_categories[uye_dil][i][0].category+'</option>';


}

$(".referee_categories_lbl").css("display", "block");
$(".referee_categories").css("display", "block");
$(".referee_categories").attr("required", "true");
$(".referee_categories").html(site_cat_html);



});










$( "select[name=referee_categories]" )
.change(function () {

$('.referee_sub_categories').removeAttr('required');
$('input[name=referee_sub_check]').removeAttr('required');

let str = "";
let str_subcategories ="";
$( "select[name=referee_categories] option:selected" ).each(function() {
str_subcategories += $( this ).val();
});

///php uyarısı


str='<?php echo json_decode($abstract_websites[0]["abstract_website"])->{"tr"};?>';

str = str.split(" ");
newstr="";
for(i=0;i<str.length;i++){
newstr += str[i];

}

site = $("input[name="+newstr+"]").val();

var site_categories = JSON.parse(site);

site_cat_html="";


var i;
var newstr;
for(i=0; i<site_categories.tr.length; i++){


    for(k=0;k<site_categories.tr[i].length;k++){

        if(site_categories.tr[i][k].category == str_subcategories){

            newstr = i;
            console.log(newstr);
        }
        else{
            
        }
    }
    


}

//php uyarısıı
referee_sub_category = '<?php  if(is_array($user_referee_state)){echo $user_referee_state[2];}?>';

for(k=1;k<site_categories.tr[newstr].length;k++){

    if(referee_sub_category ==site_categories.tr[newstr][k]){

    site_cat_html +=   '<label style="margin-left:20px;"><input type="radio" name="referee_sub_check" style="margin-left:20px;" value="'+site_categories.tr[newstr][k] +'" checked>&nbsp;'+site_categories[uye_dil][newstr][k] +'</label><br/>';

    }
    else{
    site_cat_html +=   '<label style="margin-left:20px;"><input type="radio" name="referee_sub_check" style="margin-left:20px;" value="'+site_categories.tr[newstr][k] +'">&nbsp;'+site_categories[uye_dil][newstr][k] +'</label><br/>';

    }
}
$(".referee_sub_categories").css("display", "block");
$(".referee_sub_categories_lbl").css("display", "block");
$("div[name=referee_sub_categories]").html(site_cat_html);

$("input[name=referee_sub_check]").attr("required", "true");


})
.change();
</script>



	
</body>

</html>

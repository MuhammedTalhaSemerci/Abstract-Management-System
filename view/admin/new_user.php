

<!DOCTYPE html>

<html>

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
	

 
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


			
		

		<!-- Modal -->
			<div >
			
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Üye Ekle</h5>
							
							
						</div>
						
						
						<div class="modal-body">

                            
							<form action="/admin_new_user_save" method="POST">

        <label>* Bursluluk</label>
        <span style="color: #000;"><input  type="radio" name="bursluluk"  /></span><br>

        <label>* Bursluluk Açıklaması</label><br>
        <textarea name="burslulukaciklama" style="width:100%;" ></textarea><br>

		<label>* Ad </label>
		<input class="form-control" type="text" name="kadi" onchange="toUpper(this)" onkeyup="toUpper(this)" style="width:100%;" required>


		<label>* Soyad</label>
		<input class="form-control" type="text" name="ksoyadi" onchange="toUpper(this)" onkeyup="toUpper(this)" style="width:100%;" required>
						
		<label>* Cep Telefonu</label>
		<input name="tel" type="text" id="ContentPlaceHolder2_txtCepTelefonu" class="form-control" placeholder="(5xx) xxx xx xx" / required>
								
		<label>* Şehir</label>
		<select name="sehir" class="form-control" type="text" >
		<option value="">Seçim Yapın</option>
		<option value="Türkiye Dışı">Türkiye Dışı</option>
		
	<?php
	
	$sehirler = ["Adana","Adiyaman","Afyon","Agri","Aksaray","Amasya","Ankara","Antalya","Ardahan","Artvin","Aydin","Balikesir","Bartin","Batman","Bayburt","Bilecik","Bingol","Bitlis","Bolu","Burdur","Bursa","Canakkale","Cankiri","Corum","Denizli","Diyarbakir","Duzce","Edirne","Elazig","Erzincan","Erzurum","Eskisehir","Gaziantep","Giresun","Gumushane","Hakkari","Hatay","Igdir","Isparta","Istanbul","Izmir","Kahramanmaras","Karabuk","Karaman","Kars","Kastamonu","Kayseri","Kilis","Kirikkale","Kirklareli","Kirsehir","Kocaeli","Konya","Kutahya","Malatya","Manisa","Mardin","Mersin","Mugla","Mus","Nevsehir","Nigde","Ordu","Osmaniye","Rize","Sakarya","Samsun","Sanliurfa","Siirt","Sinop","Sirnak","Sivas","Tekirdag","Tokat","Trabzon","Tunceli","Usak","Van","Yalova","Yozgat","Zonguldak"];

	for($i=0;$i<count($sehirler);$i++){

		echo '<option value="'.$sehirler[$i].'">'.$sehirler[$i].'</option>';
	   
	}
	
	?>
		
		</select>
				
		
		<label>* Ünvan</label>
		<select name="unvan" class="form-control" type="text" >
		<option value="">Seçim Yapın</option>
		
        <?php

            $unvan = ["Öğrenci","Asistan","Dr.","Dr. Öğr. Gör.","Doç. Dr.","Prof. Dr.","Mühendis"];
            if($uye_dil =="tr")
            {
                for($i=0;$i<count($unvan);$i++){

                    //echo '<option value="'.$unvan[0][$i].'">'.$unvan[0][$i].'</option>';
                    echo '<option value="'.$unvan[$i].'">'.$unvan[$i].'</option>';

                
                }
            }
            else
            {
             
                for($i=0;$i<count($unvan);$i++){
                    echo '<option value="'.$unvan[$i].'">'.$unvan[$i].'</option>';

                   // echo '<option value="'.$unvan[0][$i].'">'.$unvan[1][$i].'</option>';
                
                }
             
            }
        ?>
	
		
		</select>		

		<label>* Uzmanlık</label>
		<input class="form-control" type="text" name="uzmanlik" required>
									
		<label>* Kurum</label>
		<input class="form-control" type="text" name="kurum" required>

        <label for="uye_turu">* Üyelik Türü</label>
        <select  class="form-control" name="uye_turu" required>

            <option value="" selected>Seçim Yapın</option>
            <option value="Kongre Katılımcısı">Kongre Katılımcısı</option>
            <option value="Hakem">Bilim Kurulu Üyesi</option>

        </select>

  
    <label class="abstract_website_lbl" style="display:none;" for="abstract_website">Kongre Seçim Yapın.</label>
        
    <select style="display: none;" class="form-control abstract_website"  name="abstract_website" >

      <?php 

      echo '<option value="">Seçim Yapın</option>';

      for($i=0;$i<count($abstract_websites);$i++ ){

        $abstract_website_arr = json_decode($abstract_websites[$i]["abstract_website"]);

            echo '<option value="'.$abstract_website_arr->{"tr"}.'" >'.$abstract_website_arr->{$uye_dil}.'</option>';

      }
        
        
      ?>
      
    </select>
    <br>
   
    <label style = "display:none;" class="abstract_categories_lbl" for="abstract_categories">Kategori Seçim Yapın</label>
       
    <select  style = " display:none;"name="abstract_categories" class="form-control abstract_categories" ></select>

    <br>

    <label style="display:none;" class="abstract_sub_categories_lbl" for="abstract_categories" > Alt Kategori Seçim Yapın.</label>
    <div   style="display:none;" name="abstract_sub_categories" class="radio abstract_sub_categories" ></div>


      

		<label>* E-posta</label>
		<input class="form-control" type="email" name="mail" required>	
								
							  
        <p align="left">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <span style="color: #000;"><input id="ContentPlaceHolder2_checkbox1" type="checkbox" name="checkbox1" onclick="javascript:setTimeout(&#39;__doPostBack(\&#39;ctl00$ContentPlaceHolder2$checkbox1\&#39;,\&#39;\&#39;)&#39;, 0)" required /></span>
            &nbsp;&nbsp;
            <a style="color: #007bff !important" data-toggle="modal" data-target="#exampleModal">* KVKK Metnini </a> Okudum, kabul ediyorum.
            
        </p>
						
							
								<br>
		<button type="submit" class="btn btn-success"><i class="fas fa-user-plus"></i>&nbsp;&nbsp;Kayıt Ol</button>
		
		</form>
		
						</div>
						
						
						
	
						
					</div>
				</div>
			
			</div>

			
		

	
        
		 
		 
		 <div class="modal modalxx fade pr-0" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialogxx" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">KVKK METNİ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <h5 class="pt-5">KİŞİSEL VERİLERİN KORUNMASI VE İŞLENMESİ POLİTİKASI</h5>
                            <br />
                            KVKK’nın 11. maddesi gereği haklarınız; kişisel verilerinizin,
                            <ul>
                                <li>1- İşlenip işlenmediğini öğrenme,</li>
                                <li>2- İşlenmişse bilgi talep etme, </li>
                                <li>3- İşlenme amacını ve amacına uygun kullanılıp kullanılmadığını öğrenme,</li>
                                <li>4- Yurt içinde / yurt dışında aktarıldığı 3. kişileri bilme,</li>
                                <li>5- Eksik / yanlış işlenmişse düzeltilmesini isteme,</li>
                                <li>6- KVKK’nın 7. maddesinde öngörülen şartlar çerçevesinde silinmesini / yok edilmesini isteme,</li>
                                <li>7- Aktarıldığı 3. kişilere yukarıda sayılan (e) ve (f) bentleri uyarınca yapılan işlemlerin bildirilmesini isteme,</li>
                                <li>8- Münhasıran otomatik sistemler ile analiz edilmesi nedeniyle aleyhinize bir sonucun ortaya çıkmasına itiraz etme,</li>
                                <li>9- Kanuna aykırı olarak işlenmesi sebebiyle zarara uğramanız hâlinde zararın giderilmesini talep etme haklarına sahipsiniz.</li>
                            </ul>
                            <p>KVK Kanunu’nun 13. maddesinin 1. fıkrası gereğince, yukarıda belirtilen haklarınızı kullanmak ile ilgili talebinizi, yazılı olarak veya Kişisel Verileri Koruma Kurulu’nun belirlediği diğer yöntemlerle bize iletebilirsiniz.</p>
                            <br />
                            <p>
                                Kişisel verileriniz,<br />
                                • Kanuni yükümlülüğün yerine getirilmesi veya ilgili derneklere ait hakların tesisi, kullanılması veya korunması amacıyla yetkili resmi kurum ve kuruluşlar ile kanunen yetkilendirilmiş özel kişilere;  yurtiçi ve yurtdışı iş ortaklarımıza, işbirliği içinde bulunduğumuz şirket ve kurumlara, akdi veya kanuni yükümlülüklerimizi yerine getirmek amacıyla dışarıdan hizmet aldığı şirketlere (güvenlik, sağlık, iş güvenliği, hukuk vb. konularda), yetkili kurum ve kuruluşlara ilgili mevzuatta öngörülen usul ve esaslar çerçevesinde ve KVKK’nın 8. ve 9. maddelerinde belirtilen kişisel veri aktarma şartları ve amaçlarına uygun olarak aktarılabilecektir.
                            </p>
                            <strong>Kişisel Verilerin/Özel Nitelikli Kişisel Verilerin Toplanma Yöntemi ve Hukuki Sebebi</strong>
                            <p>
                                Kişisel verileriniz, otomatik yöntemlerle veya otomatik olmayan yöntemler ile; iletişim formları vasıtasıyla ve sitemizi ziyaret eden kişilerin IP adreslerinin kaydedilmesi suretiyle elde edilmektedir.<br />
                                <br />
                                Söz konusu kişisel verilerinizin Şirket tarafından işlenmesindeki hukuki sebepler; Veri sahibinin Açık Rıza metninde, KVKK’nin 5.maddesinin birinci fıkrası uyarınca vermiş olduğu rıza ile KVKK’nın 5.maddesinin ikinci fıkrasının ç,e ve f bentlerinde belirtilen açık rızanın istisnası olan hallerdir. 

                            </p>
                            <strong>SİTE SAHİBİ<br />
                                Nutuva Organizasyon</strong>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    </div>
                </div>
            </div>
        </div>	
		

        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


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


<script>
var site;
var uye_dil = "<?php echo $uye_dil; ?>";

	
$(".abstract_website_lbl").css("display", "none");
$(".abstract_website").css("display", "none");
$(".abstract_categories").css("display", "none");
$("input[name=abstract_sub_categories]").css("display", "none");


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


$(".abstract_website_lbl").css("display", "block");
$(".abstract_website").css("display", "block");
$(".abstract_website").attr("required", "true");
$(".abstract_categories").html(site_cat_html);

}

else{

    $(".abstract_website_lbl").css("display", "none");
$(".abstract_website").css("display", "none");
$(".abstract_categories").css("display", "none");
$(".abstract_categories_lbl").css("display", "none");
$(".abstract_sub_categories").css("display", "none");
$(".abstract_sub_categories_lbl").css("display", "none");
$("input[name=abstract_sub_categories]").css("display", "none");

$('.abstract_website').removeAttr('required');
$('.abstract_categories').removeAttr('required');
$('.abstract_sub_categories').removeAttr('required');
$('input[name=abstract_sub_check]').removeAttr('required');




}


});



$( "select[name=abstract_website]" )
.change(function () {

$('.abstract_categories').removeAttr('required');
$('.abstract_sub_categories').removeAttr('required');
$('input[name=abstract_sub_check]').removeAttr('required');

$("input[name=abstract_sub_categories]").css("display", "none"); 
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


site_cat_html += '<option value="">Seçim Yapın</option>';
for(i=0; i<site_categories.tr.length; i++){


  site_cat_html += '<option value="'+site_categories.tr[i][0].category+'">'+site_categories[uye_dil][i][0].category+'</option>';


}

$(".abstract_categories_lbl").css("display", "block");
$(".abstract_categories").css("display", "block");
$(".abstract_categories").attr("required", "true");
$(".abstract_categories").html(site_cat_html);



});










$( "select[name=abstract_categories]" )
.change(function () {

$('.abstract_sub_categories').removeAttr('required');
$('input[name=abstract_sub_check]').removeAttr('required');

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

site_cat_html +=   '<label style="margin-left:20px;"><input type="radio" name="abstract_sub_check" style="margin-left:20px;" value="'+site_categories.tr[newstr][k] +'" required>&nbsp;'+site_categories[uye_dil][newstr][k] +'</label><br/>';

}
$(".abstract_sub_categories").css("display", "block");
$(".abstract_sub_categories_lbl").css("display", "block");
$("div[name=abstract_sub_categories]").html(site_cat_html);

$("input[name=abstract_sub_check]").attr("required", "true");


})
.change();
</script>



	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
	
</body>

</html>

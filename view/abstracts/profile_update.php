

<!DOCTYPE html>

<html>

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie-edge" />
    <title><?php echo $language[0];?></title>
	
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
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"><?php echo $language[1];?></h5>
							
							
						</div>
						
						
						<div class="modal-body">
							<form action="/profile_update" method="POST">
		<label>* <?php echo $language[2];?></label>
		<input class="form-control" type="text" value="<?php echo $user_index["uye_adi"] ;?>" name="kadi" onchange="toUpper(this)" onkeyup="toUpper(this)" style="width:100%;" required>
       
        <label>* <?php echo $language[3];?></label>
		<input class="form-control" type="text" value="<?php echo $user_index["uye_soyadi"] ;?>" name="ksoyadi" onchange="toUpper(this)" onkeyup="toUpper(this)" style="width:100%;" required>
								
		<label>* <?php echo $language[4];?></label>
		<input name="tel" type="text" value="<?php echo $user_index["uye_tel"] ;?>" id="ContentPlaceHolder2_txtCepTelefonu" class="form-control" placeholder="(5xx) xxx xx xx" / required>
								
		<label><?php echo $language[5];?></label>
		<select name="sehir" class="form-control" type="text" >
		<option value=""><?php echo $language[6];?></option>

        <?php
        $sehirler = ["Adana","Adiyaman","Afyon","Agri","Aksaray","Amasya","Ankara","Antalya","Ardahan","Artvin","Aydin","Balikesir","Bartin","Batman","Bayburt","Bilecik","Bingol","Bitlis","Bolu","Burdur","Bursa","Canakkale","Cankiri","Corum","Denizli","Diyarbakir","Duzce","Edirne","Elazig","Erzincan","Erzurum","Eskisehir","Gaziantep","Giresun","Gumushane","Hakkari","Hatay","Igdir","Isparta","Istanbul","Izmir","Kahramanmaras","Karabuk","Karaman","Kars","Kastamonu","Kayseri","Kilis","Kirikkale","Kirklareli","Kirsehir","Kocaeli","Konya","Kutahya","Malatya","Manisa","Mardin","Mersin","Mugla","Mus","Nevsehir","Nigde","Ordu","Osmaniye","Rize","Sakarya","Samsun","Sanliurfa","Siirt","Sinop","Sirnak","Sivas","Tekirdag","Tokat","Trabzon","Tunceli","Usak","Van","Yalova","Yozgat","Zonguldak"];

        
            echo '<option value="Türkiye Dışı"';if($user_index["uye_sehir"] == 'Türkiye Dışı'){echo 'selected';}echo '>'.$language[7].'</option>';


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
				
		
		<label><?php echo $language[8];?></label>
		<select name="unvan" class="form-control" type="text" >
        <option value=""><?php echo $language[9];?></option>
        <?php

            $unvan = $language[10];
            if($uye_dil == "tr")
            {
                for($i=0;$i<count($unvan[0]);$i++){

                    if($unvan[0][$i]==$user_index["uye_unvan"]){
                        echo '<option value="'.$unvan[0][$i].'" selected>'.$unvan[0][$i].'</option>';
                    }
                    else{
                        echo '<option value="'.$unvan[0][$i].'">'.$unvan[0][$i].'</option>';
                    }
                }
            }
            else
            {
                for($i=0;$i<count($unvan[0]);$i++){

                    if($unvan[0][$i]==$user_index["uye_unvan"]){
                        echo '<option value="'.$unvan[0][$i].'" selected>'.$unvan[1][$i].'</option>';
                    }
                    else{
                        echo '<option value="'.$unvan[0][$i].'">'.$unvan[1][$i].'</option>';
                    }
                }
            }
        ?>

	
	
	
		
		</select>			
       
        <label>* <?php echo $language[11];?></label>
		<input class="form-control" type="text" value="<?php echo $user_index["uye_uzmanlik"] ;?>"  name="uzmanlik" required>
											
		<label>* <?php echo $language[12];?></label>
		<input class="form-control" type="text" value="<?php echo $user_index["uye_kurum"] ;?>"  name="kurum" required>
				
											
		<label>* <?php echo $language[13];?></label>
		<input class="form-control" type="text" value="<?php echo $user_index["uye_fatura_isim"] ;?>"  name="fatura_isim">

        <label>* <?php echo $language[14];?></label>
		<input class="form-control" type="text" value="<?php echo $user_index["uye_fatura_vergi_no"] ;?>"  name="fatura_vergi_no">

        <label>* <?php echo $language[15];?></label>
		<input class="form-control" type="text" value="<?php echo $user_index["uye_fatura_vergi_dairesi"] ;?>"  name="fatura_vergi_dairesi">
        
        <label>* <?php echo $language[16];?></label>
		<input class="form-control" type="text" value="<?php echo $user_index["uye_fatura_not"] ;?>"  name="fatura_not">
        
        <label>* <?php echo $language[17];?></label>
		<input class="form-control" type="text" value="<?php echo $user_index["uye_fatura_mail"] ;?>"  name="fatura_mail">

        <label>* <?php echo $language[18];?></label>
		<input class="form-control" type="text" value="<?php echo $user_index["uye_kargo_adres"] ;?>"  name="kargo_adres">
				
							
							
								<br>
		<button type="submit" class="btn btn-success"><i class="fas fa-user-plus"></i>&nbsp;&nbsp;<?php echo $language[19];?></button>
		
		</form>
		
						</div>
						
						<?php
                        
                        if(isset($_GET["status"])){

                            if($_GET["status"] == "true"){
                                echo '<h6 style="margin-left:20px;">'. $language[20].'</h6>';
                            }
                            else {
                                echo '<h6 style="margin-left:20px;">'. $language[21].'</h6>';
                            }

                        }
                        
                        ?>
						
	
						
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
	
	
</body>

</html>

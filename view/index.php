

<!DOCTYPE html>

<html>

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie-edge" />
    <title>8. Uluslararası Katılımlı Bitki Koruma Kongresi</title>
	
<meta name="keywords" content="medisinakademi, diyahed, Diyahed, Aile Hekimliği, Aile Hekimi Akademi, canlı yayın, nutuva, nutuvalive, Diyarbakır aile hekimi, aile hekimliği akademi, canlı etkinlik, istahed, ahef akademi, akademi, ahef, konya aile hekimi,">
<meta name="description" content="medisinakademi, diyahed, Diyahed, Aile Hekimliği, Aile Hekimi Akademi, canlı yayın, nutuva, nutuvalive, diyarbakır aile hekimi, aile hekimliği akademi, canlı etkinlik, istahed, ahef akademi, akademi, ahef, konya aile hekimi,">
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



	
   
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/all.min.css" rel="stylesheet" />
    <link href="css/custom.css" rel="stylesheet" />
    <link href="fontawesome/css/fontawesome.min.css" rel="stylesheet" />
  


	<link rel="stylesheet" href="css/style.css">

    <script src="js/moment-with-locales.js"></script>
    <script src="js/moment-duration-format.js"></script>
    <script src="js/jquery-3.1.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.countdown.js"></script>
    <script src="js/jquery.totemticker.js"></script>
    <script src="js/AlseinJS.js"></script>

 
    <style>
        a {
            text-decoration: none;
            background-color: transparent;
        }

        .giris {
            color: #000 !important;
        }
    </style>
	
	
	
	
</head>
<body>
   
<div class="container-fluid topbar">
                <div class="row py-2">
                    <div class="col-md-4 offset-1">
                         <a>Nutuva Bildiri Toplama Sistemi</a> 
						
                    </div>
					
					<div class="col-md-4 offset-1">
                    
					<?php

include("baglan.php");

    session_start();
    if (isset($_SESSION['user'])) {
        echo "Giriş yapıldı. (".$_SESSION['user']['uye_adi'].")
		<a href='cikis.php' id='LGGiris_hyplnkUyeGiris' class='btn btn-primary' >
        <i class='fas fa-user-times'></i>&nbsp;&nbsp; Güvenli Çıkış
        </a> 
		";
    }else {
        echo "Giriş yapılmamış.";
    }
					?>
					
                    </div>

                </div>
            </div>
<script src="js/mobilemask.debug.js" type="text/javascript"></script>

			<?php
			include("menu.php");
			?>
			
	

	
		
		<section>
            <div class="container mt-2">
                <div class="row pb-1">
                    
    <div class="col-lg-9 offset-1">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                
                      
                    <?php
                    
            $tek_calis = 0;
            $icerik = $db->query("select * from anasayfa_resim order by id desc");
            $icerik-> execute();
            while($row = $icerik->fetch(PDO::FETCH_ASSOC)){
                $id = $row['id'];
                $dizin = $row['dizin'];
                $dosya_ad = $row['dosya_ad'];
                
                if($tek_calis == 0){

                    echo'<div class="carousel-item active  ">
                    <a href="#" target="_blank">
                        <img id="ContentPlaceHolder2_rptSlider_ImgSlider_1" class="card-img-top" src="/'.$dizin."/".$dosya_ad.'" alt="..." />
                    </a>
                    </div>';
                 
                    
                    $tek_calis += 1;

                }

                else{

                    echo'<div class="carousel-item ">
                    <a href="#" target="_blank">
                        <img id="ContentPlaceHolder2_rptSlider_ImgSlider_1" class="card-img-top" src="/'.$dizin."/".$dosya_ad.'" alt="..." />
                    </a>
                    </div>';
                   

                }
           
                                
            }
                    ?>
					 
						
					
                    
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    

                </div>
            </div>
        </section>

       <?php
include("foter.php");
?>
	
			
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
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
	
	
</body>
</html>

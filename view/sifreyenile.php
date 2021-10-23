
<?php


?>



<!DOCTYPE html>

<html>

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie-edge" />
    <title>8. Uluslararası Katılımlı Bitki Koruma Kongresi</title>
	
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

	
   
<link href="../view/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../view/css/all.min.css" rel="stylesheet" />
    <link href="../view/css/custom.css" rel="stylesheet" />
    <link href="../view/fontawesome/css/fontawesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="view/style.css">


	<link rel="../view/stylesheet" href="css/style.css">

    <script src="../view/js/moment-with-locales.js"></script>
    <script src="../view/js/moment-duration-format.js"></script>
    <script src="../view/js/jquery-3.1.0.min.js"></script>
    <script src="../view/js/popper.min.js"></script>
    <script src="../view/js/bootstrap.min.js"></script>
    <script src="../view/js/jquery.countdown.js"></script>
    <script src="../view/js/jquery.totemticker.js"></script>
    <script src="../view/js/view/AlseinJS.js"></script>
 
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
   



        <header>
		  <div class="container-fluid topbar">
                <div class="row py-2">
                    <div class="col-md-4 offset-1">
                        <a>Nutuva Bildiri Toplama Sistemi </a> 
						
                    </div>
					
					<div class="col-md-4 offset-1">
                       <?php

    if (isset($_SESSION['user'])) {
        echo "Giriş yapıldı. (".$_SESSION['user']['uye_adi'].")<a href='cikis.php'>Güvenli Çıkış </a>";
    }else {
        echo "Giriş yapılmamış.";
    }
?>
                    </div>

                </div>
            </div>
            
           
		<?php
include("menu.php");
?>	
			
			
		
		</header>
   
              
		
		


			<div >
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Şifremi Unuttum </h5>
							
						</div>
						<div class="modal-body">
						<form action="reset_request" method="POST">
							
								<label>Email</label>
								<input class="form-control" type="email" name="email" required>
								
							<h6 class="modal-title" id="exampleModalLabel">Şifrenizi Sıfırlamak için E-posta adresinizi giriniz. </h6>	<br>
								
								<button type="submit" class="btn btn-primary" name="reset_request"><i class="fa fa-sign-in" ></i>&nbsp;&nbsp;Kod Gönder</button>
								
								<a href="/kayit" class="btn btn-success" ><i class="fas fa-user-plus"></i>&nbsp;&nbsp;Kayıt Ol</a>
								
								</form>		
								

                                <h5><?php 
                                if(isset($_GET['reset'])){

                                    if($_GET['reset'] == "success"){

                                        echo "Mail gönderim işlemi başarıyla sonuçlandı.";

                                    }

                                } ?></h5>

                                <h5><?php 
                                if(isset($_GET['reset'])){

                                    if($_GET['reset'] == "success"){

                                        echo "Şifre yenileme işlemlerine devam edebilmek için mail kutunuzu kontrol etmelisiniz.";

                                    }

                                } ?></h5>

                                
							
						</div>
					</div>
				</div>
			</div>	
			

		
    

	  
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

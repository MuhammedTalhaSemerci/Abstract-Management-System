
	<!DOCTYPE html>

	<html>

	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie-edge" />
    <title>ASM Güncesi | Aile  Hekimliği Online Etkinlik Platformu </title>
	
	<meta name="keywords" content="asm güncesi, ASM Güncesi, Aile Hekimliği, Aile Hekimi Akademi, canlı yayın, konahed, nutuva, nutuvalive, konya aile hekimi, aile hekimliği akademi, canlı etkinlik, istahed, ahef akademi, akademi, ahef, konya aile hekimi,">
<meta name="description" content="asm güncesi, ASM Güncesi, Aile Hekimliği, Aile Hekimi Akademi, canlı yayın, konahed, nutuva, nutuvalive, konya aile hekimi, aile hekimliği akademi, canlı etkinlik, istahed, ahef akademi, akademi, ahef, konya aile hekimi,">
<meta name="author" content="nutuva.com">
<meta class="viewport" name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

 <script src="https://kit.fontawesome.com/a9da6c256f.js" crossorigin="anonymous"></script>
<link rel="shortcut icon" type="image/png" href="../images/favicon/favicon-32x32.png"/>
<link rel="apple-touch-icon" sizes="57x57" href="../images/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="../images/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="../images/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="../images/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="../images/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="../images/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="../images/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="../images/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="../images/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="../images/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="../images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="../images/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="../images/favicon/favicon-16x16.png">
<link rel="manifest" href="../images/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

	
   
    <link href="view/css/bootstrap.min.css" rel="stylesheet" />
    <link href="view/css/all.min.css" rel="stylesheet" />
    <link href="view/css/custom.css" rel="stylesheet" />
    <link href="view/fontawesome/css/fontawesome.min.css" rel="stylesheet" />
  


	<link rel="stylesheet" href="view/css/style.css">

    <script src="view/js/moment-with-locales.js"></script>
    <script src="view/js/moment-duration-format.js"></script>
    <script src="view/js/jquery-3.1.0.min.js"></script>
    <script src="view/js/popper.min.js"></script>
    <script src="view/js/bootstrap.min.js"></script>
    <script src="view/js/jquery.countdown.js"></script>
    <script src="view/js/jquery.totemticker.js"></script>
    <script src="view/js/AlseinJS.js"></script>



	




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
					
						
                    </div>

                </div>
            </div>
            
           
		<?php
		
			

$Selector = $_GET['selector'];
$Token = $_GET['validator'];


if(empty($Selector) || empty($Token)){


    echo "İsteğini gerçekleştiremeyeceğimizi üzülerek belirtiyoruz.";


}else{
if(ctype_xdigit($Selector)!== false && ctype_xdigit($Token)!== false){

    ?>

<div >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
            <form action="/yenisifrekayit" method="POST">
                    <input type="hidden" name="selector" value="<?php echo $Selector; ?>">				
                    <input type="hidden" name="validator" value="<?php echo $Token; ?>">	
                
                    <label>*Şifreniz</label>
                    <input class="form-control" type="password" name="sifre"required>
                    <label>*Şifrenizi Tekrar Girin</label>
                    <input class="form-control" type="password" name="sifretekrar" required>
                    <br>
                    
                    
                    <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in" name = "yenisifrekayit"></i>&nbsp;&nbsp;Giriş Yap</button>
                
                    </form>	
                </div>
            </div>
        </div>
    </div>
</div>
      


	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    
</body>
</html>
<?php
   }
}

?>




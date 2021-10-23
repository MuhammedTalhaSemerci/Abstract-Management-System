
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/a9da6c256f.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-126201232-35');
</script>
</head>
<body class="d-flex flex-column h-100">


			

        <main class="flex-shrink-0">
        <div class="container">
            <div class="row">
                <div class="sayfaBaslik"><h1><?php echo $language[0];?></h1></div>
 
 
 <form name="form1" method="post" action="/kongre_on_kayit"  onsubmit="return checkform(this);">
 <table><caption></caption></table>
                    <div class="mt20"></div>
                 
                <?php
                  $prices = json_decode($abstract_websites[0]["fee"]);

                ?>
                    
					 <div class="mt20"></div>
                     <table border="1" cellspacing="0" cellpadding="5" style="width: 70%;">
              <tbody>
                <tr style="background: #e4b322;font-weight: 500;">
                  <td><strong>&nbsp;&nbsp;<?php echo $language[1];?></strong></td>
                  <td align="center"><strong><?php echo $language[2];?><br>
                  <?php echo $language[3];?></strong></td>
                  <td align="center"><strong><?php echo $language[4];?><br>
                  <?php echo $language[5];?></strong></td>
                </tr>


                <tr>
                  <td><strong> &nbsp;&nbsp;<?php echo $language[6];?><br> </strong></td>
                  <td align="center"><?php echo $prices->{$uye_dil}->{"ogrenci"}[0].$prices->{$uye_dil}->{"currency"};?> <input class="hsp" type="radio" name="Kayit_ucreti" value="Öğrenci Kaydı/<?php echo $prices->{$uye_dil}->{"ogrenci"}[0];?>/Erken Kayıt<?php echo $language[9];?>" disabled="disabled"></td>
                  <td align="center"><?php echo $prices->{$uye_dil}->{"ogrenci"}[1].$prices->{$uye_dil}->{"currency"};?> <input class="hsp" type="radio" name="Kayit_ucreti" value="Öğrenci Kaydı/<?php echo $prices->{$uye_dil}->{"ogrenci"}[1];?>/Geç Kayıt<?php echo $language[12];?>" required></td>
                </tr>
                <tr>
                  <td><strong> &nbsp;&nbsp;<?php echo $language[13];?></strong></td>
                  <td align="center"><?php echo $prices->{$uye_dil}->{"normal"}[0].$prices->{$uye_dil}->{"currency"};?> <input class="hsp" type="radio" name="Kayit_ucreti" value="Normal Kayıt/<?php echo $prices->{$uye_dil}->{"normal"}[0];?>/Erken Kayıt<?php echo $language[16];?>" disabled="disabled"></td>
                  <td align="center"><?php echo $prices->{$uye_dil}->{"normal"}[1].$prices->{$uye_dil}->{"currency"};?> <input class="hsp" type="radio" name="Kayit_ucreti" value="Normal Kayıt/<?php echo $prices->{$uye_dil}->{"normal"}[1];?>/Geç Kayıt<?php echo $language[19];?>" required ></td>
                </tr>
                <tr>
                  <td><strong> &nbsp;&nbsp;<?php echo $language[20];?></strong></td>
                  <td align="center"><?php echo $prices->{$uye_dil}->{"katilimci"}[0].$prices->{$uye_dil}->{"currency"};?> <input class="hsp" type="radio" name="Kayit_ucreti" value="Katılımcı Kaydı/<?php echo $prices->{$uye_dil}->{"katilimci"}[0];?>/Erken Kayıt<?php echo $language[23];?>" disabled="disabled"></td>
                  <td align="center"><?php echo $prices->{$uye_dil}->{"katilimci"}[1].$prices->{$uye_dil}->{"currency"};?> <input class="hsp" type="radio" name="Kayit_ucreti" value="Katılımcı Kaydı/<?php echo $prices->{$uye_dil}->{"katilimci"}[1];?>/Geç Kayıt<?php echo $language[26];?>" required ></td>
                </tr>
              </tbody>
            </table>
					
					
					 <div class="mt20"></div>
                     <table>
                        <caption><?php echo $language[27];?></caption>
                        <tbody>
                            <tr>
                                <td><b><?php echo $language[28];?></b></td>
                                <td id="kayit_tutar"><?php echo $language[29];?></td>
                          
                            </tr>
				
                            <tr>
                                <td><b><?php echo $language[30];?></b></td>
                                <td id="toplam_tutar"><?php echo $language[31];?></td>
                          
                            </tr>

                           
                               
                        </tbody>
                         
                    </table>
                   <p><?php echo $language[32];?></p>
                        
             <div class="iletisim">
                        <div class="form-row pull-right">
                            <input type="submit" name="button-g-3" value="<?php echo $language[33];?>" id="button-g-3" class="form-gonder-button">
                        </div>
                    <div class="mt20"></div>
					<table>
					
                    <div class="mt20"></div>
					
                    <br>
            <h3 style="padding-top: 0px;"><?php echo $language[34];?></h3>
           
			
            <p><strong><?php echo $language[35];?></strong> <?php echo $language[36];?></p>
            <p><strong><?php echo $language[37];?></strong> <?php echo $language[38];?></p>
            <p><strong><?php echo $language[39];?></strong> <?php echo $language[40];?>&nbsp; <strong> <?php echo $language[41];?></strong> <?php echo $language[42];?></p>
            <br>
			
            <?php
            if($uye_dil == "tr")
            {
              
            }
            else
            {
              echo '<p><strong>'.$language[43].'	:</strong> '.$language[44].'</p>
              <p><strong>'.$language[45].'	:</strong> '.$language[46].'</p>';
            }
            
            ?>
							
				
                 
                      
                        <tbody>
 
                        </table>	
					
                    <div class="col-md-12" style="min-height:500px">
       
            <br>
       
         
            <hr>
            <ul>
              <li><b><?php echo $language[47];?></b></li>
              <li>* <?php echo $language[48];?></li>
              <li>* <?php echo $language[49];?></li>
            </ul>

            <hr>
            
           
           
           
            <h3 style="padding-top: 0px;"><?php echo $language[50];?></h3>
         
            <?php echo $language[51];?><br><br>	
				
				

                <ul>
                    <li><?php echo $language[52];?></li>
                    <li><?php echo $language[53];?></li>
                    
                </ul>
                <?php echo $language[54];?>
            <hr>
 
          </div>
			
			
	
         
              
            
						
                    </div>
                </form>
				  </div>
        </div>
    </main>
 

    <script>
     jQuery(document).ready(function () {
        $(document).on('change', '.hsp', function (e) {


            var ara_toplam = $("input[name=Kayit_ucreti]:checked").val();
            ara_toplam_arr = ara_toplam.split("/");
            $('#toplam_tutar').html(ara_toplam_arr[1] + ' <?php echo $prices->{$uye_dil}->{"currency"};?>');
            $('#kayit_tutar').html(ara_toplam_arr[1] + ' <?php echo $prices->{$uye_dil}->{"currency"};?>');
           
        });
    });
</script>
 
    
    
    </body>

</html>

 
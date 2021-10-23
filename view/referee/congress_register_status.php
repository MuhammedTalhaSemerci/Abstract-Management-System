<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $language[0];?></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a9da6c256f.js" crossorigin="anonymous"></script>


</head>
<body>
    

<?php

    $user_congress_register = json_decode($user_index["withdrawals"]);

    //çoklu kongrelerde düzenlenecek
    $congress_websites = json_decode($abstract_websites[0]["abstract_website"]);

    if($uye_dil == "tr")
    {
    
    }
    
    else
    {
        for($b=0;$b<count($user_congress_register);$b++)
        {
            if($user_congress_register[$b][0] == $congress_websites->{"tr"})
            {
                $user_congress_register[$b][0]  = $congress_websites->{$uye_dil};
            }
        }
    }
    


    if(isset($user_congress_register)){

        for($i=0;$i<count($user_congress_register);$i++){
            
            $register_type = explode("/",$user_congress_register[0][1]);
        
            if($user_congress_register[$i][3] == 0 && empty($user_congress_register[$i][2])){
    
                if($register_type[0] == "Öğrenci Kaydı")
                {
                $kayit_durum = $language[1];
                }

                else if($register_type[0] == "Normal Kayıt" || $register_type[0]=="Katılımcı Kaydı")
                {
                $kayit_durum = $language[2];
                }
            }

            else if($user_congress_register[$i][3] == 0 && !empty($user_congress_register[$i][2]) && count($user_congress_register[$i][2])>0 ){
    
                $kayit_durum = $language[3];
    
            }

            else if($user_congress_register[$i][3] == 1 && !empty($user_congress_register[$i][2]) && count($user_congress_register[$i][2])>0 ){
    
                $kayit_durum = $language[4];
    
            }

            else if($user_congress_register[$i][3] == 1 && empty($user_congress_register[$i][2]) && count($user_congress_register[$i][2])==0){
    
                $kayit_durum = $language[5];
    
            }
    
            else if($user_congress_register[$i][3] == 2){
    
                $kayit_durum = $language[6];
    
            }
            else{}

            $currency="--";
            $prices = json_decode($abstract_websites[0]["fee"]);

            if($register_type[0] == "Öğrenci Kaydı")
            {
                $currency = $prices->{$uye_dil}->{"currency"};

                if($register_type[2] == "Erken Kayıt")
                {
                    $register_price_value = $prices->{$uye_dil}->{"ogrenci"}[0];
                }

                else if($register_type[2] == "Geç Kayıt")
                {
                    $register_price_value = $prices->{$uye_dil}->{"ogrenci"}[1];
                }
            }

            else if($register_type[0] == "Normal Kayıt")
            {
                $currency = $prices->{$uye_dil}->{"currency"};

                if($register_type[2] == "Erken Kayıt")
                {
                    $register_price_value = $prices->{$uye_dil}->{"normal"}[0];
                }

                else if($register_type[2] == "Geç Kayıt")
                {
                    $register_price_value = $prices->{$uye_dil}->{"normal"}[1];
                }
            }

            else if($register_type[0] == "Katılımcı Kaydı")
            {
                $currency = $prices->{$uye_dil}->{"currency"};

                if($register_type[2] == "Erken Kayıt")
                {
                    $register_price_value = $prices->{$uye_dil}->{"katilimci"}[0];
                }

                else if($register_type[2] == "Geç Kayıt")
                {
                    $register_price_value = $prices->{$uye_dil}->{"katilimci"}[1];
                }
            }
            

            $data = $language[7];

            if($uye_dil == "tr")
            {
               
            }
            else
            {
                for($a=0;$a<count($data[0]);$a++)
                {
                    if($register_type[0] == $data[0][$a])
                    {
                        $register_type[0] = $data[1][$a];
                    }
                }

                
            }

            $data = $language[8];

            if($uye_dil == "tr")
            {
               
            }
            else
            {
                for($a=0;$a<count($data[0]);$a++)
                {
                    if($register_type[2] == $data[0][$a])
                    {
                        $register_type[2] = $data[1][$a];
                    }
                }

                
            }
                
            echo '<div>
        <table style="margin-left:20px;">
    
        <tr><td ><font color="red"><b>'.$language[9].':</b></font> </td><td> '.$user_congress_register[$i][0].'</td></tr>
        
        <tr><td ><font color="red"><b>'.$language[10].':</b></font></td><td> '.$register_type[0].' </td></tr>';

        if(intval($user_congress_register[$i][3]) == 1)
        {
            echo  '<tr><td ><font color="red"><b>'.$language[11].':</b></font> </td><td> '.$register_price_value.' '.$currency.'</td></tr>';
        }
        else
        {
            echo  '<tr><td ><font color="red"><b>'.$language[12].':</b></font> </td><td> '.$register_price_value.' '.$currency.'</td></tr>';
        }
    
        echo '<tr><td><font color="red"><b>'.$language[13].':</b></font> </td><td> '.$register_type[2].' </td></tr>
    
    
        <tr><td><h6><b><font color="0099FF"> '.$language[14].': </b></font></td><td>   '.$kayit_durum.'</h6></td></tr>
        ';

        if(intval($user_congress_register[$i][3]) == 0)
        {
            echo  '<tr><td><button class="form-control" onclick="myFunction()">'.$language[15].'</td></tr>';
        }
        else if(intval($user_congress_register[$i][3]) == 1)
        {
        echo  '<tr><td><a target="_blank" href="congress_register_document">'.$language[16].'</a></td></tr> ';
        }

        echo '</table>
        </div> <hr />';
    
        }
    
    }    
    else{

        echo '<h4>'.$language[17].'</h4>';
    }

?>

<script>
myFunction = function(x) {
    var y ;
     if (confirm("<?php echo $language[18];?>") == true) {
        setTimeout(function(){window.location.href='delete_congress_registration';},100);
     } else {
         y = "<?php echo $language[19];?>";
         alert(y); 
     }
    
}
</script>



</body>
</html>
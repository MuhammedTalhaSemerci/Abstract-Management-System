<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Giriş</title>

<style>

.canliyayin{

all:unset;


margin:auto;
margin-bottom:3%;
width:100%;
height:auto;
font-size:1.5vw;
text-align:center;

font-family: Arial;

display:block;
position:relative;
float:none;




}


</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  


</head>
<body>
    

<div class="canliyayin">

        <form action="./index.php" method="POST">

        <h4>Admin Adı :</h4>

        <input class="col-4" type="text" name = "giris_kadi">
        <br>
         <h4>Admin Şifresi :</h4>
       
        <input class="col-4" type="password" name = "giris_sifre">
        <br>
        <br>
        <input class="col-4" type="submit" name = "admin_gonder">

        </form>


</div>



</body>
</html>
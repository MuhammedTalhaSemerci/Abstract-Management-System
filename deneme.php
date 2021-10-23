

<?php

if(isset($_POST["name"]) && isset($_POST["city"]))
{

    echo "<h3>Name:".$_POST["name"]." </h3><br><h3>City: ".$_POST["city"]."</h3>";

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<button>Send an HTTP POST request to a page and get the result back</button>

<div class="data"></div>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
var data1="";
$(document).ready(function(){
  $("button").click(function(){
    $.post("deneme.php",
    {
      name: "Donald Duck",
      city: "Duckburg"
    },
    function(data,status){
         data1 += data;

        $(".data").html(data1 );
      alert("Data: " + data1 + "\nStatus: " + status);
    });
  });
});
</script>

</body>
</html>
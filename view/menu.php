
	

	
	</head>
	<body>
   



        <header>
            <div class="container-fluid menubar">
                <div class="row py-1">
                    <div class="col-md-1 col-lg-1 ">
                    </div>
                    <div class="col-md-4 col-9 offset-1">
                        <a href="/index">
                        <?php 
                            if($uye_dil == "tr")
                            {
                                echo '<img src="../../view/images/logo.png" class="img-fluid"></a>';
                            }
                            else
                            {
                                echo '<img src="../../view/images/logo_'.$uye_dil.'.png" class="img-fluid"></a>';
                            }
                        ?>
                    </div>
                    <div class="col-md-1 col-lg-1 col-1">
                    </div>
                    <div class="col-md-2 col-2 offset-1">
                                <ul style="all:unset;float:left;">
                                    <li class="nav-item" style="all:unset;float:left;">
                                        <button onclick="language_changer_tr()" name="language_changer_tr" style="all:unset;border:0px;border-radius:5px;width:50px;height:50px;" class="menubar"><img src="../../view/images/turkey-flag.png" style="width:40px;height:40px;"></button>
                                    </li>
                                    <li class="nav-item"  style="all:unset;float:left;">
                                        <button onclick="language_changer_en()" name="language_changer_en" style="all:unset;border:0px;border-radius:5px;width:50px;height:50px;"><img src="../../view/images/america-flag.png" style="width:45px;height:32px;"></button>
                                    </li>
                                </ul>
                         </div>  
                </div>
            </div>
        </header>
		
        
		
	
        
		 
		 	
			
			
			
        <script>


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



 function language_changer_tr (){

    postForm("/language_changer?page=login",{language:"tr"});

}




 function language_changer_en (){

postForm("/language_changer?page=login",{language:"en"});

}

</script>




			
		
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
	
	

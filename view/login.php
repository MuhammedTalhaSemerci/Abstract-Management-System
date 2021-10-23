
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

	
	
   
<link href="view/css/bootstrap.min.css" rel="stylesheet" />
    <link href="view/css/all.min.css" rel="stylesheet" />
    <link href="view/css/custom.css" rel="stylesheet" />
    <link href="view/fontawesome/css/fontawesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="view/style.css">


	<link rel="view/stylesheet" href="css/style.css">

    <script src="view/js/moment-with-locales.js"></script>
    <script src="view/js/moment-duration-format.js"></script>
    <script src="view/js/jquery-3.1.0.min.js"></script>
    <script src="view/js/popper.min.js"></script>
    <script src="view/js/bootstrap.min.js"></script>
    <script src="view/js/jquery.countdown.js"></script>
    <script src="view/js/jquery.totemticker.js"></script>
    <script src="view/js/view/AlseinJS.js"></script>
    <script src="/view/virtual_congress/perspectivejs/dist/perspective.js"></script>

 
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
   



<?php

    if($abstract_websites["congress_start_time"] > date("U"))
    {


        echo '
        <header>
		  <div class="container-fluid topbar">
                <div class="row py-2">
                    <div class="col-md-4 offset-1">
                        <a>'.$language[1].' </a> 
						
                    </div>
					
					<div class="col-md-4 offset-1">
                       ';
    
        if (isset($_SESSION['user'])) {
            echo $language[2].". (".$_SESSION['user']['uye_adi'].")<a href='cikis'>Güvenli Çıkış </a>";
        }else {
            echo $language[3].".";
        }
        echo'
                    </div>

                </div>
            </div>
            
           ';



        include("menu.php");


			
		echo '	
		
		</header>



			<div>
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">'.$language[4].'</h5>
							
						</div>
						<div class="modal-body">
						<form action="/login" method="POST">
							
								<label>*'.$language[5].' </label>
								<input class="form-control" type="email" name="mail"required>
								<label>*'.$language[6].' </label>
								<input class="form-control" type="password" name="sifre" required>
								<br>
								
								
								<button type="submit" class="btn btn-primary"><i class="fa fa-sign-in" ></i>&nbsp;&nbsp;'.$language[7].' </button>
								<a href="/sifreyenile" class="btn btn-danger"><i class="fa fa-question"></i>&nbsp;&nbsp;'.$language[8].' </a>
								<a href="kayit" class="btn btn-success"><i class="fas fa-user-plus"></i>&nbsp;&nbsp;'.$language[9].' </a>
								
								</form>		

                                    
                                    
                                    <h5>';
                                    
                                    if(isset($_GET['sifre_yenile'])){


                                        if($_GET['sifre_yenile'] == "success"){

                                            echo $language[10];

                                        }

                                        if($_GET['sifre_yenile'] == "timeout"){

                                            echo $language[11];

                                        }

                                      

                                    }

                                    if(isset($_GET['kayit_basari'])){

                                    if($_GET['kayit_basari'] == "true"){

                                        echo $language[12];

                                    }

                                    if($_GET['kayit_basari'] == "false"){

                                        echo $language[13];

                                    
                                    }

                                  
                                    if($_GET['kayit_basari'] == "uyefalse"){

                                        echo $language[14];
                                      
                                    }
                                    
                                }
                                  
                                    
                                    echo'</h5>
                                    
                                    




	
							
						</div>
					</div>
				</div>
			</div>	
			

            





        
        <section style="z-index:-1;">
            <div class="wave wave1"></div>
            <div class="wave wave2"></div>
            <div class="wave wave3"></div>
            <div class="wave wave4"></div>
        </section>
        ';

    }

    else
    {

        if(!isset($_SESSION["user"]))
        {
            echo '
            <div class="container">

            <!-- Modal -->
            <div class="modal show" id="scientific-program-modal" role="dialog">
                <div class="modal-dialog">
                
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">'.$language[4].'</h4>
                    </div>
                    <div class="modal-body">
                    <form action="/login" method="POST">
                                
                    <label>*'.$language[5].' </label>
                    <input class="form-control" type="email" name="mail"required>
                    <label>*'.$language[6].' </label>
                    <input class="form-control" type="password" name="sifre" required>
                    <br>
                    
                    
                    <button type="submit" class="btn btn-primary close-modal"><i class="fa fa-sign-in" ></i>&nbsp;&nbsp;'.$language[7].' </button>
                    <a href="/sifreyenile" class="btn btn-danger"><i class="fa fa-question"></i>&nbsp;&nbsp;'.$language[8].' </a>
                    <a href="kayit" class="btn btn-success"><i class="fas fa-user-plus"></i>&nbsp;&nbsp;'.$language[9].' </a>
								
                    
                    </form>		

                        
                        
                        <h5>';
                        
                        if(isset($_GET['sifre_yenile'])){


                            if($_GET['sifre_yenile'] == "success"){

                                echo $language[10];

                            }

                            if($_GET['sifre_yenile'] == "timeout"){

                                echo $language[11];

                            }

                        

                        }

                        if(isset($_GET['kayit_basari'])){

                        if($_GET['kayit_basari'] == "true"){

                            echo $language[12];

                        }

                        if($_GET['kayit_basari'] == "false"){

                            echo $language[13];

                        
                        }

                    
                        if($_GET['kayit_basari'] == "uyefalse"){

                            echo $language[14];
                        
                        }
                        
                    }
                    
                                
                                echo'</h5>
                                        
                                </div>
                            <div class="modal-footer">

                            </div>
                        </div>
                    </div>
                </div>
                
                </div>
                
                <script type="text/javascript">
                $(window).on(\'load\', function() {
                    $(\'#scientific-program-modal\').modal(\'show\');
                });

                $(document).ready(function(){
                    $(".container").click(function(){
                        $(\'#scientific-program-modal\').modal(\'show\');
                    }); 
                });

                $(document).ready(function(){
                    $(".close-modal").click(function(){
                        $(".container").css("display","none");
                        $(".modal-backdrop").css("display","none");
                    }); 
                });
            </script>
            
            
            ';
            echo logincanvas($abstract_websites,$user_index,$all_admins,$withdrawal_state);
        }
        else
        {
            echo logincanvas($abstract_websites,$user_index,$all_admins,$withdrawal_state);
        }
    }


    function logincanvas($abstract_websites,$user_index,$all_admins,$withdrawal_state)
    {


    
        $images_str="";
        $admin_page_infos =json_decode($abstract_websites["admin_virtual_congress_but_infos"])->{"login_page"};
        $queue=1;
        foreach($admin_page_infos as $login_page => $index)
        {
            $images_str .= (property_exists($admin_page_infos->{$login_page},"2"))?'var image'.$login_page.' = new Image();':"";
            $images_str .= (property_exists($admin_page_infos->{$login_page},"2"))?'image'.$login_page.'.src = \''.$admin_page_infos->{$login_page}->{"2"}.'\';':"";
            $queue++;
        }

        $names_str="";
        $admin_page_infos =json_decode($abstract_websites["admin_virtual_congress_but_infos"])->{"login_page"};
        $queue=1;
        foreach($admin_page_infos as $login_page => $index)
        {
            if($queue == 5)
            {
                break;
            }
            $names_str .= (property_exists($admin_page_infos->{$login_page},"1"))?'<button id="button'.$login_page.'">'.$admin_page_infos->{$login_page}->{"1"}.'</button>':"";
            $queue++;
        }


        $links_str = "";
        foreach($admin_page_infos as $login_page => $index)
        {
            if(property_exists($admin_page_infos->{$login_page},"0") && property_exists($admin_page_infos->{$login_page},"is_saloon") && $admin_page_infos->{$login_page}->{"is_saloon"} == "1" && $admin_page_infos->{$login_page}->{"0"} != "")
            {
                $links_str .= '                
                    if(i == "'.intval($login_page).'")
                    {
                        $.post("/get_saloon_info",{but_index:"'.$login_page.'"},function(returnval){
                            if(returnval == 0)
                            {
                                alert("Oturum henüz başlatılmamıştır");
                            }    
                            else
                            {
                                window.location.href = returnval;
                            }
                        });
                        encounter += 1;
                    }
                ';
            }
            else if(property_exists($admin_page_infos->{$login_page},"0") && ((property_exists($admin_page_infos->{$login_page},"is_saloon") && $admin_page_infos->{$login_page}->{"is_saloon"} == "0" ) || (!property_exists($admin_page_infos->{$login_page},"is_saloon"))) && $admin_page_infos->{$login_page}->{"0"} != "")
            {
                $links_str .= '                
                    if(i == "'.intval($login_page).'")
                    {
                        window.location.href="'.$admin_page_infos->{$login_page}->{"0"}.'";
                        encounter += 1;
                    }
                ';
            }
            else
            {
                $links_str .="";
            }

        }
        
        if($withdrawal_state != -1 && $withdrawal_state == 0)
        {
            echo '<div onclick="withdrawalWarning(this)" style="z-index:10001;display:flex;position:absolute;width:100%;height:100%;justify-content:center;align-items:center;background-color:black;opacity:.6;"><div class="col-lg-7 col-md-7" style="padding:40px;border:2px solid #3da5c4; border-radius:10px;font-size:25px;color:white;opacity:1;">Kongre Kaydınız bulunmadığı için kısıtlı erişime sahipsiniz. Detaylı bilgi için yöneticilere ulaşınız.</div></div>';
            echo '
            <script>
                function withdrawalWarning(element)
                {
                    element.style.display = "none";
                }
            </script>';
        }
        else
        {

            if (isset($_SERVER['HTTPS']) &&
                ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
                isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
                $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
                $protocol = 'https';
            }
            else {
                $protocol = 'http';
            }
            if($protocol != "https")
            {
            echo '<div onclick="httpsWarningClose(this)"style="z-index:10001;display:flex;position:absolute;width:100%;height:100%;justify-content:center;align-items:center;background-color:black;opacity:.6;"><div class="col-lg-7 col-md-7" style="padding:40px;border:2px solid #3da5c4; border-radius:10px;font-size:25px;color:white;opacity:1;"><h5>Hatırlatma:</h5> Tüm bağlantıların güvenli ve kararlı olabilmesi için "https" protocolü kullanmalısınız. Protokolü kullanmak için lütfen tıklayın.</div></div>';
           
            echo '
            <script>
                function httpsWarningClose()
                {
                    window.location.href = "https://"+document.domain+"/";
                }
            </script>';
            }

        }


 
        $all_admins_table = "";
        if(count($all_admins)<1)
        {
            $all_admins_table .='<tr><td colspan="2">Herhangi bir kullanıcı tespit edilemedi.</td></tr>';
        }
        for($i=0;$i<count($all_admins);$i++)
        {
            if($i == 0)
            {
                $all_admins_table .= '<tr><td style="margin:auto;">Kullanıcılar</td><td>Aktiflik</td><tr>';
            }
           
            $all_admins_table .= '<tr><td><button class="form-control" onclick="start_text_meeting(\''.$all_admins[$i]["id"].'\')">'.$all_admins[$i]["uye_adi"].' '.$all_admins[$i]["uye_soyadi"].'</button></td><td class="controllable-users" data-id="'.$all_admins[$i]["id"].'"></td></tr>';
        }
        return '
            <style>




            body
            {
                overflow:hidden;
            }
            
            .main_page_redirector {
                position:absolute;
                top:5vw;
                left:5%;
                height: 5vw;
                width: 5vw;
                background-color: white;
                border:2px solid blue;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content:center;
                opacity:1;
            }
            .main_page_redirector:hover
            {
                opacity:.5;   
            }
            

            .abstract_book {
                position:absolute;
                top:11vw;
                left:5%;
                height: 5vw;
                width: 5vw;
                background-color: white;
                border:2px solid blue;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content:center;
                opacity:1;
            }
            .abstract_book:hover
            {
                opacity:.5;   
            }
            
                   
            .messenger-but {
                position:absolute;
                top:17vw;
                left:5%;
                height: 5vw;
                width: 5vw;
                background-color: white;
                border:2px solid blue;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content:center;
                opacity:1;
            }
            .messenger-but:hover
            {
                opacity:.5;   
            }

            .info-desk-but {
                position:absolute;
                top:23vw;
                left:5%;
                height: 5vw;
                width: 5vw;
                background-color: white;
                border:2px solid blue;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content:center;
                opacity:1;
            }
            .info-desk-but:hover
            {
                opacity:.5;   
            }


            .log-out-but {
                position:absolute;
                top:29vw;
                left:5%;
                height: 5vw;
                width: 5vw;
                background-color: white;
                border:2px solid blue;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content:center;
                opacity:1;
            }
            .log-out-but:hover
            {
                opacity:.5;   
            }
             
            .chat_area 
            { 
                background: rgba(0, 0, 0, 0.15);
                backdrop-filter: blur(10px); 
                margin: 0; 
                padding-bottom: 3rem; 
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
                width:283px;
                height:33vw;
                position:absolute; 
                overflow-y:scroll;
                z-index:20;
                border-radius:10px 10px 0px 0px;
                top:8.5vw;
                left:4vw;
                display:none;
            }

            #form { background: rgba(0, 0, 0, 0.15); padding: 0.25rem; position:absolute; height:auto; box-sizing: border-box; backdrop-filter: blur(10px); }
            #input { border: none; padding: 0 1rem; flex-grow: 1; border-radius: 2rem; margin: 0.25rem;height:30px; font-size:10px;display:block;}
            #input:focus { outline: none; }
            #form > button { background: #333; border: none; padding: 0 1rem; margin: 0.25rem; border-radius: 3px; outline: none; color: #fff; }

            .chat-send-but-div 
            {
                top:41.5vw;
                left:4vw;
                position:absolute;
                width:100%;
                height:auto; 
                display:flex;
                z-index:20;
            }
            #messages { list-style-type: none; margin: 0; padding: 0; opacity:1;}
            #messages > li { padding: 0.5rem 1rem; background-color:rgba(161, 235, 131,0.3); font-size:10px; overflow-wrap: break-word;opacity:1;}
            #messages > li:nth-child(odd) { background-color: rgba(240, 237, 165,0.3) ; font-size:10px;overflow-wrap: break-word;opacity:1;}


            </style>

                    
            <div class="chat_area" >
                <ul id="messages"><li> Sistem Mesajı: Genel Sohbet\'e hoşgeldiniz. Kullanıcılarla iletişim kurarken kullandığınız dile lütfen dikkat edin.</li></ul>
            </div>
            <div class="chat-send-but-div" >
                <div id="form" >
                    <input id="input" autocomplete="off" placeholder="Bir mesaj yazın" style="width:100%;display:block;"/>
                    <button id="form-send" >Gönder</button>
                    <button onclick="live_chat_opener()" >Sohbeti görüntüle</button>
                </div> 
            </div>
  
            <canvas style="position:absolute;top:0px;left:0px;">
                
               '.$names_str.'


                <button id="button4">Ana Resim</button>
              
                <button id="button5">Bilimsel Program</button>
                <button id="button6">Stand Alanı</button>
                
                <button id="button7">Danışma</button>
            </canvas>
    
            

            <div class="main_page_redirector" onclick="window.location.href=\'/virtual_congress_redirect\'" title="Online işlemler sayfasına dön"><i style="font-size:2vw;"class="fas fa-long-arrow-alt-right fa-2x"></i></div>
            <div class="abstract_book" onclick="redirect(\'/view/abstracts/abstract_book/abstract_book.pdf\')" title="Bildiri Özetleri"><i style="font-size:2vw;"class="fas fa-file-pdf fa-2x"></i></div>
            <div class="messenger-but" onclick="$(\'#messenger-modal\').modal(\'show\')" title="Sohbetlerim"><i style="font-size:2vw;"class="fas fa-comments fa-2x"></i></div>
            <div class="info-desk-but" onclick="$(\'#info-desk-modal\').modal(\'show\')" title="Danışma"><i style="font-size:2vw;"class="fas fa-question fa-2x"></i></div>
            <div class="log-out-but" onclick="window.location.href = \'/cikis\'" title="Çıkış Yap"><i style="font-size:2vw;"class="fas fa-sign-out-alt fa-2x"></i></div>
  

            <div style="display:inline-block;position:absolute;top:3vw;right:3vw;width:10vw;height:auto;padding:1vw;background-color:white;border-radius:3px;" onclick="redirect(\'http://nutuva.com/\')"><img style="position:relative;width:100%;height:auto;"src="/view/abstracts/organization_company_logo/logo.png" alt=""></div>

            

            <div class="modal fade" id="info-desk-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Danışma</h5>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$(\'#info-desk-modal\').modal(\'hide\');">Kapat</button>
                        </button>
                    </div>
                    <div class="modal-body" style="display:flex;justify-content:center;align-items:center;">
                        <table>
                            '.$all_admins_table.'
                        </table>
                    </div>

                    </div>
                </div>
            </div>

            
            <div id="scientific-program-modal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Bilimsel Program</h4>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$(\'#scientific-program-modal\').modal(\'hide\');">Kapat</button>
                        
                        </div>
                        <div class="modal-body" > 
                            <iframe src="https://ekongre.nutuva.com/api_scientific_program_iframe?salt=8943yrt049pwgf3tgbı3pğv0wefrgn90h530pg3emnı0&lang=tr" frameborder="0" style="width:100%;height:500px;"></iframe>  
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>


            <script>
   
            function redirect(url)
            {
             window.open(url,"_blank");
            }
            const canvas = document.querySelector(\'canvas\')
            const ctx = canvas.getContext(\'2d\')
            canvas.width = innerWidth
            canvas.height = innerHeight
            addEventListener(\'resize\', () => {
    
    
            canvas.width = innerWidth
            canvas.height = ((innerWidth/image.height)*600)
            ctx.drawImage(image, 0, 0,innerWidth,((image.height/image.width)*innerWidth));
            button_renderer();


    
    
            },true)
                
    
            var image = new Image();
            

            image.src = \'view/virtual_congress/pages/login_page.jpeg\';'.$images_str.'
            image.onload = function() {
            canvas.width = innerWidth
            canvas.height = ((image.height/image.width)*innerWidth)
            ctx.drawImage(image, 0, 0,innerWidth,((image.height/image.width)*innerWidth));
            button_renderer();

            image.style.display = \'none\';
            };
             
            const button0 = document.getElementById(\'button0\');
            const button1 = document.getElementById(\'button1\');
            const button2 = document.getElementById(\'button2\');
            const button3 = document.getElementById(\'button3\');
            const button4 = document.getElementById(\'button4\');
            const button5 = document.getElementById(\'button5\');
            const button6 = document.getElementById(\'button6\');
            const button7 = document.getElementById(\'button7\');


            document.addEventListener(\'focus\', redraw, true);
            document.addEventListener(\'blur\', redraw, true);
            canvas.addEventListener(\'click\', handleClick, false);
    
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(image, 0, 0,innerWidth,((image.height/image.width)*innerWidth));

            function redraw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(image, 0, 0,innerWidth,((image.height/image.width)*innerWidth));
          
            button_renderer();
            }
    
            function handleClick(e) {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(image, 0, 0,innerWidth,((image.height/image.width)*innerWidth));
            // Calculate click coordinates
            const x = e.clientX - canvas.offsetLeft;
            const y = e.clientY - canvas.offsetTop;
    
            // Focus buttons, if appropriate
                encounter = 0;
                for(i=0;i<7;i++)
                {
                    button_renderer(i);
                    if (ctx.isPointInPath(x, y)) {
                        if(encounter == 0)
                        {
                           '.$links_str.'
                           if(i == 5)
                           {
                            $(\'#scientific-program-modal\').modal(\'show\');
                                encounter += 1;
                           }
                           if(i == 6)
                           {
                                window.location.href="/virtual_congress_stand_area";
                                encounter += 1;
                           }
                        }
                    }
                } 
               
            }


            function button_renderer(x = null)
            {

             


                
                if(x == 0 || x == null)
                {
                    drawButton(button0, innerWidth/9.8,((image.height/image.width)*innerWidth)/2.8,4,20,2, 0, 0.04, .88, 0, 0,1);
                }
                if(x == 1 || x == null)
                {
                    drawButton(button1, innerWidth/4.95,((image.height/image.width)*innerWidth)/2.8,4,20,2, 0, 0.02, .88, 0, 0,1);
                }
                if(x == 2 || x == null)
                {
                    drawButton(button2, innerWidth/3.26,((image.height/image.width)*innerWidth)/2.8,4,20,2, 0, -0.02, .88, 0, 0,2);
                }
                if(x == 3 || x == null)
                {
                    drawButton(button3, innerWidth/2.45,((image.height/image.width)*innerWidth)/2.8,4,20,2, 0, -0.04, .88, 0, 0,3);
                }
                if(x == 4 || x == null)
                {
                    drawButton(button4, innerWidth/10.7,((image.height/image.width)*innerWidth)/5.8,31.5,17,2, 0, 0, .88, 0, 0,4);
                
                    if(typeof image4 != "undefined" && image4.src.search("base64") != -1)
                    {
                        var p = new Perspective(ctx, image4);
                        ctx.resetTransform();
                        p.draw([
                            [ innerWidth/5.3,((image.height/image.width)*innerWidth)/6.4],
                            [ innerWidth/1.23,((image.height/image.width)*innerWidth)/6.4],
                            [ innerWidth/1.23, ((image.height/image.width)*innerWidth)/3.4 ],
                            [ innerWidth/5.3, ((image.height/image.width)*innerWidth)/3.4 ]
                        ]);
                    }
                
                }
                if(x == 5 || x == null)
                {
                    drawButton(button5, innerWidth/12,((image.height/image.width)*innerWidth)/1.42,4,22,2, 0, 0.02, .8, 0, 0,5);
               
                    if(typeof image5 != "undefined" && image5.src.search("base64") != -1)
                    {
                        var p = new Perspective(ctx, image5);
                        ctx.resetTransform();
                        p.draw([
                            [ innerWidth/5.7,((image.height/image.width)*innerWidth)/1.77],
                            [ innerWidth/3.9,((image.height/image.width)*innerWidth)/1.77],
                            [ innerWidth/3.9, ((image.height/image.width)*innerWidth)/1.35 ],
                            [ innerWidth/5.7, ((image.height/image.width)*innerWidth)/1.35 ]
                        ]);
                    }
                }
                if(x == 6 || x == null)
                {
                    drawButton(button6, innerWidth/2.51,((image.height/image.width)*innerWidth)/1.42,4,22,2, 0, -0.02, .8, 0, 0,6);
                
                
                    if(typeof image6 != "undefined" && image6.src.search("base64") != -1)
                    {
                        var p = new Perspective(ctx, image6);
                        ctx.resetTransform();
                        p.draw([
                            [ innerWidth/1.265,((image.height/image.width)*innerWidth)/1.77],
                            [ innerWidth/1.155,((image.height/image.width)*innerWidth)/1.77],
                            [ innerWidth/1.155, ((image.height/image.width)*innerWidth)/1.365 ],
                            [ innerWidth/1.268, ((image.height/image.width)*innerWidth)/1.36 ]
                        ]);
                    }
                }

            }




    
            function drawButton(el, x, y,but_width,but_height,a,b,c,d,e,f,g) {
                const active = document.activeElement === el;
                const width = innerWidth*but_width/100;
                const height = ((image.height/image.width)*innerWidth)*but_height/100;
            
        
                ctx.setTransform(a,b,c,d,e,f);
        
                // Button background
                ctx.globalAlpha = 1;

                ctx.strokeRect(x, y, width, height);
                ctx.fillStyle = "rgba(255,255,0,1)";
                ctx.globalAlpha = .3;
                ctx.fillRect(x, y, width, height);
            
        
                // Button text
                ctx.font = width/3.4+\'px sans-serif\';
                ctx.textAlign = \'center\';
                ctx.textBaseline = \'\';
                ctx.fillStyle= "rgba(0,0,0,1)";
        
                ctx.globalAlpha = .7;
        
                if(g != 4)
                {
                    printAtWordWrap(ctx, el.textContent, x + width / 2, y + height / 2, height/8, width );
                }

              
                // Define clickable area
                ctx.beginPath();
                ctx.rect(x, y, width, height);
        
                // Draw focus ring, if appropriate
                ctx.drawFocusIfNeeded(el);
                ctx.globalAlpha = 1;
        
                ctx.resetTransform();

            }


        
            function draw_circle_Button(el, x, y,but_width,but_height,a,b,c,d,e,f) {
                const active = document.activeElement === el;
                const width = innerWidth*but_width/100;
                const height = ((image.height/image.width)*innerWidth)*but_height/100;
               
                ctx.globalAlpha = .4;
        
                ctx.setTransform(a,b,c,d,e,f);
        
                // Button background

                
        
                ctx.beginPath();
                ctx.arc(x, y, width, 0, 2 * Math.PI, false);
                ctx.fillStyle = \'yellow\';
                ctx.font = width/3.4+\'px sans-serif\';
                ctx.textAlign = \'center\';
                ctx.textBaseline = \'\';
                ctx.fill();
                ctx.strokeStyle = \'#003300\';
                ctx.stroke();
                ctx.fillStyle = "rgba(0,0,0,1)";
                ctx.globalAlpha = .8;
        
                printAtWordWrap(ctx, el.textContent, x , y , height/8, width );
               
              
        
        
                // Define clickable area
                
              
                // Draw focus ring, if appropriate
                ctx.drawFocusIfNeeded(el);
                ctx.globalAlpha = 1;
                ctx.resetTransform();
    
            }


            function printAtWordWrap( context , text, x, y, lineHeight, fitWidth)
            {
                fitWidth = fitWidth || 0;
                
                if (fitWidth <= 0)
                {
                    context.fillText( text, x, y );
                    return;
                }
                var words = text.split(\' \');
                var currentLine = 0;
                var idx = 1;
                while (words.length > 0 && idx <= words.length)
                {
                    var str = words.slice(0,idx).join(\' \');
                    var w = context.measureText(str).width;
                    if ( w > fitWidth )
                    {
                        if (idx==1)
                        {
                            idx=2;
                        }
                        context.fillText( words.slice(0,idx-1).join(\' \'), x, y + (lineHeight*currentLine) );
                        currentLine++;
                        words = words.splice(idx-1);
                        idx = 1;
                    }
                    else
                    {idx++;}
                }
                if  (idx > 0)
                    context.fillText( words.join(\' \'), x, y + (lineHeight*currentLine) );
            }
        
        </script>


      <script src="https://cdn.socket.io/3.1.3/socket.io.min.js" integrity="sha384-cPwlPLvBTa3sKAgddT6krw0cJat7egBga3DJepJyrLl4Q9/5WLra3rrnMcyTyOnh" crossorigin="anonymous"></script>
    
    <script>



        function live_chat_opener()
        {
        
            if($(".chat_area").css("display") == "none")
            {
                $(".chat_area").css("display","block"); 
            }
            else
            {
                $(".chat_area").css("display","none"); 
            }
        
        }
        function updateScroll(div){
            var element = document.getElementsByClassName(div)[0];
            element.scrollTop = element.scrollHeight;
        }
    
        var connectionOptions =   {
            rememberUpgrade:true,
            transports: [\'websocket\'],
            secure:true, 
            rejectUnauthorized: false
        };
        var socket = io("'.json_decode($abstract_websites["chat_app_infos"])[0].'",connectionOptions);
        //var socket = io("http://localhost:8080",connectionOptions);
  
        var messages = document.getElementById(\'messages\');
        var form = document.getElementById(\'form-send\');
        var input = document.getElementById(\'input\');

        form.addEventListener(\'click\', function() {
            if (input.value) {
            socket.emit(\'common chat\', { id: '.$user_index["id"].', name: \''.$user_index["uye_adi"].' '.$user_index["uye_soyadi"].'\', message: input.value, permission: 0});
            input.value = \'\';
            }
        },true);

      


        socket.on(\'common chat\', function(msg) {
            var item = document.createElement(\'li\');
            item.textContent =  msg.name+": "+msg.message;
            messages.appendChild(item);
            updateScroll("chat_area");
        });
  
       
  
  
      </script>
            ';
    }
  
?>	


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous"></script>
    <script  src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
	
	
</body>

</html>
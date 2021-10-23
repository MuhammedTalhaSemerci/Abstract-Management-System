


<?php

require(__DIR__.'/fpdf183/fpdf.php'); 
require(__DIR__.'/tfpdf/tfpdf.php'); 


class virtual_congress extends Controller
{

  
  public function virtual_congress_redirect()
  {
      session_start();
      if(isset($_SESSION["user"]))
          {
              if(intval($_SESSION["user"]["uye_yetki"]) == 0)
              {
                  header("location:/abstract_index");
                  exit();
              }
              else if(intval($_SESSION["user"]["uye_yetki"]) == 1)
              {
                  header("location:/editor_index");
                  exit();
              }
              else if(intval($_SESSION["user"]["uye_yetki"]) == 2)
              {
                  header("location:/referee_index");
                  exit();
              }

              else if(intval($_SESSION["user"]["uye_yetki"]) == 3)
              {
                  header("location:/admin_index");
                  exit();
              }
              else
              {
              header("location:/login");
              exit();
              }
          }
          else
          {
          header("location:/login");
          exit();
          }


  }


  
  public function goaway()
  {

      if(isset($_SESSION["user"]))
      {
        header("location:/");
        exit();  
      }
      else
      {
          header("location:/login");
          exit();
      }


  }

  public function congress_goaway($user_model,$virtual_congress_model)
  {
  
    $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
    $abstract_websites = $virtual_congress_model->allcategorywebsites()[0];
            
    if($abstract_websites["congress_start_time"] > date("U"))
    {
        $this->goaway();
    }
    else
    {
        $withdrawal_state = json_decode($user_index["withdrawals"])[0][3];
        if($withdrawal_state != 1)
        {
            $this->goaway();
        }
        else
        {
  
        }
  
    }

  }

  

  public function get_saloon_info()
  {
    session_start();

    $user_model = $this->model("users");
    $virtual_congress_model = $this->model("virtual_congress_model");
    $abstract_websites = $virtual_congress_model->allcategorywebsites()[0];

    if(isset($_SESSION["user"])){           
    }
    else{
      echo 0;
    }

    if(isset($_POST["but_index"]))
    {

      $button_infos = json_decode($abstract_websites["admin_virtual_congress_but_infos"]);
      $but_index = $_POST["but_index"];
      $is_saloon = (property_exists($button_infos->{"login_page"},$but_index) && property_exists($button_infos->{"login_page"}->{$but_index},"is_saloon"))? $button_infos->{"login_page"}->{$but_index}->{"is_saloon"}:"0";

      if($button_infos->{"login_page"}->{$but_index}->{0} != "#" && $button_infos->{"login_page"}->{$but_index}->{0} != "")
      {
        echo $button_infos->{"login_page"}->{$but_index}->{0};
      }
      else
      {
        echo 0;
      }
    }
    else
    {
      
      echo 0;
    }

  }


  public function main_saloon()
  {

    session_start();

    $user_model = $this->model("users");
    $virtual_congress_model = $this->model("virtual_congress_model");

    if(isset($_SESSION["user"])){ 
      $this->congress_goaway($user_model,$virtual_congress_model);           
    }
    else{
        header("location:/");
        exit;
    }

  
    $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
    $abstract_websites = $virtual_congress_model->allcategorywebsites()[0];

    $this->view("virtual_congress/main_saloon",["abstract_websites"=>$abstract_websites,"user_index"=>$user_index]);

  }

  public function stand_area()
  {

    session_start();

    $user_model = $this->model("users");
    $virtual_congress_model = $this->model("virtual_congress_model");

    if(isset($_SESSION["user"])){    
      $this->congress_goaway($user_model,$virtual_congress_model);            
    }
    else{
        header("location:/");
        exit;
    }

    $abstract_websites = $virtual_congress_model->allcategorywebsites()[0];
    $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
    
    $sponsors = (is_array(json_decode($abstract_websites["sponsors"])))? json_decode($abstract_websites["sponsors"]):[];

    $this->view('out_of_indexes/socket_notifications',[ "abstract_websites"=>$abstract_websites,"user_index"=>$user_index]);
    $this->view("virtual_congress/stand_area",["abstract_websites"=>$abstract_websites,"sponsors"=>$sponsors,"user_index"=>$user_index]);


  }


  public function inner_stand()
  {

    session_start();

    $user_model = $this->model("users");
    $virtual_congress_model = $this->model("virtual_congress_model");

    if(isset($_SESSION["user"])){       
      $this->congress_goaway($user_model,$virtual_congress_model);           
    }
    else{
        header("location:/");
        exit;
    }
    

    $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);

    if(isset($_GET["sponsor_company"]))
    {
      $abstract_websites = $virtual_congress_model->allcategorywebsites()[0];
      $sponsor_company = $_GET["sponsor_company"];
      $stand_officers = $virtual_congress_model->getStandOfficers("uye",$sponsor_company);

      if(!property_exists(json_decode($abstract_websites["sponsor_congress_logo_but_infos"]),$sponsor_company))
      {
        header("location:/virtual_congress_stand_area");
        exit;
      }
    }
    else
    {
      header("location:/virtual_congress_stand_area");
      exit;
    }

    $this->view('out_of_indexes/socket_notifications',[ "abstract_websites"=>$abstract_websites,"user_index"=>$user_index]);
    $this->view("virtual_congress/inner_stand",["abstract_websites"=>$abstract_websites,"sponsor_company"=>$sponsor_company,"stand_officers"=>$stand_officers,"user_index"=>$user_index]);

  }


  public function poster_area()
  {

    session_start();

    $user_model = $this->model("users");
    $virtual_congress_model = $this->model("virtual_congress_model");

    if(isset($_SESSION["user"])){      
      $this->congress_goaway($user_model,$virtual_congress_model);           
    }
    else{
        header("location:/");
        exit;
    }

   
    $abstract_websites = $virtual_congress_model->allcategorywebsites()[0];
    $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);

    $poster_area_abstracts=[];
    $poster_area_abstracts = $virtual_congress_model->getallabstractsbytype("E-poster");
    
    $this->view('out_of_indexes/socket_notifications',[ "abstract_websites"=>$abstract_websites,"user_index"=>$user_index]);
    $this->view("virtual_congress/poster_area",["abstract_websites"=>$abstract_websites,"poster_area_abstracts"=>$poster_area_abstracts,"user_index"=>$user_index]);

  }


  public function private_chat()
  {

    session_start();

    $user_model = $this->model("users");
    $virtual_congress_model = $this->model("virtual_congress_model");
    
    if(isset($_SESSION["user"])){          
    }
    else{
    }

   
    $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);

    $abstract_websites = $virtual_congress_model->allcategorywebsites()[0];

    if(isset($user_index))
    {
      if(isset($_GET["chat_user"]))
      {
        $chat_user = $user_model->getuserbyid("uye",$_GET["chat_user"]);
        if(isset($chat_user))
        {
          if($user_index["id"] == $chat_user["id"])
          {
            header("location:/virtual_congress_stand_area");
            exit;
          }
          else{}
        }
      }
    }
    else
    {
      header("location:/virtual_congress_stand_area");
      exit;
    }


    $this->view("virtual_congress/private_chat",["abstract_websites"=>$abstract_websites,"user_index"=>$user_index,"chat_user"=>$chat_user]);

  }

  
 

  public function bbb_create_without_preupload()
  {
    session_start();

    $user_model = $this->model("users");
    $virtual_congress_model = $this->model("virtual_congress_model");

    if(isset($_SESSION["user"])){
      $this->congress_goaway($user_model,$virtual_congress_model);           
    }
    else{
        header("location:/");
        exit;
    }
    if(isset($_POST["session_name"]) || isset($_GET["session_name"]))
    {
      $abstract_websites = $virtual_congress_model->allcategorywebsites();
      $bbb_infos = json_decode($abstract_websites[0]["bbb_infos"]);
      
      $bbb_site = $bbb_infos[0];
      $bbb_salt = $bbb_infos[1];
      $bbb_at_pw = $bbb_infos[2];
      $bbb_md_pw = $bbb_infos[3];

      $bbb_query_arr = array(
        'createname' => ($_POST["session_name"])? $_POST["session_name"] : $_GET["session_name"],
        'meetingID'=> ($_POST["session_name"])? $_POST["session_name"] : $_GET["session_name"],
        'attendeePW'=> $bbb_at_pw,
        'moderatorPW'=> $bbb_md_pw,
        'record'=>'true',

      );
      $bbb_query_arr1 = array(
        'name' => ($_POST["session_name"])? $_POST["session_name"] : $_GET["session_name"],
        'meetingID'=> ($_POST["session_name"])? $_POST["session_name"] : $_GET["session_name"],
        'attendeePW'=> $bbb_at_pw,
        'moderatorPW'=> $bbb_md_pw,
        'record'=>'true',

      );
      $bbb_url = 'https://'.$bbb_site.'/bigbluebutton/api/create?'.http_build_query($bbb_query_arr1); 
      $checksum = sha1(http_build_query($bbb_query_arr).$bbb_salt);
      $bbb_url = $bbb_url.'&checksum='.$checksum; 
      echo $bbb_url;
    }
  }

  public function bbb_join_as_moderator()
  {
    session_start();

    $user_model = $this->model("users");
    $virtual_congress_model = $this->model("virtual_congress_model");

    if(isset($_SESSION["user"])){   
      $this->congress_goaway($user_model,$virtual_congress_model);           
    }
    else{
        exit;
    }

    if(isset($_POST["session_name"]) || isset($_GET["session_name"]))
    {
      if(empty($_GET["session_name"]))
      {
        $_GET["session_name"] = $_POST["session_name"];
      }


      $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
      $virtual_congress_model->test_session_connection_time(date("r"),$user_index["uye_mail"]);
      $abstract_websites = $virtual_congress_model->allcategorywebsites();
      $bbb_infos = json_decode($abstract_websites[0]["bbb_infos"]);
      
      $bbb_site = $bbb_infos[0];
      $bbb_salt = $bbb_infos[1];
      $bbb_at_pw = $bbb_infos[2];
      $bbb_md_pw = $bbb_infos[3];


      $bbb_query_arr = array(
        'meetingID'=> ($_POST["session_name"])? $_POST["session_name"] : $_GET["session_name"],
        'password'=>'denememp',
        'fullName' => (isset($_POST["user_name"]))?  $_POST["user_name"] : $user_index["uye_adi"]." ".$user_index["uye_soyadi"],
    );


      $bbb_url = 'https://'.$bbb_site.'/bigbluebutton/api/join?'.http_build_query($bbb_query_arr); 
      $checksum = sha1('join'.http_build_query($bbb_query_arr).$bbb_salt);
      $bbb_url = $bbb_url.'&checksum='.$checksum; 
      echo $bbb_url;
    }
    
  }


  public function bbb_join_as_attendee()
  {
    session_start();

    $user_model = $this->model("users");
    $virtual_congress_model = $this->model("virtual_congress_model");

    if(isset($_SESSION["user"])){   
      $this->congress_goaway($user_model,$virtual_congress_model);           
    }
    else{
        exit;
    }

    if(isset($_POST["session_name"]) || isset($_GET["session_name"]))
    {



      $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
      $virtual_congress_model->test_session_connection_time(date("r"),$user_index["uye_mail"]);
      
      $abstract_websites = $virtual_congress_model->allcategorywebsites();
      $bbb_infos = json_decode($abstract_websites[0]["bbb_infos"]);
      
      $bbb_site = $bbb_infos[0];
      $bbb_salt = $bbb_infos[1];
      $bbb_at_pw = $bbb_infos[2];
      $bbb_md_pw = $bbb_infos[3];


      $bbb_query_arr = array(
        'meetingID'=> ($_POST["session_name"])? $_POST["session_name"] : $_GET["session_name"],
        'password'=>'denemeap',
        'fullName' => (isset($_POST["user_name"]))?  $_POST["user_name"] : $user_index["uye_adi"]." ".$user_index["uye_soyadi"],
        'guest'=>"true",
        'lockSettingsLockOnJoin'=>"true",
      );


      $bbb_url = 'https://'.$bbb_site.'/bigbluebutton/api/join?'.http_build_query($bbb_query_arr); 
      $checksum = sha1('join'.http_build_query($bbb_query_arr).$bbb_salt);
      $bbb_url = $bbb_url.'&checksum='.$checksum; 
      echo $bbb_url;
    }
    
  }

  public function bbb_get_meeting_infos()
  {
    session_start();

    $user_model = $this->model("users");
    $virtual_congress_model = $this->model("virtual_congress_model");
    
    if(isset($_SESSION["user"])){        
      $this->congress_goaway($user_model,$virtual_congress_model);           
    }
    else{
        exit;
    }
    if(isset($_POST["session_name"]) || isset($_GET["session_name"]))
    {
      
      $abstract_websites = $virtual_congress_model->allcategorywebsites();
      $bbb_infos = json_decode($abstract_websites[0]["bbb_infos"]);
      
      $bbb_site = $bbb_infos[0];
      $bbb_salt = $bbb_infos[1];
      $bbb_at_pw = $bbb_infos[2];
      $bbb_md_pw = $bbb_infos[3];

      $bbb_query_arr = array(
        'meetingID'=>($_POST["session_name"])? $_POST["session_name"] : $_GET["session_name"],//MeetingId
      );
      $url = 'https://'.$bbb_site.'/bigbluebutton/api/getMeetingInfo?'.http_build_query($bbb_query_arr); 

      $checksum = sha1('getMeetingInfo'.http_build_query($bbb_query_arr).$bbb_salt);
      $bbb_url = $url.'&checksum='.$checksum;
      echo $bbb_url;

    }
  }


  public function bbb_get_recordings_infos()
  {
    session_start();

    $user_model = $this->model("users");
    $virtual_congress_model = $this->model("virtual_congress_model");
    
    if(isset($_SESSION["user"])){        
      $this->congress_goaway($user_model,$virtual_congress_model);           
    }
    else{
        exit;
    }
    if(isset($_POST["session_name"]) || isset($_GET["session_name"]))
    {
      
      $abstract_websites = $virtual_congress_model->allcategorywebsites();
      $bbb_infos = json_decode($abstract_websites[0]["bbb_infos"]);
      
      $bbb_site = $bbb_infos[0];
      $bbb_salt = $bbb_infos[1];
      $bbb_at_pw = $bbb_infos[2];
      $bbb_md_pw = $bbb_infos[3];

      $bbb_query_arr = array(
        'record_ID'=>($_POST["session_name"])? $_POST["session_name"] : $_GET["session_name"],//MeetingId
      );
      $url = 'https://'.$bbb_site.'/bigbluebutton/api/getRecordings?'.http_build_query($bbb_query_arr); 

      $checksum = sha1('getRecordings'.http_build_query($bbb_query_arr).$bbb_salt);
      $bbb_url = $url.'&checksum='.$checksum;
      echo $bbb_url;

    }
  }

  public function virtual_congress_index()
  {

      header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
      header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
      session_start();
      
      $user_model = $this->model("users");
      $virtual_congress_model = $this->model("virtual_congress_model");
      $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
      
      if(isset($_SESSION["user"])){     
      $this->congress_goaway($user_model,$virtual_congress_model);           
      }
      else{
          header("location:/");
          exit;
      }
  
      if((isset($_POST["session_name"]) || isset($_GET["session_name"])))
      {

        $session_name = (isset($_POST["session_name"]))? $_POST["session_name"] : $_GET["session_name"];

        if(isset($_POST["user_type"]))
        {
          $user_type = $_POST["user_type"];
        }
        else
        {
          $user_type = "attendee";
        }

        $session_infos_xml="";
        if(isset($_POST["session_infos"]))
        {
          $session_infos = json_decode($_POST["session_infos"]);

          if(count($session_infos)>0)
          {
            $session_infos_xml_start = '<?xml version="1.0" encoding="UTF-8"?> <modules> <module name="presentation"> ';
            $session_infos_xml_end = '</module></modules>';
          
          }
        
          for($i=0;$i<count($session_infos);$i++)
          {
              //çoklu kongrelerde düzenlenecek
              $session_infos_xml .= '<document filename="'.strval(explode("/",$session_infos[$i])[0]).'-.pdf" url="http://'.$_SERVER['SERVER_NAME'].'/view/abstracts/presentations/Bitki%20Koruma%20Kongresi/'.rawurlencode(explode("/",$session_infos[$i])[0])."/".rawurlencode(explode("/",$session_infos[$i])[1]).'" /> ';
          }
          $session_infos_xml = $session_infos_xml_start.$session_infos_xml.$session_infos_xml_end;
        
        }
        else if(isset($_POST["session_infos_xml"]))
        {
          $session_infos_xml = $_POST["session_infos_xml"];
        }
        echo '
        <br>

        <div class="col-lg-4 col-md-4" style="margin:auto;">
          <button class="form-control" onclick="redirect(\'/\')">Ana Sayfa\'ya Dön</button>
        </div>
        </br>
        <div id="myframe"><iframe  class="inner-iframe"src="" style="margin: 0 auto;display:block; width:calc(100% / 1.2);height:calc(100% / 1.2); border-radius:20px; box-shadow:0px 0px 20px 10px #888888;" allowusermedia=""  allow="fullscreen; display-capture ; microphone ; camera *" frameborder="0">
        
        
        </iframe></div>';






      
        echo '
        <script  src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

        
        <script>
        myframe = document.getElementsByTagName("iframe")[0];
        myframe_div = document.getElementById("myframe");


    /*
        $( document ).ready(function() {
            $.ajax({
              url:"'.$create_url.'",
              type:"POST",
              headers: { 
                "Accept" : "application/xml; charset=utf-8",
                "Content-Type": "application/xml; charset=utf-8"
              },
              data:"<?xml version=\'1.0\' encoding=\'UTF-8\'?> <modules> <module name=\'presentation\'> <document url=\'https://ekongre.nutuva.com/view/abstracts/presentations/Bitki%20Koruma%20Kongresi/EP25/YENİ%20BEYZA%20BK%20KONGRESİ%20POSTER.pdf\' /> </module></modules>",
              dataType:"xml"
              crossdomain: true
            })  
        });*/';

      
        if($user_type == "moderator" && $user_index["uye_yetki"] == "3")
        {
          echo '


          function postForm(path, params, method) {
            method = method || \'post\';
        
            var form = document.createElement(\'form\');
            form.setAttribute(\'method\', method);
            form.setAttribute(\'action\', path);
        
            for (var key in params) {
                if (params.hasOwnProperty(key)) {
                    var hiddenField = document.createElement(\'input\');
                    hiddenField.setAttribute(\'type\', \'hidden\');
                    hiddenField.setAttribute(\'name\', key);
                    hiddenField.setAttribute(\'value\', params[key]);
        
                    form.appendChild(hiddenField);
                }
            }
        
            document.body.appendChild(form);
            form.submit();
        }

          function createCORSRequest(method, url) {
            var xhr = new XMLHttpRequest();
            if ("withCredentials" in xhr) {
              // XHR for Chrome/Firefox/Opera/Safari.
              xhr.open(method, url, true);
            } else if (typeof XDomainRequest != "undefined") {
              // XDomainRequest for IE.
              xhr = new XDomainRequest();
              xhr.open(method, url);
            } else {
              // CORS not supported.
              xhr = null;
            }
            return xhr;
          }
          $.post("/bbb_get_meeting_infos",{session_name:"'.$session_name.'"},function(bbb_link){
            $.post(bbb_link,{},function(is_active){
              if(is_active.getElementsByTagName("returncode")[0].textContent == "SUCCESS")
              {
                $.post("/bbb_join_as_'.$user_type.'",{"session_name":"'.$session_name.'"},function(data){
                  myframe.src = String(data);
                }).fail(function(){
                  console.log(myframe.innerHTML);
                  myframe_div.innerHTML = "<div style=\'display:flex;align-items:center;justify-content:center\'><h4>Bu görüşme henüz başlamamıştır.<h4></div>";
                });
              }
              else
              {
                    
                $.post("/bbb_create_without_preupload",{session_name:"'.$session_name.'"},function(data)
                {
                    
                  
                  var url = data;
                  var method = \'POST\';
                  var xhr = createCORSRequest(method, url);

                  xhr.onload = function() {
                
                    $.post("/bbb_join_as_'.$user_type.'",{"session_name":"'.$session_name.'"},function(data){
                      myframe.src = String(data);
                    }).fail(function(){
                      console.log(myframe.innerHTML);
                      myframe_div.innerHTML = "<div style=\'display:flex;align-items:center;justify-content:center\'><h4>Bu görüşme henüz başlamamıştır.<h4></div>";
                    });
                  
                    
                  };
                  
                  xhr.onerror = function() {
                    setTimeout(function(){
                      postForm(window.location.href+"?session_name='.$session_name.'&user_type='.$user_type.'",{session_infos:'.json_encode($_POST["session_infos"],JSON_UNESCAPED_UNICODE).'})
                    },3000);
                  };
                  
                  xhr.send(\''.$session_infos_xml.'\');
                  
                }).fail(function(){
                  console.log("olmadı");
                });
              }
            })
          });
              ';

        }
        else
        {
          echo '  

              $.post("/bbb_join_as_'.$user_type.'",{"session_name":"'.$session_name.'"},function(data){

                $.post("/bbb_get_meeting_infos",{session_name:"'.$session_name.'"},function(is_active){

                  $.get(is_active,{},function(result){
                    if(result.getElementsByTagName("returncode")[0].textContent == "SUCCESS")
                    {
                      myframe.src = String(data);
                    }
                    else
                    {
                      console.log(myframe.innerHTML);
                      myframe_div.innerHTML = "<div style=\'display:flex;align-items:center;justify-content:center\'><h4>Bu görüşme henüz başlamamıştır.<h4></div>";
                    }
                });

                });
              
                }).fail(function(){
                  console.log(myframe.innerHTML);
                  myframe_div.innerHTML = "<div style=\'display:flex;align-items:center;justify-content:center\'><h4>Bu görüşme henüz başlamamıştır.<h4></div>";
                });
        
          ';
        }
      echo '
      /*
      var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST","'.$create_url.'",true);
        xmlhttp.setRequestHeader(\'Content-Type\', \'application/xml\');
        xmlhttp.setRequestHeader(\'charset\', \'UTF-8\');
        xmlhttp.setRequestHeader(\'Access-Control-Allow-Origin\', \'*\');
        xmlhttp.setRequestHeader(\'Referrer-Policy\', \'origin-when-cross-origin\');
        
        
        xmlhttp.send(\'<?xml version="1.0" encoding="UTF-8"?> <modules> <module name="presentation"> <document url="http://ekongre.nutuva.com/view/abstracts/presentations/Bitki Koruma Kongresi/EP25/YENİ BEYZA BK KONGRESİ POSTER.pdf" /> </module></modules>\'); 
        
        var createCORSRequest = function(method, url) {
            var xhr = new XMLHttpRequest();
            if ("withCredentials" in xhr) {
              // Most browsers.
              xhr.open(method, url, true);
            } else if (typeof XDomainRequest != "undefined") {
              // IE8 & IE9
              xhr = new XDomainRequest();
              xhr.open(method, url);
            } else {
              // CORS not supported.
              xhr = null;
            }
            return xhr;
          };
          
          var url = "'.$create_url.'";
          var method = \'POST\';
          var xhr = createCORSRequest(method, url);
          
          xhr.onload = function() {
            // Success code goes here.
          };
          
          xhr.onerror = function() {
            // Error code goes here.
          };
          
          
          xhr.setRequestHeader(\'Referer\', \'http://www.google.com\');
          xhr.send(\'<?xml version="1.0" encoding="UTF-8"?> <modules> <module name="presentation"> <document url="http://ekongre.nutuva.com/view/abstracts/presentations/Bitki%20Koruma%20Kongresi/HS2/209_sunu.pdf" /> </module></modules>\');
        

        setTimeout(() =>{
            $.get("'.$bbb_url.'",{},function(data){
                console.log(data.getElementsByTagName("url")[0].innerHTML)
              myframe.src = String(data.getElementsByTagName("url")[0].innerHTML);
            }).fail(function(){
                console.log(myframe.innerHTML);
                myframe_div.innerHTML = "<div style=\'justify-content:center\'><h4>Bu görüşme henüz başlamamıştır.<h4></div>";
            });
    
        },3000);
        */

        function redirect(url)
        {
          window.location.href=url;
        }

          



      </script>
      ';


    

      
      }
      else
      {
        header("location:/");
        exit();
      }
    }






  public function congress_certificate()
  {

      
      
      //Düzenlenmeli (bitki koruma kongresi yazısı)
      include __DIR__."/simple_html_dom.php";

      session_start();

      $user_model = $this->model("users");
      $abstract_model = $this->model("model_abstract");
      $virtual_congress_model = $this->model("virtual_congress_model");

      if(isset($_SESSION["user"]) ){      
        $this->congress_goaway($user_model,$virtual_congress_model);           
      }
      else{
          header("location:/login");
          exit;
      }



      $user_index = $user_model->getuserindex("uye",$_SESSION["user"]["uye_mail"],$_SESSION["user"]["uye_sifre"]);
      $register_id =$user_index["id"];
      
      $scientific_program = json_decode($abstract_model->allcategorywebsites()[0]["scientific_program"]);
      
  
      
      $language = $this->language()[$user_index["uye_dil"]]["accepted_abstract_document"];


      $location="";
      for($i=1;$i<count(explode("/",__DIR__))-1;$i++)
      {
          $location .= "/".explode("/",__DIR__)[$i];
      }

  
      setlocale(LC_ALL, "tr_TR");

      $session_name ="";
      $session_date = "";
      $session_time = "";
      $saloon_name = "";
      $member_program_lang="";
      $cakisma=0;
      if($user_index["uye_dil"] != "tr")
      {
          $member_program_lang = "_".$user_index["uye_dil"];
      }
  

      $pdf = new tFPDF('L','mm',"A4");
      $pdf->AddPage(); 
      $pdf->AddFont('Playball','','Playball-Regular.ttf',true);

      $pdf->Image($location.'/view/abstracts/pdfsamples/Bitki_Koruma_Kongresi/sertifika.png',0,0,296,210,'PNG');

      /*
      if($user_index["uye_dil"] == 'tr')
      {
          $pdf->Image($location.'/view/abstracts/pdfsamples/Bitki_Koruma_Kongresi/sertifika.png',0,0,296,210,'PNG');
      }
      else
      {
          $pdf->Image($location.'/view/abstracts/pdfsamples/Bitki_Koruma_Kongresi/sertifika_'.$user_index["uye_dil"].'.png',0,0,296,210,'PNG');
      }
      */
      $pdf->SetTextColor(45, 55, 55);
      //oturum başkanı adı
      $pdf->SetFont('Playball','',20);
      $pdf->SetXY(93,89);
      $pdf->Write(10,mb_strtoupper($user_index["uye_adi"])." ".mb_strtoupper($user_index["uye_soyadi"]));
      $pdf->Output();
      return;

  }
}



?>

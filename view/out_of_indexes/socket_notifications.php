




<!DOCTYPE html>
<html>
  <head>

  <?php 
  if(strpos($_SERVER['HTTP_USER_AGENT'],"/MSIE") != false || strpos($_SERVER['HTTP_USER_AGENT'],"Trident/") != false)
  {
    echo '

    
    
    
    <link href="view/css/bootstrap.min.css" rel="stylesheet" />
  
    ';

    echo '<div style="z-index:10001;display:flex;position:absolute;width:100%;height:100%;justify-content:center;align-items:center;background-color:black;opacity:.6;"><div class="col-lg-7 col-md-7" style="padding:40px;border:2px solid #3da5c4; border-radius:10px;font-size:25px;color:white;opacity:1;">Kullandığınız tarayıcı tüm özellikleri desteklemiyor. Lütfen güncel tarayıcılar ile tekrar giriş yapmayı deneyin.</div></div>';
    exit; 
  }

  

 ?>

    <script src="https://cdn.socket.io/3.1.3/socket.io.min.js" integrity="sha384-cPwlPLvBTa3sKAgddT6krw0cJat7egBga3DJepJyrLl4Q9/5WLra3rrnMcyTyOnh" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <style>
       @keyframes notification_move{
          from{
            top:-400px;
          }
          to{
            top:0px;
          }
      }
      .notification-div
      {
        z-index:10000;
        width:400px;
        height:auto;
        display:fixed;
        position:absolute;
        top:0px;
        background-color:#5496ff;
        margin:20px;
        padding:20px;
        border-radius:5px;
        display:none;
      }


    </style>
    </head>
    
    <body>
      
    
    <div class="notification-div">

    </div>


    <div id="messenger-modal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h4>Sohbetlerim</h4>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#messenger-modal').modal('hide');">Kapat</button>
              </div>
              <div class="modal-body"> 
                  <iframe id="messenger-iframe" src="/virtual_congress_private_chat" frameborder="0" style="width:100%;height:500px;"></iframe>  
              </div>
              <div class="modal-footer">
              </div>
          </div>
      </div>
  </div>
 

  <div id="phone-messenger-modal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h4>Görüntülü Görüşme</h4>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="close_phone_call()">Kapat</button>
              </div>
              <div class="modal-body"> 
                  <iframe id="phone-messenger-iframe" src="" frameborder="0" allowusermedia=""  allow="fullscreen; display-capture ; microphone ; camera *" style="width:100%;height:500px;"></iframe>  
              </div>
              <div class="modal-footer">
              </div>
          </div>
      </div>
  </div>

    <script>
/*
    window.onload = function(){

      var ua = window.navigator.userAgent;
      var isIE = /MSIE|Trident/.test(ua);

      if ( isIE ) {
        alert(1);
      }
    }

*/
    var phone_messenger_iframe = document.getElementById("phone-messenger-iframe");
    var notification_div = document.getElementsByClassName("notification-div")[0];

    var all_online_users={};
        
    $(document).ready(function () {
      $('#phone-messenger-modal').modal({
              backdrop: 'static',
              keyboard: false,
              show: false
      });
      
    });



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

    function showGetResult( url,data="" )
    {
        var result = null;
        var scriptUrl = url;
        $.ajax({
            url: scriptUrl,
            type: 'post',
            dataType: 'html',
            async: false,
            data:data,
            success: function(data) {
                result = data;
            } 
        });
        return result;
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
              



    function start_text_meeting(id)
    {
        if(user_index != id)
        {
            $('#all-user-chat-modal').modal('hide');
            $('#info-desk-modal').modal('hide');

            $('#messenger-modal').modal('show');
            var messenger_iframe = document.getElementById("messenger-iframe");
            messenger_iframe.src = "/virtual_congress_private_chat?chat_user="+id;
        }
        else
        {
            alert("Kullanıcılar kendilerine mesaj gönderemez.");
        }   
    }


    function start_bbb_meeting(id)
    {
        if(id != user_index)
        {
                
            msg = {
                to:id,
                from:user_index,
                from_name:user_index_name,
                permission:0,
            };
            notification_socket.emit("bbb-notifications",msg);
            phone_call_wait_message.style.display = "flex";
            setTimeout(() => {
                phone_call_wait_message.style.display = "none";
            }, 10000);
        }
        else
        {
            alert("Kullanıcılar kendileriyle görüşme başlatamaz.");
        }
    } 


    function open_bbb_meeting(msg)
    {
      msg.permission = 1;
      var random_number = Math.floor(Math.random()*100000000000000);
      var session_name = user_index_name+" - "+user_index_company+" - "+random_number;
      msg.url = "/bbb_join_as_moderator?session_name="+session_name;


      $.post("/bbb_create_without_preupload",{session_name:session_name},function(data){
          var url = data;
          var method = 'POST';
          var xhr = createCORSRequest(method, url);
          
          xhr.onload = function() {
              $.post("/bbb_join_as_moderator",{session_name:session_name},function(data){
                phone_messenger_iframe.src = String(data);
                $('#phone-messenger-modal').modal('show');
                notification_socket.emit("bbb-chat-permission",msg);
               

            }).fail(function(){
                phone_messenger_iframe_div.innerHTML = "<div style=\'justify-content:center\'><h4>Bu görüşme henüz başlamamıştır.<h4></div>";
            });
          };
          
          xhr.onerror = function() {
            // Error code goes here.
          };

          xhr.send('<\?xml version="1.0" encoding="UTF-8"?> <modules> <module name="presentation"> </module></modules>');
          
        }).fail(function(){
            console.log("olmadı");
        });

        notification_div.style.display = "none";
    }

    function close_phone_call()
    {
      phone_messenger_iframe.src = "";
      $('#phone-messenger-modal').modal('hide');
    }
    function show_text_meeting(id)
    {
      $('#all-user-chat-modal').modal('hide');
      $('#messenger-modal').modal('show');
      var messenger_iframe = document.getElementById("messenger-iframe");
      messenger_iframe.src = "/virtual_congress_private_chat?chat_user="+id;
      $("#messenger-modal").modal("show");
      close_notification();
    }
    function close_phone_call_notification(msg)
    {
  
      var notification_div = document.getElementsByClassName("notification-div")[0];
      notification_div.style.display = "none";
      notification_div.style.animation = "";
      msg.permission = 2;
      notification_socket.emit("bbb-chat-permission",msg);
    }


    function close_notification()
    {
      notification_div.style.display = "none";
      notification_div.style.animation = "";
    }

    function all_users_activity()
    {
      var controllable_users = document.getElementsByClassName("controllable-users");

      for(i=0;i<controllable_users.length;i++)
      {
        if(typeof all_online_users[controllable_users[i].dataset.id] != "undefined")
        {
            
            controllable_users[i].innerHTML = '<i style="color:green;text-align:center;" class="fas fa-signal fa-2x"></i>';
        }
        else
        {
            controllable_users[i].innerHTML = '<i style="color:red;text-align:center;" class="far fa-times-circle fa-2x"></i>';
        }
      } 
    }


    window.addEventListener('load', function (){
                
      var controllable_users = document.getElementsByClassName("controllable-users");

      for(i=0;i<controllable_users.length;i++)
      {
        if(typeof all_online_users[controllable_users[i].dataset.id] != "undefined")
        {
            
            controllable_users[i].innerHTML = '<i style="color:green;text-align:center;" class="fas fa-signal fa-2x"></i>';
        }
        else
        {
            controllable_users[i].innerHTML = '<i style="color:red;text-align:center;" class="far fa-times-circle fa-2x"></i>';
        }
      } 
    });
  
    var user_index = '<?php echo $user_index["id"]; ?>';
    var user_index_name = '<?php echo $user_index["uye_adi"].' '.$user_index["uye_soyadi"]; ?>';
    var user_index_company = '<?php echo $user_index["stand_info"]; ?>';




    var connectionOptions =   {
        rememberUpgrade:true,
        transports: ['websocket'],
        secure:true, 
        rejectUnauthorized: false
    };
    var notification_socket = io("<?php echo json_decode($abstract_websites["chat_app_infos"])[0];?>",connectionOptions);
    //var notification_socket = io("http://localhost:8080",connectionOptions);

  

      
    notification_socket.on("connect", () => {
        notification_socket.emit("join-notification",{id:user_index});
        console.log(notification_socket.id); // false    
    });



    notification_socket.on('text-notifications', function(msg) {

        if(msg.from != user_index)
        {
          notification_div.style.animation = "";
          if($('#messenger-modal').is(':visible') === false)
          {

            notification_div.style.display = "block";
            notification_div.style.animation = "notification_move 5s";
            notification_div.innerHTML = "<button style='position:absolute;right:0px;top:0px;background:none;margin:5px;border:0px;' onclick='close_notification()'><i class='fas fa-times'></i></button><h5>"+msg.from_name+" size bir mesaj gönderdi.<button class='form-control' onclick='show_text_meeting(\""+msg.from+"\")' >Görüntüle</button ><h5>";
          }
        }
      });

      notification_socket.on('bbb-notifications', function(msg) {

        if(msg.from != user_index)
        {
          notification_div.style.animation = "";
          if($('#phone-messenger-modal').is(':visible') === false)
          {
            notification_div.style.display = "block";
            notification_div.style.animation = "notification_move 5s";
            notification_div.innerHTML = "<button style='position:absolute;right:0px;top:0px;background:none;margin:5px;border:0px;' onclick='close_phone_call_notification("+JSON.stringify(msg)+")'><i class='fas fa-times'></i></button><h5>"+msg.from_name+" bir görüntülü görüşme talep etti.<h5><div style='display:flex;'><button class='form-control' onclick='open_bbb_meeting("+JSON.stringify(msg)+")' >Onayla</button ><button class='form-control' onclick='close_phone_call_notification("+JSON.stringify(msg)+")'>Reddet</button>";
          }
        }
      });

      notification_socket.on('bbb-chat-permission-reciever', function(msg) 
      {
          if(msg.from == user_index)
          {
              if(msg.permission == 1)
              {
                  phone_call_wait_message.style.display = "none";
                  var url = showGetResult(msg.url)
                  phone_messenger_iframe.src = url;
                  $('#all-user-chat-modal').modal('hide');
                  $("#phone-messenger-modal").modal("show");
          

              }
              else if(msg.permission == 2)
              {
                phone_call_wait_message.style.display = "none";
                alert("Kullanıcı görüşme isteğini reddetti");

              }
          }
      });

      notification_socket.on("all online users",function(msg){
        all_online_users = msg;
      });
    </script>
  </body>
</html>
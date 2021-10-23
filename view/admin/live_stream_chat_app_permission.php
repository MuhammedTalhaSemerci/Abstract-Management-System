



<?php

$chat_app_domain =json_decode($abstract_websites[0]["chat_app_infos"])[0]; 

?>


<!DOCTYPE html>
<html>
  <head>
    <title>Socket.IO chat</title>
    <style>
      
      #form { background: rgba(0, 0, 0, 0.15); padding: 0.25rem;  display: flex; height: 3rem; box-sizing: border-box; backdrop-filter: blur(10px); }
      #input { border: none; padding: 0 1rem; flex-grow: 1; border-radius: 2rem; margin: 0.25rem; }
      #input:focus { outline: none; }
      #form > button { background: #333; border: none; padding: 0 1rem; margin: 0.25rem; border-radius: 3px; outline: none; color: #fff; }

      #messages { list-style-type: none; margin: 0; padding: 0; }
      #messages > li { padding: 0.5rem 1rem; }
      #messages > li:nth-child(odd) { background: #efefef; }
    </style>
  </head>
  <body>
    <form id="form" action="">
      <input id="input" autocomplete="off" /><button>Send</button>
    </form>
    <ul id="messages"></ul>

    <script src="https://cdn.socket.io/3.1.3/socket.io.min.js" integrity="sha384-cPwlPLvBTa3sKAgddT6krw0cJat7egBga3DJepJyrLl4Q9/5WLra3rrnMcyTyOnh" crossorigin="anonymous"></script>
  
    <script>

    var connectionOptions =   {
        rememberUpgrade:true,
        transports: ['websocket'],
        secure:true, 
        rejectUnauthorized: false
    };
      var socket = io("<?php echo $chat_app_domain;?>",connectionOptions);
      //var socket = io("http://localhost:8080",connectionOptions);

      var messages = document.getElementById('messages');
      var form = document.getElementById('form');
      var input = document.getElementById('input');

      form.addEventListener('submit', function(e) {
        e.preventDefault();
        if (input.value) {
          socket.emit('live stream chat', { id: "<? echo $primer_index["id"];?>", name: 'Admin', message: input.value, permission: 1});
          input.value = '';
        }
      });

      socket.on('live stream chat wo/permission', function(msg) {
        var item = document.createElement('li');
        var button = msg.name+": "+msg.message+"<button onclick='sendtolivechat(this,"+JSON.stringify(msg)+")'>Onayla</button>";
        item.innerHTML = button;

        messages.appendChild(item);
        window.scrollTo(0, document.body.scrollHeight);
      });



        function sendtolivechat(el,msg)
        {
          if(confirm("Bu işlemi gerçekleştirmek istediğinizden emin misiniz ?"))
          {
            socket.emit('live stream chat',msg);
            alert("onaylama işlemi başarılı oldu");
          }
          else
          {
            alert("onaylama işlemi iptal edildi");
          }
          el.outerHTML ="-- Onaylandı";
        }

     
        var all_messages_starter=0;

        function communication_starter(room)
        {

          socket.on(room, function(msg) 
          {

            if(all_messages_starter == 0)
            {
              for(i=0;i<msg.length;i++)
              {
                var item = document.createElement('li');

                var item_inner = (msg[i].permission == 0)? msg[i].name+": "+msg[i].message+"<button onclick='sendtolivechat(this,"+JSON.stringify(msg[i])+")'>Onayla</button>" : msg[i].name+": "+msg[i].message+"--onaylandı";
                item.innerHTML = item_inner;
                messages.appendChild(item);
                window.scrollTo(0, document.body.scrollHeight);
              }
              all_messages_starter++;

            }
            
            

          });
        }
      var live_stream_starter = communication_starter('live stream chat wo/permission all messages');
      


  

    </script>
  </body>
</html>



<!DOCTYPE html>
<html>
  <head>
    <title>Socket.IO chat</title>
    <style>

        @keyframes messageWarning 
        {
            0%{
                background-color:rgba(40,150,20,.4);
            }  
            50%{
                background-color:rgba(150,150,150,.4);
            } 
            100%{
                background-color:rgba(40,150,20,.4);
            }
        }

        body { margin: 0; padding-bottom: 3rem; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; }

        .new-user
        {
            background-color:rgba(40,150,20,.4);
        }

        #form { background: rgba(0, 0, 0, 0.15); padding: 0.25rem; position: fixed; bottom: 0; left: 0; right: 0; display: flex; height: 3rem; box-sizing: border-box; backdrop-filter: blur(10px); }
        #input { border: none; padding: 0 1rem; flex-grow: 1; border-radius: 2rem; margin: 0.25rem; }
        #input:focus { outline: none; }
        #form > button { background: #333; border: none; padding: 0 1rem; margin: 0.25rem; border-radius: 3px; outline: none; color: #fff; }

        .messages,#chat_users { list-style-type: none; margin: 0; padding: 0; }
        .messages > li { padding: 0.5rem 1rem; border:1px solid rgba(150,150,150,1);border-radius:5px;overflow-wrap: break-word;}
        #chat_users > li { height:70px;padding: 0.5rem 1rem; border:1px solid rgba(150,150,150,1);border-radius:5px;overflow-wrap: break-word;}
        #messages-div
        {
            overflow-y:scroll;
            height: calc(100vh - 86px);
            border:1px solid rgba(150,150,150,1);
        }

        #users-div
        {
            overflow-y:scroll;
            height: calc(100vh - 50px);
            border:1px solid rgba(150,150,150,1);
        }
        .my-messages
        {
            text-align:right;
            background-color:rgba(40,150,20,.4);

        }
        .other-messages
        {
            text-align:left;
            background-color:rgba(150,150,150,.4);

        }

        .controllable-users
        {
            text-align:left;
            background-color:rgba(150,150,150,.4);
        }
      
    </style>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">  
    </head>
    <body>
        <div style="display:flex;">
            <div id="users-div" class="col-4">
                <ul id="chat_users">
                   
                <?php 
                    if(isset($chat_user))
                    {
                        echo '<li class="new-user controllable-users" id="chat-'.$chat_user['id'].'" data-id="'.$chat_user['id'].'" data-name="'.$chat_user['uye_adi'].' '.$chat_user['uye_soyadi'].'"  onclick="selected_talk(\''.$chat_user['id'].'\',\''.$chat_user['uye_adi'].' '.$chat_user['uye_soyadi'].'\',this)">'.$chat_user['uye_adi'].' '.$chat_user['uye_soyadi'].'</li>';
                    }
                ?>
                </ul>
            </div>
            <div style="display:block;" class="col-8">
                <div style="display:flex;justify-content:center;" id="user-name-title">
                </div>
                <div id="messages-div" class="messages-div">
                </div>
            </div>
        </div>
      
        <form id="form" action="">
        <input id="input" autocomplete="off" /><button>Gönder</button>
    </form>
    <script src="https://cdn.socket.io/3.1.3/socket.io.min.js" integrity="sha384-cPwlPLvBTa3sKAgddT6krw0cJat7egBga3DJepJyrLl4Q9/5WLra3rrnMcyTyOnh" crossorigin="anonymous"></script>
  
    <script>


        

    var user_index = '<?php echo $user_index["id"]; ?>';
    var user_index_name = '<?php echo $user_index["uye_adi"].' '.$user_index["uye_soyadi"]; ?>';

    var chat_user_index = '';
    var chat_user_name = '';


    window.onload = function()
    {
        var all_users_chat_block = document.getElementsByClassName("controllable-users");
        var first_user_chat_block = document.getElementsByClassName("controllable-users")[0];
        if(chat_user_index == first_user_chat_block.dataset.id && chat_user_name == first_user_chat_block.dataset.name)
        {
            messageWarning(first_user_chat_block,all_chat_users_blocks);
        }
    }


    function updateScroll(div){
        var element = document.getElementsByClassName(div)[0];
        element.scrollTop = element.scrollHeight;
    }
    function create_chat_user_li_element(class_name="",onclick,id_starter,name,parent,first_or_last="last")
    {
        var item = document.createElement('li');
        item.className = class_name;
        item.id = id_starter+onclick;
        item.dataset.id = onclick;
        item.dataset.name = name;
        item.setAttribute("onclick", "selected_talk('"+onclick+"','"+name+"',this)");
        item.textContent =  name;
        if(first_or_last == "last")
        {
            parent.appendChild(item);
        }
        else if(first_or_last == "first")
        {
            parent.prepend(item);
        }
        return item;

    }

    function create_ul_element(class_name="",id,parent)
    {
        var item = document.createElement('ul');
        item.className = class_name;
        item.id = id;
        item.style.display="none";
        parent.appendChild(item);
        return item;
    }

    function create_li_element (class_name="",msg,parent)
    {
        var item = document.createElement('li');
        item.className = class_name;
        item.textContent =  msg.from_name+": "+msg.message;
        parent.appendChild(item);
        return item;
    }

    window.onload = function (){
        var message_sender = document.getElementById("form");
        message_sender.style.display = "none";

        if(document.getElementsByClassName("controllable-users").length == 1)
        {
            var first_chat_block = document.getElementsByClassName("controllable-users")[0];
            var chat_block = (document.getElementById("messages-"+first_chat_block.dataset.id) != null)?
                document.getElementById("messages-"+first_chat_block.dataset.id) : 
                create_ul_element("messages","messages-"+first_chat_block.dataset.id,messages_div);
                
            first_chat_block.style.backgroundColor = "rgba(40,150,20,.4)";
            message_sender.style.display = "flex";
            chat_block.style.display = "block";
            chat_user_index = first_chat_block.dataset.id;
            chat_user_name = first_chat_block.dataset.name;

            document.getElementById("user-name-title").innerHTML= '<h4>'+first_chat_block.dataset.name+'</h4>';
        }
        else
        {
            
        }
    }

    function auto_chat_start()
    {
        if(document.getElementsByClassName("controllable-users").length > 1)
        {
            var first_chat_block = (document.getElementsByClassName("controllable-users"))[0];

            var chat_block = (document.getElementById("messages-"+first_chat_block.dataset.id) != null)?
                document.getElementById("messages-"+first_chat_block.dataset.id) : 
                create_ul_element("messages","messages-"+first_chat_block.dataset.id,messages_div);

            first_chat_block.style.backgroundColor = "rgba(40,150,20,.4)";
            chat_block.style.display = "block";
            chat_user_index = first_chat_block.dataset.id;
            chat_user_name = first_chat_block.dataset.name;
            document.getElementById("user-name-title").innerHTML= '<h4>'+first_chat_block.dataset.name+'</h4>';

        }
    }

    function selection_changer(all_chat_users_blocks,id)
    {

        if(all_chat_users_blocks.length > 0)
        {
            for(i=0;i<all_chat_users_blocks.length;i++)
            {
                if(all_chat_users_blocks[i].dataset.id == id)
                {
                    all_chat_users_blocks[i].style.backgroundColor = "rgba(40,150,20,.4)";
                }
                else
                {
                    all_chat_users_blocks[i].style.backgroundColor = "rgba(150,150,150,.4)";
                }
            }
        }
       
    }


    function newMessagePos(all_chat_users_div,all_chat_users_blocks,id)
    {
        if(all_chat_users_blocks.length > 0)
        {
            for(i=0;i<all_chat_users_blocks.length;i++)
            {
                if(all_chat_users_blocks[i].dataset.id == id)
                {
                    chat_user_index = all_chat_users_blocks[i].dataset.id;
                    chat_user_name = all_chat_users_blocks[i].dataset.name;
                    all_chat_users_div.prepend(all_chat_users_blocks[i]);
                }
            }
        }
       
    }

    function messageWarning(element,remove_anim_elements=[])
    {
        element.style.animation = "messageWarning 5s infinite";
    }

    function selected_talk(id,name,element)
    {
        var all_chat_blocks = document.getElementsByClassName("messages");
        var all_chat_users_blocks = document.getElementsByClassName("controllable-users");

        element.style.animation = "";
        selection_changer(all_chat_users_blocks,element.dataset.id);
        element.style.backgroundColor  = "rgba(40,150,20,.4)";

        for(i=0;i<all_chat_blocks.length;i++)
        {
            all_chat_blocks[i].style.display = "none";
        }
        var chat_block = (document.getElementById("messages-"+id) != null)?
            document.getElementById("messages-"+id) : 
            create_ul_element("messages","messages-"+id,messages_div);

        chat_block.style.display = "block";

        chat_user_index = id;
        chat_user_name = name;
        document.getElementById("user-name-title").innerHTML= '<h4>'+name+'</h4>';

    }

    var connectionOptions =   {
        rememberUpgrade:true,
        transports: ['websocket'],
        secure:true, 
        rejectUnauthorized: false
    };
    var socket = io("<?php echo json_decode($abstract_websites["chat_app_infos"])[0];?>",connectionOptions);
    //var socket = io("http://localhost:8080",connectionOptions);

    var messages_div = document.getElementById('messages-div');
    var chat_users = document.getElementById('chat_users');

    var form = document.getElementById('form');
    var input = document.getElementById('input');



    form.addEventListener('submit', function(e) {
        e.preventDefault();
        if (input.value) {
           if(chat_user_index != "" && chat_user_name != "")
           {
               console.log(chat_user_name)
                socket.emit('private message', { 
                    to:chat_user_index,
                    to_name: chat_user_name, 
                    from:user_index, 
                    from_name: user_index_name, 
                    message: input.value
                });
                input.value = '';
           } 
           else
           {
               console.log(chat_user_name);
               alert("Mesaj gönderilecek kullanıcı seçilmedi.");
           }
        }
        });

        socket.on("connect", () => {
        socket.emit("join-private",{id:user_index});
        console.log(socket.id); // false    
    });


    socket.on('private chat all messages', function(msg) {
        var message_sender = document.getElementById("form");
        var user_index_count = 0;
        Object.keys(msg).forEach(current_user_index =>{
            message_sender.style.display = "flex";
            user_name = (typeof msg[current_user_index].first_id != "undefined" && typeof msg[current_user_index].second_id != "undefined" && msg[current_user_index].first_id == user_index)? msg[current_user_index].second_name :  msg[current_user_index].first_name;
            if(document.getElementById("chat-"+current_user_index) != null)
            {
            }
            else
            {
                create_chat_user_li_element("controllable-users",current_user_index,"chat-",user_name,chat_users)
            }
            user_index_count++;

            if(typeof msg[current_user_index] != "undefined" && typeof msg[current_user_index].messages != "undefined")
            {
                var ul_element = (document.getElementById("messages-"+current_user_index) != null)? document.getElementById("messages-"+current_user_index) : create_ul_element("messages","messages-"+current_user_index,messages_div);

                for(i=0;i<msg[current_user_index].messages.length;i++)
                {
                    if(msg[current_user_index].messages[i].from == user_index)
                    {
                        msg[current_user_index].messages[i].from_name = "Siz";
                        create_li_element("my-messages",msg[current_user_index].messages[i],ul_element);
                    }
                    else
                    {
                        create_li_element("other-messages",msg[current_user_index].messages[i],ul_element);
                    }
                }
                
            }
            else
            {

            }
            auto_chat_start();
            updateScroll("messages-div");


        });

        if(message_sender.style.display == "none")
        {
            var body = document.getElementsByTagName("body")[0];
            body.style.cssText = "display:flex;justify-content:center;align-items:center;";
            body.innerHTML = "<h4>Daha önce başlatılmış hehangi bir sohbet tespit edilemedi.</h4>";

        }

        updateScroll("messages-div");

        
      
    });

    socket.on('private', function(msg) {

        var all_chat_users_blocks = document.getElementsByClassName("controllable-users");
        var all_chat_users_div = document.getElementById("chat_users");


        if(msg.from == user_index)
        {
            var messages = (document.getElementById("messages-"+msg.to) != null)? 
                document.getElementById("messages-"+msg.to) : 
                create_ul_element("messages","messages-"+msg.to,messages_div);
                

            var new_user = (document.getElementById("chat-"+msg.to) != null)? document.getElementById("chat-"+msg.to):
            create_chat_user_li_element("controllable-users",msg.to,"chat-",msg.to_name,chat_users,"first");
            
            msg.from_name = "Siz";
            create_li_element("my-messages",msg,messages);
        }
        else
        {
            var messages = (document.getElementById("messages-"+msg.from) != null)? 
                document.getElementById("messages-"+msg.from) : 
                create_ul_element("messages","messages-"+msg.from,messages_div);

            var new_user = (document.getElementById("chat-"+msg.from) != null)?document.getElementById("chat-"+msg.from):
            create_chat_user_li_element("controllable-users",msg.from,"chat-",msg.from_name,chat_users,"first");


            create_li_element("other-messages",msg,messages);
        }
        newMessagePos(all_chat_users_div,all_chat_users_blocks,new_user.dataset.id)
        messageWarning(new_user,all_chat_users_blocks);
        updateScroll("messages-div");

    });



/*
     
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
                item.textContent = msg[i].name+": "+msg[i].message;
                messages.appendChild(item);
                window.scrollTo(0, document.body.scrollHeight);
              }
              all_messages_starter++;

            }
            
            

          });
        }
      var live_stream_starter = communication_starter('live stream all messages');
      

*/
  

    </script>
  </body>
</html>
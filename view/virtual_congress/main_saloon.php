<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/view/virtual_congress/perspectivejs/dist/perspective.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a9da6c256f.js" crossorigin="anonymous"></script>   
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.socket.io/3.1.3/socket.io.min.js" integrity="sha384-cPwlPLvBTa3sKAgddT6krw0cJat7egBga3DJepJyrLl4Q9/5WLra3rrnMcyTyOnh" crossorigin="anonymous"></script>
  
    <title>Document</title>
</head>
<body>
<style>


.main_page_redirector {
    position:absolute;
    top:3vw;
    left:5vw;
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


.chat_area 
{ 
    margin: 0; 
    padding-bottom: 3rem; 
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    width:40vw;
    height:auto;
    position:absolute; 
    background-color:white; 
    overflow-y:scroll;
    z-index:11;
    border-radius:10px;
    top:10vw;
    left:2vw;
    display:none;
    background-color:rgba(255,255,255,0.4)
}

#form { background: rgba(0, 0, 0, 0.15); padding: 0.25rem; position:absolute;display: flex; height: 7vw; width:40vw; box-sizing: border-box; backdrop-filter: blur(10px); }
#input { border: none; padding: 0 1rem; flex-grow: 1; border-radius: 2rem; margin: 0.25rem; }
#input:focus { outline: none; }
#form > button { background: #333; border: none; padding: 0 1rem; margin: 0.25rem; border-radius: 3px; outline: none; color: #fff; }

.chat-send-but-div 
{
    top:3vw;
    position:absolute;
    width:100%;
    height:auto; 
    display:flex;
    justify-content:center;
}
#messages { list-style-type: none; margin: 0; padding: 0; opacity:1;}
#messages > li { padding: 0.5rem 1rem; font-size:10px; overflow-wrap: break-word;opacity:1;}
#messages > li:nth-child(odd) { background: #efefef; font-size:10px;overflow-wrap: break-word;opacity:1;}


</style>

<div class="main_page_redirector" onclick="window.location.href='/'" title="Ana Sayfaya Git"><i style="font-size:2vw;" class="fas fa-home fa-2x"></i></div> 

<div style="z-index:100;position:absolute;top:3vw;right:3vw;width:10vw;height:auto;padding:1vw;background-color:white;border-radius:3px;" onclick="redirect('http://nutuva.com/')"><img style="position:relative;width:100%;height:auto;"src="/view/abstracts/organization_company_logo/logo.png"></div>

<div style="display:flex;justify-content:center;position:absolute;z-index:10;width:100%;">
    <div style="position:absolute;top:11vw;left:27%;width:48.2%;">
        <?php
            $admin_page_infos =json_decode($abstract_websites["admin_virtual_congress_but_infos"])->{"main_saloon"};
            echo $admin_page_infos->{"stream_code"};
        ?>
    </div>
</div>   

<div class="chat_area">
    <ul id="messages"></ul>
   
</div>
<div class="chat-send-but-div">
    <div id="form">
        <input id="input" autocomplete="off" placeholder="Soru sor" /><button id="form-send">Gönder</button><button onclick="live_chat_opener()">Canlı Sohbet</button>
    </div> 
</div>


<canvas >
    
    <button id="button1">Sponsor 1</button>
    <button id="button2">Sponsor 2</button>
    <!--<button id="button3">Soru Sor</button>-->
</canvas>


<script>


function redirect(url)
{
    window.open(url,"_blank");
}

const canvas = document.querySelector('canvas')
const ctx = canvas.getContext('2d')
canvas.width = innerWidth
canvas.height = innerHeight
addEventListener('resize', () => {


canvas.width = innerWidth
canvas.height = ((innerWidth/image.height)*600)
ctx.drawImage(image, 0, 0,innerWidth,((image.height/image.width)*innerWidth));
button_renderer();




},true)
    

var image = new Image();


image.src = 'view/virtual_congress/pages/ana_salon.jpeg';

<?php

    $images_str="";
    foreach($admin_page_infos as $main_saloon => $index)
    {
        $images_str .= (property_exists($admin_page_infos->{$main_saloon},"2"))?'var image'.$main_saloon.' = new Image();':"";
        $images_str .= (property_exists($admin_page_infos->{$main_saloon},"2"))?'image'.$main_saloon.'.src = \''.$admin_page_infos->{$main_saloon}->{"2"}.'\';':"";
    }

    echo $images_str;
?>

window.onload = function ()
{
canvas.width = innerWidth
canvas.height = ((image.height/image.width)*innerWidth)
ctx.drawImage(image, 0, 0,innerWidth,((image.height/image.width)*innerWidth));
button_renderer();

image.style.display = 'none';
};
 
const button1 = document.getElementById('button1');
const button2 = document.getElementById('button2');
const button3 = document.getElementById('button3');


document.addEventListener('focus', redraw, true);
document.addEventListener('blur', redraw, true);
canvas.addEventListener('click', handleClick, false);


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
    for(i=0;i<2;i++)
    {
        button_renderer(i);
        if (ctx.isPointInPath(x, y)) {
            if(encounter == 0)
            {
               <?php
                    $links_str = "";
                    foreach($admin_page_infos as $main_saloon => $index)
                    {
                        if(property_exists($admin_page_infos->{$main_saloon},"0") && $admin_page_infos->{$main_saloon}->{"0"} != "")
                        {
                            $links_str .= '                
                                if(i == "'.$main_saloon.'")
                                {
                                    window.location.href="'.$admin_page_infos->{$main_saloon}->{"0"}.'";
                                    encounter += 1;
                                }
                            ';
                        }
                        else
                        {
                            $links_str .='';
                        }
            
                    }
                    echo $links_str;

                ?>
            }
        }
    } 
   
}


function button_renderer(x = null)
{

 


    
    if(x == 0 || x == null)
    {
        drawButton(button1, innerWidth/120,((image.height/image.width)*innerWidth)/18,9.4,20.5,  2, -0.18, -.03, 3, 0, 0,0);
    }
    if(x == 1 || x == null)
    {
        drawButton(button2, innerWidth/2.41,((image.height/image.width)*innerWidth)/100-((image.height/image.width)*innerWidth)/16,7.6,17,  2, 0.4, .03, 3.7, 0, 0,1);
    }
   
    /*if(x == 3 || x == null)
    {
        drawButton(button3, innerWidth/2.4,((image.height/image.width)*innerWidth)/1.4,15,10,  3, 0, 0, .88, 0, 0,2);
    }*/
  


}





function drawButton(el, x, y,but_width,but_height,a,b,c,d,e,f,g) {
    const active = document.activeElement === el;
    const width = innerWidth*but_width/100;
    const height = ((image.height/image.width)*innerWidth)*but_height/100;



    // Button background
    ctx.globalAlpha = 1;

    ctx.fillStyle = "rgba(255,255,255,1)";
    ctx.globalAlpha = .9;

    if(g==0)
    {
        ctx.globalAlpha = .9;
        ctx.resetTransform();
    
        
        if(typeof image0 != "undefined" && image0.src.search("base64") != -1)
        {
            var p = new Perspective(ctx, image0);


            p.draw([
                [ 2.21*x,y*3],
                [ 1.83*x+width+x*10.5, y*3.5 ],
                [ 1.83*x+width+x*10.5,y+height*3.4],
                [ 1.9*x+x/4, y+height*3.5 ]
            ]);
        }

            
          
        ctx.globalAlpha = 0;

        ctx.setTransform(a,b,c,d,e,f);
        ctx.save();
        ctx.beginPath();
        ctx.moveTo( x,y );
        ctx.lineTo( x+width, y+y/2.6);
        ctx.lineTo( x+width, y+height );
        ctx.lineTo( x, y+height );
      
        ctx.closePath();

        ctx.fill();
        ctx.restore();

    }
    else if(g==1)
    {
        

        ctx.resetTransform();
        ctx.globalAlpha = .9;
        if(typeof image1 != "undefined" && image1.src.search("base64") != -1)
        {

    
            var p = new Perspective(ctx, image1);
            p.draw([
                [ 2*x,-y*4],
                [ 1.845*x+width+x/3, y-y*4 ],
                [ 1.83*x+width+x/2.8,y+height*4.9],
                [ 1.75*x+x/4, y+height*4.6 ]
            ]);
            
        }
        ctx.globalAlpha = 0;

        ctx.setTransform(a,b,c,d,e,f);
        ctx.save();
        ctx.beginPath();
        ctx.moveTo( x,y-y/1.7 );
        ctx.lineTo( x+width, y);
        ctx.lineTo( x+width, y+height );
        ctx.lineTo( x, y+height  );
        ctx.closePath();
      
        ctx.fill();
        ctx.restore();
    }
  
   /* else if(g ==2)
    {
        
        ctx.save();
        ctx.globalAlpha = .9;

        ctx.strokeRect(x, y, width, height);
        ctx.beginPath();
        ctx.moveTo( x,y );
        ctx.lineTo( x+width, y);
        ctx.lineTo( x+width, y+height );
        ctx.lineTo( x, y+height );
        ctx.closePath();
        ctx.fill();
        ctx.restore();
        ctx.fill();
        ctx.fillStyle = "rgba(0,0,0,1)";
        printAtWordWrap(ctx, el.textContent, x + width / 2, y + height / 2, height/5, width );
        ctx.globalAlpha = .3;

    }*/


    // Button text
    ctx.font = width/5+'px sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = '';

    ctx.globalAlpha = .7;


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
    ctx.fillStyle = 'yellow';
    ctx.font = width/3.4+'px sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = '';
    ctx.fill();
    ctx.strokeStyle = '#003300';
    ctx.stroke();
    ctx.fillStyle = "rgba(0,0,0,1)";
    ctx.globalAlpha = .8;

    printAtWordWrap(ctx, el.textContent, x , y , height/8, width );
    ctx.fill();
   
  


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
    var words = text.split(' ');
    var currentLine = 0;
    var idx = 1;
    while (words.length > 0 && idx <= words.length)
    {
        var str = words.slice(0,idx).join(' ');
        var w = context.measureText(str).width;
        if ( w > fitWidth )
        {
            if (idx==1)
            {
                idx=2;
            }
            context.fillText( words.slice(0,idx-1).join(' '), x, y + (lineHeight*currentLine) );
            currentLine++;
            words = words.splice(idx-1);
            idx = 1;
        }
        else
        {idx++;}
    }
    if  (idx > 0)
        context.fillText( words.join(' '), x, y + (lineHeight*currentLine) );
}

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
        transports: ['websocket'],
        secure:true, 
        rejectUnauthorized: false
    };
      var socket = io("<?php echo json_decode($abstract_websites["chat_app_infos"])[0];?>",connectionOptions);
      //var socket = io("http://localhost:8080",connectionOptions);

      var messages = document.getElementById('messages');
      var form = document.getElementById('form-send');
      var input = document.getElementById('input');

      form.addEventListener('click', function() {
        if (input.value) {
          socket.emit('live stream chat wo/permission', { id: <?php echo $user_index["id"]; ?>, name: '<?php echo $user_index["uye_adi"]." ".$user_index["uye_soyadi"]; ?>', message: input.value, permission: 0});
          input.value = '';
        }
      },true);

      socket.on('live stream chat', function(msg) {
        var item = document.createElement('li');
        item.textContent =  msg.name+": "+msg.message;
        messages.appendChild(item);
        updateScroll("chat_area");
      });


     
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
                updateScroll("chat_area");

              }
              all_messages_starter++;

            }
            
            

          });
        }
      var live_stream_starter = communication_starter('live stream all messages');
      


</script>
</body>
</html>
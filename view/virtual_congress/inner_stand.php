<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a9da6c256f.js" crossorigin="anonymous"></script>   
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
   
    <title>Document</title>
</head>
<body>
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





body{
    overflow-y:hidden;
}
.main_page_redirector {
    position:absolute;
    top:18.5vw;
    left:10%;
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

.brochures {
    position:absolute;
    top:24vw;
    left:10%;
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
.brochures:hover
{
    opacity:.5;   
}

.text_chat {
    position:absolute;
    top:29.5vw;
    left:10%;
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
.text_chat:hover
{
    opacity:.5;   
}

.voice_chat {
    position:absolute;
    top:35vw;
    left:10%;
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
.voice_chat:hover
{
    opacity:.5;   
}
</style>


<div style="z-index:100;position:absolute;top:3vw;right:3vw;width:10vw;height:auto;padding:1vw;background-color:white;border-radius:3px;" onclick="redirect('http://nutuva.com/')"><img style="position:relative;width:100%;height:auto;"src="/view/abstracts/organization_company_logo/logo.png"></div>

<div style="display:flex;justify-content:center;position:absolute;z-index:20;width:100%;margin:0px;">
    
    <div style="position:absolute;top:9.9vw;left:40%;width:auto;margin:0px;">
        <div id="player"></div>
    </div>
</div>   

<div>
    <div class="main_page_redirector" onclick="window.location.href='/virtual_congress_stand_area'" title="Stand alanına dön"><i style="font-size:2vw;"class="fas fa-long-arrow-alt-left fa-2x"></i></div>
    <div class="brochures" onclick="$('#stand_document_modal').modal('show');" title="Dökümanları görüntüle"><i style="font-size:2vw;" class="fas fa-file-alt fa-2x"></i></div>
    <div class="text_chat" onclick="$('#all-user-chat-modal').modal('show');" title="Görüşme yap"><i style="font-size:2vw;" class="far fa-comments fa-2x"></i></div>
  
</div>

<div id="stand_document_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4><?php echo $sponsor_company;?> Dökümanlarını Görüntüle</h4>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#stand_document_modal').modal('hide');">Kapat</button>
          
            </div>
            <div class="modal-body">
                <?php
                
                    $inner_stand_area_documents =json_decode($abstract_websites["sponsor_congress_logo_but_infos"])->{$sponsor_company}->{"documents"};

                   for($i=0;$i<count($inner_stand_area_documents);$i++)
                    {
                        echo '<h6>Döküman '.($i+1).': </h6><button class="form-control" onclick="redirect(\'/view/abstracts/sponsor_documents/Bitki Koruma Kongresi/'.$sponsor_company.'/'.$inner_stand_area_documents[$i].'\')">'.$inner_stand_area_documents[$i].'</button>';
                    }
                    
                ?>
            </div>
            <div class="modal-footer">
                  </div>
        </div>
    </div>
</div>



<div class="modal fade" id="all-user-chat-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Stand Görevlileri</h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#all-user-chat-modal').modal('hide');">Kapat</button>
        </button>
      </div>
      <div class="modal-body">
        <?php

            echo '<table>';
            if(count($stand_officers)<1)
            {
                echo'<tr><td colspan="3">Herhangi bir stand görevlisi tespit edilemedi.</td></tr>';
            }
            for($i=0;$i<count($stand_officers);$i++)
            {
                if($i == 0)
                {
                    echo '<tr><td style="margin:auto;">Yazılı Görüşme</td><td style="margin:auto;">Görüntülü Görüşme</td><td>Aktiflik</td><tr>';
                }
                echo '<tr><td><button class="form-control" onclick="start_text_meeting(\''.$stand_officers[$i]["id"].'\')">'.$stand_officers[$i]["uye_adi"].' '.$stand_officers[$i]["uye_soyadi"].'</button></td><td><button class="form-control" onclick="start_bbb_meeting(\''.$stand_officers[$i]["id"].'\')">'.$stand_officers[$i]["uye_adi"].' '.$stand_officers[$i]["uye_soyadi"].'</button></td><td class="controllable-users" data-id="'.$stand_officers[$i]["id"].'"></td></tr>';
            }
            echo '</table>';

        ?>
      </div>

    </div>
  </div>
</div>




<div id="phone-call-wait-message" style="z-index:10001;display:none;position:absolute;width:100%;height:100%;justify-content:center;align-items:center;background-color:rgba(0,0,0,.6);opacity:.6;"><div style="opacity:1;color:white;font-size:25px;text-align:center;border:2px solid #537d80;border-radius:30px;" class="col-lg-6 col-md-6 col-10">Görüşme isteği iletildi. İsteğe cevap verilmesini beklerken lütfen bu ekrandan ayrılmayın.<br><br><h5>Hatırlatma:</h5>Bağlantınızın güvenli ve kararlı olabilmesi için bağlantı biçiminizin "https" olması gerektiğini lütfen unutmayın. </div></div>


<?php
                
    $inner_stand_area_documents =json_decode($abstract_websites["sponsor_congress_logo_but_infos"])->{$sponsor_company}->{"videos"};
    $sponsor_videos_arr =[];
    for($i=0;$i<count($inner_stand_area_documents);$i++)
    {
        $video_ext_arr = explode(".",$inner_stand_area_documents[$i]);
        $video_ext = $video_ext_arr[count($video_ext_arr)-1];
        array_push($sponsor_videos_arr, '<source src="/view/abstracts/sponsor_videos/Bitki Koruma Kongresi/'.$sponsor_company.'/'.$inner_stand_area_documents[$i].'" type="video/'.$video_ext.'">');
    }

?>

<video id="sponsor-videos" controls autoplay="autoplay" style="position:absolute;top:9.6vw;left:40.1vw;width:18.2vw;height:11.3vw;" muted>

<?php echo $sponsor_videos_arr[0]; ?>

</video>
 
<canvas >
    
    
    <button id="button1">Sponsor 1</button>
    <button id="button2">Sponsor 2</button>
    <button id="button3">Sponsor 3</button>
    <button id="button4">Sponsor 4</button>
    <button id="button5">Sponsor 5</button>
    <button id="button6">Sponsor 6</button>
    <button id="button7">Görüşme Yap</button>


</canvas>

<script src="/view/virtual_congress/perspectivejs/dist/perspective.js"></script>
<script src="https://www.youtube.com/player_api"></script>
<script src="https://cdn.socket.io/3.1.3/socket.io.min.js" integrity="sha384-cPwlPLvBTa3sKAgddT6krw0cJat7egBga3DJepJyrLl4Q9/5WLra3rrnMcyTyOnh" crossorigin="anonymous"></script>
  


<script>




        

      
function redirect(url)
{
    window.open(url,"_blank");
}

var video = document.getElementById("sponsor-videos");
var video_list = JSON.parse(JSON.stringify(<?php echo json_encode($sponsor_videos_arr,JSON_UNESCAPED_UNICODE); ?>));
video_list_index=1;
video.addEventListener("ended",function(){
    if(video_list_index == video_list.length)
    {
        video_list_index = 0;
    }
    video.innerHTML = video_list[video_list_index];
    video.load();
    video_list_index++;

},true);


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
image.src = 'view/virtual_congress/pages/stand_ici.jpeg';

<?php

    $inner_stand_area_infos =json_decode($abstract_websites["sponsor_congress_logo_but_infos"])->{$sponsor_company}->{"stand_area"};
    $queue=1;
    foreach($inner_stand_area_infos as $stand_area_index => $inner_index)
    {
        $images_str="";
        $images_str .= (property_exists($inner_stand_area_infos->{$stand_area_index},"2"))?'var image'.$stand_area_index.' = new Image(); ':"";
        $images_str .= (property_exists($inner_stand_area_infos->{$stand_area_index},"2"))?'image'.$stand_area_index.'.src = "'.$inner_stand_area_infos->{$stand_area_index}->{"2"}.' ";':"";
        echo $images_str;
        $queue++;
    }

?>



window.onload = function() {
    canvas.width = innerWidth
    canvas.height = ((image.height/image.width)*innerWidth)
    ctx.drawImage(image, 0, 0,innerWidth,((image.height/image.width)*innerWidth));
    button_renderer();

    image.style.display = 'none';

};
 
const button1 = document.getElementById('button1');
const button2 = document.getElementById('button2');
const button3 = document.getElementById('button3');
const button4 = document.getElementById('button4');
const button5 = document.getElementById('button5');
const button6 = document.getElementById('button6');
const button7 = document.getElementById('button7');



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
button_renderer();

// Calculate click coordinates
const x = e.clientX - canvas.offsetLeft;
const y = e.clientY - canvas.offsetTop;

// Focus buttons, if appropriate
    encounter = 0;
    for(i=0;i<4;i++)
    {
        button_renderer(i+1);
        if (ctx.isPointInPath(x, y)) {
            if(encounter == 0)
            {
                <?php
                    $links_str = "";
                    foreach($inner_stand_area_infos as $stand_area_index => $index)
                    {
                        if(property_exists($inner_stand_area_infos->{$stand_area_index},"0") && $inner_stand_area_infos->{$stand_area_index}->{"0"} != "")
                        {
                            $links_str .= '                
                                if(i == '.$stand_area_index.')
                                {
                                    window.open("'.$inner_stand_area_infos->{$stand_area_index}->{"0"}.'","_blank");
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

 


    
    if(x == 1 || x == null)
    {
        drawButton(button1, innerWidth/11.2,((image.height/image.width)*innerWidth)/8.7,5.4,15.4,  2, 0.08, 0, 2, 0, 0,0);
    }

    if(x == 2 || x == null)
    {
        drawButton(button2, innerWidth/3.26,((image.height/image.width)*innerWidth)/8.1,2.4,13,  2, 0.08, -0.2, 2, 0, 0,1);
    }
  
    if(x == 3 || x == null)
    {
        drawButton(button3, innerWidth/2.8,((image.height/image.width)*innerWidth)/13,2.4,12,  2, 0.2, 0.3, 2, 0, 0,2);
    }
 
    if(x == 4 || x == null)
    {
        drawButton(button4, innerWidth/2.8,((image.height/image.width)*innerWidth)/13,2.4,12,  2, 0.2, 0.3, 2, 0, 0,3);
    }
  


}


/*
var image = new Image();
image.src = "/view/virtual_congress/perspectivejs/firefox.jpg";

image.onload = function() {
    canvas.width = image.width;
    canvas.height = image.height;
    var ctx = canvas.getContext("2d");
    var p = new Perspective(ctx, image);
    p.draw([
            [30, 30],
            [image.width - 400, 100],
            [image.width-400 , image.height - 80],
            [10, image.height]
    ]);
}
*/


function drawButton(el, x, y,but_width,but_height,a,b,c,d,e,f,index) {
    const active = document.activeElement === el;
    const width = innerWidth*but_width/100;
    const height = ((image.height/image.width)*innerWidth)*but_height/100;




    // Button background
    ctx.globalAlpha = .2;

    ctx.fillStyle = "rgba(255,255,255,.2)";
    ctx.strokeStyle = 'black';

    
    if(index == 0)
    {

        ctx.globalAlpha = .9;
        if(typeof image0 != "undefined" && image0.src.search("base64") != -1)
        {
            var p = new Perspective(ctx, image0);
            ctx.resetTransform();
            p.draw([
                [ 3.13*x,y*1.7],
                [ 3*x+width+x/1.65, y*1.7 ],
                [ 3*x+width+x/1.45, y+height*1.92 ],
                [ 3*x+x/4, y+height*1.92 ]
            ]);
        }
        ctx.globalAlpha = .2;
        ctx.setTransform(a,b,c,d,e,f);
        ctx.save();
        ctx.beginPath();
        ctx.moveTo( x+x/1.8,y-y/4 );
        ctx.lineTo( x+width+x/2, y-y/3.7 );
        ctx.lineTo( x+width+x/1.8, y+height-y/1.5 );
        ctx.lineTo( x+x/1.6, y+height-y/1.55  );
        ctx.lineTo(  x+x/1.8,y-y/4 );
        ctx.clip();
   

        ctx.fill();
        ctx.closePath();
        ctx.restore();

         
     
    }

    else if(index == 1)
    {

        
        ctx.globalAlpha = .9;
        ctx.resetTransform();
        if(typeof image1 != "undefined" && image1.src.search("base64") != -1)
        {
            var p = new Perspective(ctx, image1);

            p.draw([
                [ 1.963*x,y*1.57],
                [ 1.6*x+width+x/1.65, y*1.57 ],
                [ 1.48*x+width+x/1.45, y+height*2.22],
                [ 1.694*x+x/4, y+height*2.22 ]
            ]);
        }
        ctx.globalAlpha = .2;

        ctx.setTransform(a,b,c,d,e,f);
        ctx.save();
        ctx.beginPath();
        ctx.moveTo( x-x/100,y-y/2.6 );
        ctx.lineTo( x+width+x/13, y-y/2.4);
        ctx.lineTo( x+width+x/13, y+height-y/1.7 );
        ctx.lineTo( x, y+height-y/1.8 );
        ctx.lineTo( x-x/100,y-y/2.6 );
        ctx.clip();

        ctx.fill();
        ctx.closePath();
        ctx.restore();
    }

    else if(index == 2)
    {

        ctx.globalAlpha = .9;
        ctx.resetTransform();

        if(typeof image2 != "undefined" && image2.src.search("base64") != -1)
        {
            var p = new Perspective(ctx, image2);

            p.draw([
                [ 2.21*x,y*3.3],
                [ 1.83*x+width+x/1.635, y*3.15 ],
                [ 2.12*x+width+x/4,y+height*3.65 ],
                [ 1.9*x+x/3.95, y+height*3.53 ]
            ]);
        }
        ctx.globalAlpha = .3;

        ctx.save();
        ctx.beginPath();
        ctx.setTransform(a,b,c,d,e,f);

        ctx.moveTo( x*1.09,y-y/4 );
        ctx.lineTo( x+width+x/5.5, y-y/2);
        ctx.lineTo( x+width+x/9, y+height-y/6);
        ctx.lineTo( x+x/30, y+height-y/6);
        ctx.lineTo( x*1.09,y-y/4 );
        ctx.clip();
     
        ctx.fill();
        ctx.closePath();
        ctx.restore();

            }

 

    else if(index == 3)
    {
        ctx.globalAlpha = .9;
        ctx.resetTransform();

        if(typeof image3 != "undefined" && image3.src.search("base64") != -1)
        {
            var p = new Perspective(ctx, image3);
    
            p.draw([
                [ x+x/10.6,y*9.1],
                [ x+width+x/1.68, y*9.1 ],
                [ x+width+x/1.72,y+height*6.68 ],
                [ x+x/9, y+height*6.65 ]
            ]);
        }
        printAtWordWrap(ctx, el.textContent, x + width / 2, y + height /2, height/5, width );

        ctx.resetTransform();

        ctx.globalAlpha = .3;

        ctx.setTransform(a,b,c,d,e,f);
        ctx.save();
        ctx.beginPath();
        ctx.moveTo( x-x/1.88,y*4.17 );
        ctx.lineTo( x+width-x/3.25, y*3.93);
        ctx.lineTo( x+width-x/3, y+height*2.64);
        ctx.lineTo( x-x/1.84, y+height*2.77);
        ctx.lineTo(x-x/1.88,y*4.2 );
        ctx.clip();
       
       
        ctx.fill();
        ctx.closePath();
        ctx.restore();
        ctx.fillStyle = "rgba(0,0,0,.9)";
        ctx.globalAlpha = .9;
        ctx.globalAlpha = .2;
    }



   

    ctx.stroke();
    // Button text
    ctx.font = width/7+'px sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = '';
    ctx.fillStyle= "rgba(0,0,0,1)";

    ctx.globalAlpha = .7;

    //printAtWordWrap(ctx, el.textContent, x + width / 2, y + height / 2, height/5, width );

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




var user_index = '<?php echo $user_index["id"]; ?>';
var user_index_name = '<?php echo $user_index["uye_adi"].' '.$user_index["uye_soyadi"]; ?>';

var phone_messenger_iframe = document.getElementById("phone-messenger-iframe");
var phone_call_wait_message = document.getElementById("phone-call-wait-message");

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


/*
$(document).ready(function(){

for(i=0;i<$("iframe").length;i++)
{
    console.log($("iframe")[i]);
    $("iframe")[i].setAttribute("width","");
    $("iframe")[i].setAttribute("height","");
    $("iframe")[i].setAttribute("style","width:18.5vw;height:11vw;");
}

});*/





/*
// create youtube player
var player;
 var firstornot=0;

var videoplaylist=["0Bmhjf0rKe8","qtPuCnKahMw","cT5GghQwhFw"];

window.addEventListener('load', (event) => {
    onYouTubePlayerAPIReady()
});

function onYouTubePlayerAPIReady() {
    
        player = new YT.Player('player', {
            width: canvas.width/5.5,
            height: ((canvas.width/canvas.height)*canvas.width/17),
            videoId: videoplaylist[0],
            events: {
            onReady: onPlayerReady,
            onStateChange: onPlayerStateChange
            }
            
        });
        
        function onPlayerReady(event) {
            event.target.playVideo();
        }

        // when video ends
        function onPlayerStateChange(event) {    
            if(event.data === 0) 
            { 
                if(firstornot == 0)
                {
                    player.loadPlaylist(videoplaylist,1);      
                    firstornot =1;
                }
                else
                {
                    player.loadPlaylist(videoplaylist,0);      
                }

            }
        
        }
    }


addEventListener('resize', () => {
    firstornot=0;

    player.destroy();
    player = new YT.Player('player', {
            width: canvas.width/5.5,
            height: ((canvas.width/canvas.height)*canvas.width/14.5),
            videoId: videoplaylist[0],
            events: {
            onReady: onPlayerReady,
            onStateChange: onPlayerStateChange
            }
        });
        function onPlayerReady(event) {
        event.target.playVideo();
    }

    // when video ends
    function onPlayerStateChange(event) 
    {      

        if(event.data === 0) 
        { 
            if(firstornot == 0)
            {
                player.loadPlaylist(videoplaylist,1);      
                firstornot =1;
            }
            else
            {
                player.loadPlaylist(videoplaylist,0);      
            }
        }
    }
    
},true)
*/
</script>



</body>
</html>
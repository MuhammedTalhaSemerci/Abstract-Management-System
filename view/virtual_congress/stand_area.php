<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a9da6c256f.js" crossorigin="anonymous"></script>   
    <script  src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="/view/virtual_congress/perspectivejs/dist/perspective.js"></script>
    <script src="https://cdn.socket.io/3.1.3/socket.io.min.js" integrity="sha384-cPwlPLvBTa3sKAgddT6krw0cJat7egBga3DJepJyrLl4Q9/5WLra3rrnMcyTyOnh" crossorigin="anonymous"></script>
  
    <title>Document</title>
</head>
<body>
<style>




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
    z-index:2;
}
.main_page_redirector:hover
{
    opacity:.5;
}


.messenger-but {
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
    z-index:2;
}
.messenger-but:hover
{
    opacity:.5;
}
</style>


<div class="main_page_redirector" onclick="window.location.href='/'" title="Ana sayfaya dön"><i style="font-size:2vw;"class="fas fa-home fa-2x"></i></div>
<div class="messenger-but" onclick="$('#messenger-modal').modal('show')" title="Sohbetlerim"><i style="font-size:2vw;"class="fas fa-comments fa-2x"></i></div>
  
<div style="z-index:100;position:absolute;top:3vw;right:3vw;width:10vw;height:auto;padding:1vw;background-color:white;border-radius:3px;" onclick="redirect('http://nutuva.com/')"><img style="position:relative;width:100%;height:auto;"src="/view/abstracts/organization_company_logo/logo.png"></div>

<canvas style="position:absolute;top:0px;left:0px;">
    
    <button id="button1"></button>
    <button id="button2"></button>
    <button id="button3"></button>
    <button id="button4"></button>
    <button id="button5"></button>
    <button id="button6"></button>

    <button id="button7"></button>
    <button id="button8"></button>
    <button id="button9"></button>


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
image.src = 'view/virtual_congress/pages/stand_alani.jpeg';

<?php

$queue=1;
for($i=0;$i<6;$i++)
{
        $stand_area_infos =json_decode($abstract_websites["sponsor_congress_logo_but_infos"])->{$sponsors[$i]}->{"logo"};
        $images_str="";
        $images_str .= 'var image'.$queue.' = new Image(); ';
        $images_str .= (property_exists($stand_area_infos->{"0"},"2"))?'image'.$queue.'.src = "'.$stand_area_infos->{"0"}->{"2"}.' ";':"";
        echo $images_str;
        $queue++;
}

    $stand_area_infos =json_decode($abstract_websites["admin_virtual_congress_but_infos"])->{"stand_area"};
    foreach($stand_area_infos as $index => $value)
    {
        $images_str="";
        $images_str .= 'var image'.$queue.' = new Image(); ';
        $images_str .= (property_exists($stand_area_infos->{$index},"2"))?'image'.$queue.'.src = "'.$stand_area_infos->{$index}->{"2"}.' ";':"";
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
const button8 = document.getElementById('button8');
const button9 = document.getElementById('button9');



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
    for(i=10;i>0;i--)
    {
        button_renderer(i);
        if (ctx.isPointInPath(x, y)) {
            if(encounter == 0)
            {
                <?php
                    $links_str = "";
                    $queue=1;
                    for($i=0;$i<6;$i++)
                    {
                        if(isset($sponsors[$i]))
                        {
                            $links_str .= '                
                                if(i == "'.($i+1).'")
                                {
                                    window.location.href="/virtual_congress_inner_stand?sponsor_company='.$sponsors[$i].'";
                                    encounter += 1;
                                }
                            ';
                        }
                        else
                        {
                            $links_str .='';
                        }
                        $queue++;
                    }
                    foreach($stand_area_infos as $index => $value)
                    {
                        $url = (property_exists($stand_area_infos->{$index},"0"))? $stand_area_infos->{$index}->{"0"} : "#";
                        $links_str .= '
                        if(i == "'.($queue+$index).'")
                        {
                            window.location.href="'.$url.'";
                            encounter += 1;
                        }';
                    
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
        drawButton(button1, innerWidth/3.9,((image.height/image.width)*innerWidth)/3.5,9.5,9.7,  2, 0.04, -2.3, 2, 0, 0,0);
    }

    if(x == 2 || x == null)
    {
        drawButton(button2, innerWidth/8,((image.height/image.width)*innerWidth)/3.4,10,9.7,  2, 0.04, 2.5, 2, 0, 0,1);
    }

    if(x == 3 || x == null)
    {
        drawButton(button3, innerWidth/3.3,((image.height/image.width)*innerWidth)/5.2,5.5,3.5,  2, 0.04, -3, 2, 0, 0,2);
    }

    if(x == 4 || x == null)
    {
        drawButton(button4, innerWidth/7.4,((image.height/image.width)*innerWidth)/5,6.2,3.5,  2, 0.03, 3, 2, 0, 0,3);
    }
    
    if(x == 5 || x == null)
    {
        drawButton(button5, innerWidth/3.4,((image.height/image.width)*innerWidth)/7,4,2,  2, 0.03, -3, 2, 0, 0,4);
    }
  
    if(x == 6 || x == null)
    {
        drawButton(button6, innerWidth/6,((image.height/image.width)*innerWidth)/6.8,4.2,2,  2, 0.03, 3, 2, 0, 0,5);
    }
    
   
  




    if(x == 7 || x == null)
    {
        drawButton(button7, innerWidth/10,((image.height/image.width)*innerWidth)/30,7.7,6,  2, 0, 0.7, 2, 0, 0,6);
    }
  

    if(x == 8 || x == null)
    {
        drawButton(button8, innerWidth/4.8,((image.height/image.width)*innerWidth)/30,8.2,6,  2, 0, 0, 2, 0, 0,7);
    }
  
    if(x == 9 || x == null)
    {
        drawButton(button9, innerWidth/3.2,((image.height/image.width)*innerWidth)/30,8.2,6,  2, 0, 0, 2, 0, 0,8);
    }
  

}





function drawButton(el, x, y,but_width,but_height,a,b,c,d,e,f,index) {
    const active = document.activeElement === el;
    const width = innerWidth*but_width/100;
    const height = ((image.height/image.width)*innerWidth)*but_height/100;



    // Button background
    ctx.globalAlpha = 1;

    ctx.fillStyle = "rgba(255,255,255,1)";
    ctx.globalAlpha = .3;

    
    if(index == 0)
    {
        ctx.setTransform(a,b,c,d,e,f);
        ctx.save();
        ctx.beginPath();
        ctx.moveTo( x,y+y/50 );
        ctx.lineTo( x+width, y);
        ctx.lineTo( x+width+width/8, y+y/8 );
        ctx.lineTo( x+width-width/15, y+height );
        ctx.lineTo( x, y+height  );

        ctx.fill();
        ctx.restore();
        ctx.globalAlpha = .9;
        if(image1.src.search("base64")!=-1 && typeof image1.src != "undefined")
        {
            ctx.drawImage(image1, x,y+y/30,width/1.04, height-height/7);
        }
        ctx.globalAlpha = .3;

    }


    else if(index == 1)
    {
        ctx.setTransform(a,b,c,d,e,f);
        ctx.save();
        ctx.beginPath();
        ctx.moveTo( x,y );
        ctx.lineTo( x+width, y);
        ctx.lineTo( x+width-width/15, y+height );
        ctx.lineTo( x, y+height  );
        ctx.lineTo( x-x/8.5, y+height-y/5);
        ctx.fill();
        ctx.restore();
        ctx.globalAlpha = .9;
        if(image2.src.search("base64")!=-1 && typeof image2.src != "undefined")
        {
            ctx.drawImage(image2, x+x/100,y+y/50,width/1.08, height-height/7);
        }
        ctx.globalAlpha = .3;
    }


    else if(index == 2)
    {
        ctx.setTransform(a,b,c,d,e,f);
        ctx.save();
        ctx.beginPath();
        ctx.moveTo( x-x/50,y+y/50 );
        ctx.lineTo( x+width, y);
        ctx.lineTo( x+width+width/8, y+y/15 );
        ctx.lineTo( x+width-width/15, y+height );
        ctx.lineTo( x, y+height  );

        ctx.fill();
        ctx.restore();
        ctx.globalAlpha = .9;
        if(image3.src.search("base64")!=-1 && typeof image3.src != "undefined")
        {
            ctx.drawImage(image3, x-x/100,y+y/50,width, height-height/7);
        }
        ctx.globalAlpha = .3;

    }



    else if(index == 3)
    {
        ctx.setTransform(a,b,c,d,e,f);
        ctx.save();
        ctx.beginPath();
        ctx.moveTo( x-x/50,y+y/50 );
        ctx.lineTo( x+width, y);
        ctx.lineTo( x+width-width/15, y+height );
        ctx.lineTo( x, y+height  );
        ctx.lineTo( x-x/14, y+height-y/13);
        ctx.fill();
        ctx.restore();
        ctx.globalAlpha = .9;
        if(image4.src.search("base64")!=-1 && typeof image4.src != "undefined")
        {
            ctx.drawImage(image4, x-x/50,y+y/50,width, height-height/7);
        }
        ctx.globalAlpha = .3;
    }


    else if(index == 4)
    {
        ctx.setTransform(a,b,c,d,e,f);
        ctx.save();
        ctx.beginPath();
        ctx.moveTo( x-x/50,y+y/50 );
        ctx.lineTo( x+width, y);
        ctx.lineTo( x+width+width/8, y+y/15 );
        ctx.lineTo( x+width-width/15, y+height );
        ctx.lineTo( x, y+height  );
        ctx.fill();
        ctx.restore();
        ctx.globalAlpha = .9;
        if(image5.src.search("base64")!=-1 && typeof image5.src != "undefined")
        {
            ctx.drawImage(image5, x-x/100,y+y/50,width, height-height/7);
        }
        ctx.globalAlpha = .3;
    }

    else if(index == 5)
    {
        ctx.setTransform(a,b,c,d,e,f);
        ctx.save();
        ctx.beginPath();
        ctx.moveTo( x-x/50,y+y/50 );
        ctx.lineTo( x+width, y);
        ctx.lineTo( x+width-width/15, y+height );
        ctx.lineTo( x, y+height  );
        ctx.lineTo( x-x/20, y+height-y/18);
        ctx.fill();
        ctx.restore();
        ctx.globalAlpha = .9;
        if(image6.src.search("base64")!=-1 && typeof image6.src != "undefined")
        {
            ctx.drawImage(image6, x-x/50,y+y/50,width, height-height/7);
        }
        ctx.globalAlpha = .3;
    }



    else if(index == 6)
    {
        ctx.setTransform(a,b,c,d,e,f);
        ctx.save();
        ctx.beginPath();
        ctx.moveTo( x,y );
        ctx.lineTo( x+width, y);
        ctx.lineTo( x+width-width/15, y+height );
        ctx.lineTo( x, y+height  );
        ctx.fill();
        ctx.restore();
        ctx.globalAlpha = .9;
        ctx.resetTransform();
        if(image7.src.search("base64")!=-1 && typeof image7.src != "undefined")
        {
            var p = new Perspective(ctx, image7);

            p.draw([
                [ 1.85*x+x/4,y*2.2],
                [ 2.4*x+width+x/1.8, y*2.2 ],
                [ 2.4*x+width+x/1.5, y+height*2.6],
                [ 2.14*x+x/4, y+height*2.6 ]
            ]);
        }
        ctx.globalAlpha = .2;


    }


    else if(index == 7)
    {
        ctx.setTransform(a,b,c,d,e,f);
        ctx.save();
        ctx.beginPath();
        ctx.moveTo( x,y );
        ctx.lineTo( x+width, y);
        ctx.lineTo( x+width-width/15, y+height );
        ctx.lineTo( x+x/50, y+height  );
        ctx.fill();
        ctx.restore();
        ctx.globalAlpha = .9;
        ctx.resetTransform();
        if(image8.src.search("base64")!=-1 && typeof image8.src != "undefined")
        {
            var p = new Perspective(ctx, image8);

            p.draw([
                [ 1.75*x+x/4,y*2.2],
                [ 2.4*x+width-x/30, y*2.25 ],
                [ 2.4*x+width-x/20, y+height*2.6],
                [ 1.8*x+x/4, y+height*2.6 ]
            ]);
        }
        ctx.globalAlpha = .2;
    }

    else if(index == 8)
    {
        ctx.setTransform(a,b,c,d,e,f);
        ctx.save();
        ctx.beginPath();
        ctx.moveTo( x,y );
        ctx.lineTo( x+width, y);
        ctx.lineTo( x+width-width/6, y+height );
        ctx.lineTo( x-x/50, y+height  );

        ctx.fill();
        ctx.restore();
        ctx.globalAlpha = .9;
        ctx.resetTransform();
        if(image9.src.search("base64")!=-1 && typeof image9.src != "undefined")
        {
            var p = new Perspective(ctx, image9);

            p.draw([
                [ 1.75*x+x/4,y*2.2],
                [ 2.4*x+width-x/7, y*2.22 ],
                [ 2.4*x+width-x/4.3, y+height*2.6],
                [ 1.71*x+x/4, y+height*2.6 ]
            ]);
        }
        ctx.globalAlpha = .2;
    }


    // Button text
    ctx.font = width/7+'px sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = '';
    ctx.fillStyle= "rgba(0,0,0,1)";

    ctx.globalAlpha = .7;

    printAtWordWrap(ctx, el.textContent, x + width / 2, y + height / 2, height/5, width );

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




  
</script>
</body>
</html>
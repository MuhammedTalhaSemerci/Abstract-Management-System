<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a9da6c256f.js" crossorigin="anonymous"></script>
 

    <style>

.crop-wrapper {
    margin-top:40px;
    padding:20px;
	background-color:rgba(255,255,255,1);
	position:relative;
	width:100%;
	height:600px;
	overflow:hidden;

}

.resize-container {
    
    position: relative;
    display: inline-block;
    cursor: move;
    margin: 0 auto;
}

.resize-container-ontop {
	position:absolute;
	cursor:move;
	background-color:rgba(5,255,5,0);
	z-index:1000;
	width:100%;
	height:100%;
}

.resize-container img {
    display: block;
}

.resize-container:hover img,
.resize-container:active img {
    outline: 2px dashed rgba(0,0,0,.9);
}

.resize-handle-ne,
.resize-handle-se,
.resize-handle-nw,
.resize-handle-sw {
    position: absolute;
    display: block;
    width: 10px;
    height: 10px;
    background: rgba(0,0,0,.9);
    z-index: 999;
}

.resize-handle-nw {
    top: -5px;
    left: -5px;
    cursor: nw-resize;
}

.resize-handle-sw {
    bottom: -5px;
    left: -5px;
    cursor: sw-resize;
}

.resize-handle-ne {
    top: -5px;
    right: -5px;
    cursor: ne-resize;
}

.resize-handle-se {
    bottom: -5px;
    right: -5px;
    cursor: se-resize;
}


.overlay {
    margin-top:50px;
	position: absolute;
	left: 50%;
	top: 50%;
    justify-content:center;
	z-index: 999;
	width: 400px !important;
	height: 400px !important;
    border:2px solid black;
	box-sizing: content-box;
	pointer-events: none;
}

.overlay:before {
	top: 0;
	margin-left: -2px;
	margin-top: -40px;
}

.overlay:after {
	bottom: 0;
	margin-left: -2px;
	margin-bottom: -40px;
}


.overlay-inner:before {
	left: 0;
	margin-left: -40px;
	margin-top: -2px;
}

.overlay-inner:after{
	right: 0;
	margin-right: -40px;
	margin-top: -2px;
}

.btn {
	padding: 6px 10px;
	background-color: rgb(222,60,80);
	border: none;
	border-radius: 5px;
	color: #FFF;
	margin:10px 5px;
	line-height:30px;
}

.btn-crop img {
	vertical-align: middle;
	margin-left: 8px;
}

    </style>

</head>
<body>

     
    <br>
    <br>



    



		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

    <?php


        $button_infos = json_decode($abstract_websites[0]["sponsor_congress_logo_but_infos"])->{$user_index["sponsor_company"]};


        echo '<div class="logo">';
        echo ' <div style="display:flex;">';
        $logo_link = $button_infos->{"logo"}->{"0"}->{"0"};
        $logo_name = $button_infos->{"logo"}->{"0"}->{"1"};

            echo '<div style="margin-left:20px; border:1px solid #627c82; border-radius:5px; padding-right:20px;" class="col-lg-3 col-md-3">';
            echo '<h4 style="margin:5px;">Logo İçeriği:</h4><br>'; 
            echo '<label style="margin:5px;" for="logo">Link:</label><input style="margin:5px;" class="form-control logo" type="text" name="logo_infos"  placeholder="https://example.com" value="'.$logo_link.'">';
            echo '<label style="margin:5px;" for="logo">İsim:</label><input style="margin:5px;" class="form-control logo" type="text" name="logo_but_infos"  placeholder="Buton ismi..." value="'.$logo_name.'">&nbsp;';
            echo '<img style="margin:5px;height:auto;" class="col-lg-12 col-md-12 form-control logo" src="'.$button_infos->{"logo"}->{"0"}->{"2"}.'"></img>';
            echo '<button style="margin:5px;" class="form-control image-upload-modal" data-page="logo" data-index="0" onclick="image_crop_opener(this)">Resim yükle</button>';
            echo '<button style="margin:5px;" class="form-control" data-page="logo" data-index="0" onclick="image_delete(this)">Resim Sil</button>';
            echo '<button style="margin:5px;" class="form-control" data-page="logo" data-index="0" onclick="save(this)">Kaydet</button>';
            echo '</div>';
        
        
        echo '</div>';
    

        echo '</div>';


        echo '<div class="stand_area">';
        echo' <div style="display:block;"><br>';

        echo '<h4 style="margin-left:20px;">Stand Alanı İçeriği:</h4>';
        for($i=0;$i<$abstract_websites[0]["sponsor_congress_logo_but_quantity"];$i++)
        {
            $stand_area_link = (property_exists($button_infos->{"stand_area"},$i))? $button_infos->{"stand_area"}->{$i}->{"0"}:"";
            $stand_area_name = (property_exists($button_infos->{"stand_area"},$i))? $button_infos->{"stand_area"}->{$i}->{"1"}:"";
                echo '<div style="margin-left:20px; float:left; border:1px solid #627c82; border-radius:5px; padding-right:20px;" class="col-lg-3 col-md-3">';
                echo '<h4 style="margin:5px;">'.($i+1).'. Stand Alanı Görseli:</h4><br>'; 
                echo '<label style="margin:5px;" for="stand_area">Link:</label><input style="margin-left:20px;" style="margin:5px;" class="form-control stand_area" type="text" name="stand_area_saloon_infos"  placeholder="https://example.com" value="'.$stand_area_link.'">';
                echo '<label style="margin:5px;" for="stand_area">İsim:</label><input style="margin-left:20px;" style="margin:5px;" class="form-control stand_area" type="text" name="stand_area_saloon_but_infos"  placeholder="Buton ismi..." value="'.$stand_area_name.'">&nbsp;';
                echo '<img style="margin:5px;height:auto;" class="col-lg-12 col-md-12 form-control stand_area" src="'.$button_infos->{"stand_area"}->{$i}->{"2"}.'"></img>';
                echo '<button  style="margin:5px;" class="form-control image-upload-modal" data-page="stand_area" data-index="'.$i.'" onclick="image_crop_opener(this)">Resim yükle</button>';
                echo '<button style="margin:5px;" class="form-control" data-page="stand_area" data-index="'.$i.'" onclick="image_delete(this)">Resim Sil</button>';
                echo '<button style="margin:5px;" class="form-control" data-page="stand_area" data-index="'.$i.'" onclick="save(this)">Kaydet</button>';
                echo '</div>';
               
        }
        echo '</div>';

        echo '</div>';
        
        
        
        


    ?>


<div class="container">

<!-- Modal -->
    <div class="modal show bd-example-modal-lg" aria-labelledby="myLargeModalLabel" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
        
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Resim Kırpma</h4>
            </div>
            <div class="modal-body">
            <input type="radio" name="checkbox" id="checkbox1" value="square"/> <label for="checkbox1">Kare</label><br />
            <input type="radio" name="checkbox" id="checkbox1" value="horizontal-rect"/><label for="checkbox1">yatay dikdörtgen</label><br />
            <input type="radio" name="checkbox" id="checkbox1" value="vertical-rect"/><label for="checkbox1">dikey dikdörtgen</label><br />
            <input type="radio" name="checkbox" id="checkbox1" value="template-rect"/><label for="checkbox1">Template Biçimi</label><br />
            
            <input type="file" class="btn js-loadfile" value="Upload" />
                <button class="btn js-reset">Sıfırla</button>
                <button class="btn js-cropless">Kaydet</button>
                <button class="btn js-crop">Kırp/Kaydet</button>

                <div class="crop-wrapper">
                    <div class="top-overlay">
                    </div>
                    <div class="bottom-overlay">
                    </div>
                    <div class="left-overlay">
                    </div>
                    <div class="right-overlay">
                    </div>
                    <div class="overlay">
                        <div class="overlay-inner">
                        </div>
                    </div>
                    <img class="resize-image" src="img/image.jpg" >
                </div>
            </div>          
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
           
        </div>
        
    </div>
    


    
    <script type="text/javascript">
   


   
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


    $(document).ready(function(){
        $(".image-upload-modal").click(function(){
            $('#myModal').modal('show');
        }); 
    });

    $(document).ready(function(){
        $(".close-modal").click(function(){
            $(".container").css("display","none");
            $(".modal-backdrop").css("display","none");
        }); 
    });

    $('input[type=radio][name=checkbox]').on('change', function() {
        switch(this.value)
        {
            case "square":
                $(".overlay").css("cssText", "");

                break;
            case "horizontal-rect":
                $(".overlay").css("cssText", "width: 500px !important;height: 300px !important;");

                break;
            case "vertical-rect":
                    $(".overlay").css("cssText", "width: 300px !important;height: 540px !important;");
                break;  
            case "template-rect":
                    $(".overlay").css("cssText", "width: 700px !important;height: 150px !important;");
                break;  
                

        }
   
});
</script>



    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script>

    <?php
    
        if($button_infos != null && $button_infos != "")
        {
            echo 'var arr= JSON.parse(JSON.stringify('.json_encode($button_infos,JSON_UNESCAPED_UNICODE).'));';
        }
        else
        {
            echo '
                var arr={logo:{},stand_area:{}};
            ';
        }
    ?>




    function image_crop_opener(el)
    {
        $(".js-crop").attr("data-page",$(el).data("page"));
        $(".js-crop").attr("data-index",$(el).data("index"));
        $(".js-cropless").attr("data-page",$(el).data("page"));
        $(".js-cropless").attr("data-index",$(el).data("index"));
    }


    function image_delete(el)
    {
        var saloon = $(el).data("page");
        var index = $(el).data("index");
        if(confirm("İşlemi gerçekleştirmek istediğinizden emin misiniz ?"))
        {
            if(arr[saloon][index][2] != undefined && arr[saloon][index][2] != null && arr[saloon][index][2] != "")
            {
                arr[saloon][index][2] ="";
                alert("İşlem başarıyla gerçekleşti");

            }
            else
            {
                alert("Herhangi bir resim bulunamadı !");
                
            }
        }
    }

 
    
    function save(el)
    {
        
        var saloon = $(el).data("page");
        var index = $(el).data("index");
        console.log(saloon);
        var link_list = ()=> {
            

            for(i=0;i<$("input[name=logo_infos]").length;i++)
            {
                if(typeof arr.stand_area == "undefined")
                {
                    arr.logo={};
                }

                if(arr.logo[i] != undefined)
                {
                    arr.logo[i][0]=$("input[name=logo_infos]")[i].value;
                }
                else
                {
                    arr.logo[i]={"0":$("input[name=logo_infos]")[i].value,"1":"","2":""};
                }

                if(arr.logo[i] != undefined)
                {
                    arr.logo[i][1]=$("input[name=logo_but_infos]")[i].value;
                }
                else
                {
                    arr.logo[i]={"0":"","1":$("input[name=logo_but_infos]")[i].value,"2":""};
                }
               
            }
            for(i=0;i<$("input[name=stand_area_saloon_infos]").length;i++)
            {
                if(typeof arr.stand_area == "undefined")
                {
                    arr.stand_area={};
                }

                if(arr.stand_area[i] != undefined)
                {
                    arr.stand_area[i][0]=$("input[name=stand_area_saloon_infos]")[i].value;
                }
                else
                {
                    arr.stand_area[i]={"0":$("input[name=stand_area_saloon_infos]")[i].value,"1":"","2":""};
                }

                if(arr.stand_area[i] != undefined)
                {
                    arr.stand_area[i][1]=$("input[name=stand_area_saloon_but_infos]")[i].value;
                }
                else
                {
                    arr.stand_area[i]={"0":"","1":$("input[name=stand_area_saloon_but_infos]")[i].value,"2":""};
                }
            }
            
            return arr;
        }
        console.log(JSON.stringify(link_list()[saloon][index]));
        //postForm("/sponsor_virtual_congress_button_info_save",{data:JSON.stringify(link_list())});
        $.post("/sponsor_virtual_congress_button_info_save",{saloon:saloon,all_saloons:["logo","stand_area"],index:index,data:JSON.stringify(link_list()[saloon][index])},function(success){

            if(success == 1)
            {
                alert("İşlem başarıyla gerçekleştirildi");
            }
            else
            {
                alert("İşlem gerçekleştirilirken bir hata oluştu.");
            }

        })
        .fail(function(){
            alert("İşlem gerçekleştirilirken bir hata oluştu.");
        })
    }

    $(document).ready(function(){
        $(".js-cropless").click(function(){
            getBase64();
        });
    });


    function getBase64() {
        var file = document.querySelector('input[type="file"]').files[0];

        console.log(file);
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function () {
            var base64str= reader.result;
            var saloon = $(".js-crop").attr("data-page");
            var index = $(".js-crop").attr("data-index");
            console.log(typeof arr[saloon]);
            if(typeof arr[saloon] == "undefined")
            {
                arr[saloon]={};
            }

            if(arr[saloon].length > 0)
            {
                if(arr[saloon][index] != undefined)
                {
                    arr[saloon][index]["2"] =  base64str;
                }
                else
                {
                    arr[saloon][index] = {"0":"","1":"","2":base64str};
                }
            }
            else
            {
                arr[saloon][index] = {"0":"","1":"","2":base64str};

            }
            $('#myModal').modal('hide');
        };
        reader.onerror = function (error) {
            console.log('Error: ', error);
        };
    }
    

    var resizeableImage = function(image_target) {
  // Some variable and settings
  var $container,
  orig_src = new Image(),
  image_target = $(image_target).get(0),
  event_state = {},
  constrain = false,
  min_width = 60, // Change as required
  min_height = 60,
  max_width = 1800, // Change as required
  max_height = 1900,
  init_height=500,
  resize_canvas = document.createElement('canvas');
  imageData=null;

  init = function(){
  
  //load a file with html5 file api
	$('.js-loadfile').change(function(evt) {
		var files = evt.target.files; // FileList object
		var reader = new FileReader();

		reader.onload = function(e) {
		  imageData=reader.result;
		  loadData();
		}
		reader.readAsDataURL(files[0]);
	});
	
	//add the reset evewnthandler
	$('.js-reset').click(function() {
		if(imageData)
			loadData();
	});
	

    // When resizing, we will always use this copy of the original as the base
    orig_src.src=image_target.src;

    // Wrap the image with the container and add resize handles
    $(image_target).height(init_height)
	.wrap('<div class="resize-container"></div>')
    .before('<span class="resize-handle resize-handle-nw"></span>')
    .before('<span class="resize-handle resize-handle-ne"></span>')
    .after('<span class="resize-handle resize-handle-se"></span>')
    .after('<span class="resize-handle resize-handle-sw"></span>');

    // Assign the container to a variable
    $container =  $('.resize-container');

	$container.prepend('<div class="resize-container-ontop"></div>');
	
    // Add events
    $container.on('mousedown touchstart', '.resize-handle', startResize);
    $container.on('mousedown touchstart', '.resize-container-ontop', startMoving);
    $('.js-crop').on('click', crop);
  };
  
  loadData = function() {
			
	//set the image target
	image_target.src=imageData;
	orig_src.src=image_target.src;
	
	//set the image tot he init height
	$(image_target).css({
		width:'auto',
		height:init_height
	});
	
	
	//resize the canvas
	$(orig_src).bind('load',function() {
		resizeImageCanvas($(image_target).width(),$(image_target).height());
	});
  };
  
  startResize = function(e){
    e.preventDefault();
    e.stopPropagation();
    saveEventState(e);
    $(document).on('mousemove touchmove', resizing);
    $(document).on('mouseup touchend', endResize);
  };

  endResize = function(e){
	resizeImageCanvas($(image_target).width(), $(image_target).height())
    e.preventDefault();
    $(document).off('mouseup touchend', endResize);
    $(document).off('mousemove touchmove', resizing);
  };

  saveEventState = function(e){
    // Save the initial event details and container state
    event_state.container_width = $container.width();
    event_state.container_height = $container.height();
    event_state.container_left = $container.offset().left; 
    event_state.container_top = $container.offset().top;
    event_state.mouse_x = (e.clientX || e.pageX || e.originalEvent.touches[0].clientX) + $(window).scrollLeft(); 
    event_state.mouse_y = (e.clientY || e.pageY || e.originalEvent.touches[0].clientY) + $(window).scrollTop();
	
	// This is a fix for mobile safari
	// For some reason it does not allow a direct copy of the touches property
	if(typeof e.originalEvent.touches !== 'undefined'){
		event_state.touches = [];
		$.each(e.originalEvent.touches, function(i, ob){
		  event_state.touches[i] = {};
		  event_state.touches[i].clientX = 0+ob.clientX;
		  event_state.touches[i].clientY = 0+ob.clientY;
		});
	}
    event_state.evnt = e;
  };

  resizing = function(e){
    var mouse={},width,height,left,top,offset=$container.offset();
    mouse.x = (e.clientX || e.pageX || e.originalEvent.touches[0].clientX) + $(window).scrollLeft(); 
    mouse.y = (e.clientY || e.pageY || e.originalEvent.touches[0].clientY) + $(window).scrollTop();
    
    // Position image differently depending on the corner dragged and constraints
    if( $(event_state.evnt.target).hasClass('resize-handle-se') ){
      width = mouse.x - event_state.container_left;
      height = mouse.y  - event_state.container_top;
      left = event_state.container_left;
      top = event_state.container_top;
    } else if($(event_state.evnt.target).hasClass('resize-handle-sw') ){
      width = event_state.container_width - (mouse.x - event_state.container_left);
      height = mouse.y  - event_state.container_top;
      left = mouse.x;
      top = event_state.container_top;
    } else if($(event_state.evnt.target).hasClass('resize-handle-nw') ){
      width = event_state.container_width - (mouse.x - event_state.container_left);
      height = event_state.container_height - (mouse.y - event_state.container_top);
      left = mouse.x;
      top = mouse.y;
      if(constrain || e.shiftKey){
        top = mouse.y - ((width / orig_src.width * orig_src.height) - height);
      }
    } else if($(event_state.evnt.target).hasClass('resize-handle-ne') ){
      width = mouse.x - event_state.container_left;
      height = event_state.container_height - (mouse.y - event_state.container_top);
      left = event_state.container_left;
      top = mouse.y;
      if(constrain || e.shiftKey){
        top = mouse.y - ((width / orig_src.width * orig_src.height) - height);
      }
    }
	
    // Optionally maintain aspect ratio
    if(constrain || e.shiftKey){
      height = width / orig_src.width * orig_src.height;
    }

    if(width > min_width && height > min_height && width < max_width && height < max_height){
      // To improve performance you might limit how often resizeImage() is called
      resizeImage(width, height);  
      // Without this Firefox will not re-calculate the the image dimensions until drag end
      $container.offset({'left': left, 'top': top});
    }
  }

  resizeImage = function(width, height){
	$(image_target).width(width).height(height);
  };
  
  resizeImageCanvas = function(width, height){
    resize_canvas.width = width;
    resize_canvas.height = height;
    resize_canvas.getContext('2d').drawImage(orig_src, 0, 0, width, height);   
    $(image_target).attr('src', resize_canvas.toDataURL("image/png"));  
	//$(image_target).width(width).height(height);
  };

  startMoving = function(e){
    e.preventDefault();
    e.stopPropagation();
    saveEventState(e);
    $(document).on('mousemove touchmove', moving);
    $(document).on('mouseup touchend', endMoving);
  };

  endMoving = function(e){
    e.preventDefault();
    $(document).off('mouseup touchend', endMoving);
    $(document).off('mousemove touchmove', moving);
  };

  moving = function(e){
    var  mouse={}, touches;
    e.preventDefault();
    e.stopPropagation();
    
    touches = e.originalEvent.touches;
    
    mouse.x = (e.clientX || e.pageX || touches[0].clientX) + $(window).scrollLeft(); 
    mouse.y = (e.clientY || e.pageY || touches[0].clientY) + $(window).scrollTop();
    $container.offset({
      'left': mouse.x - ( event_state.mouse_x - event_state.container_left ),
      'top': mouse.y - ( event_state.mouse_y - event_state.container_top ) 
    });
    // Watch for pinch zoom gesture while moving
    if(event_state.touches && event_state.touches.length > 1 && touches.length > 1){
      var width = event_state.container_width, height = event_state.container_height;
      var a = event_state.touches[0].clientX - event_state.touches[1].clientX;
      a = a * a; 
      var b = event_state.touches[0].clientY - event_state.touches[1].clientY;
      b = b * b; 
      var dist1 = Math.sqrt( a + b );
      
      a = e.originalEvent.touches[0].clientX - touches[1].clientX;
      a = a * a; 
      b = e.originalEvent.touches[0].clientY - touches[1].clientY;
      b = b * b; 
      var dist2 = Math.sqrt( a + b );

      var ratio = dist2 /dist1;

      width = width * ratio;
      height = height * ratio;
      // To improve performance you might limit how often resizeImage() is called
      resizeImage(width, height);
    }
  };

  crop = function(element){
    //Find the part of the image that is inside the crop box
    var crop_canvas,
        left = $('.overlay').offset().left- $container.offset().left,
        top =  $('.overlay').offset().top - $container.offset().top,
        width = $('.overlay').width(),
        height = $('.overlay').height();
		
    crop_canvas = document.createElement('canvas');
	
    crop_canvas.width = width;
    crop_canvas.height = height;
	
    crop_canvas.getContext('2d').drawImage(image_target, left, top, width, height, 0, 0, width, height);
	var dataURL=crop_canvas.toDataURL("image/png");
	image_target.src=dataURL;
	orig_src.src=image_target.src;
	
	
	$(image_target).bind("load",function() {
		$(this).css({
			width:width,
			height:height
		}).unbind('load').parent().css({
			top:$('.overlay').offset().top- $('.crop-wrapper').offset().top,
			left:$('.overlay').offset().left- $('.crop-wrapper').offset().left
		})
	});
    //window.open(crop_canvas.toDataURL("image/png"));

    var saloon = $(".js-crop").attr("data-page");
    var index = $(".js-crop").attr("data-index");
    if(typeof arr[saloon] == "undefined")
    {
        arr[saloon]={};
    }
    if(arr[saloon].length > 0)
    {
        if(arr[saloon][index] != undefined)
        {
            arr[saloon][index]["2"] =  dataURL;
        }
        else
        {
            arr[saloon][index] = {"0":"","1":"","2":dataURL};
        }
    }
    else
    {
        arr[saloon] = {};
        arr[saloon][index] = {"0":"","1":"","2":dataURL};

    }
            $('#myModal').modal('hide');

  }

  init();
};

// Kick everything off with the target image
resizeableImage($('.resize-image'));
    </script>



</body>
</html>
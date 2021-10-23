<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a9da6c256f.js" crossorigin="anonymous"></script>   
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.socket.io/3.1.3/socket.io.min.js" integrity="sha384-cPwlPLvBTa3sKAgddT6krw0cJat7egBga3DJepJyrLl4Q9/5WLra3rrnMcyTyOnh" crossorigin="anonymous"></script>
  
    <title>Document</title>

    <style>


    .main_page_redirector {
        position:absolute;
        top:5vw;
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



    .messenger-but {
        position:absolute;
        top:5vw;
        left:11vw;
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


    div .poster_iframe
    {
        pointer-events: none; 
    }
    body
    {
        width:100%;
        height:auto;
        position:absolute;
        display:block;
        z-index:-100;

    }
    .previous_poster {
        position:absolute;
        top:5vw;
        left:42%;
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
    .previous_poster:hover
    {
        opacity:.5;
    }
    .next_poster {
        position:absolute;
        top:5vw;
        left:53%;
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
    .next_poster:hover
    {
        opacity:.5;
    }

    .poster_iframe0
    {
        position:absolute;
        display:inline-block;
        top:17.7vw;
        left:5vw;
        height:20vw;
        width:13vw;
        z-index:100;

    }
    .poster_id0
    {
        position:absolute;
        display:inline-block;
        top:14vw;
        left:9vw;
        height:5vw;
        width:13vw;
        z-index:100;

    }

    .poster_talk0
    {
        position:absolute;
        display:inline-block;
        top:40vw;
        left:5vw;
        height:5vw;
        width:13vw;
        z-index:100;

    }
    
    .poster_iframe1
    {
        position:absolute;
        display:inline-block;
        top:17.7vw;
        left:24.2vw;
        height:20vw;
        width:13vw;
        z-index:100;

    }
    .poster_id1
    {
        position:absolute;
        display:inline-block;
        top:14vw;
        left:28.2vw;
        height:5vw;
        width:13vw;
        z-index:100;

    }
    
    .poster_talk1
    {
        position:absolute;
        display:inline-block;
        top:40vw;
        left:24vw;
        height:5vw;
        width:13vw;
        z-index:100;

    }
    
    .poster_iframe2
    {
        position:absolute;
        display:inline-block;
        top:17.7vw;
        left:43.5vw;
        height:20vw;
        width:13vw;
        z-index:100;

    }

    .poster_id2
    {
        position:absolute;
        display:inline-block;
        top:14vw;
        left:47.5vw;
        height:5vw;
        width:13vw;
        z-index:100;

    }

    .poster_talk2
    {
        position:absolute;
        display:inline-block;
        top:40vw;
        left:43.5vw;
        height:5vw;
        width:13vw;
        z-index:100;

    }

    .poster_iframe3
    {
        position:absolute;
        display:inline-block;
        top:17.7vw;
        left:63vw;
        height:20vw;
        width:13vw;
        z-index:100;

    }

    .poster_id3
    {
        position:absolute;
        display:inline-block;
        top:14vw;
        left:67vw;
        height:5vw;
        width:13vw;
        z-index:100;

    }

    .poster_talk3
    {
        position:absolute;
        display:inline-block;
        top:40vw;
        left:63vw;
        height:5vw;
        width:13vw;
        z-index:100;

    }

    .poster_iframe4
    {
        position:absolute;
        display:inline-block;
        top:17.7vw;
        left:82.3vw;
        height:20vw;
        width:13vw;
        z-index:100;

    }

    .poster_id4
    {
        position:absolute;
        display:inline-block;
        top:14vw;
        left:86.3vw;
        height:5vw;
        width:13vw;
        z-index:100;

    }

    .poster_talk4
    {
        position:absolute;
        display:inline-block;
        top:40vw;
        left:82.3vw;
        height:5vw;
        width:13vw;
        z-index:100;

    }

    h4
    {
        font-size:2vw;
    }

    button
    {
        font-size:1.8vw;
    }
    img
    {
        position:absolute;
        z-index:-10;
    }
    </style>

</head>
<body>
<?php
    /*       
    for($i=0;$i<count($poster_area_abstracts);$i++)
    {


            $abstract_category_char = mb_strtoupper($poster_area_abstracts[$i]["abstract_category"][0]);
            if(strpos($poster_area_abstracts[$i]["abstract_type"],"-"))
            {
                $abstract_type_char = mb_strtoupper($poster_area_abstracts[$i]["abstract_type"][strpos($poster_area_abstracts[$i]["abstract_type"],"-")+1]);
            }
            else
            {
                $abstract_type_char = mb_strtoupper($poster_area_abstracts[$i]["abstract_type"][0]);
            }
            $last_abstract_no = intval($poster_area_abstracts[$i]["last_abstract_no"]);

            if(isset($poster_area_abstracts[$i]["presentation_files"]) && count(json_decode($poster_area_abstracts[$i]["presentation_files"])) > 0 )
            echo '<iframe src="/view/abstracts/presentations/Bitki Koruma Kongresi/'.$abstract_category_char.$abstract_type_char.$last_abstract_no.'/'.json_decode($poster_area_abstracts[$i]["presentation_files"])[0].'"></iframe>';
        
    }*/
    for($i=0;$i<count($poster_area_abstracts);$i++)
    {
        $poster_area_abstracts[$i]["presentation_files"] = json_decode($poster_area_abstracts[$i]["presentation_files"]);
        if(count($poster_area_abstracts[$i]["presentation_files"]) < 1)
        {
            array_splice($poster_area_abstracts,$i,1);
            $i--;
        }
    }
   
    echo '<script>var abstracts= JSON.parse(JSON.stringify('.json_encode($poster_area_abstracts,JSON_UNESCAPED_UNICODE).'));</script>';                        
?>


<div class="main_page_redirector" onclick="window.location.href='/'" title="Ana Sayfaya Git"><i style="font-size:2vw;" class="fas fa-home fa-2x"></i></div> 
<div class="messenger-but" onclick="$('#messenger-modal').modal('show')" title="Sohbetlerim"><i style="font-size:2vw;"class="fas fa-comments fa-2x"></i></div>

<div style="z-index:100;position:absolute;top:3vw;right:3vw;width:10vw;height:auto;padding:1vw;background-color:white;border-radius:3px;" onclick="redirect('http://nutuva.com/')"><img style="position:relative;width:100%;height:auto;"src="/view/abstracts/organization_company_logo/logo.png"></div>

<div id="poster-presentation-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="poster-header"></h4>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#poster-presentation-modal').modal('hide')">Kapat</button>
            </div>
            <div class="poster-modal-body modal-body"> 
            </div>
        </div>
    </div>
</div>

<div id="poster-div" >
</div>
<div >


    <img style="width:100vw;height:auto;" src="/view/virtual_congress/pages/poster_area.jpeg" alt="">

    <div class="previous_poster" onclick="previous_poster()" title="Önceki Sayfa"><i style="font-size:2vw;" class="fas fa-long-arrow-alt-left fa-2x"></i></div> 
    <div class="next_poster" onclick="next_poster()" title="Sonraki Sayfa"><i style="font-size:2vw;" class="fas fa-long-arrow-alt-right fa-2x"></i></div> 

</div>

<script>


    function redirect(url)
    {
        window.open(url,"_blank");
    }

    $(document).ready(function(){

        console.log("gerçek poster miktarı: "+abstracts.length);
        var abstract_offset = 5 - parseInt(abstracts.length % 5);
        for(i=0;i<abstract_offset;i++)
        {
            abstracts[abstracts.length] = {
                "presentation_files":[""],
                "abstract_category":undefined,
                "abstract_type":undefined,
                "last_abstract_no":undefined,
            };
        }
        console.log("sanal poster miktarı: "+abstracts.length);

    });


    function poster_iframes_fnc(class_info="")
    {
        abstract_no = abstract_category_char+abstract_type_char+last_abstract_no;

        return '<div onclick="poster_opener(\''+abstract_no+'\',\''+abstracts[i]["presentation_files"]+'\')" class="'+class_info+'" ><iframe class="poster_iframe" style="z-index:-9;width:100%;height:100%;"onclick="iframe_modal_opener()"  src="/view/abstracts/presentations/Bitki Koruma Kongresi/'+abstract_no+'/'+abstracts[i]["presentation_files"]+'"></iframe></div>'; 
    }
    function poster_id_fnc(class_info="")
    {
        abstract_no = abstract_category_char+abstract_type_char+last_abstract_no;

        return '<div class="'+class_info+'"><h4>'+abstract_no+'</h4></div>'; 
    }
    
    function poster_talk_fnc(class_info="")
    {
        return '<div class="'+class_info+'"><h4><button style="background-color:white;border:0px; border-radius:3px;" onclick="start_text_meeting('+main_author_id+')">Görüşme Yap</button></h4><div style="background-color:white;opacity:.5;border-radius:3px;display:inline-flex;justify-content:top;font-size:2vw;"><div style="margin-right:1.5vw;">Aktiflik: </div><div style="font-size:1.8vw;" class="controllable-users" data-id="'+main_author_id+'"></div></div></div>'; 
    }

    function poster_opener(abstract_no,presentation_file) {
        $('#poster-presentation-modal').modal('show');
        $(".poster-modal-body").html('<iframe id="big_poster_file" src="/view/abstracts/presentations/Bitki Koruma Kongresi/'+abstract_no+'/'+presentation_file+'" frameborder="0" style="width:100%;height:500px;"></iframe>');
        $("#poster-header").html("Poster "+abstract_no)
    }
    var stop_index =0;

    $(document).ready(function(){
        var poster_count=0;
        var poster_iframes="";
        for(i=0;i<abstracts.length;i++)
        {

            if(Array.isArray(abstracts[i]["presentation_files"]))
            {
                if(poster_count == 4)
                {
                    stop_index =i+1;
                }
                if(poster_count == 5)
                {
                    stop_index =i;
                    break;
                }
                if(abstracts[i]["presentation_files"].length > 0)
                {
                    abstract_category_char = (typeof abstracts[i]["abstract_category"] != "undefined")?abstracts[i]["abstract_category"][0].toUpperCase():"";
                    
                    if(typeof abstracts[i]["abstract_type"] != "undefined")
                    {
                        abstract_type_char = (abstracts[i]['abstract_type'].search("-") != -1)? abstracts[i]['abstract_type'][abstracts[i]['abstract_type'].search("-")+1].toUpperCase() : abstracts[i]['abstract_type'][0].toUpperCase();
                    }
                    else
                    {
                        abstract_type_char ="";
                    }
                    last_abstract_no = (typeof abstracts[i]["last_abstract_no"] != "undefined")? abstracts[i]["last_abstract_no"]:"";
                    main_author_id = (typeof abstracts[i]["main_author_id"] != "undefined")? abstracts[i]["main_author_id"]:"";

                    poster_iframes += (main_author_id != "")? poster_talk_fnc("poster_talk"+poster_count): "";
                    poster_iframes += (abstract_category_char != "" && abstract_type_char != "" && last_abstract_no != "")? poster_id_fnc("poster_id"+poster_count) : "";
                    poster_iframes += (abstract_category_char != "" && abstract_type_char != "" && last_abstract_no != "")? poster_iframes_fnc("poster_iframe"+poster_count): "";

                    poster_count++;
                }
            }
          
        }
        $("#poster-div").html(poster_iframes);

    });

    function next_poster()
    {
        var poster_count=0;
        var poster_iframes="";
        if(stop_index != abstracts.length)
        {
            for(i=stop_index;i<abstracts.length;i++)
            {
                if(Array.isArray(abstracts[i]["presentation_files"]))
                {
                    if(poster_count == 4)
                    {
                        stop_index =i+1;
                    }
                    if(poster_count == 5)
                    {
                        stop_index =i;
                        break;
                    }
                    if(abstracts[i]["presentation_files"].length > 0)
                    {
                        abstract_category_char = (typeof abstracts[i]["abstract_category"] != "undefined")?abstracts[i]["abstract_category"][0].toUpperCase():"";
                        
                        if(typeof abstracts[i]["abstract_type"] != "undefined")
                        {
                            abstract_type_char = (abstracts[i]['abstract_type'].search("-") != -1)? abstracts[i]['abstract_type'][abstracts[i]['abstract_type'].search("-")+1].toUpperCase() : abstracts[i]['abstract_type'][0].toUpperCase();
                        }
                        else
                        {
                            abstract_type_char ="";
                        }
                        last_abstract_no = (typeof abstracts[i]["last_abstract_no"] != "undefined")? abstracts[i]["last_abstract_no"]:"";
                        main_author_id = (typeof abstracts[i]["main_author_id"] != "undefined")? abstracts[i]["main_author_id"]:"";

                        poster_iframes += (main_author_id != "")? poster_talk_fnc("poster_talk"+poster_count): "";
                        poster_iframes += (abstract_category_char != "" && abstract_type_char != "" && last_abstract_no != "")? poster_id_fnc("poster_id"+poster_count) : "";
                        poster_iframes += (abstract_category_char != "" && abstract_type_char != "" && last_abstract_no != "")? poster_iframes_fnc("poster_iframe"+poster_count): "";
                        poster_count++;
                    }
                }
            
            }
            $("#poster-div").html(poster_iframes);
            all_users_activity();

        }
    }

    function previous_poster()
    {
        var poster_count=0;
        var poster_iframes="";
        var last_or_not = abstracts.length % 5;
        var counter = 0;
   
       
        
        if(stop_index-10 >= 0)
        {
            console.log(stop_index-10);
            stop_index = stop_index-10;

            for(i=stop_index;i<abstracts.length;i++)
            {
                if(Array.isArray(abstracts[i]["presentation_files"]))
                {
                
                    if(abstracts[i]["presentation_files"].length > 0)
                    {
                        if(poster_count == 4)
                        {
                            stop_index =i+1;
                        }
                        if(poster_count == 5)
                        {
                            stop_index =i;
                            break;
                        }
                        abstract_category_char = (typeof abstracts[i]["abstract_category"] != "undefined")?abstracts[i]["abstract_category"][0].toUpperCase():"";
                        
                        if(typeof abstracts[i]["abstract_type"] != "undefined")
                        {
                            abstract_type_char = (abstracts[i]['abstract_type'].search("-") != -1)? abstracts[i]['abstract_type'][abstracts[i]['abstract_type'].search("-")+1].toUpperCase() : abstracts[i]['abstract_type'][0].toUpperCase();
                        }
                        else
                        {
                            abstract_type_char ="";
                        }
                        last_abstract_no = (typeof abstracts[i]["last_abstract_no"] != "undefined")? abstracts[i]["last_abstract_no"]:"";
                        main_author_id = (typeof abstracts[i]["main_author_id"] != "undefined")? abstracts[i]["main_author_id"]:"";

                        poster_iframes += (main_author_id != "")? poster_talk_fnc("poster_talk"+poster_count): "";
                        poster_iframes += (abstract_category_char != "" && abstract_type_char != "" && last_abstract_no != "")? poster_id_fnc("poster_id"+poster_count) : "";
                        poster_iframes += (abstract_category_char != "" && abstract_type_char != "" && last_abstract_no != "")? poster_iframes_fnc("poster_iframe"+poster_count): "";
                        poster_count++;
                        counter++;
                    }
                }
            
            }
        
            $("#poster-div").html(poster_iframes);
            all_users_activity();

        }
    }


</script>

</body>
</html>
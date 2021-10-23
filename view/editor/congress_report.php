<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <title>Document</title>

    <style>
    
        td
        {
            padding:10px;
            border-radius: 25px;

        }
        table
        {
            border-collapse: collapse;
            border:1px solid black;
            border-style: hidden;
            border-radius: 5px;
            box-shadow: 0 0 0 1px #666;
        }
    </style>
</head>
<body>

<div class="col-lg-12 col-md-12" style="display:flex;">

    <div class="col-lg-6 col-md-6" >
        <h4 style="margin-top:20px">Kongre Raporları:</h4>
       
        <div class="congress_reports_viewer">

        </div>
        <br>
        <h4 style="margin-top:20px">Üye Raporları:</h4>
       
        <div class="member_reports_viewer">

        </div>


    </div>

    <div class="col-lg-6 col-md-6" >
        <h4 style="margin-top:20px">Bildiri Raporları:</h4>
        
        <div class="abstract_reports_viewer">

        </div>           
    </div>
</div>

    <script>
    
        var all_abstracts = JSON.parse(JSON.stringify(<?php echo json_encode($editor_all_abstracts,JSON_UNESCAPED_UNICODE); ?>));
        var all_users = JSON.parse(JSON.stringify(<?php echo json_encode($all_users,JSON_UNESCAPED_UNICODE); ?>));

        

        $(document).ready(function(){

            //congress

            var all_money_turkish = 0;
            var all_money_english = 0;
            for(i=0;i<all_users.length;i++)
            {

                if(all_users[i].uye_odenen != null && all_users[i].withdrawals != null)
                {
                    
                    withdrawals= JSON.parse(all_users[i].withdrawals)[0];
                    withdrawals_type = withdrawals[1].split('/');
                    if(withdrawals_type[3] == null)
                    {
                        all_money_turkish += parseInt(all_users[i].uye_odenen);
                        
                    }
                    else
                    {
                        all_money_english += parseInt(all_users[i].uye_odenen);
                        
                    }
                    ////////////////////
                    
                }

             
            }
            var member_reports_html = "<table>";
            member_reports_html +='<tr><td>Hasılat:</td><td>'+all_money_turkish+' TL'+' / '+all_money_english+' $'+'</td></tr>';
            member_reports_html += "</table>";

            $(".congress_reports_viewer").html(member_reports_html);
        




            //all_users
            var board_member = 0;
            var students = 0;
            for(i=0;i<all_users.length;i++)
            {
                if(parseInt(all_users[i].uye_yetki) == 2)
                {
                    board_member += 1; 
                }

                if(all_users[i].uye_unvan == "Öğrenci")
                {
                    students += 1;
                }
            }
            var member_reports_html = "<table>";
            member_reports_html +='<tr><td>Üye Sayısı:</td><td>'+all_users.length+'</td></tr>';
            member_reports_html +='<tr><td>Bilim Kurulu Üyeleri:</td><td>'+board_member+'</td></tr>';
            member_reports_html +='<tr><td>Öğrenciler(Üye kaydı):</td><td>'+students+'</td></tr>';
            member_reports_html += "</table>";

            $(".member_reports_viewer").html(member_reports_html);
        


            //all_abstarcts
            var all_abstract_numbers = 0;
            for(i=0;i<all_abstracts.length;i++)
            {
                all_abstract_numbers += 1;
            }

            var abstract_reports_html = "<table>";
            abstract_reports_html +='<tr><td>Tüm Bildiriler:</td><td>'+all_abstract_numbers+'</td></tr>';
            
            var all_categories_arr = {};

            for(i=0;i<all_abstracts.length;i++)
            {
                var cakisma = 0;
                for(var a in all_categories_arr) {
                    if(a == all_abstracts[i][7])
                    {
                        all_categories_arr[a] +=1;
                        cakisma = 1;
                        break;
                    }
                }
                if(cakisma == 0)
                {
                    var abstract_cat = all_abstracts[i][7];
                    all_categories_arr[abstract_cat] =1;
                }

            }

            for(var a in all_categories_arr)
            {
                abstract_reports_html +='<tr><td>'+a+'</td><td>'+all_categories_arr[a]+'</td></tr>';
            }
            abstract_reports_html += "</table>";
            $(".abstract_reports_viewer").html(abstract_reports_html);
               
        });


    </script>

</body>
</html>
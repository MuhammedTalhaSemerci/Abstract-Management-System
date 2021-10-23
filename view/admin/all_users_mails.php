<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div style="margin-top:20px;margin-bottom:20px;display:flex; justify-content:center;">

<select class="member_info">
    <option value="">Seçim Yapınız</option>
    <option value="uye_mail">Üye Mailleri</option>
    <option value="uye_tel">Üye Telefonları</option>
    <option value="uye_kurum">Üye Kurumları</option>
    <option value="uye_fatura" data-control="1">Kontrol Edilmiş Fatura Bilgileri</option>
    <option value="uye_fatura" data-control="0">Kontrol Edilmemiş Fatura Bilgileri</option>
    <option value="uye_kargo" data-control="1">Kontrol Edilmiş Kargo Bilgileri</option>
    <option value="uye_kargo" data-control="0">Kontrol Edilmemiş Kargo Bilgileri</option>
</select>

</div>
    
<div class="data_shower" style="text-align:center;">

</div>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        
    <script>


        <?php
        
        $uye_mail = [];
        $uye_tel = [];
        $uye_kurum = [];
        $uye_fatura_paid =[];
        $uye_fatura_wpaid =[];
        $uye_kargo_wpaid = [];
        $uye_kargo_paid = [];

        $cargo_paid_queue = 1;
        $cargo_wpaid_queue = 1;

        for($i=0;$i<count($all_users);$i++)
        {
            $withdrawals = json_decode($all_users[$i]["withdrawals"])[0];

            if($withdrawals[3] == 1)
            {

                array_push($uye_mail,$all_users[$i]["uye_adi"].' '.$all_users[$i]["uye_soyadi"].":&nbsp;&nbsp;&nbsp;&nbsp;".$all_users[$i]["uye_mail"]);
                array_push($uye_tel,$all_users[$i]["uye_adi"].' '.$all_users[$i]["uye_soyadi"].":&nbsp;&nbsp;&nbsp;&nbsp;".$all_users[$i]["uye_tel"]);
                array_push($uye_kurum,$all_users[$i]["uye_adi"].' '.$all_users[$i]["uye_soyadi"].":&nbsp;&nbsp;&nbsp;&nbsp;".$all_users[$i]["uye_kurum"].', '.$all_users[$i]["uye_sehir"]);
                $member_bill_control = ($all_users[$i]["uye_fatura_kontrol"] == 1)? "checked" : "";
                $withdrawals_details = explode("/",$withdrawals[1])[0];
                $member_paid = intval($all_users[$i]["uye_odenen"]); 
                $kdv = $member_paid/1.18;
                if(isset($all_users[$i]["uye_fatura_isim"]) || isset($all_users[$i]["uye_fatura_vergi_no"]) || isset($all_users[$i]["uye_fatura_vergi_dairesi"]) || isset($all_users[$i]["uye_fatura_not"]) || isset($all_users[$i]["uye_fatura_mail"]))
                {
                    if($all_users[$i]["uye_fatura_kontrol"] == 0)
                    {
                        array_push($uye_fatura_wpaid,
                            '<div style="border:2px solid black;margin:20px;border-radius:10px;">'.$all_users[$i]["uye_adi"].' '.$all_users[$i]["uye_soyadi"].":<br>".'Fatura üzerinde yazan isim: '.$all_users[$i]["uye_fatura_isim"].'<br> Fatura vergi no/TC: '.$all_users[$i]["uye_fatura_vergi_no"].'<br> Fatura Vergi Dairesi: '.$all_users[$i]["uye_fatura_vergi_dairesi"].'<br> Fatura notu: '.$all_users[$i]["uye_fatura_not"].'<br> Faturanın Gönderileceği Mail Adresi: '.$all_users[$i]["uye_fatura_mail"].'<br>Kayıt Türü: <font color="red">'.$withdrawals_details.'</font>, KDV dahil :'.$member_paid.', KDV hariç: '.str_replace(".",",",strval(($member_paid-($member_paid-$kdv)))).' <br> Üye Açıklaması: '.$all_users[$i]["uye_aciklama"].'<br>(Fatura Durum: <input class="bill_info" onclick="bill_info(this)" type="checkbox" data-id="'.$all_users[$i]["id"].'" '.$member_bill_control.'>)</div>'
                        );
                    }
                    else if($all_users[$i]["uye_fatura_kontrol"] == 1)
                    {
                        array_push($uye_fatura_paid,
                            '<div style="border:2px solid black;margin:20px;border-radius:10px;">'.$all_users[$i]["uye_adi"].' '.$all_users[$i]["uye_soyadi"].":<br>".'Fatura üzerinde yazan isim: '.$all_users[$i]["uye_fatura_isim"].'<br> Fatura vergi no/TC: '.$all_users[$i]["uye_fatura_vergi_no"].'<br> Fatura Vergi Dairesi: '.$all_users[$i]["uye_fatura_vergi_dairesi"].'<br> Fatura notu: '.$all_users[$i]["uye_fatura_not"].'<br> Faturanın Gönderileceği Mail Adresi: '.$all_users[$i]["uye_fatura_mail"].'<br>Kayıt Türü: <font color="red">'.$withdrawals_details.'</font>, KDV dahil :'.$member_paid.', KDV hariç: '.str_replace(".",",",strval(($member_paid-($member_paid-$kdv)))).' <br> Üye Açıklaması: '.$all_users[$i]["uye_aciklama"].'<br>(Fatura Durum: <input class="bill_info" onclick="bill_info(this)" type="checkbox" data-id="'.$all_users[$i]["id"].'" '.$member_bill_control.'>)</div>'
                        );
                    }
                    else{}
                    
                }
  

                if(isset($all_users[$i]["uye_kargo_adres"]) && $all_users[$i]["uye_kargo_adres"] != "" && isset($all_users[$i]["uye_kargo_adres"]))
                {
                    $member_cargo_control = ($all_users[$i]["uye_kargo_kontrol"] == 1)? "checked" : "";
                    if($all_users[$i]["uye_kargo_kontrol"] == 0)
                    {
                        array_push($uye_kargo_wpaid,
                            $cargo_wpaid_queue.".) ".$all_users[$i]["uye_adi"].' '.$all_users[$i]["uye_soyadi"].": ".$all_users[$i]["uye_kargo_adres"].', '.$all_users[$i]["uye_tel"].', '.$withdrawals_details.', '.$all_users[$i]["uye_aciklama"].' (Kargo Durum: <input class="cargo_info" onclick="cargo_info(this)" type="checkbox" data-id="'.$all_users[$i]["id"].'" '.$member_cargo_control.'>)<br><br>'
                        );
                        $cargo_wpaid_queue++;
                    }
                    else if($all_users[$i]["uye_kargo_kontrol"] == 1)
                    {
                        array_push($uye_kargo_paid,
                            $cargo_paid_queue.".) ".$all_users[$i]["uye_adi"].' '.$all_users[$i]["uye_soyadi"].": ".$all_users[$i]["uye_kargo_adres"].', '.$all_users[$i]["uye_tel"].', '.$withdrawals_details.', '.$all_users[$i]["uye_aciklama"].' (Kargo Durum: <input class="cargo_info" onclick="cargo_info(this)" type="checkbox" data-id="'.$all_users[$i]["id"].'" '.$member_cargo_control.'>)<br><br>'
                        );
                        $cargo_paid_queue++;
                    }
                }
            }

        }
        
        ?>
        var uye_infos = 
            {
                uye_mail:<?php echo json_encode($uye_mail,JSON_UNESCAPED_UNICODE);?>, 
                uye_tel:<?php echo json_encode($uye_tel,JSON_UNESCAPED_UNICODE);?>,  
                uye_kurum:<?php echo json_encode($uye_kurum,JSON_UNESCAPED_UNICODE);?>,
                "uye_fatura0":<?php echo json_encode($uye_fatura_wpaid,JSON_UNESCAPED_UNICODE);?>,
                "uye_fatura1":<?php echo json_encode($uye_fatura_paid,JSON_UNESCAPED_UNICODE);?>,
                "uye_kargo0":<?php echo json_encode($uye_kargo_wpaid,JSON_UNESCAPED_UNICODE);?>,
                "uye_kargo1":<?php echo json_encode($uye_kargo_paid,JSON_UNESCAPED_UNICODE);?>,


            }

        $(".member_info").change(function(){

            var value = $(this).val();

            var html = "";
            if(value == "uye_fatura" || value == "uye_kargo")
            {
                var control = $('option:selected', this).attr("data-control");
                var data = JSON.parse(JSON.stringify(uye_infos[String(value)+String(control)]));
                for(i=0;i<data.length;i++)
                {
                    html += '<div>'+data[i]+'</div>';
                }
            }
            else
            {
                var data = JSON.parse(JSON.stringify(uye_infos[value]));
                for(i=0;i<data.length;i++)
                {
                    html += '<div>'+data[i]+'</div>';
                }
            }

           

            $(".data_shower").html(html);


        })


        function bill_info(el)
        {
            if($(el).is(":checked"))
            {
                $.post("/admin_accept_users_bill_info",{state:1,id:el.dataset.id},function(returnVal){
                    if(returnVal == 1)
                    {
                        alert("İşlem başarıyla gerçekleştirildi")
                    }
                    else
                    {
                        alert("İşlem gerçekleştirilirken bir hata meydana geldi")
                    }
                }).fail(function(){
                    alert("İşlem gerçekleştirilirken bir hata meydana geldi")
                });
            }
            else
            {
                $.post("/admin_accept_users_bill_info",{state:0,id:el.dataset.id},function(returnVal){
                    if(returnVal == 1)
                    {
                        alert("İşlem başarıyla gerçekleştirildi")
                    }
                    else
                    {
                        alert("İşlem gerçekleştirilirken bir hata meydana geldi")
                    }
                }).fail(function(){
                    alert("İşlem gerçekleştirilirken bir hata meydana geldi")
                });
            }
        }

        function cargo_info(el)
        {
            if($(el).is(":checked"))
            {
                $.post("/admin_accept_users_cargo_info",{state:1,id:el.dataset.id},function(returnVal){
                    if(returnVal == 1)
                    {
                        alert("İşlem başarıyla gerçekleştirildi")
                    }
                    else
                    {
                        alert("İşlem gerçekleştirilirken bir hata meydana geldi")
                    }
                }).fail(function(){
                    alert("İşlem gerçekleştirilirken bir hata meydana geldi")
                });
            }
            else
            {
                $.post("/admin_accept_users_cargo_info",{state:0,id:el.dataset.id},function(returnVal){
                    if(returnVal == 1)
                    {
                        alert("İşlem başarıyla gerçekleştirildi")
                    }
                    else
                    {
                        alert("İşlem gerçekleştirilirken bir hata meydana geldi")
                    }
                }).fail(function(){
                    alert("İşlem gerçekleştirilirken bir hata meydana geldi")
                });
            }
        }


        console.log()
    </script>

</body>
</html>
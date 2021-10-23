//////Yazı Ekle //////////
function yazi_kaydet(){
    
    var yazi_baslik     = $("input[name=yazi_baslik]").val();
    if(yazi_baslik =="" ){
        alert("Başlık boş bırakılamaz").stop();
    };
    var seo_baslik      = $("span[name=seo_baslik]").html();
    var yazi_icerik     = $("textarea[name=message]").val();
    if(yazi_icerik =="" ){
        alert("İçerik boş bırakılamaz").stop();
    };
    //Foto//Foto adı Sessionda gidiyor
    var yazi_etiket     = $("input[name=yazi_etiket]").val();
    var yazi_durum      = $("input[name=yazi_durum]:checked").val();
    var slayt_durum     = $("input[name=slayt_durum]:checked").val();
    var yazi_kategori   = $("input[name=yazi_kategori]:checked").val();

    if(yazi_kategori == undefined){
        alert("Kategori seçiniz").stop();
    };



     

 
    $.ajax({

        type        : "POST",
        url         : "kutuphane/php/veri_ekle.php",
        headers     : {'fonksiyon' : 'yazi_ekle'},
        data        : { 
            yazi_baslik     : yazi_baslik, 
            seo_baslik      : seo_baslik, 
            yazi_icerik     : yazi_icerik, 
            yazi_etiket     : yazi_etiket,
            yazi_durum      : yazi_durum,
            slayt_durum     : slayt_durum,
            yazi_kategori   : yazi_kategori
                    },
        success : function(sonuc){
                if(sonuc == 1)
                    {
                        alert("Yazı Kaydedildi");
                        setTimeout(function(){window.location.href='tum_yazilar.php';},500);
                    }
                    else
                    {
                        alert("Hata Oluştu");
                    }
                }
    });
}




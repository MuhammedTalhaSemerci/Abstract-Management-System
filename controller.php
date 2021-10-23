<?php

class Controller
{

    public function view($name,$data =[])
    {
       extract($data);
        require __DIR__ . '/view/' . strtolower($name) . '.php';
    }
   
  


    public function model($name)
    {
        require __DIR__ . '/model/' . strtolower($name) . '.php';
        return new $name();
    }

    public function all_abstracts($all_abstracts)
        {

            $all_abstracts_arr = [];

            for($i=0;$i<count($all_abstracts);$i++)
            {




                $abstract_main_name= json_decode($all_abstracts[$i]["main_author"])[0];
                $abstract_main_surname= json_decode($all_abstracts[$i]["main_author"])[1];
                $abstract_main_mail= json_decode($all_abstracts[$i]["main_author"])[3];
                $abstract_other_contact = $all_abstracts[$i]["alt_contact"];
                $abstract_id = $all_abstracts[$i]["abstract_no"];
                $accepted = $all_abstracts[$i]["accepted"];
                $abstract_title = strip_tags($all_abstracts[$i]["title"]);
                $abstract_sub_category = $all_abstracts[$i]["abstract_sub_category"];
                $abstract_edit_requests = $all_abstracts[$i]["edit_requests"];
                $abstract_referee_comments = $all_abstracts[$i]["referee_comments"];
                $abstract_referee_ids = $all_abstracts[$i]["referee_ids"];
                $abstract_type = $all_abstracts[$i]["abstract_type"];
                $register_id = $all_abstracts[$i]["register_id"];
                $abstract_english_title = strip_tags($all_abstracts[$i]["title_english"]);
                $abstract_main_author_id = strip_tags($all_abstracts[$i]["main_author_id"]);
                $abstract_category = strip_tags($all_abstracts[$i]["abstract_category"]);
                $abstract_presentation_files = ($all_abstracts[$i]["presentation_files"] != null && $all_abstracts[$i]["presentation_files"] != "[]")? json_decode($all_abstracts[$i]["presentation_files"])[0]:[];


                
                




                ##########################################
                $abstract_main_author = json_decode($all_abstracts[$i]["main_author"]);
                $abstract_other_author = json_decode($all_abstracts[$i]["other_author"]);

                if($abstract_other_author != null)
                {
                    if(array_key_exists(4,$abstract_main_author))
                    {
                        array_splice($abstract_other_author,intval($abstract_main_author[4])-1,0,[$abstract_main_author]);
                        $abstract_all_authors = $abstract_other_author; 
                    }
                    else
                    {
                        $abstract_main_author[4] = 1;
                        array_splice($abstract_other_author,0,0,[$abstract_main_author]);
                        $abstract_all_authors = $abstract_other_author; 
                    }
                }
    
                else
                {
                    $abstract_main_author[4] = 1;
                    $abstract_all_authors = [$abstract_main_author];
                }
                $abstract_main_author = [];
                $abstract_other_author = [];

                $abstract_all_authors_html ="";

                for($a=0;$a<count($abstract_all_authors);$a++)
                {
                    if(array_key_exists(4,$abstract_all_authors[$a]) && $abstract_all_authors[$a][4] == ($a+1))
                    {
                        if($a == 0)
                        {
                            $abstract_all_authors_html .= '<u>'.mb_convert_case($abstract_all_authors[$a][0], MB_CASE_TITLE, "UTF-8").' '.mb_strtoupper($abstract_all_authors[$a][1]).'</u>';
                        }
                        else
                        {
                            $abstract_all_authors_html .= ', <u>'.mb_convert_case($abstract_all_authors[$a][0], MB_CASE_TITLE, "UTF-8").' '.mb_strtoupper($abstract_all_authors[$a][1]).'</u>';
                        }
                    }
                    else
                    {
                        if($a == 0)
                        {
                            $abstract_all_authors_html .= mb_convert_case($abstract_all_authors[$a][0], MB_CASE_TITLE, "UTF-8").' '.mb_strtoupper($abstract_all_authors[$a][1]);
                        }
                        else
                        {
                            $abstract_all_authors_html .= ', '.mb_convert_case($abstract_all_authors[$a][0], MB_CASE_TITLE, "UTF-8").' '.mb_strtoupper($abstract_all_authors[$a][1]);
                        }
                    }
                }

                ###################################################



                $abstract_category_char = mb_strtoupper($all_abstracts[$i]["abstract_category"][0]);
                if(strpos($all_abstracts[$i]["abstract_type"],"-"))
                {
                    $abstract_type_char = mb_strtoupper($all_abstracts[$i]["abstract_type"][strpos($all_abstracts[$i]["abstract_type"],"-")+1]);
                }
                else
                {
                    $abstract_type_char = mb_strtoupper($all_abstracts[$i]["abstract_type"][0]);
                }
                $last_abstract_no = intval($all_abstracts[$i]["last_abstract_no"]);
                
            
                array_push($all_abstracts_arr, 
                [
                    $abstract_main_name,
                    $abstract_main_surname,
                    $abstract_main_mail,
                    $abstract_other_contact,
                    $abstract_id,
                    $accepted,
                    $abstract_title,
                    $abstract_sub_category,
                    $abstract_edit_requests,
                    $abstract_referee_comments,
                    $abstract_referee_ids,
                    $abstract_all_authors_html,
                    $abstract_type,
                    $last_abstract_no,
                    $register_id,
                    $abstract_english_title,
                    $abstract_main_author_id,
                    $abstract_category,
                    $abstract_presentation_files
                ]);
                
            }

            return $all_abstracts_arr;
        }


    public function language()
    {
        $language = 
        [
            'en'=>
            [
                'login' =>
                [
                    '8. Plant Protection Congress with International Participation',
                    'Nutuva Abstract Management System',
                    'You already Logged in',
                    'You didn\'t login',
                    'Member Login',
                    'E-mail',
                    'Password',
                    'Login',
                    'I forget my password',
                    'Register',
                    'Your password change process has been successfully finished. You could login with your new password.',
                    'Your password change link expired, so your password change process failed.',
                    'Your registration process has been successfully finished, so you could login your account.',
                    'This mail address exists in the system. Please try to login. If you have any trouble while you are trying to login, you could use \'I forget my password\'.',
                    'Please try again to login. If you have any trouble while you are trying to login, you could use \'I forget my password\'.'
                ],
               

                'register'=>
                [
                    '8. Plant Protection Congress with International Participation',
                    'Nutuva Abstract Management System',
                    'You already Logged in',
                    'You didn\'t login',
                    'Register Now',
                    'Name',
                    'Surname',
                    'Phone Number',
                    'City',
                    'Choose',
                    'Out of Turkey',
                    'Degree',
                    'Choose',
                    [
                        ["Öğrenci","Asistan","Dr.","Dr. Öğr. Gör.","Doç. Dr.","Prof. Dr.","Mühendis","Hekim","Vet. Hekim"],
                        ["Student","Assistant","Dr.","Dr. lecturer","Assoc. Prof. Dr.","Prof. Dr.","Engineer","Physician","Vet. Physician"]
                    ],
                    'Expertness',
                    'Institution',
                    'Registration Type',
                    'Choose',
                    'Congress Participant',
                    'Scince Board Member',
                    'Choose Congress',
                    'Choose',
                    'Choose Category',
                    'Choose Sub-category',
                    'E-mail',
                    'Password',
                    ['KVKK text ','is read and admitted. (This paper includes some rules to save personal data)'],
                    'Register Now',
                    'Choose',

                ],

                'profile_update'=>
                [
                    '8. Plant Protection Congress with International Participation',
                    'Profile Arrangement Page',
                    'Name',
                    'Surname',
                    'Phone Number',
                    'City',
                    'Choose',
                    'Out of Turkey',
                    'Degree',
                    'Choose',
                    [
                        ["Öğrenci","Asistan","Dr.","Dr. Öğr. Gör.","Doç. Dr.","Prof. Dr.","Mühendis","Hekim","Vet. Hekim"],
                        ["Student","Assistant","Dr.","Dr. lecturer","Assoc. Prof. Dr.","Prof. Dr.","Engineer","Physician","Vet. Physician"]
                    ],
                    'Expertness',
                    'Institution',
                    'Bill Address which is on the bill',
                    'Bill Tax No',
                    'Bill Tax Administration No',
                    'Bill Note',
                    'Bill Address',
                    'Congress Backpack Cargo Address',
                    'Save',
                    'The process is successfully finished.',
                    'An error occurred while the process was running.',
                ],

                
                //abstracter
                'abstracter_language'=>
                [
                    '8. Plant Protection Congress with International Participation',
                    'Log-out',
                    'My Profile',
                    'Registration',
                    'Congress Pre-registration',
                    'Send File',
                    'Registration state',
                    'Abstract operations',
                    'Send Abstract',
                    'My Abstracts',
                    'Scientific Program',
                    'Session Infos',
                    'My Presentations',
                    'Dashboard',
                    'Home',
                    'Dashboard',
                ],

                'abstract_upload'=>
                [
                    '8. Plant Protection Congress with International Participation',
                    'Previous',
                    'Next',
                    'Step',
                    'Choose the congress which you want to upload the abstract.',
                    'Choose',
                    'Choose the main category which you want to upload the abstract.',
                    'Choose a Sub-category.',
                    'Indicate the amount of authors for writing their information',
                    'Indicate the amount of authors.',//placeholder
                    'Abstract type',
                    [
                        ["Sözlü Sunum","E-poster"],
                        ["Oral Presentation","E-poster"]
                    ],
                    'Choose your abstract language.',
                    'Turkish/English',
                    'English',
                    'Alternative mail address',
                    'Abstract Title (Turkish)',
                    'Abstract(Turkish)',
                    'Word limit:',
                    'Keywords (Turkish)',
                    'Keywords 1, keywords 2, ...',//keyword placeholder
                    'Abstract  (English)',
                    'Abstract (English)',
                    'Word limit:',
                    'Keywords (English)',
                    'Keywords 1, keywords 2, ...',//keyword placeholder
                    'Abstract Title (English)',
                    'Abstract (English)',
                    'Word limit:',
                    'Keywords (English)',
                    'Keywords 1, keywords 2, ...',//keyword placeholder
                    'Supports and contributions',
                    'This abstract is supported by xx',//placeholder
                    'Comments and explanations ',
                    'Save',
                    'please wait...',
                    'Abstract (Turkish)',
                    'Abstract (English)',
                    'Abstract (English)',
                    'Abstract Title (Turkish)',
                    'Abstract Title (English)',
                    'Abstract Title (English)',
                    'You exceed the limit!',
                    'Choose',
                    'Author 1',
                    'Name',
                    'Surname',
                    'Institution',
                    'E-mail',
                    'Corresponding Author',
                    'Author',
                    'Name',
                    'Surname',
                    'Institution',
                    'E-mail',
                    'Corresponding Author',
                ],

                'abstract_update'=>
                [
                    '8. Plant Protection Congress with International Participation',
                    'Abstract type',
                    [
                        ["Sözlü Sunum","E-poster"],
                        ["Oral Presentation","E-poster"]
                    ],
                    'Choose your abstract language',
                    'Turkish/English',
                    'English',
                    'Alternative mail address',
                    'Abstract Title (Turkish)',
                    'Abstract(Turkish)',
                    'Keywords (Turkish)',
                    'Keywords 1, keywords 2, ...',//keyword placeholder
                    'Abstract  (English)',
                    'Abstract (English)',
                    'Keywords (English)',
                    'Keywords 1, keywords 2, ...',//keyword placeholder
                    'Abstract Title (English)',
                    'Abstract (English)',
                    'Keywords (English)',
                    'Keywords 1, keywords 2, ...',//keyword placeholder
                    'Supports and contributions',
                    'This abstract is supported by xx',//placeholder
                    'Comments and explanations ',
                    'Save',
                    'please wait...',
                    'Abstract (Turkish)',
                    'Abstract (English)',
                    'Abstract (English)',
                    'Abstract Title (Turkish)',
                    'Abstract Title (English)',
                    'Abstract Title (English)',
                ],
                'my_abstracts'=>
                [
                    '8. Plant Protection Congress with International Participation',
                    'Abstract judgement is waited.',
                    'Your abstract is accepted',
                    'Your abstract is rejected',
                    'Abstract arrangement is waited',
                    'Abstract has been arranged sucessfully. The judgement is waited. <font color="red">(When you finish your arrangement, you have to finalize that by using "Finalize the Arrangement" button.)</font>',
                    'Scientific Committee Member assignment is done.',
                    'Abstract no',
                    'Corresponding Author',
                    'Abstract title',
                    'Abstract category',
                    'Abstract state',
                    'Science board member appreciation',
                    'Upload Presentation',
                    'acceptance letter',
                    'Finalize the Arrangement',
                    'Arrange abstract',
                    'Arrange category',
                    'Add/Change Author',
                    'View',
                    'View',
                    'Arrange abstract',
                    'Arrange category',
                    'Add/Change Author',
                    'View',
                    'Delete Abstract',
                    'View',
                    'Are you sure to do the process ?',
                    'The process was stopped !',
                    'Are you sure to do the process ?',
                    'The process was stopped !',
                    'Science board member appreciation',
                ],

                'abstract_category_update'=>
                [
                    '8. Plant Protection Congress with International Participation',
                    'Choose the congress which you want to upload the abstract.',
                    'Choose',
                    'Choose the main category which you want to upload the abstract.',
                    'Choose',
                    'Choose a Sub-category.',
                    'Save',
                    'please wait...',
                    'Choose',
                ],

                'abstract_author_update'=>
                [
                    '8. Plant Protection Congress with International Participation',
                    'Indicate the amount of authors for writing their information',
                    'Indicate the amount of authors.',//placeholder
                    'Author',
                    'Name',
                    'Surname',
                    'Institution',
                    'E-mail',
                    'Corresponding Author',
                    'Save',
                    'please wait...',
                    'Author 1',
                    'Name',
                    'Surname',
                    'Institution',
                    'E-mail',
                    'Corresponding Author',
                    'Author',
                    'Name',
                    'Surname',
                    'Institution',
                    'E-mail',
                    'Corresponding Author',
                ],

                'accepted_abstract_document'=>
                [
                    [
                        ['E-poster','Sözlü Sunum'],
                        ['E-poster','Oral Presentation']                    
                    ],
                    'Accepted',
                ],

                'congress_register_status'=>
                [
                    '8. Plant Protection Congress with International Participation',
                    'Student Document and receipt uploading are expected.',
                    'Receipt is expected.',
                    'Waiting for manager acception.',
                    'Your congress register process is completed.',
                    'Your congress register process is completed.',
                    'Your congress register process is rejected.',
                    [
                        ["Katılımcı Kaydı","Normal Kayıt","Öğrenci Kaydı","Burslu Kayıt","Davetli Konuşmacı"],
                        ["Participant Registration","Normal Registration","Student Registration","Bursary Registration","Invited Speaker"],
                    ],
                    [
                        ["Erken Kayıt","Geç Kayıt"],
                        ["Pre-registration","Late registration"],
                    ],
                    'Congress',
                    'Registeration degree',
                    'The amount that will be paid ',
                    'The amount that is paid',
                    'Registration type',
                    'Acception state',
                    'Delete the congress registration',
                    'View the invitation paper',
                    'You don\'t have any registraiton to congresses .',
                    'Are you sure to do the process ?',
                    'The process was stopped !',
                ],

                'congress_document_upload'=>
                [
                    'Choose the files which you wanted (gif, jpeg, jpg, png, docx, pdf)',
                    'Student Document',
                    'Receipt',
                    'Save',
                    'Your files',
                    [
                        ["Öğrenci Belgesi","Dekont"],
                        ["Student Document","Receipt"],
                    ],
                    'Delete file',
                ],


                'abstract_viewer' =>
                [
                    '8. Plant Protection Congress with International Participation',
                    'Download as a Pdf',
                    'Download as a Word',
                    'Corresponding Author:',
                    'Keywords:',
                    'Comment',
                ],
                'abstract_booker' =>
                [
                    '8. Plant Protection Congress with International Participation',
                    'Corresponding Author:',
                    'Keywords:',
                    'Comment',
                ],

                'abstract_presentations'=>
                [
                    'Choose the files which you wanted (Only "pdf" files / max 10 mb)',
                    'Save',
                    'Your files',
                    'Delete file',
                ],
                
                //Ücretlendirmeler
                'congress_register'=>
                [
                    'Online Registration',
                    'Registration Prices',
                    'Early registration',
                    'June 01, 2021 and Before',
                    'Late registration',
                    'June 01, 2021 After',
                    //Student
                    'Student registration',
                    '50 $',
                    '50',
                    '/yabanci',
                    '65 $',
                    '65',
                    '/yabanci',
                    //Normal
                    'Normal registration',
                    '65 $',
                    '65',
                    '/yabanci',
                    '80 $',
                    '80',
                    '/yabanci',
                    //Participant
                    'Participant registration',
                    '60 $',
                    '60',
                    '/yabanci',
                    '80 $',
                    '80',
                    '/yabanci',
                    'The fee That will be paid',
                    'Registration fee (USD)',
                    '0 $',
                    'Total fee (USD)',
                    '0 $',
                    'Note : Your registration is pre-registration and you must complete your payment for final registration. Receipt
                    and student document proves that you are a student to the system, so please upload the documents, after that your payment will be done by the system administrator.
                    Your congress registration will be confirmed within 24 hours. Check your registration from the registration status menu. 
                    If you think there is an issue, please contact the system administrator via bilgi@nutuva.com. ',
                    'Pre-registration.',
                    'BANK ACCOUNT INFORMATONS',
                    'Account Owner Name :',
                    'Nutuva Organizasyon (Fikret AKDİŞ)',
                    'Bank Name :',
                    'Kuveyt Türk Participation Bank Ihsaniye Branch (223)',
                    '',
                    '',
                    'IBAN :',
                    'TR24 0020 5000 0017 3427 8001 01',
                    //usd account adds
                    'SWIFT Code',
                    'kteftrisxxx',
                    'Remarks',
                    'Registration Fee for Plant Protection Congress',
                    //
                    '',
                    'It is mandatory for all participants to register for the congress.',
                    'Participation fee includes participation certificate, congress materials and participation in general scientific activities.',
                    'CANCELLATION CONDITIONS',
                    'All cancellation requests must be notified to Nutuva Organization in writing.',
                    'For cancellation requests made before August 15, 2021, 90% of the remaining amount will be refunded after the money transfer fees have been deducted.',
                    'For cancellations made after August 16, 2021, 50% of the remaining amount will be refunded after the transfer costs are deducted.',
                    'All refunds will be made after the congress.',
                    '$',
                    '$',
                ],

                'session_abstract_info'=>
                [
                    'Moderator Informations: ',
                    'Moderator:',
                    'Session Day: ',
                    'Session Saloon: ',
                    'Session Name: ',
                    'Session Time: ',
                    'Moderator Invitation Paper',
                    'Start the session',
                ],
                'main_author_abstracts'=>
                [
                    'Presentation Informations: ',
                    'Session Day: ',
                    'Session Saloon: ',
                    'Session Time : ',
                    'Abstract Number: ',
                    'Abstract Title: ',
                    'Abstract Authors: ',
                    'Upload a presentation',
                    'Acceptance letter',
                    'Start The Session',
                ],
                'scientific_program_viewer'=>
                [
                    'Moderator:',
                ],
                'virtual_congress_sponsor_documents'=>
                [
                    'Company Brochures:',
                    'Choose the files which you wanted (pdf, jpeg, jpg, png)',
                    'Save',
                    'Your files',
                    'Delete file',
                ],
     
                'virtual_congress_sponsor_videos'=>
                [
                    'Company videos:',
                    'Choose the files which you wanted (50MB/mp4,webm)',
                    'Save',
                    'Your files',
                    'Delete file',
                ],
            ],


            'tr' =>
            [
                'login' =>
                [
                    '8. Uluslararası Katılımlı Bitki Koruma Kongresi',
                    'Nutuva Bildiri Yönetim Sistemi',
                    'Giriş yapıldı',
                    'Giriş yapılmadı',
                    'Üye Giriş',
                    'E-posta',
                    'Şifre',
                    'Giriş Yap',
                    'Şifremi Unuttum',
                    'Kayıt Ol',
                    'Şifre değiştirme işlemi başarılı oldu. Yeni şifreniz ile giriş yapabilirsiniz.',
                    'Kullandığınız şifre yenileme linki zaman aşımına uğradığı için şifre yenilenemedi.',
                    'Kayıt işleminiz başarılı olmuştur. Lütfen giriş yapınız.',
                    'Mail adresi kayıtlı gözüküyor. Lütfen giriş yapmayı deneyin. Giriş yapmakta sorun yaşıyorsanız \'şifremi unuttum\' ile yeni bir şifre belirleyebilirsiniz.',
                    'Lütfen tekrar giriş yapmayı deneyin. Giriş yapmakta sorun yaşıyorsanız \'şifremi unuttum\' ile yeni bir şifre belirleyebilirsiniz.'
                ],

                'register'=>
                [
                    '8. Uluslararası Katılımlı Bitki Koruma Kongresi',
                    'Nutuva Bildiri Yönetim Sistemi',
                    'Giriş yapıldı',
                    'Giriş yapılmadı',
                    'Kayıt Ol',
                    'Ad',
                    'Soyad',
                    'Cep Telefonu',
                    'Şehir',
                    'Seçim Yapın',
                    'Türkiye Dışı',
                    'Ünvan',
                    'Seçim Yapın',
                    [
                        ["Öğrenci","Asistan","Dr.","Dr. Öğr. Gör.","Doç. Dr.","Prof. Dr.","Mühendis","Hekim","Vet. Hekim"]
                    ],
                    'Uzmanlık',
                    'Kurum',
                    'Üyelik Türü',
                    'Seçim Yapın',
                    'Kongre Katılımcısı',
                    'Bilim Kurulu Üyesi',
                    'Kongre Seçim Yapın',
                    'Seçim Yapın',
                    'Kategori Seçim Yapın',
                    'Alt Kategori Seçim Yapın',
                    'E-posta',
                    'Şifre',
                    ['KVKK Metnini','Okudum, kabul ediyorum.'],
                    'Kayıt Ol',
                    'Seçim Yapın',
                ],

                'profile_update'=>
                [
                    '8. Uluslararası Katılımlı Bitki Koruma Kongresi',
                    'Profil Düzenleme Sayfası',
                    'Ad',
                    'Soyad',
                    'Cep Telefonu',
                    'Şehir',
                    'Seçim Yapınız',
                    'Türkiye Dışı',
                    'Ünvan',
                    'Seçim Yapınız',
                     [
                        ["Öğrenci","Asistan","Dr.","Dr. Öğr. Gör.","Doç. Dr.","Prof. Dr.","Mühendis","Hekim","Vet. Hekim"],
                     ],
                    'Uzmanlik',
                    'Kurum',
                    'Fatura Üstünde Görünecek İsim veya Kurum Adı',
                    'Fatura Vergi No/TC',
                    'Fatura Vergi Dairesi',
                    'Fatura Üzerine Yazılmasını İstediğiniz Not yada Proje Adı',
                    'Faturanın Gönderileceği Mail Adresi',
                    'Kongre Çantasının Gönderileceği Adres',
                    'Kaydet',
                    'İşlem başarıyla gerçekleştirildi.',
                    'İşlem sırasında bir hata oluştu',
                ],

                //abstracter
                'abstracter_language'=>
                [
                    '8. Uluslararası Katılımlı Bitki Koruma Kongresi',
                    'Güvenli Çıkış',
                    'Profilim',
                    'Kayıt İşlemleri',
                    'Kongre Ön Kayıt',
                    'Belge Gönder',
                    'Kayıt Durum Sorgula',
                    'Bildiri İşlemleri',
                    'Bildiri Yükle',
                    'Bildirilerim',
                    'Bilimsel Program',
                    'Oturum Bilgileri',
                    'Sunumlarım',
                    'Kontrol Paneli',
                    'Ev',
                    'Kontrol Paneli',
                ],

                'abstract_upload'=>
                [
                    '8. Uluslararası Katılımlı Bitki Koruma Kongresi',
                    'Önceki',
                    'Sonraki',
                    'Adım',
                    'Bildiri yüklemek istediğiniz kongreyi seçin',
                    'Seçim Yapın',
                    'Bildiri yüklemek istediğiniz ana kategoriyi seçin',
                    'Alt kategoriyi seçin.',
                    'Yazar bilgilerini eklemek için kaç yazar bulunduğunu sayı cinsinde yazınız.',
                    'Yazar sayısını belirtin',//placeholder
                    'Bildiri Türü',
                    [
                        ["Sözlü Sunum","E-poster"]
                    ],
                    'Bildirinizin dilini seçiniz',
                    'Türkçe/İngilizce',
                    'İngilizce',
                    'Alternatif mail adresi',
                    'Bildiri Başlığı (Türkçe)',
                    'Bildiri Özeti (Türkçe)',
                    'Kelime Sınırı:',
                    'Anahtar Kelimeler (Türkçe)',
                    'Anahtar kelime 1, Anahtar kelime 2, ...',//keyword placeholder
                    'Bildiri Başlığı (İngilizce)',
                    'Bildiri Özeti (İngilizce)',
                    'Kelime Sınırı:',
                    'Anahtar Kelimeler (İngilizce)',
                    'Anahtar kelime 1, Anahtar kelime 2, ...',//keyword placeholder
                    'Bildiri Başlığı (İngilizce)',
                    'Bildiri Özeti (İngilizce)',
                    'Kelime Sınırı:',
                    'Anahtar Kelimeler (İngilizce)',
                    'Anahtar kelime 1, Anahtar kelime 2, ...',//keyword placeholder
                    'Destek ve Katkılar',
                    'Bu bildiri xx tarafından desteklenmektedir',//placeholder
                    'Yorum ve Açıklamalar',
                    'Kaydet',
                    'lütfen bekleyin...',
                    'Bildiri Özeti (Türkçe)',
                    'Bildiri Özeti (İngilizce)',
                    'Bildiri Özeti (İngilizce)',
                    'Bildiri Başlığı (Türkçe)',
                    'Bildiri Başlığı (İngilizce)',
                    'Bildiri Başlığı (İngilizce)',
                    'Sınır Aşıldı!',
                    'Seçim Yapın',
                    'Yazar 1',
                    'Ad',
                    'Soyad',
                    'Kurum',
                    'E-posta',
                    'Sorumlu Yazar',
                    'Yazar',
                    'Ad',
                    'Soyad',
                    'Kurum',
                    'E-posta',
                    'Sorumlu Yazar',
                ],

                'abstract_update'=>
                [
                    '8. Uluslararası Katılımlı Bitki Koruma Kongresi',
                    'Bildiri Türü',
                    [
                        ["Sözlü Sunum","E-poster"]
                    ],
                    'Bildirinizin dilini seçiniz.',
                    'Türkçe/İngilizce',
                    'İngilizce',
                    'Alternatif mail adresi',
                    'Bildiri Başlığı (Türkçe)',
                    'Bildiri Özeti (Türkçe)',
                    'Anahtar Kelimeler (Türkçe)',
                    'Anahtar kelime 1, Anahtar kelime 2, ...',//keyword placeholder
                    'Bildiri Başlığı (İngilizce)',
                    'Bildiri Özeti (İngilizce)',
                    'Anahtar Kelimeler (İngilizce)',
                    'Anahtar kelime 1, Anahtar kelime 2, ...',//keyword placeholder
                    'Bildiri Başlığı (İngilizce)',
                    'Bildiri Özeti (İngilizce)',
                    'Anahtar Kelimeler (İngilizce)',
                    'Anahtar kelime 1, Anahtar kelime 2, ...',//keyword placeholder
                    'Destek ve Katkılar',
                    'Bu bildiri xx tarafından desteklenmektedir',//placeholder
                    'Yorum ve Açıklamalar',
                    'Kaydet',
                    'lütfen bekleyin...',
                    'Bildiri Özeti (Türkçe)',
                    'Bildiri Özeti (İngilizce)',
                    'Bildiri Özeti (İngilizce)',
                    'Bildiri Başlığı (Türkçe)',
                    'Bildiri Başlığı (İngilizce)',
                    'Bildiri Başlığı (İngilizce)',
                ],

                'my_abstracts'=>
                [
                    '8. Uluslararası Katılımlı Bitki Koruma Kongresi',
                    'Bildirinin değerlendirilmesi beklenmektedir.',
                    'Bildiriniz kabul edilmiştir',
                    'Bildiriniz reddedilmiştir',
                    'Bildinizi düzenlemeniz beklenmektedir <font color="red">(Düzenlemelerinizi tamamladıktan sonra "Bildiri düzenlemelerini sonlandır" butonu ile düzenlemelerinizi bitirmelisiniz.)</font>',
                    'Bildiriniz başarıyla düzenlenmiş olup yeniden değerlendirilmesi beklenmektedir.',
                    'Hakem ataması gerçekleşmiştir.',
                    'Bildiri no',
                    'Sorumlu yazar',
                    'Bildiri Başlığı',
                    'Bildiri kategorisi',
                    'Bildiri durumu',
                    'Bilim Kurulu Üyesi Değerlendirmesi',
                    'Sunum Yükle',
                    'Kabul Mektubu',
                    'Bildiri düzenlemelerini sonlandır',
                    'Bildiri düzenle',
                    'Kategori düzenle',
                    'Yazar Ekle/Düzenle',
                    'Görüntüle',
                    'Görüntüle',
                    'Bildiri düzenle',
                    'Kategori düzenle',
                    'Yazar Ekle/Düzenle',
                    'Görüntüle',
                    'Bildiri Sil',
                    'Görüntüle',
                    'İşlemi gerçekleştirmek istediğinizden emin misiniz ?',
                    'İşlem iptal edilmiştir !',
                    'İşlemi gerçekleştirmek istediğinizden emin misiniz ?',
                    'İşlem iptal edilmiştir !',
                    'Bilim Kurulu Üyesi Değerlendirmesi',
                ],

                'abstract_category_update'=>
                [
                    '8. Uluslararası Katılımlı Bitki Koruma Kongresi',
                    'Bildiri yüklemek istediğiniz kongreyi seçin',
                    'Seçim Yapın',
                    'Bildiri yüklemek istediğiniz ana kategoriyi seçin',
                    'Seçim Yapın',
                    'Alt kategoriyi seçin.',
                    'Kaydet',
                    'lütfen bekleyin...',
                    'Seçim Yapın',

                ],
                'abstract_author_update'=>
                [
                    '8. Uluslararası Katılımlı Bitki Koruma Kongresi',
                    'Yazar bilgilerini eklemek için kaç yazar bulunduğunu sayı cinsinde yazınız.',
                    'Yazar sayısını belirtin',//placeholder
                    'Yazar',
                    'Ad',
                    'Soyad',
                    'Kurum',
                    'E-posta',
                    'Sorumlu Yazar',
                    'Kaydet',
                    'lütfen bekleyin...',
                    'Yazar 1',
                    'Ad',
                    'Soyad',
                    'Kurum',
                    'E-posta',
                    'Sorumlu Yazar',
                    'Yazar',
                    'Ad',
                    'Soyad',
                    'Kurum',
                    'E-posta',
                    'Sorumlu Yazar',
                ],
                'accepted_abstract_document'=>
                [
                    [
                        ['E-poster','Sözlü Sunum']
                    ],
                    'Kabul edildi',
                ],
                'congress_register_status'=>
                [
                    '8. Uluslararası Katılımlı Bitki Koruma Kongresi',
                    'Öğrenci belgenizi ve dekontunuzu yüklemeniz beklenmektedir.',
                    'Dekont yüklemeniz beklenmektedir.',
                    'Admin onayı beklenmektedir.',
                    'Kongre kayıt işleminiz gerçekleştirilmiştir.',
                    'Kongre kayıt işleminiz gerçekleştirilmiştir.',
                    'Kongre kayıt işleminiz reddedilmiştir.',
                    [
                        ["Katılımcı Kaydı","Normal Kayıt","Öğrenci Kaydı","Burslu Kayıt","Davetli Konuşmacı"],
                    ],
                    [
                        ["Erken Kayıt","Geç Kayıt"],
                    ],
                    'Kongre',
                    'Kayıt Ünvanı',
                    'Ödenen Tutar',
                    'Ödenecek Tutar',
                    'Kayıt Türü',
                    'Onay durumu',
                    'Kongre kaydını sil',
                    'Davet Mektubunu Görüntüle',
                    'Herhangi bir kongre\'ye kaydınız bulunmamaktadır.',
                    'İşlemi gerçekleştirmek istediğinizden emin misiniz ?',
                    'İşlem iptal edilmiştir !',
                ],
                'congress_document_upload'=>
                [
                    'Yüklemek istediğiniz belgeleri seçiniz (gif, jpeg, jpg, png, docx, pdf)',
                    'Öğrenci Belgesi',
                    'Dekont',
                    'Kaydet',
                    'Yüklediğiniz Belgeler',
                    [
                        ["Öğrenci Belgesi","Dekont"],
                    ],
                    'belge sil',
                ],


                'abstract_viewer' =>
                [
                    '8. Uluslararası Katılımlı Bitki Koruma Kongresi',
                    'Pdf Olarak İndir',
                    'Word Olarak İndir',
                    'Sorumlu Yazar:',
                    'Anahtar Kelimeler:',
                    'Keywords:',
                    'Yorum:',
                ],
                'abstract_booker' =>
                [
                    '8. Uluslararası Katılımlı Bitki Koruma Kongresi',
                    'Sorumlu Yazar:',
                    'Anahtar Kelimeler:',
                    'Keywords:',
                    'Comments:',
                ],


                 'abstract_presentations'=>
                [
                    'Yüklemek istediğiniz belgeleri seçiniz (Sadece pdf dosyaları / maksimum 10 mb)',
                    'Kaydet',
                    'Yüklediğiniz Belgeler',
                    'belge sil',
                ],

                //Ücretlendirmeler
                'congress_register'=>
                [
                    'Online Kayıt',
                    'Kayıt Ücretleri',
                    'Erken Kayıt',
                    '01 Haziran 2021 ve Öncesi',
                    'Geç Kayıt',
                    '01 Haziran 2021 Sonrası',
                    //Student
                    'Öğrenci Kaydı',
                    '150 TL',
                    '150',
                    '',
                    '200 TL',
                    '200',
                    '',
                    //Normal
                    'Normal Kayıt',
                    '250 TL',
                    '250',
                    '',
                    '300 TL',
                    '300',
                    '',
                    //Participant
                    'Katılımcı Kaydı',
                    '200 TL',
                    '200',
                    '',
                    '250 TL',
                    '250',
                    '',
                    'ÖDENECEK TUTAR',
                    'Kayıt Tutarı (TL)',
                    '0 TL',
                    'Toplam Tutar (TL)',
                    '0 TL',
                    'Not : Kaydınız ön kayıt olup kesin kayıt için ödeme işleminizi tamamlamanız gerekmektedir. Dekont
                    ve öğrenci olduğunuzu ispatlayan belgeyi belge yükleme sayfasından sisteme yükledikten ve ödemeniz sistem yöneticisi 
                    tarafından onaylandıktan sonra kongre kaydınız en geç 24 saat içinde onaylanacaktır. Kayıt durum menüsünden kaydınızı kontrol 
                    edebilirsiniz. Bir hata olduğunu düşünüyorsanız bilgi@nutuva.com üzerinden sistem yöneticisi ile iletişime geçiniz.',
                    'Ön Kayıt',
                    'BANKA HESAP BİLGİLERİ',
                    'Hesap Adı :',
                    'Nutuva Organizasyon (Fikret AKDİŞ)',
                    'Banka Adı :',
                    'Kuveyt Türk Katılım Bankası İhsaniye Şb. (223)',
                    'TL Hesap Numarası :',
                    '173 42 78',
                    'IBAN :',
                    'TR51 0020 5000 0017 3427 8000 03',
                    //usd account adds
                    '',
                    '',
                    '',
                    '',
                    'Kayıt ücretine KDV dahildir.',
                    'Tüm katılımcıların kongreye kayıt yaptırması zorunludur.',
                    'Katılım ücretine, katılım sertifikası, kongre materyalleri ve genel bilimsel aktivitelere katılım dâhildir.',
                    'İPTAL KOŞULLARI',
                    'Tüm iptal talepleri Nutuva Organizasyon\'a yazılı olarak bildirilmelidir.',
                    '15 Ağustos 2021 tarihinden önce yapılan iptal talebinde, havale masrafları kesildikten sonra kalan miktarın %90\'ı iade edilecektir.',
                    '16 Ağustos 2021 tarihinden sonra yapılacak iptallerde havale masrafları kesildikten sonra kalan miktarın %50\'si iade edilecektir.',
                    'Bütün iadeler kongre sonrasında yapılacaktır.',
                    'TL',
                    'TL',
                ],
                
                'session_abstract_info'=>
                [
                    'Oturum Başkanı Bilgileri: ',
                    'Oturum Başkanı:',
                    'Oturum Günü: ',
                    'Oturum Salonu: ',
                    'Oturum Adı: ',
                    'Oturum Saati: ',
                    'Oturum Başkanı davet Mektubu',
                    'Oturumu Başlat',
                ],

                'main_author_abstracts'=>
                [
                    'Sunum Bilgileri: ',
                    'Oturum Günü: ',
                    'Oturum Salonu: ',
                    'Oturum Saati: ',
                    'Bildiri Numarası: ',
                    'Bildiri Başlığı: ',
                    'Bildiri Yazarları: ',
                    'Sunum Yükle',
                    'Kabul Mektubu',
                    'Oturumu Başlat',
                ],
                'scientific_program_viewer'=>
                [
                    'Oturum Başkanı:',
                ],

                'virtual_congress_sponsor_documents'=>
                [
                    'Firma Broşürleri:',
                    'Yüklemek istediğiniz belgeleri seçiniz (pdf, jpeg, jpg, png)',
                    'Kaydet',
                    'Yüklediğiniz Belgeler',
                    'belge sil',
                ],

                'virtual_congress_sponsor_videos'=>
                [
                    'Firma Videoları:',
                    'Yüklemek istediğiniz belgeleri seçiniz (50MB/mp4,webm)',
                    'Kaydet',
                    'Yüklediğiniz Belgeler',
                    'belge sil',
                ],
                
            ]
        ];

        return $language ;
    }

}
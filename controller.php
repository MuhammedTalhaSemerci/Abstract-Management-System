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
                        ["????renci","Asistan","Dr.","Dr. ????r. G??r.","Do??. Dr.","Prof. Dr.","M??hendis","Hekim","Vet. Hekim"],
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
                        ["????renci","Asistan","Dr.","Dr. ????r. G??r.","Do??. Dr.","Prof. Dr.","M??hendis","Hekim","Vet. Hekim"],
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
                        ["S??zl?? Sunum","E-poster"],
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
                        ["S??zl?? Sunum","E-poster"],
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
                        ['E-poster','S??zl?? Sunum'],
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
                        ["Kat??l??mc?? Kayd??","Normal Kay??t","????renci Kayd??","Burslu Kay??t","Davetli Konu??mac??"],
                        ["Participant Registration","Normal Registration","Student Registration","Bursary Registration","Invited Speaker"],
                    ],
                    [
                        ["Erken Kay??t","Ge?? Kay??t"],
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
                        ["????renci Belgesi","Dekont"],
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
                
                //??cretlendirmeler
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
                    'Nutuva Organizasyon (Fikret AKD????)',
                    'Bank Name :',
                    'Kuveyt T??rk Participation Bank Ihsaniye Branch (223)',
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
                    '8. Uluslararas?? Kat??l??ml?? Bitki Koruma Kongresi',
                    'Nutuva Bildiri Y??netim Sistemi',
                    'Giri?? yap??ld??',
                    'Giri?? yap??lmad??',
                    '??ye Giri??',
                    'E-posta',
                    '??ifre',
                    'Giri?? Yap',
                    '??ifremi Unuttum',
                    'Kay??t Ol',
                    '??ifre de??i??tirme i??lemi ba??ar??l?? oldu. Yeni ??ifreniz ile giri?? yapabilirsiniz.',
                    'Kulland??????n??z ??ifre yenileme linki zaman a????m??na u??rad?????? i??in ??ifre yenilenemedi.',
                    'Kay??t i??leminiz ba??ar??l?? olmu??tur. L??tfen giri?? yap??n??z.',
                    'Mail adresi kay??tl?? g??z??k??yor. L??tfen giri?? yapmay?? deneyin. Giri?? yapmakta sorun ya????yorsan??z \'??ifremi unuttum\' ile yeni bir ??ifre belirleyebilirsiniz.',
                    'L??tfen tekrar giri?? yapmay?? deneyin. Giri?? yapmakta sorun ya????yorsan??z \'??ifremi unuttum\' ile yeni bir ??ifre belirleyebilirsiniz.'
                ],

                'register'=>
                [
                    '8. Uluslararas?? Kat??l??ml?? Bitki Koruma Kongresi',
                    'Nutuva Bildiri Y??netim Sistemi',
                    'Giri?? yap??ld??',
                    'Giri?? yap??lmad??',
                    'Kay??t Ol',
                    'Ad',
                    'Soyad',
                    'Cep Telefonu',
                    '??ehir',
                    'Se??im Yap??n',
                    'T??rkiye D??????',
                    '??nvan',
                    'Se??im Yap??n',
                    [
                        ["????renci","Asistan","Dr.","Dr. ????r. G??r.","Do??. Dr.","Prof. Dr.","M??hendis","Hekim","Vet. Hekim"]
                    ],
                    'Uzmanl??k',
                    'Kurum',
                    '??yelik T??r??',
                    'Se??im Yap??n',
                    'Kongre Kat??l??mc??s??',
                    'Bilim Kurulu ??yesi',
                    'Kongre Se??im Yap??n',
                    'Se??im Yap??n',
                    'Kategori Se??im Yap??n',
                    'Alt Kategori Se??im Yap??n',
                    'E-posta',
                    '??ifre',
                    ['KVKK Metnini','Okudum, kabul ediyorum.'],
                    'Kay??t Ol',
                    'Se??im Yap??n',
                ],

                'profile_update'=>
                [
                    '8. Uluslararas?? Kat??l??ml?? Bitki Koruma Kongresi',
                    'Profil D??zenleme Sayfas??',
                    'Ad',
                    'Soyad',
                    'Cep Telefonu',
                    '??ehir',
                    'Se??im Yap??n??z',
                    'T??rkiye D??????',
                    '??nvan',
                    'Se??im Yap??n??z',
                     [
                        ["????renci","Asistan","Dr.","Dr. ????r. G??r.","Do??. Dr.","Prof. Dr.","M??hendis","Hekim","Vet. Hekim"],
                     ],
                    'Uzmanlik',
                    'Kurum',
                    'Fatura ??st??nde G??r??necek ??sim veya Kurum Ad??',
                    'Fatura Vergi No/TC',
                    'Fatura Vergi Dairesi',
                    'Fatura ??zerine Yaz??lmas??n?? ??stedi??iniz Not yada Proje Ad??',
                    'Faturan??n G??nderilece??i Mail Adresi',
                    'Kongre ??antas??n??n G??nderilece??i Adres',
                    'Kaydet',
                    '????lem ba??ar??yla ger??ekle??tirildi.',
                    '????lem s??ras??nda bir hata olu??tu',
                ],

                //abstracter
                'abstracter_language'=>
                [
                    '8. Uluslararas?? Kat??l??ml?? Bitki Koruma Kongresi',
                    'G??venli ????k????',
                    'Profilim',
                    'Kay??t ????lemleri',
                    'Kongre ??n Kay??t',
                    'Belge G??nder',
                    'Kay??t Durum Sorgula',
                    'Bildiri ????lemleri',
                    'Bildiri Y??kle',
                    'Bildirilerim',
                    'Bilimsel Program',
                    'Oturum Bilgileri',
                    'Sunumlar??m',
                    'Kontrol Paneli',
                    'Ev',
                    'Kontrol Paneli',
                ],

                'abstract_upload'=>
                [
                    '8. Uluslararas?? Kat??l??ml?? Bitki Koruma Kongresi',
                    '??nceki',
                    'Sonraki',
                    'Ad??m',
                    'Bildiri y??klemek istedi??iniz kongreyi se??in',
                    'Se??im Yap??n',
                    'Bildiri y??klemek istedi??iniz ana kategoriyi se??in',
                    'Alt kategoriyi se??in.',
                    'Yazar bilgilerini eklemek i??in ka?? yazar bulundu??unu say?? cinsinde yaz??n??z.',
                    'Yazar say??s??n?? belirtin',//placeholder
                    'Bildiri T??r??',
                    [
                        ["S??zl?? Sunum","E-poster"]
                    ],
                    'Bildirinizin dilini se??iniz',
                    'T??rk??e/??ngilizce',
                    '??ngilizce',
                    'Alternatif mail adresi',
                    'Bildiri Ba??l?????? (T??rk??e)',
                    'Bildiri ??zeti (T??rk??e)',
                    'Kelime S??n??r??:',
                    'Anahtar Kelimeler (T??rk??e)',
                    'Anahtar kelime 1, Anahtar kelime 2, ...',//keyword placeholder
                    'Bildiri Ba??l?????? (??ngilizce)',
                    'Bildiri ??zeti (??ngilizce)',
                    'Kelime S??n??r??:',
                    'Anahtar Kelimeler (??ngilizce)',
                    'Anahtar kelime 1, Anahtar kelime 2, ...',//keyword placeholder
                    'Bildiri Ba??l?????? (??ngilizce)',
                    'Bildiri ??zeti (??ngilizce)',
                    'Kelime S??n??r??:',
                    'Anahtar Kelimeler (??ngilizce)',
                    'Anahtar kelime 1, Anahtar kelime 2, ...',//keyword placeholder
                    'Destek ve Katk??lar',
                    'Bu bildiri xx taraf??ndan desteklenmektedir',//placeholder
                    'Yorum ve A????klamalar',
                    'Kaydet',
                    'l??tfen bekleyin...',
                    'Bildiri ??zeti (T??rk??e)',
                    'Bildiri ??zeti (??ngilizce)',
                    'Bildiri ??zeti (??ngilizce)',
                    'Bildiri Ba??l?????? (T??rk??e)',
                    'Bildiri Ba??l?????? (??ngilizce)',
                    'Bildiri Ba??l?????? (??ngilizce)',
                    'S??n??r A????ld??!',
                    'Se??im Yap??n',
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
                    '8. Uluslararas?? Kat??l??ml?? Bitki Koruma Kongresi',
                    'Bildiri T??r??',
                    [
                        ["S??zl?? Sunum","E-poster"]
                    ],
                    'Bildirinizin dilini se??iniz.',
                    'T??rk??e/??ngilizce',
                    '??ngilizce',
                    'Alternatif mail adresi',
                    'Bildiri Ba??l?????? (T??rk??e)',
                    'Bildiri ??zeti (T??rk??e)',
                    'Anahtar Kelimeler (T??rk??e)',
                    'Anahtar kelime 1, Anahtar kelime 2, ...',//keyword placeholder
                    'Bildiri Ba??l?????? (??ngilizce)',
                    'Bildiri ??zeti (??ngilizce)',
                    'Anahtar Kelimeler (??ngilizce)',
                    'Anahtar kelime 1, Anahtar kelime 2, ...',//keyword placeholder
                    'Bildiri Ba??l?????? (??ngilizce)',
                    'Bildiri ??zeti (??ngilizce)',
                    'Anahtar Kelimeler (??ngilizce)',
                    'Anahtar kelime 1, Anahtar kelime 2, ...',//keyword placeholder
                    'Destek ve Katk??lar',
                    'Bu bildiri xx taraf??ndan desteklenmektedir',//placeholder
                    'Yorum ve A????klamalar',
                    'Kaydet',
                    'l??tfen bekleyin...',
                    'Bildiri ??zeti (T??rk??e)',
                    'Bildiri ??zeti (??ngilizce)',
                    'Bildiri ??zeti (??ngilizce)',
                    'Bildiri Ba??l?????? (T??rk??e)',
                    'Bildiri Ba??l?????? (??ngilizce)',
                    'Bildiri Ba??l?????? (??ngilizce)',
                ],

                'my_abstracts'=>
                [
                    '8. Uluslararas?? Kat??l??ml?? Bitki Koruma Kongresi',
                    'Bildirinin de??erlendirilmesi beklenmektedir.',
                    'Bildiriniz kabul edilmi??tir',
                    'Bildiriniz reddedilmi??tir',
                    'Bildinizi d??zenlemeniz beklenmektedir <font color="red">(D??zenlemelerinizi tamamlad??ktan sonra "Bildiri d??zenlemelerini sonland??r" butonu ile d??zenlemelerinizi bitirmelisiniz.)</font>',
                    'Bildiriniz ba??ar??yla d??zenlenmi?? olup yeniden de??erlendirilmesi beklenmektedir.',
                    'Hakem atamas?? ger??ekle??mi??tir.',
                    'Bildiri no',
                    'Sorumlu yazar',
                    'Bildiri Ba??l??????',
                    'Bildiri kategorisi',
                    'Bildiri durumu',
                    'Bilim Kurulu ??yesi De??erlendirmesi',
                    'Sunum Y??kle',
                    'Kabul Mektubu',
                    'Bildiri d??zenlemelerini sonland??r',
                    'Bildiri d??zenle',
                    'Kategori d??zenle',
                    'Yazar Ekle/D??zenle',
                    'G??r??nt??le',
                    'G??r??nt??le',
                    'Bildiri d??zenle',
                    'Kategori d??zenle',
                    'Yazar Ekle/D??zenle',
                    'G??r??nt??le',
                    'Bildiri Sil',
                    'G??r??nt??le',
                    '????lemi ger??ekle??tirmek istedi??inizden emin misiniz ?',
                    '????lem iptal edilmi??tir !',
                    '????lemi ger??ekle??tirmek istedi??inizden emin misiniz ?',
                    '????lem iptal edilmi??tir !',
                    'Bilim Kurulu ??yesi De??erlendirmesi',
                ],

                'abstract_category_update'=>
                [
                    '8. Uluslararas?? Kat??l??ml?? Bitki Koruma Kongresi',
                    'Bildiri y??klemek istedi??iniz kongreyi se??in',
                    'Se??im Yap??n',
                    'Bildiri y??klemek istedi??iniz ana kategoriyi se??in',
                    'Se??im Yap??n',
                    'Alt kategoriyi se??in.',
                    'Kaydet',
                    'l??tfen bekleyin...',
                    'Se??im Yap??n',

                ],
                'abstract_author_update'=>
                [
                    '8. Uluslararas?? Kat??l??ml?? Bitki Koruma Kongresi',
                    'Yazar bilgilerini eklemek i??in ka?? yazar bulundu??unu say?? cinsinde yaz??n??z.',
                    'Yazar say??s??n?? belirtin',//placeholder
                    'Yazar',
                    'Ad',
                    'Soyad',
                    'Kurum',
                    'E-posta',
                    'Sorumlu Yazar',
                    'Kaydet',
                    'l??tfen bekleyin...',
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
                        ['E-poster','S??zl?? Sunum']
                    ],
                    'Kabul edildi',
                ],
                'congress_register_status'=>
                [
                    '8. Uluslararas?? Kat??l??ml?? Bitki Koruma Kongresi',
                    '????renci belgenizi ve dekontunuzu y??klemeniz beklenmektedir.',
                    'Dekont y??klemeniz beklenmektedir.',
                    'Admin onay?? beklenmektedir.',
                    'Kongre kay??t i??leminiz ger??ekle??tirilmi??tir.',
                    'Kongre kay??t i??leminiz ger??ekle??tirilmi??tir.',
                    'Kongre kay??t i??leminiz reddedilmi??tir.',
                    [
                        ["Kat??l??mc?? Kayd??","Normal Kay??t","????renci Kayd??","Burslu Kay??t","Davetli Konu??mac??"],
                    ],
                    [
                        ["Erken Kay??t","Ge?? Kay??t"],
                    ],
                    'Kongre',
                    'Kay??t ??nvan??',
                    '??denen Tutar',
                    '??denecek Tutar',
                    'Kay??t T??r??',
                    'Onay durumu',
                    'Kongre kayd??n?? sil',
                    'Davet Mektubunu G??r??nt??le',
                    'Herhangi bir kongre\'ye kayd??n??z bulunmamaktad??r.',
                    '????lemi ger??ekle??tirmek istedi??inizden emin misiniz ?',
                    '????lem iptal edilmi??tir !',
                ],
                'congress_document_upload'=>
                [
                    'Y??klemek istedi??iniz belgeleri se??iniz (gif, jpeg, jpg, png, docx, pdf)',
                    '????renci Belgesi',
                    'Dekont',
                    'Kaydet',
                    'Y??kledi??iniz Belgeler',
                    [
                        ["????renci Belgesi","Dekont"],
                    ],
                    'belge sil',
                ],


                'abstract_viewer' =>
                [
                    '8. Uluslararas?? Kat??l??ml?? Bitki Koruma Kongresi',
                    'Pdf Olarak ??ndir',
                    'Word Olarak ??ndir',
                    'Sorumlu Yazar:',
                    'Anahtar Kelimeler:',
                    'Keywords:',
                    'Yorum:',
                ],
                'abstract_booker' =>
                [
                    '8. Uluslararas?? Kat??l??ml?? Bitki Koruma Kongresi',
                    'Sorumlu Yazar:',
                    'Anahtar Kelimeler:',
                    'Keywords:',
                    'Comments:',
                ],


                 'abstract_presentations'=>
                [
                    'Y??klemek istedi??iniz belgeleri se??iniz (Sadece pdf dosyalar?? / maksimum 10 mb)',
                    'Kaydet',
                    'Y??kledi??iniz Belgeler',
                    'belge sil',
                ],

                //??cretlendirmeler
                'congress_register'=>
                [
                    'Online Kay??t',
                    'Kay??t ??cretleri',
                    'Erken Kay??t',
                    '01 Haziran 2021 ve ??ncesi',
                    'Ge?? Kay??t',
                    '01 Haziran 2021 Sonras??',
                    //Student
                    '????renci Kayd??',
                    '150 TL',
                    '150',
                    '',
                    '200 TL',
                    '200',
                    '',
                    //Normal
                    'Normal Kay??t',
                    '250 TL',
                    '250',
                    '',
                    '300 TL',
                    '300',
                    '',
                    //Participant
                    'Kat??l??mc?? Kayd??',
                    '200 TL',
                    '200',
                    '',
                    '250 TL',
                    '250',
                    '',
                    '??DENECEK TUTAR',
                    'Kay??t Tutar?? (TL)',
                    '0 TL',
                    'Toplam Tutar (TL)',
                    '0 TL',
                    'Not : Kayd??n??z ??n kay??t olup kesin kay??t i??in ??deme i??leminizi tamamlaman??z gerekmektedir. Dekont
                    ve ????renci oldu??unuzu ispatlayan belgeyi belge y??kleme sayfas??ndan sisteme y??kledikten ve ??demeniz sistem y??neticisi 
                    taraf??ndan onayland??ktan sonra kongre kayd??n??z en ge?? 24 saat i??inde onaylanacakt??r. Kay??t durum men??s??nden kayd??n??z?? kontrol 
                    edebilirsiniz. Bir hata oldu??unu d??????n??yorsan??z bilgi@nutuva.com ??zerinden sistem y??neticisi ile ileti??ime ge??iniz.',
                    '??n Kay??t',
                    'BANKA HESAP B??LG??LER??',
                    'Hesap Ad?? :',
                    'Nutuva Organizasyon (Fikret AKD????)',
                    'Banka Ad?? :',
                    'Kuveyt T??rk Kat??l??m Bankas?? ??hsaniye ??b. (223)',
                    'TL Hesap Numaras?? :',
                    '173 42 78',
                    'IBAN :',
                    'TR51 0020 5000 0017 3427 8000 03',
                    //usd account adds
                    '',
                    '',
                    '',
                    '',
                    'Kay??t ??cretine KDV dahildir.',
                    'T??m kat??l??mc??lar??n kongreye kay??t yapt??rmas?? zorunludur.',
                    'Kat??l??m ??cretine, kat??l??m sertifikas??, kongre materyalleri ve genel bilimsel aktivitelere kat??l??m d??hildir.',
                    '??PTAL KO??ULLARI',
                    'T??m iptal talepleri Nutuva Organizasyon\'a yaz??l?? olarak bildirilmelidir.',
                    '15 A??ustos 2021 tarihinden ??nce yap??lan iptal talebinde, havale masraflar?? kesildikten sonra kalan miktar??n %90\'?? iade edilecektir.',
                    '16 A??ustos 2021 tarihinden sonra yap??lacak iptallerde havale masraflar?? kesildikten sonra kalan miktar??n %50\'si iade edilecektir.',
                    'B??t??n iadeler kongre sonras??nda yap??lacakt??r.',
                    'TL',
                    'TL',
                ],
                
                'session_abstract_info'=>
                [
                    'Oturum Ba??kan?? Bilgileri: ',
                    'Oturum Ba??kan??:',
                    'Oturum G??n??: ',
                    'Oturum Salonu: ',
                    'Oturum Ad??: ',
                    'Oturum Saati: ',
                    'Oturum Ba??kan?? davet Mektubu',
                    'Oturumu Ba??lat',
                ],

                'main_author_abstracts'=>
                [
                    'Sunum Bilgileri: ',
                    'Oturum G??n??: ',
                    'Oturum Salonu: ',
                    'Oturum Saati: ',
                    'Bildiri Numaras??: ',
                    'Bildiri Ba??l??????: ',
                    'Bildiri Yazarlar??: ',
                    'Sunum Y??kle',
                    'Kabul Mektubu',
                    'Oturumu Ba??lat',
                ],
                'scientific_program_viewer'=>
                [
                    'Oturum Ba??kan??:',
                ],

                'virtual_congress_sponsor_documents'=>
                [
                    'Firma Bro????rleri:',
                    'Y??klemek istedi??iniz belgeleri se??iniz (pdf, jpeg, jpg, png)',
                    'Kaydet',
                    'Y??kledi??iniz Belgeler',
                    'belge sil',
                ],

                'virtual_congress_sponsor_videos'=>
                [
                    'Firma Videolar??:',
                    'Y??klemek istedi??iniz belgeleri se??iniz (50MB/mp4,webm)',
                    'Kaydet',
                    'Y??kledi??iniz Belgeler',
                    'belge sil',
                ],
                
            ]
        ];

        return $language ;
    }

}
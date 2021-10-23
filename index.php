<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

require __DIR__ . '/database.php';
require __DIR__ . '/model.php';
require __DIR__ . '/controller.php';
require __DIR__ . '/route.php';


Route::run('/', 'login@index');
Route::run('/index', 'login@index');

Route::run('/login', 'login@index');
Route::run('/login', 'login@system_login','post');

Route::run('/kayit', 'register@index');
Route::run('/kaydet', 'register@save','post');

Route::run('/sifreyenile', 'pass_reset_c@index');
Route::run('/reset_request', 'pass_reset_c@pass_reset',"post");
Route::run('/yenisifreolustur', 'pass_reset_c@new_pass');
Route::run('/yenisifrekayit', 'pass_reset_c@new_pass_save',"post");

Route::run('/profile_update', 'abstracter@profileupdate',"post");

Route::run('/language_changer', 'language@language_changer');
Route::run('/language_changer', 'language@language_changer',"post");



//abstracter
Route::run('/abstract_index', 'abstracter@index');
Route::run('/abstract_viewer', 'abstracter@abstract_viewer');

Route::run('/abstract_save', 'abstracter@save');
Route::run('/abstract_save', 'abstracter@save',"post");

Route::run('/abstract_update', 'abstracter@update');
Route::run('/abstract_update', 'abstracter@update',"post");

Route::run('/abstract_author_update', 'abstracter@authorupdate');
Route::run('/abstract_author_update', 'abstracter@authorupdate',"post");

Route::run('/abstract_category_update', 'abstracter@categoryupdate');
Route::run('/abstract_category_update', 'abstracter@categoryupdate',"post");

Route::run('/abstract_arrangement_save', 'abstracter@abstract_arrangement_save');
Route::run('/abstract_arrangement_save', 'abstracter@abstract_arrangement_save',"post");

Route::run('/abstract_edit_request_viewer', 'abstracter@abstract_edit_request_viewer');
Route::run('/abstract_edit_request_viewer', 'abstracter@abstract_edit_request_viewer',"post");

Route::run('/accepted_abstract_document', 'abstracter@accepted_abstract_document');
Route::run('/accepted_abstract_document', 'abstracter@accepted_abstract_document',"post");

Route::run('/presentation_upload', 'abstracter@presentation_upload');
Route::run('/presentation_upload', 'abstracter@presentation_upload',"post");

Route::run('/presentation_delete', 'abstracter@presentation_delete');
Route::run('/presentation_delete', 'abstracter@presentation_delete',"post");

Route::run('/session_manager_document', 'abstracter@session_manager_document');
Route::run('/session_manager_document', 'abstracter@session_manager_document',"post");

Route::run('/sponsor_virtual_congress_button_info_save', 'abstracter@sponsor_virtual_congress_button_info_save');
Route::run('/sponsor_virtual_congress_button_info_save', 'abstracter@sponsor_virtual_congress_button_info_save',"post");

Route::run('/sponsor_document_upload', 'abstracter@sponsor_document_upload');
Route::run('/sponsor_document_upload', 'abstracter@sponsor_document_upload',"post");

Route::run('/sponsor_document_delete', 'abstracter@sponsor_document_delete');
Route::run('/sponsor_document_delete', 'abstracter@sponsor_document_delete',"post");


Route::run('/sponsor_video_upload', 'abstracter@sponsor_video_upload');
Route::run('/sponsor_video_upload', 'abstracter@sponsor_video_upload',"post");

Route::run('/sponsor_video_delete', 'abstracter@sponsor_video_delete');
Route::run('/sponsor_video_delete', 'abstracter@sponsor_video_delete',"post");

Route::run('/abstract_delete', 'abstracter@delete');



Route::run('/congress_register', 'congressregister@index');
Route::run('/congress_register_status', 'congressregister@registerstatus');
Route::run('/kongre_on_kayit', 'congressregister@preregister',"post");
Route::run('/congress_document_upload', 'congressregister@imageupload',"post");
Route::run('/congress_document_delete', 'congressregister@imagedelete',"post");
Route::run('/delete_congress_registration', 'congressregister@delete_congress_registration');
Route::run('/congress_register_document', 'congressregister@congress_register_document');





//admin process
Route::run('/admin_index', 'admin@index');

Route::run('/admin_search', 'admin@search');
Route::run('/admin_search', 'admin@search',"post");

Route::run('/admin_authority_change', 'admin@admin_authority_change');
Route::run('/admin_authority_change', 'admin@admin_authority_change',"post");

Route::run('/admin_user_update', 'admin@admin_user_update');
Route::run('/admin_user_update', 'admin@admin_user_update',"post");

Route::run('/admin_withdrawal_update', 'admin@admin_withdrawal_update');
Route::run('/admin_withdrawal_update', 'admin@admin_withdrawal_update',"post");

Route::run('/admin_paid_val_update', 'admin@admin_paid_val_update');
Route::run('/admin_paid_val_update', 'admin@admin_paid_val_update',"post");

Route::run('/admin_sponsor_authorization_update', 'admin@admin_sponsor_authorization_update');
Route::run('/admin_sponsor_authorization_update', 'admin@admin_sponsor_authorization_update',"post");

Route::run('/admin_stand_authorization_update', 'admin@admin_stand_authorization_update');
Route::run('/admin_stand_authorization_update', 'admin@admin_stand_authorization_update',"post");

Route::run('/admin_auto_mailer', 'admin@admin_auto_mailer');
Route::run('/admin_auto_mailer', 'admin@admin_auto_mailer',"post");

Route::run('/admin_manuel_mailer', 'admin@admin_manuel_mailer');
Route::run('/admin_manuel_mailer', 'admin@admin_manuel_mailer',"post");

Route::run('/admin_abstract_authorization', 'admin@admin_abstract_authorization');
Route::run('/admin_abstract_authorization', 'admin@admin_abstract_authorization',"post");

Route::run('/abstract_main_author_id_save', 'admin@abstract_main_author_id_save');
Route::run('/abstract_main_author_id_save', 'admin@abstract_main_author_id_save',"post");

Route::run('/admin_abstract_accept', 'admin@admin_abstract_accept');
Route::run('/admin_abstract_accept', 'admin@admin_abstract_accept',"post");

Route::run('/admin_abstract_delete', 'admin@admin_abstract_delete');
Route::run('/admin_abstract_delete', 'admin@admin_abstract_delete',"post");

Route::run('/admin_new_user_save', 'admin@admin_new_user_save');
Route::run('/admin_new_user_save', 'admin@admin_new_user_save',"post");


Route::run('/admin_abstract_main_author_mail_compare', 'admin@admin_abstract_main_author_mail_compare');
Route::run('/admin_abstract_main_author_mail_compare', 'admin@admin_abstract_main_author_mail_compare',"post");

Route::run('/admin_presentation_archiver', 'admin@admin_presentation_archiver');
Route::run('/admin_presentation_archiver', 'admin@admin_presentation_archiver',"post");

Route::run('/admin_scientific_program_save', 'admin@admin_scientific_program_save');
Route::run('/admin_scientific_program_save', 'admin@admin_scientific_program_save',"post");

Route::run('/abstract_booker', 'admin@abstract_booker');
Route::run('/abstract_booker', 'admin@abstract_booker',"post");

Route::run('/registration_replace', 'admin@registration_replace');
Route::run('/registration_replace', 'admin@registration_replace',"post");

Route::run('/congress_payment_date_control', 'admin@congress_payment_date_control');
Route::run('/congress_payment_date_control', 'admin@congress_payment_date_control',"post");

Route::run('/virtual_congress_button_info_save', 'admin@virtual_congress_button_info_save');
Route::run('/virtual_congress_button_info_save', 'admin@virtual_congress_button_info_save',"post");

Route::run('/admin_accept_users_bill_info', 'admin@admin_accept_users_bill_info');
Route::run('/admin_accept_users_bill_info', 'admin@admin_accept_users_bill_info',"post");

Route::run('/admin_accept_users_cargo_info', 'admin@admin_accept_users_cargo_info');
Route::run('/admin_accept_users_cargo_info', 'admin@admin_accept_users_cargo_info',"post");




//editor process
Route::run('/editor_index', 'editor@index');

Route::run('/editor_search', 'editor@search');
Route::run('/editor_search', 'editor@search',"post");

Route::run('/editor_authority_change', 'editor@editor_authority_change');
Route::run('/editor_authority_change', 'editor@editor_authority_change',"post");

Route::run('/editor_user_update', 'editor@editor_user_update');
Route::run('/editor_user_update', 'editor@editor_user_update',"post");

Route::run('/editor_withdrawal_update', 'editor@editor_withdrawal_update');
Route::run('/editor_withdrawal_update', 'editor@editor_withdrawal_update',"post");

Route::run('/editor_auto_mailer', 'editor@editor_auto_mailer');
Route::run('/editor_auto_mailer', 'editor@editor_auto_mailer',"post");

Route::run('/editor_manuel_mailer', 'editor@editor_manuel_mailer');
Route::run('/editor_manuel_mailer', 'editor@editor_manuel_mailer',"post");

Route::run('/editor_abstract_authorization', 'editor@editor_abstract_authorization');
Route::run('/editor_abstract_authorization', 'editor@editor_abstract_authorization',"post");

Route::run('/editor_abstract_accept', 'editor@editor_abstract_accept');
Route::run('/editor_abstract_accept', 'editor@editor_abstract_accept',"post");

Route::run('/editor_abstract_delete', 'editor@editor_abstract_delete');
Route::run('/editor_abstract_delete', 'editor@editor_abstract_delete',"post");


Route::run('/editor_presentation_archiver', 'editor@editor_presentation_archiver');
Route::run('/editor_presentation_archiver', 'editor@editor_presentation_archiver',"post");
//referee process

Route::run('/referee_index', 'referee@index');

Route::run('/referee_search', 'referee@search');
Route::run('/referee_search', 'referee@search',"post");

Route::run('/referee_auto_mailer', 'referee@referee_auto_mailer');
Route::run('/referee_auto_mailer', 'referee@referee_auto_mailer',"post");

Route::run('/referee_manuel_mailer', 'referee@referee_manuel_mailer');
Route::run('/referee_manuel_mailer', 'referee@referee_manuel_mailer',"post");

Route::run('/referee_abstract_accept', 'referee@referee_abstract_accept');
Route::run('/referee_abstract_accept', 'referee@referee_abstract_accept',"post");

Route::run('/abstract_edit_requester', 'referee@abstract_edit_requester');
Route::run('/abstract_edit_requester', 'referee@abstract_edit_requester',"post");

Route::run('/referee_abstract_edit_request_save', 'referee@referee_abstract_edit_request_save');
Route::run('/referee_abstract_edit_request_save', 'referee@referee_abstract_edit_request_save',"post");



//external area

Route::run('/referee_notexist_count', 'referee@referee_notexist_count');


Route::run('/main_language_changer', 'language@main_language_changer');
Route::run('/main_language_changer', 'language@main_language_changer',"post");

Route::run('/cikis', 'cikis@index');



//Virtual Congress

Route::run('/virtual_congress_index', 'virtual_congress@virtual_congress_index');
Route::run('/virtual_congress_index', 'virtual_congress@virtual_congress_index',"post");

Route::run('/get_saloon_info', 'virtual_congress@get_saloon_info');
Route::run('/get_saloon_info', 'virtual_congress@get_saloon_info',"post");



Route::run('/bbb_create_without_preupload', 'virtual_congress@bbb_create_without_preupload');
Route::run('/bbb_create_without_preupload', 'virtual_congress@bbb_create_without_preupload',"post");

Route::run('/bbb_join_as_moderator', 'virtual_congress@bbb_join_as_moderator');
Route::run('/bbb_join_as_moderator', 'virtual_congress@bbb_join_as_moderator',"post");

Route::run('/bbb_join_as_attendee', 'virtual_congress@bbb_join_as_attendee');
Route::run('/bbb_join_as_attendee', 'virtual_congress@bbb_join_as_attendee',"post");

Route::run('/bbb_get_meeting_infos', 'virtual_congress@bbb_get_meeting_infos');
Route::run('/bbb_get_meeting_infos', 'virtual_congress@bbb_get_meeting_infos',"post");

Route::run('/bbb_get_recordings_infos', 'virtual_congress@bbb_get_recordings_infos');
Route::run('/bbb_get_recordings_infos', 'virtual_congress@bbb_get_recordings_infos',"post");

Route::run('/virtual_congress_main_saloon', 'virtual_congress@main_saloon');
Route::run('/virtual_congress_main_saloon', 'virtual_congress@main_saloon',"post");

Route::run('/virtual_congress_stand_area', 'virtual_congress@stand_area');
Route::run('/virtual_congress_stand_area', 'virtual_congress@stand_area',"post");

Route::run('/virtual_congress_inner_stand', 'virtual_congress@inner_stand');
Route::run('/virtual_congress_inner_stand', 'virtual_congress@inner_stand',"post");

Route::run('/virtual_congress_poster_area', 'virtual_congress@poster_area');
Route::run('/virtual_congress_poster_area', 'virtual_congress@poster_area',"post");

Route::run('/virtual_congress_private_chat', 'virtual_congress@private_chat');
Route::run('/virtual_congress_private_chat', 'virtual_congress@private_chat',"post");

Route::run('/congress_certificate', 'virtual_congress@congress_certificate');
Route::run('/congress_certificate', 'virtual_congress@congress_certificate',"post");



Route::run('/virtual_congress_redirect', 'virtual_congress@virtual_congress_redirect');
Route::run('/virtual_congress_redirect', 'virtual_congress@virtual_congress_redirect',"post");






//API

Route::run('/api_scientific_program_iframe', 'api@scientific_program_iframe');
Route::run('/api_scientific_program_iframe', 'api@scientific_program_iframe',"post");


////////   1. değer gidilecek dosya ve dizini, 2. değer controller , class ve  fonksiyon için./////////
<?php

class kaydet extends Controller
{

    public function index()
    {

        $usersModel = $this->model('users');
        $users = $usersModel->getAll();

        $this->view('kaydet');
    }


    public function kaydet(){

        $uye_adi = $_POST["kadi"];
        $uye_tel = $_POST["tel"];
        $uye_sehir = $_POST["sehir"];
        $uye_unvan = $_POST["unvan"];
        $uye_uzmanlik = $_POST["uzmanlik"];
        $uye_mail = $_POST["mail"];
        $uye_sifre = $_POST["sifre"];

        $usermodel = $this->model('users');
        $users = $usermodel->insertuser("uye",$uye_adi,$uye_tel,$uye_sehir,$uye_unvan,$uye_uzmanlik,$uye_mail,$uye_sifre);
        header("location:/");
        exit();
        
    }
}
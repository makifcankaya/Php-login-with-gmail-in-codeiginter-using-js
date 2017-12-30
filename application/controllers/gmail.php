<?php

  class Gmail extends CI_Controller
  {


    function index(){
        $this->load->view('gmail');
    }

    function gmail_login(){

      if (@_POST['login_gmail'])  echo "connect";

    }


  }

?>

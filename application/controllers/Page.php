<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
    public function about(){
        $this->load->view('front/about'); 

    }
    public function services(){
        $this->load->view('front/services'); 

    }
    public function contacts(){
        $this->load->library('email');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');

        if($this->form_validation->run() == true){
       

     // here  we will  contact form status
     
     
     $config = Array(
        'protocol' => 'smtp',
        //'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_host' => 'ssl://smtp.gmail.com',
        'smtp_port' => 465,
        'smtp_user' => 'ma.chand.saini@gmail.com',
        'smtp_pass' => 'Mahesh@97', 
        'mailtype'  => 'html',
        'charset'   => 'iso-8859-1'
    );
       
        $this->email->initialize($config);
         $this->email->set_newline("\r\n");


         $this->email->from('ma.chand.saini@gmail.com');
         $this->email->to('sainimaheshsaini97@gmail.com');
         $this->email->subject('Email Test');


         $name = $this->input->post('name');
         $email = $this->input->post('email');
         $msg = $this->input->post('message');

         $message ="Name :".$name;
         $message .="<br>";
         $message .="Email :".$email;
         $message .="<br>";
         $message .="Message :".$msg;
         $message .="<br>";
         $message .="<br>";
         $message .="Thanks";

         $this->email->message($message);
         if ($this->email->send()) {
            echo 'Your email was sent, thanks chamil.';
        } else {
            show_error($this->email->print_debugger());
        }
        
          
         $this->session->set_flashdata('msg','Thanks for your enquire ');
         redirect(base_url('page/contacts'));
         
        }

        else{
            $this->load->view('front/contact_us');
        }

       
    }
}

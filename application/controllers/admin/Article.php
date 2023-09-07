<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {
 // show article listing page
    public function index($page=1){
      
      $config['per_page'] = 5;
      $param['offset']=$config['per_page'];
      $param['limit']=($page*$config['per_page'])-$config['per_page'];
      $param['q'] = $this->input->get('q');

      $this->load->model('Article_model');
      $this->load->library('pagination');

      //pagination_link in this page 

         $config['base_url'] = base_url('admin/article/index');
         $config['total_rows'] = $this->Article_model->getArticlescount($param);
         
         $config['use_page_numbers'] = true;

         $config['first_link'] = 'First';
         $config['last_link'] = 'Last';
         $config['next_link'] = 'Next';
         $config['prev_link'] = 'Prev';
         $config['full_tag_open'] = "<ul class='pagination'>";
         $config['full_tag_close'] ="</ul>";
         $config['num_tag_open'] = '<li class="page-item">';
         $config['num_tag_close'] = '</li>';
         $config['cur_tag_open'] = "<li class='disabled page-item'><li class='active page-item'><a href='#' class=\"page-link\">";
         $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
         $config['next_tag_open'] = "<li class=\"page-item\">";
         $config['next_tagl_close'] = "</li>";
         $config['prev_tag_open'] = "<li  class=\"page-item\">";
         $config['prev_tagl_close'] = "</li>";
         $config['first_tag_open'] = "<li  class=\"page-item\">";
         $config['first_tagl_close'] = "</li>";
         $config['last_tag_open'] = "<li  class=\"page-item\">";
         $config['last_tagl_close'] = "</li>";
         $config['attributes'] = array('class' => 'page-link');

     $this->pagination->initialize($config);
     $pagination_link= $this->pagination->create_links();
   
  

      $articles=$this->Article_model->getArticles($param);
      $data['q'] =$this->input->get('q');
      $data['articles']  = $articles;
      $data['pagination_link']  =  $pagination_link;

      $data['mainModule'] ='article';
      $data['subModule'] ='viewArticle';
      $this->load->view('admin/article/list',$data);

    }
   // create article page  
        
    public function create(){
        $this->load->model('Category_model');
        $this->load->model('Article_model');
        $this->load->helper('comman_helper');

        $data['mainModule'] ='article';
        $data['subModule'] ='createArticle';

        $categories = $this->Category_model->getCategories();
        $data['categories'] = $categories;
      // file setting 
      
       $config['upload_path']          = './public/uploads/articles/';
       $config['allowed_types']        = 'gif|jpg|png';
       $config['encrypt_name']        = true;
       $this->load->library('upload', $config);

     
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
        $this->form_validation->set_rules('category_id', 'Category', 'trim|required');
        $this->form_validation->set_rules('title', 'Title', 'trim|required','min_length[20]');
        $this->form_validation->set_rules('author', 'Author', 'trim|required');
    
        if ($this->form_validation->run() == true){

         if(!empty($_FILES['image']['name'])){
          // here will save image 
          if($this->upload->do_upload('image')){
            // image upload sucessfully 
                    $data = $this->upload->data();
                    resizeImage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb_front/'.$data['file_name'],1120,800);
                    resizeImage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb_admin/'.$data['file_name'],300,250);

                    $formArray['image'] = $data['file_name'];
                    $formArray['title'] = $this->input->post('title');
                    $formArray['Category'] = $this->input->post('category_id');
                    $formArray['description'] = $this->input->post('description');
                    $formArray['author'] = $this->input->post('author');
                    $formArray['status'] = $this->input->post('status');
                    $formArray['create_at'] = date('Y-m-d H:i:s'); 
                    $this->Article_model->addArticle($formArray);
                    $this->session->set_flashdata('success','Category added successfully.');
                    redirect(base_url().'admin/article/index');
           
          }
          else{
            // image error
            $errors = $this->upload->display_errors("<p class='invalid-feedback'>",'</p>');
            $data['imageError'] = $errors;
            $this->load->view('admin/article/create',$data);
          }

         }
         else{
              // uplaod the entry in data base 
            $formArray['title'] = $this->input->post('title');
            $formArray['Category'] = $this->input->post('category_id');
            $formArray['description'] = $this->input->post('description');
            $formArray['author'] = $this->input->post('author');
            $formArray['status'] = $this->input->post('status');
            $formArray['create_at'] = date('Y-m-d H:i:s'); 
            $this->Article_model->addArticle($formArray);
            $this->session->set_flashdata('success','Category added successfully.');
            redirect(base_url().'admin/article/index');
         }
             
        }
        else{
            // form is not validiate 
            $this->load->view('admin/article/create',$data);
        }

    }
  // edit article page
    public function edit($ID){

     $this->load->library('form_validation');
     $this->load->model('Article_model');
     $this->load->model('Category_model');
     $this->load->helper('comman_helper');

     $data['mainModule'] ='article';
     $data['subModule'] ='';

     $article=$this->Article_model->getArticle($ID);
     if(empty($article)){
      $this->session->set_flashdata('error','Article is not found');
      redirect(base_url('admin/article/index'));
     }

     $categories = $this->Category_model->getCategories();
     $data['categories'] = $categories;
     $data['article'] = $article;

     $config['upload_path']          = './public/uploads/articles/';
     $config['allowed_types']        = 'gif|jpg|png';
     $config['encrypt_name']        = true;
     $this->load->library('upload', $config);

   
      $this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
      $this->form_validation->set_rules('category_id', 'Category', 'trim|required');
      $this->form_validation->set_rules('title', 'Title', 'trim|required','min_length[20]');
      $this->form_validation->set_rules('author', 'Author', 'trim|required');
  
      if ($this->form_validation->run() == true){

       if(!empty($_FILES['image']['name'])){
        // here will save image 
        if($this->upload->do_upload('image')){
          // image upload sucessfully 
                  $data = $this->upload->data();
                    
                  $path='./public/uploads/articles/thumb_admin/'.$article['image'];
                  if($article['image']!= "" && file_exists($path)){
                    // remove the old  thumb_admin image 
                    unlink($path);
                  }
                  $path='./public/uploads/articles/thumb_front/'.$article['image'];
                  if($article['image']!= "" && file_exists($path)){
                    // remove the old thump_front image 
                    unlink($path);
                  }
                  $path='./public/uploads/articles/'.$article['image'];
                  if($article['image']!= "" && file_exists($path)){
                    // remove the old image in articles
                    unlink($path);
                  }
                  
              
                  resizeImage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb_front/'.$data['file_name'],1120,800);
                  resizeImage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb_admin/'.$data['file_name'],300,250);

                  $formArray['image'] = $data['file_name'];
                  $formArray['title'] = $this->input->post('title');
                  $formArray['Category'] = $this->input->post('category_id');
                  $formArray['description'] = $this->input->post('description');
                  $formArray['author'] = $this->input->post('author');
                  $formArray['status'] = $this->input->post('status');
                  $formArray['updated_at'] = date('Y-m-d H:i:s'); 
                  $this->Article_model->updateArticle($ID,$formArray);
                  $this->session->set_flashdata('success','Category updated successfully.');
                  redirect(base_url().'admin/article/index');
         
        }
        else{
          // image error
          $errors = $this->upload->display_errors("<p class='invalid-feedback'>",'</p>');
          $data['imageError'] = $errors;
          $this->load->view('admin/article/edit',$data);
     
        }

       }
       else{
            // uplaod the entry in data base 
          $formArray['title'] = $this->input->post('title');
          $formArray['Category'] = $this->input->post('category_id');
          $formArray['description'] = $this->input->post('description');
          $formArray['author'] = $this->input->post('author');
          $formArray['status'] = $this->input->post('status');
          $formArray['updated_at'] = date('Y-m-d H:i:s'); 
          $this->Article_model->updateArticle($ID,$formArray);
          $this->session->set_flashdata('success','Category updated successfully.');
          redirect(base_url().'admin/article/index');
       }
           
      }
      else{
          // form is not validiate 
          $this->load->view('admin/article/edit',$data);
     
      }


     
    // print_r($article);

    }
// delete article page 
    public function delete($ID){

      $this->load->model('Article_model');

      $article=$this->Article_model->getArticle($ID);
      if(empty($article)){
       $this->session->set_flashdata('error','Article is not found');
       redirect(base_url('admin/article/index'));

       $path='./public/uploads/articles/thumb_admin/'.$article['image'];
       if($article['image']!= "" && file_exists($path)){
         // remove the old  thumb_admin image 
         unlink($path);
       }
       $path='./public/uploads/articles/thumb_front/'.$article['image'];
       if($article['image']!= "" && file_exists($path)){
         // remove the old thump_front image 
         unlink($path);
       }
       $path='./public/uploads/articles/'.$article['image'];
       if($article['image']!= "" && file_exists($path)){
         // remove the old image in articles
         unlink($path);
       }
      }
     $this->Article_model->deleteArticle($ID);
     $this->session->set_flashdata('delete','Article delete successfully.');
     redirect(base_url().'admin/article/index');
 
    }


    
}
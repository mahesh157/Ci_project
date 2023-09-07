<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

  // category list page 
	public function index()
	{
     $this->load->model('Category_model');
     $queryString=$this->input->get('q');
     $params['queryString']=$queryString;

     $categories=$this->Category_model->getCategories($params);
     $data['categories']=$categories;
     $data['queryString']=$queryString;

     $data['mainModule'] ='category';
     $data['subModule'] ='viewCategory';

     $this->load->view('admin/category/list',$data);
	}	
    // create a  category
    public function create() {
		$this->load->helper('comman_helper');
        $data['mainModule'] ='category';
        $data['subModule'] ='createCategory';
         
        $config['upload_path']         = './public/uploads/category/';
        $config['allowed_types']       = 'gif|jpg|png';
        $config['encrypt_name']        = true;
		
        $this->load->library('upload', $config);
		
        $this->load->model('Category_model');
        $this->load->library('form_validation');
		
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
        $this->form_validation->set_rules('name','Name','trim|required');
		      
        if ($this->form_validation->run() == TRUE) {
			
            if (!empty($_FILES['image']['name'])) {
                // Now user has selected a file so we will proceeed
	
                if ($this->upload->do_upload('image')) {
                    // File uploaded successfully
					
                    $data = $this->upload->data();
                    //resize image 
                    resizeImage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb/'.$data['file_name'],300,270);

                    // We will create category without image
                    $formArray['image'] = $data['file_name'];
                    $formArray['name'] = $this->input->post('name');
                    $formArray['status'] = $this->input->post('status');            
                    $formArray['created_at'] = date('Y-m-d H:i:s');
                    $this->Category_model->create($formArray);
                    $this->session->set_flashdata('success','Category added successfully.');
                    redirect(base_url().'admin/category/index');


                } else {
                    // We got some errros
                    $error = $this->upload->display_errors("<p class='invalid-feedback'>",'</p>');
                    $data['errorImageUpload'] = $error;
                    $this->load->view('admin/category/create',$data);
                }


            } else {
                // We will create category without image
                $formArray['name'] = $this->input->post('name');
                $formArray['status'] = $this->input->post('status');            
                $formArray['created_at'] = date('Y-m-d H:i:s');
                $this->Category_model->create($formArray);
                $this->session->set_flashdata('success','Category added successfully.');
                redirect(base_url().'admin/category/index');
            
            }

        } else {
            // Will show errors
            $this->load->view('admin/category/create',$data);
        }

        
    }

    // edit the category
    public function edit($categories_ID)
	{
      $this->load->model('Category_model');

      $data['mainModule'] ='category';
      $data['subModule'] ='';

      $category=$this->Category_model->getCategory($categories_ID);
        if(empty($category)){
        $this->session->set_flashdata('error','Category not found');
        redirect(base_url().'admin/category/index');
        }
        $this->load->helper('comman_helper');
        $config['upload_path']         = './public/uploads/category/';
        $config['allowed_types']       = 'gif|jpg|png';
        $config['encrypt_name']        = true;
		
        $this->load->library('upload', $config);
		
    
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
        $this->form_validation->set_rules('name','Name','trim|required');
		      
        if ($this->form_validation->run() == TRUE) {

            if (!empty($_FILES['image']['name'])) {
                // Now user has selected a file so we will proceeed
	
                if ($this->upload->do_upload('image')) {
                    // File uploaded successfully
					
                    $data = $this->upload->data();
                    //resize image 
                    resizeImage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb/'.$data['file_name'],300,270);

                    // We will create category without image
                    $formArray['image'] = $data['file_name'];
                    $formArray['name'] = $this->input->post('name');
                    $formArray['status'] = $this->input->post('status');            
                    $formArray['updated_at'] = date('Y-m-d H:i:s');

                    $this->Category_model->update($categories_ID,$formArray);
               
                    if(file_exists('./public/uploads/category/'.$category['image'])){
                        unlink('./public/uploads/category/'.$category['image']);
                    }
                    if(file_exists('./public/uploads/category/thumb/'.$category['image'])){
                        unlink('./public/uploads/category/thumb/'.$category['image']);
                    }


                    $this->session->set_flashdata('success','Category updated successfully.');
                    redirect(base_url().'admin/category/index');


                } else {
                    // We got some errros
                    $error = $this->upload->display_errors("<p class='invalid-feedback'>",'</p>');
                    $data['errorImageUpload'] = $error;
                    $data['category']=$category;
                    $this->load->view('admin/category/edit',$data);
                }


            } else {
                // We will create category without image
                $formArray['name'] = $this->input->post('name');
                $formArray['status'] = $this->input->post('status');            
                $formArray['updated_at'] = date('Y-m-d H:i:s');
                $this->Category_model->update($categories_ID,$formArray);
                $this->session->set_flashdata('success','Category updated successfully.');
                redirect(base_url().'admin/category/index');
            
            }

        }
        else{
               $data['category']=$category;
               $this->load->view('admin/category/edit',$data);
        }
	}
    //  delete the  category	
    public function delete($categories_ID)
	{
        $this->load->model('Category_model');
        $category=$this->Category_model->getCategory($categories_ID);
          if(empty($category)){
          $this->session->set_flashdata('error','Category not found');
          redirect(base_url().'admin/category/index');
          }
          
          if(file_exists('./public/uploads/category/'.$category['image'])){
            unlink('./public/uploads/category/'.$category['image']);
              }
        if(file_exists('./public/uploads/category/thumb/'.$category['image'])){
            unlink('./public/uploads/category/thumb/'.$category['image']);
            }
          $this->Category_model->delete($categories_ID);
          $this->session->set_flashdata('success','Category delete successfully.');
          redirect(base_url().'admin/category/index');
	}	
	
}
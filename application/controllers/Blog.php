 <?php 
 class Blog extends CI_controller{
// this  method show  blog the list 
    public function index($page=1){

        $config['per_page'] = 10;
        $param['offset']=$config['per_page'];
        $param['limit']=($page*$config['per_page'])-$config['per_page'];
      
      

        $this->load->model('Article_model');
        $this->load->helper('text');
        $this->load->library('pagination');

        $config['base_url'] = base_url('blog/index');
        $config['total_rows'] = $this->Article_model->getArticlescount();
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
  
 


       $articles= $this->Article_model->getArticlesFront($param);
       $data=[];
       $data['articles']=$articles;
       $data['pagination_link']=$pagination_link;



        $this->load->view('front/blog',$data);

  
    }
    public function categories(){
       $this->load->model('Category_model');
       $categories= $this->Category_model->getCategoriesfront();
       $data=[];
       $data['categories']=$categories;;
        $this->load->view('front/categories',$data);
    }
    function detail($ID) {

        $this->load->model('Article_model');
        $this->load->model('Comment_model');
        $this->load->library('form_validation');
        
        $article = $this->Article_model->getArticle($ID);


        if (empty($article)) {
            redirect(base_url('blog'));
        }
        $data = [];
        $data['article'] = $article;

       $comments= $this->Comment_model->getComments($ID);
       $data['comments'] = $comments;

        $this->form_validation->set_rules('name','Name','required|min_length[5]');
        $this->form_validation->set_rules('comment','Comment','required|min_length[20]');
        $this->form_validation->set_error_delimiters('<p class="mb-0">','</p>');

        if ($this->form_validation->run() == true ) {
            // Insert here
            $formArray = [];
            $formArray['name'] = $this->input->post('name');
            $formArray['comment'] = $this->input->post('comment');
            $formArray['article_id'] = $ID;
            $formArray['create_at'] = date('Y-m-d H:i:s');
            $this->Comment_model->create($formArray);

            $this->session->set_flashdata('message','Your comment has been posted successfully.');
            redirect(base_url('blog/detail/'.$ID));

        } else {
            $this->load->view('front/detail',$data);    
        }       
        
    }

    public function Category($category_ID,$page=1){

        $this->load->model('Category_model');
        $this->load->model('Article_model');
        $this->load->helper('text');
        $this->load->library('pagination');

        $category= $this->Category_model->getCategory($category_ID);
       if(empty($category)){
        redirect(base_url('blog'));
       }
      


        $config['per_page'] = 2;
        $param['offset']=$config['per_page'];
        $param['limit']=($page*$config['per_page'])-$config['per_page'];
        $param['category_ID'] = $category_ID;
      

        
        $config['base_url'] = base_url('blog/category/'. $category_ID);
        $config['total_rows'] = $this->Article_model->getArticlescount($param);
        $config['uri_segment'] =4;

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
  
 


       $articles= $this->Article_model->getArticlesFront($param);
       $data=[];
       $data['articles']=$articles;
       $data['category']=$category;
       $data['pagination_link']=$pagination_link;


          $this->load->view('front/category_article',$data);
    }
 }
 ?>
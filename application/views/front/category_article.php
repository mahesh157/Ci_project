<?php 
$this->load->view('front/header');
?>
<div class="container">
    <h3 class="pt-4 pb-4"> Blog / <?php echo $category['name']?></h3>

    <?php if(!empty($articles)){
        foreach($articles as $article){
        ?>

    <div class="row mb-5">
        <div class=" col-md-4">
            <?php
          if(!empty($article['image'])){
            ?>
            <img class="w-100 rounded " src="<?php echo base_url('public/uploads/articles/'.$article['image']);?>"
                width="300" height="270">
            <?php
           }
          ?>
        </div>
        <div class="col-md-8">
            <p class="bg-light pt-2 pb-2 pl-3">
                <a href="<?php echo base_url('blog/category/'.$article['category'])?>" class="text-muted text-uppercase"> <?php echo $article['category_name']?> </a>
            </p>
            <h3>
                <a href="<?php echo base_url('blog/detail/'.$article['ID']);?>"> <?php echo $article['title'];?></a>
            </h3>
            <p>

            <?php echo  word_limiter(strip_tags($article['description']),50)?>
            <a href="<?php echo base_url('blog/detail/'.$article['ID']);?>" class="text-muted"> Read More </a>
        </p>
            <p class="text-muted"> Posted By <strong><?php echo $article['author'];?></strong> on <strong>
                    <?php echo date('d M y',strtotime($article['create_at']));?> </strong></p>

        </div>
    </div>
    <?php 
    }
}
    
?>

    <div class="row">
        <div class=" col-md-12">
            <?php
           echo $pagination_link;
            ?>

        </div>
    </div>


</div>
<?php
$this->load->view('front/footer');
?>
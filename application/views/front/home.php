  <?php $this->load->view('front/header');?>
  
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <img src="<?php echo base_url('public/images/slide1.png');?>" class="d-block w-100 " alt="...">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo base_url('public/images/slide2.jpg');?>" class="d-block w-100 " alt="">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo base_url('public/images/slide3.jpg');?>" class="d-block w-100 " alt="...">
                </div>
            
        </div>
        <div class="container mt-3">
            <h3 class="mt-3">About Company </h3>
            <p class="text-muted">
                A company is a legal entity formed by a group of individuals to engage
                in and operate a business—commercial or industrial—enterprise. A company
                may be organized in various ways for tax and financial liability purposes
                depending on the corporate law of its jurisdiction
                The line of business the company is in will generally determine which business
                structure it chooses such as a partnership, proprietorship, or corporation.
                These structures also denote the ownership structure of the company.
                They can also be distinguished between private and public companies. Both have different
                ownership structures, regulations, and financial reporting requirements.
            </p>
            <p>
                A company is essentially an artificial person—also known as corporate personhood—in
                that it is an entity separate from the individuals who own, manage, and support its operations.
                Companies are generally organized to earn a profit from business activities, though some may be
                structured as nonprofit charities. Each country has its own hierarchy of company and corporate
                structures, though with many similarities.
                A company has many of the same legal rights and responsibilities as a person does,
                like the ability to enter into contracts, the right to sue (or be sued), borrow money,
                pay taxes, own assets, and hire employees.</p>

        </div>
        

        <div class="bg-light pb-4">
            <div class="container ">
                <h3 class="pb-3 pt-4">OVER SERVICES </h3>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card h-100 mt-1">
                            <img src="<?php echo base_url('public/images/box1.jpg');?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Website Development</h5>
                                <p class="card-text">Web development is the work involved in developing a website for
                                    the Internet or an intranet.
                                    applications.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card h-100 mt-1">
                            <img src="<?php echo base_url('public/images/box2.jpg');?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Dìgital Marketing</h5>
                                <p class="card-text">the promotion of brands to connect with potential customers
                                    using the internet and other forms of digital communication. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card h-100 mt-1">
                            <img src="<?php echo base_url('public/images/box3.jpg');?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Mobile App Development</h5>
                                <p class="card-text">Mobile application development is the process of making software
                                    for smartphones,
                                    tablets and digital assistants</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card h-100 mt-1">
                            <img src="<?php echo base_url('public/images/box4.jpg');?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">IT Consultant Company</h5>
                                <p class="card-text">An IT Consultant is a knowledgeable professional who helps
                                    businesses develop, integrate,
                                    and maximize the value of IT systems..</p>
                            </div>
                        </div>
                    </div>
       
                </div>
            </div>
        </div>
        <?php if(!empty($articles)){?>
        <div class="pb-4 pt-4">
            <div class="container ">
                <h3 class="pb-3 pt-4">LATEST BLOGS</h3>
                <div class="row">
                <?php foreach($articles as $article){ ?>
                    <div class="col-lg-3">
                        <div class="card h-100 mt-1">

                            <a href="<?php echo base_url('blog/detail/'.$article['ID'])?>">

                            <?php if(file_exists('./public/uploads/articles/'.$article['image'])){ ?>
                                <img src="<?php echo base_url('./public/uploads/articles/'.$article['image'])?>" class="card-img-top" alt="...">
                             <?php }?>
                            </a>
                            
                            <div class="card-body">
                                <p class="card-text"><?php echo $article['title']?> </p>
                                <a  class="btn btn-primary btn-sm" href="<?php echo base_url('blog/detail/'.$article['ID'])?>">Read More </a>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                    <!--
                    <div class="col-lg-3">
                        <div class="card h-100 mt-1">
                            <img src="<?php echo base_url('public/images/box2.jpg');?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text">the promotion of brands to connect with potential customers
                                    using the internet and other forms of digital communication. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card h-100 mt-1">
                            <img src="<?php echo base_url('public/images/box3.jpg');?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text">Mobile application development is the process of making software
                                    for smartphones,
                                    tablets and digital assistants</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card h-100 mt-1">
                            <img src="<?php echo base_url('public/images/box4.jpg');?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text">An IT Consultant is a knowledgeable professional who helps
                                    businesses develop, integrate,
                                    and maximize the value of IT systems..</p>
                            </div>
                        </div>
                    </div>
                -->
                </div>
            </div>
        </div>

    </div>
    </div>
    </div>
        <?php $this->load->view('front/footer');?>

       <?php }?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

</body>

</html>
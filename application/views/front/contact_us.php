<?php 
$this->load->view('front/header');
?>

<div class="container-fluid" style="background-image: url(../public/images/ball-bright-close-up-clouds-207489.jpg);">
    <div class="row">
        <div class="col-md-12">
            <h1 class=" text-center text-white pt-5"> Contact Us <h1>
        </div>
    </div>

    <div class="container mt-5 pb-5">
        <div class="row ">

            <div class="col-md-7">
                <div class="card mb-5 h-100">
                    <div class="card-header bg-secondary text-white">
                        Have question or comments?
                    </div>
                    <div class="card-body">
                        <?php
                        if(!empty($this->session->set_flashdata('msg'))){

                            ?>
                           <div class="alert alert-success">
                              <?php echo $this->session->set_flashdata('msg'); ?>
                           </div>
                            <?php
                        }
                        ?>
                        <form action="<?php echo base_url('page/contacts');?>" method="post" id="contact-form" name="contact-form">
                            <div>
                                <label>Name</label>
                                <input value="<?php echo set_value('name');?>" type="text" name="name" id="name" class="form-control mt-2 mb-2 <?php echo (form_error('name')!="")? 'is-invalid ': ''; ?>">
                                    <?php echo form_error('name');?>
                            </div>
                            <div>
                                <label>Email Address </label>
                                <input value="<?php echo set_value('email');?>" type="text" name="email" id="email" class="form-control mt-2 mb-2 <?php echo (form_error('email')!="")? 'is-invalid ': ''; ?>">
                                    <?php echo form_error('email');?>
                            </div>
                            <div>
                                <label> Message </label>
                                <textarea name="message" id="message" class="form-control mt-2 " rows="5"><?php echo set_value('message');?></textarea>
                            </div>
                            <button type="sumbit" id="submit" class="btn btn-primary mt-2 ">Send</button>

                        </form>

                    </div>
                </div>
            </div>


            <div class="col-md-5">

                <div class="card h-100">
                    <div class="card-header bg-secondary text-white">
                        Reach Us
                    </div>
                    <div class="card-body">
                        <p class="m-0"><strong> Customer Service</strong> </p>
                        <p class="m-0"> Phone: +91 7691-xxxxxx </p>
                        <p class="m-0"> E-mail: Revolution123@gmail.com </p>

                        <p class="pt-1">&nbsp</p>
                        <p class="m-0"><strong> Headquarters </strong></p>
                        <p class="m-0"> Revolution Software Services Pvt </p>
                        <p class="m-0">Maharani Apartment, B-208, B-6, </p>
                        <p class="m-0">Rajendra Marg, Bapu Nagar, </p>
                        <p class="m-0">Jaipur, Rajasthan 302015 </p>

                        <p class="pt-1">&nbsp</p>
                        <p class="m-0"><strong> India </strong></p>
                        <p class="m-0"> Revolution Software Services Pvt </p>
                        <p class="m-0">Maharani Apartment, B-208, B-6, </p>
                        <p class="m-0">Revolution123@gmail.com </p>

                    </div>
                </div>
            </div>






        </div>
    </div>
</div>


<?php
 $this->load->view('front/footer');
?>
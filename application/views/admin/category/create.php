<?php $this->load->view('admin/header');?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Categories</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/category/index';?>">Categories</a></li>
                    <li class="breadcrumb-item active">Create a new Category</li>
                    
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- /.col-md-6 -->
            <div class="col-lg-12">

                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">
                            Create New Category
                        </div>

                    </div>
                    <form enctype="multipart/form-data" name="categoryForm" id="categoryForm" method="post"
                        action="<?php echo base_url().'admin/category/create'?>">
                        <div class="card-body">

                            <div class="form-group">
                                <lable><strong> Name </strong></lable>
                                <input type="text" name="name" id="name" value="<?php echo set_value('name');?>" class="form-control <?php echo (form_error('name')!="") ? 'is-invalid' : ''; ?> ">
                                <?php echo form_error('name');?>
                            </div>                                                                           

                            <div class="form-group">
                            <label>Image</label> <br>
                            <input type="file" name="image" id="image" class="<?php echo (!empty($errorImageUpload)) ? 'is-invalid' : '';?>">
                            <?php echo (!empty($errorImageUpload)) ? $errorImageUpload : '';?>
                        </div>

                            <div class="form-check custom-radio float-left">
                                <input class="form-check-input" value="1" type="radio" name="status" id="statusActive">
                                <label class="form-check-label" for="statusActive"><strong> Active <strong></label>
                            </div>
                            <div class="form-check custom-radio float-left  ml-3">
                                <input class="form-check-input" value="0" type="radio" name="status" id="statusBlock">
                                <label class="form-check-label" for="statusBlock"> <strong> Block <strong> </label>
                            </div>

                            <div class="card-footer ">
                                <button style="margin-left: -126px;" name="submit" type="submit"
                                    class="btn btn-primary btn-sm my-3 "> Submit</button>
                                <a href=" <?php echo base_url().'admin/category/index';?>" class="btn btn-secondary btn-sm">
                                    Back </a>
                            </div>
                    </form>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<?php $this->load->view('admin/footer');?>
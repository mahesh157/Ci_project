<?php $this->load->view('admin/header');?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Articles</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Articles</li>
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

                <?php if ($this->session->flashdata('success') != ""){?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('success');?></div>
                <?php } ?>

                <?php if ($this->session->flashdata('error') != ""){?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('error');?></div>
                <?php } ?>

                <div class="card">
                    <div class="card-header">
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <form id="searhFrm" name="searhFrm" method="get" action="">
                                    <div class="input-group mb-0">
                                        <input type="text" value="<?php echo $q;?>" class="form-control" placeholder="Search" name="q">
                                        <div class="input-group-append">
                                            <button class="input-group-text" id="basic-addon1">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-tools">
                                <a href="<?php echo base_url().'admin/article/create';?>" class="btn btn-primary"><i
                                        class="fas fa-plus"></i>Create</a>

                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th width="50">SNO</th>
                                    <th width="100">Image</th>
                                    <th>Title</th>
                                    <th width="150">Author</th>
                                    <th width="100">Status</th>
                                    <th width="70">Create</th>
                                    <th width="140" class="text-center">Action</th>
                                </tr>
                                <?php if(!empty($articles)){ 
                                    foreach($articles as $article){
                                    ?>
                                <tr>
                                    <td><?php echo $article ['ID'] ?></td>
                                    <td>
                                        <?php 
                                    $path = './public/uploads/articles/'.$article['image'];
                                    if($article['image'] != "" && file_exists($path)) {
                                        ?>
                                        <img class="w-100"
                                            src="<?php echo base_url('public/uploads/articles/'.$article['image'])?>"
                                            alt="">
                                        <?php
                                    } else {
                                        ?>
                                        <img class="w-100"
                                            src="<?php echo base_url('public/uploads/articles/thumb_admin/no-image.png');?>"
                                            alt="">

                                        <?php
                                    }
                                    ?>
                                    </td>
                                    <td><?php echo $article ['title'] ?></td>
                                    <td><?php echo $article ['author'] ?></td>
                                    <td><?php echo date('d-m-Y',strtotime($article ['create_at'] ))?></td>
                                    <td>
                                        <?php 
                                         if($article ['status'] ==1 ){
                                            ?>
                                        <p class="badge bg-success"> Active </p>
                                        <?php
                                         
                                         }else{
                                         ?>
                                        <p class="badge bg-danger"> Block </p>
                                        <?php  }?>
                                    </td>
                                    <td class="text-center">

                                        <a href="<?php echo base_url('admin/article/edit/'.$article ['ID']);?>" class="btn btn-sm btn-primary">
                                             <i class="far fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" onclick="deleteArticle(<?php echo $article ['ID']; ?>)" class="btn btn-sm btn-danger">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </td>

                                </tr>
                                <?php 
                                 }
                                    } else{
                                        ?>
                                <tr>
                                    <td colspan="4">Record is Not found </td>
                                </tr>
                                <?php 
                                    }?>

                            </table>
                            <div>
                                <?php echo $pagination_link ?>
                            </div>
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <?php $this->load->view('admin/footer');?>

        <script type="text/javascript">
        function deleteArticle(ID) {
            if (confirm("are you sure you want to delete article")) {
                window.location.href = '<?php echo base_url().'admin/article/delete/';?>' + ID;

            }
        }
        </script>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('public/css/style.css');?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

    <div container="">
        <nav class="navbar navbar-expand-lg bg-body-tertiary pt-4 pb-3">
            <div class="container-fluid offset-1">
                <a class="navbar-brand " href="<?php echo base_url();?>">Codeigniter Web Application</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0  offset-5">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo base_url();?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('page/about')?>">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('page/services')?>">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('blog')?>">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('blog/categories')?>">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('page/contacts');?>">Contact</a>
                        </li>
                </div>
            </div>
        </nav>
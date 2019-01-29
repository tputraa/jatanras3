<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php if($this->uri->segment(3) == null || $this->uri->segment(3) == ''){?>
          <title>Koarmada</title>
      <meta name="url" content="<?php echo base_url();?>">
      <meta name="description" content="KOARMADA - Komando Armada"/>
      <meta name="image" content="<?php echo site_url('assets/images/logo/')?>logo3.png">
      <meta content="Indonesia" name="geo.placename"/>
      <meta property="og:url"                content="<?php echo base_url(uri_string());?>" />
      <meta property="og:type"               content="website"/>
      <!-- <meta property="fb:app_id"             content="2094126644166944" /> -->
      <meta property="og:title"              content="KOARMADA - Komando Armada" />
      <meta property="og:description"        content="KOARMADA - Komando Armada" />
      <meta property="og:image"              content="<?php echo site_url('assets/images/logo/')?>logo3.png">
      <meta property="og:image:width" content="300">
      <meta property="og:image:height" content="300">
      <meta name="twitter:title" content="KOARMADA - Komando Armada"/>
      <meta name="twitter:card" content="summary_large_image" />
      <meta name="twitter:description" content="KOARMADA - Komando Armada"/>
      <meta name="twitter:image" content="<?php echo site_url('assets/images/logo/')?>logo3.png" />
    <?php } else{ foreach($singlepost as $row){ ?>
        <title><?php echo $row->judul;?></title>
        <?php 
          $text = $row->isi;
          $text = character_limiter($text,100);
        ?>
        <meta name="url" content="<?php echo base_url(uri_string());?>">
        <meta name="description" content="<?php echo strip_tags($text);?>"/>
        <meta property="og:url"                content="<?php echo base_url(uri_string());?>" />
        <meta property="og:type"               content="article"/>
        <!-- <meta property="fb:app_id"             content="2094126644166944" /> -->
        <meta property="og:title"              content="<?php echo $row->judul; ?>" />
        <meta property="og:description"        content="<?php echo strip_tags($text); ?>" />
        <meta property="og:image"              content="<?php echo base_url('/assets/images/berita_images/').$row->images?>" />
        <?php }?>
    <?php }?>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/customize.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
  </head>
  <body>

  <div>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-space">
      <div class="container head-content">
        <a class="navbar-brand" href="#">
          <img src="<?php echo base_url();?>assets/images/logo/koarmadalogo.png" alt="Logo">
          <div class="title">
            <h5>Pusat Data & Informasi</h5>
            <h2>KOARMADA 1</h2>
          </div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample07">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url();?>">Utama<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('');?>profilekoarmada">Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url();?>blog">Berita</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url();?>galeri">Galeri</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('login');?>">Admin</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-md-0" action="<?php echo base_url('Blog/Search');?>" method="get">
            <input class="form-control form-custom" type="text" name="q" placeholder="Search..." aria-label="Cari">
            <button class="btn btn-light btn-cari" type="submit"><i class="fa fa-search"></i></button>
          </form>
        </div>
      </div>
    </nav>
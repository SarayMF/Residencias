<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
  <link rel="stylesheet" href="<?php echo base_url('resources/slide/css/swiper.min.css');?>">
  
  <link href="<?php echo base_url('resources/libs/fontawesome/css/fontawesome.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('resources/libs/fontawesome/css/brands.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('resources/libs/fontawesome/css/solid.css');?>" rel="stylesheet">
  <link rel="stylesheet" media="screen" href="<?php echo base_url('resources/style/style.css');?>">
  <link rel="stylesheet" media="screen" href="<?php echo base_url('resources/style/sfia.css');?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  
  <link rel="stylesheet" media="screen" href="<?php echo base_url('resources/style/customStyle.css');?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.27.1/slimselect.min.css" rel="stylesheet"></link>
  <!-- Traductor -->
  <style type="text/css">
    
    a.gflag {vertical-align:middle;font-size:32px;padding:1px 0;background-repeat:no-repeat;background-image:url(//gtranslate.net/flags/32.png);}
    a.gflag img {border:0;}
    a.gflag:hover {background-image:url(//gtranslate.net/flags/32a.png);}
    #goog-gt-tt {display:none !important;}
    .goog-te-banner-frame {display:none !important;}
    .goog-te-menu-value:hover {text-decoration:none !important;}
    body {top:0 !important;}
    #google_translate_element2 {display:none!important;}
    
  </style>

  <title>JuventudEsGto</title>
  <link rel="shortcut icon" href="<?php echo base_url('resources/impulso.ico');?>">



</head>

<body>
  <div class="wrapper">
    <!-- GTranslate: https://gtranslate.io/ -->
    <div id="google_translate_element2"></div>

    <!-- HEADER -->
    <header class="masthead" role="banner">
      <!-- Top bar -->
      <div class="top-bar">
        <div class="container">
          <div class="row">
            <!-- CONTACT -->
            <div class="hidden-xs col-sm-6">
              <ul class="contact-options">

                <li class="phone">
                  <a href="http://sgo.juventudesgto.com/Directorio/Directorio.html" title="Contacto" target="_blank"> 477 710 34 00</a>

                </li>

                <div class="rro"></div>
                <li class="phone">
                  <a href="http://sgo.juventudesgto.com/Directorio/Directorio.html" title="Contacto" target="_blank">DIRECTORIO</a>
                </li>

              </ul>
            </div>
            <!-- /CONTACT -->
            <!-- SOCIAL -->
            <div class="col-xs-12 col-sm-6">
              <div class="social xs-center">

                <a href="https://www.instagram.com/juventudgto/" title="Instagram" target="_blank"><span class="fab fa-instagram"></span></a>
                <a href="https://www.facebook.com/JuventudEsGto" title="Facebook" target="_blank"><span class="fab fa-facebook-square"></span></a>
                <a href="https://twitter.com/JuventudEsGto" title="Twitter" target="_blank"><span class="fab fa-twitter"></span></a>
                <a href="https://www.youtube.com/channel/UCNxjn155hP-SHqu1m4C4w4w" title="YouTube" target="_blank"><span class="fab fa-youtube"></span></a>
                <a href="https://www.tiktok.com/@juventudesgto?_d=secCgYIASAHKAESMgowwNecevOXTNFs1MrRbUWyACd%2F8VbwjJSj7X0VbtSgMB8Hk6CSAz4JM6iFy3fkAhmMGgA%3D&language=es&sec_uid=MS4wLjABAAAAIvg_1QW5XcHcnWaU215krcSoYRS32VH140AvOjufnSdAgfinJVU1lo4yH5UGZANK&sec_user_id=MS4wLjABAAAAIvg_1QW5XcHcnWaU215krcSoYRS32VH140AvOjufnSdAgfinJVU1lo4yH5UGZANK&share_app_id=1233&share_author_id=6902169995460314113&share_link_id=1ef3c474-ff07-49b6-9446-456a68e369d6&timestamp=1625587897&u_code=dfm08lg625c7a6&user_id=6902169995460314113&utm_campaign=client_share&utm_medium=android&utm_source=whatsapp&source=h5_m&_r=1" title="TikTok" target="_blank"><span class="fab fa-tiktok"></span></a>
                <div class="rro lnh"></div>                           
              </div>
            </div>
            <!-- /SOCIAL -->
          </div>
        </div>
      </div>

      <?php $session = session();?>
      <?php if($session->has('idUsuario')):?>
        <div class="col-12 veda">

          <div class="col-6 col-md-3 col-lg-3">
            <div class="navbar-header">
              <a href="#"></a>
            </div>
          </div>
          
          <div class="col-6 col-md-9 col-lg-9 justify-content-end">
            <ul class="nav d-flex justify-content-end main-menu">
              <li class="nav-item">
                  <a class="nav-link <?=(str_replace('%20',' ',$uri->getSegment(1))=='')?'active':''?>" href="<?php echo base_url('/')?>"><span class="fas fa-home"></span></a>
              </li>
              <?php foreach($permisos as $permiso):?>
                <li class="nav-item">
                  <a class="nav-link <?=(str_replace('%20',' ',$uri->getSegment(1))==$permiso['nombre'])?'active':''?>" href="<?php echo base_url($permiso['nombre'])?>"><?php echo $permiso['nombre'] ?></a>
                </li>
              <?php endforeach?>
              
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('salir')?>"><i class="fas fa-sign-out-alt"></i></i></a>
              </li>
            </ul>
          </div>

        </div>
      <?php endif?>

      <div class="botbar">
       <div class="barC1"></div>
       <div class="barC2"></div>
     </div>
   </header>
   
   <!-- Search field -->
   <div class="modal search fade" id="modal_search" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-body">
        <form action="javascript:RedireccionaBuscador()">
          <input type="text" class="search-field" id="txtSearch" placeholder="Buscar" value="">
          <button type="submit" style="display: none;">Buscar</button>
        </form>
      </div>
    </div>
  </div>
  <!-- /Search field -->
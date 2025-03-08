<?php
  $nom=$user_info['nom']." ".$user_info['prenom'];//nom 
  
  $idnivo=$user_info['idnivo'];// le nivo
  $idpersonne=$user_info['idpersonne'];
  $pays=$user_info['pays'];
  $photo_de_profile=$photo;


 // $nbre_no_read=$this->Tableau->get_all_message_no_read();
  //$no_read_dos=$this->Tableau->message_dossier();
  
  if ($photo) {
    $photo_de_profile=$photo;
  }else{
    $photo_de_profile='img/ph.png';
  }

?>


<!--==================================================-->
<!-- Start lawyer Main Menu Area -->
<!--==================================================-->
<div id="sticky-header" class="lawyer_nav_manu style-two align-items-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-2">
                <div class="logo">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><strong class="blanc" style="color: white; "><?php echo $nom?></strong></span> 
                </div>
            </div>
            <div class="col-lg-8">
                <nav class="lawyer_menu">
                    <ul class="nav_scroll">
                        <li><a href="#">Personnel</a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo base_url('Liste_personnel') ?>">Liste personnel</a></li>
                                <li><a href="<?php echo base_url('Fiche_salaire') ?>">Fiche de salaire</a></li>
                                <li><a href="<?php echo base_url('About_us') ?>index-3.html">Home Page 03</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo base_url('About_us') ?>">About </a></li>
                        <li><a href="#">Client</a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo base_url('Client') ?>">Liste client</a></li>
                                <li><a href="<?php echo base_url('Team') ?>">Team</a></li>
                                <li><a href="<?php echo base_url('Service') ?>">Service</a></li>
                                <li><a href="<?php echo base_url('Portfolio') ?>">Portfolio</a></li>
                                <li><a href="<?php echo base_url('Faq') ?>">Faq</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Case Study</a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo base_url('Case_study1') ?>">Case Study One</a></li>
                                <li><a href="<?php echo base_url('Case_study2') ?>">Case Study Two</a></li>
                                <li><a href="<?php echo base_url('Case_study3') ?>">Case Study Three</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Blog</a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo base_url('Blog_liste') ?>">Blog List</a></li>
                                <li><a href="<?php echo base_url('Blog_column') ?>">Blog 2Column</a></li>
                                <li><a href="<?php echo base_url('Blog_detail') ?>">Blog Details</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo base_url('Contact') ?>">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-2 pl-0 pr-0 ">
                <div class="header-button">
                    <a href="<?php echo base_url('Deconnected') ?>"> DECONNEXION  </a>
                </div>
            </div>
        </div>
    </div>
</div>
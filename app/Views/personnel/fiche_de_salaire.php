<?= $this->include("tete/base");  ?>
<?= $this->section('content'); ?>
<?php $idnivo = $user_info['idnivo'];   ?>
<title>Clients</title>

<div class=" col-lg-12">

    <div class="card shadow mt-4">
        <!-- Card Header - Dropdown -->
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 text-left">
                    <a href="<?= base_url('Newclient') . "?action=" . md5('ciphertext') . md5('ciphertext') ?>">
                        <h5 class="text-center police" style="color: #007BFD">ENREGISTRER UN EMPLOYER</h5>
                    </a>
                </div>
                <div class="col-lg-6 col-md-6 text-right">
                    <i class="fa fa-2x fa-print text-primary sr-icons"><a target="_blank" href="<?php echo base_url('Liste_client_pdf'); ?> ">Imprimer</a> </i>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5 mb-5" style="padding-left: 5em;padding-right: 5em;">
        <i class="fa fa-2x fa-users text-primary sr-icons">LISTE DU PERSONNEL </i>
        <table id="example" class="table table-striped table-hover table-bordered" style="width:100%">
            <thead class="thead-dark">
                <th>Nom et prénom</th>
                <th class="text-center">Fonction</th>
                <th class="text-center">Tél</th>
                <th class="text-center">N° de compte</th>
                <th class="text-center">Salaire de base</th>
                <th class="text-center">Opérations</th>
            </thead>
            <tbody>
                <?php foreach ($lessalaires as $lessalaire) {  ?>
                    <tr>
                        <td>
                            <?php
                            if ($idnivo == 1) {
                                echo name($lessalaire['nom'] . " " . $lessalaire['prenom']);
                            } else {
                                echo name($lessalaire['nom'] . " " . $lessalaire['prenom']);
                            }
                            ?>
                        </td>
                        <td><?php echo @ucfirst($lessalaire['fonction']); ?> </td>
                        <td><?php echo @$lessalaire['tel']; ?> </td>
                        <td class="text-right"><?php echo $lessalaire['num_compte']; ?> </td>
                        <td class="text-right"><?php echo $lessalaire['salaire_base']; ?> </td>
                        <td class="text-center">
                            <a class="btn btn-space btn-primary btn-xs" href="<?php echo base_url('Employer_alter/' . ($lessalaire['idfiche'])) . "ff" . md5($lessalaire['idfiche']) . md5($lessalaire['idfiche']); ?>/alter"><i class="fa fa-1x fa-pen sr-icons"></i></a>
                            <a class="btn btn-space btn-danger btn-xs" href="<?php echo base_url('Employer_alter/' . ($lessalaire['idfiche'])) . "ff" . md5($lessalaire['idfiche']) . md5($lessalaire['idfiche']); ?>/canceling"><i class="fa fa-1x fa-lock sr-icons"></i></a>
                        </td>
                    </tr>
                <?php }  ?>

            </tbody>

        </table>
    </div>
</div>




<?= $this->include('footer/findepage') ?>
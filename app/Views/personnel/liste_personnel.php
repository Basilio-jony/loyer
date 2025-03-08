<?= $this->include("tete/base");  ?>
<?= $this->section('content'); ?>
<?php $idnivo = $user_info['idnivo'];   ?>
<title>Liste du personnel</title>

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
                <th class="text-center cv">N°</th>
                <th class="text-center">Nom</th>
                <th class="text-center">Fonction</th>
                <th class="text-center">Tel</th>
                <th class="text-center">Operation</th>
            </thead>
            <tbody>
                <?php foreach ($personnels as $personnel) { ?>
                    <tr>
                        <td><?php echo $personnel['idfiche'];  ?> </td>
                        <td class="text-left">
                            <?php echo name($personnel['nom'] . " " . $personnel['prenom']) ?>
                        </td>
                        <td><?php echo @ucfirst($personnel['fonction']); ?> </td>
                        <td class="text-center"><?php echo name($personnel['tel']) ?> </td>
                        <td class="text-center" style="width:15%">
                            <a class="btn btn-space btn-primary btn-xs" href="<?php echo base_url('Personnel_alter/' . ($personnel['idfiche'])) . "ff" . md5($personnel['idfiche']) . md5($personnel['idfiche']); ?>/alter"><i class="fa fa-1x fa-pen sr-icons"></i></a>
                            <a class="btn btn-space btn-danger btn-xs" href="<?php echo base_url('Personnel_alter/' . ($personnel['idfiche'])) . "ff" . md5($personnel['idfiche']) . md5($personnel['idfiche']); ?>/canceling"><i class="fa fa-1x fa-lock sr-icons"></i></a>
                        </td>
                    </tr>
                <?php }  ?>

            </tbody>

        </table>
    </div>
</div>




<?= $this->include('footer/findepage') ?>
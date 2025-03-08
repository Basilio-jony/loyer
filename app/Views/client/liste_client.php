<?= $this->include("tete/base");  ?>
<?= $this->section('content'); ?>

<title>Clients</title>

<div class=" col-lg-12">
    
    <div class="card shadow mt-4">
        <!-- Card Header - Dropdown -->
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 text-left">
                    <a href="<?= base_url('Newclient') . "?action=" . md5('ciphertext') . md5('ciphertext') ?>">
                        <h5 class="text-center police" style="color: #007BFD">CREER NOUVEAU CLIENT</h5>
                    </a>
                </div>
                <div class="col-lg-6 col-md-6 text-right">
                    <i class="fa fa-2x fa-print text-primary sr-icons"><a target="_blank" href="<?php echo base_url('Liste_client_pdf'); ?> ">Imprimer</a> </i>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5 mb-5">
        <i class="fa fa-2x fa-users text-primary sr-icons">LISTE CLIENT </i>
        <table id="example" class="table table-striped table-hover table-bordered" style="width:100%">
            <thead class="thead-dark">
                <th class="text-center cv">N°</th>
                <th class="text-center">Date</th>
                <th class="text-center">Nom</th>
                <th class="text-center">Société/Tel</th>
                <th class="text-center">Email</th>
                <th class="text-center">Dossier</th>
                <th class="text-center">Edit</th>
            </thead>
            <tbody>
                <?php foreach ($clients as $client) { ?>
                    <tr>
                        <td><?php echo $client['idclient'];  ?> </td>
                        <td class="text-right">
                            <?php
                            if ($client['date']) {
                                echo trans_date($client['date']);
                            } else {
                                echo "--";
                            } ?>
                        </td>
                        <td><?php echo name($client['nom']) ?> </td>
                        <td><?php echo $client['ste'] . "<br/> Tel : " . $client['tel'];  ?> </td>
                        <td><?php echo $client['mail']; ?> </td>
                        <td class="text-center">
                            <a class="btn btn-space btn-success btn-xs" href="<?php echo base_url('Corps_facture/' . md5(1) . md5(2) . "/" . $client['idclient']) . "W" . md5(1) . md5(2); ?>"><i class="fa fa-1x fa-folder-open sr-icons"></i></a>
                        </td>
                        <td class="text-center" style="width:15%">
                            <a class="btn btn-space btn-primary btn-xs" href="<?php echo base_url('Client_alter/' . md5($client['idclient']) . md5($client['idclient']) . "/" . ($client['idclient'])) . "ff" . md5($client['idclient']) . md5($client['idclient']); ?>"><i class="fa fa-1x fa-pen sr-icons"></i></a>
                        </td>
                    </tr>
                <?php }  ?>

            </tbody>

        </table>
    </div>
</div>




<?= $this->include('footer/findepage') ?>
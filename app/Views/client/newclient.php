<?= $this->include("tete/base");  ?>
<?= $this->section('content'); ?>

<title>Client</title>

<div class="row contact-info-section">
    <div class="col-xl-3 col-lg-3"></div>
    <div class="col-md-6" style="background-color: white; box-shadow: 5px 5px 8px 2px"><br />
        <div class="card mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 text-left">
                        <!-- service-box -->
                        <h3 class="ctitre police">Nouveau client</h3>
                        <?= sepa_com_new(); ?>
                        <form method="post" class="username-challenge" autocomplete="off" action="<?= site_url('Valider') . "?operation=" . md5(1) . md5(2) ?>">
                            <?= csrf_field(); ?>
                            <div class="form-row">
                                <div class="form-group floating-label col-md-12 show-label orko pure-form">
                                    <label style="color: #007BFD">Nom du client</label>
                                    <input style="border-radius: 45px" type="text" class="form-control orko pure-form" autocomplete="off" name="nom" placeholder="Nom du client" value='<?= set_value('nom') ?>'>
                                    <div class="rouge alert-danger "><?= $validation->getError('nom') ?></div>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group floating-label col-md-6 show-label">
                                    <label style="color: #007BFD">Téléphone</label>
                                    <input style="border-radius: 45px" type="tel" class="form-control" name="tel" placeholder="Téléphone" value='<?= set_value('tel') ?>'>
                                    <div class="rouge alert-danger "><?= $validation->getError('tel') ?></div>
                                </div>

                                <div class="form-group floating-label col-md-6 show-label">
                                    <label style="color: #007BFD">Société</label>
                                    <input style="border-radius: 45px" type="text" class="form-control" name="ste" placeholder="Société(pas obligatoire)" id="loginFormInputLogin" value='<?= set_value('ste') ?>'>
                                </div>
                            </div>
                            <div class="form-group floating-label col-md-12 show-label">
                                <label style="color: #007BFD">Email</label>
                                <input style="border-radius: 45px" type="text" class="form-control" name="mail" placeholder="Email du Email(pas obligatoire)" id="loginFormInputLogin" value='<?= set_value('mail') ?>'>
                                <div class="rouge alert-danger "><?= $validation->getError('mail') ?></div>
                            </div>
                    </div>
                    <a class="btn btn-primary puree-button-primary puree-spinner-button" href="<?php echo base_url('Liste_client') . "?annuler=" . md5('1') . md5('2') ?>">Annuler</a>
                    <button type="submit" class="btn btn-success puree-button-primary puree-spinner-button" onclick="return validations();">VALIDER</button>

                    </form>
                    <br />
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('footer/findepage') ?>
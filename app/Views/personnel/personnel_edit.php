<?= $this->include("tete/base");  ?>
<?= $this->section('content'); ?>

<title>Personnel Modification</title>

<div class="row contact-info-section">
    <div class="col-xl-3 col-lg-3"></div>
    <div class="col-md-6" style="background-color: white; box-shadow: 5px 5px 8px 2px"><br />
        <div class="card mb-5">
            <div class="container">
            <div class="row">
                    <div class="col-lg-12 col-md-12 text-left">
                        <i class="fa fa-2x fa-user text-danger sr-icons">MODIFICATION D'INFORMATION EMPLOYE</i><br />
                        <?php echo sepa_com() ?>
                        <form method="post" class="username-challenge" autocomplete="off" action="<?= site_url('upatedemployer' . '?mise_a_jour=' . md5(5) . md5(8)) ?>">
                            <div class="form-row">
                                <input type="hidden" name="idfiche" value='<?= $fiche['idfiche'] ?>'>

                                <div class="form-group floating-label col-md-6 show-label orko pure-form">
                                    <label style="color: #007BFD">Nom</label>
                                    <input style="border-radius: 45px" type="text" class="form-control orko pure-form" autocomplete="off" name="nom" placeholder="Nom" value='<?= $fiche['nom'] ?>' id="loginFormInputLogin">
                                    <div class="rouge alert-danger "><?= $validation->getError('nom') ?></div>
                                </div>
                                <div class="form-group floating-label col-md-6 show-label orko pure-form">
                                    <label style="color: #007BFD">Prénom</label>
                                    <input style="border-radius: 45px" class="form-control orko pure-form" autocomplete="off" type="text" name="prenom" placeholder="Prénom" value='<?= $fiche['prenom'] ?>' id="loginFormInputLogin">
                                    <div class="rouge alert-danger "><?= $validation->getError('prenom') ?></div>
                                </div>
                                <div class="form-group col-md-6  pure-u-1-2 reg-month puree-dropdown dropdown" style="width: 100%">
                                    <select name="fonction" style="border-radius: 45px">
                                        <option value="<?= $fiche['fonction'] ?>"><?= $fiche['fonction'] ?></option>

                                        <?php foreach ($postes as $poste) { ?>
                                            <option value="<?php echo $poste['nom_poste']; ?>"><?php echo $poste['nom_poste']; ?></option>
                                        <?php }  ?>
                                    </select>
                                    <div class="arrow"></div>
                                    <div class="rouge alert-danger "><?= $validation->getError('fonction') ?></div>
                                </div>
                                <div class="form-group floating-label col-md-6 show-label orko pure-form">
                                    <label style="color: #007BFD">Tel</label>
                                    <input style="border-radius: 45px" class="form-control orko pure-form" autocomplete="off" type="text" name="tel" placeholder="Telephone" value='<?= @$fiche['tel'] ?>' id="loginFormInputLogin">
                                    <div class="rouge alert-danger "><?= $validation->getError('tel') ?></div>
                                </div>
                                <div class="form-group floating-label col-md-6 show-label">
                                    <label style="color: #007BFD">N° de compte bancaire</label>
                                    <input style="border-radius: 45px" type="text" class="form-control" name="num_cont" placeholder="N° de compte bancaire" value='<?= $fiche['num_compte'] ?>' id="loginFormInputLogin">
                                    <div class="rouge alert-danger "><?= $validation->getError('num_cont') ?></div>
                                </div>
                                <div class="form-group floating-label col-md-6 show-label">
                                    <label style="color: #007BFD">Salaire de base</label>
                                    <input readonly style="border-radius: 45px" type="text" class="form-control" name="base" placeholder="Salaire de base" value='<?= $fiche['salaire_base'] ?>' id="loginFormInputLogin">
                                    <div class="rouge alert-danger "><?= $validation->getError('base') ?></div>
                                </div>

                                <a class="btn btn-primary puree-button-primary puree-spinner-button" href="<?php echo base_url('Liste_personnel' . "?annuler=" . md5(85) . md5(56)) ?>">Annuler</a>&nbsp;&nbsp;
                                <button type="submit" class="btn btn-danger puree-button-primary puree-spinner-button">Modifier</button>
                            </div><br />
                        </form>
                    </div>

                    <br />
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('footer/findepage') ?>
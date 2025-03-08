<?php 

function date_complet($date){

    $jour=array('', 'Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche');
    
    $mois=array('','Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre');

    $date=strtotime($date);
    $date_en_francais=$jour[date('N',$date)].' '.date('d',$date).' '.$mois[date('n',$date)].' '.date('Y',$date);
    return $date_en_francais;
}

     function trans_date($date){
        $dat=date_create($date);
        if ($date) {
            return date_format($dat,"d-m-Y");
        }else{
            return "--";
        }
        
    }
     function separateur($val){
        if ($val!=0) {
            $val=number_format ($val,0,"," ," ");
        }    
        return $val;
    }
     function compo_fact($date){
        $dat=date_create($date);
        return date_format($dat,"y");
    }
     function extraire_jour($date){
        $dat=date_create($date);
        return date_format($dat,"d");
    }
     function extraire_mois($date){
        $dat=date_create($date);
        return date_format($dat,"m");
    }
     function extraire_annee($date){
        $dat=date_create($date);
        return date_format($dat,"Y");
    }
     function name($nom){
        $nom = strtoupper($nom);        
        return $nom;
    }
    
     function separateur2($val){
        if ($val!=0) {
            $val=number_format ($val,2,"." ," ");
        }    
        return $val;
    }
 function mot($passe){
        $h1="la_côte_dû";
        $h2="Je_tîam_125";
        $pa=md5($h1.$passe.$h2);
        return $pa;
    }
     function sepa_com(){
        $leg='<legend style="border-bottom: 2px solid red; width: 100%"></legend>';
        return $leg;                                    
    }
    function sepa_com_pdf(){
        $leg='<legend style="border-bottom: 3px solid #F2940F; width: 100%"></legend>';
        return $leg;                                    
    }
    function sepa_com_new(){
        $leg='<legend style="border-bottom: 3px solid #687AE8; width: 100%"></legend>';
        return $leg;                                    
    }

    function mode($bar){
        if ($bar==0) {
            return $ab='Cash';
        }else{
            return $ab='Chèque';
        }
    }
    function opera($bar){
        if ($bar==1) {
            return $ab='Versement';
        }elseif ($bar==2) {
            return $ab='Retrait';           
        }
    }
    function pays($bar){
        if ($bar==0) {
            return $ab='(Lomé)';
        }else{
            return $ab='(Ouaga)';
        }
    }
    
     function operation_salaire($bar){
        if ($bar==0) {
            return $ab='Avance sur salaire';
        }elseif ($bar==1) {
            return $ab='Prèt';
        }elseif ($bar==2) {
            return $ab='Perte';
        }else{
            return $ab='Remboursement';
        }
    }

    function titre($rang){
        if ($rang==1) {
            return $ab='Niveau 1';
        }elseif ($rang==2) {
            return $ab='Niveau 2';
        }elseif ($rang==3) {
            return $ab='Niveau 3';
        }elseif ($rang==4) {
            return $ab='Niveau 4';
        }elseif ($rang==5) {
            return $ab='Niveau 5';
        }
    }
    function type_lib($rang){
        if ($rang==0) {
            return $ab='Caisse';
        }elseif ($rang==1) {
            return $ab='Banque';
        }elseif ($rang==2) {
            return $ab='Caisse-Banque';
        }elseif ($rang==3) {
            return $ab='Transfert';
        }elseif ($rang==4) {
            return $ab='Autres';
        }
    }


    function periode_salaire($rang){
        if ($rang==1) {
            return $ab='Janvier';
        }elseif ($rang==2) {
            return $ab='Février';
        }elseif ($rang==3) {
            return $ab='Mars';
        }elseif ($rang==4) {
            return $ab='Avril';
        }elseif ($rang==5) {
            return $ab='Mai';
        }elseif ($rang==6) {
            return $ab='Juin';
        }elseif ($rang==7) {
            return $ab='Juillet';
        }elseif ($rang==8) {
            return $ab='Août';
        }elseif ($rang==9) {
            return $ab='Septembre';
        }elseif ($rang==10) {
            return $ab='Octobre';
        }elseif ($rang==11) {
            return $ab='Novembre';
        }elseif ($rang==12) {
            return $ab="Décembre";
        }
}


?>
<?php

namespace App\Models;

use CodeIgniter\Model;

class MesfonctionModel extends Model
{


   //-------------------------------------
   // TABLE PERSONNE
   //-----------------------------------

   public function verification($email)
   {
      $builder = $this->db->table('fiche_personnel');
      $builder->select('*');
      $builder->join('personne', 'personne.idpersonnel = fiche_personnel.idfiche');
      $builder->where('personne.mail', $email);
      $result = $builder->get();

      if (count($result->getResultArray()) == 1) {
         return $result->getRowArray();
      } else {
         return false;
      }
   }

   public function verification_de_compte($idpersonnel, $mail)
   {
      $builder = $this->db->table('personne');
      $builder->select('*');
      $builder->where('idpersonnel', $idpersonnel);
      $builder->where('mail', $mail);
      $builder->where('actif', 1);
      $result = $builder->get();
      if (count($result->getResultArray()) == 1) {
         return $result->getRowArray();
      } else {
         return false;
      }
   }
   public function validation_facture()
   {
      $builder = $this->db->table('pied');
      $builder->select('*');
      $builder->where('type', 1);
      $builder->where('validation', 0);
      $result = $builder->get();

      return count($result->getResultArray());
   }

   public function get_info_person($idpersonne)
   {
      $builder = $this->db->table('personne');
      $builder->select('*'); // cest sa
      $builder->where('idpersonne', $idpersonne);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row;
      }
   }
   public function get_rapport($idrapport)
   {
      $builder = $this->db->table('rapport');
      $builder->select('*'); // cest sa
      $builder->where('idrapport', $idrapport);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row;
      }
   }

   public function get_ligne_bq($idbanque)
   {
      $builder = $this->db->table('banque');
      $builder->select('*'); // cest sa
      $builder->where('idbanque', $idbanque);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row;
      }
   }
   public function get_idbanque($num)
   {
      $builder = $this->db->table('banque');
      $builder->select('idbanque'); // cest sa
      $builder->where('num', $num);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row->idbanque;
      }
   }



   public function solde_caisse()
   {
      $builder = $this->db->table('caisse');
      $builder->select('*');
      $builder->where('attent', 0);
      $builder->where('mode', 0);
      $builder->where('idbanque', 0);
      $result = $builder->get();
      return $result->getResult();
   }
   public function solde_bq()
   {
      $builder = $this->db->table('caisse');
      $builder->select('*');
      //$builder->where('attent',0);
      $builder->where('mode', 1);
      $builder->where('idbanque >', 0);
      $result = $builder->get();
      return $result->getResult();
   }
   public function lescheques()
   {
      $builder = $this->db->table('caisse');
      $builder->select('*');
      $builder->where('attent >', 0);
      $builder->where('mode', 1);
      $result = $builder->get();
      return $result->getResult();
   }
   public function total_entrer($idbanque)
   {
      $builder = $this->db->table('caisse');
      $builder->selectSum('entrer');
      //$builder->selectSum('payer');
      $builder->where('idbanque', $idbanque);
      $builder->groupBy('idbanque');
      $result = $builder->get();

      return $result->getResult();
   }

   public function solde_versement()
   {
      $builder = $this->db->table('caisse');
      $builder->select('*');
      $builder->Distinct('idbanque');
      $builder->selectSum('entrer');
      $builder->selectSum('sortie');
      $builder->where('mode', 1);
      $builder->where('idbanque >', 0);
      $builder->groupBy('idbanque');
      //$builder->groupBy('mode');          
      $result = $builder->get();
      return $result->getResult();
   }
   public function total_sortie($idbanque)
   {
      $builder = $this->db->table('caisse');
      $builder->selectSum('sortie');
      $builder->where('idbanque', $idbanque);
      $builder->groupBy('idbanque');
      $result = $builder->get();
      return $result->getResult();
   }
   public function all_opperation_bq_encour()
   {
      $builder = $this->db->table('caisse');
      $builder->select('*');
      $builder->where('mode', 1);
      $builder->where('mois', date("m"));
      $builder->where('anne', date("Y"));
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'DESC');
      $builder->orderBy('ref', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }

   public function opperation_detail_cours($idbanque)
   {
      $builder = $this->db->table('caisse');
      $builder->select('*');
      $builder->where('mode', 1);
      $builder->where('mois', date('m'));
      $builder->where('idbanque', $idbanque);
      $builder->where('anne', date('Y'));
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'ASC');
      $builder->orderBy('ref', 'ASC');
      $result = $builder->get();
      return $result->getResult();
   }
   public function opperation_detail_dernier($idbanque, $mois)
   {
      $builder = $this->db->table('caisse');
      $builder->select('*');
      $builder->where('mode', 1);
      $builder->where('mois', $mois);
      $builder->where('idbanque', $idbanque);
      $builder->where('anne', date('Y'));
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'ASC');
      $builder->orderBy('ref', 'ASC');
      $result = $builder->get();
      return $result->getResult();
   }
   public function opperation_detail_all($idbanque)
   {
      $builder = $this->db->table('caisse');
      $builder->select('*');
      $builder->where('mode', 1);
      $builder->where('idbanque', $idbanque);
      $builder->where('anne', date('Y'));
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'ASC');
      $builder->orderBy('ref', 'ASC');
      $result = $builder->get();
      return $result->getResult();
   }

   public function all_opperation_bq_mois_dernier($mois)
   {
      $builder = $this->db->table('caisse');
      $builder->select('*');
      $builder->where('mode', 1);
      $builder->where('mois', $mois);
      $builder->where('anne', date('Y'));
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'DESC');
      $builder->orderBy('ref', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }
   public function all_opperation_bq()
   {
      $builder = $this->db->table('caisse');
      $builder->select('*');
      $builder->where('mode', 1);
      $builder->where('anne', date('Y'));
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'DESC');
      $builder->orderBy('ref', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }

   public function get_idlib($libe)
   {
      $builder = $this->db->table('libelles');
      $builder->select('*'); // cest sa
      $builder->where('libe', $libe);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row->idlib;
      }
   }
   public function get_lib($id)
   {
      $builder = $this->db->table('libelles');
      $builder->select('*'); // cest sa
      $builder->where('idlib', $id);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row->libe;
      }
   }
   public function ref_caisse($mode)
   {
      $builder = $this->db->table('caisse');
      $builder->select('ref'); // cest sa
      $builder->where('mode', $mode);
      $builder->where('delete_at', null);
      $builder->orderBy('ref', 'DESC');
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row->ref;
      }
   }
   public function ligne_caisse($idcaisse)
   {
      $builder = $this->db->table('caisse');
      $builder->select('*'); // cest sa
      $builder->where('idcaisse', $idcaisse);
      $builder->where('delete_at', null);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row;
      }
   }

   public function num_op_fsr()
   {
      $builder = $this->db->table('compte_fsr');
      $builder->select('num_op'); // cest sa
      $builder->orderBy('num_op', 'DESC');
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row->num_op;
      }
   }

   public function solde_fsr_reglement()
   {
      $builder = $this->db->table('compte_fsr');
      $builder->select('*');
      $builder->Distinct('idfsr');
      $builder->where('idfsr >', 0);
      $builder->selectSum('reglement');
      $builder->groupBy('idfsr');
      $result = $builder->get();

      return $result->getResult();
   }

   public function solde_fsr_achat()
   {
      $builder = $this->db->table('piedmp');
      $builder->select('*');
      $builder->Distinct('idfsr');
      $builder->selectSum('montant');
      $builder->groupBy('idfsr');
      $result = $builder->get();

      return $result->getResult();
   }

   public function get_nom_personnel($idpersonnel)
   {
      $builder = $this->db->table('fiche_personnel');
      $builder->select('*'); // cest sa
      $builder->where('idfiche', $idpersonnel);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row;
      }
   }
   public function get_nom_personnel2($idpersonnel)
   {
      $builder = $this->db->table('fiche_personnel');
      $builder->select('*'); // cest sa
      $builder->where('idfiche', $idpersonnel);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row->prenom;
      }
   }

   public function get_idpersonnel_by_idpersonne($idpersonne)
   {
      $builder = $this->db->table('personne');
      $builder->select('*'); // cest sa
      $builder->where('idpersonne', $idpersonne);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row->idpersonnel;
      }
   }

   public function get_idfsr($nom)
   {
      $builder = $this->db->table('fsr');
      $builder->select('*'); // cest sa
      $builder->where('nom', $nom);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row->idfsr;
      }
   }

   public function get_ligne_fsr($id)
   {
      $builder = $this->db->table('fsr');
      $builder->select('*'); // cest sa
      $builder->where('idfsr', $id);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row;
      }
   }

   public function eviter_double_save_avance($date, $idfiche, $montant)
   {
      $builder = $this->db->table('avance_sur_salaire');
      $builder->select('*');
      $builder->where('date', $date);
      $builder->where('idpersonnel', $idfiche);
      $builder->where('montant', $montant);
      $builder->where('delete_at', null);
      $result = $builder->get();

      if (count($result->getResultArray())) {
         return true;
      } else {
         return false;
      }
   }
   public function eviter_double_save_compte_clt($date, $num)
   {
      $builder = $this->db->table('compte_client');
      $builder->select('num_fact');
      $builder->where('date', $date);
      $builder->where('num_fact', $num);
      $builder->where('type', 1);
      $builder->where('delete_at', null);
      $result = $builder->get();
      if (count($result->getResultArray())) {
         return true;
      } else {
         return false;
      }
   }
   public function eviter_double_save_pied($num)
   {
      $builder = $this->db->table('pied');
      $builder->select('num_fact');
      $builder->where('type', 1);
      $builder->where('num_fact', $num);
      $builder->where('delete_at', null);
      $result = $builder->get();
      if (count($result->getResultArray())) {
         return true;
      } else {
         return false;
      }
   }
   public function eviter_double_piedproforma($num)
   {
      $builder = $this->db->table('pied_proforma');
      $builder->select('num_fact');
      $builder->where('num_fact', $num);
      $builder->where('delete_at', null);
      $result = $builder->get();
      if (count($result->getResultArray())) {
         return true;
      } else {
         return false;
      }
   }
   public function eviter_double_save_salaire($p, $idfiche)
   {
      $builder = $this->db->table('salaire');
      $builder->select('*');
      $builder->where('periode', $p);
      $builder->where('idpersonnel', $idfiche);
      $builder->where('delete_at', null);
      $result = $builder->get();

      if (count($result->getResultArray())) {
         return true;
      } else {
         return false;
      }
   }
   public function eviter_double_save_fsr_payment($num_op, $idpersonnel)
   {
      $builder = $this->db->table('compte_fsr');
      $builder->select('*');
      $builder->where('num_op', $num_op);
      $builder->where('idpersonnel', $idpersonnel);
      $builder->where('delete_at', null);
      $result = $builder->get();

      if (count($result->getResultArray())) {
         return true;
      } else {
         return false;
      }
   }
   public function eviter_double_save_paiement_bq($ref, $idpersonnel, $date)
   {
      $builder = $this->db->table('caisse');
      $builder->select('*');
      $builder->where('ref', $ref);
      $builder->where('mode', 1);
      $builder->where('date', $date);
      $builder->where('idpersonnel', $idpersonnel);
      $builder->where('delete_at', null);
      $result = $builder->get();

      if (count($result->getResultArray())) {
         return true;
      } else {
         return false;
      }
   }
   public function eviter_double_save_cheque_bq($ref, $date)
   {
      $builder = $this->db->table('caisse');
      $builder->select('*');
      $builder->where('ref', $ref);
      $builder->where('mode', 1);
      $builder->where('attent >', 0);
      $builder->where('date', $date);
      $builder->where('delete_at', null);
      $result = $builder->get();

      if (count($result->getResultArray())) {
         return true;
      } else {
         return false;
      }
   }
   public function eviter_double_save_paiement_fact($num_fact, $date)
   {
      $builder = $this->db->table('caisse');
      $builder->select('*');
      $builder->where('num_fact', $num_fact);
      $builder->where('date', $date);
      $builder->where('delete_at', null);
      $result = $builder->get();

      if (count($result->getResultArray())) {
         return true;
      } else {
         return false;
      }
   }
   public function eviter_double_save_paiement_cpt_clt($idcaisse, $date)
   {
      $builder = $this->db->table('compte_client');
      $builder->select('*');
      $builder->where('idcaisse', $idcaisse);
      $builder->where('date', $date);
      $builder->where('delete_at', null);
      $result = $builder->get();

      if (count($result->getResultArray())) {
         return true;
      } else {
         return false;
      }
   }
   public function eviter_double_save_depense($idpersonnel, $ref, $date)
   {
      $builder = $this->db->table('caisse');
      $builder->select('*');
      $builder->where('idpersonnel', $idpersonnel);
      $builder->where('ref', $ref);
      $builder->where('date', $date);
      $builder->where('delete_at', null);
      $result = $builder->get();

      if (count($result->getResultArray())) {
         return true;
      } else {
         return false;
      }
   }

   public function detail_sal($p, $anne)
   {
      $builder = $this->db->table('salaire');
      $builder->select('*');
      $builder->where('periode', $p);
      $builder->where('annee', $anne);
      $builder->where('delete_at', null);
      $result = $builder->get();
      return $result->getResult();
   }

   public function get_idpersonnel_byidavance($idavance)
   {
      $builder = $this->db->table('avance_sur_salaire');
      $builder->select('*'); // cest sa
      $builder->where('idavance', $idavance);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row->idpersonnel;
      }
   }




   //-------------------------------------
   // FIN TABLE PERSONNEL
   //-----------------------------------

   //-------------------------------------
   // TABLE PRODUIT
   //-----------------------------------

   public function get_nom_produit($idproduit)
   {
      $builder = $this->db->table('produit');
      $builder->select('*'); // cest sa
      $builder->where('idproduit', $idproduit);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row;
      }
   }
   public function ligne_reglement($idcompte)
   {
      $builder = $this->db->table('compte_client');
      $builder->select('*'); // cest sa
      $builder->where('idcompteclient', $idcompte);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row;
      }
   }
   public function get_idcategorie($idproduit)
   {
      $builder = $this->db->table('produit');
      $builder->select('*'); // cest sa
      $builder->where('idproduit', $idproduit);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row->idcategori;
      }
   }
   public function get_pointure($idcategori)
   {
      $builder = $this->db->table('categorie');
      $builder->select('*'); // cest sa
      $builder->where('idcategori', $idcategori);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row->cate;
      }
   }


   public function liste_produit()
   {
      $builder = $this->db->table('produit');
      $builder->select('*');
      $builder->where('delete_at', null);
      $result = $builder->get();
      return $result->getResult();
   }
   public function recherche_avance($d1, $d2)
   {
      $builder = $this->db->table('avance_sur_salaire');
      $builder->select('*');
      $builder->where('date >=', $d1);
      $builder->where('date <=', $d2);
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'ASC');
      $result = $builder->get();
      return $result->getResult();
   }



   public function solde_avance($idpersonnel)
   {
      $builder = $this->db->table('avance_sur_salaire');
      $builder->selectSum('montant');
      $builder->selectSum('payer');
      $builder->where('idpersonnel', $idpersonnel);
      $builder->groupBy('idpersonnel');
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row;
      }
   }
   public function rembours($idavance)
   {
      $builder = $this->db->table('avance_sur_salaire');
      $builder->select('*');
      $builder->where('idavance', $idavance);
      $builder->groupBy('idpersonnel');
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row;
      }
   }
   public function recep_for_pret()
   {
      $builder = $this->db->table('avance_sur_salaire');
      $builder->select('*');
      $builder->selectSum('montant');
      $builder->selectSum('payer');
      $builder->where('delete_at', null);
      $builder->groupBy('idpersonnel');
      $result = $builder->get();
      return $result->getResult();
   }








   //-------------------------------------
   // FIN TABLE PRODUIT 
   //-----------------------------------



   //-------------------------------------
   // TABLE CLIENT
   //-----------------------------------

   public function get_info_client($idclient)
   {
      $builder = $this->db->table('client');
      $builder->select('*'); // cest sa
      $builder->where('idclient', $idclient);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row;
      }
   }
   public function get_nom_client($idclient)
   {
      $builder = $this->db->table('client');
      $builder->select('*'); // cest sa
      $builder->where('idclient', $idclient);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row->nom;
      }
   }
   public function get_idclient($client)
   {
      $builder = $this->db->table('client');
      $builder->select('*'); // cest sa
      $builder->where('nom', $client);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row->idclient;
      }
   }








   //-------------------------------------
   // FIN TABLE CLIENT
   //-----------------------------------



   //-------------------------------------
   // TABLE FACTURE
   //-----------------------------------

   public function num_facture()
   {
      $builder = $this->db->table('corps');
      $builder->select('num_fact');
      $builder->where('type', 1);
      $builder->where('delete_at', null);
      $builder->orderBy('num_fact', 'DESC');
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row->num_fact;
      }
   }
   public function num_reglements()
   {
      $builder = $this->db->table('compte_client');
      $builder->select('numerotation');
      $builder->where('type', 2);
      $builder->where('delete_at', null);
      $builder->orderBy('numerotation', 'DESC');
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row->numerotation;
      }
   }
   public function num_facture_proforma()
   {
      $builder = $this->db->table('proforma');
      $builder->select('num_fact');
      $builder->where('delete_at', null);
      $builder->orderBy('num_fact', 'DESC');
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row->num_fact;
      }
   }
   public function num_production()
   {
      $builder = $this->db->table('corps');
      $builder->select('num_fact');
      $builder->where('type', 2);
      $builder->where('delete_at', null);
      $builder->orderBy('num_fact', 'DESC');
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row->num_fact;
      }
   }

   public function ligne_pied_proforma($num_fact)
   {
      $builder = $this->db->table('pied_proforma');
      $builder->select('*'); // cest sa
      $builder->where('num_fact', $num_fact);
      $builder->where('delete_at', null);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row;
      }
   }
   public function ligne_pied($num_fact)
   {
      $builder = $this->db->table('pied');
      $builder->select('*'); // cest sa
      $builder->where('num_fact', $num_fact);
      $builder->where('type', 1);
      $builder->where('delete_at', null);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row;
      }
   }
   public function ligne_pied_fsr($num_appro)
   {
      $builder = $this->db->table('piedmp');
      $builder->select('*'); // cest sa
      $builder->where('num_appro', $num_appro);
      $builder->where('delete_at', null);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row;
      }
   }
   public function ligne_pied_production($num_fact)
   {
      $builder = $this->db->table('pied');
      $builder->select('*'); // cest sa
      $builder->where('num_fact', $num_fact);
      $builder->where('type', 2);
      $builder->where('delete_at', null);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row;
      }
   }
   public function ligne_pied_byid($idpied)
   {
      $builder = $this->db->table('pied');
      $builder->select('*'); // cest sa
      $builder->where('idpied', $idpied);
      $builder->where('type', 2);
      $builder->where('delete_at', null);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row;
      }
   }


   public function info_liste_produit_corps($num)
   {
      $builder = $this->db->table('corps');
      $builder->select('*'); // cest sa
      $builder->where('num_fact', $num);
      $builder->where('type', 1);
      $builder->where('delete_at', null);
      $result = $builder->get();
      return $result->getResult();
   }
   public function getinfo_production($num)
   {
      $builder = $this->db->table('corps');
      $builder->select('*'); // cest sa
      $builder->where('num_fact', $num);
      $builder->where('type', 2);
      $builder->where('delete_at', null);
      $result = $builder->get();
      return $result->getResult();
   }
   public function getinfo_proforma($num)
   {
      $builder = $this->db->table('proforma');
      $builder->select('*'); // cest sa
      $builder->where('num_fact', $num);
      $builder->where('delete_at', null);
      $result = $builder->get();
      return $result->getResult();
   }
   public function calcul_somme_facture($num)
   {
      $builder = $this->db->table('corps');
      $builder->select('*'); // cest sa
      $builder->where('num_fact', $num);
      $builder->where('type', 1);
      $builder->where('delete_at', null);
      $result = $builder->get();
      return $result->getResult();
   }
   public function calcul_somme_proforma($num)
   {
      $builder = $this->db->table('proforma');
      $builder->select('*'); // cest sa
      $builder->where('num_fact', $num);
      $builder->where('delete_at', null);
      $result = $builder->get();
      return $result->getResult();
   }

   public function voir_stock($idproduit)
   {
      $builder = $this->db->table('corps');
      $builder->select('*');
      $builder->selectSum('qte');
      $builder->selectSum('qte_produit');
      $builder->selectSum('qte_gater');
      $builder->where('idproduit', $idproduit);
      $builder->where('delete_at', null);
      $builder->groupBy('date');
      //$builder->orderBy('date',"DESC"); 
      $result = $builder->get();
      return $result->getResult();
   }
   public function production_qte()
   {
      $builder = $this->db->table('corps');
      $builder->select('*');
      $builder->selectSum('qte_produit');
      $builder->selectSum('qte_gater');
      $builder->where('delete_at', null);
      $builder->where('equipe >', 0);
      $builder->where('mois', date("m"));
      $builder->where('anne', date("Y"));
      $builder->groupBy('date');
      $builder->groupBy('equipe');
      $builder->orderBy('date', "DESC");
      $result = $builder->get();
      return $result->getResult();
   }
   public function production_qte2($mois)
   {
      $builder = $this->db->table('corps');
      $builder->select('*');
      $builder->selectSum('qte_produit');
      $builder->selectSum('qte_gater');
      $builder->where('delete_at', null);
      $builder->where('equipe >', 0);
      $builder->where('mois', $mois);
      $builder->where('anne', date("Y"));
      $builder->groupBy('date');
      $builder->groupBy('equipe');
      $builder->orderBy('date', "DESC");
      $result = $builder->get();
      return $result->getResult();
   }
   public function production_qte3()
   {
      $builder = $this->db->table('corps');
      $builder->select('*');
      $builder->selectSum('qte_produit');
      $builder->selectSum('qte_gater');
      $builder->where('delete_at', null);
      $builder->where('equipe >', 0);
      $builder->where('anne', date("Y"));
      $builder->groupBy('date');
      $builder->groupBy('equipe');
      $builder->orderBy('date', "DESC");
      $result = $builder->get();
      return $result->getResult();
   }


   public function calcul_somme_production($num)
   {
      $builder = $this->db->table('corps');
      $builder->select('*'); // cest sa
      $builder->where('num_fact', $num);
      $builder->where('type', 2);
      $builder->where('delete_at', null);
      $result = $builder->get();
      return $result->getResult();
   }
   public function detail_du_jour($d, $m, $y)
   {
      $builder = $this->db->table('corps');
      $builder->select('*'); // cest sa
      $builder->where('jour', $d);
      $builder->where('mois', $m);
      $builder->where('anne', $y);
      $builder->where('equipe', 1);
      $builder->where('delete_at', null);
      $result = $builder->get();
      return $result->getResult();
   }

   public function depense_encours()
   {
      $builder = $this->db->table('caisse');
      $builder->select('*');
      $builder->where('sortie >', 0);
      $builder->where('mois', date("m"));
      $builder->where('anne', date("Y"));
      $builder->where('mode', 0);
      $builder->where('idbanque', 0);
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'DESC');
      $builder->orderBy('ref', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }
   public function depense_moisdernier($mois)
   {
      $builder = $this->db->table('caisse');
      $builder->select('*');
      $builder->where('sortie >', 0);
      $builder->where('mode', 0);
      $builder->where('mois', $mois);
      $builder->where('anne', date("Y"));
      $builder->where('idbanque', 0);
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'DESC');
      $builder->orderBy('ref', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }
   public function touts_depense()
   {
      $builder = $this->db->table('caisse');
      $builder->select('*');
      $builder->where('sortie >', 0);
      $builder->where('mode', 0);
      $builder->where('anne', date("Y"));
      $builder->where('idbanque', 0);
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'DESC');
      $builder->orderBy('ref', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }
   public function depense_encoursbg()
   {
      $builder = $this->db->table('caisse');
      $builder->select('*');
      $builder->where('sortie >', 0);
      $builder->where('mois', date("m"));
      $builder->where('anne', date("Y"));
      $builder->where('mode', 1);
      $builder->where('idbanque >', 0);
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'DESC');
      $builder->orderBy('ref', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }
   public function depense_moisdernierbg($mois)
   {
      $builder = $this->db->table('caisse');
      $builder->select('*');
      $builder->where('sortie >', 0);
      $builder->where('mode', 1);
      $builder->where('mois', $mois);
      $builder->where('anne', date("Y"));
      $builder->where('idbanque >', 0);
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'DESC');
      $builder->orderBy('ref', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }
   public function touts_depense_bq()
   {
      $builder = $this->db->table('caisse');
      $builder->select('*');
      $builder->where('sortie >', 0);
      $builder->where('mode', 1);
      $builder->where('anne', date("Y"));
      $builder->where('idbanque >', 0);
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'DESC');
      $builder->orderBy('ref', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }
   public function reglement_encour()
   {
      $builder = $this->db->table('compte_client');
      $builder->select('*');
      $builder->where('mois', date("m"));
      $builder->where('anne', date("Y"));
      $builder->where('reglement >', 0);
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'DESC');
      $builder->orderBy('numerotation', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }
   public function reglement_moisdernier($mois)
   {
      $builder = $this->db->table('compte_client');
      $builder->select('*');
      $builder->where('mois', $mois);
      $builder->where('anne', date("Y"));
      $builder->where('reglement >', 0);
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'DESC');
      $builder->orderBy('numerotation', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }
   public function detail_credit_client($idclient)
   {
      $builder = $this->db->table('compte_client');
      $builder->select('*');
      $builder->where('idclient', $idclient);
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'ASC');
      $builder->orderBy('numerotation', 'ASC');
      $result = $builder->get();
      return $result->getResult();
   }
   public function detail_credit_fsr($idfsr)
   {
      $builder = $this->db->table('compte_fsr');
      $builder->select('*');
      $builder->where('idfsr', $idfsr);
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'ASC');
      $builder->orderBy('num_op', 'ASC');
      $result = $builder->get();
      return $result->getResult();
   }
   public function tout_reglement()
   {
      $builder = $this->db->table('compte_client');
      $builder->select('*');
      $builder->where('anne', date("Y"));
      $builder->where('reglement >', 0);
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'DESC');
      $builder->orderBy('numerotation', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }

   public function production_encoure()
   {
      $builder = $this->db->table('pied');
      $builder->select('*');
      $builder->where('mois', date("m"));
      $builder->where('anne', date("Y"));
      $builder->where('type', 2);
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'DESC');
      $builder->orderBy('num_fact', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }
   public function production_moisdernier($mois)
   {
      $builder = $this->db->table('pied');
      $builder->select('*');
      $builder->where('mois', $mois);
      $builder->where('anne', date("Y"));
      $builder->where('type', 2);
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'DESC');
      $builder->orderBy('num_fact', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }
   public function production_tout()
   {
      $builder = $this->db->table('pied');
      $builder->select('*');
      $builder->where('anne', date("Y"));
      $builder->where('type', 2);
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'DESC');
      $builder->orderBy('num_fact', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }


   public function facture_no_valider()
   {
      $builder = $this->db->table('pied');
      $builder->select('*');
      $builder->where('type', 1);
      $builder->where('validation', 0);
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'DESC');
      $builder->orderBy('idpied', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }
   public function facture_encoure()
   {
      $builder = $this->db->table('pied');
      $builder->select('*');
      $builder->where('mois', date("m"));
      $builder->where('anne', date("Y"));
      $builder->where('type', 1);
      //$builder->where('validation',1); 
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'DESC');
      $builder->orderBy('idpied', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }
   public function facture_moisdernier($mois)
   {
      $builder = $this->db->table('pied');
      $builder->select('*');
      $builder->where('mois', $mois);
      $builder->where('anne', date("Y"));
      $builder->where('type', 1);
      //$builder->where('validation',1); 
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'DESC');
      $builder->orderBy('idpied', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }
   public function facture_tout()
   {
      $builder = $this->db->table('pied');
      $builder->select('*');
      $builder->where('anne', date("Y"));
      $builder->where('type', 1);
      $builder->where('delete_at', null);
      //$builder->where('validation',1); 
      $builder->orderBy('date', 'DESC');
      $builder->orderBy('idpied', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }
   public function facture_tout_pour_solde()
   {
      $builder = $this->db->table('pied');
      $builder->select('*');
      $builder->where('anne', date("Y"));
      $builder->where('type', 1);
      $builder->where('delete_at', null);
      $builder->where('validation', 1);
      $builder->orderBy('date', 'DESC');
      $builder->orderBy('idpied', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }
   public function rapor_encoure()
   {
      $builder = $this->db->table('rapport');
      $builder->select('*');
      $builder->where('mois', date("m"));
      $builder->where('anne', date("Y"));
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'DESC');
      $builder->orderBy('idrapport', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }

   public function rapor_moispasser($mois)
   {
      $builder = $this->db->table('rapport');
      $builder->select('*');
      $builder->where('mois', $mois);
      $builder->where('anne', date("Y"));
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'DESC');
      $builder->orderBy('idrapport', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }
   public function rapor_tout()
   {
      $builder = $this->db->table('rapport');
      $builder->select('*');
      //$builder->where('mois',$mois); 
      $builder->where('anne', date("Y"));
      $builder->where('delete_at', null);
      $builder->orderBy('date', 'DESC');
      $builder->orderBy('idrapport', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }







   //-------------------------------------
   // FIN TABLE CLIENT
   //-----------------------------------


   //-------------------------------------
   // TABLE APPRO
   //-----------------------------------

   public function num_appro()
   {
      $builder = $this->db->table('corps_mp');
      $builder->select('num_appro'); // cest sa
      $builder->where('delete_at', null);
      $builder->orderBy('num_appro', 'DESC');
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row->num_appro;
      }
   }

   public function mise_ajour_corps($num, $data)
   {
      $builder = $this->db->table('corps_mp');
      $builder->set($data);
      $builder->where('num_appro', $num);
      $builder->where('delete_at', null);
      $builder->update($data);
   }
   public function mise_ajour_corps_facture($num, $data)
   {
      $builder = $this->db->table('corps');
      $builder->set($data);
      $builder->where('num_fact', $num);
      $builder->where('type', 1);
      $builder->where('delete_at', null);
      $builder->update($data);
   }
   public function mise_ajour_corps_production($num, $data)
   {
      $builder = $this->db->table('corps');
      $builder->set($data);
      $builder->where('num_fact', $num);
      $builder->where('type', 2);
      $builder->where('delete_at', null);
      $builder->update($data);
   }
   public function mise_ajour_corps_defectueux($num, $data)
   {
      $builder = $this->db->table('corps');
      $builder->set($data);
      $builder->where('num_fact', $num);
      $builder->where('type', 3);
      $builder->where('delete_at', null);
      $builder->update($data);
   }
   public function annuler_facture($num)
   {
      $builder = $this->db->table('corps');
      $builder->where('num_fact', $num);
      $builder->where('type', 1);
      $builder->where('delete_at', null);
      $builder->delete();
   }
   public function annuler_production($num)
   {
      $builder = $this->db->table('corps');
      $builder->where('num_fact', $num);
      $builder->where('type', 2);
      $builder->where('delete_at', null);
      $builder->delete();
   }
   public function annuler_proforma($num)
   {
      $builder = $this->db->table('proforma');
      $builder->where('num_fact', $num);
      $builder->where('delete_at', null);
      $builder->delete();
   }
   public function annuler_defectueux($num)
   {
      $builder = $this->db->table('corps');
      $builder->where('num_fact', $num);
      $builder->where('type', 3);
      $builder->where('delete_at', null);
      $builder->delete();
   }
   public function assurance_pied($num)
   {
      $builder = $this->db->table('pied');
      $builder->where('num_fact', $num);
      $builder->where('type', 1);
      $builder->where('delete_at', null);
      $builder->delete();
   }
   public function assurance_pied_pro($num)
   {
      $builder = $this->db->table('pied_proforma');
      $builder->where('num_fact', $num);
      $builder->where('delete_at', null);
      $builder->delete();
   }

   public function total_facture_fsr($idfsr)
   {
      $builder = $this->db->table('piedmp');
      $builder->selectSum('montant');
      $builder->where('delete_at', null);
      $builder->where('idfsr', $idfsr);
      $builder->groupBy('idfsr');
      $result = $builder->get();

      return $result->getResult();
   }
   public function stockglobal()
   {
      $builder = $this->db->table('corps');
      $builder->select('*');
      $builder->selectSum('qte');
      $builder->selectSum('qte_produit');
      $builder->selectSum('qte_gater');
      $builder->where('delete_at', null);
      $builder->groupBy('idproduit');
      $result = $builder->get();
      return $result->getResult();
   }
   public function recap_du_jour()
   {
      $builder = $this->db->table('corps');
      $builder->select('*');
      $builder->selectSum('qte');
      $builder->selectSum('qte_produit');
      $builder->selectSum('qte_gater');
      $builder->where('mois', date('m'));
      $builder->where('delete_at', null);
      $builder->groupBy('date');
      $builder->orderBy('date', 'DESC');
      $result = $builder->get();
      return $result->getResult();
   }

   public function total_reglement_fsr($idfsr)
   {
      $builder = $this->db->table('compte_fsr');
      $builder->selectSum('reglement');
      $builder->where('delete_at', null);
      $builder->where('idfsr', $idfsr);
      $builder->groupBy('idfsr');
      $result = $builder->get();
      return $result->getResult();
   }

   public function get_piedmp_approvision_info($idpiedmp, $idfsr)
   {
      $builder = $this->db->table('piedmp');
      $builder->select('*');
      $builder->where('idpiedmp', $idpiedmp);
      $builder->where('idfsr', $idfsr);
      $builder->where('delete_at', null);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row;
      }
   }
   public function mise_ajour_corps_mp($idcorpsmp, $data)
   {
      $builder = $this->db->table('corps_mp');
      $builder->set($data);
      $builder->where('idcorpsmp', $idcorpsmp);
      $builder->where('delete_at', null);
      $builder->update($data);
   }
   public function get_info_corpsmp_by_idnum_appro($num)
   {
      $builder = $this->db->table('corps_mp');
      $builder->select('*'); // cest sa
      $builder->where('num_appro', $num);
      $builder->where('delete_at', null);
      $result = $builder->get();
      return $result->getResult();
   }
   public function get_nom_fournisseur($idfsr)
   {
      $builder = $this->db->table('fsr');
      $builder->select('*'); // cest sa
      $builder->where('idfsr', $idfsr);
      //$builder->where('delete_at',null);
      $result = $builder->get();
      foreach ($result->getResult() as $row) {
         return $row->nom;
      }
   }
   public function mise_ajour_piedmp($idpiedmp, $data)
   {
      $builder = $this->db->table('piedmp');
      $builder->set($data);
      $builder->where('idpiedmp', $idpiedmp);
      $builder->where('delete_at', null);
      $builder->update($data);
   }
   //-------------------------------------
   // FIN TABLE APPRO
   //-----------------------------------

   public function day_caisse($date)
   {
      $builder = $this->db->table('caisse');
      $builder->select('*');
      $builder->where('delete_at', null);
      $builder->where('date', $date);
      $builder->where('mode', 0);
      $result = $builder->get();
      return $result->getResult();
   }




















   public function mot($passe)
   {
      $h1 = "la_côte_dû";
      $h2 = "Je_tîam_125";
      $pa = md5($h1 . $passe . $h2);
      return $pa;
   }
   public function extraire_jour($date)
   {
      $dat = date_create($date);
      return date_format($dat, "d");
   }
   public  function extraire_mois($date)
   {
      $dat = date_create($date);
      return date_format($dat, "m");
   }
   public  function extraire_annee($date)
   {
      $dat = date_create($date);
      return date_format($dat, "Y");
   }

   public  function ladate($date)
   {
      $dat = date_create($date);
      return date_format($dat, "d-m-Y");
   }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MesfonctionModel;
use App\Models\PersonnelModel;
use App\Models\PersonneModel;
use App\Models\PosteModel;
use App\Models\ProfilModel;

class Personnel extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form', 'html']);
        $this->mesfonction = new MesfonctionModel();
        $this->session = session();
    }
    

    public function index()
    {
        $user_info = session()->get('user_info'); 
        $mail=$user_info['mail'];        
        
        if ($mail) {
            $data = ['user_info'=> $user_info]; 
            $personnel = new PersonnelModel();
            $profil = new ProfilModel();

            $idpersonne=$user_info['idpersonne'];
            $data['photo']=$profil->where('idpersonne',$idpersonne)->first();
            $data['personnels'] = $personnel->findAll();
            return view('personnel/liste_personnel',$data);     
        }else{
            return redirect()->to(site_url('Deconnected'));
        }                  
    }

    public function infoemployer($idemployer, $type)
    {
        $user_info = session()->get('user_info');
        $idpersonne = $user_info['idpersonne'];
        $mail = $user_info['mail'];
        $idemployer = (int)$idemployer;
        $type = $type;
        $data['type'] = $type;

        if ($mail) {
            $employer = new PersonnelModel();
            $profil = new ProfilModel();
            $poste = new PosteModel();

            $data = ['user_info' => $user_info];
            $data['photo'] = $profil->where('idpersonne', $idpersonne)->first();
            $data['fiche'] = $employer->find($idemployer);
            $data['idemployer'] = $idemployer;
            $data['validation'] = \Config\Services::validation();
            $data['postes'] = $poste->findAll();
            if ($type == "alter") {
                return view('personnel/personnel_edit', $data);
            } elseif ($type == "canceling") {
                return view('personnel/new_personnel_off', $data);
            }
        } else {
            return redirect()->to(site_url('Deconnected'));
        }
    }

    public function upateemployer()
    {

        $data = [];
        $user_info = session()->get('user_info');
        $mail = $user_info['mail'];


        if ($mail) {
            $data = ['user_info' => $user_info];
            $personne = new PersonneModel();
            $profil = new ProfilModel();
            $poste = new PosteModel();
            $employer = new PersonnelModel();

            $idpersonne = $user_info['idpersonne'];
            $data['photo'] = $profil->where('idpersonne', $idpersonne)->first();
            $data['validation'] = \Config\Services::validation();

            $isValid = $this->validate([
                'nom' => [
                    'rules' => 'trim|required|htmlspecialchars|alpha_space',
                    'errors' => [
                        'required' => " Le nom est obligatoire",
                        'alpha_space' => " Le nom est mal écrit",
                    ],
                ],
                'prenom' => [
                    'rules' => 'trim|required|htmlspecialchars|alpha_space',
                    'errors' => [
                        'required' => " Le prenom est obligatoire",
                        'alpha_space' => " Le prénom est mal écrit",
                    ],
                ],
                'fonction' => [
                    'rules' => 'trim|required|htmlspecialchars|alpha_space',
                    'errors' => [
                        'required' => " La fonction est obligatoire",
                        'alpha_space' => " La fonction est male écrite",
                    ],
                ],
                'tel' => [
                    'rules' => 'trim|required|htmlspecialchars|is_natural',
                    'errors' => [
                        'required' => " Le téléphone est obligatoire",
                        'is_natural' => " Veuillez bien écrire le numéro de téléphone",
                    ],
                ],
                'num_cont' => [
                    'rules' => 'trim|htmlspecialchars',
                    'errors' => [
                        //'required' =>" Le numero de compte est obligatoire",
                    ],
                ],
                'base' => [
                    'rules' => 'trim|required|htmlspecialchars',
                    'errors' => [
                        'required' => " Veuillez definir un salaire de base",
                        'is_natural' => " Veuillez bien écrire  le montant",
                    ],
                ],

            ]);
            if (!$isValid) {
                
                $idemployer = $this->request->getPost('idfiche');
                $data['fiche'] = $employer->find($idemployer);
                $data['postes'] = $poste->findAll();
                return view('personnel/personnel_edit', $data);
            } else {

                if ($this->request->getMethod() == 'post') {

                    $personnel = new PersonnelModel();

                    $nom = $this->request->getPost('nom');
                    $prenom = $this->request->getPost('prenom');
                    $tel = $this->request->getPost('tel');
                    $fonction = $this->request->getPost('fonction');
                    $num_compte = $this->request->getPost('num_cont');
                    $base = $this->request->getPost('base');
                    $idfiche = $this->request->getPost('idfiche');
                    $type = $this->request->getPost('type');

                    $datas = [

                        'nom' => $nom,
                        'prenom' => $prenom,
                        'tel' => $tel,
                        'fonction' => $fonction,
                        'num_compte' => $num_compte,

                    ];

                    $personnel->update($idfiche, $datas);

                    $this->session->setTempdata('sucess', "Les informations ont été modifiées avec succès!", 3);

                    return redirect()->to(site_url('Liste_personnel') . "?mise_a_jour=" . md5(1) . md5(2));
                } else {
                    session()->setFlashdata('sucess', 'Une erreur inattendue s\'est produit et les informations de cet utilisateur n\'ont pas été modifiées!');
                    return redirect()->to(site_url('Liste_personnel'));
                }
            }
        } else {
            return redirect()->to(site_url('Deconnected'));
        }
    }
    
   /* public function fiche_salaire()
    {
        $user_info = session()->get('user_info'); 
        $mail=$user_info['mail'];        
        
        if ($mail) {
            $data = ['user_info'=> $user_info]; 
            $personnel = new PersonnelModel();
            $profil = new ProfilModel();

            $idpersonne=$user_info['idpersonne'];
            $data['photo']=$profil->where('idpersonne',$idpersonne)->first();
            $data['lessalaires'] = $personnel->findAll();
            return view('personnel/fiche_de_salaire',$data);     
        }else{
            return redirect()->to(site_url('Deconnected'));
        }                  
    }*/

    public function fiche_salaire()
    {
        $user_info = session()->get('user_info');
        $mail = $user_info['mail'];

        if ($mail) {
            $data = ['user_info' => $user_info];

            $profil = new ProfilModel();
            $personnel = new PersonnelModel();

            $idpersonne = $user_info['idpersonne'];

            $data['photo'] = $profil->where('idpersonne', $idpersonne)->first();

            $data['lessalaires'] = $personnel->findAll();

            return view('personnel/fiche_de_salaire', $data);
        } else {
            return redirect()->to(site_url('Deconnected'));
        }
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use App\Models\MesfonctionModel;
use App\Models\ProfilModel;

class Client extends BaseController
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
            $client = new ClientModel();
            $profil = new ProfilModel();

            $idpersonne=$user_info['idpersonne'];
            $data['photo']=$profil->where('idpersonne',$idpersonne)->first();
            $data['clients'] = $client->findAll();
            return view('client/liste_client',$data);     
        }else{
            return redirect()->to(site_url('Deconnected'));
        }                  
    }

    public function newclient(){
        $user_info = session()->get('user_info'); 
        $mail=$user_info['mail'];        

        if ($mail) {
            $data = ['user_info'=> $user_info]; 
            $profil = new ProfilModel();

            $idpersonne=$user_info['idpersonne'];
            $data['photo']=$profil->where('idpersonne',$idpersonne)->first();
            $data['validation']= \Config\Services::validation();
            return view('client/newclient',$data);     
        }else{
            return redirect()->to(site_url('Deconnected'));
        } 
    }

    public function save_newclient()
    { 

        $data=[];
        $user_info = session()->get('user_info'); 
        $mail = $user_info['mail'];        

        if ($mail) {
            $data = ['user_info'=> $user_info]; 
            $profil = new ProfilModel();
            $idpersonne=$user_info['idpersonne'];
            $data['photo']=$profil->where('idpersonne',$idpersonne)->first(); 
            $data['validation']= \Config\Services::validation(); 

            
            $isValid = $this->validate([
                'nom' =>[
                'rules'=> 'trim|required|htmlspecialchars|is_unique[client.nom]',
                'errors'=>[
                    'required' =>" Le nom est  obligatoire",
                    'is_unique' =>" Ce nom existe déjà dans la base",
                ],
            ],
                'tel' =>[
                'rules'=> 'trim|required|htmlspecialchars',
                'errors'=>[
                    'required' =>" Le contact est obligatoire",
                ],
            ],
                'mail' =>[
                'rules'=> 'trim|htmlspecialchars',
                'errors'=>[
                    'required' =>" L'email est obligatoire",
                    'valid_email' =>" L'email est mal écrit",
                ],
            ],
           
        ]);

            if (!$isValid) {
               
                return view('client/newclient',$data);
            } else {

                if ($this->request->getMethod()=='post') {
                    $client= new ClientModel();
                    $nom = $this->request->getPost('nom');
                    $ste = $this->request->getPost('ste');
                    $mail = $this->request->getPost('mail');
                    $tel = $this->request->getPost('tel');

                    $trouver=count($client->where('nom',$nom)->findAll());
                    $datas = [   
                        'nom'=> $nom,
                        'tel'=>$tel,
                        'ste' => $ste,
                        'mail' => $mail,
                    ];
           
                    $client->save($datas);

                    session()->setFlashdata('sucess','Le client a été crée avec succès!');
                    return redirect()->to(site_url('Client'));                   
                } 
            } 
        }else{
            return redirect()->to(site_url('Deconnected'));
        }
    }

    public function infoclient($clt,$idclient)
    {   
        $user_info = session()->get('user_info'); 
        $idpersonne=$user_info['idpersonne'];
        $mail = $user_info['mail'];      

        $idclient = (int)$idclient;

        if ($mail) {

            $client = new ClientModel();
            $profil = new ProfilModel();

            $data = ['user_info'=> $user_info]; 
            $data['photo']=$profil->where('idpersonne',$idpersonne)->first();  
            $data['validation']= \Config\Services::validation();

            $data['client'] = $client->find($idclient);

            return view('client/newclient_editter', $data);
        }else{
            return redirect()->to(site_url('Deconnected'));
        }
    }

    public function  updateclient()
    {       
        if ($this->request->getMethod()=='post') {
            
            $client = new ClientModel();
            $nom = $this->request->getPost('nom');
            $mail = $this->request->getPost('mail');
            $tel = $this->request->getPost('tel');
            $ste = $this->request->getPost('ste');
            $idclient = $this->request->getPost('idclient');

            $datas = [   
                'nom'=> $nom,
                'mail'=> $mail,
                'tel' => $tel,
                'ste' => $ste,
            ];

            $client->update($idclient, $datas);
       
            session()->setFlashdata('sucess','Les informations de ce client a été modifié avec succès!');
            return redirect()->to(site_url('Client?Modification=').md5("ll").md5("5l"));

        }else{
            session()->setFlashdata('sucess','Une erreur inattendue s\'est produit et les informations de ce client n\'ont pas été modifiées!');
            return redirect()->to(site_url('Client'));
        }
    }











}

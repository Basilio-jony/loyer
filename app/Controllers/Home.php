<?php

namespace App\Controllers;

use App\Models\MesfonctionModel;
use App\Models\Sauvegare;
use Config\Services;
use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
    public $mesfonctionModel;
    public $session;
    use ResponseTrait;

    public function __construct()
    {
        helper(['url', 'form', 'html']);

        $this->mesfonction = new MesfonctionModel();
        $this->session = session();
    }

    public function index()
    {
        return view('index');
    }
    
    public function services()
    {
        return view('pages/service');
    }

    public function sobrees()
    {
        return view('site/sobree');
    }

    public function contactos()
    {
        return view('site/contactos');
    }

    public function terms()
    {
        return view('site/terms');
    }

    public function downloadTerms() //baixar os termos e condições
    {
        $filePath = WRITEPATH . '../public/termos_e_condições_CSA.pdf'; // Caminho do PDF no servidor

        // Verifica se o arquivo existe antes de tentar baixá-lo
        if (file_exists($filePath)) {
            return $this->response->download($filePath, null);
        } else {
            return $this->response->setStatusCode(404, 'Arquivo não encontrado.');
        }
    }

    public function downloadPolitics() //baixar politicas de privacidade
    {
        $filePath = WRITEPATH . '../public/Politica_de_privacidade.pdf'; // Caminho do PDF no servidor

        // Verifica se o arquivo existe antes de tentar baixá-lo
        if (file_exists($filePath)) {
            return $this->response->download($filePath, null);
        } else {
            return $this->response->setStatusCode(404, 'Arquivo não encontrado.');
        }
    }


    public function login()
    {
        $data['validation'] = \Config\Services::validation();

        return view('login', $data);
    }
    


    public function signine()
    {
        $data = [];

        $isValid = $this->validate([
            'username' => [
                'rules' => 'trim|required|htmlspecialchars|valid_email',
                'errors' => [
                    'required' => " L'email est obligatoire",
                    'valid_email' => " L'email est mal écrit",
                ],
            ],
            'passwd' => [
                'rules' => 'trim|required|htmlspecialchars',
                'errors' => [
                    'required' => " le mot de passe est obligatoire",
                ],
            ],

        ]);
        if (!$isValid) {
            $data['validation'] = \Config\Services::validation();
            return view('login', $data);
        } else {
            if ($this->request->getMethod() == 'post') {

                $saved = new Sauvegare();
                $mail = $this->request->getPost('username');
                $passe = $this->request->getPost('passwd');

                $userdata = $this->mesfonction->verification($mail);
                $mpasse = $this->mesfonction->mot($passe);
                //$nbre_facture_a_valider = $this->mesfonction->validation_facture();

                if ($userdata) {
                    if ($mpasse == $userdata['password']) {
                        if ($userdata['actif'] == 1) {

                            $datas = [
                                'date' => date("Y-m-d"),
                                'heureD' => date('H:i:s'),
                                'heureF' => "--",
                                'idpersonnel' => $userdata['idpersonnel']
                            ];
                            $saved->save($datas);


                            $this->session->set('user_info', $userdata);
                            // $this->session->set('nbre_facture_a_valider',$data);
                            return redirect()->to(site_url('Client' . "?action=" . md5(8)));
                        } else {
                            $this->session->setTempdata('passerror', 'Votre compte a été désactivé, veuillez contacter votre administrateur !', 3);
                            $data['validation'] = \Config\Services::validation();
                            return view('login', $data);
                        }
                    } else {
                        $this->session->setTempdata('passerror', 'Votre mail ou mot de passe est incorect, veuillez réésayer !', 3);
                        $data['validation'] = \Config\Services::validation();
                        return view('login', $data);
                    }
                } else {
                    $this->session->setTempdata('passerror', 'Votre mail ou mot de passe est incorect, veuillez réésayer !', 3);
                    $data['validation'] = \Config\Services::validation();
                    return view('login', $data);
                }
            }
        }
    }

    public function logoute()
    {
        $user_info = session()->get('user_info');
        $idpersonnel = $user_info['idpersonnel'];

        $saved = new Sauvegare();
        if (session()->has('user_info')) {

            $data = [
                'date' => date("Y-m-d"),
                'heureF' => date('H:i:s'),
                'heureD' => "--",
                'idpersonnel' => $idpersonnel,
            ];
            $saved->save($data);

            session()->remove('user_info');
            session()->setFlashdata('fail', 'vous vous êtes déconnecté');
            return redirect()->to('');
        }
    }

    public function logouted()
    {
        $user_info = session()->get('user_info');

        if (session()->has('user_info')) {

            session()->remove('user_info');
            session()->setFlashdata('fail', 'vous vous êtes déconnecté');
            return redirect()->to('');
        } else {
            session()->remove('user_info');
            session()->setFlashdata('fail', 'vous vous êtes déconnecté');
            return redirect()->to('');
        }
    }
}

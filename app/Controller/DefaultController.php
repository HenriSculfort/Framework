<?php

namespace Controller;

use \W\Controller\Controller;
use \app\Model\Users2Model;

class DefaultController extends Controller
{


    /**
	 * Page d'accueil par défaut
	 */
    public function home()
    {
        $firstname = 'Henri';
        $params = ['firstname' => $firstname];
        $this->show('default/home', $params );
    }  

   





}
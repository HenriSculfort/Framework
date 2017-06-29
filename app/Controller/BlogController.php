<?php

namespace Controller;

use \W\Controller\Controller;
use \app\Model\Users2Model;

class BlogController extends Controller{

    public function blogAdd(){


        $post = [];
        $errors = [];
        $addValid = false;


        if(isset($_SESSION['user']['id'])){
            if(!empty($_POST)){
                // $_POST est une superglobale => par default elle est FORCEMENT définit dans PHP
                // Si la superglobale n'est pas vide, quelqu'un à envoyé le formulaire POST 
                foreach($_POST as $key => $value){
                    $post[$key] = trim(strip_tags($value));
                    //Permet de nettoyer Les valeurs reçues dans le formulaire
                    //trim() => Supprime les espaces en début et fin de chaîne
                    //strip_tags => Supprime les balises HTML et PHP d'une chaîne
                    // Le tableau $post contiendra la valeurs saisies dans le formulaire mais nettoyer  
                }

                if(strlen($post['title']) < 3){
                    $errors[] = 'Votre title n\'est pas valide, minimum 3 caractères';
                }

                if(strlen($post['content']) < 25){
                    $errors[] = 'Votre contenu n\'est pas valide, minimum 25 caractères';
                }



                if(count($errors) === 0){

                    $data = [
                        'title'     => ucfirst($post['title']),
                        'content'   => $post['content'],
                        'idUser'    => $_SESSION['user']['id'],
                        'date'      => date('Y-m-d H:i:s'),

                    ];

                    $BlogModel = new \Model\BlogModel;
                    $insert = $BlogModel->insert($data); 
                    // Retourne false si il y a uen $errors ou alors les données insérées sous formes d'un array()
                    if(!empty($insert)){
                        $addValid = true;
                    }
                }
            }
        }else{
            $notShow = new Controller();
            $notShow->showNotFound();
        }

        // Dans la vue, les clés deviennent des variables
        $this->show('blog/blogAdd', ['post' => $post , 'addValid' => $addValid , 'errors' => $errors,]);
    }


    //    --------------------------------------------------------------------


    public function listArticle(){

        $BlogModel = new \Model\BlogModel;
        $findAll = $BlogModel->findJointure();

        $findArticles = ['findAll' => $findAll];


        if(isset($_GET['deco']))
        {
            $authModel = new \W\Security\AuthentificationModel;
            $authModel->logUserOut();
            $controller = new Controller;
            $controller->redirect('http://localhost/PHP/AxelPHP/frameWork/W/public/connexion/');
        }
        $this->show('blog/listArticle', $findArticles);
    }
}



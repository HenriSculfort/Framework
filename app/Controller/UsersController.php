<?php

namespace Controller;

use \W\Controller\Controller;
use \app\Model\Users2Model;

class UsersController extends Controller
{


    public function inscription()
    {
        $post = [];
        $errors = [];
        $formValid = false;
        $emailExist = false;
        $data = [];



        if(isset($_POST['email'])){
            $Users2Model = new \Model\Users2Model;
            $verifEmail = $Users2Model->emailExists($_POST['email']);
            if($verifEmail == false){

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

                    if(strlen($post['firstname']) < 2){
                        $errors[] = 'Votre prénom n\'est pas valide, minimum 2 caractères';
                    }

                    if(strlen($post['lastname']) < 2){
                        $errors[] = 'Votre nom n\'est pas valide, minimum 2 caractères';
                    }

                    if(strlen($post['username']) < 8){
                        $errors[] = 'Votre pseudo n\'est pas valide, minimum 8 caractères';
                    }

                    if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
                        $errors[] = 'Votre email n\'est pas valide';
                    }

                    if(strlen($post['password']) < 8){
                        $errors[] = 'Le mot de passe doit comporter au moins 8 caractères';	
                    }

                    if(count($errors) === 0){
                        $authModel = new \W\Security\AuthentificationModel;


                        $data = [
                            'firstname' => ucfirst($post['firstname']), // Ajoute une majuscule au prénom
                            'lastname'	=> strtoupper($post['lastname']), // Met le nom en majuscule
                            'username'	=> strtolower($post['username']), // Met le pseudo en minuscule
                            'email'		=> strtolower($post['email']),
                            'password'	=> $authModel->hashPassword($post['password']),
                        ];


                        $insert = $Users2Model->insert($data); // Retourne false si il y a uen $errors ou alors les données insérées sous formes d'un array()
                        if(!empty($insert)){
                            $formValid = true;
                        }


                    }
                }
            }else{
                $emailExist = true;
            }
        }
        // Dans la vue, les clés deviennent des variables
        $this->show('Users/inscription', [
            'formValid'     => $formValid,
            'errors'        => $errors,
            'emailExist'    => $emailExist,
            'post'          => $post,
        ]);
    }




    //    ---------------------------------------------------------------------

    public function list(){


        $Users2Model = new \Model\Users2Model;
        $findAll = $Users2Model->findAll();

        $findUser = ['findAll' => $findAll];

        $this->show('Users/list', $findUser);
    }


    //    ---------------------------------------------------------------------


    public function connexion(){

        $me_user = [];
        $session = [];
        $post = [];


        if(!empty($_POST)){

            foreach($_POST as $key => $value)
            {
                $post[$key] = trim(strip_tags($value));
            }

            $authModel = new \W\Security\AuthentificationModel;
            $id_user = $authModel->isValidLoginInfo($post['email'], $post['password']);
            if(!empty($id_user)){
                $Users2Model = new \Model\Users2Model;
                $me_user = $Users2Model->find($id_user);
                if(!empty($me_user)){
                    $authModel->logUserIn($me_user);
                    if(!empty($authModel->getLoggedUser())){
                        $this->flash('Vous êtes désormais connecté ! ', 'success');
                        $this->redirectToRoute('listArticle');
                    }
                }
            }else
            {
                $this->flash('Vos donnée de connexion sont incorrect ! ', 'danger');
            }
        }
        $this->show('Users/connexion', ['post' => $post, 'user' => $me_user, 'cleanUser' => $session]);
    }


    //    ---------------------------------------------------------------------




    public function logOut() {

        $logOut = new \W\Security\AuthentificationModel();
        $logOut->logUserOut();
        if(empty($this->getUser())){
            $this->flash('Vous avez été déconnecté avec succès', 'success');
            $this->redirectToRoute('connexion');

        } 

    }

}
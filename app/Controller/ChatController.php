<?php 

namespace Controller;

class ChatController extends \W\Controller\Controller
{

    /**
	 * Affichage du chat et du formulaire permettant d'envoyer un message
	 */
    public function chat()
    {
        if(!empty($this->getUser())){
            $this->show('chat/chat');
        }else{
            $this->showNotFound(); // Page 404 si pas connecté
        }
    }




    /**
	 * Valider un message et l'insérer en base
	 */
    public function addMessageAjax()
    {

        $post = [];
        $errors = [];
        $current_user = $this->getUser();
        if(isset($current_user)){


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


                if(strlen($post['message']) < 10){
                    $errors[] = 'Votre contenu n\'est pas valide, minimum 10 caractères';
                }



                if(count($errors) === 0){

                    $data = [
                        'id_user'           => $current_user['id'],
                        'message'           => $post['message'],
                        'date_publish'      => date('c'),

                    ];

                    $ChatModel = new \Model\ChatModel;
                    $insert = $ChatModel->insert($data); 
                    // Retourne false si il y a uen $errors ou alors les données insérées sous formes d'un array()
                    if(!empty($insert)){
                        $json = [
                            'result' => true,
                        ];
                    }
                    else {
                        $json = [
                            'result' => false,
                            'message' => 'Une erreur est survenue lors de la sauvegarde de votre message',
                        ];
                    }
                }
                else {
                    $json = [
                        'result' => false,
                        'errors' => implode('<br>', $errors),
                    ];
                }
            }
            $this->showJson($json);
        }else{
            $this->showNotFound();
        }
    }



    /**
	 * Récupération de tous les messages existants en base
	 */
    public function listMessagesAjax()
    {


        $ChatModel = new \Model\ChatModel;
        //        $ChatMessages = $ChatModel->findAll('date_publish', 'DESC'); 
        $ChatMessages = $ChatModel->findJointure();


        $html = '<ul>';

        foreach($ChatMessages as $msg){
            $html.= '<li><strong>'.$msg['firstname'].'</strong> ('.$msg['date_publish'].') : '.$msg['message'].'</li>';
        }
        $html.='</ul>';


        $this->showJson($html);
    }

}
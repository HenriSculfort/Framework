<?php 

namespace Model;

use \W\Model\Model;

class ChatModel extends Model
{

    public function findJointure() // Read
    {
        // Le mot clé "AS" permet de "renomer" (temporairement) la table. Pour accéder aux colonnes, il faudra donc utiliser l'alias et non le nom de la table.  
        $sql = 'SELECT * FROM '.$this->table.' INNER JOIN users ON '.$this->table.'.id_user = users.id ORDER BY date_publish asc ';
        $select = $this->dbh->prepare($sql);

        if($select->execute()){
            return $select->fetchAll(); // Retournera un tableau avec les données correspondantes trouvées
        }
        return false; 
    }

}
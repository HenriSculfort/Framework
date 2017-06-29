<?php 

namespace Model;

use \W\Model\Model;

class BlogModel extends Model
{

    
   public function findJointure() // Read
	{
		// On vérifie que l'id soit bien numérique
			$select = $this->dbh->prepare('SELECT * FROM '.$this->table.' INNER JOIN users ON '.$this->table.'.idUser = users.id ');

			if($select->execute()){
				return $select->fetchAll(); // Retournera un tableau avec les données correspondantes trouvées
			}
		}

	}

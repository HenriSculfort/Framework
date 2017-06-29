<?php session_start(); ?>
<?php $this->layout('layout', ['title' => 'Liste des articles']) ?>

<?php $this->start('main_content') ?>

<h1>Coucou</h1>

<?php 
    //var_dump($findAll); 
?>
<table>
    <tr>
        <th>Titre</th>
        <th>Contenu</th>
        <th>Auteur</th>
        
    </tr>
    <?php foreach($findAll as $findAlls){ ?>
    <tr>
        <td><?php echo $findAlls['title'] ?></td>
        <td><?php echo $findAlls['content'] ?></td>
        <td><?php echo $findAlls['firstname'].' '.$findAlls['lastname'] ?></td>


    </tr>
    <?php } // end foreach -- $findAlls ?>
</table>

<br> <a href="../blog/"> Ajout articles</a>



<?php $this->stop('main_content') ?>
<?php $this->layout('layout', ['title' => 'Liste']) ?>

<?php $this->start('main_content') ?>

<h1>Coucou</h1>

<?php 
    //var_dump($findAll); 
?>
<table>
    <tr>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Pseudo</th>
        <th>Email</th>
    </tr>
    <?php foreach($findAll as $findAlls){ ?>
    <tr>
        <td><?php echo $findAlls['firstname'] ?></td>
        <td><?php echo $findAlls['lastname'] ?></td>
        <td><?php echo $findAlls['username'] ?></td>
        <td><?php echo $findAlls['email'] ?></td>


    </tr>
    <?php } // end foreach -- $findAlls ?>
</table>


<?php $this->stop('main_content') ?>

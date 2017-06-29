<?php  session_start();?>
<?php $this->layout('layout', ['title' => 'Connexion']) ?>


<?php $this->start('main_content') ?>

<form method="POST">
    <h3>Connexion</h3>

    <label for="email">Email</label>
    <input type="text" id="email" name="email" value="<?php if(isset($post['email'])){echo $post['email']; } ?>">

    <label for="password">Mdp</label>
    <input type="text" id="password" name="password">

    <button type="submit">GO ! </button>

</form>

<?php 
//var_dump($user);
//var_dump($cleanUser);
?>

<?php $this->stop('main_content') ?>

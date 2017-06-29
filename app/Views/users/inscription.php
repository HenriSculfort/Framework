<?php $this->layout('layout', ['title' => 'Inscription']) ?>

<?php $this->start('main_content') ?>
<h2>NTM</h2>

<?php if($emailExist == true){ echo 'Cette email exist déjà ! ';} ?>
<?php if($formValid == true){ echo 'Félicitation vous avez bien été enregistré';} ?>
<?php if(!empty($errors)){ echo implode('<br>', $errors);} ?>

<form method="POST">
    <label for="firstname">Prénom</label>
    <input type="text" id="firstname" name="firstname" value="<?php if(isset($post['firstname'])){echo $post['firstname']; } ?>">

    <label for="lastname">Nom</label>
    <input type="text" id="lastname" name="lastname" value="<?php if(isset($post['lastname'])){echo $post['lastname']; } ?>">

    <label for="username">Pseudo</label>
    <input type="text" id="username" name="username" value="<?php if(isset($post['username'])){echo $post['username']; } ?>">

    <label for="email">Email</label>
    <input type="text" id="email" name="email" value="<?php if(isset($post['email'])){echo $post['email']; } ?>">

    <label for="password">MDP</label>
    <input type="text" id="password" name="password" >

    <button type="submit">GO !!</button>
</form>


<?php $this->stop('main_content') ?>

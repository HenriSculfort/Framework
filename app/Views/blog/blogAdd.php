<?php  session_start();?>
<?php $this->layout('layout', ['title' => 'Ajout articles']) ?>

<?php $this->start('main_content') ?>
<h1>Ajout articles </h1>

<?php if($addValid == true){ echo 'Félicitation votre article a bien été enregistré';} ?>
<?php if(!empty($errors)){ echo implode('<br>', $errors);} ?>

<form method="POST">

    <label for="title">Titre</label>
    <input type="text" id="title" name="title" value="<?php if(isset($post['title'])){echo $post['title']; } ?>" >

    <label for="content">Contenu</label>
    <textarea name="content" id="content" cols="30" rows="10" ><?php if(isset($post['content'])){echo $post['content']; } ?></textarea>

    <button type="submit"> GO ! </button>

</form>
<?php 
//echo $_SESSION['user']['id']; 
?>

<br> <a href="../viewBlog/"> Liste articles</a>
<br> <a href="../chat/"> Chat</a>

<?php $this->stop('main_content') ?>

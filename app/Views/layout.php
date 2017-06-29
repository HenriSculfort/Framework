<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title><?= $this->e($title) ?></title>
        

        <link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">

    </head>
    <body>


        <div class="container">
            <header>
                <h1>W :: <?= $this->e($title) ?></h1>
                <?php if(!empty($w_flash_message)){ ?>
                <div> <?php echo $w_flash_message->message; ?></div>
                <?php } ?>
            </header>

            <section>
                <?= $this->section('main_content') ?>
            </section>
            <?php if(!empty($w_user)) { ?>
            <br>
            <a href="<?=$this->url('user_logout');?>">Déconnexion</a> 
            <?php };?>

            <footer>
            </footer>
        </div>
        
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <?= $this->section('script') ?>

        
          
    </body>
</html>
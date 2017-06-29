<?php $this->layout('layout', ['title' => 'Chat']) ?>
<?php $this->start('main_content') ?>

<h2>Messagerie instantanné</h2>

<div id="chatMessages"></div>

<form method="POST">
    <h4>Message à transmettre !  </h4>

    <label for="message">Message</label>
    <textarea name="message" id="message" cols="30" rows="10"></textarea>
    <button id="submitMessage" type="submit">GO ! </button>
</form>

<div id="ErrorsAjax"></div>

<?php $this->stop('main_content') ?>

<?php $this->start('script') ?>
<script>


    function getMessages()
    {
        $.getJSON('<?=$this->url('chat_list');?>', function(htmlMessages){

            $('#chatMessages').html(htmlMessages);
        });
    };

    $(document).ready(function(){
        getMessages();

        $('#submitMessage').on('click', function(e){

            e.preventDefault();
            $.ajax({
                url: '<?=$this->url('chat_add'); ?>',
                type: 'POST',
                data: $('form').serialize(),
                dataType: 'json',
                success: function(retour){
                    if(retour.result == true){
                        // On recharge les messages
                        getMessages();
                        $('#message').val('');
                        $('#ErrorsAjax').text('');
                    }
                    else if(retour.result == false) {
                        // On affiche l'erreur
                        $('#ErrorsAjax').html('<div class="alert alert-success">'+retour.errors+'</div>');

                    }
                }
            }); // fermeteur $.ajax
        });
    });
</script>

<?php $this->stop('script') ?>




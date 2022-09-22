<?php $this->extend('Layout/main'); ?>

<!-- section title start -->
<?php $this->section('title'); ?>
<?php echo $title; ?>
<?php $this->endSection(); ?>
<!-- section title end -->

<!-- section styles start -->
<?php $this->section('styles'); ?>

<?php $this->endSection(); ?>
<!-- section styles end -->

<!-- content start -->
<?php $this->section('content'); ?>

<div class="">
  <div class="col-lg-12">
    <div class="block">

      <div id="response">

      </div>

      <?php echo form_open('/', ['id' => 'form'], ['id' => "$user->id"]); ?>


      <?php echo $this->include('Users/_form'); ?>


      <div class="block-body">
        <div class="form-group mt-5 mb-2">
          <input type="submit" id="btn-save" value="Salvar alterações" class="btn btn-danger mr-2">
          <a href="<?php echo site_url("users/show/$user->id"); ?>" class="btn btn-secondary ml-2">Cancelar</a>
        </div>
      </div>

      <?php echo form_close(); ?>


    </div> <!-- block -->
  </div>
</div>

<?php $this->endSection(); ?>
<!-- content end -->

<!-- script start -->
<?php $this->section('scripts'); ?>

<script>
  $(document).ready(function() {
    $('#form').on('submit', function(e) {
      e.preventDefault();

      $.ajax({
        type: 'POST',
        url: '<?php echo site_url('users/update'); ?>',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
          $('#response').html('')
          $('#btn-save').val('Salvando...')
        },
        success: function(response) {
          $('#btn-save').val('Salvar alterações')
          $('#btn-save').removeAttr('disabled')
          $('[name=csrf_ordem]').val(response.token)

          if (!response.erro) {

            if (response.info) {
              $('#response').html('<div class="alert alert-info">' + response.info + '</div>')
            } else {
              // tudo certo com a atualização do usuário, podemos redirecioná-lo tranquilamente
              window.location.href = "<?php echo site_url("users/show/$user->id") ?>"
            }

          } else {
            $('#response').html('<div class="alert alert-danger">' + response.erro + '</div>')

            if (response.errors_model) {
              $.each(response.errors_model, function(key, value) {
                $('#response').append('<div class="alert alert-danger"><ul class="list-unstyled"><li class="text-danger">' + value + '</li></ul></div>')
              })
            }

          }

        },
        error: function() {
          alert('Não foi possível processar a solicitação. Por favor, entre em contato com o suporte técnico.')
          $('#btn-save').val('Salvar alterações')
          $('#btn-save').removeAttr('disabled')
        }
      });
    })

    $('#form').submit(function() {
      $(this).find(":submit").attr('disabled', 'disabled')
    })
  });
</script>

<?php $this->endSection(); ?>
<!-- script end -->
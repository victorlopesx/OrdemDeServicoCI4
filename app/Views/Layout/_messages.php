<?php if (session()->has('success')) : ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong><?php echo session('success'); ?></strong>
    <button type="button" data-dismiss="alert" aria-label="Close" class="close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php endif; ?>

<?php if (session()->has('info')) : ?>
  <div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong><?php echo session('info'); ?></strong>
    <button type="button" data-dismiss="alert" aria-label="Close" class="close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php endif; ?>

<?php if (session()->has('error')) : ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong><?php echo session('error'); ?></strong>
    <button type="button" data-dismiss="alert" aria-label="Close" class="close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php endif; ?>

<?php if (session()->has('errors_model')) : ?>
  <ul>
    <?php foreach ($erros_model as $error) : ?>
      <li class="text-danger"><?php echo $error; ?></li>
    <?php endforeach ?>
  </ul>
<?php endif; ?>
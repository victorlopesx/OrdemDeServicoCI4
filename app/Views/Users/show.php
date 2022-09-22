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
  <div class="col-lg-4">
    <div class="block">

      <div class="text-center">
        <?php echo esc($user->name); ?>
        <br />
        <a href="https://wa.me/55<?php echo $user->phoneNumber; ?>?text=Olá,%20<?php echo esc($user->name);?>!%20Somos%20da%20Eletrônica" target="_blank"><?php echo $user->phoneNumber; ?></a>
        <div class="card-text"><?php echo ($user->active == true ? 'Usuário Ativo' : 'Usuário Inativo'); ?></div>
        <?php if ($user->avatar == null) : ?>
          <img src="<?php echo site_url('assets/img/userAvatarDefault.png'); ?>" alt="Usuário sem avatar" class="card-img-top" style="width: 90%;">

        <?php else : ?>
          <img src="<?php echo site_url("users/img/$user->avatar"); ?>" alt="<?php echo esc($user->name); ?>" class="card-img-top" style="width: 90%;">
        <?php endif; ?>

        <a href="<?php echo site_url("users/avatar/$user->id"); ?>" class="btn btn-outline-primary btn-sm mt-2">Alterar avatar</a>
      </div>

      <hr class="border-secondary" />

      <p class="card-text">Criado em: <?php echo $user->created_at->humanize(); ?></p>
      <p class="card-text">Atualizado em: <?php echo $user->created_at->humanize(); ?></p>

      <div class="btn-group">
        <div class="dropdown show">
          <a class="btn btn-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Ações
          </a>

          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="<?php echo site_url("users/edit/$user->id") ?>">Editar usuário</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Excluir</a>
          </div>
        </div>

        <a href="<?php echo site_url('users') ?>" class="btn btn-secondary ml-3">Voltar</a>
      </div>



    </div> <!-- block -->
  </div>
</div>

<?php $this->endSection(); ?>
<!-- content end -->

<!-- script start -->
<?php $this->section('scripts'); ?>

<?php $this->endSection(); ?>
<!-- script end -->
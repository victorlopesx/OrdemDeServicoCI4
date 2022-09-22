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
  <h1>Conteúdo renderizado a partir do Home/index, utilizando o Layout/main.</h1>
<?php $this->endSection(); ?>
<!-- content end -->

<!-- script start -->
<?php $this->section('scripts'); ?>
  
<?php $this->endSection(); ?>
<!-- script end -->
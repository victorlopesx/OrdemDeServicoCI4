<?php $this->extend('Layout/main'); ?>

<!-- section title start -->
<?php $this->section('title'); ?>
<?php echo $title; ?>
<?php $this->endSection(); ?>
<!-- section title end -->

<!-- section styles start -->
<?php $this->section('styles'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.css" />
<?php $this->endSection(); ?>
<!-- section styles end -->

<!-- content start -->
<?php $this->section('content'); ?>
<div class="">
  <div class="col-lg-12">
    <div class="block">

    <a href="<?php echo site_url('users/create'); ?>" class="btn btn-danger mb-5">Criar novo usuário</a>

      <div class="title"><strong>Usuários do Sistema</strong></div>
      <div class="table-responsive">
        <table id="ajaxTable" class="table table-striped table-sm" style="width: 100%;">
          <thead>
            <tr>
              <th>Avatar</th>
              <th>Nome</th>
              <th>Email</th>
              <th>Status</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $this->endSection(); ?>
<!-- content end -->

<!-- script start -->
<?php $this->section('scripts'); ?>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#ajaxTable').DataTable({
      ajax: '<?php echo site_url('users/printUsers'); ?>',
      columns: [{
          data: 'avatar'
        },
        {
          data: 'name'
        },
        {
          data: 'email'
        },
        {
          data: 'active'
        },
      ],
      deferRender: true,
      processing: true,
      language: {
        lengthMenu: 'Exibir _MENU_ usuários por página',
        zeroRecords: 'Nada encontrado - desculpe',
        info: 'Página _PAGE_ de _PAGES_',
        infoEmpty: 'Não há registros disponíveis',
        infoFiltered: '(filtrado de _MAX_ registros totais)',
        sInfoPostFix: '',
        sInfoThousands: '.',
        sLengthMenu: '_MENU_ resultados por página',
        sLoadingRecords: 'Carregando...',
        sProcessing: 'Processando...',
        sZeroRecords: 'Nenhum registro encontrado',
        sSearch: 'Pesquisar',
        oPaginate: {
          sNext: 'Próximo',
          sPrevious: 'Anterior',
          sFirst: 'Primeiro',
          sLast: 'Último',
        },
      },
      responsive: true,
      pagingType: $(window).width() < 768 ? 'simple' : 'simple_numbers',
    });
  });
</script>
<?php $this->endSection(); ?>
<!-- script end -->
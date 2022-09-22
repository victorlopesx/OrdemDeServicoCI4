<div class="block-body">

  <div class="form-group row">
    <label class="col-sm-3 form-control-label">Nome completo</label>
    <div class="col-sm-9">
      <input type="text" name="name" placeholder="Insira o nome completo" class="form-control" value="<?php echo esc($user->name); ?>">
    </div>
  </div>

  <div class="line"></div>
  <div class="form-group row">
    <label for="" class="col-sm-3 form-control-label">Telefone</label>
    <div class="col-sm-9">
      <input type="number" name="phoneNumber" class="form-control" placeholder="Insira o telefone" value="<?php echo $user->phoneNumber;?>">
    </div>
  </div>

  <div class="line"></div>
  <div class="form-group row">
    <label for="" class="col-sm-3 form-control-label">Email</label>
    <div class="col-sm-9">
      <input type="email" name="email" class="form-control" placeholder="Insira o email" value="<?php echo esc($user->email); ?>">
    </div>
  </div>

  <div class="line"></div>
  <div class="form-group row">
    <label for="" class="col-sm-3 form-control-label">Senha</label>
    <div class="col-sm-9">
      <input type="password" name="password" id="" placeholder="Insira a senha de acesso" class="form-control">
    </div>
  </div>

  <div class="line"></div>
  <div class="form-group row">
    <label for="" class="col-sm-3 form-control-label">Confirme a senha</label>
    <div class="col-sm-9">
      <input type="password" name="password_confirmation" id="" placeholder="Confirme a senha de acesso" class="form-control">
    </div>
  </div>

  <div class="line"></div>
  <div class="form-group row">
    <label for="" class="col-sm-3 form-control-label">Status</label>
    <div class="col-sm-9">
      <div class="i-checks">
        <input type="hidden" name="active" value="0">
        <input type="checkbox" name="active" id="active" value="1" class="checkbox-template" <?php if($user->active == true) : ?> checked <?php endif; ?>>
        <label for="active">Ativo</label>
      </div>
    </div>
  </div>

</div>
<h1><?= esc($title) ?></h1>

<?php 
  $validation = \Config\Services::validation(); 
  $session = \Config\Services::session(); 
?>

<?php if (isset($_SESSION['success'])):?>
    <div class="alert alert-success" role="alert">
        <?= $_SESSION['success']; ?>
    </div>
<?php endif;?>

<form action="<?php echo base_url('/validate'); ?>" method="post" accept-charset="utf-8">
  <div class="form-group">
    <label>Jméno</label>
    <input type="text" name="username" class="form-control">

    <!-- Error -->
    <?php if ($validation->getError('username')) { ?>
      <div class='alert alert-danger mt-2'>
        <?= $error = $validation->getError('username'); ?>
      </div>
    <?php } ?>
  </div>
  <br>

  <div class="form-group">
    <label>E-mail</label>
    <input type="text" name="email" class="form-control">

    <!-- Error -->
    <?php if ($validation->getError('email')) { ?>
      <div class='alert alert-danger mt-2'>
        <?= $error = $validation->getError('email'); ?>
      </div>
    <?php } ?>
  </div>
  <br>

  <div class="form-group">
    <label>Heslo</label>
    <input type="password" name="password" class="form-control">

    <!-- Error -->
    <?php if ($validation->getError('password')) { ?>
      <div class='alert alert-danger mt-2'>
        <?= $error = $validation->getError('password'); ?>
      </div>
    <?php } ?>
  </div>
  <br>

  <div class="form-group">
    <label>Věk</label>
    <input type="number" min="0" name="age" class="form-control">

    <!-- Error -->
    <?php if ($validation->getError('age')) { ?>
      <div class='alert alert-danger mt-2'>
        <?= $error = $validation->getError('age'); ?>
      </div>
    <?php } ?>
  </div>
  <br>

  <div class="form-group mb-3">
    <label>Role</label>
        <br>
        <select class="custom-select" id="roles" name="role">
            <option selected>Vybrat roli</option>
            <?php foreach($roles as $role){ ?>
            <option value="<?php echo $role->id;?>"><?php echo $role->name;?></option>
            <?php } ?>
        </select>
    <?php if ($validation->getError('role')) { ?>
      <div class='alert alert-danger mt-2'>
        <?= $error = $validation->getError('role'); ?>
      </div>
    <?php } ?>
  </div>

  <div class="form-group">
    <button type="submit" class="btn btn-secondary btn-lg">Odeslat</button>
  </div>
</form>
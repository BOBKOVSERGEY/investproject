<div class="container">
  <h1 class="mt-4 mb-3"><?php echo $title; ?></h1>
  <div class="row">
    <div class="col-lg-8 mb-4">
      <form action="/account/profile" method="post">
        <div class="control-group form-group">
          <div class="controls">
            <label>Логин:</label>
            <input type="text" class="form-control" name="login" value="<?php echo $_SESSION['account']['login']; ?>" disabled>
            <p class="help-block"></p>
          </div>
        </div>
        <div class="control-group form-group">
          <div class="controls">
            <label>Email:</label>
            <input type="email" class="form-control" name="email" value="<?php echo $_SESSION['account']['email']; ?>">
            <p class="help-block"></p>
          </div>
        </div>
        <div class="control-group form-group">
          <div class="controls">
            <label>Номер кошелька:</label>
            <input type="text" class="form-control" name="wallet" value="<?php echo $_SESSION['account']['wallet']; ?>">
          </div>
        </div>
        <div class="control-group form-group">
          <div class="controls">
            <label>Новый пароль для входа</label>
            <input type="password" class="form-control" name="password">
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
      </form>
    </div>
  </div>
</div>
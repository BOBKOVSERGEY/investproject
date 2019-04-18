<div class="container">
  <h1 class="mt-4 mb-3"><?php echo $title; ?></h1>
  <div class="row">
    <div class="col-lg-8 mb-4">
      <!--<div class="card mb-4 shadow-sm">
        <div class="card-header">
          <h4 class="my-0 font-weight-normal"><?php echo $tariff['title']; ?></h4>
        </div>
        <div class="card-body">
          <h1 class="card-title pricing-card-title"><?php echo $tariff['percent']; ?> <small class="text-muted">%</small></h1>
          <ul class="list-unstyled mt-3 mb-4">
            <li><?php echo $tariff['description']; ?></li>
          </ul>
          <ul class="list-group list-group-flush mb-4">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Минимальная инвестиция
              <span class="badge badge-primary badge-pill">$<?php echo $tariff['min']; ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Максимальная инвестиция
              <span class="badge badge-primary badge-pill">$<?php echo $tariff['max']; ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Период инвестиции
              <span class="badge badge-primary badge-pill"><?php echo $tariff['hour']; ?> ч.</span>
            </li>
          </ul>
          <?php if (isset($_SESSION['account']['id'])) { ?>
            <a href="/dashboard/invest/<?php echo $key; ?>" class="btn btn-lg btn-block btn-outline-primary">Инвестировать</a>
          <?php } else { ?>
            <a href="/account/login" class="btn btn-lg btn-block btn-outline-primary">Авторизуйтесь</a>
          <?php } ?>

        </div>
      </div>-->
      <form action="https://perfectmoney.is/api/step1.asp" method="post" target="_blank" id="no_ajax">
        <div class="control-group form-group">
          <div class="controls">
            <label>Название тарифа:</label>
            <input type="text" class="form-control" value="<?php echo $tariff['title']; ?>" disabled>
          </div>
        </div>
        <div class="control-group form-group">
          <div class="controls">
            <label>Период инвестиции:</label>
            <input type="text" class="form-control" value="<?php echo $tariff['hour']; ?> ч." disabled>
          </div>
        </div>
        <div class="control-group form-group">
          <div class="controls">
            <label>Процентная ставка:</label>
            <input type="text" class="form-control" value="<?php echo $tariff['percent']; ?> %" disabled>
          </div>
        </div>
        <input type="hidden" name="PAYEE_ACCOUNT" value="Кошелек получателя">
        <input type="hidden" name="PAYEE_NAME" value="Оплата тарифа # <?php echo $this->route['id']; ?>">
        <div class="control-group form-group">
          <div class="controls">
            <label>Сумма:</label>
            <input type="number" min="<?php echo $tariff['min']; ?>" max="<?php echo $tariff['max']; ?>" class="form-control" value="<?php echo $tariff['min']; ?>" name="PAYMENT_AMOUNT">
          </div>
        </div>
        <input type="hidden" name="PAYMENT_UNITS" value="USD">
        <input type="hidden" name="PAYMENT_ID" value="<?php echo $this->route['id'].','.$_SESSION['account']['id']; ?>">
        <input type="hidden" name="STATUS_URL" value="<?php echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST']; ?>/merchant/perfectmoney">
        <input type="hidden" name="PAYMENT_URL" value="<?php echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST']; ?>/account/profile">
        <input type="hidden" name="PAYMENT_URL_METHOD" value="LINK">
        <input type="hidden" name="NOPAYMENT_URL" value="<?php echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST']; ?>/account/profile">
        <input type="hidden" name="NOPAYMENT_URL_METHOD" value="LINK">
        <button type="sumbit" class="btn btn-primary">Перейти к оплате</button>
      </form>
    </div>
  </div>
</div>
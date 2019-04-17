<div class="container">
  <h1 class="mt-4 mb-3"><?php echo $title; ?></h1>
  <div class="row">
    <div class="col-lg-8 mb-4">
      <div class="card mb-4 shadow-sm">
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
      </div>
    </div>
  </div>
</div>
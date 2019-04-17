<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Тарифы</h1>
  <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
</div>
<div class="container">
  <div class="row">
    <?php foreach ($tariffs as $key => $tariff) {?>
      <div class="col-md-4">
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
      <!--<div class="card mb-4 shadow-sm">
        <div class="card-header">
          <h4 class="my-0 font-weight-normal">Pro</h4>
        </div>
        <div class="card-body">
          <h1 class="card-title pricing-card-title">$15 <small class="text-muted">/ mo</small></h1>
          <ul class="list-unstyled mt-3 mb-4">
            <li>20 users included</li>
            <li>10 GB of storage</li>
            <li>Priority email support</li>
            <li>Help center access</li>
          </ul>
          <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button>
        </div>
      </div>
      <div class="card mb-4 shadow-sm">
        <div class="card-header">
          <h4 class="my-0 font-weight-normal">Enterprise</h4>
        </div>
        <div class="card-body">
          <h1 class="card-title pricing-card-title">$29 <small class="text-muted">/ mo</small></h1>
          <ul class="list-unstyled mt-3 mb-4">
            <li>30 users included</li>
            <li>15 GB of storage</li>
            <li>Phone and email support</li>
            <li>Help center access</li>
          </ul>
          <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button>
        </div>
      </div>-->
    <?php } ?>
  </div>

</div>

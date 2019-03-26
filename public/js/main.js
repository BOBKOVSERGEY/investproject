$(function () {
  $('form').on('submit', function (event) {
    event.preventDefault();
    // reset
    //this.reset();
    // or $(this)[0].reset();

    // получаем action
    this.getAttribute('action');

    // получаем method
    this.getAttribute('method');
    var res;
    $.ajax({
      type: this.getAttribute('method'),
      url: this.getAttribute('action'),
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function (result) {
        console.log(result);
        res = JSON.parse(result);
        if (res.url) {
          window.location.href = res.url;
        } else  {
          swal(
            res.title,
            res.text,
            res.status,
          );
        }

      },
      error: function (result) {
        swal("Сообщение отправлено!", result, "error");
      }
    });
  });
});
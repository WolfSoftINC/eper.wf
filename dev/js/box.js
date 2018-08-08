// box
class Box {
  static add(id) {

    var url = '/box/padd';
    var str = 'pa=1';

    var button = $('a[data-product="'+ id +'"]');

    str += '&product_id=' + id,

    $.ajax({
      url: url,
      type: 'POST',
      data: str,
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      success: function(result){
        console.log(result);
        if (result == 'success') {
          button.html('Добавлено');
          button.addClass('product__button_added');
        } else {
          // location.href = "/registry";
        }
      }
    });
  }
}
// box
class Box {
  static add(id) {

    var url = '/box/padd';
    var str = 'pa=1';

    var button = $('a[data-product="'+ id +'"]');

    str += '&shop_id' + id,

    $.ajax({
      url: url,
      type: 'POST',
      data: src,
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      success: function(result){
        if (result == 'success') {
          button.html('Добавлено');
          button.addClass('product__button_added');
        }
      }
    });
  }
}
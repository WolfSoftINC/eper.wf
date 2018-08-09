// box
class Box {

  // add product
  static add(id) {

    var url = '/box/padd';
    var str = 'pa=1';

    var button = $('a[data-product="'+ id +'"]');

    str += '&product_id=' + id;

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

  // get product list
  static gl(id, data) {

    var url = '/box/product';

    // str
    var str = '';
    str += 'gl=1';

    if (data['shop_id']) {
      str += '&shop_id=' + data['shop_id']; 
    }
    if (data['ip']) {
      str += '&ip=' + data['ip']; 
    }

    $.ajax({
      url: url,
      type: 'POST',
      data: str,
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      success: function(list){
        var list = JSON.parse(list);

        list.forEach(function(data){
          var row = Box.rProduct(data);
          $('#' + id).append(row);
        });
      }
    });
  }

  // row
  static rProduct(data) {


    var row = $('<li/>',{
      class: 'box-list__item',
    })

    var content = $('<div/>',{
      class: 'product__content product__content_box',
    });
    row.append(content);


    var cover = $('<div/>',{
      class: 'product__cover product__cover_box',
    });
    content.append(cover);

    // img
    var src = '/img/product/'+ data['id'] + '.' + data['img'];
    var img = $('<img/>',{
      class: 'product__img',
      src: src,
    });
    cover.append(img);


    // info
    var info = $('<div/>',{
      class: 'product__info product__info_box',
    });
    content.append(info);

    var name = $('<p>',{
      class: 'product__title product__title_box',
      text: data['name'],
    });
    info.append(name);

    // price
    var price = $('<p/>',{
      class: 'product__price',
      text: data['price'] + 'сом',
    });
    info.append(price);

    // select
    var select = $('<select/>',{
      class: 'select product__number',
      name: 'number',
      id: 'number',
    });
    info.append(select);
    
    // option
    for (var i = 1; i <= 100; i++) {
      var option = $('<option/>',{
        value: i,
        text: i + ' шт.',
      });
      if (i == data['number']) option.attr('selected', true);
      select.append(option);
    }

    // total
    var total = $('<p/>',{
      class: 'product__total',
      text: data['price'] * data['number'] + 'c',
    });
    info.append(total);

    // var bottom = $('<div>',{
    //   class: 'product_box_bottom',
    //   html: '<div class="product_box_bottom_left"><p id="total"></p></div><input type="hidden" id="cost" value=""><div class="product_box_bottom_right"><input type="submit" name="is_del" value="Удалить"><input type="submit" name="is_buy" value="Купить"> </div>',
    // });
    // form.append(bottom);

    return row;
  }
}
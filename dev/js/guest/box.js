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
      id: 'product_' + data['id'],
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
      class: 'product__info product__info_box product__info_compare',
    });
    content.append(info);

    // name
    var wName = $('<div/>',{class: 'narrow_4',}); // name wrap
    var name = $('<p>',{
      class: 'product__title product__title_box',
      text: data['name'],
    });
    wName.append(name);
    info.append(wName);

    // price
    var wPrice = $('<div/>',{class: 'narrow_4',}); // price wrap
    var price = $('<p/>',{
      class: 'product__price',
      text: data['price'] + 'сом',
    });
    price.attr('data-type', 'price');
    price.attr('data-value', data['price']);
    wPrice.append(price);
    info.append(wPrice);

    // select
    var wSelect = $('<div/>',{class: 'narrow_4',}); // select wrap
    var select = $('<select/>',{
      class: 'select product__number',
      name: 'number',
      id: 'number',
      onChange: 'Box.cn('+ data['id'] +')',
    });
    select.attr('data-product', data['id']);
    wSelect.append(select);
    info.append(wSelect);
    
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
    var wTotal = $('<div/>',{class: 'narrow_4',}); // name wrap
    var total = $('<p/>',{
      class: 'product__total',
      text: data['price'] * data['number'] + 'c',
    });
    total.attr('data-type', 'total');
    wTotal.append(total);
    info.append(wTotal);

    // var bottom = $('<div>',{
    //   class: 'product_box_bottom',
    //   html: '<div class="product_box_bottom_left"><p id="total"></p></div><input type="hidden" id="cost" value=""><div class="product_box_bottom_right"><input type="submit" name="is_del" value="Удалить"><input type="submit" name="is_buy" value="Купить"> </div>',
    // });
    // form.append(bottom);

    return row;
  }

  // change number
  static cn(id) {

    var select = $('select[data-product="'+ id +'"]');
    
    var number = 0;
    number = select.val();

    var url = '/box/product';
    var str = 'pc=1';

    str += '&product_id=' + id;
    str += '&number=' + number;

    $.ajax({
      url: url,
      type: 'POST',
      data: str,
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      success: function(result){
        var row = $('#product_' + id);

        var price = row.find('p[data-type="price"]').data('value');
        row.find('p[data-type="total"]').html(price * number + 'c');
        total('box', 'total');

      }
    });
  }
}
class Product {

  // get list
  static gl(id, category, data) {

    var url = 'product/list';
    var str = '';
    str += 'gl=1';

    // shop id
    if (data['shop_id']) {
      str += '&shop_id=' + data['shop_id']; 
    }

    $.ajax({
      url: url,
      type: 'POST',
      data: str,
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      success: function(list){
        list = JSON.parse(list);

        list.forEach(function(data){
          var row = Product.row(data);
          $('#' + id).append(row);
        });
      }
    });
  }

  // row
  static row(data) {

    // row
    var row = $('<div/>', {
      class: 'product__row',
    });


    // cover
    var cover = $('<div/>',{
      class: 'product__cover',
    });
    row.append(cover);

    // image
    var src = '/img/product/' + data['product_id'] + '.' + data['img']; // image src
    var img = $('<img/>',{
      src: src,
      alt: '',
      class: 'product__img',
    });
    cover.append(img);


    // info
    var info = $('<div/>',{
      class: 'product__info',
    });
    row.append(info);

    // title
    var title = $('<a/>',{
      href: '/product=' + data['product_id'],
      class: 'product__title',
      text: data['name'],
    });
    info.append(title);

    var price = $('<span/>',{
      class: 'product__price',
      text: data['price'] + 'с',
    });
    info.append(price);


    // footer
    var footer = $('<div/>',{
      class: 'product__footer',
    });
    row.append(footer);

    // button
    var button = $('<a/>',{
      class: 'product__button',
      text: 'Добавить',
      onClick: 'Box.add('+ data['product_id'] +');',
    });
    button.attr('data-product', data['product_id']);
    footer.append(button);

    return row;
  }
}
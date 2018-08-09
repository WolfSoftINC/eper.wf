$(document).ready(function(){
  $("#number").change(function(){
      var cost = $("#cost").val(), number = 0, s = $('#number').val();

      for (var i = 0; i < s.length; i++)
      {
          if (s[i] == ' ')
              break;
          number *= 10;
          number += parseInt(s[i]);
      }

      $('#total').html("Сумма (" + number + " шт.) : " + (cost * number) + " сом");
  });
});


function total(iDiv, iTotal) {

  var div = $('#' + iDiv);

  var total = 0;

  div.children().each(function(){

    str = $(this).find('p[data-type="total"]').html();

    str = str.slice(0, -1);

    var val = parseInt(str);

    total += val;
  });

  $('#' + iTotal).html(total + 'с');
}
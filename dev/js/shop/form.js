// insert data from div in input 
function iddi(id, name) {
  var value = $('#' + id).html();

  $('input[name="'+ name +'"]').val(value);
}
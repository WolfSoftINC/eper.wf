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
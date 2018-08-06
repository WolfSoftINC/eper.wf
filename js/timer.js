$(document).ready(function(){
    var sz = $("#size").val();

    var t = [1212];

    for (var i = 1; i <= sz; i++)
        t.push((parseInt($('#' + i).html()) * 1000) + 86400000);

    setInterval(function(){
        for (var i = 1; i <= sz; i++)
        {
            var timer = t[i];
            var now = new Date().getTime();

            timer -= now;

            if (timer <= 0)
                $('#' + i).html("OVER");
            else
            {
                var hours = Math.floor((timer % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((timer % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((timer % (1000 * 60)) / 1000);
                
                var s = (hours + "ч " + minutes + "м " + seconds + "c");

                $('#' + i).html(s);
            }
        }
    },1000);
});
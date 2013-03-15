$(document).ready(function() {
    $('#od').datepicker({
        minDate: new Date(2011, 5, 23),
        maxDate: new Date(),
        onSelect: function(dateText, inst) {
            $('#odHdn').val(dateText);
            $('#do').datepicker('destroy');
            $('#do').datepicker({
                minDate: dateText,
                maxDate: new Date(),
                onSelect: function(dateText, inst) {
                    $('#doHdn').val(dateText);
                }
            });
        }
    });
    $('#do').datepicker({
        minDate: new Date(2011, 5, 23),
        maxDate: new Date(),
        onSelect: function(dateText, inst) {
            $('#doHdn').val(dateText);
        }
    });    

    $('.gradovi').click(function(){
        if($(this).hasClass('sel')){
            $(this).removeClass('sel');
            $('#gradHdn').val('');
        }
        else{
            $('.gradovi').removeClass('sel');
            $(this).addClass('sel');
            $('#gradHdn').val($(this).attr('id'));
        }
    }).hover(function(){
        $(this).addClass('hov');
    }, function(){
        $(this).removeClass('hov');
    });

    $('.shto').click(function(){
        if($(this).hasClass('sel')){
            $(this).removeClass('sel');
            $('#shtoHdn').val('');
        }
        else{
            $('.shto').removeClass('sel');
            $(this).addClass('sel');
            $('#shtoHdn').val($(this).attr('id'));
        }
    }).hover(function(){
        $(this).addClass('hov');
    }, function(){
        $(this).removeClass('hov');
    });

    $('.denovi').click(function(){
        if($(this).hasClass('sel')){
            $(this).removeClass('sel');
            $('#denHdn').val('');
        }
        else{
            $('.denovi').removeClass('sel');
            $(this).addClass('sel');
            $('#denHdn').val( $(this).attr('id').substring(1) );
        }
    }).hover(function(){
        $(this).addClass('hov');
    }, function(){
        $(this).removeClass('hov');
    });
});
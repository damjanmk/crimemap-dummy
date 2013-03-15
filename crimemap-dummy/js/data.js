$(function(){
    var query_string = window.location.search;
    var index_l = query_string.indexOf('l');
    var lang = query_string.substring(index_l+2,index_l + 4);
    var report_error;
    var cancel;
    report_error = "Пријави грешка";
    cancel = "Откажи";
    if (lang == 'mk'){
        report_error = "Пријави грешка";
        cancel = "Откажи";
    }
    else if(lang == 'en'){
        report_error = "Report Error";
        cancel = "Cancel";
    }
    else if (lang == 'sq'){
        report_error = "Пријави грешка";
        cancel = "Откажи";
    }
    $('.prijavi').click(function(){
        $('#formular_datum').datepicker();
        var id = $("div.select").attr('id');
        if(!id){
            $('#stavka').dialog({
                modal: true,
                buttons: {
                    Ok: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
            return;
        }
        $('#formular_shto').val( $('#shto_' + id).text()  );
        $('#formular_grad').val( $('#grad_' + id).text()  );
        $('#formular_adresa').val( $('#adresa_' + id).text()  );
        $('#formular_bilten').val( $('#bilten_' + id).text()  );
        $('#formular_datum').val( $('#datum_' + id).text()  );
        $('#formular_lat').val( $('#lat_' + id).text()  );
        $('#formular_lng').val( $('#lng_' + id).text()  );
        $('#formular_opis').val( $('#opis_' + id).text()  );
       
        
        var dialog_buttons = {};
        dialog_buttons[report_error] = function(){
            prijavi(id);
            $( this ).dialog( "close" );
        }
        dialog_buttons[cancel] = function(){
            $( this ).dialog( "close" );
        }


        $( "#dialog-formular" ).dialog({
            height: 650,
            width: 500,
            modal: true,
            buttons: dialog_buttons
        });
    });

    $('#tabela tr').click(function(){
        $('tr').removeClass('select_red');
        $(this).addClass('select_red');
        $('.id').removeClass('select');
        $(this).find('.id').addClass('select');
    });

    if($('#nastan_id').text() != ''){
        $('#tabela tr div.id').each(function() {
            var i = $(this).attr('id');
            if(i == $('#nastan_id').text()){
                $(this).addClass('select');
                $('.prijavi').click();
            }
        });
    }

    $('#search').keyup(function (event) {
        if (event.keyCode == '13') {
            var vr = $('#search').val();
            if(vr == '' || vr == ' ')
                return false;
            else{
                location.href="?l=" + lang + "&opis=" + vr;
            }
        }
        return false;
    });

    $('#search_img').click(function(){
	var vr = $('#search').val();
            if(vr == '' || vr == ' ')
                return false;
            else{
                location.href="?l=" + lang + "&opis=" + vr;
            }
    });
	
});
function prijavi(id){
    //var email = $('#formular_email').val();
    var shto = $('#formular_shto').val();
    var grad = $('#formular_grad').val();
    var adresa = $('#formular_adresa').val();
    var datum_bilten = $('#formular_bilten').val();
    var datum = $('#formular_datum').val();
    var lat = $('#formular_lat').val();
    var lng = $('#formular_lng').val();
    var opis = $('#formular_opis').val();
    $.post("../model/ajax.php", {
        id: id,
        shto: shto,
        grad: grad,
        adresa: adresa,
        datum_bilten : datum_bilten,
        datum: datum,
        lat:lat,
        lng:lng,
        opis: opis
    }, function(data){
        if(data==''){
            $('#ok').dialog({
                modal: true,
                buttons: {
                    OK: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
        }
        else
            alert(data);
    });
}

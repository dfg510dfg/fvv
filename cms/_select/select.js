function buscar() {
    //esperando la carga... 
    var nivel = $('#cmbNivel').val()-1;
    $('#cmbPertenece').html('<option value="">Cargando...aguarde</option>');
    $.ajax({
        type: "post",
        url: '../_select/procesar.php',
        data: 'nivel=' + nivel,
        success: function(resp) {
            $('#cmbPertenece').html(resp);
        }
    });
}
function buscara() {
    //esperando la carga... 
    var nivel = $('#cmbNivel').val()-1;
    $('#cmbPertenece').html('<option value="">Cargando...aguarde</option>');
    $.ajax({
        type: "post",
        url: '../_select/procesar2.php',
        data: 'nivel=' + nivel,
        success: function(resp) {
            $('#cmbPertenece').html(resp);
        }
    });
}

function cantidad(){
    //esperando la carga... 
    var nivel = $('#cmbNivel').val();
    var idmenu = $('#cmbPertenece').val();
    if(nivel>0){
        $('#cmbPosicion').html('<option value="">Cargando...aguarde</option>');
        $.ajax({
            type: "post",
            url: '../_select/cantidad.php',
            data: 'idmenu=' + idmenu,
            success: function(resp) {
                $('#cmbPosicion').html(resp);
            }
        });     
    }else{
        resp='<option value="0">[---]</option>';
        $('#cmbPosicion').html(resp);
    }
}

function cantidad2(){
    //esperando la carga... 
    var nivel = $('#cmbNivel').val();
    var idmenu = $('#cmbPertenece').val();
    var cont = $('#contenedor').val();
    if(nivel>0){
        $('#cmbPosicion').html('<option value="">Cargando...aguarde</option>');
        $.ajax({
            type: "post",
            url: '../_select/cantidad2.php',
            data: 'idmenu=' + idmenu + '&contenido=' + cont,
            success: function(resp) {
                $('#cmbPosicion').html(resp);
            }
        });     
    }else{
        resp='<option value="0">[---]</option>';
        $('#cmbPosicion').html(resp);
    }
}

function cantidades(){
    //esperando la carga... 
    var nivel = $('#cmbNivel').val();
    var idmenu = $('#cmbPertenece').val();
    if(nivel>0){
        $('#cmbPosicion').html('<option value="">Cargando...aguarde</option>');
        $.ajax({
            type: "post",
            url: '../_select/cantidades.php',
            data: 'idmenu=' + idmenu,
            success: function(resp) {
                $('#cmbPosicion').html(resp);
            }
        });     
    }else{
        resp='<option value="0">[---]</option>';
        $('#cmbPosicion').html(resp);
    }
}

function cantidadese(){
    //esperando la carga... 
    var nivel = $('#cmbNivel').val();
    var idmenu = $('#cmbPertenece').val();
    if(nivel>0){
        $('#cmbPosicion').html('<option value="">Cargando...aguarde</option>');
        $.ajax({
            type: "post",
            url: '../_select/cantidadese.php',
            data: 'idmenu=' + idmenu,
            success: function(resp) {
                $('#cmbPosicion').html(resp);
            }
        });     
    }else{
        resp='<option value="0">[---]</option>';
        $('#cmbPosicion').html(resp);
    }
}

function cantidad4(){
    //esperando la carga... 
    var nivel = $('#cmbNivel').val();
    var idmenu = $('#cmbPertenece').val();
    var cont = $('#contenedor').val();
    if(nivel>0){
        $('#cmbPosicion').html('<option value="">Cargando...aguarde</option>');
        $.ajax({
            type: "post",
            url: '../_select/cantidad4.php',
            data: 'idmenu=' + idmenu + '&contenido=' + cont,
            success: function(resp) {
                $('#cmbPosicion').html(resp);
            }
        });     
    }else{
        resp='<option value="0">[---]</option>';
        $('#cmbPosicion').html(resp);
    }
}
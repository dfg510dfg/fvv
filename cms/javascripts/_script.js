function setModal(){
    var vArgs = new Array();
    vArgs = arguments;
    var nWidth = vArgs[0]; //ancho de de la ventana
    var sTipoModal = vArgs[1]; // tipo de modal ok / ok-cancel
    //var sMensaje
    switch(sTipoModal){
        case 'okAux':
            var img = document.getElementById("imagenMsg");
            img.src = "";
            img.src = '_img/alerta.png'; // imagen a mostrar
            $(function(){
                // Dialog
                $('#dialog').dialog({   //inicia el dialogo
                    autoOpen: false, //
                    width: nWidth,// ancho de la ventana
                    buttons: { //botones
                        "Ok": function() {
                            $(this).dialog("close");//cierra la ventana
                            var idForm = document.getElementById("idForm");
                            var vID = idForm.innerHTML.split("-");//vector de ID de controles
                            var logn = vID.length;
                            var msg = "";
                            for(var i=0; i<logn; i++){
                                if(vID[i]!=""){
                                    $("#"+vID[i]+"").addClass("mostrarError");//aplica estilo a los controles
                                }
                            }
                            return false;
                        }
                    },
                    modal: true //most
                });
                $('#dialog').dialog('open');// mostrar modal

            });
            break;
        case 'ok':
            var img = document.getElementById("imagenMsg");
            img.src = "";
            img.src = '../_img/alerta.png'; // imagen a mostrar
            $(function(){
                // Dialog
                $('#dialog').dialog({   //inicia el dialogo
                    autoOpen: false, //
                    width: nWidth,// ancho de la ventana
                    buttons: { //botones
                        "Ok": function() {
                            $(this).dialog("close");//cierra la ventana
                            var idForm = document.getElementById("idForm");
                            var vID = idForm.innerHTML.split("-");//vector de ID de controles
                            var logn = vID.length;
                            var msg = "";
                            for(var i=0; i<logn; i++){
                                if(vID[i]!=""){
                                    $("#"+vID[i]+"").addClass("mostrarError");//aplica estilo a los controles
                                }
                            }
                            return false;
                        }
                    },
                    modal: true //most
                });
                $('#dialog').dialog('open');// mostrar modal

            });
            break;
        case 'ok-cancel':
            var msgScript = document.getElementById("msgScript");//div donde se escribe el mensaje
            var img = document.getElementById("imagenMsg");
            img.src = '../_img/informe.png'; // imagen a mostrar
            msgScript.innerHTML = "";
            msgScript.innerHTML = "¿ Está seguro que desea salir de esta ventana ?";
            $(function(){
                // Dialog
                $('#dialog').dialog({   //inicia el dialogo
                    autoOpen: false, //
                    width: nWidth,// ancho de la ventana
                    buttons: { //botones
                        "Ok": function() {
                            window.close();
                            return false;
                        },
                        "Cancelar": function(){
                            $(this).dialog("close");//cierra la ventana
                            return false;
                        }
                    },
                    modal: true //most
                });
                $('#dialog').dialog('open');// mostrar modal
                
            });
            break;
        case 'errro-info-save':
            var msgScript = document.getElementById("msgScript");//div donde se escribe el mensaje
            msgScript.innerHTML = "";
            msgScript.innerHTML = "el registro no pudo ser grabado.<br><br> ocurrió un problem en el sistema.<br><br>vuelva a intentarlo.!!!";
            $(function(){
                // Dialog
                $('#dialog').dialog({   //inicia el dialogo
                    autoOpen: false, //
                    width: nWidth,// ancho de la ventana
                    buttons: { //botones
                        "Ok": function() {
                            $(this).dialog("close");//cierra la ventana
                            return false;
                        }
                    },
                    modal: true //most
                });
                $('#dialog').dialog('open');// mostrar modal

            });
            break;
            

          case 'error-horario-1':
            var msgScript = document.getElementById("msgScript");//div donde se escribe el mensaje
            msgScript.innerHTML = "";
            msgScript.innerHTML = "debe seleccionar día y hora.<br><br> de la lista de horarios.";
            $(function(){
                // Dialog
                $('#dialog').dialog({   //inicia el dialogo
                    autoOpen: false, //
                    width: nWidth,// ancho de la ventana
                    buttons: { //botones
                        "Ok": function() {
                            $(this).dialog("close");//cierra la ventana
                            return false;
                        }
                    },
                    modal: true //most
                });
                $('#dialog').dialog('open');// mostrar modal

            });
            break;

            case 'error-horario-2':
                
                var msgScript = document.getElementById("msgScript");//div donde se escribe el mensaje
                msgScript.innerHTML = "";
                msgScript.innerHTML = "Error de lógica: <br><br><br> el número de clases es menor.<br><br> al de la lista de horarios.";
                $(function(){
                    // Dialog
                    $('#dialog').dialog({   //inicia el dialogo
                        autoOpen: false, //
                        width: nWidth,// ancho de la ventana
                        buttons: { //botones
                            "Ok": function() {
                                $(this).dialog("close");//cierra la ventana
                                return false;
                            }
                        },
                        modal: true //most
                    });
                    $('#dialog').dialog('open');// mostrar modal

                });
            break;

            case 'error-usuario-1':

                var msgScript = document.getElementById("msgScript");//div donde se escribe el mensaje
                msgScript.innerHTML = "";
                msgScript.innerHTML = "Usuario y clave incorrecta.<br><br> Vuelva a intentarlo";
                $(function(){
                    // Dialog
                    $('#dialog').dialog({   //inicia el dialogo
                        autoOpen: false, //
                        width: nWidth,// ancho de la ventana
                        buttons: { //botones
                            "Ok": function() {
                                $(this).dialog("close");//cierra la ventana
                                return false;
                            }
                        },
                        modal: true //most
                    });
                    $('#dialog').dialog('open');// mostrar modal

                });
            break;
          case 'ok-cancel-dscto':
            var msgScript = document.getElementById("msgScript");//div donde se escribe el mensaje
            var img = document.getElementById("imagenMsg");
            img.src = "";
            img.src = '../_img/informe.png'; // imagen a mostrar
            msgScript.innerHTML = "";
            msgScript.innerHTML = "¿ Está seguro que desea salir de esta ventana ?";
            $(function(){
                // Dialog
                $('#dialog').dialog({   //inicia el dialogo
                    autoOpen: false, //
                    width: nWidth,// ancho de la ventana
                    buttons: { //botones
                        "Ok": function() {
                            window.close();
                            window.opener.unChecked('chkDscto');
                            return true;
                        },
                        "Cancelar": function(){
                            $(this).dialog("close");//cierra la ventana
                            return true;
                        }
                    },
                    modal: true //most
                });
                $('#dialog').dialog('open');// mostrar modal

            });
            break;
        
        default:
            $(function(){
                // Dialog
                $('#dialog').dialog({   //inicia el dialogo
                    autoOpen: false, //
                    width: nWidth,// ancho de la ventana
                    buttons: { //botones
                        "Ok": function() {
                            
                            return false;
                        }
                    },
                    modal: true //most
                });
               

            });
            break;
    }
}
function setBotonesMantenimiento(){
    var vArgs = new Array();
    vArgs = arguments;
    var vBotones = vArgs[0];
    var vIconos = vArgs[1];

    $(function(){
        // icono para los botones de mantenimiento
        var nLong = vBotones.length;
        for(var i=0; i<nLong; i++){
            $("#"+vBotones[i]+"").button({
                icons: {
                    primary: ''+vIconos[i]+''
                }
            });
        }
    });
}
function seleccionar(){ /* uso solo para grilla horario */

    var vArg = new Array();
    vArg= arguments;
    var fila = vArg[0];
    var columna = vArg[1];
    var msg="";
    var objChecked = document.getElementById("chkDia_"+fila+"_"+columna+"");
    var objbtnCheck = document.getElementById("btnCheck_"+fila+"_"+columna+"");
    if(!objChecked.checked){
        objChecked.checked = true;
        with(objbtnCheck.style){
            backgroundImage = "url('../_img/Checked.png')";
            backgroundColor = "#cceecc";
            cursor = "pointer";
        }

    } else {
        objChecked.checked = false;
        with(objbtnCheck.style){
            backgroundImage = "url('../_img/Unchecked.png')";
            cursor = "pointer";
            backgroundColor = "";
        }

    }
   
}



function mostrarMensajeModal(){
    var vArgs = new Array();
    vArgs = arguments;
    var nWidth = vArgs[0]; //ancho de de la ventana
    var sTipoModal = vArgs[1]; // tipo de modal ok / ok-cancel;
    var sParamAux = vArgs[3];
    var vParam = vArgs[4];
    var msgScript = document.getElementById("msgScript");//div donde se escribe el mensaje
    var img = document.getElementById("imagenMsg");
    img.src = "";
    img.src = sParamAux; // imagen a mostrar
    msgScript.innerHTML = "";
    msgScript.innerHTML = vArgs[2];
    switch(sTipoModal){
        case 'okVal':
            $(function(){
                // Dialog
                $('#dialog').dialog({   //inicia el dialogo
                    autoOpen: false, //
                    width: nWidth,// ancho de la ventana
                    buttons: { //botones
                        "Ok": function() {
                            $(this).dialog("close");//cierra la ventana
                                var idForm = document.getElementById("idForm");
                                var vID = idForm.innerHTML.split("-");//vector de ID de controles
                                var logn = vID.length;
                                var msg = "";
                                for(var i=0; i<logn; i++){
                                    if(vID[i]!=""){
                                        $("#"+vID[i]+"").addClass("mostrarError");//aplica estilo a los controles
                                    }
                                }
                            return false;
                        }
                    },
                    modal: true //most
                });
                $('#dialog').dialog('open');// mostrar modal

            });
            break;
            
        case 'ok':
            
            $(function(){
                // Dialog
                $('#dialog').dialog({   //inicia el dialogo
                    autoOpen: false, //
                    width: nWidth,// ancho de la ventana
                    buttons: { //botones
                        "Ok": function() {
                            $(this).dialog("close");//cierra la ventana
                            return false;
                        }
                    },
                    modal: true //most
                });
                $('#dialog').dialog('open');// mostrar modal

            });
            break;
            case 'ok-cancel':
            $(function(){
                // Dialog
                $('#dialog').dialog({   //inicia el dialogo
                    autoOpen: false, //
                    width: nWidth,// ancho de la ventana
                    buttons: { //botones
                        "Ok": function() {
                            irA(4,'../_controlador/PagoControlador.php?temp_popup=1&mostrar=1',0,'frmPago','NO',Array('cmbFormaPago','cmbTipoMoneda'));
                            return false;
                        },
                        "Cancelar": function(){
                            $(this).dialog("close");//cierra la ventana
                            return false;
                        }
                    },
                    modal: true //most
                });
                $('#dialog').dialog('open');// mostrar modal

            });
            break;
            case 'ok-cancel-delete':
            $(function(){
                // Dialog
                $('#dialog').dialog({   //inicia el dialogo
                    autoOpen: false, //
                    width: nWidth,// ancho de la ventana
                    buttons: { //botones
                        "Ok": function() {
                            window.location='../_controlador/MatriculaControlador.php?temp_popup=1&accion=DEL&idmatricula='+vParam[0]+'&idalumno='+vParam[1]+'&anio='+vParam[2];
                            return false;
                        },
                        "Cancelar": function(){
                            $(this).dialog("close");//cierra la ventana
                            return false;
                        }
                    },
                    modal: true //most
                });
                $('#dialog').dialog('open');// mostrar modal

            });
            break;
            case 'ok-cancel-updpago':
            $(function(){
                // Dialog
                $('#dialog').dialog({   //inicia el dialogo
                    autoOpen: false, //
                    width: nWidth,// ancho de la ventana
                    buttons: { //botones
                        "Ok": function() {
                            irA(4,'../_controlador/PagoControlador.php?temp_popup=1',0,'frmCambiarPago','NO',Array('cmbFormaPago','cmbTipoMoneda'));
                            return false;
                        },
                        "Cancelar": function(){
                            $(this).dialog("close");//cierra la ventana
                            return false;
                        }
                    },
                    modal: true //most
                });
                $('#dialog').dialog('open');// mostrar modal

            });

            break;
            case 'ok-cancel-deuda':
            $(function(){
                // Dialog
                $('#dialog').dialog({   //inicia el dialogo
                    autoOpen: false, //
                    width: nWidth,// ancho de la ventana
                    buttons: { //botones
                        "Ok": function() {
                            irA(4,'../_controlador/CancelardeudaControlador.php?temp_popup=1',0,'frmCancelarDeuda','NO',Array('cmbFormaPago','cmbTipoMoneda'));
                            return false;
                        },
                        "Cancelar": function(){
                            $(this).dialog("close");//cierra la ventana
                            return false;
                        }
                    },
                    modal: true //most
                });
                $('#dialog').dialog('open');// mostrar modal

            });

            break;
            case 'ok-cancel-deuda-add':
            $(function(){
                // Dialog
                $('#dialog').dialog({   //inicia el dialogo
                    autoOpen: false, //
                    width: nWidth,// ancho de la ventana
                    buttons: { //botones
                        "Ok": function() {
                            irA(4,'../_controlador/CancelardeudaAddControlador.php?temp_popup=1',0,'frmCancelarDeuda','NO',Array('cmbFormaPago','cmbTipoMoneda'));
                            return false;
                        },
                        "Cancelar": function(){
                            $(this).dialog("close");//cierra la ventana
                            return false;
                        }
                    },
                    modal: true //most
                });
                $('#dialog').dialog('open');// mostrar modal

            });

            break;
       case 'ok-cancel-pase-add':
            $(function(){
                // Dialog
                $('#dialog').dialog({   //inicia el dialogo
                    autoOpen: false, //
                    width: nWidth,// ancho de la ventana
                    buttons: { //botones
                        "Ok": function() {
                            irA(4,'../_controlador/PagopaseControlador.php?temp_popup=1',0,'frmPagopase','NO',Array('cmbFormaPago','cmbTipoMoneda'));
                            return false;
                        },
                        "Cancelar": function(){
                            $(this).dialog("close");//cierra la ventana
                            return false;
                        }
                    },
                    modal: true //most
                });
                $('#dialog').dialog('open');// mostrar modal

            });
            break;
       case 'ok-reload':
            $(function(){
                // Dialog
                $('#dialog').dialog({   //inicia el dialogo
                    autoOpen: false, //
                    width: nWidth,// ancho de la ventana
                    buttons: { //botones
                        "Ok": function() {
                            window.location.reload();
                            $(this).dialog("close");//cierra la ventana


                        }
                    },
                    modal: true //most
                });
                $('#dialog').dialog('open');// mostrar modal
            });
            break;

        default:
            break;
    }
    
}

function seleccionarAux(){ /* uso solo para grilla horario */
    var vArg = new Array();
    vArg= arguments;
    var fila = vArg[0];
    var columna = vArg[1];
    var msg="";
    var objChecked = document.getElementById("chkDia_"+fila+"_"+columna+"");
    var objbtnCheck = document.getElementById("btnCheck_"+fila+"_"+columna+"");
    if(!objChecked.checked){
        objChecked.checked = true;
        with(objbtnCheck.style){
            backgroundImage = "url('../_img/Checked.png')";
            backgroundColor = "#cceecc";
            cursor = "pointer";
        }

    } else {
        objChecked.checked = false;
        with(objbtnCheck.style){
            backgroundImage = "url('../_img/Unchecked.png')";
            cursor = "pointer";
            backgroundColor = "";
        }

    }
}
function retirarErrorAux(){ // retira el borde rojo cuando se digita algo en la caja de texto
    var Args = new Array();
    Args = arguments;
    var objCtrl = document.getElementById(""+Args[0]+"");
    if(objCtrl.value.length>0 || objCtrl.value != 'vacio'){
        $("#"+objCtrl.id+"").removeClass("mostrarError");
    }
}
function retirarError(){ // retira el borde rojo cuando se digita algo en la caja de texto
    var Args = new Array();
    Args = arguments;
    var objCtrl = Args[0];
    if(objCtrl.value.length>0 || objCtrl.value != 'vacio'){
        $("#"+objCtrl.id+"").removeClass("mostrarError");
    }
}
function redondea(sVal, nDec){
    var n = parseFloat(sVal);
    var s = "";
    if (!isNaN(n)){
        n = Math.round(n * Math.pow(10, nDec)) / Math.pow(10, nDec);
        s = String(n);
        s += (s.indexOf(".") == -1? ".": "") + String(Math.pow(10, nDec)).substr(1);
        s = s.substr(0, s.indexOf(".") + nDec + 1);
    }
    return s;
}
function aDecimal(obj,nDec){
    obj.value = redondea(obj.value, nDec);
    obj.value = redondea(obj.value, nDec);
}
function numeros(frm,control,tipo){
    // NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57
    //a=97, z=122 , A=65, Z=90
    var key=window.event.keyCode;
    
    if (key < 48 || key > 57){
    
        if(key!=46){ //permite el punto decimal
            if(key==13){
                frm.method="post";
                frm.submit();
            } else {
                window.event.keyCode=0;
                alert(msg);
                control.focus();
            }
        }



    }
    return window.event.keyCode=0;
}// fin de la funcion
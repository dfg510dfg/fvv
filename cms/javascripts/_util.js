function redireccionar(){
    var vArgs = new Array();
    vArgs = arguments;
    var url = vArgs[0];
    var sustituir = vArgs[1];
    if(url.length>0){
        openPopUp(url,1,0,0,0,0,0,0,0,0,0,0,sustituir);
    }	
}

function validarInputFile(){
    var Args = new Array();
    Args = arguments;
    var frm = document.getElementById(""+Args[0]+"");
    var objControl = document.getElementById(""+Args[1]+"");
    var extensionesPermitidas = Args[2];
    var paramAux = Args[3];
    var msg = "";
    
    if(objControl.type=="file"){

        if(objControl.value.length<=0){
            msg = "No se ha seleccionado un archivo <br>en el formulario";
           
        } else {
            
            //recupero la extensión de este nombre de archivo
            var extension = (objControl.value.substring(objControl.value.lastIndexOf("."))).toLowerCase();
            //compruebo si la extensión está entre las permitidas
            var permitida = false;
            for (var i = 0; i < extensionesPermitidas.length; i++) {
                if (extensionesPermitidas[i] == extension) {
                    permitida = true;
                    break;
                }
            }
            if(!permitida){
                msg="Comprueba la extensión de los archivos a subir. <br>Sólo se pueden subir archivos con extensiones: <br>"+ extensionesPermitidas.join();
               
            } else {
               frm.submit();
               return true;
            }
        }
        
        mostrarMensajeModal(500,'ok',msg,'../_img/alerta.png');
    }
    
    
}

function setearIndexCombo(){/* enviar id y numero de index */
    var Args = new Array();
    Args = arguments;
    var objControl= document.getElementById("" + Args[0] + "");
    var index= Args[1];
    if(objControl.type=="select-one"){
        objControl.selectedIndex = index;
    } else {
        mostrarMensaje("el objeto enviado no es un combo");
    }
    
}
function activarControlHtml(){ /* activa un control HTML */
    var Args = new Array();
    Args = arguments;
    var objControl= document.getElementById("" + Args[0] + "");

    if(objControl.disabled){ /*si el control html esta bloqueado*/
        if(objControl.type=="select-one"){ /* combo */
            objControl.selectedIndex=0;
            objControl.disabled = false;
        } else if(objControl.type=="text"){ /* texto */
            objControl.value="";
            objControl.disabled = false;
        } else {
            mostrarMensaje("el objeto enviado no es un control HTML");
        }
    }
    

}
function bloquearControlHtml(){
    var Args = new Array();
    Args = arguments;
    var objControl= document.getElementById("" + Args[0] + "");

    if(!objControl.disabled){ /*si el control html esta activo*/
        if(objControl.type=="select-one"){ /* combo */
            objControl.selectedIndex=0;
            objControl.disabled = true;
        } else if(objControl.type=="text"){ /* texto */
            objControl.value="";
            objControl.disabled = true;
        } else {
            mostrarMensaje("el objeto enviado no es un control HTML");
        }
    } 
}
function seleccionPintaFila(){

    var Args = new Array();
    Args = arguments;
    var fila = Args[0];
    var objControl = Args[1];
    var colorOriginal = Args[2];
    var objTR = document.getElementById("tr"+fila+"");
    var colorPintar = Args[3];
    if(!objControl.checked){
        objTR.style.backgroundColor = colorPintar;
        objControl.checked=true;
    }else{
        objTR.style.backgroundColor = colorOriginal;
        objControl.checked=false;
    }
}

function bloquearActivar(){
    var Args = new Array();
    Args = arguments;
    var objControl = Args[0];
    var objControl2 = document.getElementById("" + Args[1] + "");
    if(objControl.type=="checkbox"){ /* checkbox */
        if(objControl.checked){
            if(objControl2.type=="textarea")objControl2.readOnly=false;
            if(objControl2.type=="select-one")objControl2.selectedIndex=0;objControl2.disabled = false;
            if(objControl2.type=="text")objControl2.value="";objControl2.disabled = false;
        } else {
            if(objControl2.type=="textarea")objControl2.value="";objControl2.readOnly=true;
            if(objControl2.type=="select-one")objControl2.selectedIndex=0;objControl2.disabled = true;
            if(objControl2.type=="text")objControl2.value="";objControl2.disabled = true;
        }
    } 
}

function seleccionPintaFilaAsist(){

    var Args = new Array();
    Args = arguments;
    var fila = Args[0];
    var objControl = Args[1];
    var colorOriginal = Args[2];
    var colorPintar = Args[3];
    var objTR = document.getElementById("tr"+fila+"");
    var objCmb = document.getElementById(""+Args[4]+"");
    var objChkJustifica = document.getElementById(""+Args[5]+"");
    var objTextJustifica = document.getElementById("txtTiempo"+fila+"");
    
    objTextJustifica.value="";
    //objTextJustifica.disabled=true;
    setFoco(""+Args[4]+"");
    if(objControl.checked){
        //objChkJustifica.disabled=false;
        //objChkJustifica.checked=false;
        //objTR.style.backgroundColor = colorPintar;
        objCmb.selectedIndex = 1;
    }else{
        //objChkJustifica.disabled=true;
        //objChkJustifica.checked=false;
        //objTR.style.backgroundColor = colorOriginal;
        objCmb.selectedIndex = 0;
    }
}

function seleccionPintaFilaAsistAux(){

    var Args = new Array();
    Args = arguments;
    var fila = Args[0];
    var objControl = Args[1];
    var colorOriginal = Args[2];
    var colorPintar = Args[3];
    var objTR = document.getElementById("tr"+fila+"");
    var objChk = document.getElementById(""+Args[4]+"");
    var objChkJustifica = document.getElementById(""+Args[5]+"");
    var objTextJustifica = document.getElementById("txtTiempo"+fila+"");
    
    if(objControl.selectedIndex > 0){
        //objTR.style.backgroundColor = colorPintar;
        objChk.checked=true;
        if(objControl.value==3)objChkJustifica.disabled=true; else objChkJustifica.disabled=false;objChkJustifica.checked=false;objTextJustifica.value="";objTextJustifica.readOnly=true;
    }else{
        //objTR.style.backgroundColor = colorOriginal;
        objChk.checked=false;
        objChkJustifica.disabled=true;
        objChkJustifica.checked=false;
        objTextJustifica.value="";
        objTextJustifica.readOnly=true;
    }
}

function seleccionPintaFilaAux(){
    var Args = new Array();
    Args = arguments;
    var fila = Args[0];
    var objControl = Args[1];
    var colorOriginal = Args[2];
    var objCheck = document.getElementById("chk"+fila+"");
    var colorPintar = Args[3];
    if(!objCheck.checked){
        objControl.style.backgroundColor = colorPintar;
        objCheck.checked=true;
    }else{
        objControl.style.backgroundColor = colorOriginal;
        objCheck.checked=false;
    }
}

function mostrarMensaje(){
    var Args = new Array();
    Args = arguments;
    alert(Args[0]);
}
function iluminarTxtOver(Objtxt,color_entrada){
    Objtxt.style.backgroundColor=color_entrada;
    Objtxt.focus();
}
function iluminarTxtOut(Objtxt,color_default){
    Objtxt.style.backgroundColor="";
}

function uno(src,color_entrada) {
    src.style.backgroundColor=color_entrada;
    src.style.cursor="hand";
}

function unoAux(fila,color_entrada) {
    var ObjTR = document.getElementById("tr"+fila+"");
    ObjTR.style.backgroundColor=color_entrada;
    ObjTR.style.cursor="hand";
}

function openPopUp(direccion, pantallacompleta, herramientas, direcciones, estado, barramenu, barrascroll, cambiatamano, ancho, alto, izquierda, arriba, sustituir){
    var opciones = "fullscreen=" + pantallacompleta +
    ",toolbar=" + herramientas +
    ",location=" + direcciones +
    ",status=" + estado +
    ",menubar=" + barramenu +
    ",scrollbars=" + barrascroll +
    ",resizable=" + cambiatamano +
    ",width=" + ancho +
    ",height=" + alto +
    ",left=" + izquierda +
    ",top=" + arriba;
    window.open(direccion,sustituir,opciones,sustituir);
        
}
function setScrollBar(nombreContenedor,ancho,alto){
    var contenedor = document.getElementById("" + nombreContenedor + "");
    with(contenedor.style){
        height = alto + "px";
        width = ancho + "px";
        overflow = "scroll";
        overflowX = "hidden";
        scrollbarLeftmargin = "0";
        scrolllbarMarginwidth = "0";
        unicodeBidi = "bidi-override";
     }
}

function seleccionarCheck(){
    var vArg = new Array();
    vArg= arguments;
    var frm = vArg[0];
    var objAct = vArg[1];
    var msg="";
    var envio=true;
    var nObjts=frm.length;
    if(objAct.checked){
        for(var i=0; i<nObjts; i++){
            if(frm.elements[i].type == "checkbox"){
                frm.elements[i].checked=true;
            }
        }
    } else {
        for(var i=0; i<nObjts; i++){
            if(frm.elements[i].type == "checkbox"){
                frm.elements[i].checked=false;
            }
        }
    }
}



function setWidthForm(op,ancho,alto,contenedor){
    var objdiv = document.getElementById(""+contenedor+"");
    if(op==1){
        objdiv.style.width = ancho + "px";
    //objdiv.style.height = alto + "px";

    }else{
        objdiv.style.width = ancho+"%";
        objdiv.style.height = alto + "%";
    }
}

function ocultar(){ /**/
    var vArgs = new Array();
    vArgs = arguments;
    var obj = document.getElementById(""+vArgs[0]+"");
    obj.style.display = "none";
}

function mostrar(){ /**/
    var vArgs = new Array();
    vArgs = arguments;
    var obj = document.getElementById(""+vArgs[0]+"");
    obj.style.display = "block";
}
function setFoco(){ /**/
    var vArgs = new Array();
    vArgs = arguments;
    var obj = document.getElementById(""+vArgs[0]+"");
    obj.focus();
}
function setTextoCheck(){ /**/
    var vArgs = new Array();
    vArgs = arguments;
    var obj = document.getElementById(""+vArgs[0]+"");
    var objDiv = document.getElementById("textoCheck");
    objDiv.style.width = "10px";
    objDiv.innerHTML = "";
    if(obj.checked){
        objDiv.innerHTML = " (SI) ";
        obj.value = "1";
    } else {
        objDiv.innerHTML = " (NO) ";
    }
}

function setTextoCheckAux(){ /**/
    var vArgs = new Array();
    vArgs = arguments;
    var obj = document.getElementById(""+vArgs[0]+"");
    var objDiv = document.getElementById(""+vArgs[1]+"");
    objDiv.style.width = "10px";
    objDiv.innerHTML = "";
    if(obj.checked){
        objDiv.innerHTML = " (SI) ";
        obj.value = "1";
    } else {
        objDiv.innerHTML = " (NO) ";
    }
}

function limpiarControles(){
    var vArgs = new Array();
    vArgs = arguments;
    var tipo = vArgs[0]; /*tipo de validacion: si se van a validar todos y solo los elementos elegidos*/
    var vControles = vArgs[1]; /*nombres de los controles que se van a validar*/
    var objform = vArgs[2]; /* hace referencia al formulario actual */

    switch(tipo){
        case 'todo':
            var size=objform.length;
            for(var i=0; i<size; i++){
                if(objform.elements[i].type == "text" ||
                    objform.elements[i].type == "password"){
                    objform.elements[i].value = "";
                } else if(objform.elements[i].type == "select-one"){
                    objform.elements[i].selectedIndex = 0;
                } else if(objform.elements[i].type == "checkbox" ||
                    objform.elements[i].type == "radio"){
                    objform.elements[i].checked = false;
                }
            }
            break;
        case 'elegido':
            var size=objform.length;
            var sizeAux=vControles.length;
            for(var i=0; i<size; i++){
                for(var j=0; j<sizeAux; j++){
                    if(objform.elements[i].name == vControles[j]){
                        if(objform.elements[i].type == "text" ||
                            objform.elements[i].type == "password"){
                            objform.elements[i].value = "";
                        } else if(objform.elements[i].type == "select-one"){
                            objform.elements[i].selectedIndex = 0;
                        } else if(objform.elements[i].type == "checkbox" ||
                            objform.elements[i].type == "radio"){
                            objform.elements[i].checked = false;
                        }
                    }
                }
            }
            break;
    }
}

function validarControl(){    
    var v_Args = new Array();
    v_Args= arguments;
    var objControl = v_Args[0];
    var tpValidacion = v_Args[1];
    var e = v_Args[2];
    var key = "";
    
    if(e.event != undefined){
        key = window.e.keyCode;
    }else{
        key = e.keyCode;
    }
    switch(tpValidacion){ /* varia su funcionalidad deacuerdo a la configuacion de teclado windows (ingles-spañol)  */
        case 'numeros':
            if (key < 48 || key > 57){
                if(key!=8){ //permite usar back space
                    objControl.value="";
                    objControl.focus();
                    mostrarMensajeModal(500,'ok','! Ingrese solo números ¡','../_img/alerta.png');
                }
            }
            break;
        case 'letras':
            if (key < 65 || key > 122){
                if(key != 32){
                    e.keyCode=0;
                    objControl.focus();
                    mostrarMensajeModal(500,'ok','! Ingrese solo letras ¡','../_img/alerta.png');
                }
            }
            break;

        case 'alfaNumerico':
            if(key < 48 || key > 122){
                if(key != 32){
                    e.keyCode=0;
                    objControl.focus();
                    mostrarMensajeModal(500,'ok','! Ingrese solo numeros y letras ¡','../_img/alerta.png');
                }
            }
            break;
        case 'decimales':
            if (key < 48 || key > 57){
                if(key != 46){
                    e.keyCode=0;
                    objControl.focus();
                    alert('! Ingrese solo números y/o decimales ¡')
                }
            }
            break;
            
        default:
            break;
    }
    return key=0;
}

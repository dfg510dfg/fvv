<?php
include("Mysql.php");

class Datos {

    public static function getCombo($mostrar,$vValores,$valorPorDefecto) {
        $objMysql = new Mysql();
        $salida = NULL;
        $val = $vValores[0]; // parametr 1 pasado por array
        $val2 = $vValores[1]; // parametr 2 pasado por array
        try {
            switch ($mostrar) {
                case 'cmb':
                    $salida = $objMysql->getDropDownList("SELECT idnivel AS 'codigo', nombre as 'descripcion' FROM ".DB_PREFIJO."_nivel WHERE nombre<>'' ", $valorPorDefecto);
                    break;
                case 'cmbPosicion':
                    $salida = $objMysql->getDropDownList("SELECT posicion AS 'codigo', posicion as 'descripcion' FROM ".DB_PREFIJO."_menumnt WHERE idcontenedor=".$vValores." ORDER BY posicion ASC; ", $valorPorDefecto);
                    break;
                case 'cmbClase':
                    $salida = $objMysql->getDropDownList("SELECT idclase AS 'codigo', nombre as 'descripcion' FROM ".DB_PREFIJO."_clase WHERE eliminado<>1 and nombre<>'' ORDER BY nombre ASC;", $valorPorDefecto);
                    break;
                case 'cmbCategoria':
                    $salida = $objMysql->getDropDownList("SELECT idcategoria AS 'codigo', nombre as 'descripcion' FROM ".DB_PREFIJO."_categoria WHERE eliminado<>1 and nombre<>'' ORDER BY nombre ASC;", $valorPorDefecto);
                    break;
                case 'cmbGenero':
                    $salida = $objMysql->getDropDownList("SELECT idgenero AS 'codigo', nombre as 'descripcion' FROM ".DB_PREFIJO."_genero WHERE eliminado<>1 and nombre<>'' ORDER BY nombre ASC;", $valorPorDefecto);
                    break;
                case 'cmbPerfil':
                    $salida = $objMysql->getDropDownList("SELECT idperfil AS 'codigo', nombre as 'descripcion' FROM ".DB_PREFIJO."_perfil WHERE eliminado<>1 and nombre<>'' ORDER BY nombre ASC;", $valorPorDefecto);
                    break;
                case 'cmbProductos':
                    $salida = $objMysql->getDropDownList("SELECT idproducto AS 'codigo', nombre as 'descripcion' FROM ".DB_PREFIJO."_productos WHERE nombre<>'' ORDER BY nombre ASC;", $valorPorDefecto);
                    break;
                case 'cmbPagina':
                    $salida = $objMysql->getDropDownList("SELECT idpaginaweb AS 'codigo', titulopagweb as 'descripcion' FROM ".DB_PREFIJO."_pagina WHERE titulopagweb<>'' ORDER BY titulopagweb ASC;", $valorPorDefecto);
                    break;
                case 'cmbOcasion':
                    $salida = $objMysql->getDropDownList("SELECT idocasion AS 'codigo', nombre as 'descripcion' FROM ".DB_PREFIJO."_ocasion WHERE eliminado<>1 and nombre<>'' ORDER BY nombre ASC;", $valorPorDefecto);
                    break;
                case 'cmbNivel':
                    $salida = $objMysql->getDropDownList("SELECT idmenu AS 'codigo', campo as 'descripcion' FROM ".DB_PREFIJO."_menumnt WHERE eliminado<>1 and campo<>''and nivel=".$vValores." ORDER BY campo ASC;", $valorPorDefecto);
                    break;
                case 'cmbDirectorio':
                    $salida = $objMysql->getDropDownList("SELECT iddirectorio AS 'codigo', campo as 'descripcion' FROM ".DB_PREFIJO."_directorio WHERE nivel=".$vValores." ORDER BY campo ASC;", $valorPorDefecto);
                    break;
                case 'cmbDirectorioPosicion':
                    $salida = $objMysql->getDropDownList("SELECT posicion AS 'codigo', posicion as 'descripcion' FROM ".DB_PREFIJO."_directorio WHERE idcontenedor=".$vValores." ORDER BY posicion ASC; ", $valorPorDefecto);
                    break;
            }
        } catch (Exception $exc) {
            $salida = $exc->getTraceAsString();
        }
        return $salida;
    }



    public static function getConsulta(array $vParam){
        $objMysql = new Mysql();
        $salida = NULL;
        $mostrar = $vParam[0]; // parametr 1 pasado por array
        $val1 = $vParam[1]; // parametr 2 pasado por array
        $ordenarPorCampo = $vParam[2];
        $ordenarEnForma = $vParam[3];
        $campoaBuscar = $vParam[4];
        $valoraBuscar = $vParam[5];
        $page = $vParam[6];
        $mostrarRegistros = $vParam[7]; 
        $queryOedenar = "";
        /* --------  instrucciones de orden ----------------------- */
        if(!empty($ordenarPorCampo) && !empty($ordenarEnForma)){
            if($ordenarEnForma == "ASC"){
                $ordenarEnForma = "DESC";
            } else {
                $ordenarEnForma = "ASC";
            }
            $queryOedenar=" order by ".$ordenarPorCampo." ".$ordenarEnForma." ";
        }
        /* -------------------------------------- */
        try {
            switch ($mostrar) {
                case 'listarUsuario':
                       /* --------  instrucciones de busqueda ----------------------- */
                        $queryBuscar = "";
                        if(!empty($campoaBuscar) && !empty($valoraBuscar)){
                            if($campoaBuscar=="codigo"){
                                $queryBuscar=" and u.idusuario='".$valoraBuscar."' ";
                            } else {
                                $queryBuscar=" and u.usuario like '".$valoraBuscar."%' ";
                            }
                        }
                        /* -------------------------------------- */
                        $datos = $objMysql->ejecutar("SELECT 
                                                            u.idusuario AS 'codigo' 
                                                        FROM ".DB_PREFIJO."_usuarios u 
                                                        WHERE u.eliminado<>1 
                                                        ".$queryBuscar." ;");
                        
                        
                        //MIRO CUANTOS DATOS FUERON DEVUELTOS
                        $num_rows = $datos->rowCount();

                        //ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR P?GINA , EN EL EJEMPLO PONGO 15
                        $rows_per_page = $mostrarRegistros;
                        $num_page_view = 2;
                        $num_page_next = 1;
                        //CALCULO LA ULTIMA P?GINA
                        $lastpage = ceil($num_rows / $rows_per_page);

                        //COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA P?GINA
                        $page = (int) $page;
                        if ($page > $lastpage) {
                            $page = $lastpage;
                        }
                        if ($page < 1) {
                            $page = 1;
                        }

                        //CREO LA SENTENCIA LIMIT PARA A?ADIR A LA CONSULTA QUE DEFINITIVA
                        $limit = " LIMIT " . ($page - 1) * $rows_per_page . ',' . $rows_per_page;
                        
                        $salida = $objMysql->ejecutar("SELECT 
                                                            u.idusuario as 'codigo',
                                                            u.usuario as 'nombre',
                                                            '********' as 'clave',
                                                            u.correo,
                                                            p.nombre as 'perfil',  
                                                            DATE_FORMAT(u.feccrea,'%d/%m/%Y') as 'feccrea', 
                                                            DATE_FORMAT(u.fecmodif,'%d/%m/%Y') as 'fecmodf' 
                                                        FROM ".DB_PREFIJO."_usuarios u 
                                                            INNER JOIN ".DB_PREFIJO."_perfil p on u.idperfil=p.idperfil 
                                                        WHERE u.eliminado<>1    
                                                            ".$queryBuscar."  ".$queryOedenar." ".$limit." ;");
                        
                  break;
                case 'listarUsuarioTot':
                        $rs = $objMysql->ejecutar("SELECT count(*) as 'cant' FROM ".DB_PREFIJO."_usuarios u  
                                                            where u.eliminado<>1;");
                        $fila = $rs->fetch(PDO::FETCH_ASSOC);
                        $salida=$fila["cant"];
                    break;  
                
                case 'listarPopup':

                       /* --------  instrucciones de busqueda ----------------------- */

                        $queryBuscar = "";

                        if(!empty($campoaBuscar) && !empty($valoraBuscar)){

                            if($campoaBuscar=="codigo"){

                                $queryBuscar=" where p.idpopup ='".$valoraBuscar."' ";

                            } else {

                                $queryBuscar=" where p.nom like '".$valoraBuscar."%' ";

                            }

                        }

                        /* -------------------------------------- */

                        $datos = $objMysql->ejecutar("SELECT p.idpopup AS 'codigo' FROM ".DB_PREFIJO."_popup p ".$queryBuscar." ;");

                        

                        //MIRO CUANTOS DATOS FUERON DEVUELTOS

                        $num_rows = $datos->rowCount();



                        //ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR P?GINA , EN EL EJEMPLO PONGO 15

                        $rows_per_page = $mostrarRegistros;

                        $num_page_view = 2;

                        $num_page_next = 1;

                        //CALCULO LA ULTIMA P?GINA

                        $lastpage = ceil($num_rows / $rows_per_page);



                        //COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA P?GINA

                        $page = (int) $page;

                        if ($page > $lastpage) {

                            $page = $lastpage;

                        }

                        if ($page < 1) {

                            $page = 1;

                        }



                        //CREO LA SENTENCIA LIMIT PARA A?ADIR A LA CONSULTA QUE DEFINITIVA

                        $limit = " LIMIT " . ($page - 1) * $rows_per_page . ',' . $rows_per_page;

                        

                        $salida = $objMysql->ejecutar("SELECT 

                                                            p.idpopup as 'codigo',

                                                            p.nom as 'nombre',

                                                            CONCAT('<img src=\"../imgs_banner/',p.img,'\" width=\"100\"/>') AS 'foto', 

                                                            p.ancho,

                                                            p.alto,

                                                            p.position,

                                                            IF(p.swactivo=1,'ACTIVO','NO ACTIVO') AS 'estado' 

                                                            FROM ".DB_PREFIJO."_popup p 	     

                                                            ".$queryBuscar."  ".$queryOedenar." ".$limit." ;");

                  break;

                case 'listarPopupTot':

                        $rs = $objMysql->ejecutar("SELECT count(*) as 'cant' FROM ".DB_PREFIJO."_popup p;");

                        $fila = $rs->fetch(PDO::FETCH_ASSOC);

                        $salida=$fila["cant"];

                    break;  
                case 'listarConvocatorias':
                       /* --------  instrucciones de busqueda ----------------------- */
                        $queryBuscar = "1=1";
                        if(!empty($campoaBuscar) && !empty($valoraBuscar)){
                            if($campoaBuscar=="codigo"){
                                $queryBuscar.=" and c.idconvocatoria ='".$valoraBuscar."' ";
                            } else {
                                $queryBuscar.=" and c.descripcion like '".$valoraBuscar."%' ";
                            }
                        }
                        /* -------------------------------------- */
                        $datos = $objMysql->ejecutar("SELECT 
                                                            c.idconvocatoria AS 'codigo',
                                                            c.descripcion AS 'descripcion',
                                                            Date_format(c.fecini,'%d/%m/%Y') AS 'inicio',
                                                            Date_format(c.fecfin,'%d/%m/%Y') AS 'final',
                                                            if(CURDATE()>fecfin,'TERMINADO','VIGENTE')  AS 'estado'
                                                        FROM ".DB_PREFIJO."_convocatoria c
                                                        WHERE ".$queryBuscar." ;");
                        
                        
                        //MIRO CUANTOS DATOS FUERON DEVUELTOS
                        $num_rows = $datos->rowCount();

                        //ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR P?GINA , EN EL EJEMPLO PONGO 15
                        $rows_per_page = $mostrarRegistros;
                        $num_page_view = 2;
                        $num_page_next = 1;
                        //CALCULO LA ULTIMA P?GINA
                        $lastpage = ceil($num_rows / $rows_per_page);

                        //COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA P?GINA
                        $page = (int) $page;
                        if ($page > $lastpage) {
                            $page = $lastpage;
                        }
                        if ($page < 1) {
                            $page = 1;
                        }

                        //CREO LA SENTENCIA LIMIT PARA A?ADIR A LA CONSULTA QUE DEFINITIVA
                        $limit = " LIMIT " . ($page - 1) * $rows_per_page . ',' . $rows_per_page;
                        
                        $salida = $objMysql->ejecutar("SELECT 
                                                            c.idconvocatoria AS 'codigo',
                                                            c.descripcion AS 'descripcion',
                                                            Date_format(c.fecini,'%d/%m/%Y') AS 'inicio',
                                                            Date_format(c.fecfin,'%d/%m/%Y') AS 'final',
                                                            if(CURDATE()>fecfin,'TERMINADO','VIGENTE')  AS 'estado'
                                                        FROM ".DB_PREFIJO."_convocatoria c
                                                        WHERE    
                                                            ".$queryBuscar."  ".$queryOedenar." ".$limit." ;");
                        
                  break;
                case 'listarConvocatoriasTot':
                        $rs = $objMysql->ejecutar("SELECT count(*) as 'cant' FROM ".DB_PREFIJO."_convocatoria c;");
                        $fila = $rs->fetch(PDO::FETCH_ASSOC);
                        $salida=$fila["cant"];
                    break;
                case 'listarBanner':
                       /* --------  instrucciones de busqueda ----------------------- */
                        $queryBuscar = "";
                        if(!empty($campoaBuscar) && !empty($valoraBuscar)){
                            if($campoaBuscar=="codigo"){
                                $queryBuscar=" and b.idbanner ='".$valoraBuscar."' ";
                            } else {
                                $queryBuscar=" and b.titulo like '".$valoraBuscar."%' ";
                            }
                        }
                        /* -------------------------------------- */
                        $datos = $objMysql->ejecutar("SELECT 
                                                            b.idbanner AS 'codigo' 
                                                        FROM ".DB_PREFIJO."_banner b
                                                        WHERE b.eliminado<>1 
                                                        ".$queryBuscar." ;");
                        
                        
                        //MIRO CUANTOS DATOS FUERON DEVUELTOS
                        $num_rows = $datos->rowCount();

                        //ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR P?GINA , EN EL EJEMPLO PONGO 15
                        $rows_per_page = $mostrarRegistros;
                        $num_page_view = 2;
                        $num_page_next = 1;
                        //CALCULO LA ULTIMA P?GINA
                        $lastpage = ceil($num_rows / $rows_per_page);

                        //COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA P?GINA
                        $page = (int) $page;
                        if ($page > $lastpage) {
                            $page = $lastpage;
                        }
                        if ($page < 1) {
                            $page = 1;
                        }

                        //CREO LA SENTENCIA LIMIT PARA A?ADIR A LA CONSULTA QUE DEFINITIVA
                        $limit = " LIMIT " . ($page - 1) * $rows_per_page . ',' . $rows_per_page;
                        
                        $salida = $objMysql->ejecutar("SELECT 
                                                            b.idbanner as 'codigo',
                                                            b.titulo as 'nombre',
                                                            CONCAT('<img src=\"../',b.foto,'\" width=\"80\"/>') AS 'foto',
                                                            b.descripcion,
                                                            b.orden,
                                                            IF(b.enlace=1,'sin enlace',IF(b.enlace=2,'pagina',b.url)),
                                                            IF(b.mostrar=1,'ACTIVO','DESACTIVADO') AS 'estado' 
                                                        FROM ".DB_PREFIJO."_banner b
                                                        WHERE b.eliminado<>1    
                                                            ".$queryBuscar."  ".$queryOedenar." ".$limit." ;");
                        
                  break;
                case 'listarBannerTot':
                        $rs = $objMysql->ejecutar("SELECT count(*) as 'cant' FROM ".DB_PREFIJO."_banner b 
                                                            where b.eliminado<>1;");
                        $fila = $rs->fetch(PDO::FETCH_ASSOC);
                        $salida=$fila["cant"];
                    break;
                case 'listarProyecto':
                       /* --------  instrucciones de busqueda ----------------------- */
                        $queryBuscar = "";
                        if(!empty($campoaBuscar) && !empty($valoraBuscar)){
                            if($campoaBuscar=="codigo"){
                                $queryBuscar=" and b.idproyecto ='".$valoraBuscar."' ";
                            } else {
                                $queryBuscar=" and b.descripcion like '%".$valoraBuscar."%' ";
                            }
                        }
                        /* -------------------------------------- */
                        $datos = $objMysql->ejecutar("SELECT 
                                                            b.idproyecto AS 'codigo' 
                                                        FROM ".DB_PREFIJO."_proyecto b
                                                        WHERE 1=1 
                                                        ".$queryBuscar." ;");
                        
                        
                        //MIRO CUANTOS DATOS FUERON DEVUELTOS
                        $num_rows = $datos->rowCount();

                        //ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR P?GINA , EN EL EJEMPLO PONGO 15
                        $rows_per_page = $mostrarRegistros;
                        $num_page_view = 2;
                        $num_page_next = 1;
                        //CALCULO LA ULTIMA P?GINA
                        $lastpage = ceil($num_rows / $rows_per_page);

                        //COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA P?GINA
                        $page = (int) $page;
                        if ($page > $lastpage) {
                            $page = $lastpage;
                        }
                        if ($page < 1) {
                            $page = 1;
                        }

                        //CREO LA SENTENCIA LIMIT PARA A?ADIR A LA CONSULTA QUE DEFINITIVA
                        $limit = " LIMIT " . ($page - 1) * $rows_per_page . ',' . $rows_per_page;
                        $query="SELECT 
                                                            b.idproyecto as 'codigo',
                                                            b.descripcion as 'nombre',
                                                            CONCAT('<img src=\"../',b.foto,'\" width=\"80\"/>') AS 'foto',
                                                            if(b.contenido=1,'sin enlace',if(b.contenido=2,(select p.titulopagweb from cms_pagina p where p.idpaginaweb=b.url),b.url))
                                                        FROM ".DB_PREFIJO."_proyecto b
                                                        WHERE 1=1 
                                                            ".$queryBuscar."  ".$queryOedenar." ".$limit." ;";
                        $salida = $objMysql->ejecutar($query);
                        
                  break;
                case 'listarProyectoTot':
                        $rs = $objMysql->ejecutar("SELECT count(*) as 'cant' FROM ".DB_PREFIJO."_proyecto;");
                        $fila = $rs->fetch(PDO::FETCH_ASSOC);
                        $salida=$fila["cant"];
                    break;
                case 'listarServicios':
                       /* --------  instrucciones de busqueda ----------------------- */
                        $queryBuscar = "";
                        if(!empty($campoaBuscar) && !empty($valoraBuscar)){
                            if($campoaBuscar=="codigo"){
                                $queryBuscar=" and s.idservicio ='".$valoraBuscar."' ";
                            } else {
                                $queryBuscar=" and s.titulo like '".$valoraBuscar."%' ";
                            }
                        }
                        /* -------------------------------------- */
                        $datos = $objMysql->ejecutar("SELECT 
                                                            s.idservicio AS 'codigo' 
                                                        FROM ".DB_PREFIJO."_servicio s
                                                        WHERE s.eliminado<>1 
                                                        ".$queryBuscar." ;");
                        
                        
                        //MIRO CUANTOS DATOS FUERON DEVUELTOS
                        $num_rows = $datos->rowCount();

                        //ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR P?GINA , EN EL EJEMPLO PONGO 15
                        $rows_per_page = $mostrarRegistros;
                        $num_page_view = 2;
                        $num_page_next = 1;
                        //CALCULO LA ULTIMA P?GINA
                        $lastpage = ceil($num_rows / $rows_per_page);

                        //COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA P?GINA
                        $page = (int) $page;
                        if ($page > $lastpage) {
                            $page = $lastpage;
                        }
                        if ($page < 1) {
                            $page = 1;
                        }

                        //CREO LA SENTENCIA LIMIT PARA A?ADIR A LA CONSULTA QUE DEFINITIVA
                        $limit = " LIMIT " . ($page - 1) * $rows_per_page . ',' . $rows_per_page;
                        
                        $salida = $objMysql->ejecutar("SELECT 
                                                            s.idservicio as 'codigo',
                                                            s.titulo as 'nombre',
                                                            CONCAT('<img src=\"../',s.foto,'\" width=\"80\"/>') AS 'foto',
                                                            if(s.idpagina=0,'No asociado',(select titulopagweb from ".DB_PREFIJO."_pagina
															where idpaginaweb=s.idpagina)) as 'pagina',
                                                            IF(s.eliminado=0,'ACTIVO','ELIMINADO') AS 'estado' 
                                                            FROM ".DB_PREFIJO."_servicio s
                                                            WHERE s.eliminado<>1  
                                                            ".$queryBuscar."  ".$queryOedenar." ".$limit." ;");
                        
                  break;
                case 'listarServiciosTot':
                        $rs = $objMysql->ejecutar("SELECT count(*) as 'cant' FROM ".DB_PREFIJO."_servicio s 
                                                            where s.eliminado<>1;");
                        $fila = $rs->fetch(PDO::FETCH_ASSOC);
                        $salida=$fila["cant"];
                    break;
                case 'listarBannerInterno':
                       /* --------  instrucciones de busqueda ----------------------- */
                        $queryBuscar = "";
                        if(!empty($campoaBuscar) && !empty($valoraBuscar)){
                            if($campoaBuscar=="codigo"){
                                $queryBuscar=" and b.idbannerinterior ='".$valoraBuscar."' ";
                            } else {
                                $queryBuscar=" and b.titulo like '".$valoraBuscar."%' ";
                            }
                        }
                        /* -------------------------------------- */
                        $datos = $objMysql->ejecutar("SELECT 
                                                            b.idbannerinterior AS 'codigo' 
                                                        FROM ".DB_PREFIJO."_bannerinterior b
                                                        WHERE b.eliminado<>1 
                                                        ".$queryBuscar." ;");
                        
                        
                        //MIRO CUANTOS DATOS FUERON DEVUELTOS
                        $num_rows = $datos->rowCount();

                        //ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR P?GINA , EN EL EJEMPLO PONGO 15
                        $rows_per_page = $mostrarRegistros;
                        $num_page_view = 2;
                        $num_page_next = 1;
                        //CALCULO LA ULTIMA P?GINA
                        $lastpage = ceil($num_rows / $rows_per_page);

                        //COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA P?GINA
                        $page = (int) $page;
                        if ($page > $lastpage) {
                            $page = $lastpage;
                        }
                        if ($page < 1) {
                            $page = 1;
                        }

                        //CREO LA SENTENCIA LIMIT PARA A?ADIR A LA CONSULTA QUE DEFINITIVA
                        $limit = " LIMIT " . ($page - 1) * $rows_per_page . ',' . $rows_per_page;
                        
                        $salida = $objMysql->ejecutar("SELECT 
                                                            b.idbannerinterior as 'codigo',
                                                            b.titulo as 'nombre',
                                                            CONCAT('<img src=\"../',b.foto,'\" width=\"80\"/>') AS 'foto',
                                                            if(b.idpagina=0,'----','ASOCIADO') as 'pagina',
                                                            IF(b.eliminado=0,'ACTIVO','ELIMINADO') AS 'estado' 
                                                        FROM ".DB_PREFIJO."_bannerinterior b
                                                        WHERE b.eliminado<>1    
                                                            ".$queryBuscar."  ".$queryOedenar." ".$limit." ;");
                        
                  break;
                case 'listarBannerInternoTot':
                        $rs = $objMysql->ejecutar("SELECT count(*) as 'cant' FROM ".DB_PREFIJO."_bannerinterior b 
                                                            where b.eliminado<>1;");
                        $fila = $rs->fetch(PDO::FETCH_ASSOC);
                        $salida=$fila["cant"];
                    break;
                case 'listarPagina':
                       /* --------  instrucciones de busqueda ----------------------- */
                        $queryBuscar = "WHERE p.tipo=1";
                        if(!empty($campoaBuscar) && !empty($valoraBuscar)){
                            if($campoaBuscar=="codigo"){
                                $queryBuscar="WHERE p.tipo=1 AND p.idpaginaweb ='".$valoraBuscar."' ";
                            } else {
                                $queryBuscar="WHERE p.tipo=1 AND p.titulopagweb like '".$valoraBuscar."%' ";
                            }
                        }
                        /* -------------------------------------- */
                        $datos = $objMysql->ejecutar("SELECT p.idpaginaweb AS 'codigo',
                                                             p.titulopagweb AS 'titulo',
                                                             IF(p.tipo=1,'PAGINA','NOTICIA') AS 'tipo', 
                                                             p.descriptag AS 'tag', 
                                                             IF(p.activo=1,'ACTIVO','NO ACTIVO') AS 'estado'
                                                             FROM ".DB_PREFIJO."_pagina p
                                                             ".$queryBuscar."  ".$queryOedenar.";");
                        
                        
                        //MIRO CUANTOS DATOS FUERON DEVUELTOS
                        $num_rows = $datos->rowCount();

                        //ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR P?GINA , EN EL EJEMPLO PONGO 15
                        $rows_per_page = $mostrarRegistros;
                        $num_page_view = 2;
                        $num_page_next = 1;
                        //CALCULO LA ULTIMA P?GINA
                        $lastpage = ceil($num_rows / $rows_per_page);

                        //COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA P?GINA
                        $page = (int) $page;
                        if ($page > $lastpage) {
                            $page = $lastpage;
                        }
                        if ($page < 1) {
                            $page = 1;
                        }

                        //CREO LA SENTENCIA LIMIT PARA A?ADIR A LA CONSULTA QUE DEFINITIVA
                        $limit = " LIMIT " . ($page - 1) * $rows_per_page . ',' . $rows_per_page;
                        
                        $salida = $objMysql->ejecutar("SELECT p.idpaginaweb AS 'codigo',p.titulopagweb AS 'titulo', IF(p.tipo=1,'PAGINA','NOTICIA') AS 'tipo', p.descriptag AS 'tag',IF(p.activo=0,'NO ACTIVO','ACTIVO') AS 'estado' ". 
                                                                    "FROM ".DB_PREFIJO."_pagina p  
                                                                    ".$queryBuscar."  ".$queryOedenar." ".$limit." ;");
                        
                  break;
                case 'listarPaginaTot':
                        $rs = $objMysql->ejecutar("SELECT count(*) as 'cant' FROM ".DB_PREFIJO."_pagina p WHERE tipo=1;");
                                                            //".$queryBuscar."  ".$queryOedenar." ;");
                        $fila = $rs->fetch(PDO::FETCH_ASSOC);
                        $salida=$fila["cant"];

                    break; 
                case 'listarContactenos':
                       /* --------  instrucciones de busqueda ----------------------- */
                        $queryBuscar = "";
                        if(!empty($campoaBuscar) && !empty($valoraBuscar)){
                            if($campoaBuscar=="codigo"){
                                $queryBuscar="WHERE c.idcontactenos ='".$valoraBuscar."' ";
                            } else {
                                $queryBuscar="WHERE c.nombre like '%".$valoraBuscar."%' ";
                            }
                        }
                        /* -------------------------------------- */
                        $datos = $objMysql->ejecutar("SELECT c.idcontactenos AS 'codigo',
                                                            DATE_FORMAT(c.fecha,'%d/%m/%Y') AS 'fechaa',
                                                            DATE_FORMAT(c.hora,'%h:%i %p') AS 'horaa',
                                                            c.nombre AS 'contacto',
                                                            c.telefono AS 'telefono',
                                                            c.email AS 'correo',
                                                            IF(c.estado=1,'RESPONDIDO','CONSULTA') AS 'estado'
                                                            FROM ".DB_PREFIJO."_contactenos c
                                                            ".$queryBuscar."  order by fecha,hora asc;");
                        
                        
                        //MIRO CUANTOS DATOS FUERON DEVUELTOS
                        $num_rows = $datos->rowCount();

                        //ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR P?GINA , EN EL EJEMPLO PONGO 15
                        $rows_per_page = $mostrarRegistros;
                        $num_page_view = 2;
                        $num_page_next = 1;
                        //CALCULO LA ULTIMA P?GINA
                        $lastpage = ceil($num_rows / $rows_per_page);

                        //COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA P?GINA
                        $page = (int) $page;
                        if ($page > $lastpage) {
                            $page = $lastpage;
                        }
                        if ($page < 1) {
                            $page = 1;
                        }

                        //CREO LA SENTENCIA LIMIT PARA A?ADIR A LA CONSULTA QUE DEFINITIVA
                        $limit = " LIMIT " . ($page - 1) * $rows_per_page . ',' . $rows_per_page;
                        
                        $salida = $objMysql->ejecutar("SELECT c.idcontactenos AS 'codigo',
                                                            DATE_FORMAT(c.fecha,'%d/%m/%Y') AS 'fechaa',
                                                            DATE_FORMAT(c.hora,'%h:%i %p') AS 'horaa',
                                                            c.nombre AS 'contacto',
                                                            c.telefono AS 'telefono',
                                                            c.email AS 'correo',
                                                            IF(c.estado=1,'RESPONDIDO','CONSULTA') AS 'estado' ". 
                                                                    "FROM ".DB_PREFIJO."_contactenos c  
                                                                    ".$queryBuscar."  order by fecha,hora asc ".$limit." ;");
                        
                  break;
                case 'listarContactenosTot':
                        $rs = $objMysql->ejecutar("SELECT count(*) as 'cant' FROM ".DB_PREFIJO."_contactenos c;");
                                                            //".$queryBuscar."  ".$queryOedenar." ;");
                        $fila = $rs->fetch(PDO::FETCH_ASSOC);
                        $salida=$fila["cant"];

                    break;
                case 'listarNovedades':
                       /* --------  instrucciones de busqueda ----------------------- */
                        $queryBuscar = "";
                        if(!empty($campoaBuscar) && !empty($valoraBuscar)){
                            if($campoaBuscar=="codigo"){
                                $queryBuscar=" and n.idnovedades ='".$valoraBuscar."' ";
                            } else {
                                $queryBuscar=" and n.nombre like '".$valoraBuscar."%' ";
                            }
                        }
                        /* -------------------------------------- */
                        $datos = $objMysql->ejecutar("SELECT 
                                                            n.idnovedades AS 'codigo' 
                                                        FROM ".DB_PREFIJO."_novedades n 
                                                        WHERE n.eliminado<>1 
                                                        ".$queryBuscar." ;");
                        
                        
                        //MIRO CUANTOS DATOS FUERON DEVUELTOS
                        $num_rows = $datos->rowCount();

                        //ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR P?GINA , EN EL EJEMPLO PONGO 15
                        $rows_per_page = $mostrarRegistros;
                        $num_page_view = 2;
                        $num_page_next = 1;
                        //CALCULO LA ULTIMA P?GINA
                        $lastpage = ceil($num_rows / $rows_per_page);

                        //COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA P?GINA
                        $page = (int) $page;
                        if ($page > $lastpage) {
                            $page = $lastpage;
                        }
                        if ($page < 1) {
                            $page = 1;
                        }

                        //CREO LA SENTENCIA LIMIT PARA A?ADIR A LA CONSULTA QUE DEFINITIVA
                        $limit = " LIMIT " . ($page - 1) * $rows_per_page . ',' . $rows_per_page;
                        
                        $salida = $objMysql->ejecutar("SELECT 
                                                            n.idnovedades as 'codigo',
                                                            n.nombre as 'nombre',
                                                            CONCAT('<img src=\"../../',n.foto,'\" width=\"80\"/>') AS 'foto',
                                                            n.enlace,
                                                            n.ubicacion,
                                                            IF(n.mostrar=0,'NO','SI') AS 'Mostrar',  
                                                            IF(n.eliminado=0,'ACTIVO','ELIMINADO') AS 'estado' 
                                                        FROM ".DB_PREFIJO."_novedades n 
                                                        WHERE n.eliminado<>1    
                                                            ".$queryBuscar."  ".$queryOedenar." ".$limit." ;");
                        
                  break;
                case 'listarNovedadesTot':
                        $rs = $objMysql->ejecutar("SELECT count(*) as 'cant' FROM ".DB_PREFIJO."_novedades n  
                                                            where n.eliminado<>1;");
                        $fila = $rs->fetch(PDO::FETCH_ASSOC);
                        $salida=$fila["cant"];
                    break;  
                case 'listarProducto':
                       /* --------  instrucciones de busqueda ----------------------- */
                        $queryBuscar = "";
                        if(!empty($campoaBuscar) && !empty($valoraBuscar)){
                            if($campoaBuscar=="codigo"){
                                $queryBuscar=" and p.idproducto ='".$valoraBuscar."' ";
                            } else {
                                $queryBuscar=" and p.nombre like '".$valoraBuscar."%' ";
                            }
                        }
                        /* -------------------------------------- */
                        $datos = $objMysql->ejecutar("SELECT 
                                                            p.idproducto AS 'codigo' 
                                                        FROM ".DB_PREFIJO."_productos p
                                                                INNER JOIN ".DB_PREFIJO."_categoria c ON p.idcategoria=c.idcategoria 
	 
                                                        WHERE p.eliminado<>1 
                                                        ".$queryBuscar." ;");
                        
                        
                        //MIRO CUANTOS DATOS FUERON DEVUELTOS
                        $num_rows = $datos->rowCount();

                        //ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR P?GINA , EN EL EJEMPLO PONGO 15
                        $rows_per_page = $mostrarRegistros;
                        $num_page_view = 2;
                        $num_page_next = 1;
                        //CALCULO LA ULTIMA P?GINA
                        $lastpage = ceil($num_rows / $rows_per_page);

                        //COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA P?GINA
                        $page = (int) $page;
                        if ($page > $lastpage) {
                            $page = $lastpage;
                        }
                        if ($page < 1) {
                            $page = 1;
                        }

                        //CREO LA SENTENCIA LIMIT PARA A?ADIR A LA CONSULTA QUE DEFINITIVA
                        $limit = " LIMIT " . ($page - 1) * $rows_per_page . ',' . $rows_per_page;
                        
                        $salida = $objMysql->ejecutar("SELECT 
                                                            p.idproducto as 'codigo',
                                                            p.codigo as 'modelo',
                                                            p.nombre as 'nombre',
                                                            c.nombre AS 'categoria',
                                                            IF(p.destacado=1,'ACTIVO','DESACTIVADO') AS 'mostrar'
                                                        FROM ".DB_PREFIJO."_productos p
                                                                INNER JOIN ".DB_PREFIJO."_categoria c ON p.idcategoria=c.idcategoria 
                                                                
                                                        WHERE p.eliminado<>1    
                                                            ".$queryBuscar."  ".$queryOedenar." ".$limit." ;");
                        
                  break;
                case 'listarProductoTot':
                        $rs = $objMysql->ejecutar("SELECT count(*) as 'cant' FROM ".DB_PREFIJO."_productos p 
                                                            where p.eliminado<>1;");
                        $fila = $rs->fetch(PDO::FETCH_ASSOC);
                        $salida=$fila["cant"];

                    break;
                case 'listarCategoria':
                       /* --------  instrucciones de busqueda ----------------------- */
                        $queryBuscar = "";
                        if(!empty($campoaBuscar) && !empty($valoraBuscar)){
                            if($campoaBuscar=="codigo"){
                                $queryBuscar=" and c.idcategoria ='".$valoraBuscar."' ";
                            } else {
                                $queryBuscar=" and c.nombre like '".$valoraBuscar."%' ";
                            }
                        }
                        /* -------------------------------------- */
                        $datos = $objMysql->ejecutar("SELECT c.idcategoria AS 'codigo',c.nombre,cl.nombre AS 'Familia',c.feccrea,c.fecmodif,IF(c.eliminado=0,'ACTIVO','ELIMINADO') AS 'estado' FROM ".DB_PREFIJO."_categoria c 
                                                            INNER JOIN ".DB_PREFIJO."_clase cl ON c.idclase=cl.idclase
                                                            WHERE c.eliminado<>1       
                                                            ".$queryBuscar."  ".$queryOedenar.";");
                        
                        
                        //MIRO CUANTOS DATOS FUERON DEVUELTOS
                        $num_rows = $datos->rowCount();

                        //ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR P?GINA , EN EL EJEMPLO PONGO 15
                        $rows_per_page = $mostrarRegistros;
                        $num_page_view = 2;
                        $num_page_next = 1;
                        //CALCULO LA ULTIMA P?GINA
                        $lastpage = ceil($num_rows / $rows_per_page);

                        //COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA P?GINA
                        $page = (int) $page;
                        if ($page > $lastpage) {
                            $page = $lastpage;
                        }
                        if ($page < 1) {
                            $page = 1;
                        }

                        //CREO LA SENTENCIA LIMIT PARA A?ADIR A LA CONSULTA QUE DEFINITIVA
                        $limit = " LIMIT " . ($page - 1) * $rows_per_page . ',' . $rows_per_page;
                        
                        $salida = $objMysql->ejecutar("SELECT c.idcategoria AS 'codigo',c.nombre,cl.nombre AS 'Familia',c.feccrea,c.fecmodif,IF(c.eliminado=0,'ACTIVO','ELIMINADO') AS 'estado' FROM ".DB_PREFIJO."_categoria c 
                                                            INNER JOIN ".DB_PREFIJO."_clase cl ON c.idclase=cl.idclase
                                                            WHERE c.eliminado<>1   
                                                            ".$queryBuscar."  ".$queryOedenar." ".$limit." ;");
                        
                  break;
                case 'listarCategoriaTot':
                        $rs = $objMysql->ejecutar("SELECT count(*) as 'cant' FROM ".DB_PREFIJO."_categoria c 
                                                            where c.eliminado<>1;");
                                                            //".$queryBuscar."  ".$queryOedenar." ;");
                        $fila = $rs->fetch(PDO::FETCH_ASSOC);
                        $salida=$fila["cant"];

                    break;  
                case 'listarClases':
                       /* --------  instrucciones de busqueda ----------------------- */
                        $queryBuscar = "";
                        if(!empty($campoaBuscar) && !empty($valoraBuscar)){
                            if($campoaBuscar=="codigo"){
                                $queryBuscar=" and c.idclase ='".$valoraBuscar."' ";
                            } else {
                                $queryBuscar=" and c.nombre like '".$valoraBuscar."%' ";
                            }
                        }
                        /* -------------------------------------- */
                        $datos = $objMysql->ejecutar("SELECT c.idclase as 'codigo',c.nombre,c.feccrea,c.fecmodif,IF(c.eliminado=0,'ACTIVO','ELIMINADO') AS 'estado' FROM ".DB_PREFIJO."_clase c 
                                                            where c.eliminado<>1   
                                                            ".$queryBuscar."  ".$queryOedenar.";");
                        
                        
                        //MIRO CUANTOS DATOS FUERON DEVUELTOS
                        $num_rows = $datos->rowCount();

                        //ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR P?GINA , EN EL EJEMPLO PONGO 15
                        $rows_per_page = $mostrarRegistros;
                        $num_page_view = 2;
                        $num_page_next = 1;
                        //CALCULO LA ULTIMA P?GINA
                        $lastpage = ceil($num_rows / $rows_per_page);

                        //COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA P?GINA
                        $page = (int) $page;
                        if ($page > $lastpage) {
                            $page = $lastpage;
                        }
                        if ($page < 1) {
                            $page = 1;
                        }

                        //CREO LA SENTENCIA LIMIT PARA A?ADIR A LA CONSULTA QUE DEFINITIVA
                        $limit = " LIMIT " . ($page - 1) * $rows_per_page . ',' . $rows_per_page;
                        
                        $salida = $objMysql->ejecutar("SELECT c.idclase as 'codigo',c.nombre,c.feccrea,c.fecmodif,IF(c.eliminado=0,'ACTIVO','ELIMINADO') AS 'estado' FROM ".DB_PREFIJO."_clase c 
                                                            where c.eliminado<>1   
                                                            ".$queryBuscar."  ".$queryOedenar." ".$limit." ;");
                        
                  break;    
                case 'listarClasesTot':
                        $rs = $objMysql->ejecutar("SELECT count(*) as 'cant' FROM ".DB_PREFIJO."_clase c 
                                                            where c.eliminado<>1;");
                                                            //".$queryBuscar."  ".$queryOedenar." ;");
                        $fila = $rs->fetch(PDO::FETCH_ASSOC);
                        $salida=$fila["cant"];

                    break;
                
                case 'listarDatos':
                       /* --------  instrucciones de busqueda ----------------------- */
                        $queryBuscar = "";
                        if(!empty($campoaBuscar) && !empty($valoraBuscar)){
                            if($campoaBuscar=="codigo"){
                                $queryBuscar=" and c.iddatos ='".$valoraBuscar."' ";
                            } else {
                                $queryBuscar=" and c.campo like '".$valoraBuscar."%' ";
                            }
                        }
                        /* -------------------------------------- */
                        $datos = $objMysql->ejecutar("SELECT c.iddatos as 'codigo',c.posicion,c.campo,c.contenido,c.URL FROM ".DB_PREFIJO."_datos c 
                                                            where c.iddatos>0  
                                                            ".$queryBuscar."  ".$queryOedenar.";");
                        
                        
                        //MIRO CUANTOS DATOS FUERON DEVUELTOS
                        $num_rows = $datos->rowCount();

                        //ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR P?GINA , EN EL EJEMPLO PONGO 15
                        $rows_per_page = $mostrarRegistros;
                        $num_page_view = 2;
                        $num_page_next = 1;
                        //CALCULO LA ULTIMA P?GINA
                        $lastpage = ceil($num_rows / $rows_per_page);

                        //COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA P?GINA
                        $page = (int) $page;
                        if ($page > $lastpage) {
                            $page = $lastpage;
                        }
                        if ($page < 1) {
                            $page = 1;
                        }

                        //CREO LA SENTENCIA LIMIT PARA A?ADIR A LA CONSULTA QUE DEFINITIVA
                        $limit = " LIMIT " . ($page - 1) * $rows_per_page . ',' . $rows_per_page;
                        
                        $salida = $objMysql->ejecutar("SELECT c.iddatos as 'codigo',c.posicion,c.campo,c.contenido,
                                                        if(c.URL='#','sin enlace',c.URL) FROM ".DB_PREFIJO."_datos c 
                                                            where c.iddatos>0   
                                                            ".$queryBuscar."  ".$queryOedenar." ".$limit." ;");
                        
                  break;    
                case 'listarDatosTot':
                        $rs = $objMysql->ejecutar("SELECT count(*) as 'cant' FROM ".DB_PREFIJO."_datos c 
                                                            where c.iddatos>0 ;");
                                                            //".$queryBuscar."  ".$queryOedenar." ;");
                        $fila = $rs->fetch(PDO::FETCH_ASSOC);
                        $salida=$fila["cant"];

                    break;
                
                case 'listarOcasion':
                       /* --------  instrucciones de busqueda ----------------------- */
                        $queryBuscar = "";
                        if(!empty($campoaBuscar) && !empty($valoraBuscar)){
                            if($campoaBuscar=="codigo"){
                                $queryBuscar=" and o.idocasion ='".$valoraBuscar."' ";
                            } else {
                                $queryBuscar=" and o.nombre like '".$valoraBuscar."%' ";
                            }
                        }
                        /* -------------------------------------- */
                        $datos = $objMysql->ejecutar("SELECT o.idocasion as 'codigo',o.nombre,o.feccrea,o.fecmodif,IF(o.eliminado=0,'ACTIVO','ELIMINADO') AS 'estado' FROM ".DB_PREFIJO."_ocasion o 
                                                            where o.eliminado<>1   
                                                            ".$queryBuscar."  ".$queryOedenar.";");
                        
                        
                        //MIRO CUANTOS DATOS FUERON DEVUELTOS
                        $num_rows = $datos->rowCount();

                        //ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR P?GINA , EN EL EJEMPLO PONGO 15
                        $rows_per_page = $mostrarRegistros;
                        $num_page_view = 2;
                        $num_page_next = 1;
                        //CALCULO LA ULTIMA P?GINA
                        $lastpage = ceil($num_rows / $rows_per_page);

                        //COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA P?GINA
                        $page = (int) $page;
                        if ($page > $lastpage) {
                            $page = $lastpage;
                        }
                        if ($page < 1) {
                            $page = 1;
                        }

                        //CREO LA SENTENCIA LIMIT PARA A?ADIR A LA CONSULTA QUE DEFINITIVA
                        $limit = " LIMIT " . ($page - 1) * $rows_per_page . ',' . $rows_per_page;
                        
                        $salida = $objMysql->ejecutar("SELECT o.idocasion as 'codigo',o.nombre,o.feccrea,o.fecmodif,IF(o.eliminado=0,'ACTIVO','ELIMINADO') AS 'estado' FROM ".DB_PREFIJO."_ocasion o 
                                                            where o.eliminado<>1   
                                                            ".$queryBuscar."  ".$queryOedenar." ".$limit." ;");
                        
                  break;
                case 'listarOcasionTot':
                        $rs = $objMysql->ejecutar("SELECT count(*) as 'cant' FROM ".DB_PREFIJO."_ocasion o  
                                                            where o.eliminado<>1;");
                                                            //".$queryBuscar."  ".$queryOedenar." ;");
                        $fila = $rs->fetch(PDO::FETCH_ASSOC);
                        $salida=$fila["cant"];

                    break;  
                
                case 'listarMenu':
                       /* --------  instrucciones de busqueda ----------------------- */
                        $queryBuscar = "";
                        if(!empty($campoaBuscar) && !empty($valoraBuscar)){
                            if($campoaBuscar=="codigo"){
                                $queryBuscar=" and a.idmenu ='".$valoraBuscar."' ";
                            } else {
                                $queryBuscar=" and a.campo like '".$valoraBuscar."%' ";
                            }
                        }
                        /* -------------------------------------- */
                        $datos = $objMysql->ejecutar("SELECT *,a.idmenu as 'codigo',
                            case a.nivel
                                when '1' then concat(cast(posicion as char(10)))
                                when '2' then concat(cast((select b.posicion from ".DB_PREFIJO."_menumnt b where b.idmenu=a.idcontenedor)as char(10)),'.',cast(a.posicion as char(10)))
                                when '3' then concat(cast((select c.posicion from ".DB_PREFIJO."_menumnt c where c.idmenu=(select b.idcontenedor from ".DB_PREFIJO."_menumnt b where b.idmenu=a.idcontenedor))as char(10)),'.',cast((select b.posicion from ".DB_PREFIJO."_menumnt b where b.idmenu=a.idcontenedor)as char(10)),'.',cast(a.posicion as char(10)))
                            end as lista,a.campo as 'nombre',IF(a.mostrar=1,'ACTIVO','ELIMINADO') AS 'estado' FROM ".DB_PREFIJO."_menumnt a 
                                                            where a.eliminado<>1   
                                                            ".$queryBuscar."  ".$queryOedenar.";");
                        
                        //MIRO CUANTOS DATOS FUERON DEVUELTOS
                        $num_rows = $datos->rowCount();

                        //ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR P?GINA , EN EL EJEMPLO PONGO 15
                        $rows_per_page = $mostrarRegistros;
                        $num_page_view = 2;
                        $num_page_next = 1;
                        //CALCULO LA ULTIMA P?GINA
                        $lastpage = ceil($num_rows / $rows_per_page);

                        //COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA P?GINA
                        $page = (int) $page;
                        if ($page > $lastpage) {
                            $page = $lastpage;
                        }
                        if ($page < 1) {
                            $page = 1;
                        }

                        //CREO LA SENTENCIA LIMIT PARA A?ADIR A LA CONSULTA QUE DEFINITIVA
                        $limit = " LIMIT " . ($page - 1) * $rows_per_page . ',' . $rows_per_page;
                        
                        $salida = $objMysql->ejecutar("SELECT a.idmenu as 'codigo',
                            case a.nivel
                                when '1' then concat(cast(posicion as char(10)))
                                when '2' then concat(cast((select b.posicion from ".DB_PREFIJO."_menumnt b where b.idmenu=a.idcontenedor)as char(10)),'.',cast(a.posicion as char(10)))
                                when '3' then concat(cast((select c.posicion from ".DB_PREFIJO."_menumnt c where c.idmenu=(select b.idcontenedor from ".DB_PREFIJO."_menumnt b where b.idmenu=a.idcontenedor))as char(10)),'.',cast((select b.posicion from ".DB_PREFIJO."_menumnt b where b.idmenu=a.idcontenedor)as char(10)),'.',cast(a.posicion as char(10)))
                            end as lista,
                            a.campo as 'nombre',
                                IF(a.mostrar=1,'ACTIVO','DESACTIVADO') AS 'estado' FROM ".DB_PREFIJO."_menumnt a 
                                                            where a.eliminado<>1   
                                                            ".$queryBuscar."  ".$queryOedenar." ".$limit." ;");
                        
                  break;  
                  case 'listarMenuTot':
                        $rs = $objMysql->ejecutar("SELECT count(*) as 'cant' FROM ".DB_PREFIJO."_menumnt o  
                                                            where o.eliminado<>1;");
                                                            //".$queryBuscar."  ".$queryOedenar." ;");
                        $fila = $rs->fetch(PDO::FETCH_ASSOC);
                        $salida=$fila["cant"];

                    break;
                
                
                
                case 'listarDirectorio':
                       /* --------  instrucciones de busqueda ----------------------- */
                        $queryBuscar = "";
                        if(!empty($campoaBuscar) && !empty($valoraBuscar)){
                            if($campoaBuscar=="codigo"){
                                $queryBuscar=" and a.iddirectorio ='".$valoraBuscar."' ";
                            } else {
                                $queryBuscar=" and a.campo like '".$valoraBuscar."%' ";
                            }
                        }
                        /* -------------------------------------- */
                        $datos = $objMysql->ejecutar("SELECT *,a.iddirectorio as 'codigo',
                            case a.nivel
                                when '1' then concat(cast(posicion as char(10)))
                                when '2' then concat(cast((select b.posicion from ".DB_PREFIJO."_directorio b where b.iddirectorio=a.idcontenedor)as char(10)),'.',cast(a.posicion as char(10)))
                                when '3' then concat(cast((select c.posicion from ".DB_PREFIJO."_directorio c where c.iddirectorio=(select b.idcontenedor from ".DB_PREFIJO."_directorio b where b.iddirectorio=a.idcontenedor))as char(10)),'.',cast((select b.posicion from ".DB_PREFIJO."_directorio b where b.iddirectorio=a.idcontenedor)as char(10)),'.',cast(a.posicion as char(10)))
                            end as lista,a.campo as 'nombre',IF(a.eliminado=0,'ACTIVO','ELIMINADO') AS 'estado' FROM ".DB_PREFIJO."_directorio a 
                                                            where a.eliminado<>1   
                                                            ".$queryBuscar."  ".$queryOedenar.";");
                        
                        //MIRO CUANTOS DATOS FUERON DEVUELTOS
                        $num_rows = $datos->rowCount();

                        //ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR P?GINA , EN EL EJEMPLO PONGO 15
                        $rows_per_page = $mostrarRegistros;
                        $num_page_view = 2;
                        $num_page_next = 1;
                        //CALCULO LA ULTIMA P?GINA
                        $lastpage = ceil($num_rows / $rows_per_page);

                        //COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA P?GINA
                        $page = (int) $page;
                        if ($page > $lastpage) {
                            $page = $lastpage;
                        }
                        if ($page < 1) {
                            $page = 1;
                        }

                        //CREO LA SENTENCIA LIMIT PARA A?ADIR A LA CONSULTA QUE DEFINITIVA
                        $limit = " LIMIT " . ($page - 1) * $rows_per_page . ',' . $rows_per_page;
                        
                        $salida = $objMysql->ejecutar("SELECT a.iddirectorio as 'codigo',
                            case a.nivel
                                when '1' then concat(cast(posicion as char(10)))
                                when '2' then concat(cast((select b.posicion from ".DB_PREFIJO."_directorio b where b.iddirectorio=a.idcontenedor)as char(10)),'.',cast(a.posicion as char(10)))
                                when '3' then concat(cast((select c.posicion from ".DB_PREFIJO."_directorio c where c.iddirectorio=(select b.idcontenedor from ".DB_PREFIJO."_directorio b where b.iddirectorio=a.idcontenedor))as char(10)),'.',cast((select b.posicion from ".DB_PREFIJO."_directorio b where b.iddirectorio=a.idcontenedor)as char(10)),'.',cast(a.posicion as char(10)))
                            end as lista,
                            a.campo as 'nombre',
                                IF(a.eliminado=0,'ACTIVO','ELIMINADO') AS 'estado' FROM ".DB_PREFIJO."_directorio a 
                                                            where a.eliminado<>1   
                                                            ".$queryBuscar."  ".$queryOedenar." ".$limit." ;");
                        
                  break;  
                  case 'listarDirectorioTot':
                        $rs = $objMysql->ejecutar("SELECT count(*) as 'cant' FROM ".DB_PREFIJO."_directorio o  
                                                            where o.eliminado<>1;");
                                                            //".$queryBuscar."  ".$queryOedenar." ;");
                        $fila = $rs->fetch(PDO::FETCH_ASSOC);
                        $salida=$fila["cant"];

                    break; 
                case 'f_convocatoria':
                      $rs = $objMysql->ejecutar("SELECT * FROM ".DB_PREFIJO."_convocatoria c where c.idconvocatoria='".$val1."'");  
                      $salida = $rs->fetch(PDO::FETCH_ASSOC);
                      break;
                  case 'f_contactenos':
                      $rs = $objMysql->ejecutar("SELECT *,DATE_FORMAT(c.fecha,'%d/%m/%Y') AS 'fechaa',
DATE_FORMAT(c.hora,'%h:%i %p') AS 'horaa' FROM ".DB_PREFIJO."_contactenos c where c.idcontactenos='".$val1."'");  
                      $salida = $rs->fetch(PDO::FETCH_ASSOC);
                      break;
                  case 'f_clase':
                      $rs = $objMysql->ejecutar("SELECT * FROM ".DB_PREFIJO."_clase c where c.idclase='".$val1."' and c.eliminado=0");  
                      $salida = $rs->fetch(PDO::FETCH_ASSOC);
                      break;
                  case 'f_sistema':
                      $rs = $objMysql->ejecutar("SELECT * FROM ".DB_PREFIJO."_sistema c where c.idsistema='".$val1."'");  
                      $salida = $rs->fetch(PDO::FETCH_ASSOC);
                      break;
                  case 'f_popup':

                      $rs = $objMysql->ejecutar("SELECT * FROM ".DB_PREFIJO."_popup p where p.idpopup='".$val1."'");  

                      $salida = $rs->fetch(PDO::FETCH_ASSOC);

                      break;
                  case 'f_ocasion':
                      $rs = $objMysql->ejecutar("SELECT * FROM ".DB_PREFIJO."_ocasion o where o.idocasion='".$val1."' and o.eliminado=0");  
                      $salida = $rs->fetch(PDO::FETCH_ASSOC);
                      break;
                  case 'f_categoria':
                      $rs = $objMysql->ejecutar("SELECT * FROM ".DB_PREFIJO."_categoria c where c.idcategoria='".$val1."' and c.eliminado=0");  
                      $salida = $rs->fetch(PDO::FETCH_ASSOC);
                      break;
                  case 'f_datos':
                      $rs = $objMysql->ejecutar("SELECT * FROM ".DB_PREFIJO."_datos c where c.iddatos='".$val1."'");  
                      $salida = $rs->fetch(PDO::FETCH_ASSOC);
                      break;
                  case 'f_menumnt':
                      $rs = $objMysql->ejecutar("SELECT * FROM ".DB_PREFIJO."_menumnt c where c.idmenu='".$val1."' and c.eliminado=0");  
                      $salida = $rs->fetch(PDO::FETCH_ASSOC);
                      break;
                  case 'f_directorio':
                      $rs = $objMysql->ejecutar("SELECT * FROM ".DB_PREFIJO."_directorio c where c.iddirectorio='".$val1."' and c.eliminado=0");  
                      $salida = $rs->fetch(PDO::FETCH_ASSOC);
                      break;
                  case 'f_producto':
                      $rs = $objMysql->ejecutar("SELECT * FROM ".DB_PREFIJO."_productos p where p.idproducto='".$val1."' and p.eliminado=0");  
                      $salida = $rs->fetch(PDO::FETCH_ASSOC);
                      break;
                  case 'f_pagina':
                      $rs = $objMysql->ejecutar("SELECT * FROM ".DB_PREFIJO."_pagina c where c.idpaginaweb='".$val1."'");  
                      $salida = $rs->fetch(PDO::FETCH_ASSOC);
                      break;    
                  case 'f_banner':
                      $rs = $objMysql->ejecutar("SELECT * FROM ".DB_PREFIJO."_banner b where b.idbanner='".$val1."' and b.eliminado=0");  
                      $salida = $rs->fetch(PDO::FETCH_ASSOC);
                      break;
                  case 'f_proyecto':
                      $rs = $objMysql->ejecutar("SELECT * FROM ".DB_PREFIJO."_proyecto b where b.idproyecto='".$val1."'");  
                      $salida = $rs->fetch(PDO::FETCH_ASSOC);
                      break;
                  case 'f_bannerinterno':
                      $rs = $objMysql->ejecutar("SELECT * FROM ".DB_PREFIJO."_bannerinterior b where b.idbannerinterior='".$val1."' and b.eliminado=0");  
                      $salida = $rs->fetch(PDO::FETCH_ASSOC);
                      break;
                  case 'f_servicio':
                      $rs = $objMysql->ejecutar("SELECT * FROM ".DB_PREFIJO."_servicio b where b.idservicio='".$val1."' and b.eliminado=0");  
                      $salida = $rs->fetch(PDO::FETCH_ASSOC);
                      break;
                  case 'f_novedades':
                      $rs = $objMysql->ejecutar("SELECT * FROM ".DB_PREFIJO."_novedades n where n.idnovedades='".$val1."' and n.eliminado=0");  
                      $salida = $rs->fetch(PDO::FETCH_ASSOC);
                      break;
                  case 'f_usuario':
                      $rs = $objMysql->ejecutar("SELECT * FROM ".DB_PREFIJO."_usuarios u where u.idusuario='".$val1."' and u.eliminado=0");  
                      $salida = $rs->fetch(PDO::FETCH_ASSOC);
                      break;
                  case 'relacionados':
                      $rs = $objMysql->ejecutar("SELECT prela.idrelacionado as 'id',p.nombre as 'nombre' FROM ".DB_PREFIJO."_prod_rela prela 
                                                inner join ".DB_PREFIJO."_productos p on prela.idrelacionado=p.idproducto 
                                                where prela.idproducto=".$val1." 
                                                and prela.swactivo=1 
                                                order by id asc;");  
                      $salida = $rs;
                      break;
                  
                  
            }
        } catch (Exception $exc) {
             $salida = $exc->getTraceAsString();
        }
        return $salida;
    }


    
}

?>

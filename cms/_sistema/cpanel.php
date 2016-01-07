<?
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
include("../_util/Sesion.php");$objSesion=new Sesion(); if (!isset($_SESSION['username']) && !isset($_SESSION['userid'])){header("Location: ../login/logout.php");}
?>
<!DOCTYPE html>
<html>

    <head>
        <title>INTRANET SERVILITE</title>
        <!-- Your stuff -->
        <link href="../../imagenes/favicon.png" rel="shortcut icon" type="image/x-icon">
        <!-- Include Sidr bundled CSS theme -->
        <link rel="stylesheet" href="../stylesheets/jquery.sidr.light.css">
        <!-- Include jQuery -->
        <script src="../javascripts/jquery.js"></script>
        <!-- Include the Sidr JS -->
        <script src="../javascripts/jquery.sidr.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <script>
            $(document).ready(function() {
                $('#left-menu').sidr({
                    name: 'sidr-left',
                    source: '#sidr',
                    side: 'left' // By default
                });
                $('#left-menu').click();
            });
        </script>
        <style>
            body{font-family: 'Roboto'; margin: 0; padding: 0; /*background-image:url(../img/bgpanel.jpg);*/ background-repeat:repeat;}
            #left-menu{
                background-color:lightgray;
                padding:5px;
                border-radius:0 10px 10px 0; 
            }
        </style>
    </head>
    <body>
        <div id="tit" style="width:100%; background-image:url(../img/bgtit.jpg);background-repeat:repeat-x;height: 50px;">
            <div style="font-family:'Oswald';font-size:1.5em;padding: 0.2em 0 0 5em; ">CMS Sirod v2.5 <img width="32" src="../img/logo-sirod.png" /></div>
        </div>    
        <a id="left-menu" href="#left-menu" style="position:absolute;z-index:1001"><img src="../img/menu.png" /></a> 
        <div id="sidr" style="display:none;">
            <!-- Your content -->
            <ul>
                <li>
                    <a href="../paginas/inicio.php" target="interno">
                        <div style="margin: 10px;">
                            <img src="../img/home.png" width="24" align="center" /> Inicio
                        </div>
                    </a>
                </li>
                <li><a href="../configuracionSistema/UPDSistema.php?id=<? //rand(1,1000)?>>" target="interno"><img src="../img/settings.png" align="center" /> Configuracion del Sistema</a>  
                </li>
                <li><a href="../datosContactenos/MNTDatos.php?id=<? //rand(1,1000)?>>" target="interno"><img src="../img/datos.png" align="center" width="26px" /> Datos de Contactenos</a>  
                </li>
                
                <li><a href="../menu/MNTMenu.php?id=<?=rand(1,1000)?>>" target="interno"><img src="../img/menu.png" align="center" width="24" /> Modificar o eliminar Menu</a>
                      <ul>
                        <li><a href="../menu/INSMenu.php?id=<?=rand(1,1000)?>>" target="interno"> + Agregar Menu </a></li>
                      </ul>
                </li>
                <li><a href="../banner/MNTbanner.php?id=<?=rand(1,1000)?>>" target="interno"><img src="../img/banner.png" align="center" width="24" /> Modificar o eliminar Banners</a>
                      <ul>
                        <li><a href="../banner/INSbanner.php?id=<?=rand(1,1000)?>>" target="interno"> + Agregar Banner </a></li>
                      </ul>
                </li>
                <li><a href="../bannerinterno/MNTbannerInterno.php?id=<?=rand(1,1000)?>>" target="interno"><img src="../img/interno.png" align="center" width="24" /> Modificar o eliminar Banners Inter</a>
                      <ul>
                        <li><a href="../bannerinterno/INSbannerInterno.php?id=<?=rand(1,1000)?>>" target="interno"> + Agregar Banner Interno</a></li>
                      </ul>
                </li>
                <li><a href="../servicios/MNTservicio.php?id=<?=rand(1,1000)?>>" target="interno"><img src="../img/servi.png" align="center" width="24" /> Modificar o eliminar Servicio</a>
                      <ul>
                        <li><a href="../servicios/INSservicio.php?id=<?=rand(1,1000)?>>" target="interno"> + Agregar Servicio </a></li>
                      </ul>
                </li>
<!--                <li><a href="../popup/MNTpopup.php?id=<?=rand(1,1000)?>>" target="interno"><img src="../img/popup.png" align="center" width="24" /> Modificar o eliminar Popup</a>
                      <ul>
                        <li><a href="../popup/INSpopup.php?id=<?=rand(1,1000)?>>" target="interno"> + Agregar Popup </a></li>
                      </ul>
                </li>-->
                <li><a href="../clase/MNTclase.php?id=<? //rand(1,1000)?>>" target="interno"><img src="../img/clase.png" align="center" /> Modificar o eliminar Clase </a>
                    <ul>
                        <li><a href="../clase/INSclase.php?id=<? //rand(1,1000)?>>" target="interno"> + Agregar Clase </a></li>
                    </ul>
                </li>
                <li><a href="../categoria/MNTCategoria.php?id=<?=rand(1,1000)?>>" target="interno"><img src="../img/cat.png" align="center" width="24" /> Modificar o eliminar Categorias </a>
                    <ul>
                        <li><a href="../categoria/INSCategoria.php?id=<?=rand(1,1000)?>>" target="interno"> + Agregar Categoria </a></li>
                    </ul>
                </li>
                <li><a href="../producto/MNTproducto.php?id=<?=rand(1,1000)?>>" target="interno"><img src="../img/prod.png" align="center" width="24" /> Modificar o eliminar Productos</a>
                      <ul>
                        <li><a href="../producto/INSproducto.php?id=<?=rand(1,1000)?>>" target="interno"> + Agregar Producto </a></li>
                      </ul>
                </li>
                <li><a href="../pagina/MNTPagina.php?id=<?=rand(1,1000)?>>" target="interno"><img src="../img/pag.png" align="center" width="24" /> Modificar o eliminar P&aacute;gina</a>
                      <ul>
                        <li><a href="../pagina/INSPagina.php?id=<?=rand(1,1000)?>>" target="interno"> + Agregar P&aacute;gina </a></li>
                      </ul>
                </li>
                <li><a href="../contactenos/MNTContactenos.php?id=<?=rand(1,1000)?>>" target="interno"><img src="../img/contac.png" align="center" width="24" /> Responder o eliminar Consulta</a>
                </li>
                <li><a href="../convocatorias/MNTConvocatoria.php?id=<?=rand(1,1000)?>>" target="interno"><img src="../img/convo.png" align="center" width="24" /> Modificar o eliminar Convocatoria</a>
                      <ul>
                        <li><a href="../convocatorias/INSConvocatoria.php?id=<?=rand(1,1000)?>>" target="interno"> + Agregar Convocatoria </a></li>
                      </ul>
                </li>
                <li><a href="../proyectos/MNTProyecto.php?id=<?=rand(1,1000)?>>" target="interno"><img src="../img/directorio.png" align="center" width="24" /> Modificar o eliminar Proyecto</a>
                      <ul>
                          <li><a href="../proyectos/INSProyecto.php?id=<?=rand(1,1000)?>>" target="interno"> + Agregar Proyecto </a></li>
                      </ul>
                </li>
                <li><a href="../usuario/MNTusuario.php?id=<?=rand(1,1000)?>>" target="interno"><img src="../img/users.png" align="center" width="24" /> Modificar o eliminar Usuarios</a>
                      <ul>
                        <li><a href="../usuario/INSusuario.php?id=<?=rand(1,1000)?>>" target="interno"> + Agregar Usuario </a></li>
                      </ul>
                </li>
               <!--
                <li><a href="../novedades/MNTnovedades.php?id=<?=rand(1,1000)?>>" target="interno">Modificar o eliminar Novedades</a>
                      <ul>
                        <li><a href="../novedades/INSnovedades.php?id=<?=rand(1,1000)?>>" target="interno"> + Agregar Novedades </a></li>
                      </ul>
                </li>-->
                <li>
                    <a href="../login/logout.php?>" target="_self"> <img src="../img/logout.png" alt="Cerrar Sesi&oacute;n " /></a>
                </li>
            </ul>
        </div>        
        <div id="contenedor" style="margin-left: 5em;">
            <iframe src="../paginas/inicio.php" frameborder="0" scrolling="no" style="background-color:transparent;" width="1000" height="1500" name="interno" id="interno"></iframe>
        </div>
    </body>
</html>
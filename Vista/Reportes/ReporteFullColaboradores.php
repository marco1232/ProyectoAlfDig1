<?php session_start(); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Alfabetizacion Digital</title>
        <link rel="icon" type="image/png" href="../../images/Alfabetizacion_Mano_Sin Resplandor.png">
        <link href="../../layout/styles/layout.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/main1.css" rel="stylesheet" type="text/css"/>
        <link href="../../vendor/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="../../js/javascript.js" type="text/javascript"></script>
        
        <script>
            function descargarExcel(idtabla) {
                //Creamos un Elemento Temporal en forma de enlace
                var tmpElemento = document.createElement('a');
                // obtenemos la información desde el div que lo contiene en el html
                // Obtenemos la información de la tabla
                var data_type = 'data:application/vnd.ms-excel';
                var tabla_div = document.getElementById(idtabla);
                var tabla_html = tabla_div.outerHTML.replace(/ /g, '%20');
                tmpElemento.href = data_type + ', ' + tabla_html;
                //Asignamos el nombre a nuestro EXCEL
                tmpElemento.download = 'tabla.xls';
                // Simulamos el click al elemento creado para descargarlo
                tmpElemento.click();
            }
        </script>
        <script>
            function classActive(){
                var adm=document.getElementById('liadministracion');
                var mat=document.getElementById('limateriales');
                var rep=document.getElementById('lireportes');
                var prin=document.getElementById('liaccionesprincipales');
                adm.className='';
                mat.className='active';
                rep.className='';
                prin.className='';
            }
        </script>
    </head>
    <body id="top">
        <div class="wrapper col1">
            <div id="header">
                <img src="../../images/encabezado-aulavirtual.png" alt="" id="logo"/>
                <br class="clear" />
            </div>
        </div>
        <div class="wrapper col2">
            <div id="topbar">
                <div id="topnav" style="width:100%">
                    <ul>
                        <li id="liaccionesprincipales" class style="max-width:250px"><a href="../Administrador/FrmPrincipalAdmin.php">Acciones principales</a></li>
                        <!--<li><a href="pages/style-demo.html">Style Demo</a></li>
                        <li><a href="pages/full-width.html">Full Width</a></li>-->
                        <li id="liadministracion" class><a href="#" onclick="return null">Administracion</a>
                            <ul style="width:150px">
                                <li><a  style="width:180px" id="adminben" href="../Mantenimiento/AdministrarBeneficiarios.php">Beneficiarios</a></li>
                                <li><a  style="width:180px" id="admincol" href="../Mantenimiento/AdministrarColaboradores.php">Colaboradores</a></li>
                            </ul>
                           
                        </li>
                        <li id="limateriales" class><a href="#" onclick="return null">Materiales</a>
                            <ul style="width:150px">
                                <li><a  style="width:180px" id="adminMat" href="javascript:ajax('AjaxControlador','2');javascript:classActive()">Mostrar materiales</a></li>
                            </ul>
                        </li>
                        <li id="lireportes" class="active"><a href="#" onclick="return null">Reportes</a>
                            <ul style="width:150px">
                                <li><a  style="width:180px" id="repben" href="../Reportes/ReporteFullBeneficiarios.php">Beneficiarios</a></li>
                                <li><a  style="width:180px" id="repcol" href="../Reportes/ReporteFullColaboradores.php">Colaboradores</a></li>
                            </ul>
                        </li>
                        <!--<li class="last"><a href="#">A Long Link Text</a></li>-->
                        <li class="last"><a href="../../Util/cerrarsesion.php">Cerrar sesion</a></li>
                    </ul>
                </div>
                <br class="clear" />
            </div>
        </div>
        <form name="form">

            <div class="wrapper col5">
                <br><center><h1>Cordial bienvenida: <?php if (isset($_SESSION['datos'])) {
    echo $_SESSION['datos']['nombres'];
} ?></h1></center>
                <input type="hidden" name="op">
                <div id="container" >

                    <style>
                        #customers, #customers1 {
                            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                            border-collapse: collapse;
                            width: 100%;
                        }

                        #customers td, #customers th,#customers1 td, #customers1 th {
                            border: 1px solid #ddd;
                            padding: 8px;
                        }

                        #customers tr:nth-child(even){background-color: #f2f2f2;}
                        #customers1 tr:nth-child(even){background-color: #f2f2f2;}
                        #customers tr:hover {background-color: #ddd;}
                        #customers1 tr:hover {background-color: #ddd;}
                        #customers th, #customers1 th {
                            padding-top: 12px;
                            padding-bottom: 12px;
                            text-align: center;
                            background-color: royalblue;
                            color: white;
                        }
                    </style>
                    <CENTER>
                        <div style="width:1000px">
                            <?php
                            include '../../Util/config.inc.php';
                            $db1 = new Conect_MySql();
                            $sql1 = "select * from usuario u inner join colaborador c on u.dniusu=c.dniusu order by id_cola";
                            $query1 = $db1->execute($sql1);
                            $usuarios1 = array();
                            while ($datos1 = $db1->fetch_row($query1)) {
                                $id1 = $datos1['id_cola'];
                                //$title_id = $row['title_id'];
                                $usuarios1[$id1] = $datos1;
                            }
                            $_SESSION['imc_colaboradores'] = $usuarios1;
                            ?>
                            <div>Buscar por nombres: <input type="text" name="textinput" id="textinput" onkeyup="javascript: ajax1('BuscadorFiltroColaborador','1',document.getElementById('textinput').value)"></div>
                            <div id="container1" style="overflow:  auto;padding-bottom: 0px;max-height: 500px;padding-top:  0px;"><br>
                            <table border="1" class="tituloTabla" style="text-align: center" id="customers1" >
                                <tr>
                                    <th colspan="35" class="tituloTabla">Colaboradores</th>
                                </tr>

                                <tr>
                                    <td>ID colaborador</td>
                                    <td>DNI</td>
                                    <td>Usuario de acceso</td>
                                    <td>Contraseña</td>
                                    <td>Perfil</td>
                                    <td>Apellidos</td>
                                    <td>Nombres</td>
                                    <td>Provincia de nacimiento</td>
                                    <td>Distrito de nacimiento</td>
                                    <td>Fecha de nacimiento</td>
                                    <td>Domicilio actual</td>
                                    <td>Distrito actual</td>
                                    <td>Email</td>
                                    <td>Celular</td>
                                    <td>Telefono</td>
                                    <td>Nombre de empresa</td>
                                    <td>Cargo de empresa</td>
                                    <td>Direccion de empresa</td>
                                    <td>Distrito de empresa</td>
                                    <td>Telefono de empresa</td>
                                    <td>Email de empresa</td>
                                    <td>Participacion previa</td>
                                    <td>Objetos en casa</td>
                                    <td>Como se entero de la campaña</td>
                                    <td>Disponibilidad</td>
                                    <td>Estado</td>
                                    <td>Numero CIP</td>
                                    <td>Grado academico</td>
                                    <td>Especialidad</td>
                                    <td>Nombre de universidad</td>
                                    <td>Ciclo</td>
                                    <td>Descripcion de experiencia como docente</td>
                                    <td>Niveles de conocimientos</td>
                                    <td>Aspira a aplicar para</td>
                                    <td>Privilegio de subida de materiales</td>
                                </tr>
                                <?php
                                foreach ($usuarios1 as $filas1) {
                                    if ($filas1['perf'] != 'Administrador') {
                                        ?>
                                        <?php
                                        if ($filas1['estado'] == 'INACTIVO') {
                                            echo '<tr class="fondogrilla" style="background-color: #ff000061;">';
                                        } else if ($filas1['estado'] == 'PENDIENTE') {
                                            echo '<tr class="fondogrilla" style="background-color: #ffff0059;">';
                                        } else if ($filas1['estado'] == 'ACTIVO') {
                                            echo '<tr class="fondogrilla" >';
                                        }
                                        ?>
                                        <td><?php echo $filas1['id_cola']; ?></td>
                                        <td><?php echo $filas1['dniusu']; ?></td>
                                        <td><?php echo $filas1['usua']; ?></td>
                                        <td><?php echo $filas1['pass']; ?></td>
                                        <td><?php echo $filas1['perf']; ?></td>
                                        <td><?php echo $filas1['apellidos']; ?></td>
                                        <td><?php echo $filas1['nombres']; ?></td>
                                        <td><?php echo $filas1['provnaci']; ?></td>
                                        <td><?php echo $filas1['distnaci']; ?></td>
                                        <td><?php echo $filas1['fecnaci']; ?></td>
                                        <td><?php echo $filas1['domiact']; ?></td>
                                        <td><?php echo $filas1['distact']; ?></td>
                                        <td><?php echo $filas1['email']; ?></td>
                                        <td><?php echo $filas1['celu']; ?></td>
                                        <td><?php echo $filas1['tele']; ?></td>
                                        <td><?php echo $filas1['nomempres']; ?></td>
                                        <td><?php echo $filas1['cargempres']; ?></td>
                                        <td><?php echo $filas1['dirempres']; ?></td>
                                        <td><?php echo $filas1['distempres']; ?></td>
                                        <td><?php echo $filas1['telempres']; ?></td>
                                        <td><?php echo $filas1['emailempres']; ?></td>
                                        <td><?php echo $filas1['participaprevia']; ?></td>
                                        <td><?php echo $filas1['objetencasa']; ?></td>
                                        <td><?php echo $filas1['enterarcampa']; ?></td>
                                        <td><?php echo $filas1['disponibilidad']; ?></td>
                                        <td><?php echo $filas1['estado']; ?></td>
                                        <td><?php echo $filas1['cip']; ?></td>
                                        <td><?php echo $filas1['gradoacad']; ?></td>
                                        <td><?php echo $filas1['especia']; ?></td>
                                        <td><?php echo $filas1['nomuniver']; ?></td>
                                        <td><?php echo $filas1['ciclo']; ?></td>
                                        <td><?php echo $filas1['descripdocen']; ?></td>
                                        <td><?php echo $filas1['nivelconoci']; ?></td>
                                        <td><?php echo $filas1['aplicarpara']; ?></td>
                                        <td><?php echo $filas1['privilegiodesubirmat']; ?></td>

                                        </tr>
    <?php
    }
}
?>
                            </table>
                            </div>
                        </div>
                    </center>
                    <br>
                    <button type="button" onclick="descargarExcel('customers1')">Descargar Excel</button>
                </div>
                
            </div>
        </form>
        <div class="wrapper col7" >
            <div id="copyright">
                <p class="fl_left">Copyright &copy; 2018 - Derechos reservados - <a href="HTTP://alfabetizaciondigital.info" target="_BLANK">alfabetizaciondigital.info</a></p>
                <!--<p class="fl_right">Template by <a target="_blank" href="http://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>-->
                <br class="clear" />
            </div>
        </div>
        <script src="../../vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>

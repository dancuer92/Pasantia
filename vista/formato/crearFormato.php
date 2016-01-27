<html>    
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <title>Crear Formato</title>

        <!-- CSS  -->
        <link rel="shortcut icon" href="../../vista/util/images/corporativo/icono_ceramica.ico">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Scripts de la pagina -->        
        <script src="../util/js/dragAndDrop.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="../../vista/util/js/jquery-2.1.4.min.js"></script>


    </head>
    <body>
        <div><br>
            <div class="col-lg-3 col-sm-12 col-md-12" id="paleta">
                <form>
                    Entrada de texto
                    <div class="input-field" id="campo-texto" draggable="true" ondragstart="start(event)" ondragend="end(event)">
                        <input placeholder="Placeholder" id="first_name" type="text" class="validate">
                        <label for="first_name" >First Name</label>
                    </div>
                    <div id="areaTexto" class="input-field" draggable="true" ondragstart="start(event)" ondragend="end(event)">
                        <textarea id="textarea1" class="materialize-textarea"></textarea>
                        <label for="textarea1">Textarea</label>
                    </div>
                    <div id="lista" class="input-field" draggable="true" ondragstart="start(event)" ondragend="end(event)">
                        <select>
                            <option value="" disabled selected>Choose your option</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                        <label>Materialize Select</label>
                    </div>
                    <div id="opcion" draggable="true" ondragstart="start(event)" ondragend="end(event)"> opcion   
                        <p>
                            <input name="group1" type="radio" id="test1" />
                            <label for="test1">Red</label> 
                        </p>
                        <p>                        
                            <input name="group1" type="radio" id="test3"  />
                            <label for="test3">Green</label>
                        </p>
                    </div>

                    <div id="verificacion" draggable="true" ondragstart="start(event)" ondragend="end(event)">verificacion
                        <p>
                            <input type="checkbox" id="test4" checked="checked" />
                            <label for="test4">Red</label>
                        </p>
                        <p>
                            <input type="checkbox" id="test5" />
                            <label for="test5">Yellow</label>
                        </p>
                        <p>
                            <input type="checkbox"  id="test6" />
                            <label for="test6">Filled in</label>
                        </p>
                        <p>
                            <input type="checkbox" id="test7" />
                            <label for="test7">Green</label>
                        </p>
                        <p>
                            <input type="checkbox" id="test8" />
                            <label for="test8">Brown</label>
                        </p>                        
                    </div>
                    <div>
                        <p id="fechas" draggable="true" ondragstart="start(event)" ondragend="end(event)">
                            <input type="date" class="datepicker">
                        </p>
                    </div>
                    <table id="tabla" draggable="true" ondragstart="start(event)" ondragend="end(event)">
                        <tr>
                            <td>columna 1</td>
                            <td>columna 2</td>
                        </tr>
                        <tr>
                            <td>columna 1</td>
                            <td>columna 2</td>
                        </tr>
                    </table>
                </form>
            </div>
            <div id="formato" class="col-lg-9 col-sm-12 col-md-12 hover collection">
                <?php include "../plantillasFormatos/template-encabezadoGral.php" ?>


                <div id="cuadro1" ondragenter="return enter(event)" ondragover="return over(event)" ondragleave="return leave(event)" ondrop="return drop(event)">Seleccionar un cuadro
                    <div class="cuadradito" id="arrastrable1" draggable="true" ondragstart="start(event)" ondragend="end(event)">1</div>
                    <div class="cuadradito" id="arrastrable2" draggable="true" ondragstart="start(event)" ondragend="end(event)">2</div>
                    <div class="cuadradito" id="arrastrable3" draggable="true" ondragstart="start(event)" ondragend="end(event)">3</div>
                </div>
                <div id="cuadro2" ondragenter="return enter(event)" ondragover="return over(event)" ondragleave="return leave(event)" ondrop="return drop(event)">Arrastrar</div>
                <div id="cuadro3" ondragenter="return enter(event)" ondragover="return over(event)" ondragleave="return leave(event)" ondrop="return clonar(event)">Clonadora</div>
                <div id="papelera" ondragenter="return enter(event)" ondragover="return over(event)" ondragleave="return leave(event)" ondrop="return eliminar(event)">Papelera</div>
            </div>
        </div>
    </body>
</html>


<html> 
    <head> 
        <title>Administrador</title>      
        <!--import de la cabecera de la pagina -->
        <?php include '../home/headHtml.php'; ?>
        <!-- Scripts de la pagina -->
        <?php
        include '../home/scripts.php';
        ?>
        <script src="../util/js/jsAdmin.js"></script>
        <script src="../util/js/dragAndDrop.js"></script>

    </head>
    <body>
        <div id="test2" class="row s12"><br>
            <div class="col l3 hoverable">
                <form>
                    Entrada de texto
                    <div class="input-field s12 group" id="input-field" draggable="true" ondragstart="start(event)" ondragend="end(event)">
                        <input placeholder="Placeholder" id="first_name" type="text" class="validate">
                        <label for="first_name" >First Name</label>
                    </div>
                    <div class="input-field col s12" draggable="true">
                        <textarea id="textarea1" class="materialize-textarea"></textarea>
                        <label for="textarea1">Textarea</label>
                    </div>
                    <div class="input-field col s12" draggable="true">
                        <select>
                            <option value="" disabled selected>Choose your option</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                        <label>Materialize Select</label>
                    </div>
                    <div draggable="true">    
                        <p>
                            <input name="group1" type="radio" id="test1" />
                            <label for="test1">Red</label> 
                        </p>
                        <p>                        
                            <input name="group1" type="radio" id="test3"  />
                            <label for="test3">Green</label>
                        </p>
                    </div>

                    <div draggable="true">
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
                        <p draggable="true">
                            <input type="date" class="datepicker">
                        </p>
                    </div>
                </form>
            </div>
            <div id="formato" class=" l9 m12 s12 collection">
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


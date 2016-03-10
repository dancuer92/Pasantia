<div id="asignarFormat" class="contenido">
    <form class="s12 m4" id="formAsigFormat" method="POST" action="./formato/crearFomato.php"> 
        <div class="center" >
            <h3><i class="material-icons prefix" style="font-size: 2.92rem">input</i> Asignar Formato</h3>
            <div>
                <div class="row">                    
                    <div class="input-field col s12 m12 l6">
                        <i class="material-icons prefix">person</i>
                        <input id="cod_usuario" name="cod_usuario" type="text" maxlength="15" class="validate" required onkeyup="autocompletarUsuario();">
                        <label for="cod_usuario">Seleccione un usuario</label>                           
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <i class="material-icons prefix">description</i>
                        <input id="cod_formato" name="cod_formato" type="text" maxlength="15" class="validate" required onkeyup="autocompletarFormato();">
                        <label for="cod_formato">Seleccione un formato</label>                           
                    </div>
                </div>
                <div class="row">                    
                    <div class="input-field col s12 m12 l6" id="usuarios">
                    </div>
                    <div class="input-field col s12 m12 l6" id="formatos">
                    </div>
                </div>
            </div> 
            
            <br>
            <br>
            <br>

            <button id="asignoFormato" class="btn waves-effect waves-light hoverable" type="submit">Asignar
                <i class="material-icons right">send</i>
            </button>           
            <a class="waves-effect waves-red btn-flat hoverable" onclick="limpiar()">Limpiar
                <i class="material-icons right">cancel</i></a>        
        </div>
    </form>
</div>



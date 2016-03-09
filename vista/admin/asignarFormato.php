<div id="asignarFormat" class="contenido">
    <form class="s12 m4" id="formAsigFormat" method="POST" action="./formato/crearFomato.php"> 
        <div class="center" >
            <h3><i class="material-icons prefix" style="font-size: 2.92rem">note_add</i> Asignar Formato</h3>
            <div>
                <div class="row">                    
                    <div class="input-field col s12 m12 l6">
                        <i class="material-icons prefix">info_outline</i>
                        <input id="cod_usuario" name="cod_usuario" type="text" maxlength="15" class="validate" required>
                        <label forcod_usuario">Seleccione un usuario</label>                           
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <i class="material-icons prefix">info_outline</i>
                        <input id="cod_formato" name="cod_formato" type="text" maxlength="15" class="validate" required>
                        <label for="cod_formato">Seleccione un formato</label>                           
                    </div>
                </div>
            </div> 

        <!--<input id="opcion" name="opcion" type="hidden" value="registrar">-->

            <button id="asignoFormato" class="btn waves-effect waves-light hoverable" type="submit">Asignar
                <i class="material-icons right">send</i>
            </button>           
            <a class="waves-effect waves-red btn-flat hoverable" onclick="limpiar()">Limpiar
                <i class="material-icons right">cancel</i></a>        
        </div>
    </form>
</div>

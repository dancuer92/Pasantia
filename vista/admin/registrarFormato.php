<div id="regFor">
    <form class="s12 m4" id="formRegFormat" method="POST" action="./formato/crearFomato.php"> 
        <div class="center" >
            <h3><i class="material-icons prefix" style="font-size: 2.92rem">note_add</i> Registrar Formato</h3>
            <div>
                <div class="row">
                    <div class="input-field col s12 m12 l6">
                        <i class="material-icons prefix">info_outline</i>
                        <input id="codigoFormato" name="codigoFormato" type="text" maxlength="15" class="validate" required>
                        <label for="codigoFormato">Código del formato</label>                           
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <i class="material-icons prefix">info_outline</i>
                        <input id="nombreFormato" name="nombreFormato" type="text" maxlength="30" class="validate" required>
                        <label for="nombreFormato">Nombre del formato</label>                           
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <i class="material-icons prefix">content_paste</i>
                        <input id="procedimiento" name="procedimiento" type="text" maxlength="30" class="validate" required>
                        <label for="procedimiento">Procedimiento de trabajo</label>                                                      
                    </div>                               
                    <div class="input-field col s12 m12 l6">
                        <i class="material-icons prefix">supervisor_account</i>
                        <input id="directorProcedimiento" name="directorProcedimiento" type="text" maxlength="15" class="validate" required>
                        <label for="directorProcedimiento">Director del procedimiento</label>                                                      
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <i class="material-icons prefix">timeline</i>
                        <input id="frecuenciaFormato" name="frecuenciaFormato" type="text" maxlength="50" class="validate" required>
                        <label for="frecuenciaFormato">Frecuencia de uso del formato</label>                                                      
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <i class="material-icons prefix">list</i>
                        <input id="tipoContenido" name="tipoContenido" type="text" maxlength="50" class="validate" required>
                        <label for="tipoContenido">tipo de contenido</label>                                                      
                    </div>                    
                    <div class="input-field col s12 m12 l12">
                        <i class="material-icons prefix">description</i>
                        <textarea id="descripcionFormato" name="descripcionFormato" class="materialize-textarea" ></textarea>
                        <label for="descripcionFormato">Descripción del formato</label>                                                      
                    </div>
                </div>

            </div> 

        <!--<input id="opcion" name="opcion" type="hidden" value="registrar">-->

            <button id="registroFormato" class="btn waves-effect waves-light hoverable" type="submit">Registrar
                <i class="material-icons right">send</i>
            </button>           
            <a class="waves-effect waves-red btn-flat hoverable" onclick="limpiar()">Limpiar
                <i class="material-icons right">cancel</i></a>        
        </div>
    </form>
</div>


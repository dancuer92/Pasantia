<div id="registrarFormat" class="contenido" >
    <form class="s12 m4" id="formRegFormat" method="POST" action="./formato/crearFormato.php"> 
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
                        <i class="material-icons prefix">list</i>
                        <input id="tipoFormato" name="tipoFormato" type="text" maxlength="50" class="validate" required>
                        <label for="tipoFormato">tipo de contenido</label>                                                      
                    </div>  
                    <div class="input-field col s12 m12 l6">   
                        <select id="frecuenciaFormato" name="frecuenciaFormato" class="validate" required >  
                            <option value="1">Hora</option>
                            <option value="2">Turno</option>                        
                            <option value="3">Turno administración</option>                        
                            <option value="4">Diario</option>                        
                            <option value="5">Semanal</option>                        
                            <option value="6">Ocasional</option>                        
                            <option value="7">Libre</option>                        
                        </select>
                    </div>
                    <div class="input-field col s12 m12 l12">
                        <i class="material-icons prefix">description</i>
                        <textarea id="descripcionFormato" name="descripcionFormato" class="materialize-textarea" ></textarea>
                        <label for="descripcionFormato">Descripción del formato</label>                                                      
                    </div>
                    <input id="cod_html" name="cod_html" type="hidden" value="">
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


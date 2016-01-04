<div id="modalCambioPass" class="modal" >
    <div class="modal-content" >
        <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
            <input id="cod" name="cod" type="text" class="validate" required>
            <label for="cod">Código de usuario</label>                            
        </div>

        <?php        
//        $_SESSION['codigo'] =$_REQUEST['cod'];
        include 'cambiarPassword.php';       
        ?>
    </div>
</div>




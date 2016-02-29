<div id="miPerfil" class="contenido">
    <form id="profile">
        <h3 class="center"><i class="material-icons prefix" style="font-size: 2.92rem">account_circle</i> Mi perfil</h3>
        <div id="myProfile" style="padding-left: 3%"></div>    
        <div class="center">
            <a id="modificarPerfil" class="btn waves-effect waves-light hoverable red" onclick="modificar()">Modificar
                <i class="material-icons right">send</i>
            </a>
            <a id="guardar" class="btn waves-effect waves-light hoverable red" onclick="guardar()">Guardar cambios
                <i class="material-icons right">send</i>
            </a>
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        $('#guardar').hide();
        var codigo =<?php echo $_SESSION['codigo']; ?>;
        $.post("../../controlador/sesion/controladorUsuario.php", {codigo: codigo, opcion: "cargar"},
        function (mensaje) {
            $('#myProfile').html(mensaje);
        });
    });
    function modificar() {
        $('#modificarPerfil').hide();
        $('#guardar').show();
        $('#profile :disabled').prop('disabled', false);
        $('#profile :input').css('font-style', 'italic');
        $('#profile :input').css('border', '1px solid');
    }
    function guardar() {
        $('#guardar').hide();
        $('#modificarPerfil').show();
        $('#profile :input').prop('disabled', true);
        $('#profile :input').css('font-style', 'normal');
        $('#profile :input').css('border', 'none');
    }

    function edit(item) {
        var x = '#' + item;
        var valor = $(x).val();
        var codigo =<?php echo $_SESSION['codigo']; ?>;
        if (valor !== '') {
            $.post("../../controlador/sesion/controladorUsuario.php", {valor: valor, clave: item, codigo: codigo, opcion: "editar"},
            function (mensaje) {
                Materialize.toast(mensaje, 500, 'rounded');
            });
        }
        else {
            $(x).focus();
            Materialize.toast('Favor diligenciar el campo', 3000, 'rounded');
        }
    }

</script>
<html>
<head>

    <title>Formulario para agregar estudiantes</title>

    <style>

    </style>
</head>

<body>
<form action="guardar.php" method="POST" enctype="multipart/form-data">
    <div class="input-group">
        <label for="numero_cuenta">Numero de Cuenta</label>
        <input type="text" maxlength="13" name="numero_cuenta" id="numero_cuenta">

    </div>

    <div style="display: flex">
        <div class="input-group">
            <label for="primer_nombre">Primer Nombre</label>
            <input type="text" maxlength="20" name="primer_nombre" id="primer_nombre">
        </div>
        <div class="input-group">
            <label for="apellido">Apellido</label>
            <input type="text" maxlength="20" name="apellido" id="apellido">
        </div>
    </div>

    <div style="display: flex">
        <label for="correo">Correo Electrónico</label>
        <input type="email" maxlength="100" name="correo" id="correo">
    </div>

    <div style="display: flex">

        <select name="dia">Dia
            <option>Día</option>
            <?php
            for ($i=1; $i<=31;$i++): ?>
                <option value=" <?php echo $i; ?>"><?php echo $i; ?> </option>
            <?php endfor;
            ?>
        </select>
        <select name="mes">
            <option>Mes</option>
            <?php
            for ($i=1; $i<=12;$i++): ?>
                <option value=" <?php echo $i; ?>"><?php echo $i; ?> </option>
            <?php endfor;
            ?>
        </select>
        <select>
            <option name="year">
                Año
            </option>
            <?php
            for ($i=1980; $i<=2000;$i++): ?>
                <option value=" <?php echo $i; ?>"><?php echo $i; ?> </option>
            <?php endfor;
            ?>
        </select>
    </div>

    <div>
        <label for="imagen">Foto de Perfil</label>
        <input type="file" name="imagen" id="imagen" accept="image/*">
    </div>
    <input type="submit" value="Enviar">

</form>




</body>
</html>


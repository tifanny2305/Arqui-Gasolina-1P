<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Sucursal</title>
</head>
<body>

    <h1>Editar Sucursal</h1>

    <form action="index.php?action=actualizar_sucursal" method="POST">
    <!-- ID oculto para que esté en POST -->
    <input type="hidden" name="id" value="<?= $sucursal['id'] ?>">

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" value="<?= $sucursal['nombre'] ?>" required><br><br>

    <label for="ubicacion">Ubicación:</label>
    <input type="text" id="ubicacion" name="ubicacion" value="<?= $sucursal['ubicacion'] ?>" required><br><br>

    <label for="bombas">Número de Bombas:</label>
    <input type="number" id="bombas" name="bombas" value="<?= $sucursal['bombas'] ?>" required><br><br>

    <label>Combustibles:</label><br>
        <?php foreach ($combustibles as $combustible): ?>
            <input type="checkbox" name="combustibles[]" id="combustible_<?= $combustible['id'] ?>" 
                   value="<?= $combustible['id'] ?>"
                   <?= in_array($combustible['id'], $combustibles_seleccionados) ? 'checked' : '' ?>>
            <label for="combustible_<?= $combustible['id'] ?>"><?= $combustible['tipo'] ?></label><br>
        <?php endforeach; ?><br>

        <button type="submit">Actualizar</button>
    </form>


    <a href="index.php?action=sucursales">Volver</a>

</body>
</html>

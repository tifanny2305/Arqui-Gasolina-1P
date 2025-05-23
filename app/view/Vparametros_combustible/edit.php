<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parámetros de Combustible</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
        }

        form {
            max-width: 600px;
            margin: 30px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="number"], input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            background-color: #27ae60;
            color: white;
            padding: 12px 16px;
            border: none;
            border-radius: 6px;
            margin-top: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #219150;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1>Editar Parámetros: <?= htmlspecialchars($combustible['tipo']) ?></h1>

    <div class="actions">
        <a class="back-link" href="index.php?action=parametros_combustible">Volver al listado</a>
    </div>

    <form action="index.php?action=guardar_parametros" method="post">
        <input type="hidden" name="combustible_id" value="<?= $combustible['id'] ?>">
        
        <div class="form-group">
            <label>Consumo por Auto (litros)</label>
            <input type="number" step="0.01" name="consumo_por_auto" 
                value="<?= isset($parametros['consumo_promedio_por_auto']) ? htmlspecialchars($parametros['consumo_promedio_por_auto']) : '' ?>" required>
        </div>
        
        <div class="form-group">
            <label>Tiempo por Auto (minutos)</label>
            <input type="text" name="tiempo_por_auto" 
                value="<?= isset($parametros['tiempo_promedio_carga']) ? substr($parametros['tiempo_promedio_carga'], 0, 5) : '' ?>" required>
        </div>
        
        <div class="form-group">
            <label>Largo del Vehículo (metros)</label>
            <input type="number" step="0.01" name="largo_vehiculo" 
                value="<?= isset($parametros['largo_promedio_auto']) ? htmlspecialchars($parametros['largo_promedio_auto']) : '' ?>" required>
        </div>
        
        <button type="submit">Guardar</button>
    </form>

</body>
</html>

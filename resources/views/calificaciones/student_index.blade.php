<!DOCTYPE html>
<html>
<head>
    <title>Mis Calificaciones</title>
</head>
<body>
    <h1>Mis Calificaciones</h1>
    
    <?php if(count($calificaciones) > 0): ?>
        <table border="1">
            <tr>
                <th>Materia</th>
                <th>Grupo</th>
                <th>Calificación</th>
            </tr>
            <?php foreach($calificaciones as $calificacion): ?>
                <tr>
                    <td><?php echo $calificacion->grupo->horario->materia->nombre; ?></td>
                    <td><?php echo $calificacion->grupo->nombre; ?></td>
                    <td><?php echo $calificacion->calificacion; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No tienes calificaciones registradas</p>
    <?php endif; ?>
    
    <br>
    <a href="/dashboard">Volver al Dashboard</a>
</body>
</html>

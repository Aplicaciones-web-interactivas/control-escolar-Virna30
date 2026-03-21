<!DOCTYPE html>
<html>
<head>
    <title>Alumnos del Grupo</title>
</head>
<body>
    <h1>Grupo: <?php echo $grupo->nombre; ?></h1>
    <h2>Materia: <?php echo $grupo->horario->materia->nombre; ?></h2>
    
    <?php if(session('success')): ?>
        <p style="color: green;"><?php echo session('success'); ?></p>
    <?php endif; ?>
    
    <?php if(session('error')): ?>
        <p style="color: red;"><?php echo session('error'); ?></p>
    <?php endif; ?>
    
    <table border="1">
        <tr>
            <th>Alumno</th>
            <th>Calificación</th>
            <th>Acción</th>
        </tr>
        <?php foreach($alumnos as $alumno): ?>
            <tr>
                <td><?php echo $alumno['user']->nombre; ?></td>
                <td>
                    <?php if($alumno['calificacion']): ?>
                        <?php echo $alumno['calificacion']; ?>
                    <?php else: ?>
                        Sin calificación
                    <?php endif; ?>
                </td>
                <td>
                    <form action="/calificaciones" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="grupo_id" value="<?php echo $grupo->id; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $alumno['user']->id; ?>">
                        <input type="number" name="calificacion" 
                               value="<?php echo $alumno['calificacion'] ?? ''; ?>" 
                               min="0" max="100" step="0.01" required>
                        <button type="submit">Guardar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    
    <br>
    <a href="/calificaciones">Volver a Mis Grupos</a>
</body>
</html>

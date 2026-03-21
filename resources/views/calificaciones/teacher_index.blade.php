<!DOCTYPE html>
<html>
<head>
    <title>Calificaciones - Maestro</title>
</head>
<body>
    <h1>Mis Grupos</h1>
    
    <?php if(count($grupos) > 0): ?>
        <ul>
            <?php foreach($grupos as $grupo): ?>
                <li>
                    <a href="/calificaciones/grupo/<?php echo $grupo->id; ?>">
                        <?php echo $grupo->nombre; ?> - 
                        <?php echo $grupo->horario->materia->nombre; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No tienes grupos asignados</p>
    <?php endif; ?>
    
    <br>
    <a href="/dashboard">Volver al Dashboard</a>
</body>
</html>

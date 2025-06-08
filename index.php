<?php
// index.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hola Mundo - AlmaLinux PHP 7.4</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            max-width: 600px;
            width: 100%;
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 15px;
            margin: 15px 0;
        }
        .success {
            color: #28a745;
            font-weight: bold;
        }
        .folder-status {
            background: #e9ecef;
            padding: 10px;
            border-radius: 5px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>¡Hola Mundo desde Docker! Modificado</h1>
        
        <div class="info-box">
            <h3>🐧 Información del Sistema</h3>
            <p><strong>Sistema Operativo:</strong> <?php echo php_uname('s') . ' ' . php_uname('r'); ?></p>
            <p><strong>Versión de PHP:</strong> <span class="success"><?php echo PHP_VERSION; ?></span></p>
            <p><strong>Servidor Web:</strong> <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'Apache'; ?></p>
            <p><strong>Fecha y Hora:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
        </div>

        <div class="info-box">
            <h3>📁 Estado de Carpetas</h3>
            <div class="folder-status">
                <p><strong>Carpeta webimagenes:</strong> 
                <?php
                $webimagenesPath = '/var/www/html/webimagenes';
                if (is_dir($webimagenesPath)) {
                    echo '<span class="success">✅ Existe y está protegida por volumen de Docker</span>';
                    
                    // Crear archivo de prueba si no existe
                    $testFile = $webimagenesPath . '/test.txt';
                    if (!file_exists($testFile)) {
                        file_put_contents($testFile, 'Archivo de prueba creado el: ' . date('Y-m-d H:i:s'));
                    }
                    
                    // Mostrar archivos en la carpeta
                    $files = scandir($webimagenesPath);
                    $fileCount = count($files) - 2; // Excluir . y ..
                    echo "<br>📄 Archivos en la carpeta: $fileCount";
                } else {
                    echo '<span style="color: red;">❌ No existe</span>';
                }
                ?>
                </p>
            </div>
        </div>

        <div class="info-box">
            <h3>🔧 Extensiones PHP Cargadas</h3>
            <p>
                <?php
                $extensions = ['curl', 'gd', 'json', 'mbstring', 'mysql', 'xml', 'zip'];
                foreach ($extensions as $ext) {
                    $status = extension_loaded($ext) ? '✅' : '❌';
                    echo "$status $ext &nbsp;&nbsp;";
                }
                ?>
            </p>
        </div>

        <div class="info-box">
            <h3>🐳 Docker & Automatización</h3>
            <p>✅ Contenedor corriendo en puerto 8080</p>
            <p>✅ Watchtower configurado para auto-updates</p>
            <p>✅ Volumen persistente para webimagenes</p>
            <p>✅ Red Docker personalizada configurada</p>
        </div>

        <div style="text-align: center; margin-top: 30px;">
            <p><em>Proyecto creado con AlmaLinux 8 + PHP 7.4 + Docker Compose</em></p>
        </div>
    </div>
</body>
</html>
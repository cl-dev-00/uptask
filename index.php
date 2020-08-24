<?php include "includes/funciones/sesiones.php"; ?>
<?php include "includes/funciones/funciones.php"; ?>
<?php include "includes/templates/header.php"; ?>
<?php include "includes/templates/barra.php"; ?>

<?php 

    $id = null;

    if(isset($_GET["id_proyecto"])) {
        $id = $_GET["id_proyecto"];
    }

?>

<div class="contenedor">
    
    <?php include "includes/templates/sidebar.php"; ?>

    <main class="contenido-principal">

        <?php 
            $proyecto = obtenerNombreProyecto($id);
            if($proyecto) {
        ?>
            <h1>
                <?php 
                foreach($proyecto as $nombre) { ?>
                    <span><?php echo $nombre['nombre']; ?></span>
                <?php } ?>
            </h1>

            <form action="#" class="agregar-tarea">
                <div class="campo">
                    <label for="tarea">Tarea:</label>
                    <input type="text" placeholder="Nombre Tarea" class="nombre-tarea"> 
                </div>
                <div class="campo enviar">
                    <input type="hidden" id="id_proyecto" value="<?php echo $id; ?>">
                    <input type="submit" class="boton nueva-tarea" value="Agregar">
                </div>
            </form>

            <?php }
            
            else {
                echo "Selecciona un proyecto de la izquierda";
            }
            
            ?>

            <h2>Listado de tareas:</h2>

            <div class="listado-pendientes">
                <ul>
                    <?php  

                        $tareas = obtenerTareas($id);

                        if($tareas) {

                            if($tareas->num_rows > 0) {

                                foreach($tareas as $tarea) {
                    ?>
                                <li id="tarea:<?php echo $tarea['id']; ?>" class="tarea">
                                    <p><?php echo $tarea["nombre"]; ?></p>
                                    <div class="acciones">
                                        <i class="far fa-check-circle <?php echo ($tarea["estado"]==="1")? "completo" : ""; ?>"></i>
                                        <i class="fas fa-trash"></i>
                                    </div>
                                </li>  
                    <?php 
                                }
                            } else {
                                echo "<p class='tareas-vacio'>No hay ninguna tarea en este proyecto</p>";
                            } 
                        
                        }
                    ?>
                </ul>
            </div>

            <div class="avance">
                <h2>Avance proyecto</h2>
                <div id="barra-avance" class="barra-avance">
                    <div id="porcentaje" class="porcentaje"></div>
                </div>
                
            </div>

        </main>

</div><!--.contenedor-->


<?php include "includes/templates/footer.php"; ?>
<?php
    include 'idiomas\idiomas_index.php'; 
?>
<html>
    <link rel="stylesheet" href="../assets/css/footer.css">
    <footer class="footer">
        <div class="footer-content contenedor_footer">
            <!--Idioma-->
            <div class="leng">
                <form method="POST" action="" enctype="multipart/form-data" class="idioma">
                    <label for="lang" class="texto"><?php echo $palabras['config']['idioma'].' '?></label>
                    <select name="lang" id="lang" onchange="this.form.submit()" class="texto">
                        <option value="es" <?php echo ($idioma == 'es') ? 'selected' : ''; ?> class="options"><?php echo $palabras['idiomas']['idioma1'] ?></option>
                        <option value="en" <?php echo ($idioma == 'en') ? 'selected' : ''; ?> class="options"><?php echo $palabras['idiomas']['idioma2'] ?></option>
                    </select>
                </form>
            </div>
            <!--Logo-->
            <div class="logo-foot">
                <p class="logo-foot texto">TimerLab</p>
            </div>
        </div>
    </footer>
</html>
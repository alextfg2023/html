<form method="POST" action="" enctype="multipart/form-data">
    <label for="lang"><?php echo $palabras['config']['idioma'] ?></label>
    <select name="lang" id="lang" onchange="this.form.submit()">
        <option value="es" <?php echo ($idioma == 'es') ? 'selected' : ''; ?>><?php echo $palabras['idiomas']['idioma1'] ?></option>
        <option value="en" <?php echo ($idioma == 'en') ? 'selected' : ''; ?>><?php echo $palabras['idiomas']['idioma2'] ?></option>
    </select>
</form>
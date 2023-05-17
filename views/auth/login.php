<main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

    <?php foreach($errores as $error): ?>
         <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

        <form class="formulario" method="POST" action="/login">
        <fieldset>
          <legend>Email y Password</legend>

          <label for="email">Email</label>
          <input id="email" name="email" type="email" placeholder="Tu Email" value="   
            <?php if ($email){
            echo $email;
            }?>" 
            required/>
          <label for="password">Teléfono</label>
          <input id="password" name="password" type="password" placeholder="Tu Password" required/>

        </fieldset>
        <input type="submit" class="boton-verde" value="enviar">
        </form>
    </main>
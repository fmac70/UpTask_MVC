<div class="contenedor recuperar">
    <?php
    @include_once __DIR__ . '/../templates/nombre-sitio.php';	
    ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Recupera tu Password</p>
            <form method="POST" class="formulario" action="recuperar-password">
               
                <div class="campo">
					<label for="password">Password</label>
					<input type="password" id="password" name="password" placeholder="Tu Password" required>
				</div>
				
				<div class="campo">
					<label for="password2">Password</label>
					<input type="password" id="password2" name="password2" placeholder="Repetir Password" required>
				</div>


                <input type="submit" class="boton" value="Enviar Instrucciones">  
            </form>
            <div class="acciones">
                <a href="/">¿Ya tienes cuenta? Inciar Sessión</a>	
                <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear una</a>	
            </div>

    </div> <!--.contenedor-sm-->    

</div>  <!--.contenedor-->
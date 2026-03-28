<div class="contenedor login">
	<?php
	@include_once __DIR__ . '/../templates/nombre-sitio.php';	
	?>

	<div class="contenedor-sm">
		<p class="descripcion-pagina">Inicia Sesión con tus Datos</p>

			<form method="POST" class="formulario" action="/">
				<div class="campo">
					<label for="email">Email</label>
					<input type="email" id="email" name="email" placeholder="Tu Email" required>
				</div>

				<div class="campo">
					<label for="password">Password</label>
					<input type="password" id="password" name="password" placeholder="Tu Password" required>
				</div>

				<input type="submit" class="boton" value="Iniciar Sesión">  
			</form>
			<div class="acciones">
				<a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear una</a>	
				<a href="/olvide-password">¿Olvidaste tu Password?</a>
			</div>

	</div> <!--.contenedor-sm-->
</div>  <!--.contenedor-->
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">Editar Jugadores</h3>
    </div>
    	<div class="card-body">
    		<form method="post">
        	<?php
			$editarJugador = new MvcController();
			$editarJugador -> editarJugadorController();
			$editarJugador -> actualizarJugadorController();
			?>
			</form>          	
        </div>
</div>

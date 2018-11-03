<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">Editar Equipos</h3>
    </div>
    	<div class="card-body">
    		<form method="post">
        	<?php
			$editarEquipo = new MvcController();
			$editarEquipo -> editarEquipoController();
			$editarEquipo -> actualizarEquipoController();
			?>
			</form>          	
        </div>
</div>

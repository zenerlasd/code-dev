					<?php foreach ($row as $key => $turnos): ?>

						<div class="row well-white marcador-borde-verde bloque-top">
							<div class="col-sm-2 fontSize1_5">
								<?php echo $turnos['LABOR']; ?>
							</div>
							<div class="col-sm-5">
								<?php $terminal = str_replace(" ", "-", $turnos['TERMINAL']); ?>
								<?php //$CDE = $this->test_model->getServicios($turnos['TER_PKSTRID']); ?>

								<h5 class="media-heading text-primary ajaxLink">	
									<a href="<?php echo site_url('test/cargarModalTurnoAjax/' . $terminal . '/' . $turnos['TER_PKSTRID']); ?>" 
										class="fontSize1_5" data-toggle="modal" data-target="#myModal">
										<?php echo $turnos['NOMBRE']; ?>
									</a>
								</h5>
								

								
							</div>
							<div class="col-sm-2 fontSize1_5">
								<?php echo gmdate('H:i:s',$turnos['TIEMPO']*60); ?>
								<span class="pull-right"><a><?php echo $turnos['TURNO']; ?></a></span>
							</div>
							<div class="col-sm-3 fontSize1_5">
								<?php echo $turnos['TERMINAL']; ?>
							</div>
						</div>
					<?php endforeach; ?>
<script>
		$('.ajaxLink a').on('click', function() {
			//var id_enlace_foro = $(this).attr('id');
			var ipCifrada = $('.containerIP').attr('id');

			var enlace_foro = $(this).attr('href') + "/" + ipCifrada;
			console.log(enlace_foro)
			$('.cuerpoModalDelForo, #cuerpoModalDelForo').html('<i class="centrar-caja font-color-blanco fa fa-refresh fa-spin fa-4x text-success"></i>');
			$('#cuerpoModalDelForo').load(enlace_foro);
			$('.cuerpoModalDelForo').load(enlace_foro);

		});
</script>
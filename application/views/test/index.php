	<?php $of['oficina2'] = str_replace("-", " ", $oficina); ?>
	<div class="container containerIP" id="<?php echo $ipCifrada; ?>">

		<div id="dashboardEncabezado-titulo">
			<a href=""></a>
			<a href="<?php echo site_url('test/dashboardEncabezado'); ?>"></a>
		</div>
			
		<div class="row">
			<div id="dashboardEncabezado" class="col-md-8 col-sm-8">
				<script>
					var ipCifrada = $('.containerIP').attr('id');
					var enlaceLoad3 = $('#dashboardEncabezado-titulo a:eq(1)').attr('href')+ '/' + ipCifrada;
					$('#dashboardEncabezado').load(enlaceLoad3);
				</script>
			</div>

			<div class="col-md-4 col-sm-4">
			<?php $this->load->view('templates/datalist'); ?>
			</div>
		</div>

		<div class="row" id="gtr">
			<div class="col-md-6">
				<div class="panel panel-tigo-verde panel-extra">
					<div class="panel-heading">
						<h3 class="panel-title" id="estadoAsesores-titulo">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
		         				 Estado de los asesores <span class="fontSize0"><?php echo $of['oficina2']; ?></span>
		        			</a>
		        			<a href="<?php echo site_url('test/renderRacsTiempoReal/' . $oficina); ?>"></a>
	        			</h3>
					</div>
					<div id="collapseOne" class="panel-collapse collapse in">
						<div class="panel-body" id="">

							<div id="estadoAsesoresChart" style="min-width: 45%; height: 110px; margin: 0 auto">
							</div>

							<div id="estadoAsesores">
								<script>
									var ipCifrada = $('.containerIP').attr('id');
									var enlaceLoad1 = $('#estadoAsesores-titulo a:eq(1)').attr('href')+ '/' + ipCifrada;
									 console.log(enlaceLoad1)
									$('#estadoAsesores').html('<p class="text-center"><i class="fa fa-refresh fa-spin fa-2x text-success"></i></p>');
									
									$.get( enlaceLoad1, function( data ) {
									  	if (data != 0) {
									  		$( "#estadoAsesores" ).html( data );
									  	} else if (data == 0) {
									  		$( "#estadoAsesores" ).text("ola k ase");
									  	};

									}).fail(function() {
									    alert( "Up's ha ocurrido un error" );
									});

								</script>
							</div>
							
						</div>
					</div>

				</div>
			</div>
			
			<div class="col-md-6">
				<div class="panel panel-tigo-verde panel-extra">
					<div class="panel-heading">
						<h3 class="panel-title" id="clientesEspera-titulo">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseClientes">
		         				 Clientes en espera <span class="fontSize0"><?php echo $of['oficina2']; ?></span>
		        			</a>
		        			<a href="<?php echo site_url('test/renderClientesEsperaTiempoReal/' . $oficina); ?>"></a>
		        			<a href="<?php echo site_url('test/chartCientesEspera/' . $oficina); ?>"></a>
	        			</h3>
					</div>
					<div id="collapseClientes" class="panel-collapse collapse in">
						<div class="panel-body" id="">
							<div id="loquesea"></div>
							<div id="estadoSala" style="min-width: 45%; height: 100px; margin: 0 auto"></div>

							<div id="clientesEspera">
								<script>
									var ipCifrada = $('.containerIP').attr('id');
									var enlaceLoad1 = $('#clientesEspera-titulo a:eq(1)').attr('href')+ '/' + ipCifrada;
									 console.log(enlaceLoad1)
									$('#clientesEspera').html('<p class="text-center"><i class="fa fa-refresh fa-spin fa-2x text-success"></i></p>');
									$('#clientesEspera').load(enlaceLoad1, function( response, status, xhr ) {
									  if ( status == "error" ) {
									    var msg = "Error  NOT found ";
									    $( "#clientesEspera" ).html( msg + xhr.status + " " + xhr.statusText );
									  }
									});
								</script>
							</div>
			
						</div>
					</div>

				</div>
			</div>

		</div>
	</div>
	<div class="container">
		<div class="row" id="actividad-acumulada">
			<div class="col-sm-6 col-md-3" id="sinTurno" style="padding-right: 5px;padding-left: 5px;">
				<?php $this->load->view('test/paneles/panelSinTurno', $of); ?>
			</div>
			
			<div class="col-sm-6 col-md-3" id="almuerzo" style="padding-right: 5px;padding-left: 5px;">
				<?php $this->load->view('test/paneles/panelAlmuerzo', $of); ?>
			</div>

			<div class="col-sm-6 col-md-3" id="Control-disponibles" style="padding-right: 5px;padding-left: 5px;">
				<?php $this->load->view('test/paneles/panelLaborAdministrativa', $of); ?>
			</div>

			<div class="col-sm-6 col-md-3" id="AHT-alto" style="padding-right: 5px;padding-left: 5px;">
				<?php $this->load->view('test/paneles/panelBano', $of); ?>
			</div>
		</div>
	</div>


	<div class="container">

		<div class="row" id="estadisticas">
			<div class="col-md-12">
				<?php $this->load->view('test/paneles/estadisticas'); ?>
			</div>
		</div>

		<div class="row" id="visitasPanel">
			<div class="col-md-12">
				<?php $this->load->view('test/paneles/visitasVista'); ?>
			</div>
		</div>
	</div>

	<div class="container">

		<div class="row" id="timelineEstadoAsesores">
			<div class="col-md-12">
				<?php $this->load->view('test/paneles/timelineEstadoAsesores'); ?>
			</div>
		</div>
	</div>


	
	<!-- <pre class="fontSize1"><?php //print_r($row) ?></pre> -->

    <?php echo $this->benchmark->elapsed_time();?>seg
    
    <?php echo $this->benchmark->memory_usage();?>
<br>

<!-- Modal -->


<div class="modal cuerpoModalDelForo" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div><!-- /.modal -->
<!DOCTYPE html>
<html>

<head>
	<title>Sistema de Votación</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script>
		$(document).ready(function() {
			$('#region').change(function() {
				var regionId = $(this).val();

				$.get(`comunas.php?region_id=${regionId}`, function(comunas) {
					var select = $('#comuna');
					select.empty();
					$.each(comunas, function(index, comuna) {
						select.append($('<option>', {
							value: comuna.id,
							text: comuna.nombre
						}));
					});
				});
			});

			$('#formulario').submit(function(event) {
				event.preventDefault(); // Evitar que se envíe el formulario de manera predeterminada

				var payload = {
					nombre: $('#nombre').val(),
					alias: $('#alias').val(),
					rut: $('#rut').val(),
					email: $('#email').val(),
					comuna_id: $('#comuna').val(),
					candidato_id: $('#candidato').val(),
					medios: $('.medios:checked').map(function() {
						return $(this).val();
					}).get(),
				};

				$.post('votar.php', payload)
					.done((data) => {
						$('#form').hide();
						$('#success').show();
					})
					.fail((result) => {
						var error = (result && result.responseJSON && result.responseJSON.error) || 'Error inesperado';
						$.toast({
							heading: 'Error',
							text: error,
							icon: 'error',
							position: 'top-center',
							loader: false, // Change it to false to disable loader
						});
					});
			});

			reset();
		});

		function reset() {
			$('#nombre').val('');
			$('#alias').val('');
			$('#rut').val('');
			$('#email').val('');
			$('#region').empty();

			$('#region').append($('<option>', {
				value: '',
				text: 'Seleccione una región',
			}));

			$('#comuna').empty();

			$('#comuna').append($('<option>', {
				value: '',
				text: 'Seleccione una comuna',
			}));

			$('#candidato').empty();

			$('#candidato').append($('<option>', {
				value: '',
				text: 'Seleccione un candidato',
			}));

			$('.medios:checked').prop('checked', false);

			$('#form').show();
			$('#success').hide();

			$.get('candidatos.php', function(candidatos) {
				select = $('#candidato');
				$.each(candidatos, function(index, candidato) {
					select.append($('<option>', {
						value: candidato.id,
						text: candidato.nombre
					}));
				});
			});

			$.get('regiones.php', function(regiones) {
				var select = $('#region');
				$.each(regiones, function(index, region) {
					select.append($('<option>', {
						value: region.id,
						text: region.nombre
					}));
				});
			});
		}
	</script>


	<style>
		#form {
			border: 2px solid black;
			/* Agregar un borde al contenedor */
			padding: 20px;
			/* Agregar un relleno al contenedor */
			width: 700px;
			/* Ancho del contenedor */
		}
	</style>


</head>

<body>
	<div id="form">
		<h1>FORMULARIO DE VOTACION</h1>
		<form id="formulario">
			<label>Nombre y Apellido:</label>
			<input type="text" id="nombre" name="nombre_apellido" required><br><br>

			<label>Alias:</label>
			<input type="text" id="alias" name="alias" required><br><br>

			<label>RUT:</label>
			<input type="text" id="rut" name="rut" required><br><br>

			<label>Email:</label>
			<input type="text" id="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"><br><br>

			<label>Región:</label>
			<select id="region" name="region_id">
			</select><br><br>

			<label>Comuna:</label>
			<select id="comuna" name="comuna_id">
			</select><br><br>

			<label>Candidato:</label>
			<select id="candidato" name="candidato_id">
			</select><br><br>

			<label>¿Cómo se enteró de nosotros?</label>
			<input type="checkbox" class="medios" value="Web"> Web
			<input type="checkbox" class="medios" value="TV"> TV
			<input type="checkbox" class="medios" value="Redes Sociales"> Redes Sociales
			<input type="checkbox" class="medios" value="Amigo"> Amigo<br><br>

			<input type="submit" value="Votar">
		</form>
	</div>
	<div id="success" style="display: none">
		<p>
			El voto se ha registrado correctamente! Muchas gracias por su tiempo.
		</p>
		<button onclick="reset();">Registrar otro voto</button>
	</div>
</body>

</html>
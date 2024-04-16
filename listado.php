<?php include "cabecera.htm"; ?>

<div class="container">
	</br>
  	<table class="table table-striped">
	<?php
		$titulo = $_POST["titulo"];
		$year = $_POST["year"];
		$tipo = $_POST["tipo"];
		$url = "https://www.omdbapi.com/?apikey=fe8a7565&s=$titulo&y=$year&type=$tipo";
		$url = str_replace(' ', '%20', $url);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);
		$data = curl_exec($curl);
		curl_close($curl);

		echo "<tr><th>Título</th><th>Año</th><th>Tipo</th><th>Acciones</th></tr>";
		$data_convertido = json_decode($data, true);

		foreach($data_convertido["Search"] as $film){
			echo "<tr>";
			echo "<td>" . $film["Title"] . "</td>";
			echo "<td>" . $film["Year"] . "</td>";
			echo "<td>" . $film["Type"] . "</td>";
			echo "<td><a href='ficha.php?num_ficha=" . $film["imdbID"] . "'>" . "<button class='btn btn-outline-success btn-sm'>Ficha</button>" . "</a></td>";
			echo "</tr>";
		}
	?>
	</table>
	</br>
	<p>
		<?php
			echo "&nbsp;&nbsp;" . $data_convertido["totalResults"] . " registros encontrados"
		?>
	</p>	
</div>

<?php include "pie.htm"; ?>	
	
	


	
	

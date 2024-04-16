<?php include "cabecera.htm"; ?>

<div class="container">
	</br>
  	<table class="table table-striped">
	<?php
		$xml = simplexml_load_file("preferidos.xml");
		$json = json_encode($xml);
		$un_array = json_decode($json,TRUE);

		/* FASE 1
		foreach($un_array["preferido"] as $preferido){
			echo $preferido["id_usuario"];
			echo "</br>";
			echo $preferido["id_recurso"];
			echo "</br>";
		}
		*/
		
		/* FASE 2
		foreach($un_array["preferido"] as $preferido){
			if ($preferido["id_usuario"] == $_GET["id_usuario"]){
				echo $preferido["id_recurso"];
				echo "</br>";
			}	
		}
		*/

		echo "<tr><th>Título</th><th>Año</th><th>Tipo</th></tr>";

		foreach($un_array["preferido"] as $preferido){
			if ($preferido["id_usuario"] == $_GET["id_usuario"]){
				$ficha = $preferido["id_recurso"];
				$url = "https://www.omdbapi.com/?apikey=fe8a7565&i=$ficha";
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_HEADER, false);
				$data = curl_exec($curl);
				curl_close($curl);
				$data_convertido = json_decode($data, true);
				echo "<tr>";
				echo "<td>" . $data_convertido["Title"] . "</td>";
				echo "<td>" . $data_convertido["Year"] . "</td>";
				echo "<td>" . $data_convertido["Type"] . "</td>";
				echo "</tr>";
			}	
		}
	?>
	</table>	
</div>

<?php include "pie.htm"; ?>
	
	
	


	
	

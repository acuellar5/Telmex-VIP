<?php 
	header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
	header("Content-Disposition: attachment;filename= como_se_va_a_llamar.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
?>
<!-- <h3 align="center" style="color: #084c6f;">Tabla de Detalles</h3>

<table width="100%" border="1">
	<tr bgcolor="#084c6f" style="color: white;" align="center" >
		<td>OTP</td>
		<td>Cliente</td>
		<td>tipo OTP</td>
		<td>Servicio</td>
		<td>Estado otp</td>
		<td>Programacion</td>
		<td>Compromiso</td>
		<td>Creacion</td>
		<td>Ingeniero</td>
		<td>OTH</td>
		<td>Tipo OTH</td>
		<td>Estado OTH</td>
	</tr>
<?php 
//$registros
for ($i=0; $i < count($registros); $i++) { 
	echo "<tr>";
		echo "<td>".elimina_acentos($registros[$i]->k_id_ot_padre)."</td>";
		echo "<td>".elimina_acentos($registros[$i]->n_nombre_cliente)."</td>";
		echo "<td>".elimina_acentos($registros[$i]->orden_trabajo)."</td>";
		echo "<td>".elimina_acentos($registros[$i]->servicio)."</td>";
		echo "<td>".elimina_acentos($registros[$i]->estado_orden_trabajo)."</td>";
		echo "<td>".elimina_acentos($registros[$i]->fecha_programacion)."</td>";
		echo "<td>".elimina_acentos($registros[$i]->fecha_compromiso)."</td>";
		echo "<td>".elimina_acentos($registros[$i]->fecha_creacion)."</td>";
		echo "<td>".elimina_acentos($registros[$i]->nombre)."</td>";
		echo "<td>".elimina_acentos($registros[$i]->id_orden_trabajo_hija)."</td>";
		echo "<td>".elimina_acentos($registros[$i]->ot_hija)."</td>";
		echo "<td>".elimina_acentos($registros[$i]->estado_orden_trabajo_hija)."</td>";
	echo "</tr>";
			
}
?>
</table>
 -->





 <h3 align="center" style="color: #084c6f;">Tabla de Detalles OTP</h3>

<table width="100%" border="1">
	<thead>
		<th>OTP</th>
		<th>Nombre cliente</th>
		<th>Tipo OTP</th>
		<th>Servicio</th>
		<th>Estado OTP</th>
		<th>Programado</th>
		<th>Compromiso</th>
		<th>Creacion</th>
		<th>Nombre</th>
		<th>Lista</th>
		<th>Observacion</th>
	</thead>
<?php 
//$registros
for ($i=0; $i < count($registros['otp']); $i++) { 
	echo "<tr>";
		echo "<td>".$registros['otp'][$i]->k_id_ot_padre."</td>";
		echo "<td>".$registros['otp'][$i]->n_nombre_cliente."</td>";
		echo "<td>".$registros['otp'][$i]->orden_trabajo."</td>";
		echo "<td>".$registros['otp'][$i]->servicio."</td>";
		echo "<td>".$registros['otp'][$i]->estado_orden_trabajo."</td>";
		echo "<td>".$registros['otp'][$i]->fecha_programacion."</td>";
		echo "<td>".$registros['otp'][$i]->fecha_compromiso."</td>";
		echo "<td>".$registros['otp'][$i]->fecha_creacion."</td>";
		echo "<td>".$registros['otp'][$i]->nombre."</td>";
		echo "<td><select class='form-control'>";
					echo "<option value=''>1</option>";
					echo "<option value=''>2</option>";
					echo "<option value=''>3</option>";
					echo "<option value=''>4</option>";
					echo "<option value=''>5</option>";
				echo "</select></td>";
		echo "<td><textarea rows='1'></textarea></td>";
	echo "</tr>";
			
}
?>
</table>
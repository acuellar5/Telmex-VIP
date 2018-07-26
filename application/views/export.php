<?php 
	header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
	header("Content-Disposition: attachment;filename= como_se_va_a_llamar.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
?>

<table>
	<tr>
		<td>
			<table width="100%" border="1">
				<h3 align="center" style="color: #084c6f;">Tabla de Detalles OTP</h3>
					<tr bgcolor="#084c6f" style="color: white;" align="center" >
						<td>OTP</td>
						<td>Nombre cliente</td>
						<td>Tipo OTP</td>
						<td>Servicio</td>
						<td>Estado OTP</td>
						<td>Programado</td>
						<td>Compromiso</td>
						<td>Creacion</td>
						<td>Nombre</td>
					</tr>
				<?php 
				//$registros
				for ($i=0; $i < count($registros['otp']); $i++) { 
					echo "<tr>";
						echo "<td>".elimina_acentos($registros['otp'][$i]->k_id_ot_padre)."</td>";
						echo "<td>".elimina_acentos($registros['otp'][$i]->n_nombre_cliente)."</td>";
						echo "<td>".elimina_acentos($registros['otp'][$i]->orden_trabajo)."</td>";
						echo "<td>".elimina_acentos($registros['otp'][$i]->servicio)."</td>";
						echo "<td>".elimina_acentos($registros['otp'][$i]->estado_orden_trabajo)."</td>";
						echo "<td>".elimina_acentos($registros['otp'][$i]->fecha_programacion)."</td>";
						echo "<td>".elimina_acentos($registros['otp'][$i]->fecha_compromiso)."</td>";
						echo "<td>".elimina_acentos($registros['otp'][$i]->fecha_creacion)."</td>";
						echo "<td>".elimina_acentos($registros['otp'][$i]->nombre)."</td>";
					echo "</tr>";
							
				}
				?>
			</table>
		</td>
		<td>   </td>
		<td>
			<table width="100%" border="1">
				<h3 align="center" style="color: #084c6f;">Tabla de Detalles OTH</h3>
				<tr bgcolor="#084c6f" style="color: white;" align="center" >
					<td>OTP</td>
					<td>Cliente</td>
					<td>tipo OTP</td>
					<td>Servicio</td>
					<td>Estado otp</td>
					<td>Programación</td>
					<td>Compromiso</td>
					<td>Creación</td>
					<td>Ingeniero</td>
					<td>OTH</td>
					<td>Tipo OTH</td>
					<td>Estado OTH</td>
				</tr>
			<?php 
			//$registros
			for ($i=0; $i < count($registros['oth']); $i++) { 
				echo "<tr>";
					echo "<td>".elimina_acentos($registros['oth'][$i]->k_id_ot_padre)."</td>";
					echo "<td>".elimina_acentos($registros['oth'][$i]->n_nombre_cliente)."</td>";
					echo "<td>".elimina_acentos($registros['oth'][$i]->orden_trabajo)."</td>";
					echo "<td>".elimina_acentos($registros['oth'][$i]->servicio)."</td>";
					echo "<td>".elimina_acentos($registros['oth'][$i]->estado_orden_trabajo)."</td>";
					echo "<td>".elimina_acentos($registros['oth'][$i]->fecha_programacion)."</td>";
					echo "<td>".elimina_acentos($registros['oth'][$i]->fecha_compromiso)."</td>";
					echo "<td>".elimina_acentos($registros['oth'][$i]->fecha_creacion)."</td>";
					echo "<td>".elimina_acentos($registros['oth'][$i]->nombre)."</td>";
					echo "<td>".elimina_acentos($registros['oth'][$i]->id_orden_trabajo_hija)."</td>";
					echo "<td>".elimina_acentos($registros['oth'][$i]->ot_hija)."</td>";
					echo "<td>".elimina_acentos($registros['oth'][$i]->estado_orden_trabajo_hija)."</td>";
				echo "</tr>";
						
			}
			?>
		</table>
		</td>
	</tr>
</table>

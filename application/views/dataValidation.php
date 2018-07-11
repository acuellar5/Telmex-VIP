<div class="container autoheight p-t-20 m-t-20">
	<div class="alert alert-success alert-dismissable hidden" id="principalAlert">
		<a href="#" class="close">&times;</a>
		<p id="text" class="m-b-0 p-b-0"></p>
	</div>
	<label id="lblProgressInformation" class="hidden">0 de 0</label>
	<div class="progress hidden" id="progressProcessImportData">
		<div class="progress-bar progress-bar-striped active" role="progressbar"
		aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
		0%
	</div>
</div>
<div>
	<div class="container-contact100" style="border-radius: 2%;">
		<div class="wrap-contact100" >
			<form class="contact100-form validate-form">

				<div class="wrap-input100 input100-select bg1">
					<span class="label-input100">Opciones *</span>
					<div>
						<select class="js-select2 selectValidacionIP" name="service" id="service" onchange="cambioForm();">
							<option value="LoopBack">LoopBack</option>
							<option value="Publica">Pública</option>
							<option values="WAN">WAN</option>
							<option values="Lan Colaboracion">Lan Colaboracion</option>
						</select>
						<div class="dropDownSelect2"></div>
					</div>
				</div>

				<div class="wrap-input100  bg1 rs1-wrap-input100"  id="IPdiv">
					<span class="label-input100">IP *</span>
					<input class="input100" type="text" name="IP" id="IP" placeholder="Segmento de red a validar" required>
				</div>
				<div class="wrap-input100  bg1 rs1-wrap-input100"  id="mascaraLoo">
					<span class="label-input100">Mask*</span>
					<input class="input100" type="number" name="IP" id="mascaraL" required>
				</div>


				<div class="wrap-input100  bg1 rs1-wrap-input100"  id="IPPdiv" style="display:none;">
					<span class="label-input100">IP pública*</span>
					<input class="input100" type="text" name="IP" id="IPP" placeholder="Segmento de red a validar" required>
				</div>
				<div class="wrap-input100  bg1 rs1-wrap-input100"  id="mascaraPdiv" style="display:none;">
					<span class="label-input100">Mask*</span>
					<input class="input100" type="number" name="IP" id="mascaraP" required>
				</div>

				<div class="wrap-input100  bg1 rs1-wrap-input100"  id="IPWANdiv" style="display:none;">
					<span class="label-input100">IP*</span>
					<input class="input100" type="text" name="IP" id="IPWAN" placeholder="Segmento de red a validar" required>
				</div>
				<div class="wrap-input100  bg1 rs1-wrap-input100"  id="mascaraWANdiv" style="display:none;">
					<span class="label-input100">Mask*</span>
					<input class="input100" type="number" name="IP" id="mascaraWAN" required>
				</div>


				<div class="wrap-input100  bg1 rs1-wrap-input100"  id="IPLANC" style="display:none;">
					<span class="label-input100">IP*</span>
					<input class="input100" type="text" name="IP" id="IPLAN" placeholder="Segmento de red a validar" required>
				</div>
				<div class="wrap-input100  bg1 rs1-wrap-input100"  id="mascaraLAN" style="display:none;">
					<span class="label-input100">Mask*</span>
					<input class="input100" type="number" name="IP" id="mascaraLANCo" required>
				</div>

            <!-- <div class="wrap-input100  bg1 rs1-wrap-input100" >
              <span class="label-input100">Mask *</span>
              <input class="input100" type="number" name="mascara" id="mascara" placeholder="Mask" required>
            </div>

            <div class="wrap-input100 bg1 rs1-wrap-input100">
              <span class="label-input100">Busquela desde</span>
              <input class="input100" type="number" name="busqueda" id="busqueda">
            </div>

            <div class="wrap-input100 bg1 rs1-wrap-input100">
              <span class="label-input100">Posición Separador último Octeto</span>
              <input class="input100" type="number" name="posicion" id="posicion">
            </div>

            <div class="wrap-input100 bg1 rs1-wrap-input100">
              <span class="label-input100"># Char último octeto</span>
              <input class="input100" type="number" name="char" id="char">
            </div>

            <div class="wrap-input100 bg1 rs1-wrap-input100">
              <span class="label-input100">Último octeto</span>
              <input class="input100" type="number" name="ultimo" id="ultimo">
          </div> -->

          <div class="container-contact100-form-btn" id="resultadoDIV" >
          	<input type="button" value="Validar IP LoopBack" class="contact100-form-btn" onclick="validarInformacion()">
          </div>
          <div class="container-contact100-form-btn" id="resultadoPDIV" style="display:none;">
          	<input type="button" value="Validar IP Pública" class="contact100-form-btn" onclick="validarInformacionPublica()" >
          </div>
          <div class="container-contact100-form-btn" id="resultadoWANDIV" style="display:none;">
          	<input type="button" value="Validar WAN" class="contact100-form-btn" onclick="validarInformacionWAN()" >
          </div>
          <div class="container-contact100-form-btn" id="resultadolanDIV" style="display:none;">
          	<input type="button" value="Validar IP LAN" class="contact100-form-btn" onclick="validarInformacionLAN()" >
          </div>
      </br></br></br></br>

      <div class="wrap-input100  bg0 rs1-alert-validate" >
      	<span class="label-input100">Resultado</span>
      	<textarea class="input100" rows="20" name="message" placeholder="Resultado" id="resultado" disabled></textarea>
      </div>


  </form>
</div>
</div>

</div>
</div>

<script>
	$(".js-select2").each(function(){
		$(this).select2({
			minimumResultsForSearch: 20,
			dropdownParent: $(this).next('.dropDownSelect2')
		});


		$(".js-select2").each(function(){
			$(this).on('select2:close', function (e){
				if($(this).val() == "Please chooses") {
					$('.js-show-service').slideUp();
				}
				else {
					$('.js-show-service').slideUp();
					$('.js-show-service').slideDown();
				}
			});
		});
	})
</script>

<script>
	var filterBar = document.getElementById('filter-bar');

	noUiSlider.create(filterBar, {
		start: [ 1500, 3900 ],
		connect: true,
		range: {
			'min': 1500,
			'max': 7500
		}
	});

	var skipValues = [
	document.getElementById('value-lower'),
	document.getElementById('value-upper')
	];

	filterBar.noUiSlider.on('update', function( values, handle ) {
		skipValues[handle].innerHTML = Math.round(values[handle]);
		$('.contact100-form-range-value input[name="from-value"]').val($('#value-lower').html());
		$('.contact100-form-range-value input[name="to-value"]').val($('#value-upper').html());
	});
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-23581568-13');
</script>
<script scr="<?= URL::to("assets/plugins/sweetalert-master/dist/sweetalert.min.js") ?>" ></script>
<script type="text/javascript" charset="utf-8">
	function validarIP(ip){
		if(ip.split(".").length < 4 || (ip.split(".")[0] < 0 || ip.split(".")[0] > 256) || (ip.split(".")[1] < 0 || ip.split(".")[1] > 256) || (ip.split(".")[2] < 0 || ip.split(".")[2] > 256) || (ip.split(".")[3] < 0 || ip.split(".")[3] > 256)){
			swal({
				title: "Lo sentimos!",
				text: "Ingresa una IP valida",
				icon: "error",
				button: "volver",
			});
			return 0;
		} else {
			return 1;
		}
	}

	function validarInformacion(){
		var ip = $('#IP').val();
		var mask = $('#mascaraL').val();

		if(validarIP(ip)){
			var salida = "";

			if(ip == ""){
				$('#resultado').val("Por favor diligencie la IP");
			}
			else {
				if((ip.split(".")[0] == "10" && ip.split(".")[1] == "11" && ip.split(".")[2] == "205") || (ip.split(".")[0] == "10" && ip.split(".")[1] == "11" && ip.split(".")[2] == "204") || (ip.split(".")[0] == "10" && ip.split(".")[1] == "11" && ip.split(".")[2] == "206") || (ip.split(".")[0] == "10" && ip.split(".")[1] == "11" && ip.split(".")[2] == "207")){
					swal({
						title: "Lo sentimos!",
						text: "IP invalida, lo van hechar si usa esa IP",
						icon: "error",
						button: "volver",
					});
				} else {
					salida = salida + "****Estos comandos se deben correr sobre  ASR (A9KTRIARA1) - CONSULTA TABLA ENRUTAMIENTO ****" + "\n\n";
					salida = salida + "sh route vrf " + " ip-telephony longer-prefixes " + ip + "/" + mask + " | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] + "." + "\n";
					salida = salida + "sh route vrf " + " pymes-tpbc longer-prefixes " + ip + "/" + mask + " | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] + "." + "\n";
					salida = salida + "sh route vrf " + " sip-trunk longer-prefixes " + ip + "/" + mask + " | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] + "." + "\n";
					salida = salida + "sh route vrf " + " core-sip-trunk longer-prefixes " + ip + "/" + mask + " | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] + "." + "\n";
					salida = salida + "sh route vrf " + " ims-sbc-core longer-prefixes  " + ip + "/" + mask + " | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] + "." + "\n";
					salida = salida + "sh route vrf " + " ims-sbc-ippbx longer-prefixes " + ip + "/" + mask + " | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] + "." + "\n\n\n\n";

					salida = salida + "****Estos comandos se deben correr sobre    ASR (A9KTRIARA1) - CONSULTA BGP****" + "\n\n";

					salida = salida + "sh bgp vrf " + " ip-telephony " + ip + " | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] +"." + "\n";
					salida = salida + "sh bgp vrf " + "  pymes-tpbc " + ip + " | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + " sip-trunk " + ip + " | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + "  core-sip-trunk " + ip + " | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + " ims-sbc-core " + ip + " | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + " ims-sbc-ippbx " + ip + " | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] + "." + "\n\n\n\n";

					salida = salida + "****Estos comandos se deben correr sobre   ASR (A9KTRIARA1) ****" + "\n\n";
					salida = salida + "sh bgp" + " ipv4 all " + ip + "/" + mask + " | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] + "." +"\n";

					$('#resultado').val(salida);
				}
			}
		}
	}

	function validarInformacionPublica(){
		var ip = $('#IPP').val();
		var mask = $('#mascaraP').val();

		if(validarIP(ip)){
			var salida = "";
			if(ip == "" || mask == ""){
				$('#resultado').val("Por favor diligenciar todos los valores");
			}
			else {
				salida = salida + "****Estos comandos se deben correr sobre GSR (ICORTEZAL  |  ICCHICONORTE  |  ICBOSQUE  |  ICBOSTON) - CONSULTA ENRUTAMIENTO ESTÁTICO" + "\n\n";

				salida = salida + "show ip bgp vrf nap " + ip + "\n";
				salida = salida + "show ip bgp vrf internet  " + ip + "\n";
				salida = salida + "sh route vrf nap longer-prefixes " + ip + "/" + mask + "\n";
				salida = salida + "sh route vrf nap longer-prefixes " + ip + "/" + mask + " | inc " + ip + "\n";
				salida = salida + "sh route vrf internet longer-prefixes " + ip + "/" + mask + "\n";
				salida = salida + "sh route vrf internet longer-prefixes " + ip + "/" + mask + " | inc " + ip + "\n";
				salida = salida + "show ip bgp vpnv4 all " + ip + "\n\n\n\n";

				salida = salida + "****Estos comandos se deben correr sobre GSR (CHICONORTE2) - CONSULTA ENRUTAMIENTO DINÁMICO BGP****" + "\n\n";
				salida = salida + "show ip route vrf internet-vip " + ip + "\n";
				salida = salida + "show ip route vrf internet-nap " + ip + "\n";
				salida = salida + "show ip route vrf internet " + ip + "\n";
				salida = salida + "show ip route vrf pymes-internet " + ip + "\n\n\n\n";

				salida = salida + "****Estos comandos se deben correr sobre ASR (A9KTRIARA1  |  A9KORTEZAL)****" + "\n\n";
				salida = salida + "sh bgp all all " + ip + "/" + mask + " longer-prefixes | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + "\n";
				$('#resultado').val(salida);
			}
		}
	}

	function validarInformacionWAN(){
		var ip = $('#IPWAN').val();
		var mask = $('#mascaraWAN').val();

		if(validarIP(ip)){
			var salida = "";
			if(ip == "" || mask == ""){
				$('#resultado').val("Por favor diligenciar todos los valores");
			} else {
				salida = salida + "****Estos comandos se deben correr sobre GSR (CHICONORTE2)****" + "\n\n";

				for(var i = 0; i < 4; i++){
					salida = salida + "sh ip bgp vpnv4 all " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] + "." + (parseInt(ip.split(".")[3])+i) + " | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] + "." + "\n";
				}
				salida = salida + "\n\n\n\n";

				salida = salida + "****Estos comandos se deben correr sobre ASR (A9KTRIARA1  |  A9KORTEZAL)****" + "\n\n";


				salida = salida + "sh route longer-prefixes " + ip + "/" + mask + "\n";
				for(var i = 0; i < 4; i++){
					salida = salida + "sho ipv4 vrf all int bri | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] + "." + (parseInt(ip.split(".")[3])+i) + "\n";
				}

				salida = salida + "show ip route vrf cpemanagement " + ip + "\n";
				salida = salida + "show bgp vrf cpemanagement " + ip + "\n";
				salida = salida + "sh bgp all all " + ip + "/" + mask + " longer-prefixes | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] + "." +"\n";

				$('#resultado').val(salida);
			}
		}
	}

	function validarInformacionLAN(){
		var ip = $('#IPLAN').val();
		var mask = $('#mascaraLANCo').val();
		var mip = ip.split(".");

		if(validarIP(ip)){
			var salida = "";

			if(ip == ""){
				$('#resultado').val("Por favor diligencie la IP");
			}
			else {
				if((ip.split(".")[0] == "10" && ip.split(".")[1] == "11" && ip.split(".")[2] == "205") || (ip.split(".")[0] == "10" && ip.split(".")[1] == "11" && ip.split(".")[2] == "204") || (ip.split(".")[0] == "10" && ip.split(".")[1] == "11" && ip.split(".")[2] == "206") || (ip.split(".")[0] == "10" && ip.split(".")[1] == "11" && ip.split(".")[2] == "207")){
					swal({
						title: "Lo sentimos!",
						text: "IP invalida, lo van hechar si usa esa IP",
						icon: "error",
						button: "volver",
					});
				} else {
					salida = salida + "****Estos comandos se deben correr sobre    ASR (A9KTRIARA1  |  A9KORTEZAL) - CONSULTA TABLA ENRUTAMIENTO ****" + "\n\n";
					salida = salida + "sh route vrf " + " allianz-telephony longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " alllianz-telephony longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " asistemica-telephony longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " ath-telephony longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " avianca-telephony longer-prefixes  " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " call-people-telephony longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " call-people-telephony-med longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " casadebolsa-telephony longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " colaboracion longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " colaboracion-lab longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " coltefinanciera-telephony longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " evt-telephony longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " fidubogota-telephony longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " vrf flar-telephony longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " fuua-telephony longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " homcenter-telephony longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " homecenter-telephony longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " homecenter-telephony1 longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " ip-telephony longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " prever-telephony longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " servpostales-telephony longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " sodimac-telephony longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " vys-telephony longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " pbxadministrada  longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh route vrf " + " colaboracion-extranet   longer-prefixes " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n\n\n\n";

					salida = salida + "****Estos comandos se deben correr sobre      ASR (A9KTRIARA1  |  A9KORTEZAL) - CONSULTA BGP****" + "\n\n";

					salida = salida + "sh bgp vrf " + " allianz-telephony " + ip + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] +"." + "\n";
					salida = salida + "sh bgp vrf " + "  alllianz-telephony " + ip + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + " asistemica-telephony " + ip + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + "  ath-telephony " + ip + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + " avianca-telephony " + ip + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + " call-people-telephony " + ip + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + " call-people-telephony-med " + ip + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + " casadebolsa-telephony " + ip + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + " colaboracion " + ip + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + " colaboracion-lab " + ip + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + " coltefinanciera-telephony " + ip + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + " evt-telephony " + ip + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + " fidubogota-telephony " + ip + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + " flar-telephony " + ip + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + " fuua-telephony " + ip + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + " homcenter-telephony " + ip + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + " homecenter-telephony " + ip + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + " homecenter-telephony1 " + ip + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + " ip-telephony " + ip + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + " prever-telephony " + ip + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + " servpostales-telephony " + ip + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + " sodimac-telephony " + ip + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n";
					salida = salida + "sh bgp vrf " + " vys-telephony " + ip + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." + "\n\n\n\n";

					salida = salida + "****Estos comandos se deben correr sobre     ASR (A9KTRIARA1  |  A9KORTEZAL) ****" + "\n\n";
					salida = salida + "sh bgp" + " ipv4 all " + ip + "/" + mask + " | inc " + mip[0] + "." + mip[1] + "." + mip[2] + "." +"\n";

					$('#resultado').val(salida);
				}
			}
		}
	}








	function cambioForm(){
		var option = $('#service option:selected').val();
		console.log(option);
		if(option == "LoopBack"){
			$('#IPdiv').show(350);
			$('#mascaraLoo').show(350);
			$('#resultadoDIV').show(350);
			$('#IPPdiv').hide(350);
			$('#mascaraPdiv').hide(350);
			$('#resultadoPDIV').hide(350);
			$('#IPWANdiv').hide(350);
			$('#resultadoWANDIV').hide(350);
			$('#mascaraWANdiv').hide(350);
			$('#IPLANC').hide(350);
			$('#mascaraLAN').hide(350);
			$('#resultadolanDIV').hide(350);
		}
		if(option == "WAN"){
			$('#IPdiv').hide(350);
			$('#mascaraLoo').hide(350);
			$('#resultadoDIV').hide(350);
			$('#IPPdiv').hide(350);
			$('#resultadoPDIV').hide(350);
			$('#mascaraPdiv').hide(350);
			$('#IPWANdiv').show(350);
			$('#resultadoWANDIV').show(350);
			$('#mascaraWANdiv').show(350);
			$('#IPLANC').hide(350);
			$('#mascaraLAN').hide(350);
			$('#resultadolanDIV').hide(350);
		}
		if(option == "Publica"){
			$('#IPdiv').hide(350);
			$('#mascaraLoo').hide(350);
			$('#resultadoDIV').hide(350);
			$('#IPPdiv').show(350);
			$('#resultadoPDIV').show(350);
			$('#mascaraPdiv').show(350);
			$('#IPWANdiv').hide(350);
			$('#resultadoWANDIV').hide(350);
			$('#mascaraWANdiv').hide(350);
			$('#IPLANC').hide(350);
			$('#mascaraLAN').hide(350);
			$('#resultadolanDIV').hide(350);
		}
		if (option == "Lan Colaboracion") {
			$('#IPdiv').hide(350);
			$('#mascaraLoo').hide(350);
			$('#resultadoDIV').hide(350);
			$('#IPPdiv').hide(350);
			$('#resultadoPDIV').hide(350);
			$('#mascaraPdiv').hide(350);
			$('#IPWANdiv').hide(350);
			$('#resultadoWANDIV').hide(350);
			$('#mascaraWANdiv').hide(350);
			$('#IPLANC').show(350);
			$('#mascaraLAN').show(350);
			$('#resultadolanDIV').show(350);
			
			
		}
		$('#resultado').val("");

	}

</script>
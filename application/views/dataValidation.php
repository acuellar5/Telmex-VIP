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
                </select>
                <div class="dropDownSelect2"></div>
              </div>
            </div>

            <div class="wrap-input100  bg1 rs1-wrap-input100"  id="IPdiv">
              <span class="label-input100">IP *</span>
              <input class="input100" type="text" name="IP" id="IP" placeholder="Segmento de red a validar" required>
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

            <div class="container-contact100-form-btn" id="resultadoDIV">
              <input type="button" value="Validar IP LoopBack" class="contact100-form-btn" onclick="validarInformacion()">
            </div>
            <div class="container-contact100-form-btn" id="resultadoPDIV" style="display:none;">
              <input type="button" value="Validar IP Pública" class="contact100-form-btn" onclick="validarInformacionPublica()" >
            </div>
            <div class="container-contact100-form-btn" id="resultadoWANDIV" style="display:none;">
              <input type="button" value="Validar WAN" class="contact100-form-btn" onclick="validarInformacionWAN()" >
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
					salida = salida + "****Estos comandos se deben correr sobre  ASR (A9KTRIARA1  |  A9KORTEZAL) - CONSULTA ENRUTAMIENTO ESTÁTICO****" + "\n\n";
					salida = salida + "sh route " + ip + "\n";
					salida = salida + "show route vrf " + "ip-telephony " + ip + "\n";
					salida = salida + "show route vrf " + "pymes-tpbc " + ip + "\n";
					salida = salida + "show route vrf " + "sip-trunk " + ip + "\n";
					salida = salida + "show route vrf " + "core-sip-trunk  " + ip + "\n";
					salida = salida + "show route vrf " + "ims-sbc-core " + ip + "\n";
					salida = salida + "show route vrf " + "ims-sbc-ippbx " + ip + "\n\n\n\n";

					salida = salida + "****Estos comandos se deben correr sobre  ASR (A9KTRIARA1  |  A9KORTEZAL) - CONSULTA ENRUTAMIENTO DINÁMICO BGP****" + "\n\n";
					salida = salida + "sh route " + " longer-prefix " + ip + "/24 | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] +"\n";
					salida = salida + "show route vrf " + " ip-telephony  longer-prefix " + ip + "/24 | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] + "." + "\n";
					salida = salida + "show route vrf " + " pymes-tpbc  longer-prefix " + ip + "/24 | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] + "." + "\n";
					salida = salida + "show route vrf " + " sip-trunk  longer-prefix " + ip + "/24 | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] + "." + "\n";
					salida = salida + "show route vrf " + " core-sip-trunk  longer-prefix " + ip + "/24 | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] + "." + "\n";
					salida = salida + "show route vrf " + " ims-sbc-core  longer-prefix " + ip + "/24 | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] + "." + "\n";
					salida = salida + "show route vrf " + " ims-sbc-ippbx  longer-prefix " + ip + "/24 | inc " + ip.split(".")[0] + "." + ip.split(".")[1] + "." + ip.split(".")[2] + "." + "\n\n\n\n";

					salida = salida + "****Estos comandos se deben correr sobre ASR (A9KTRIARA1  |  A9KORTEZAL)****" + "\n\n";
					salida = salida + "show bgp all all " + ip +"\n";
					salida = salida + "show bgp vrf " + "ip-telephony " + ip +"\n";
					salida = salida + "show bgp vrf " + "pymes-tpbc " + ip +"\n";
					salida = salida + "show bgp vrf " + "sip-trunk " + ip +"\n";
					salida = salida + "show bgp vrf " + "core-sip-trunk " + ip +"\n";
					salida = salida + "show bgp vrf " + "ims-sbc-core " + ip +"\n";
					salida = salida + "show bgp vrf " + "ims-sbc-ippbx " + ip +"\n";

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

	function cambioForm(){
		var option = $('#service option:selected').val();
		console.log(option);
		if(option == "LoopBack"){
			$('#IPdiv').show();
			$('#resultadoDIV').show();
			$('#IPPdiv').hide();
			$('#mascaraPdiv').hide();
			$('#resultadoPDIV').hide();
			$('#IPWANdiv').hide();
			$('#resultadoWANDIV').hide();
			$('#mascaraWANdiv').hide();
		}
		if(option == "WAN"){
			$('#IPdiv').hide();
			$('#resultadoDIV').hide();
			$('#IPPdiv').hide();
			$('#resultadoPDIV').hide();
			$('#mascaraPdiv').hide();
			$('#IPWANdiv').show();
			$('#resultadoWANDIV').show();
			$('#mascaraWANdiv').show();
		}
		if(option == "Publica"){
			$('#IPdiv').hide();
			$('#resultadoDIV').hide();
			$('#IPPdiv').show();
			$('#resultadoPDIV').show();
			$('#mascaraPdiv').show();
			$('#IPWANdiv').hide();
			$('#resultadoWANDIV').hide();
			$('#mascaraWANdiv').hide();
		}
		$('#resultado').val("");

	}

</script>

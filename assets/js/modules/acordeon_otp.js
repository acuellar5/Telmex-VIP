$(function () {
    acord = {
        init: function () {
            acord.events();
            acord.collapse_fun();
            
        },

        //Eventos de la ventana.
        events: function () {
        	
        },

        //funcion para activar funcionalidad de los acordeones
        collapse_fun: function(){            
			var acc = document.getElementsByClassName("accordion");
			var i;
			// Recorro los botones de acordeon y les asigno un evento
			for (i = 0; i < acc.length; i++) {
			    acc[i].addEventListener("click", acord.act_desact);
			}
        },

        // Activa o desactiva la clase active
        act_desact: function(event){
        	// capturo el id del inge q le dieron clic
			var iduser = event.currentTarget.dataset.iduser;            
			this.classList.toggle("active");
			var panelj = $(this).next();			
			var panel  = this.nextElementSibling;
	        if (panel.style.display === "block") {
	            panel.style.display = "none";
	            acord.collapse_fun();
	        } else {
	            if (panel.innerHTML == "") {
	            	acord.nivel_ot_padre(iduser, panelj);
	            }
	            panel.style.display = "block";
	        }
        },

        // llena la seccion para ots padres
        nivel_ot_padre: function(id, panel){
        	// console.log(panel);
        	$.post( baseurl + '/OtPadre/c_get_otp_by_id_user', 
        		{
        			iduser: id
        		}, 
        		function(data) {
        			var ots = JSON.parse(data);
        			$.each(ots, function(i, ot) {
        				 panel.append(`
								<button class='accordion' data-ot='${ot.k_id_ot_padre}'>${ot.k_id_ot_padre}<span class='glyphicon glyphicon-plus rigth'></span></button>
	   							<div class='panel'>algo</div>
        				 	`);
        			});
	            acord.collapse_fun();
    	        }
	        );         
        },


    };
    acord.init();
});
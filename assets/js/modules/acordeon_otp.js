$(function () {
    acord = {
        init: function () {
            acord.events();
            acord.collapse_fun();
            
        },

        //Eventos de la ventana.
        events: function () {
        	$('.accordion').on('click', function(event){
                var contenido = $(this).next();
                var iduser = event.currentTarget.dataset.iduser;
                
                    acord.nivel_ot_padre(iduser, contenido);
                


            });
        },

        //funcion para activar funcionalidad de los acordeones
        collapse_fun: function(){            
			var acc = document.getElementsByClassName("accordion");
			var i;
			for (i = 0; i < acc.length; i++) {
			    acc[i].addEventListener("click", acord.act_desact);
			}
        },

        // Activa o desactiva la clase active
       act_desact: function(event){
            // variable para diferenciar si le dan clic para expandir o para otra accion
            var def = event.target.dataset.iduser;
            var icono = $(this).children('img');
            // var panel  = this.nextElementSibling;
            var panel = $(this).next();
            //  si quiere expandir dif estará definida, sino será undefined
            if (def) {                
                if (panel.css('display') === "block") {
                    $(this).removeClass('active');
                    panel.hide(300);
                    icono.attr('src', baseurl + '/assets/images/plus.png');

                } else {
                    $(this).addClass('active');
                    panel.show(300);
                    icono.attr('src', baseurl + '/assets/images/minus.png');
                }
            }
        },

        // llena la seccion para ots padres
        nivel_ot_padre: function(id, panel){
        	$.post( baseurl + '/OtPadre/c_get_otp_by_id_user', 
        		{
        			iduser: id
        		}, 
        		function(data) {
                    panel.html("");
                    panel.append(`<legend class="sub-title-acord">OTP</legend>`);
        			var ots = JSON.parse(data);
        			$.each(ots, function(i, ot) {
        				 panel.append(`
								<button class='accordion show_type' data-iduser='${id}' data-ot='${ot.k_id_ot_padre}'>${ot.k_id_ot_padre}<img class='rigth' src='${baseurl}/assets/images/plus.png'><a class='rigth btn btn-default' target='_blank' href='${baseurl}/OtHija/detalle/${id}/${ot.k_id_ot_padre}'><span class='glyphicon glyphicon-eye-open' title='ver detalle'></span></a> <a class='rigth btn btn-default' href='${baseurl}/OtHija/exportar/${id}/${ot.k_id_ot_padre}'><span class='glyphicon glyphicon-export' title='exportar a excel'></span></a></button>
	   							<div class='panel'></div>
        				 	`);
        			});
	            acord.collapse_fun();
                acord.panel_types();
    	        }
	        );         
        },

        // funcion para trabajar el panel de tipos
        panel_types: function(){
            $('.show_type').on('click', function(){
                var contenido = $(this).next();
                var iduser    = $(this).data('iduser');
                var otp       = $(this).data('ot');

                 acord.nivel_type_oth(otp, iduser, contenido);
                
            });
        },

        // llena la seccion para tipos de ot hija
        nivel_type_oth: function(otp, iduser, panel){
            $.post( baseurl + '/Type/c_get_types_by_iduser_otp', 
                {
                    iduser: iduser,
                    otp: otp
                }, 
                function(data) {
                    var tipos = JSON.parse(data);
                    panel.html("");
                    panel.append(`<legend class="sub-title-acord">Tipo OTH</legend>`);

                    $.each(tipos, function(i, tipo) {
                         panel.append(`
                                <button class='accordion show_oth' data-idtipo='${tipo.k_id_tipo}' data-iduser='${iduser}' data-ot='${otp}'>${tipo.n_name_tipo}<img class='rigth' src='${baseurl}/assets/images/plus.png'><a class='rigth btn btn-default' target='_blank' href='${baseurl}/OtHija/detalle/${iduser}/${otp}/${tipo.k_id_tipo}'><span class='glyphicon glyphicon-eye-open' title='ver detalle'></span></a> <a class='rigth btn btn-default' href='${baseurl}/OtHija/exportar/${iduser}/${otp}/${tipo.k_id_tipo}'><span class='glyphicon glyphicon-export' title='exportar a excel'></span></a></button>
                                <div class='panel'></div>
                            `);
                    });
                acord.collapse_fun();
                acord.panel_oth();
                }
            );         
        },

        // funcion para trabajar el panel de ot hijas
        panel_oth: function(){
            $('.show_oth').on('click', function(){
                var contenido = $(this).next();
                console.log("contenido", contenido);

                var iduser    = $(this).data('iduser');
                var otp       = $(this).data('ot');
                var idtipo    = $(this).data('idtipo');

                    acord.nivel_oth(idtipo, otp, iduser, contenido);

            });
        },

        // llena la seccion para ots hijas
        nivel_oth: function(idtipo, otp, iduser, panel){
            $.post( baseurl + '/OtHija/c_get_oth_by_iduser_otp_idtipo', 
                {
                    iduser: iduser,
                    otp: otp,
                    idtipo: idtipo
                }, 
                function(data) {
                    var ots = JSON.parse(data);
                    panel.html("");
                    panel.append(`<legend class="sub-title-acord">Numero OTH</legend>`)
                    $.each(ots, function(i, oth) {
                         panel.append(`
                                <div class='bg' data-oth='${oth.id_orden_trabajo_hija}' data-idtipo='${idtipo}' data-iduser='${iduser}' data-ot='${otp}'>${oth.id_orden_trabajo_hija} <span style='margin-left:40%;'>${oth.n_name_estado_ot}</span><a class='rigth btn btn-default' target='_blank' href='${baseurl}/OtHija/detalle/${iduser}/${otp}/${idtipo}/${oth.id_orden_trabajo_hija}'><span class='glyphicon glyphicon-eye-open' title='ver detalle'></span></a> <a class='rigth btn btn-default' href='${baseurl}/OtHija/exportar/${iduser}/${otp}/${idtipo}/${oth.id_orden_trabajo_hija}'><span class='glyphicon glyphicon-export' title='exportar a excel'></span></a></div>
                            `);
                    });
                }
            );         
        },


    };
    acord.init();
});
$(function () {
    acord = {
        init: function () {
            $.post( baseurl + '/OtPadre/in_today_out', 
            function(data) {
                acord.obj = JSON.parse(data);
                acord.events();
                acord.collapse_fun();
                acord.fill_counts(acord.obj);
                acord.grafics(acord.obj.grafics);
            });            
        },

        //Eventos de la ventana.
        events: function () {
            $('.accordion').on('click', function(event){
                var contenido = $(this).next();
                var iduser = event.currentTarget.dataset.iduser;
                
                    acord.nivel_ot_padre(iduser, contenido);
            });
        },

        // pinto los badge del semaforo
        fill_counts: function(obj){
            // lleno los contadores del semaforo ppal
            $('#all_otp').html(obj.cant_otp);
            $('#in_time_otp').html(obj.cant_in);
            $('#out_time_otp').html(obj.cant_out);
            $('#today_otp').html(obj.cant_hoy);
            // Recorro los span ppal de los botones ingenieros y anexo contadores
            $.each(obj.ing, function(cc, item) {
                $(`#${cc}`).append(`
                    <span class='span_all'>${item.all}</span> <span class='span_in_time'>${item.in}</span> <span class='span_out_time'>${item.out}</span> <span class='span_today'>${item.hoy}</span>
                `);
                // añado la clase del color que corresponda al boton del ingeniero
                var btn_ing = $(`#${cc}`).parent('button');
                btn_ing.addClass(item.color);
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
            var valores = acord.obj.ing[id];
            console.log(acord.obj);
           

            // deber.sort()
            var color = "";
            panel.html("");
            panel.append(`<legend class="sub-title-acord">OTP</legend>`);
			// var ots = JSON.parse(data);
			$.each(valores, function(i, ot) {

                if (ot.time == 1) {
                    color = 'btn_red';
                } else if (ot.time == 0) {
                    color = 'btn_orange'; 
                } else {
                    color = 'btn_green';
                }



                if (i != 'all' && i != 'color' && i != 'hoy' && i != 'in' && i != 'out') {
    				panel.append(`
    						<button class='accordion show_type ${color}' data-iduser='${id}' data-ot='${i}'>${i}<span style='margin-left:40%;'>${ot.cliente}</span><img class='rigth' src='${baseurl}/assets/images/plus.png'><a class='rigth fontsize10' target='_blank' href='${baseurl}/OtHija/detalle/${id}/${i}'><span class='glyphicon glyphicon-eye-open' title='ver detalle'></span></a> <a class='rigth fontsize10' href='${baseurl}/OtHija/exportar/${id}/${i}'><span class='glyphicon glyphicon-export' title='exportar a excel'></span></a></button>
    							<div class='panel'></div>
    				 	`);
                }
			});
        acord.collapse_fun();
        acord.panel_types();
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
                    var general = JSON.parse(data);

                    var color = "";
                    panel.html("");
                    panel.append(`<legend class="sub-title-acord">Tipo OTH</legend>`);

                    for (var i = 0; i < general.indices.length; i++) {
                        
                        if (general.tipos[general.indices[i]].tiempo == 1) {
                            color = 'btn_red';
                        } else if (general.tipos[general.indices[i]].tiempo == 0) {
                            color = 'btn_orange'; 
                        } else {
                            color = 'btn_green';
                        }
                        panel.append(`
                                <button class='accordion show_oth ${color}' data-idtipo='${general.tipos[general.indices[i]].k_id_tipo}' data-iduser='${iduser}' data-ot='${otp}'>${general.tipos[general.indices[i]].name}<img class='rigth' src='${baseurl}/assets/images/plus.png'><a class='rigth fontsize10' target='_blank' href='${baseurl}/OtHija/detalle/${iduser}/${otp}/${general.tipos[general.indices[i]].k_id_tipo}'><span class='glyphicon glyphicon-eye-open' title='ver detalle'></span></a> <a class='rigth fontsize10' href='${baseurl}/OtHija/exportar/${iduser}/${otp}/${general.tipos[general.indices[i]].k_id_tipo}'><span class='glyphicon glyphicon-export' title='exportar a excel'></span></a></button>
                                <div class='panel'></div>
                            `);
                    }

                acord.collapse_fun();
                acord.panel_oth();
                }
            );         
        },

        // funcion para trabajar el panel de ot hijas
        panel_oth: function(){
            $('.show_oth').on('click', function(){
                var contenido = $(this).next();

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
                    var ots   = JSON.parse(data);
                    var color = "";
                    var dias;
                    var fecha_entrega;
                    
                    panel.html("");
                    panel.append(`<legend class="sub-title-acord">Numero OTH</legend>`);
                    $.each(ots, function(i, oth) {
                        color = "";
                        dias = "";
                        fecha_entrega = "";
                        if (oth.n_name_estado_ot != 'Cancelada' &&  oth.n_name_estado_ot != 'Cerrada' && oth.n_name_estado_ot != '3- Terminada') {   
                            if (oth.tiempo > 1) {
                                color = 'btn_red';
                            } else if (oth.tiempo == 0) {
                                color = 'btn_orange'; 
                            } else {
                                color = 'btn_green';
                            }
                            dias = (oth.tiempo == -999) ? 'siempre en tiempos' : oth.tiempo;
                            fecha_entrega = (oth.tiempo == -999) ? "" : acord.sumar_dias(formato_fecha, oth.tiempo);

                        }

                         panel.append(`
                                <div class='bg ${color}' data-oth='${oth.id_orden_trabajo_hija}' data-idtipo='${idtipo}' data-iduser='${iduser}' data-ot='${otp}'>${oth.id_orden_trabajo_hija} <span style='margin-left:40%;'>${oth.n_name_estado_ot}</span><a class='rigth fontsize10' target='_blank' href='${baseurl}/OtHija/detalle/${iduser}/${otp}/${idtipo}/${oth.id_orden_trabajo_hija}'><span class='glyphicon glyphicon-eye-open' title='ver detalle'></span></a> <a class='rigth fontsize10' href='${baseurl}/OtHija/exportar/${iduser}/${otp}/${idtipo}/${oth.id_orden_trabajo_hija}'><span class='glyphicon glyphicon-export' title='exportar a excel'></span></a> <span class='rigth'> ${dias}</span><span class='rigth'> ${fecha_entrega}</span></div>
                            `);
                    });
                }
            );         
        },

        // sumar dias a una fecha
        sumar_dias: function(fecha, dias){
            var f = new Date(fecha);
            f.setDate(f.getDate() - dias);

             return acord.formato_aaaa_mm_dd(f);
        },

        //**********************************/////////////////////////////*******************************************************
        formato_aaaa_mm_dd: function(date){
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('-');            
        },

        // comienzo a pintar las graficas
        grafics: function(params){

            var ctx = $("#graficsTotal");

            // Chart.defaults.global.defaultFontFamily = "Lato";
            // Chart.defaults.global.defaultFontSize = 12;
            Chart.defaults.global.defaultFontColor = '#000';

            var myChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: params.g_inges, //horizontal
                    datasets: [
                        {
                            //Total
                            label: 'Total',
                            fill: true,
                            lineTension: 0.4,
                            backgroundColor: "rgba(125, 125, 125, 0.1)",
                            borderColor: "rgba(125, 125, 125, 1)",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            pointBorderColor: "rgba(125, 125, 125, 1)",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 8,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(125, 125, 125, 1)",
                            pointHoverBorderColor: "rgba(220, 220, 220, 1)",
                            pointHoverBorderWidth: 5,
                            pointRadius: 1,
                            pointHitRadius: 10,
                            data: params.g_all, //vertical
                            // type: 'line',
                            spanGaps: false,
                            borderWidth: 2,
                        },
                        {
                            //Fuera de Tiempos
                            label: 'Fuera de Tiempos',
                            fill: true,
                            lineTension: 0.1,
                            backgroundColor: "rgba(255, 0, 0, 0.2)",
                            borderColor: "rgba(255, 0, 0, 1)",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            pointBorderColor: "rgba(255, 0, 0, 1)",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 8,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(255, 0, 0, 1)",
                            pointHoverBorderColor: "rgba(220, 220, 220, 1)",
                            pointHoverBorderWidth: 5,
                            pointRadius: 1,
                            pointHitRadius: 10,
                            data: params.g_out, //vertical
                            spanGaps: false,
                            borderWidth: 2,
                        },
                        {
                            //Hoy
                            label: 'Hoy',
                            fill: true,
                            lineTension: 0.1,
                            backgroundColor: "rgba(255, 255, 0, 1)",
                            borderColor: "rgba(255, 153, 0, 1)",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            pointBorderColor: "rgba(255, 153, 0, 1)",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 8,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(255, 255, 0, 1)",
                            pointHoverBorderColor: "rgba(220, 220, 220, 1)",
                            pointHoverBorderWidth: 5,
                            pointRadius: 1,
                            pointHitRadius: 10,
                            data: params.g_hoy, //vertical
                            spanGaps: false,
                            borderWidth: 2,
                        }, {
                            //en tiempos
                            label: 'en tiempos',
                            fill: true,
                            lineTension: 0.1,
                            backgroundColor: "rgba(0, 255, 0, 0.8)",
                            borderColor: "rgba(0, 255, 0, 1)",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            pointBorderColor: "rgba(0, 255, 0, 1)",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 8,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(0, 255, 0, 1)",
                            pointHoverBorderColor: "rgba(220, 220, 220, 1)",
                            pointHoverBorderWidth: 5,
                            pointRadius: 1,
                            pointHitRadius: 10,
                            data: params.g_in, //vertical
                            spanGaps: false,
                            borderWidth: 2,
                        }
                    ]
                },
                options: {
                    // onClick: vista.clickEventGrafics,
                    title: {
                    display: true,
                    text: 'Cantidad OTP Ingeniero'
                  },

                    scales: {
                       xAxes: [{
                              gridLines: {
                                // display: false,
                                color: '#ccc'
                              },
                            display: true,
                            // stacked: true,
                            scaleLabel: {
                              display: true,
                              labelString: 'CANTIDAD DE ORDENES'
                            },


                            ticks: {
                                // min: 60 // Edit the value according to what you need
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                // display: false,
                                color: '#ccc'
                              },
                            display: true,
                            stacked: true,
                            scaleLabel: {
                              display: true,
                              labelString: 'NOMBRE INGENIERO'
                            },
                            ticks: {
                              // beginAtZero: true,
                            }
                        }]
                    }
                }
            });





        },


    };
    acord.init();
});

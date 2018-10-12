$(function () {
    efectividad = {
        init: function () {
            efectividad.events();
            efectividad.get_data_efectividad();
        },

        //Eventos de la ventana.
        events: function () {
        
        },


        //vgh
        get_data_efectividad: function(){
            $.post(baseurl + '/Graphics/get_data_grafics', {
            	// fecha: fecha
            }, function(data) {
            	const obj = JSON.parse(data);
            	console.log("obj", obj);
            	efectividad.printGraphicTorta1(obj);
            });
        },

        //
        printGraphicTorta1: function(data){
            var oilCanvas = document.getElementById("myChart");

			Chart.defaults.global.defaultFontFamily = "Lato";
			Chart.defaults.global.defaultFontSize = 18;

			var oilData = {
			    labels: data.estados,
			    datasets: [
			        {
			            data: data.cantidades,
			            backgroundColor: [
			                "#FF6384",
			                "#63FF84",
			                "#84FF63",
			                "#8463FF",
			                "#6384FF"
			            ]
			        }]
			};

			var pieChart = new Chart(oilCanvas, {
			  type: 'pie',
			  data: oilData,
			    options: {
			    	animation: {
			        	duration: 1500,
			        	easing: 'easeOutBounce',

			        },
			        
			    }
			});
        },


    };
    efectividad.init();
});
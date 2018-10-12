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

			Chart.defaults.global.defaultFontFamily = "sans-serif";
			Chart.defaults.global.defaultFontSize = 16;
			Chart.defaults.global.defaultFontColor = 'black';

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
			    	// title: {
			     //        display: true,
			     //        text: 'Custom Chart Title'
			     //    },
			    	animation: {
			        	duration: 1500,
			        	easing: 'easeOutBounce',

			        	onComplete: function () {
						      var ctx = this.chart.ctx;

						      this.data.datasets.forEach(function (dataset) {

						        for (var i = 0; i < dataset.data.length; i++) {
						          var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
						              total = dataset._meta[Object.keys(dataset._meta)[0]].total,
						              mid_radius = model.innerRadius + (model.outerRadius - model.innerRadius)/2,
						              start_angle = model.startAngle,
						              end_angle = model.endAngle,
						              mid_angle = start_angle + (end_angle - start_angle)/2;

						          var x = mid_radius * Math.cos(mid_angle);
						          var y = mid_radius * Math.sin(mid_angle);

						          ctx.fillStyle = '#fff';
						          if (i == 3){ // Darker text color for lighter background
						            ctx.fillStyle = '#080808';
						          }

						          var val = dataset.data[i];
						          var percent = String(Math.round(val/total*100)) + "%";

						          if(val != 0) {
						            ctx.fillText(dataset.data[i], model.x + x, model.y + y);
						            // Display percent in another line, line break doesn't work for fillText
						            ctx.fillText(percent, model.x + x, model.y + y + 15);
						          }
						        }
						      });               
						    }

			        },
			        
			    }
			});
        },


    };
    efectividad.init();
});



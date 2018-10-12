$(function () {
    efectividad = {
        init: function () {
            efectividad.events();
            efectividad.get_data_efectividad_torta_1();
            efectividad.get_data_barras_1();

            efectividad.get_data_barras_2();
            efectividad.get_data_efectividad_torta_3();
            efectividad.get_data_barras_3();
            efectividad.get_data_barras_4();
        },

        colores: ['#f44336', '#9c27b0', '#3f51b5', '#2196f3', '#4caf50', '#ffeb3b', '#ff9800', '#795548', '#9e9e9e', '#607d8b', '#0027ff', '#00ffba', '#b2ff00', '#404040', '#ffc107', '#8bc34a', '#673ab7', '#e91e63'],

        //Eventos de la ventana.
        events: function () {

        },

        //vgh
        get_data_efectividad_torta_1: function () {
            $.post(baseurl + '/Graphics/get_data_grafics', {
                // fecha: fecha
            }, function (data) {
                const obj = JSON.parse(data);
                efectividad.printGraphicTorta1(obj);
            });
        },

        //
        printGraphicTorta1: function (data) {
            var oilCanvas = document.getElementById("torta_1");

            Chart.defaults.global.defaultFontFamily = "sans-serif";
            Chart.defaults.global.defaultFontSize = 16;
            Chart.defaults.global.defaultFontColor = 'black';

            var oilData = {
                labels: data.nombres,
                datasets: [
                    {
                        data: data.cantidades,
                        backgroundColor: [
                            '#f44336', '#9c27b0', '#3f51b5', '#2196f3', '#4caf50', '#ffeb3b', '#ff9800'
                        ],

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
                                            mid_radius = model.innerRadius + (model.outerRadius - model.innerRadius) / 2,
                                            start_angle = model.startAngle,
                                            end_angle = model.endAngle,
                                            mid_angle = start_angle + (end_angle - start_angle) / 2;

                                    var x = mid_radius * Math.cos(mid_angle);
                                    var y = mid_radius * Math.sin(mid_angle);

                                    ctx.fillStyle = '#fff';
                                    if (i == 3) { // Darker text color for lighter background
                                        ctx.fillStyle = '#080808';
                                    }

                                    var val = dataset.data[i];
                                    var percent = String(Math.round(val / total * 100)) + "%";

                                    if (val != 0) {
                                        ctx.fillText(dataset.data[i], model.x + x, model.y + y);
                                        // Display percent in another line, line break doesn't work for fillText
                                        ctx.fillText(percent, model.x + x, model.y + y + 15);
                                    }
                                }
                            });
                        }

                    },
                    cutoutPercentage: 50,
                    title: {
                        display: true,
                        text: 'EFECTIVIDAD SEMANAL'
                    },
                    tooltips: {
                        backgroundColor: '#000',
                        position: 'average',
                        // callbacks: {
                        //     label: function(tooltipItem, data) {
                        //         var label = data.datasets[tooltipItem.datasetIndex].label || '';

                        //         if (label) {
                        //             label += ': ';
                        //         }
                        //         label += Math.round(tooltipItem.yLabel * 100) / 100;
                        //         return 'label';
                        //     }
                        // }
                    }

                },
            });
        },

        //trae los datos para barras 1
        get_data_barras_1: function () {
            $.post(baseurl + '/Graphics/getDataEfectividadSemanal', {
                // fecha: fecha
            }, function (data) {
                const obj = JSON.parse(data);
                efectividad.printGraphicBars1(obj);
            });
        },

        // retorna los datos para el chart js
        get_datasets: function (data) {
            var response = [];
            console.log(data);
            // for (var i = 0; i < data.length; i++) {
            // 	data[i]
            // }
            let flag = 0;
            $.each(data, function (seccion, cantidades) {
                if (seccion != 'names') {
                    response.push({
                        label: seccion,
                        fill: true,
                        lineTension: 0.1,
                        backgroundColor: efectividad.colores[flag],
                        borderColor: "#333",
                        borderCapStyle: 'butt',
                        borderDash: [],
                        borderDashOffset: 0.0,
                        borderJoinStyle: 'miter',
                        pointHitRadius: 10,
                        data: cantidades, //vertical
                        spanGaps: false,
                        borderWidth: 2,

                    });

                    flag++;
                }


            });

            return response;
        },

        // pinta la grafica de barras 1 (semanal total)
        printGraphicBars1: function (data) {
            const datasets = efectividad.get_datasets(data);
            var ctx = $("#barras_1");
            var myChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: data.names,
                    datasets: datasets,
                },
                options: {
                    // onClick: vista.clickEventGrafics,
                    title: {
                    display: true,
                    text: 'EFECTIVIDAD SEMANAL Estado VOC Principal',
                    fontSize: 18
                  },

                    scales: {
                       xAxes: [{
                              gridLines: {
                                // display: false,
                                color: '#000'
                              },
                            display: true,
                            stacked: true,
                            scaleLabel: {
                              display: true,
                              labelString: 'cantidades Tipo Sede'
                            },

                            }],
                        yAxes: [{
                            gridLines: {
                                // display: false,
                                color: '#000'
                              },
                            display: true,
                            stacked: true,
                            scaleLabel: {
                              display: false,
                              labelString: 'Estado VOC Principal'
                            },
                            ticks: {
                              // beginAtZero: true,
                            }
                        }]
                    }
                }
            });
        },
        
        //
        get_data_barras_2: function () {
            $.post(baseurl + '/Graphics/getDataNoEfectividadSemanal', {
                // fecha: fecha
            }, function (data) {
                const obj = JSON.parse(data);
                efectividad.printGraphicBars2(obj);
            });
        }, 
        // pinta la grafica de barras 2
        printGraphicBars2: function (data) {
            const datasets = efectividad.get_datasets(data);
            var ctx = $("#barras_2");
            var myChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: data.names,
                    datasets: datasets,
                },
                options: {
                    // onClick: vista.clickEventGrafics,
                    title: {
                        display: true,
                        text: 'CAUSALES NO EFECTIFIVAD SEMANAL',
                        fontSize: 18
                    },

                    scales: {
                        xAxes: [{
                                gridLines: {
                                    // display: false,
                                    color: '#000'
                                },
                                display: true,
                                stacked: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Cantidades Tipo Sede'
                                },

                            }],
                        yAxes: [{
                                gridLines: {
                                    // display: false,
                                    color: '#000'
                                },
                                display: true,
                                stacked: true,
                                scaleLabel: {
                                    display: false,
                                    labelString: 'Causas Visita Perdida primario'
                                },
                                ticks: {
                                    // beginAtZero: true,
                                }
                            }]
                    }
                }
            });
        },
        

        get_data_efectividad_torta_3: function(){
            $.post(baseurl + '/Graphics/get_data_grafics_torta_3', {
            	// fecha: fecha
            }, function(data) {
            	const obj = JSON.parse(data);
            	efectividad.printGraphicTorta3(obj);
            });
        },

        //
        printGraphicTorta3: function(data){
            var oilCanvas = document.getElementById("torta_3");

			Chart.defaults.global.defaultFontFamily = "sans-serif";
			Chart.defaults.global.defaultFontSize = 16;
			Chart.defaults.global.defaultFontColor = 'black';

			var oilData = {
			    labels: data.nombres,
			    datasets: [
			        {
			            data: data.cantidades,
			            backgroundColor: [
			               '#f44336','#9c27b0','#3f51b5','#2196f3','#4caf50','#ffeb3b','#ff9800','#795548','#9e9e9e','#607d8b','#0027ff','#00ffba','#b2ff00','#404040','#ffc107','#8bc34a','#673ab7','#e91e63'
			            ],
			            
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
			        cutoutPercentage: 50,
			        title: {
			            display: true,
			            text: 'EFECTIVIDAD GENERAL'
			        },
			        tooltips: {
			        	backgroundColor: '#000',
			        	position: 'average',
			            // callbacks: {
			            //     label: function(tooltipItem, data) {
			            //         var label = data.datasets[tooltipItem.datasetIndex].label || '';

			            //         if (label) {
			            //             label += ': ';
			            //         }
			            //         label += Math.round(tooltipItem.yLabel * 100) / 100;
			            //         return 'label';
			            //     }
			            // }
			        }

			    },
			});
        },

        //trae los datos para barras 1
        get_data_barras_3: function(){
            $.post(baseurl + '/Graphics/getDataEfectividadSemanal_barras3', {
            	// fecha: fecha
            }, function(data) {
            	const obj = JSON.parse(data);
            	efectividad.printGraphicBars3(obj);
            });
        },



        // pinta la grafica de barras 1 (semanal total)
        printGraphicBars3: function(data){
        	const datasets = efectividad.get_datasets(data);
            var ctx = $("#barras_3");
            var myChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: data.names,
                    datasets: datasets,    
                },
                options: {
                    // onClick: vista.clickEventGrafics,
                    title: {
                    display: true,
                    text: 'EFECTIVIDAD GENERAL Estado VOC Principal',
                    fontSize: 18
                  },

                    scales: {
                       xAxes: [{
                              gridLines: {
                                // display: false,
                                color: '#000'
                              },
                            display: true,
                            stacked: true,
                            scaleLabel: {
                              display: true,
                              labelString: 'cantidades Tipo Sede'
                            },

                        }],
                        yAxes: [{
                            gridLines: {
                                // display: false,
                                color: '#000'
                              },
                            display: true,
                            stacked: true,
                            scaleLabel: {
                              display: false,
                              labelString: 'Estado VOC Principal'
                            },
                            ticks: {
                              // beginAtZero: true,
                            }
                        }]
                    }
                }
            });
        },
//
        get_data_barras_4: function () {
            $.post(baseurl + '/Graphics/getDataNoEfectividad', {
                // fecha: fecha
            }, function (data) {
                const obj = JSON.parse(data);
                efectividad.printGraphicBars4(obj);
            });
        }, 
        // pinta la grafica de barras 2
        printGraphicBars4: function (data) {
            const datasets = efectividad.get_datasets(data);
            var ctx = $("#barras_4");
            var myChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: data.names,
                    datasets: datasets,
                },
                options: {
                    // onClick: vista.clickEventGrafics,
                    title: {
                        display: true,
                        text: 'CAUSALES NO EFECTIFIVAD TOTAL',
                        fontSize: 18
                    },

                    scales: {
                        xAxes: [{
                                gridLines: {
                                    // display: false,
                                    color: '#000'
                                },
                                display: true,
                                stacked: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Cantidades Tipo Sede'
                                },

                            }],
                        yAxes: [{
                                gridLines: {
                                    // display: false,
                                    color: '#000'
                                },
                                display: true,
                                stacked: true,
                                scaleLabel: {
                                    display: false,
                                    labelString: 'Causas Visita Perdida primario'
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
    efectividad.init();
});


000

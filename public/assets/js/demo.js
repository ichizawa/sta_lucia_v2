"use strict";


// window.addEventListener('load', function(event) {
//   $("body").append(modalShowcase);

//   const myModal = new bootstrap.Modal("#modalShowcase");
//   myModal.show();
// });

// Cicle Chart

$.getScript(
    'https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js',
    function () {
        particlesJS('particles-js', {
            particles: {
                number: {
                    value: 100,
                    density: {
                        enable: true,
                        value_area: 500,
                    },
                },
                color: {
                    value: '#8c825b',
                },
                shape: {
                    type: 'circle',
                    stroke: {
                        width: 0,
                        color: '#000000',
                    },
                    polygon: {
                        nb_sides: 5,
                    },
                    image: {
                        width: 100,
                        height: 100,
                    },
                },
                opacity: {
                    value: 0.5,
                    random: false,
                    anim: {
                        enable: false,
                        speed: 1,
                        opacity_min: 0.1,
                        sync: false,
                    },
                },
                size: {
                    value: 5,
                    random: true,
                    anim: {
                        enable: false,
                        speed: 40,
                        size_min: 0.1,
                        sync: false,
                    },
                },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#000',
                    opacity: 0.5,
                    width: 1,
                },
                move: {
                    enable: true,
                    speed: 6,
                    direction: 'none',
                    random: false,
                    straight: false,
                    out_mode: 'out',
                    attract: {
                        enable: false,
                        rotateX: 600,
                        rotateY: 1200,
                    },
                },
            },
            interactivity: {
                detect_on: 'canvas',
                events: {
                    onhover: {
                        enable: true,
                        mode: 'repulse',
                    },
                    onclick: {
                        enable: false,
                        mode: 'push',
                    },
                    resize: true,
                },
                modes: {
                    grab: {
                        distance: 400,
                        line_linked: {
                            opacity: 1,
                        },
                    },
                    bubble: {
                        distance: 400,
                        size: 40,
                        duration: 2,
                        opacity: 8,
                        speed: 3,
                    },
                    repulse: {
                        distance: 100,
                    },
                    push: {
                        particles_nb: 4,
                    },
                    remove: {
                        particles_nb: 2,
                    },
                },
            },
            retina_detect: true,
            config_demo: {
                hide_card: false,
                background_color: '#b61924',
                background_image: '',
                background_position: '50% 50%',
                background_repeat: 'no-repeat',
                background_size: 'cover',
            },
        });
    },
);


Circles.create({
	id:           'task-complete',
	radius:       50,
	value:        80,
	maxValue:     100,
	width:        5,
	text:         function(value){return value + '%';},
	colors:       ['#36a3f7', '#fff'],
	duration:     400,
	wrpClass:     'circles-wrp',
	textClass:    'circles-text',
	styleWrapper: true,
	styleText:    true
})

//Notify
// $.notify({
// 	icon: 'icon-bell',
// 	title: 'Kaiadmin',
// 	message: 'Premium Bootstrap 5 Admin Dashboard',
// },{
// 	type: 'secondary',
// 	placement: {
// 		from: "bottom",
// 		align: "right"
// 	},
// 	time: 1000,
// });

// Jsvectormap
var world_map = new jsVectorMap({
	selector: "#world-map",
	map: "world",
	zoomOnScroll: false,
	regionStyle: {
		hover: {
			fill: '#435ebe'
		}
	},
	markers: [
		{
			name: 'Indonesia',
			coords: [-6.229728, 106.6894311],
			style: {
				fill: '#435ebe'
			}
		},
		{
			name: 'United States',
			coords: [38.8936708, -77.1546604],
			style: {
				fill: '#28ab55'
			}
		},
		{
			name: 'Russia',
			coords: [55.5807481, 36.825129],
			style: {
				fill: '#f3616d'
			}
		},
		{
			name: 'China',
			coords: [39.9385466, 116.1172735]
		},
		{
			name: 'United Kingdom',
			coords: [51.5285582, -0.2416812]
		},
		{
			name: 'India',
			coords: [26.8851417, 75.6504721]
		},
		{
			name: 'Australia',
			coords: [-35.2813046, 149.124822]
		},
		{
			name: 'Brazil',
			coords: [-22.9140693, -43.5860681]
		},
		{
			name: 'Egypt',
			coords: [26.834955, 26.3823725]
		},
	],
	onRegionTooltipShow(event, tooltip) {
		tooltip.css({ backgroundColor: '#435ebe' })
	}
});

//Chart

var ctx = document.getElementById('statisticsChart').getContext('2d');

var statisticsChart = new Chart(ctx, {
	type: 'line',
	data: {
		labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
		datasets: [ {
			label: "Ground Floor",
			borderColor: '#f3545d',
			pointBackgroundColor: 'rgba(243, 84, 93, 0.6)',
			pointRadius: 0,
			backgroundColor: 'rgba(243, 84, 93, 0.4)',
			legendColor: '#f3545d',
			fill: true,
			borderWidth: 2,
			data: [154, 184, 175, 203, 210, 231, 240, 278, 252, 312, 320, 374]
		}, {
			label: "First Floor",
			borderColor: '#fdaf4b',
			pointBackgroundColor: 'rgba(253, 175, 75, 0.6)',
			pointRadius: 0,
			backgroundColor: 'rgba(253, 175, 75, 0.4)',
			legendColor: '#fdaf4b',
			fill: true,
			borderWidth: 2,
			data: [256, 230, 245, 287, 240, 250, 230, 295, 331, 431, 456, 521]
		}, {
			label: "Second Floor",
			borderColor: '#177dff',
			pointBackgroundColor: 'rgba(23, 125, 255, 0.6)',
			pointRadius: 0,
			backgroundColor: 'rgba(23, 125, 255, 0.4)',
			legendColor: '#177dff',
			fill: true,
			borderWidth: 2,
			data: [542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 900]
		}]
	},
	options : {
		responsive: true, 
		maintainAspectRatio: false,
		legend: {
			display: false
		},
		tooltips: {
			bodySpacing: 4,
			mode:"nearest",
			intersect: 0,
			position:"nearest",
			xPadding:10,
			yPadding:10,
			caretPadding:10
		},
		layout:{
			padding:{left:5,right:5,top:15,bottom:15}
		},
		scales: {
			yAxes: [{
				ticks: {
					fontStyle: "500",
					beginAtZero: false,
					maxTicksLimit: 5,
					padding: 10
				},
				gridLines: {
					drawTicks: false,
					display: false
				}
			}],
			xAxes: [{
				gridLines: {
					zeroLineColor: "transparent"
				},
				ticks: {
					padding: 10,
					fontStyle: "500"
				}
			}]
		}, 
		legendCallback: function(chart) { 
			var text = []; 
			text.push('<ul class="' + chart.id + '-legend html-legend">'); 
			for (var i = 0; i < chart.data.datasets.length; i++) { 
				text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor + '"></span>'); 
				if (chart.data.datasets[i].label) { 
					text.push(chart.data.datasets[i].label); 
				} 
				text.push('</li>'); 
			} 
			text.push('</ul>'); 
			return text.join(''); 
		}  
	}
});

var myLegendContainer = document.getElementById("myChartLegend");

// generate HTML legend
myLegendContainer.innerHTML = statisticsChart.generateLegend();

// bind onClick event to all LI-tags of the legend
var legendItems = myLegendContainer.getElementsByTagName('li');
for (var i = 0; i < legendItems.length; i += 1) {
	legendItems[i].addEventListener("click", legendClickCallback, false);
}

var dailySalesChart = document.getElementById('dailySalesChart').getContext('2d');

var myDailySalesChart = new Chart(dailySalesChart, {
	type: 'line',
	data: {
		labels:["January",
		"February",
		"March",
		"April",
		"May",
		"June",
		"July",
		"August",
		"September"],
		datasets:[ {
			label: "Sales Analytics", fill: !0, backgroundColor: "rgba(255,255,255,0.2)", borderColor: "#fff", borderCapStyle: "butt", borderDash: [], borderDashOffset: 0, pointBorderColor: "#fff", pointBackgroundColor: "#fff", pointBorderWidth: 1, pointHoverRadius: 5, pointHoverBackgroundColor: "#fff", pointHoverBorderColor: "#fff", pointHoverBorderWidth: 1, pointRadius: 1, pointHitRadius: 5, data: [65, 59, 80, 81, 56, 55, 40, 35, 30]
		}]
	},
	options : {
		maintainAspectRatio:!1, legend: {
			display: !1
		}
		, animation: {
			easing: "easeInOutBack"
		}
		, scales: {
			yAxes:[ {
				display:!1, ticks: {
					fontColor: "rgba(0,0,0,0.5)", fontStyle: "bold", beginAtZero: !0, maxTicksLimit: 10, padding: 0
				}
				, gridLines: {
					drawTicks: !1, display: !1
				}
			}
			], xAxes:[ {
				display:!1, gridLines: {
					zeroLineColor: "transparent"
				}
				, ticks: {
					padding: -20, fontColor: "rgba(255,255,255,0.2)", fontStyle: "bold"
				}
			}
			]
		}
	}
});

$("#activeUsersChart").sparkline([112,109,120,107,110,85,87,90,102,109,120,99,110,85,87,94], {
	type: 'bar',
	height: '100',
	barWidth: 9,
	barSpacing: 10,
	barColor: 'rgba(255,255,255,.3)'
});

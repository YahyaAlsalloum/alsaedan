// // Set new default font family and font color to mimic Bootstrap's default styling
// Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
// Chart.defaults.global.defaultFontColor = '#858796';

// function number_format(number, decimals, dec_point, thousands_sep) {
//   // *     example: number_format(1234.56, 2, ',', ' ');
//   // *     return: '1 234,56'
//   number = (number + '').replace(',', '').replace(' ', '');
//   var n = !isFinite(+number) ? 0 : +number,
//     prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
//     sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
//     dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
//     s = '',
//     toFixedFix = function (n, prec) {
//       var k = Math.pow(10, prec);
//       return '' + Math.round(n * k) / k;
//     };
//   // Fix for IE parseFloat(0.55).toFixed(0) = 0;
//   s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
//   if (s[0].length > 3) {
//     s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
//   }
//   if ((s[1] || '').length < prec) {
//     s[1] = s[1] || '';
//     s[1] += new Array(prec - s[1].length + 1).join('0');
//   }
//   return s.join(dec);
// }


// var monthes = JSON.parse(document.getElementById("monthes").innerHTML);
// // Requests Chart 
// var ctx = document.getElementById("myAreaChart");
// var requestByDate = JSON.parse(document.getElementById("requestByDate").innerHTML);
// var myLineChart = new Chart(ctx, {
//   type: 'line',
//   data: {

//     labels: monthes,
//     datasets: [{
//       label: "Requests",
//       lineTension: 0.3,
//       backgroundColor: "#a3916152",
//       borderColor: "#a39161",
//       pointRadius: 3,
//       pointBackgroundColor: "#a39161",
//       pointBorderColor: "#a39161",
//       pointHoverRadius: 3,
//       pointHoverBackgroundColor: "#311858",
//       pointHoverBorderColor: "#311858",
//       pointHitRadius: 10,
//       pointBorderWidth: 2,
//       data: requestByDate,
//     }],
//   },
//   options: {
//     maintainAspectRatio: false,
//     layout: {
//       padding: {
//         left: 10,
//         right: 25,
//         top: 25,
//         bottom: 0
//       }
//     },
//     scales: {
//       xAxes: [{
//         time: {
//           unit: 'date'
//         },
//         gridLines: {
//           display: false,
//           drawBorder: false
//         },
//         ticks: {
//           maxTicksLimit: 12
//         }
//       }],
//       yAxes: [{
//         ticks: {
//           maxTicksLimit: 5,
//           padding: 10,
//           // Include a dollar sign in the ticks
//           callback: function (value, index, values) {
//             // return '$' + number_format(index);
//             return number_format(value);
//           }
//         },
//         gridLines: {
//           color: "rgb(234, 236, 244)",
//           zeroLineColor: "rgb(234, 236, 244)",
//           drawBorder: false,
//           borderDash: [2],
//           zeroLineBorderDash: [2]
//         }
//       }],
//     },
//     legend: {
//       display: false
//     },
//     tooltips: {
//       backgroundColor: "rgb(255,255,255)",
//       bodyFontColor: "#858796",
//       titleMarginBottom: 10,
//       titleFontColor: '#6e707e',
//       titleFontSize: 14,
//       borderColor: '#dddfeb',
//       borderWidth: 1,
//       xPadding: 15,
//       yPadding: 15,
//       displayColors: false,
//       intersect: false,
//       mode: 'index',
//       caretPadding: 10,
//       callbacks: {
//         label: function (tooltipItem, chart) {
//           var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
//           return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
//         }
//       }
//     }
//   }
// });
// // Joining Chart 
// var ctxJ = document.getElementById("myAreaChartJoin");
// var joiningByDate = JSON.parse(document.getElementById("joiningByDate").innerHTML);
// var myLineChartj = new Chart(ctxJ, {
//   type: 'line',
//   data: {

//     labels: monthes,
//     datasets: [{
//       label: "Joining Business",
//       lineTension: 0.3,
//       backgroundColor: "#a3916152",
//       borderColor: "#a39161",
//       pointRadius: 3,
//       pointBackgroundColor: "#a39161",
//       pointBorderColor: "#a39161",
//       pointHoverRadius: 3,
//       pointHoverBackgroundColor: "#311858",
//       pointHoverBorderColor: "#311858",
//       pointHitRadius: 10,
//       pointBorderWidth: 2,
//       data: joiningByDate,
//     }],
//   },
//   options: {
//     maintainAspectRatio: false,
//     layout: {
//       padding: {
//         left: 10,
//         right: 25,
//         top: 25,
//         bottom: 0
//       }
//     },
//     scales: {
//       xAxes: [{
//         time: {
//           unit: 'date'
//         },
//         gridLines: {
//           display: false,
//           drawBorder: false
//         },
//         ticks: {
//           maxTicksLimit: 12
//         }
//       }],
//       yAxes: [{
//         ticks: {
//           maxTicksLimit: 5,
//           padding: 10,
//           // Include a dollar sign in the ticks
//           callback: function (value, index, values) {
//             // return '$' + number_format(index);
//             return number_format(value);
//           }
//         },
//         gridLines: {
//           color: "rgb(234, 236, 244)",
//           zeroLineColor: "rgb(234, 236, 244)",
//           drawBorder: false,
//           borderDash: [2],
//           zeroLineBorderDash: [2]
//         }
//       }],
//     },
//     legend: {
//       display: false
//     },
//     tooltips: {
//       backgroundColor: "rgb(255,255,255)",
//       bodyFontColor: "#858796",
//       titleMarginBottom: 10,
//       titleFontColor: '#6e707e',
//       titleFontSize: 14,
//       borderColor: '#dddfeb',
//       borderWidth: 1,
//       xPadding: 15,
//       yPadding: 15,
//       displayColors: false,
//       intersect: false,
//       mode: 'index',
//       caretPadding: 10,
//       callbacks: {
//         label: function (tooltipItem, chart) {
//           var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
//           return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
//         }
//       }
//     }
//   }
// });
// // Packages Chart 
// var ctxP = document.getElementById("myAreaChartPackage");
// var packagesByDate = JSON.parse(document.getElementById("packagesByDate").innerHTML);
// var myLineChartj = new Chart(ctxP, {
//   type: 'line',
//   data: {

//     labels: monthes,
//     datasets: [{
//       label: "Packages",
//       lineTension: 0.3,
//       backgroundColor: "#a3916152",
//       borderColor: "#a39161",
//       pointRadius: 3,
//       pointBackgroundColor: "#a39161",
//       pointBorderColor: "#a39161",
//       pointHoverRadius: 3,
//       pointHoverBackgroundColor: "#311858",
//       pointHoverBorderColor: "#311858",
//       pointHitRadius: 10,
//       pointBorderWidth: 2,
//       data: packagesByDate,
//     }],
//   },
//   options: {
//     maintainAspectRatio: false,
//     layout: {
//       padding: {
//         left: 10,
//         right: 25,
//         top: 25,
//         bottom: 0
//       }
//     },
//     scales: {
//       xAxes: [{
//         time: {
//           unit: 'date'
//         },
//         gridLines: {
//           display: false,
//           drawBorder: false
//         },
//         ticks: {
//           maxTicksLimit: 12
//         }
//       }],
//       yAxes: [{
//         ticks: {
//           maxTicksLimit: 5,
//           padding: 10,
//           // Include a dollar sign in the ticks
//           callback: function (value, index, values) {
//             // return '$' + number_format(index);
//             return number_format(value);
//           }
//         },
//         gridLines: {
//           color: "rgb(234, 236, 244)",
//           zeroLineColor: "rgb(234, 236, 244)",
//           drawBorder: false,
//           borderDash: [2],
//           zeroLineBorderDash: [2]
//         }
//       }],
//     },
//     legend: {
//       display: false
//     },
//     tooltips: {
//       backgroundColor: "rgb(255,255,255)",
//       bodyFontColor: "#858796",
//       titleMarginBottom: 10,
//       titleFontColor: '#6e707e',
//       titleFontSize: 14,
//       borderColor: '#dddfeb',
//       borderWidth: 1,
//       xPadding: 15,
//       yPadding: 15,
//       displayColors: false,
//       intersect: false,
//       mode: 'index',
//       caretPadding: 10,
//       callbacks: {
//         label: function (tooltipItem, chart) {
//           var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
//           return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
//         }
//       }
//     }
//   }
// });

// // Events Chart 
// var ctxE = document.getElementById("myAreaChartEvent");
// var eventsByDate = JSON.parse(document.getElementById("eventsByDate").innerHTML);
// var myLineChartj = new Chart(ctxE, {
//   type: 'line',
//   data: {

//     labels: monthes,
//     datasets: [{
//       label: "Events",
//       lineTension: 0.3,
//       backgroundColor: "#a3916152",
//       borderColor: "#a39161",
//       pointRadius: 3,
//       pointBackgroundColor: "#a39161",
//       pointBorderColor: "#a39161",
//       pointHoverRadius: 3,
//       pointHoverBackgroundColor: "#311858",
//       pointHoverBorderColor: "#311858",
//       pointHitRadius: 10,
//       pointBorderWidth: 2,
//       data: eventsByDate,
//     }],
//   },
//   options: {
//     maintainAspectRatio: false,
//     layout: {
//       padding: {
//         left: 10,
//         right: 25,
//         top: 25,
//         bottom: 0
//       }
//     },
//     scales: {
//       xAxes: [{
//         time: {
//           unit: 'date'
//         },
//         gridLines: {
//           display: false,
//           drawBorder: false
//         },
//         ticks: {
//           maxTicksLimit: 12
//         }
//       }],
//       yAxes: [{
//         ticks: {
//           maxTicksLimit: 5,
//           padding: 10,
//           // Include a dollar sign in the ticks
//           callback: function (value, index, values) {
//             // return '$' + number_format(index);
//             return number_format(value);
//           }
//         },
//         gridLines: {
//           color: "rgb(234, 236, 244)",
//           zeroLineColor: "rgb(234, 236, 244)",
//           drawBorder: false,
//           borderDash: [2],
//           zeroLineBorderDash: [2]
//         }
//       }],
//     },
//     legend: {
//       display: false
//     },
//     tooltips: {
//       backgroundColor: "rgb(255,255,255)",
//       bodyFontColor: "#858796",
//       titleMarginBottom: 10,
//       titleFontColor: '#6e707e',
//       titleFontSize: 14,
//       borderColor: '#dddfeb',
//       borderWidth: 1,
//       xPadding: 15,
//       yPadding: 15,
//       displayColors: false,
//       intersect: false,
//       mode: 'index',
//       caretPadding: 10,
//       callbacks: {
//         label: function (tooltipItem, chart) {
//           var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
//           return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
//         }
//       }
//     }
//   }
// });
// // Users Chart 
// var ctxU = document.getElementById("myAreaChartUser");
// var usersByDate = JSON.parse(document.getElementById("usersByDate").innerHTML);
// var myLineChartj = new Chart(ctxU, {
//   type: 'line',
//   data: {

//     labels: monthes,
//     datasets: [{
//       label: "Users",
//       lineTension: 0.3,
//       backgroundColor: "#a3916152",
//       borderColor: "#a39161",
//       pointRadius: 3,
//       pointBackgroundColor: "#a39161",
//       pointBorderColor: "#a39161",
//       pointHoverRadius: 3,
//       pointHoverBackgroundColor: "#311858",
//       pointHoverBorderColor: "#311858",
//       pointHitRadius: 10,
//       pointBorderWidth: 2,
//       data: usersByDate,
//     }],
//   },
//   options: {
//     maintainAspectRatio: false,
//     layout: {
//       padding: {
//         left: 10,
//         right: 25,
//         top: 25,
//         bottom: 0
//       }
//     },
//     scales: {
//       xAxes: [{
//         time: {
//           unit: 'date'
//         },
//         gridLines: {
//           display: false,
//           drawBorder: false
//         },
//         ticks: {
//           maxTicksLimit: 12
//         }
//       }],
//       yAxes: [{
//         ticks: {
//           maxTicksLimit: 5,
//           padding: 10,
//           // Include a dollar sign in the ticks
//           callback: function (value, index, values) {
//             // return '$' + number_format(index);
//             return number_format(value);
//           }
//         },
//         gridLines: {
//           color: "rgb(234, 236, 244)",
//           zeroLineColor: "rgb(234, 236, 244)",
//           drawBorder: false,
//           borderDash: [2],
//           zeroLineBorderDash: [2]
//         }
//       }],
//     },
//     legend: {
//       display: false
//     },
//     tooltips: {
//       backgroundColor: "rgb(255,255,255)",
//       bodyFontColor: "#858796",
//       titleMarginBottom: 10,
//       titleFontColor: '#6e707e',
//       titleFontSize: 14,
//       borderColor: '#dddfeb',
//       borderWidth: 1,
//       xPadding: 15,
//       yPadding: 15,
//       displayColors: false,
//       intersect: false,
//       mode: 'index',
//       caretPadding: 10,
//       callbacks: {
//         label: function (tooltipItem, chart) {
//           var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
//           return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
//         }
//       }
//     }
//   }
// });

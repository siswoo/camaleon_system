<!doctype html>
<html>

<head>
	<title>Line Chart</title>
	<script src="../js/jquery-3.5.1.min.js"></script>
	<script src="../js/Chart.js"></script>
</head>

<body>
	<div class="container" style="max-height: 400px; max-width: 800px;">
		<div class="col-12">
			<canvas id="speedCanvas" height="350vw" width="600vw"></canvas>
		</div>
	</div>
</body>
</html>

<script>
/*
var data = {
  labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
  datasets: [{
    label: "",
    backgroundColor: "rgba(255,99,132,0.2)",
    borderColor: "rgba(255,99,132,1)",
    borderWidth: 2,
    hoverBackgroundColor: "rgba(255,99,132,0.4)",
    hoverBorderColor: "rgba(255,99,132,1)",
    data: [65, 59, 20, 81, 56, 55, 40],
  }]
};

var option = {
  responsive: true,
  scales: {
    yAxes: [{
      stacked: true,
      gridLines: {
        display: true,
        color: "rgba(255,99,132,0.2)"
      }
    }],
    xAxes: [{
      gridLines: {
        display: false
      }
    }]
  }
};

Chart.Bar('chart_0', {
  options: option,
  data: data
});
*/

/*
var dataFirst = {
  label: "Car A - Speed (mph)",
  data: [0, 59, 75, 20, 20, 55, 40],
  lineTension: 0.3,
};
   
var dataSecond = {
  label: "Car B - Speed (mph)",
  data: [20, 15, 60, 60, 65, 30, 70],
};
   
var speedData = {
  labels: ["0s", "10s", "20s", "30s", "40s", "50s", "60s"],
  datasets: [dataFirst, dataSecond]
};
 
 
var lineChart = new Chart(speedCanvas, {
  type: 'bar',
  data: speedData
});
*/

var speedData = {
  labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
	datasets: [
		dataFirst = {
			label: "XLove",
			data: [0, 59, 75, 20, 20, 55, 2000],
			lineTension: 0.3,
		},
		dataSecond = {
			label: "Chaturbate",
			data: [0, 59, 75, 20, 20, 55, 40],
			lineTension: 0.3,
		},
	]
};

var lineChart = new Chart(speedCanvas, {
  type: 'bar',
  data: speedData
});

</script>
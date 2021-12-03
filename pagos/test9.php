<!DOCTYPE html>
<html>
<head>
<title>Creating Dynamic Data Graph using PHP and Chart.js</title>
<style type="text/css">
BODY {
    width: 550PX;
}

#chart-container {
    width: 100%;
    height: auto;
}
</style>
<script src="../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../js/popper.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="../js/navbar.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="../js/mdb.js"></script>
<!--<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>-->
<script src="../js/Chart.js"></script>


</head>
<body>
    <div id="chart-container">
        <canvas id="graphCanvas"></canvas>
    </div>

    <button onclick="iniciar();">TEST</button>

    <script>
        /*
        $(document).ready(function () {
            showGraph();
        });
        */

        function iniciar(){
            showGraph();
        }


        function showGraph()
        {
            {
                $.post("test9_1.php",
                function (data)
                {
                    console.log(data);
                    var tokens = [];
                    var dolares = [];
                    var fecha_desde = [];
                    var fecha_hasta = [];
                    var fecha_inicio = [];
                    var moneda = "Dolares";
                    var pagina = "XLove";

                    for (var i in data) {
                        tokens.push(data[i].tokens);
                        dolares.push(data[i].dolares);
                        fecha_desde.push(data[i].fecha_desde);
                        fecha_hasta.push(data[i].fecha_hasta);
                        fecha_inicio.push(data[i].fecha_desde+" | "+data[i].fecha_hasta);
                    }

                    var chartdata = {
                        labels: fecha_inicio,
                        datasets: [
                            {
                                label: pagina,
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: dolares,
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
            }
        }
        </script>

</body>
</html>
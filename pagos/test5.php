<!--
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
-->
<script src="../js/jquery-3.5.1.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
<script src="../js/Chart.js"></script>
<canvas id="myChart" width="400" height="400"></canvas>
<script>
  function grab() {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: "test5_1.json",
        method: "GET",
        dataType: 'JSON',
        success: function(data) {
          resolve(data)
        },
        error: function(error) {
          reject(error);
        }
      })
    })
  }

  $(document).ready(function() {
    grab().then((data) => {
      console.log('Recieved our data', data);
      let regions = [];
      let value = [];

      try {
        data.forEach((item) => {
          regions.push(item.REGION)
          value.push(item.REV_VALUE)
        });

        let chartdata = {
          labels: [...regions],
          datasets: [{
            label: 'Region',
            backgroundColor: 'rgba(200, 200, 200, 0.75)',
            borderColor: 'rgba(200, 200, 200, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: [...value]
          }]
        };

        let ctx = $("#myChart");

        let barGraph = new Chart(ctx, {
          type: 'bar',
          data: chartdata
        });

      } catch (error) {
        console.log('Error parsing JSON data', error)
      }

    }).catch((error) => {
      console.log(error);
    })
  });
</script>



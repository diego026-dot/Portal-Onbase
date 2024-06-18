<?php

$this->dbOnBase=new DatabaseOnBase();

    
$this -> dbOnBase->connect();
       
$sql = "exec [dbo].[OB_WEB_IndicadoresMain2] '" . "1" . "'";
$this->dbOnBase->query($sql);
$resultados = $this->dbOnBase->obtener_registros();
    
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<body>



    <div class="container-fluid h-100">
        <div class="row mt-3 h-25 " >
       
            <div class="col-2 card mx-3 ">
                
            </div>
            <div class="col-2 card mx-3">

            </div>
            <div class="col-2 card mx-3">

            </div>

            <div class="col-2 card mx-3">

            </div>

        </div>
        <?php foreach( $resultados as $row){ ?>
            <?php echo($row)->dump2; ?>
            <?php } ?>

        <div class="row h-25 mt-5">
            <div class="col-4 p-3 card mx-4" style = "background-color: #fff">
                <canvas id="myChart"></canvas>
                
            </div>

            <div class="col-6 p-3 card mx-4" style = "background-color: #fff">
                <canvas id="myChart2"></canvas>
            </div>

         
        </div>

    </div>

    <style>
     
    </style>
    


</html>

<!-- <script >

document.addEventListener('DOMContentLoaded', () => {
  const data = {
      labels: ['Red', 'Blue', 'Yellow'],
      datasets: [{
          label: 'My First Dataset',
          data: [300, 50, 100],
          backgroundColor: [
              'rgb(255, 99, 132)',
              'rgb(54, 162, 235)',
              'rgb(255, 205, 86)'
          ],
          hoverOffset: 4
      }]
  };

  new Chart(
      document.getElementById('myChart'),
      {
          type: 'doughnut',
          data: data
      }
  );
});




document.addEventListener('DOMContentLoaded', () => {
const data = {
  labels: ["1","2","3","4","5","6","7"],
  datasets: [{
    label: 'My First Dataset',
    data: [65, 59, 80, 81, 56, 55, 40],
    backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],
    borderWidth: 1
  }]
};



  new Chart(
      document.getElementById('myChart2'),
      {
        type: 'bar',
        data,
        options: {
            scales: {
                y: {
                beginAtZero: true
                }
            }
        },
      }
  );
});


</script> -->
</body>
</html>
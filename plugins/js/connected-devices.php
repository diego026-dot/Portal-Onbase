<script>
var client = new Keen({
  projectId: "5337e28273f4bb4499000000",
  readKey: "8827959317a6a01257bbadf16c12eff4bc61a170863ca1dadf9b3718f56bece1ced94552c6f6fcda073de70bf860c622ed5937fcca82d57cff93b432803faed4108d2bca310ca9922d5ef6ea9381267a5bd6fd35895caec69a7e414349257ef43a29ebb764677040d4a80853e11b8a3f"
});

var geoProject = new Keen({
  projectId: "53eab6e12481962467000000",
  readKey: "d1b97982ce67ad4b411af30e53dd75be6cf610213c35f3bd3dd2ef62eaeac14632164890413e2cc2df2e489da88e87430af43628b0c9e0b2870d0a70580d5f5fe8d9ba2a6d56f9448a3b6f62a5e6cdd1be435c227253fbe3fab27beb0d14f91b710d9a6e657ecf47775281abc17ec455"
});

Keen.ready(function(){

  // ----------------------------------------
  // Visitors Timeline
  // ----------------------------------------
  var new_users = new Keen.Query("count", {
    eventCollection: "activations",
    interval: "monthly",
    timeframe: "this_year"
  });
  geoProject.draw(new_users, document.getElementById("visitors"), {
    chartType: "areachart",
    title: "Por mes",
    height: 300,
    width: 490,
    chartOptions: {
      legend: { position: "none" },
      chartArea: {
        height: "78%",
        top: "15%",
        left: "8%",
        width: "85%"
      },
      hAxis: { format: 'MMM', maxTextLines: 1 }
    }
  });

  // ----------------------------------------
  // Visitors by Browser Timeline
  // ----------------------------------------
  var browser = new Keen.Query("count", {
    eventCollection: "activations",
    timeframe: "this_year",
    interval: "monthly",
    groupBy: "device_model_name"
  });
  geoProject.draw(browser, document.getElementById("browser"), {
    title: "Visits by Browser",
    height: 300,
    width: 475,
    chartOptions: {
      legend: { position: "none" },
      chartArea: {
        height: "78%",
        top: "15%",
        left: "10%",
        width: "100%"
      }
    }
  });

  // ----------------------------------------
  // Visitors by State
  // ----------------------------------------
  var state = new Keen.Query("count", {
    eventCollection: "visit",
    groupBy: "visitor.geo.province"
  });
  client.draw(state, document.getElementById("geography"), {
    chartType: "columnchart",
    title: "Por Cliente",
    height: 300,
    width: 475,
    chartOptions: {
      legend: { position: "none" },
      chartArea: {
        height: "78%",
        top: "15%",
        left: "12%",
        width: "100%"
      }
    },
    labelMapping: {
      "New Jersey" : "NJ",
      "Virginia" : "VA",
      "California": "CA",
      "Washington": "WA",
      "Utah": "UT",
      "Oregon": "OR",
      "null": "Other"
    }
  });


  // ----------------------------------------
  // Users
  // ----------------------------------------

  var users = new Keen.Query("count_unique", {
    eventCollection: "activations",
    targetProperty: "user.id"
  });

  $(".users").knob({
    'angleArc':250,
    'angleOffset':-125,
    'readOnly':true,
    'min':0,
    'max':<?php echo $_SESSION['TOTAL_ENVIOS'];?>,
    'fgColor': Keen.Dataviz.defaults.colors[0],
    height: 290,
    width: '100%'
  });
  var geoUsers = geoProject.run(users, function(err, res){
   // $(".users").val(res.result).trigger('change');
  });
  
  $(".users1").knob({
    'angleArc':250,
    'angleOffset':-125,
    'readOnly':true,
    'min':0,
    'max':<?php echo $_SESSION['TOTAL_ENTREGAS'];?>,
    'fgColor': Keen.Dataviz.defaults.colors[16],
    height: 290,
    width: '100%'
  });
  var geoUsers = geoProject.run(users, function(err, res){
   // $(".users").val(res.result).trigger('change');
  });


  // ----------------------------------------
  // Errors Detected
  // ----------------------------------------


  var errors = new Keen.Query("count", {
    eventCollection: "user_action",
    filters: [{"property_name":"error_detected","operator":"eq","property_value":true}]
  });

  $(".errors").knob({
    'angleArc':250,
    'angleOffset':-125,
    'readOnly':true,
    'min':0,
    'max': <?php echo $_SESSION['TOTAL_ENVIOS'];?>,
    'fgColor': Keen.Dataviz.defaults.colors[10],
    height: 290,
    width: '100%'
  });
  geoProject.run(errors, function(err, res){
   // $(".errors").val(res.result).trigger('change');
  });
  
  $(".errors1").knob({
    'angleArc':250,
    'angleOffset':-125,
    'readOnly':true,
    'min':0,
    'max': <?php echo $_SESSION['TOTAL_ENTREGAS'];?>,
    'fgColor': Keen.Dataviz.defaults.colors[8],
    height: 290,
    width: '100%'
  });
  geoProject.run(errors, function(err, res){
   // $(".errors").val(res.result).trigger('change');
  });


  // ----------------------------------------
  // Funnel
  // ----------------------------------------
  var funnel = new Keen.Query("funnel", {
    steps: [
      {
         event_collection: "purchases",
         actor_property: "user.id"
      },
      {
        event_collection: "activations",
        actor_property: "user.id"
      },
      {
        event_collection: "status_update",
        actor_property: "user.id"
      }
    ]
  });

 
});

</script>

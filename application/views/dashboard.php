<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8" />
  <title>Administración de Facturas</title>
  <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <? $this->load->view('includes/scr'); ?>

</head>
<body>
<div class="app app-header-fixed ">
  

    <!-- header -->
    <? $this->load->view('includes/headerAdmin'); ?>
    <!-- / header -->


    <!-- aside -->
     <? $this->load->view('includes/aside'); ?>
    <!-- / aside -->


  <!-- content -->
  <div id="content" class="app-content" role="main">
  	<div class="app-content-body ">
	    

<div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="
    app.settings.asideFolded = false; 
    app.settings.asideDock = false;
  ">
  <!-- main -->
  <div class="col">
    <!-- main header titulo -->
    <div class="bg-light lter b-b wrapper-md">
      <div class="row">
        <div class="col-sm-6 col-xs-12">
          <h1 class="m-n font-thin h3 text-black">Administración de facturas</h1>
          <small class="text-muted">Bienvenidos al panel de administración</small>
        </div>
        <div class="col-sm-6 text-right hidden-xs">
          <div class="inline m-r text-left">
            <div class="m-b-xs">1290 <span class="text-muted">items</span></div>
            <div ng-init="d3_1=[ 106,108,110,105,110,109,105,104,107,109,105,100,105,102,101,99,98 ]" 
              ui-jq="sparkline" 
              ui-options="[ 106,108,110,105,110,109,105,104,107,109,105,100,105,102,101,99,98 ], {type:'bar', height:20, barWidth:5, barSpacing:1, barColor:'#dce5ec'}" 
              class="sparkline inline">loading...
            </div>
          </div>
          <div class="inline text-left">
            <div class="m-b-xs">$30,000 <span class="text-muted">revenue</span></div>
            <div ng-init="d3_2=[ 105,102,106,107,105,104,101,99,98,109,105,100,108,110,105,110,109 ]" 
              ui-jq="sparkline" 
              ui-options="[ 105,102,106,107,105,104,101,99,98,109,105,100,108,110,105,110,109 ], {type:'bar', height:20, barWidth:5, barSpacing:1, barColor:'#dce5ec'}" 
              class="sparkline inline">loading...
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / main header -->
    <div class="wrapper-md">
      <!-- stats -->
      <div class="row">
        <div class="col-md-5">
          <div class="row row-sm text-center">
            <div class="col-xs-12 m-b-md">
              <div class="r bg-light dker item hbox no-border">
                <div class="col w-xs v-middle hidden-md">
                  <div ng-init="d3_3=[60,40]" ui-jq="sparkline" ui-options="[60,40], {type:'pie', height:40, sliceColors:['#fad733','#fff']}" class="sparkline inline"></div>
                </div>
                <div class="col dk padder-v r-r">
                  <div class="text-primary-dk font-thin h1"><span>$<?php echo money_format('%i',$totalVentas); ?></span></div>
                  <span class="text-muted text-xs">Ventas del día</span>
                </div>
              </div>
            </div>
            <div class="col-xs-12 m-b-md">
              <div class="r bg-light dker item hbox no-border">
                <div class="col w-xs v-middle hidden-md">
                  <div ng-init="d3_3=[60,40]" ui-jq="sparkline" ui-options="[60,40], {type:'pie', height:40, sliceColors:['#fad733','#fff']}" class="sparkline inline"></div>
                </div>
                <div class="col dk padder-v r-r">
                  <div class="text-primary-dk font-thin h1"><span> <?php echo $masVendido['numPiezasTotal'].' PZAS'; ?></span></div>
                  <span class="text-muted text-xs">Producto mas vendido - <?php echo $masVendido['nombre']; ?></span>
                </div>
              </div>
            </div>
            <div class="col-xs-12 m-b-md">
              <div class="r bg-light dker item hbox no-border">
                <div class="col w-xs v-middle hidden-md">
                  <div ng-init="d3_3=[60,40]" ui-jq="sparkline" ui-options="[60,40], {type:'pie', height:40, sliceColors:['#fad733','#fff']}" class="sparkline inline"></div>
                </div>
                <div class="col dk padder-v r-r">
                  <div class="text-primary-dk font-thin h1"><span> <?php echo $menosVendido['numPiezasTotal'].' PZAS'; ?></span></div>
                  <span class="text-muted text-xs">Producto menos vendido - <?php echo $menosVendido['nombre']; ?></span>
                </div>
              </div>
            </div>
            


          </div>
        </div>
        <div class="col-md-7">
          <div class="panel panel-default">
          <div class="panel-body">
             <div id="canvas-holder" style="width:100%">
                <canvas id="myChart" width="400" height="250"></canvas>
            </div>

            
          </div>
        </div>
        </div>
      </div>
      <!-- / stats -->

    </div>
  </div>
  <!-- / main -->
</div>

<!-- table -->
 <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Producto</th>
            <th>Piezas</th>
            <th style="width:30px;">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          foreach ($totalesProductos as $totProd) {
          ?>
            <tr>
              <td><?php echo $totProd['nombre']; ?></td>
              <td><?php echo $totProd['numPiezasTotal']; ?></td>
              <td><?php echo $totProd['totalDinero']; ?></td>
              <td></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
<!-- termina table -->

	</div>

  </div>
  <!-- /content -->
  
  <!-- footer -->
  <? $this->load->view('includes/footerAdmin'); ?>
  <!-- / footer -->

</div>


<? $this->load->view('includes/scriptAdmin'); ?>
 <script>


    var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
    };
    var randomColorFactor = function() {
        return Math.round(Math.random() * 255);
    };
    var randomColor = function(opacity) {
        return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
    };


      

    window.onload = function() {
        var ctx = document.getElementById("myChart").getContext("2d");

        var data = '<?php echo json_encode($clientes); ?>';

        var pieJson = JSON.parse(data);

        console.log(pieJson);

        var dataValue = [];
        var labelsValue = [];

        for (var i=0; i < pieJson.length; i++){
            console.log(pieJson[i].nombre);

            dataValue.push(pieJson[i].total);
            labelsValue.push(pieJson[i].nombre);
        }

        var config = {
        cutoutPercentage: 50,
        type: 'pie',
        data: {
            datasets: [{
                data: dataValue,
                backgroundColor: [
                    "#F7464A",
                    "#46BFBD",
                    "#FDB45C",
                    "#949FB1",
                    "#4D5360",
                    "#F23e4A",
                    "#46BFBD",
                    "#FFFF5C",
                    "#94BBB1",
                    "#4D55F0",
                ],
            }],
            labels: labelsValue
        },
        options: {
            responsive: true,
            cutoutPercentage: 50,
        },
    };
       
        window.myPie = new Chart(ctx, config);  
    };
  </script>
</body>
</html>

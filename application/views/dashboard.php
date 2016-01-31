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
                  <div class="text-primary-dk font-thin h1"><span>$102,300.50</span></div>
                  <span class="text-muted text-xs">Ventas del día</span>
                </div>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="panel padder-v item">
                <div class="h1 text-info font-thin h1">521</div>
                <span class="text-muted text-xs">Productos vendidos</span>
                <div class="top text-right w-full">
                  <i class="fa fa-caret-down text-warning m-r-sm"></i>
                </div>
              </div>
            </div>
            <div class="col-xs-6">
              <a href class="block panel padder-v bg-primary item">
                <span class="text-white font-thin h1 block">930</span>
                <span class="text-muted text-xs">Uploads</span>
                <span class="bottom text-right w-full">
                  <i class="fa fa-cloud-upload text-muted m-r-sm"></i>
                </span>
              </a>
            </div>
            <div class="col-xs-6">
              <a href class="block panel padder-v bg-info item">
                <span class="text-white font-thin h1 block">432</span>
                <span class="text-muted text-xs">Comments</span>
                <span class="top text-left">
                  <i class="fa fa-caret-up text-warning m-l-sm"></i>
                </span>
              </a>
            </div>
            <div class="col-xs-6">
              <div class="panel padder-v item">
                <div class="font-thin h1">129</div>
                <span class="text-muted text-xs">Feeds</span>
                <div class="bottom text-left">
                  <i class="fa fa-caret-up text-warning m-l-sm"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="panel panel-default">
          <div class="panel-heading font-bold">Ventas por cliente</div>
          <div class="panel-body">
            <div ui-jq="plot" ui-options="
              [ [30, 80],  [20, 40], [30, 30],  [40, 20] ],
              {
                series: { pie: { show: true, innerRadius: 0.5, stroke: { width: 0 }, label: { show: true, threshold: 0.05 } } },
                colors: ['#7266ba','#23b7e5','#27c24c','#fad733','#f05050'],
                grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#ccc' },   
                tooltip: true,
                tooltipOpts: { content: '%s: %p.0%' }
              }
            " style="height: 240px; padding: 0px; position: relative;">
            <canvas class="flot-base" width="462" height="240" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 462px; height: 240px;"></canvas>
            <canvas class="flot-overlay" width="462" height="240" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 462px; height: 240px;"></canvas>
            <span class="pieLabel" id="pieLabel0" style="position: absolute; top: 94px; left: 315.5px;"><div style="font-size:x-small;text-align:center;padding:2px;color:rgb(114,102,186);">undefined<br>30%</div></span>
            <span class="pieLabel" id="pieLabel1" style="position: absolute; top: 196px; left: 150.5px;"><div style="font-size:x-small;text-align:center;padding:2px;color:rgb(35,183,229);">undefined<br>30%</div></span>
            <span class="pieLabel" id="pieLabel2" style="position: absolute; top: 74px; left: 103.5px;"><div style="font-size:x-small;text-align:center;padding:2px;color:rgb(39,194,76);">undefined<br>30%</div></span><span class="pieLabel" id="pieLabel3" style="position: absolute; top: 3px; left: 168.5px;"><div style="font-size:x-small;text-align:center;padding:2px;color:rgb(250,215,51);">undefined<br>10%</div></span></div>
          </div>
        </div>
        </div>
      </div>
      <!-- / stats -->

    </div>
  </div>
  <!-- / main -->
  <!-- right col -->

  <!-- / right col -->
</div>



	</div>
  </div>
  <!-- /content -->
  
  <!-- footer -->
  <? $this->load->view('includes/footerAdmin'); ?>
  <!-- / footer -->



</div>


<? $this->load->view('includes/scriptAdmin'); ?>
</body>
</html>

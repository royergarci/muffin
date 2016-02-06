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
    
    <!--datatable -->
    	 <!-- content -->
  <div id="content" class="app-content" role="main">
  	<div class="app-content-body ">
	    

<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Datatable</h1>
</div>
<div class="wrapper-md">
  <div class="panel panel-default">
    <div class="panel-heading">
      DataTables
    </div>
    <div class="table-responsive">
      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
				<thead>
					<tr>
						<th width="5%">folio</th>
						<th width="15%">serie</th>
						<th width="15%">id</th>
						<th width="15%">total</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="5" class="dataTables_empty">Cargando datos del servidor</td>
					</tr>
				</tbody>
				</table>
    </div>
  </div>
</div>



	</div>
  </div>
  <!-- /content -->
    <!-- termina datatable -->

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
 <script>
	var urlBase = '<?php echo base_url();?>';

$(document).ready(function() {
		console.log(urlBase);
			    $('#example').dataTable({
			    	"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
			        "bProcessing": true,
			        "sAjaxSource": urlBase+'index.php/factura/datatable',
			        "sPaginationType": "full_numbers"
				});
				
	/*	$('#btnInsertar').click(function (){
			window.location = urlBase+'index.php/usuarios/action/INSERT'
		});
		
		$("input[name='nick']").change(function (){
			revisaExisteNick($(this).val());
		});*/
		
});
  </script>
</body>
</html>

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
          <h1 class="m-n font-thin h3 text-black">Carga de facturas</h1>
          <small class="text-muted">Cargar archivos xml o zip de facturas</small>
        </div>
      </div>
    </div>
    <!-- / main header -->
    <!-- form -->
    <div class="panel panel-default">
    <div class="panel-heading font-bold">
      Carga de facturas
    </div>
    <div class="panel-body">
      <?php echo form_open_multipart('factura/do_upload');?>
       
         <div class="form-group">
          <label class="col-sm-2 control-label">Seleccione archivo</label>
          <div class="col-sm-10">
            <input ui-jq="filestyle" type="file" name="userfile" class="btn" />          
          </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <div class="col-sm-4 col-sm-offset-2">
            <button type="submit" class="btn btn-default">Regresar</button>
            <button type="submit" class="btn btn-primary">Cargar Archivo</button>
          </div>
        </div>
      </form>
    </div>
  </div>

    <!-- termina form -->


  </div>
  <!-- / main -->

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

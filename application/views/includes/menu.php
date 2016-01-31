<?php 
$menuActive = "";
$archivo_actual = current_url();
if (strpos($archivo_actual,"index.php/usuarios") !== FALSE ||
	strpos($archivo_actual,"index.php/empresas") !== FALSE ||
	strpos($archivo_actual,"index.php/puestosTrabajo")  !== FALSE ){
		$menuActive = "ADMINISTRACION";
	}
else {
	$menuActive = "HOME";
}
?>
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="<?php echo base_url();?>">Empresa</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li <?php if ($menuActive == "HOME") echo 'class="active"'; ?>>
                <a href="<?php echo base_url();?>">Home</a>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Facturas<b class="caret"></b></a>
                <ul class="dropdown-menu">
                	<li><a href="<?php echo base_url();?>index.php/factura" >Carga de facturas</a></li>
                </ul>
              </li>
               <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Reportes<b class="caret"></b></a>
                <ul class="dropdown-menu">
                	<li><a href="<?php echo base_url();?>index.php/reportes" >Ventas por día</a></li>
                </ul>
              </li>
              <li class="">
                <?php echo anchor('login/logout', 'Salir'); ?>
              </li>
            </ul>
            <ul class="nav pull-right">
              <li>
                <a href="*">Bienvenido(a) <b>Roger</b></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
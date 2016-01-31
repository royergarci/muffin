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
          <a class="brand">Prodeho</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li <?php if ($menuActive == "HOME") echo 'class="active"'; ?>>
                <a href="<?php echo base_url();?>index.php/clientes/indexClientes">Home</a>
              </li>
              <li>
                <a href="<?php echo base_url();?>index.php/ayuda">Ayuda</a>
              </li>
              <li class="">
                <?php echo anchor('login/logoutClientes', 'Salir'); ?>
              </li>
            </ul>
            <ul class="nav pull-right">
              <li>
                <a>Bienvenido(a) <b><?php echo $this->session->userdata('username'); ?></b></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
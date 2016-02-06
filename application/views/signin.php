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
  

<div class="container w-xxl w-auto-xs" ng-controller="SigninFormController" ng-init="app.settings.container = false;">
  <a href class="navbar-brand block m-t">Facturas</a>
  <div class="m-b-lg">
    <div class="wrapper text-center">
      <strong>Por favor ingresa tus datos</strong>
    </div>
     <?php echo form_open_multipart('welcome/loggin');?>
      <div class="text-danger wrapper text-center" ng-show="authError">
          
      </div>
      <div class="list-group list-group-sm">
        <div class="list-group-item">
          <input type="email" placeholder="Email" class="form-control no-border" ng-model="user.email" required>
        </div>
        <div class="list-group-item">
           <input type="password" placeholder="Password" class="form-control no-border" ng-model="user.password" required>
        </div>
      </div>
      <button type="submit" class="btn btn-lg btn-primary btn-block" ng-click="login()" ng-disabled='form.$invalid'>Log in</button>
      <div class="text-center m-t m-b"><a ui-sref="access.forgotpwd">Olvidaste tu password?</a></div>
      <div class="line line-dashed"></div>
      <a ui-sref="access.signup" class="btn btn-lg btn-default btn-block">Crear una cuenta</a>
    </form>
  </div>
  <div class="text-center" ng-include="'tpl/blocks/page_footer.html'">
    <p>
  <small class="text-muted">Sistema de administración de Facturas<br>&copy; 2016</small>
</p>
  </div>
</div>


</div>
<? $this->load->view('includes/scriptAdmin'); ?>
</body>
</html>

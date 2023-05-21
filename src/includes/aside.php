<style>
  .logo {
    font-size: 1.4rem;
    padding: 5px 10px 5px 10px;
    border-radius: 10px;
    background-color: #007bff;
    color: #f1faee !important;
    height: fit-content;
  }
  .logo:hover{
    cursor: pointer;
    text-decoration: none;
  }
</style>
<aside class="aside">
  <a href="<?=Router::getRouteURL('administrador/')?>" class="logo mt-3 mb-5">
    <i class="fas fa-code mr-1"></i>
    F I M A K
  </a>
  <a href="<?=Router::getRouteURL('administrador/inventario')?>" class="option-button c-orange <?=($appController->routeConfig['title']=='Inventario')?'option-selected':''?>">
    <i class="fas fa-server mr-2"></i>Productos
  </a>
  <a href="<?=Router::getRouteURL('administrador/lineas')?>" class="option-button c-blue <?=($appController->routeConfig['title']=='Lineas')?'option-selected':''?>">
    <i class="fas fa-code-branch mr-2"></i>Lineas
  </a>
  <a href="<?=Router::getRouteURL('administrador/consultaVentas')?>" class="option-button c-green <?=($appController->routeConfig['title']=='Consultas')?'option-selected':''?>">
    <i class="fas fa-money-bill-wave-alt mr-2"></i>Ventas
  </a>
  <a href="<?=Router::getRouteURL('administrador/respaldo')?>" class="option-button c-pink <?=($appController->routeConfig['title']=='Respaldo')?'option-selected':''?>">
    <i class="fas fa-save mr-2"></i></i>Respaldo
  </a>
  <a href="<?=Router::getRouteURL('administrador/logout')?>" class="option-button c-red">
    <i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión
  </a>
</aside>
<div style="width:15%;"></div>
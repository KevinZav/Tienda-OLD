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
  
  <a href="<?=Router::getRouteURL('cajero/ventas')?>" class="option-button c-green <?=($appController->routeConfig['title']=='Ventas')?'option-selected':''?>">
    <i class="fas fa-money-bill-wave-alt mr-2"></i>Ventas
  </a>
  <a href="<?=Router::getRouteURL('cajero/consultaVentas')?>" class="option-button c-blue <?=($appController->routeConfig['title']=='Consultas')?'option-selected':''?>">
    <i class="fas fa-wallet mr-2"></i></i>Consultas
  </a>
  <a href="<?=Router::getRouteURL('cajero/logout')?>" class="option-button c-red">
    <i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión
  </a>
</aside>
<div style="width:15%;"></div>
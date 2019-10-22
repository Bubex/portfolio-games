<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
          <div class="sidebar-brand-icon rotate-n-15">
               <i class="fas fa-laugh-wink"></i>
          </div>
          <div class="sidebar-brand-text mx-3"><?= APP_NAME ?></div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item active">
          <a class="nav-link" href="dashboard.php">
               <i class="fas fa-fw fa-tachometer-alt"></i>
               <span>Dashboard</span>
          </a>
     </li>

     <? if (in_array('1', $accessAreas)) { ?>

          <!-- Divider -->
          <hr class="sidebar-divider">

          <!-- Heading -->
          <div class="sidebar-heading">
               Gerencial
          </div>

          <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-users"></i>
                    <span>Usuários</span>
               </a>
               <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                         <a class="collapse-item" href="reg_users.php">Cadastrar</a>
                         <a class="collapse-item" href="#">Comissão</a>
                    </div>
               </div>
          </li>

          <!-- Nav Item - Utilities Collapse Menu -->
          <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-truck-moving"></i>
                    <span>Produtos</span>
               </a>
               <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                         <a class="collapse-item" href="#">Cadastrar</a>
                         <a class="collapse-item" href="#">Estoque</a>
                    </div>
               </div>
          </li>

     <? } ?>

     <? if (in_array('2', $accessAreas)) { ?>

          <!-- Divider -->
          <hr class="sidebar-divider">

          <!-- Heading -->
          <div class="sidebar-heading">
               Operacional
          </div>

          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item">
               <a class="nav-link" href="#">
                    &nbsp;<i class="fas fa-clipboard"></i>
                    &nbsp;<span>Pedidos</span>
               </a>
          </li>

          <!-- Nav Item - Charts -->
          <li class="nav-item">
               <a class="nav-link" href="charts.html">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Comissão</span></a>
          </li>

     <? } ?>

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

</ul>
<!-- End of Sidebar -->
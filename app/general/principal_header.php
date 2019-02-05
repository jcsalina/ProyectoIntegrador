


    <header class="main-header">
    <a href="index.html" class="logo">
        <!-- Logo -->
        <span class="logo-mini">
            <!--<b>A</b>H-admin-->
            <!-- <img src="../../assets/dist/img/mini-logo.png" alt=""> -->
        </span>
        <span class="logo-lg">
            <!--<b>Admin</b>H-admin-->
            <!-- <img src="../../assets/dist/img/logo.png" alt=""> -->
        </span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top ">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <!-- Sidebar toggle button-->
            <span class="sr-only">Toggle navigation</span>
            <span class="fa fa-tasks"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Notifications -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="pe-7s-bell"></i>
                        <span class="label label-warning">8</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header"><i class="fa fa-bell"></i> 8 Notifications</li>
                        <li>
                            <ul class="menu">
                                <li>
                                    <a href="#" class="border-gray"><i class="fa fa-inbox"></i> Inbox <span class=" label-success label label-default pull-right">9</span></a>
                                </li>
                                <li>
                                    <a href="#" class="border-gray"><i class="fa fa-cart-plus"></i> New Order <span
                                            class=" label-success label label-default pull-right">3</span> </a>
                                </li>
                                <li>
                                    <a href="#" class="border-gray"><i class="fa fa-money"></i> Payment Failed <span
                                            class="label-success label label-default pull-right">6</span> </a>
                                </li>
                                <li>
                                    <a href="#" class="border-gray"><i class="fa fa-cart-plus"></i> Order Confirmation
                                        <span class="label-success label label-default pull-right">7</span> </a>
                                </li>
                                <li>
                                    <a href="#" class="border-gray"><i class="fa fa-cart-plus"></i> Update system
                                        status <span class=" label-success label label-default pull-right">11</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="border-gray"><i class="fa fa-cart-plus"></i> client update <span
                                            class="label-success label label-default pull-right">12</span> </a>
                                </li>
                                <li>
                                    <a href="#" class="border-gray"><i class="fa fa-cart-plus"></i> shipment cancel
                                        <span class="label-success label label-default pull-right">2</span> </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#"> See all Notifications <i class=" fa fa-arrow-right"></i></a>
                        </li>
                    </ul>
                </li>
                <!-- user -->
                <li class="dropdown dropdown-user admin-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <div class="user-image">
                            <img src="/ProyectoIntegrador/assets/dist/img/avatar4.png" class="img-circle" height="40" width="40" alt="User Image">
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- <li><a href="profile.html"><i class="fa fa-users"></i> Perfil</a></li> -->
                        <!-- <li><a href="#"><i class="fa fa-gear"></i> Configuracion</a></li> -->
                        <li><a href="/ProyectoIntegrador/pdo/procesos/logout.php?tk=<?php echo $_SESSION['token']; ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

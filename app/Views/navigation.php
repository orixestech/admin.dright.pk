<!-- Navigation -->
<style>
    .navigation .navigation-menu-tab ul li a {

        padding: 4px 0 !important;

</style>
<div class="navigation">
    <!-- Logo -->
    <div class="navigation-header">
        <a class="navigation-logo" href=index.html>
            <img class="logo" src="<?= $template ?>logo.png" style="width: 46%;" alt="logo">
        </a>
        <a href="#" class="small-navigation-toggler"></a>
    </div>
    <!-- ./ Logo -->

    <!-- Menu wrapper -->
    <div class="navigation-menu-wrapper">
        <!-- Menu tab -->
        <div class="navigation-menu-tab">
            <ul>
                <li>
                    <a href="<?=$path?>" >
                                <span class="menu-tab-icon">
                                    <i data-feather="pie-chart"></i>
                                </span>
                        <span>Dashboards</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-menu-target="#apps">
                                <span class="menu-tab-icon">
                                    <i data-feather="globe"></i>
                                </span>
                        <span>Support Ticket</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-menu-target="#components">
                                <span class="menu-tab-icon">
                                    <i data-feather="layers"></i>
                                </span>
                        <span>Task System</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-menu-target="#forms">
                                <span class="menu-tab-icon">
                                    <i class="pe-is-w-thermometer-1-f"></i>
                                </span>
                        <span>Health Care</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-menu-target="#plugins">
                                <span class="menu-tab-icon">
                                    <i data-feather="gift"></i>
                                </span>
                        <span>Extended</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-menu-target="#pages">
                                <span class="menu-tab-icon">
                                    <i data-feather="copy"></i>
                                </span>
                        <span>Builder</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-menu-target="#other">
                                <span class="menu-tab-icon">
                                    <i data-feather="arrow-up-right"></i>
                                </span>
                        <span>Pharmacy</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-menu-target="#users">
                                <span class="menu-tab-icon">
                                    <i data-feather="users"></i>
                                </span>
                        <span>User</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                                <span class="menu-tab-icon">
                                    <i data-feather="clock"></i>
                                </span>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- ./ Menu tab -->

        <!-- Menu body -->
        <div class="navigation-menu-body">
<!--            <ul id="dashboards">-->
<!--                <li class="navigation-divider">Dashboards</li>-->
<!---->
<!--                <li>-->
<!--                    <a class="active"-->
<!--                       href="--><?php //= $path ?><!--">-->
<!--                        <span class="nav-link-icon" data-feather="bar-chart-2"></span>-->
<!--                        <span>Analytics</span>-->
<!--                        <                        <span class="badge badge-success">New</span>-->
<!--                    </a>-->
<!--                </li>-->
<!---->
<!--            </ul>-->
            <ul id="apps">
                <li class="navigation-divider">Support Ticket</li>
                <li>
                    <a href="<?= $path ?>support-ticket/dashboard">
                                <span class="nav-link-icon">
                                    <i data-feather="pie-chart"></i>
                                </span>
                        <span>Dashboard</span>
                    </a>

                </li>
                <li>
                    <a href="todo-list.html">
                        <span class="nav-link-icon" data-feather="check-circle"></span>
                        <span>All Ticket</span>
                        <span class="badge badge-warning small-badge">2</span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?= $path ?>support-ticket/add">Add</a>
                        </li>
                        <li>
                            <a href="<?= $path ?>support-ticket">All </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?= $path ?>support-ticket/pending">
                        <span class="nav-link-icon" data-feather="file"></span>
                        <span>Pending</span>
                    </a>
                </li>
            </ul>
            <ul id="components">
                <li class="navigation-divider">Task System</li>

                <li>
                    <a href="<?= $path ?>task/dashboard">
                                <span class="nav-link-icon">
                                    <i data-feather="pie-chart"></i>
                                </span>
                        <span>Dashboard</span>
                    </a>

                </li>
                <li>
                    <a href="<?= $path ?>task/">
                                <span class="nav-link-icon">
                                    <i data-feather="aperture"></i>
                                </span>
                        <span>My Task</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $path ?>task/assigned_task">
                                <span class="nav-link-icon">
                                    <i data-feather="anchor"></i>
                                </span>
                        <span>Assigned Task</span>
                    </a>
                </li>
            </ul>
            <ul id="forms">
                <li class="navigation-divider">Health Care</li>
                <li>
                    <a href="<?= $path ?>health-care/dashboard">
                                <span class="nav-link-icon">
                                    <i data-feather="pie-chart"></i>
                                </span>
                        <span>Dashboard</span>
                    </a>

                </li>
                <li>
                    <a href="#">
                                                <span class="nav-link-icon">
                                                    <i data-feather="layers"></i>
                                                </span>
                        <span>Diet Categories</span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?= $path ?>health-care/fruit">Fruit</a></li>
                        <li>
                            <a href="<?= $path ?>health-care/vegetable">Vegetable</a></li>
                        <li>
                            <a href="<?= $path ?>health-care/miscellaneous">Miscellaneous</a></li>
                        <li>
<!--                            <a href="dropdown.html">Dropdown</a></li>-->
<!--                        <li>-->
<!--                            <a href="list-group.html">List Group</a></li>-->
<!--                        <li>-->
<!--                            <a href="pagination.html">Pagination</a></li>-->

                    </ul>
                </li>
                <li>
                    <a href="#">
                                                <span class="nav-link-icon">
                                                    <i data-feather="book"></i>
                                                </span>
                        <span>Branches</span>
                    </a>
                    <ul>

                        <li>
                            <a href="typography.html">Typography</a></li>
                        <li>
                            <a href="media-object.html">Media Object</a>
                        </li>
                        <li>
                            <a href="progress.html">Progress</a></li>
                        <li>
                            <a href="modal.html">Modal</a></li>
                        <li>
                            <a href="spinners.html">Spinners</a></li>
                        <li>
                            <a href="navs.html">Navs</a></li>
                        <li>
                            <a href="tab.html">Tab</a></li>
                        <li>
                            <a href="tooltip.html">Tooltip</a></li>
                        <li>
                            <a href="popovers.html">Popovers</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                                                <span class="nav-link-icon">
                                                    <i data-feather="disc"></i>
                                                </span>
                        <span>RCC</span>
                    </a>
                    <ul>
                        <li>
                            <a href="spinners.html">Spinners</a></li>
                        <li>
                            <a href="navs.html">Navs</a></li>
                        <li>
                            <a href="tab.html">Tab</a></li>
                        <li>
                            <a href="tooltip.html">Tooltip</a></li>
                        <li>
                            <a href="popovers.html">Popovers</a></li>
                    </ul>
                </li>
            </ul>
            <ul id="plugins">
                <li class="navigation-divider">Extended</li>
                <li>
                    <a href="<?= $path ?>">
                                <span class="nav-link-icon">
                                    <i data-feather="pie-chart"></i>
                                </span>
                        <span>Dashboard</span>
                    </a>

                </li>
                <li>
                    <a href="sweet-alert.html">
                        <span class="nav-link-icon" data-feather="alert-triangle"></span>
                        <span>Database Compare</span>
                    </a>
                </li>
                <li>
                    <a href="lightbox.html">
                        <span class="nav-link-icon" data-feather="crop"></span>
                        <span>Profiles</span>
                    </a>
                </li>
                <li>
                    <a href="toast.html">
                        <span class="nav-link-icon" data-feather="clipboard"></span>
                        <span>Default Configuration</span>
                    </a>
                </li>
                <li>
                    <a href="tour.html">
                        <span class="nav-link-icon" data-feather="sliders"></span>
                        <span>Default Lookups</span>
                    </a>
                </li>
            </ul>
            <ul id="pages">
                <li class="navigation-divider">Builder</li>
                <li>
                    <a href="<?= $path ?>builder/dashboard">
                                <span class="nav-link-icon">
                                    <i data-feather="pie-chart"></i>
                                </span>
                        <span>Dashboard</span>
                    </a>

                </li>
                <li>
                    <a href="<?= $path ?>builder/">
                        <span class="nav-link-icon" data-feather="hash"></span>
                        <span>Doctors</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $path ?>builder/hospital">
                        <span class="nav-link-icon" data-feather="search"></span>
                        <span>Hospital</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $path ?>builder/images">
                        <span class="nav-link-icon" data-feather="layout"></span>
                        <span>Images</span>

                    </a>
                </li>
                <li>
                    <a href="<?= $path ?>builder/banners" target="_blank">
                        <span class="nav-link-icon" data-feather="frown"></span>
                        <span>Banners</span>
                    </a>
                </li>
            </ul>
            <ul id="other">
                <li class="navigation-divider">Pharmacy</li>
                <li>
                    <a href="<?= $path ?>pharmacy/dashboard">
                                <span class="nav-link-icon">
                                    <i data-feather="pie-chart"></i>
                                </span>
                        <span>Dashboard</span>
                    </a>

                </li>
                <li>
                    <a href="#">
                        <span class="nav-link-icon" data-feather="activity"></span>
                        <span>Medicine</span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?= $path ?>medicine/add">Add</a>
                        </li>
                        <li>
                            <a href="<?= $path ?>medicine/">Listing</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <span class="nav-link-icon" data-feather="tool"></span>
                        <span>Therapy</span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?= $path ?>therapy/add">Add</a>
                        </li>
                        <li>
                            <a href="<?= $path ?>therapy/">Listing</a>
                        </li>
                    </ul>
            </ul>
            <ul id="users">
                <li class="navigation-divider">Users</li>
                <li>
                    <a href="<?= $path ?>users/dashboard">
                                <span class="nav-link-icon">
                                    <i data-feather="pie-chart"></i>
                                </span>
                        <span>Dashboard</span>
                    </a>

                </li>
                <li>
                    <a href="#">
                        <span class="nav-link-icon" data-feather="users"></span>
                        <span>User</span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?= $path ?>users/add">Add</a>
                        </li>
                        <li>
                            <a href="<?= $path ?>users">All Users</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?= $path ?>users/access-level">
                                <span class="nav-link-icon">
                                    <i data-feather="mail"></i>
                                </span>
                        <span>Access Level</span>
                    </a>

                </li>
                <li>
                    <a href="<?= $path ?>">
                                <span class="nav-link-icon">
                                    <i data-feather="mail"></i>
                                </span>
                        <span>Admin Activites</span>
                    </a>

                </li>
                <li>
                    <a href="<?= $path ?>">
                                <span class="nav-link-icon">
                                    <i data-feather="mail"></i>
                                </span>
                        <span>Admin Approvals</span>
                    </a>

                </li>

            </ul>
        </div>
        <!-- ./ Menu body -->
    </div>
    <!-- ./ Menu wrapper -->
</div>
<!-- ./ Navigation -->

<!-- Navigation -->
<style>
    .navigation .navigation-menu-tab ul li a {
        padding: 4px 0 !important;
    }
</style>
<div class="navigation">
    <!-- Logo -->
    <div class="navigation-header">
        <a class="navigation-logo" href='<?= $path ?>' style="padding: 0 20px;">
            <img class="logo" src="<?= $template ?>logo.png" style="height: 70px;" alt="logo">
        </a>
        <!-- <a href="#" class="small-navigation-toggler"></a> -->
    </div>
    <!-- ./ Logo -->

    <!-- Menu wrapper -->
    <div class="navigation-menu-wrapper">
        <!-- Menu tab -->
        <div class="navigation-menu-tab">
            <ul>
                <li>
                    <a href="" data-menu-target="#dashboards" <?= ($segment_a == 'dashboards' ? 'class="active"' : '') ?>>
                        <span class="menu-tab-icon">
                            <i data-feather="pie-chart"></i>
                        </span>
                        <span>Dashboards</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-menu-target="#pages" <?= ($segment_a == 'builder' ? 'class="active"' : '') ?>>
                        <span class="menu-tab-icon">
                            <i data-feather="copy"></i>
                        </span>
                        <span>Builder</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-menu-target="#forms" <?= ($segment_a == 'diet' ? 'class="active"' : '') ?>>
                        <span class="menu-tab-icon">
                            <i class="pe-is-w-thermometer-1-f"></i>
                        </span>
                        <span>Health Care</span>
                    </a>
                </li>
                <li>
                    <a href=""
                        data-menu-target="#clinta_members" <?= ($segment_a == 'clinta_members' ? 'class="active"' : '') ?>>
                        <span class="menu-tab-icon">
                            <i data-feather="users"></i>
                        </span>
                        <span>Clinta Members</span>
                    </a>
                </li>
                <li>
                    <a href=""
                        data-menu-target="#customers" <?= ($segment_a == 'customers' ? 'class="active"' : '') ?>>
                        <span class="menu-tab-icon">
                            <i data-feather="users"></i>
                        </span>
                        <span>Customers</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-menu-target="#plugins" <?= ($segment_a == 'extended' ? 'class="active"' : '') ?>>
                        <span class="menu-tab-icon">
                            <i data-feather="gift"></i>
                        </span>
                        <span>Extended</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        data-menu-target="#investigation" <?= ($segment_a == 'investigation' ? 'class="active"' : '') ?>>
                        <span class="menu-tab-icon">
                            <i data-feather="layers"></i>
                        </span>
                        <span>Investigation</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-menu-target="#other" <?= ($segment_a == 'medicine' ? 'class="active"' : '') ?>>
                        <span class="menu-tab-icon">
                            <i data-feather="arrow-up-right"></i>
                        </span>
                        <span>Pharmacy</span>
                    </a>
                </li>
                <li>
                    <a href="" data-menu-target="#diseases" <?= ($segment_a == 'diseases' ? 'class="active"' : '') ?>>
                        <span class="menu-tab-icon">
                            <i data-feather="users"></i>
                        </span>
                        <span>Diseases</span>
                    </a>
                </li>
                <li>
                    <a href=""
                        data-menu-target="#laboratories" <?= ($segment_a == 'laboratories' ? 'class="active"' : '') ?>>
                        <span class="menu-tab-icon">
                            <i data-feather="users"></i>
                        </span>
                        <span>Laboratories</span>
                    </a>
                </li>
                <li>
                    <a href=""
                        data-menu-target="#investigation" <?= ($segment_a == 'investigation' ? 'class="active"' : '') ?>>
                        <span class="menu-tab-icon">
                            <i data-feather="users"></i>
                        </span>
                        <span>Investigation</span>
                    </a>
                </li>
                <li>
                    <a href=""
                        data-menu-target="#laboratories" <?= ($segment_a == 'specialities' ? 'class="active"' : '') ?>>
                        <span class="menu-tab-icon">
                            <i data-feather="users"></i>
                        </span>
                        <span>Specialities</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        data-menu-target="#apps" <?= ($segment_a == 'support-ticket' ? 'class="active"' : '') ?>>
                        <span class="menu-tab-icon">
                            <i data-feather="globe"></i>
                        </span>
                        <span>Support Ticket</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-menu-target="#users" <?= ($segment_a == 'users' ? 'class="active"' : '') ?>>
                        <span class="menu-tab-icon">
                            <i data-feather="users"></i>
                        </span>
                        <span>User</span>
                    </a>
                </li>
                <li>
                    <a href="" data-menu-target="#lookups" <?= ($segment_a == 'lookups' ? 'class="active"' : '') ?>>
                        <span class="menu-tab-icon">
                            <i data-feather="users"></i>
                        </span>
                        <span>Lookups</span>
                    </a>
                </li>
                <li>
                    <a href=""
                        data-menu-target="#document" <?= ($segment_a == 'document' ? 'class="active"' : '') ?>>
                        <span class="menu-tab-icon">
                            <i data-feather="users"></i>
                        </span>
                        <span>Documentations</span>
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
            <ul id="lookups">
                <li class="navigation-divider">Lookups</li>
                <li>
                    <a href="<?= $path ?>lookups/dashboard">
                        <span class="nav-link-icon">
                            <i data-feather="pie-chart"></i>
                        </span>
                        <span>Dashboard</span>
                    </a>

                </li>
                <li>
                    <a href="<?= $path ?>lookups/">
                        <span class="nav-link-icon" data-feather="check-circle"></span>
                        <span>Lookups</span>
                    </a>
                </li>
            </ul>
            <ul id="customers">
                <li class="navigation-divider">Customers</li>
                <li>
                    <a href="<?= $path ?>customers/dashboard">
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
                        <span>Customers</span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?= $path ?>customers/">All</a>
                        </li>
                        <li>
                            <a href="<?= $path ?>customers/add">Add</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul id="dashboards">
                <li class="navigation-divider">Dashboards</li>
                <li>
                    <a href="<?= $path ?>">
                        <span class="nav-link-icon">
                            <i data-feather="pie-chart"></i>
                        </span>
                        <span>Dashboard</span>
                    </a>

                </li>
                <li>
                    <a href="<?= $path ?>support-ticket/dashboard">
                        <span class="nav-link-icon">
                            <i data-feather="layers"></i>
                        </span>
                        <span>HealthCare Dashbaord</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $path ?>investigation/dashboard">
                        <span class="nav-link-icon">
                            <i data-feather="layers"></i>
                        </span>
                        <span>Investigation Dashbaord</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $path ?>pharmacy/dashboard">
                        <span class="nav-link-icon">
                            <i data-feather="layers"></i>
                        </span>
                        <span>Pharmacy Dashbaord</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $path ?>users/dashboard">
                        <span class="nav-link-icon">
                            <i data-feather="layers"></i>
                        </span>
                        <span>Users Dashbaord</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $path ?>support-ticket/dashboard">
                        <span class="nav-link-icon">
                            <i data-feather="layers"></i>
                        </span>
                        <span>HealthCare Dashbaord</span>
                    </a>
                </li>
            </ul>
            <ul id="clinta_members">
                <li class="navigation-divider">Customers</li>
                <li>
                    <a href="<?= $path ?>customers/dashboard">
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
                        <span>Customers</span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?= $path ?>customers/">All</a>
                        </li>
                        <li>
                            <a href="<?= $path ?>customers/add">Add</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul id="diseases">
                <li class="navigation-divider">Diseases</li>
                <li>
                    <a href="<?= $path ?>customers/dashboard">
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
                        <span>Diseases</span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?= $path ?>customers/">All</a>
                        </li>
                        <li>
                            <a href="<?= $path ?>customers/add">Add</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul id="document">
                <li class="navigation-divider">Documentations</li>
                <li>
                    <a href="<?= $path ?>document/dashboard">
                        <span class="nav-link-icon">
                            <i data-feather="pie-chart"></i>
                        </span>
                        <span>Dashboard</span>
                    </a>

                </li>
                <li>
                    <a href="<?= $path ?>document/">
                        <span class="nav-link-icon">
                            <i data-feather="layers"></i>
                        </span>
                        <span>Diet Plan</span>
                    </a>

                </li>
                <li>
                    <a href="<?= $path ?>document/">
                        <span class="nav-link-icon">
                            <i data-feather="layers"></i>
                        </span>
                        <span>Workout</span>
                    </a>

                </li>
                <li>
                    <a href="<?= $path ?>document/">
                        <span class="nav-link-icon">
                            <i data-feather="layers"></i>
                        </span>
                        <span>Tips and Guide</span>
                    </a>

                </li>
                <li>
                    <a href="<?= $path ?>document/">
                        <span class="nav-link-icon">
                            <i data-feather="layers"></i>
                        </span>
                        <span>Faqs</span>
                    </a>

                </li>
                <li>
                    <a href="<?= $path ?>document/">
                        <span class="nav-link-icon">
                            <i data-feather="layers"></i>
                        </span>
                        <span>Exercises</span>
                    </a>

                </li>
            </ul>
            <ul id="laboratories">
                <li class="navigation-divider">Laboratories</li>
                <li>
                    <a href="<?= $path ?>laboratories/dashboard">
                        <span class="nav-link-icon">
                            <i data-feather="pie-chart"></i>
                        </span>
                        <span>Dashboard</span>
                    </a>

                </li>
                <li>
                    <a href="<?= $path ?>laboratories/dashboard">
                        <span class="nav-link-icon">
                            <i data-feather="layers"></i>
                        </span>
                        <span>Laboratories</span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?= $path ?><?= $path ?>laboratories/">All</a>
                        </li>
                        <li>
                            <a href="<?= $path ?>laboratories/add">Add</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul id="Specialities">
                <li class="navigation-divider">Specialities</li>
                <li>
                    <a href="<?= $path ?>specialities/dashboard">
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
                        <span>Specialities</span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?= $path ?>specialities/">All</a>
                        </li>
                        <li>
                            <a href="<?= $path ?>specialities/add">Add</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul id="investigation">
                <li class="navigation-divider">investigation</li>

                <li>
                    <a href="<?= $path ?>investigation/dashboard">
                        <span class="nav-link-icon">
                            <i data-feather="pie-chart"></i>
                        </span>
                        <span>Dashboard</span>
                    </a>

                </li>
                <li>
                    <a href="<?= $path ?>investigation/">
                        <span class="nav-link-icon">
                            <i data-feather="aperture"></i>
                        </span>
                        <span>Lab Reports</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $path ?>investigation/">
                        <span class="nav-link-icon">
                            <i data-feather="anchor"></i>
                        </span>
                        <span>Radiology</span>
                    </a>
                </li>
            </ul>
            <ul id="forms">
                <li class="navigation-divider">Health Care</li>
                <li>
                    <a href="<?= $path ?>diet/dashboard">
                        <span class="nav-link-icon">
                            <i data-feather="pie-chart"></i>
                        </span>
                        <span>Dashboard</span>
                    </a>

                </li>
                <li>
                    <a href="<?= $path ?>diet/support-videos">
                        <span class="nav-link-icon">
                            <i data-feather="layers"></i>
                        </span>
                        <span>Support Videos</span>
                    </a></li>
                <li>
                <li>
                    <a href="<?= $path ?>diet/diet-categories">
                        <span class="nav-link-icon">
                            <i data-feather="layers"></i>
                        </span>
                        <span>Diet Categories</span>
                    </a></li>
                <li>
                    <a href="#">
                        <span class="nav-link-icon">
                            <i data-feather="layers"></i>
                        </span>
                        <span>Diet Facts</span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?= $path ?>diet/fruit">Fruit</a>
                        </li>
                        <li>
                            <a href="<?= $path ?>diet/vegetable">Vegetable</a>
                        </li>
                        <li>
                            <a href="<?= $path ?>diet/miscellaneous">Miscellaneous</a>
                        </li>
                        <li>
                        <li>
                            <a href="<?= $path ?>diet/pulses-grains">Pulses & Grains</a>
                        </li>
                        <li>
                        <li>
                            <a href="<?= $path ?>diet/dry-fruits">Dry Fruits</a>
                        </li>
                        <li>
                            <!--                        <li>-->
                            <!--                            <a href="buttons.html">Buttons</a></li>-->
                            <!--                        <li>-->
                            <!--                            <a href="dropdown.html">Dropdown</a></li>-->
                            <!--                        <li>-->
                            <!--                            <a href="list-group.html">List Group</a></li>-->
                            <!--                        <li>-->
                            <!--                            <a href="pagination.html">Pagination</a></li>-->

                    </ul>
                </li>
                <li>
                    <a href="<?= $path ?>franchises">
                        <span class="nav-link-icon">
                            <i data-feather="book"></i>
                        </span>
                        <span>Branches</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $path ?>representative/">
                        <span class="nav-link-icon">
                            <i data-feather="disc"></i>
                        </span>
                        <span>RCC</span>
                    </a>

                </li>
            </ul>
            <ul id="plugins">
                <li class="navigation-divider">Extended</li>
                <li>
                    <a href="<?= $path ?>extended/dashboard">
                        <span class="nav-link-icon">
                            <i data-feather="pie-chart"></i>
                        </span>
                        <span>Dashboard</span>
                    </a>

                </li>
                <li>
                    <a href="<?= $path ?>extended">
                        <span class="nav-link-icon" data-feather="alert-triangle"></span>
                        <span>Database Compare</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $path ?>extended">
                        <span class="nav-link-icon" data-feather="crop"></span>
                        <span>Profiles</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $path ?>extended">
                        <span class="nav-link-icon" data-feather="clipboard"></span>
                        <span>Default Configuration</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $path ?>extended">
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
                <li class="navigation-divider">Medicine</li>
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
                        <li>
                            <a href="<?= $path ?>medicine/">Take Type</a>
                        </li>
                        <li>
                            <a href="<?= $path ?>medicine/">Forms</a>
                        </li>
                        <li>
                            <a href="<?= $path ?>medicine/">Timing</a>
                        </li>
                        <li>
                            <a href="<?= $path ?>medicine/">Company</a>
                        </li>
                    </ul>
                </li>
                <!--                <li>-->
                <!--                    <a href="#">-->
                <!--                        <span class="nav-link-icon" data-feather="tool"></span>-->
                <!--                        <span>Therapy</span>-->
                <!--                    </a>-->
                <!--                    <ul>-->
                <!--                        <li>-->
                <!--                            <a href="--><?php //= $path 
                                                            ?><!--therapy/add">Add</a>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <a href="--><?php //= $path 
                                                            ?><!--therapy/">Listing</a>-->
                <!--                        </li>-->
                <!--                    </ul>-->
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
                    <a href="<?= $path ?>users">
                        <span class="nav-link-icon" data-feather="users"></span>
                        <span>User</span>
                    </a>
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
                    <a href="<?= $path ?>users">
                        <span class="nav-link-icon">
                            <i data-feather="mail"></i>
                        </span>
                        <span>Admin Activites</span>
                    </a>

                </li>
                <li>
                    <a href="<?= $path ?>users">
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

<script type="text/javascript">
    $(document).ready(function() {
        $(".navigation-menu-tab ul li a").hover(
            function() {
                $(this).click();
            }
        );
    });
</script>
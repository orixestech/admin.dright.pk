<!-- Navigation -->
<div class="navigation">
    <!-- Logo -->
    <div class="navigation-header">
        <a class="navigation-logo" href=index.html>
            <img class="logo" src="<?= $template ?>assets/media/image/logo/logo.png" alt="logo">
            <img class="dark-logo" src="<?= $template ?>assets/media/image/logo/dark-logo.png" alt="dark logo">
            <img class="small-logo" src="<?= $template ?>assets/media/image/logo/small-logo.png" alt="small logo">
            <img class="small-dark-logo" src="<?= $template ?>assets/media/image/logo/small-dark-logo.png" alt="small dark logo">
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
                    <a href="#" data-menu-target="#dashboards">
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
                        <span>Apps</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-menu-target="#components">
                                <span class="menu-tab-icon">
                                    <i data-feather="layers"></i>
                                </span>
                        <span>Components</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-menu-target="#forms">
                                <span class="menu-tab-icon">
                                    <i data-feather="mouse-pointer"></i>
                                </span>
                        <span>Forms</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-menu-target="#plugins">
                                <span class="menu-tab-icon">
                                    <i data-feather="gift"></i>
                                </span>
                        <span>Plugins</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-menu-target="#pages">
                                <span class="menu-tab-icon">
                                    <i data-feather="copy"></i>
                                </span>
                        <span>Pages</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-menu-target="#other">
                                <span class="menu-tab-icon">
                                    <i data-feather="arrow-up-right"></i>
                                </span>
                        <span>Other</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- ./ Menu tab -->

        <!-- Menu body -->
        <div class="navigation-menu-body">
            <ul id="dashboards">
                <li class="navigation-divider">Dashboards</li>
                <li>
                    <a  href="ecommerce-dashboard.html">
                        <span class="nav-link-icon" data-feather="shopping-cart"></span>
                        <span>E-commerce</span>
                    </a>
                </li>
                <li>
                    <a  class="active"
                        href="analytics-dashboard.html">
                        <span class="nav-link-icon" data-feather="bar-chart-2"></span>
                        <span>Analytics</span>
                        <span class="badge badge-success">New</span>
                    </a>
                </li>
                <li>
                    <a  href="helpdesk-dashboard.html">
                        <span class="nav-link-icon" data-feather="life-buoy"></span>
                        <span>Helpdesk</span>
                    </a>
                </li>
                <li class="navigation-divider">E-commerce Pages</li>
                <li>
                    <a  href="orders.html">
                        <span class="nav-link-icon" data-feather="box"></span>
                        <span>Orders</span>
                    </a>
                </li>
                <li>
                    <a  href="product-list.html">
                        <span class="nav-link-icon" data-feather="list"></span>
                        <span>Product List</span>
                    </a>
                </li>
                <li>
                    <a  href="product-grid.html">
                        <span class="nav-link-icon" data-feather="grid"></span>
                        <span>Product Grid</span>
                    </a>
                </li>
                <li>
                    <a  href="product-detail.html">
                        <span class="nav-link-icon" data-feather="file-text"></span>
                        <span>Product Detail</span>
                    </a>
                </li>
            </ul>
            <ul id="apps">
                <li class="navigation-divider">Apps</li>
                <li>
                    <a  href="chat.html">
                        <span class="nav-link-icon" data-feather="message-circle"></span>
                        <span>Chat</span>
                        <span class="badge badge-danger">5</span>
                    </a>
                </li>
                <li>
                    <a  href="mail.html">
                        <span class="nav-link-icon" data-feather="mail"></span>
                        <span>Mail</span>
                    </a>
                </li>
                <li>
                    <a  href="todo-list.html">
                        <span class="nav-link-icon" data-feather="check-circle"></span>
                        <span>Todo List</span>
                        <span class="badge badge-warning small-badge">2</span>
                    </a>
                </li>
                <li>
                    <a  href="file-manager.html">
                        <span class="nav-link-icon" data-feather="file"></span>
                        <span>File Manager</span>
                    </a>
                </li>
                <li>
                    <a  href="calendar.html">
                        <span class="nav-link-icon" data-feather="calendar"></span>
                        <span>Calendar</span>
                    </a>
                </li>
                <li>
                    <a  href="gallery.html">
                        <span class="nav-link-icon" data-feather="image"></span>
                        <span>Gallery</span>
                    </a>
                </li>
                <li>
                    <a  href="invoice.html">
                        <span class="nav-link-icon" data-feather="book"></span>
                        <span>Invoice</span>
                    </a>
                </li>
            </ul>
            <ul id="components">
                <li class="navigation-divider">Components</li>
                <li>
                    <a href="#">
                                <span class="nav-link-icon">
                                    <i data-feather="layers"></i>
                                </span>
                        <span>Basic Components</span>
                    </a>
                    <ul>
                        <li>
                            <a  href="alert.html">Alerts</a></li>
                        <li>
                            <a  href="accordion.html">Accordion</a></li>
                        <li>
                            <a  href="buttons.html">Buttons</a></li>
                        <li>
                            <a  href="dropdown.html">Dropdown</a></li>
                        <li>
                            <a  href="list-group.html">List Group</a></li>
                        <li>
                            <a  href="pagination.html">Pagination</a></li>
                        <li>
                            <a  href="typography.html">Typography</a></li>
                        <li>
                            <a  href="media-object.html">Media Object</a>
                        </li>
                        <li>
                            <a  href="progress.html">Progress</a></li>
                        <li>
                            <a  href="modal.html">Modal</a></li>
                        <li>
                            <a  href="spinners.html">Spinners</a></li>
                        <li>
                            <a  href="navs.html">Navs</a></li>
                        <li>
                            <a  href="tab.html">Tab</a></li>
                        <li>
                            <a  href="tooltip.html">Tooltip</a></li>
                        <li>
                            <a  href="popovers.html">Popovers</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                                <span class="nav-link-icon">
                                    <i data-feather="square"></i>
                                </span>
                        <span>Cards</span>
                    </a>
                    <ul>
                        <li>
                            <a  href="basic-cards.html">Basic Cards </a></li>
                        <li>
                            <a  href="image-cards.html">Image Cards </a></li>
                        <li>
                            <a  href="scrollable-cards.html">Scrollable Cards</a></li>
                        <li>
                            <a  href="other-cards.html">Others Cards</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                                <span class="nav-link-icon">
                                    <i data-feather="grid"></i>
                                </span>
                        <span>Tables</span>
                    </a>
                    <ul>
                        <li>
                            <a  href="basic-tables.html">Basic Tables</a></li>
                        <li>
                            <a  href="dataTable.html">Datatable</a></li>
                        <li>
                            <a  href="responsive-tables.html">Responsive Tables</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a  href="avatar.html">
                                <span class="nav-link-icon">
                                    <i data-feather="aperture"></i>
                                </span>
                        <span>Avatar</span>
                    </a>
                </li>
                <li>
                    <a  href="icons.html">
                                <span class="nav-link-icon">
                                    <i data-feather="anchor"></i>
                                </span>
                        <span>Icons</span>
                    </a>
                </li>
                <li>
                    <a  href="colors.html">
                                <span class="nav-link-icon">
                                    <i data-feather="droplet"></i>
                                </span>
                        <span>Colors</span>
                    </a>
                </li>
                <li>
                    <a  href="divider.html">
                                <span class="nav-link-icon">
                                    <i data-feather="git-commit"></i>
                                </span>
                        <span>Divider</span>
                    </a>
                </li>
            </ul>
            <ul id="forms">
                <li class="navigation-divider">Forms</li>
                <li>
                    <a  href="basic-forms.html">
                        <span class="nav-link-icon" data-feather="book"></span>
                        <span>Basic Forms</span>
                    </a>
                </li>
                <li>
                    <a  href="custom-forms.html">
                        <span class="nav-link-icon" data-feather="disc"></span>
                        <span>Custom Forms</span>
                    </a>
                </li>
                <li>
                    <a  href="advanced-forms.html">
                        <span class="nav-link-icon" data-feather="framer"></span>
                        <span>Advanced Forms</span>
                    </a>
                </li>
                <li>
                    <a  href="form-validation.html">
                        <span class="nav-link-icon" data-feather="toggle-left"></span>
                        <span>Form Validation</span>
                    </a>
                </li>
                <li>
                    <a  href="form-wizard.html">
                        <span class="nav-link-icon" data-feather="sliders"></span>
                        <span>Form Wizard</span>
                    </a>
                </li>
                <li>
                    <a  href="form-repeater.html">
                        <span class="nav-link-icon" data-feather="repeat"></span>
                        <span>Form Repeater</span>
                    </a>
                </li>
            </ul>
            <ul id="plugins">
                <li class="navigation-divider">Plugins</li>
                <li>
                    <a  href="sweet-alert.html">
                        <span class="nav-link-icon" data-feather="alert-triangle"></span>
                        <span>Sweet Alert</span>
                    </a>
                </li>
                <li>
                    <a  href="lightbox.html">
                        <span class="nav-link-icon" data-feather="crop"></span>
                        <span>Lightbox</span>
                    </a>
                </li>
                <li>
                    <a  href="toast.html">
                        <span class="nav-link-icon" data-feather="clipboard"></span>
                        <span>Toast</span>
                    </a>
                </li>
                <li>
                    <a  href="tour.html">
                        <span class="nav-link-icon" data-feather="sliders"></span>
                        <span>Tour</span>
                    </a>
                </li>
                <li>
                    <a  href="slick-slide.html">
                        <span class="nav-link-icon" data-feather="layers"></span>
                        <span>Slick Slide</span>
                    </a>
                </li>
                <li>
                    <a  href="nestable.html">
                        <span class="nav-link-icon" data-feather="align-right"></span>
                        <span>Nestable</span>
                    </a>
                </li>
                <li>
                    <a  href="file-upload.html">
                        <span class="nav-link-icon" data-feather="upload-cloud"></span>
                        <span>File Upload</span>
                    </a>
                </li>
                <li>
                    <a  href="datepicker.html">
                        <span class="nav-link-icon" data-feather="calendar"></span>
                        <span>Datepicker</span>
                    </a>
                </li>
                <li>
                    <a  href="timepicker.html">
                        <span class="nav-link-icon" data-feather="clock"></span>
                        <span>Timepicker</span>
                    </a>
                </li>
                <li>
                    <a  href="colorpicker.html">
                        <span class="nav-link-icon" data-feather="eye"></span>
                        <span>Colorpicker</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="nav-link-icon" data-feather="activity"></span>
                        <span>Charts</span>
                    </a>
                    <ul>
                        <li>
                            <a  href="apexchart.html">Apex Chart</a>
                        </li>
                        <li>
                            <a  href="justgage.html">Justgage</a>
                        </li>
                        <li>
                            <a  href="peity.html">Peity</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                                <span class="nav-link-icon">
                                    <i data-feather="map-pin"></i>
                                </span>
                        <span>Maps</span>
                    </a>
                    <ul>
                        <li>
                            <a  href="google-map.html">Google Map</a>
                        </li>
                        <li>
                            <a  href="vector-map.html">Vector Map</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul id="pages">
                <li class="navigation-divider">Pages</li>
                <li>
                    <a href="#">
                        <span class="nav-link-icon" data-feather="users"></span>
                        <span>User Pages</span>
                    </a>
                    <ul>
                        <li>
                            <a  href="profile.html">Profile</a></li>
                        <li>
                            <a  href="user-list.html">User List</a></li>
                        <li>
                            <a  href="user-edit.html">User Edit</a></li>
                        <li><a href="login.html" target="_blank">Login</a></li>
                        <li><a href="register.html" target="_blank">Register</a></li>
                        <li><a href="recovery-password.html" target="_blank">Recovery Password</a>
                        </li>
                        <li><a href="lock-screen.html" target="_blank">Lock Screen</a></li>
                    </ul>
                </li>
                <li>
                    <a  href="timeline.html">
                        <span class="nav-link-icon" data-feather="hash"></span>
                        <span>Timeline</span>
                    </a>
                </li>
                <li>
                    <a  href="pricing-table.html">
                        <span class="nav-link-icon" data-feather="dollar-sign"></span>
                        <span>Pricing Table</span>
                    </a>
                </li>
                <li>
                    <a  href="pricing-table-2.html">
                        <span class="nav-link-icon" data-feather="dollar-sign"></span>
                        <span>Pricing Table</span>
                        2</a>
                </li>
                <li>
                    <a  href="search-result.html">
                        <span class="nav-link-icon" data-feather="search"></span>
                        <span>Search Result</span>
                    </a>
                </li>
                <li>
                    <a  href="blank-page.html">
                        <span class="nav-link-icon" data-feather="layout"></span>
                        <span>Blank Page</span>

                    </a>
                </li>
                <li>
                    <a href="404.html" target="_blank">
                        <span class="nav-link-icon" data-feather="frown"></span>
                        <span>404</span>
                    </a>
                </li>
                <li>
                    <a href="503.html" target="_blank">
                        <span class="nav-link-icon" data-feather="frown"></span>
                        <span>503</span>
                    </a>
                </li>
                <li>
                    <a href="mean-at-work.html" target="_blank">
                        <span class="nav-link-icon" data-feather="tool"></span>
                        <span>Mean at Work</span>
                    </a>
                </li>
            </ul>
            <ul id="other">
                <li class="navigation-divider">Other</li>
                <li>
                    <a href="#">
                                <span class="nav-link-icon">
                                    <i data-feather="mail"></i>
                                </span>
                        <span>Email Templates</span>
                    </a>
                    <ul>
                        <li><a target="_blank" href="email-template-basic.html">Basic</a></li>
                        <li><a target="_blank" href="email-template-alert.html">Alert</a></li>
                        <li><a target="_blank" href="email-template-billing.html">Billing</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                                <span class="nav-link-icon">
                                    <i data-feather="menu"></i>
                                </span>
                        <span>Menu Level</span>
                    </a>
                    <ul>
                        <li>
                            <a href="#">Menu Level</a>
                            <ul>
                                <li>
                                    <a href="#">Menu Level </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- ./ Menu body -->
    </div>
    <!-- ./ Menu wrapper -->
</div>
<!-- ./ Navigation -->

<nav class="navbar navbar-expand-lg custom-navbar">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#WafiAdminNavbar" aria-controls="WafiAdminNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
            <i></i>
            <i></i>
            <i></i>
        </span>
    </button>
    <div class="collapse navbar-collapse" id="WafiAdminNavbar">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active-page" href="#" id="dashboardsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-devices_other nav-icon"></i>
                    {{ __('Tableaux de bord ')}}
                </a>
                <ul class="dropdown-menu" aria-labelledby="dashboardsDropdown">
                    <li>
                        <a class="dropdown-item" href="index.html">Admin Dashboard</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="project-dashboard.html">Project Management</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="sales-dashboard.html">Sales Dashboard</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="crm-dashboard.html">CRM Dashboard</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="ecommerce-dashboard.html">Ecommerce Dashboard</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="quick-dashboard.html">Quick Dashboard</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="smart-dashboard.html">Smart Dashboard</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="helpdesk-dashboard.html">Help Desk Dashboard</a>
                    </li>
                    <li>
                        <a class="dropdown-toggle sub-nav-link active-page" href="#" id="layoutsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Layouts
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="layoutsDropdown">
                            <li>
                                <a class="dropdown-item" href="default-layout.html">Default Layout</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="default-layout-light.html">Light Color Layout</a>
                            </li>
                            <li>
                                <a class="dropdown-item active-page" href="fixed-layout.html">Fixed Layout</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="card-options.html">Card Options</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="drag-drop-cards.html">Drag and Drop Cards</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="appsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-settings nav-icon"></i>
                    {{ __('Parametrages globale')}}
                </a>
                <ul class="dropdown-menu" aria-labelledby="appsDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('parametrages.site') }}">Gestion site</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="tasks.html">Tasks App</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="documents.html">Documents</a>
                    </li>
                    <li>
                        <a class="dropdown-toggle sub-nav-link" href="#" id="calendarsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Calendars
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="calendarsDropdown">
                            <li>
                                <a class="dropdown-item" href="calendar.html">Daygrid View</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="calendar-external-draggable.html">External Draggable</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="calendar-google.html">Google Calendar</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="calendar-list-view.html">List View</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="calendar-selectable.html">Selectable</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="calendar-week-numbers.html">Week Numbers</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropdown-item" href="invoice.html">Invoice</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="contacts.html">Contacts</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="datepickers.html">Datepickers</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="comments.html">Comments</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="timeline.html">Timeline</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-user nav-icon"></i>
                    {{ __('Gestion utilisateur')}}
                </a>
                <ul class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <li>
                        <a class="dropdown-item" href="user-profile.html">User Profile</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="cards.html">Cards</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="pricing.html">Pricing Plans</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="faq.html">Faq</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="search-results.html">Search Results</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="blog.html">Blog</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="account-settings.html">Account Settings</a>
                    </li>
                    <li>
                        <a class="dropdown-toggle sub-nav-link" href="#" id="customGallery" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Gallery
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="customGallery">
                            <li>
                                <a class="dropdown-item" href="gallery.html">Gallery Slider</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="gallery2.html">Gallery Thumbnail</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="gallery3.html">Gallery Hover</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropdown-item" href="icons.html">Icons</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="typography.html">Typography</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="formsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-monitor nav-icon"></i>
                    {{ __('Plateforme Ferme')}}
                </a>
                <ul class="dropdown-menu" aria-labelledby="formsDropdown">
                    <li>
                        <a class="dropdown-item" href="wizard.html">Wizards</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="bs-select.html">BS Select</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="input-tags.html">Input Tags</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="input-masks.html">Input Mask</a>
                    </li>
                    <li>
                        <a class="dropdown-toggle sub-nav-link" href="#" id="customDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Custom Forms
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="customDropdown">
                            <li>
                                <a class="dropdown-item" href="contact.html">Contact Form</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="contact2.html">Contact Form #2</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="contact3.html">Contact Form #3</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="contact4.html">Contact Form #4</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropdown-item" href="form-inputs.html">Form Inputs</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="input-groups.html">Input Groups</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="check-radio.html">Check Boxes</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="range-sliders.html">Range Sliders</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="editor.html">Editor</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="uiElementsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-shopping-bag nav-icon"></i>
                    {{ __('Gestion production')}}
                </a>
                <ul class="dropdown-menu" aria-labelledby="uiElementsDropdown">
                    <li>
                        <a class="dropdown-toggle sub-nav-link" href="#" id="buttonsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Buttons
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="buttonsDropdown">
                            <li>
                                <a class="dropdown-item" href="buttons.html">Buttons</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="button-groups.html">Button Groups</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="dropdowns.html">Dropdowns</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropdown-toggle sub-nav-link" href="#" id="navsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Navbars
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navsDropdown">
                            <li>
                                <a class="dropdown-item" href="nav.html">Nav</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="tabs.html">Tabs</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropdown-toggle sub-nav-link" href="#" id="componentsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Components
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="componentsDropdown">
                            <li>
                                <a class="dropdown-item" href="jumbotron.html">Jumbotron</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="labels-badges.html">Labels &amp; Badges</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="list-items.html">List Items</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="pagination.html">Paginations</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="progress.html">Progress Bars</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="pills.html">Pills</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="spinners.html">Spinners</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropdown-toggle sub-nav-link" href="#" id="gridDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Grid
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="gridDropdown">
                            <li>
                                <a class="dropdown-item" href="grid.html">Grid</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="grid-doc.html">Grid Doc</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropdown-toggle sub-nav-link" href="#" id="imagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Images
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="imagesDropdown">
                            <li>
                                <a class="dropdown-item" href="avatars.html">Avatars</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="media-objects.html">Media Objects</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="images.html">Thumbnails</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="text-avatars.html">Text Avatars</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropdown-toggle sub-nav-link" href="#" id="accordionsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Accordions
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="accordionsDropdown">
                            <li>
                                <a class="dropdown-item" href="accordion.html">Accordion</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="accordion-icons.html">Accordion Icons</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="accordion-arrows.html">Accordion Arrows</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="accordion-lg.html">Accordion Large</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropdown-toggle sub-nav-link" href="#" id="alertDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Notifications
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="alertDropdown">
                            <li>
                                <a class="dropdown-item" href="bootstrap-alerts.html">Default Alerts</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="custom-alerts.html">Custom Alerts</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="toasts.html">Toasts</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropdown-item" href="carousel.html">Carousels</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="modals.html">Modals</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="popovers-tooltips.html">Tooltips</a>
                    </li>
                </ul>
            </li>

            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="tablesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-book-open nav-icon"></i>
                    {{ __('Gestion Dépense')}}
                </a>
                <ul class="dropdown-menu" aria-labelledby="tablesDropdown">
                    <li>
                        <a class="dropdown-item" href="custom-tables.html">Custom Tables</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="default-table.html">Default Table</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="table-bordered.html">Table Bordered</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="table-hover.html">Table Hover</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="table-striped.html">Table Striped</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="table-small.html">Table Small</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="table-colors.html">Table Colors</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="data-tables.html">Data Tables</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
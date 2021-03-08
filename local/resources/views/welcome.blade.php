@extends('layouts.backend')

@section('content')  
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-speaker icon-gradient bg-night-fade">
                </i>
            </div>
            <div>Panel de Administración
                <div class="page-title-subheading">
                </div>
            </div>
        </div>
    </div>
</div> 
<div class="row">
    <div class="col-lg-6 col-xl-4">
        <div class="mb-3 card">
            <div class="card-header-tab card-header">
                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                    <i class="header-icon lnr-shirt mr-3 text-muted opacity-6"> </i>
                    Top Sellers
                </div>
                <div class="btn-actions-pane-right actions-icon-btn">
                    <div class="btn-group dropdown">
                        <button type="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" class="btn-icon btn-icon-only btn btn-link">
                            <i class="pe-7s-menu btn-icon-wrapper"></i>
                        </button>
                        <div tabindex="-1" role="menu" aria-hidden="true"
                            class="dropdown-menu-shadow dropdown-menu-hover-link dropdown-menu">
                            <h6 tabindex="-1" class="dropdown-header">Header</h6>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <i class="dropdown-icon lnr-inbox"> </i><span>Menus</span>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <i class="dropdown-icon lnr-file-empty"> </i><span>Settings</span>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <i class="dropdown-icon lnr-book"> </i><span>Actions</span>
                            </button>
                            <div tabindex="-1" class="dropdown-divider"></div>
                            <div class="p-1 text-right">
                                <button class="mr-2 btn-shadow btn-sm btn btn-link">View Details</button>
                                <button class="mr-2 btn-shadow btn-sm btn btn-primary">Action</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget-chart widget-chart2 text-left p-0">
                <div class="widget-chat-wrapper-outer">
                    <div class="widget-chart-content widget-chart-content-lg">
                        <div class="widget-chart-flex">
                            <div class="widget-title opacity-5 text-muted text-uppercase">New accounts since 2018</div>
                        </div>
                        <div class="widget-numbers">
                            <div class="widget-chart-flex">
                                <div>
                                    <span class="opacity-10 text-success pr-2">
                                        <i class="fa fa-angle-up"></i>
                                    </span>
                                    <span>9</span>
                                    <small class="opacity-5 pl-1">%</small>
                                </div>
                                <div class="widget-title ml-2 font-size-lg font-weight-normal text-muted">
                                    <span class="text-danger pl-2">+14% failed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-chart-wrapper widget-chart-wrapper-xlg opacity-10 m-0">
                        <div id="dashboard-sparkline-3"></div>
                    </div>
                </div>
            </div>
            <div class="pt-2 pb-0 card-body">
                <h6 class="text-muted text-uppercase font-size-md opacity-9 mb-2 font-weight-normal">Authors</h6>
                <div class="scroll-area-md shadow-overflow">
                    <div class="scrollbar-container">
                        <ul class="rm-list-borders rm-list-borders-scroll list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <img width="38" class="rounded-circle" src="assets/images/avatars/1.jpg" alt="">
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Viktor Martin</div>
                                            <div class="widget-subheading mt-1 opacity-10">
                                                <div class="badge badge-pill badge-dark">$152</div>
                                            </div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="fsize-1 text-focus">
                                                <small class="opacity-5 pr-1">$</small>
                                                <span>752</span>
                                                <small class="text-warning pl-2">
                                                    <i class="fa fa-angle-down"></i>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <img width="38" class="rounded-circle" src="assets/images/avatars/2.jpg" alt="">
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Denis Delgado</div>
                                            <div class="widget-subheading mt-1 opacity-10">
                                                <div class="badge badge-pill badge-dark">$53</div>
                                            </div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="fsize-1 text-focus">
                                                <small class="opacity-5 pr-1">$</small>
                                                <span>587</span>
                                                <small class="text-danger pl-2">
                                                    <i class="fa fa-angle-up"></i>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <img width="38" class="rounded-circle" src="assets/images/avatars/3.jpg" alt="">
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Shawn Galloway</div>
                                            <div class="widget-subheading mt-1 opacity-10">
                                                <div class="badge badge-pill badge-dark">$239</div>
                                            </div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="fsize-1 text-focus">
                                                <small class="opacity-5 pr-1">$</small>
                                                <span>163</span>
                                                <small class="text-muted pl-2">
                                                    <i class="fa fa-angle-down"></i>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <img width="38" class="rounded-circle" src="assets/images/avatars/4.jpg" alt="">
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Latisha Allison</div>
                                            <div class="widget-subheading mt-1 opacity-10">
                                                <div class="badge badge-pill badge-dark">$21</div>
                                            </div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="fsize-1 text-focus">
                                                <small class="opacity-5 pr-1">$</small>
                                                653
                                                <small class="text-primary pl-2">
                                                    <i class="fa fa-angle-up"></i>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <img width="38" class="rounded-circle" src="assets/images/avatars/5.jpg" alt="">
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Lilly-Mae White</div>
                                            <div class="widget-subheading mt-1 opacity-10">
                                                <div class="badge badge-pill badge-dark">$381</div>
                                            </div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="fsize-1 text-focus">
                                                <small class="opacity-5 pr-1">$</small> 629
                                                <small class="text-muted pl-2">
                                                    <i class="fa fa-angle-up"></i>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <img width="38" class="rounded-circle" src="assets/images/avatars/8.jpg" alt="">
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Julie Prosser</div>
                                            <div class="widget-subheading mt-1 opacity-10">
                                                <div class="badge badge-pill badge-dark">$74</div>
                                            </div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="fsize-1 text-focus">
                                                <small class="opacity-5 pr-1">$</small>462
                                                <small class="text-muted pl-2">
                                                    <i class="fa fa-angle-down"></i>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="border-bottom-0 list-group-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <img width="38" class="rounded-circle" src="assets/images/avatars/8.jpg" alt="">
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Amin Hamer</div>
                                            <div class="widget-subheading mt-1 opacity-10">
                                                <div class="badge badge-pill badge-dark">$7</div>
                                            </div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="fsize-1 text-focus">
                                                <small class="opacity-5 pr-1">$</small>
                                                956
                                                <small class="text-success pl-2">
                                                    <i class="fa fa-angle-up"></i>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="d-block text-center rm-border card-footer">
                <button class="btn btn-primary">
                    View complete report
                    <span class="text-white pl-2 opacity-3">
                        <i class="fa fa-arrow-right"></i>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-4">
        <div class="mb-3 card">
            <div class="card-header-tab card-header">
                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                    <i class="header-icon lnr-laptop-phone mr-3 text-muted opacity-6"> </i>Best Selling Products
                </div>
                <div class="btn-actions-pane-right actions-icon-btn">
                    <div class="btn-group dropdown">
                        <button data-toggle="dropdown" type="button" aria-haspopup="true"
                            aria-expanded="false" class="btn-icon btn-icon-only btn btn-link">
                            <i class="pe-7s-menu btn-icon-wrapper"></i></button>
                        <div tabindex="-1" role="menu" aria-hidden="true"
                            class="dropdown-menu-shadow dropdown-menu-hover-link dropdown-menu">
                            <h6 tabindex="-1" class="dropdown-header">Header</h6>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <i class="dropdown-icon lnr-inbox"> </i><span>Menus</span>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <i class="dropdown-icon lnr-file-empty"> </i><span>Settings</span>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <i class="dropdown-icon lnr-book"> </i><span>Actions</span>
                            </button>
                            <div tabindex="-1" class="dropdown-divider"></div>
                            <div class="p-1 text-right">
                                <button class="mr-2 btn-shadow btn-sm btn btn-link">View Details</button>
                                <button class="mr-2 btn-shadow btn-sm btn btn-primary">Action</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget-chart widget-chart2 text-left p-0">
                <div class="widget-chat-wrapper-outer">
                    <div class="widget-chart-content widget-chart-content-lg">
                        <div class="widget-chart-flex">
                            <div class="widget-title opacity-5 text-muted text-uppercase">Toshiba Laptops
                            </div>
                        </div>
                        <div class="widget-numbers">
                            <div class="widget-chart-flex">
                                <div>
                                    <span class="opacity-10 text-warning pr-2">
                                        <i class="fa fa-dot-circle"></i>
                                    </span>
                                    <span>$984</span>
                                </div>
                                <div class="widget-title ml-2 font-size-lg font-weight-normal text-muted">
                                    <span class="text-success pl-2">+14</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-chart-wrapper widget-chart-wrapper-xlg opacity-10 m-0">
                        <div id="dashboard-sparkline-2"></div>
                    </div>
                </div>
            </div>
            <div class="pt-2 pb-0 card-body">
                <h6 class="text-muted text-uppercase font-size-md opacity-9 mb-2 font-weight-normal">Top
                    Performing</h6>
                <div class="scroll-area-md shadow-overflow">
                    <div class="scrollbar-container">
                        <ul class="rm-list-borders rm-list-borders-scroll list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="icon-wrapper m-0">
                                                <div class="progress-circle-wrapper">
                                                    <div class="progress-circle-wrapper">
                                                        <div class="circle-progress circle-progress-gradient">
                                                            <small></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Asus Laptop</div>
                                            <div class="widget-subheading mt-1 opacity-10">
                                                <div class="badge badge-pill badge-dark">$152</div>
                                            </div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="fsize-1 text-focus">
                                                <small class="opacity-5 pr-1">$</small>
                                                <span>752</span>
                                                <small class="text-warning pl-2">
                                                    <i class="fa fa-angle-down"></i>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="icon-wrapper m-0">
                                                <div class="progress-circle-wrapper">
                                                    <div class="progress-circle-wrapper">
                                                        <div class="circle-progress circle-progress-danger">
                                                            <small></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Dell Inspire</div>
                                            <div class="widget-subheading mt-1 opacity-10">
                                                <div class="badge badge-pill badge-dark">$53</div>
                                            </div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="fsize-1 text-focus">
                                                <small class="opacity-5 pr-1">$</small>
                                                <span>587</span>
                                                <small class="text-danger pl-2">
                                                    <i class="fa fa-angle-up"></i>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="icon-wrapper m-0">
                                                <div class="progress-circle-wrapper">
                                                    <div class="progress-circle-wrapper">
                                                        <div class="circle-progress circle-progress-primary">
                                                            <small></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Lenovo IdeaPad</div>
                                            <div class="widget-subheading mt-1 opacity-10">
                                                <div class="badge badge-pill badge-dark">$239</div>
                                            </div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="fsize-1 text-focus">
                                                <small class="opacity-5 pr-1">$</small>
                                                <span>163</span>
                                                <small class="text-muted pl-2">
                                                    <i class="fa fa-angle-down"></i>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="icon-wrapper m-0">
                                                <div class="progress-circle-wrapper">
                                                    <div class="progress-circle-wrapper">
                                                        <div class="circle-progress circle-progress-info">
                                                            <small></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Asus Vivobook</div>
                                            <div class="widget-subheading mt-1 opacity-10">
                                                <div class="badge badge-pill badge-dark">$21</div>
                                            </div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="fsize-1 text-focus">
                                                <small class="opacity-5 pr-1">$</small>
                                                653
                                                <small class="text-primary pl-2">
                                                    <i class="fa fa-angle-up"></i>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="icon-wrapper m-0">
                                                <div class="progress-circle-wrapper">
                                                    <div class="progress-circle-wrapper">
                                                        <div class="circle-progress circle-progress-warning">
                                                            <small></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Apple Macbook</div>
                                            <div class="widget-subheading mt-1 opacity-10">
                                                <div class="badge badge-pill badge-dark">$381</div>
                                            </div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="fsize-1 text-focus">
                                                <small class="opacity-5 pr-1">$</small>
                                                629
                                                <small class="text-muted pl-2">
                                                    <i class="fa fa-angle-up"></i>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="icon-wrapper m-0">
                                                <div class="progress-circle-wrapper">
                                                    <div class="progress-circle-wrapper">
                                                        <div class="circle-progress circle-progress-dark">
                                                            <small></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading">HP Envy 13"</div>
                                            <div class="widget-subheading mt-1 opacity-10">
                                                <div class="badge badge-pill badge-dark">$74</div>
                                            </div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="fsize-1 text-focus">
                                                <small class="opacity-5 pr-1">$</small>
                                                462
                                                <small class="text-muted pl-2">
                                                    <i class="fa fa-angle-down"></i>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="border-bottom-0 list-group-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="icon-wrapper m-0">
                                                <div class="progress-circle-wrapper">
                                                    <div class="progress-circle-wrapper">
                                                        <div class="circle-progress circle-progress-alternate">
                                                            <small></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Gaming Laptop HP</div>
                                            <div class="widget-subheading mt-1 opacity-10">
                                                <div class="badge badge-pill badge-dark">$7</div>
                                            </div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="fsize-1 text-focus">
                                                <small class="opacity-5 pr-1">$</small>
                                                956
                                                <small class="text-success pl-2">
                                                    <i class="fa fa-angle-up"></i>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="d-block text-center rm-border card-footer">
                <button class="btn btn-primary">
                    View all participants
                    <span class="text-white pl-2 opacity-3">
                        <i class="fa fa-arrow-right"></i>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-xl-4">
        <div class="mb-3 card">
            <div class="rm-border pb-0 responsive-center card-header">
                <div>
                    <h5 class="menu-header-title text-capitalize">Portfolio Performance</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-xl-12">
                    <div class="no-shadow rm-border bg-transparent widget-chart text-left card">
                        <div class="progress-circle-wrapper">
                            <div class="circle-progress circle-progress-gradient-lg">
                                <small></small>
                            </div>
                        </div>
                        <div class="widget-chart-content">
                            <div class="widget-subheading">Capital Gains</div>
                            <div class="widget-numbers text-success"><span>$563</span></div>
                            <div class="widget-description text-focus">
                                Increased by
                                <span class="text-warning pl-1">
                                    <i class="fa fa-angle-up"></i>
                                    <span class="pl-1">7.35%</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-12">
                    <div class="card no-shadow rm-border bg-transparent widget-chart text-left mt-2">
                        <div class="progress-circle-wrapper">
                            <div class="circle-progress circle-progress-gradient-alt-lg">
                                <small></small>
                            </div>
                        </div>
                        <div class="widget-chart-content">
                            <div class="widget-subheading">Withdrawals</div>
                            <div class="widget-numbers text-danger"><span>$194</span></div>
                            <div class="widget-description opacity-8 text-focus">
                                Down by
                                <span class="text-success pl-1 pr-1">
                                    <i class="fa fa-angle-down"></i>
                                    <span class="pl-1">21.8%</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mx-auto mt-3">
                <div role="group" class="btn-group-sm btn-group nav">
                    <a class="btn-shadow pl-3 pr-3 active btn btn-primary" data-toggle="tab" href="#sales-tab-1">Income</a>
                    <a class="btn-shadow pr-3 pl-3  btn btn-primary" data-toggle="tab" href="#sales-tab-2">Expenses</a>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="sales-tab-1">
                        <div class="text-center">
                            <h5 class="menu-header-title">Target Sales</h5>
                            <h6 class="menu-header-subtitle opacity-6">Total performance for this month</h6>
                        </div>
                        <div id="dashboard-sparklines-primary"></div>
                    </div>
                    <div class="tab-pane fade" id="sales-tab-2">
                        <div class="text-center">
                            <h5 class="menu-header-title">Tabbed Content</h5>
                            <h6 class="menu-header-subtitle opacity-6">Example of various options built with ArchitectUI</h6>
                        </div>
                        <div
                            class="card-hover-shadow-2x widget-chart widget-chart2 bg-premium-dark text-left mt-3 card">
                            <div class="widget-chart-content text-white">
                                <div class="widget-chart-flex">
                                    <div class="widget-title">Sales</div>
                                    <div class="widget-subtitle opacity-7">Monthly Goals</div>
                                </div>
                                <div class="widget-chart-flex">
                                    <div class="widget-numbers text-success">
                                        <small>$</small>
                                        <span>976</span>
                                        <small class="opacity-8 pl-2">
                                            <i class="fa fa-angle-up"></i>
                                        </small>
                                    </div>
                                    <div class="widget-description ml-auto opacity-7">
                                        <i class="fa fa-angle-up"></i>
                                        <span class="pl-1">175%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button class="btn-pill btn-shadow btn-wide fsize-1 btn btn-success btn-lg">
                                <span class="mr-2 opacity-7">
                                    <i class="icon icon-anim-pulse ion-ios-analytics-outline"></i>
                                </span>
                                <span class="mr-1">View Complete Report</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-lg-6 col-xl-8">
        <div class="mb-3 card">
            <div class="card-header-tab card-header">
                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                    <i class="header-icon lnr-dice mr-3 text-muted opacity-6"> </i>
                    Easy Dynamic Tables
                </div>
                <div class="btn-actions-pane-right actions-icon-btn">
                    <div class="btn-group dropdown">
                        <button type="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" class="btn-icon btn-icon-only btn btn-link">
                            <i class="pe-7s-menu btn-icon-wrapper"></i>
                        </button>
                        <div tabindex="-1" role="menu" aria-hidden="true"
                            class="dropdown-menu-shadow dropdown-menu-hover-link dropdown-menu">
                            <h6 tabindex="-1" class="dropdown-header">Header</h6>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <i class="dropdown-icon lnr-inbox"> </i><span>Menus</span>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <i class="dropdown-icon lnr-file-empty"> </i><span>Settings</span>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <i class="dropdown-icon lnr-book"> </i><span>Actions</span>
                            </button>
                            <div tabindex="-1" class="dropdown-divider"></div>
                            <div class="p-3 text-right">
                                <button class="mr-2 btn-shadow btn-sm btn btn-link">View Details</button>
                                <button class="mr-2 btn-shadow btn-sm btn btn-primary">Action</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table style="width: 100%;" id="example2"
                    class="table table-hover table-striped table-bordered pag-table">
                    <thead>
                        <tr>
                            <th>id_category</th>
                            <th>Name</th>
                            <th>Link Rewrite</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $item)
                           <tr>
                               <td>{{ $item->id_category }}</td>
                               <td>{{ $item->name }}</td>
                               <td>{{ $item->link_rewrite }}</td>
                               <td></td>
                            </tr> 
                        @endforeach
                        
                    </tbody>   
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

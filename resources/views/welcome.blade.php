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
<div class="container">
    <ul class="tabs-animated-shadow tabs-animated nav nav-justified tabs-rounded-lg">
        <li class="nav-item">
            <a role="tab" class="nav-link active show" href="javascript:void(0);" aria-selected="true">
                <span>Sales</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link" href="javascript:void(0);" aria-selected="false">
                <span>Activity</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link" href="javascript:void(0);" aria-selected="false">
                <span>Profile</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link" href="javascript:void(0);" aria-selected="false">
                <span>Accounts</span>
            </a>
        </li>
    </ul>
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
                    class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011/07/25</td>
                            <td>$170,750</td>
                        </tr>
                        <tr>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>2009/01/12</td>
                            <td>$86,000</td>
                        </tr>
                        <tr>
                            <td>Cedric Kelly</td>
                            <td>Senior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2012/03/29</td>
                            <td>$433,060</td>
                        </tr>
                        <tr>
                            <td>Airi Satou</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>33</td>
                            <td>2008/11/28</td>
                            <td>$162,700</td>
                        </tr>
                        <tr>
                            <td>Brielle Williamson</td>
                            <td>Integration Specialist</td>
                            <td>New York</td>
                            <td>61</td>
                            <td>2012/12/02</td>
                            <td>$372,000</td>
                        </tr>
                        <tr>
                            <td>Herrod Chandler</td>
                            <td>Sales Assistant</td>
                            <td>San Francisco</td>
                            <td>59</td>
                            <td>2012/08/06</td>
                            <td>$137,500</td>
                        </tr>
                        <tr>
                            <td>Rhona Davidson</td>
                            <td>Integration Specialist</td>
                            <td>Tokyo</td>
                            <td>55</td>
                            <td>2010/10/14</td>
                            <td>$327,900</td>
                        </tr>
                        <tr>
                            <td>Colleen Hurst</td>
                            <td>Javascript Developer</td>
                            <td>San Francisco</td>
                            <td>39</td>
                            <td>2009/09/15</td>
                            <td>$205,500</td>
                        </tr>
                        <tr>
                            <td>Sonya Frost</td>
                            <td>Software Engineer</td>
                            <td>Edinburgh</td>
                            <td>23</td>
                            <td>2008/12/13</td>
                            <td>$103,600</td>
                        </tr>
                        <tr>
                            <td>Jena Gaines</td>
                            <td>Office Manager</td>
                            <td>London</td>
                            <td>30</td>
                            <td>2008/12/19</td>
                            <td>$90,560</td>
                        </tr>
                        <tr>
                            <td>Quinn Flynn</td>
                            <td>Support Lead</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2013/03/03</td>
                            <td>$342,000</td>
                        </tr>
                        <tr>
                            <td>Charde Marshall</td>
                            <td>Regional Director</td>
                            <td>San Francisco</td>
                            <td>36</td>
                            <td>2008/10/16</td>
                            <td>$470,600</td>
                        </tr>
                        <tr>
                            <td>Haley Kennedy</td>
                            <td>Senior Marketing Designer</td>
                            <td>London</td>
                            <td>43</td>
                            <td>2012/12/18</td>
                            <td>$313,500</td>
                        </tr>
                        <tr>
                            <td>Tatyana Fitzpatrick</td>
                            <td>Regional Director</td>
                            <td>London</td>
                            <td>19</td>
                            <td>2010/03/17</td>
                            <td>$385,750</td>
                        </tr>
                        <tr>
                            <td>Michael Silva</td>
                            <td>Marketing Designer</td>
                            <td>London</td>
                            <td>66</td>
                            <td>2012/11/27</td>
                            <td>$198,500</td>
                        </tr>
                        <tr>
                            <td>Paul Byrd</td>
                            <td>Chief Financial Officer (CFO)</td>
                            <td>New York</td>
                            <td>64</td>
                            <td>2010/06/09</td>
                            <td>$725,000</td>
                        </tr>
                        <tr>
                            <td>Gloria Little</td>
                            <td>Systems Administrator</td>
                            <td>New York</td>
                            <td>59</td>
                            <td>2009/04/10</td>
                            <td>$237,500</td>
                        </tr>
                        <tr>
                            <td>Bradley Greer</td>
                            <td>Software Engineer</td>
                            <td>London</td>
                            <td>41</td>
                            <td>2012/10/13</td>
                            <td>$132,000</td>
                        </tr>
                        <tr>
                            <td>Dai Rios</td>
                            <td>Personnel Lead</td>
                            <td>Edinburgh</td>
                            <td>35</td>
                            <td>2012/09/26</td>
                            <td>$217,500</td>
                        </tr>
                        <tr>
                            <td>Jenette Caldwell</td>
                            <td>Development Lead</td>
                            <td>New York</td>
                            <td>30</td>
                            <td>2011/09/03</td>
                            <td>$345,000</td>
                        </tr>
                        <tr>
                            <td>Yuri Berry</td>
                            <td>Chief Marketing Officer (CMO)</td>
                            <td>New York</td>
                            <td>40</td>
                            <td>2009/06/25</td>
                            <td>$675,000</td>
                        </tr>
                        <tr>
                            <td>Caesar Vance</td>
                            <td>Pre-Sales Support</td>
                            <td>New York</td>
                            <td>21</td>
                            <td>2011/12/12</td>
                            <td>$106,450</td>
                        </tr>
                        <tr>
                            <td>Doris Wilder</td>
                            <td>Sales Assistant</td>
                            <td>Sidney</td>
                            <td>23</td>
                            <td>2010/09/20</td>
                            <td>$85,600</td>
                        </tr>
                        <tr>
                            <td>Angelica Ramos</td>
                            <td>Chief Executive Officer (CEO)</td>
                            <td>London</td>
                            <td>47</td>
                            <td>2009/10/09</td>
                            <td>$1,200,000</td>
                        </tr>
                        <tr>
                            <td>Gavin Joyce</td>
                            <td>Developer</td>
                            <td>Edinburgh</td>
                            <td>42</td>
                            <td>2010/12/22</td>
                            <td>$92,575</td>
                        </tr>
                        <tr>
                            <td>Jennifer Chang</td>
                            <td>Regional Director</td>
                            <td>Singapore</td>
                            <td>28</td>
                            <td>2010/11/14</td>
                            <td>$357,650</td>
                        </tr>
                        <tr>
                            <td>Brenden Wagner</td>
                            <td>Software Engineer</td>
                            <td>San Francisco</td>
                            <td>28</td>
                            <td>2011/06/07</td>
                            <td>$206,850</td>
                        </tr>
                        <tr>
                            <td>Fiona Green</td>
                            <td>Chief Operating Officer (COO)</td>
                            <td>San Francisco</td>
                            <td>48</td>
                            <td>2010/03/11</td>
                            <td>$850,000</td>
                        </tr>
                        <tr>
                            <td>Shou Itou</td>
                            <td>Regional Marketing</td>
                            <td>Tokyo</td>
                            <td>20</td>
                            <td>2011/08/14</td>
                            <td>$163,000</td>
                        </tr>
                        <tr>
                            <td>Michelle House</td>
                            <td>Integration Specialist</td>
                            <td>Sidney</td>
                            <td>37</td>
                            <td>2011/06/02</td>
                            <td>$95,400</td>
                        </tr>
                        <tr>
                            <td>Suki Burks</td>
                            <td>Developer</td>
                            <td>London</td>
                            <td>53</td>
                            <td>2009/10/22</td>
                            <td>$114,500</td>
                        </tr>
                        <tr>
                            <td>Prescott Bartlett</td>
                            <td>Technical Author</td>
                            <td>London</td>
                            <td>27</td>
                            <td>2011/05/07</td>
                            <td>$145,000</td>
                        </tr>
                        <tr>
                            <td>Gavin Cortez</td>
                            <td>Team Leader</td>
                            <td>San Francisco</td>
                            <td>22</td>
                            <td>2008/10/26</td>
                            <td>$235,500</td>
                        </tr>
                        <tr>
                            <td>Martena Mccray</td>
                            <td>Post-Sales support</td>
                            <td>Edinburgh</td>
                            <td>46</td>
                            <td>2011/03/09</td>
                            <td>$324,050</td>
                        </tr>
                        <tr>
                            <td>Unity Butler</td>
                            <td>Marketing Designer</td>
                            <td>San Francisco</td>
                            <td>47</td>
                            <td>2009/12/09</td>
                            <td>$85,675</td>
                        </tr>
                        <tr>
                            <td>Howard Hatfield</td>
                            <td>Office Manager</td>
                            <td>San Francisco</td>
                            <td>51</td>
                            <td>2008/12/16</td>
                            <td>$164,500</td>
                        </tr>
                        <tr>
                            <td>Hope Fuentes</td>
                            <td>Secretary</td>
                            <td>San Francisco</td>
                            <td>41</td>
                            <td>2010/02/12</td>
                            <td>$109,850</td>
                        </tr>
                        <tr>
                            <td>Vivian Harrell</td>
                            <td>Financial Controller</td>
                            <td>San Francisco</td>
                            <td>62</td>
                            <td>2009/02/14</td>
                            <td>$452,500</td>
                        </tr>
                        <tr>
                            <td>Timothy Mooney</td>
                            <td>Office Manager</td>
                            <td>London</td>
                            <td>37</td>
                            <td>2008/12/11</td>
                            <td>$136,200</td>
                        </tr>
                        <tr>
                            <td>Jackson Bradshaw</td>
                            <td>Director</td>
                            <td>New York</td>
                            <td>65</td>
                            <td>2008/09/26</td>
                            <td>$645,750</td>
                        </tr>
                        <tr>
                            <td>Olivia Liang</td>
                            <td>Support Engineer</td>
                            <td>Singapore</td>
                            <td>64</td>
                            <td>2011/02/03</td>
                            <td>$234,500</td>
                        </tr>
                        <tr>
                            <td>Bruno Nash</td>
                            <td>Software Engineer</td>
                            <td>London</td>
                            <td>38</td>
                            <td>2011/05/03</td>
                            <td>$163,500</td>
                        </tr>
                        <tr>
                            <td>Sakura Yamamoto</td>
                            <td>Support Engineer</td>
                            <td>Tokyo</td>
                            <td>37</td>
                            <td>2009/08/19</td>
                            <td>$139,575</td>
                        </tr>
                        <tr>
                            <td>Thor Walton</td>
                            <td>Developer</td>
                            <td>New York</td>
                            <td>61</td>
                            <td>2013/08/11</td>
                            <td>$98,540</td>
                        </tr>
                        <tr>
                            <td>Finn Camacho</td>
                            <td>Support Engineer</td>
                            <td>San Francisco</td>
                            <td>47</td>
                            <td>2009/07/07</td>
                            <td>$87,500</td>
                        </tr>
                        <tr>
                            <td>Serge Baldwin</td>
                            <td>Data Coordinator</td>
                            <td>Singapore</td>
                            <td>64</td>
                            <td>2012/04/09</td>
                            <td>$138,575</td>
                        </tr>
                        <tr>
                            <td>Zenaida Frank</td>
                            <td>Software Engineer</td>
                            <td>New York</td>
                            <td>63</td>
                            <td>2010/01/04</td>
                            <td>$125,250</td>
                        </tr>
                        <tr>
                            <td>Zorita Serrano</td>
                            <td>Software Engineer</td>
                            <td>San Francisco</td>
                            <td>56</td>
                            <td>2012/06/01</td>
                            <td>$115,000</td>
                        </tr>
                        <tr>
                            <td>Jennifer Acosta</td>
                            <td>Junior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>43</td>
                            <td>2013/02/01</td>
                            <td>$75,650</td>
                        </tr>
                        <tr>
                            <td>Cara Stevens</td>
                            <td>Sales Assistant</td>
                            <td>New York</td>
                            <td>46</td>
                            <td>2011/12/06</td>
                            <td>$145,600</td>
                        </tr>
                        <tr>
                            <td>Hermione Butler</td>
                            <td>Regional Director</td>
                            <td>London</td>
                            <td>47</td>
                            <td>2011/03/21</td>
                            <td>$356,250</td>
                        </tr>
                        <tr>
                            <td>Lael Greer</td>
                            <td>Systems Administrator</td>
                            <td>London</td>
                            <td>21</td>
                            <td>2009/02/27</td>
                            <td>$103,500</td>
                        </tr>
                        <tr>
                            <td>Jonas Alexander</td>
                            <td>Developer</td>
                            <td>San Francisco</td>
                            <td>30</td>
                            <td>2010/07/14</td>
                            <td>$86,500</td>
                        </tr>
                        <tr>
                            <td>Shad Decker</td>
                            <td>Regional Director</td>
                            <td>Edinburgh</td>
                            <td>51</td>
                            <td>2008/11/13</td>
                            <td>$183,000</td>
                        </tr>
                        <tr>
                            <td>Michael Bruce</td>
                            <td>Javascript Developer</td>
                            <td>Singapore</td>
                            <td>29</td>
                            <td>2011/06/27</td>
                            <td>$183,000</td>
                        </tr>
                        <tr>
                            <td>Donna Snider</td>
                            <td>Customer Support</td>
                            <td>New York</td>
                            <td>27</td>
                            <td>2011/01/25</td>
                            <td>$112,000</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

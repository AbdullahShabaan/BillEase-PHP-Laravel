@extends('layouts.master')
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection

@section('title')
Dashboard
@endsection
@section('page-header')
                <!-- breadcrumb -->
                <div class="breadcrumb-header justify-content-between">
                    <div class="left-content">
                        <div>
                          <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi, welcome back {{ucfirst(auth()->user()->name)}}</h2>
                          <p class="mg-b-0">Dashboard</p>
                        </div>
                    </div>
                    <div class="main-dashboard-header-right">
                
                        <div>
                            <label class="tx-13">Number Of Customers</label>
                            <h5>{{\App\Models\Category::count()}} Customers</h5>
                        </div>
                        <div>
                            <label class="tx-13">Number Of Products </label>
                            <h5>{{\App\Models\Product::count()}} Products</h5>
                        </div>
                    </div>
                </div>
                <!-- /breadcrumb -->
@endsection
@section('content')
                <!-- row -->
                <div class="row row-sm">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                        <div class="card overflow-hidden sales-card bg-primary-gradient">
                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white">Total Bills</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <div class="">
                                            <h4 class="tx-20 font-weight-bold mb-1 text-white">${{number_format(\App\Models\Bill::sum('total') , 3)}}</h4>
                                            <p class="mb-0 tx-12 text-white op-7">Count Bills {{\App\Models\Bill::count()}}</p>
                                        </div>
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-up text-white"></i>
                                            <span class="text-white op-7">%100</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                        <div class="card overflow-hidden sales-card bg-danger-gradient">
                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white">UnPaid Bills</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <div class="">
                                            <h4 class="tx-20 font-weight-bold mb-1 text-white">${{number_format(\App\Models\Bill::where('value_status' , 2 )->sum('total') , 3)}}</h4>
                                            <p class="mb-0 tx-12 text-white op-7">Count Bills {{\App\Models\Bill::where('value_status' , 2)->count()}}</p>
                                        </div>
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-down text-white"></i>
                                            <span class="text-white op-7">
                                                @if(\App\Models\Bill::count() != 0)
                                                %{{round(\App\Models\Bill::where('value_status' , 2)->count() / \App\Models\Bill::count() * 100 , 2)}}</span>
                                                @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                        <div class="card overflow-hidden sales-card bg-success-gradient">
                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white">Paid Bills</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <div class="">
                                            <h4 class="tx-20 font-weight-bold mb-1 text-white">${{number_format(\App\Models\Bill::where('value_status' , 1 )->sum('total') , 3)}}</h4>
                                            <p class="mb-0 tx-12 text-white op-7">Count Bills {{\App\Models\Bill::where('value_status' , 1)->count()}}</p>
                                        </div>
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-up text-white"></i>
                                            <span class="text-white op-7"> 
                                                 @if(\App\Models\Bill::count() != 0)
                                                 %{{round(\App\Models\Bill::where('value_status' , 1)->count() / \App\Models\Bill::count() * 100 , 2)}}</span>
                                                 @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                        <div class="card overflow-hidden sales-card bg-warning-gradient">
                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white">Partialy Paid Bills</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <div class="">
                                            <h4 class="tx-20 font-weight-bold mb-1 text-white">${{number_format(\App\Models\Bill::where('value_status' , 3 )->sum('total') , 3)}}</h4>
                                            <p class="mb-0 tx-12 text-white op-7">Count Bills {{\App\Models\Bill::where('value_status' , 3)->count()}}</p>
                                        </div>
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-down text-white"></i>
                                            <span class="text-white op-7">
                                                @if(\App\Models\Bill::count() != 0)
                                                %{{round(\App\Models\Bill::where('value_status' , 3)->count() / \App\Models\Bill::count() * 100 , 2 )}}</span>
                                                @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
                        </div>
                    </div>
                </div>
                <!-- row closed -->

                <!-- row opened -->
                <div class="row row-sm">
                    <div class="col-md-12 col-lg-12 col-xl-7">
                        <div class="card">
                            <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mb-0">Bill Bar Chart:</h4>
                                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                                </div>
                               
                            </div>
                           <div >
                                {!! $chartjs->render() !!}
                           </div>
                        </div>
                    </div>



        <div class="col-lg-12 col-xl-5">
            <div class="card card-dashboard-map-one">
                <label class="main-content-label"> Bill Pie Chart: </label>
                <div class="" style="width: 100%">
                    {!! $chartjs2->render() !!}
                </div>
            </div>
        </div>
                  
                </div>


                <!-- row closed -->

                <!--Row-->
                <div class="row row-sm">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mg-b-0">CUSTOMERS TABLE</h4>
                                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                                </div>
                            
                            </div>
                            <div class="card-body">
                                <div class="table-responsive border-top userlist-table">
                                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th class="wd-lg-8p"><span>Id</span></th>
                                                <th class="wd-lg-8p"><span>User</span></th>
                                                <th class="wd-lg-20p"><span>Description</span></th>
                                                <th class="wd-lg-20p"><span>Sales </span></th>
                                                <th class="wd-lg-20p"><span>Created_At</span></th>
                                                <th class="wd-lg-20p"><span>Number Of Products </span></th>
                                                <th class="wd-lg-20p"><span>Control </span></th>
                                       
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($category as $cat)
                                            <tr>
                                               
                                                <td>{{$cat->id}}</td>
                                                <td>{{$cat->name}}</td>
                                                <td>{{$cat->description}}</td>
                                                <td>{{$cat->created_by}}</td>
                                                <td>{{$cat->created_at}}</td>
                                                <td class="text-center">
                                                    <span class="label text-muted d-flex"><div class="dot-label bg-gray-300 ml-1"></div>{{\App\Models\Category::find($cat->id)->products->count()}}</span>
                                                </td>
                                                
                                                <td>
                                                    <a href="{{route('categories.edit' , $cat->id)}}" class="btn btn-sm btn-primary">
                                                        <i class="las la-search"></i>
                                                    </a>    
                                                </td>
                                            </tr>
                                            @endforeach
                                          
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <ul class="pagination mt-4 mb-0 float-left">
                                    <li class="page-item page-prev disabled">
                                        <a class="page-link" href="#" tabindex="-1">Prev</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item page-next">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- COL END -->
                </div>
                            
                    
            </div>
        </div>
        <!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>   
@endsection

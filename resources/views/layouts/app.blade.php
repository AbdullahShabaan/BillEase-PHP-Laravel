@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
                <!-- breadcrumb -->
                <div class="breadcrumb-header justify-content-between">
                    <div class="my-auto">
                        <div class="d-flex">
                            <h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Profile</span>
                        </div>
                    </div>
                    <div class="d-flex my-xl-auto right-content">
                        <div class="pr-1 mb-3 mb-xl-0">
                            <button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
                        </div>
                        <div class="pr-1 mb-3 mb-xl-0">
                            <button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
                        </div>
                        <div class="pr-1 mb-3 mb-xl-0">
                            <button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
                        </div>
                        <div class="mb-3 mb-xl-0">
                            <div class="btn-group dropdown">
                                <button type="button" class="btn btn-primary">14 Aug 2019</button>
                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
                                    <a class="dropdown-item" href="#">2015</a>
                                    <a class="dropdown-item" href="#">2016</a>
                                    <a class="dropdown-item" href="#">2017</a>
                                    <a class="dropdown-item" href="#">2018</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- breadcrumb -->
@endsection
@section('content')
@include('sweetalert::alert')

                <!-- row -->
                <div class="row row-sm">
                    <div class="col-lg-4">
                        <div class="card mg-b-20">
                            <div class="card-body">
                                <div class="pl-0">
                                    <div class="main-profile-overview">
                                        <div class="main-img-user profile-user">
                                           @if ( !empty ( Auth()->user()->img ))
                                            <img alt="" src="{{asset('app/profilePic/' . Auth()->user()->img)}}">
                                                @else
                                            <img alt="" src="{{asset('app/profilePic/11.JPG')}}">
                                              @endif
                                            <a class="fas fa-camera profile-edit" href="JavaScript:void();"></a>
                                        </div>
                                           
                                        <div class="d-flex justify-content-between mg-b-20">
                                            <div>
                                                <h5 class="main-profile-name">{{Auth()->user()->name}}</h5>
                                                <p class="main-profile-name-text">{{Auth()->user()->email}}</p>
                                            </div>
                                        </div>
                                      
                                       
                                   
                                  
                               
                                  
                                    </div><!-- main-profile-overview -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row row-sm">
                      
                     
                         
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="tabs-menu ">
                                    <!-- Tabs -->
                                    <ul class="nav nav-tabs profile navtab-custom panel-tabs">
                                    
                                  
                                        <li class="">
                                            <a href="#settings" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="las la-cog tx-16 mr-1"></i></span> <span class="hidden-xs">SETTINGS</span> </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
                                  
                            
                                    <div class="tab-pane active" id="settings">
                                        <form role="form" action="{{route ('profile.update')}}" method="post" enctype="multipart/form-data" autocomplete="">
                                            @csrf
                                            <div class="form-group">
                                                <label for="FullName">Name</label>
                                                <input name="name" type="text" value="{{Auth()->user()->name}}" id="FullName" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="Email">Email</label>
                                                <input name="email" type="email" value="{{Auth()->user()->email}}" id="Email" class="form-control">
                                            </div>
                                         
                                            <div class="form-group">
                                                <label for="Password">Password</label>
                                                <input name="password1" type="password" placeholder="6 - 15 Characters"  id="Password" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="RePassword">Re-Password</label>
                                                <input name="password2" type="password" placeholder="6 - 15 Characters" id="RePassword" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label >Profile Image</label>
                                                <p class='alert alert-danger'>if you don't want to change profile picture leave it blank.</p>
                                                <input name="img" type="file"  class="form-control">
                                            </div>

                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                         @error('password1')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                         
                                            <button class="btn btn-primary waves-effect waves-light w-md" type="submit">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row closed -->
            </div>
            <!-- Container closed -->
        </div>
        <!-- main-content closed -->
@endsection
@section('js')
@endsection
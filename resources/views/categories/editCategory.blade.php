@extends('layouts.master')
@section('css')
@endsection
@section('title')
Edit Category
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Settings</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Edit Category</span>
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
				<!-- row -->
				<div class="row">
								<div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
						<div class="card  box-shadow-0">
							<div class="card-header">
								@foreach($data as $cat)
								<h4 class="card-title mb-1">Edit {{$cat->name}}</h4>
							</div>
							<div class="card-body pt-0">
								<form class="form-horizontal" method='post' 
								action='{{route("categories.update" , $cat->id)}}' >
								@csrf
								@method('PUT')
<br>
									<label>Name </label>
									<div class="form-group">
										<input type="text" name="name" class="form-control" value="{{$cat->name}}" placeholder="Name">
									</div>
<br>
									<label>description </label>
									<div class="form-group">
										<input type="text" name="description" value="{{$cat->description}}" class="form-control"  placeholder="Category Description">
									</div>
								@endforeach
					<ul>
  						@error('name')
    						<li class="alert alert-danger">{{ $message }}</li>
						@enderror

						@error('description')
    						<li class="alert alert-danger">{{ $message }}</li>
						@enderror
					</ul>
									<div class="form-group mb-0 mt-3 justify-content-end">
										<div>
											<button type="submit" class="btn btn-primary">Update</button>
											<a href='{{url()->previous()}}' class="btn btn-secondary">Back</a>
										</div>
									</div>
								</form>
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
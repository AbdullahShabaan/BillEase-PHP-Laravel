@extends('layouts.master')
@section('css')
@endsection
@section('title')
Edit Product
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Settings</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Edit Product</span>
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
								action='{{route("products.update" , $cat->id)}}' >
								@csrf
								@method('PUT')
							@endforeach
<br>
				@foreach($data as $product)
														
  						<div class="mb-3">
    						<label id="name" >Product Name</label>
    						<input id="name" value="{{$product->name}}" name="name" placeholder="Click Here" type="text" class="form-control" >
  						</div>


  						<div class="mb-3">
    						<label id="desc" >Product description</label>
    						<input id="desc" value="{{$product->description}}" name ="description" placeholder="Click Here" type="text" class="form-control" >
  						</div>

  						 <div class="mb-3">
    						<label id="price" >Price</label>
    						<input id="price" value="{{$product->price}}" name ="price" placeholder="Click Here" type="number" class="form-control" >
  						</div>

  						<div>
							<p class="mb-3">Product Status</p>
							<select class="SlectBox form-control" name='status'>


							<option 
							@if($product->status == 1 ) 
							selected
							@endif
							value="1">Old</option>														
							<option 
							@if($product->status == 2 ) 
							selected
							@endif
							value="2">Like New</option>

							<option 
							@if($product->status == 3 ) 
							selected
							@endif
							value="3">New</option>

							</select>
						</div>

						 <div>
							<p class="mb-3">Category</p>
							<select class="SlectBox form-control" name='category'>

						@foreach($category as $cat)
							<option 
							@if($product->category->name == $cat->name)
							selected
							@endif
							value="{{$cat->id}}">{{$cat->name}}</option>					
						@endforeach
							</select>
						</div>
					<ul>

				@endforeach
  						@error('name')
    						<li class="alert alert-danger">{{ $message }}</li>
						@enderror

						@error('description')
    						<li class="alert alert-danger">{{ $message }}</li>
						@enderror

						@error('price')
    						<li class="alert alert-danger">{{ $message }}</li>
						@enderror

						@error('status')
    						<li class="alert alert-danger">{{ $message }}</li>
						@enderror

						@error('category')
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
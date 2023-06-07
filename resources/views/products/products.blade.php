@extends('layouts.master')
@section('title')
Products
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
@include('sweetalert::alert')

				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Settings</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Show Products</span>
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
				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">

				@can('add-products')
				<div class="col-sm-12 col-md-8 col-xl-6 mg-t-20">

						<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-sign" data-toggle="modal" href="#modaldemo8">Add New Product</a>

					<ul>
  						@error('name')
    						<li class="alert alert-danger">{{ $message }}</li>
						@enderror

						@error('description')
    						<li class="alert alert-danger">{{ $message }}</li>
						@enderror
					</ul>
				</div>
				@endcan

							<!-- Modal effects -->

	<div class="modal" id="modaldemo8">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Add Product</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
				<form method="post" action="{{route('products.store')}}" >
					@csrf
					
  						<div class="mb-3">
    						<label id="name" >Product Name</label>
    						<input id="name" value="{{old('name')}}" name="name" placeholder="Click Here" type="text" class="form-control" >
  						</div>


  						<div class="mb-3">
    						<label id="desc" >Product description</label>
    						<input id="desc" value="{{old('description')}}" name ="description" placeholder="Click Here" type="text" class="form-control" >
  						</div>

  						 <div class="mb-3">
    						<label id="price" >Price</label>
    						<input id="price" value="{{old('price')}}" name ="price" placeholder="Click Here" type="number" class="form-control" >
  						</div>

  						<div>
							<p class="mb-3">Product Status</p>
							<select class="SlectBox form-control" name='status'>

							<option >...</option>
							<option value="1">Old</option>
							<option value="2">Like New</option>
							<option value="3">New</option>

							</select>
						</div>

						 <div>
							<p class="mb-3">Category</p>
							<select class="SlectBox form-control" name='category'>
								<option >...</option>
							@foreach($category as $cat)
							<option value="{{$cat->id}}">{{$cat->name}}</option>
							@endforeach
							</select>
						</div>
  	
  						
					</div>
					<div class="modal-footer">
						<input  class="btn ripple btn-primary" type="submit" value="Add">
				</form>
						<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
					</div>
				</div>
			</div>
		</div>

		<!-- End Modal effects-->


								</div>
					
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">Id</th>
												<th class="wd-15p border-bottom-0">Name</th>
												<th class="wd-20p border-bottom-0">Category</th>
												<th class="wd-15p border-bottom-0">User</th>
												<th class="wd-10p border-bottom-0">description</th>
												<th class="wd-25p border-bottom-0">price</th>
												<th class="wd-25p border-bottom-0">status</th>
												<th class="wd-25p border-bottom-0">date</th>
												@can('edit-products')
												<th class="wd-25p border-bottom-0">Edit</th>
												@endcan
												@can('delete-products')
												<th class="wd-25p border-bottom-0">Delete</th>
												@endcan
												<th class="wd-25p border-bottom-0">#</th>
											</tr>
										</thead>
										<tbody>
				@foreach($data as $product)
											<tr>
												<td>{{$product->id}}</td>
												<td>{{$product->name}}</td>
												<td>{{$product->category->name}}</td>
												<td>{{$product->user}}</td>
												<td>{{$product->description}}</td>
												<td>{{$product->price}}</td>
												<td>@if ($product->status == 1)
													Old
													@elseif($product->status == 2)
													Like New
													@elseif($product->status == 3)
													New
													@endif</td>
												<td>{{$product->date}}</td>
												@can('edit-products')
												<td>

													<a class=" btn btn-sm btn-primary" 
         											href="{{route('products.edit' , $product->id)}}" ><i class="las la-edit"></i>Edit</a>
         										</td>
         										@endcan
         										@can('delete-products')
         										<td>
													<!-- delete -->
       												<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
             									 	data-toggle="modal"
    												href="#modaldemo9" ><i class="las la-trash"></i>Delete</a>

           										 </td>
           										 @endcan

                    <div class="modal" id="modaldemo9">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">Delete Category</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                     type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="{{route('products.destroy' , $product->id)}}" method="post">
                                    {{method_field('delete')}}
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <p>?Are you sure you want to delete this Product 

                                        </p><br>
     
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Yes</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
							<!-- End delete -->
											</tr>
				@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->

					


@endsection

@section('js')
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>

    <script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('section_name')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #description').val(description);
        })
    </script>

    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('section_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_name').val(section_name);
        })
    </script>




@endsection
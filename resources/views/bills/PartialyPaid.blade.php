@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('title')
Partialy Paid
@endsection
@section('page-header')
@include('sweetalert::alert')

				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Partialy Paid Bills</h4>
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
				

					
					<!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Partialy Paid</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>

				<div class="col-sm-12 col-md-8 col-xl-6 mg-t-20">

						<a class="modal-effect btn btn-outline-primary btn-block"  href="{{route('bills.create')}}">Add New Bill</a>

				</div>


							
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap">
										<thead>
  											<tr>
												<th class="border-bottom-0">Id</th>
												<th class="border-bottom-0">Bill_Number</th>
												<th class="border-bottom-0">Date</th>
												<th class="border-bottom-0">Due_Date</th>
												<th class="border-bottom-0">Product</th>
												<th class="border-bottom-0">Category </th>
												<th class="border-bottom-0">Amount_Collection</th>
												<th class="border-bottom-0">Amount_Commission</th>
												<th class="border-bottom-0">Discount</th>
												<th class="border-bottom-0">Value_VAT</th>
												<th class="border-bottom-0">Rate_VAT</th>
												<th class="border-bottom-0">Total</th>
												<th class="border-bottom-0">Status</th>
												<th class="border-bottom-0">Note</th>
												<th class="border-bottom-0">User</th>
												<th class="border-bottom-0">Details</th>
												<th class="border-bottom-0">Control</th>
												<th class="border-bottom-0">Delete</th>
												<th class="border-bottom-0">Status</th>
											</tr>
										</thead>
										<tbody>

										@foreach($data as $bill) 
											<tr>
												<td>{{$bill->id}}</td>
												<td>{{$bill->bill_number}}</td>
												<td>{{$bill->date}}</td>
												<td>{{$bill->due_date}}</td>
												<td>{{$bill->product}}</td>
												<td>{{$bill->Category->name}}</td>
												<td>{{$bill->amount_collection}}</td>
												<td>{{$bill->amount_commission}}</td>
												<td>{{$bill->discount}}</td>
												<td>{{$bill->value_VAT}}</td>
												<td>{{$bill->rate_VAT}}</td>
												<td>{{$bill->total}}</td>
												<td>
													@if($bill->value_status == 2)
													<span class='alert alert-danger'>{{$bill->status}}</span>
													@elseif($bill->value_status == 1)
													<span class='alert alert-success'>{{$bill->status}}</span>
													@elseif ($bill->value_status == 3)
													<span class='alert alert-info'>{{$bill->status}}</span>
													@endif
												</td>
												<td>
														@if($bill->note)
														{{$bill->note}}
														@else
														<span>--</span>							@endif
												</td>		
												<td>{{$bill->user}}</td>
												<td><a class="btn btn-secondary btn-sm" href="{{url('details' , $bill->id)}}">More Details</a></td>
												<td>										
													<a class="btn btn-warning-gradient btn-sm" href="{{route('bills.edit' , $bill->id)}}">Edit</a>
												</td>
												<td>
							<!-- delete -->     				
                           			   				<a class="btn btn-danger-gradient btn-sm" href="#" data-invoice_id="{{ $bill->id }}"
                               						 data-toggle="modal" data-target="#delete_invoice">&nbsp;&nbsp;Delete</a>
							<!-- End delete -->
       											</td>
       											<td>	
													<a class="btn btn-warning-gradient btn-sm" href="{{url('changeStatus' , $bill->id)}}">Change Payment status</a>
												</td>
       											</tr>
										@endforeach
          								</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
											
												
                                                   
											
												




				<!-- Delete -->
    <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Bill Delete </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('bills.destroy', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                </div>
                <div class="modal-body">
                    ?are you sure you want to delete this bill 
                    <input type="hidden" name="invoice_id" id="invoice_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
   			 <!-- End Delete -->


					<!--/div-->

		<!-- main-content closed -->
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


    <script>
        $('#delete_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })

    </script>

@endsection
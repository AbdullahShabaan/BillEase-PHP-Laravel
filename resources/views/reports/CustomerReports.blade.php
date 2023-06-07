@extends('layouts.master')
@section('css')
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">

    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Customer Reports</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Search</span>
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

<div class="card-header pb-0">

                <form action='{{url("CustomerSearch")}}' role="search" autocomplete="off" method="post">

                	@csrf
   

                    <div class="row">

                        <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="category">
                            <p class="mg-b-10">Select Category</p><select class="form-control select2" name="category"
                                required onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option value="" selected disabled>Select Category</option>
                                @foreach($category as $cat)                           
                                <option 
                                value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach

                            </select>
                        </div><!-- col-4 -->

                          <div class="col">
                                <label for="inputName" class="control-label">product</label>
                                <select id="product" name="product" class="form-control select2"> 
                                	<option disabled selected> Select Product </option>                               
                                </select>
                          </div>

                         


          

                        <div class="col-lg-3" id="start_at">
                            <label for="exampleFormControlSelect1">From </label>
                            <div class="input-group">
                                <input class="form-control fc-datepicker" 
                                    name="start_at" value="{{$start_at ?? ''}}" placeholder="YYYY-MM-DD" type="date">
                            </div><!-- input-group -->
                        </div>

                        <div class="col-lg-3" id="end_at">
                            <label for="exampleFormControlSelect1">To </label>
                            <div class="input-group">
                                <input class="form-control fc-datepicker" name="end_at"
                                  value="{{$end_at ?? ''}}" placeholder="YYYY-MM-DD" type="date">
                            </div><!-- input-group -->
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-sm-3 col-md-3">
                            <button class="btn btn-outline-primary btn-block">Search</button>
                        </div>
                    </div>
                </form>

            </div>
<!-- if -->
	@if(isset($data)) 


					
					<!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Total Bills</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
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
												<th class="border-bottom-0">Payment Status</th>
												<th class="border-bottom-0">Note</th>
												<th class="border-bottom-0">User</th>
												@can('bill-details')
												<th class="border-bottom-0">Details</th>
												@endcan
												@can('bill-edit')
												<th class="border-bottom-0">Control</th>
												@endcan
												@can('bill-delete')
												<th class="border-bottom-0">Delete</th>
												@endcan
												@can('bill-payment')
												<th class="border-bottom-0">Status</th>
												@endcan
												@can('bill-print')
												<th class="border-bottom-0">Print</th>
												@endcan
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
												@can('bill-details')	
												<td><a class="btn btn-secondary btn-sm" href="{{url('details' , $bill->id)}}">More Details</a></td>
												@endcan
												@can('bill-edit')
												<td>										
													<a class="btn btn-warning-gradient btn-sm" href="{{route('bills.edit' , $bill->id)}}">Edit</a>
												</td>
												@endcan
												@can('bill-delete')
												<td>
							<!-- delete -->     				
                           			   				<a class="btn btn-danger-gradient btn-sm" href="#" data-invoice_id="{{ $bill->id }}"
                               						 data-toggle="modal" data-target="#delete_invoice">&nbsp;&nbsp;Delete</a>
							<!-- End delete -->
       											</td>
       											@endcan
       											@can('bill-payment')
       											<td>	
													<a class="btn btn-warning-gradient btn-sm" href="{{url('changeStatus' , $bill->id)}}">Change Payment status</a>
												</td>
												@endcan
												@can('bill-print')
												<td>	
													<a class="btn btn-purple btn-sm" href="{{url('printBill'  , $bill->id)}}">Print</a>
												</td>
												@endcan
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
			

@endif

				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->

		<!-- main-content closed -->
		</div>
<!-- end if -->
@endsection
@section('js')
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

<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal Select2.min js -->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Ion.rangeSlider.min js -->
<script src="{{ URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
<!-- Ionicons js -->
<script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
<!--Internal  pickerjs js -->
<script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
   <script>
        $(document).ready(function() {
            $('select[name="category"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('cat') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });

    </script> 
@endsection
@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
@include('sweetalert::alert')

				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Bills</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Bill Details</span>
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
<br>
<br>
<br>
<div class="d-md-flex ">
   <div class="">
      <div class="panel panel-primary tabs-style-4">
         <div class="tab-menu-heading">
            <div class="tabs-menu ">
               <!-- Tabs -->
               <ul class="nav panel-tabs">
                  <li class=""><a href="#tab21" class="active" data-toggle="tab">Details </a></li>
                  <li><a href="#tab22" data-toggle="tab"> Status </a></li>
                  <li><a href="#tab23" data-toggle="tab"> Attachements </a></li>
 
               </ul>
            </div>
         </div>
      </div>
   </div>
   <div class="tabs-style-4">
      <div class="panel-body tabs-menu-body">
         <div class="tab-content">
            <div class="tab-pane active" id="tab21">

					<ul>
  						@error('pic')
    						<li class="alert alert-danger">{{ $message }}</li>
						@enderror
					</ul>

 										<div class="table-responsive mg-t-40">
										<table class="table table-invoice border text-md-nowrap mb-0">
											<thead>
												<tr>
													<th class="wd-20p">ID</th>
													<th class="wd-40p">Bill_Number</th>
													<th class="tx-center">Product</th>
													<th class="tx-right">Category</th>
													<th class="tx-right">User</th>
													<th class="tx-right">Notes</th>
													<th class="tx-right">Created_At</th>
													<th class="tx-right">Updated_At</th>
													<th class="tx-right">Status</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>{{$detailAll->bill_id}}</td>
													<td class="tx-12">{{$detailAll->bill_number}}</td>
													<td class="tx-center">{{$detailAll->product}}</td>
													<td class="tx-right">{{$detailAll->Category->name}}</td>
													<td class="tx-right">{{$detailAll->user}}</td>
													<td class="tx-right">
														@if($detailAll->notes)
														{{$detailAll->notes}}
														@else
														---
														@endif
													</td>
													<td class="tx-right">{{$detailAll->created_at}}</td>
													<td class="tx-right">{{$detailAll->updated_at}}</td>
													<td>
													@if($detailAll->status == 2)
														<span class='alert alert-danger'><b>UnPaid</b></span>
													@elseif($detailAll->status == 1)
														<span class='alert alert-success'><b>Paid</b></span>
													@elseif ($detailAll->status == 3)
														<span class='alert alert-info'><b>PartialyPaid</b></span>
													@endif
												</td>
													<td class="tx-right"></td>
												</tr>
												
											</tbody>
										</table>
									</div>
            </div>
            <div class="tab-pane" id="tab22">
  			<div class="table-responsive mg-t-40">
										<table class="table table-invoice border text-md-nowrap mb-0">
										<thead>
												<tr>
													<th class="wd-20p">Bill_Number</th>
													<th class="wd-20p">Created_By</th>
													<th class="wd-20p">Created_At</th>
													<th class="wd-20p">Payment_At</th>
													<th class="wd-20p">Status</th>
												</tr>
										</thead>
										<tbody>
													@foreach($details as $detail)
											<tr>
													<td>{{$detail->bill_number}}</td>
													<td>{{$detail->user}}</td>
													<td>{{$detail->created_at}}</td>
													<td>{{$detail->payment_at}}</td>
												<td>
													@if($detail->status == 2)
														<span class='alert alert-danger'><b>UnPaid</b></span>
													@elseif($detail->status == 1)
														<span class='alert alert-success'><b>Paid</b></span>
													@elseif ($detail->status == 3)
														<span class='alert alert-info'><b>PartialyPaid</b></span>
													@endif
												</td>
											</tr>
													@endforeach
												
											</tbody>
										</table>
									</div>
            </div>

      <div class="tab-pane" id="tab23">
			<div class="table-responsive mg-t-40">
										<table class="table table-invoice border text-md-nowrap mb-0">
										<thead>
												<tr>
													<th class="wd-20p">Updated_At</th>
													<th class="wd-20p">Created_By</th>
													<th class="wd-20p">File_Name</th>
													<th class="wd-20p">Show</th>
													<th class="wd-20p">Download</th>
													<th class="wd-20p">Delete</th>
												</tr>
										</thead>
										<tbody>
	
            	@foreach($file as $d)
											<tr>
             			<td>{{$d->created_at}}</td>
             			<td>{{$d->created_by}}</td>
             			<td>{{$d->file_name}}</td>
  	

  							<td><a class='alert alert-info' href="{{url('openFile')}}/{{$d->file_name}}">Show</a></td>

							<td>
								<a class='alert alert-success' href="{{url('downloadFile')}}/{{$d->file_name}}">Download</a>
							</td>

							<td><a class='alert alert-danger' href="{{url('DeleteFile')}}/{{$d->file_name}}">Delete</a></td>


												
  										</tr>
  					@endforeach
											</tbody>
										</table>
									</div>




				<div class="col-sm-12 col-md-6 col-xl-6 mg-t-20">

						<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-sign" data-toggle="modal" href="#modaldemo8">Add New Attachement</a>
				</div>


						<!-- Modal effects -->

	<div class="modal" id="modaldemo8">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Add File</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
				<form method="post" enctype="multipart/form-data" action="{{route('Attachement.store')}}" >
					@csrf
					@foreach ($details as $file)
  						<div class="mb-3">
    						<input value="{{$file->bill_number}}" name="bill_number" type="hidden" class="form-control" >
  						</div>


  						<div class="mb-3">
    						<input value="{{$file->bill_id}}" name="bill_id" type="hidden" class="form-control" >
  						</div>
						
  					@endforeach

  					   <p class="text-danger">*  Attachment Format pdf, jpeg ,.jpg , png </p>
                  <h5 class="card-title">Files</h5>

                 <div class="col-sm-12 col-md-12">
                      <input type="file" name="pic" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                data-height="70" />
                 </div><br>
  						
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

@endsection






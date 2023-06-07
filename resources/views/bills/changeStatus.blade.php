@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Bills</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ add new bill</span>
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
			 <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form   
                        autocomplete="off" method="post" action="{{url('updateStatus' , $bill->id)}}">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">bill number</label>
                                <input type="text"  readonly class="form-control" id="inputName" value="{{$bill->bill_number}}" name="bill_number"
                                    placeholder="Enter bill number" required>
                            </div>

                            <div class="col">
                                <label>Date</label>
                                <input class="form-control fc-datepicker" readonly name="date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $bill->date }}" required>
                            </div>

                            <div class="col">
                                <label>Due Date</label>
                                <input class="form-control fc-datepicker" readonly name="due_date" placeholder="YYYY-MM-DD" value="{{$bill->due_date}}"
                                    type="text" required>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Category</label>
                                <select readonly name="category" class="form-control SlectBox" >
                                    <!--placeholder-->
                                        <option 
                                        @if( $category->id == $bill->category_id)
                                        selected
                                        @endif
                                         value="{{ $category->id }}"> {{ $category->name }}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">product</label>
                                <select readonly id="product" name="product" class="form-control">
                                    <option 
                                        
                                        selected
                                        
                                         value="{{$bill->product}}">{{$bill->product}}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Collected Amount</label>
                                <input readonly placeholder="0" type="text" class="form-control" id="inputName" name="collected_amount" value="{{$bill->amount_collection}}"
                                    >
                            </div>
                        </div>



                        <div class="row">

                        <div class="col">
                                <label for="inputName" class="control-label">مبلغ العمولة</label>
                                <input readonly type="text" class="form-control form-control-lg" id="Amount_Commission"
                                    value="{{$bill->amount_commission}}"
                                    name="Amount_Commission" title="يرجي ادخال مبلغ العمولة "
                                    >
                            </div>
                            

                            <div class="col">
                                <label for="inputName" class="control-label">الخصم</label>
                                <input readonly type="text" class="form-control form-control-lg" id="Discount" name="Discount"
                                value="{{$bill->discount}}"
                                  >
                            </div>

                             <div class="col">
                                <label for="inputName" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                <select readonly name="Rate_VAT" id="Rate_VAT" class="form-control" 
                                    <option 
                                    @if($bill->rate_VAT == '5%')
                                    selected
                                    @endif
                                    value="5%">5%</option>
                                    <option 
                                    @if($bill->rate_VAT == '10%')
                                    selected
                                    @endif
                                    value="10%">10%</option>
                                </select>
                            </div>

                        </div>

	                  <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                <input readonly type="text" class="form-control" id="Value_VAT"
                                value="{{$bill->value_VAT}}" name="Value_VAT" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                                <input readonly type="text" class="form-control" id="Total" value="{{$bill->total}}" name="Total" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">notes</label>
                                <input readonly type="Textarea" class="form-control" id="exampleTextarea" name="note" value="{{$bill->note}}" rows="3">
                            </div>

                        </div><br>
                                                  
                        <div class="col">
                                <label for="inputName" class="control-label alert alert-success">Payment Status </label>
                                <select readonly  name="status" class="form-control">
                                    <option value='Paid'>Paid</option>
                                    <option value='UnPaid'>UnPaid</option>
                                    <option value='PartialyPaid'>Partialy Paid</option>
                                </select>
                            </div>
                         <br>
                                    <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text ">
                                                    Payment Date:
                                                </div>
                                            </div><input class="form-control" name="payment_at" id="dateMask" placeholder="YYYY/MM/DD" type="text">
                                        </div>
                                    </div>

                        @error('payment_at')
                            <li class="alert alert-danger">{{ $message }}</li>
                        @enderror

                      
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')

 



@endsection
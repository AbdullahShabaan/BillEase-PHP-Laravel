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
                    <form   enctype="multipart/form-data"
                        autocomplete="off" method="post" action="{{route('bills.update' , $bill->id)}}">
                        @csrf
                        @method("PUT")
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">bill number</label>
                                <input type="text" class="form-control" id="inputName" value="{{$bill->bill_number}}" name="bill_number"
                                    placeholder="Enter bill number" required>
                            </div>

                            <div class="col">
                                <label>Date</label>
                                <input class="form-control fc-datepicker" name="date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $bill->date }}" required>
                            </div>

                            <div class="col">
                                <label>Due Date</label>
                                <input class="form-control fc-datepicker" name="due_date" placeholder="YYYY-MM-DD" value="{{$bill->due_date}}"
                                    type="text" required>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Category</label>
                                <select name="category" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    @foreach ($category as $cat)
                                        <option 
                                        @if( $cat->id == $bill->category_id)
                                        selected
                                        @endif
                                         value="{{ $cat->id }}"> {{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">product</label>
                                <select  id="product" name="product" class="form-control">
                                    <option 
                                        
                                        selected
                                        
                                         value="{{$bill->product}}">{{$bill->product}}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Collected Amount</label>
                                <input placeholder="0" type="text" class="form-control" id="inputName" name="collected_amount" value="{{$bill->amount_collection}}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>



                        <div class="row">

                        <div class="col">
                                <label for="inputName" class="control-label">مبلغ العمولة</label>
                                <input type="text" class="form-control form-control-lg" id="Amount_Commission"
                                    value="{{$bill->amount_commission}}"
                                    name="Amount_Commission" title="يرجي ادخال مبلغ العمولة "
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required>
                            </div>
                            

                            <div class="col">
                                <label for="inputName" class="control-label">الخصم</label>
                                <input type="text" class="form-control form-control-lg" id="Discount" name="Discount"
                                value="{{$bill->discount}}"
                                    title="يرجي ادخال مبلغ الخصم "
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value=0 required>
                            </div>

                             <div class="col">
                                <label for="inputName" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                <select name="Rate_VAT" id="Rate_VAT" class="form-control" onchange="myFunction()">
                                    <!--placeholder-->
                                    <option value="" selected disabled>حدد نسبة الضريبة</option>
                                    <option value=" 5%">5%</option>
                                    <option value="10%">10%</option>
                                </select>
                            </div>

                        </div>

	                  <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                <input type="text" class="form-control" id="Value_VAT" name="Value_VAT" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                                <input type="text" class="form-control" id="Total" name="Total" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">notes</label>
                                <input  type="Textarea" class="form-control" id="exampleTextarea" name="note" value="{{$bill->note}}" rows="3">
                            </div>

                        </div><br>

                        <p class="text-danger">* If you don't want to change attachement file leave it blank.<br> Attachment Format pdf, jpeg ,.jpg , png </p>
                        <h5 class="card-title">المرفقات</h5>

                        <div class="col-sm-12 col-md-12">
                            @if($oldFile)
                            <input type="hidden" name='oldFile' value='{{$oldFile->file_name}}'>
                            @endif
                            <input type="file" name="pic"  class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                data-height="70" />
                        </div><br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                        </div>
                    <ul>
                        @error('bill_number')
                            <li class="alert alert-danger">{{ $message }}</li>
                        @enderror


                        @error('due_date')
                            <li class="alert alert-danger">{{ $message }}</li>
                        @enderror

                        @error('date')
                            <li class="alert alert-danger">{{ $message }}</li>
                        @enderror

                        @error('product')
                            <li class="alert alert-danger">{{ $message }}</li>
                        @enderror

                        @error('Rate_VAT')
                            <li class="alert alert-danger">{{ $message }}</li>
                        @enderror

                        @error('Amount_Commission')
                            <li class="alert alert-danger">{{ $message }}</li>
                        @enderror

                        @error('collected_amount')
                            <li class="alert alert-danger">{{ $message }}</li>
                        @enderror

                        @error('pic')
                            <li class="alert alert-danger">{{ $message }}</li>
                        @enderror

                    </ul>

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

    <script>
        function myFunction() {

            var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
            var Discount = parseFloat(document.getElementById("Discount").value);
            var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
            var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);

            var Amount_Commission2 = Amount_Commission - Discount;


            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {

                alert('يرجي ادخال مبلغ العمولة ');

            } else {
                var intResults = Amount_Commission2 * Rate_VAT / 100;

                var intResults2 = parseFloat(intResults + Amount_Commission2);

                sumq = parseFloat(intResults).toFixed(2);

                sumt = parseFloat(intResults2).toFixed(2);

                document.getElementById("Value_VAT").value = sumq;

                document.getElementById("Total").value = sumt;

            }

        }

    </script>



@endsection
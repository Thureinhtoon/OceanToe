@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class=" align-items-center">
       <h1 class="h3">{{translate('Inhouse Product sale report')}}</h1>
	</div>
</div>

<div class="col-md-8 mx-auto">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('in_house_sale_report.index') }}" method="GET">
                <div class="form-group row offset-lg-2">
                    <label class="col-md-3 col-form-label">{{translate('Sort by Category')}} :</label>
                    <div class="col-md-5">
                        <select id="demo-ease" class="aiz-selectpicker" name="category_id" required>
                            @foreach (\App\Category::all() as $key => $category)
                                <option value="{{ $category->id }}" @if($category->id == $sort_by) selected @endif >{{ $category->getTranslation('name') }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="cil-md-2">
                        <button class="btn btn-light" type="submit">{{ translate('Filter') }}</button>
                    </div>
                </div>
            </form>

            {{-- <table class="table table-bordered aiz-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ translate('Product Name') }}</th>
                        <th>{{ translate('Num of Sale') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                        <tr>
                            <td>{{ ($key+1) + ($products->currentPage() - 1)*$products->perPage() }}</td>
                            <td>{{ $product->getTranslation('name') }}</td>
                            <td>{{ $product->num_of_sale }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

@endsection --}}

   <form class="" action="" method="GET">
        <div class="card-header row gutters-5">
          <div class="col text-center text-md-left">
            <h5 class="mb-md-0 h6">{{ translate('All Orders') }}</h5>
          </div>
          <div class="col-lg-2">
              <div class="form-group mb-0">
                  <input type="text" class="aiz-date-range form-control" value="{{ $date }}" name="date" placeholder="{{ translate('Filter by date') }}" data-format="DD-MM-Y" data-separator=" to " data-advanced-range="true" autocomplete="off">
              </div>
          </div>
          <div class="col-lg-2">
            <div class="form-group mb-0">
              <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type Order code & hit Enter') }}">
            </div>
          </div>
          <div class="col-auto">
            <div class="form-group mb-0">
              <button type="submit" class="btn btn-primary">{{ translate('Filter') }}</button>
            </div>
          </div>
        </div>
    </form>

            <table class="table table-bordered aiz-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ translate('Product Name') }}</th>
                        <th>{{ translate('Num of Sale') }}</th>
                        <th>{{translate('Total')}}</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($orderme as $key => $order)
                 
                        <tr>
                            <td>{{ ($key+1)}}</td>
                            {{-- <td>{{ ($key+1) + ($order->currentPage() - 1)*$order->perPage() }}</td> --}}
                            {{-- @foreach($bb as $b)
                            
                            @endforeach
                           @if($order->name === "Shirt3" )
                           
                            <td>OK</td>
                            @endif --}}
                            
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{($order->price * $order->quantity)}}</td>
                        </tr>
                    @endforeach
                     <tr>
                            <td colspan="2">Total</td>
                            
                            <td>{{ $orderme->sum('quantity')}}</td>
                            
                            <td>{{$orderme->sum('tot')}}</td>
                              
                        </tr>
                </tbody>
            </table>
            {{-- <div class="aiz-pagination mt-4">
                {{ $orders->links() }}
            </div> --}}
              <div class="text-right no-print">
                    <a href="{{ route('inhouse.invoice.download') }}" type="button" class="btn btn-icon btn-light"><i class="las la-print"></i></a>
                </div>

            <div class="aiz-pagination">
            {{ $orders->appends(request()->input())->links() }}
        </div>
    </div>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection 

 @section('script')
    <script type="text/javascript">
        function sort_orders(el){
            $('#sort_orders').submit();
        }
    </script>
    
@endsection

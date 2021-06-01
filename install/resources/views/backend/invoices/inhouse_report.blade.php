<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	

	<!-- aiz core css -->
	<link rel="stylesheet" href="{{ static_asset('assets/css/vendors.css') }}">
    
	<link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.css') }}">
	<style media="all">
	
	        *{
	            margin: 0;
	            padding: 0;
	            line-height: 1.3;
	            font-family: 'Hind Siliguri','Roboto';
	            color: #333542;
	        }
       
	       
        
		body{
			font-size: .875rem;
		}
		.gry-color *,
		.gry-color{
			color:#878f9c;
		}
		table{
			width: 100%;
		}
		table th{
			font-weight: normal;
		}
		table.padding th{
			padding: .5rem .7rem;
		}
		table.padding td{
			padding: .7rem;
		}
		table.sm-padding td{
			padding: .2rem .7rem;
		}
		.border-bottom td,
		.border-bottom th{
			border-bottom:1px solid #eceff4;
		}
		.text-left{
			text-align:left;
		}
		.text-right{
			text-align:right;
		}
		.small{
			font-size: .85rem;
		}
		.currency{

		}
	</style>
</head>
<body>
	 <div style="background: #eceff4;padding: 1.5rem;">
			<table>
				<tr>
					<td>
							<img loading="lazy"  src="{{ static_asset('assets/img/logo.png') }}" height="40" style="display:inline-block;">
						
					</td>
					<td style="font-size: 2.5rem;" class="text-right strong">{{  translate('INVOICE') }}</td>
				</tr>
			</table>
    <table  class="table table-bordered" style="border-color:white;">
				<thead>
	                <tr class="gry-color" style="background: #eceff4;">
                        <th>{{ translate('Product No') }}</th>
	                    <th>{{ translate('Product Name') }}</th>
						<th>{{ translate('Number Of Sales') }}</th>
	                    <th>{{ translate('Total') }}</th>
	                </tr>
				</thead>

                <tbody class="strong">
						
                            {{-- <td>{{ $order->name }}</td> --}}
							
							
	                 @foreach ($orderme as $key => $order)
                        <tr>
                            <td>{{ ($key+1)}}</td>
							
                            <td>{{ $order->name }}</td>
							
                            <td>{{ $order->quantity }}</td>
                            <td>{{($order->price * $order->quantity)}}</td>
                        </tr>
                    @endforeach
	            </tbody>
                <tfoot>
                    <tr>
                            <td colspan="2">Total</td>
                            
                            <td> {{ $orderme->sum('quantity')}}</td>
                            
                            <td>{{$orderme->sum('tot')}}</td>
                              
                        </tr>
                </tfoot>

    </table>

	</div> 
</body>
</html>

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">

    </script>
@endsection
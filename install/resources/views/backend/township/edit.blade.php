@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <form action="{{url('township/'.$township->id.'/update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    {{-- <div class="form-group">
                        <label for="township">Township</label>
                        <select name="township_id" class="form-control @error('township_id')is-invalid @enderror" id="township">
                            <option value="">Select Township</option>
                            @foreach ($townships as $township )
                                 <option value="{{$township->id}}">{{$township->name}}</option>
                            @endforeach
                         </select>  
                         
                        </div> --}}
                         <div class="form-group">
                        <label for="township_id">Name</label>
                    <input type="text" name="township_id" class="form-control @error('township_id') is-invalid @enderror" placeholder="Enter Post Title" value="{{$township->name}}">
                        @error('township_id')
                        <span class="text-danger"><small>{{$message}}</small></span>
                        @enderror
                        
                    </div>
                        
                        
                    

                    
                    <div class="form-group">
                        <label for="price">Price</label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Enter Post Title" value="{{$township->delivery_price}}">
                        @error('price')
                        <span class="text-danger"><small>{{$message}}</small></span>
                        @enderror
                        
                    </div>
                     <input type="submit" class="btn btn-primary mt-2" value="Update">
                </form>
            </div>
        </div>
    </div>
@endsection
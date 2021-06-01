@extends('backend.layouts.app')

@section('content')
 
           @if(Session('message'))
           <div class="alert alert-success alert-dismissible fade show">
             <div>{{Session('message')}}</div>
             <button class="close" data-dismiss="alert">&times;</button>
           </div>
           

           @endif
        <a href="{{route('township.create')}}" class="btn btn-primary mb-2 float-right">Create</a>
           <table class="table table-bordered table-hover">
             <thead>
               <tr>
                 <th>ID</th>
                 <th>Name</th>
                 <th>Price</th>
                 
                 <th>Action</th>
               </tr>
             </thead>

              <tbody>
               @foreach ( $townships as $township)
               <tr>
                    <td>{{$township->id}}</td>
                    <td>{{$township->name}}</td>
                    <td>{{$township->delivery_price}}</td>
                    
                   
                    <td>
                   
                      {{-- <form action="{{route('township.delete'.$township->id)}}" method="POST">
                        @csrf 
                        @method('DELETE')
                      <a href="{{route('township.edit'.$township->id)}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i>Edit</a>
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?');"><i class="fas fa-trash"></i>Delete</button>
                      
                      </form> --}}
                      <form action="{{url('township/'.$township->id.'/delete')}}" method="POST">
                        @csrf 
                        @method('DELETE')
                      <a href="{{url('township/'.$township->id.'/edit')}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i>Edit</a>
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?');"><i class="fas fa-trash"></i>Delete</button>
                      
                      </form>
                    
                  
                  </td>
                 
                </tr> 
               @endforeach
               
             </tbody>
           </table>
      
@endsection

@extends('admin.layout.master')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12 col-xl-10">
      <div class="card card-default">
        <div class="card-header">
           <strong class="card-title">{{$page_name}}</strong>
       </div>

        <div class="card-body">

          <div id="permission-page">

           @if(count($errors)> 0)
              <div class="alert alert-danger alert-block">
                 <ul>@foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                     @endforeach
                 </ul>
             </div>
           @endif

             <div class="card-body">


                 {!! Form::model($permission,['route' => ['permission-update', $permission->id],'method' => 'put']) !!}


                     <div class="form-group">
                         {!! Form::label('Name', 'name', array('class' => 'control-label mb-1')) !!}
                         {!! Form::text('name', null, ['class' => 'form-control','id' => 'name']) !!}
                     </div>

                  <div class="form-group">
                         {!! Form::label('Display Name', 'guard_name', array('class' => 'control-label mb-1')) !!}
                         {!! Form::text('guard_name', null, ['class' => 'form-control','id' => 'guard_name']) !!}
                     </div>

                 <div class="form-group">
                         {!! Form::label('Permission_description', 'permission_description', array('class' => 'control-label mb-1')) !!}
                         {!! Form::textarea('permission_description', null, ['class' => 'form-control','id' => 'permission_description']) !!}
                     </div>

                     <div class="form-group">
                         <button id="submit-role" type="submit" class="btn btn-info btn-lg">Update</button>
                     </div>

                 {!! Form::close() !!}


             </div>
         </div>

        </div>
       </div> <!-- .card -->
      </div>
    </div>
</div>

@endsection

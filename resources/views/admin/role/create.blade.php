

@extends('admin.layout.master')
@section('content')

<link rel="stylesheet" href="{{asset('public/admin/assets/css/lib/chosen/chosen.min.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{asset('public/admin/assets/js/lib/chosen/chosen.jquery.min.js')}}"></script>


<script>
    $( document ).ready(function() {
        console.log( "document loaded" );

        $(".myselect-select").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "100%"
        });
    });

</script>


<div class="container">
<div class="row">
  <div class="col-md-10">
    <div class="card">
      <div class="card-header">
            <strong class="card-title">{{$page_name}}</strong>


        </div>
      <div class="card-body">

           <div id="permission-page">

             @if(count($errors)> 0)
                <div class="alert alert-danger alert-block" role="alert">
                   <ul>@foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                       @endforeach

                   </ul>

               </div>
             @endif

               <div class="card-body">


                   {!! Form::open(array('url' => 'back/roles/store','method' => 'post')) !!}



                       <div class="form-group">
                           {!! Form::label('Name', 'Name', array('class' => 'control-label mb-1')) !!}
                           {!! Form::text('name', null, ['class' => 'form-control','id' => 'name']) !!}
                       </div>

                    <div class="form-group">
                           {!! Form::label('Display Name', 'Guard_name', array('class' => 'control-label mb-1')) !!}
                           {!! Form::text('guard_name', null, ['class' => 'form-control','id' => 'guard_name']) !!}
                       </div>

                   <div class="form-group">
                           {!! Form::label('Role_description', 'Role_description', array('class' => 'control-label mb-1')) !!}
                           {!! Form::textarea('description', null, ['class' => 'form-control','id' => 'permission_description']) !!}
                    </div>

                   <div class="form-group">
                        {!! Form::label('Permission_select', 'Permission', array('class' => 'control-label mb-1')) !!}
                        {{ Form::select('permissions[]',$permission,null,['class'=>'form-control myselect-select','data-placeholder'=>'Select Permissions', 'multiple'] )}}
                    </div>

                       <div class="form-group">
                           <button id="submit-role" type="submit" class="btn btn-info btn-lg">
                               SUBMIT
                           </button>
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

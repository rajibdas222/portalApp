
@extends('admin.layout.master')
@section('content')

    <link rel="stylesheet" href="{{asset('public/admin/assets/css/lib/chosen/chosen.min.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{asset('public/admin/assets/js/lib/chosen/chosen.jquery.min.js')}}"></script>

    <script>
        $( document ).ready(function() {
            $(".myselect_select").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
        });

    </script>

    <div class="container-fluid">
  <div class="row">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
              <strong class="card-title">Author Create</strong>


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


                     {!! Form::open(array('url' => 'back/author/store','method' => 'post')) !!}


                         <div class="form-group">
                             {!! Form::label('name', 'Name', array('class' => 'control-label mb-1')) !!}
                             {!! Form::text('name', null, ['class' => 'form-control','id' => 'author_name']) !!}
                         </div>

                      <div class="form-group">
                             {!! Form::label('email', 'Email', array('class' => 'control-label mb-1')) !!}
                             {!! Form::text('email', null, ['class' => 'form-control','id' => 'author_email']) !!}
                         </div>



                     <div class="form-group">
                         {!! Form::label('password', 'Password',array('class' => 'control-label mb-1')) !!}
                         {!! Form::password('password', ['class' => 'form-control','id' => 'author_password']) !!}

                     </div><br>


                     <div class="form-group">
                         {!! Form::label('roles', 'Roles', array('class' => 'control-label mb-1')) !!}
                         {{ Form::select('roles[]',$roles,null,['class'=>'form-control myselect_select','data-placeholder'=>'Select Roles', 'multiple'] )}}
                     </div>

                         <div class="form-group">
                             <button id="submit-author" type="submit" class="btn btn-info btn-lg">SUBMIT</button>
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

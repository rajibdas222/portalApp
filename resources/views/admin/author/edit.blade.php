
@extends('admin.layout.master')
@section('content')

    <link rel="stylesheet" href="{{asset('public/admin/assets/css/lib/chosen/chosen.min.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{asset('public/admin/assets/js/lib/chosen/chosen.jquery.min.js')}}"></script>



    <script>
        $(document).ready(function () {
            console.log("document loaded");

            $(".myselect-select").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
        });

    </script>

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


                 {!! Form::model($author,['route' => ['author-edit', $author->id],'method' => 'put']) !!}

                     <div class="form-group">
                         {!! Form::label('Name', 'name', array('class' => 'control-label mb-1')) !!}
                         {!! Form::text('name', null, ['class' => 'form-control','id' => 'name']) !!}
                     </div>

                  <div class="form-group">
                         {!! Form::label('Email', 'email', array('class' => 'control-label mb-1')) !!}
                         {!! Form::text('email', null, ['class' => 'form-control','id' => 'email']) !!}
                     </div>

                 <div class="form-group">
                     {{ Form::label('author', 'Author', array('class' => 'control-label mb-1')) }}

                     {{ Form::select('author[]',$user,$selectedUser,['class'=>'myselect-select','data-placeholder'=>'Select Rules(s)', 'multiple'] )  }}
                 </div>

                     <div class="form-group">
                         <button id="submit-author" type="submit" class="btn btn-info btn-lg">Update</button>
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

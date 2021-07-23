@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Post
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'patch', 'files' => true]) !!}

                        {{-- @include('posts.fields') --}}

                    <!-- Photo Field -->
                <div class="form-group col-sm-6">
                    <img src="{{asset('/upload/post/'.$post->photo)}}" style="width:150px;height:150px;" id="image" class="imagePreview img-thumbnail"><br>

                    <label class="btn btn-primary upload_btn" style="width: 150px">
                    Upload<input type="file" accept="image/png,image/jpeg,image/jpg" onchange="displaySelectedPhoto('upload_photo','image')" id="upload_photo" name="photo" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;" required>
                    </label>
                </div>
                <div class="clearfix"></div>

                <!-- Cat Id Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('cat_id', 'Cat Id:') !!}
                    {!! Form::select('cat_id', $categories, null, ['class' => 'form-control']) !!}
                </div>

                <!-- Title Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('title', 'Title:') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>

                <!-- Content Field -->
                <div class="form-group col-sm-12 col-lg-12">
                    {!! Form::label('content', 'Content:') !!}
                    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
                </div>

                <!-- Submit Field -->
                <div class="form-group col-sm-12">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('posts.index') }}" class="btn btn-default">Cancel</a>
                </div>


                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
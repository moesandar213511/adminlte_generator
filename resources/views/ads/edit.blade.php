@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Ads
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($ads, ['route' => ['ads.update', $ads->id], 'method' => 'patch', 'files' => true]) !!}

                        {{-- @include('ads.fields') --}}

                        <!-- Photo Field -->
<div class="form-group col-sm-6">
    {{-- {!! Form::label('photo', 'Photo:') !!}
    {!! Form::file('photo') !!} --}}
    <img src="{{asset('/upload/ads/'.$ads->photo)}}" style="width:150px;height:150px;" id="image" class="imagePreview img-thumbnail"><br>

    <label class="btn btn-primary upload_btn" style="width: 150px">
    Upload<input type="file" accept="image/png,image/jpeg,image/jpg" onchange="displaySelectedPhoto('upload_photo','image')" id="upload_photo" name="photo" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;" required>
    </label>
</div>
<div class="clearfix"></div>

<!-- Link Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Webpage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('webpage', 'Webpage:') !!}<br>
    @foreach($webpages as $data)
    {{-- <label class="checkbox-inline"> --}}
        {{-- {!! Form::hidden('webpage',  $data) !!} --}}
        {{-- {!! Form::checkbox('webpage[]',$data->id, ['class' => 'webpage_arr'] ) !!} --}}
        {{-- {{ $data->name}} --}}
    {{-- </label> --}}
    <div class="col-sm-3">
        <div class="form-group">
            <div class="custom-control custom-checkbox">
            <input type="checkbox" name="webpage_id[]" class="custom-control-input webpage_arr" id="" value="{{$data->id}}">
            <label class="custom-control-label" for="">{{$data->name}}</label>
            </div>
        </div>
    </div>
    @endforeach
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('ads.index') }}" class="btn btn-default">Cancel</a>
</div>

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection

@section('scripts')
    
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){

        edit();

        function edit(){
             var ads = {!! json_encode($edit_ads->toArray(), JSON_HEX_TAG) !!};
            // console.log(ads['webpages']);
        
            var web_arr = ads['webpages']; //fetch checked webpage with get() in db 
            //all data in db
            var arr = []; 
            var aa = $('.webpage_arr').length;
            console.log(aa);
            if (aa > 0){
                $('.webpage_arr').each(function(){
                    arr.push($(this).val());
                });
            }
            console.log(arr);

            //checked webpage
            var cb=document.getElementsByClassName('webpage_arr');
            for(var i = 0;i < arr.length;i++){

                if(check_contain(arr[i],web_arr)){
                    cb[i].checked=true;
                }
            }
        }

         function check_contain(value,arr){
                var boo=false;
                for(var i=0;i<arr.length;i++){
                    if(arr[i]==value){
                        boo=true;
                    }
                }
                return boo;
            }
            
    });
    
   
</script>

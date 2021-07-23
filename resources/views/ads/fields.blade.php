<!-- Photo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('photo', 'Photo:') !!}
    {!! Form::file('photo') !!}
</div>
<div class="clearfix"></div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Webpage Field -->
<div class="form-group col-sm-12">
    {!! Form::label('webpage', 'Webpage:') !!}
    @foreach($webpages as $data)
    {!! Form::checkbox('webpage[]',$data->id,null) !!}
    {{$data->name}}
    @endforeach
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('ads.index') }}" class="btn btn-default">Cancel</a>
</div>

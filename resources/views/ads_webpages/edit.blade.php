@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Ads Webpage
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($adsWebpage, ['route' => ['adsWebpages.update', $adsWebpage->id], 'method' => 'patch']) !!}

                        @include('ads_webpages.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
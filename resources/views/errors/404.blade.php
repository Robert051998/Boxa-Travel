@extends('template')

@section('main')
<main>
  <div class="container-fluid text-center mt-5 pt-5">
    <div class="row">
      <div class="col-12 error_width" >
        <div class="notfound w-100">
          <div class="notfound-404">
            <h2 class="mb-3">{{trans('messages.error.oops')}} {{trans('messages.error.unauthorized_action')}}</h2>
            <h1 class="mb-3"><span>4</span><span>0</span><span>4</span></h1>
          </div>
          <h3 class="text-center">{{trans('messages.error.error_data_1')}}  {{trans('messages.error.error_data_2')}}</h3>
        </div>
      </div>
    </div>
  </div>
</main>  
@stop

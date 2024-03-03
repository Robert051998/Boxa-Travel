@extends('template')
@section('main')

<main>
    <div class="row m-0">
        <!-- sidebar start-->
        @include('users.sidebar')
        <!--sidebar end-->
        <div class="col-xl-10 col-lg-9 min-height right-section p-0">
            <div class="container-fluid inner-content">
                <div class="row mb-3">
                    <div class="col-12">
						<h4 class="mb-4">My Profile</h4>
					</div>
                    <div class="col-md-12">
                        @include('users.profile_nav')

                        <!--Success Message -->
                        @if(Session::has('message'))
                            <div class="row">
                                <div class="col-md-12  alert {{ Session::get('alert-class') }} alert-dismissable fade in top-message-text opacity-1">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('message') }}
                                </div>
                            </div>
                        @endif

                        
                        <div class="row m-0 mt-5">
                            <div class="col-md-12 align-self-center form-group photo-upload text-center ">
                                @if($result->profile_image)
                                    <img class="mb-3" width="200" height="200" title="{{ Auth::user()->first_name }}" src="{{  $result->profile_image }}" alt="{{ $result->first_name }}">
                                @else
                                    <img class="mb-3" width="225" height="225" title="{{ Auth::user()->first_name }}" src="{{  \Auth::user()->profile_src }}" alt="{{ $result->first_name }}">
                                @endif
                                <form name="ajax_upload" method="post" id="ajax_upload" enctype="multipart/form-data" action="{{ url('/') }}/users/profile/media" accept-charset="UTF-8" >
                                    {{ csrf_field() }}
                                    <div class="file-upload">
                                        <input type="file" name="photos[]" id="profile_image" class="form-control ">
                                        <img src="{{URL::to('images/upload.png')}}" alt="Upload File"/>
                                    </div>
                                    <p class="fs-6 mt-3">{{trans('messages.users_media.photo_data')}}</p>
                                    <input type="submit" class="btn btn-large btn-photo btn vbtn-outline-success mb-3" value="upload">
                                    
                                    <iframe class="d-none" name="upload_frame" id="upload_frame"></iframe>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@push('scripts')
<script src="{{ url('js/jquery.validate.min.js') }}"></script>
<script src="{{ url('js/additional-method.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#ajax_upload').validate({
            rules: {
                'photos[]': {
                    accept: "image/jpg,image/jpeg,image/png,image/gif"
                }
            },
            messages: {
            'photos[]': {
                    accept: "{{ __('messages.jquery_validation.image_accept') }}",
                    }
            },
            errorElement : 'div',
            errorLabelContainer: '.errorTxt_p'
        });
    });
</script>
@endpush
@stop

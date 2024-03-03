@extends('template')
@section('main')
<main>
	<div class="row m-0">
        <!-- sidebar start-->
        @include('users.sidebar')
        <!--sidebar end-->
        <div class="col-xl-10 col-lg-9 min-height right-section">
            <div class="main-panel pro_listing">
                <div class="row ">
                    <div class="col-md-3 bg-lightgreen">
                        @include('listing.sidebar')
                    </div>

                    <div class="col-md-9 mb-5">
                        <div class="inner-main-panel">
                            <form id="img_form" enctype='multipart/form-data' method="post" action="{{url('listing/'.$result->id.'/'.$step)}}" accept-charset='UTF-8'>
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="mt-5 mb-5">{{trans('messages.listing_sidebar.photos')}}</h3>
                                        <div class="form-group photo-upload ">
                                            <div class="alert alert-danger m-0 mb-4 hide text-center" id="notice">
                                                <span class="text-center"></span>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            @if (session('success'))
                                                                <div class="alert alert-success m-0 mb-4 text-center">
                                                                    <span>{{ session('success') }}</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="row text-center">
                                                        <div class="col-12">
                                                            <div class="file-upload">
                                                                <input class="form-control" name="file" id="photo_file" type="file" value="">
                                                                <img src="{{URL::to('images/uploads.svg')}}" alt="Upload File"/>
                                                            </div>
                                                            <input type="hidden" id="photo" type="text" name="photos">
                                                            <input type="hidden" name="img_name" id="img_name">
                                                            <input type="hidden" name="crop" id="type" value="crop">
                                                            <p class="fs-6 mt-3">(Width 640px and Height 360px)</p>
                                                            <div id="result" class="hide"><img src="#" alt=""></div>
                                                            <button type="submit" class="btn btn-large btn-photo btn vbtn-outline-success mb-3" id="up_button" disabled>
                                                                <i class="spinner fa fa-spinner fa-spin d-none" id="up_spin"></i>
                                                                <span id="up_button_txt">{{ trans('messages.listing_description.upload') }}</span>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12">
                                                            @if ($errors->any() && !$errors->has('url'))
                                                                <div class="alert alert-danger text-center">
                                                                    <span class="text-center">{{ $errors->first() }}</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div id="photo-list-div" class="col-md-12 p-0">
                                                    <?php
                                                    $serial = 0;
                                                    ?>
                                                    <div class="row">
                                                        @foreach ($photos as $photo)
                                                            <?php
                                                            $serial++;
                                                            ?>
                                                            <div class="col-md-12 mt-5" id="photo-div-{{ $photo->id }}">
                                                                <div class="room-image-container200" style="background-image:url('{{ $photo->photo }}');">
                                                                    @if ($photo->cover_photo == 0)
                                                                        <a class="photo-delete text-right" href="javascript:void(0)" data-rel="{{ $photo->id }}">
                                                                            <p class="photo-delete-icon"><i class="fa fa-trash text-danger p-4"></i></p>
                                                                        </a>
                                                                    @endif
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12 form-group">
                                                                        <textarea data-rel="{{ $photo->id }}" class="form-control photo-highlights" placeholder="{{ trans('messages.listing_description.what_are_the_highlight') }}">{{ $photo->message }}</textarea>
                                                                    </div>
                                                                    <div class="col-md-12 form-group">
                                                                        <label for="sel1">{{ trans('messages.listing_description.serial') }}</label>
                                                                        <input type="text" image_id="{{ $photo->id }}" property_id="{{ $result->id }}" id="serial-{{ $photo->id }}" class="form-control serial" name="serial" value="{{ $photo->serial }}">
                                                                    </div>

                                                                    <div class="col-md-12 form-group">
                                                                        @if ($photo->cover_photo == 0)
                                                                            <label for="sel1">{{ trans('messages.listing_description.cover_photo') }}</label>
                                                                            <select class="form-control photoId" id="photoId">
                                                                                <option value="Yes" <?= $photo->cover_photo == 1 ? 'selected' : '' ?> image_id="{{ $photo->id }}" property_id="{{ $result->id }}">
                                                                                    {{ trans('messages.listing_description.yes') }}
                                                                                </option>
                                                                                <option value="No" <?= $photo->cover_photo == 0 ? 'selected' : '' ?> image_id="{{ $photo->id }}" property_id="{{ $result->id }}">
                                                                                    {{ trans('messages.listing_description.no') }}
                                                                                </option>
                                                                            </select>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                @if ($serial % 3 == 0)
                                                                    <div style="clear:both;">&nbsp;</div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="col-md-12 text-center">
                                                    <span class="text-danger display-off" id='photo'>{{ trans('messages.reviews.this_field_is_required') }}</span>
                                                </div>
                                            </div>

                                            <div style="clear:both;"></div>
                                        </div>
                                    </div>
                               
                            
                                    <div class="col-md-12 mt-5">
                                        <div class="row m-0 justify-content-between">
                                            <div class="">
                                                <a href="{{ url('listing/'.$result->id.'/amenities') }}" class="btn btn-outline-danger">
                                                    {{trans('messages.listing_description.back')}}
                                                </a>
                                            </div>

                                            <div class="">

                                                <a href="{{url('listing/'.$result->id.'/pricing')}}" class="btn vbtn-outline-success" id="btnnext"><i class="spinner fa fa-spinner fa-spin d-none" id="btn_spin"></i>
                                                    <span id="btnnext-text">{{trans('messages.listing_basic.next')}}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal crop-modal calender_modal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="background: white">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongTitle">{{ trans('messages.listing_description.edit_image') }}</h2>
                <button type="button" class="close" id="clode-modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div style="min-height: 70vh">
                    <canvas id="canvas">
                        {{trans('messages.listing_description.not_compatible')}}
                    </canvas>
                </div>
            </div>
            <div class="modal-footer p-3">
                <div class="row m-0 justify-content-between w-100">
                    <button type="button" id="restore" class="btn btn-outline-danger m-0" data-dismiss="modal">Skip</button>
                    <button type="button" id="crop" class="btn vbtn-outline-success m-0">Crop</button>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('css')
    <link rel="stylesheet" href="{{ url('css/cropper.min.css') }}" />
    <style>
        .modal-content {
            border-radius: 0 !important;
        }
        /* Limit image width to avoid overflow the container */
        img {
            max-width: 100% !important;
        }

        #canvas {
            height: 500px;
            width: 100%;
            background-color: #ffffff;
            cursor: default;
            border: 1px solid black;
        }
        div#result {
            height: 200px;
            width: 100% !important;
            border: 1px solid #1dbf73;
        }

        div#result img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .hide {
            display: none;
        }
    </style>
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ url('js/bootbox.min.js') }}"></script>
    <script src="{{ url('js/sweetalert.min.js') }}"></script>
    <script src="{{ url('js/cropper.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
    <script src="{{ url('js/additional-method.min.js') }}"></script>

    <script type="text/javascript">
        var gl_photo_id = 0;
        $(document).on('submit', '#photo-form', function(e){
            e.preventDefault();
            $('#photo').hide();
            var dataURL = '{{url("add_photos/").$result->id}}';
            var form_data = new FormData(this);
            var photo_file = $('#photo_file').val();
            if(photo_file != ''){
                $.ajax({
                url: dataURL,
                data: {
                    form_data,
                    '_token': '{{ csrf_token() }}'
                },
                type: 'post',
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (result) {
                    if(result.status){
                    var photo_url = '{{url("images/rooms/").$result->id}}'+'/'+result.photo_name;
                    var photo_div = '<div class="col-md-4 margin-top10" id="photo-div-'+result.photo_id+'">'
                    +'<div class="room-image-container200" style="background-image:url('+photo_url+');">'
                    +'<a class="photo-delete" href="#" data-rel="'+result.photo_id+'"><p class="photo-delete-icon"><i class="fa fa-trash-o"></i></p></a>'
                    +'</div>'
                    +'<div class="margin-top5">'
                    +'<textarea data-rel="'+result.photo_id+'" class="form-control photo-highlights" placeholder="'+"{{ trans('messages.lys.highlights_photo') }}"+'"></textarea>'
                    +'</div>'
                    +'</div>';
                    $('#photo-list-div').append(photo_div);
                    }
                    else
                    $('#photo').show();

                },
                error: function (request, error) {
                    // This callback function will trigger on unsuccessful action
                    show_error_message("{{trans('messages.error.network_error')}}");
                    }
                });
                $('#photo_file').val('');
            }
        });

        $(document).on('focusout', '.photo-highlights', function(e){
                var dataURL = '{{url("listing/".$result->id."/photo_message")}}';
                var photo_id = $(this).attr('data-rel');
                var messages = $(this).val();
                $.ajax({
                    url: dataURL,
                    data: {'photo_id':photo_id, 'messages':messages, '_token': '{{ csrf_token() }}'},
                    type: 'post',
                    dataType: 'json',
                    success: function (result) {
                    },
                    error: function (request, error) {
                        // This callback function will trigger on unsuccessful action
                        show_error_message("{{trans('messages.error.network_error')}}");
                    }
                });
        })


        $(document).on('click', '.photo-delete', function(e){
            var gl_photo_id = $(this).attr('data-rel');
            event.preventDefault();
            swal({
                title: "{{trans('messages.modal.are_you_sure')}}",
                text: "{{trans('messages.modal.delete_message')}}",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "{{trans('messages.search.cancel')}}",
                        value: null,
                        visible: true,
                        className: "btn btn-outline-danger text-16 font-weight-700  pt-3 pb-3 pl-5 pr-5",
                        closeModal: true,
                    },
                    confirm: {
                        text: "{{trans('messages.modal.ok')}}",
                        value: true,
                        visible: true,
                        className: "btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 pl-5 pr-5",
                        closeModal: true
                    }
                },
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var dataURL  = '{{url("listing/$result->id/photo_delete")}}';
                    var photo_id = gl_photo_id;
                    $.ajax({
                        url: dataURL,
                        data: {'photo_id':photo_id, '_token': '{{ csrf_token() }}'},
                        type: 'post',
                        dataType: 'json',
                        success: function (result) {
                            if(result.success){
                                $('#photo-div-'+photo_id).remove();
                                swal({
                                    icon: "success",
                                    buttons: {
                                        confirm: {
                                            text: "Deleted!",
                                            value: true,
                                            visible: true,
                                            className: "btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 pl-5 pr-5",
                                            closeModal: true
                                        }
                                    },
                                });
                            }
                        },
                        error: function (request, error) {
                            show_error_message(request.statusText);
                        }
                    });
                }
            });
        });

        $(document).on('change', '#photoId', function(ev){
            var dataURL      = '{{url("listing/photo/make_default_photo")}}';
            var option_value = $(this).val();
            var photo_id     = $('option:selected', this).attr('image_id');
            var property_id  = $('option:selected', this).attr('property_id');
            $.ajax({
                url: dataURL,
                data: {'photo_id':photo_id, 'property_id':property_id, 'option_value':option_value, '_token': '{{ csrf_token() }}'},
                type: 'post',
                dataType: 'json',
                success: function (result) {
                location.reload();
                }
            });
        });

        $(document).on('change', '.serial', function(ev){
            var dataURL = '{{url("listing/photo/make_photo_serial")}}';
            var serial = $(this).val();
            var id     = $(this).attr('image_id');

            $.ajax({
                    url: dataURL,
                    data: {'id':id, 'serial':serial, '_token': '{{ csrf_token() }}'},
                    type: 'post',
                    dataType: 'json',
                    success: function (result) {
                    location.reload();
                }
            });
        });

    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#img_form').validate({
                rules: {
                    'photos[]': {
                        required:true,
                        accept: "image/jpg,image/jpeg,image/png,image/gif,image/JPG"
                    }
                },
                submitHandler: function(form)
                {
                    
                    $("#up_button").on("click", function (e)
                    {
                        $("#up_button").attr("disabled", true);
                        e.preventDefault();
                    });

                    $("#up_spin").removeClass('d-none');
                    $("#up_button_txt").text("{{trans('messages.listing_description.upload')}}..");
                    return true;
                },
                messages: {
                    'photos[]': {
                        accept: "{{ __('messages.jquery_validation.image_accept') }}",
                    }
                }
            });
        });

        $(document).on('click', '#btnnext', function() {
            $(this).addClass('disabled');
            $("#btn_spin").removeClass('d-none');
            $("#btnnext-text").text("{{trans('messages.listing_basic.next')}}..");

        });

        $('#photo_file').on('change', function() {
            var canvas  = $("#canvas"),
                context = canvas.get(0).getContext("2d"),
                result = $('#result img');
            let name = this.files[0].name;
            if (this.files && this.files[0]) {
                if ( this.files[0].type.match(/^image\//) ) {
                    $(".crop-modal").modal('toggle');
                    var reader = new FileReader();
                    reader.onload = function(evt) {
                        var img = new Image();
                        img.onload = function() {
                            context.canvas.height = img.height;
                            context.canvas.width  = img.width;
                            context.drawImage(img, 0, 0);
                            $('#img_name').val(name);
                            var cropper = canvas.cropper({
                            });
                            $('#crop').click(function() {
                                var croppedImageDataURL = canvas.cropper('getCroppedCanvas').toDataURL("image/png");
                                result.attr('src', croppedImageDataURL);
                                $('#result').show();
                                $('#photo').val(croppedImageDataURL);
                                $('#type').val('crop');
                                canvas.cropper('destroy');
                                $(".crop-modal").modal('toggle');
                                $("#up_button").attr("disabled", false);
                                $("#up_button").click();

                            });

                            $('#restore').click(function() {
                                canvas.cropper('destroy');
                                result.empty();
                                $('#type').val('original');
                                $("#up_button").attr("disabled", false);
                                $("#up_button").click();
                            });
                        };
                        img.src = evt.target.result;
                    };
                    reader.readAsDataURL(this.files[0]);
                }
                else {
                    show_error_message("{{trans('messages.listing_description.invalid')}}");
                }
            }
            else {
                show_error_message("{{trans('messages.listing_description.nofile')}}");
            }
        });

        function show_error_message(msg) {
            $('#notice').show();
            $('#notice span').html(msg);

        }
    </script>
@endpush

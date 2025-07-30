{{----------------------------------- Taken from https://codepen.io/piyushpd139/pen/ZEOYKNZ -----------------------------------}}

<div class="modal fade cropImageModal" id="cropImagePop" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Crop Image')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="upload-demo" class="center-block">
                    <h5><i class="fas fa-arrows-alt mr-1"></i> Drag your photo as you require</h5>
                </div>
                <div class="mt-5 pt-5 d-flex justify-content-between">
                    <x-light-button type="button" class="btn-lg w-50" data-bs-dismiss="modal">@lang('Cancel')</x-light-button>
                    <x-secondary-button class="btn-lg w-50 ms-3" id="cropImageBtn">@lang('Confirm')</x-secondary-button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" />
    <style>
        .ci-user-picture {
            min-width: 150px;
            margin-right: 16px;
        }
        .ci-user-picture img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }
        .btn-default {
            display: inline-block;
            padding: 14px 32px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            transition: 0.5s;
            text-align: center;
            text-transform: capitalize;
        }
        .bg-blue {
            background-color: #1877f2;
            color: #fff !important;
        }
        .filepreviewprofile {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
        }

        /*----modal--------*/
        .modal-header-bg {
            width: 100%;
            height: 12px;
            background: linear-gradient(269.44deg, #1877f2 2.3%, #00AE86 99.19%);
        }
        .cropImageModal .modal-dialog{
            max-width: 750px;
            width: 90%;
            margin: 0.5rem auto;
        }
        .up-photo-title{
            padding: 8px 15px;
            text-align: center;
        }

        #upload-demo{
            position: relative;
            width: 100%;
            height: 250px;
        padding-bottom:0;
        }
        .croppie-container h5 {
            position: absolute;
            bottom: 4px;
            text-align: center;
            left: 0;
            right: 0;
            color: #fff;
            z-index: 2;
            font-size: 15px;
        }
        figure figcaption {
            position: absolute;
            bottom: 0;
            color: #fff;
            width: 100%;
            padding-left: 9px;
            padding-bottom: 5px;
            text-shadow: 0 0 10px #000;
        }
        .croppie-container .cr-image{
            right: 0;
        }
        .croppie-container .cr-slider-wrap {
            width: 275px;
        }
        .cr-slider-wrap p{
            font-size: 13px;
            color: #8D8D94;
            text-align: left;
        }
        .cr-slider{
            width: 275px;
        }
        .upload-action-btn {
            margin-top: 60px;
            padding-top: 40px;
        }

        .cr-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 18px;
            height: 18px;
            background: #1877f2;
            cursor: pointer;
            box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.25);
        }
        
        .cr-slider::-moz-range-thumb {
            width: 18px;
            height: 18px;
            background: #1877f2;
            cursor: pointer;
            box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.25);
        }
        .cr-slider::-ms-thumb {
            width: 18px;
            height: 18px;
            background: #1877f2;
            cursor: pointer;
            box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.25);
        }
        .cr-slider::-webkit-slider-runnable-track {
            width: 275px;
            height: 2px;
            cursor: pointer;
            box-shadow: none;
            background: #E0E0E0;
            border-radius: 3px;
            border:none;
        }
        .cr-slider:focus::-webkit-slider-runnable-track {
            background: #E0E0E0;
        }
        .cr-slider::-moz-range-track {
            width: 275px;
            height: 2px;
            cursor: pointer;
            box-shadow: none;
            background: #E0E0E0;
            border-radius: 3px;
            border:none;
        }
        .cr-slider::-ms-track {
            width: 275px;
            height: 2px;
            cursor: pointer;
            box-shadow: none;
            background: #E0E0E0;
            border-radius: 3px;
            border:none;
            color: transparent;
        }
        .drag-label{
            border-radius: 10px;
            border: 2px dashed #1877f2;
            background: #ebeffc;
            color: #1877f2;
        }
    </style>
@endpush
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <script>
        let $uploadCrop,
            tempFilename,
            rawImg,
            imageId;

        function readFile(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const fileType = file.type;
                const validTypes = ['image/png', 'image/jpeg', 'image/jpg'];

                if (!validTypes.includes(fileType)) {
                    notify("Please upload a valid image file (PNG, JPG, or JPEG).");
                    input.value = '';
                    return;
                }

                let reader = new FileReader();

                reader.onload = function (e) {
                    $('.upload-demo').addClass('ready');
                    $('#cropImagePop').modal('show');
                    rawImg = e.target.result;
                }
                reader.readAsDataURL(file);
            }
            else {
                notify("@lang('Sorry - you\'re browser doesn\'t support the Crop Image')");
            }
        }

        $uploadCrop = $('#upload-demo').croppie({
            viewport: {
                width: 160,
                height: 160,
                type: 'circle'
            },
            enforceBoundary: false,
            enableExif: true
        });

        $('#cropImagePop').on('shown.bs.modal', function(){
            $('.cr-slider-wrap').prepend('<p>Image Zoom</p>');
            $uploadCrop.croppie('bind', {
                url: rawImg
            });
        });

        $('#cropImagePop').on('hidden.bs.modal', function(){
            $('.item-img').val('');
            $('.cr-slider-wrap p').remove();
        });

        $('.item-img').on('change', function () { 
            readFile(this); 
        });
        
        $('#cropImageBtn').on('click', function (ev) {
            $uploadCrop.croppie('result', {
                type: 'base64',
                backgroundColor : "#000000",
                format: 'png',
                size: {width: 250, height: 250}
            }).then(function (resp) {
                $('.logo-preview').attr('src', resp);
                $('.logo-preview').removeClass("d-none");
                $('#cropImagePop').modal('hide');
                $('.item-img').val('');
                $('.drag-label').hide();
                $('.logo-buttons').removeClass("d-none");
            });
        });

        $('.drag-label').on('dragover', e => e.preventDefault()).on('drop', e => {
            e.preventDefault();

            const files = e.originalEvent.dataTransfer.files;

            if (files.length > 0) {
                const input = $('.item-img')[0];

                const dataTransfer = new DataTransfer();
                [...files].forEach(file => dataTransfer.items.add(file));
                input.files = dataTransfer.files;

                $(input).trigger('change');
            }
        });

        $('.delete-image').on('click', function() {
            $('.logo-preview').addClass("d-none");
            $('.logo-buttons').addClass("d-none");
            $('.drag-label').show();
            $('.logo-preview').attr('src', "");
        });
    </script>
@endpush
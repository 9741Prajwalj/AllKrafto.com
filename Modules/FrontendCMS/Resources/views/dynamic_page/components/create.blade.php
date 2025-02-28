@extends('backEnd.master')
@section('styles')
<link rel="stylesheet" href="{{asset(asset_path('modules/frontendcms/css/style.css'))}}" />

@endsection
@section('mainContent')
    <div class="col-12">
        <div class="box_header">
            <div class="main-title d-flex justify-content-between w-100">
                <h3 class="mb-0 mr-30">{{ __('frontendCms.create_dynamic_page') }}</h3>

            </div>
        </div>
    </div>
    @if(isModuleActive('FrontendMultiLang'))
    @php
    $LanguageList = getLanguageList();
    @endphp
    @endif
    <div class="col-12">
        <div class="white_box_50px box_shadow_white">
            <form id="formData" action="{{ route('frontendcms.dynamic-page.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    @if(isModuleActive('FrontendMultiLang'))
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                @foreach ($LanguageList as $key => $language)
                                    <li class="nav-item">
                                        <a class="nav-link anchore_color @if (auth()->user()->lang_code == $language->code) active @endif" href="#element{{$language->code}}" role="tab" data-toggle="tab" aria-selected="@if (auth()->user()->lang_code == $language->code) true @else false @endif">{{ $language->native }} </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @foreach ($LanguageList as $key => $language)
                                    <div role="tabpanel" class="tab-pane fade @if (auth()->user()->lang_code == $language->code) show active @endif" id="element{{$language->code}}">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="title">{{ __('common.title') }} <span class="text-danger">*</span></label>
                                                    <input name="title[{{$language->code}}]" id="title{{$language->code}}" class="primary_input_field" placeholder="-" type="text" value="{{ old('title.'.$language->code)}}">
                                                </div>
                                                @error('title.'.auth()->user()->lang_code)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-xl-6 d-none" id="default_lang_{{$language->code}}">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="slug">{{ __('common.slug') }} <span class="text-danger">*</span></label>
                                                    <input name="slug[{{$language->code}}]" id="slug{{$language->code}}" class="primary_input_field" placeholder="-" type="text" value="{{ old('slug.'.$language->code)}}">
                                                </div>
                                                @error('slug.'.auth()->user()->lang_code)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="primary_input mb-35">
                                                    <label class="primary_input_label" for="">{{ __('common.details') }} <span class="text-danger">*</span></label>
                                                    <textarea name="description[{{$language->code}}]" class="summernote" id="description{{$language->code}}">{{ old('description.'.$language->code)}}</textarea>
                                                </div>
                                                @error('description.'.auth()->user()->lang_code)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="col-xl-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="title">{{ __('common.title') }} <span class="text-danger">*</span></label>
                                <input name="title" id="title" class="primary_input_field" placeholder="-" type="text" value="{{ old('title') }}">
                            </div>
                            @error('title')
                                <span class="text-danger" id="error_title">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-xl-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="slug">{{ __('common.slug') }} <span class="text-danger">*</span></label>
                                <input name="slug" id="slug" class="primary_input_field" placeholder="-" type="text" value="{{ old('slug') }}">
                            </div>
                            @error('slug')
                                <span class="text-danger" id="error_title">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-xl-12">
                            <div class="primary_input mb-35">
                                <label class="primary_input_label" for="">{{ __('common.details') }} <span class="text-danger">*</span></label>
                                <textarea name="description" class="summernote" id="description">{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                                <span class="text-danger" id="error_title">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                    <div class="col-xl-12">
                        <div class="primary_input mb-35">
                            <label class="primary_input_label" for="">{{ __('common.status') }} <span class="text-danger">*</span></label></label>
                            <ul id="theme_nav" class="permission_list sms_list ">
                                <li>
                                    <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                        <input name="status" id="status_active" value="1" checked="true" class="active"
                                            type="radio">
                                        <span class="checkmark"></span>
                                    </label>
                                    <p>{{ __('common.active') }}</p>
                                </li>
                                <li>
                                    <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                                        <input name="status" value="0" id="status_inactive" class="de_active" type="radio">
                                        <span class="checkmark"></span>
                                    </label>
                                    <p>{{ __('common.inactive') }}</p>
                                </li>
                            </ul>
                        </div>
                        @error('status')
                            <span class="text-danger" id="error_title">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-12 text-center">
                        <div class="d-flex justify-content-center">
                            <button class="primary-btn semi_large2  fix-gr-bg mr-1" id="save_button_parent" type="submit" dusk="save"><i
                                    class="ti-check"></i>{{ __('common.save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')

<script>
    (function($){
        "use strict";
        $(document).ready(function(){

            @if(isModuleActive('FrontendMultiLang'))
                $(document).on('keyup', '#title{{auth()->user()->lang_code}}', function(event){
                    processSlug($('#title{{auth()->user()->lang_code}}').val(), '#slug{{auth()->user()->lang_code}}');
                });
            @else
                $(document).on('keyup', '#title', function(event){
                    processSlug($(this).val(), '#slug');
                });
            @endif
            $('.summernote').summernote({
                placeholder: 'Description',
                tabsize: 2,
                height: 400,
                codeviewFilter: true,
			    codeviewIframeFilter: true
            });
            @if(isModuleActive('FrontendMultiLang'))
                $(document).on('click', '.default_lang', function(event){
                    var lang = $(this).data('id');
                    if (lang == "{{auth()->user()->lang_code}}") {
                        $('#default_lang_{{auth()->user()->lang_code}}').removeClass('d-none');
                    }
                });
                if ("{{auth()->user()->lang_code}}") {
                        $('#default_lang_{{auth()->user()->lang_code}}').removeClass('d-none');
                }
            @endif

        });
    })(jQuery);
</script>

@endpush

<div class="box_header common_table_header">
    <div class="main-title d-md-flex">
        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('product.add_new_attribute') }}</h3>
    </div>
</div>
@if(isModuleActive('FrontendMultiLang'))
@php
$LanguageList = getLanguageList();
@endphp
@endif
<form action="#" method="POST" enctype="multipart/form-data" id="variantForm">
    <div class="white_box_50px box_shadow_white mb-20">
        <input type="hidden" class="edit_id">
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
                            <div class="col-lg-12">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for=""> {{__("common.name")}} <span class="text-danger">*</span></label>
                                    <input class="primary_input_field" name="name[{{$language->code}}]" id="name" placeholder="{{__("common.name")}}" type="text" value="{{old('name.'.$language->code)}}">
                                    <span class="text-danger" id="name_{{$language->code}}_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for=""> {{__("common.description")}} </label>
                                    <textarea class="primary_textarea height_112" placeholder="{{ __('common.description') }}" name="description[{{$language->code}}]" spellcheck="false">{{old('description.'.$language->code)}}</textarea>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="col-lg-12">
                <div class="primary_input mb-15">
                    <label class="primary_input_label" for=""> {{__("common.name")}} <span class="text-danger">*</span></label>
                    <input class="primary_input_field" name="name" id="name" placeholder="{{__("common.name")}}" type="text" value="{{old('name')}}">
                    <span class="text-danger" id="name_error"></span>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="primary_input mb-15">
                    <label class="primary_input_label" for=""> {{__("common.description")}} </label>
                    <textarea class="primary_textarea height_112" placeholder="{{ __('common.description') }}" name="description" spellcheck="false"></textarea>
                </div>
            </div>
        @endif
            <div class="col-xl-12">
                <div class="primary_input">
                    <label class="primary_input_label" for="">{{ __('common.status') }} <span class="text-danger">*</span></label>
                    <ul id="theme_nav" class="permission_list sms_list ">
                        <li>
                            <label data-id="bg_option"
                                   class="primary_checkbox d-flex mr-12">
                                <input name="status" value="1" class="active" checked type="radio">
                                <span class="checkmark"></span>
                            </label>
                            <p>{{__("common.active")}} </p>
                        </li>
                        <li>
                            <label data-id="color_option"
                                   class="primary_checkbox d-flex mr-12">
                                <input name="status" value="0" class="de_active"
                                       type="radio">
                                <span class="checkmark"></span>
                            </label>
                            <p>{{__("common.inactive")}}</p>
                        </li>
                    </ul>
                    <span class="text-danger" id="status_error"></span>
                </div>
            </div>
            <div class="col-lg-12">
                <strong>{{__("product.attribute_value")}} </strong> <span class="text-danger">*</span>
                <div class="QA_section2 QA_section_heading_custom check_box_table">
                    <div class="QA_table mb_15">
                        <!-- table-responsive -->
                        <div class="table-responsive">
                            <table class="table create_table">
                                <tbody>
                                    <tr class="variant_row_lists">
                                        <td class="pl-0 pb-0 border-0">
                                            <input class="placeholder_input" id="variant_values" name="variant_values[]" placeholder="-" type="text">
                                        </td>
                                        <td class="pl-0 pb-0 pr-0 border-0">
                                            <div class="add_items_button">
                                                <button type="button" class="primary-btn radius_30px add_single_variant_row fix-gr-bg">
                                                    <i class="ti-plus"></i>{{ __('product.add_value') }}
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="variant_row_lists">
                                        <td class="pl-0 pb-0 border-0">
                                            <span class="text-danger" id="error_variant_values"></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @if (permissionCheck('product.attribute.store'))
                <div class="col-lg-12">
                    <button class="primary_btn_2 mt-5"><i class="ti-check"></i>{{__("common.save")}} </button>
                </div>
            @else
                <div class="col-lg-12 mt-5 text-center">
                    <span class="alert alert-warning" role="alert">
                        <strong>{{ __('common.you_don_t_have_this_permission') }}</strong>
                    </span>
                </div>
            @endif
        </div>
    </div>
</form>

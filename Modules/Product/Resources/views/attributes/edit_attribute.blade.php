<div class="box_header common_table_header">
    <div class="main-title d-md-flex">
        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('product.edit_attribute') }}</h3>
    </div>
</div>
@if(isModuleActive('FrontendMultiLang'))
@php
$LanguageList = getLanguageList();
@endphp
@endif
<form action="" method="POST" id="attributeEditForm">
    <div class="white_box_50px box_shadow_white mb-20">
        <div class="row">
            <input type="hidden" class="edit_id" value="{{$attribute->id}}">
            @if(isModuleActive('FrontendMultiLang'))
            <div class="col-lg-12">
                <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                    @foreach ($LanguageList as $key => $language)
                        <li class="nav-item lang_code" data-id="{{$language->code}}">
                            <a class="nav-link anchore_color @if (auth()->user()->lang_code == $language->code) active @endif" href="#element{{$language->code}}" role="tab" data-toggle="tab" aria-selected="@if (auth()->user()->lang_code == $language->code) true @else false @endif">{{ $language->native }} </a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach ($LanguageList as $key => $language)
                        <div role="tabpanel" class="tab-pane fade @if (auth()->user()->lang_code == $language->code) show active @endif" id="element{{$language->code}}">
                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.name') }} <span class="text-danger">*</span></label>
                                    <input name="name[{{$language->code}}]" class="primary_input_field name" placeholder="{{ __('common.name') }}" type="text" value="{{isset($attribute)?$attribute->getTranslation('name',$language->code):old('name.'.$language->code)}}">
                                    <span class="text-danger" id="edit_name_{{$language->code}}_error"></span>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.description') }}</label>
                                    <textarea class="primary_textarea height_112 description" placeholder="{{ __('common.description') }}" name="description[{{$language->code}}]" spellcheck="false">{{isset($attribute)?$attribute->getTranslation('description',$language->code):old('description.'.$language->code)}}</textarea>
                                    <span class="text-danger" id="edit_description_error"></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="col-xl-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('common.name') }} <span class="text-danger">*</span></label>
                    <input name="name" class="primary_input_field name" placeholder="{{ __('common.name') }}" type="text" value="{{$attribute->name}}">
                    <span class="text-danger" id="edit_name_error"></span>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('common.description') }}</label>
                    <textarea class="primary_textarea height_112 description" placeholder="{{ __('common.description') }}" name="description" spellcheck="false">{{$attribute->description}}</textarea>
                    <span class="text-danger" id="edit_description_error"></span>
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
                                <input name="status" value="1" class="active" {{$attribute->status == 1?'checked':''}} type="radio">
                                <span class="checkmark"></span>
                            </label>
                            <p>{{__("common.active")}}</p>
                        </li>
                        <li>
                            <label data-id="color_option"
                                   class="primary_checkbox d-flex mr-12">
                                <input name="status" value="0" class="de_active" {{$attribute->status == 0?'checked':''}}
                                       type="radio">
                                <span class="checkmark"></span>
                            </label>
                            <p>{{__("common.inactive")}}</p>
                        </li>
                    </ul>
                    <span class="text-danger" id="edit_status_error"></span>
                </div>
            </div>
            <div class="col-lg-12">
                <strong>{{__("product.attribute_value")}} <span class="text-danger">*</span></strong>
                <div class="QA_section2 QA_section_heading_custom check_box_table">
                    <div class="QA_table mb_15">
                        <!-- table-responsive -->
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @if($attribute->id == 1)
                                        @if(count($attribute->values) > 0)
                                            @foreach($attribute->values as $key => $items)
                                                @if ($key === 0)
                                                    <tr class="variant_edit_row_lists">
                                                        <td class="pl-0 pb-0 border-0 w-auto">
                                                            <input type='text' class='basic placeholder_input' name="edit_variant_values[]" id='basic' value='{{$items->value}}' />
                                                            <input type="hidden" name="color_with_id[]" value="{{$items->value}}-{{$items->id}}"/>
                                                        </td>
                                                        <td class="pl-0 pb-0 border-0">
                                                            <input type='text' class='placeholder_input' placeholder='{{__('product.color_name')}}' name="edit_variant_c_name[]" value='{{$items->color->name}}' />
                                                        </td>
                                                        <td class="pl-0 pb-0 pr-0 border-0">
                                                            <div class="add_items_button pt-10">
                                                                <button type="button" class="primary-btn primary-circle add_color_variant_edit_row  fix-gr-bg">
                                                                    <i class="ti-plus"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr class="variant_edit_row_lists">
                                                        <td class="pl-0 pb-0 border-0">
                                                        <input type='text' class='basic placeholder_input' name="edit_variant_values[]" id='basic' value='{{$items->value}}' />
                                                        <input type="hidden" name="color_with_id[]" value="{{$items->value}}-{{$items->id}}"/>
                                                        </td>
                                                        <td class="pl-0 pb-0 border-0">
                                                            <input type='text' class='placeholder_input' placeholder='{{__('product.color_name')}}' name="edit_variant_c_name[]" value='{{$items->color->name}}' />
                                                        </td>
                                                        <td class="pl-0 pb-0 pr-0 remove_edit border-0">
                                                            @if(!$items->productVariation)
                                                                <div class="items_min_icon "><i class="ti-trash"></i></div>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                    @else
                                        @if(count($attribute->values) > 0)
                                            @foreach($attribute->values as $key => $items)
                                                @if ($key == 0)
                                                    <tr class="variant_edit_row_lists">
                                                        <td class="pl-0 pb-0 border-0">
                                                            <input class="placeholder_input" value="{{$items->value}}" placeholder="-" name="edit_variant_values[]" type="text">
                                                            <input type="hidden" class="d-none" name="value_id[]" value="{{$items->id}}">
                                                            <input type="hidden" class="d-none" name="value_with_id[]" value="{{$items->value}}-{{$items->id}}">
                                                        </td>
                                                        <td class="pl-0 pb-0 pr-0 border-0">
                                                            <div class="add_items_button pt-10">
                                                                <button type="button" class="primary-btn primary-circle add_single_variant_edit_row  fix-gr-bg">
                                                                    <i class="ti-plus"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr class="variant_edit_row_lists">
                                                        <td class="pl-0 pb-0 border-0">
                                                            <input class="placeholder_input" value="{{$items->value}}" placeholder="-" name="edit_variant_values[]" type="text">
                                                            <input type="hidden" class="d-none" name="value_id[]" value="{{$items->id}}">
                                                            <input type="hidden" class="d-none" name="value_with_id[]" value="{{$items->value}}-{{$items->id}}">
                                                        </td>
                                                        <td class="pl-0 pb-0 pr-0 remove_edit border-0">
                                                            @if(!$items->productVariation)
                                                            <div class="items_min_icon "><i class="ti-trash"></i></div>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @else
                                        <tr class="variant_edit_row_lists">
                                            <td class="pl-0 pb-0 border-0">
                                                <input class="placeholder_input" name="edit_variant_values[]" placeholder="-" type="text">
                                            </td>
                                            <td class="pl-0 pb-0 pr-0 border-0">
                                                <div class="add_items_button pt-10">
                                                    <button type="button" class="primary-btn radius_30px add_single_variant_edit_row  fix-gr-bg">
                                                        <i class="ti-plus"></i>{{ __('product.add_value') }}
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @if (permissionCheck('product.attribute.store'))
                <div class="col-lg-12 text-center">
                    <div class="d-flex justify-content-center pt_20">
                        <button type="submit" class="primary-btn semi_large2  fix-gr-bg"
                                id="save_button_parent"><i
                                class="ti-check"></i>{{ __('common.update') }}
                        </button>
                    </div>
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

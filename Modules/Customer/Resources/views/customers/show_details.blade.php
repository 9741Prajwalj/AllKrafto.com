@extends('backEnd.master')
@section('styles')
<link rel="stylesheet" href="{{asset(asset_path('modules/customer/css/show_details.css'))}}" />
<style>
    .white-color{
        color: #FFF !important;
    }
</style>
@endsection
@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">
                        <div class="box_header">
                            <div class="main-title d-flex">
                                <h3 class="mb-0 mr-30">{{ __('common.customer_profile')}}</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="img_div">
                                    <img class="student-meta-img mb-3" src="{{ (@$customer->avatar != null) ? showImage($customer->avatar) : showImage('frontend/default/img/avatar.jpg') }}"  alt="">
                                </div>
                                <h3>{{$customer->first_name}} {{$customer->last_name}}</h3>
                                <table class="table table-borderless customer_view">
                                    <tr>
                                        <td>{{ __('common.name') }}</td>
                                        <td>: <span class="ml-1"></span>{{$customer->first_name}} {{$customer->last_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('common.email') }}</td>
                                        <td>: <span class="ml-1"></span>{{ $customer->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('common.phone') }}</td>
                                        <td>: <span class="ml-1"></span>{{ (getNumberTranslate($customer->phone)) ?? $customer->username }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('common.registered_date') }}</td>
                                        <td>: <span class="ml-1"></span>{{ dateConvert($customer->created_at) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('common.active_status') }}</td>
                                        <td>: <span class="ml-1"></span>
                                            @if ($customer->is_active == 1)
                                                <span class="badge_1">{{__('common.active')}}</span>
                                            @elseif($customer->is_active == 0)
                                                <span class="badge_4">{{__('common.disabled')}}</span>
                                            @else
                                                <span class="badge_4">{{__('common.in-active')}}</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4 col-sm-12">
                               <div class="mb-3 mb-md-0 customer_profile">
                                <h3>{{__('common.order_summary')}}</h3>
                                <table class="table table-borderless customer_view">
                                    <tr><td>{{__('common.total_orders')}}</td>
                                    <td>: <span class="ml-1"></span>{{getNumberTranslate(count($customer->orders))}}</td></tr>
                                    <tr><td>{{__('common.confirmed_orders')}}</td>
                                    <td>: <span class="ml-1"></span>{{getNumberTranslate(count($customer->orders->where('is_confirmed', 1)->where('is_completed', 0)))}}</td></tr>
                                    <tr><td>{{__('common.pending_orders')}}</td>
                                    <td>: <span class="ml-1"></span>{{getNumberTranslate(count($customer->orders->where('is_confirmed', 0)))}}</td></tr>
                                    <tr><td>{{__('common.completed_orders')}}</td>
                                    <td>: <span class="ml-1"></span>{{getNumberTranslate(count($customer->orders->where('is_completed', 1)))}}</td></tr>
                                    <tr><td>{{__('common.cancelled_orders')}}</td>
                                    <td>: <span class="ml-1"></span>{{getNumberTranslate(count($customer->orders->where('is_cancelled', 1)))}}</td></tr>
                                </table>
                               </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="customer_profile">
                                    <h3>{{__('common.wallet_summary')}}</h3>
                                    <table class="table table-borderless customer_view">
                                        <tr><td>{{__('common.total_recharge')}}</td>
                                        <td>: <span class="ml-1"></span>{{single_price($customer->wallet_balances->where('type', 'Deposite')->sum('amount'))}}</td></tr>
                                        <tr><td>{{__('common.pending_balance_approval')}}</td>
                                        <td>: <span class="ml-1"></span>{{single_price($customer->CustomerCurrentWalletPendingAmounts)}}</td></tr>
                                        <tr><td>{{__('common.total_balance')}}</td>
                                        <td>: <span class="ml-1"></span>{{single_price($customer->CustomerCurrentWalletAmounts)}}</td></tr>
                                    </table>
                                </div>
                            </div>

                        </div>
                        @if ($customer->description)
                            <hr>
                                <div class="row">
                                    <div class="col">
                                        <label class="primary_input_label" for="">
                                            @php
                                                echo $customer->description;
                                            @endphp
                                        </label>
                                    </div>
                                </div>
                            <hr>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">
                        <div class="col-lg-12 student-details">
                            <ul class="nav nav-tabs tab_column mb-50" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#Order" role="tab" data-toggle="tab">{{ __('common.orders') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#Wallet" role="tab" data-toggle="tab">{{ __('common.wallet_histories') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#Address" role="tab" data-toggle="tab">{{ __('common.addresses') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#login_ip" role="tab" data-toggle="tab">{{ __('common.login_ip') }}</a>
                                </li>
                            </ul>
                            <div class="tab-content pt-30">

                                <div role="tabpanel" class="tab-pane fade show active" id="Order">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="QA_section QA_section_heading_custom check_box_table">
                                                <div class="QA_table ">
                                                    <div class="">
                                                        <table class="table" id="orderTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{__('common.sl')}}</th>
                                                                    <th width="10%">{{__('common.date')}}</th>
                                                                    <th>{{__('common.order_id')}}</th>
                                                                    <th>{{__('order.total_product_qty')}}</th>
                                                                    <th>{{__('common.total_amount')}}</th>
                                                                    <th>{{__('order.order_status')}}</th>
                                                                    <th>{{__('order.is_paid')}}</th>
                                                                    <th>{{__('common.action')}}</th>
                                                                </tr>
                                                            </thead>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="Wallet">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="QA_section QA_section_heading_custom check_box_table">
                                                <div class="QA_table ">

                                                    <div class="">
                                                        <table class="table Crm_table_active3" id="walletTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{__('common.sl')}}</th>
                                                                    <th>{{__('common.date')}}</th>
                                                                    <th>{{__('common.user')}}</th>
                                                                    <th>{{__('order.txn_id')}}</th>
                                                                    <th>{{__('common.amount')}}</th>
                                                                    <th>{{__('common.type')}}</th>
                                                                    <th>{{__('common.payment_method')}}</th>
                                                                    <th>{{__('common.approval')}}</th>
                                                                </tr>
                                                            </thead>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="Address">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="QA_section QA_section_heading_custom check_box_table">
                                                <div class="QA_table ">
                                                    <div class="">
                                                        <table class="table Crm_table_active3">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{ __('common.sl') }}</th>
                                                                    <th>{{ __('common.full_name') }}</th>
                                                                    <th>{{ __('common.address') }}</th>
                                                                    <th>{{ __('common.region') }}</th>
                                                                    <th>{{ __('common.email') }}</th>
                                                                    <th>{{ __('common.phone_number') }}</th>
                                                                    <th>{{ __('common.postcode') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($customer->customerAddresses as $key => $address)
                                                                    <tr class="{{ $address->is_updated == 0 ? 'bg-success':'' }}">
                                                                        <td class="{{ $address->is_updated == 0 ? 'white-color':'' }}" >{{ getNumberTranslate($key+1) }}</td>
                                                                        <td class="{{ $address->is_updated == 0 ? 'white-color':'' }}" >{{ $address->name }}</td>
                                                                        <td class="{{ $address->is_updated == 0 ? 'white-color':'' }}" >{{ $address->address }}</td>
                                                                        <td class="{{ $address->is_updated == 0 ? 'white-color':'' }}" >
                                                                            {{ !empty($address->getCity) ? $address->getCity->name:'' }}
                                                                            {{ !empty($address->getState) ? ', '.$address->getState->name:'' }}
                                                                            {{ !empty($address->getCountry) ? ', '.$address->getCountry->name:'' }}

                                                                        </td>
                                                                        <td class="{{ $address->is_updated == 0 ? 'white-color':'' }}" >{{ $address->email }}</td>
                                                                        <td class="{{ $address->is_updated == 0 ? 'white-color':'' }}" >{{ getNumberTranslate($address->phone) }}</td>
                                                                        <td class="{{ $address->is_updated == 0 ? 'white-color':'' }}" >{{ getNumberTranslate($address->postal_code) }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="login_ip">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="QA_section QA_section_heading_custom check_box_table">
                                                <div class="QA_table ">
                                                    <div class="">
                                                        <table class="table Crm_table_active3">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{ __('common.sl') }}</th>
                                                                    <th>{{ __('common.IP') }}</th>
                                                                    <th>{{ __('common.agent') }}</th>
                                                                    <th>{{ __('common.login_time') }}</th>
                                                                    <th>{{ __('common.logout_time') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($logins as $key => $login)
                                                                    <tr>
                                                                       <td>{{ $key + 1 }}</td>
                                                                       <td>{{ $login->ip }}</td>
                                                                       <td>{{ $login->agent }}</td>
                                                                       <td>{{ showDate($login->login_time).' '.date("h:i a",strtotime($login->login_time)) }}</td>
                                                                       <td>{{ showDate($login->logout_time).' '.date("h:i a",strtotime($login->logout_time)) }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push("scripts")
    <script type="text/javascript">
        $(document).ready(function(){
            let baseUrl = $('#url').val();
            let urlForOrders = baseUrl + '/customer/profile/details/' + "{{$customer->id}}" + '/get-orders';
            $('#orderTable').DataTable({
                processing: true,
                serverSide: true,
                "stateSave": true,
                "ajax": ( {
                    url: urlForOrders
                }),
                "initComplete":function(json){
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'id',render:function(data){
                        return numbertrans(data)
                    }},
                    { data: 'date', name: 'date' },
                    { data: 'order_number', name: 'order_number' },
                    { data: 'number_of_product', name: 'number_of_product' },
                    { data: 'total_amount', name: 'total_amount' },
                    { data: 'order_status', name: 'order_status' },
                    { data: 'is_paid', name: 'is_paid' },
                    { data: 'action', name: 'action' }
                ],
                bLengthChange: false,
                "bDestroy": true,
                language: {
                    search: "<i class='ti-search'></i>",
                    searchPlaceholder: trans('common.quick_search'),
                    paginate: {
                        next: "<i class='ti-arrow-right'></i>",
                        previous: "<i class='ti-arrow-left'></i>"
                    }
                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-files-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'Copy',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        title: $("#header_title").text(),
                        margin: [10, 10, 10, 0],
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },

                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'PDF',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },
                        pageSize: 'A4',
                        margin: [0, 0, 0, 0],
                        alignment: 'center',
                        header: true,

                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        titleAttr: 'Print',
                        title: $("#header_title").text(),
                        exportOptions: {
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa fa-columns"></i>',
                        postfixButtons: ['colvisRestore']
                    }
                ],
                columnDefs: [{
                    visible: false
                }],
                responsive: true,
            });

            let urlForWallet = baseUrl + '/customer/profile/details/' + "{{$customer->id}}" + '/get-wallet-history';
            $('#walletTable').DataTable({
                processing: true,
                serverSide: true,
                "stateSave": true,
                "ajax": ( {
                    url: urlForWallet
                }),
                "initComplete":function(json){

                },
                columns: [
                    { data: 'DT_RowIndex', name: 'id' ,render:function(data){
                        return numbertrans(data)
                    }},
                    { data: 'date', name: 'date' },
                    { data: 'user', name: 'user' },
                    { data: 'txn_id', name: 'txn_id' },
                    { data: 'amount', name: 'amount' },
                    { data: 'type', name: 'type' },
                    { data: 'payment_method', name: 'payment_method' },
                    { data: 'approval', name: 'approval' }
                ],

                bLengthChange: false,
                "bDestroy": true,
                language: {
                    search: "<i class='ti-search'></i>",
                    searchPlaceholder: trans('common.quick_search'),
                    paginate: {
                        next: "<i class='ti-arrow-right'></i>",
                        previous: "<i class='ti-arrow-left'></i>"
                    }
                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-files-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'Copy',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        title: $("#header_title").text(),
                        margin: [10, 10, 10, 0],
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'PDF',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },
                        pageSize: 'A4',
                        margin: [0, 0, 0, 0],
                        alignment: 'center',
                        header: true,
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        titleAttr: 'Print',
                        title: $("#header_title").text(),
                        exportOptions: {
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa fa-columns"></i>',
                        postfixButtons: ['colvisRestore']
                    }
                ],
                columnDefs: [{
                    visible: false
                }],
                responsive: true,
            });
        });
    </script>
@endpush

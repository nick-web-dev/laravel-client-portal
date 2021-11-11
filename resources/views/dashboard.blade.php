@extends('layouts.app')

@section('content')
    <!-- Promises Met -->
    <div class="bg-white py-8">
        <div class="container overflow-hidden py-3">
            <h3 class="text-dark-blue-selected">Promises Met</h3>
            <div class="row promise-cards-row">
                <div class="col-lg-6 col-xl-4">
                    <x-promise-card title="On Time Fulfillment" description="Orders meeting SLA within the last month" icon="on-time" color-class="blue" :value="$fulfillment->percent">
                        <x-pie-chart :percent="$fulfillment->percent" color-class="blue" text-color="blue-active" class="gauge align-middle" style="width: 86px" />
                    </x-promise-card>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <x-promise-card title="Fulfillment Accuracy" description="Orders fulfilled accurately within the last month" icon="bullseye" color-class="orange" :value="$fulfillment->accuracy">
                        <x-gauge-widget :percent="$fulfillment->accuracy" class="gauge align-middle" color-class="blue" :gradient="true" style="width: 86px" />
                    </x-promise-card>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <x-promise-card title="Fulfillment Savings" description="Money you saved on shipping and fulfillment by partnering with OWD" icon="savings" color-class="green" :value="$fulfillment->savings">
                        <x-pie-chart :percent="$fulfillment->savings" color-class="green" text-color="blue-selected" class="gauge align-middle" format="$%d" style="width: 86px" />
                    </x-promise-card>
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Back -->
    <div class="content content-boxed dashboard pb-20">
        <h3 class="text-dark-blue-selected">Welcome Back!</h3>
        <div class="widget-container">

            <x-dash.todays-orders :orders="$live_data->orders" />

            <x-dash.asn-receives :asn-receives="$live_data->asnReceives" />

            <x-dash.inventory :inventory="$live_data->inventory" />

            <x-dash.announcements :items="$announcements_list" />

        </div>
    </div>
@endsection

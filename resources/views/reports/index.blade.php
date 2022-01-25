@extends('layouts.app')

@push('css_before')
@endpush

@push('css_after')

@endpush

@section('content')
    <header class='reports-nav'>
        <x-nav.section title="Your Report Library">
            <x-nav.link href="#watch-guide" text="Watch Guide" icon="play" text-class="text-gd-blue" icon-color="blue" />
        </x-nav.section>
    </header>

    <div class="custom-reports__wrapper content content-narrow pb-20">
        <div class="custom-reports__header row">
            <h4 class="custom-reports__header-company-name">Walmart</h4>
            <h3 class="custom-reports__header-title">Custom Reports</h3>
        </div>
        <!-- Shipments begin -->
        <div class="container-fluid custom-reports__list shipments__reports">
            <div class="custom-report__labels">
                <label class='custom-reports__category-label'>Shipments</label>
                <label class='custom-reports__qty'>03</label>
            </div>
            <div class="row custom-reports__cards">
                <div class="col-lg-4">
                    <div class=" custom-reports__card">
                        <a href="{{route('reports.show', ['reportType'=>'sales-orders','reportId'=>1,])}}" class='link-overlay'></a>
                        <div class="card-icon"></div>
                        <div class="card-content">
                            <label class='report-date'>Aug 17, 2021 </label>
                            <h3 class='report-title'>Name of the report</h3>
                            <p class='report-desc'>Data: Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        </div>
                        <div class="card-controls">
                            <div class="report-export">
                                <a href="#" class="btn" name="buttonReportExport">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
                                        <path d="M20 13.5L17 10.5L14 13.5" stroke="#0084FF" stroke-width="2"/>
                                        <path d="M10 15V24H24V15" stroke="#0084FF" stroke-width="2"/>
                                        <path d="M17 11V19" stroke="#0084FF" stroke-width="2"/>
                                    </svg>
                                </a>
                            </div>
                            <div class="report-more dropdown">
                                <button class="btn" type="button" id="dropdownMoreButton" data-toggle="dropdown" aria-expanded="false">
                                    <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11 19C12.1046 19 13 18.1046 13 17C13 15.8954 12.1046 15 11 15C9.89543 15 9 15.8954 9 17C9 18.1046 9.89543 19 11 19ZM19 17C19 18.1046 18.1046 19 17 19C15.8954 19 15 18.1046 15 17C15 15.8954 15.8954 15 17 15C18.1046 15 19 15.8954 19 17ZM25 17C25 18.1046 24.1046 19 23 19C21.8954 19 21 18.1046 21 17C21 15.8954 21.8954 15 23 15C24.1046 15 25 15.8954 25 17Z" fill="#0084FF"/>
                                    </svg>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMoreButton">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class=" custom-reports__card">
                        <a href="{{route('reports.show', ['reportType'=>'sales-orders','reportId'=>1,])}}" class='link-overlay'></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class=" custom-reports__card">
                        <a href="{{route('reports.show', ['reportType'=>'sales-orders','reportId'=>1,])}}" class='link-overlay'></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Shipments end -->

        <!-- Orders begin -->
        <div class="container-fluid custom-reports__list orders__reports">
            <div class="custom-report__labels">
                <label class='custom-reports__category-label'>Orders</label>
                <label class='custom-reports__qty'>03</label>
            </div>
            <div class="row custom-reports__cards">
                <div class="col-lg-4">
                    <div class="custom-reports__card">
                        <a href="{{route('reports.show', ['reportType'=>'inventory','reportId'=>1,])}}" class='link-overlay'></a>
                        <div class="card-icon"></div>
                        <div class="card-content">
                            <label class='report-date'>Aug 17, 2021 </label>
                            <h3 class='report-title'>Name of the report</h3>
                            <p class='report-desc'>Data: Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        </div>
                        <div class="card-controls">
                            <div class="report-export">
                                <a href="#" class="btn" name="buttonReportExport">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
                                        <path d="M20 13.5L17 10.5L14 13.5" stroke="#0084FF" stroke-width="2"/>
                                        <path d="M10 15V24H24V15" stroke="#0084FF" stroke-width="2"/>
                                        <path d="M17 11V19" stroke="#0084FF" stroke-width="2"/>
                                    </svg>
                                </a>
                            </div>
                            <div class="report-more dropdown">
                                <button class="btn" type="button" id="dropdownMoreButton" data-toggle="dropdown" aria-expanded="false">
                                    <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11 19C12.1046 19 13 18.1046 13 17C13 15.8954 12.1046 15 11 15C9.89543 15 9 15.8954 9 17C9 18.1046 9.89543 19 11 19ZM19 17C19 18.1046 18.1046 19 17 19C15.8954 19 15 18.1046 15 17C15 15.8954 15.8954 15 17 15C18.1046 15 19 15.8954 19 17ZM25 17C25 18.1046 24.1046 19 23 19C21.8954 19 21 18.1046 21 17C21 15.8954 21.8954 15 23 15C24.1046 15 25 15.8954 25 17Z" fill="#0084FF"/>
                                    </svg>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMoreButton">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="custom-reports__card">
                        <a href="{{route('reports.show', ['reportType'=>'inventory','reportId'=>1,])}}" class='link-overlay'></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="custom-reports__card">
                        <a href="{{route('reports.show', ['reportType'=>'inventory','reportId'=>1,])}}" class='link-overlay'></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Orders end -->
        <!-- Returns begin -->
        <div class="container-fluid custom-reports__list returns__reports">
            <div class="custom-report__labels">
                <label class='custom-reports__category-label'>Returns</label>
                <label class='custom-reports__qty'>03</label>
            </div>
            <div class="row custom-reports__cards">
                <div class="col-lg-4">
                    <div class="custom-reports__card">
                        <a href="{{route('reports.show', ['reportType'=>'returns','reportId'=>1,])}}" class='link-overlay'></a>
                        <div class="card-icon"></div>
                        <div class="card-content">
                            <label class='report-date'>Aug 17, 2021 </label>
                            <h3 class='report-title'>Name of the report</h3>
                            <p class='report-desc'>Data: Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        </div>
                        <div class="card-controls">
                            <div class="report-export">
                                <a href="#" class="btn" name="buttonReportExport">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
                                        <path d="M20 13.5L17 10.5L14 13.5" stroke="#0084FF" stroke-width="2"/>
                                        <path d="M10 15V24H24V15" stroke="#0084FF" stroke-width="2"/>
                                        <path d="M17 11V19" stroke="#0084FF" stroke-width="2"/>
                                    </svg>
                                </a>
                            </div>
                            <div class="report-more dropdown">
                                <button class="btn" type="button" id="dropdownMoreButton" data-toggle="dropdown" aria-expanded="false">
                                    <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11 19C12.1046 19 13 18.1046 13 17C13 15.8954 12.1046 15 11 15C9.89543 15 9 15.8954 9 17C9 18.1046 9.89543 19 11 19ZM19 17C19 18.1046 18.1046 19 17 19C15.8954 19 15 18.1046 15 17C15 15.8954 15.8954 15 17 15C18.1046 15 19 15.8954 19 17ZM25 17C25 18.1046 24.1046 19 23 19C21.8954 19 21 18.1046 21 17C21 15.8954 21.8954 15 23 15C24.1046 15 25 15.8954 25 17Z" fill="#0084FF"/>
                                    </svg>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMoreButton">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="custom-reports__card">
                        <a href="{{route('reports.show', ['reportType'=>'returns','reportId'=>1,])}}" class='link-overlay'></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="custom-reports__card">
                        <a href="{{route('reports.show', ['reportType'=>'returns','reportId'=>1,])}}" class='link-overlay'></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="custom-reports__card">
                        <a href="{{route('reports.show', ['reportType'=>'returns','reportId'=>1,])}}" class='link-overlay'></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Returns end -->
    </div>

@endsection

@pushonce('js_after:gridSettings')

@endpushonce

@push('js_after')
@endpush

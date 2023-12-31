@extends('layouts.app')

@push('css_before')
@endpush

@push('css_after')
<style>
	.dx-datagrid-group-space + td::before {
		content: none !important;
	}
	.dx-pages[style="visibility: hidden;"] {
		display: none;
	}

	.dx-loadpanel-content {
		margin: 2rem !important;
	}

	/* Hover effect */
	.dx-data-row.dx-state-hover:not(.dx-selection):not(.dx-row-inserted):not(.dx-row-removed):not(.dx-edit-row) > td:not(.dx-focused) {
		background-color: #fff !important;
		cursor: pointer;
	}
	table.dx-datagrid-table tbody tr.dx-header-row.dx-state-hover {
		background-color: #fff;
	}
	/* Visibility selectbox customization */
	.dx-list .dx-list-item.dx-list-item-selected,
	.dx-list .dx-list-item.dx-list-item-selected.dx-state-hover {
		background: linear-gradient(0deg, rgba(0, 132, 255, 0.2), rgba(0, 132, 255, 0.2)), #FFFFFF;
	}
	.dx-list .dx-list-item.dx-state-hover {
		background: linear-gradient(0deg, rgba(0, 132, 255, 0.1), rgba(0, 132, 255, 0.1)), #FFFFFF;
	}
	.dx-checkbox-icon,
	.dx-radiobutton-icon,
	.dx-radiobutton-icon:before {
		background-color: transparent;
	}
	.dx-list-select-radiobutton .dx-radiobutton-icon:before,
	.dx-list .dx-list-item .dx-checkbox-icon:before {
		background: url("data:image/svg+xml,%3Csvg width='10' height='9' viewBox='0 0 10 9' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M9.16668 0.666016L4.16668 7.33268L0.833344 4.83268' stroke='rgba(0, 29, 97, 0.2)' stroke-width='2'/%3E%3C/svg%3E%0A") center bottom no-repeat;
	}
	.dx-list-select-radiobutton[aria-checked="true"] .dx-radiobutton-icon:before,
	.dx-list-item.dx-state-focused .dx-list-select-radiobutton:not([aria-checked="false"]) .dx-radiobutton-icon:before,
	.dx-list-item.dx-state-active .dx-list-select-radiobutton:not([aria-checked="false"]) .dx-radiobutton-icon:before,
	.dx-list .dx-checkbox-checked .dx-checkbox-icon:before {
		border-image-source: linear-gradient(to right, #06B68C, #fff);
		background: url("data:image/svg+xml,%3Csvg width='10' height='9' viewBox='0 0 10 9' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M9.16668 0.666016L4.16668 7.33268L0.833344 4.83268' stroke='%2306B68C' stroke-width='2'/%3E%3C/svg%3E%0A") center bottom no-repeat;
	}

	.dx-datagrid .dx-header-filter-empty {
		-webkit-transition: background-image 0.2s ease-in-out;
		transition: background-image 0.2s ease-in-out;
	}
	.dx-header-filter-upward {
		background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 7L6 2L1 7' stroke='%23404040' stroke-width='2'/%3E%3C/svg%3E") !important;
	}

	.dx-datagrid-pager.dx-pager {
		background: var(--color-lighter);
	}
</style>
@endpush

@section('content')
<header class='reports-nav'>

	<x-nav.section title="Reports">
		<x-nav.link href="#watch-guide" text="Watch Guide" icon="play" text-class="text-gd-blue" icon-color="blue" />
        <div class="btn-with-modal">
            <x-nav.link href="#save_as" id="save_as" text="Save As" icon="empty" text-class="text-gd-blue"
                        icon-color="blue"
                        data-toggle="modal" data-target="#save_as_modal"/>
            <div class="modal" id="save_as_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{$saveAsModalTitle}}</h5>
                        </div>
                        <form id="report_name_form" novalidate>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label class="small" for="report_name">Name Your Report</label>
                                    <input type="text" class="form-control" id="report_name"
                                           aria-describedby="newReportName" placeholder="Example Name" required>
                                    <div class="invalid-feedback">
                                        Please enter a nonempty name for report!
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button id="save_as_save_btn" type="submit" class="btn btn-primary btn-gradient">Save
                                    New Report
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

		<x-nav.link href="#save" id="save" text="Save" icon="empty" text-class="text-gd-blue" icon-color="blue" />
		<x-nav.link href="{{route('reports.index')}}" text="" icon="close" text-class="text-gd-blue" icon-color="blue" />
	</x-nav.section>
</header>

	<div class="content content-narrow pb-20">
		<div class="overflow-hidden">
			<div id="report"></div>
			<div class="bg-white height-20 rounded-bottom"></div>
		</div>
	</div>


@endsection

@pushonce('js_after:gridSettings')
	<script src="{{ asset('js/globalGridSettings.js') }}"></script>
@endpushonce

@push('js_after')
    <script>
        const token = "{{ csrf_token() }}";
        const saveAsUrl = "{{ $createUrl }}";
        const saveUrl = "{{ $saveUrl }}";
        const saveAsModal = $('#save_as_modal');
        const loadingModal = $('#loading');
        const reportNameForm = document.getElementById('report_name_form');
        const reportName = document.getElementById('report_name');
        let isLoading = false;
        let reportNameValue = () => reportName.value.trim();
        let reportNameValueIsEmpty = () => reportNameValue() === '';
        let openSaveAsModal = () => saveAsModal.modal('show');
        let closeSaveAsModal = () => saveAsModal.modal('hide');
        let closeLoadingModal = () => loadingModal.modal('hide');
        let openLoadingModal = () => loadingModal.modal('show');
        let removeValidationErrors = () => reportNameForm.classList.remove('was-validated');
        let getGridInstance = el => $(el).dxDataGrid('instance');
        let validateReportNameForm = () => {
            reportName.value = reportNameValue();
            if (reportNameForm.checkValidity() === false) {
                reportNameForm.classList.add('was-validated');
                return false;
            }
            return true;
        }
        let prepareData = (cb) => {
            let grid = getGridInstance("#report");
            let rowKey = grid.getKeyByRowIndex(0);
            $.when(grid.expandRow(rowKey))
                .then(() => {
                    grid.collapseRow(rowKey);
                    cb(grid.state(), getGridInstance('.master-detail').state());
                });
        };
        reportName.addEventListener('keydown', removeValidationErrors);
        reportNameForm.addEventListener('submit', (event)=>{
            event.preventDefault();
            event.stopPropagation();
            return false;
        });
        saveAsModal.on('show.bs.modal', function () {
            removeValidationErrors();
            reportName.value = '';
        })
        saveAsModal.on('shown.bs.modal', function () {
            reportName.focus();
        })
        $("#save_as").click(function (e) {
            if (!isLoading) {
                isLoading = true;
                e.preventDefault();
                e.stopPropagation();
                openSaveAsModal()
            }
        });
        $('#save_as_save_btn').click(async (e) => {
            /*@todo
            * - https://js.devexpress.com/Documentation/ApiReference/UI_Components/dxDataGrid/Methods/#state
            * - https://js.devexpress.com/Documentation/ApiReference/UI_Components/dxDataGrid/Methods/#option
            * - https://js.devexpress.com/Documentation/ApiReference/UI_Components/dxDataGrid/Methods/#getCombinedFilter
            * */
            e.preventDefault();
            e.stopPropagation();
            if (validateReportNameForm()) {
                prepareData((outerGridState, internalGridState) => {
                    closeSaveAsModal();
                    setTimeout(()=>{
                        $.post({
                            url: saveAsUrl,
                            contentType: "application/json; charset=utf-8",
                            dataType: "json",
                            data: JSON.stringify({
                                name: reportNameValue(),
                                mainGrid: outerGridState,
                                internalGrid: internalGridState,
                                _token: token
                            })
                        }).done(function (data) {
                            alert("New report saved!");
                            isLoading = false;
                        }).fail(function (jqXHR, textStatus) {
                            alert("Some error happened!");
                            isLoading = false;
                        });
                    },0)
                })
            }
        })
        $( "#save" ).click(function(e) {
            if (!isLoading) {
                isLoading = true;
            e.preventDefault();
            e.stopPropagation();
                prepareData((outerGridState, internalGridState) => {
                    $.post({
                        url: saveUrl,
                        contentType: "application/json; charset=utf-8",
                        dataType: "json",
                        data: JSON.stringify({
                            mainGrid: outerGridState,
                            internalGrid: internalGridState,
                            _token: token
                        })
                    }).done(function (data) {
            alert( "Changes saved!");
                        isLoading = false;
                    }).fail(function (jqXHR, textStatus) {
                        alert("Some error happened!");
                        isLoading = false;
                    });
                })
            }
        });
    </script>
	<script src="{{ asset('/js/demo/reports-order_data.js') }}"></script>
	<script>
		$(function() {
			window.dataGrid = $("#report").dxDataGrid( $.extend(true, {}, globalGridSettings, {
				dataSource: orders,
				keyExpr: "id",
                columnChooser: {
                    mode: "select",//https://js.devexpress.com/Documentation/ApiReference/UI_Components/dxDataGrid/Configuration/columnChooser/
                    width: 160
                },
                onToolbarPreparing: function(event) {
                const dataGrid = event.component;
                event.toolbarOptions.elementAttr = {class: "rounded"};
                event.toolbarOptions.items = [
                    // Date Range Picker
                    {
                        location: "before",
                        widget: "dxButton",
                        locateInMenu: "never",
                        options: {
                            elementAttr: {class: "bg-blue-10 rounded"},
                            icon: `<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M4 0H6V1H10V0H12V1H16V16H0V1H4V0ZM7 5H4V7H7V5ZM4 10H7V12H4V10ZM12 5H9V7H12V5ZM9 10H12V12H9V10ZM2 14V3H14V14H2Z" fill="#001D61"/></svg>`,
                            stylingMode: "text",
                            template: t => {
                                return `
							<span class="dx-icon">${t.icon}</span>
							<span>${ (new Date()).toLocaleDateString() }</span>
							<span class="text-muted">to</span>
							<span>${ (new Date()).toLocaleDateString() }</span>
					`},
                            onClick: () => {
                                console.info( 'Date Picker Clicked!' );
                            }
                        }
                    },
                    {
                        location: "before",
                        template: () => `<span class="divider"></span>`
                    },
                    // Somehow generate array of custom filters
                    {
                        location: 'before',
                        widget: 'dxSelectBox',
                        locateInMenu: 'auto',
                        options: {
                            elementAttr: {class: "bg-blue-10 rounded"},
                            // items: FILTER_VALUES,
                            valueExpr: "id",
                            displayExpr: "text",
                            stylingMode: "filled",
                            // value: FILTER_VALUES[0].id,
                            onValueChanged: function(args) {
                                console.info( 'Filter Changed!', args );
                                if(args.value > 1) { // First index is "ALL" here
                                    dataGrid.filter("type" , "=", args.value);
                                } else {
                                    dataGrid.filter(null);
                                }
                                dataGrid.load();
                            }
                        }
                    },
                    {
                        location: 'before',
                        widget: 'dxSelectBox',
                        locateInMenu: 'auto',
                        options: {
                            elementAttr: {class: "bg-blue-10 rounded"},
                            // items: FILTER_VALUES,
                            valueExpr: "id",
                            displayExpr: "text",
                            stylingMode: "filled",
                            // value: FILTER_VALUES[0].id,
                            onValueChanged: function(args) {
                                console.info( 'Filter Changed!', args );
                                if(args.value > 1) { // First index is "ALL" here
                                    dataGrid.filter("type" , "=", args.value);
                                } else {
                                    dataGrid.filter(null);
                                }
                                dataGrid.load();
                            }
                        }
                    },
                    {
                        location: "before",
                        template: () => `<span class="divider"></span>`
                    },
                    { // Custom Filter
                        location: "before",
                        widget: "dxButton",
                        locateInMenu: "auto",
                        options: {
                            elementAttr: {class: "bg-blue-10 rounded"},
                            icon: `<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 4.5V1H15V4.5L10 8.5V14.5375L6 13V8.5L1 4.5Z" stroke="#001D61" stroke-width="2"/></svg>`,
                            text: "Create Filter",
                            stylingMode: "text",
                            onClick: () => {
                                console.info( 'Create Filter Clicked!' );
                                console.log( event );
                                // dataGrid._showFilterBuilder();
                            }
                        }
                    },
                    { // Column Chooser
                        location: "before",
                        widget: "dxButton",
                        locateInMenu: "auto",
                        options: {
                            elementAttr: {class: "bg-blue-10 rounded column-chooser-btn"},
                            icon: `<svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="16" width="2" height="16" transform="rotate(90 16 0)" fill="#001D61"/>
						<rect x="2" y="12" width="2" height="12" transform="rotate(-180 2 12)" fill="#001D61"/>
						<rect x="7" y="12" width="2" height="12" transform="rotate(-180 7 12)" fill="#001D61"/>
						<rect x="16" y="12" width="2" height="12" transform="rotate(-180 16 12)" fill="#001D61"/>
						<rect x="16" y="10" width="2" height="16" transform="rotate(90 16 10)" fill="#001D61"/>
						<rect x="16" y="5" width="2" height="16" transform="rotate(90 16 5)" fill="#001D61"/>
					</svg>`,
                            text: "Column Chooser",
                            stylingMode: "text",
                            onClick: () => {
                                console.info( 'Column Chooser Clicked!' );
                                dataGrid.showColumnChooser();
                            }
                        }
                    },
                    {
                        location: "before",
                        template: () => `<span class="divider"></span>`
                    },
                    { // Search
                        location: "before",
                        widget: "dxTextBox",
                        locateInMenu: "never",
                        options: {
                            elementAttr: {class: "bg-blue-10 rounded"},
                            // icon: `table`,
                            placeholder: "Search Criteria",
                            stylingMode: "filled",
                            onValueChanged: data => {
                                console.info( 'Search Entered!', data );
                                // dataGrid.doSomeSearchThing();
                            }
                        }
                    },
                    { // Export
                        location: "after",
                        widget: "dxButton",
                        locateInMenu: "auto",
                        options: {
                            elementAttr: {class: "bg-blue-10 rounded"},
                            icon: `<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M11 4.5L8 1.5L5 4.5" stroke="#001D61" stroke-width="2"/>
						<path d="M1 6V15H15V6" stroke="#001D61" stroke-width="2"/>
						<path d="M8 2V10" stroke="#001D61" stroke-width="2"/>
					</svg>`,
                            stylingMode: "text",
                            onClick: () => {
                                    dataGrid.exportToExcel();
                            }
                        }
                    },
                    { // Items per Page
                        location: "after",
                        widget: "dxDropDownButton",
                        locateInMenu: "auto",
                        options: {
                            elementAttr: {class: "bg-blue-10 rounded"},
                            useSelectMode: true,
                            showArrowIcon: false,
                            dropDownOptions: {
                                width: 230
                            },
                            keyExpr: 'id',
                            itemTemplate: data => `Show ${data.value} results`,
                            selectedItemKey: 2,
                            stylingMode: "text",
                            onContentReady: e => {
                                setTimeout(() => {
                                    let range_str = `${dataGrid.pageSize() * dataGrid.pageIndex() + 1}-${dataGrid.pageSize() * dataGrid.pageIndex() + dataGrid.pageSize()}`;
                                    let total_count = dataGrid.totalCount();
                                    e.component.option('text', `${range_str} of ${total_count}`);
                                }, 500);
                            },
                            onSelectionChanged: e => {
                                console.info( 'Item Count Clicked!', e, dataGrid );
                                dataGrid.pageSize( e.item.value != 'all' ? e.item.value : dataGrid.totalCount() );

                                let range_str = `${dataGrid.pageSize() * dataGrid.pageIndex() + 1}-${dataGrid.pageSize() * dataGrid.pageIndex() + dataGrid.pageSize()}`;
                                let total_count = dataGrid.totalCount();
                                e.component.option('text', `${range_str} of ${total_count}`);
                            },
                            items: [{id: 1, value: 10}, {id: 2, value: 20}, {id: 3, value: 50}, {id: 4, value: 100}, {id: 5, value: 'all'}]
                        }
                    },
                    { // Page Back
                        location: "after",
                        widget: "dxButton",
                        locateInMenu: "never",
                        options: {
                            elementAttr: {class: "bg-blue-10 rounded"},
                            icon: `<svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 1L2 6L7 11" stroke="#001D61" stroke-width="2"/></svg>`,
                            stylingMode: "text",
                            onClick: () => {
                                console.info( 'Page Back Clicked!' );
                                dataGrid.pageIndex( Math.max(0, dataGrid.pageIndex() - 1) );
                            }
                        }
                    },
                    { // Page Forward
                        location: "after",
                        widget: "dxButton",
                        locateInMenu: "never",
                        options: {
                            elementAttr: {class: "bg-blue-10 rounded"},
                            icon: `<svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 11L6 6L1 1" stroke="#001D61" stroke-width="2"/></svg>`,
                            stylingMode: "text",
                            onClick: () => {
                                console.info( 'Page Forward Clicked!' );
                                dataGrid.pageIndex( Math.min(dataGrid.pageCount() - 1, dataGrid.pageIndex() + 1) );
                            }
                        }
                    },
                ]
            },
				onExporting: function(e) {
					var workbook = new ExcelJS.Workbook();
					var worksheet = workbook.addWorksheet('Orders');
					DevExpress.excelExporter.exportDataGrid({
						component: e.component,
						worksheet: worksheet,
                        autoFilterEnabled: false
					}).then(function() {
						workbook.xlsx.writeBuffer().then(function(buffer) {
							saveAs(new Blob([buffer], {
								type: 'application/octet-stream'
							}), 'Orders.xlsx');
						});
					});
					e.cancel = true;
				},
				onContentReady: function(e) {
					e.element.find('.dx-datagrid-rowsview tr').each(function(i, el){
						el = $(el);
						let rowindex = el.attr('aria-rowindex');
						el.find('td:first-child').attr('data-rowindex', rowindex);
					});
				},
				columns: [
                    {
                        dataField: "order_id",
                        caption: "Order ID"
                    },
                    {
                        dataField: "state",
                        caption: "Order Status"
                    },
                    {
                        dataField: "last_ship_date",
                        caption: "Last Ship Date",
                        dataType: "date"
                    },
                    {
                        dataField: "delivery_contact.name",
                        caption: "Name",
                        width: 150
                    },
                    {
                        dataField: "delivery_contact.city",
                        caption: "City"
                    },
                    {
                        dataField: "delivery_contact.state_or_province_code",
                        caption: "State"
                    },
                    {
                        dataField: "customer_reference_number",
                        caption: "Reference Number",
                        width: 150,
                        visible: false
                    },
                    {
                        dataField: "purchase_order_number",
                        caption: "Reference PO Number",
                        visible: false
                    },
                    {
                        dataField: "delivery_terms",
                        caption: "Delivery Terms",
                        alignment: "center",
                        visible: false
                    },
                    {
                        dataField: "channel_name",
                        caption: "Channel",
                        visible: false
                    },
                    {
                        dataField: "business_model",
                        caption: "Business Model",
                        visible: false
                    },
                    {
                        dataField: "shipping_method_name",
                        caption: "Ship Method",
                        visible: false
                    },
                    {
                        dataField: "ship_earliest_on",
                        caption: "No Earlier Than",
                        dataType: "datetime",
                        visible: false
                    },
                    {
                        dataField: "ship_latest_on",
                        caption: "No Later Than",
                        dataType: "datetime",
                        visible: false
                    },
                    {
                        dataField: "ship_at",
                        caption: "SLA",
                        dataType: "datetime",
                        visible: false
                    },
                    {
                        dataField: "created_at",
                        caption: "Created",
                        dataType: "datetime",
                        visible: false
                    },
                    {
                        dataField: "updated_at",
                        caption: "Updated",
                        dataType: "datetime",
                        visible: false
                    },
                    {
                        dataField: "delivery_contact.company",
                        caption: "Company",
                        visible: false
                    },
                    {
                        dataField: "delivery_contact.address_lines",
                        caption: "Address",
                        visible: false
                    },
                    {
                        dataField: "delivery_contact.postal_code",
                        caption: "ZIP",
                        visible: false
                    },
                    {
                        dataField: "delivery_contact.country_code",
                        caption: "Country",
                        visible: false
                    },
                    {
                        dataField: "delivery_contact.phone_number",
                        caption: "Phone",
                        visible: false
                    },
                    {
                        dataField: "delivery_contact.fax_number",
                        caption: "Fax",
                        visible: false
                    },
                    {
                        dataField: "delivery_contact.email",
                        caption: "Email",
                        visible: false
                    }],
				masterDetail: {
					enabled: true,
					template: function(container, options) {
						var currentOrderData = options.data;
                        $("<div class='master-detail'>").dxDataGrid($.extend(true, {}, globalGridSettings, {
							columns: [
                                {
                                    dataField: "origin_location_name",
                                    caption: "Shipped From"
                                },
                                {
                                    dataField: "product_number",
                                    caption: "Product ID",
                                },
                                {
                                    dataField: "product_name",
                                    caption: "Product Name"
                                },
                                {
                                    dataField: "quantity",
                                    caption: "Qty",
                                    alignment: "right"
                                },
                                {
                                    dataField: "description",
                                    caption: "Product Description",
                                    visible: false
                                },
                                {
                                    dataField: "backordered_quantity",
                                    caption: "Backordered Qty",
                                    alignment: "right",
                                    visible: false
                                },
                                {
                                    dataField: "allocated_quantity",
                                    caption: "Allocated Qty",
                                    alignment: "right",
                                    visible: false
                                },
                                {
                                    dataField: "shipped_quantity",
                                    caption: "Shipped Qty",
                                    alignment: "right",
                                    visible: false
                                }
                            ],
                            columnChooser: {
                                mode: "select",
                                width: 160
                            },
							onToolbarPreparing: event => {
								const dataGrid = event.component;
								event.toolbarOptions.elementAttr = {class: "rounded"};
								event.toolbarOptions.items = [
									{
										location: "before",
										template: () => `
											<strong>Order ID:</strong>
											<span class="text-blue">${currentOrderData.order_id}</span>
										`
									},
									{
										location: "before",
										template: () => `<span class="divider"></span>`
									},
									{ // Custom Filter
										location: "before",
										widget: "dxButton",
										locateInMenu: "auto",
										options: {
											elementAttr: {class: "bg-blue-10 rounded"},
											icon: `<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 4.5V1H15V4.5L10 8.5V14.5375L6 13V8.5L1 4.5Z" stroke="#001D61" stroke-width="2"/></svg>`,
											text: "Create Filter",
											stylingMode: "text",
											onClick: () => {
												console.info( 'Create Filter Clicked!' );
												console.log( event );
												// dataGrid._showFilterBuilder();
											}
										}
									},
									{ // Column Chooser
										location: "before",
										widget: "dxButton",
										locateInMenu: "auto",
										options: {
											elementAttr: {class: "bg-blue-10 rounded column-chooser-btn"},
											icon: `<svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
												<rect x="16" width="2" height="16" transform="rotate(90 16 0)" fill="#001D61"/>
												<rect x="2" y="12" width="2" height="12" transform="rotate(-180 2 12)" fill="#001D61"/>
												<rect x="7" y="12" width="2" height="12" transform="rotate(-180 7 12)" fill="#001D61"/>
												<rect x="16" y="12" width="2" height="12" transform="rotate(-180 16 12)" fill="#001D61"/>
												<rect x="16" y="10" width="2" height="16" transform="rotate(90 16 10)" fill="#001D61"/>
												<rect x="16" y="5" width="2" height="16" transform="rotate(90 16 5)" fill="#001D61"/>
											</svg>`,
											text: "Column Chooser",
											stylingMode: "text",
											onClick: () => {
												console.info( 'Column Chooser Clicked!' );
												dataGrid.showColumnChooser();
											}
										}
									},
								]
							},
							summary: {
								totalItems: [{
									column: "product_number",
									summaryType: "count",
									displayFormat: "Product Count: {0}"
								}]
							},
							dataSource: new DevExpress.data.DataSource({
								store: new DevExpress.data.ArrayStore({
									key: "order_id",
									data: orderLines
								}),
								filter: ["order_id", "=", options.key]
							})
						}) ).appendTo(container);
					}
				}
			} )).dxDataGrid('instance');
		});
			$('.btn-with-modal a').on('click', function() {
				$(this).toggleClass("active");
				var interval=setInterval(findBackDrop, 100);

				function findBackDrop() {
					console.log('looking for backdrop...');
					if ($('.modal-backdrop').length == 1) {
						console.log('backdrop found...');
						$('.modal-backdrop').on('click', function() {
								$('.btn-with-modal a').toggleClass("active");
								$('.modal.show').click();
						});
						clearInterval(interval);
					}
				}

			});

			var checkPageLoad = setInterval(findButton, 100);

			function findButton() {
				if ($('div[aria-label="Column Chooser"]').length == 1) {
					clearInterval(checkPageLoad);
					$('div[aria-label="Column Chooser"]').on('click', function() {
						// if($('.dx-overlay-wrapper.dx-datagrid-column-chooser').length == 0){
							// $(this).toggleClass('active');
							var thisLeftPosition = $('div[aria-label="Column Chooser"]').offset().left - 100;
							var buttonWidth =$('div[aria-label="Column Chooser"]').width();
							var interval = setInterval(findOverlay, 100);


							function findOverlay(){
								console.log('looking for overlay...');
								if ($('.dx-overlay-wrapper.dx-datagrid-column-chooser').length == 1) {
									var thisHeight = $('.dx-overlay-wrapper.dx-datagrid-column-chooser').height() + 80;

									console.log(thisHeight);
									console.log('this left pos' + thisLeftPosition);
									$('.dx-overlay-wrapper.dx-datagrid-column-chooser').css('top','-80px');
									$('.dx-overlay-wrapper.dx-datagrid-column-chooser').css('height',thisHeight+'px');
									$('.dx-overlay-wrapper.dx-datagrid-column-chooser .dx-overlay-content').attr('style','transform: translate('+thisLeftPosition+'px, 0px)');
									$('.dx-overlay-wrapper.dx-datagrid-column-chooser .dx-overlay-content').css('width', buttonWidth);
									clearInterval(interval);
								}
							}

						// }

					});
				}
			}



	</script>
@endpush

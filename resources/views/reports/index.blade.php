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
	<x-nav.section title="Reports">
		<x-nav.link href="#demo-link" text="New Criteria" icon="new" text-class="text-gd-blue" icon-color="blue" />
	</x-nav.section>

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
	<script src="{{ asset('/js/demo/reports-order_data.js') }}"></script>
	<script>
		$(function() {

			// $('.export-excel').click(function(){
			// 	dataGrid.exportToExcel({
			// 		autoFilterEnabled: true
			// 	});
			// });

			window.dataGrid = $("#report").dxDataGrid( $.extend(true, {}, globalGridSettings, {
				dataSource: orders,
				keyExpr: "id",
				onExporting: function(e) {
					var workbook = new ExcelJS.Workbook();
					var worksheet = workbook.addWorksheet('Orders');
					DevExpress.excelExporter.exportDataGrid({
						component: e.component,
						worksheet: worksheet,
						autoFilterEnabled: true
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
				columns: [{
					dataField: "order_id",
					caption: "Order ID"
				}, {
					dataField: "state",
					caption: "Order Status"
				}, {
					dataField: "last_ship_date",
					caption: "Last Ship Date",
					dataType: "date"
				}, {
					dataField: "delivery_contact.name",
					caption: "Name",
					width: 150
				}, {
					dataField: "delivery_contact.city",
					caption: "City"
				}, {
					dataField: "delivery_contact.state_or_province_code",
					caption: "State"
				}, {
					dataField: "customer_reference_number",
					caption: "Reference Number",
					width: 150,
					visible: false
				}, {
					dataField: "purchase_order_number",
					caption: "Reference PO Number",
					visible: false
				}, {
					dataField: "delivery_terms",
					caption: "Delivery Terms",
					alignment: "center",
					visible: false
				}, {
					dataField: "channel_name",
					caption: "Channel",
					visible: false
				}, {
					dataField: "business_model",
					caption: "Business Model",
					visible: false
				}, {
					dataField: "shipping_method_name",
					caption: "Ship Method",
					visible: false
				}, {
					dataField: "ship_earliest_on",
					caption: "No Earlier Than",
					dataType: "datetime",
					visible: false
				}, {
					dataField: "ship_latest_on",
					caption: "No Later Than",
					dataType: "datetime",
					visible: false
				}, {
					dataField: "ship_at",
					caption: "SLA",
					dataType: "datetime",
					visible: false
				}, {
					dataField: "created_at",
					caption: "Created",
					dataType: "datetime",
					visible: false
				}, {
					dataField: "updated_at",
					caption: "Updated",
					dataType: "datetime",
					visible: false
				}, {
					dataField: "delivery_contact.company",
					caption: "Company",
					visible: false
				}, {
					dataField: "delivery_contact.address_lines",
					caption: "Address",
					visible: false
				}, {
					dataField: "delivery_contact.postal_code",
					caption: "ZIP",
					visible: false
				}, {
					dataField: "delivery_contact.country_code",
					caption: "Country",
					visible: false
				}, {
					dataField: "delivery_contact.phone_number",
					caption: "Phone",
					visible: false
				}, {
					dataField: "delivery_contact.fax_number",
					caption: "Fax",
					visible: false
				}, {
					dataField: "delivery_contact.email",
					caption: "Email",
					visible: false
				}],
				// summary: {
				// 	totalItems: [{
				// 		column: "order_id",
				// 		summaryType: "count",
				// 		displayFormat: "Order Count: {0}"
				// 	}]
				// },
				masterDetail: {
					enabled: true,
					template: function(container, options) {
						var currentOrderData = options.data;
						$("<div>").dxDataGrid( $.extend(true, {}, globalGridSettings, {
							columns: [{
								dataField: "origin_location_name",
								caption: "Shipped From"
							}, {
								dataField: "product_number",
								caption: "Product ID",
							}, {
								dataField: "product_name",
								caption: "Product Name"
							}, {
								dataField: "quantity",
								caption: "Qty",
								alignment: "right"
							}, {
								dataField: "description",
								caption: "Product Description",
								visible: false
							}, {
								dataField: "backordered_quantity",
								caption: "Backordered Qty",
								alignment: "right",
								visible: false
							}, {
								dataField: "allocated_quantity",
								caption: "Allocated Qty",
								alignment: "right",
								visible: false
							}, {
								dataField: "shipped_quantity",
								caption: "Shipped Qty",
								alignment: "right",
								visible: false
							}],
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
											elementAttr: {class: "bg-blue-10 rounded"},
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
	</script>
@endpush
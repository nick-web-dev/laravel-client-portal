var globalGridSettings = {
	showBorders: false,
	rowAlternationEnabled: false,
	allowColumnReordering: true,
	allowColumnResizing: true,
	columnResizingMode: "widget",
	pager: {
		allowedPageSizes: [10, 20, 50, 100, 'all'],
		showInfo: true,
		showNavigationButtons: true,
		showPageSizeSelector: true,
		visible: false
	},
	paging: {
		pageSize: 20
	},
	selection: {
		mode: "multiple"
	},
	sorting: {
		mode: "multiple"
	},
	columnChooser: {
		enabled: true
	},
	columnFixing: {
		enabled: true
	},
	filterPanel: {
		visible: false
	},
	filterRow: {
		visible: true,
		applyFilter: "auto"
	},
	headerFilter: {
		visible: true
	},
	searchPanel: {
		visible: true,
		width: 240,
		placeholder: "Enter Search Criteria..."
	},
	elementAttr: {
		class: 'table-numbered rounded'
	},
	export: {
		enabled: true,
		allowExportSelectedData: true
	},
	onRowPrepared: e => {
		if(e.rowType == "filter"){
			e.rowElement.css('height', '35px');
		}
	},
	onEditorPreparing: e => {
		if (e.parentType == "filterRow") {
			e.editorOptions.height = 34;
			// e.editorOptions.stylingMode = 'filled';
		}
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
						console.info( 'Export Clicked!' );
						// dataGrid.exportToExcel({
						// 	autoFilterEnabled: true
						// });
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
	}
};
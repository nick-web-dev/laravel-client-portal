@extends('layouts.app')

@push('css_before')
	<link rel="stylesheet" href="{{ asset('/js/plugins/flatpickr/flatpickr.min.css') }}">
@endpush

@push('css_after')
	<style>
		.dx-header-row td:nth-child(8) .dx-header-filter {
			cursor: pointer;
		}
		.dx-header-row td:not(:nth-child(7)) .dx-sort-none {
			display: none !important;
		}
		.dx-pages[style="visibility: hidden;"] {
			display: none;
		}
		.dx-loadpanel-content {
			margin: 2rem !important;
		}

		.dx-density-1x .dx-data-row td {
			font-size: 0.85em;
			padding: 3px 10px;
		}
		.dx-density-2x .dx-data-row td {
			font-size: 0.95em;
			padding: 6px 18px;
		}
		.dx-density-3x .dx-data-row td {
			padding: 8px 22px;
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
		.dx-datagrid .dx-row > td > .current-status svg {
			cursor: pointer;
			transition: all .2s ease-in-out;
		}
		.dx-datagrid .dx-row > td > .to-change {
			display: none;
		}
		.dx-datagrid .dx-row > td > .current-status:hover svg {
			transform: scale(1.1);
		}
		.dx-dropdowneditor-icon:before {
			content: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L6 6L11 1' stroke='%23001D61' stroke-width='2'/%3E%3C/svg%3E");
			margin-top: -12px;
		}
		.dx-header-filter-clicked {
			background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 7L6 2L1 7' stroke='%23001D61' stroke-width='2'/%3E%3C/svg%3E") !important;
		}

		.dx-datagrid-pager.dx-pager {
			background: var(--color-lighter);
		}
		.dx-datagrid .dx-column-lines > td:last-child a {
			text-decoration: none;
		}
	</style>
@endpush

@section('content')
<x-nav.section title="Announcement">
	<x-nav.link :href="route('announcement-create')" text="New" icon="new" text-class="text-gd-blue" icon-color="blue" />
</x-nav.section>

<div class="content content-boxed pb-20">
	@php 
		$statuses = ['draft' => 'Draft', 'scheduled' => 'Publish'];
	@endphp

	<div class="d-flex justify-content-between bg-lighter rounded p-4 mb-2">
		<div>
			<div id="status-filter" class="form-control bg-dark-blue-10 text-dark rounded border-0"></div>
		</div>
		{{-- @if( $announcements->count() > 20 ) --}}
		<div class="text-right">
			<span class="btn btn-sm text-dark bg-dark-blue-10 rounded" id="record-limit-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="text-monospace">{{ $table_meta->range[0] }}-{{ $table_meta->range[1] }}</span> 
				<span class="text-muted">of</span> 
				<span class="text-monospace">{{ $table_meta->record_total }}</span>
			</span>
			<div class="dropdown-menu p-0" aria-labelledby="record-limit-dropdown">
				<div class="p-2">
					<div class="p-4">Results per page</div>
					<div role="separator" class="dropdown-divider"></div>
					<button type="button" data-value="10" class="dropdown-item record-limit">
						Show 10 results
					</button>
					<button type="button" data-value="20" class="dropdown-item record-limit">
						Show 20 results
					</button>
					<button type="button" data-value="50" class="dropdown-item record-limit">
						Show 50 results
					</button>
					<button type="button" data-value="100" class="dropdown-item record-limit">
						Show 100 results
					</button>
				</div>
			</div>
			<button class="btn border-0 btn-sm icon bg-dark-blue-10 text-dark rounded prev-page">
				<i class="fa fa-fw fa-chevron-left"></i>
			</button>
			<button class="btn border-0 btn-sm icon bg-dark-blue-10 text-dark rounded next-page">
				<i class="fa fa-fw fa-chevron-right"></i>
			</button>
		</div>
		{{-- @endif --}}
	</div>

	<div id="announcements-container" class="overflow-hidden rounded-top">
	</div>

	<div id="density-popup"></div>

    <div class="modal announcement-modal type-announcement" tabindex="-1" role="dialog" aria-hidden="true" id="preview-ann" aria-labelledby="preview-ann">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content rounded-0">
                <div class="block mb-0">
                    <div class="block-header clearfix">
                        <div class="header-top">
                            <h3 class="block-title" id="modal-title"></h3>
                            <div class="block-options">
                                <a href="javascript:void(0)" data-dismiss="modal" aria-label="Close" class="text-blue">
                                	<x-icons.close-16x />
                                </a>
                            </div>
                        </div>
                        <div class="block-meta">
                            <span class="author" id="modal-author"></span>
                            {{-- <span class="time-elapsed"></span> --}}
                            <span class="time-elapsed" id="modal-status"></span>
                        </div>
                    </div>
                    <div class="modal-media">
                        <img src="/storage/media/placeholder-ann_size.png" id="modal-img" alt="" class="d-block img-fluid mx-auto">
                    </div>
                     <div class="block-content bg-light prev-content">
                        <div id="modal-content-block" class="text-dark"></div>
                    </div> 
                    <div class="block-content block-footer p-0 d-flex">
                        <button type="button" class="btn btn-default btn-blue btn-xl flex-grow-1" data-dismiss="modal">Done</button>
                        {{-- <a href="#" class="btn btn-dark btn-xl flex-grow-1" data-dismiss="modal" id="modal-action"></a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>    

</div>

<div class="d-none">
	<textarea id="simplemde"></textarea>
</div>
@endsection

@php
	$subs = \App\Services\Rushmore::$subscriptions;
	array_pop($subs); // removes OWDrep from this list
	$sub_colors = array_combine($subs, [
		'orange', 'blue', 'yellow'//,  'black' // <--- last one is for OWDrep
	]);

	$subs_index = [];
	foreach ($sub_colors as $sub_name => $sub_color) {
		$subs_index[] = ['label' => $sub_name, 'color' => $sub_color];
	}
@endphp

@push('js_after')
	<script src="{{ asset('js/plugins/simplemde/simplemde.min.js') }}"></script>
	<script>

		var subs_index = {!! json_encode($subs_index) !!};
		var statuses = ['All Statuses', 'Scheduled', 'Draft'];

		var density = localStorage.gridDensity =  localStorage.gridDensity || '1';
		var simplemde = new SimpleMDE({ element: $('#simplemde')[0] });

		{{--
		var gridDataSource = new DevExpress.data.DataSource({
			key: "id",
			load: function(loadOptions) {
				var d = $.Deferred(),
					params = {};
				[
					"skip",
					"take", 
					"requireTotalCount", 
					"requireGroupCount", 
					"sort", 
					"filter", 
					"totalSummary", 
					"group", 
					"groupSummary"
				].forEach(function(i) {
					if(i in loadOptions && isNotEmpty(loadOptions[i])) 
						params[i] = JSON.stringify(loadOptions[i]);
				});
				params.v = 1;
				$.getJSON("{{ route('announcements-list') }}", params)
				.done(function(result) {
					d.resolve(result.data, { 
						totalCount: result.totalCount,
						summary: result.summary,
						groupCount: result.groupCount
					});
				});
			  return d.promise();
			}
		});
		--}}
		
		var gridDataSource = @json($announcements->sortDesc()->values());

		function isNotEmpty(value) {
			return value !== undefined && value !== null && value !== "";
		}

        DevExpress.localization.loadMessages({
            "en": {
                "dxList-selectAll": "All"
            }
        });

		$('#announcements-container').on('click', '#dx-col-7 .dx-header-filter', function(e){
			e.preventDefault();
			let popup = $("#density-popup").dxPopup({
				width: 140,
				height: 105,
				container: '#density-popup',
				position: {my: 'top right', at: 'bottom right', of: '#dx-col-7'},
				elementAttr: {class: 'dx-header-filter-menu'},
				contentTemplate: function() {
					let content = $(`<div id="density-list"></div>`);
					content.dxList({
						dataSource: new DevExpress.data.ArrayStore({
							key: 'id',
							data: [
								{id: '1', text: '1x'},
								{id: '2', text: '2x'},
								{id: '3', text: '3x'}
							]
						}),
						selectedItemKeys: [density],
						selectionMode: 'single',
						showSelectionControls: true,
						onItemClick: function(e){
							$('#announcements-container')
								.removeClass('dx-density-1x dx-density-2x dx-density-3x')
								.addClass(`dx-density-${e.itemData.id}x`);
							$('#dx-col-7 .dx-datagrid-text-content').html(e.itemData.id + 'x');
							localStorage.gridDensity = e.itemData.id;
						}
					});
					return content;
				},
				showTitle: false,
				dragEnabled: false,
				closeOnOutsideClick: true
			}).dxPopup("instance");
			popup.show();
		});


		$(function(){
			$("#status-filter").dxSelectBox({
				dataSource: statuses,
				value: statuses[0],
				onValueChanged: function(data) {
					if (data.value == "All Statuses")
						dataGrid.clearFilter();
					else
						dataGrid.filter(["status", "=", data.value.toLowerCase()]);
				}
			});

			function buttonStates(){
				if ( dataGrid.pageIndex() == dataGrid.pageCount() - 1 ) {
					$('.next-page').prop('disabled', true).addClass('disabled');
				} else {
					$('.next-page').prop('disabled', false).removeClass('disabled');
				}
				if ( dataGrid.pageIndex() == 0 ) {
					$('.prev-page').prop('disabled', true).addClass('disabled');
				} else {
					$('.prev-page').prop('disabled', false).removeClass('disabled');
				}

				$('#record-limit-dropdown span:first-of-type').text(
					`${dataGrid.pageSize() * dataGrid.pageIndex() + 1}-${dataGrid.pageSize() * dataGrid.pageIndex() + dataGrid.pageSize()}`
				);
			}

			$('.record-limit').click(function(){
				dataGrid.pageSize( $(this).data('value') );
				buttonStates();
			});

			$('.prev-page').click(function(){
				dataGrid.pageIndex( Math.max(0, dataGrid.pageIndex() - 1) );
				buttonStates();
			});
			$('.next-page').click(function(){
				dataGrid.pageIndex( Math.min(dataGrid.pageCount() - 1, dataGrid.pageIndex() + 1) );
				buttonStates();
			});

			var dataGrid = $("#announcements-container").dxDataGrid({
				dataSource: gridDataSource,
				remoteOperations: false,
				// remoteOperations: {
				// 	paging: true,
				// 	sorting: true,
				// 	filtering: true,
				// 	grouping: true,
				// },
				selection: {
					mode: 'multiple',
					showCheckBoxesMode: 'always'
				},
				elementAttr: {
					class: 'table-numbered'
				},
				headerFilter: {
					visible: true,
					width: 140,
					height: 170
				},
				columnMinWidth: 100,
				columnAutoWidth: true,
				columnHidingEnabled: false,
				columns: [
					{caption: 'Title', dataField: 'title', allowFiltering: false, width: 212},
					{caption: 'Author', dataField: 'author', allowSorting: false, width: 184},
					{caption: 'Visibility', dataField: 'subscription_levels', allowSorting: false,
						cellTemplate: function(el, meta){
							let cell_html = '';
							meta.data.subscription_levels.forEach(function(sub){
								if( sub.name == 'OWDRep' ){ return; }
								cell_html += ` <span class="text-${subs_index[sub.id - 1].color} pr-2">${sub.name}</span>`;
							});
							el.html(cell_html);
						},
						lookup: {
							dataSource: @json(array_values($subs))
						},
						calculateCellValue: function(row) {
							let value = [];
							row.subscription_levels.forEach(sub => value.push(sub.name));
							return value.toString();
						},
						calculateFilterExpression: function(filterValue, selectedFilterOperation) {
							return [this.calculateCellValue, "contains", filterValue];
						}
					},
					{caption: 'File', dataField: 'media', allowFiltering: false, allowSorting: false,
						cellTemplate: function(el, meta){
						if ( meta.value && meta.value != '' ) {
							el.append(`<a href="{{ asset('/storage/${meta.value}') }}" target="_blank">Photo</a>`);
						} else {
							el.append(`<em>No photo</em>`);
						}
					}},
					{caption: 'Status', dataField: 'status', allowSorting: false,
						cellTemplate: (el, meta) => {
							let status_html = '';

							let active = `<x-icons.active-16x color="url(#green-grad-90)" />`;
							let paused = `<x-icons.paused-16x color="url(#yellow-grad-90)" />`;
							
							let act_class = (meta.data.status == 'scheduled' ? 'current-status' : 'to-change'),
								pau_class = (meta.data.status == 'scheduled' ? 'to-change' : 'current-status');

							status_html = `
								<span class="${act_class}" data-id="${meta.data.id}" data-change="draft">
									${active}
								</span>
								<span class="${pau_class}" data-id="${meta.data.id}" data-change="scheduled">
									${paused}
								</span>
							`;
							el.html(status_html);
						},
						headerFilter: {
							dataSource: [
								{text: 'Active', value: 'scheduled'},
								{text: 'Inactive', value: 'draft'},
							]
						},
					},
					{caption: 'Date', dataField: 'publish_start_date', dataType: 'date', format: 'dd/MM/yyyy', allowFiltering: false},
					{caption: density + 'x',  dataField: 'action', 
						cellTemplate: function(el, meta){ 
							el.append(`
								<a href="/announcements/${meta.data.id}" class="mr-3"><x-icons.settings-16x color="url(#blue-grad-90)" /></a>
								<a href="javascript:void(0);" data-action="remove"><x-icons.delete-16x color="url(#red-grad-90)"/></a>
							`);
						},
						calculateFilterExpression: function(filterValue, selectedFilterOperation) {
							return [this.calculateCellValue, "contains", filterValue];
						}
					}
				],
				onCellClick: function(e) {
					if (e.column.dataField == 'status' ) {
						e.event.stopPropagation();
						let iconClicked = $(e.event.target.parentElement);
 						let change = iconClicked.data('change');

						if (isNotEmpty(change) && change !== 'none') {
							let newStatus = change;
							$.ajax({
								url: "{{ url('announcements/status') }}" + "/" +  e.data.id,
								type: 'POST',
								data: {
									_token: "{{ csrf_token() }}",
									status: newStatus
								},
								success: function (data) {
									// Find the icon with old status to toggle it to changeable(css: to-change)
									let iconToUpdate = $(`.to-change[data-id=${e.data.id}]`);
									iconToUpdate.toggleClass('current-status to-change');

									iconClicked.toggleClass('current-status to-change');
									//console.log(iconClicked, iconToUpdate);

									let ds = $("#announcements-container").dxDataGrid("getDataSource");
									let item = ds.items().find(o => o.id === e.data.id);
									item.status = newStatus;
								},
								error: function(request, error) {
									console.log(error);
								}
							});
						}
					} else if (e.column.dataField == 'action') {
                        let clicked = $(e.event.target.parentElement)
                        let action = clicked.data('action')
                        if(isNotEmpty(action) && action == 'remove') {
                            dataGrid.deleteRow(e.rowIndex);
                        }                                          
                    }
				},
                onRowRemoving: function(e) {
                    $.ajax({
                        url: "{{ url('announcements') }}" + "/" + e.data.id + "/delete" ,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        error: function (request, error) {
                            console.log(error)
                        }
                    });
                },
                hoverStateEnabled: true,
                onRowClick: function(e) {
                    if (e.rowType == "data") {
                        $('#modal-title').text(e.data.title);
                        $('#modal-author').text(e.data.author);
                        let status = e.data.status;
                        $('#modal-status').text(status.substr(0,1).toUpperCase() + status.substr(1));
                        $('#modal-img').attr('src', `/storage/${e.data.media}`);
                        $('#modal-content-block').html( simplemde.markdown(e.data.content) );
                        // $('#modal-action').text(e.data.action_text);
                        $('#preview-ann').modal('show');
                    }
                },
      //           onOptionChanged: function(e) {
      //           	console.log(e);
      //           	if (e.name == 'columns') {
      //           		// This is for the header filters' icon upward/downward effect.
						// // The contentReady function is not invoked when a user clicks on all from a filter selectbox
						// // (because content hasn't been changed: default option for filter select boxes - all)
						// // Refresh the dataGrid to bring it in the init status
						// dataGrid.refresh();
      //           	}
      //           },
				onContentReady: function(grid) {
					$('#dx-col-7 .dx-header-filter').unbind('dxclick');
					grid.element.addClass(`dx-density-${density}x`);
					grid.element.find('.dx-datagrid-rowsview tr').each(function(i, el){
						el = $(el);
						let rowindex = el.find('.current-status').data('id');
						el.find('td:first-child').attr('data-rowindex', rowindex);
					});

					$('.dx-header-filter').on('dxclick', function(e) {
						$(this).addClass('dx-header-filter-upward');
						$("div.dx-toolbar-items-container").on('dxclick', function(e) {
							$(".dx-header-filter").removeClass('dx-header-filter-upward');
						});
					});

					$('body').on('dxclick', function(e) {
						if (!$(event.target).closest('.dx-overlay-wrapper').length) {
							$(".dx-header-filter, .dx-header-filter.dx-header-filter-empty").removeClass('dx-header-filter-upward');
						}
					});
				}
			}).dxDataGrid('instance');
		});
	</script>
@endpush
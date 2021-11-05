let max_char = 42;
var globalAreaSettings = {
	argumentAxis: {
		valueMarginsEnabled: false,
		label: {
			font: {
				family: 'Roboto Mono',
				size: '10px',
				weight: '500',
				color: '#515E7C'
			}
		}
	},
	commonAxisSettings: {
		width: 1,
		color: 'var(--color-body-bg-dark)',
		visible: true,
		tick: {
			color: 'var(--color-dark)',
			length: 5,
			width: 2,
			shift: 0
		},
		discreteAxisDivisionMode: 'crossLabels',
		valueMarginsEnabled: false,
		endOnTick: true,
		grid: {
			visible: true,
			color: 'var(--color-body-bg-dark)'
		},
		label: {
			font: {
				family: 'Roboto Mono',
				size: '10px',
				weight: '500',
				color: '#515E7C'
			}
		}
	},
	seriesSelectionMode: 'single',
	commonSeriesSettings:{
		selectionMode: 'excludePoints',
		opacity: 0.85,
		border: {
			visible: true,
			color: '#404040',
			width: '1px'
		},
		hoverStyle: {
			opacity: 1,
			hatching: {
				direction: 'none'
			},
			border: {
				visible: true,
				color: '#000000',
				width: '1px'
			}
		},
		selectionStyle: {
			opacity: 1,
			hatching: {
				direction: 'none'
			},
			border: {
				visible: true,
				color: '#000000',
				width: '1px'
			}
		},
		point: {
			visible: true,
			size: 6,
			color: '#fafafa',
			border: {
				visible: true,
				color: '#404040',
				width: '1px'
			},
			hoverStyle: {
				size: 14,
				color: '#fff',
				border: {
					visible: true,
					color: '#404040',
					width: '2px'
				}
			},
			selectionStyle: {
				size: 6,
				color: '#fafafa',
				border: {
					visible: true,
					color: '#404040',
					width: '2px'
				}
			}
		},
		aggregation: {
			enabled: true
		}
	},
	tooltip: {
		enabled: true,
		shared: true,
		border: { visible: false },
		paddingTopBottom: 0,
		paddingLeftRight: 0,
		arrowLength: 6,
		location: 'edge',
		shadow: {
			color: 'rgba(64, 64, 64, 0.15)',
			offsetX: 0, offsetY: 0,
			blur: 15
		},
		customizeTooltip: function (info) {
			var content = '';

			info.points.forEach(point => {
				let color = point.point.series._styles.normal.border.stroke;
				// let color = 'var(--color-green)';
				// let hexPattern = /#[a-z0-9]{6}/i;
				// let color = (hexPattern.test( point.point.series._styles.legendStyles.normal.fill ) 
				// 	? point.point.series._styles.legendStyles.normal.fill 
				// 	: `var(--color-${point.point.series._styles.legendStyles.normal.fill})`);
				let value = new Intl.NumberFormat().format( Number(point.value) );
				content += 
					`<div class="tip-point" style="border-color: ${color};">
						<span class="series-name">${point.seriesName}</span>
						<span class="value">${value}</span>
					</div>`;
			});

			var htmlContent = $(content);
			return {
				html: $("<div>").append(htmlContent).html()
			};
		}
	},
	legend: {
		visible: false,
		customizeItems: function(items){
			if( !items.length ) {return;}
			let $footer = items[0].series._renderer._$container.closest('.block').find('.block-footer');
			if( $footer.children().length ){ return; }

			let itemOptions = items.map(item => item.text)
			if ( itemOptions.reduce((counter, option) => counter + option.length, 0) < max_char) { // max number of characters to fit in line
				items.forEach(function(item){
					let color = item.series._styles.normal.border.stroke;
					// let hexPattern = /#[a-z0-9]{6}/i;
					// let color = (hexPattern.test( stroke ) 
					//  ? stroke 
					//  : `var(--color-${stroke})`);
					let legend = $(`<div class="mr-4 legend"><i class="legend-dot mr-2" style="background-color: ${color};"></i><span class="ml-1">${item.text}</span></div>`);

					$footer.append(legend);
					item.series.legend = legend;

					legend.click(() => {
						legend.parent().find('.selected').removeClass('selected');
						if( !item.series.isSelected() ){
							item.series.select();
							legend.addClass('selected');
						} else {
							item.series.clearSelection();
						}
					});
				});

			} else {
				// Legends are too long to display horizontally -> make dropdown
				let select_items = items.map(function(item, i){
					let color = item.series._styles.normal.border.stroke;
					return {
						id: i,
						name: item.text,
						icon: `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-circle-fill" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10" fill="var(--color-blue-10)"/><circle cx="10" cy="10" r="5" fill="${color}"/></svg>`,
						checkmark: (checked) => `<svg width="10" height="9" viewBox="0 0 10 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.16683 0.666748L4.16683 7.33341L0.833496 4.83341" stroke="var(--color-${checked ? 'green' : 'muted' })" stroke-width="2"/></svg>`,
						series: item.series,
						onClick: e => {
							e.element.find('.check path').attr('stroke', 'var(--color-muted)');
							e.itemData.series.select();
							e.itemElement.find('.check path').attr('stroke', 'var(--color-green)')
						}
					};
				});

				let $select = $("<div />").dxDropDownButton({
					keyExpr: "id",
					selectedItemKey: 0,
					displayExpr: "name",
					useSelectMode: true,
					stylingMode: 'text',
					dropDownOptions: {
						width: 230
					},
					itemTemplate: item => `
						<div class="d-flex justify-content-between align-items-center">
							${item.icon}
							<span class="flex-grow-1 ml-2 trunc-12" title="${item.name}">${item.name}</span>
							<span class="check">${item.checkmark( item.series.isSelected() )}</span>
						</div>
					`,
					onSelectionChanged: function(e) {
						e.previousItem.series.clearSelection();
					},
					items: select_items
				});
				$footer.append( $select );
			}
		}
	},
	onSeriesClick: function(e){
		if( !e.target.isSelected() ){
			e.target.select();
			if( e.target.legend ){
				e.target.legend.parent().find('.selected').removeClass('selected');
				e.target.legend.addClass('selected');
			}
		} else {
			e.target.clearSelection();
		}
	},
	onDone: function(e){
		let series = e.component.getAllSeries()[0];
		series.select();

		if( series.legend ){
			series.legend.addClass('selected');
			let color = series._styles.normal.border.stroke;
			$('#customLegendDot').css({"background-color": color})
		}
	},
	export: {
		enabled: false
	},
};
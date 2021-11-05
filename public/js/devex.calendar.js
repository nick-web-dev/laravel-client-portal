function datePicker(input_str){
	const $container = $(`<div />`).appendTo('#page-container');

	const popup = $container.dxPopup({
		container: $container,
		width: 430,
		height: 350,
		elementAttr: {class: 'calendar-popup'},
		contentTemplate: function(){
			let $content = $('<div />'),
				$tabs = $("<div />").dxTabs({
					dataSource: [
						{text: 'Year', id: 'decade'},
						{text: 'Month', id: 'year'},
						{text: 'Day', id: 'month'}
					],
					keyExpr: 'id',
					selectedItemKeys: 'month',
					onItemClick: e => {
						$calendar.dxCalendar('instance').option("zoomLevel", e.itemData.id);
					}
				}),
				$calendar = $("<div />").dxCalendar({
					zoomLevel: 'month',
					onOptionChanged: e => {
						if(e.name == 'zoomLevel'){
    						$tabs.dxTabs('instance').option("selectedItemKeys", e.value);
						}
					},
					onValueChanged: e => {
						console.log( e, this );
						this._position.of.val( e.value );
						this.hide();
					}
				});
			return $content.append($tabs).append($calendar);
		},
		showTitle: false,
		visible: false,
		dragEnabled: false,
		closeOnOutsideClick: true,
		position: {my: 'top left', at: 'bottom left', collision: 'fit'}
	}).dxPopup('instance');

	$(input_str).click(function(){
		popup.option({
			'position.of': $(this)
		});
		popup.show();
	});
}
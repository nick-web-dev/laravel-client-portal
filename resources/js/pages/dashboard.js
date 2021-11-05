class pageDash {
	static init($){
		let selected_widget = $('#widget-list-tabs a:first-of-type').data('widget');

		$('#widget-list-tabs a').click(function(){
			selected_widget = $(this).data('widget');
		});

		$('.btn.add-widget').on('click', function(){
			$.get(`widgets/${selected_widget}?html=true`)
			.done(data => {
				$('.grid-stack')[0].gridstack
				.addWidget(`<div>${data}</div>`,
					{width: 6, height: 4}
				);
				$('#modal-add-widget').modal('hide');
			});
		});

		//Dashmix.helpers('gridstack');
		GridStack.init();
	}
}


jQuery(() => { pageDash.init(jQuery); });
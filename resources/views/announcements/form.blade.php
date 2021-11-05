@extends('layouts.app')

@push('css_before')
	<link rel="stylesheet" href="{{ asset('js/plugins/simplemde/simplemde.min.css') }}">
	{{-- <link rel="stylesheet" href="{{ asset('/js/plugins/flatpickr/flatpickr.min.css') }}"> --}}
	<link rel="stylesheet" href="{{ asset('/js/plugins/flatpickr/themes/owd.css') }}">
@endpush

@push('css_after')
	<style>
		h4.text-dark {
			font-size: 22px;
			line-height: 28px;
		}

		h5 {
			color: var(--color-dark-blue-selected);
			font-family:  "Roboto", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto;
			font-size: 18px;
			line-height: 24px;
			font-weight: 500;
			margin-bottom: 14px;
		}

		p {
			font-size: 14px;
			line-height: 20px;
			margin-bottom: 0;
		}

		p.text-muted {
			line-height: 20px !important;
			margin-bottom: 10px;
		}

		input.form-control {
			padding: 14px 20px;
			border: none;
			border-radius: 0;
			background-color: var(--color-lighter);
		}
		input.form-control:not(.time-widget) {
			padding: 14px 20px 13px;
			line-height: 22px;
			height: auto;
			box-sizing: border-box;
			color: var(--color-dark-blue);
			border-bottom: 1px solid var(--color-dark-blue);
		}
		input.form-control::placeholder {
			color: var(--color-body-text-light);
		}

		.form-group label {
			font-size: 14px;
			line-height: 20px;
			font-weight: 400;
			color: var(--color-dark-blue);
		}

		.CodeMirror {
			color: var(--color-dark-blue);
			background: var(--color-lighter);
		}

		.custom-control-dark.custom-block .custom-control-label {
			font-size: 16px;
			font-weight: 500;
			line-height: 22px;
			padding: 7px 20px;
			border-radius: 0;

			/*color: var(--color-slate);
			border: 2px solid var(--color-slate);
			border-radius: 0;
			background: transparent;*/
		}
		.custom-control-dark.custom-block .custom-control-input:checked ~ .custom-control-label {
			/*color: #fff;
			background: var(--color-slate);*/
		}

		.block-visibility {
			flex-wrap: wrap;
			gap: 16px;
		}

		.has-upload .btn {
			font-size: 14px;
			line-height: 18px;
			display: flex;
		}

		.block-media-drop {
			display: flex;
			align-items: center;
			gap: 4px;
			color: #000;
			margin-bottom: 10px;
		}

		.block-media-drop .text-muted {
			font-family:  "Roboto Mono", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto;     
		}

		.btn-media-drop {
			display: flex;
			justify-content: space-between;
			align-items: center;
			width: 144px;
			padding: 8px 20px;
			text-align: left;
			border: 0;
		}

		.btn-media-drop span {
			font-size: 14px;
			line-height: 18px;
			padding-right: 20px;
		}

		#media-drop {
			padding: 20px;
			background: var(--color-lighter);
			box-shadow: 0 0 10px rgba(0,0,0,0);
			transition: all 0.25s;
			background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg'%3e%3crect width='100%25' height='100%25' fill='none' stroke='rgba(0,0,0,0.3)' stroke-width='1' stroke-dasharray='6%2c6' stroke-dashoffset='0' stroke-linecap='square'/%3e%3c/svg%3e");
		}

		#media-drop.dz-drag-hover {
			border-color: #000;
			background: #c7c7c7;
		}

		#media-drop.dz-drag-hover > * {
			filter: blur(2px);
		}

		#media-drop.dz-started {
			padding: 0;
			border: none;
			box-shadow: 0 0 15px rgba(64, 64, 64, 0.15);
		}
		#media-drop.dz-started:before {
			content: none;
		}
		#media-drop.dz-started > :not(.dz-preview) {
			display: none;
		}

		.dz-preview.dz-image-preview {
			width: 100%;
			padding: 14px 20px 14px 16px;
			display: flex;
			flex-wrap: wrap;
			align-items: center;
			justify-content: space-between;

			background: #fff;
			border: 1px solid var(--color-passive-light);
			cursor: pointer;
		}

		.dz-preview > * + * {
			margin-left: 14px;
		}

		.dz-image {
			width: 26px;
			height: 26px;
			padding: 3px 4px;
			border: 1px solid var(--color-passive-light);
			border-radius: 5px;
		}

		.dz-image img {
			display: block;
			width: 100%;
			height: 100%;
		}

		.dz-preview:not(.dz-success) .dz-success-mark, 
		.dz-preview:not(.dz-error) .dz-error-mark {
			display: none;
		}
		.dz-success-mark .fa,
		.dz-error-mark .fa,
		.dz-remove .fa {
			display: block;
		}

		.dz-success-mark svg, 
		.dz-error-mark svg,
		.dz-remove svg {
			max-width: 16px;
			max-height: 16px;
		}
		.dz-success-mark svg path {
			fill: green !important;
		}
		.dz-error-mark svg path,
		.dz-remove svg path {
			fill: red !important;
		}

		.dz-error-message {
			display: none;
		}

		.dz-error-message {
			width: 100%;
			font-size: 14px;
			color: var(--color-direct);
			margin-top: 6px;
		}

		.dz-details {
			flex-grow: 1;
			display: flex;
			place-content: center flex-start;

			font-size: 14px;
			line-height: 18px;
		}

		.dz-filename {
			order: 1;
			padding-right: 10px;
			margin-right: 10px;;
			max-width: 84px;
			white-space: nowrap;
			text-overflow: ellipsis;
			overflow: hidden;
			border-right: 1px solid #efefef;
		}

		.dz-size {
			order: 2;
		}

		.dz-error-size .dz-size span {
			color: var(--color-direct);
		}
		.dz-error-size .dz-size span::after {
			content: " \f071";
			font-family: FontAwesome;
		}

		.dz-size span {
			font-family: 'Roboto Mono';
			/*color: var(--color-med-grey);*/
			font-weight: 500;
		}
		.dz-size span strong {
			font-weight: 500;
		}

		.dz-size::before {
			content: 'Size: ';
			padding-right: 4px;
		}


		input.time-widget {
			font-size: 12px;
			font-weight: 500;
			line-height: 22px;
			text-align: center;
			border-bottom: none;
			padding: 0;
		}
		input.time-widget.active {
			background: var(--color-blue-20) !important;
			color: var(--color-blue-passive);
			-webkit-text-fill-color: var(--color-blue-passive);
		}

		.calendar-popup .dx-popup-content {
			padding: 0;
		}
		.calendar-popup .dx-calendar {
			width: auto;
			min-width: initial;
		}
		.calendar-popup .dx-calendar-navigator {
			display: none;
		}
		.calendar-popup .dx-calendar-body {
			top: 0;
		}

		.flatpickr-day.today.none-selected {    
			background: #404040 !important;    
			-webkit-box-shadow: none;
			box-shadow: none;
			color: #ff4700;
			border-color: #404040 !important;    
		}

		.time-icon {
			position: relative;
			display: flex;
			flex-direction: column;
			place-content: center center;

			flex-shrink: 0;
			flex-basis: 34px;
			height: 34px;
			margin-right: 4px;
			border-color: var(--color-passive-light) !important;
		}
		.time-icon .fa {
			color: var(--color-slate);
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}

		#page-footer > :not(.btn-group) {
			font-size: 22px;
			line-height: 28px;
		}

		#page-footer .btn {
			display: flex;
			justify-content: space-between;
			align-items: center;

			width: 200px;

			font-size: 16px;
			line-height: 22px;
		}

		/*.btn-group > .btn:not(:last-child) {
			border-right: 2px solid var(--color-blue-20);
		}*/
		.btn-group > .btn:hover{
			 z-index: initial; 
		}
	</style>
@endpush


@section('content')
<x-nav.section title="New Announcements">
	<x-nav.link :href="route('announcements-list')" icon="close" icon-color="blue" />
</x-nav.section>

<div class="content content-boxed pt-10 pb-20">
	<form id="ann-form" action="{{ isset($announcement) ? route('announcement-view', $announcement->id) : route('announcement-store') }}" method="post" enctype="multipart/form-data">
		@csrf

		@if ($errors->any())
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="alert alert-danger">
					<ul class="m-0 list-unstyled">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		@endif

		<div class="row justify-content-center">
			<div class="col-12 col-lg-6 col-xl-6">
				<h4 class="text-dark mb-6">Details</h4>
				<div class="block h-auto">
					<x-block-content class="p-7">
						<div class="row push">
							<div class="col-12 col-xl-6 form-group m-0">
								<label for="ann-title">Title</label>
								<input type="text" id="ann-title" name="title" class="form-control" placeholder="Example" value="{{ old('title') ?? $announcement->title ?? null }}" maxlength="90" required>
							</div>
							<div class="col-12 col-xl-6 form-group m-0">
								<label for="ann-author">Author</label>
								<input type="text" id="ann-author" name="author" class="form-control" placeholder="Example" value="{{ old('author') ?? $announcement->author ?? null }}" maxlength="64">
							</div>
						</div>
						<textarea class="js-simplemde" id="simplemde" name="content" required>{{ old('content') ?? $announcement->content ?? null }}</textarea>
					</x-block-content>
				</div>
			</div>

			<div class="col-12 col-lg-6 col-xl-4">
				<h4 class="text-dark mb-6">Options</h4>
				<div class="block h-auto mb-block">
					<x-block-content class="py-7">
						<h5>Visibility</h5>
						<p class="text-muted">On which channels should this announcement show?</p>
						<div class="d-flex justify-content-between block-visibility">
							@foreach( $subscriptions as $sub_level )
								@if( $sub_level->name == 'OWDRep' ) @continue @endif
								<div class="custom-control custom-block custom-control-dark flex-grow-1">
									<input type="checkbox" class="custom-control-input" id="ann-subLevels-{{$sub_level->id}}" name="sub_levels[]" {{ isset($announcement) && $announcement->subscriptionLevels->contains('id', $sub_level->id) ? 'checked' : '' }} value="{{$sub_level->id}}">
									<label class="custom-control-label btn btn-alt btn-blue shadow-none" for="ann-subLevels-{{$sub_level->id}}">
										<span class="d-block text-center">
											{{ $sub_level->name }}
										</span>
									</label>
								</div>
							@endforeach
						</div>
						<div class="custom-control custom-checkbox mb-4 d-none">
							<input type="checkbox" class="custom-control-input" id="ann-exclusive" name="exclusive" value="true" checked>
							<label class="custom-control-label font-w400" for="ann-exclusive">Show only to this level.</label>
						</div>
					</x-block-content>
				</div>

				<div class="block h-auto mb-block">
					<x-block-content class="block-content-full py-7">
						<div class="no-upload">
							<h5>Image</h5>
							<div class="d-flex justify-content-between">
								<p class="text-muted">Find the right image for your post.</p>
								<p class="text-muted">Up-to 2mb</p>
							</div>
						</div>
						<div class="has-upload" style="display: none">
							<div class="d-flex justify-content-between align-items-center mb-6">
								<h5 class="mb-0">Up-to 2mb</h5>
								<button class="btn btn-blue btn-ghost px-block py-3" type="button">
									Text Button<i class="fa fa-placeholder fa-sm ml-block"></i>
								</button>
							</div>
						</div>
						<div id="media-drop" 
							class="d-flex flex-column align-items-center text-black"
							action="{{ isset($announcement) ? route('announcement-view', $announcement->id) : route('announcement-store') }}">
							<div class="block-media-drop">
								Drag &amp; Drop Image <span class="text-muted">(416x200)</span>
							</div>
							<p class="mb-3">or</p>
							<button type="button" class="btn btn-blue btn-default upload-btn btn-media-drop">
								<span>Upload</span> <i class="fa fa-placeholder fa-sm"></i>
							</button>
						</div>
						<div id="media-input"></div>
					</x-block-content>
				</div>
				<div class="block h-auto">
					<x-block-content class="block-content-full py-7">
						<h5>Text</h5>
						<p class="text-muted">Pick starting and ending time</p>
						<div class="d-flex justify-content-between align-items-center text-center mb-2">
							<div class="time-icon">
								<x-icons.calendar-16x color="url(#blue-grad-90)" />
							</div>
							<div class="bg-blue-10">
								<input type="text" class="time-widget form-control text-monospace text-gd-blue" id="ann-publish_start_date" data-alt-input="true" data-alt-format="M j, Y" name="publish_start_date" placeholder="Start Date" value="{{ old('publish_start_date') ?? $announcement->publish_start_date ?? \Carbon\Carbon::now() }}">
							</div>
							<div class="text-muted px-4">
								to
							</div>
							<div class="bg-blue-10">
								<input type="text" class="time-widget form-control text-monospace text-gd-blue" id="ann-publish_end_date" data-alt-input="true" data-alt-format="M j, Y" name="publish_end_date" placeholder="End Date" value="{{ old('publish_end_date') ?? $announcement->publish_end_date ?? '' }}">
							</div>
						</div>
						@php 
							if( isset($announcement) ){
								$start_time = $announcement->publish_start_date->format('h:i');
								$end_time = $announcement->publish_end_date->format('h:i');
							}
						@endphp
						<div class="d-flex justify-content-between align-items-center text-center">
							<div class="time-icon">
								<x-icons.time-16x color="url(#blue-grad-90)" />
							</div>
							<div class="bg-blue-10">
								<input type="text" class="time-widget form-control text-monospace text-gd-blue" id="ann-publish_start_time" data-enable-time="true" data-alt-input="true" data-alt-format="h:i K" data-no-calendar="true" name="publish_start_time" placeholder="Start Time" value="{{ old('publish_start_time') ?? $start_time ?? '' }}">
							</div>
							<div class="text-muted px-4 flex-grow">
								to
							</div>
							<div class="bg-blue-10">
								<input type="text" class="time-widget form-control text-monospace text-gd-blue" id="ann-publish_end_time" data-enable-time="true" data-alt-input="true" data-alt-format="h:i K" data-no-calendar="true" name="publish_end_time" placeholder="End Time" value="{{ old('publish_end_time') ?? $end_time ?? '' }}">   
							</div>
						</div>
					</x-block-content>
				</div>
			</div>
		</div>
	</form>
	@isset( $announcement )
		<x-announcement-modal id="preview-modal" :announcement="$announcement" />
	@else
		@php
			$example = new \App\Models\Announcement();
			$example->author = 'From';
			$example->content = '';
			$example->media = '/';
			$example->publish_start_date = \Carbon\Carbon::now();
		@endphp
		<x-announcement-modal id="preview-modal" :announcement="$example" />
	@endisset

</div>
<template id="dropzone-temp" >
	<div class="dz-preview dz-file-preview text-dark-blue">
		<div class="dz-image"><img data-dz-thumbnail /></div>
		<div class="dz-details">
			<div class="dz-filename"><span data-dz-name></span></div>
			<div class="dz-size"><span data-dz-size></span></div>
		</div>
		<div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
		<div class="dz-success-mark text-dark"><span><i class="fa fa-placeholder fa-sm"></i></span></div>
		<div class="dz-error-mark text-dark"><span><i class="fa fa-placeholder fa-sm"></i></span></div>
		<div class="dz-remove text-danger" data-dz-remove><i class="fa fa-placeholder fa-sm"></i></div>
		<div class="dz-error-message" data-dz-errormessage></div>
	</div>
</template>

{{-- <div id="calendar-popup"></div> --}}
@endsection

@section('footer')
	<div class="d-flex justify-content-between align-items-center w-100 bg-white" style="min-height: 64px;">
		<div class="ml-6 text-dark-blue">Text</div>
		<div class="align-self-stretch btn-group">
			<button class="btn btn-alt btn-blue prev-btn px-5 h-100" 
				data-target="#preview-modal" data-toggle="modal" disabled>
				Preview <i class="fa fa-placeholder ml-block"></i>
			</button>
			<button class="btn btn-alt btn-blue save-btn px-5 h-100" type="button" disabled>
				Save to Draft <i class="fa fa-placeholder ml-block"></i>
			</button>
			<button class="btn publish-btn btn-default btn-blue px-5 h-100" type="button" disabled>
				@if( !isset($announcement) || optional($announcement)->status == 'draft' )
					Publish <i class="fa fa-placeholder ml-block"></i>
				@else
					Update <i class="fa fa-placeholder ml-block"></i>
				@endif
			</button>
		</div>
	</div>
@endsection

@push('js_after')
	<script src="{{ asset('js/plugins/simplemde/simplemde.min.js') }}"></script>
	<script src="{{ asset('js/devex.calendar.js') }}"></script>
	<script src="{{ asset('js/plugins/dropzone/dropzone.min.js') }}"></script>
	<script>
		$(function(){
			$('.save-btn').click(function(e){
				e.preventDefault();
				e.stopPropagation();
				$('.save-btn, .publish-btn').prop('disabled', true);
				if( mediaDrop.getQueuedFiles().length ){
					mediaDrop.processQueue();
				} else {
					$('#ann-form').submit();
				}

				return false;
			});
			$('.publish-btn').click(function(){
				$('.save-btn, .publish-btn').prop('disabled', true);
				$('#ann-form').append(`<input type="hidden" name="publish" value="true" />`);
				if( mediaDrop.getQueuedFiles().length ){
					mediaDrop.processQueue();
				} else {
					$('#ann-form').submit();
				}

				return false;
			});

			Dropzone.autoDiscover = false;

			var mediaDrop = new Dropzone( '#media-drop', {
				removedfile: function (file) {
					$(file.previewElement).remove();
					$('#ann-form').append( `<input type="hidden" name="remove-media" value="true" />` );
				},
				paramName: "media", // The name that will be used to transfer the file
				maxFiles: 1,
				maxFilesize: 2, // MB
				resizeWidth: 416,
				resizeHeight: 200,
				resizeMethod: 'crop',
				parallelUploads: 1,
				hiddenInputContainer: '#media-input',
				clickable: '.upload-btn',
				acceptedFiles: 'image/*',
				previewTemplate: $('#dropzone-temp').html(),
				autoProcessQueue: false,
				params: function(){
					let values = $('#ann-form').serializeArray();
					let payload = {};
					values.forEach(field => {
						if( field.name in payload && !Array.isArray( payload[field.name] ) ){
							payload[ field.name ] = [payload[ field.name ]];
						}
						if( Array.isArray( payload[ field.name ] ) ){
							payload[ field.name ].push( field.value );
						} else {
							payload[ field.name ] = field.value;
						}
					});
					payload.content = simplemde.value();
					payload.v = '1';

					return payload;
				},
				init: function() {
					this.on('addedfile', function(file) {
						$('.no-upload').hide();
						$('.has-upload').show();
						if (this.files.length > 1) {
							this.removeFile(this.files[0]);
						}

						$('#ann-form [name="remove-media"]').remove();
					});
					this.on('error', function(file, errorMsg, xhrRequest) {
						checkRequired();

						if( errorMsg != undefined && xhrRequest == undefined ){
							$.toast({
								title: 'File Error',
								content: errorMsg
							});

							if( errorMsg.indexOf('too big') > -1 ){
								$('.dz-preview').addClass('dz-error-size');
							} else {
								$('.dz-preview').removeClass('dz-error-size');
							}
						} 
						if( xhrRequest != undefined && 'errors' in errorMsg ){
							let errors = errorMsg.errors,
								msg = '';

							for(let field in errors) {
								msg += errors[field].join('<br />') + '<br />';
							}

							msg = `<span class="text-danger">${msg}</span>`;

							$.toast({
								title: 'Form Error',
								content: msg
							});

							file.status = Dropzone.ADDED;
							this.enqueueFile(file);
						}
					});
					this.on('success', function(file, response) {
						response = JSON.parse( response );
						if( 'route' in response ){
							location.href = response.route;
						} else {
							location.reload();
						}
					});
				},
			});

			@if( !empty($announcement->media) )
			{
				let mock_file = {
					name: '{{ \Str::of($announcement->media)->basename() }}', 
					size: 12345,
					accepted: true,
				};
				mediaDrop.displayExistingFile( mock_file, '/storage/{{ $announcement->media }}');
				// mediaDrop.options.maxFiles = 0;
				mediaDrop.files.push( mock_file );
			}
			@endif

			$('#media-drop').on('click', '.dz-preview', function(){
				$(mediaDrop.clickableElements[0]).click();
			});

			var last_date = $('#ann-publish_date').val();
			$('#is_scheduled').click(function(){
				$('.date-selector').toggle();
				if( !this.checked ){
					$('#ann-publish_date').val(null);
				} else {
					$('#ann-publish_date').val( last_date );
				}
			});

			$('#ann-publish_date').on('input', function(){
				last_date = this.value;
			});

			var simplemde = new SimpleMDE({ element: $("#simplemde")[0] });
			var prevModal = $('#preview-modal');
			$('.prev-btn').click(function(){
				prevModal.find('.block-title').html( $('#ann-title').val() );
				prevModal.find('.author').html( $('#ann-author').val() );
				prevModal.find('.prev-content').html(
					simplemde.markdown( simplemde.value() )
				);
				prevModal.find('.modal-media img').attr('src', mediaDrop.files[0].dataURL);
			});

			datePicker('#ann-publish_start_date, #ann-publish_end_date');

			var inputs = [
				'#ann-title', 
				// '#ann-author', 
				// '#ann-publish_start_date', '#ann-publish_start_time', 
				// '#ann-publish_end_date', '#ann-publish_end_time'
			];

			function checkRequired() {
				var values = $( inputs.join(',') ).map(function(){ return this.value; }).get();
				values.push( simplemde.value() );

				if ( values.includes('') ) {
					$('#page-container').removeClass('page-footer-fixed');
					$('#page-footer .btn-group').removeClass('border-dark');
					$('#page-footer .btn-group button').prop('disabled', true);
				} else {
					$('#page-container').addClass('page-footer-fixed');
					$('#page-footer .btn-group').addClass('border-dark');
					$('#page-footer .btn-group button').prop('disabled', false);
				}
			}

			// $('.js-flatpickr').flatpickr({onChange: checkRequired});
			$( inputs.join(',') ).on('blur', checkRequired);
			simplemde.codemirror.on('blur', checkRequired);
			$( inputs[0] ).trigger('blur');

			/* Current day should be pre-selected */
			var noneSelected = true;
			$('.flatpickr-day').map(function() {
				if ($(this).hasClass('selected')) {                    
					noneSelected = false;                    
				}
			});
			if (noneSelected) {
				$('.flatpickr-day.today').addClass('none-selected');
			}
		});
	</script>
@endpush
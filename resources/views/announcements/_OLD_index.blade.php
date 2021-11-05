@extends('layouts.app')

@push('css_before')
    <link rel="stylesheet" href="{{ asset('/js/plugins/flatpickr/flatpickr.min.css') }}">
@endpush

@section('content')
<div class="bg-white">
    <div class="content content-narrow">
        <h1>Announcements</h1>
        <div class="row">
            <div class="col-md-4">
                <x-block>
                    <x-block-header>
                        Test
                    </x-block-header>
                    <x-block-content>
                        <p>This is where more content will go.</p>
                        <button class="btn btn-dark">Action button</button>
                    </x-block-content>
                </x-block>
            </div>
            <div class="col-md-4">
                <x-block>
                    <x-block-header>
                        Test
                    </x-block-header>
                    <x-block-content>
                        <p>This is where more content will go.</p>
                        <button class="btn btn-dark">Action button</button>
                    </x-block-content>
                </x-block>
            </div>
            <div class="col-md-4">
                <x-block>
                    <x-block-header>
                        Test
                    </x-block-header>
                    <x-block-content>
                        <p>This is where more content will go.</p>
                        <a href="{{ route('announcement-create') }}" class="btn btn-primary">Create an Announcement</a>
                    </x-block-content>
                </x-block>
            </div>
        </div>
    </div>
</div>

<div class="content content-narrow">

    @php 
        $statuses = ['draft' => 'Draft', 'scheduled' => 'Publish'];
    @endphp

    <form method="get" class="d-flex justify-content-between bg-white rounded p-4 mb-2">
        <div class="">
            <select name="filter" class="form-control bg-light rounded border-0" oninput="this.form.submit();">
                <option value="">All Statuses</option>
                <option value="published" {{ request()->filter == 'published' ? 'selected' : 0 }}>Published</option>
                <option value="draft" {{ request()->filter == 'draft' ? 'selected' : 0 }}>Drafts</option>
            </select>
        </div>
        <div class="text-right">
            <span class="btn bg-light rounded" id="record-limit" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="text-monospace">{{ $table_meta->range[0] }}-{{ $table_meta->range[1] }}</span> 
                <span class="text-muted">of</span> 
                <span class="text-monospace">{{ $table_meta->record_total }}</span>
            </span>
                <div class="dropdown-menu p-0" aria-labelledby="record-limit">
                    <div class="p-2">
                        <div class="p-4">Results per page</div>
                        <div role="separator" class="dropdown-divider"></div>
                        <button type="submit" name="limit" value="10" class="dropdown-item">
                            Show 10 results
                        </button>
                        <button type="submit" name="limit" value="20" class="dropdown-item">
                            Show 20 results
                        </button>
                        <button type="submit" name="limit" value="50" class="dropdown-item">
                            Show 50 results
                        </button>
                        <button type="submit" name="limit" value="100" class="dropdown-item">
                            Show 100 results
                        </button>
                    </div>
                </div>
            <button type="submit" name="page" value="{{ $table_meta->page - 1 }}" 
                class="btn border-0 bg-light rounded" {{$table_meta->page == 1 ? 'disabled' : 0}}>
                <i class="fa fa-fw fa-chevron-left"></i>
            </button>
            <button type="submit" name="page" value="{{ $table_meta->page + 1 }}" 
                class="btn border-0 bg-light rounded" {{$table_meta->range[1] >= $table_meta->record_total ? 'disabled' : 0}}>
                <i class="fa fa-fw fa-chevron-right"></i>
            </button>
        </div>
    </form>

    <table id="announcements-table" class="js-table-sections table table-hover table-numbered bg-white rounded">
        <thead><tr>
            <th class="pl-6">
                <div class="custom-checkbox custom-control custom-control-lg">
                    <input type="checkbox" class="custom-control-input" id="select-all" name="select-all">
                    <label class="custom-control-label" for="select-all"></label>
                </div>
            </th>
            <th>Title</th>
            <th>Author</th>
            <th>Preview</th>
            <th>Status</th>
            <th>Date</th>
        </tr></thead>
        @forelse($announcements as $ann)
            <tbody class="js-table-sections-header">
                <tr data-id="{{ $ann->id }}">
                    <td class="pl-6">
                        <div class="custom-checkbox custom-control custom-control-lg">
                            <input type="checkbox" class="custom-control-input row-checkbox" id="check-{{$ann->id}}" name="check-{{$ann->id}}">
                            <label class="custom-control-label" for="check-{{$ann->id}}"></label>
                        </div>
                    </td>
                    <td class="title">{{ $ann->title }}</td>
                    <td class="author">{{ $ann->author }}</td>
                    <td><a class="btn btn-outline-fullfillment px-2 py-1" href="#preview-ann-{{ $ann->id }}" data-toggle="modal">Preview</a></td>
                    <td class="status">{{ $ann->status == 'scheduled' && $ann->isPublished() ? 'Published' : ucwords($ann->status) }}</td>
                    <td class="date">{!! $ann->publish_date ? $ann->publish_date->format('Y-m-d g:i a') : '<span class="text-muted">(unscheduled)</span>' !!}</td>
                </tr>
            </tbody>
            <tbody>
                <tr class="bg-light" data-id="{{ $ann->id }}">
                    <td></td>
                    <td colspan="5">
                        <div class="row">
                            <div class="col-md-6 border-right">
                                <h5>Quick Edit</h5>
                                <div class="form-group">
                                    <label for="title-{{$ann->id}}">Title</label>
                                    <input type="text" class="form-control ann-title" id="title-{{$ann->id}}" placeholder="Title" value="{{ $ann->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="status-{{$ann->id}}">Status</label>
                                    <select id="status-{{$ann->id}}" class="form-control ann-status">
                                        @foreach( $statuses as $status => $label )
                                            <option value="{{ $status }}" @if( $ann->status == $status ) selected @endif> {{ $label }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 scheduler">
                                <div class="custom-control custom-checkbox custom-control-lg">
                                    <input type="checkbox" class="custom-control-input" id="is_scheduled-{{$ann->id}}" name="is_scheduled" @if( isset($ann->publish_date) ) checked @endif>
                                    <label class="custom-control-label font-w400" for="is_scheduled-{{$ann->id}}">Scheduled Post</label>
                                </div>
                                <div class="date-selector mt-4" @if( empty($ann->publish_date) ) style="display: none;" @endif>
                                    <input type="text" class="js-flatpickr ann-publish_date form-control bg-white" id="ann-publish_date-{{$ann->id}}" name="publish_date" placeholder="Choose a date to publish on..." data-inline="true" data-enable-time="true" value="{{ $ann->publish_date ?? null }}">
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="{{ route('announcement-view', $ann->id) }}" class="btn btn-dark">Edit</a>
                            <button class="btn btn-secondary update-btn">Update</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        @empty
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="py-4 text-center"><em>No Announcements found</em></div>
                    </td>
                </tr>
            </tbody>
        @endforelse
    </table>

    @foreach( $announcements as $ann )
        <x-announcement-modal id="preview-ann-{{ $ann->id }}"
            image="storage/{{ $ann->media }}" 
            :action="['link' => $ann->action_link, 'text' => $ann->action_text]">
            <x-slot name="title">
                {{ $ann->title }} <br>
                <small class="text-primary">{{ $ann->author }}</small>
            </x-slot>
            <x-block-content class="bg-light prev-content">
                {!! $ann->render() !!}
            </x-block-content>
        </x-announcement-modal>
    @endforeach

</div>
@endsection

@push('js_after')
    <script src="{{ asset('/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script>
        $(function(){ 
            Dashmix.helpers(['table-tools-sections', 'flatpickr']); 

            $('#select-all').click(function(){
                $('.row-checkbox').prop('checked', $('#select-all').prop('checked'));
            });
            $('.row-checkbox').click(function(){
                var total = $('.row-checkbox');
                var checked = $('.row-checkbox:checked');
                if( checked.length == total.length ){
                    $('#select-all').prop('indeterminate', false);
                    $('#select-all').prop('checked', true);
                } else if ( checked.length == 0 ){
                    $('#select-all').prop('indeterminate', false);
                    $('#select-all').prop('checked', false);
                } else {
                    $('#select-all').prop('indeterminate', true);
                }
            });


            $('.js-flatpickr').each(function(i, el){
                $(el).data('last_date', el.value);
            });
            

            $('[name="is_scheduled"]').click(function(){ 
                var $scheduler = $(this).closest('.scheduler');
                $scheduler.find('.date-selector').toggle();

                if( !this.checked ){
                    $scheduler.find('.js-flatpickr').val(null);
                } else {
                    $scheduler.find('.js-flatpickr').val( $scheduler.find('.js-flatpickr').data('last_date') );
                }
            });
            $('.js-flatpickr').on('input', function(){
                $(this).data('last_date', this.value);
            });

            $('.update-btn').click(function(){
                var $btn = $(this);
                $btn.html('<i class="spinner-border spinner-border-sm"></i> Saving');

                var $row = $btn.closest('tr');
                var title = $row.find('.ann-title').val(),
                    status = $row.find('.ann-status').val(),
                    publish_date = $row.find('.ann-publish_date').val();

                $.post({
                    url: '/announcements/' + $row.data('id'),
                    data: {
                        _token: "{{ csrf_token() }}",
                        title: title,
                        status: status,
                        publish_date: publish_date
                    }
                })
                .done(function(){
                    $btn.html('Update');
                    var $row_head = $('.js-table-sections-header [data-id="'+$row.data('id')+'"]');

                    var published = new Date(publish_date) < new Date();

                    $row_head.find('.title').html( title );
                    $row_head.find('.status').html( published ? 'Published' : status.charAt(0).toUpperCase() + status.slice(1) );
                    $row_head.find('.date').html( publish_date || '(unscheduled)' );
                });
            });
        });
    </script>
@endpush
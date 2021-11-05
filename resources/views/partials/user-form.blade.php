<div class="dropdown-menu dropdown-menu-right mt-0 p-0 text-left" aria-labelledby="page-header-user-dropdown" style="filter: drop-shadow(2px 4px 6px rgba(0,0,0,0.25)); z-index: 100;">
    @if( $user )
    <a href="{{ route('profile') }}" class="dropdown-item">Profile</a>
    <a href="{{ route('announcements-list') }}" class="dropdown-item">Announcements</a>
    @endif

    @push('js_after')
        <script>
            $('#page-header-user-dropdown').on('click', function() {
                // Toggle show class on dropdown
                $(this.nextElementSibling).toggleClass('show');

                // Toggle aria-expanded attribute for styling
                return $(this).attr('aria-expanded') == 'true' ? $(this).attr('aria-expanded', 'false') : $(this).attr('aria-expanded', 'true');
            });
        </script>
    @endpush
</div>
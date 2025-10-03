@extends($activeTheme. 'layouts.auth')
@section('auth')
    <div class="py-5 ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="text-end mb-4">
                        <button class="btn btn-sm btn-primary addBtn" type="button"><i class="ti ti-circle-plus"></i> @lang('Add New')</button>
                    </div>
                    <div class="card custom--card">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table custom--table">
                                    <thead>
                                        <tr>
                                            <th>@lang('S.N.')</th>
                                            <th>@lang('Name')</th>
                                            <th>@lang('Action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($categories as $category)
                                            <tr>
                                                <td>{{ $categories->firstItem() + $loop->index }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline-primary editBtn" 
                                                        data-resource="{{ $category }}" 
                                                        data-action="{{ route('user.bill.category.store', $category->id) }}">
                                                        <i class="ti ti-edit"></i> @lang('Edit')
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                @include('partials.noData')
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @if($categories->hasPages())
                            <div class="card-footer">
                                {{ $categories->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Update Modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="col-form-label required">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('page-script')
    <script>
        (function ($) {
            'use strict';

            let modal = $('#addModal');

            $('.addBtn').on('click', function() {
                let actionRoute = `{{ route('user.bill.category.store') }}`;

                modal.find('.modal-title').text('Add New Category');
                modal.find('form')[0].reset();
                modal.find('form').attr('action', actionRoute);
                modal.modal('show');
            });

            $('.editBtn').on('click', function() {
                let resource    = $(this).data('resource');
                let actionRoute = $(this).data('action');

                modal.find('.modal-title').text('Update Category');
                modal.find('[name=name]').val(resource.name);
                modal.find('form').attr('action', actionRoute);
                
                modal.modal('show');
            });
        })(jQuery)
    </script>
@endpush
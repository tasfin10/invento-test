@extends('admin.layouts.master')

@section('master')
    <div class="col-12">
        <table class="table table--striped table-borderless">
            <thead>
                <tr>
                    <th>@lang('Short Code')</th>
                    <th>@lang('Description')</th>
                </tr>
            </thead>
            <tbody>
                @foreach($template->shortcodes as $shortcode => $key)
                    <tr>
                        <td>@php echo "{{". $shortcode ."}}"  @endphp</td>
                        <td>{{ __($key) }}</td>
                    </tr>
                @endforeach

                @foreach($setting->universal_shortcodes as $shortCode => $codeDetails)
                    <tr>
                        <td>@{{@php echo $shortCode @endphp}}</td>
                        <td>{{ __($codeDetails) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-12">
        <form class="row g-4" action="{{ route('admin.notification.template.update', $template->id) }}" method="POST">
            @csrf
            <div class="col-lg-6">
                <div class="custom--card">
                    <div class="card-header">
                        <h3 class="title">@lang('Email Template')</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group d-flex align-items-center gap-3">
                            <label for="emailStatus" class="col-form--label">@lang('Status') :</label>
                            <div class="form-check form--switch">
                                <input class="form-check-input" id="emailStatus" type="checkbox" name="email_status" @checked($template->email_status)>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form--label required">@lang('Subject')</label>
                            <input type="text" class="form--control" name="subject" value="{{ $template->subj }}" placeholder="@lang('Email subject')" required>
                        </div>
                        <div class="form-group mb-0 editor-wrapper">
                            <label class="form--label required">@lang('Email Body')</label>
                            <textarea class="form--control trumEdit" name="email_body">{{ $template->email_body }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="custom--card h-auto">
                    <div class="card-header">
                        <h3 class="title">@lang('SMS Template')</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group d-flex align-items-center gap-3">
                            <label for="smsStatus" class="col-form--label">@lang('Status') :</label>
                            <div class="form-check form--switch">
                                <input class="form-check-input" id="smsStatus" type="checkbox" name="sms_status" @checked($template->sms_status)>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <label class="form--label required">@lang('SMS Body')</label>
                            <textarea class="form--control" name="sms_body" required>{{ $template->sms_body }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <button class="btn btn--base px-4" type="submit">@lang('Submit')</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('breadcrumb')
    <a href="{{ route('admin.notification.templates') }}" class="btn btn--sm btn--base"><i class="ti ti-circle-arrow-left"></i> @lang('Back')</a>
@endpush

@push('page-script-lib')
    <script src="{{asset('assets/admin/js/page/ckEditor.js')}}"></script>
@endpush

@push('page-script')
    <script>
        (function ($) {
            "use strict";

            if ($(".trumEdit")[0]) {
                    $('.editor-wrapper').find('.ck-editor').remove();

                    window.editors = {};
                    document.querySelectorAll('.trumEdit').forEach((node, index) => {
                        ClassicEditor
                            .create(node, {
                                heading: {
                                    options: [
                                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                                    ]
                                },
                            })
                            .then(newEditor => {
                                window.editors[index] = newEditor;
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    });
                }
        })(jQuery);
    </script>
@endpush


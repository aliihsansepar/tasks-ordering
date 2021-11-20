@extends('layouts.app')

@section('content')
    <div class="row border-bottom border-1 mb-4">
        <div class="col-12 d-flex justify-content-between p-2">
            <h2>Create Task</h2>
            <span>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary"> &lt; Back</a>
            </span>
        </div>
    </div>
    <div class="row">
        <div class="col-12 shadow-sm p-3 mb-5 bg-body rounded d-flex align-items-center justify-content-center">
            <form action="{{ route('tasks.store') }}" class="p-5 col-md-6 col-xs-12" id="taskCreateForm">
                <div class="alert d-none" id="alertBox"></div>
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title"
                           placeholder="Enter Task Title" required>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                    <select name="type" id="type" class="form-select" required>
                        <option value="">Select Task Type</option>
                        <option value="invoice_ops">Invoice</option>
                        <option value="common_ops">Common</option>
                        <option value="custom_ops">Custom</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    <select name="country" id="country" class="form-select">
                        <option value="">Select Country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country['code'] }}">{{ $country['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="prerequisites" class="form-label">Prerequisites</label>
                    <select name="prerequisites" id="prerequisites" class="form-select">
                        <option value="">Select Prerequisites</option>
                        @foreach($tasks as $task)
                            <option value="{{ $task->id }}">{{ $task->title }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Show only type selected invoice --}}
                <div class="input-group mb-3 d-none" id="amount-section">
                    <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Amount">
                    <select name="currency" id="currency" class="dropdown-toggle bg-transparent p-2"
                            data-bs-toggle="dropdown">
                        <option>₺</option>
                        <option>€</option>
                        <option>$</option>
                        <option>£</option>
                    </select>
                </div>
                {{-- Show only type selected invoice --}}
                <div class="col-12">
                    <button onclick="sendTaskForm()" type="button" class="btn btn-success col-12">Create Task</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#type').on('change', function (e) {
            e.preventDefault();
            if ($(this).val() === 'invoice_ops') {
                $('#amount-section').removeClass('d-none')
            } else {
                $('#amount-section').addClass('d-none')
            }
        });

        function sendTaskForm() {
            let form = $('#taskCreateForm'),
                formUrl = form.attr('action'),
                formData = form.serialize();

            sendForm(form, formUrl, formData);
        }

        function sendForm(form, formUrl, formData) {
            $.ajax({
                'url': formUrl,
                'method': 'post',
                'data': formData,
                success: function (result) {
                    resetAlertBox();
                    $('#alertBox').html(result.messsage).addClass('alert-success').removeClass('d-none');
                    form[0].reset();
                },
                error: function (error) {
                    resetAlertBox();
                    let errors = error.responseJSON.errors,
                        errorHTML = '<ul>';
                    $.each(errors, function (i, el) {
                        errorHTML+='<li>'+el+'</li>'
                    });
                    errorHTML +='</ul>';
                    $('#alertBox').html(errorHTML).addClass('alert-danger').removeClass('d-none');
                }
            })
        }

        function resetAlertBox() {
            $('#alertBox').removeClass('alert-success alert-danger').addClass('d-none');
        }
    </script>
@endpush

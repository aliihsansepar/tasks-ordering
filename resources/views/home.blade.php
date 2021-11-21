@extends('layouts.app')

@section('content')
    <div class="row border-bottom border-1 mb-4">
        <div class="col-12 d-flex justify-content-end p-2">
            <span>
                <a href="{{ route('tasks.create') }}" class="btn btn-outline-primary">Create Task</a>
            </span>
        </div>
    </div>
    <div class="row">
        <div class="col-12 w-100 shadow-sm p-3 mb-5 bg-body rounded">
            <table id="taskTable" class="table table-striped" style="width: 100%">
                <thead>
                <tr>
                    <th>Order</th>
                    <th>title</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Prerequisites</th>
                </tr>
                </thead>
                <tbody>
                @if(is_string($tasks))
                    <tr>
                        <td colspan="5" align="center">{{ $tasks }}</td>
                    </tr>
                @elseif(count($tasks) > 0)
                    @foreach($tasks as $task)
                    <tr>
                        <td width="5%">{{ $loop->iteration }}</td>
                        <td>{{ $task['title'] }}</td>
                        <td>{{ \Illuminate\Support\Str::title($task['type']) }}</td>
                        <td>{{ optional($task['amount'])['amount'] . ' ' . optional($task['amount'])['currency']}}</td>
                        <td width="25%">
                            <select name="prerequisites[]" class="form-control prerequisites" multiple>
                                @foreach($task['prerequisites'] as $prerequisity)
                                    <option value="{{ $prerequisity }}"  selected="selected"> {{ $prerequisity }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" align="center">Data Not Available</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

        $('.prerequisites').select2({
            data: @json($tasksForSelect)
        });
        $(document).ready(function () {
            $('#taskTable').DataTable({
                "order": [0, "asc"]
            });
        });
    </script>
@endpush

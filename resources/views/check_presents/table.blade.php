<table class="table table-responsive" id="checkPresents-table">
    <thead>
        <tr>
            <th>Check Status</th>
            <th>Present Id</th>
            <th>Present Name</th>
            <th>Pay status</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($checkPresents as $checkPresent)
        <tr>
            <td>{!! $checkPresent->check_status !!}</td>
            <td>{!! $checkPresent->present_id !!}</td>
            <td>{!! $checkPresent->present->sequence->description !!}</td>
            <td>
                    @if($checkPresent->pay_status)
                <span class="label label-success">Yes</span>
                @else
                <span class="label label-default">No</span>

            @endif
            </td>
            <td>
                {!! Form::open(['route' => ['checkPresents.destroy', $checkPresent->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('checkPresents.show', [$checkPresent->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('checkPresents.edit', [$checkPresent->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {{-- {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!} --}}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>


@section('scripts')
<script>
    $(document).ready(function () {
        $('#checkPresents-table').DataTable();
    });

</script>
@endsection
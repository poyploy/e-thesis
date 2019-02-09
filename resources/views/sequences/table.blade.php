<table class="table table-responsive" id="sequences-table">
    <thead>
        <tr>
            {{-- <th>Id</th> --}}
            <th>ปีการศึกษา</th>
            <th>ครั้งที่นำเสนอ เทอม/ครั้ง</th>
            <th>วัน-เวลา</th>
            <th>สถานะการอัปโหลด</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($sequences as $sequence)
        <tr>
            {{-- <td>{!! $sequence->id !!}</td> --}}
            <td>{!! $sequence->year !!}</td>
            <td>{!! $sequence->description !!}</td>
            <td>{!! $sequence->date_time !!}</td>
            <td>{!! $sequence->uploadfile_status == 0 ? "close":"open"  !!}</td>
            <td>
                {!! Form::open(['route' => ['sequences.destroy', $sequence->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('sequences.show', [$sequence->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('sequences.edit', [$sequence->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>


@section('scripts')
<script>
$(document).ready( function () {
    $('#sequences-table').DataTable();
} );

</script>
@endsection
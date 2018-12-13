<div class="col-sm-12" style="margin-bottom: 25px;">
    <div class="form-inline">
        <div class="form-group">
            {!! Form::open(['route' => 'rooms.index', 'method' => 'get']) !!}
            <label for="exampleInputName2">Years :</label>
            @if(empty($filter_year))
            {!! Form::select('year', $years,null , ['class' => 'form-control select2']) !!}
            @else
            {!! Form::select('year', $years,$filter_year , ['class' => 'form-control select2']) !!}
            @endif
            <button type="submit" class="btn btn-default">Filter</button>
            {!! Form::close() !!}
        </div>
        @if(!empty($filter_year))
        <div class="form-group"  style="margin-left: 25px;">
            <label for="exampleInputName2">Group by : </label>
            <button type="button" class="form-control" onclick="GroupByRandom('{{$filter_year}}')">Random</button>
        <button type="button" class="btn btn-default" onclick="GroupByOrder('{{$filter_year}}')">Order</button>
        </div>
        @endif
    </div>
</div>

<table class="table table-responsive" id="rooms-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Num</th>
            <th>Max Student</th>
            <th>Year</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rooms as $room)
        <tr>
            <td>{!! $room->name !!}</td>
            <td>{!! $room->num !!}</td>
            <td>{!! $room->max_student !!}</td>
            <td>{!! $room->year !!}</td>
            <td>{!! $room->status === 1 ? 'ACTIVE' : 'INACTIVE' !!}</td>
            <td>
                {!! Form::open(['route' => ['rooms.destroy', $room->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    @if(count($room->roomUsers) < 1) <a href="{!! route('rooms.manual', [$room->id]) !!}" class='btn btn-info btn-xs'><i
                            class="glyphicon glyphicon-user"></i></a>
                        @endif
                        <a href="{!! route('rooms.show', [$room->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('rooms.edit', [$room->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class'
                        => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
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
        $('#rooms-table').DataTable();
    });

    @if(!empty($filter_year))
    var GroupByRandom = function () {
        window.location.href = "{{ route('rooms.groupByRandom' , ['year' => $filter_year]) }}";
        // alert('Group by random -> room : ' + room_id)
    }

    var GroupByOrder = function (room_id) {
        window.location.href = "{{ route('rooms.groupByOrder' , ['year' => $filter_year]) }}";
    }
    @endif

</script>
@endsection
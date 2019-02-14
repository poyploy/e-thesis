<table class="table table-responsive" id="checkPresents-table">
    <thead>
        <tr>
            <th>จำนวนครั้งที่เช็คชื่อ</th>
            {{-- <th>Present Id</th> --}}
            <th width="20%">ชื่อ</th>
            <th width="30%">นามสกุล</th>
            <th>ครั้งที่นำเสนอ เทอม/ครั้งที่</th>
            {{-- <th>action</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach($checkPresents as $checkPresent)
        <tr>
            <td>{!! $checkPresent->check_status !!}</td>
            {{-- <td>{!! $checkPresent->present_id !!}</td> --}}
            <td>{!! $checkPresent->user->name_TH !!}</td>
            <td>{!! $checkPresent->user->surname_TH !!}</td>
            <td>{!! $checkPresent->present->sequence->description !!}</td>
            <td>
                {!! Form::open(['route' => ['checkPresents.destroy',
                $checkPresent->id], 'method' => 'delete']) !!}
                {{-- <div class="btn-group">
                    <a
                        href="{!! route('checkPresents.show', [$checkPresent->id]) !!}"
                        class="btn btn-default btn-xs"
                        ><i class="glyphicon glyphicon-eye-open"></i
                    ></a>
                    <a
                        href="{!! route('checkPresents.edit', [$checkPresent->id]) !!}"
                        class="btn btn-default btn-xs"
                        ><i class="glyphicon glyphicon-edit"></i
                    ></a> --}}
                    {{-- {!! Form::button('<i
                        class="glyphicon glyphicon-trash"
                    ></i
                    >', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs',
                    'onclick' => "return confirm('Are you sure?')"]) !!} --}}
                {{-- </div> --}}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@section('scripts')
<script>
    $(document).ready(function() {
        $('#checkPresents-table').DataTable()
    })
</script>
@endsection

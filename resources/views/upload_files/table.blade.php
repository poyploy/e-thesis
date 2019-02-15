<table class="table table-responsive" id="uploadFiles-table">
    <thead>
        <tr>
            {{-- <th>รหัสผู้ใช้งาน</th> --}}
            <th>ครั้งที่นำเสนอ</th>
            <th>ไฟล์</th>
            <th>รหัสประจำตัวนักศึกษา</th>
            <th>วัน-เวลา</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($uploadFiles as $uploadFile)
        <tr>
            {{-- <td>{!! $uploadFile->user_id !!}</td> --}}
            <td>{!! $uploadFile->sequence->description !!}</td>
            <td><a target="_blank" href="{{ asset('storage'.$uploadFile->file) }}" >{!! $uploadFile->file !!}</a></td>
            <td>{!! $uploadFile->student_id !!}</td>
            <td>{!! $uploadFile->created_at !!}</td>
            <td>
                {!! Form::open(['route' => ['uploadFiles.destroy', $uploadFile->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('uploadFiles.show', [$uploadFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    {{-- <a href="{!! route('uploadFiles.edit', [$uploadFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a> --}}
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
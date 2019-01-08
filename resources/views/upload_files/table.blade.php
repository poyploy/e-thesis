<table class="table table-responsive" id="uploadFiles-table">
    <thead>
        <tr>
            <th>User Id</th>
        <th>Sequence Id</th>
        <th>File</th>
        <th>Student Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($uploadFiles as $uploadFile)
        <tr>
            <td>{!! $uploadFile->user_id !!}</td>
            <td>{!! $uploadFile->sequence_id !!}</td>
            <td><a target="_blank" href="{{ asset('storage'.$uploadFile->file) }}" >{!! $uploadFile->file !!}</a></td>
            <td>{!! $uploadFile->student_id !!}</td>
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
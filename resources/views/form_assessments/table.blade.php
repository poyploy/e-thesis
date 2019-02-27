<table class="table table-responsive" id="formAssessments-table">
    <thead>
        <tr>
            <th>ครั้งที่นำเสนอ</th>
            <th>หัวข้อในการตรวจ</th>
            <th>คะแนนเต็ม</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($formAssessments as $formAssessment)
        @php
        $totalpoint = 0;
        @endphp
        @foreach ($formAssessment as $item)
        @php
        $totalpoint += $item->max;
        @endphp
        <tr>
            <td>{!! $item->sequence_id !!}</td>
            <td>{!! $item->title !!}</td>
            <td>{!! $item->max !!}</td>
            <td>
                {!! Form::open(['route' => ['formAssessments.destroy', $item->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('formAssessments.detail', [$item->id]) !!}" class='btn btn-info btn-xs'><i
                            class="glyphicon glyphicon-th-list"></i></a>
                    <a href="{!! route('formAssessments.show', [$item->id]) !!}" class='btn btn-default btn-xs'><i
                            class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('formAssessments.edit', [$item->id]) !!}" class='btn btn-default btn-xs'><i
                            class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn
                    btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="2" class="text-right"><b>คะแนนรวม</b> : </td>
            <td colspan="2"> <b> {{ $totalpoint }}</b></td>
        </tr>
        @endforeach
    </tbody>
</table>
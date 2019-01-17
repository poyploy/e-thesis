<table class="table table-responsive" id="advisorsApproves-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Student Name</th>
            <th>Student Surname</th>
            <th>Time</th>
            <th>Remark</th>
            <th>CreatedAt</th>
            {{-- <th colspan="3">Action</th> --}}
        </tr>
    </thead>
    <tbody>
    @foreach($approveds as $ap)
        <tr>
            <td>{!! $ap->id !!}</td>
            <td>{!! $ap->user->name_TH !!}</td>
            <td>{!! $ap->user->surname_TH !!}</td>
            <td>{!! $ap->count !!}</td>
            <td>{!! $ap->remark !!}</td>
            <td>{!! $ap->created_at !!}</td>
            
        </tr>
    @endforeach
    </tbody>
</table>
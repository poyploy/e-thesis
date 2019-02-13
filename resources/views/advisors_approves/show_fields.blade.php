<table class="table table-responsive" id="advisorsApproves-table">
    <thead>
        <tr>
            {{-- <th>รหัส</th> --}}
            <th style="width:10%">ครั้งที่เข้าพบ</th>
            <th>ชื่อ</th>
            <th>นามสกุล</th>
            <th>คำอธิบาย</th>
            <th>วัน/เวลา</th>
            {{-- <th colspan="3">Action</th> --}}
        </tr>
    </thead>
    <tbody>
    @foreach($approveds as $ap)
        <tr>
            {{-- <td>{!! $ap->id !!}</td> --}}
            <td>{!! $ap->count !!}</td>
            <td>{!! $ap->user->name_TH !!}</td>
            <td>{!! $ap->user->surname_TH !!}</td>
            <td>{!! $ap->remark !!}</td>
            <td>{!! $ap->created_at !!}</td>
            
        </tr>
    @endforeach
    </tbody>
</table>
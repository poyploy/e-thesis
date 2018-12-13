<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('year', 'Year:') !!} {{$room->year}}
</div>


<div id="div-ids"></div>
<div class="form-group col-sm-12">
    <!-- Year Field -->
    @if(!empty($users))
    <table class="table table-responsive" id="users-table">
        <thead>
            <tr>
                <th width="6%">Action</th>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Year</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>
                    <input type="checkbox" id="{{$user->id}}" name="ids" value="{{$user->id}}">
                </td>
                <td>{!! $user->id !!}</td>
                <td>{!! $user->name !!}</td>
                <td>{!! $user->email !!}</td>
                <td>{!! $user->year !!}</td>

            </tr>
            @endforeach
        </tbody>
    </table>

    @endif
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('Save', ['class' => 'btn btn-primary', 'onClick' => 'getData()']) !!}
    <a href="{!! route('rooms.index') !!}" class="btn btn-default">Cancel</a>
</div>


@section('scripts')
<script>
    var arr = []
    var getData = function () {
        console.log(arr)
        for (i = 0; i < arr.length; i++) {
            $('<input type="hidden" name="user_ids[]" />').val(arr[i]).appendTo('#div-ids');
        }
        $('#room-manual-form').submit();
    }

    $('input[name=ids]').click(function (e) {

        var val = $(this).val()
        var checked = $(this).prop("checked")
        // alert(val+' is checked > '+checked)
        if (checked) {
            arr.push(val)
        } else {
            arr = $.grep(arr, function (value) {
                return value != val;
            });
        }
    })

    var GroupByRandom = function(room_id) {
        alert('Group by random -> room : ' + room_id)
    }

    var GroupByOrder = function(room_id) {
        alert('Group by order -> room : ' + room_id)
    }

    $(document).ready(function () {

        $('#users-table').DataTable();

    });

</script>
@endsection
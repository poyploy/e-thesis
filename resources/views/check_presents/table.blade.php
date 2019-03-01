<table class="table table-responsive" id="checkPresents-table">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {
            opacity: 0.7;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9);
            /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation */
        .modal-content,
        #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {
                -webkit-transform: scale(0)
            }

            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }
        }
    </style>
    <thead>
        <tr style="font-family: 'Kanit', sans-serif;">
            <th>จำนวนครั้งที่เช็คชื่อ</th>
            {{-- <th>Present Id</th> --}}
            <th width="10%">ชื่อ</th>
            <th width="15%">นามสกุล</th>
            <th>ครั้งที่นำเสนอ เทอม/ครั้งที่</th>
            <th>สถานะการจ่ายเงิน</th>
            <th>หลักฐานการโอนเงิน</th>

            {{-- <th>action</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach($checkPresents as $checkPresent)
        <tr style="font-family: 'Kanit', sans-serif;">
            <td>{!! $checkPresent->check_status !!}</td>
            {{-- <td>{!! $checkPresent->present_id !!}</td> --}}
            <td>{!! $checkPresent->user->name_TH !!}</td>
            <td>{!! $checkPresent->user->surname_TH !!}</td>
            <td>{!! $checkPresent->present->sequence->description !!}</td>
            <td>
                @if($checkPresent->pay_status)
                <span class="label label-success">Yes</span>
                @else
                <span class="label label-default">No</span>

                @endif
            </td>
            {{-- {{dd($checkPresent->slip)}} --}}
            <td><img id="myImg" src="{{ asset('/storage/'.$checkPresent->slip) }}" alt="" width="50"></td>

            <div id="myModal" class="modal">
                <span class="close">dd</span>
                <img class="modal-content" id="img01">
                <div id="caption"></div>
            </div>
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
    $(document).ready(function () {
        $('#checkPresents-table').DataTable()
    })

        // Get the modal
        var modal = document.getElementById('myModal');
        
        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById('myImg');
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function(){
          modal.style.display = "block";
          modalImg.src = this.src;
          captionText.innerHTML = this.alt;
        }
        
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() { 
          modal.style.display = "none";
        }
        </script>
@endsection
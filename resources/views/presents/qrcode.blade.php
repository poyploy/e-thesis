@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Qrcode
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row text-center" style="padding-left: 20px">
                <h1>Present {{ $present->sequence->description}}</h1>
                <h2>Room {{ $present->room->name}}</h2>
                    <img src="https://chart.googleapis.com/chart?chs=450x450&cht=qr&chl=http://35.247.147.98:8084/qrcode/scan/{{ $present->code }}">
                    {{-- <a href="{!! route('presents.index') !!}" class="btn btn-default">Back</a> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

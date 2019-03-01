@extends('layouts.app') @section('content')
<link
    href="https://getbootstrap.com/docs/3.3/assets/css/docs.min.css"
    rel="stylesheet"
/>

<section class="content-header">
    <h1 class="pull-left" style="font-family: 'Kanit', sans-serif;">
        ประวัติการเช็คชื่อ
    </h1>
    <h1 class="pull-right">
        <a
            class="btn btn-primary pull-right"
            style="margin-top: -10px;margin-bottom: 5px; background-color:red; border-color:red"
            href="{!! route('qrcode.scan') !!}/"
            rel="nofollow"
            >Scan</a
        >
    </h1>
</section>
<br>
<div class="content">
        <div class="box box-primary">
                <div class="row">
                    <br><div class="col-sm-12" style="margin-left:2%">
                    <form action="{{ route('qrcode.index') }}" method="GET">

                        <div class="form-group">
                            <label for="">ปีการศึกษา</label>
                            <select name="year" id="">
                                @for ($i = $years;$i >= $years-10; $i--)
                            <option value="{{$i}}"  {!! $i == $year ? 'selected' : '' !!}>{{$i}}</option>
                                @endfor
                            </select>
                            <button>submit</button>
                        </div>
                    </form>
                    </div>
                </div>
        </div>
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="row" style="font-family: 'Kanit', sans-serif;">
                <div class="col-sm-3">
                        <div
                            class="bs-callout bs-callout-info"
                            id="callout-btn-group-tooltips"
                        >
                            <h4 style="font-family: 'Kanit', sans-serif;">
                                จำนวนครั้งที่เช็คชื่อ
                            </h4>
                            <p>
                                {{ number_format($checkPresentCount) }}
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div
                            class="bs-callout bs-callout-info"
                            id="callout-btn-group-tooltips"
                        >
                            <h4 style="font-family: 'Kanit', sans-serif;">
                                สถานะการจ่ายเงิน
                            </h4>
                            <p>
                                {{ number_format($checkPresentPayCount) }}
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div
                            class="bs-callout bs-callout-info"
                            id="callout-btn-group-tooltips"
                        >
                            <h4 style="font-family: 'Kanit', sans-serif;">
                                ค่าตรวจ
                            </h4>
                            <p>
                                {{ number_format($total) }}
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div
                            class="bs-callout bs-callout-info"
                            id="callout-btn-group-tooltips"
                        >
                            <h4 style="font-family: 'Kanit', sans-serif;">
                                ค่าที่ปรึกษา
                            </h4>
                            <p>
                                {{ number_format(($checkPresentCount*500)*$student) }}
                            </p>
                        </div>
                    </div>
        </div>
        
    </div>

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">
            @include('check_presents.table')
        </div>
    </div>
    <div class="text-center"></div>
</div>
@endsection

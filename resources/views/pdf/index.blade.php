<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- jQuery 3.1.1 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        /* @font-face {
            font-family: 'THSarabunNew';
            src: url('{{ asset("fonts/THSarabunNew.ttf") }}') format('truetype'),
                url('{{ asset("fonts/THSarabunNew Italic.ttf") }}') format('truetype'),
                url('{{ asset("fonts/THSarabunNew BoldItalic.ttf") }}') format('truetype'),
                url('{{ asset("fonts/THSarabunNew Bold.ttf") }}') format('truetype');
            font-weight: bold;
            font-style: normal;
        } */

        @font-face {
            font-family: 'THSarabunNew';
            src: url('{{ asset("fonts/THSarabunNew.woff") }}') format('woff')
                url('{{ asset("fonts/THSarabunNew.woff2") }}') format('woff2');
            font-weight: bold;
            font-style: normal;
        }

        @page {
            size: 7in 9.25in;
            margin: 27mm 16mm 27mm 16mm;
        }

        body {
            /* line-height: 1em; */
            font-family: 'THSarabunNew';
            font-size: 14px;
        }

        div.titlepage {
            page: blank;
        }

        .watermark {
            height: 95%;
            width: 90%;
            position: absolute;
            top: 0;
            bottom: 0;
            right: 0;
            left: 0;
            background-repeat: repeat-y;
            z-index: 9999;
            opacity: 0.1;
        }
        .img-circle{
            width: 70%;
            height: auto;
            padding-top: 30%;
            padding-left: 20%; 
            
        }

    </style>
</head>

<body>
    <div class="watermark" >
        <img src="http://www.mum22.com/img/%E0%B8%A8%E0%B8%B4%E0%B8%A5%E0%B8%9B%E0%B8%B2%E0%B8%81%E0%B8%A3.png" class="img-circle"
        alt="User Image"/>
    </div>
    <div class="titlepage" style="text-align: center; width:100%; ">
    <h2>REPORT MONEY OF TEACHER </h2>
    <h3>AT SILPAKORN UNIVERSITY {{ $year + 543 }}</h3>
    </div>
    <table width="100%">
        <tr height="150px">
            <td width="50%" style="line-height: 0.5em;">
                <p>Part: Silpakorn University,City Campus 
                    <br><br><br>(Muang Thong Thani)</p>
                <p>Address: 80 Popular Road,Banmai,
                    <br><br><br>Pakkret,Nonthaburi 11120</p>
                <p>Tel: 091-765-9890</p>
                <p>Tax: 0-03259-4033</p>

            </td>
            <td align="right" style=" line-height: 0.5em;">
                <p>Name-Surname : {{ $auth->name_EN }} {{ $auth->surname_EN }}</p>
                <p>E-mail : {{ $auth->email }}</p>
            </td>
        </tr>
    </table>
    <br>
    <div style="width: 90%; display: block;margin: 0 auto;">
        {{-- {{ dd($checkPresents , $total) }} --}}
        <table width="100%">
            <thead>
                <tr>
                    -----------------------------------------------------------------------------------------------
                    <td><b>
                        Cost Advisor (student*500)
                    </td>
                <tr>
                    <td>
                        Count Check Present : {{ number_format(($checkPresentCount*500)*$student) }}
                    </td>
                </tr>
                </tr>
            </thead>

            {{-- <tr>
                    <td>Count Check Present : </td>
                    <td>{{ number_format($checkPresentCount) }}</td>
            </tr> --}}

            <br>
            <table width="100%">
                <thead>
                        <td><b>
                                Cost Check Present
                        </td>
                    <tr>
                        -----------------------------------------------------------------------------------------------
                    <tr>
                        <td>
                            Arrange
                        </td>
                        <td>
                            Sequence Present (Term/Sequnce)
                        </td>
                        <td>
                            Total
                        </td>
                        
                    </tr>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($checkPresents as $item)
                   <tr> 
                        <td>
                            #
                        </td>
                        <td>
                            {!! $item->present->sequence->description !!}
                        </td>
                        <td>
                            {!! $total !!}
                        </td>
                    </tr>
                   @endforeach
                   <tr>
                       <td colspan="3" align="right"> Grand total</td>
                        <td>{{ number_format($total) }}</td>
                    </tr>
                </tbody>
            
            </table>

    </div>
    </table>

    <!-- <div class="chapter"></div> -->
    <br>
    <br>
    <table>
        <tr>
            <td>Count Check Present : </td>
            <td>{{ number_format($checkPresentCount) }}</td>
        </tr>
        <tr>
            <td>Count Payment Present : </td>
            <td>{{ number_format($checkPresentPayCount) }}</td>
        </tr>
    </table>

    <p>unc et augue eget nisl consectetur dapibus in ac sapien. Vestibulum ante ipsum primis in faucibus orci luctus et
        ultrices posuere cubilia Curae; Nulla neque neque, pretium vitae pharetra pulvinar, consequat eget ante. Nam
        semper, nulla quis feugiat aliquam, augue justo condimentum sapien, id condimentum ipsum quam convallis purus.
        Sed condimentum vehicula elit non placerat. Mauris urna orci, sollicitudin at metus sed, gravida dictum arcu.
        Morbi pharetra ultrices commodo.</p>
        <script>
                $(document).ready(function(){
                    window.print();
                })
            </script>   
</body>

</html>
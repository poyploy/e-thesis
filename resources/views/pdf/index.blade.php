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
    </style>
</head>

<body>
    <div class="titlepage" style="text-align: center; width:100%; ">
    <h3>Advisor Report @ {{ $year + 543 }}</h3>
    </div>
    <table width="100%">
        <tr height="150px">
            <td width="50%" style="line-height: 0.5em;">
                <p>name:  ICT su #d#</p>
                <p>address 12/52 </p>
                <p>tel 086-000-0000</p>
                <p>taxId 0000000000000000</p>

            </td>
            <td align="right" style=" line-height: 0.5em;">
                <p>ชื่ออาจารย์ {{ $auth->name_TH }} {{ $auth->surname_TH }}</p>
                <p>อีเมล์ {{ $auth->email }}</p>
            </td>
        </tr>
    </table>
    <br>
    <div style="width: 90%; display: block;margin: 0 auto;">
        {{-- {{ dd($checkPresents , $total) }} --}}
        <table width="100%">
            <thead>
                <tr>
                    <td>
                        ID
                    </td>
                    <td>
                        Name
                    </td>
                    <td>
                        Count
                    </td>
                    <td>
                        Total
                    </td>
                </tr>
            </thead>
            <tbody>
               @foreach ($checkPresents as $item)
               <tr>
                    <td>
                        @
                    </td>
                    <td>
                        Name surname
                    </td>
                    <td>
                        Count
                    </td>
                    <td>
                        500
                    </td>
                </tr>
               @endforeach
               <tr>
                   <td colspan="3" align="right">grand total</td>
                    <td>{{ number_format($total) }}</td>
                </tr>
            </tbody>
            
        </table>

    </div>

    <!-- <div class="chapter"></div> -->
    <br>
    <br>
    <table>
        <tr>
            <td>count Present : </td>
            <td>{{ number_format($checkPresentCount) }}</td>
        </tr>
        <tr>
            <td>count payment Present : </td>
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
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<table style = 'background-color:#fff;text-align:center;'>
    <tr><td>
            
        </td></tr>
    <tr><td>
            <hr style = 'border:solid 1px #000'></hr>
            <table style = 'width:100%;background-color:#fff;text-align:left;'><tr><td style = 'text-align:center' colspan = '2'>
                <tr><td colspan = '2'>
                    </td></tr>
                <tr><td colspan = '2'>
                        Dear  Admin<br><br>
                    </td></tr><tr><td colspan = '2'>
                    </td></tr>
                <tr><td><b>Product Name:</b></td><td>{{$data->title}}</td></tr>
                <tr><td><b>Product Description:</b></td><td>{!! $data->description !!}</td></tr>
                @if($data->picture)
                    <tr><td><b>Product Picture:</b></td><td><img src="{{asset('/storage/'.$data->picture)}}"/></td></tr>@endif
                @if($data->pdf_link)
                    <tr><td><b>Product Link:</b></td><td><a href="{{asset('/storage/'.$data->pdf_link)}}" download>Download</a></td></tr>
                @endif
              
				<tr><td colspan='2'>&nbsp;</tr>
                <tr><td colspan='2'>Thank You.</td></tr>
                <tr><td colspan='2'>&nbsp;</tr>
            </table>
        </td></tr>
</table>
</body>
</html>
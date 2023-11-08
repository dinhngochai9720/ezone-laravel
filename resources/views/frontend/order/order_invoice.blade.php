<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>Hóa đơn</title>

    <style type="text/css">
        * {
            font-family: 'Times New Roman', Times, serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .font {
            font-size: 15px;
        }

        .authority {
            /*text-align: center;*/
            float: right
        }

        .authority h5 {
            margin-top: -10px;
            color: green;
            /*text-align: center;*/
            margin-left: 35px;
        }

        .thanks p {
            color: green;
            ;
            font-size: 16px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }
    </style>

</head>

<body>

    <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
        <tr>
            <td valign="top">
                <!-- {{-- <img src="" alt="" width="150"/> --}} -->
                <h2 style="color: green; font-size: 26px;"><strong>Ezone Việt Nam</strong></h2>
            </td>
            <td align="right">
                <pre class="font">
          Ezone Việt Nam 
           Email:support@ezone.com <br>
           Điện thoại: 0398918811 <br>
           Địa chỉ: 55 Giải Phóng, Hai Bà Trưng, Hà Nội  <br>
        </pre>
            </td>
        </tr>

    </table>


    <table width="100%" style="background:white; padding:2px;"></table>

    <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
        <tr>
            <td>
                <p class="font" style="margin-left: 20px;">
                    <strong>Họ tên:</strong> {{ $order->name }} <br>
                    <strong>Email:</strong> {{ $order->email }} <br>
                    <strong>Điện thoại:</strong> {{ $order->phone }} <br>
                    <strong>Địa chỉ:</strong> {{ $order->address }} <br>
                    <strong>Post Code:</strong> {{ $order->post_code }}
                </p>
            </td>
            <td>
                <p class="font">
                <h3><span style="color: green;">#:</span> {{ $order->invoice_no }}</h3>
                Ngày đặt hàng: {{ date('j-n-Y', strtotime($order->order_date)) }} <br>
                Ngày giao hàng: {{ date('j-n-Y', strtotime($order->delivered_date)) }} <br>
                Phương thức thanh toán: {{ $order->payment_method }} </span>
                </p>
            </td>
        </tr>
    </table>
    <br />
    <h3>Chi tiết sản phẩm</h3>


    <table width="100%">
        <thead style="background-color: green; color:#FFFFFF;">
            <tr class="font">
                <th>Ảnh</th>
                <th>Tên</th>
                <th>Size</th>
                <th>Màu</th>
                <th>Code</th>
                <th>Số lượng</th>
                <th>Nhà cung cấp </th>
                <th>Tổng tiền sản phẩm </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($order_items as $item)
                <tr class="font">
                    <td align="center">
                        <img src="{{ public_path($item['product']['product_thumbnail']) }} " height="60px;"
                            width="60px;" alt="">
                    </td>
                    <td align="center">{{ $item['product']['product_name'] }}</td>

                    @if ($item->color == null)
                        <td align="center"></td>
                    @else
                        <td align="center">{{ $item->color }} </td>
                    @endif

                    @if ($item->size == null)
                        <td align="center"></td>
                    @else
                        <td align="center">{{ $item->size }} </td>
                    @endif

                    <td align="center">{{ $item['product']['product_code'] }}</td>
                    <td align="center">{{ $item->qty }}</td>

                    @if ($item->vendor_id == null)
                        <td align="center">Admin</td>
                    @else
                        <td align="center">{{ $item['product']['vendor']['name'] }} </td>
                    @endif
                    <td align="center">{{ number_format($item->price * $item->qty, 0, '.', '.') }}₫</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table width="100%" style=" padding:0 10px 0 10px;">
        <tr>
            <td align="right">
                <h2><span style="color: green;">Tổng tiền sản phẩm:</span>
                    {{ number_format($order->subtotal, 0, '.', '.') }}₫</h2>
                <h2><span style="color: green;">Tổng tiền giảm giá:</span>
                    {{ number_format($order->discount_coupon, 0, '.', '.') }}₫</h2>
                <h2><span style="color: green;">Tổng tiền thanh
                        toán:</span>{{ number_format($order->amount, 0, '.', '.') }}₫</h2>
            </td>
        </tr>
    </table>
    <div class="thanks mt-3">
        <p>Cảm ơn quý khách đã lựa chọn sản phẩm của chúng tôi!</p>
    </div>
    <div class="authority float-right mt-5">
        <p>-----------------------------------</p>
        <h5>Ký tên</h5>
    </div>
</body>

</html>

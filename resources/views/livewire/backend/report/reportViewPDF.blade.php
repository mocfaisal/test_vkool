@php
    if ($date['start'] == $date['end']) {
        $date_trx = $date['start'];
    } else {
        $date_trx = $date['start'] . ' to ' . $date['end'];
    }
@endphp

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        * {
            font-family: DejaVu Sans, sans-serif;
        }
    </style>
    <title>Report History Transaction</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 11pt;
        }
    </style>

    <center>
        <h5>Report History Transaction</h4>
    </center>

    <br>
    <h6>Date Transaction: {{ $date_trx }}</h6>
    <br>

    <div class="table-responsive">
        <table class="table-bordered table-striped table">
            <thead>
                <tr>
                    <th style="text-align: center; vertical-align: middle;">No</th>
                    <th style="text-align: center; vertical-align: middle;">Transaction</th>
                    <th style="text-align: center; vertical-align: middle;">User</th>
                    <th style="text-align: center; vertical-align: middle;">Status</th>
                    <th style="text-align: center; vertical-align: middle;">Date</th>
                    <th style="text-align: center; vertical-align: middle;">Total</th>
                    <th style="text-align: center; vertical-align: middle;">Item</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viewData as $item)
                    <tr wire:key="{{ $item->id }}">
                        <td style="text-align: center; vertical-align: middle;">{{ $loop->iteration }}
                        </td>

                        <td style="vertical-align: middle;">
                            {{ $item->nama_transaksi }}
                        </td>
                        <td style="vertical-align: middle;">
                            {{ $item->nama_customer }}
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            {{ $item->status }}
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            {{ Carbon\Carbon::parse($item->tgl_transaksi)->format('d F Y') }}
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            {{ number_format($item->total_item) }}
                        </td>
                        <td style="vertical-align: top;">
                            @foreach ($item->detail as $detail_item)
                                {{ $detail_item->nama }} x {{ $detail_item->qty }} <br>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

</body>

</html>

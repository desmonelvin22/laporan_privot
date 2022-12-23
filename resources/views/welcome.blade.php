<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        td,
        th {
            font-size: 11px;
        }
    </style>


    <title>TES - Venturo Camp Tahap 2</title>
</head>

<body>
    <div class="container-fluid">
        <div class="card" style="margin: 2rem 0rem;">
            <div class="card-header">
                Venturo - Laporan penjualan tahunan per menu
            </div>
            <div class="card-body">
                <form action="{{route('laporan.index')}}" method="get">
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <select id="my-select" class="form-control" name="tahun">
                                    <option value="">Pilih Tahun</option>
                                    <option value="2021" @if($tahun==2021) selected @endif>2021</option>
                                    <option value="2022" @if($tahun==2022) selected @endif>2022</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary">
                                Tampilkan
                            </button>
                            @if($tahun != '')
                            <a href="{{route('laporan.menu')}}" target="_blank" rel="Array Menu" class="btn btn-secondary">
                                Json Menu
                            </a>
                            <a href="{{route('laporan.transaksi', $tahun)}}" target="_blank" rel="Array Transaksi" class="btn btn-secondary">
                                Json Transaksi
                            </a>

                            @endif
                        </div>
                    </div>
                </form>
                @if($tahun != '')
                <hr>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" style="margin: 0;">
                        <thead>
                            <tr class="table-dark">
                                <th rowspan="2" style="text-align:center;vertical-align: middle;width: 250px;">Menu</th>
                                <th colspan="12" style="text-align: center;">Periode Pada {{$tahun}}
                                </th>
                                <th rowspan="2" style="text-align:center;vertical-align: middle;width:75px">Total</th>
                            </tr>
                            <tr class="table-dark">
                                <th style="text-align: center;width: 75px;">Jan</th>
                                <th style="text-align: center;width: 75px;">Feb</th>
                                <th style="text-align: center;width: 75px;">Mar</th>
                                <th style="text-align: center;width: 75px;">Apr</th>
                                <th style="text-align: center;width: 75px;">Mei</th>
                                <th style="text-align: center;width: 75px;">Jun</th>
                                <th style="text-align: center;width: 75px;">Jul</th>
                                <th style="text-align: center;width: 75px;">Ags</th>
                                <th style="text-align: center;width: 75px;">Sep</th>
                                <th style="text-align: center;width: 75px;">Okt</th>
                                <th style="text-align: center;width: 75px;">Nov</th>
                                <th style="text-align: center;width: 75px;">Des</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-secondary" colspan="14"><b>Makanan</b></td>
                            </tr>
                            @foreach($menu as $data)
                            @if($data->kategori != 'minuman')
                            @php $total[$data->menu] = 0; @endphp
                            <tr>
                                <td>{{$data->menu}}</td>

                                @for($a=1; $a <= 12; $a++) <td style="text-align: right;">
                                    @php

                                    $no = str_pad($a, 2, '0', STR_PAD_LEFT);
                                    if(empty($makanan[$data->menu][$no])) echo '';
                                    else {
                                    $total[$data->menu] += $makanan[$data->menu][$no];
                                    echo number_format($makanan[$data->menu][$no], 0,'',',');
                                    }

                                    @endphp
                                    </td>
                                    @endfor
                                    <td style="text-align: right;">
                                        <b>
                                            @if(empty($makanan[$data->menu]))
                                            0
                                            @else

                                            {{number_format($total[$data->menu], 0, '',',')}}
                                            @endif
                                        </b>
                                    </td>
                            </tr>
                            @endif
                            @endforeach
                            <tr>
                                <td class="table-secondary" colspan="14"><b>Minuman</b></td>
                            </tr>
                            @foreach($menu as $data)
                            @if($data->kategori != 'makanan')
                            @php 
                                $total[$data->menu] = 0; 
                              
                            @endphp
                            <tr>
                                <td>{{$data->menu}}</td>

                                @for($a=1; $a <= 12; $a++) <td style="text-align: right;">
                                    @php

                                    $no = str_pad($a, 2, '0', STR_PAD_LEFT);
                                    if(empty($makanan[$data->menu][$no])) echo '';
                                    else {
                                        $total[$data->menu] += $makanan[$data->menu][$no];
                                       
                                        echo number_format($makanan[$data->menu][$no], 0,'',',');
                                    }

                                    @endphp
                                    </td>
                                    @endfor
                                    <td style="text-align: right;">
                                        <b>
                                            @if(empty($makanan[$data->menu]))
                                            0
                                            @else
                                            {{number_format($total[$data->menu], 0, '',',')}}
                                            @endif
                                        </b>
                                    </td>
                            </tr>
                            @endif
                            @endforeach
                            <tr class="table-dark">
                                <td><b>Total</b></td>
                                @for($a=1; $a<= 12; $a++)
                                @php 
                                    
                                    $no = str_pad($a, 2, '0', STR_PAD_LEFT);
                                    
                                @endphp
                                <td style="text-align: right;">
                                    @if(!empty($total_tahun[$no]))
                                        @php $total_hor[] = $total_tahun[$no]; @endphp
                                        <b>{{number_format($total_tahun[$no], 0, '',',')}}</b>
                                    @endif
                                </td>
                                @endfor

                               <td style="text-align: right;">
                                <b>{{number_format(array_sum($total_hor), 0, '',',')}}</b>
                               </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{base_url('asset/css/base.css?v=').date("Y/m/d") }}" />
</head>

<body>
    <div class="container">
        <div class="top-nav">
            <div class="header">
                <a class="title">Peternakan</a>
            </div>
            <div>admin</div>
        </div>

        <div class="row">
            <div class="sidemenu">
                <div>
                    <div class="title">
                        <a href="{{base_url()}}">Dashboard</a>
                    </div>
                </div>
                <div>
                    <div class="title active">
                        <a href="">Data Peternakan <i class="fa fa-caret-down"></i></a>
                    </div>

                    <div class="submenu">
                        <a href="{{base_url('kandang')}}">Data Kandang</a>
                        <a href="{{base_url('supplier')}}">Data Supplier</a>
                        <a href="{{base_url('persediaan')}}">Data </a>
                    </div>
                </div>
                <div>
                    <div class="title">
                        <a href="">Transaksi Peternakan</a>
                    </div>
                </div>
                <div>
                    <div class="title">
                        <a href="">Laporan</a>
                    </div>
                </div>
                <div>
                    <div class="title">
                        <a href="">Setting</a>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="body">
                @yield('content')
                </div>
            </div>
        </div>
    </div>

    @yield("modal")
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loakin</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <style>
        #cat:hover a {
            color: royalblue;
        }

        #lifooter:hover a {
            font-weight: bold;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="col-12" style="width: 100%; box-shadow: 0 4px 4px 0 lightgrey, 0 4px 4px 0 lightgrey; margin-bottom: 5px;">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}" style="font-family: 'Montserrat', sans-serif; font-size: 20px; font-weight: bold; color: #1492E6;">Loakin</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <?php if (Auth::guard('user')->check()) { ?>
                        <div class="col-lg-6 col-12 ml-auto" style="padding-left: 0; padding-right: 0; display: flex; flex-direction: row;">
                            <!-- <form style="" action="home.html"> -->
                            <input id="search" class="form-control w-80" style="border-top-right-radius: 0; border-bottom-right-radius: 0;" type="text" placeholder="Masukkan keyword..., contoh: asus a456uf">
                            <button onclick="cari()" class="btn btn-outline-primary" style="border-top-left-radius: 0; border-bottom-left-radius: 0; background-color: #fff;" type="submit">
                                <i class="fas fa-search" style="color: #111;"></i>
                            </button>
                            <!-- </form> -->
                        </div>
                        <div class="col-12 col-lg-6" style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-home"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('keranjang') }}">Keranjang Saya <?php if (Auth::guard('user')->check()) { ?><span class="badge" style="background-color: blue; color:#fff; font-weight:bold">{{$jml}}</span> <?php } ?></a>
                                <a class="dropdown-item" href="{{ route('mytoko') }}">Toko Saya</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('transaksi') }}">History Transaksi</a>
                            </div>
                            <div class="ml-2 mr-2" style="height: 20px; border: 1px solid grey;"></div>
                            <p class="mt-auto mb-auto">{{Auth::guard('user')->user()->nama}}</p>
                            <a class="btn btn-danger ml-5" href="{{ route('logout') }}">Logout</a>
                        </div>
                    <?php } else { ?>
                        <div class="col-lg-8 col-12 ml-auto" style="padding-left: 0; padding-right: 0;">
                            <form style="display: flex; flex-direction: row;" action="home.html">
                                <input class="form-control w-80" style="border-top-right-radius: 0; border-bottom-right-radius: 0;" type="text" placeholder="Masukkan keyword..., contoh: asus a456uf">
                                <button class="btn btn-outline-primary" style="border-top-left-radius: 0; border-bottom-left-radius: 0; background-color: #fff;" type="submit">
                                    <i class="fas fa-search" style="color: #111;"></i>
                                </button>
                            </form>
                        </div>
                        <div class="col-12 col-lg-3" style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-home"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('keranjang') }}">Keranjang Saya</a>
                                <a class="dropdown-item" href="{{ route('mytoko') }}">Toko Saya</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('transaksi') }}">History Transaksi</a>
                            </div>
                            <div class="ml-2 mr-2" style="height: 20px; border: 1px solid grey;"></div>
                            <button class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#modalLogin">Masuk</button>
                            <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Form Login</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('login') }}" method="post">
                                            {{csrf_field()}}
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Password</label>
                                                    <input name="pass" type="password" class="form-control" placeholder="Masukkan password" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Masuk</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalDaftar">Daftar</button>
                            <div class="modal fade" id="modalDaftar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Form Register</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('register') }}" method="post">
                                            {{csrf_field()}}
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Nama</label>
                                                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Password</label>
                                                    <input id="inpass" name="pass" type="password" class="form-control" placeholder="Masukkan password" required>
                                                    <div style="display: flex; flex-direction: row; align-items: center">
                                                        <input type="checkbox" onchange="showpass()" id="cekbox">
                                                        <p class="mt-auto mb-auto ml-1" style="text-decoration: none; color:#111;">Lihat password</p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Alamat</label>
                                                    <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">No. HP</label>
                                                    <input type="number" name="phone" class="form-control" placeholder="Masukkan nomor HP" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Daftar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </nav>
    </div>
    @if (session('gagal'))
    <div class="alert alert-danger" role="alert" style="text-align: center">
        {{ session('gagal') }}
    </div>
    @endif
    @if (session('sukses'))
    <div class="alert alert-success" role="alert" style="text-align: center">
        {{ session('sukses') }}
    </div>
    @endif
    <div style="background-color: white;">
        <nav class="navbar navbar-expand-lg navbar-light">
            <ul class="navbar-nav mr-auto ml-auto">
                <?php foreach ($kategori as $key) { ?>
                    <li class="nav-item" id="cat">
                        <a class="nav-link" href="#" onclick="getbykategori(<?php echo $key->id ?>)" style="font-family: 'Montserrat', sans-serif;">{{$key->nama_kategori}}</a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
    <div class="container">
        <div class="row" id="listcard"></div>
    </div>
    <div class="col-12 pt-5">
        <div class="container pb-4" style="border-bottom: 3px dashed grey;">
            <h5 style="font-family: 'Montserrat', sans-serif; color: #1492E6; font-weight: bold;">Belum punya toko? Buka
                toko sekarang</h5>
            <p style="line-height: 3;">Mudah, nyaman dan tentunya gratis</p>
            <div style="display: flex; flex-direction: row;">
                <a class="btn btn-primary" href="{{ route('mytoko') }}">Buka Toko</a>
                <p class="mt-auto mb-auto ml-3">
                    <a href="" style="text-decoration: none; color: #1492E6; font-weight: bold;">Tata cara buka toko</a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-12 pt-3 pb-3" style="border-bottom: 2px dotted lightgrey;">
        <div class="container">
            <h5>Cari barang bekas di loakin dengan mudah</h5>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Unde nemo adipisci repellendus dignissimos
                voluptate minima tenetur sunt aspernatur hic. Aliquam velit porro deserunt ad provident obcaecati soluta
                aperiam in accusantium.</p>
        </div>
    </div>
    <div class="container pt-4">
        <div class="row">
            <div class="col-3">
                <h5>Tentang Kami</h5>
                <p style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro sint
                    culpa labore, ex iure reiciendis
                    voluptates dignissimos sed provident! Alias sapiente, debitis recusandae et nobis quae maxime iusto
                    labore neque?</p>
            </div>
            <div class="col-3">
                <h5>Kategori</h5>
                <ul class="pl-0" style="list-style-type: none;">
                    <div class="row">
                        <div class="col-6 pl-0 pr-0">
                            <?php for ($i = 0; $i < sizeof($kategori) / 2; $i++) { ?>
                                <li class="nav-item" id="lifooter">
                                    <a class="nav-link" href="#" style="font-family: 'Montserrat', sans-serif;" onclick="getbykategori(<?php echo $kategori[$i]->id ?>)">{{$kategori[$i]->nama_kategori}}</a>
                                </li>
                            <?php } ?>
                        </div>
                        <div class="col-6 pl-0 pr-0">
                            <?php for ($i = 4; $i < sizeof($kategori); $i++) { ?>
                                <li class="nav-item" id="lifooter">
                                    <a class="nav-link" href="#" style="font-family: 'Montserrat', sans-serif;" onclick="getbykategori(<?php echo $kategori[$i]->id ?>)">{{$kategori[$i]->nama_kategori}}</a>
                                </li>
                            <?php } ?>
                        </div>
                    </div>
                </ul>
            </div>
            <div class="col-3">
                <h5>Bantuan dan Panduan</h5>
                <ul class="pl-0" style="list-style-type: none">
                    <li>
                        <a href="" style="text-decoration: none; color: #1492E6; font-weight: bold;">Tata cara buka
                            toko</a>
                    </li>
                    <li>
                        <a href="" style="text-decoration: none; color: #1492E6; font-weight: bold;">Tata cara jual
                            barang</a>
                    </li>
                    <li>
                        <a href="" style="text-decoration: none; color: #1492E6; font-weight: bold;">Tata cara beli
                            barang</a>
                    </li>
                </ul>
            </div>
            <div class="col-3">
                <center>
                    <img src="{{ asset('/assets/loakinlogo.jpg') }}" alt="" class="w-75">
                    <div class="pt-2" style="display: flex; flex-direction: row; align-items: center; justify-content: center;">
                        <i class="fas fa-copyright" style="color: grey;"></i>
                        <p class="mt-auto mb-auto ml-1" style="font-family: 'Montserrat', sans-serif; color: grey;">2020. Loakin</p>
                    </div>
                </center>
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    var spin = '<center class="col-12">' +
        '<div class="spinner-border" role="status">' +
        '<span class="sr-only">Loading...</span>' +
        '</div>' +
        '</center>';

    function cari() {
        document.getElementById("listcard").innerHTML = spin;
        var data = "";
        $.ajax({
            url: "{{ route('searchdata') }}",
            type: "post",
            dataType: 'json',
            data: {
                'keyword': document.getElementById("search").value,
                '_token': '{{ csrf_token() }}'
            },
            success: function(result) {
                console.log(result);
                if (result.length <= 0) {
                    data = '<div class="col-lg-12 pt-4"><center><img style="width:200px; height:200px" src="{{ asset("/assets/smiley.svg") }}" alt="" class="w-75"><h5 class="pt-2" style="color:red">Ups barang tidak ditemukan</h5></center></div>';
                    document.getElementById("listcard").innerHTML = data;
                } else {
                    for (let i = 0; i < result.length; i++) {
                        var buttontambah = '';
                        if (result[i].stok > 0) {
                            buttontambah = '<form action={{route("addlist")}} method="post" class="mt-2">' +
                                '{{csrf_field()}}' +
                                '<input type="hidden" value="' + result[i].id + '" name="id"/>' +
                                '<button type="submit" class="btn btn-success">Tambahkan ke keranjang</button>' +
                                '</form>';
                        } else {
                            buttontambah = '<a class="btn btn-success mt-2 disabled style="color:#fff"">Tambahkan ke keranjang</a>';
                        }
                        <?php if (Auth::guard('user')->check()) { ?>
                            data += '<div class="col-lg-3 pb-3">' +
                                '<div class="card" style="box-shadow: 0 4px 4px 0 lightgrey, 0 4px 4px 0 lightgrey;">' +
                                '<a href="" style="text-decoration: none">' +
                                '<img src="data:image/png;base64, ' + result[i].foto + '" class="card-img-top" alt="...">' +
                                '<div class="card-body">' +
                                '<h5 class="card-title" style="color: #111;">' + result[i].nama_barang + '</h5>' +
                                '<p class="card-text" style="color: red;">Rp. ' + parseInt(result[i].harga).toLocaleString() + '</p>' +
                                '<p style="color: #111; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;">' + result[i].deskripsi + '</p>' +
                                '<p style="color:#111">Stok : ' + result[i].stok + '</p>' +
                                '<div>' +
                                '<span class="fa fa-star checked" style="color: #1492E6;"></span>' +
                                '<span class="fa fa-star checked" style="color: #1492E6;"></span>' +
                                '<span class="fa fa-star checked" style="color: #1492E6;"></span>' +
                                '<span class="fa fa-star" style="color: #111;"></span>' +
                                '<span class="fa fa-star" style="color: #111;"></span>' +
                                '</div>' +
                                buttontambah +
                                '</div>' +
                                '</a>' +
                                '</div>' +
                                '</div>';
                        <?php } else { ?>
                            data += '<div class="col-lg-3 pb-3">' +
                                '<div class="card" style="box-shadow: 0 4px 4px 0 lightgrey, 0 4px 4px 0 lightgrey;">' +
                                '<a href="" style="text-decoration: none">' +
                                '<img src="data:image/png;base64, ' + result[i].foto + '" class="card-img-top" alt="...">' +
                                '<div class="card-body">' +
                                '<h5 class="card-title" style="color: #111;">' + result[i].nama_barang + '</h5>' +
                                '<p class="card-text" style="color: red;">Rp. ' + parseInt(result[i].harga).toLocaleString() + '</p>' +
                                '<p style="color: #111; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;">' + result[i].deskripsi + '</p>' +
                                '<p style="color:#111">Stok : ' + result[i].stok + '</p>' +
                                '<div>' +
                                '<span class="fa fa-star checked" style="color: #1492E6;"></span>' +
                                '<span class="fa fa-star checked" style="color: #1492E6;"></span>' +
                                '<span class="fa fa-star checked" style="color: #1492E6;"></span>' +
                                '<span class="fa fa-star" style="color: #111;"></span>' +
                                '<span class="fa fa-star" style="color: #111;"></span>' +
                                '</div>' +
                                '</div>' +
                                '</a>' +
                                '</div>' +
                                '</div>';
                        <?php } ?>
                    }
                    document.getElementById("listcard").innerHTML = data;
                }
            }
        });
    }

    $(document).ready(function() {
        document.getElementById("listcard").innerHTML = spin;
        var data = "";
        $.ajax({
            url: "{{ route('getdata') }}",
            type: "get",
            dataType: 'json',
            success: function(result) {
                console.log(result);
                for (let i = 0; i < result.length; i++) {
                    var buttontambah = '';
                    if (result[i].stok > 0) {
                        buttontambah = '<form action={{route("addlist")}} method="post" class="mt-2">' +
                            '{{csrf_field()}}' +
                            '<input type="hidden" value="' + result[i].id + '" name="id"/>' +
                            '<button type="submit" class="btn btn-success">Tambahkan ke keranjang</button>' +
                            '</form>';
                    } else {
                        buttontambah = '<a class="btn btn-success mt-2 disabled style="color:#fff"">Tambahkan ke keranjang</a>';
                    }
                    <?php if (Auth::guard('user')->check()) { ?>
                        data += '<div class="col-lg-3 pb-3">' +
                            '<div class="card" style="box-shadow: 0 4px 4px 0 lightgrey, 0 4px 4px 0 lightgrey;">' +
                            '<a href="" style="text-decoration: none">' +
                            '<img src="data:image/png;base64, ' + result[i].foto + '" class="card-img-top" alt="..." style="height:200px;">' +
                            '<div class="card-body">' +
                            '<h5 class="card-title" style="color: #111;">' + result[i].nama_barang + '</h5>' +
                            '<p class="card-text" style="color: red;">Rp. ' + parseInt(result[i].harga).toLocaleString() + '</p>' +
                            '<p style="color: #111; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;">' + result[i].deskripsi + '</p>' +
                            '<p style="color:#111">Stok : ' + result[i].stok + '</p>' +
                            '<div>' +
                            '<span class="fa fa-star checked" style="color: #1492E6;"></span>' +
                            '<span class="fa fa-star checked" style="color: #1492E6;"></span>' +
                            '<span class="fa fa-star checked" style="color: #1492E6;"></span>' +
                            '<span class="fa fa-star" style="color: #111;"></span>' +
                            '<span class="fa fa-star" style="color: #111;"></span>' +
                            '</div>' +
                            buttontambah +
                            '</div>' +
                            '</a>' +
                            '</div>' +
                            '</div>';
                    <?php } else { ?>
                        data += '<div class="col-lg-3 pb-3">' +
                            '<div class="card" style="box-shadow: 0 4px 4px 0 lightgrey, 0 4px 4px 0 lightgrey;">' +
                            '<a href="" style="text-decoration: none">' +
                            '<img src="data:image/png;base64, ' + result[i].foto + '" class="card-img-top" alt="..." style="height:200px;">' +
                            '<div class="card-body">' +
                            '<h5 class="card-title" style="color: #111;">' + result[i].nama_barang + '</h5>' +
                            '<p class="card-text" style="color: red;">Rp. ' + parseInt(result[i].harga).toLocaleString() + '</p>' +
                            '<p style="color: #111; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;">' + result[i].deskripsi + '</p>' +
                            '<p style="color:#111">Stok : ' + result[i].stok + '</p>' +
                            '<div>' +
                            '<span class="fa fa-star checked" style="color: #1492E6;"></span>' +
                            '<span class="fa fa-star checked" style="color: #1492E6;"></span>' +
                            '<span class="fa fa-star checked" style="color: #1492E6;"></span>' +
                            '<span class="fa fa-star" style="color: #111;"></span>' +
                            '<span class="fa fa-star" style="color: #111;"></span>' +
                            '</div>' +
                            '</div>' +
                            '</a>' +
                            '</div>' +
                            '</div>';
                    <?php } ?>
                }
                document.getElementById("listcard").innerHTML = data;
            }
        });
    });

    $('#myModal').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus')
    });

    function showpass() {
        if (document.getElementById("cekbox").checked) {
            document.getElementById("inpass").type = 'text';
        } else {
            document.getElementById("inpass").type = 'password';
        }
    }

    function getbykategori(id) {
        // alert(id);
        document.getElementById("listcard").innerHTML = spin;
        var data = "";
        $.ajax({
            url: "{{ route('getbykategori') }}",
            type: "get",
            data: {
                'id': id
            },
            dataType: 'json',
            success: function(result) {
                console.log(result);
                if (result.length <= 0) {
                    data = '<div class="col-lg-12 pt-4"><center><img style="width:200px; height:200px" src="{{ asset("/assets/smiley.svg") }}" alt="" class="w-75"><h5 class="pt-2" style="color:red">Ups barang tidak ditemukan</h5></center></div>';
                    document.getElementById("listcard").innerHTML = data;
                } else {
                    for (let i = 0; i < result.length; i++) {
                        var buttontambah = '';
                        if (result[i].stok > 0) {
                            buttontambah = '<form action={{route("addlist")}} method="post" class="mt-2">' +
                                '{{csrf_field()}}' +
                                '<input type="hidden" value="' + result[i].id + '" name="id"/>' +
                                '<button type="submit" class="btn btn-success">Tambahkan ke keranjang</button>' +
                                '</form>';
                        } else {
                            buttontambah = '<a class="btn btn-success mt-2 disabled style="color:#fff"">Tambahkan ke keranjang</a>';
                        }
                        <?php if (Auth::guard('user')->check()) { ?>
                            data += '<div class="col-lg-3 pb-3">' +
                                '<div class="card" style="box-shadow: 0 4px 4px 0 lightgrey, 0 4px 4px 0 lightgrey;">' +
                                '<a href="" style="text-decoration: none">' +
                                '<img src="data:image/png;base64, ' + result[i].foto + '" class="card-img-top" alt="...">' +
                                '<div class="card-body">' +
                                '<h5 class="card-title" style="color: #111;">' + result[i].nama_barang + '</h5>' +
                                '<p class="card-text" style="color: red;">Rp. ' + parseInt(result[i].harga).toLocaleString() + '</p>' +
                                '<p style="color: #111; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;">' + result[i].deskripsi + '</p>' +
                                '<p style="color:#111">Stok : ' + result[i].stok + '</p>' +
                                '<div>' +
                                '<span class="fa fa-star checked" style="color: #1492E6;"></span>' +
                                '<span class="fa fa-star checked" style="color: #1492E6;"></span>' +
                                '<span class="fa fa-star checked" style="color: #1492E6;"></span>' +
                                '<span class="fa fa-star" style="color: #111;"></span>' +
                                '<span class="fa fa-star" style="color: #111;"></span>' +
                                '</div>' +
                                buttontambah +
                                '</div>' +
                                '</a>' +
                                '</div>' +
                                '</div>';
                        <?php } else { ?>
                            data += '<div class="col-lg-3 pb-3">' +
                                '<div class="card" style="box-shadow: 0 4px 4px 0 lightgrey, 0 4px 4px 0 lightgrey;">' +
                                '<a href="" style="text-decoration: none">' +
                                '<img src="data:image/png;base64, ' + result[i].foto + '" class="card-img-top" alt="...">' +
                                '<div class="card-body">' +
                                '<h5 class="card-title" style="color: #111;">' + result[i].nama_barang + '</h5>' +
                                '<p class="card-text" style="color: red;">Rp. ' + parseInt(result[i].harga).toLocaleString() + '</p>' +
                                '<p style="color: #111; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;">' + result[i].deskripsi + '</p>' +
                                '<p style="color:#111">Stok : ' + result[i].stok + '</p>' +
                                '<div>' +
                                '<span class="fa fa-star checked" style="color: #1492E6;"></span>' +
                                '<span class="fa fa-star checked" style="color: #1492E6;"></span>' +
                                '<span class="fa fa-star checked" style="color: #1492E6;"></span>' +
                                '<span class="fa fa-star" style="color: #111;"></span>' +
                                '<span class="fa fa-star" style="color: #111;"></span>' +
                                '</div>' +
                                '</div>' +
                                '</a>' +
                                '</div>' +
                                '</div>';
                        <?php } ?>
                    }
                    document.getElementById("listcard").innerHTML = data;
                }
            }
        });
    }
</script>

</html>
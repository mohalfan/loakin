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
                        <!-- <div class="col-lg-6 col-12 ml-auto" style="padding-left: 0; padding-right: 0;">
                            <form style="display: flex; flex-direction: row;" action="home.html">
                                <input onkeyup="search()" class="form-control w-80" style="border-top-right-radius: 0; border-bottom-right-radius: 0;" type="text" placeholder="Masukkan keyword..., contoh: asus a456uf">
                                <button class="btn btn-outline-primary" style="border-top-left-radius: 0; border-bottom-left-radius: 0; background-color: #fff;" type="submit">
                                    <i class="fas fa-search" style="color: #111;"></i>
                                </button>
                            </form>
                        </div> -->
                        <div class="col-12 col-lg-6 ml-auto" style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-home"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('keranjang') }}">Keranjang Saya <span class="badge" style="background-color: blue; color:#fff; font-weight:bold">{{$jml}}</span></a>
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
                                <a class="dropdown-item" href="{{route('keranjang')}}">Keranjang Saya</a>
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
                                        <form action="{{ route('dologin') }}" method="post">
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
    <!-- <div style="background-color: white;">
        <nav class="navbar navbar-expand-lg navbar-light">
            <ul class="navbar-nav mr-auto ml-auto">
                <li class="nav-item" id="cat">
                    <label><input type="checkbox" value=""> Option 1</label>
                </li>
            </ul>
        </nav>
    </div> -->
    <div class="container pt-3">
        <h5 style="text-align: center; font-size: 25px; font-weight: bold; font-family: 'Montserrat', sans-serif">Keranjang anda</h5>
        <div class="row pb-4" id="listbuy">
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

    $(document).ready(function() {
        document.getElementById("listbuy").innerHTML = spin;
        var data = "";
        $.ajax({
            url: "{{ route('getbasket') }}",
            type: "get",
            dataType: 'json',
            success: function(result) {
                console.log(result);
                if (result.item.length <= 0) {
                    data += '<div class="col-lg-12 pt-4"><center><img style="width:200px; height:200px" src="{{ asset("/assets/smiley.svg") }}" alt="" class="w-75"><h5 class="pt-2" style="color:red">Ups keranjang kamu masih kosong nih</h5></center></div>';
                } else {
                    for (let i = 0; i < result.item.length; i++) {
                        data +=
                            '<div class="col-lg-12 p-3 mb-3" style="border:1px solid transparent; border-radius: 10px;display: flex; flex-direction: row; background-color: #fff; box-shadow: 0 4px 4px 0 lightgrey, 0 4px 4px 0 lightgrey;">' +
                            '<img style="width: 150px; height: 150px; border-radius: 10px;" src="data:image/png;base64, ' + result.item[i].foto + '" class="card-img-top" alt="...">' +
                            '<div class="pl-3">' +
                            '<h5>' + result.item[i].nama_barang + '</h5>' +
                            '<button class="btn btn-danger mr-5" onclick="hapus(' + result.item[i].id + ')" style="position: absolute; right:0; color:#111"><i class="fas fa-trash"></i></button>' +
                            '<p id="total' + result.item[i].id + '">Rp. ' + parseInt(result.item[i].total).toLocaleString() + '</p>' +
                            '<p>Dibeli di : ' + result.item[i].nama_toko + '</p>' +
                            '<div style="display: flex; flex-direction: row;">' +
                            '<button class="btn btn-primary" onclick="minusItem(' + result.item[i].id_barang + ',' + result.item[i].id + ')"><i class="fas fa-minus"></i></button>' +
                            '<input id="jml' + result.item[i].id + '" style="width: 38px;" type="number" value="' + result.item[i].qty + '" class="form-control mr-1 ml-1" readonly>' +
                            '<button class="btn btn-primary" onclick="addItem(' + result.item[i].id_barang + ',' + result.item[i].id + ')"><i class="fas fa-plus"></i></button>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    }
                    data += '<div class="col-lg-12 p-3 mb-3" style="border:1px solid transparent; border-radius: 10px;display: flex; flex-direction: row; background-color: #fff; box-shadow: 0 4px 4px 0 lightgrey, 0 4px 4px 0 lightgrey;">' +
                        '<h5 class="mt-auto mb-auto ml-auto" id="tot">Total : ' + parseInt(result.total).toLocaleString() + '</h5>' +
                        '</div>';
                    data += '<div class="col-lg-12 pt-4" style="text-align: center;">' +
                        '<button class="btn btn-primary" onclick="checkout()">Check Out</button>' +
                        '</div>';
                }
                document.getElementById("listbuy").innerHTML = data;
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

    function hapus(id) {
        if (confirm("Ingin melanjutkan hapus data?")) {
            var url = '{{ route("delete", "id")}}';
            url = url.replace('id', id);
            window.location.href = url;
        }
    }

    function checkout() {
        $.ajax({
            url: "{{ route('cekbelanjaan') }}",
            type: "POST",
            dataType: 'json',
            data: {
                'id': <?php echo Auth::guard('user')->user()->id ?>,
                '_token': '{{ csrf_token() }}',
            },
            success: function(result) {
                console.log(result);
                if (result == 1) {
                    var url = '{{ route("cekout", "id")}}';
                    url = url.replace('id', <?php echo Auth::guard('user')->user()->id ?>);
                    window.location.href = url;
                } else {
                    alert("Barang belanjaan harus dalam satu toko untuk sekali check out");
                }
            }
        });
    }

    function addItem(idb, id) {
        $.ajax({
            url: "{{ route('addItem') }}",
            type: "POST",
            dataType: 'json',
            data: {
                'id': id,
                'idb': idb,
                '_token': '{{ csrf_token() }}',
            },
            success: function(result) {
                console.log(result);
                document.getElementById("jml" + id).value = result.item[0].qty;
                document.getElementById("total" + id).innerHTML = "Rp. " + parseInt(result.item[0].total).toLocaleString();
                document.getElementById("tot").innerHTML = "Total : " + parseInt(result.total).toLocaleString();
            }
        });
    }

    function minusItem(idb, id) {
        $.ajax({
            url: "{{ route('minusItem') }}",
            type: "POST",
            dataType: 'json',
            data: {
                'id': id,
                'idb': idb,
                '_token': '{{ csrf_token() }}',
            },
            success: function(result) {
                console.log(result);
                document.getElementById("jml" + id).value = result.item[0].qty;
                document.getElementById("total" + id).innerHTML = "Rp. " + parseInt(result.item[0].total).toLocaleString();
                document.getElementById("tot").innerHTML = "Total : " + parseInt(result.total).toLocaleString();
            }
        });
    }

    function search(){

    }
</script>

</html>
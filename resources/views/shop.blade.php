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
                                <input class="form-control w-80" style="border-top-right-radius: 0; border-bottom-right-radius: 0;" type="text" placeholder="Masukkan keyword..., contoh: asus a456uf">
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
                            <div class="modal fade" id="formtoko" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <div class="col-lg-12">
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
    </div>
    <div class="container pt-3">
        <h5 style="text-align: center; font-size: 25px; font-weight: bold; font-family: 'Montserrat', sans-serif">Toko Anda</h5>
        <div class="row pb-4" id="toko">
            <?php if (sizeof($toko) <= 0) { ?>
                <div class="col-lg-12 pt-4">
                    <center>
                        <img style="width:200px; height:200px" src="{{ asset("/assets/smiley.svg") }}" alt="" class="w-75">
                        <h5 class="pt-2" style="color:red">Ups kamu belum punya toko nih
                            <br>Tekan tombol dibawah untuk membuat toko</h5>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#formtoko">Buat Toko</button>
                    </center>
                    <div class="modal fade" id="formtoko" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Form Toko</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('createtoko')}}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="">Nama Toko</label>
                                            <input type="text" class="form-control" name="namatoko" placeholder="Masukkan nama toko" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Alamat Toko</label>
                                            <input type="text" class="form-control" name="alamat" placeholder="Masukkan alamat toko" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">No. telepon Toko</label>
                                            <input type="number" class="form-control" name="phone" placeholder="Masukkan nomor telepon toko" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Foto Toko</label><br>
                                            <input type="file" name="foto" required>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } else {
                foreach ($toko as $key) {
                ?>
                    <div class="col-lg-3 pt-3">
                        <center>
                            <img style="width:200px; height:200px" src="data:image/png;base64, {{$key->foto}}" alt="">
                            <div class="pt-2">
                                <h6>Nama Toko : {{$key->nama_toko}}</h6>
                                <h6>Alamat Toko : {{$key->alamat}}</h6>
                                <h6>No. Telepon : {{$key->phone}}</h6>
                                <h6>Rating : {{$key->rating}}, jumlah ulasan : {{$ulas}}</h6>
                                <button class="btn btn-success" data-toggle="modal" data-target="#formgood">Tambah Barang Jualan</button>
                            </div>
                        </center>
                        <div class="modal fade" id="formgood" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Form Tambah Barang</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('addgood')}}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="idtoko" value="{{$toko[0]->id}}">
                                            <div class="form-group">
                                                <label for="">Kategori</label>
                                                <select name="kategori" class="form-control" required>
                                                    <option value="">--Select Here--</option>
                                                    @foreach($kategori as $key)
                                                    <option value="{{$key->id}}">{{$key->nama_kategori}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Nama Barang</label>
                                                <input type="text" class="form-control" name="namabarang" placeholder="Masukkan nama barang" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Deskripsi</label>
                                                <textarea class="form-control" name="desc" placeholder="Masukkan deskripsi barang" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Harga</label>
                                                <input type="number" class="form-control" name="harga" placeholder="Masukkan harga barang" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Stok</label>
                                                <input type="number" class="form-control" name="stok" placeholder="Masukkan stok barang" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Foto Barang</label><br>
                                                <input type="file" name="foto" required>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 pt-3">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td style="text-align: center">No.</td>
                                    <td style="text-align: center">Nama Barang</td>
                                    <td style="text-align: center">Deskripsi</td>
                                    <td style="text-align: center">Harga</td>
                                    <td style="text-align: center">Stok</td>
                                    <td style="text-align: center">Foto</td>
                                    <td style="text-align: center">Action</td>
                                </tr>
                            </thead>
                            <tbody id="listgoods">

                            </tbody>
                        </table>
                        <div class="col-lg-12" style="align-items: center; justify-content: center" id="load">

                        </div>
                    </div>
            <?php }
            } ?>
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

    var sorry = '<div class="col-lg-12 pt-4">' +
        '<center>' +
        '<img style="width:200px; height:200px" src="{{ asset("/assets/smiley.svg") }}" alt="" class="w-75">' +
        '<h5 class="pt-2" style="color:red">Ups kamu belum punya toko nih' +
        '<br>Tekan tombol dibawah untuk membuat toko</h5>' +
        '</center>' +
        '</div>';

    var kosong = '<div></div>';

    $(document).ready(function() {
        document.getElementById("load").innerHTML = spin;
        var data = "";
        <?php if (sizeof($toko) > 0) { ?>
            $.ajax({
                url: "{{ route('getbyshop') }}",
                type: "post",
                dataType: 'json',
                data: {
                    idtoko: <?php echo $toko[0]->id ?>,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(result) {
                    console.log(result)
                    for (let i = 0; i < result.length; i++) {
                        data += '<tr>' +
                            '<td style="text-align:center">' + (i + 1) + '</td>' +
                            '<td>' + result[i].nama_barang + '</td>' +
                            '<td>' + result[i].deskripsi + '</td>' +
                            '<td style="text-align:center">Rp. ' + parseInt(result[i].harga).toLocaleString() + '</td>' +
                            '<td style="text-align:center">' + result[i].stok + '</td>' +
                            '<td style="text-align:center"><img style="width:100px; height:100px" src="data:image/png;base64, ' + result[i].foto + '"/></td>' +
                            '<td style="text-align:center"><button class="btn btn-primary">Edit</button></td>' +
                            '</tr>';
                    }
                    document.getElementById("load").innerHTML = kosong;
                    document.getElementById("listgoods").innerHTML = data;
                }
            });
        <?php } ?>
    })

    $('#myModal').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus')
    });
</script>

</html>
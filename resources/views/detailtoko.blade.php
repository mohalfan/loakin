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
                    <?php } else if (Auth::guard('admin')->check()) { ?>
                        <div class="col-12 col-lg-2 ml-auto" style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                            <p class="mt-auto mb-auto" style="text-transform: capitalize">{{Auth::guard('admin')->user()->nama}}</p>
                            <a class="btn btn-danger ml-5" href="{{ route('logoutadmin') }}">Logout</a>
                        </div>
                    <?php } else { ?>
                        <div class="col-lg-8 col-12 ml-auto" style="padding-left: 0; padding-right: 0;">

                        </div>
                        <div class="col-12 col-lg-3 ml-auto" style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
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
    <div class="container pt-3">
        <div class="row pb-4" id="listtrans">
            @foreach($toko as $key)
            <div class="col-lg-4">
                <img src="{{'data:image/png;base64, '.$key->foto}}" class="card-img-top" alt="..." style="height: 250px">
            </div>
            <div class="col-lg-8">
                <div style="display: flex; flex-direction: row">
                    <h2>{{$key->nama_toko}}</h2>
                    <?php if (Auth::guard('user')->check() && $key->id_owner != Auth::guard('user')->user()->id) { ?>
                        <button class="btn btn-success ml-auto" data-toggle="modal" data-target="#formulasan">Berikan Ulasan</button>
                        <div class="modal fade" id="formulasan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Form ulasan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{route('giverating')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="modal-body">
                                            <input type="hidden" name="id_user" value="{{Auth::guard('user')->user()->id}}">
                                            <input type="hidden" name="idtoko" value="{{$key->id}}">
                                            <div class="form-group">
                                                <label for="">Komentar</label>
                                                <textarea name="komen" id="" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group" style="display: flex; flex-direction: row">
                                                <label for="rating" class="pt-auto pb-auto">Rating : </label>
                                                <select name="rate" id="" class="ml-2 mr-2">
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                                <span class="pb-auto pt-auto">Dari 5</span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Ulas</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <table>
                    <tr>
                        <th>Alamat</th>
                        <th class="pl-2 pr-2"> : </th>
                        <th>{{$key->alamat}}</th>
                    </tr>
                    <tr>
                        <th>Telp</th>
                        <th class="pl-2 pr-2"> : </th>
                        <th><span style="color: blue">{{$key->phone}}</span></th>
                    </tr>
                    <tr>
                        <th>Rating</th>
                        <th class="pl-2 pr-2"> : </th>
                        <th>{{(int) $rating}}</th>
                    </tr>
                </table>
                <!-- <h6>Alamat : {{$key->alamat}}</h6>
                <h6>Telp : <span style="color: blue">{{$key->phone}}</span></h6>
                <h6>Rating : {{(int) $rating}}</h6> -->
                <h5 style="text-align: center">Ulasan</h5>
                <div id="komentar">

                </div>
            </div>
            @endforeach
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

    function convert(str) {
        var mnths = {
                Jan: "01",
                Feb: "02",
                Mar: "03",
                Apr: "04",
                May: "05",
                Jun: "06",
                Jul: "07",
                Aug: "08",
                Sep: "09",
                Oct: "10",
                Nov: "11",
                Dec: "12"
            },
            date = str.split(" ");

        return [date[2], mnths[date[1]], date[3]].join("-");
    }

    $(document).ready(function() {
        document.getElementById("komentar").innerHTML = spin;
        var data = '';
        $.ajax({
            url: "{{ route('ratingshop') }}",
            type: "post",
            dataType: 'json',
            data: {
                idtoko: <?php echo $toko[0]->id ?>,
                '_token': '{{ csrf_token() }}'
            },
            success: function(result) {
                console.log(result)
                if (result.length > 0) {
                    for (let i = 0; i < result.length; i++) {
                        var rating = '';
                        for (let j = 0; j < 5; j++) {
                            if (j <= result[i].rating - 1) {
                                rating += '<span class="fa fa-star checked" style="color: #1492E6;"></span>';
                            } else {
                                rating += '<span class="fa fa-star" style="color: #111;"></span>';
                            }
                        }
                        data += '<div style="border-bottom:2px solid" class="pb-3">' +
                            '<h6>' + result[i].nama + '</h6>' +
                            '<span>' + result[i].komentar + '</span>' +
                            '<div>' +
                            rating +
                            '</div>' +
                            '</div>';
                    }
                } else {
                    data += '<div><p style="color:red; text-align:center">Belum ada ulasan untuk toko ini</p></div>'
                }
                document.getElementById("komentar").innerHTML = data;
            }
        });
    })

    $('#myModal').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus')
    });
</script>

</html>
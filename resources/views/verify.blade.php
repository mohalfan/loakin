<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="{{ asset('sb/css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <div class="col-lg-12" style="display: flex; flex:1; justify-content: center; min-height: 100vh">
        <div class="d-flex" style="flex-direction: column;align-items:center; justify-content:center;">
            <h4 style="text-align: center; color:red">Email anda belum terverifikasi<br>Harap melakukan verifikasi terlebih dahulu<br>Link telah dikirim ke email anda setelah mendaftarkan akun</h4>
            <a href="http://gmail.com" target="_blank" class="btn btn-primary">buka email</a>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('sb/js/scripts.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('sb/assets/demo/chart-area-demo.js')}}"></script>
<script src="{{ asset('sb/assets/demo/chart-bar-demo.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('sb/assets/demo/datatables-demo.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#tabel').DataTable();
    });
</script>

</html>
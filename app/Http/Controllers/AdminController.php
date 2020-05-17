<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\Barang;
use App\Keranjang;
use App\Transaction;
use App\Toko;
use App\Rating;
use App\User;
use DB;

use Illuminate\Http\Request;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AdminController extends Controller
{
    function home()
    {
        $data['jmluser'] = User::all()->count();
        $data['jmltrans'] = Transaction::all()->count();
        $data['jmltoko'] = Toko::all()->count();
        $data['jmlbarang'] = Barang::all()->count();
        return view('homeadmin', $data);
    }

    function verifying($email){
        User::where('email', $email)->update([
            'status' => "verify"
        ]);
        return redirect('/')->with('sukses', 'Selamat akun anda telah berhasil dikonfirmasi, silahkan login kembali untuk melanjutkan');
    }

    function listuser()
    {
        $data['user'] = User::all();
        return view('listuser', $data);
    }

    function listtrans()
    {
        $data['trans'] = DB::table('transactions')
            ->join('users', 'transactions.id_user', '=', 'users.id')
            ->select('transactions.*', 'users.nama')->get();
        return view('listtrans', $data);
    }

    function verifypage(){
        return view('verify');
    }

    function listbarang()
    {
        $data['barang'] = DB::table('barangs')->join('tokos', 'barangs.id_toko','=','tokos.id')->
        select('barangs.*', 'tokos.nama_toko', 'tokos.phone')->get();
        return view('listbarang', $data);
    }

    function listtoko()
    {
        $data['toko'] = Toko::all();
        return view('listtoko', $data);
    }

    function confirmtrans()
    {
        if ($_POST['status'] == "Menunggu konfirmasi pembayaran oleh admin") {
            Transaction::where('id', '=', $_POST['id'])->update([
                'status' => "Barang diproses penjual"
            ]);
            return redirect('listtrans')->with('sukses', 'Konfirmasi Berhasil');
        } else if ($_POST['status'] == "Menunggu konfirmasi admin") {
            Transaction::where('id', '=', $_POST['id'])->update([
                'status' => "Menunggu pembayaran"
            ]);
            $iduser = Transaction::select('id_user','created_at','status','total')->where('id', $_POST['id'])->get();
            $user = User::where('id', $iduser[0]->id_user)->get();
            $message = 'Transaksi anda pada tanggal '.date("d-m-Y H:i:s", strtotime($iduser[0]->created_at)).
            ' denga total '.$iduser[0]->total.' sudah kami konfirmasi harap segera melakukan pembayaran<br><br>Status : '.$iduser[0]->status.
            '<br>Link upload bukti pembayaran : <a href="http://localhost:8000/transaksi">Disini</a>';
            $this->sendtouser($user[0]->email,$user[0]->nama,$message);
            return redirect('listtrans')->with('sukses', 'Konfirmasi Berhasil');
        } else if ($_POST['status'] == "Barang diproses penjual") {
            Transaction::where('id', '=', $_POST['id'])->update([
                'status' => "Barang dikirim"
            ]);
        } else if ($_POST['status'] == "Barang dikirim") {
            Transaction::where('id', '=', $_POST['id'])->update([
                'status' => "Barang diterima"
            ]);
            return redirect('transaksi')->with('sukses', 'Transaksi Selesai, menunggu konfirmasi admin');
        } else if ($_POST['status'] == "Barang diterima") {
            Transaction::where('id', '=', $_POST['id'])->update([
                'status' => "Selesai"
            ]);
            return redirect('listtrans')->with('sukses', 'Konfirmasi Berhasil');
        }
    }

    public function sendtoadmin()
    {
        require 'C:/xampp/htdocs/loakin/vendor/autoload.php';
        require 'C:/xampp/htdocs/loakin/vendor/phpmailer/src/Exception.php';
        require 'C:/xampp/htdocs/loakin/vendor/phpmailer/src/PHPMailer.php';
        require 'C:/xampp/htdocs/loakin/vendor/phpmailer/src/SMTP.php';                                     // load Composer's autoloader

        $mail = new PHPMailer(true);                            // Passing `true` enables exceptions

        $mail->IsSMTP();
        $mail->SMTPDebug = 2;
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;

        // But you can comment from here
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->CharSet = "UTF-8";
        // To here. 'cause default secure is TLS.

        $mail->setFrom($email, $nama);
        $mail->Username = $email;
        $mail->Password = $pass;

        $mail->Subject = "Transaksi Loakin";
        $mail->msgHTML($message);
        $mail->addAddress("ecommerceloakin@gmail.com", "loakin ecommerce");

        if (!$mail->send()) {
            $mail->ErrorInfo;
            return back()->with('message', 'Pesan gagal terkirim!');
        } else {
            return back()->with('message', 'Pesan Terkirim!');
        }
    }

    public function sendtouser($email,$name,$message)
    {
        require 'C:/xampp/htdocs/loakin/vendor/autoload.php';
        require 'C:/xampp/htdocs/loakin/vendor/phpmailer/src/Exception.php';
        require 'C:/xampp/htdocs/loakin/vendor/phpmailer/src/PHPMailer.php';
        require 'C:/xampp/htdocs/loakin/vendor/phpmailer/src/SMTP.php';                                     // load Composer's autoloader

        $mail = new PHPMailer(true);                            // Passing `true` enables exceptions

        $mail->IsSMTP();
        $mail->SMTPDebug = false;
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;

        // But you can comment from here
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->CharSet = "UTF-8";
        // To here. 'cause default secure is TLS.

        $mail->setFrom("ecommerceloakin@gmail.com", "loakin ecommerce");
        $mail->Username = "ecommerceloakin@gmail.com";
        $mail->Password = "dragonking97";

        $mail->Subject = "Transaksi Loakin";
        $mail->msgHTML($message);
        $mail->addAddress($email, $name);

        if (!$mail->send()) {
            return redirect('/listtrans')->with('gagal', 'Pesan gagal terkirim!');
        } else {
            return redirect('/listtrans')->with('sukses', 'Pesan Terkirim!');
        }
    }
}

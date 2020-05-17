<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AuthController extends Controller
{
	public function dologin()
	{
		$cek = User::where('email', $_POST['email'])->count();
		if ($cek == 1) {
			$data = User::where('email', $_POST['email'])->get();
			if ($data[0]->status == "verify") {
				if (Auth::guard('user')->attempt(['email' => $_POST['email'], 'password' => $_POST['pass']])) {
					return redirect()->intended('/')->with('sukses', "Selamat anda berhasil login!!");
				} else {
					return redirect('/')->with('gagal', "Username / Password Salah!!");
				}
			} else {
				return redirect('/errorverify');
			}
		} else if (Auth::guard('admin')->attempt(['email' => $_POST['email'], 'password' => $_POST['pass']])) {
			return redirect()->intended('/homeadmin')->with('sukses', "Selamat anda berhasil login!!");
		} else {
			return redirect('/')->with('gagal', "Username / Password Salah!!");
		}
	}

	public function register()
	{
		$cek = User::where('email', '=', $_POST['email'])->count();
		if ($cek >= 1) {
			return redirect('/')->with('gagal', "Pendaftaran gagal, email telah terdaftar!!");
		} else {
			$data = User::create([
				'nama' => $_POST['nama'],
				'email' => $_POST['email'],
				'password' => Hash::make($_POST['pass']),
				'phone' => $_POST['phone'],
				'alamat' => $_POST['alamat']
			]);
			$message = "Selamat anda berhasil membuat akun di Loakin
			<br> Klik link berikut ini untuk verifikasi akun anda<br>
			<a href='http://localhost:8000/verifying/" . $_POST['email'] . "'>Verifikasi Akun Loakin</a>";
			$this->sendlinkverify($_POST['email'], $_POST['nama'], $message);
			return redirect('/')->with('sukses', "Selamat pendaftaran akun anda berhasil, silahkan verifikasi akun anda telebih dahulu, buka pesan di email anda!!");
		}
	}

	public function logout()
	{
		if (Auth::guard('user')->check()) {
			Auth::guard('user')->logout();
		} else if (Auth::guard('admin')->check()) {
			Auth::guard('admin')->logout();
		}
		return redirect('/')->with('gagal', "Logout Berhasil!!");
	}

	public function sendlinkverify($email, $name, $message)
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

		$mail->Subject = "Verifikasi Akun Loakin";
		$mail->msgHTML($message);
		$mail->addAddress($email, $name);

		if (!$mail->send()) {
			return redirect('/listtrans')->with('gagal', 'Pesan gagal terkirim!');
		} else {
			return redirect('/listtrans')->with('sukses', 'Pesan Terkirim!');
		}
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function index()
    {
        echo 'Halo selamat datang ' .Auth::user()->name;
        echo "<a href='/mahasiswa'> Lihat data mahasiswa </a>";
        echo "<a href='/logout'> Logout </a>";
    }

    function admin()
    {
        echo 'Halo selamat datang ' .Auth::user()->name. ' di halaman admin';
        echo "<a href='/mahasiswa'> Lihat data mahasiswa </a>";
        echo "<a href='/logout'> Logout </a>";
    }

    function mahasiswa()
    {
        echo 'Halo selamat datang ' .Auth::user()->name.  ' di halaman mahasiswa';
        echo "<a href='/mahasiswa'> Lihat data mahasiswa </a>";
        echo "<a href='/logout'> Logout </a>";
    }

    function dosen()
    {
        echo 'Halo selamat datang ' .Auth::user()->name.  ' di halaman dosen';
        echo "<a href='/mahasiswa'> Lihat data mahasiswa </a>";
        echo "<a href='/logout'> Logout </a>";
    }
}

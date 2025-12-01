<?php

namespace App\Http\Controllers;

use App\Models\konfigurasi_web;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Method untuk landing page (home)
    public function index()
    {
        // Ambil data konfigurasi dari database
        $konfigurasi = konfigurasi_web::first();
        
        // Ambil data reviews untuk ditampilkan di home
        $reviews = Review::orderBy('id_review', 'desc')
            ->take(6)
            ->get();
        
        // Kirim data ke view home
        return view('home', compact('konfigurasi', 'reviews'));
    }

    // Method untuk dashboard home
    public function dashboard()
    {
        // Ambil data konfigurasi untuk ditampilkan di dashboard
        $konfigurasi = konfigurasi_web::first();
        
        // Kirim data ke view dashboard
        return view('dashboard.homedashboard', compact('konfigurasi'));
    }
}
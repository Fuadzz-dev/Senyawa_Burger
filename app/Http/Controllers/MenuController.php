<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        // Ambil semua menu yang tersedia, kelompokkan berdasarkan kategori
        $menus = Menu::where('status_tersedia', true)
            ->orderBy('Kategori')
            ->orderBy('nama_menu')
            ->get()
            ->groupBy('Kategori');

        // Daftar kategori yang akan ditampilkan (urutan tab)
        $kategoriList = ['burger', 'kebab', 'minuman', 'dessert', 'snack'];

        return view('Menu', compact('menus', 'kategoriList'));
    }
}

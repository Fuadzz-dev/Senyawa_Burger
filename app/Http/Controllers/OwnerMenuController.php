<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class OwnerMenuController extends Controller
{
    public function index()
    {
        $menusRaw = Menu::with('bahan')->get();

        $menus = $menusRaw->map(function($item) {
            return [
                'id' => $item->id_menu,
                'nama' => $item->nama_menu,
                'harga' => intval($item->harga),
                'bahan' => $item->bahan ? $item->bahan->pluck('nama_bahan')->toArray() : [],
                'kategori' => $item->Kategori,
                'foto' => $item->foto ? asset('storage/' . $item->foto) : null,
            ];
        })->values()->toArray();

        return view('Owner.Daftar_menu', compact('menus'));
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        
        // Relasi pivot menu_bahan harusnya otomatis terhapus jika di-set terpisah atau memiliki on cascade, 
        // namun untuk amannya kita detach manual:
        $menu->bahan()->detach();

        $menu->delete();

        return response()->json([
            'success' => true,
            'message' => 'Menu berhasil dihapus.'
        ]);
    }
}

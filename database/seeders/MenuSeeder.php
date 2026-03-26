<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            // BURGER
            [
                'nama_menu' => 'Cheese Burger',
                'harga' => 24500,
                'foto' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400&q=80',
                'deskripsi' => 'Burger keju klasik dengan daging sapi panggang dan keju cheddar leleh.',
                'kategori' => 'burger',
                'status_tersedia' => true,
            ],
            [
                'nama_menu' => 'Beef Burger',
                'harga' => 26000,
                'foto' => 'https://images.unsplash.com/photo-1553979459-d2229ba7433b?w=400&q=80',
                'deskripsi' => 'Burger daging sapi premium dengan sayuran segar.',
                'kategori' => 'burger',
                'status_tersedia' => true,
            ],
            [
                'nama_menu' => 'Double Patty Cheeseburger',
                'harga' => 28500,
                'foto' => 'https://images.unsplash.com/photo-1594212699903-ec8a3eca50f5?w=400&q=80',
                'deskripsi' => 'Dua lapis daging sapi dengan keju leleh berlimpah.',
                'kategori' => 'burger',
                'status_tersedia' => true,
            ],
            [
                'nama_menu' => 'Crispy Chicken Burger',
                'harga' => 25000,
                'foto' => 'https://images.unsplash.com/photo-1585238342024-78d387f4a707?w=400&q=80',
                'deskripsi' => 'Ayam goreng renyah dengan saus spesial.',
                'kategori' => 'burger',
                'status_tersedia' => true,
            ],

            // KEBAB
            [
                'nama_menu' => 'Kebab Original',
                'harga' => 20000,
                'foto' => 'https://images.unsplash.com/photo-1561651823-34feb02250e4?w=400&q=80',
                'deskripsi' => 'Kebab klasik dengan daging dan sayuran segar.',
                'kategori' => 'kebab',
                'status_tersedia' => true,
            ],
            [
                'nama_menu' => 'Kebab Jumbo Daging',
                'harga' => 28000,
                'foto' => 'https://images.unsplash.com/photo-1529006557810-274b9b2fc783?w=400&q=80',
                'deskripsi' => 'Kebab ukuran jumbo dengan porsi daging ekstra.',
                'kategori' => 'kebab',
                'status_tersedia' => true,
            ],
            [
                'nama_menu' => 'Kebab Mozarella',
                'harga' => 25000,
                'foto' => 'https://images.unsplash.com/photo-1590080875515-8a3a8dc5735e?w=400&q=80',
                'deskripsi' => 'Kebab dengan lelehan keju mozarella.',
                'kategori' => 'kebab',
                'status_tersedia' => true,
            ],
            [
                'nama_menu' => 'Kebab Pedas Mantap',
                'harga' => 22000,
                'foto' => 'https://images.unsplash.com/photo-1613514785940-daed07799d9b?w=400&q=80',
                'deskripsi' => 'Kebab dengan level pedas yang menggugah selera.',
                'kategori' => 'kebab',
                'status_tersedia' => true,
            ],

            // MINUMAN
            [
                'nama_menu' => 'Es Teh Manis',
                'harga' => 8000,
                'foto' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=400&q=80',
                'deskripsi' => 'Teh manis dingin yang menyegarkan.',
                'kategori' => 'minuman',
                'status_tersedia' => true,
            ],
            [
                'nama_menu' => 'Jus Jeruk Segar',
                'harga' => 12000,
                'foto' => 'https://images.unsplash.com/photo-1621506289937-a8e4df240d0b?w=400&q=80',
                'deskripsi' => 'Jus jeruk peras segar tanpa pengawet.',
                'kategori' => 'minuman',
                'status_tersedia' => true,
            ],
            [
                'nama_menu' => 'Milkshake Coklat',
                'harga' => 18000,
                'foto' => 'https://images.unsplash.com/photo-1572490122747-3968b75cc699?w=400&q=80',
                'deskripsi' => 'Milkshake coklat creamy yang nikmat.',
                'kategori' => 'minuman',
                'status_tersedia' => true,
            ],

            // DESSERT
            [
                'nama_menu' => 'Brownies Coklat',
                'harga' => 15000,
                'foto' => 'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=400&q=80',
                'deskripsi' => 'Brownies coklat lembut dengan topping coklat leleh.',
                'kategori' => 'dessert',
                'status_tersedia' => true,
            ],
            [
                'nama_menu' => 'Ice Cream Sundae',
                'harga' => 16000,
                'foto' => 'https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=400&q=80',
                'deskripsi' => 'Es krim dengan topping saus dan wafer.',
                'kategori' => 'dessert',
                'status_tersedia' => true,
            ],

            // SNACK
            [
                'nama_menu' => 'French Fries',
                'harga' => 14000,
                'foto' => 'https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=400&q=80',
                'deskripsi' => 'Kentang goreng renyah dengan bumbu spesial.',
                'kategori' => 'snack',
                'status_tersedia' => true,
            ],
            [
                'nama_menu' => 'Chicken Nugget',
                'harga' => 16000,
                'foto' => 'https://images.unsplash.com/photo-1562967914-608f82629710?w=400&q=80',
                'deskripsi' => 'Nugget ayam renyah dengan saus pilihan.',
                'kategori' => 'snack',
                'status_tersedia' => true,
            ],
            [
                'nama_menu' => 'Onion Rings',
                'harga' => 13000,
                'foto' => 'https://images.unsplash.com/photo-1639024471283-03518883512d?w=400&q=80',
                'deskripsi' => 'Bawang goreng tepung renyah golden brown.',
                'kategori' => 'snack',
                'status_tersedia' => true,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}

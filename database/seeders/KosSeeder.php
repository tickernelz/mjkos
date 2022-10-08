<?php

namespace Database\Seeders;

use App\Models\Kos;
use Illuminate\Database\Seeder;

class KosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kos::create([
            'nama' => 'MJKOS',
            'email' => 'mjkos@admin.com',
            'telp' => '0812345678',
            'alamat' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque quis vel',
            'deskripsi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque quis vel asperiores voluptates, totam mollitia aliquam blanditiis inventore, quia quos explicabo? Accusantium asperiores debitis hic tempore alias. Ipsum et, veniam distinctio adipisci ut accusantium sed tenetur quidem expedita unde? Consectetur repudiandae nostrum dolores et deserunt asperiores vero quis ad sapiente eligendi aliquid fuga, similique voluptatem porro ullam maiores hic id, laboriosam sed optio repellendus aspernatur eius cupiditate consequatur. Deleniti ratione asperiores, nostrum blanditiis consequatur dolor animi ullam, aut minus odit nihil accusamus possimus, dolore laborum iste. Laborum corrupti molestias animi sint consequatur voluptatibus cupiditate quas esse molestiae vitae doloribus atque ducimus fugiat, debitis eligendi, nesciunt eum culpa alias hic porro dignissimos nulla. Non accusantium perspiciatis nihil, consectetur dicta nulla iste adipisci dolor facere, possimus aut fuga amet! Distinctio voluptates recusandae a doloribus excepturi quis eos, molestias mollitia iusto odio saepe exercitationem inventore accusantium ea dolorem eum illo quidem vitae rerum, fuga dolore, blanditiis eligendi! Rem odio inventore nulla suscipit rerum numquam fugit aliquam at? Velit aperiam ullam asperiores. Exercitationem, nemo iste? Quis, dolor iusto, mollitia non alias tempore neque earum provident fugit accusamus soluta. Nisi cum, suscipit dolores laudantium impedit nesciunt libero tempore, consequuntur reiciendis iure nobis voluptas voluptates provident.',
            'cover' => 'hero-bg.jpg'
        ]);
    }
}

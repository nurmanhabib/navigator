Welcome to Navigator!
===================

Generate multi menu navigasi dengan nama yang unik, dapat ditampilkan dimana saja. Custom templating. Support Laravel 5.

----------
Instalasi
-------------

#### Install dengan Composer

Cukup sederhana, jalankan perintah berikut untuk mendapatkan versi terbaru.

    composer require nurmanhabib/navigator

Untuk Laravel 5.0

    composer require nurmanhabib/navigator:~3.0

Untuk Laravel 4.2

    composer require nurmanhabib/navigator:~2.0

#### Tambahkan Service Provider

Tambahkan `Nurmanhabib\Navigator\NavigatorServiceProvider` ke dalam file di `config/app.php` pada array `providers`.

    'providers' = [
        ...,
        ...,
        
        'Nurmanhabib\Navigator\NavigatorServiceProvider',
    ];


#### Publish Contoh Template

Navigator mempunyai contoh template `arjuna` dan `sbadmin2` yang akan disalin ke dalam folder `resources/views/vendor/navigator/template`

    php artisan vendor:publish

Navigator memberikan sebuah *namespace* `mynavigator` pada folder `resources/views/vendor/navigator`. Anda dapat mengakses view dengan mudah, misalnya.

    Navigator::setTemplate('mynavigator::template.sbadmin2');

atau tetap masih dapat diakses dengan cara

    Navigator::setTemplate('vendor.navigator.template.sbadmin2');


Contoh Penggunaan
-------------

Langsung coba inisialisasi navigator pertama Anda. Tambahkan navigator pada *constructor* Controller utama agar dapat digunakan disetiap Controller dibawahnya.

    class Controller extends BaseController
    {

        public function __construct()
        {
            Navigator::set('Dashboard', url('home'));
            Navigator::set('Post', url('post'));
            Navigator::set('User', url('user'));
        }
        
    }

Selanjutnya, coba buat Controller baru dengan meng-extends Class Controller tersebut.

    class HomeController extends Controller
    {

        public function index()
        {
            return view('home');
        }
    
    }

Selanjutnya, buat sebuah view dengan nama `home.blade.php` tambahkan `Navigator::show()` pada bagian yang akan menampilkan menu navigasi.

    ...
    <div class="sidebar">
        {!! Navigator::show() !!}
    </div>
    ...


----------

API
---

#### Set Item Navigasi

Menambahkan item menu navigasi. Terdapat 3 parameter.

    Navigator::set($text, $url = '#', $icon = 'dashboard');

 1. `$text` : Tampilan atau nama menu yang akan tampil. (required)
 2. `$url` : Alamat URL ketika item diklik. (opsional)
 3. `$icon` : Icon didapatkan dari **FontAwesome** tanpa awalan `fa-`. (opsional)

Contoh penggunaannya adalah sebagai berikut.

    Navigator::set('Dashboard', url('home'), 'home');


----------


#### Set Child Item Navigasi

Menambahkan item child pada menu navigasi.

    Navigator::set('User')->child(function()
    {
        Navigator::set('Semua', url('user'), 'users');
        Navigator::set('Baru', url('user/create'), 'plus');
    });


----------


#### Set Active Item Navigasi

Jika Anda sedang mengunjungi `http://example.com/user` maka harapannya pada item yang sudah diinisialisasikan dengan `url('user')` akan terdapat `class="active"` pada element `<li>`. Tambahkan fungsi berikut pada method yang sedang di akses.

    Navigator::setActive(url('home'));

 
Contoh penggunaan adalah sebagai berikut.

    class UserController extends Controller
    {

        public function index()
        {
            Navigator::setActive(url('home'));

            return view('user.index');
        }
        
    }
        

----------


#### Set Multiple Navigator

Bisa jadi di web yang sedang Anda buat memiliki sebuah sidebar di sisi kiri, kemudian navbar di header, ataupun menu lainnya. Semua itu sudah disiapkan di Navigator. Semuanya bisa di set dengan nama yang unik. Untuk membuat nama unik setiap navigator, bisa gunakan fungsi name().

    Navigator::name('navbar-atas');
    Navigator::set('Home');
    ...

    Navigator::name('sidebar');
    Navigator::set('Dashboard');
    ...

Untuk menampilkan pada view juga mudah.

    <nav class="navbar-nav navbar-default">        
        {!! Navigator::show('navbar-atas') !!}
    </nav>

    <div class="sidebar">
        {!! Navigator::show('sidebar') !!}
    </div>


----------


#### Kustomisasi Template

Navigator ini diusahakan fleksibel terhadap struktur HTML setiap desain template Anda. Anda dapat mengaturnya sendiri. Template ini menggunakan konsep file langsung di dalam folder view. Perlu diperhatikan struktur penamaan file standar.

 - resources
     - views
         - **template**
             - **mynavigator**
                 - `index`.blade.php *- required*
                 - `item`.blade.php *- required, default*
                 - `item_active`.blade.php *- opsional*
                 - `item_disabled`.blade.php *- opsional*
                 - `child`.blade.php *- opsional*
                 - `child_active`.blade.php *- opsional*

Folder `template.mynavigator` sekaligus menjadi nama template yang akan digunakan untuk Navigator. Semua file view harus mempunyai akhiran `.php` atau jika menggunakan Blade menggunakan akhiran `.blade.php`. Untuk set template kustomisasi, gunakan method berikut.

    Navigator::setTemplate('template.mynavigator');

> Jika di dalam template file yang ditandai opsional tidak dibuat, maka Navigator akan membaca `item.blade.php` sebagai default.
> Membuat template di dalam folder `vendor/navigator`, maka dapat dipanggil dengan *namespace* `mynavigator`.

Selain itu, jika akan membuat template untuk *child*, maka akan membaca folder `child`. Struktur dari folder child berlaku rekursif dengan item.

 - resources
     - views
         - **template**
             - **mynavigator**
                 - **child**
                     - **child**
                         - `index`.blade.php
                         - `item`.blade.php
                         - ...
                     - `index`.blade.php
                     - `item`.blade.php
                     - ...
                 - `index`.blade.php
                 - `item`.blade.php
                 - `item_active`.blade.php
                 - `item_disabled`.blade.php
                 - `child`.blade.php
                 - `child_active`.blade.php


----------

#### index.blade.php

Sebagai wrapper dari menu navigasi yang akan ditampilkan. Pada file ini terdapat variabel yang dapat digunakan, yaitu `$items` untuk menampilkan semua item yang sudah di set di Controller.

    <ul class="sidebar-menu">

        {!! $items !!}

    </ul>


----------


#### item.blade.php

Untuk menampilkan setiap item. Pada file ini terdapat variabel yang dapat digunakan, yaitu `$item` untuk mendapatkan atribut dari item.

 - `$item->text` : Tampilan teks
 - `$item->url` : Alamat URL dari item
 - `$item->icon` : Nama icon yang sudah di set tanpa awalan `fa-`
 - `$item->iconFa()` : Hasil icon dengan format **FontAwesome**.


Semua atribut dapat digunakan pada file view `item.blade.php` sesuai kebutuhan.

    <li>
        <a href="{{ $item->url }}">{!! $item->iconFa() !!} {{ $item->text }}</a>
    </li>


----------


#### item_active.blade.php

Untuk menampilkan item yang sedang `active`. Sama seperti pada `item.blade.php`, file ini terdapat variabel yang dapat digunakan, yaitu `$item` untuk mendapatkan atribut dari item.

    <li class="active">
        <a href="{{ $item->url }}">{!! $item->iconFa() !!} {{ $item->text }}</a>
    </li>


----------

#### item_disabled.blade.php

Untuk menampilkan item yang sedang `disabled`. Sama seperti pada `item.blade.php`, file ini terdapat variabel yang dapat digunakan, yaitu `$item` untuk mendapatkan atribut dari item.

    <li class="disabled">
    <a href="{{ $item->url }}">{!! $item->iconFa() !!} {{ $item->text }}</a>
    </li>


----------

#### child.blade.php

Untuk menampilkan item yang mempunyai menu `child`. Sama seperti pada `item.blade.php`, file ini terdapat variabel yang dapat digunakan, yaitu `$item` untuk mendapatkan atribut dari item. Terdapat variabel khusus untuk menampilkan menu `child`, yaitu `$child`. Kustomisasi template `child` ada di dalam folder `child`.

    <li class="treeview">
        <a href="">
            {!! $item->iconFa() !!} <span>{{ $item->text }}</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
    
        {!! $child !!}

    </li>


----------

#### child_active.blade.php

Untuk menampilkan item yang mempunyai menu `child` yang sedang `active`. Sama seperti pada `item.blade.php`, file ini terdapat variabel yang dapat digunakan, yaitu `$item` untuk mendapatkan atribut dari item. Terdapat variabel khusus untuk menampilkan menu `child`, yaitu `$child`. Kustomisasi template `child` ada di dalam folder `child`.

    <li class="treeview active">
        <a href="">
            {!! $item->iconFa() !!} <span>{{ $item->text }}</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
    
        {!! $child !!}

    </li>


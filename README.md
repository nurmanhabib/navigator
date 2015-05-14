<<<<<<< HEAD
Welcome to Navigator!
===================

Generate multi menu navigasi dengan nama yang unik, dapat ditampilkan dimana saja. Custom templating. Support Laravel 5.

----------
Instalasi
-------------

#### <i class="icon-file"></i> Install dengan Composer

Cukup sederhana, jalankan perintah berikut.

    composer require nurmanhabib/navigator


#### <i class="icon-file"></i> Tambahkan Service Provider

Tambahkan `Nurmanhabib\Navigator\NavigatorServiceProvider` ke dalam file di `config/app.php` pada array `providers`.

    'providers' = [
        ...,
        ...,
        
        'Nurmanhabib\Navigator\NavigatorServiceProvider',
    ];


----------


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

#### <i class="icon-file"></i> Set Item Navigasi

Menambahkan item menu navigasi. Terdapat 3 parameter.

    Navigator::set($text, $url = '#', $icon = 'dashboard');

 1. `$text` : Tampilan atau nama menu yang akan tampil. (required)
 2. `$url` : Alamat URL ketika item diklik. (opsional)
 3. `$icon` : Icon didapatkan dari **FontAwesome** tanpa awalan `fa-`. (opsional)

Contoh penggunaannya adalah sebagai berikut.

    Navigator::set('Dashboard', url('home'), 'home');


----------


#### <i class="icon-file"></i> Set Child Item Navigasi

Menambahkan item child pada menu navigasi.

    Navigator::set('User')->child(function($nav)
    {
        $nav->set('Semua', url('user'), 'users');
        $nav->set('Baru', url('user/create'), 'plus');
    
        return $nav;
    });


----------


#### <i class="icon-file"></i> Set Active Item Navigasi

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


#### <i class="icon-file"></i> Kustomisasi Template

Navigator ini diusahakan fleksibel terhadap struktur HTML setiap desain template Anda. Anda dapat mengaturnya sendiri. Template ini menggunakan konsep file langsung di dalam folder view. Perlu diperhatikan struktur penamaan file standar.

 - resources
     - views
         - **mynavigator**
             - `index` *- required*
             - `item` *- required, default*
             - `item_active` *- opsional*
             - `item_disabled` *- opsional*
             - `child` *- opsional*
             - `child_active` *- opsional*

Folder `mynavigator` sekaligus menjadi nama template yang akan digunakan untuk Navigator. Semua file view harus mempunyai akhiran `.php` atau jika menggunakan Blade menggunakan akhiran `.blade.php`. Untuk set template kustomisasi, gunakan method berikut.

    Navigator::setTemplate('mynavigator');

> Jika di dalam template file yang ditandai opsional tidak dibuat, maka Navigator akan membaca `item.blade.php` sebagai default.

Selain itu, jika akan membuat template untuk *child*, maka akan membaca folder `child`. Struktur dari folder child berlaku rekursif dengan item.

 - resources
     - views
         - **mynavigator**
             - **child**
                 - **child**
                     - `index`
                     - `item`
                     - ...
                 - `index`
                 - `item`
                 - ...
             - `index`
             - `item`
             - `item_active`
             - `item_disabled`
             - `child`
             - `child_active`


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

    <li class="disabled">
    <a href="{{ $item->url }}">{!! $item->icon !!} {{ $item->text }}</a>
    </li>


----------

#### child.blade.php

    <li class="treeview">
        <a href="">
            {!! $item->iconFa() !!} <span>{{ $item->text }}</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
    
        {!! $child !!}

    </li>


----------

#### child_active.blade.php

    <li class="treeview active">
        <a href="">
            {!! $item->iconFa() !!} <span>{{ $item->text }}</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
    
        {!! $child !!}

    </li>
=======
navigator
=========

Generate multi menu navigasi dengan nama yang unik, dapat ditampilkan dimana saja. Custom templating.

    $list = array(
        'Dashboard' => url('home'),
        'Kasus'     => url('kasus'),
        'Users'     => url('users'),
    );

    Navigator::set('sidebar', $list);

### Pemanggilan pada view
Pemanggilan dapat dilakukan dimana saja, Anda dapat menampilkan multi navigator dengan lokasi yang berbeda berdasarkan name yang sudah di buat.

    {{ Navigator::name('sidebar') }}

### Fungsi tambahan
#### ->setTemplate();
Template yang tersedia:

    'stacked'           => 'Nurmanhabib\\Navigator\\Template\\Stacked',
    'pills'             => 'Nurmanhabib\\Navigator\\Template\\Pills',
    'sb-admin-2'        => 'Nurmanhabib\\Navigator\\Template\\SBAdmin2',
    'sb-admin-2-child'  => 'Nurmanhabib\\Navigator\\Template\\SBAdmin2\\Child',
    'treeview'          => 'Nurmanhabib\\Navigator\\Template\\Treeview',
    'treeview-child'    => 'Nurmanhabib\\Navigator\\Template\\Treeview\\Child',
    
Secara default, template akan membaca konfigurasi pada file **config/package/nurmanhabib/navigator/config.php**

    'template' => 'stacked'
    
Mengganti template pada saat inisilasi navigator

    Navigator::set('sidebar', $list)->setTemplate('treeview');
    
Mengganti template pada navigator yang sudah dibuat

    Navigator::name('sidebar')->setTemplate('treeview');

#### ->setActive();

    Navigator::set('sidebar', $list)->setActive(route('home'));
>>>>>>> b32f798841e78275085438e0bdc3359db9bb16d2

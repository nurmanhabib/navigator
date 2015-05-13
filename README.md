Welcome to Navigator!
===================

Generate multi menu navigasi dengan nama yang unik, dapat ditampilkan dimana saja. Custom templating.

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

Langsung coba inisialisasi navigator pertama Anda. Tambahkan navigator pada contructor Controller utama agar dapat digunakan disetiap Controller dibawahnya.

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

Menambahkan item menu navigasi. Icon didapatkan dari **FontAwesome** tanpa awalan `fa-`.

    Navigator::set('Dashboard', url('home'), 'dashboard');


----------


#### <i class="icon-file"></i> Set Child Item Navigasi

Menambahkan item child pada menu navigasi.

    Navigator::set('User')->child(function($nav)
    {
        $nav->set('Semua', url('user'));
        $nav->set('Baru', url('user/create'));
    
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

Navigator ini diusahakan fleksibel terhadap struktur HTML setiap desain template Anda. Anda dapat mengaturnya sendiri.
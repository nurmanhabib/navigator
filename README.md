# Welcome to Navigator!

Sekarang bisa digunakan untuk semua framework PHP bahkan untuk PHP Native. Untuk penggunaan Laravel berubah menjadi `nurmanhabib/laravel-menu`.

------

## Instalasi

#### Install dengan Composer

Cukup sederhana, jalankan perintah berikut untuk mendapatkan versi terbaru.

```
composer require nurmanhabib/navigator
```

#### Penggunaan

1. Cukup membuat _object_ `NavCollection` dengan menambahkan beberapa `NavItem`

   ```php
   $menu = new NavCollection;
   $menu->addHome();
   $menu->addLink('Berita', 'berita');
   $menu->addSeparator();
   $menu->addParent('Kategori', function (NavCollection $menu) {
     $menu->addLink('Teknologi', 'kategori/teknologi');
     $menu->addLink('Otomotif', 'kategori/otomotif');
     $menu->addParent('Lifestyle', function (NavCollection $menu) {
       $menu->addLink('Pria', 'lifestyle-pria');
       $menu->addLink('Wanita', 'lifestyle-wanita');
     });
   });
   ```

2. Selanjutnya membuat object `Navigator`

   ```php
   $navigator = new Navigator($menu);
   ```

3. Set NavItem yang aktif berdasarkan url

   ```php
   $navigator->setActive('lifestyle-wanita');
   ```

4. Render Navigator

   ```php
   return $navigator->render();
   ```


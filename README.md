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

Cukup membuat _object_ `Nurmanhabib\Navigator\NavCollection` dengan menambahkan beberapa `Nurmanhabib\Navigator\NavItem`

```php
use Nurmanhabib\Navigator\NavCollection;
use Nurmanhabib\Navigator\Navigator;

$menu = new NavCollection;
$menu->addHome();
$menu->addLink('Berita', '/berita')->match('berita*');
$menu->addSeparator();
$menu->addParent('Kategori', function (NavCollection $menu) {
    $menu->addLink('Teknologi', '/kategori/teknologi');
    $menu->addLink('Otomotif', '/kategori/otomotif');
    $menu->addParent('Lifestyle', function (NavCollection $menu) {
        $menu->addLink('Pria', '/lifestyle-pria');
        $menu->addLink('Wanita', '/lifestyle-wanita');
    });
});

$menu->addHeading('Configuration');
$menu->addLink('Application', '/config/app');

$menu->addHeading('Account');
$menu->addLink('My Profile', '/profile');
$menu->addLink('Logout', '/logout');

$navigator = new Navigator($menu);

echo $navigator->render();
```

Anda juga bisa membuat menggunakan data Array

```php
$data = [
    [
        'text' => 'Home',
        'url' => '/'
    ],
    [
        'text' => 'Berita',
        'url' => 'berita',
        'match' => '/berita*'
    ],
    [
        'type' => 'separator'
    ],
    [
        'text' => 'Kategori',
        'child' => [
            [
                'text' => 'Teknologi',
                'url' => 'kategori/teknologi'
            ],
            [
                'text' => 'Otomotif',
                'url' => 'kategori/otomotif'
            ],
            [
                'text' => 'Lifestyle',
                'child' => [
                    [
                        'text' => 'Pria',
                        'url' => 'lifestyle-pria'
                    ],
                    [
                        'text' => 'Wanita',
                        'url' => 'lifestyle-wanita'
                    ],
                ]
            ],
        ]
    ],
    [
        'type' => 'heading',
        'text' => 'Configuration'
    ],
    [
        'text' => 'Account',
        'child' => [
            [
                'text' => 'Change Password',
                'url' => 'change-password'
            ],
            [
                'text' => 'Logout',
                'url' => 'logout'
            ],
        ]
    ],
];

$factory = new ArrayNavCollectionFactory($data);

$menu = $factory->createNavCollection();

$navigator = new Navigator($menu);

echo $navigator->render();
```
   
#### API

1. match

    ```php
    $menu->addLink('Teknologi', 'kategori/teknologi')->match('kategori/*');
    ```
   
   Item akan aktif untuk path uri berikut:
   
    - `kategori/teknologi`    
    - `kategori/otomotif`
    
2. setData

    ```php
    $menu->addLink('Teknologi', 'kategori/teknologi')->setData(['key' => 'value']);
    ```
   
   Anda bisa menambahkan data pada item menu untuk digunakan pada saat custom render.
   
3. hasData
    ```php
    $item->hasData('key');
    ```

4. getData
    ```php
    echo $item->getData('key');
    ```
   
5. getType
    ```php
    echo $item->getType();
    ```
   
   Type yang didukung saat ini :
   
   - link
   - home
   - heading
   - separator
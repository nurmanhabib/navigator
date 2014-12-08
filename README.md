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
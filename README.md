navigator
=========

Generate navigasi dengan tampilan bootstrap untuk Laravel

    $navs   = array(
        '<i class="fa fa-dashboard"></i> <span>Home</span>'                 => route('dashboard'),
        '<i class="fa fa-credit-card"></i> <span>Pembayaran Baru</span>'    => route('backend.zakat.create'),
        '<i class="fa fa-coffee"></i> <span>Rekapitulasi</span>'            => array(
            '<i class="fa fa-coffee"></i> <span>Ringkasan</span>'           => route('dashboard'),
            '<i class="fa fa-coffee"></i> <span>Semua</span>'               => route('backend.zakat'),
            '<i class="fa fa-download"></i> <span>Download</span>'          => route('export'),
        ),
        '<i class="fa fa-print"></i> <span>Cetak Nota Kosong</span>'        => route('invoice.blank'),
        '<i class="fa fa-cog"></i> <span>Options</span>'                    => '#',
    );

    Navigator::initialize($navs, array(
        'ulattr'        => array('class' => 'sidebar-menu'),
        'liactive'      => 'active',
        'liparent_attr' => array('class' => 'treeview'),
        'child'         => array(
            'ulattr'        => array('class' => 'treeview-menu'),
            'liactive'      => 'active'
        )
    ));
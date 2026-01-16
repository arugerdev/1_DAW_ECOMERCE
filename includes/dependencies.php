<?php

$assets = [

    'css' => [

        '/assets/plugins/fontawesome/css/all.min.css',
        '/assets/plugins/bootstrap/bootstrap.min.css',
        '/assets/plugins/jquery-ui/jquery-ui.min.css',
        '/assets/plugins/datatables/dataTables.bootstrap4.min.css',
        '/assets/plugins/daterangepicker/daterangepicker.min.css',
        '/assets/plugins/jvectormap/jsvectormap.min.css',
        '/assets/plugins/adminlte/adminlte.min.css',
        '/assets/plugins/dropzonejs/dropzonejs.min.css',
    ],

    'js' => [

        '/assets/plugins/jquery/jquery.min.js',
        '/assets/plugins/jquery-knob/jquery-knob.min.js',
        '/assets/plugins/jquery-ui/jquery-ui.min.js',
        '/assets/plugins/bootstrap/bootstrap.bundle.min.js',
        '/assets/plugins/moment/moment.min.js',
        '/assets/plugins/chartjs/chart.min.js',
        '/assets/plugins/chartjs-adapter-date-fns/adapter.min.js',
        '/assets/plugins/datatables/jquery.dataTables.min.js',
        '/assets/plugins/datatables/dataTables.bootstrap4.min.js',
        '/assets/plugins/daterangepicker/daterangepicker.min.js',
        '/assets/plugins/datetimepicker/jquery.datetimepicker.full.min.js',
        '/assets/plugins/jvectormap/jsvectormap.min.js',
        '/assets/plugins/jvectormap/world.js',
        '/assets/plugins/adminlte/adminlte.min.js',
        '/assets/plugins/dropzonejs/dropzonejs.min.js',
        '/assets/plugins/iframejs/iframejs.js',
    ]
];

foreach ($assets['js'] as $js) {
    echo "<script src='$js'></script>";
}

foreach ($assets['css'] as $css) {
    echo "<link rel='stylesheet' href='$css'>";
}

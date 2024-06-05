# Installer 
  npm install @fortawesome/fontawesome-free
  @import '~@fortawesome/fontawesome-free/css/all.min.css';

# CDN Fontawesome
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

# Utiliser dataTables
  * composer require yajra/laravel-datatables-oracle
  * php artisan vendor:publish --provider="Yajra\DataTables\DataTablesServiceProvider"
  * ajouter ceci dans le dossier config>app.php
     'providers' => [
        \Yajra\DataTables\DataTablesServiceProvider::class,
     ]
  *   'aliases' => [
         'DataTables' => \Yajra\DataTables\Facades\DataTables::class
    ]
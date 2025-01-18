<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AjustesController;
use App\Http\Controllers\Panel\PublicacionController;
use App\Http\Controllers\Portal\AudiolibroController;
use App\Http\Controllers\Panel\EtiquetaController;
use App\Http\Controllers\Panel\MembresiaController;
use App\Http\Controllers\Portal\PortalController;
use App\Http\Controllers\Panel\RecomendadoController;
use App\Http\Controllers\Panel\SagaController;
use App\Http\Controllers\Panel\SolicitudesController;
use App\Http\Controllers\Portal\SoporteController;
use App\Http\Controllers\Panel\TopController;
use App\Http\Controllers\PublicidadController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Artisan;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* 
Route::get('/', function () {
    //return view('portal.index');
   
});
*/

Route::get('/limpiar-cache', function () {
    Artisan::call('cache:clear');
    return "Caché limpiada correctamente.";
});

Route::get('/', [PortalController::class, 'index'])->name('portal.index');
Route::get('/audiolibros', [PortalController::class, 'todos'])->name('portal.todos');
Route::get('/top', [PortalController::class, 'top'])->name('portal.top');
Route::get('/membresia', [PortalController::class, 'membresia'])->name('portal.membresia');
Route::get('/terminos-y-condiciones', [PortalController::class, 'terminos'])->name('portal.terminos');
Route::get('/DMCA', [PortalController::class, 'dmca'])->name('portal.dmca');
Route::get('/politica-y-privacidad', [PortalController::class, 'politica_y_privacidad'])->name('portal.politica');
Route::get('/sugeridos', [PortalController::class, 'sugeridos'])->name('portal.sugeridos');
Route::get('/search', [PortalController::class, 'search'])->name('portal.search');
Route::get('/genero/{genero}', [PortalController::class, 'genero'])->name('portal.genero');
Route::get('/autor/{autor}', [PortalController::class, 'autor'])->name('portal.autor');
Route::get('/sagas', [PortalController::class, 'sagas'])->name('portal.sagas');
Route::get('/saga/{saga}', [PortalController::class, 'sagas_view'])->name('portal.sagas.view');
Route::get('/year', [PortalController::class, 'year'])->name('portal.year');
Route::post('/pagos', [PortalController::class, 'pagos'])->name('portal.pagos');
Route::get('/documentation', [PortalController::class, 'documentation'])->name('portal.documentation');
Route::get('/documentation/install', [PortalController::class, 'documentation_install'])->name('portal.documentation.install');





//Audiolibro, favoritos y comentar
Route::get('/audiolibro/{slug}/', [AudiolibroController::class, 'detalles'])->name('portal.detalles');
Route::get('/audiolibro/{slug}/enlaces', [AudiolibroController::class, 'enlaces'])->name('portal.enlaces');
//Comentarios
Route::post('Audiolibro/store/comment/', [AudiolibroController::class, 'storeComment'])->name('portal.store.comment');
Route::get('Audiolibro/view/comment/', [AudiolibroController::class, 'view_comentario'])->name('portal.view.comment');
Route::get('/Audiolibro/delete/comment/{id}', [AudiolibroController::class, 'destroy_comment'])->name('portal.delete.comment');
//Favoritos
Route::get('/audiolibro/favorito/view/{id}', [AudiolibroController::class, 'favoritos_view'])->name('portal.favoritos_view');
Route::get('/audiolibro/favorito/{id}', [AudiolibroController::class, 'favoritos_store'])->name('portal.favoritos_store');
Route::get('/audiolibro/favorito/delete/{id}', [AudiolibroController::class, 'favoritos_destroy'])->name('portal.favoritos_delete');
//Publicidad
Route::get('/audiolibro/publicidad/{id}', [AudiolibroController::class, 'visualizar_publicidad'])->name('portal.publicidad');


//Soporte
Route::post('Audiolibro/{id}/store', [SoporteController::class, 'storeReporte'])->name('portal.reporte');
Route::get('/peticiones', [SoporteController::class, 'peticiones'])->name('portal.peticiones');
Route::post('Peticiones/storePeticiones', [SoporteController::class, 'storePeticione'])->name('portal.peticiones.store');
Route::get('Peticiones/realizado/{id}', [SoporteController::class, 'RealizadoPeticione'])->name('portal.peticiones.realizado');
Route::get('/contacto', [SoporteController::class, 'contacto'])->name('portal.contacto');
Route::post('Contacto/storeContacto', [SoporteController::class, 'storeContacto'])->name('portal.contacto.store');

//Cerar cesion
Route::get('/logout', [PortalController::class, 'logout'])->name('portal.logout');





Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/panel/create', function () {
        return view('panel.index');
    })->name('dashboard');

    //Mis Favoritos - Usuario Logueado
    Route::get('account/favoritos', [PortalController::class, 'favoritos'])->name('portal.favoritos');
    //Mi Cuenta
    Route::get('account/profile', [PortalController::class, 'profile'])->name('portal.profile');
    Route::get('account/profile/settings', [PortalController::class, 'profile_settings'])->name('portal.profile.settings');
    Route::post('account/profile/settings/password', [PortalController::class, 'password_reset'])->name('portal.profile.password_reset');
    Route::post('account/profile/settings/info', [PortalController::class, 'info_reset'])->name('portal.profile.info_reset');




    //Publicaciones
    Route::resource('panel', PublicacionController::class)->names('admin.publicaciones');
    Route::get('panel/dashboard/home', [PublicacionController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('panel/publicaciones/{id}', [PublicacionController::class, 'colaborador'])->name('admin.create.colaborador');
  

    //Solicitudes
    Route::get('panel/peticiones/all', [SolicitudesController::class, 'peticiones'])->name('admin.peticiones');
    Route::delete('panel/peticiones/{id}', [SolicitudesController::class, 'destroy_peticiones'])->name('admin.peticiones.destroy');
    Route::delete('panel/peticiones/delete/all', [SolicitudesController::class, 'peticiones_destroy_all'])->name('admin.peticiones.destroy.all');
    
    Route::get('panel/reportes/all', [SolicitudesController::class, 'reportes'])->name('admin.reportes');
    Route::delete('panel/reportes/{id}', [SolicitudesController::class, 'destroyReportes'])->name('admin.reportes.destroy');
    Route::delete('panel/reportes/delete/all', [SolicitudesController::class, 'reporte_destroy_all'])->name('admin.reportes.destroy.all');
    
    Route::get('panel/contacto/all', [SolicitudesController::class, 'contacto'])->name('admin.contacto');
    Route::delete('panel/contacto/{id}', [SolicitudesController::class, 'destroy_contacto'])->name('admin.contactos.destroy');
    Route::delete('panel/contacto/delete/todos', [SolicitudesController::class, 'contacto_destroy_all'])->name('admin.contactos.destroy.all');




    //Etiquetas General
    Route::get('panel/etiqueta/admin', [EtiquetaController::class, 'etiqueta'])->name('admin.etiquetas');
    Route::post('panel/store2', [EtiquetaController::class, 'store'])->name('admin.etiquetas.store');
    //Autor
    Route::get('panel/edit_autor/{id}', [EtiquetaController::class, 'edit_autor'])->name('admin.edit.autor');
    Route::put('panel/edit_autor/{id}', [EtiquetaController::class, 'update_autor'])->name('admin.update.autor');
    //Genero
    Route::get('panel/edit_genero/{id}', [EtiquetaController::class, 'edit_genero'])->name('admin.edit.genero');
    Route::put('panel/edit_genero/{id}', [EtiquetaController::class, 'update_genero'])->name('admin.update.genero');
    //Year
    Route::get('panel/edit_year/{id}', [EtiquetaController::class, 'edit_year'])->name('admin.edit.year');
    Route::put('panel/edit_year/{id}', [EtiquetaController::class, 'update_year'])->name('admin.update.year');
    //Calificacion
    Route::get('panel/edit_calificacion/{id}', [EtiquetaController::class, 'edit_calificacion'])->name('admin.edit.calificacion');
    Route::put('panel/edit_calificacion/{id}', [EtiquetaController::class, 'update_calificacion'])->name('admin.update.calificacion');
    



    //Recomendados
    Route::get('panel/recomendado/all', [RecomendadoController::class, 'index'])->name('admin.clasificado');
    Route::post('panel/store', [RecomendadoController::class, 'store'])->name('admin.clasificado.store');
    Route::delete('panel/clasificado/{id}', [RecomendadoController::class, 'destroy'])->name('admin.recomendado.destroy');
    Route::delete('panel/clasificado/{id}/nuevo', [RecomendadoController::class, 'destroy_nuevo'])->name('admin.nuevo.destroy');

    //Sagas
    Route::resource('panel/sagas/admin', SagaController::class)->names('admin.sagas');
    Route::post('panel/sagas/edit/add/{id}', [SagaController::class, 'sagas_audio_add'])->name('admin.edit.sagas.add');
    Route::delete('panel/sagas/{saga}/eliminar', [SagaController::class, 'sagas_audio_destroy'])->name('admin.destroy.sagas.audio');
    

    //Top
    Route::resource('panel/top/admin', TopController::class)->names('admin.top');
    Route::delete('panel/top/delete/all', [TopController::class, 'top_destroy_all'])->name('admin.destroy.top.all');
    

    //Mmembresa
    Route::resource('panel/membresia/admin', MembresiaController::class)->names('admin.membresia');

    //Publicidad
    Route::resource('panel/publicidad/admin', PublicidadController::class)->names('admin.publicidad');
    
    //Ajustes
    Route::get('panel/admin/ajustes/', [AjustesController::class, 'index'])->name('admin.ajustes');
    Route::post('panel/admin/ajustes/store', [AjustesController::class, 'store'])->name('admin.ajustes.store');
    Route::get('panel/admin/ajustes/', [AjustesController::class, 'index'])->name('admin.ajustes');
    Route::delete('panel/admin/ajustes/{ajuste}', [AjustesController::class, 'destroy'])->name('admin.ajustes.destroy');
    Route::put('panel/admin/ajustes/{ajuste}', [AjustesController::class, 'update'])->name('admin.ajustes.update');



    //Roles y usuarioa
    Route::resource('admin/roles', RoleController::class)->names('admin.roles');
    Route::resource('admin/users', UserController::class)->names('admin.users');


});

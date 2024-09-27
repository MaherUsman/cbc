<?php


use App\Http\Controllers\AboutController;
use App\Http\Controllers\AboutUsChildGalleryController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AboutUsGalleryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnimalCategoryController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AnimalGalleryController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ChunkUploadController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\IntroController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TopasChildGalleryController;
use App\Http\Controllers\TopasGalleryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitorChildGalleryController;
use App\Http\Controllers\VisitorGalleryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Frontend\HomeController;

//Route::get('/', function () {return view('welcome');});

Route::prefix('admin')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::view('login', 'auth.login')->name('adminLogin');
        Route::post('login', [AuthenticationController::class, 'login'])->name('login');
    });

    Route::middleware(['adminAuth'])->group(function () {
        Route::get('logout', [AuthenticationController::class, 'logout_web'])->name('logout');

        Route::get('dashboard', [AdminController::class, 'dash'])->name('admin.dashboard');
        Route::get('profile',  [AdminController::class, 'edit'])->name('admin.profile');
        Route::post('profile',  [AdminController::class, 'update'])->name('admin.profile.update');

        Route::get('career-listing',  [AdminController::class, 'career_application'])->name('admin.career-listing');


        Route::get('settings',  [AdminController::class, 'setting'])->name('admin.settings');
        Route::post('update-setting',  [AdminController::class, 'update_setting'])->name('admin.settings.update');

        Route::resource('user',UserController::class);
        Route::resource('animal-categories',AnimalCategoryController::class);
        Route::resource('blogs', BlogController::class);
        Route::resource('teams', TeamController::class);
        Route::resource('contact-us', ContactUsController::class);
        Route::resource('sliders', SliderController::class);
        Route::get('reorder-sliders', [SliderController::class, 'gridView'])->name('sliders.gridView');
        Route::post('update-sliders-order', [SliderController::class, 'updateOrder'])->name('sliders.updateOrder');
        Route::resource('intros', IntroController::class);
        Route::get('intro', [IntroController::class, 'createOrEdit'])->name('intros.COE');
        Route::resource('abouts', AboutController::class);
        Route::get('reorder-abouts', [AboutController::class, 'gridView'])->name('abouts.gridView');
        Route::post('update-abouts-order', [AboutController::class, 'updateOrder'])->name('abouts.updateOrder');
        Route::resource('about-uses', AboutUsController::class);
        Route::get('about-us', [AboutUsController::class, 'createOrEdit'])->name('about-uses.COE');

        Route::resource('topas-galleries', TopasGalleryController::class);
        Route::get('topas-child-galleries/{topasGallery}', [TopasChildGalleryController::class, 'index'])->name('topasChildGalleries');
        Route::resource('topas-child-galleries', TopasChildGalleryController::class);

        Route::resource('visitor-galleries', VisitorGalleryController::class);
        Route::get('visitor-child-galleries/{visitorGallery}', [VisitorChildGalleryController::class, 'index'])->name('visitorChildGalleries');
        Route::resource('visitor-child-galleries', VisitorChildGalleryController::class);

        Route::resource('about-us-galleries', AboutUsGalleryController::class);
        Route::get('get-about-us-gallery/{aboutUsGallery}', [AboutUsGalleryController::class, 'getData']);

        Route::get('about-us-child-galleries/{aboutUsGallery}', [AboutUsChildGalleryController::class, 'index'])->name('aboutUsChildGalleries');
        Route::resource('about-us-child-galleries', AboutUsChildGalleryController::class);

        Route::resource('animals', AnimalController::class);
        Route::get('reorder-animals', [AnimalController::class, 'gridView'])->name('animals.gridView');
        Route::post('update-animals-order', [AnimalController::class, 'updateOrder'])->name('animals.updateOrder');
        Route::controller(AnimalGalleryController::class)->group(function () {
            Route::get('/animal-galleries/{animal}', 'index')->name('animal-galleries.index');
            Route::get('/animal-galleries/create/{animal}', 'create')->name('animal-galleries.create');
            Route::post('/animal-galleries/{animal}', 'store')->name('animal-galleries.store');
            Route::get('/animal-galleries/{animal_gallery}', 'show')->name('animal-galleries.show');
            Route::get('/animal-galleries/{animal_gallery}/edit', 'edit')->name('animal-galleries.edit');
            Route::put('/animal-galleries/{animal_gallery}', 'update')->name('animal-galleries.update');
            Route::delete('/animal-galleries/{animal_gallery}', 'destroy')->name('animal-galleries.destroy');
            Route::get('/animal-galleries/reorder/{animal}', 'gridView')->name('animal-galleries.gridView');
            //Route::post('/animal-galleries/update-order', 'updateOrder')->name('animal-galleries.updateOrder');
            Route::post('/update-animal-galleries-order', 'updateOrder')->name('animal-galleries.updateOrder');
        });
    });

Route::view('gal','admin/gallery/AboutUsGallery');

});

Route::post('upload-chunk',[ChunkUploadController::class,'uploadImageChunk'])->name('uploadImageChunk');

Route::get('/' , [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'frontend'  , 'as' => 'frontend.'] , function (){

    Route::get('animal/{slug}' , [\App\Http\Controllers\Frontend\AnimalController::class , 'findAnimal'])->name('find.animal');
    Route::get('animals/listing' , [\App\Http\Controllers\Frontend\AnimalController::class , 'listingAnimal'])->name('listing.animal');
    Route::get('about-us' , [HomeController::class , 'aboutUs'])->name('about.us');

    Route::get('contact-us' , [HomeController::class , 'contactUs'])->name('contact.us');
    Route::get('career' , [\App\Http\Controllers\Frontend\CareerController::class , 'careerPage'])->name('career.store');
    Route::post('career/apply' , [\App\Http\Controllers\Frontend\CareerController::class , 'submitApplication'])->name('career.apply');
   Route::get('event/{slug}' , [\App\Http\Controllers\Frontend\EventController::class , 'findEvent'])->name('find.event');
});

//dd(123);
Route::get('{any?}', function () {view('welcome');})->where('any', '.*');


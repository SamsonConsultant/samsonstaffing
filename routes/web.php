<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('optimize:clear');
    $exitCode = Artisan::call('clear-compiled');
    $exitCode = Artisan::call('route:clear');
    return '<h1>Cache facade value cleared</h1>';
});

Route::get('/migrate', function () {
    $exitCode = Artisan::call('migrate');
    return '<h1>migrate success</h1>';
});

Route::get('/migrate-fresh', function () {
    $exitCode = Artisan::call('migrate:fresh');
    return '<h1>migrate success</h1>';
});

Route::get('/seed', function () {
    $exitCode = Artisan::call('db:seed');
    return '<h1>DB Seed success</h1>';
});

Route::get('/call-migration', function() {
    $exitCode = Artisan::call('migrate --path=/database/migrations/2022_08_13_134209_create_contacts_table.php');
    return '<h1>call migration success</h1>';
});

// Route::get('/', function () { return view('welcome'); });
// Route::get('/home', 'HomeController@index')->name('home');

// frontend Routes
Route::group(['as'=>'frontend.', 'namespace'=>'Frontend'], function () {
    Route::get('/', 'FrontendManagerController@index')->name('home');
    Route::get('/page/{id}', 'FrontendManagerController@gePageContent')->name('show.page');
    Route::get('/blogs', 'FrontendManagerController@getBlogs')->name('blogs');
    Route::get('/blog/{id}', 'FrontendManagerController@getBlogContent')->name('show.blog');
    Route::get('/job-listing', 'FrontendManagerController@getJobsContent')->name('jobs');
    Route::get('/job-detail/{id}', 'FrontendManagerController@getJobDetailContent')->name('job.detail');
    Route::post('/store/contact-form', 'FrontendManagerController@storeContactForm')->name('contact.form');
    Route::get('/apply-job', 'FrontendManagerController@getApplyJob')->name('apply.job');
});

Route::group(['prefix' => 'admin', 'namespace'=>'Admin'], function () {
    Route::get('login', 'AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('signin', 'AdminLoginController@login')->name('admin.login.submit');
    Route::post('logout', 'AdminLoginController@logout')->name('admin.logout');
});

Auth::routes();

Route::post('ckeditor/upload', 'CKEditorController@upload')->name('ckeditor.image-upload');

Route::group(['as'=>'admin.','prefix' => 'admin','namespace'=>'Admin'], function () {
    Route::get('dashboard', 'AdminDashboardController@index')->name('dashboard');

    // Permissions...
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles...
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users...
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');
    Route::get('user/activate/{id}', 'AdminDashboardController@getUserActive')->name('users.active');
    Route::get('user/deactivate/{id}', 'AdminDashboardController@getUserInactive')->name('users.inactive');

    // Categories...
    Route::delete('categories/destroy', 'CategoriesController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoriesController');

    // // Companies...
    // Route::post('companies/media', 'CompaniesController@storeMedia')->name('companies.storeMedia');
    Route::delete('companies/destroy', 'CompaniesController@massDestroy')->name('companies.massDestroy');
    Route::resource('companies', 'CompaniesController');

    // Projects...
    Route::delete('projects/destroy', 'ProjectController@massDestroy')->name('projects.massDestroy');
    Route::resource('projects', 'ProjectController');

    // Contacts...
    Route::delete('contacts/destroy', 'ContactController@massDestroy')->name('contacts.massDestroy');
    Route::resource('contacts', 'ContactController');

    // // Locations...
    Route::delete('locations/destroy', 'LocationsController@massDestroy')->name('locations.massDestroy');
    Route::get('manage-locations/{id?}', 'LocationsController@index')->name('manage.locations');
    Route::post('store/location', 'LocationsController@storeLocationData')->name('store.location');
    Route::get('destroy/location/{id}', 'LocationsController@destroy')->name('location.destroy');


    // Jobs...
    Route::delete('jobs/destroy', 'JobsController@massDestroy')->name('jobs.massDestroy');
    Route::resource('jobs', 'JobsController');

    Route::get('settings', 'AdminDashboardController@settingsContent')->name('setting');
    Route::post('store/settings', 'AdminDashboardController@storeSettings')->name('store.setting');

    # pages..
    Route::get('page-lists', 'OtherContentController@pageList')->name('pages');
    Route::get('page-create', 'OtherContentController@pageCreate')->name('page.create');
    Route::post('page-store', 'OtherContentController@pageStore')->name('page.store');
    Route::get('/{id}/page-edit', 'OtherContentController@pageEdit')->name('page.edit');
    Route::get('page-delete/{id}', 'OtherContentController@pageDelete')->name('page.delete');

    # review... 06-sep-22
    Route::get('manage-review/{id?}', 'OtherContentController@manageReviewContent')->name('manage.review');
    Route::get('add-review', 'OtherContentController@addReviewContent')->name('add.review');
    Route::post('store/review', 'OtherContentController@storeReview')->name('store.review');

    Route::get('delete/{id}', 'AdminDashboardController@destroy')->name('destroy');    
    Route::get('home-setting', 'AdminDashboardController@settingsContent')->name('home.setting');

    #.. master data routes...
    Route::get('manage-experience/{id?}', 'OtherContentController@manageExperienceContent')->name('manage.experience');
    Route::get('manage-roles/{id?}', 'OtherContentController@manageRolesContent')->name('manage.roles');
    Route::get('manage-candidate/{id?}', 'OtherContentController@manageCandidateContent')->name('manage.candidate');
    Route::get('manage-education/{id?}', 'OtherContentController@manageEducationContent')->name('manage.education');
    Route::get('manage-industry/{id?}', 'OtherContentController@manageIndustryContent')->name('manage.industry');
    Route::get('manage-area/{id?}', 'OtherContentController@manageAreaContent')->name('manage.area');
    Route::get('manage-employment/{id?}', 'OtherContentController@manageEmploymentContent')->name('manage.employment');
    Route::get('manage-category/{id?}', 'OtherContentController@manageCategoryContent')->name('manage.category');
    Route::get('manage-skills/{id?}', 'OtherContentController@manageKeySkillContent')->name('manage.skills');

    # store master data..
    Route::post('store/data', 'OtherContentController@storeMasterData')->name('store.data');

    # 13-sep-22 blog
    Route::resource('blogs', 'BlogController');    

    # menu routes..
    Route::get('menus', 'AdminDashboardController@setMenuContent')->name('menus');
    Route::get('edit/{id?}/menus', 'AdminDashboardController@setMenuContent')->name('menu.edit');
    Route::get('delete/{id?}', 'AdminDashboardController@deleteMenuContent')->name('menu.delete');
    Route::post('store/menu', 'AdminDashboardController@storeMenu')->name('store.menu');
    Route::post('store/sub-menu', 'AdminDashboardController@storeSubMenu')->name('store.sub.menu');

    #.. project id...
    Route::post('get/project', 'AdminDashboardController@getProject')->name('project');

    # get the state list based on the country id...
    Route::get('country/state', 'AdminDashboardController@getStateByCountryId')->name('country.state');
    
    # manage account type...
    Route::get('manage-account-type/{id?}', 'OtherContentController@manageAccountTypeContent')->name('manage.account.type');

    # manage contact form...
    Route::get('contact-form', 'AdminDashboardController@manageContactForm')->name('manage.contact.form');

    #...job management
    Route::get('job-management', 'AdminDashboardController@jobManageMentContent')->name('job.manage');
    Route::get('project-view/{job_id}/{project_id}', 'AdminDashboardController@getProjectView')->name('project.view');

    Route::post('store/user/profile', 'OtherContentController@storeUserProfile')->name('store.profile');
    Route::get('change/job/status/{job_id}/{status_id}/{user_id}', 'OtherContentController@changeJobStatus')->name('job.status');

    Route::post('store/bulk/mail', 'OtherContentController@sendBulkMail')->name('send.bulk.mail');
    Route::post('store/interview', 'OtherContentController@setInterView')->name('store.interview');

    Route::get('change/interview/status/{job_id}/{status_id}/{user_id}', 'OtherContentController@changeInterviewStatus')->name('interview.status');

    Route::post('store/selection', 'OtherContentController@storeOfferLetter')->name('store.letter');

    # get the contact based on the account
    Route::post('get/contact', 'AdminDashboardController@getContact')->name('contact.list');

    #job stage...
    Route::get('job/stage/one', 'AdminDashboardController@getJobStageContent')->name('job.stage.one');
    Route::get('job/stage/two', 'AdminDashboardController@getJobStageContent')->name('job.stage.two');
    Route::get('job/stage/three', 'AdminDashboardController@getJobStageContent')->name('job.stage.three');
    Route::get('job/stage/four', 'AdminDashboardController@getJobStageContent')->name('job.stage.four');
    Route::get('job/stage/five', 'AdminDashboardController@getJobStageContent')->name('job.stage.five');
    Route::get('job/stage/six', 'AdminDashboardController@getJobStageContent')->name('job.stage.six');
    Route::get('job/stage/seven', 'AdminDashboardController@getJobStageContent')->name('job.stage.seven');
    Route::get('job/stage/eight', 'AdminDashboardController@getJobStageContent')->name('job.stage.eight');

    # create a user form contact...
    Route::get('create/user/{id}', 'OtherContentController@storeUserFromContact')->name('create.user');
    Route::get('search/cv', 'AdminDashboardController@getSearchCv')->name('search.cv');
});

# employer routes..
Route::group(['as'=>'employer.','prefix' => 'employer','namespace'=>'Employer', 'middleware' => ['auth', 'employer']], function () {
    Route::get('dashboard', 'EmployerController@index')->name('dashboard');
    Route::post('password/change', 'EmployerController@passwordUpdate')->name('password.update');

    // company routes...
    Route::get('companies/index', 'ContentViewController@companyIndex')->name('companies.index');
    Route::get('companies/add-edit/{id?}', 'ContentViewController@companyCreate')->name('companies.create');
    Route::get('companies/show/{id?}', 'ContentViewController@companyShow')->name('companies.show');

    Route::post('companies/store', 'ContentStoreController@companyStore')->name('companies.store');
    Route::get('companies/destroy/{id}', 'ContentStoreController@companyDestroy')->name('companies.destroy');

    // contact routes...
    Route::get('contacts/index', 'ContentViewController@contactsIndex')->name('contacts.index');
    Route::get('contacts/add-edit/{id?}', 'ContentViewController@contactsCreate')->name('contacts.create');
    Route::get('contacts/show/{id?}', 'ContentViewController@contactsShow')->name('contacts.show');

    Route::post('contacts/store', 'ContentStoreController@contactsStore')->name('contacts.store');
    Route::get('contacts/destroy/{id}', 'ContentStoreController@contactsDestroy')->name('contacts.destroy');

    // project routes
    Route::get('projects/index', 'ContentViewController@projectsIndex')->name('projects.index');
    Route::get('projects/add-edit/{id?}', 'ContentViewController@projectsCreate')->name('projects.create');
    Route::get('projects/show/{id?}', 'ContentViewController@projectsShow')->name('projects.show');

    Route::post('projects/store', 'ContentStoreController@projectsStore')->name('projects.store');
    Route::get('projects/destroy/{id}', 'ContentStoreController@projectsDestroy')->name('projects.destroy');

    // jobs routes...
    Route::get('jobs/index', 'ContentViewController@jobsIndex')->name('jobs.index');
    Route::get('jobs/add-edit/{id?}', 'ContentViewController@jobsCreate')->name('jobs.create');
    Route::get('jobs/show/{id?}', 'ContentViewController@jobsShow')->name('jobs.show');

    Route::post('jobs/store', 'ContentStoreController@jobsStore')->name('jobs.store');
    Route::get('jobs/destroy/{id}', 'ContentStoreController@jobsDestroy')->name('jobs.destroy');

    #...job management
    Route::get('job-management', 'ContentViewController@jobManageMentContent')->name('job.manage');
    Route::get('project-view/{job_id}/{project_id}', 'ContentViewController@getProjectView')->name('project.view');

    #job stage...
    Route::get('job/stage/two', 'ContentViewController@getJobStageContent')->name('job.stage.two');
    Route::get('job/stage/three', 'ContentViewController@getJobStageContent')->name('job.stage.three');
    Route::get('job/stage/four', 'ContentViewController@getJobStageContent')->name('job.stage.four');
    Route::get('job/stage/seven', 'ContentViewController@getJobStageContent')->name('job.stage.seven');
});

# user routes...
Route::group(['as'=>'user.','prefix' => 'user','namespace'=>'User', 'middleware' => ['auth', 'user']], function () {
    Route::get('dashboard', 'UserDashboardController@index')->name('dashboard');
    Route::get('password-change', 'UserDashboardController@getPassword')->name('password');
    Route::get('profile', 'UserDashboardController@getProfile')->name('profile');
    Route::get('job-listing', 'UserDashboardController@getJobs')->name('jobs');
    Route::post('store/profile', 'UserDashboardController@storeProfile')->name('store.profile');
    Route::post('apply/job', 'UserDashboardController@applyJob')->name('apply.job');
    Route::get('country/state', 'UserDashboardController@getStateByCountryId')->name('country.state');
    Route::get('delete/experience/{id}', 'UserDashboardController@destroyExperience')->name('dlt.exp');
    Route::get('delete/education/{id}', 'UserDashboardController@destroyEducation')->name('dlt.edu');

});

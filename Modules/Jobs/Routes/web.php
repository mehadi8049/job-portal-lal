<?php

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
Route::get('jobs/{q?}', 'JobsController@getJobsList')->name('jobslist');

Route::get('job/{slug}', 'JobsController@getJobDetail')->name('job');

Route::get('companies/{q?}', 'CompaniesController@getCompanies')->name('companies');

Route::get('company-detail/{slug?}', 'CompaniesController@getCompanyDetail')->name('company');

// public
Route::group(['prefix' => 'company', 'as' => 'company.'], function(){
	Route::post('apply', 'EmployerApplicantsController@apply')->name('apply');
});

Route::middleware('auth')->group(function () {
	// actions jobs
	Route::middleware('can:employer')->group(function () {
		
		Route::group(['prefix' => 'company', 'as' => 'company.'], function(){

			Route::get('dashboard', 'EmployerController@dashboard')->name('dashboard');
			Route::get('profile', 'EmployerController@companyProfile')->name('profile');
			Route::post('update-profile', 'EmployerController@updateCompanyProfile')->name('update-profile');
			
			// companies
			Route::resource('companies', 'CompaniesController')->except('show');
			// jobs
			Route::resource('jobs', 'EmployerJobsController')->except('show');
			// applicants
			Route::resource('applicants', 'EmployerApplicantsController')->except('show');

			if (Module::find('Saas')) {

				Route::group(['middleware' => 'Modules\Saas\Http\Middleware\Billing'], function(){
				    Route::resource('jobs', 'EmployerJobsController', ['only' => ['create','store','update']]);
				    Route::post('update-profile', 'EmployerController@updateCompanyProfile')->name('update-profile');
				});
			}
			
		});	
	});

	
	Route::middleware('can:admin')->prefix('settings')->name('settings.')->group(function () {
		// attributes
		Route::group(['prefix' => 'job-attributes', 'as' => 'job.attributes.'], function(){

			// language_levels
			Route::group(['prefix' => 'language_levels', 'as' => 'language_levels.'], function(){
				Route::get('', 'LanguageLevelsController@index')->name('index');
				Route::get('create', 'LanguageLevelsController@create')->name('create');
				Route::post('', 'LanguageLevelsController@store')->name('store');
				Route::get('{id}', 'LanguageLevelsController@edit')->name('edit');
				Route::put('{id}', 'LanguageLevelsController@update')->name('update');
				Route::delete('{id}', 'LanguageLevelsController@destroy')->name('destroy');
			});
			// career_levels
			Route::group(['prefix' => 'career_levels', 'as' => 'career_levels.'], function(){
				Route::get('', 'CareerLevelsController@index')->name('index');
				Route::get('create', 'CareerLevelsController@create')->name('create');
				Route::post('', 'CareerLevelsController@store')->name('store');
				Route::get('{id}', 'CareerLevelsController@edit')->name('edit');
				Route::put('{id}', 'CareerLevelsController@update')->name('update');
				Route::delete('{id}', 'CareerLevelsController@destroy')->name('destroy');
			});
			// functional_areas
			Route::group(['prefix' => 'functional_areas', 'as' => 'functional_areas.'], function(){
				Route::get('', 'FunctionalAreasController@index')->name('index');
				Route::get('create', 'FunctionalAreasController@create')->name('create');
				Route::post('', 'FunctionalAreasController@store')->name('store');
				Route::get('{id}', 'FunctionalAreasController@edit')->name('edit');
				Route::put('{id}', 'FunctionalAreasController@update')->name('update');
				Route::delete('{id}', 'FunctionalAreasController@destroy')->name('destroy');
			});
			// genders
			Route::group(['prefix' => 'genders', 'as' => 'genders.'], function(){
				Route::get('', 'GendersController@index')->name('index');
				Route::get('create', 'GendersController@create')->name('create');
				Route::post('', 'GendersController@store')->name('store');
				Route::get('{id}', 'GendersController@edit')->name('edit');
				Route::put('{id}', 'GendersController@update')->name('update');
				Route::delete('{id}', 'GendersController@destroy')->name('destroy');
			});
			// industries
			Route::group(['prefix' => 'industries', 'as' => 'industries.'], function(){
				Route::get('', 'IndustriesController@index')->name('index');
				Route::get('create', 'IndustriesController@create')->name('create');
				Route::post('', 'IndustriesController@store')->name('store');
				Route::get('{id}', 'IndustriesController@edit')->name('edit');
				Route::put('{id}', 'IndustriesController@update')->name('update');
				Route::delete('{id}', 'IndustriesController@destroy')->name('destroy');
			});
			// job_experiences
			Route::group(['prefix' => 'job_experiences', 'as' => 'job_experiences.'], function(){
				Route::get('', 'JobExperiencesController@index')->name('index');
				Route::get('create', 'JobExperiencesController@create')->name('create');
				Route::post('', 'JobExperiencesController@store')->name('store');
				Route::get('{id}', 'JobExperiencesController@edit')->name('edit');
				Route::put('{id}', 'JobExperiencesController@update')->name('update');
				Route::delete('{id}', 'JobExperiencesController@destroy')->name('destroy');
			});
			// job_skills
			Route::group(['prefix' => 'job_skills', 'as' => 'job_skills.'], function(){
				Route::get('', 'JobSkillsController@index')->name('index');
				Route::get('create', 'JobSkillsController@create')->name('create');
				Route::post('', 'JobSkillsController@store')->name('store');
				Route::get('{id}', 'JobSkillsController@edit')->name('edit');
				Route::put('{id}', 'JobSkillsController@update')->name('update');
				Route::delete('{id}', 'JobSkillsController@destroy')->name('destroy');
			});
			// job_types
			Route::group(['prefix' => 'job_types', 'as' => 'job_types.'], function(){
				Route::get('', 'JobTypesController@index')->name('index');
				Route::get('create', 'JobTypesController@create')->name('create');
				Route::post('', 'JobTypesController@store')->name('store');
				Route::get('{id}', 'JobTypesController@edit')->name('edit');
				Route::put('{id}', 'JobTypesController@update')->name('update');
				Route::delete('{id}', 'JobTypesController@destroy')->name('destroy');
			});
			// job_shifts
			Route::group(['prefix' => 'job_shifts', 'as' => 'job_shifts.'], function(){
				Route::get('', 'JobShiftsController@index')->name('index');
				Route::get('create', 'JobShiftsController@create')->name('create');
				Route::post('', 'JobShiftsController@store')->name('store');
				Route::get('{id}', 'JobShiftsController@edit')->name('edit');
				Route::put('{id}', 'JobShiftsController@update')->name('update');
				Route::delete('{id}', 'JobShiftsController@destroy')->name('destroy');
			});
			// degree_levels
			Route::group(['prefix' => 'degree_levels', 'as' => 'degree_levels.'], function(){
				Route::get('', 'DegreeLevelsController@index')->name('index');
				Route::get('create', 'DegreeLevelsController@create')->name('create');
				Route::post('', 'DegreeLevelsController@store')->name('store');
				Route::get('{id}', 'DegreeLevelsController@edit')->name('edit');
				Route::put('{id}', 'DegreeLevelsController@update')->name('update');
				Route::delete('{id}', 'DegreeLevelsController@destroy')->name('destroy');
			});
			// degree_types
			Route::group(['prefix' => 'degree_types', 'as' => 'degree_types.'], function(){
				Route::get('', 'DegreeTypesController@index')->name('index');
				Route::get('create', 'DegreeTypesController@create')->name('create');
				Route::post('', 'DegreeTypesController@store')->name('store');
				Route::get('{id}', 'DegreeTypesController@edit')->name('edit');
				Route::put('{id}', 'DegreeTypesController@update')->name('update');
				Route::delete('{id}', 'DegreeTypesController@destroy')->name('destroy');
			});
			// major_subjects
			Route::group(['prefix' => 'major_subjects', 'as' => 'major_subjects.'], function(){
				Route::get('', 'MajorSubjectsController@index')->name('index');
				Route::get('create', 'MajorSubjectsController@create')->name('create');
				Route::post('', 'MajorSubjectsController@store')->name('store');
				Route::get('{id}', 'MajorSubjectsController@edit')->name('edit');
				Route::put('{id}', 'MajorSubjectsController@update')->name('update');
				Route::delete('{id}', 'MajorSubjectsController@destroy')->name('destroy');
			});
			// result_types
			Route::group(['prefix' => 'result_types', 'as' => 'result_types.'], function(){
				Route::get('', 'ResultTypesController@index')->name('index');
				Route::get('create', 'ResultTypesController@create')->name('create');
				Route::post('', 'ResultTypesController@store')->name('store');
				Route::get('{id}', 'ResultTypesController@edit')->name('edit');
				Route::put('{id}', 'ResultTypesController@update')->name('update');
				Route::delete('{id}', 'ResultTypesController@destroy')->name('destroy');
			});
			// marital_statuses
			Route::group(['prefix' => 'marital_statuses', 'as' => 'marital_statuses.'], function(){
				Route::get('', 'MaritalStatusesController@index')->name('index');
				Route::get('create', 'MaritalStatusesController@create')->name('create');
				Route::post('', 'MaritalStatusesController@store')->name('store');
				Route::get('{id}', 'MaritalStatusesController@edit')->name('edit');
				Route::put('{id}', 'MaritalStatusesController@update')->name('update');
				Route::delete('{id}', 'MaritalStatusesController@destroy')->name('destroy');
			});
			// ownership_types
			Route::group(['prefix' => 'ownership_types', 'as' => 'ownership_types.'], function(){
				Route::get('', 'OwnershipTypesController@index')->name('index');
				Route::get('create', 'OwnershipTypesController@create')->name('create');
				Route::post('', 'OwnershipTypesController@store')->name('store');
				Route::get('{id}', 'OwnershipTypesController@edit')->name('edit');
				Route::put('{id}', 'OwnershipTypesController@update')->name('update');
				Route::delete('{id}', 'OwnershipTypesController@destroy')->name('destroy');
			});
			// salary_periods
			Route::group(['prefix' => 'salary_periods', 'as' => 'salary_periods.'], function(){
				Route::get('', 'SalaryPeriodsController@index')->name('index');
				Route::get('create', 'SalaryPeriodsController@create')->name('create');
				Route::post('', 'SalaryPeriodsController@store')->name('store');
				Route::get('{id}', 'SalaryPeriodsController@edit')->name('edit');
				Route::put('{id}', 'SalaryPeriodsController@update')->name('update');
				Route::delete('{id}', 'SalaryPeriodsController@destroy')->name('destroy');
			});

		});
	
		// companies
		Route::resource('companies', 'CompaniesController')->except('show');

		Route::resource('jobs', 'JobsController')->except('show');

		// applicants
		Route::group(['prefix' => 'jobs/applicants', 'as' => 'jobs.applicants.'], function() {
			Route::get('', 'ApplicantsController@index')->name('index');
			Route::delete('{id}', 'ApplicantsController@destroy')->name('destroy');
		});
	});
});
		

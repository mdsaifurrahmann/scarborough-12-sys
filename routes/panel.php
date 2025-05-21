<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProductColorController;
use App\Http\Controllers\ProductsCategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductSizeController;
use App\Http\Controllers\ProductSizeGuideController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WebsiteInformationController;

Route::prefix('panel')->middleware('auth')->group(function () {
    Route::get('dashboard', [Dashboard::class, 'index'])->name('dashboard');

   

// users & customers
    Route::prefix('users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('users.index');
        Route::post('store', [UsersController::class, 'store'])->name('users.store');
        Route::delete('delete', [UsersController::class, 'destroy'])->name('users.delete');
        Route::get('edit/{email}', [UsersController::class, 'edit'])->name('users.edit');
        Route::patch('update', [UsersController::class, 'update'])->name('users.update');
    });

// Frontend Pages Content
    Route::prefix('pages')->group(function () {

// Policies
        Route::get('policies', [PolicyController::class, 'index'])->name('policies.index');
        Route::patch('privacy', [PolicyController::class, 'privacy'])->name('policies.privacy');
        Route::patch('refund', [PolicyController::class, 'refund'])->name('policies.refund');

// Terms
        Route::get('tos', [PolicyController::class, 'tos'])->name('tos.index');
        Route::patch('tos/update', [PolicyController::class, 'tosUpdate'])->name('tos.update');

// Website Information
        Route::get('info-settings', [WebsiteInformationController::class, 'index'])->name('info.index');
        Route::put('basic-info/update', [WebsiteInformationController::class, 'basicInfo'])->name('basic.info.update');
        Route::put('social-media/update', [WebsiteInformationController::class, 'socialMedia'])->name('social.media.update');
        Route::put('seo-info/update', [WebsiteInformationController::class, 'seo'])->name('seo.info.update');
        Route::put('code-injector/update', [WebsiteInformationController::class, 'injector'])->name('injector.update');
    });


// group post
    Route::get('groups', [RolesController::class, 'groupsIndex'])->name('groups.index');
    Route::post('group/store', [RolesController::class, 'groupStore'])->name('group.store');
    Route::patch('group/update/{id}', [RolesController::class, 'groupUpdate'])->name('group.update');
    Route::delete('group/delete', [RolesController::class, 'groupDelete'])->name('group.delete');

// permission post
    Route::get('permissions', [RolesController::class, 'permissionsIndex'])->name('permissions.index');
    Route::post('permission/store', [RolesController::class, 'permissionStore'])->name('permission.store');
    Route::patch('permission/update', [RolesController::class, 'permissionUpdate'])->name('permission.update');
    Route::delete('permission/delete', [RolesController::class, 'permissionDelete'])->name('permission.delete');

// role post
    Route::get('roles', [RolesController::class, 'rolesIndex'])->name('roles.index');
    Route::get('role/create', [RolesController::class, 'roleCreate'])->name('role.create');
    Route::post('role/store', [RolesController::class, 'roleStore'])->name('role.store');
    Route::get('role/edit/{name}', [RolesController::class, 'roleEdit'])->name('role.edit');
    Route::patch('role/update', [RolesController::class, 'roleUpdate'])->name('role.update');
    Route::delete('role/delete', [RolesController::class, 'roleDelete'])->name('role.delete');
});

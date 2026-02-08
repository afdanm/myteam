<?php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});


// **************************** USER ***************************

// Home > User
Breadcrumbs::for('user.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('User', route('user.index'));
});

// Home > User > [Update]
Breadcrumbs::for('user.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('user.index');
    $trail->push('Update [' . $user->name . ']', route('user.edit', $user));
});

// Home > User > Create
Breadcrumbs::for('user.create', function (BreadcrumbTrail $trail) {
    $trail->parent('user.index');
    $trail->push('Create', route('user.create'));
});

// Home > User > Permission
// Breadcrumbs::for('user.show', function (BreadcrumbTrail $trail, $user) {
//     $trail->parent('user.index');
//     $trail->push('User Permission', route('user.show', $user));
// });

// Home > User > Permission
Breadcrumbs::for('user.role', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('user.index');
    $trail->push('User Roles [' . $user->name . ']', route('user.role', $user));
});

// **************************** END USER ***************************


// **************************** ROLE ***************************

// Home > Role
Breadcrumbs::for('role.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Role', route('role.index'));
});

// Home > Role > [Update]
Breadcrumbs::for('role.edit', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('role.index');
    $trail->push('Update [' . $role->name . ']', route('role.edit', $role));
});

// Home > Role > Create
Breadcrumbs::for('role.create', function (BreadcrumbTrail $trail) {
    $trail->parent('role.index');
    $trail->push('Create', route('role.create'));
});

// Home > Role > Permission
Breadcrumbs::for('role.show', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('role.index');
    $trail->push('Role Permission', route('role.show', $role));
});

// **************************** END ROLE ***************************


// **************************** PERMISSION ***************************

// Home > Permission
Breadcrumbs::for('permission.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Permission', route('permission.index'));
});

// Home > Permission > [Update]
Breadcrumbs::for('permission.edit', function (BreadcrumbTrail $trail, $permission) {
    $trail->parent('permission.index');
    $trail->push('Update [' . $permission->name . ']', route('permission.edit', $permission));
});

// Home > Permission > Create
Breadcrumbs::for('permission.create', function (BreadcrumbTrail $trail) {
    $trail->parent('permission.index');
    $trail->push('Create', route('permission.create'));
});

// **************************** END PERMISSION ***************************


// **************************** PERMISSION GROUP ***************************

// Home > Permission Group
Breadcrumbs::for('permissiongroup.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Permission Group', route('permissiongroup.index'));
});

// Home > Permission Group > [Update]
Breadcrumbs::for('permissiongroup.edit', function (BreadcrumbTrail $trail, $permissiongroup) {
    $trail->parent('permissiongroup.index');
    $trail->push('Update [' . $permissiongroup->name . ']', route('permissiongroup.edit', $permissiongroup));
});

// Home > Permission Group > Create
Breadcrumbs::for('permissiongroup.create', function (BreadcrumbTrail $trail) {
    $trail->parent('permissiongroup.index');
    $trail->push('Create', route('permissiongroup.create'));
});

// **************************** END PERMISSION GROUP ***************************


// **************************** MENU ***************************

// Home > Menu
Breadcrumbs::for('menu.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Menu', route('menu.index'));
});

// Home > Menu > [Update]
Breadcrumbs::for('menu.edit', function (BreadcrumbTrail $trail, $menu) {
    $trail->parent('menu.index');
    $trail->push('Update [' . $menu->nama_menu . ']', route('menu.edit', $menu));
});

// Home > Menu > Create
Breadcrumbs::for('menu.create', function (BreadcrumbTrail $trail) {
    $trail->parent('menu.index');
    $trail->push('Create', route('menu.create'));
});

// **************************** END MENU ***************************


// **************************** ARTICLE CATEGORY ***************************

// Home > Article Categories
Breadcrumbs::for('article_categories.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Article Categories', route('article_categories.index'));
});

// Home > Article Categories > [Update]
Breadcrumbs::for('article_categories.edit', function (BreadcrumbTrail $trail, $article_categories) {
    $trail->parent('article_categories.index');
    $trail->push('Update [' . $article_categories->name . ']', route('article_categories.edit', $article_categories));
});

// Home > Article Categories > Create
Breadcrumbs::for('article_categories.create', function (BreadcrumbTrail $trail) {
    $trail->parent('article_categories.index');
    $trail->push('Create', route('article_categories.create'));
});

// **************************** END ARTICLE CATEGORY ***************************


// **************************** ARTICLE ***************************

// Home > Article Categories
Breadcrumbs::for('article.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Article', route('article.index'));
});

// Home > Article Categories > [Update]
Breadcrumbs::for('article.edit', function (BreadcrumbTrail $trail, $article) {
    $trail->parent('article.index');
    $trail->push('Update [' . $article->title . ']', route('article.edit', $article));
});

// Home > Article Categories > Create
Breadcrumbs::for('article.create', function (BreadcrumbTrail $trail) {
    $trail->parent('article.index');
    $trail->push('Create', route('article.create'));
});

// Home > Article Categories > Create
Breadcrumbs::for('article.show', function (BreadcrumbTrail $trail, $article) {
    $trail->parent('article.index');
    $trail->push('Article ' . $article->title, route('article.show', $article));
});

// **************************** END ARTICLE ***************************

// **************************** Pengaturan ***************************

// Home > Pengaturan
Breadcrumbs::for('setting.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Daftar Pengaturan', route('setting.index'));
});

// Home > Pengaturan > Create
Breadcrumbs::for('setting.create', function (BreadcrumbTrail $trail) {
    $trail->parent('setting.index');
    $trail->push('Tambah Pengaturan', route('setting.create'));
});

// Home > Pengaturan > Edit
Breadcrumbs::for('setting.edit', function (BreadcrumbTrail $trail,$setting) {
    $trail->parent('setting.index');
    $trail->push('Edit Pengaturan', route('setting.edit',$setting->id));
});

// **************************** END Pengaturan ***************************

// **************************** BOARD ***************************

// Home > Boards
Breadcrumbs::for('boards.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Boards', route('boards.index'));
});

// Home > Boards > [Update]
Breadcrumbs::for('boards.edit', function (BreadcrumbTrail $trail, $board) {
    $trail->parent('boards.index');
    $trail->push('Update [' . $board->title . ']', route('boards.edit', $board));
});

// Home > Boards > Create
Breadcrumbs::for('boards.create', function (BreadcrumbTrail $trail) {
    $trail->parent('boards.index');
    $trail->push('Create', route('boards.create'));
});

// **************************** END BOARD ***************************
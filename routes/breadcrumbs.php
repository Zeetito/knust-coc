<?php

// routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use App\Models\User;
// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Home > Users
Breadcrumbs::for('view_users', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Users', route('view_users'));
});

// Home > Users > [Profile]
Breadcrumbs::for('profile', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('view_users');
    $trail->push($user->fullname(), route('view_profile', $user));
});

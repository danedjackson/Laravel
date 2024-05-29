<?php
use Illuminate\support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function() {
    return view('jobs', [
        'jobs' => Job::all()
    ]);
});


Route::get('/job/{id}', function ($id) {

    // \Illuminate\Support\Arr::first($jobs, function($job) use ($id) {
    //     return $job['id'] == $id;
    // });
    // $job = Arr::first(Job::all(), fn($j) => $j['id'] == $id);

    $job = Job::find($id);

    return view('job', ['job' => $job]);
});

Route::get('/about', function () {
    return view('about');
});

Route::get('contact', function () {
    return view('contact');
});


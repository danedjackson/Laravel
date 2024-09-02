<?php
use Illuminate\support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function() {
    // Eager loading
    $jobs = Job::with('employer')->get();

    // Lazy Loading
    // $jobs = Job::all();

    if(!$jobs) {
        abort(404);
    }
    return view('jobs', [
        'jobs' => $jobs
    ]);
});


Route::get('/job/{id}', function ($id) {

    // \Illuminate\Support\Arr::first($jobs, function($job) use ($id) {
    //     return $job['id'] == $id;
    // });
    // $job = Arr::first(Job::all(), fn($j) => $j['id'] == $id);

    $job = Job::find($id);

    if(!$job) {
        abort(404);
    }

    return view('job', ['job' => $job]);
});

Route::get('/about', function () {
    return view('about');
});

Route::get('contact', function () {
    return view('contact');
});


<?php
use Illuminate\support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function() {
    // Eager loading
    $jobs = Job::with('employer')->latest()->simplePaginate(5);

    // Lazy Loading
    // $jobs = Job::all();

    if(!$jobs) {
        abort(404);
    }
    return view('jobs/index', [
        'jobs' => $jobs
    ]);
});

Route::get('jobs/create', function() {
    return view('jobs/create');
});

Route::post('/jobs', function() {
    //Validations here
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
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

    return view('jobs/show', ['job' => $job]);
});

Route::get('/about', function () {
    return view('about');
});

Route::get('contact', function () {
    return view('contact');
});


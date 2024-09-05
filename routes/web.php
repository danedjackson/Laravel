<?php
use Illuminate\support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

//Index
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

// Create
Route::get('jobs/create', function() {
    return view('jobs/create');
});

// Store
Route::post('/jobs', function() {
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

// Update
Route::patch('/job/{id}', function($id) {
    // Validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    // Authorize

    // Update the job and persist
    $job = Job::findOrFail($id);

    $job->update([
        'title' => request('title'),
        'salary' => request('salary')
    ]);

    // Redirect to the job page
    return redirect('/job/' . $job->id);
});

// Delete
Route::delete('/job/{id}', function($id) {
    // Authorize

    // Delete the job
    Job::findOrFail($id)->delete();

    // Redirect
    return redirect('/jobs');
});

// Show
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

// Edit
Route::get('/job/{id}/edit', function ($id) {
    $job = Job::find($id);

    if(!$job) {
        abort(404);
    }

    return view('jobs/edit', ['job' => $job]);
});

Route::get('/about', function () {
    return view('about');
});

Route::get('contact', function () {
    return view('contact');
});


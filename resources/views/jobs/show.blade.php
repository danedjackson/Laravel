<x-layout>
    <x-slot:heading>
        Job Details
    </x-slot:heading>
    
    <h2> <strong>{{$job['title']}}</strong> </h2>
    <p>
        This job pays {{ $job['salary'] }} per year.
    </p>
</x-layout>
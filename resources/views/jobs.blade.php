<x-layout>
    <x-slot:heading>
        Jobs Page
    </x-slot:heading>
    
    <ul>
        @foreach($jobs as $job)
            <a href = '/job/{{ $job['id'] }}'>
                <li>
                    <strong>({{ $job['id'] }}) {{ $job['title'] }}</strong>
                </li>
            </a>
        @endforeach
    </ul>
</x-layout>
        '{{ $key }}' => [
            'driver' => 'local',
            'root'   => {{ $function }}( '{{ $path }}' ),
        ],
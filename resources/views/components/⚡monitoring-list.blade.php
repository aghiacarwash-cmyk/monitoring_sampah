<div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Container</th>
                <th>Persen</th>
                <th>Baterai</th>
                <th>Status</th>
                <th>Status System</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Update Terakhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($containers as $container)
                <tr wire:key="container-{{ $container->id }}">
                    <td>{{ $container->kode_containers }}</td>
                    <td>{{ $container->persen }}%</td>
                    <td>{{ $container->baterai }}%</td>
                    <td>{{ $container->status }}</td>
                    <td>
                        <span class="badge {{ $container->status_system === 'Online' ? 'bg-success' : 'bg-secondary' }}">
                            {{ $container->status_system }}
                        </span>
                    </td>
                    <td>{{ $container->latitude }}</td>
                    <td>{{ $container->longitude }}</td>
                    <td>{{ $container->updated_at->diffForHumans() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="card mb-4">
    <div class="card-header bg-secondary text-white">
        💰 Coûts par Niveau et Ressource
    </div>

    <div class="card-body table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
            <tr>
                <th>Niveau</th>
                @foreach ($building->costs->groupBy('resource_id') as $resourceId => $costs)
                    <th>{{ $costs->first()->ressource->trans_key ?? 'Ressource ' . $resourceId }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @php
                $maxLevel = $building->max_level;
                $minLevel = $building->min_level;
                $cost = $building->costs->first();

            @endphp


            @foreach (range($minLevel, $maxLevel) as $level)
                <tr>
                    <td>{{ $level }}</td>
                    @foreach ($building->costs->groupBy('resource_id') as $resourceId => $costs)
                        @php
                            $costValue = $cost->cost * pow($cost->evolution, $level - $building->default_level);
                        @endphp
                        <td>{{ number_format($costValue, 2) }}</td>

                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

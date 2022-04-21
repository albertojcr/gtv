<div class="card">
    <div class="card-header">
        <span class="card-title h4">Ranking de puntos más visitados</span>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id='users-table' class="table text-center">
                <thead class="text-primary">
                <th class="text-center">Posición</th>
                <th>Qr</th>
                </thead>
                <tbody>
                @foreach($pointsOfInterestMostVisits as $pointOfInterest)
                    @if($pointOfInterest != null)
                    <tr>
                        <td class="text-center">{{ $loop->index+1}}</td>
                        <td>
                            <a href="{{ route('admin.pointsofinterest.show',$pointOfInterest) }}">{{ $pointOfInterest->qr }}</a>
                        </td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

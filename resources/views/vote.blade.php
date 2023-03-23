@extends('layouts.index')
@section('body')
    <!-- Modal -->
    @if ($voters->month === $monthVoter)
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header float-right">
                <h5>Congratulations Top Voter in {{ $thisMonth }}🎉🎊</h5>
            </div>
            <div class="modal-body">
                <div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NickName</th>
                                <th scope="col">Total Vote</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 3; $i++)
                                <tr>
                                    <th scope="row">{{ $i + 1 }}</th>
                                    <td>{{ $topVoter[$i]->nickname }}</td>
                                    <td>{{ $topVoter[$i]->vote }}</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
    <br>
    <div class="row">
        <div class="card bg-transparent text-white mb-2">
            <div class="card-header text-white"><h4 class="card-title">Top Voters</h4></div>
                <div class="card-body text-white">
                    <table class="table text-white">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">NickName</th>
                                    <th scope="col">Votes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < 10; $i++)
                                    <tr>
                                        <th scope="row">{{ $i + 1 }}</th>
                                        <td>{{ $voters->voters[$i]->nickname }}</td>
                                        <td>{{ $voters->voters[$i]->votes }}</td>
                                    </tr>
                                @endfor
                            </tbody>
                    </table>
                    <p>Data dari {{ count($voters->voters) }} Players</p>
                    <small>sekarang tanggal {{ date("d/m/Y") }}, pukul {{ date("H:i") }} WIB</small> <br>
                    <a href="{{ env('MC_VOTE_URL') }}"><button class="btn btn-primary mt-3">Vote Now!</button></a>
                </div>
            </div>
        </div>
    </div>

@endsection
@extends('layouts.index')
@section('body')
    <!-- Modal -->
    {{-- kalo tanggal > 5 maka hasilin false --}}
    <div class="modal-dialog">
        <div class="modal-content">
            @if ($showModal)
            <div class="modal-header float-right">
                <h5>Congratulations Top Voter in {{ $monthVoter->format('F') }}🎉🎊</h5>
            </div>
            {{-- @dd($topVoter) --}}
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
                            @foreach ($topVoter as $key => $voter )
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $voter->nickname }}</td>
                                    <td>{{ $voter->vote }}</td>
                                </tr>
                            @endforeach
                            {{-- @for ($i = 0; $i < 3; $i++)
                                <tr>
                                    <th scope="row">{{ $i + 1 }}</th>
                                    <td>{{ $topVoter[$i]->nickname }}</td>
                                    <td>{{ $topVoter[$i]->vote }}</td>
                                </tr>
                            @endfor --}}
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            @if ($issetTopVoter && Auth::user()->isAdmin)
                <div class="modal-header float-right bg-danger">
                    <p>Please migrate top voter, use 'php artisan arlcraft:sync:topvoter'</p>
                </div>
            @endif
        </div>
    </div>
    <br>
    <div class="row">
        <div class="card bg-transparent text-white mb-2">
            <div class="card-header text-white"><h4 class="card-title">Top Ten Voters</h4></div>
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
                                        <td>{{ $voters[$i]['nickname'] }}</td>
                                        <td>{{ $voters[$i]['votes'] }}</td>
                                    </tr>
                                @endfor
                            </tbody>
                    </table>
                    <p>Data dari {{ $countVoters }} Players</p>
                    <small>sekarang tanggal {{ date("d/m/Y") }}, pukul {{ date("H:i") }} WIB</small> <br>
                    <a href="{{ env('MC_VOTE_URL') }}"><button class="btn btn-primary mt-3">Vote Now!</button></a>
                </div>
            </div>
        </div>
    </div>

@endsection
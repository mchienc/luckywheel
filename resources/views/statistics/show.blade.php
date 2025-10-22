@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h1>Chi tiết lượt quay #{{ $statistic->id }}</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Người chơi:</strong> {{ optional($statistic->user)->name ?? 'Khách' }}</p>
            <p><strong>Phần thưởng:</strong> {{ $statistic->result }}</p>
            <p><strong>Thời gian:</strong> {{ $statistic->spin_time }}</p>
            <p><strong>Spin ID:</strong> {{ $statistic->spin_id }}</p>
            <p><strong>ManagerSpin ID:</strong> {{ $statistic->manager_spin_id }}</p>
        </div>
    </div>

</div>
@endsection

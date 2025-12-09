@extends('admin.main')
@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 style="color: white; text-align: center; margin-bottom: 0;">Student Medical Findings</h4>
                </div>
                <div class="card-body">
                    @if(!empty($schoolName))
                        <h5><b>School:</b> <span class="text-dark">{{ $schoolName }}</span></h5>
                    @endif
                    <h5>Name: <span class="text-dark">{{ $student->name }} {{ $student->lname }}</span></h5>
                    <h6>Phone: <span class="text-dark">{{ $student->phone }}</span></h6>
                    <hr>
                    <h5>Medical Issues:</h5>
                    @if(!empty($findings) && count($findings) > 0)
                        <ul class="list-group std-medical-card">
                        @foreach($findings as $finding)
                                @php
                                    $labels = [
                                        'observation1' => 'Restless or overactive?',
                                        'observation2' => 'Excitable, Impulsive?',
                                        'observation3' => 'Disturbs other children?',
                                        'observation4' => 'Fails to finish things started?',
                                        'observation5' => 'Inattentive, easily distracted?',
                                        'observation6' => 'Cries often and easily?',
                                        'observation7' => 'Is your spelling poor?',
                                        'observation8' => 'Do you often make mistakes?',
                                        'observation9' => 'Difficulty in telling left from right?',
                                        'observation10' => 'Mix up bus numbers?',
                                    ];

                                    $valueLabels = [
                                        '3' => 'Pretty Much',
                                        '4' => 'Very Much',
                                    ];

                                    $displayKey = $labels[$finding->key] ?? $finding->key;
                                    $displayValue = $valueLabels[$finding->value] ?? $finding->value;
                                @endphp

                                <li class="list-group-item" style="background-color: #fbf5f2; border-color: #19191a; font-weight: 700;">
                                    {{ $displayKey }}: {{ $displayValue }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="alert alert-success">No medical issues found for this student.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
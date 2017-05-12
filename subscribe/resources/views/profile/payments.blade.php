@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Payment Details</h2>
        <p>
            Your subscription is {{$subscription}}. @if($subscription === 'standard')
                <a href="#">Upgrade</a> to premium membership.
            @endif
        </p>

        <table class="table">
            <thead>
            <tr>
                <th>Amount</th>
                <th>Card Name</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach (Auth::user()->payments as $payment)
                <tr>
                    <td>{{$payment->amount}}</td>
                    <td>{{$payment->payed_by}}</td>
                    <td>{{$payment->status}}</td>
                    <td>{{$payment->created_at->diffForHumans()}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
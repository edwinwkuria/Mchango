@extends('layouts.app')

@section('content')
<div class="container">
  <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
      <div class="collapse navbar-collapse" id="navbarsExample09">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <span class="nav-link">{{ $fundraiser->name}} </span>
          </li>
          <li class="nav-item">
            <span class="nav-link">Account Number <b>{{ $fundraiser->accountNumber}}</b></span>
          </li>
          <li class="nav-item">
          <span class="nav-link">Amount Raised <b>{{ $fundraiser->amountRaised}}</b></span>
          </li>
          <li class="nav-item">
          <span class="nav-link">Target <b>{{ $fundraiser->target}}</b></span>
          </li>
          <li class="nav-item">
          <span class="nav-link">Contributors <b>{{ $fundraiser->numberOfContributors}}</b></span>
          </li>
        </ul>
      </div>

      <form method="POST" action="/C2BWithdraw">
      <div class="form-row" >
        @csrf
        <div class="col-7">
          <input type="text" class="form-control" name="MSISDN" id="MSISDN" value="{{Auth::user()->primaryPhone}}">
        </div>
        <div class="col">
          <input type="text" class="form-control" name="amount" id="amount" placeholder="{{ $fundraiser->amountRaised }}" disabled>
        </div>
        <button type="submit" class="btn btn-primary">Withdraw</button>
      </div>
    </form>
  </nav>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Mode</th>
      <th scope="col">Name</th>
      <th scope="col">Phone Number </th>
      <th scope="col">Amount</th>
    </tr>
  </thead>
  <tbody>
  @foreach($transactions as $transaction)
    <tr>
      <th scope="row">1</th>
      <td>{{ $transaction->fullName }}</td>
      <td>{{ $transaction->phoneNumber }}</td>
      <td>{{ $transaction->transAmount }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>
@endsection
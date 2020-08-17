@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        
        <div class="row">
        @foreach($fundraisers as $fundraiser)
            <div class="col-sm-4">
                <div class="card border-{{ $fundraiser->isActive ? 'success' : 'danger' }} mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $fundraiser->name }}</h5>
                    <p class="card-text">Total Amount Raised: Ksh <b>{{ $fundraiser->amountRaised }}</b>, Target Contribution <b>{{ $fundraiser->target }}</b></p>
                    <p class="card-text">Number of contributors: Ksh <b>{{ $fundraiser->numberOfContributors }}</b></p>
                    <p class="card-text">Paybill: <b>200</b> Account Number: <b>{{ $fundraiser->accountNumber}}</b></p>
                    <a href="#" class="btn btn-primary">View details</a>
                    @if($fundraiser->isActive)
                    <a onclick="event.preventDefault();document.getElementById('Update-form').submit();"><button class="btn btn-danger">Close Fundraiser</button></a>
                        <form id="Update-form" action="/fundraiser/{{ $fundraiser->id }}" method="POST" style="display: none;"> 
                            {{ method_field('PATCH')}}
                            {{ csrf_field() }}
                        </form>
                    @endif
                </div>
                </div>
            </div>
        @endforeach
        </div>
        </div>
    </div>
</div>
@endsection

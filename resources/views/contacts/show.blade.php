@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="mr-3">{{ $contact->full_name }}</h1>
            <a href="{{ route('contacts.edit', ['contact' => $contact]) }}" class="btn btn-info">Edit</a>
            <form method="POST" action="{{ route('contacts.destroy', ['contact' => $contact]) }}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete</a>
            </form>
        </div>
        <div class="row">
            <h3>Details</h3>
        </div>
        <div class="row mb-3">
            <div class="card-body bg-white rounded shadow-sm">
                <h6 class="card-subtitle mb-2 text-muted">
                    {{ $contact->company_name }} &ndash; {{ $contact->position }}
                </h6>
                <p class="card-text">
                    @if(isset($contact->email))
                        {{ $contact->email }}<br>
                    @endif
                </p>
            </div>
        </div>
        <div class="row">
            @if ($contact->phoneNumbers->count() == 1)
                <h3>Phone Number</h3>
            @else
                <h3>Phone Numbers</h3>
            @endif
        </div>
        <div class="row">
            <div class="card-body bg-white rounded shadow-sm">
                <p class="card-text">
                    @foreach($contact->phoneNumbers as $phoneNumber)
                        {{ $phoneNumber->number }}
                    @endforeach
                </p>
            </div>
        </div>
    </div>
@endsection

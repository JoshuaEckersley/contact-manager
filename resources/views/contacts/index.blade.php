@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="pr-3">Contacts</h1>
            <a href="{{ route('contacts.create') }}" class="btn btn-primary">Add Contact</a>
        </div>
        @foreach($contacts as $contact)
            <div class="row pb-3">
                <div class="card w-100">
                    <div class="card-body">
                        <a href="{{ route('contacts.show', ['contact' => $contact]) }}">
                            <h5 class="card-title">{{ $contact->full_name }}</h5>
                        </a>
                        <h6 class="card-subtitle mb-2 text-muted">
                            {{ $contact->company_name }} &ndash; {{ $contact->position }}
                        </h6>
                        <p class="card-text">
                            @if(isset($contact->email))
                                {{ $contact->email }}<br>
                            @endif

                            @foreach($contact->phoneNumbers as $phoneNumber)
                                {{ $phoneNumber->number }}
                            @endforeach
                        </p>
                    </div>
                    <div class="card-footer">
                        <span class="float-left">
                            <a href="{{ route('contacts.edit', ['contact' => $contact]) }}" class="btn btn-info">Edit</a>
                        </span>
                        <span class="float-right">
                            <form method="POST" action="{{ route('contacts.destroy', ['contact' => $contact]) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</a>
                            </form>
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="row">{{ $contacts->links() }}</div>
    </div>
@endsection

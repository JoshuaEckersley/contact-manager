@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Edit Contact</h1>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('contacts.update', ['contact' => $contact]) }}">
            @csrf
            @method('put')
            <div class="row">
                <label>First Name
                    <input type="text" name="first_name" value="{{ $contact->first_name }}"></input>
                </label>
            </div>
            <div class="row">
                <label>Last Name
                    <input type="text" name="last_name" value="{{ $contact->last_name }}"></input>
                </label>
            </div>
            <div class="row">
                <label>Date of Birth
                    <input type="text" name="DOB" value="{{ $contact->DOB }}"></input>
                </label>
            </div>
            <div class="row">
                <label>Company
                    <input type="text" name="company_name" value="{{ $contact->company_name }}"></input>
                </label>
            </div>
            <div class="row">
                <label>Position
                    <input type="text" name="position" value="{{ $contact->position }}"></input>
                </label>
            </div>
            <div class="row">
                <label>Email
                    <input type="text" name="email" value="{{ $contact->email }}"></input>
                </label>
            </div>
            @foreach($contact->phoneNumbers as $phoneNumber)
                <div class="row">
                    <label>Phone Number
                        <input type="text" name="number[]" value="{{ $phoneNumber->number }}"></input>
                    </label>
                </div>
            @endforeach
            {{-- Blank field outside the loop to allow new number. Refactor later to add multiple at a time. --}}
            <div class="row">
                    <label>Phone Number
                        <input type="text" name="number[]"></input>
                    </label>
                </div>
           <div class="row">
                <button type="submit" class="btn btn-primary">Update</a>
            </div>
        </form>
    </div>
@endsection

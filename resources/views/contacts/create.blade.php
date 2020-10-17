@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Add Contact</h1>
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
        <form method="POST" action="{{ route('contacts.store') }}">
            @csrf
            <div class="row">
                <label>First Name
                    <input type="text" name="first_name"></input>
                </label>
            </div>
            <div class="row">
                <label>Last Name
                    <input type="text" name="last_name"></input>
                </label>
            </div>
            <div class="row">
                <label>Date of Birth
                    <input type="text" name="DOB"></input>
                </label>
            </div>
            <div class="row">
                <label>Company
                    <input type="text" name="company_name"></input>
                </label>
            </div>
            <div class="row">
                <label>Position
                    <input type="text" name="position"></input>
                </label>
            </div>
            <div class="row">
                <label>Email
                    <input type="text" name="email""></input>
                </label>
            </div>
            <div class="row">
                <label>Phone Number
                    <input type="text" name="number[]"></input>
                </label>
            </div>
           <div class="row">
                <button type="submit" class="btn btn-primary">Add</a>
            </div>
        </form>
    </div>
@endsection

<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contactQry = Contact::query();

        $searchString = $request->search_contacts ?? null;

        if (isset($searchString)) {
            $contactQry->where('first_name', 'LIKE', '%'. $searchString . '%')
                ->orWhere('last_name', 'LIKE', '%'. $searchString . '%')
                ->orWhere('email', 'LIKE', '%'. $searchString . '%')
                ->orWhere('company_name', 'LIKE', '%'. $searchString . '%');
        }

        $contacts = $contactQry->paginate(5);

        return view('contacts.index', compact('contacts', 'searchString'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedFields = Validator::make($request->input(), [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'DOB' => ['date', 'nullable'],
            'company_name' => ['required', 'string'],
            'position' => ['required', 'string'],
            'email' => ['email', 'nullable', Rule::unique('contacts')],
        ])->validate();

        if (! array_filter($request->number)) {
            throw ValidationException::withMessages([
                'number' => 'phone number required',
            ]);
        }

        $contact = new Contact();
        $contact->fill($validatedFields);
        $contact->getConnection()->beginTransaction();
        $contact->save();
        foreach ($request->number as $number) {
            PhoneNumber::create(['number' => $number, 'contact_id' => $contact->id]);
        }
        $contact->getConnection()->commit();

        return view('contacts.show', compact('contact'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $validatedFields = Validator::make($request->input(), [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'DOB' => ['date', 'nullable'],
            'company_name' => ['required', 'string'],
            'position' => ['required', 'string'],
            'email' => ['email', 'nullable', Rule::unique('contacts')->ignore($contact->id)],
        ])->validate();

        if (! array_filter($request->number)) {
            throw ValidationException::withMessages([
                'number' => 'at least one phone number required',
            ]);
        }

        $contact->fill($validatedFields);

        $contact->getConnection()->beginTransaction();
        foreach ($contact->phoneNumbers as $phoneNumber) {
            if (! in_array($phoneNumber->number, $request->number)) {
                $phoneNumber->delete();
            }
        }
        foreach ($request->number as $number) {
            $alreadyAssigned = $contact->phoneNumbers->firstWhere('number', $number);
            if (
                empty($alreadyAssigned)
                && ! empty($number)
            ) {
                PhoneNumber::create(['number' => $number, 'contact_id' => $contact->id]);
            }
        }
        $contact->save();
        $contact->getConnection()->commit();

        return redirect()->route('contacts.show', compact('contact'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index');
    }
}

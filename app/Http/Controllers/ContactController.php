<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contacts.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'         => 'required|string|max:255',
            'phone_number' => 'required|string|max:20||unique:contacts,phone_number',
        ]);

        Contact::create($validate);
        return redirect()->back()->with('status', 'contact-saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('contacts.form', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $validate = $request->validate([
            'name'         => 'required|string|max:255',
            'phone_number' => 'required|string|max:255|unique:contacts,phone_number,' . $contact->id,
        ]);

        $contact->update($validate);
        return redirect()->back()->with('status', 'contact-saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->back()->with('status', 'contact-deleted');
    }

    /**
     * Show the form for importing contact.
     *
     * @return \Illuminate\Contracts\View\View
     */

    public function importForm()
    {
        return view('contacts.import');
    }

    /**
     * Import contact from an xml file
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function postImport(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:8096',
        ]);

        $file       = $request->file('file');
        $xmlContent = file_get_contents($file->getRealPath());
        $xml        = simplexml_load_string($xmlContent);

        foreach ($xml->children() as $contact) {
            Contact::updateOrCreate([
                'phone_number' => trim((string) $contact->phone),
            ], [
                'name' => trim((string) $contact->name),
            ]);
        }
        return redirect()->route('contacts.index');
    }
}

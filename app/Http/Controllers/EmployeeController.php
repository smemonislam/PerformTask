<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = DB::table('employees as e')
        ->select('e.id as eid', 'e.company_id', 'e.first_name', 'e.last_name', 'e.email', 'e.phone', 'c.id', 'c.name')
        ->leftJoin('companies as c', 'c.id', 'e.company_id')
        ->orderBy('e.id', 'DESC')
        ->paginate(10);
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = DB::table('companies')->get();
        return view('employee.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $data = [
            "company_id"    => $request->name,
            "first_name"    => $request->first_name,
            "last_name"     => $request->last_name,
            "email"         => $request->email,
            "phone"         => $request->phone
        ];

        try{
            DB::table('employees')->insert($data);
            $this->getSuccessMessage( 'Added successfully.' );
            return redirect()->route('employees.index');

        } catch( Exception $e ){
            $this->getErrorMessage( $e->getMessage() );            
            return redirect()->back();
        } 
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employees = DB::table('employees')->find($id);
        $companies = DB::table('companies')->get();
        return view('employee.edit', compact('employees', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name'          => 'required',
            'first_name'    => 'required|min:3|max:32',
            'last_name'     => 'required|min:3|max:32',
            'email'         => ['required', 'email', 'unique:employees,email,'. $id],
            'phone'         => 'required'
        ]);

        $data = [
            "company_id"    => $request->name,
            "first_name"    => $request->first_name,
            "last_name"     => $request->last_name,
            "email"         => $request->email,
            "phone"         => $request->phone
        ];

        try{
            DB::table('employees')->where('id', $id)->update($data);
            $this->getSuccessMessage( 'Added successfully.' );
            return redirect()->route('employees.index');

        } catch( Exception $e ){
            $this->getErrorMessage( $e->getMessage() );            
            return redirect()->back();
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('employees')->where('id', $id)->delete();
        $this->getSuccessMessage( 'Delete successfully.' );
        return redirect()->route('employees.index');
    }
}

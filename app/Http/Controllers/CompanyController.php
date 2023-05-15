<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = DB::table('companies')->orderBy('id', 'DESC')->paginate(10);
        return view('company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {       
        if( $request->file('logo') ){
            $logo = $request->logo; 
            $logoname = uniqid() . '.' . $logo->getClientOriginalExtension();            
            $logo->storeAs( 'public/image', $logoname);
        }

        $data = [
            'name'      => $request->name,
            'email'     => $request->email,
            'logo'      => $logoname,
            'website'   => $request->website,
        ];

        try{
            DB::table('companies')->insert($data);
            $this->getSuccessMessage( 'Added successfully.' );
            return redirect()->route('companies.index');

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
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $companies = DB::table('companies')->find($id);
        return view('company.edit', compact('companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:companies,email,'. $id,
            'website'   => 'url',
            'logo'      => 'required|image|mimes:jpg,jpeg,png|dimensions:max_width=100, max_height=100'
        ]);

        if( $request->file('logo') ){
            $logo = $request->logo; 
            $logoname = uniqid() . '.' . $logo->getClientOriginalExtension();           
        }

        if( $request->file('logo') ){
            if( File::exists($request->old_image) ){
                unlink($request->old_image);
            }   
            
            $logo->storeAs( 'public/image', $logoname);
        }

        $data = [
            'name'      => $request->name,
            'email'     => $request->email,
            'logo'      => $logoname,
            'website'   => $request->website,
        ];

        try{
            DB::table('companies')->where('id', $id)->update($data);
            $this->getSuccessMessage( 'Update successfully.' );
            return redirect()->route('companies.index');

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
        DB::table('companies')->where('id', $id)->delete();
        $this->getSuccessMessage( 'Delete successfully.' );
        return redirect()->route('companies.index');
    }
}

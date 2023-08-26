<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Type;
use App\Models\ScholarForm;

use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Hash;
use Auth;
class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->role != 'admin'){
            return redirect('/');
        }
        //if ($request->ajax()) {

            //$users = User::orderBy('role', 'ASC')->get();
            //return datatables()->of($users)
              //  ->addColumn('name', function ($row) {
                //    return $row->full_name;
                //})
                //->addColumn('action', function ($row) {
                  //  $html = '<a class="btn-sm btn btn-info" href="'.route('users.show', $row->id).'"><i class="fa fa-eye"></i></a><a class="btn-sm btn btn-primary" href="'.route('users.edit', $row->id).'"><i class="fa fa-edit"></i></a> <button type="submit" class="btn-sm btn btn-danger delete" data-id="' . $row->id . '"><i class="fa fa-trash"></i></button>';
                    //return $html;
                //})->toJson();
        //}
        //return view('users.index');
		
        $users = User::orderBy('id', 'DESC')->paginate(10);

        return view('users.index',compact('users'));
    }

    public function scholarFormView(Request $request)
    {
        $users = ScholarForm::orderBy('id', 'ASC')->paginate(10);
        return view('scholar.index',compact('users'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function scholarDestroy(Request $request)
    {
        $scholarForm = ScholarForm::find($request->id);
        if($scholarForm){
            $scholarForm->delete();
            return 'Success';
        }
        else{
            return 'Error';
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $user = User::create([
            'full_name' => $request->full_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
	 public function scholarFormSingle($scholar)
    {
		 $scholar = ScholarForm::find($scholar);
        return view('scholar.show', compact('scholar'));
    }
	
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(ScholarForm $scholar)
    {
        return view('scholar.edit', compact('scholar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'full_name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        $user->full_name = $request->full_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = isset($request->password) ? Hash::make($request->password) : $user->password;
        $user->update();

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $user = User::find($request->id);
        if($user){
            $user->delete();
            return 'Success';
        }
        else{
            return 'Error';
        }

    }
}

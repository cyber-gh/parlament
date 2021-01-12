<?php

namespace App\Http\Controllers;

use App\Models\Constituency;
use App\Models\Interest;
use App\Models\Member;
use App\Models\Party;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $members = Member::with(["constituency", "party", "interests" ])->get();

        return view("members", compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $parties = Party::all();
        $interests = Interest::all();
        $constituencies = Constituency::all();

        return view('member_create', [
            "parties" => $parties,
            "interests" => $interests,
            "constituencies" => $constituencies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $v = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'date_of_birth' => 'required|date',
            'party' => 'required',
            'interests' => 'required|array|min:1',
            'constituency' => 'required'
        ]);

        $date1 = $request->date_of_birth;
        $date2 = date_default_timezone_get();

        $diff = abs(strtotime($date2) - strtotime($date1));

        $years = floor($diff / (365*60*60*24));

        if ($years < 18) {
            $v->errors()->add("date_of_birth", "User must be at least 18 years old");
            return redirect()->back()->withErrors($v->errors());
        }

        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors());
        } else {

            $member = new Member;
            $member->firstname = $request->firstname;
            $member->lastname = $request->lastname;
            $member->date_of_birth = $request->date_of_birth;
            $member->party_id = $request->party;
            $member->constituency_id = $request->constituency;
            $member->save();
            foreach ($request->interests as $interest) {
                $member->interests()->attach($interest);
            }


            $member->save();
            return Redirect::to("members");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
        return view("member_details", compact("member"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }
}

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
    public function index(Request $request)
    {
        //
        $members = Member::with(["constituency", "party", "interests" ])->get();
        if ($request->has('partyId')) {
            $partyId = $request->query('partyId');
            if ($partyId != -1) {
                $members = $members->filter(function ($it) use ($partyId) {
                    return $it->party->id == $partyId;
                });
            }
        }

        if ($request->has('interestId')) {
            $interestId = $request->query('interestId');
            if ($interestId != -1) {
                $members = $members->filter(function ($it) use ($interestId) {
                    foreach ($it->interests as $interest) {
                        if ($interest->id == $interestId) {
                            return true;
                        }
                        return false;
                    }
                });
            }
        }

        $parties = Party::all();
        $interests = Interest::all();
        return view("members", [
            'members' => $members,
            "parties" => $parties,
            "interests" => $interests,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (session()->get("isAdmin") == false) {
            return Redirect::to("members")->with("error", "You are not allowed to do that, not an admin");
        }
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

        if (session()->get("isAdmin") == false) {
            return Redirect::to("members")->with("error", "You are not allowed to do that, not an admin");
        }

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

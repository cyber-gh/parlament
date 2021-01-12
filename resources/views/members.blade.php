@extends('master')
@section('title', 'Page Title')

@section('sidebar')
    @parent
{{--   adition data to siderbar--}}
@stop

@section('content')
    @if(Session::has("error"))
        <p>{{Session::get("error")}}</p>
    @endif

    <form action="{{route("members.index")}}" method="get">
        <div class="form-group">
            <label for="cars">Choose a party:</label>

            <select name="partyId" id="party">


                <option value="-1">None</option>
                @foreach($parties as $party)
                    <option  value="{{$party->id}}">{{$party->name}}</option>
                @endforeach
            </select>

        </div>


        <div class="form-group">
            <label for="cars">Select your interests</label>

            <select name="interestId" id="interest">

                <option value="-1">None</option>
                @foreach($interests as $interest)
                    <option value="{{$interest->id}}">{{$interest->name}}</option>
                @endforeach
            </select>

        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary submit-btn">Filter</button>
        </div>
    </form>

    <a href="{{route("members.index")}}">Clear filter</a>

    <table>

        @foreach($members as $member)
            <tr>
                <td>
                    <h3>First Name {{$member->firstname}}</h3>
                    <h3>Last Name {{$member->lastname}}</h3>
                    <h3>Date of birth{{$member->date_of_birth}}</h3>
{{--                    <h3>{{$member->constituency->electorate}}</h3>--}}
                    <h3>Constituence region  {{$member->constituency->region}}</h3>
                    <h3>Party Name  {{$member->party->name}}</h3>
                    <h3>Party principal_colour  {{$member->party->principal_colour}}</h3>
                    <h3>Intererests  {{$member->interests[0]->name}}</h3>

                    <a href="{{route("members.show", [$member->id]) }}">Details</a>
                </td>
            </tr>
        @endforeach
    </table>

    @if(Session::has("isAdmin") && Session::get("isAdmin"))
        <a href="{{route("members.create")}}">Add new</a>
    @endif


@stop




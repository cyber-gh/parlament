

<table>

    <h3>First Name {{$member->firstname}}</h3>
    <h3>Last Name {{$member->lastname}}</h3>
    <h3>Date of birth{{$member->date_of_birth}}</h3>
    {{--                    <h3>{{$member->constituency->electorate}}</h3>--}}
    <h3>Constituence region  {{$member->constituency->region}}</h3>
    <h3>Party Name  {{$member->party->name}}</h3>
    <h3>Party principal_colour  {{$member->party->principal_colour}}</h3>
    <h3>Intererests  </h3>

    @foreach($member->interests as $interest)

        <h4>
            {{$interest->name}}
        </h4>

    @endforeach




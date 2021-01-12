<form action="{{ route('members.store') }}" method="post">
    @csrf
    <div class="form-group">
        <label>First Name</label>
        <input type="text" class="form-control" name="firstname" required>

    </div>

    <div class="form-group">
        <label>Last Name</label>
        <input type="text" class="form-control" name="lastname" required>

    </div>

    <div class="form-group">
        <label>Date of birth</label>
        <input type="date" class="form-control" name="date_of_birth" required>

    </div>

    <div class="form-group">
        <label for="cars">Choose a constinuency:</label>

        <select name="constituency" id="constituency" required>


            @foreach($constituencies as $constituencie)
                <option value="{{$constituencie->id}}">{{$constituencie->region}}</option>
            @endforeach
        </select>

    </div>

    <div class="form-group">
        <label for="cars">Choose a party:</label>

        <select name="party" id="party" required>


            @foreach($parties as $party)
                <option value="{{$party->id}}">{{$party->name}}</option>
            @endforeach
        </select>

    </div>


    <div class="form-group">
        <label for="cars">Select your interests</label>

        <select name="interests[]" id="interest" required multiple>


            @foreach($interests as $interest)
                <option value="{{$interest->id}}">{{$interest->name}}</option>
            @endforeach
        </select>

    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
    </div>

    <div class="form-group">
        @foreach($errors->all() as $message)
            <p>{{$message}}</p>
        @endforeach
    </div>
</form>

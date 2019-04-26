@extends('layouts.app')

@section('content')
    <style>
        h3{
            color: #088dcd;
            font-size: 21px;
            font-family: "Muli", "Segoe Ui";
        }
    </style>
    <div class="central-meta">
        <div class="editing-info">
            <h5 class="f-title"><i class="ti-info-alt"></i> Your Profile</h5>

            <div class="user_pic">
                <img class="img-thumbnail" src="{{URL::asset('avatars/'.Auth::user()->filename)}}" alt="{{Auth::user()->original_filename}}">
            </div>

                <div class="form-group half show_profile" >
                    <h3>Your Username</h3><i class="mtrl-select"></i>
                    <input type="text" id="input" readonly placeholder="{{$currentuser->name}}">
                </div>
            <div class="form-group half show_profile">
                <h3>Your Email</h3><i class="mtrl-select"></i>
                <input type="text" id="input" readonly placeholder="{{$currentuser->email}}">
            </div>
            <div class="form-group half show_profile">
                <h3>Your Role</h3><i class="mtrl-select"></i>
                <input type="text" id="input" readonly placeholder="{{$currentuser->role}}">

            </div>
            <div class="form-group half show_profile">
                <h3>Your City</h3><i class="mtrl-select"></i>
                <input type="text" id="input" readonly placeholder="{{$currentuser->city}}">

            </div>
            <div class="form-group half show_profile">
                <h3>Your Subject</h3><i class="mtrl-select"></i>
                <input type="text" id="input" readonly placeholder="{{$currentuser->subject}}">

            </div>
            <div class="form-group half show_profile">
                <h3>Your Grade</h3><i class="mtrl-select"></i>
                <input type="text" id="input" readonly placeholder="{{$currentuser->level}}">

            </div>

            <a href="{{route('profiles.edit')}}"><button type="button" class="mtr-btn"><span>Edit Your Profile</span></button></a>



        </div>
    </div>

    <div class="central-meta">
        <h5 class="f-title"><i class="ti-info-alt"></i> Your Recent Test Score</h5>

    </div>

    <div class="central-meta">
        <h5 class="f-title"><i class="ti-info-alt"></i> Your Recent Test Score</h5>

    </div>

    <div class="central-meta">
        <h5 class="f-title"><i class="ti-info-alt"></i> Check Your Perfomence</h5>

        <form method="post" action="{{url('showmark')}}">
            @csrf
            <div class="col-md-12">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="name">Select Subject :</label>
                    <select name="subject_id" required>
                        <option value="" selected disabled hidden>Choose here</option>
                        @foreach ($subject as $sub)
                            <option value="{{ $sub->id }}">{{$sub->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="name">Select Level :</label>
                    <select name="level_id" required>
                        <option value="" selected disabled hidden>Choose here</option>
                        @foreach ($level as $lv)
                            <option value="{{ $lv->id }}">{{$lv->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="mtr-btn"><span>Check Now !</span></button>

        </form>
    </div>



@endsection
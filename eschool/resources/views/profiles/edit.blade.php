@extends('layouts.app')

@section('content')

    @if (Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br />
    @endif

    <div class="central-meta">
        <div class="editing-info">
            <h5 class="f-title"><i class="ti-info-alt"></i> Edit Basic Information</h5>

            <div class="user_pic">
                <img class="img-thumbnail" src="{{URL::asset('avatars/'.Auth::user()->filename)}}" alt="{{Auth::user()->original_filename}}">
            </div>

            {{--start form--}}
            <form method="post" action="{{url('/editprofile')}}" enctype="multipart/form-data" id="myForm">
                {{csrf_field()}}
                <div class="form-group half first_form">
                    <input type="text" name="user_name" style="margin-right: 10px;" placeholder="{{Auth::user()->name}}">
                    <label class="control-label" for="input">Change Your Username</label>
                </div>
                <div class="form-group half">
                    <input type="email" name="user_email" placeholder="{{Auth::user()->email}}">
                    <label class="control-label" for="input">Change Your Log In Email</label>
                </div>

                <div class="form-group half">
                    <select name="user_subject">
                        <option name="user_subject" value="" selected disabled hidden>{{Auth::user()->subject}}</option>
                        @foreach ($subject as $sub)
                            <option value="{{ $sub->name }}"name="{{$sub->name}}">{{$sub->name }}</option>
                        @endforeach
                    </select>
                    <label class="control-label" for="input">Change Your Favourite Subject</label>
                </div>
                <div class="form-group half">
                    <select style="display: block" name="user_level">
                        <option name="user_level" value="" selected disabled hidden>{{Auth::user()->level}}</option>
                        @foreach ($level as $lv)
                            <option value="{{ $lv->name }}" name="{{$lv->name}}">{{$lv->name }}</option>
                        @endforeach
                    </select>
                    <label class="control-label" for="input">Change Your Grade</label>
                </div>
                {{--city--}}
                <div class="form-group half">
                    <select style="display: block" name="user_city">
                        <option name="user_city" value="" selected disabled hidden>{{Auth::user()->city}}</option>
                        <option name="user_city" value="Thành phố Hà Nội">Thành phố Hà Nội</option>
                        <option name="user_city" value="Tỉnh Hà Giang">Tỉnh Hà Giang</option>
                        <option name="user_city" value="Tỉnh Cao Bằng">Tỉnh Cao Bằng</option>
                        <option name="user_city" value="Tỉnh Bắc Kạn">Tỉnh Bắc Kạn</option>
                        <option name="user_city" value="Tỉnh Tuyên Quang">Tỉnh Tuyên Quang</option>
                        <option name="user_city" value="Tỉnh Lào Cai">Tỉnh Lào Cai</option>
                        <option name="user_city" value="Tỉnh Điện Biên">Tỉnh Điện Biên</option>
                        <option name="user_city" value="Tỉnh Lai Châu">Tỉnh Lai Châu</option>
                        <option name="user_city" value="Tỉnh Sơn La">Tỉnh Sơn La</option>
                        <option name="user_city" value="Tỉnh Yên Bái">Tỉnh Yên Bái</option>
                        <option name="user_city" value="Tỉnh Hoà Bình">Tỉnh Hoà Bình</option>
                        <option name="user_city" value="Tỉnh Thái Nguyên">Tỉnh Thái Nguyên</option>
                        <option name="user_city" value="Tỉnh Lạng Sơn">Tỉnh Lạng Sơn</option>
                        <option name="user_city" value="Tỉnh Quảng Ninh">Tỉnh Quảng Ninh</option>
                        <option name="user_city" value="Tỉnh Bắc Giang">Tỉnh Bắc Giang</option>
                        <option name="user_city" value="Tỉnh Phú Thọ">Tỉnh Phú Thọ</option>
                        <option name="user_city" value="Tỉnh Vĩnh Phúc">Tỉnh Vĩnh Phúc</option>
                        <option name="user_city" value="Tỉnh Bắc Ninh">Tỉnh Bắc Ninh</option>
                        <option name="user_city" value="Tỉnh Hải Dương">Tỉnh Hải Dương</option>
                        <option name="user_city" value="Thành phố Hải Phòng">Thành phố Hải Phòng</option>
                        <option name="user_city" value="Tỉnh Hưng Yên">Tỉnh Hưng Yên</option>
                        <option name="user_city" value="Tỉnh Thái Bình">Tỉnh Thái Bình</option>
                        <option name="user_city" value="Tỉnh Hà Nam">Tỉnh Hà Nam</option>
                        <option name="user_city" value="Tỉnh Nam Địn">Tỉnh Nam Định</option>
                        <option name="user_city" value="Tỉnh Ninh Bình">Tỉnh Ninh Bình</option>
                        <option name="user_city" value="Tỉnh Thanh Hóa">Tỉnh Thanh Hóa</option>
                        <option name="user_city" value="Tỉnh Nghệ An">Tỉnh Nghệ An</option>
                        <option name="user_city" value="Tỉnh Hà Tĩnh">Tỉnh Hà Tĩnh</option>
                        <option name="user_city" value="Tỉnh Quảng Bình">Tỉnh Quảng Bình</option>
                        <option name="user_city" value="Tỉnh Quảng Trị">Tỉnh Quảng Trị</option>
                        <option name="user_city" value="Tỉnh Thừa Thiên Huế">Tỉnh Thừa Thiên Huế</option>
                        <option name="user_city" value="Thành phố Đà Nẵng">Thành phố Đà Nẵng</option>
                        <option name="user_city" value="Tỉnh Quảng Nam">Tỉnh Quảng Nam</option>
                        <option name="user_city" value="Tỉnh Quảng Ngãi">Tỉnh Quảng Ngãi</option>
                        <option name="user_city" value="Tỉnh Bình Định">Tỉnh Bình Định</option>
                        <option name="user_city" value="Tỉnh Phú Yên">Tỉnh Phú Yên</option>
                        <option name="user_city" value="Tỉnh Khánh Hòa">Tỉnh Khánh Hòa</option>
                        <option name="user_city" value="Tỉnh Ninh Thuận">Tỉnh Ninh Thuận</option>
                        <option name="user_city" value="Tỉnh Bình Thuận">Tỉnh Bình Thuận</option>
                        <option name="user_city" value="Tỉnh Kon Tum">Tỉnh Kon Tum</option>
                        <option name="user_city" value="Tỉnh Gia Lai">Tỉnh Gia Lai</option>
                        <option name="user_city" value="Tỉnh Đắk Lắk">Tỉnh Đắk Lắk</option>
                        <option name="user_city" value="Tỉnh Đắk Nông">Tỉnh Đắk Nông</option>
                        <option name="user_city" value="Tỉnh Lâm Đồng">Tỉnh Lâm Đồng</option>
                        <option name="user_city" value="Tỉnh Bình Phước">Tỉnh Bình Phước</option>
                        <option name="user_city" value="Tỉnh Tây Ninh">Tỉnh Tây Ninh</option>
                        <option name="user_city" value="Tỉnh Bình Dương">Tỉnh Bình Dương</option>
                        <option name="user_city" value="Tỉnh Đồng Nai">Tỉnh Đồng Nai</option>
                        <option name="user_city" value="Tỉnh Bà Rịa - Vũng Tàu">Tỉnh Bà Rịa - Vũng Tàu</option>
                        <option name="user_city" value="Thành phố Hồ Chí Minh">Thành phố Hồ Chí Minh</option>
                        <option name="user_city" value="Tỉnh Long An">Tỉnh Long An</option>
                        <option name="user_city" value="Tỉnh Tiền Giang">Tỉnh Tiền Giang</option>
                        <option name="user_city" value="Tỉnh Bến Tre">Tỉnh Bến Tre</option>
                        <option name="user_city" value="Tỉnh Trà Vinh">Tỉnh Trà Vinh</option>
                        <option name="user_city" value="Tỉnh Vĩnh Long">Tỉnh Vĩnh Long</option>
                        <option name="user_city" value="Tỉnh Đồng Tháp">Tỉnh Đồng Tháp</option>
                        <option name="user_city" value="Tỉnh An Giang">Tỉnh An Giang</option>
                        <option name="user_city" value="Tỉnh Kiên Giang">Tỉnh Kiên Giang</option>
                        <option name="user_city" value="Thành phố Cần Thơ">Thành phố Cần Thơ</option>
                        <option name="user_city" value="Tỉnh Hậu Giang">Tỉnh Hậu Giang</option>
                        <option name="user_city" value="Tỉnh Sóc Trăng">Tỉnh Sóc Trăng</option>
                        <option name="user_city" value="Tỉnh Bạc Liêu">Tỉnh Bạc Liêu</option>
                        <option name="user_city" value="Tỉnh Cà Mau">Tỉnh Cà Mau</option>
                    </select>
                    <label class="control-label" for="input">Change Your City</label>
                </div>

                <div class="form-group half">
                    <select style="display: block" name="user_role">
                        <option value="" selected disabled hidden>{{Auth::user()->role}}</option>
                        <option name="user_role" value="Teacher">Teacher</option>
                        <option name="user_role" value="Student">Student</option>
                    </select>
                    <label class="control-label" for="input">Change Your Role</label>
                </div>

                <div class="form-group" style="margin-top: 50px">

                    <input type="file" class="form-control" name="avatar"style="margin-top: 10px">
                    <label class="control-label" for="input">Update your profile picture</label>
                </div>

                <div class="submit-btns">
                    <button type="button" class="mtr-btn" onclick="myFunction()"><span>Cancel</span></button>
                    <button type="submit" class="mtr-btn"><span>Update</span></button>
                </div>

            </form>
            {{--end form--}}
        </div>
    </div>

    <script>
        //clear form
        function myFunction() {
            document.getElementById("myForm").reset();
        }


    </script>
@endsection
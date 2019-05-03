<?php
/**
 * Created by PhpStorm.
 * User: The Doctor
 * Date: 4/24/2019
 * Time: 10:36 PM
 */
use Illuminate\Support\Carbon;

use App\Post;
// ROR RECENT POST
$id = \Auth::user()->id;
$recents = Post::where('user_id', '=', $id)->latest()->take(5)->get();

?>
<div class="col-lg-3">
    <aside class="sidebar static">
        <div class="widget">
            <h4 class="widget-title">Shortcuts</h4>
            <ul class="naves">
                <li>
                    <i class="ti-clipboard"></i>
                    <a href={{url('/')}} title="">News feed</a>
                </li>
                <?php
                if(Auth::check()){
                    $role =Auth::user()->role;
                    if( $role == 'teacher' || $role == 'admin'){
                        echo "<li class='admin'>
                                <i class='ti-files'></i>
                                <a href='/manager'>Post Manager</a>
                                </li>";
                    }
                }
                ?>
                <?php
                if(Auth::check()){
                    $role =Auth::user()->role;
                    if( $role == 'teacher' || $role == 'admin'){
                        echo "<li class='admin'>
                                <i class='ti-files'></i>
                                <a href='/accs'>Account Manager</a>
                                </li>";
                    }
                }
                ?>
                <li>
                    <i class="ti-files"></i>
                    <a href="{{url('dotest')}}" title="">Do test</a>
                </li>
                <?php
                use Illuminate\Support\Facades\Auth;
                if(Auth::check()){
                    $role =Auth::user()->role;
                    if( $role == 'teacher' || $role == 'admin'){
                        echo "<li class='admin'>
                                <i class='ti-files'></i>
                                <a href='/add_question_form'>Add Question</a>
                                </li>";
                    }
                }
                ?>
                <li>
                    <i class="ti-bell"></i>
                    <a href="{{ route('notifications') }}"
                       onclick="event.preventDefault();
                   document.getElementById('notify-shortcut').submit();">
                        {{ __('Notifications') }}
                    </a>
                    <form id="notify-shortcut" action="{{ route('notifications') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                <li>
                    <i class="fa fa-bar-chart-o"></i>
                    <a href="insights.html" title="">insights</a>
                </li>
                <li>
                    <i class="ti-power-off"></i>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                </li>
            </ul>
        </div><!-- Shortcuts -->
        <div class="widget">
            <a href="{{url('activity')}}" <h4 class="widget-title">Recent Activity</h4></a>
            <ul class="activitiez">
                @foreach($activities as $activy)
                    @php
                        $check = DB::table('users')
                            ->where('id','=',$activy->receiver_id)
                            ->exists();
                        if(!$check)
                        {
                            $receiver_info ='yourself';
                        }
                        else
                        {
                            $receiver = DB::table('users')
                            ->where('id','=',$activy->receiver_id)
                            ->first();
                            $receiver_info =$receiver->name;
                        }
                        $car = new Carbon($activy->updated_at);
                        $dif = $car->diffForHumans();


                    @endphp
                    <li>
                        <div class="activity-meta">
                            <i>{{$dif}}</i>
                            <span>{{$activy->content}} <create></span>
                            <h6>: <a href="">{{$receiver_info}}</a></h6>
                        </div>
                    </li>

                @endforeach
            </ul>
        </div><!-- recent activites -->
        <div class="widget">
            <h4 class="widget-title">Your Recent Posts</h4>
            <ul class="activitiez">
                @foreach ($recents as $recent)
                    <li>
                        <div class="activity-meta">
                            <i>{{$recent->updated_at->diffForHumans()}}</i>
                            <span><a href="{{route('posts.show', $recent['id'])}}" title="">{{$recent->title}} </a></span>
                            {{--<h6>by <a href="time-line.html">black demon.</a></h6>--}}
                        </div>
                    </li>

                @endforeach
            </ul>
        </div><!-- recent activites -->
        <div class="widget stick-widget">
            <h4 class="widget-title">Who's follownig</h4>
            <ul class="followers">
                <li>
                    <figure><img src={{asset('images/resources/friend-avatar2.jpg')}} alt=""></figure>
                    <div class="friend-meta">
                        <h4><a href="time-line.html" title="">Kelly Bill</a></h4>
                        <a href="#" title="" class="underline">Add Friend</a>
                    </div>
                </li>
                <li>
                    <figure><img src={{asset('images/resources/friend-avatar4.jpg')}} alt=""></figure>
                    <div class="friend-meta">
                        <h4><a href="time-line.html" title="">Issabel</a></h4>
                        <a href="#" title="" class="underline">Add Friend</a>
                    </div>
                </li>
                <li>
                    <figure><img src={{asset('images/resources/friend-avatar6.jpg')}} alt=""></figure>
                    <div class="friend-meta">
                        <h4><a href="time-line.html" title="">Andrew</a></h4>
                        <a href="#" title="" class="underline">Add Friend</a>
                    </div>
                </li>
                <li>
                    <figure><img src={{asset('images/resources/friend-avatar8.jpg')}} alt=""></figure>
                    <div class="friend-meta">
                        <h4><a href="time-line.html" title="">Sophia</a></h4>
                        <a href="#" title="" class="underline">Add Friend</a>
                    </div>
                </li>
                <li>
                    <figure><img src={{asset('images/resources/friend-avatar9.jpg')}} alt=""></figure>
                    <div class="friend-meta">
                        <h4><a href="time-line.html" title="">Allen</a></h4>
                        <a href="#" title="" class="underline">Add Friend</a>
                    </div>
                </li>
            </ul>
        </div><!-- who's following -->
    </aside>
</div><!-- sidebar -->

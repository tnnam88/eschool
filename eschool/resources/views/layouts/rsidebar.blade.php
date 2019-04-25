<?php
/**
 * Created by PhpStorm.
 * User: The Doctor
 * Date: 4/24/2019
 * Time: 10:37 PM
 */
?>
<div class="col-lg-3">
    <aside class="sidebar static">
        <div class="widget">
            <h4 class="widget-title">Your page</h4>
            <div class="your-page">
                <figure>
                    <a href="#" title=""><img src={{asset('images/resources/friend-avatar9.jpg')}} alt=""></a>
                </figure>
                <div class="page-meta">
                    <a href="#" title="" class="underline">My page</a>
                    <span><i class="ti-comment"></i><a href="insight.html" title="">Messages <em>9</em></a></span>
                    <span><i class="ti-bell"></i><a href="insight.html" title="">Notifications <em>2</em></a></span>
                </div>
                <div class="page-likes">
                    <ul class="nav nav-tabs likes-btn">
                        <li class="nav-item"><a class="active" href="#link1" data-toggle="tab">likes</a></li>
                        <li class="nav-item"><a class="" href="#link2" data-toggle="tab">views</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active fade show " id="link1" >
                            <span><i class="ti-heart"></i>884</span>
                            <a href="#" title="weekly-likes">35 new likes this week</a>
                            <div class="users-thumb-list">
                                <a href="#" title="Anderw" data-toggle="tooltip">
                                    <img src={{asset('images/resources/userlist-1.jpg')}} alt="">
                                </a>
                                <a href="#" title="frank" data-toggle="tooltip">
                                    <img src={{asset('images/resources/userlist-2.jpg')}} alt="">
                                </a>
                                <a href="#" title="Sara" data-toggle="tooltip">
                                    <img src={{asset('images/resources/userlist-3.jpg')}} alt="">
                                </a>
                                <a href="#" title="Amy" data-toggle="tooltip">
                                    <img src={{asset('images/resources/userlist-4.jpg')}} alt="">
                                </a>
                                <a href="#" title="Ema" data-toggle="tooltip">
                                    <img src={{asset('images/resources/userlist-5.jpg')}} alt="">
                                </a>
                                <a href="#" title="Sophie" data-toggle="tooltip">
                                    <img src={{asset('images/resources/userlist-6.jpg')}} alt="">
                                </a>
                                <a href="#" title="Maria" data-toggle="tooltip">
                                    <img src={{asset('images/resources/userlist-7.jpg')}} alt="">
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="link2" >
                            <span><i class="ti-eye"></i>440</span>
                            <a href="#" title="weekly-likes">440 new views this week</a>
                            <div class="users-thumb-list">
                                <a href="#" title="Anderw" data-toggle="tooltip">
                                    <img src={{asset('images/resources/userlist-1.jpg')}} alt="">
                                </a>
                                <a href="#" title="frank" data-toggle="tooltip">
                                    <img src={{asset('images/resources/userlist-2.jpg')}} alt="">
                                </a>
                                <a href="#" title="Sara" data-toggle="tooltip">
                                    <img src={{asset('images/resources/userlist-3.jpg')}} alt="">
                                </a>
                                <a href="#" title="Amy" data-toggle="tooltip">
                                    <img src={{asset('images/resources/userlist-4.jpg')}} alt="">
                                </a>
                                <a href="#" title="Ema" data-toggle="tooltip">
                                    <img src={{asset('images/resources/userlist-5.jpg')}} alt="">
                                </a>
                                <a href="#" title="Sophie" data-toggle="tooltip">
                                    <img src={{asset('images/resources/userlist-6.jpg')}} alt="">
                                </a>
                                <a href="#" title="Maria" data-toggle="tooltip">
                                    <img src={{asset('images/resources/userlist-7.jpg')}} alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- page like widget -->
        <div class="widget">
            <div class="banner medium-opacity bluesh">
                <div class="bg-image" style="background-image: url(images/resources/baner-widgetbg.jpg)"></div>
                <div class="baner-top">
                    <span><img alt="" src={{asset('images/book-icon.png')}}></span>
                    <i class="fa fa-ellipsis-h"></i>
                </div>
                <div class="banermeta">
                    <p>
                        W3Schools' Online Certification
                    </p>
                    <span>Lavarel Quiz</span>
                    <a data-ripple="" title="" href="#">start now!</a>
                </div>
            </div>
        </div>
        <div class="widget friend-list stick-widget">
            <h4 class="widget-title">Friends</h4>
            <div id="searchDir"></div>
            <ul id="people-list" class="friendz-list">
                <li>
                    <figure>
                        <img src={{asset('images/resources/friend-avatar.jpg')}} alt="">
                        <span class="status f-online"></span>
                    </figure>
                    <div class="friendz-meta">
                        <a href="time-line.html">bucky barnes</a>
                        <i><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="b5c2dcdbc1d0c7c6dad9d1d0c7f5d2d8d4dcd99bd6dad8">[email&#160;protected]</a></i>
                    </div>
                </li>
                <li>
                    <figure>
                        <img src={{asset('images/resources/friend-avatar2.jpg')}} alt="">
                        <span class="status f-away"></span>
                    </figure>
                    <div class="friendz-meta">
                        <a href="time-line.html">Sarah Loren</a>
                        <i><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="fc9e9d8e92998fbc9b919d9590d29f9391">[email&#160;protected]</a></i>
                    </div>
                </li>
                <li>
                    <figure>
                        <img src={{asset('images/resources/friend-avatar3.jpg')}} alt="">
                        <span class="status f-off"></span>
                    </figure>
                    <div class="friendz-meta">
                        <a href="time-line.html">jason borne</a>
                        <i><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="3852594b57565a785f55595154165b5755">[email&#160;protected]</a></i>
                    </div>
                </li>
                <li>
                    <figure>
                        <img src={{asset('images/resources/friend-avatar4.jpg')}} alt="">
                        <span class="status f-off"></span>
                    </figure>
                    <div class="friendz-meta">
                        <a href="time-line.html">Cameron diaz</a>
                        <i><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="d1bbb0a2bebfb391b6bcb0b8bdffb2bebc">[email&#160;protected]</a></i>
                    </div>
                </li>
                <li>

                    <figure>
                        <img src={{asset('images/resources/friend-avatar5.jpg')}} alt="">
                        <span class="status f-online"></span>
                    </figure>
                    <div class="friendz-meta">
                        <a href="time-line.html">daniel warber</a>
                        <i><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="244e45574b4a46644349454d480a474b49">[email&#160;protected]</a></i>
                    </div>
                </li>
                <li>

                    <figure>
                        <img src={{asset('images/resources/friend-avatar6.jpg')}} alt="">
                        <span class="status f-away"></span>
                    </figure>
                    <div class="friendz-meta">
                        <a href="time-line.html">andrew</a>
                        <i><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="442e25372b2a26042329252d286a272b29">[email&#160;protected]</a></i>
                    </div>
                </li>
                <li>

                    <figure>
                        <img src={{asset('images/resources/friend-avatar1.jpg')}} alt="">
                        <span class="status f-off"></span>
                    </figure>
                    <div class="friendz-meta">
                        <a href="time-line.html">amy watson</a>
                        <i><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="355f54465a5b57755258545c591b565a58">[email&#160;protected]</a></i>
                    </div>
                </li>
                <li>

                    <figure>
                        <img src={{asset('images/resources/friend-avatar2.jpg')}} alt="">
                        <span class="status f-online"></span>
                    </figure>
                    <div class="friendz-meta">
                        <a href="time-line.html">daniel warber</a>
                        <i><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="472d263428292507202a262e2b6924282a">[email&#160;protected]</a></i>
                    </div>
                </li>
                <li>

                    <figure>
                        <img src={{asset('images/resources/friend-avatar4.jpg')}} alt="">
                        <span class="status f-away"></span>
                    </figure>
                    <div class="friendz-meta">
                        <a href="time-line.html">Sarah Loren</a>
                        <i><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="7d1f1c0f13180e3d1a101c1411531e1210">[email&#160;protected]</a></i>
                    </div>
                </li>
            </ul>
            <div class="chat-box">
                <div class="chat-head">
                    <span class="status f-online"></span>
                    <h6>Bucky Barnes</h6>
                    <div class="more">
                        <span><i class="ti-more-alt"></i></span>
                        <span class="close-mesage"><i class="ti-close"></i></span>
                    </div>
                </div>
                <div class="chat-list">
                    <ul>
                        <li class="me">
                            <div class="chat-thumb"><img src={{asset('images/resources/chatlist1.jpg')}} alt=""></div>
                            <div class="notification-event">
															<span class="chat-message-item">
																Hi James! Please remember to buy the food for tomorrow! I’m gonna be handling the gifts and Jake’s gonna get the drinks
															</span>
                                <span class="notification-date"><time datetime="2004-07-24T18:18" class="entry-date updated">Yesterday at 8:10pm</time></span>
                            </div>
                        </li>
                        <li class="you">
                            <div class="chat-thumb"><img src={{asset('images/resources/chatlist2.jpg')}} alt=""></div>
                            <div class="notification-event">
															<span class="chat-message-item">
																Hi James! Please remember to buy the food for tomorrow! I’m gonna be handling the gifts and Jake’s gonna get the drinks
															</span>
                                <span class="notification-date"><time datetime="2004-07-24T18:18" class="entry-date updated">Yesterday at 8:10pm</time></span>
                            </div>
                        </li>
                        <li class="me">
                            <div class="chat-thumb"><img src={{asset('images/resources/chatlist1.jpg')}} alt=""></div>
                            <div class="notification-event">
															<span class="chat-message-item">
																Hi James! Please remember to buy the food for tomorrow! I’m gonna be handling the gifts and Jake’s gonna get the drinks
															</span>
                                <span class="notification-date"><time datetime="2004-07-24T18:18" class="entry-date updated">Yesterday at 8:10pm</time></span>
                            </div>
                        </li>
                    </ul>
                    <form class="text-box">
                        <textarea placeholder="Post enter to post..."></textarea>
                        <div class="add-smiles">
                            <span title="add icon" class="em em-expressionless"></span>
                        </div>
                        <div class="smiles-bunch">
                            <i class="em em---1"></i>
                            <i class="em em-smiley"></i>
                            <i class="em em-anguished"></i>
                            <i class="em em-laughing"></i>
                            <i class="em em-angry"></i>
                            <i class="em em-astonished"></i>
                            <i class="em em-blush"></i>
                            <i class="em em-disappointed"></i>
                            <i class="em em-worried"></i>
                            <i class="em em-kissing_heart"></i>
                            <i class="em em-rage"></i>
                            <i class="em em-stuck_out_tongue"></i>
                        </div>
                        <button type="submit"></button>
                    </form>
                </div>
            </div>
        </div><!-- friends list sidebar -->
    </aside>
</div><!-- sidebar -->

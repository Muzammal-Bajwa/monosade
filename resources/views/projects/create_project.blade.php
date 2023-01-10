@extends('layouts.admin')
@section('content')
<section id="header">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <a href="#"><img src="assets/img/logo_main.png" alt=""></a>
            </div>
            <div class="col-12 col-lg-6 text-right">
                <a href="#" class="logout">mansuri.jafar7@gmail.com - Logout</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12">
                <h2>Create a new project</h2>
            </div>
        </div>
    </div>
</section>

<section id="createProject">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="white_card">
                    <form action="#">
                        <div class="form-group">
                            <label for="#">Project title</label>
                            <input type="text" placeholder="E.g.  eCommerce app design" />
                        </div>
                        <div class="form-group">
                            <label for="#">Design category</label>
                            <input type="text" placeholder="Search your category" />
                            <ul class="tags">
                                <li><img src="assets/img/tick_green.png" alt="">Social media posts</li>
                                <li><img src="assets/img/tick_green.png" alt="">Social media posts</li>
                                <li><img src="assets/img/tick_green.png" alt="">Social media posts</li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="#">Dimensions</label>
                            <p>Social media posts</p>
                            <div class="item_cards">
                                <a href="#">
                                    <div class="item">
                                        <span><img src="assets/img/uit_facebook-f.png" alt=""></span>
                                        <h6>Facebook post</h6>
                                        <p>1080 X 1080</p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="item">
                                        <span><img src="assets/img/uit_facebook-f.png" alt=""></span>
                                        <h6>Facebook story</h6>
                                        <p>1080 X 1080</p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="item">
                                        <span><img src="assets/img/instagram.png" alt=""></span>
                                        <h6>Instagram post</h6>
                                        <p>1080 X 1080</p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="item">
                                        <span><img src="assets/img/instagram.png" alt=""></span>
                                        <h6>Instagram story</h6>
                                        <p>1080 X 1080</p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="item">
                                        <span><img src="assets/img/custom.png" alt=""></span>
                                        <h6>Custom</h6>
                                        <p>1080 X 1080</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="form-group space_up">
                            <label for="#">How many post you want to make?</label>
                            <div class='ctrl'>
                                <div class='ctrl__button ctrl__button--decrement'>&ndash;</div>
                                <div class='ctrl__counter'>
                                    <input class='ctrl__counter-input' maxlength='10' type='text' value='0'>
                                    <div class='ctrl__counter-num'>0</div>
                                </div>
                                <div class='ctrl__button ctrl__button--increment'>+</div>
                            </div>
                        </div>
                        <div class="form-group space_up">
                            <label for="#">Description</label>
                            <p>Format your paragraphs and create checklist to make your description easy to read and follow. Well written
                                instruction = better designs.</p>
                            <div class="app">
                            </div>
                        </div>
                        <div class="form-group space_up">
                            <label for="#">Attachments</label>
                            <div class="attech">
                                <div class="attech_header">
                                    <a href=""></a>
                                </div>
                                <div class="attech_body">

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('css-page')
@endpush

@push('scripts')

@endpush
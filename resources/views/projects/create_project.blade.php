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
                                            <input type="file" class="custom-file-input">
                                            <p>Upload or drag & drop any images, files, or examples that may be helpful<br/>
                                                explaining your project here.</p>
                                        </div>
                                        <div class="attech_body">
                                            <div class="file_item">
                                                <span><img src="assets/img/upload_placeholder.png"/> demo_image.png</span>
                                                <a href="#">Remove</a>
                                            </div>
                                            <div class="file_item">
                                                <span><img src="assets/img/upload_placeholder.png"/> demo_image.png</span>
                                                <a href="#">Remove</a>
                                            </div>
                                            <div class="file_item">
                                                <span><img src="assets/img/upload_placeholder.png"/> demo_image.png</span>
                                                <a href="#">Remove</a>
                                            </div>
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
        <!-- Search Tags -->
        <script>
            var KEYCODE_ESCAPE = 27;
            var KEYCODE_UP = 38;
            var KEYCODE_DOWN = 40;

            $('#input1').on('focus', function() {
                
                $('#list1').removeClass('hide');
                
            }).on('blur', function() {
                
                $('#list1').addClass('hide');
                $('#list1 .list-group-item.active').removeClass('active');
                
            }).on('keyup', function(e) {
                
                if (e.keyCode === KEYCODE_DOWN) {
                    
                    if ($('#list1.hide').length > 0) {
                        
                        $('#list1.hide').removeClass('hide');
                        
                    } else {
                        
                        if ($('#list1 .list-group-item.active').length > 0) {
                            if ($('#list1 .list-group-item.active').is(':last-child')) {
                                $('#list1 .list-group-item.active').removeClass('active');
                                $('#list1 .list-group-item:first-child').addClass('active');
                            } else {
                                $('#list1 .list-group-item.active').removeClass('active').next().addClass('active');
                            }
                        } else {
                            $('#list1 .list-group-item:first-child').addClass('active');
                        }
                        
                    }
                    
                } else if (e.keyCode === KEYCODE_UP) {
                    
                    if ($('#list1.hide').length > 0) {
                        
                        $('#list1.hide').removeClass('hide');
                        
                    } else {
                        
                        if ($('#list1 .list-group-item.active').length > 0) {
                            if ($('#list1 .list-group-item.active').is(':first-child')) {
                                $('#list1 .list-group-item.active').removeClass('active');
                                $('#list1 .list-group-item:last-child').addClass('active');
                            } else {
                                $('#list1 .list-group-item.active').removeClass('active').prev().addClass('active');
                            }
                        } else {
                            $('#list1 .list-group-item:last-child').addClass('active');
                        }
                        
                    }
                    
                } else if (e.keyCode === KEYCODE_ESCAPE) {
                    
                    $('#list1').addClass('hide');
                    $('#list1 .list-group-item.active').removeClass('active');
                    
                }
                
            });
        </script>

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <script>
            (function() {
                'use strict';

                function ctrls() {
                    var _this = this;

                    this.counter = 0;
                    this.els = {
                    decrement: document.querySelector('.ctrl__button--decrement'),
                    counter: {
                        container: document.querySelector('.ctrl__counter'),
                        num: document.querySelector('.ctrl__counter-num'),
                        input: document.querySelector('.ctrl__counter-input')
                    },
                    increment: document.querySelector('.ctrl__button--increment')
                    };

                    this.decrement = function() {
                    var counter = _this.getCounter();
                    var nextCounter = (_this.counter > 0) ? --counter : counter;
                    _this.setCounter(nextCounter);
                    };

                    this.increment = function() {
                    var counter = _this.getCounter();
                    var nextCounter = (counter < 9999999999) ? ++counter : counter;
                    _this.setCounter(nextCounter);
                    };

                    this.getCounter = function() {
                    return _this.counter;
                    };

                    this.setCounter = function(nextCounter) {
                    _this.counter = nextCounter;
                    };

                    this.debounce = function(callback) {
                    setTimeout(callback, 100);
                    };

                    this.render = function(hideClassName, visibleClassName) {
                    _this.els.counter.num.classList.add(hideClassName);

                    setTimeout(function() {
                        _this.els.counter.num.innerText = _this.getCounter();
                        _this.els.counter.input.value = _this.getCounter();
                        _this.els.counter.num.classList.add(visibleClassName);
                    }, 100);

                    setTimeout(function() {
                        _this.els.counter.num.classList.remove(hideClassName);
                        _this.els.counter.num.classList.remove(visibleClassName);
                    }, 1100);
                    };

                    this.ready = function() {
                    _this.els.decrement.addEventListener('click', function() {
                        _this.debounce(function() {
                        _this.decrement();
                        _this.render('is-decrement-hide', 'is-decrement-visible');
                        });
                    });

                    _this.els.increment.addEventListener('click', function() {
                        _this.debounce(function() {
                        _this.increment();
                        _this.render('is-increment-hide', 'is-increment-visible');
                        });
                    });

                    _this.els.counter.input.addEventListener('input', function(e) {
                        var parseValue = parseInt(e.target.value);
                        if (!isNaN(parseValue) && parseValue >= 0) {
                        _this.setCounter(parseValue);
                        _this.render();
                        }
                    });

                    _this.els.counter.input.addEventListener('focus', function(e) {
                        _this.els.counter.container.classList.add('is-input');
                    });

                    _this.els.counter.input.addEventListener('blur', function(e) {
                        _this.els.counter.container.classList.remove('is-input');
                        _this.render();
                    });
                    };
                };

                // init
                var controls = new ctrls();
                document.addEventListener('DOMContentLoaded', controls.ready);
                })();
        </script>

        <script src="https://unpkg.com/react@latest/umd/react.development.js"></script>
        <script src="https://unpkg.com/react-dom@latest/umd/react-dom.development.js"></script>
        <script src="https://unpkg.com/prop-types/prop-types.js"></script>
        <script src="https://unpkg.com/react-quill@latest/dist/react-quill.js"></script>
        <script>
@endpush
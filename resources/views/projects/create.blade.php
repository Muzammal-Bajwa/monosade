<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-free">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

        <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

        <meta name="description" content="" />

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{asset('public/new_assets/assets/img/favicon/favicon.ico')}}" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />

        <!-- Icons. Uncomment required icon fonts -->
        <link rel="stylesheet" href="{{asset('public/new_assets/assets/vendor/fonts/boxicons.css')}}" />

        <!-- Core CSS -->
        <link rel="stylesheet" href="{{asset('public/new_assets/assets/vendor/css/core.css')}}" class="template-customizer-core-css')}}" />
        <link rel="stylesheet" href="{{asset('public/new_assets/assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css')}}" />
        <link rel="stylesheet" href="{{asset('public/new_assets/assets/css/demo.css')}}" />
        <link rel="stylesheet" href="{{asset('public/new_assets/assets/css/icon_style.css')}}" />

        <!-- Vendors CSS -->
        <link rel="stylesheet" href="{{asset('public/new_assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

        <link rel="stylesheet" href="{{asset('public/new_assets/assets/vendor/libs/apex-charts/apex-charts.css')}}" />
        <link rel="stylesheet" href="https://unpkg.com/react-quill@1.0.0/dist/quill.core.css')}}">
        <link rel="stylesheet" href="https://unpkg.com/react-quill@1.0.0/dist/quill.snow.css')}}">
        <link rel="stylesheet" href="https://unpkg.com/react-quill@1.0.0/dist/quill.bubble.css')}}">

        <!-- Page CSS -->

        <!-- Helpers -->
        <script src="{{asset('public/new_assets/assets/vendor/js/helpers.js')}}"></script>

        <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
        <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
        <script src="{{asset('public/new_assets/assets/js/config.js')}}"></script>
    </head>

    <body>
        
        <section id="header">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <a href="#"><img src="{{asset('public/new_assets/assets/img/logo_main.png')}}" alt=""></a>
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
                        <form class="" method="post" action="{{ route('projects.store',$currentWorkspace->slug) }}">
                            @csrf
                                <div class="form-group">
                                    <label for="#">Project title</label>
                                    <input type="text" name="name" placeholder="E.g.  eCommerce app design"/>
                                </div>
                                <div class="form-group">
                                    <label for="#">Design category</label>
                                    <input type="text" placeholder="Search your category"/>
                                    <ul class="tags">
                                        <li><img src="{{asset('public/new_assets/assets/img/tick_green.png')}}" alt="">Social media posts</li>
                                        <li><img src="{{asset('public/new_assets/assets/img/tick_green.png')}}" alt="">Social media posts</li>
                                        <li><img src="{{asset('public/new_assets/assets/img/tick_green.png')}}" alt="">Social media posts</li>
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <label for="#">Dimensions</label>
                                    <p>Social media posts</p>
                                    <div class="item_cards">
                                        <a href="#">
                                            <div class="item">
                                                <span><img src="{{asset('public/new_assets/assets/img/uit_facebook-f.png')}}" alt=""></span>
                                                <h6>Facebook post</h6>
                                                <p>1080 X 1080</p>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="item">
                                                <span><img src="{{asset('public/new_assets/assets/img/uit_facebook-f.png')}}" alt=""></span>
                                                <h6>Facebook story</h6>
                                                <p>1080 X 1080</p>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="item">
                                                <span><img src="{{asset('public/new_assets/assets/img/instagram.png')}}" alt=""></span>
                                                <h6>Instagram post</h6>
                                                <p>1080 X 1080</p>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="item">
                                                <span><img src="{{asset('public/new_assets/assets/img/instagram.png')}}" alt=""></span>
                                                <h6>Instagram story</h6>
                                                <p>1080 X 1080</p>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="item">
                                                <span><img src="{{asset('public/new_assets/assets/img/custom.png')}}" alt=""></span>
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
                                    <textarea class="form-control" id="description" name="description" required="" placeholder="{{ __('Add Description') }}"></textarea>
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
                                <div class="modal-footer">
                                <input type="submit" value="{{ __('Add New project')}}" class="btn  btn-primary">
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Core JS -->
        <script src="{{asset('public/new_assets/assets/vendor/libs/jquery/jquery.js')}}"></script>
        <script src="{{asset('public/new_assets/assets/vendor/libs/popper/popper.js')}}"></script>
        <script src="{{asset('public/new_assets/assets/vendor/js/bootstrap.js')}}"></script>
        <script src="{{asset('public/new_assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

        <script src="{{asset('public/new_assets/assets/vendor/js/menu.js')}}"></script>
        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="{{asset('public/new_assets/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

        <!-- Main JS -->
        <script src="{{asset('public/new_assets/assets/js/main.js')}}"></script>

        <!-- Page JS -->
        <script src="{{asset('public/new_assets/assets/js/dashboards-analytics.js')}}"></script>

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
            /* 
            * Simple editor component that takes placeholder text as a prop 
            */
            class Editor extends React.Component {
            constructor(props) {
                super(props);
                this.state = { editorHtml: '', theme: 'snow' };
                this.handleChange = this.handleChange.bind(this);
            }

            handleChange(html) {
                this.setState({ editorHtml: html });
            }

            handleThemeChange(newTheme) {
                if (newTheme === "core") newTheme = null;
                this.setState({ theme: newTheme });
            }

            render() {
                return /*#__PURE__*/(
                React.createElement("div", null, /*#__PURE__*/
                React.createElement(ReactQuill, {
                    theme: this.state.theme,
                    onChange: this.handleChange,
                    value: this.state.editorHtml,
                    modules: Editor.modules,
                    formats: Editor.formats,
                    bounds: '.app',
                    placeholder: this.props.placeholder }), /*#__PURE__*/

                React.createElement("div", { className: "themeSwitcher" }, /*#__PURE__*/
                React.createElement("label", null, "Theme "), /*#__PURE__*/
                React.createElement("select", { onChange: (e) =>
                    this.handleThemeChange(e.target.value) }, /*#__PURE__*/
                React.createElement("option", { value: "snow" }, "Snow"), /*#__PURE__*/
                React.createElement("option", { value: "bubble" }, "Bubble"), /*#__PURE__*/
                React.createElement("option", { value: "core" }, "Core")))));




            }}


            /* 
            * Quill modules to attach to editor
            * See https://quilljs.com/docs/modules/ for complete options
            */
            Editor.modules = {
            toolbar: [
            [{ 'header': '1' }, { 'header': '2' }, { 'font': [] }],
            [{ size: [] }],
            ['bold', 'italic', 'underline', 'strike', 'blockquote'],
            [{ 'list': 'ordered' }, { 'list': 'bullet' },
            { 'indent': '-1' }, { 'indent': '+1' }],
            ['link', 'image', 'video'],
            ['clean']],

            clipboard: {
                // toggle to add extra line breaks when pasting HTML:
                matchVisual: false } };


            /* 
            * Quill editor formats
            * See https://quilljs.com/docs/formats/
            */
            Editor.formats = [
            'header', 'font', 'size',
            'bold', 'italic', 'underline', 'strike', 'blockquote',
            'list', 'bullet', 'indent',
            'link', 'image', 'video'];


            /* 
            * PropType validation
            */
            Editor.propTypes = {
            placeholder: PropTypes.string };


            /* 
            * Render component on page
            */
            ReactDOM.render( /*#__PURE__*/
            React.createElement(Editor, { placeholder: 'Write something...' }),
            document.querySelector('.app'));
        </script>
    </body>
</html>

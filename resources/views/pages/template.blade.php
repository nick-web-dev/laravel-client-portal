@extends('layouts.app')

@section('content')
<div class="content">
    <h2>Grid Layout</h2>
    <div class="row">
        <div class="col-12 mb-block"><div class="bg-gray" style="height: 50px;"></div></div>
        
        <div class="col-6 mb-block"><div class="bg-gray" style="height: 50px;"></div></div>
        <div class="col-6 mb-block"><div class="bg-gray" style="height: 50px;"></div></div>
        
        <div class="col-4 mb-block"><div class="bg-gray" style="height: 50px;"></div></div>
        <div class="col-4 mb-block"><div class="bg-gray" style="height: 50px;"></div></div>
        <div class="col-4 mb-block"><div class="bg-gray" style="height: 50px;"></div></div>
        
        <div class="col-3 mb-block"><div class="bg-gray" style="height: 50px;"></div></div>
        <div class="col-3 mb-block"><div class="bg-gray" style="height: 50px;"></div></div>
        <div class="col-3 mb-block"><div class="bg-gray" style="height: 50px;"></div></div>
        <div class="col-3 mb-block"><div class="bg-gray" style="height: 50px;"></div></div>
        
        <div class="col-2 mb-block"><div class="bg-gray" style="height: 50px;"></div></div>
        <div class="col-2 mb-block"><div class="bg-gray" style="height: 50px;"></div></div>
        <div class="col-2 mb-block"><div class="bg-gray" style="height: 50px;"></div></div>
        <div class="col-2 mb-block"><div class="bg-gray" style="height: 50px;"></div></div>
        <div class="col-2 mb-block"><div class="bg-gray" style="height: 50px;"></div></div>
        <div class="col-2 mb-block"><div class="bg-gray" style="height: 50px;"></div></div>
    </div>

    <hr>

    <h2>Typography</h2>
    <div class="row">
        <div class="col-lg-4">
            <h1>Heading 1</h1>
            <h2>Heading 2</h2>
            <h3>Heading 3</h3>
            <h4>Heading 4</h4>
            <h5>Heading 5</h5>
            <h6>Heading 6</h6>
            <h3>
                Heading
                <small class="text-muted">with muted text</small>
            </h3>
            <p class="lead">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
        </div>
        <div class="col-lg-4">
            <h2>Example body text</h2>
            <p>Nullam quis risus eget <a href="#">urna mollis ornare</a> vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.</p>
            <p><small>This line of text is meant to be treated as fine print.</small></p>
            <p>The following is <strong>rendered as bold text</strong>.</p>
            <p>The following is <em>rendered as italicized text</em>.</p>
            <p>An abbreviation of the word attribute is <abbr title="attribute">attr</abbr>.</p>
            
        </div>
        <div class="col-lg-4">
            <h2>Emphasis classes</h2>
            <p class="text-muted">Fusce dapibus, tellus ac cursus commodo, tortor mauris nibh.</p>
            <p class="text-primary">Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            <p class="text-secondary">Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
            <p class="text-warning">Etiam porta sem malesuada magna mollis euismod.</p>
            <p class="text-danger">Donec ullamcorper nulla non metus auctor fringilla.</p>
            <p class="text-success">Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
            <p class="text-info">Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
            
        </div>
    </div>

    <!-- Blockquotes -->

    <div class="row">
        <div class="col-lg-12">
            <h2 id="type-blockquotes">Blockquotes</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <blockquote class="blockquote">
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
            </blockquote>
        </div>
        <div class="col-lg-4">
            <blockquote class="blockquote text-center">
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
            </blockquote>
        </div>
        <div class="col-lg-4">
            <blockquote class="blockquote text-right">
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
            </blockquote>
        </div>
    </div>

    <hr>

    <div class="bg-white p-6">
        <h2 class="mt-0">Colors</h2>
        <div class="row">
            <div class="col-6">
                <div class="row mb-4">
                    <div class="col">
                        Slate
                        <div class="aspect-ratio-1-1 bg-slate"></div>
                    </div>
                    <div class="col">
                        Direct
                        <div class="aspect-ratio-1-1 bg-direct"></div>
                    </div>
                    <div class="col">
                        Fullfillment
                        <div class="aspect-ratio-1-1 bg-fullfillment"></div>
                    </div>
                    <div class="col">
                        Ecommerce
                        <div class="aspect-ratio-1-1 bg-ecommerce"></div>
                    </div>
                    <div class="col">
                        Callcenter
                        <div class="aspect-ratio-1-1 bg-callcenter"></div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <div class="aspect-ratio-1-1 bg-slate opacity-60"></div>
                    </div>
                    <div class="col">
                        <div class="aspect-ratio-1-1 bg-direct opacity-60"></div>
                    </div>
                    <div class="col">
                        <div class="aspect-ratio-1-1 bg-fullfillment opacity-60"></div>
                    </div>
                    <div class="col">
                        <div class="aspect-ratio-1-1 bg-ecommerce opacity-60"></div>
                    </div>
                    <div class="col">
                        <div class="aspect-ratio-1-1 bg-callcenter opacity-60"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="aspect-ratio-1-1 bg-slate opacity-30"></div>
                    </div>
                    <div class="col">
                        <div class="aspect-ratio-1-1 bg-direct opacity-30"></div>
                    </div>
                    <div class="col">
                        <div class="aspect-ratio-1-1 bg-fullfillment opacity-30"></div>
                    </div>
                    <div class="col">
                        <div class="aspect-ratio-1-1 bg-ecommerce opacity-30"></div>
                    </div>
                    <div class="col">
                        <div class="aspect-ratio-1-1 bg-callcenter opacity-30"></div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row mb-4">
                    <div class="col">
                        Light
                        <div class="aspect-ratio-1-1 bg-light"></div>
                    </div>
                    <div class="col">
                        Golden
                        <div class="aspect-ratio-1-1 bg-golden"></div>
                    </div>
                    <div class="col">
                        Ice
                        <div class="aspect-ratio-1-1 bg-ice"></div>
                    </div>
                    <div class="col">
                        Wheat
                        <div class="aspect-ratio-1-1 bg-wheat"></div>
                    </div>
                    <div class="col">
                        Heather
                        <div class="aspect-ratio-1-1 bg-heather"></div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <div class="aspect-ratio-1-1 bg-light opacity-60"></div>
                    </div>
                    <div class="col">
                        <div class="aspect-ratio-1-1 bg-golden opacity-60"></div>
                    </div>
                    <div class="col">
                        <div class="aspect-ratio-1-1 bg-ice opacity-60"></div>
                    </div>
                    <div class="col">
                        <div class="aspect-ratio-1-1 bg-wheat opacity-60"></div>
                    </div>
                    <div class="col">
                        <div class="aspect-ratio-1-1 bg-heather opacity-60"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="aspect-ratio-1-1 bg-light opacity-30"></div>
                    </div>
                    <div class="col">
                        <div class="aspect-ratio-1-1 bg-golden opacity-30"></div>
                    </div>
                    <div class="col">
                        <div class="aspect-ratio-1-1 bg-ice opacity-30"></div>
                    </div>
                    <div class="col">
                        <div class="aspect-ratio-1-1 bg-wheat opacity-30"></div>
                    </div>
                    <div class="col">
                        <div class="aspect-ratio-1-1 bg-heather opacity-30"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="d-none d-md-block">
        
        <h2>Buttons</h2>
        <h3 class="mb-0">Solid</h3>
        <div class="row mb-4 align-items-center text-center">
            <div class="col"><button type="button" class="btn btn-dark btn-xl">Default</button></div>
            <div class="col"><button type="button" class="btn btn-dark btn-lg">Default</button></div>
            <div class="col"><button type="button" class="btn btn-dark btn-sm">Default</button></div>
            
            <div class="col"><button type="button" class="btn btn-dark">Default</button></div>
            <div class="col"><button type="button" class="btn btn-dark text-nowrap">Default <i class="fa fa-square-full ml-4"></i></button></div>
            <div class="col"><button type="button" class="btn btn-dark"><i class="fa fa-square-full"></i></button></div>
            
            <div class="col"><button type="button" class="btn btn-primary">Primary</button></div>
            <div class="col"><button type="button" class="btn btn-secondary">Secondary</button></div>
            <div class="col"><button type="button" class="btn btn-success">Success</button></div>
            <div class="col"><button type="button" class="btn btn-info">Info</button></div>
            <div class="col"><button type="button" class="btn btn-warning">Warning</button></div>
            <div class="col"><button type="button" class="btn btn-danger">Danger</button></div>
        </div>
        
        <h3 class="mb-0">Disabled</h3>
        <div class="row mb-4 align-items-center text-center">
            <div class="col"><button type="button" class="btn btn-dark disabled btn-xl">Default</button></div>
            <div class="col"><button type="button" class="btn btn-dark disabled btn-lg">Default</button></div>
            <div class="col"><button type="button" class="btn btn-dark disabled btn-sm">Default</button></div>
            
            <div class="col"><button type="button" class="btn btn-dark disabled">Default</button></div>
            <div class="col"><button type="button" class="btn btn-dark disabled text-nowrap">Default <i class="fa fa-square-full ml-4"></i></button></div>
            <div class="col"><button type="button" class="btn btn-dark disabled"><i class="fa fa-square-full"></i></button></div>
            
            <div class="col"><button type="button" class="btn btn-primary disabled">Primary</button></div>
            <div class="col"><button type="button" class="btn btn-secondary disabled">Secondary</button></div>
            <div class="col"><button type="button" class="btn btn-success disabled">Success</button></div>
            <div class="col"><button type="button" class="btn btn-info disabled">Info</button></div>
            <div class="col"><button type="button" class="btn btn-warning disabled">Warning</button></div>
            <div class="col"><button type="button" class="btn btn-danger disabled">Danger</button></div>
        </div>
        
        <h3 class="mb-0">Secondary</h3>
        <div class="row mb-4 align-items-center text-center">
            <div class="col"><button type="button" class="btn btn-outline-dark btn-xl">Default</button></div>
            <div class="col"><button type="button" class="btn btn-outline-dark btn-lg">Default</button></div>
            <div class="col"><button type="button" class="btn btn-outline-dark btn-sm">Default</button></div>
            
            <div class="col"><button type="button" class="btn btn-outline-dark">Default</button></div>
            <div class="col"><button type="button" class="btn btn-outline-dark text-nowrap">Default <i class="fa fa-square-full ml-4"></i></button></div>
            <div class="col"><button type="button" class="btn btn-outline-dark"><i class="fa fa-square-full"></i></button></div>
            
            <div class="col"><button type="button" class="btn btn-outline-primary">Primary</button></div>
            <div class="col"><button type="button" class="btn btn-outline-secondary">Secondary</button></div>
            <div class="col"><button type="button" class="btn btn-outline-success">Success</button></div>
            <div class="col"><button type="button" class="btn btn-outline-info">Info</button></div>
            <div class="col"><button type="button" class="btn btn-outline-warning">Warning</button></div>
            <div class="col"><button type="button" class="btn btn-outline-danger">Danger</button></div>
        </div>
        
        <h3 class="mb-0">Ghost</h3>
        <div class="row mb-4 align-items-center text-center">
            <div class="col"><button type="button" class="btn btn-alt-dark btn-xl">Default</button></div>
            <div class="col"><button type="button" class="btn btn-alt-dark btn-lg">Default</button></div>
            <div class="col"><button type="button" class="btn btn-alt-dark btn-sm">Default</button></div>
            
            <div class="col"><button type="button" class="btn btn-alt-dark">Default</button></div>
            <div class="col"><button type="button" class="btn btn-alt-dark text-nowrap">Default <i class="fa fa-square-full ml-4"></i></button></div>
            <div class="col"><button type="button" class="btn btn-alt-dark"><i class="fa fa-square-full"></i></button></div>
            
            <div class="col"><button type="button" class="btn btn-alt-primary">Primary</button></div>
            <div class="col"><button type="button" class="btn btn-alt-secondary">Secondary</button></div>
            <div class="col"><button type="button" class="btn btn-alt-success">Success</button></div>
            <div class="col"><button type="button" class="btn btn-alt-info">Info</button></div>
            <div class="col"><button type="button" class="btn btn-alt-warning">Warning</button></div>
            <div class="col"><button type="button" class="btn btn-alt-danger">Danger</button></div>
        </div>
    </div>


    <h2>Dialog / Modal</h2>
    <a href="#modal-block-normal" class="btn btn-primary mb-4" data-toggle="modal">Show Pop-up</a>
    <div class="modal" id="modal-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-0">
                <div class="block mb-0">
                    <div class="block-header">
                        <div class="media w-100">
                            <div class="pic mr-6 position-relative">
                                <img src="//source.unsplash.com/random/64x64" alt="" class="rounded-circle">
                                <i class="position-absolute fa fa-plus-circle bg-white rounded-circle" style="bottom: 0; right: 0;"></i>
                            </div>
                            <div class="media-body d-flex">
                                <h3 class="block-title">Pop-up Title <br> <small class="text-primary">Subtext</small></h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option fa-lg" data-dismiss="modal" aria-label="Close">
                                        &times;
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content bg-light">
                        <p>GOiA, a Cardiff-based business, is speaking to councils about being the first company to operate scooters for hire in Wales.</p>
                        
                        <p>Founder Jarrad Morris said: "I think now with public transport, the capacity has been decreased by 70-90%... there's a massive lack at the moment of transport options for individuals in cities to get around places.</p>
                        
                        <p>"It's green, it's in line with green air targets... it's a massive opportunity."</p>
                        
                        <p>The e-scooters are app-based and can be hired for about £2 for 20 minutes.</p>
                        
                        <ul>
                            <li>When can I ride an e-scooter legally?</li>
                            <li>How to upgrade your bike into an electric bicycle</li>
                            <li>First e-scooters trial launched in town</li>
                        </ul>
                        
                        <p>GOiA would also have docks the e-scooters would need to be returned to, which the company said would stop the dumping of the vehicles seen in other European countries.</p>
                    </div>
                    <div class="block-content block-footer p-0 d-flex">
                        <button type="button" class="btn btn-xl btn-default flex-grow-1" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-xl btn-dark flex-grow-1" data-dismiss="modal">Done</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h2>Widgets</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="block block-rounded block-bordered">
                <div class="block-header d-flex">
                    <h3 class="block-title">Widget <small>Subtitle</small></h3>
                    <div class="fa fa-md fa-plus"></div>
                </div>
                <div class="block-content p-0">
                    <div class="aspect-ratio-16-9">
                        <ul class="list-group widget-list list-group-flush">
                            <li class="list-group-item">
                                Text
                                <i class="indicator text-success fa fa-circle"></i>
                            </li>
                            <li class="list-group-item">
                                Text
                                <i class="indicator text-success fa fa-circle"></i>
                            </li>
                            <li class="list-group-item">
                                Text
                                <i class="indicator text-success fa fa-circle"></i>
                            </li>
                            <li class="list-group-item">
                                Text
                                <i class="indicator text-success fa fa-circle"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="block block-rounded block-bordered">
                <div class="block-header d-flex">
                    <h3 class="block-title">Announcements</h3>
                    <div class="fa fa-md fa-plus"></div>
                </div>
                <div class="block-content">
                    <div class="aspect-ratio-16-9 text-center">
                        <i class="fa fa-lg fa-bullhorn mt-10 mb-6"></i>
                        <p>No announcements <br>at this time</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="block block-rounded block-bordered">
                <div class="block-header block-header-default d-flex">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="fa fa-md fa-plus"></div>
                </div>
                <div class="block-content block-content-full">
                    <div class="js-pie-chart pie-chart" data-percent="50" data-line-width="26" data-size="300" data-bar-color="#404040" data-line-cap="butt" data-track-color="#e9e9e9">
                        <span>
                            <span class="h3 text-monospace">50%</span> <br>
                            <span class="text-muted">Text</span>
                        </span>
                    </div>
                </div>
                <div class="block-content block-content-full bg-light">
                    <i class="fa fa-circle"></i> Text
                    <i class="fa fa-circle ml-4"></i> Text
                    <i class="fa fa-circle ml-4"></i> Text
                </div>
            </div>
        </div>
    </div>


    <div class="mb-20"></div>
</div>
<!-- END Page Content -->
@endsection

@push('js_after')
    <script src="{{ asset('js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script>
        $(function(){
            Dashmix.helpers('easy-pie-chart');
        });
    </script>
@endpush
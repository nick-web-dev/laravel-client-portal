@extends('layouts.app')

@section('content')
<div class="content">
    
    <!-- Buttons
    ================================================== -->
    <div class="bs-docs-section">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-12">
          <h1 id="buttons">Buttons</h1>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-lg-7">
    
        <p class="bs-component">
          <button type="button" class="btn btn-dark">Default</button>
          <button type="button" class="btn btn-primary">Primary</button>
          <button type="button" class="btn btn-secondary">Secondary</button>
          <button type="button" class="btn btn-success">Success</button>
          <button type="button" class="btn btn-info">Info</button>
          <button type="button" class="btn btn-warning">Warning</button>
          <button type="button" class="btn btn-danger">Danger</button>
          <button type="button" class="btn btn-link">Link</button>
        </p>
    
        <p class="bs-component">
          <button type="button" class="btn btn-dark disabled">Default</button>
          <button type="button" class="btn btn-primary disabled">Primary</button>
          <button type="button" class="btn btn-secondary disabled">Secondary</button>
          <button type="button" class="btn btn-success disabled">Success</button>
          <button type="button" class="btn btn-info disabled">Info</button>
          <button type="button" class="btn btn-warning disabled">Warning</button>
          <button type="button" class="btn btn-danger disabled">Danger</button>
          <button type="button" class="btn btn-link disabled">Link</button>
        </p>
    
        <p class="bs-component">
          <button type="button" class="btn btn-outline-dark">Default</button>
          <button type="button" class="btn btn-outline-primary">Primary</button>
          <button type="button" class="btn btn-outline-secondary">Secondary</button>
          <button type="button" class="btn btn-outline-success">Success</button>
          <button type="button" class="btn btn-outline-info">Info</button>
          <button type="button" class="btn btn-outline-warning">Warning</button>
          <button type="button" class="btn btn-outline-danger">Danger</button>
        </p>
    
        <p class="bs-component">
          <button type="button" class="btn btn-alt-dark">Default</button>
          <button type="button" class="btn btn-alt-primary">Primary</button>
          <button type="button" class="btn btn-alt-secondary">Secondary</button>
          <button type="button" class="btn btn-alt-success">Success</button>
          <button type="button" class="btn btn-alt-info">Info</button>
          <button type="button" class="btn btn-alt-warning">Warning</button>
          <button type="button" class="btn btn-alt-danger">Danger</button>
        </p>
    
        <div class="bs-component mb-3">
          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-primary">Primary</button>
            <div class="btn-group" role="group">
              <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item" href="#">Dropdown link</a>
                <a class="dropdown-item" href="#">Dropdown link</a>
              </div>
            </div>
          </div>
    
          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-success">Success</button>
            <div class="btn-group" role="group">
              <button id="btnGroupDrop2" type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                <a class="dropdown-item" href="#">Dropdown link</a>
                <a class="dropdown-item" href="#">Dropdown link</a>
              </div>
            </div>
          </div>
          
          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-info">Info</button>
            <div class="btn-group" role="group">
              <button id="btnGroupDrop3" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop3">
                <a class="dropdown-item" href="#">Dropdown link</a>
                <a class="dropdown-item" href="#">Dropdown link</a>
              </div>
            </div>
          </div>
          
          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-danger">Danger</button>
            <div class="btn-group" role="group">
              <button id="btnGroupDrop4" type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop4">
                <a class="dropdown-item" href="#">Dropdown link</a>
                <a class="dropdown-item" href="#">Dropdown link</a>
              </div>
            </div>
          </div>
        </div>
    
        <div class="bs-component">
          <button type="button" class="btn btn-primary btn-lg">Large button</button>
          <button type="button" class="btn btn-primary">Default button</button>
          <button type="button" class="btn btn-primary btn-sm">Small button</button>
        </div>
    
      </div>
      <div class="col-lg-5">
    
        <p class="bs-component">
          <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button>
        </p>
    
        <div class="bs-component" style="margin-bottom: 15px;">
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-primary active">
              <input type="checkbox" checked autocomplete="off"> Active
            </label>
            <label class="btn btn-primary">
              <input type="checkbox" autocomplete="off"> Check
            </label>
            <label class="btn btn-primary">
              <input type="checkbox" autocomplete="off"> Check
            </label>
          </div>
        </div>
    
        <div class="bs-component" style="margin-bottom: 15px;">
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-primary active">
              <input type="radio" name="options" id="option1" autocomplete="off" checked> Active
            </label>
            <label class="btn btn-primary">
              <input type="radio" name="options" id="option2" autocomplete="off"> Radio
            </label>
            <label class="btn btn-primary">
              <input type="radio" name="options" id="option3" autocomplete="off"> Radio
            </label>
          </div>
        </div>
    
        <div class="bs-component">
          <div class="btn-group-vertical">
            <button type="button" class="btn btn-primary">Button</button>
            <button type="button" class="btn btn-primary">Button</button>
            <button type="button" class="btn btn-primary">Button</button>
            <button type="button" class="btn btn-primary">Button</button>
            <button type="button" class="btn btn-primary">Button</button>
            <button type="button" class="btn btn-primary">Button</button>
          </div>
        </div>
    
        <div class="bs-component" style="margin-bottom: 15px;">
          <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-secondary">Left</button>
            <button type="button" class="btn btn-secondary">Middle</button>
            <button type="button" class="btn btn-secondary">Right</button>
          </div>
        </div>
    
        <div class="bs-component" style="margin-bottom: 15px;">
          <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group mr-2" role="group" aria-label="First group">
              <button type="button" class="btn btn-secondary">1</button>
              <button type="button" class="btn btn-secondary">2</button>
              <button type="button" class="btn btn-secondary">3</button>
              <button type="button" class="btn btn-secondary">4</button>
            </div>
            <div class="btn-group mr-2" role="group" aria-label="Second group">
              <button type="button" class="btn btn-secondary">5</button>
              <button type="button" class="btn btn-secondary">6</button>
              <button type="button" class="btn btn-secondary">7</button>
            </div>
            <div class="btn-group" role="group" aria-label="Third group">
              <button type="button" class="btn btn-secondary">8</button>
            </div>
          </div>
        </div>
    
      </div>
    </div>
    </div>
    
    <!-- Typography
    ================================================== -->
    <div class="bs-docs-section">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1 id="typography">Typography</h1>
        </div>
      </div>
    </div>
    
    <!-- Headings -->
    
    <div class="row">
      <div class="col-lg-4">
        <div class="bs-component">
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
      </div>
      <div class="col-lg-4">
        <div class="bs-component">
          <h2>Example body text</h2>
          <p>Nullam quis risus eget <a href="#">urna mollis ornare</a> vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.</p>
          <p><small>This line of text is meant to be treated as fine print.</small></p>
          <p>The following is <strong>rendered as bold text</strong>.</p>
          <p>The following is <em>rendered as italicized text</em>.</p>
          <p>An abbreviation of the word attribute is <abbr title="attribute">attr</abbr>.</p>
        </div>
    
      </div>
      <div class="col-lg-4">
        <div class="bs-component">
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
    </div>
    
    <!-- Blockquotes -->
    
    <div class="row">
      <div class="col-lg-12">
        <h2 id="type-blockquotes">Blockquotes</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4">
        <div class="bs-component">
          <blockquote class="blockquote">
            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
            <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
          </blockquote>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="bs-component">
          <blockquote class="blockquote text-center">
            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
            <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
          </blockquote>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="bs-component">
          <blockquote class="blockquote text-right">
            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
            <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
          </blockquote>
        </div>
      </div>
    </div>
    </div>
    
    <!-- Tables
    ================================================== -->
    <div class="bs-docs-section">
    
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1 id="tables">Tables</h1>
        </div>
    
        <div class="bs-component">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Type</th>
                <th scope="col">Column heading</th>
                <th scope="col">Column heading</th>
                <th scope="col">Column heading</th>
              </tr>
            </thead>
            <tbody>
              <tr class="table-active">
                <th scope="row">Active</th>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
              </tr>
              <tr>
                <th scope="row">Default</th>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
              </tr>
              <tr class="table-primary">
                <th scope="row">Primary</th>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
              </tr>
              <tr class="table-secondary">
                <th scope="row">Secondary</th>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
              </tr>
              <tr class="table-success">
                <th scope="row">Success</th>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
              </tr>
              <tr class="table-danger">
                <th scope="row">Danger</th>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
              </tr>
              <tr class="table-warning">
                <th scope="row">Warning</th>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
              </tr>
              <tr class="table-info">
                <th scope="row">Info</th>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
              </tr>
              <tr class="table-light">
                <th scope="row">Light</th>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
              </tr>
              <tr class="table-dark">
                <th scope="row">Dark</th>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
              </tr>
            </tbody>
          </table> 
        </div><!-- /example -->
      </div>
    </div>
    </div>
    
    <!-- Forms
    ================================================== -->
    <div class="bs-docs-section">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1 id="forms">Forms</h1>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-lg-6">
        <div class="bs-component">
          <form>
            <fieldset>
              <legend>Legend</legend>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
              </div>
              <div class="form-group">
                <label for="exampleSelect1">Example select</label>
                <select class="form-control" id="exampleSelect1">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleSelect2">Example multiple select</label>
                <select multiple class="form-control" id="exampleSelect2">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleTextarea">Example textarea</label>
                <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
              </div>
              <fieldset class="form-group">
                <legend>Radio buttons</legend>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                    Option one is this and that&mdash;be sure to include why it's great
                  </label>
                </div>
                <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2">
                    Option two can be something else and selecting it will deselect option one
                  </label>
                </div>
                <div class="form-check disabled">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios3" value="option3" disabled>
                    Option three is disabled
                  </label>
                </div>
              </fieldset>
              <fieldset class="form-group">
                <legend>Checkboxes</legend>
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="" checked>
                    Option one is this and that&mdash;be sure to include why it's great
                  </label>
                </div>
                <div class="form-check disabled">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="" disabled>
                    Option two is disabled
                  </label>
                </div>
              </fieldset>
              <fieldset class="form-group">
                <legend>Sliders</legend>
                <label for="customRange1">Example range</label>
                <input type="range" class="custom-range" id="customRange1">
              </fieldset>
              <button type="submit" class="btn btn-primary">Submit</button>
            </fieldset>
          </form>
        </div>
      </div>
      <div class="col-lg-4 offset-lg-1">
    
        <form class="bs-component">
          <div class="form-group">
            <fieldset disabled>
              <label class="control-label" for="disabledInput">Disabled input</label>
              <input class="form-control" id="disabledInput" type="text" placeholder="Disabled input here..." disabled="">
            </fieldset>
          </div>
    
          <div class="form-group">
            <fieldset>
              <label class="control-label" for="readOnlyInput">Readonly input</label>
              <input class="form-control" id="readOnlyInput" type="text" placeholder="Readonly input here…" readonly>
            </fieldset>
          </div>
    
          <div class="form-group has-success">
            <label class="form-control-label" for="inputSuccess1">Valid input</label>
            <input type="text" value="correct value" class="form-control is-valid" id="inputValid">
            <div class="valid-feedback">Success! You've done it.</div>
          </div>
    
          <div class="form-group has-danger">
            <label class="form-control-label" for="inputDanger1">Invalid input</label>
            <input type="text" value="wrong value" class="form-control is-invalid" id="inputInvalid">
            <div class="invalid-feedback">Sorry, that username's taken. Try another?</div>
          </div>
    
          <div class="form-group">
            <label class="col-form-label col-form-label-lg" for="inputLarge">Large input</label>
            <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg" id="inputLarge">
          </div>
    
          <div class="form-group">
            <label class="col-form-label" for="inputDefault">Default input</label>
            <input type="text" class="form-control" placeholder="Default input" id="inputDefault">
          </div>
    
          <div class="form-group">
            <label class="col-form-label col-form-label-sm" for="inputSmall">Small input</label>
            <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm" id="inputSmall">
          </div>
    
          <div class="form-group">
            <label class="control-label">Input addons</label>
            <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">$</span>
                </div>
                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                <div class="input-group-append">
                  <span class="input-group-text">.00</span>
                </div>
              </div>
            </div>
          </div>
        </form>
    
        <div class="bs-component">
          <fieldset>
            <legend>Custom forms</legend>
            <div class="form-group">
              <div class="custom-control custom-radio">
                <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" checked>
                <label class="custom-control-label" for="customRadio1">Toggle this custom radio</label>
              </div>
              <div class="custom-control custom-radio">
                <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                <label class="custom-control-label" for="customRadio2">Or toggle this other custom radio</label>
              </div>
              <div class="custom-control custom-radio">
                <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input" disabled>
                <label class="custom-control-label" for="customRadio3">Disabled custom radio</label>
              </div>
            </div>
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck1" checked>
                <label class="custom-control-label" for="customCheck1">Check this custom checkbox</label>
              </div>
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck2" disabled>
                <label class="custom-control-label" for="customCheck2">Disabled custom checkbox</label>
              </div>
            </div>
            <div class="form-group">
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                <label class="custom-control-label" for="customSwitch1">Toggle this switch element</label>
              </div>
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" disabled id="customSwitch2">
                <label class="custom-control-label" for="customSwitch2">Disabled switch element</label>
              </div>
            </div>
            <div class="form-group">
              <select class="custom-select">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
            <div class="form-group">
              <div class="input-group mb-3">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="inputGroupFile02">
                  <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                </div>
                <div class="input-group-append">
                  <span class="input-group-text" id="">Upload</span>
                </div>
              </div>
            </div>
          </fieldset>
        </div>
    
      </div>
    </div>
    </div>
    
    <!-- Navs
    ================================================== -->
    <div class="bs-docs-section">
    
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1 id="navs">Navs</h1>
        </div>
      </div>
    </div>
    
    <div class="row" style="margin-bottom: 2rem;">
      <div class="col-lg-6">
        <h2 id="nav-tabs">Tabs</h2>
        <div class="bs-component">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#profile">Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
              </div>
            </li>
          </ul>
          <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade show active" id="home">
              <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis blockigan american apparel, butcher voluptate nisi qui.</p>
            </div>
            <div class="tab-pane fade" id="profile">
              <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit.</p>
            </div>
            <div class="tab-pane fade" id="dropdown1">
              <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork.</p>
            </div>
            <div class="tab-pane fade" id="dropdown2">
              <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater.</p>
            </div>
          </div>
        </div>
      </div>
    
      <div class="col-lg-6">
        <h2 id="nav-pills">Pills</h2>
        <div class="bs-component">
          <ul class="nav nav-pills">
            <li class="nav-item">
              <a class="nav-link active" href="#">Active</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
          </ul>
        </div>
        <br>
        <div class="bs-component">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="#">Active</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-lg-6">
        <h2 id="nav-breadcrumbs">Breadcrumbs</h2>
        <div class="bs-component">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active">Home</li>
          </ol>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Library</li>
          </ol>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active">Data</li>
          </ol>
        </div>
      </div>
    
      <div class="col-lg-6">
        <h2 id="pagination">Pagination</h2>
        <div class="bs-component">
          <div>
            <ul class="pagination">
              <li class="page-item disabled">
                <a class="page-link" href="#">&laquo;</a>
              </li>
              <li class="page-item active">
                <a class="page-link" href="#">1</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">2</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">3</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">4</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">5</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">&raquo;</a>
              </li>
            </ul>
          </div>
    
          <div>
            <ul class="pagination pagination-lg">
              <li class="page-item disabled">
                <a class="page-link" href="#">&laquo;</a>
              </li>
              <li class="page-item active">
                <a class="page-link" href="#">1</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">2</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">3</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">4</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">5</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">&raquo;</a>
              </li>
            </ul>
          </div>
    
          <div>
            <ul class="pagination pagination-sm">
              <li class="page-item disabled">
                <a class="page-link" href="#">&laquo;</a>
              </li>
              <li class="page-item active">
                <a class="page-link" href="#">1</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">2</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">3</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">4</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">5</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">&raquo;</a>
              </li>
            </ul>
          </div>
    
        </div>
      </div>
    </div>
    </div>
    
    <!-- Indicators
    ================================================== -->
    <div class="bs-docs-section">
    
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1 id="indicators">Indicators</h1>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-lg-12">
        <h2>Alerts</h2>
        <div class="bs-component">
          <div class="alert alert-dismissible alert-warning">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4 class="alert-heading">Warning!</h4>
            <p class="mb-0">Best check yo self, you're not looking too good. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna, <a href="#" class="alert-link">vel scelerisque nisl consectetur et</a>.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4">
        <div class="bs-component">
          <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Oh snap!</strong> <a href="#" class="alert-link">Change a few things up</a> and try submitting again.
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="bs-component">
          <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Well done!</strong> You successfully read <a href="#" class="alert-link">this important alert message</a>.
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="bs-component">
          <div class="alert alert-dismissible alert-info">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Heads up!</strong> This <a href="#" class="alert-link">alert needs your attention</a>, but it's not super important.
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4">
        <div class="bs-component">
          <div class="alert alert-dismissible alert-primary">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Oh snap!</strong> <a href="#" class="alert-link">Change a few things up</a> and try submitting again.
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="bs-component">
          <div class="alert alert-dismissible alert-secondary">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Well done!</strong> You successfully read <a href="#" class="alert-link">this important alert message</a>.
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="bs-component">
          <div class="alert alert-dismissible alert-light">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Heads up!</strong> This <a href="#" class="alert-link">alert needs your attention</a>, but it's not super important.
          </div>
        </div>
      </div>
    </div>
    <div>
      <h2>Badges</h2>
      <div class="bs-component" style="margin-bottom: 40px;">
        <span class="badge badge-primary">Primary</span>
        <span class="badge badge-secondary">Secondary</span>
        <span class="badge badge-success">Success</span>
        <span class="badge badge-danger">Danger</span>
        <span class="badge badge-warning">Warning</span>
        <span class="badge badge-info">Info</span>
        <span class="badge badge-light">Light</span>
        <span class="badge badge-dark">Dark</span>
      </div>
      <div class="bs-component">
        <span class="badge badge-pill badge-primary">Primary</span>
        <span class="badge badge-pill badge-secondary">Secondary</span>
        <span class="badge badge-pill badge-success">Success</span>
        <span class="badge badge-pill badge-danger">Danger</span>
        <span class="badge badge-pill badge-warning">Warning</span>
        <span class="badge badge-pill badge-info">Info</span>
        <span class="badge badge-pill badge-light">Light</span>
        <span class="badge badge-pill badge-dark">Dark</span>
      </div>
    </div>
    </div>
    
    <!-- Progress
    ================================================== -->
    <div class="bs-docs-section">
    
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1 id="progress">Progress</h1>
        </div>
    
        <h3 id="progress-basic">Basic</h3>
        <div class="bs-component">
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
    
        <h3 id="progress-alternatives">Contextual alternatives</h3>
        <div class="bs-component">
          <div class="progress">
            <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="progress">
            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="progress">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="progress">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
    
        <h3 id="progress-multiple">Multiple bars</h3>
        <div class="bs-component">
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
            <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
            <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
    
        <h3 id="progress-striped">Striped</h3>
        <div class="bs-component">
          <div class="progress">
            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
    
        <h3 id="progress-animated">Animated</h3>
        <div class="bs-component">
          <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
          </div>
        </div>
      </div>
    </div>
    </div>
    
    <!-- Containers
    ================================================== -->
    <div class="bs-docs-section">
    
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1 id="containers">Containers</h1>
        </div>
        <div class="bs-component">
          <div class="jumbotron">
            <h1 class="display-3">Hello, world!</h1>
            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <p class="lead">
              <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p>
          </div>
        </div>
      </div>
    </div>
    
    
    <div class="row">
      <div class="col-lg-12">
        <h2>List groups</h2>
      </div>
    </div>
    
    <div class="row">
      <div class="col-lg-4">
        <div class="bs-component">
          <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Cras justo odio
              <span class="badge badge-primary badge-pill">14</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Dapibus ac facilisis in
              <span class="badge badge-primary badge-pill">2</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Morbi leo risus
              <span class="badge badge-primary badge-pill">1</span>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="bs-component">
          <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action active">
              Cras justo odio
            </a>
            <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in
            </a>
            <a href="#" class="list-group-item list-group-item-action disabled">Morbi leo risus
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="bs-component">
          <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">List group item heading</h5>
                <small>3 days ago</small>
              </div>
              <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
              <small>Donec id elit non mi porta.</small>
            </a>
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">List group item heading</h5>
                <small class="text-muted">3 days ago</small>
              </div>
              <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
              <small class="text-muted">Donec id elit non mi porta.</small>
            </a>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Rounded Blocks -->
    <h2 class="content-heading">Rounded Blocks</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="block block-rounded">
                <div class="block-header">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                </div>
                <div class="block-content">
                    <p>Simple block..</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                </div>
                <div class="block-content">
                    <p>With header background..</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-rounded block-bordered">
                <div class="block-header d-flex">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="fa fa-md fa-plus"></div>
                </div>
                <div class="block-content">
                    <p>Bordered block..</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-rounded block-bordered">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                </div>
                <div class="block-content">
                    <p>Bordered block with header background..</p>
                </div>
            </div>
        </div>
    </div>
    <!-- END Rounded Blocks -->

    <!-- Blocks with Footer -->
    <h2 class="content-heading">Blocks with Footer</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                </div>
                <div class="block-content">
                    <p>Simple block..</p>
                </div>
                <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                    Footer content..
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                </div>
                <div class="block-content">
                    <p>With header background..</p>
                </div>
                <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                    Footer content..
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-bordered">
                <div class="block-header">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                </div>
                <div class="block-content">
                    <p>Bordered block..</p>
                </div>
                <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                    Footer content..
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-bordered">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                </div>
                <div class="block-content">
                    <p>Bordered block with header background..</p>
                </div>
                <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                    Footer content..
                </div>
            </div>
        </div>
    </div>
    <!-- END Blocks with Footer -->

     <div class="row">
        <div class="col-md-6">
            <div class="block block-themed">
                <div class="block-header">
                    <h3 class="block-title">Primary</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-settings"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Block’s content..</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-themed">
                <div class="block-header bg-primary-light">
                    <h3 class="block-title">Primary Light</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-settings"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Block’s content..</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-themed">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Primary Dark</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-settings"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Block’s content..</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-themed">
                <div class="block-header bg-primary-darker">
                    <h3 class="block-title">Primary Darker</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-settings"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Block’s content..</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-themed">
                <div class="block-header bg-success">
                    <h3 class="block-title">Success</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-settings"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Block’s content..</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-themed">
                <div class="block-header bg-info">
                    <h3 class="block-title">Info</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-settings"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Block’s content..</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-themed">
                <div class="block-header bg-warning">
                    <h3 class="block-title">Warning</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-settings"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Block’s content..</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-themed">
                <div class="block-header bg-danger">
                    <h3 class="block-title">Danger</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-settings"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Block’s content..</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-themed">
                <div class="block-header bg-gray">
                    <h3 class="block-title">Gray</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-settings"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Block’s content..</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-themed">
                <div class="block-header bg-muted">
                    <h3 class="block-title">Gray Dark</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-settings"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Block’s content..</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-themed">
                <div class="block-header bg-gray-darker">
                    <h3 class="block-title">Gray Darker</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-settings"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Block’s content..</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-themed">
                <div class="block-header bg-black">
                    <h3 class="block-title">Black</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-settings"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Block’s content..</p>
                </div>
            </div>
        </div>
    </div>
    <!-- END Square Themed Blocks -->
    </div>
    
    <!-- Dialogs
    ================================================== -->
    <div class="bs-docs-section">
    
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1 id="dialogs">Dialogs</h1>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <h2>Modals</h2>
        <div class="bs-component">
            <a href="#modal-block-normal" class="btn btn-primary" data-toggle="modal">Show Modal</a>
            <div class="modal" id="modal-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content rounded-0">
                        <div class="block mb-0">
                            <div class="block-header">
                                <div class="media w-100">
                                    <div class="pic mr-3 position-relative">
                                        <img src="//source.unsplash.com/random/64x64" alt="" class="rounded-circle">
                                        <i class="position-absolute  fa fa-plus-circle" style="bottom: 0; right: 0;"></i>
                                    </div>
                                    <div class="media-body d-flex">
                                        <h3 class="block-title">Modal Title</h3>
                                        <div class="block-options">
                                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                <i class="fa fa-fw fa-plus"></i>
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
                            <div class="block-content p-0 d-flex">
                                <button type="button" class="btn btn-xl btn-default flex-grow-1" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-xl btn-dark flex-grow-1" data-dismiss="modal">Done</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="col-lg-6">
        <h2>Popovers</h2>
        <div class="bs-component" style="margin-bottom: 3em;">
          <button type="button" class="btn btn-secondary" title="Popover Title" data-container="body" data-toggle="popover" data-placement="left" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">Left</button>
    
          <button type="button" class="btn btn-secondary" title="Popover Title" data-container="body" data-toggle="popover" data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">Top</button>
    
          <button type="button" class="btn btn-secondary" title="Popover Title" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Vivamus
          sagittis lacus vel augue laoreet rutrum faucibus.">Bottom</button>
    
          <button type="button" class="btn btn-secondary" title="Popover Title" data-container="body" data-toggle="popover" data-placement="right" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">Right</button>
        </div>
        <h2>Tooltips</h2>
        <div class="bs-component" style="margin-bottom: 3em;">
          <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="left" title="Tooltip on left">Left</button>
    
          <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Top</button>
    
          <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">Bottom</button>
    
          <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="right" title="Tooltip on right">Right</button>
        </div>
        <h2>Toasts</h2>
        <div class="bs-component">
          <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
              <strong class="mr-auto">Bootstrap</strong>
              <small>11 mins ago</small>
              <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="toast-body">
              Hello, world! This is a toast message.
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    
    <div id="source-modal" class="modal fade" tabindex='-1'>
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Source Code</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <pre contenteditable></pre>
        </div>
      </div>
    </div>
    </div>
</div>
@endsection

@extends('layouts.base', ['VueId' => 'home'])
@section('body')

  <div class="row">
    <div class="col-xs-12 col-sm-9">
      <div id="articles" class="">
        <div class="ui four column grid doubling stackable container">
          <div class="ui column">
            <div class="ui segments">
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
            </div>
          </div>
          <div class="ui column">
            <div class="ui segments">
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
            </div>
          </div>
          <div class="ui column">
            <div class="ui segments">
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
            </div>
          </div>
          <div class="ui column">
            <div class="ui segments">
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
              <div class="ui segment">Content</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection

@section('js')
  <script src="{{ asset('js/app.js') }}"></script>
@endsection

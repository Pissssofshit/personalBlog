{{-- SideNav --}}
<ul id="slide-out" class="sidenav">

    <li>
        <div class="user-view">
            <div class="background">
                <img src="{{ asset('images/red-black.png') }}" alt="">
            </div>
            <span><img class="circle" src="{{ asset('images/avatar.jpg') }}"></span>
            <span class="white-text name">Miles Peng</span>
            <a href="mailto:mingpeng16@gmail.com"><span class="white-text email">mingpeng16@gmail.com</span></a>
        </div>
    </li>

    <li class="no-padding">
        <ul class="collapsible collapsible-accordion">

            <li>
                <a class="collapsible-header waves-effect waves-teal">
                    <i class="material-icons">apps</i>@lang('menus.categories')
                </a>
                <div class="collapsible-body">
                    <ul>
                        @foreach($categories as $category)
                            <li>
                                <a class="waves-effect waves-teal" href="{{ url('categories.show', $category->slug) }}">
                                    <span class="badge teal white-text">{{ $category->posts_count }}</span>
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>

        </ul>
    </li>
    <li><div class="divider"></div></li>
    {{--<li><a class="subheader">Subheader</a></li>--}}
    <li><a href="{{ url('home', 'indigo') }}" class="waves-effect waves-teal"><i class="material-icons">bubble_chart</i>@lang('menus.project')</a></li>
    <li><a class="waves-effect waves-teal" href="{{ url('home', 'archives') }}"><i class="material-icons">date_range</i>@lang('menus.archives')</a></li>
    <li><a class="waves-effect waves-teal" href="{{ url('home', 'links') }}"><i class="material-icons">link</i>@lang('menus.links')</a></li>
    <li><a class="waves-effect waves-teal" href="{{ url('home', 'about') }}"><i class="material-icons">person</i>@lang('menus.about')</a></li>
    <li><a class="waves-effect waves-teal" href="https://github.com/MilesPong"><i class="material-icons">code</i>Github</a></li>

</ul>

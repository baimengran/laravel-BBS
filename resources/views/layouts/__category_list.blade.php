@if(isset($category['children'])&&count($category['children'])>0)

    <li class="dropdown-submenu">
        <a href="{{route('categories.show',[$category['id']])}}">{{$category['name']}}<i class="fa fa-caret-down"></i></a>
        <ul class="dropdown-menu">
            @each('layouts.__category_list',$category['children'],'category')
        </ul>
    </li>

@else
    <li class=""><a href="{{route('categories.show',[$category['id']])}}">{{$category['name']}}</a></li>

    @endif
{{--<li class="dropdown-submenu">--}}
{{--<a href="#">选项2 <span class="tip tip-dark">hot</span>--}}
{{--<em class="not-included">(标记)</em><i--}}
{{--class="fa fa-caret-down"></i></a>--}}
{{--<ul class="dropdown-menu">--}}
{{--<li><a href="#">选项2-1</a></li>--}}
{{--</ul>--}}
{{--</li>--}}
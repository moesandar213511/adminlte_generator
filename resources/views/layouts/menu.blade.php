<li class="{{ Request::is('categories*') ? 'active' : '' }}">
    <a href="{{ route('categories.index') }}"><i class="fa fa-edit"></i><span>Categories</span></a>
</li>

<li class="{{ Request::is('posts*') ? 'active' : '' }}">
    <a href="{{ route('posts.index') }}"><i class="fa fa-edit"></i><span>Posts</span></a>
</li>

<li class="{{ Request::is('ads*') ? 'active' : '' }}">
    <a href="{{ route('ads.index') }}"><i class="fa fa-edit"></i><span>Ads</span></a>
</li>

<li class="{{ Request::is('webpages*') ? 'active' : '' }}">
    <a href="{{ route('webpages.index') }}"><i class="fa fa-edit"></i><span>Webpages</span></a>
</li>

<li class="{{ Request::is('adsWebpages*') ? 'active' : '' }}">
    <a href="{{ route('adsWebpages.index') }}"><i class="fa fa-edit"></i><span>Ads Webpages</span></a>
</li>


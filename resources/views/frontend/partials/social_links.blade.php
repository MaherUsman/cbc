<ul class="{{isset($className) ? $className : 'social-links'}} clearfix">
    @foreach($socialLinks as $socialLink)
        <li><a target="_blank" href="{{$socialLink->social_link}}"><i class="{{$socialLink->social_icon}}"></i></a></li>
    @endforeach
</ul>

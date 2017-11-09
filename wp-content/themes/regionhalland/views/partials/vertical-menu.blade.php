@if(isset($verticalNav) && is_array($verticalNav) && !empty($verticalNav) && count($verticalNav) > 1)
	@foreach($verticalNav as $navItem)
	    <a href="{!! $navItem['link'] !!}" data-link-tooltip="{{ $navItem['title'] }}"></a>
	@endforeach
@endif

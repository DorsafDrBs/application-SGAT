
@if(!empty($months))
  @foreach($months as $key => $value)
    <option value="{{ $key }}">{{ $value }}</option>
  @endforeach
@endif
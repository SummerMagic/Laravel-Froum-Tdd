@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				@foreach($thread->replies as $reply)
					@include('threads.reply')
				@endforeach
			</div>
		</div>

		@if (auth()->check())
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<form method="post" action="{{ $thread->path() . '/replies' }}">
					{{ csrf_field() }}
					<div class="form-group">
						<textarea name="body" id="body" class="form-control" placeholder="说点什么吧..."rows="5"></textarea>
					</div>

					<button type="submit" class="btn btn-default">提交</button>

				</form>
			</div>
		</div>
		@endif

	</div>
@endsection

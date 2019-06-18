@extends('index-denied')


@section('content')

	<div class="container" id="form-indicacao">

		<div class="row justify-content-md-center py-5">

			<div class="col-md-6">
				<div class="jumbotron">

					<div class="row">
						<div class="col-md-5">
							<h1 class="display-3">Ops..</h1>
							<p class="lead text-left">Você não tem permissão para isso.</p>
				  			<a class="btn btn-primary btn-lg" href="{{ route('home') }}" role="button">Ir para a página principal do site</a>
						</div>
						<div class="col-md-2"></div>
						<div class="col-md-5 text-center">
							<img src="{{ asset('images/B6.png') }}" />
						</div>
					</div>


				</div>
			</div>

		</div>

	</div>

@endsection

@section('footer')
@endsection